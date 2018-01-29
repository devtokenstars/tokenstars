<?php

namespace App\Models\Accounts;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string wallet
 * @property integer id
 */
class Account extends Model
{
    const OPEN = 'open';
    const CLOSED = 'closed';

    const VERB_STATUS = [
        self::OPEN => 'Open',
        self::CLOSED => 'Closed',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'credit_limit',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item() {
        return $this->belongsTo(Item::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accountType() {
        return $this->belongsTo('App\Models\Accounts\AccountType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency() {
        return $this->belongsTo('App\Models\Accounts\Currency');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sourceTransfers() {
        return $this->hasMany('App\Models\Accounts\Transfer', 'source_id')->whereNull('reverse_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function destinationTransfers() {
        return $this->hasMany('App\Models\Accounts\Transfer', 'destination_id')->whereNull('reverse_id');
    }

    public function transactions() {
        return $this->hasMany('App\Models\Accounts\Transaction')->whereHas('transfer', function ($q) {
            $q->whereNull('reverse_id');
        });
    }

    public function getActualBalanceAttribute()
    {
        return $this->transactions()->sum('amount');
    }

    /**
     * @return bool
     */
    public function isOpen() {
        return $this->status === self::OPEN;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function canBeAuthorisedBy(User $user=null) {
        if ($user === null) {
            return true;
        }
        return !$this->user || $user->id === $this->user->id || $this->credit_limit === null;
    }

    /**
     * @param double $amount Sum to debit.
     * @return bool
     */
    public function isDebitPermitted($amount) {
        if ($this->credit_limit === null) {
            return true;
        }
        $available = bcadd($this->actual_balance, $this->credit_limit, 20);
        return bccomp($available, $amount, 20) >= 0;
    }

    public function scopeOfAccountType(Builder $query, $name) {
        return $query->whereHas('accountType', function ($q) use ($name) {
            $q->where('name', $name);
        });
    }

    /**
     * Минимально возможный шаг для слайдера, при этом чтобы можно было выбрать
     * хотя бы ,например, 5-ую часть десятичной дроби
     * @return float|int
     */
    public function getStep() {
        $step = 1;
        $minimal = 0.001;
        $decimal = $this->balance - floor($this->balance);
        if ($decimal > $minimal) {
            $step = 1/pow(10, -1 * floor(log10($decimal) - 1));
        }
        return $step;
    }

    public function totalPaid() {
        return -1 * $this->transactions()->where('amount', '<', 0)->sum('amount');
    }

    public function totalReceived() {
        return $this->transactions()->where('amount', '>', 0)->sum('amount');
    }
}
