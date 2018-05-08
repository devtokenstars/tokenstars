<?php

namespace App\Services;

use App\Models\Bet\BetBonus;
use App\Models\Bet\ConfigureQuestion;
use App\Models\Quiz\QuizQuestion;
use App\Models\TelegramUser;
use App\Jobs\ProcessQuizTimeout;
use App\Telegram\Commands\Bet\RegisterCommand;
use Carbon\Carbon;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Objects\Update;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class TelegramService {

    const BUTTONS = [
        [
            [
                'text' => "\xF0\x9F\x92\xBC Profile",
                'callback_data' => 'profile'
            ],
            [
                'text' => "\xF0\x9F\x93\x8B Rules",
                'callback_data' => 'rules'
            ],
        ],
        [
            [
                'text' => "\xf0\x9f\xa4\x9d Referral Program",
                'callback_data' => 'referral_program'
            ],
            [
                'text' => "\xf0\x9f\x93\x9d Register",
                'callback_data' => 'register'
            ]
        ],
        [
            [
                'text' => "Active predictions",
                'callback_data' => 'active_predictions'
            ],
            [
                'text' => "Buy Tokens",
                'callback_data' => 'buy_tokens'
            ]
        ]
    ];

    const CONFIGURE_COMMAND = 'configure';

    public function getMenu() {
        return ['keyboard' => self::BUTTONS, 'resize_keyboard' => true];
    }

    public function getCommandFromUpdate(Update $update) {
        $message = $update->getMessage();
        foreach(self::BUTTONS as $row) {
            foreach($row as $button) {
                if ($button['text'] == $message->text) {
                    foreach(Telegram::getCommands() as $command) {
                        if ($command->getName() == $button['callback_data']) {
                            return $command;
                        }
                    }
                    return null;
                }
            }
        }
        return null;
    }

    public function getQuizQuestionResponse(TelegramUser $telegramUser)
    {
        $question = QuizQuestion::whereNotIn(
            'id',
            $telegramUser->quiz_questions()
            ->whereNotNull('answered_at')
            ->get()
            ->pluck('pivot.quiz_question_id')
        )->orderBy('position')->first();
        if (!is_null($question)) {
            $buttons = [];
            $row_size = 2;
            $rows = [];
            foreach ($question->quiz_answers as $index => $answer) {
                $buttons[] = [
                    'text' => $answer->content,
                    'callback_data' => 'QuizAnswer ' . $answer->id
                ];
                if (
                    (($index + 1) % $row_size == 0) ||
                    ($index == count($question->quiz_answers) - 1)
                ) {
                    $rows[] = $buttons;
                    $buttons = [];
                }
            }
            if (! $telegramUser->quiz_questions()
                ->where('quiz_question_id', $question->id)
                ->exists())
            {
                $telegramUser->quiz_questions()->attach($question);
            }
            ProcessQuizTimeout::dispatch($telegramUser, $question)
                ->onQueue('quiz')
                ->delay(Carbon::now()->addSeconds(60));
            $questions_count = $question->quiz->quiz_questions()->count();
            return [
                'chat_id' => $telegramUser->telegram_id,
                'text' => "Question {$question->position} " . ($question->position == $questions_count ? "(the last one). " : "of {$questions_count}. ") . $question->content,
                'reply_markup' => json_encode(['inline_keyboard' => $rows])
            ];
        }
        return [];
    }

    public function processNextQuizQuestion(TelegramUser $telegramUser, $text, $callbackQueryId = null)
    {
        if ($callbackQueryId) {
            try {
                Telegram::answerCallbackQuery([
                    'callback_query_id' => $callbackQueryId,
                ]);
            } catch (TelegramSDKException $e) {
                Log::info("Failed to answer callback query  to telegram user {$telegramUser->id}");
            }
        }
        if (
            QuizQuestion::whereNotIn(
                'id',
                $telegramUser->quiz_questions()
                ->whereNotNull('answered_at')
                ->get()
                ->pluck('pivot.quiz_question_id')
            )->exists()
        ) {
            $rows = [
                [
                    [
                        'text' => 'Next question',
                        'callback_data' => 'QuizQuestion 1'
                    ],
                    [
                        'text' => 'Skip the Quiz',
                        'callback_data' => 'QuizQuestion 0'
                    ],
                ]
            ];
            try {
                Telegram::sendMessage([
                    'chat_id' => $telegramUser->telegram_id,
                    'text' => $text,
                    'parse_mode' => 'HTML',
                    'reply_markup' => json_encode(['inline_keyboard' => $rows])
                ]);
            } catch (TelegramSDKException $e) {
                Log::info("Failed to send message to telegram user {$telegramUser->id}");
            }
        } else {
            if ($text) {
                try {
                    Telegram::sendMessage([
                        'chat_id' => $telegramUser->telegram_id,
                        'parse_mode' => 'HTML',
                        'text' => $text,
                    ]);
                } catch (TelegramSDKException $e) {
                    Log::info("Failed to send message to telegram user {$telegramUser->id}");
                }
            }
            $this->sendQuizFinalResponse($telegramUser);
        }
    }

    public function sendQuizFinalResponse(TelegramUser $telegramUser)
    {
        $quiz = $telegramUser->quizzes()->where('name', 'Start quiz')->first();
        if (is_null($quiz)) {
            Log::info("quiz is null for user {$telegramUser->id}");
            return;
        } else if ($quiz->pivot->finished_at) {
            return;
        } else {
            $telegramUser->quizzes()->updateExistingPivot(
                $quiz->id,
                ['finished_at' => Carbon::now()]
            );
        }
        if ($tokens_amount = $telegramUser->getTokensAmount(BetBonus::TYPE_QUIZ)) {
            $text = "Congratulations 🎉, you have earned <b>"
                  .$this->format_number($tokens_amount)
                  ."</b> TEAM tokens, ✨ your total balance <b>"
                  .$this->format_number($telegramUser->balance)."</b> TEAM tokens. 🎆";
            try {
                Telegram::sendMessage([
                    'chat_id' => $telegramUser->telegram_id,
                    'parse_mode' => 'HTML',
                    'text' => $text,
                ]);
            } catch (TelegramSDKException $e) {
                Log::info("Failed to send message to telegram user {$telegramUser->id}");
            }
        }
        $this->initWallet($telegramUser);
    }

    public function sendQuizQuestionResponse(TelegramUser $telegramUser)
    {
        $response = $this->getQuizQuestionResponse($telegramUser);
        if (!empty($response)) {
            try {
                Telegram::sendMessage($response);
            } catch (TelegramSDKException $e) {
                Log::info("Failed to send message to telegram user {$telegramUser->id}");
            }
        } else {
            $this->sendQuizFinalResponse($telegramUser);
        }
    }

    public function sendConfigureResponse(TelegramUser $telegramUser)
    {
        $question = $telegramUser->configure_questions()
                  ->whereNull('configure_answer_id')
                  ->WhereNull('comment')
                  ->orderBy('position')
                  ->first();
        if (is_null($question)) {
            $question = ConfigureQuestion::whereNotIn(
                'id',
                $telegramUser->configure_questions
                ->pluck('pivot.configure_question_id')
            )->orderBy('position')->first();
        }
        if (!is_null($question)) {
            $telegramUser->current_bot_command = self::CONFIGURE_COMMAND;
            $telegramUser->save();
            $buttons = [];
            $row_size = 2;
            $rows = [];
            foreach ($question->configure_answers as $index => $answer) {
                $buttons[] = [
                    'text' => $answer->type == $answer::TYPE_USER_INPUT
                    ? "Skip"
                    : $answer->content,
                    'callback_data' => 'ConfigureAnswer ' . $answer->id
                ];
                if (
                    (($index + 1) % $row_size == 0) ||
                    ($index == count($question->configure_answers) - 1)
                ) {
                    $rows[] = $buttons;
                    $buttons = [];
                }
            }
            if (! $telegramUser->configure_questions()->where('configure_question_id', $question->id)->exists()) {
                $telegramUser->configure_questions()->attach($question);
            }
            $questions_count = ConfigureQuestion::count();
            try {
                Telegram::sendMessage([
                    'chat_id' => $telegramUser->telegram_id,
                    'text' => "Question {$question->position} " . ($question->position == $questions_count ? "(the last one). " : "of {$questions_count}. ") . $question->content,
                    'reply_markup' => json_encode(['inline_keyboard' => $rows])
                ]);
            } catch (TelegramSDKException $e) {
                Log::info("Failed to send message to telegram user {$telegramUser->id}");
            }
        } else {
            $telegramUser->current_bot_command = null;
            $telegramUser->save();
        }
    }

    public function initWallet(TelegramUser $telegramUser)
    {
        if (is_null($telegramUser->profile_configured_at)) {
            $telegramUser->profile_configured_at = Carbon::now();
            $telegramUser->save();
            try {
                Telegram::sendMessage([
                    'chat_id' => $telegramUser->telegram_id,
                    'text' => 'You are all set. Wait for new prediction events, they might come several times per day.',
                ]);
            } catch (TelegramSDKException $e) {
                Log::info($e);
            }
        }

        $command = app()->make(RegisterCommand::class);

        $response = $command->prepareResponseForUser($telegramUser);
        if (! empty($response)) {
            try {
                Telegram::sendMessage(array_merge($response, ['chat_id' => $telegramUser->telegram_id]));
            } catch (TelegramSDKException $e) {
                Log::info($e);
            }
        }
    }

    public function format_number($number, $digits = 4) {
        $number = (string) $number;
        $before = str_before($number, '.');
        $after = substr(str_after($number, '.'), 0, $digits);
        $after = (float) ("1." . $after);
        $after = (string) $after;
        $dummy = '';
        if (str_contains($after, '.')) {
            $dummy = '.' . str_after($after, '.');
        }
        return $before . $dummy;
    }

}
