<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\RemindQREmail;
use App\Models\Accounts\Transfer;
use App\Models\Item;
use App\Models\User;
use App\Repositories\AccountRepository;
use App\Repositories\CurrencyRepository;
use App\Repositories\PriceRepository;
use App\Services\EmailService;
use App\Services\EthereumService;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Accounts\Promo;
use App\Models\Accounts\Currency;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PragmaRX\Google2FA\Google2FA;

class HomeController extends Controller
{
    use ResetsPasswords;

    /** @var CurrencyRepository $currencyRepository */
    protected $currencyRepository;
    /** @var PriceRepository $priceRepository */
    protected $priceRepository;
    /** @var EmailService $emailService */
    protected $emailService;
    /** @var AccountRepository $accountRepository */
    protected $accountRepository;
    /** @var  EthereumService $ethereumService */
    protected $ethereumService;

    public function __construct(
        CurrencyRepository $currencyRepository,
        PriceRepository $priceRepository,
        EmailService $emailService,
        AccountRepository $accountRepository,
        EthereumService $ethereumService
    ) {
        parent::__construct();
        $this->currencyRepository = $currencyRepository;
        $this->priceRepository = $priceRepository;
        $this->emailService = $emailService;
        $this->accountRepository = $accountRepository;
        $this->ethereumService = $ethereumService;
    }

    public function home(Request $request)
    {
        $items = Item::whereIn('state', ['new', 'ended'])->orderBy('position')->get();
        if ($request->get('show')) {
            $items = Item::whereIn('id', explode(',', $request->get('show')))->orderBy('position')->get()->merge($items);
            Cookie::queue('show_items', $request->get('show'));
        }

        $items_exchange = [];

        foreach ($items as $item) {

            $bid = null;

            if ($item->winner) {
                $bid = $item->winner;
            }

            $items_exchange[] = ['item' => $item, 'usd' => $bid ? $item->rate_usd * $bid->eth_amount : false];

        }

        return view(
            'charity.index',
            [
                'items'=>$items_exchange,
                'registered'=>session('registered'),
            ]
        );
    }

    public function read(Request $request, $slug)
    {
        $bid = null;
        $item = Item::where('slug_name', $slug)->first();
        /** @var Item $item */
        if (!$item) abort(404);

        $other = Item::select(['id', 'name', 'card_name', 'slug_name', 'title'])
               ->where('id', '!=', $item->id)
               ->where('slug_name', '!=', 'boe')
               ->where('state', '=', 'new')->get();

        if ($item->winner) {
            $bid = $item->winner;
        }

        $item_exchange = ['item' => $item, 'usd' => $bid ? $item->rate_usd * $bid->eth_amount : false];

        $itemAccount = $this->accountRepository->getOrCreateItemWallet($item, 'ETH');

        $transfers = Transfer::where('item_id', $item->id)//whereIn('bid_id', $item->bids()->pluck('id'))
            ->has('transactions')
            ->orderBy('created_at', 'asc')->get();

        $extBids = [];
        $bidsAmount = [];
        foreach ($transfers as $transfer) {
            $extBids[] = [
                'amount' => $transfer->amount,
                'updated_at' => $transfer->created_at,
                'address' => $transfer->reference,
                'user_id' => $transfer->user_id,
            ];
        }

        $extBids = array_reverse($extBids);


        return view('charity.read',
            [
                'item'=>$item_exchange,
                'extBids' => $extBids,
                'bids'=>$item->getLastNBids(),
                'other_auctions'=>$other->shuffle()->slice(0, 3)
            ]);
    }


    public function portfolio(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user) {
            return redirect('/');
        }
        $currentPromo = Promo::where('slug', config('app.current_promo_slug'))->first();
        $wallet_currencies = $this->currencyRepository->getActiveCurrencies();

        $accounts = [];
        $currencies = [];
        $tokens = [];
        $totalPaid = 0;
        foreach ($wallet_currencies as $currency_code) {
            $currency = Currency::where('code', $currency_code)->first();
            $account = $user->accountOfCurrency($currency_code)->first();

            $sum = 0;

            if ($account) {
                $sum = $account->balance + 0;
            }

            $price = $this->priceRepository->getPriceForPromo($currentPromo->id, $currency_code);

            $current = $sum; // floor($sum / $price) * $price;

            $accounts[] = [
                'current' => $current,
                'code' => $currency_code,
                'name' => $currency->name,
                'price' => $price,
                'min_amount' => $this->currencyRepository->getMinAmount($currency->code),
                'account' => $account,
                'step' => 'ETH' == $currency_code ? 0.1 : 0.005,
            ];
            if ($account && $account->totalPaid() > 0) {
                $totalPaid += $account->totalPaid();
                array_push($currencies, $account->totalPaid() + 0 .' '.$currency->code);
            }
        }
        $account = $user->accountOfCurrency($currentPromo->currency->code)->first();
        if ($account && $account->totalReceived() > 0) {
            array_push($tokens, $account->totalReceived() + 0 .' '.$account->currency->code);
        }

