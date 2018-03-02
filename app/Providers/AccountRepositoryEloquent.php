<?php

namespace App\Repositories;

use App\Models\Accounts\AccountType;
use App\Models\Accounts\Currency;
use App\Models\Accounts\Promo;
use App\Models\Item;
use App\Models\User;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Accounts\Account;

/**
 * Class AccountRepositoryEloquent.
 */
class AccountRepositoryEloquent extends BaseRepository implements AccountRepository
{
    protected $priceRepository;
    public function __construct(Container $app, PriceRepository $priceRepository)
    {
        parent::__construct($app);
        $this->priceRepository = $priceRepository;
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Account::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $attributes)
    {
        $user = array_has($attributes, 'user') ? $attributes['user'] : null;
        $currency = $attributes['currency'];
        $wallet = array_has($attributes, 'wallet') ? $attributes['wallet'] : null;
        $account = new Account([
            'name' => $user ? $user->email." (${currency})" : "${currency} wallet",
            'status' => Account::OPEN,
        ]);
        $accountType = AccountType::firstOrCreate(['name' => AccountType::BANK_ACCOUNT_NAME]);
        $currency = Currency::where(['code' => $currency])->first();
        if ($user) {
            $account->user()->associate($user);
        }
        $account->accountType()->associate($accountType);
        $account->currency()->associate($currency);
        $account->save();

        if ($wallet) {
            if (array_has($wallet, 'address')) {
                $account->wallet = $wallet['address'];
            }
            if (array_has($wallet, 'pubkey')) {
                $account->pubkey = $wallet['pubkey'];
            }
            if (array_has($wallet, 'dest_tag')) {
                $account->dest_tag = $wallet['dest_tag'];
            }
            $account->save();
        }
        return $account;
    }

    public function createCoinSource($currency)
    {
        $accountName = "${currency} Coin Source";
        if (Account::where('name', $accountName)->exists()) {
            return Account::where('name', $accountName)->first();
        }
        $account_type = AccountType::where('name', AccountType::BANK_ACCOUNT_NAME)->first();
        $account = new Account([
            'name' => $accountName,
            'status' => Account::OPEN,
            'credit_limit' => null,
        ]);
        $currency = Currency::where('code', $currency)->first();
        $account->currency()->associate($currency);
        $account->accountType()->associate($account_type);
        $account->save();

        return $account;
    }

    public function getOrCreate(User $user, $currency, Item $item)
    {
        if (config('app.debug')) {
            Log::info(array($user->id, $currency, $item->id));
        }
        $query = $user->accountOfCurrency($currency)->where('item_id', $item->id);
        if (!$query->exists()) {
            DB::transaction(function () use ($user, $currency, $item) {
                $account = Account::whereNull('user_id')->whereNotNull('wallet')->whereHas('currency', function ($q) use ($currency) {
                    $q->where('code', $currency)->where('is_active', true);
                })->firstOrFail();
                $account->user()->associate($user);
                $account->item()->associate($item);
                $account->save();
            });
        }
        return $query->firstOrFail();
    }

    public function getOrCreateNonWallet(User $user, $currency) {
        $query = $user->accountOfCurrency($currency)->whereNull('wallet');
        if (!$query->exists()) {
            return $this->create(['user' => $user, 'currency' => $currency]);
        }
        return $query->first();
    }

    public function getOrCreateItemWallet(Item $item, $currency) {
        if (!$item->user()->exists()) {
            $user = new User();
            $user->password = '';
            $user->email = 'item_' . $item->id . '@tokenstars.com';
            $user->name = $item->slug_name . "'s item";
            $user->save();
            $item->user()->associate($user);
            $item->save();
        }
        if (!$item->user->accountOfCurrency($currency)->exists()) {
            return $this->create(['user' => $item->user, 'currency' => $currency]);
        }
        return $item->user->accountOfCurrency($currency)->first();
    }

    public function getOrCreateUserETHWallet($address)
    {
        if (Account::where('wallet', $address)->exists()) {
            return Account::where('wallet', $address)->first();
        }
        if (User::where('wallet', $address)->exists()) {
            return $this->create([
                'user' => User::where('wallet', $address)->first(),
                'currency' => 'ETH',
                'wallet' => ['address' => $address],
                'credit_limit' => null
            ]);
        }
        return $this->create([
            'currency' => 'ETH',
            'wallet' => ['address' => $address],
        ]);
    }

    public function getCollected(Promo $promo, $extra=0) {
        $btc = $this->getOrCreateNonWallet($promo->user, 'BTC')->balance;
        $eth = $this->getOrCreateNonWallet($promo->user, 'ETH')->balance + $extra;
        $usd = bcmul($eth, $this->priceRepository->getPrice('ETH', 'USD'), 20);
        $usd += bcmul($btc, $this->priceRepository->getPrice('BTC', 'USD'), 20);
        $eth += bcmul($btc, $this->priceRepository->getPrice('BTC', 'ETH'), 20);
        return [
            'ETH' => round($eth, 2),
            'USD' => round($usd)
        ];
    }

    public function isValidETHAddress($address) {
        $result = null;
        $cmd = 'python -c "from eth_utils.address import is_address; print is_address(\"'. $address . '\")"';
        exec($cmd, $result);
        return count($result) > 0 && $result[0] === 'True';
    }

}
