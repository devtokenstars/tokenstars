<?php

namespace App\Models\Bet;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BetSport.
 *
 * @property string $name
 */

class BetSport extends Model
{

    protected $fillable = [
        'name',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bet_questions()
    {
        return $this->hasMany('App\Models\Bet\BetQuestion');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function telegram_users()
    {
        return $this->belongsToMany('App\Models\TelegramUser')->withTimeStamps();
    }

}
