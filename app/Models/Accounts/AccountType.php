<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    const TOKENS_SOURCE_ACCOUNT_NAME = 'Tokens Source';
    const BANK_ACCOUNT_NAME = 'Bank Account';
    const CURRENCY_ACCOUNT_NAME = 'Currency Account';
    const BID_AGGREGATE_ACCOUNT_NAME = 'Bid Aggregate Account';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
