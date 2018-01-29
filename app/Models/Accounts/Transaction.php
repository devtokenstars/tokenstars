<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'amount',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function transfer() {
        return $this->belongsTo('App\Models\Accounts\Transfer');
    }


    public function account() {
        return $this->belongsTo('App\Models\Accounts\Account');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $currency
     * @return \Illuminate\Database\Eloquent\Builder mixed
     */
    public function scopeOfCurrency($query, $currency)
    {
        return $query->whereHas('account', function ($q) use ($currency) {
            $q->whereHas('currency', function ($q) use ($currency) {
                $q->where('code', $currency);
            });
        });
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder mixed
     */
    public function scopeSpent($query)
    {
        return $query->where('transactions.amount', '<', 0);
    }
}
