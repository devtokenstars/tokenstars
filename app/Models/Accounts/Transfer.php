<?php

namespace App\Models\Accounts;

use App\Models\Bid;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property Account source
 * @property Account destination
 */
class Transfer extends Model implements Transformable
{
    use TransformableTrait;

    const EVENT_BID = 1; // Прямая ставка
    const EVENT_MANAGED_BID = 2; // Ставка через coinpayments

    protected $fillable = [
        'amount',
        'reference',
        'description',
        'bonus',
        'promo_id',
        'price',
        'parent_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source() {
        return $this->belongsTo('App\Models\Accounts\Account', 'source_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destination() {
        return $this->belongsTo('App\Models\Accounts\Account', 'destination_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions() {
        return $this->hasMany('App\Models\Accounts\Transaction');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent() {
        return $this->belongsTo('App\Models\Accounts\Transfer');
    }

    public function children()
    {
        return $this->hasMany(Transfer::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reverse() {
        return $this->belongsTo('App\Models\Accounts\Transfer');
    }

    public function getTokens() {
        return $this->transactions()->whereHas('account', function ($q) {
            return $q->where('currency_id', $this->promo->currency_id);
        })->where('amount', '>', 0)->value('amount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promo() {
        return $this->belongsTo('App\Models\Accounts\Promo', 'promo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }

    public function getRealPrice() {
        if ($this->getTokens()) {
            return bcdiv($this->amount, bcdiv($this->getTokens(), ($this->bonus / 100 + 1), 20), 20);
        }
    }

    public function getFromAddressAttribute()
    {
        $sourceWallet = $this->source->wallet;
        return $sourceWallet ? $sourceWallet : $this->destination->wallet;
    }

    public function getAddressAttribute()
    {
        $user = $this->user()->first();
        if ($user && $user->wallet) {
            return $user->wallet;
        }

        $source = $this->source()->first();
        $address = $source->wallet;
        if ($source->user()->exists() && $source->user()->first()->wallet) {
            $address = $source->user()->first()->wallet;
        }
        return $address;
    }
}
