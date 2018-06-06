<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = [
        'name',
        'quiz_id',
        'position',
        'content',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz\Quiz');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quiz_answers()
    {
        return $this->hasMany('App\Models\Quiz\QuizAnswer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function telegram_users()
    {
        return $this->belongsToMany('App\Models\TelegramUser')
            ->withTimeStamps()
            ->withPivot(['quiz_answer_id', 'answered_at']);
    }
}
