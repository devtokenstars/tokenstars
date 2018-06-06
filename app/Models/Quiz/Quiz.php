<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quiz_questions()
    {
        return $this->hasMany('App\Models\Quiz\QuizQuestion');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function telegram_users()
    {
        return $this->belongsToMany('App\Models\TelegramUser')
            ->withTimeStamps()
            ->withPivot(['started_at', 'finished_at']);
    }
}
