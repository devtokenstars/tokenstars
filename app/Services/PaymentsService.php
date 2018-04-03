<?php

namespace App\Services;


interface PaymentsService {

    /**
     * @param $amount double
     * @param $currency string
     * @param $buyerEmail string
     * @return mixed
     */
    function createTransaction($amount, $currency, $address='', $buyerEmail='');

    /**
     * @param $currency string
     * @return mixed
     */
    function createWallet($currency);

    function getExchangeRates();
}
