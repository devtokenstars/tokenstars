<?php

namespace App\Http\Controllers;

use App\Mail\AddressEmail;
use App\Models\Accounts\Promo;
use App\Models\Bid;
use App\Models\Item;
use App\Models\User;
use App\Repositories\AccountRepository;
use App\Repositories\CurrencyRepository;
use App\Repositories\PriceRepository;
use App\Repositories\TransferRepository;
use App\Services\PaymentsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Mail\PurchaseEmail;
use Illuminate\Support\Facades\Mail;

class TokensController extends Controller
{
    protected $transferRepository;
    protected $paymentsService;
    protected $priceRepository;
    protected $accountRepository;
    protected $currencyRepository;

    public function __construct(
        AccountRepository $accountRepository,
        TransferRepository $transferRepository,
        PaymentsService $paymentsService,
        PriceRepository $priceRepository,
        CurrencyRepository $currencyRepository
    ) {
        parent::__construct();
        $this->transferRepository = $transferRepository;
        $this->paymentsService = $paymentsService;
        $this->priceRepository = $priceRepository;
        $this->accountRepository = $accountRepository;
        $this->currencyRepository = $currencyRepository;
        $this->middleware('auth')->except('wallet_user');
    }
    private function getMinValueRule($currency) {
        $minAmount = $this->currencyRepository->getMinAmount($currency);
        if ($minAmount >= 0) {
            return '|min:' . $minAmount;
        }
        return '';
    }

    protected function getBidAmountByCurrency($bid, $currency)
    {
        if ($currency === 'ETH') {
            return $bid->eth_amount;
        }
        return bcmul($bid->eth_amount, $this->priceRepository->getPrice('ETH', $currency), 20);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $attributes = [];
        foreach ($this->currencyRepository->getActiveCurrencies() as $currency) {
            $attributes[$currency] = 'numeric' . $this->getMinValueRule($currency);
        }

        return Validator::make($data, $attributes);
    }

    protected function walletValidator(array $data)
    {
        $attributes = [
            'currency' => 'required|in:' . implode(',', $this->currencyRepository->getActiveCurrencies()),
            'item_id' => 'required|exists:items,id',
        ];
        return Validator::make($data, $attributes);
    }

    protected function bidData($item, $user, $currency_code, $wallet)
    {
        $highestBid = 0;
        if ($item->winner) {
            $highestBid = $this->getBidAmountByCurrency($item->winner, $currency_code);
        }
        $yourBid = $user ? $user->getLastBid($item) : false;
        $yourBid = $yourBid ? $this->getBidAmountByCurrency($yourBid, $currency_code) : 0;
        $price = $this->priceRepository->getPrice('ETH', $currency_code);
        $stepEth = bcmul(0.05, $price, 20);
        if ($highestBid > 0) {
            if ($yourBid > 0) {
                if ($item->winner && $item->winner->user->id === $user->id) {
                    $leadBid = 0;
                } else {
                    $leadBid = bcadd(bcsub($highestBid, $yourBid, 20), $stepEth, 20);
                }
            } else {
                $leadBid = bcadd($highestBid, $stepEth, 20);
            }
        } else {
            if ($item->min_bid_amount && $item->min_bid_amount > 0) {
                $leadBid = bcmul($item->min_bid_amount, $price, 20);
            } else {
                $leadBid = $stepEth;
            }
        }
        return [
            'wallet' => $wallet,
            'highest_bid' => $this->roundBid($highestBid, $currency_code),
            'your_bid' =>  $this->roundBid($yourBid, $currency_code),
            'lead_bid' => $this->roundBid($leadBid, $currency_code),
            'metamask_bid' => $leadBid ? number_format($leadBid, 4) :  0,
            'eth_wallet' => $item->auction_address,
            'item' => $item->title
        ];
    }

    public function wallet_user(Request $request)
    {
        $data = Input::except('_method', '_token');
        $validator = Validator::make($request->only('email'), [
            'email' => 'required|email',
        ]);
        $validator->validate();
        $this->walletValidator($request->only('currency', 'item_id'))->validate();
        $query = User::where([
            'email' => $data['email'],
        ]);
        $password = null;
        if ($query->exists()) {
            $user = $query->first();

            if ($user->confirmed) {
                return response(['error' => 'This email address is already in use. Please sign in.']);
            }

        } else {
            $password = str_random(8);
            $user = new User(['email' => $data['email'], 'password' => bcrypt($password)]);
        }

        $user->confirmed = true;
        $user->save();

        $item = Item::where('id', $request->input('item_id'))->firstOrFail();
        $currency_code = $request->input('currency');
        $account = $this->accountRepository->getOrCreate($user, $currency_code, $item);
        $bidData = $this->bidData($item, $user, $currency_code, $account->wallet);
        Mail::send(new AddressEmail($account, $bidData, $password));
        return response($bidData);
    }

    public function wallet(Request $request)
    {
        $currency_code = $request->input('currency');
        /** @var Item $item */
        $item = Item::where('id', $request->input('item_id'))->firstOrFail();
        /** @var User $user */
        $user = Auth::user();
        if ($currency_code === 'ACE' || $currency_code === 'TEAM') {
            $wallet = $item->auction_address;
        } else {
            $this->walletValidator($request->only('currency', 'item_id'))->validate();
            $account = $this->accountRepository->getOrCreate($user, $currency_code, $item);
            $wallet = $account->wallet;
        }
        return response($this->bidData($item, $user, $currency_code, $wallet));
    }

    private function roundBid($bid, $code)
    {
        if ($code === 'ACE' || $code === 'TEAM') {
            return $bid ? round($bid) . ' ' . $code :  'NO';
        } else {
            return $bid ? number_format($bid, 4) . ' ' . $code :  'NO';
        }
    }

    public function buy(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = Input::except('_method', '_token');
            $this->validator($data)->validate();
            $user = Auth::user();
            $promo = Promo::where('slug', config('app.current_promo_slug'))->first();
            $amount = 0; // Суммарное кол-во токенов для отправки в письме
            $items = [];
            $usd = 0; // Суммарное кол-во USD в транзакции для отправки в GA
            foreach ($data as $currency => $value) {
                if ($value <= 0) {
                    continue;
                }

                $usd += bcmul($value, $this->priceRepository->getPrice($currency, 'USD'), 20);
                $items[] = $value.' '.$currency;

                $userCoinAccount = $this->accountRepository->getOrCreate($user, $currency);
                $sellerCoinAccount = $this->accountRepository->getOrCreateNonWallet($promo->user, $currency);
                $amount += $this->transferRepository->createCoinsForTokensTransfer(
                    $userCoinAccount,
                    $sellerCoinAccount,
                    $value,
                    $promo,
                    'Coins For Tokens'
                );
            }

            Mail::send(new PurchaseEmail($user, $amount, $promo, $items));

            return redirect()->route('portfolio')->with('transaction', $usd);
        }

        return redirect()->route('portfolio');
    }
}
