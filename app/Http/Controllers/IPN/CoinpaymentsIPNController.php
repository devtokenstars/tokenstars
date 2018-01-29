<?php

namespace App\Http\Controllers\IPN;

use App\Http\Controllers\Controller;
use App\Mail\BidEmail;
use App\Mail\FirstBidEmail;
use App\Models\Accounts\Account;
use App\Models\Accounts\Transaction;
use App\Models\Accounts\Transfer;
use App\Models\Bid;
use App\Repositories\AccountRepository;
use App\Repositories\PriceRepository;
use App\Repositories\TransferRepository;
use App\Services\EthereumService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CoinpaymentsIPNController extends Controller
{
    protected $transferRepository;
    protected $accountRepository;
    protected $priceRepository;
    /**
     * @var $ethereumService EthereumService
     */
    protected $ethereumService;

    public function __construct(TransferRepository $transferRepository,
                                AccountRepository $accountRepository,
                                EthereumService $ethereumService,
                                PriceRepository $priceRepository)
    {
        parent::__construct();
        $this->transferRepository = $transferRepository;
        $this->accountRepository = $accountRepository;
        $this->ethereumService = $ethereumService;
        $this->priceRepository = $priceRepository;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'merchant' => [
                'required',
                Rule::in([config('services.coinpayments')['merchant_id']]),
            ],
            'ipn_type' => 'required|in:simple,button,cart,donation,deposit,api',
            'status' => 'required',
            'txn_id' => 'required',
        ]);
    }

    protected function depositValidator(array $data)
    {
        return Validator::make($data, [
            'merchant' => [
                'required',
                Rule::in([config('services.coinpayments')['merchant_id']]),
            ],
            'ipn_type' => 'required|in:deposit',
            'status' => 'required',
            'txn_id' => 'required',
            'currency' => 'required',
            'address' => 'required',
            'amount' => 'required',
        ]);
    }

    private function checkRequest(Request $request)
    {
        $hmacHeader = $request->header('Hmac');
        if (!$hmacHeader) {
            return response('No HMAC signature sent', 400);
        }
        $hmac = hash_hmac("sha512", $request->getContent(), config('services.coinpayments')['ipn_secret']);
        if ($hmac !== $hmacHeader) {
            return response('HMAC signature does not match', 400);
        }
        return false;
    }

    public function transaction(Request $request)
    {
        $data = $request->all();
        Log::info($data);
        $validator = $this->validator($data);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        if ($response = $this->checkRequest($request)) {
            return $response;
        }
        if ($data['status'] >= 100) {
            $this->transferRepository->confirmTransferByReference($data['txn_id']);
        }
        return response('');
    }

    public function callbackAddress(Request $request)
    {
        $data = $request->all();
        Log::info($data);
        return response('');
    }

    public function deposit(Request $request)
    {
        bcscale(20);
        $data = $request->all();
        Log::info($data);
        $validator = $this->depositValidator($data);
        if ($validator->fails()) {
            Log::warning('Invalid data in IPN request: ' . $validator->errors());
            return response()->json($validator->messages(), 400);
        }

        if ($response = $this->checkRequest($request)) {
            return $response;
        }
        if ($data['status'] >= 0) {
            if (!Transfer::where('reference', $data['txn_id'])->exists()) {
                $source = $this->accountRepository->createCoinSource($data['currency']);
                $userAccount = Account::where('wallet', $data['address'])->first();
                $this->transferRepository->createTransfer(
                    $source,
                    $userAccount,
                    $data['amount'],
                    $data['txn_id'],
                    $userAccount->user,
                    $this->priceRepository->getPrice('ETH', $userAccount->currency->code),
                    "Deposit"
                );
            }
        }
        if ($data['status'] >= 100) {
            $confirmed = Transaction::whereHas('transfer', function ($q) use ($data) {
                $q->where('reference', $data['txn_id']);
            })->exists();
            if (Transfer::where('reference', $data['txn_id'])->exists() && !$confirmed) {
                $transfer = $this->transferRepository->confirmTransferByReference($data['txn_id']);
                $account = $transfer->destination;
                if (!$account->user_id || !Bid::where([
                    'user_id' => $account->user_id,
                    'item_id' => $account->item->id,
                ])->exists()) {
                    $bid = new Bid();
                    $bid->user()->associate($account->user);
                    $bid->item()->associate($account->item);
                } else {
                    $bid = Bid::where(['user_id' => $account->user_id, 'item_id' => $account->item->id])->first();
                }
                $bid->state = 'paid';
                $bid->save();

                $sellerCoinAccount = $this->accountRepository->getOrCreateItemWallet($bid->item, $transfer->destination->currency->code);
                $chargeTransfer = $this->transferRepository->createTransfer(
                    $transfer->destination,
                    $sellerCoinAccount,
                    $transfer->amount,
                    null,
                    $transfer->destination->user,
                    $transfer->price,
                    "Coins For Tokens"
                );
                $chargeTransfer->save();

                $amount = bcdiv($transfer->amount, $transfer->price, 20);
                $reference = $this->ethereumService->makeBidding($bid, $bid->received_amount + $amount);
                if ($reference) {
                    $chargeTransfer->reference = $reference;
                    $chargeTransfer->save();
                } else {
                    Log::error('Error during managedBid: bid id = ' . $bid->id . ', transfer id = ' . $transfer->id);
                }
            }
        }
        return response('');
    }
}
