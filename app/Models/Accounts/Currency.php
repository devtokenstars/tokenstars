<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Currency extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'code',
        'is_fiat',
    ];

}
