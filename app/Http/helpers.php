<?php

use App\Models\Accounts\Currency;

function currencies()
{
    $currencies = config("app.default_wallet_currencies");
    return Currency::whereIn('code', $currencies)->get();
}
