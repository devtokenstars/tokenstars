<?php

namespace App\Jobs;

use App\Models\Quiz\QuizQuestion;
use App\Models\TelegramUser;
use App\Services\TelegramService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Exceptions\TelegramOtherException;
use Telegram\Bot\Laravel\Facades\Telegram;

class ProcessQuizTimeout implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $question;
    protected $telegramUser;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TelegramUser $telegramUser,
                                QuizQuestion $question
    )
    {
        $this->telegramUser = $telegramUser;
        $this->question = $question;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(TelegramService $telegramService)
    {
        $telegramUser = $this->telegramUser;
        $question = $this->question;
        $has_answered = $telegramUser->quiz_questions()
                      ->where('quiz_question_id', $question->id)
                      ->whereNotNull('answered_at')
                      ->exists();
        if (!$has_answered) {
            $correct_answer = $question->quiz_answers()->where('winner', 1)->first();
            if (is_null($correct_answer)) {
                Log::warning("correct answer is null for question {$question->id}");
                return;
            }
            $telegramUser->quiz_questions()
                ->updateExistingPivot(
                    $question->id,
                    ['answered_at' => Carbon::now()]
                );
            $text = <<<EOT
Sorry, your time is up. \xf0\x9f\xa4\xb7\xe2\x80\x8d\xe2\x99\x80\xef\xb8\x8f
Correct answer is: {ANSWER}
EOT;
            $text = str_replace('{ANSWER}', $correct_answer->content, $text);
            $telegramService->processNextQuizQuestion($telegramUser, $text);
        }
    }
}
