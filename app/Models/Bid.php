<?php

namespace App\Models;

use App\Models\Accounts\Account;
use App\Models\Accounts\Transfer;
use App\Repositories\PriceRepository;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property float eth_amount
 * @property User user
 * @property Transfer[] transfers
 */
class Bid extends Model implements Transformable
{
    use TransformableTrait;

    //protected $fillable = [];
    protected $guarded = ['id','created_at','updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function getReceivedAmountAttribute()
    {
        return $this->transfers()->has('transactions')->sum('amount');
    }

    public function getFullAmountAttribute()
    {
        return $this->received_amount;
    }

    public function getEthAmountAttribute()
    {
        return $this->amount;
    }

    public function getFromAddressAttribute()
    {
        if ($this->user && $this->user->wallet) {
            return $this->user->wallet;
        }

        if ($this->account) {
            return $this->account->wallet;
        }
        $account = Account::where('user_id', $this->user_id)->first();
        if ($account->wallet) {
            return $account->wallet;
        }
//        $transfer = false;
//        if ($this->transfers()->exists()) {
//            $transfer = $this->transfers()->orderBy('created_at', 'desc')->first();
//
//            if ($transfer->parent_id && $transfer->parent()->first()->source->wallet) {
//                return $transfer->parent()->first()->source->wallet;
//            }
//            if ($transfer->source->wallet) {
//                return $transfer->source->wallet;
//            }
//        }
//        if ($this->user_id) {
//            return $this->user->wallet;
//        }
//
//        if ($transfer && $transfer->destination->wallet) {
//            return $transfer->destination->wallet;
//        }
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }
}
