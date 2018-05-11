<?php

namespace App\Models\Bet;

use Illuminate\Database\Eloquent\Model;

class ConfigureQuestion extends Model
{
    protected $fillable = [
        'content',
        'position',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function configure_answers()
    {
        return $this->hasMany('App\Models\Bet\ConfigureAnswer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function telegram_users()
    {
        return $this->belongsToMany('App\Models\TelegramUser')
            ->withTimeStamps()
            ->withPivot(['configure_answer_id', 'comment']);
    }
}
