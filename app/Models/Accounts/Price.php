<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Price extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'currency_id', 'commodity_id', 'date', 'value'
    ];

    public function commodity() {
        return $this->belongsTo('App\Models\Accounts\Currency', 'commodity_id');
    }

    public function currency() {
        return $this->belongsTo('App\Models\Accounts\Currency', 'currency_id');
    }
}
