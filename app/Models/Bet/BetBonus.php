<?php

namespace App\Models\Bet;

use Illuminate\Database\Eloquent\Model;

class BetBonus extends Model
{
    const TYPE_BET = 'bet';
    const TYPE_CONFIGURE = 'configure';
    const TYPE_QUIZ = 'quiz';
    const TYPE_REFERRAL = 'referral';
    const TYPE_WITHDRAW = 'withdraw';

    const TYPES = [
        self::TYPE_BET,
        self::TYPE_CONFIGURE,
        self::TYPE_QUIZ,
        self::TYPE_REFERRAL,
        self::TYPE_WITHDRAW,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function telegram_user()
    {
        return $this->belongsTo('App\Models\TelegramUser');
    }
}
