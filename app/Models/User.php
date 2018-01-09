<?php

namespace App\Models;

use App\Events\UserCreated;
use App\Models\Accounts\AccountType;
use App\Models\Accounts\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property Transaction[] transactions
 * @property integer id
 */
class User extends Authenticatable
{
    use Notifiable;

    const ROLE_USER = 'user';
    const ROLE_SELLER = 'seller';
    const ROLE_ADMIN = 'admin';
    const ROLE_EDITOR = 'editor';
    const ROLES = [
        self::ROLE_USER,
        self::ROLE_SELLER,
        self::ROLE_ADMIN,
        self::ROLE_EDITOR,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'wallet', '', 'register_token',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => UserCreated::class,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'register_token',
    ];

    /**
     * @return Builder
     */
    public function accounts()
    {
        return $this->hasMany('App\Models\Accounts\Account')->whereHas('currency', function ($q) {
            $q->where('is_active', true);
        });
    }

    public function accountOfType($name)
    {
        return $this->accountOfTypeAndCurrency($name, config('app.name').'.TKN');
    }

    public function accountById($id)
    {
        return $this->accounts()->where('id', $id);
    }

    public function accountOfTypeAndCurrency($name, $currencyCode = '')
    {
        if (!$currencyCode) {
            $currencyCode = config('app.name').'.TKN';
        }

        return $this->accounts()->whereHas('accountType', function ($q) use ($name) {
            $q->where('name', $name);
        })->whereHas('currency', function ($q) use ($currencyCode) {
            $q->where('code', $currencyCode);
        });
    }

    public function accountOfCurrency($currencyCode = '')
    {
        if (!$currencyCode) {
            $currencyCode = config('app.name').'.TKN';
        }

        return $this->accounts()->whereHas('accountType', function ($q) {
            $q->where('name', AccountType::BANK_ACCOUNT_NAME);
        })->whereHas('currency', function ($q) use ($currencyCode) {
            $q->where('code', $currencyCode);
        });
    }

    public function transactions()
    {
        return $this->hasManyThrough('App\Models\Accounts\Transaction', 'App\Models\Accounts\Account')
            ->whereHas('account', function ($q) {
                $q->whereHas('currency', function ($q1) {
                    $q1->where('is_active', true);
                });
            })->whereHas('transfer', function ($q) {
                $q->whereNotNull('item_id')->whereNull('reverse_id');
            })->join('transfers', 'transfers.id', '=', 'transactions.transfer_id');
    }

    public function realTransactions()
    {
        return $this->transactions()->whereHas('transfer', function ($q) {
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function getConfirmUrlAttribute()
    {
        return route('auth.confirm').'?token='.$this->register_token;
    }

    /**
     * @param Item $item
     * @return Bid|null
     */
    public function getLastBid(Item $item)
    {
        return $this->bids()
            ->where('item_id', $item->id)
            ->where('state', 'completed')
            ->orderBy('amount', 'desc')
            ->orderBy('updated_at', 'asc')
            ->first();
    }

    public function utms() {
        return $this->hasMany('App\Models\Utm');
    }

    public function getLastUtmAttribute()
    {
        return $this->utms()->latest('id')->first();
    }

    public function getNameOrEmailAttribute()
    {
      return $this->name ? $this->name : $this->email;
    }
}
