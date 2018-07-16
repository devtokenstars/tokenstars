<?php

namespace App\Models\Bet;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class BetQuestion.
 *
 * @property string $name
 * @property dateTime $started_at
 * @property dateTime $starts_at
 * @property dateTime $closes_at
 * @property text $description
 * @property BetAnswer[] bet_answers
 */


class BetQuestion extends Model
{

    const STATUS_DRAFT = 'draft';
    const STATUS_ACTIVE = 'active';
    const STATUS_CLOSED = 'closed';

    const DISK = 'bet';
    const TIME_FORMAT = 'd.m.Y G:i';

    const STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_ACTIVE,
        self::STATUS_CLOSED
    ];

    protected $fillable = [
        'name',
        'description',
        'started_at',
        'bet_sport_id',
        'status',
        'image',
        'telegram_file_id',
        'starts_at',
        'closes_at',
        'bonus_amount',
        'reply_columns',
    ];

    protected $dates = [
        'started_at',
        'starts_at',
        'closes_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bet_sport()
    {
        return $this->belongsTo('App\Models\Bet\BetSport');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bet_answers()
    {
        return $this->hasMany('App\Models\Bet\BetAnswer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function telegram_users()
    {
        return $this->belongsToMany('App\Models\TelegramUser')
            ->withTimeStamps()
            ->withPivot([
                'bet_answer_id',
                'telegram_message_id',
                'ace_tokens',
                'team_tokens',
                'bet_bonuses',
                'rating',
            ]);
    }

    public function getImageUrlAttribute()
    {
        return route('admin:bet-question:image', ['question' => $this->id]);
    }
}
