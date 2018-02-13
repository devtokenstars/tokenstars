<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Promo extends Model implements Transformable
{
    use TransformableTrait;

    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_ACTIVE = 'active';
    const STATUS_CLOSED = 'closed';

    const STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_PUBLISHED,
        self::STATUS_ACTIVE,
        self::STATUS_CLOSED,
    ];

    protected $dates = [
        'start',
        'end',
        'created_at',
        'updated_at',
        'delivery_date',
    ];

    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo('App\Models\Accounts\Currency', 'currency_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mainCurrency()
    {
        return $this->belongsTo('App\Models\Accounts\Currency', 'main_currency_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function getTokensIds()
    {
        return self::select('currency_id')->distinct()->pluck('currency_id');
    }

    public static function getUsersIds()
    {
        return self::select('user_id')->distinct()->pluck('user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transfers()
    {
        return $this->hasMany('App\Models\Accounts\Transfer')->whereNull('reverse_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class,Transfer::class)
            ->whereNull('transfers.reverse_id')
            ->whereHas('transfer', function ($q) {
                $q->whereHas('source', function ($q) {
                    $q->whereHas('currency', function ($q) {
                        $q->where('code', '!=', 'LTCT');
                    });
                })->where(function($q) {
                    $q->whereNull('parent_id')->orWhereHas('parent', function ($q) {
                        $q->whereHas('source', function ($q) {
                            $q->whereHas('currency', function ($q) {
                                $q->where('code', '!=', 'LTCT');
                            });
                        });
                    });
                });
            });
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function users()
    {
        return $this->hasManyThrough('App\Models\User', 'App\Models\Accounts\Account',
            'currency_id', // account.currency_id
            'id', // user.id
            'currency_id', // promo.currency_id
            'user_id' // account.user_id
        )->whereHas('realTransactions', function ($q) {
            $q->whereHas('account', function ($q) {
                $q->where('currency_id', $this->currency_id);
            });
        });
    }

    /**
     * Флаг, нужно или нет округлять результат
     *
     * @return bool
     */
    public function getFractionalAttribute()
    {
        if ('goldmint' === $this->slug) {
            return true;
        }
        if ('wax' === $this->slug) {
            return true;
        }
        if ('pundix' === $this->slug) {
            return true;
        }
        if ('gladius' === $this->slug) {
            return true;
        }
        if ('bitclave' === $this->slug) {
            return true;
        }

        return true;
    }

    public function getProgressPercent($collected)
    {
        $basePercent = 20;
        if ($collected < $this->min_amount) {
            return round($basePercent * $collected/$this->min_amount, 2);
        }
        return ($basePercent + round((100 - $basePercent) * ($collected-$this->min_amount)/($this->target_amount-$this->min_amount), 2));
    }
}
