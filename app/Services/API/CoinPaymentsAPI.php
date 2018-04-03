<?php

namespace App\Services\API;

/*
	CoinPayments.net API Class - v1.0
	Copyright 2014-2016 CoinPayments.net. All rights reserved.	
	License: GPLv2 - http://www.gnu.org/licenses/gpl-2.0.txt
*/

final class CoinPaymentsAPI {
	private $private_key = '';
	private $public_key = '';
	private $ch = null;

    public function __construct() {
	    $this->setup(config('services.coinpayments')['private_key'], config('services.coinpayments')['public_key']);
    }

    public function setup($private_key, $public_key) {
		$this->private_key = $private_key;
		$this->public_key = $public_key;
		$this->ch = null;
	}

	/**
	 * Gets the current CoinPayments.net exchange rate. Output includes both crypto and fiat currencies.
	 * @param bool $short If short == TRUE (the default), the output won't include the currency names and confirms needed to save bandwidth.
     * @return array data
	 */
	public function getRates($short = TRUE) {
		$short = $short ? 1:0;
		return $this->apiCall('rates', array('short' => $short));
	}

	/**
	 * Gets your current coin balances (only includes coins with a balance unless all = TRUE).<br />
	 * @param bool $all If all = TRUE then it will return all coins, even those with a 0 balance.
     * @return array data
	 */
	public function getBalances($all = FALSE) {
		return $this->apiCall('balances', array('all' => $all ? 1:0));
	}
	
	/**
	 * Creates a basic transaction with minimal parameters.<br />
	 * See CreateTransaction for more advanced features.
	 * @param double $amount The amount of the transaction (floating point to 8 decimals).
	 * @param string $currency1 The source currency (ie. USD), this is used to calculate the exchange rate for you.
	 * @param string $currency2 The cryptocurrency of the transaction. currency1 and currency2 can be the same if you don't want any exchange rate conversion.
	 * @param string $address Optionally set the payout address of the transaction. If address is empty then it will follow your payout settings for that coin.
	 * @param string $ipn_url Optionally set an IPN handler to receive notices about this transaction. If ipn_url is empty then it will use the default IPN URL in your account.
	 * @param string $buyer_email Optionally (recommended) set the buyer's email so they can automatically claim refunds if there is an issue with their payment.
     * @return array data
	 */
	public function createTransactionSimple($amount, $currency1, $currency2, $address='', $ipn_url='', $buyer_email='') {
		$req = array(
			'amount' => $amount,
			'currency1' => $currency1,
			'currency2' => $currency2,
			'address' => $address,
			'ipn_url' => $ipn_url,
			'buyer_email' => $buyer_email,
		);
		return $this->apiCall('create_transaction', $req);
	}

	public function createTransaction($req) {
		// See https://www.coinpayments.net/apidoc-create-transaction for parameters
		return $this->apiCall('create_transaction', $req);
	}

	/**
	 * Creates an address for receiving payments into your CoinPayments Wallet.<br />
	 * @param string $currency The cryptocurrency to create a receiving address for.
	 * @param string $ipn_url Optionally set an IPN handler to receive notices about this transaction. If ipn_url is empty then it will use the default IPN URL in your account.
     * @return array data
	 */
	public function getCallbackAddress($currency, $ipn_url = '') {
		$req = array(
			'currency' => $currency,
			'ipn_url' => $ipn_url,
		);
		return $this->apiCall('get_callback_address', $req);
	}

	/**
	 * Creates a withdrawal from your account to a specified address.<br />
	 * @param double $amount The amount of the transaction (floating point to 8 decimals).
	 * @param string $currency The cryptocurrency to withdraw.
	 * @param string $address The address to send the coins to.
	 * @param bool $auto_confirm If auto_confirm is TRUE, then the withdrawal will be performed without an email confirmation.
	 * @param string $ipn_url Optionally set an IPN handler to receive notices about this transaction. If ipn_url is empty then it will use the default IPN URL in your account.
     * @return array data
	 */
	public function createWithdrawal($amount, $currency, $address, $auto_confirm = FALSE, $ipn_url = '') {
		$req = array(
			'amount' => $amount,
			'currency' => $currency,
			'address' => $address,
			'auto_confirm' => $auto_confirm ? 1:0,
			'ipn_url' => $ipn_url,
		);
		return $this->apiCall('create_withdrawal', $req);
	}

	/**
	 * Creates a transfer from your account to a specified merchant.<br />
	 * @param double $amount The amount of the transaction (floating point to 8 decimals).
	 * @param string $currency The cryptocurrency to withdraw.
	 * @param string $merchant The merchant ID to send the coins to.
	 * @param bool $auto_confirm If auto_confirm is TRUE, then the transfer will be performed without an email confirmation.
     * @return array data
	 */
	public function createTransfer($amount, $currency, $merchant, $auto_confirm = FALSE) {
		$req = array(
			'amount' => $amount,
			'currency' => $currency,
			'merchant' => $merchant,
			'auto_confirm' => $auto_confirm ? 1:0,
		);
		return $this->apiCall('create_transfer', $req);
	}

	/**
	 * Creates a transfer from your account to a specified $PayByName tag.<br />
	 * @param double $amount The amount of the transaction (floating point to 8 decimals).
	 * @param string $currency The cryptocurrency to withdraw.
	 * @param string $pbntag The $PayByName tag to send funds to.
	 * @param bool $auto_confirm If auto_confirm is TRUE, then the transfer will be performed without an email confirmation.
     * @return array data
	 */
	public function sendToPayByName($amount, $currency, $pbntag, $auto_confirm = FALSE) {
		$req = array(
			'amount' => $amount,
			'currency' => $currency,
			'pbntag' => $pbntag,
			'auto_confirm' => $auto_confirm ? 1:0,
		);
		return $this->apiCall('create_transfer', $req);
	}
	
	private function isSetup() {
		return (!empty($this->private_key) && !empty($this->public_key));
	}
	
	private function apiCall($cmd, $req = array()) {
		if (!$this->isSetup()) {
			return array('error' => 'You have not called the Setup function with your private and public keys!');
		}
		
		// Set the API command and required fields
        $req['version'] = 1;
		$req['cmd'] = $cmd;
		$req['key'] = $this->public_key;
		$req['format'] = 'json'; //supported values are json and xml
	    
		// Generate the query string
		$post_data = http_build_query($req, '', '&');
	    
		// Calculate the HMAC signature on the POST data
		$hmac = hash_hmac('sha512', $post_data, $this->private_key);
		// Create cURL handle and initialize (if needed)
		if ($this->ch === null) {
			$this->ch = curl_init('https://www.coinpayments.net/api.php');
			curl_setopt($this->ch, CURLOPT_FAILONERROR, TRUE);
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
		}
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('HMAC: '.$hmac));
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($this->ch, CURLOPT_VERBOSE, true);
        $fp = fopen(storage_path().'/logs/curl.log', 'w');
        curl_setopt($this->ch, CURLOPT_STDERR, $fp);
	    
		$data = curl_exec($this->ch);                
		if ($data !== FALSE) {
			if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {
				// We are on 32-bit PHP, so use the bigint as string option. If you are using any API calls with Satoshis it is highly NOT recommended to use 32-bit PHP
				$dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
			} else {
				$dec = json_decode($data, TRUE);
			}
			if ($dec !== NULL && count($dec)) {
				return $dec;
			} else {
				// If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message
				return array('error' => 'Unable to parse JSON result ('.json_last_error().')');
			}
		} else {
			return array('error' => 'cURL error: '.curl_error($this->ch));
		}
	}
};
