<?php

namespace App\Models\Bet;

use Illuminate\Database\Eloquent\Model;

class ConfigureAnswer extends Model
{
    const TYPE_PREDEFINED = 'predefined';
    const TYPE_USER_INPUT = 'user_input';

    const TYPES = [
        self::TYPE_PREDEFINED,
        self::TYPE_USER_INPUT
    ];


    protected $fillable = [
        'content',
        'configure_question_id',
        'type'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function configure_question()
    {
        return $this->belongsTo('App\Models\Bet\ConfigureQuestion');
    }
}