        $transaction = null;
        $transaction_usd = session('transaction');
        if ($transaction_usd) {
            $transaction = $user->transactions()->orderBy('id', 'desc')->skip(1)->first();
            $transaction_usd = bcmul($transaction->amount, $this->priceRepository->getPrice('ETH', 'USD'), 20) * -1;
        }
        $userPromos = [];
        $accountsWithTransactions = $user->transactions()->pluck('account_id');
        $userTokenAccounts = $user->accounts()
            ->whereIn('currency_id', Promo::pluck('currency_id'))
            ->whereIn('id', $accountsWithTransactions)->get();
        foreach ($userTokenAccounts as $account) {
            $promo = Promo::where('currency_id', $account->currency_id)->first();
            if (!isset($userPromos[$promo->id])) {
                $userPromos[$promo->id] = ['promo' => $promo];
            }
            $transactions = $user->transactions()->whereHas('account', function ($q) use ($promo) {
                $q->where('currency_id', $promo->currency_id);
            });
            $userPromos[$promo->id]['transactions'] = $transactions->orderBy('created_at', 'asc')->get();
        }

        return view('promo.'.$currentPromo->slug.'.dashboard', [
            'view' => 'profile',
            'accounts' => $accounts,
            'promo' => $currentPromo,
            'account' => $user->accounts()->where('currency_id', $currentPromo->currency_id)->first(),
            'currencies' => $currencies,
            'showPaid' => $totalPaid > 0,
            'tkns' => $tokens,
            'transaction' => $transaction,
            'transaction_usd' => $transaction_usd,
            'userPromos' => $userPromos,
            'show_wallet_popover' => $transaction_usd !== null && $user->wallet === null
        ]);
    }

    public function subscribe(Request $request)
    {
        $result = $this->emailService->subscribe($request->get('email'));
        if ($result['status'] || 'Member Exists' == $result['error']) {
            return response('ok')->cookie('s', '1', 0)
                ->cookie('email', $request->input('email'));
        } else {
            return response($result['error'], 400);
        }
    }

    protected function profileValidator(Request $request)
    {
        Validator::extend('eth_address', function ($attribute, $value, $parameters, $validator) {
            return $this->accountRepository->isValidETHAddress($value);
        });
        return Validator::make($request->except(['_token']), [
            'name' => 'nullable',
            'password' => 'nullable|string|min:6|confirmed',
            'wallet' => 'nullable|eth_address',
            'current_password' => 'required_with:password'
        ]);
    }

    public function profile(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = $this->profileValidator($request);
            $validator->validate();
            $user = $request->user();
            $user->name = $request->input('name');
            $user->wallet = $request->input('wallet');
            $user->use_2fa = $request->has('use_2fa');
            if ($user->use_2fa && empty($user->google2fa_secret)) {
                $google2fa = new Google2FA();
                $user->google2fa_secret = $google2fa->generateSecretKey();
                $user->save();
                Mail::send(new RemindQREmail($user));
            } else {
                $user->save();
            }
            $message = trans('profile.changed');
            if ($request->input('password')) {
                if ($this->guard()->validate(['email' => $user->email, 'password' => $request->input('current_password')])) {
                    $this->resetPassword($user, $request->input('password'));
                    $message .= "<br>" . trans('profile.password_changed');
                } else {
                    $validator->errors()->add('current_password', trans('auth.failed'));
                }
            }
            return redirect()->back()->withErrors($validator)->with('status', $message);
        }
//        $show_wallet_notify = Cookie::get('new_confirmed');
        $show_wallet_notify = false;
        Cookie::queue(Cookie::forget('new_confirmed'));
        return view('layouts.promo.profile', ['show_wallet_notify'=>$show_wallet_notify]);
    }

    /**
     * User wallet validator.
     *
     * @param  Request $request HTTP-request.
     * @return Validator        validator
     */
    protected function userWalletValidator(Request $request)
    {
        Validator::extend('eth_address', function ($attribute, $value, $parameters, $validator) {
            return $this->accountRepository->isValidETHAddress($value);
        });
        return Validator::make($request->except(['_token']), [
            'wallet' => 'eth_address',
        ]);
    }

    /**
     * Set user wallet.
     *
     * @param Request $request HTTP-request
     */
    public function setUserWallet(Request $request)
    {
        $validator = $this->userWalletValidator($request);
        $validator->validate();
        $wallet = $request->input('wallet');

        $user = $request->user();
        $user->wallet = $wallet;
        $user->save();
        return response('saved', 200);
    }

    public function rules(Request $request)
    {
        return view('charity.rules');
    }
}
