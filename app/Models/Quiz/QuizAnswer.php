<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    protected $fillable = [
        'quiz_question_id',
        'winner',
        'content',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quiz_question()
    {
        return $this->belongsTo('App\Models\Quiz\QuizQuestion');
    }
}
