<?php

namespace App\Models\Bet;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BetAnswer.
 *
 * @property string $name
 * @property float $coefficient
 * @property BetQuestion bet_question
 * @property bool winner
 */

class BetAnswer extends Model
{
    protected $fillable = [
        'name',
        'coefficient',
        'bet_question_id',
        'winner',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bet_question()
    {
        return $this->belongsTo('App\Models\Bet\BetQuestion');
    }

}
