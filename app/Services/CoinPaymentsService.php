<?php

namespace App\Services;


use App\Services\API\CoinPaymentsAPI;
use Illuminate\Support\Facades\Log;

class CoinPaymentsService implements PaymentsService {

    protected $apiClient;

    public function __construct() {
        $this->apiClient = new CoinPaymentsAPI();
    }

    public function createTransaction($amount, $currency, $address='', $buyerEmail='') {
        $ipnUrl = config('services.coinpayments')['ipn_host'] . route('coinpayments.transactionIpnUrl', [], false);
        $response = $this->apiClient->createTransactionSimple(
            $amount,
            $currency,
            $currency,
            $address,
            $ipnUrl,
            $buyerEmail
        );
        Log::info(array($amount, $address, $currency, $response));
        $result = ['error' => '', 'redirect' => '', 'reference' => ''];
        if (array_has($response, 'error') && $response['error'] !== 'ok') {
            $result['error'] = $response['error'];
        }
        if (array_has($response, 'result.status_url') && $response['result']['status_url']) {
            $result['redirect'] = $response['result']['status_url'];
        }
        if (array_has($response, 'result.txn_id') && $response['result']['txn_id']) {
            $result['reference'] = $response['result']['txn_id'];
        }
        return $result;
    }

    function createWallet($currency) {
        $ipnUrl = config('services.coinpayments')['ipn_host'] . route('coinpayments.depositIpnUrl', [],false);
        $response = $this->apiClient->getCallbackAddress($currency, $ipnUrl);
        if (array_has($response, ['error']) && $response['error'] === 'ok') {
            $result = $response['result'];
        } else {
            $result = [];
            Log::error($response['error']);
        }
        return $result;
    }

    function getExchangeRates() {
        $rates = $this->apiClient->getRates(false);
        if (!array_key_exists('result', $rates)) {
            Log::error('Sync exchange rates: Invalid response: ' . json_encode($rates));
            return [];
        }
        return $rates['result'];
    }
}
