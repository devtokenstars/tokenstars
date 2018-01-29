<?php

namespace App\Repositories;

use App\Exceptions\Accounts\AccountException;
use App\Exceptions\Accounts\ClosedAccountException;
use App\Exceptions\Accounts\InsufficientFundsException;
use App\Exceptions\Accounts\InvalidAmountException;
use App\Models\Accounts\Account;
use App\Models\Accounts\Currency;
use App\Models\Accounts\Transaction;
use App\Models\Accounts\Transfer;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Carbon\Carbon;

/**
 * Class TransferRepositoryEloquent.
 */
class TransferRepositoryEloquent extends BaseRepository implements TransferRepository
{
    protected $accountRepository;
    protected $priceRepository;

    public function __construct(Container $app, AccountRepository $accountRepository, PriceRepository $priceRepository)
    {
        parent::__construct($app);
        $this->accountRepository = $accountRepository;
        $this->priceRepository = $priceRepository;
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Transfer::class;
    }

    public function create(array $attributes)
    {
        throw new \Exception('Not implemented. Use createTransfer instead.');
    }

    public function createTransfer(Account $source, Account $destination, $amount, $reference, User $user = null, $price=null, $description = null)
    {
        $this->verifyTransfer($source, $destination, $amount, $user);
        $transfer = new Transfer([
            'amount' => $amount,
            'reference' => $reference,
            'description' => $description,
            'price' => $price,
        ]);
        $transfer->source()->associate($source);
        $transfer->destination()->associate($destination);
        if ($user) {
            $transfer->user()->associate($user);
        }
        $transfer->save();
        return $transfer;
    }

    public function confirmTransfer(Transfer $transfer)
    {
        DB::transaction(function () use ($transfer) {
            $sourceId = $transfer->source->id;
            $destinationId = $transfer->destination->id;
            $transaction = new Transaction([
                'amount' => -1 * $transfer->amount,
            ]);
            $transaction->transfer()->associate($transfer);
            $transaction->account()->associate($transfer->source);
            $transaction->save();
            $transaction = new Transaction([
                'amount' => $transfer->amount,
            ]);
            $transaction->transfer()->associate($transfer);
            $transaction->account()->associate($transfer->destination);
            $transaction->save();
            $this->updateBalance([$sourceId, $destinationId]);
        }, 10);
    }

    public function confirmTransferByReference($reference)
    {
        $transfer = Transfer::where('reference', $reference)->first();
        $this->confirmTransfer($transfer);
        return $transfer;
    }

    private function verifyTransfer(Account $source, Account $destination, $amount, User $user = null)
    {
        if ($amount <= 0) {
            throw new InvalidAmountException("Invalid amount: ${amount}");
        }
        if (!$source->isOpen()) {
            throw new ClosedAccountException('Source account '.$source->id.' is closed.');
        }
        if (!$source->canBeAuthorisedBy($user)) {
            throw new AccountException('This user is not authorised to make transfers from this account.');
        }
        if (!$destination->isOpen()) {
            throw new ClosedAccountException('Destination account '.$destination->id.' is closed.');
        }
        if (!$source->isDebitPermitted($amount)) {
            throw new InsufficientFundsException("Unable to debit ${amount} from account #".$source->id);
        }
    }

