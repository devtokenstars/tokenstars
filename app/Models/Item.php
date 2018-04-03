<?php

namespace App\Models;

use App\Models\Accounts\Transfer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property integer id
 * @property Bid winner
 * @property string auction_address
 * @property float min_bid_amount
 * @property Bid[] bids
 * @property User user
 */
class Item extends Model implements Transformable
{
    use TransformableTrait;

    #protected $fillable = [];
    protected $guarded = ['id','created_at','updated_at'];

    protected $appends = ['bid_count'];

    protected $dates = [
        'created_at',
        'updated_at',
        'date_end',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return integer
     */
    public function getBidCountAttribute()
    {
        return Transfer::where('item_id', $this->id)->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bids()
    {
        return $this->hasMany(Bid::class)
            ->where('state', 'completed')
            ->orderBy('amount', 'desc')
            ->orderBy('updated_at', 'asc');
    }

    public function getLastNBids($limit = 5)
    {
        return Bid::where('item_id', $this->id)->where('state', 'completed')->limit($limit)->get();
    }

    public function getWinnerAttribute()
    {
        return Bid::find($this->winner_bid_id);
    }

    /**
     * Обновляет текущего победителя
     */
    public function updateWinner()
    {
        if ($this->bids()->exists()) {

            $this->winner_bid_id = $this->bids()->firstOrFail()->id;
            $this->save();
        }
    }

    public function getIsActiveAttribute()
    {
        return $this->state == 'new' or in_array($this->id, explode(',', Cookie::get('show_items')));
    }
}