    /**
     * @param Transfer $transfer
     * @param Bid $bid
     * @return Transfer
     */
    public function createTokensTransfer(Transfer $transfer, Bid $bid)
    {
        $currency = Currency::where('code', 'ETH')->firstOrFail();
        $tokenSource = $this->accountRepository->getOrCreateNonWallet($transfer->destination->user, $currency->code);
        $tokenDestination = $this->accountRepository->getOrCreateItemWallet($bid->item, 'ETH');
        $scale = 20;
        $totalSum = bcdiv($transfer->amount, $transfer->price, $scale);

        $tokensTransfer = new Transfer([
            'amount' => $totalSum,
            'description' => $transfer->description . ' [ETH transfer]',
            'price' => $transfer->price,
        ]);
        $tokensTransfer->source()->associate($tokenSource);
        $tokensTransfer->destination()->associate($tokenDestination);
        $tokensTransfer->bid()->associate($bid);
        $tokensTransfer->parent()->associate($transfer);
        $tokensTransfer->save();

        DB::transaction(function () use ($transfer, $tokenSource, $tokenDestination, $totalSum, $tokensTransfer) {
            // Транзакция на снятие койнов с юзера
            $sourceId = $transfer->source->id;
            $destinationId = $transfer->destination->id;
            $transaction = new Transaction([
                'amount' => -1 * $transfer->amount,
            ]);
            $transaction->transfer()->associate($transfer);
            $transaction->account()->associate($transfer->source);
            $transaction->save();

            // Транзакция на перевод койнов юзеру акции
            $transaction = new Transaction([
                'amount' => $transfer->amount,
            ]);
            $transaction->transfer()->associate($transfer);
            $transaction->account()->associate($transfer->destination);
            $transaction->save();

            // Транзакия на снятие токенов с юзера акции
            $transaction = new Transaction([
                'amount' => -1 * $totalSum,
            ]);
            $transaction->transfer()->associate($tokensTransfer);
            $transaction->account()->associate($tokenSource);
            $transaction->save();

            // Транзакция на зачисление токенов юзеру
            $transaction = new Transaction([
                'amount' => $totalSum,
            ]);
            $transaction->transfer()->associate($tokensTransfer);
            $transaction->account()->associate($tokenDestination);
            $transaction->save();
            $this->updateBalance([$sourceId, $destinationId, $tokenSource->id, $tokenDestination->id]);
        }, 10);

        return $tokensTransfer;
    }


    public function reverseTransfer(Transfer $transfer, User $user = null, $description = null)
    {
        $reverseTransfer = new Transfer([
            'amount' => $transfer->amount,
            'description' => $description,
        ]);
        $reverseTransfer->source()->associate($transfer->destination);
        $reverseTransfer->destination()->associate($transfer->source);
        if ($user) {
            $reverseTransfer->user()->associate($user);
        }
        $reverseTransfer->save();
        $transfer->reverse()->associate($reverseTransfer);
        $transfer->save();
        $this->confirmTransfer($reverseTransfer);
        return $reverseTransfer;
    }

    /**
     * @param Builder $transfers
     * @param int $newBonus
     */
    public function recalcBonus(Builder $transfers, $newBonus)
    {
        foreach ($transfers->get() as $transfer)
        {
            DB::transaction(function () use ($transfer, $newBonus) {
                $scale = 20;
                $transfer->bonus = $newBonus;
                $transfer->save();
                if ($transfer->parent) {
                    $bonusRatio = bcdiv(100 + $newBonus, 100, $scale);
                    $totalSum = bcdiv($transfer->parent->amount, $transfer->parent->price, $scale);
                    $tokensAmount = bcmul($totalSum, $bonusRatio, $scale);
                    $sourceId = $transfer->source_id;
                    $destinationId = $transfer->destination_id;
                    Transaction::where(['account_id' => $sourceId, 'transfer_id' => $transfer->id])->update([
                        'amount' => -1 * $tokensAmount,
                        'updated_at' => Carbon::now(),
                    ]);
                    Transaction::where(['account_id' => $destinationId, 'transfer_id' => $transfer->id])->update([
                        'amount' => $tokensAmount,
                        'updated_at' => Carbon::now(),
                    ]);
                    $this->updateBalance([$sourceId, $destinationId]);
                }
            }, 10);
        }
    }

    /**
     * @param array $accounts
     */
    protected function updateBalance(array $accounts)
    {
        DB::table('accounts')->join(
            DB::raw('(SELECT account_id, sum(amount) total_amount FROM transactions GROUP BY account_id) transactions_amount'),
            DB::raw('transactions_amount.account_id'), '=', 'accounts.id'
        )->whereIn('accounts.id', $accounts)
            ->update([
                'balance' => DB::raw('transactions_amount.total_amount'),
                'updated_at' => Carbon::now(),
            ]);
    }
    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
