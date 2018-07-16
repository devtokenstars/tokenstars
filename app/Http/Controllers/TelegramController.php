<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use App\Models\Bet\BetAnswer;
use App\Models\Bet\BetBonus;
use App\Models\Bet\BetQuestion;
use App\Models\Bet\ConfigureAnswer;
use App\Models\Bet\ConfigureQuestion;
use App\Models\Quiz\Quiz;
use App\Models\Quiz\QuizQuestion;
use App\Models\Quiz\QuizAnswer;
use App\Telegram\Commands\Bet\RegisterCommand;
use App\Services\TelegramService;
use App\Telegram\Commands\Bet\WalletCommand;
use App\Telegram\Commands\Bet\WithdrawCommand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Objects\Update;

class TelegramController extends Controller
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    public function telegramMessage(Request $request)
    {
        if ($request->isMethod('post')) {
            $errors = 0;
            $success = 0;
            foreach (TelegramUser::whereNotNull('started_bot')->get() as $tmuser) {
                try {
                    Telegram::sendMessage([
                        'chat_id' => $tmuser->telegram_id,
                        'text' => Input::get('message'),
                    ]);
                    $success += 1;
                } catch (TelegramSDKException $e) {
                    $errors += 1;
                }
            }
            return back()->with(['errors' => $errors, 'success' => $success]);
        }
        return view('admin.telegram.message', []);
    }

    protected function addBonusToUser(TelegramUser $telegramUser, $bonusType, $amount)
    {
        $bonus = new BetBonus();
        $bonus->type = $bonusType;
        $bonus->amount = $amount;
        $telegramUser->addBonus($bonus);
    }

    protected function finishConfiguration(TelegramUser $telegramUser)
    {
        $telegramUser->current_bot_command = null;
        $telegramUser->save();
        $this->addBonusToUser($telegramUser, BetBonus::TYPE_CONFIGURE, 10);
        $text = <<<EOT
Great! You already got your first <b>10 TEAM</b> tokens. 🏁 Check your token balance in your /profile.
EOT;

        try {
            Telegram::sendMessage([
                'chat_id' => $telegramUser->telegram_id,
                'parse_mode' => 'HTML',
                'text' => $text,
            ]);
        } catch (TelegramSDKException $e) {
            Log::info("Failed to send message to telegram user {$telegramUser->id}");
        }

        $this->initQuiz($telegramUser);
    }

    public function initQuiz(TelegramUser $telegramUser)
    {
        if ($telegramUser->quizzes()->count()) {
            return;
        }

        $text = <<<EOT
We also have a sports quiz to get you started.
Earn <b>3 tokens</b> for each correct answer, only <b>60 seconds</b> to pick the right one.
Try yourself! 💪
EOT;
        $rows = [
            [
                [
                    'text' => 'Start',
                    'callback_data' => 'Quiz 1'
                ],
                [
                    'text' => 'Skip the Quiz',
                    'callback_data' => 'Quiz 0'
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
    }

    public function webhook()
    {
        // Log::info(Input::all());
        // return response('ok');
        /** @var Update $update */
        $update = Telegram::commandsHandler(true);
        // return response('ok');
        // $update = Telegram::getWebhookUpdates();
        $message = $update->getMessage();
        $user = null;
        if ($update->isType('callback_query')) {
            $user = $message->chat;
            $callback_data = $update->callbackQuery->data;
        } else {
            $user = $message->from;
        }
        $telegramUser = $telegramUser = TelegramUser::where(
            ['telegram_id' => $user->id]
        )->first();
        if (is_null($telegramUser)) {
            Log::warning("TelegramUser is null for user {$user->id}");
            return response('ok');
        }
        if (!is_null($telegramUser->deleted_bot)) {
            $telegramUser->deleted_bot = null;
            $telegramUser->save();
        }
        if ($update->isType('callback_query')) {
            try {
                Telegram::editMessageReplyMarkup([
                    'chat_id' => $telegramUser->telegram_id,
                    'message_id' => $message->message_id,
                    'reply_markup' => ''
                ]);
            } catch (TelegramSDKException $e) {
                Log::info("Failed to edit message to telegram user {$telegramUser->id}");
            }
            $classes = [
                'BetAnswer',
                'ConfigureAnswer',
                'Quiz',
                'QuizAnswer',
                'QuizQuestion',
                'BetQuestion',
            ];
            $matches = [];
            if ($telegramUser->current_bot_command
                && preg_match('/(' . $telegramUser->current_bot_command . ')\s(\d+)/'
                              , $callback_data, $matches)
                && $matches[2])
            {
                if ($telegramUser->current_bot_command == "register") {
                    switch($matches[2]) {
                    case '1':
                        $exitCode = Artisan::call('tmbot:send:question', ['user_id' => $telegramUser->id]);
                        $telegramUser->current_bot_command = null;
                        $telegramUser->save();
                        break;
                    case '2':
                        if ($telegramUser->wallet_confirmation_code) {
                            $telegramUser->wallet_confirmation_code = null;
                        } else if ($telegramUser->confirmation_code) {
                            $telegramUser->confirmation_code = null;
                        }
                        $telegramUser->save();
                        $command = Telegram::getCommands()[$telegramUser->current_bot_command];
                        if ($command) {
                            $response = $command->prepareResponseForUser($telegramUser);
                            if (! empty($response)) {
                                try {
                                    Telegram::sendMessage(array_merge($response, ['chat_id' => $telegramUser->telegram_id]));
                                } catch (TelegramSDKException $e) {
                                    Log::info($e);
                                }
                            }
                        }
                    }
                } else { // for other commands process as press on 'Skip' button i.e. cancel command
                    $telegramUser->current_bot_command = null;
                    $telegramUser->save();
                }
                return response('ok');
            }
            $pattern = '/(' . implode('|', $classes) . ')\s(\d+)/';
            if (!preg_match($pattern, $callback_data, $matches)) {
                return response('ok');
            }
            switch($matches[1]) {
            case 'BetAnswer':
                $answer = BetAnswer::find($matches[2]);
                if (is_null($answer)) {
                    return response('ok');
                }
                $question = $answer->bet_question;
                if ($question->status != BetQuestion::STATUS_ACTIVE
                    || ($question->closes_at && $question->closes_at < Carbon::now())
                )
                {
                    try {
                        Telegram::sendMessage([
                            'chat_id' => $telegramUser->telegram_id,
                            'text' => 'Sorry the bet is closed',
                        ]);
                    } catch (TelegramSDKException $e) {
                        Log::info("Failed to send message to telegram user {$telegramUser->id}");
                    }
                    return response('ok');
                }
                if (
                    !$telegramUser->bet_questions()
                    ->where('bet_question_id', $question->id)
                    ->exists()
                )
                {
                    return response('ok');
                }
                if (
                    $telegramUser->bet_questions()
                    ->where('bet_question_id', $question->id)
                    ->whereNotNull('bet_answer_id')
                    ->exists()
                )
                {
                    return response('ok');
                }
                $telegramUser->bet_questions()
                    ->updateExistingPivot(
                        $question->id,
                        ['bet_answer_id' => $answer->id]
                    );
                if ($telegramUser->referrer
                    && $telegramUser->bet_questions()->whereNotNull('bet_answer_id')->count() == 5)
                {
                    $bonus = new BetBonus();
                    $bonus->amount = 4.036;
                    $bonus->type = BetBonus::TYPE_REFERRAL;
                    $bonus->referral_id = $telegramUser->id;
                    $telegramUser->referrer->bet_bonuses()->save($bonus);

                    $bonus = new BetBonus();
                    $bonus->amount = 4.036;
                    $bonus->type = BetBonus::TYPE_REFERRAL;
                    $telegramUser->bet_bonuses()->save($bonus);
                    try {
                        Telegram::sendMessage([
                            'chat_id' => $telegramUser->referrer->telegram_id,
                            'parse_mode' => 'HTML',
                            'text' => "Hi, one of the users you invited has just activated, so you get <b>{$bonus->amount}</b> tokens. Keep inviting and climbing up the leaderbord! 🙆",
                        ]);
                    } catch (TelegramSDKException $e) {
                        Log::info("Failed to send message to telegram user {$telegramUser->id}");
                    }
                }
                $question->save();
                try {
                    Telegram::answerCallbackQuery([
                        'callback_query_id' => $update->callbackQuery->id,
                    ]);
                } catch (TelegramSDKException $e) {
                    Log::info("Failed to answer callback query  to telegram user {$telegramUser->id}");
                }
                try {
                    Telegram::sendMessage([
                        'chat_id' => $telegramUser->telegram_id,
                        'text' => 'Your prediction "' . $answer->name . '" for the question "'.$question->name.'" is accepted.',
                    ]);
                } catch (TelegramSDKException $e) {
                    Log::info("Failed to answer callback query  to telegram user {$telegramUser->id}");
                }
                break;
            case 'ConfigureAnswer':
                $answer = ConfigureAnswer::find($matches[2]);
                if (is_null($answer)) {
                    return response('ok');
                }
                $question = $answer->configure_question;
                if (
                    !$telegramUser->configure_questions()
                    ->where('configure_question_id', $question->id)
                    ->exists()
                )
                {
                    return response('ok');
                }
                if (
                    $telegramUser->configure_questions()
                    ->where('configure_question_id', $question->id)
                    ->whereNotNull('configure_answer_id')
                    ->exists()
                )
                {
                    return response('ok');
                }
                $telegramUser->configure_questions()
                    ->updateExistingPivot(
                        $question->id,
                        ['configure_answer_id' => $answer->id]
                    );
                if ($answer->type != ConfigureAnswer::TYPE_USER_INPUT) {
                    try {
                        Telegram::answerCallbackQuery([
                            'callback_query_id' => $update->callbackQuery->id,
                            'text' => 'Your answer: ' . $answer->content,
                        ]);
                    } catch (TelegramSDKException $e) {
                        Log::info("Failed to answer callback query  to telegram user {$telegramUser->id}");
                    }
                }
                if ($telegramUser->configure_questions()
                    ->whereNull('configure_answer_id')
                    ->WhereNull('comment')->exists()
                    || ConfigureQuestion::whereNotIn(
                        'id',
                        $telegramUser->configure_questions
                        ->pluck('pivot.configure_question_id')
                    )->exists())
                {
                    $this->telegramService->sendConfigureResponse($telegramUser);
                } else {
                    $this->finishConfiguration($telegramUser);
                }
                break;
            case 'Quiz':
                $quiz = Quiz::where('name', 'Start quiz')->first();
                try {
                    Telegram::answerCallbackQuery([
                        'callback_query_id' => $update->callbackQuery->id,
                    ]);
                } catch (TelegramSDKException $e) {
                    Log::info("Failed to answer callback query  to telegram user {$telegramUser->id}");
                }
                if (is_null($quiz)) {
                    Log::warning("Quiz is null");
                    return response('ok');
                }
                if ($telegramUser->quizzes()->where('quiz_id', $quiz->id)->exists()) {
                    return response('ok');
                }
                $telegramUser->quizzes()->attach($quiz);
                if ((int)$matches[2]) {
                    $telegramUser->quizzes()->updateExistingPivot($quiz->id, ['started_at' => Carbon::now()]);
                    $this->telegramService->sendQuizQuestionResponse($telegramUser);
                } else {
                    $this->telegramService->initWallet($telegramUser);
                }
                break;
            case 'QuizAnswer':
                $answer = QuizAnswer::find($matches[2]);
                if (is_null($answer)) {
                    Log::warning("QuisAnswer ".$matches[2]." is null");
                    return response('ok');
                }
                $question = $answer->quiz_question;
                if (
                    !$telegramUser->quiz_questions()
                    ->where('quiz_question_id', $question->id)
                    ->exists()
                )
                {
                    return response('ok');
                }
                if (
                    $telegramUser->quiz_questions()
                    ->where('quiz_question_id', $question->id)
                    ->whereNotNull('answered_at')
                    ->exists()
                )
                {
                    return response('ok');
                }
                $telegramUser->quiz_questions()
                    ->updateExistingPivot(
                        $question->id,
                        [
                            'quiz_answer_id' => $answer->id,
                            'answered_at' => Carbon::now()
                        ]
                    );
                $correct_answer = $question->quiz_answers()->where('winner', 1)->first();
                if (is_null($correct_answer)) {
                    Log::warning("correct answer is null for question {$question->id}");
                    return response('ok');
                }
                $text = 'No, the correct answer is "'.$correct_answer->content.'"';
                if ($answer->winner) {
                    $tokens_amount = 3;
                    $this->addBonusToUser($telegramUser, BetBonus::TYPE_QUIZ, $tokens_amount);
                    $text = "Correct! 👍 You just won <b>{$tokens_amount}</b> TEAM tokens.";
                }
                $this->telegramService->processNextQuizQuestion($telegramUser, $text, $update->callbackQuery->id);
                break;
            case 'QuizQuestion':
                $quiz = Quiz::where('name', 'Start quiz')->first();
                if (is_null($quiz)) {
                    Log::warning("Quiz is null");
                    return response('ok');
                }
                if (! (int)$matches[2]) {
                    foreach ( $quiz->quiz_questions as $q )
                    {
                        if ($tq = $telegramUser->quiz_questions()
                            ->where('quiz_question_id', $q->id)
                            ->first())
                        {
                            $tq->pivot->answered_at = Carbon::now();
                            $tq->save();
                        } else {
                            $telegramUser->quiz_questions()->attach(
                                $q->id,
                                ['answered_at' => Carbon::now()]
                            );
                        }
                    }
                }
                $this->telegramService->sendQuizQuestionResponse($telegramUser);
                break;
            case 'BetQuestion':
                try {
                    Telegram::deleteMessage([
                        'chat_id' => $telegramUser->telegram_id,
                        'message_id' => $message->message_id,
                    ]);
                } catch (TelegramSDKException $e) {
                    Log::info("Failed to delete message to telegram user {$telegramUser->id}");
                }
                $question = BetQuestion::find($matches[2]);
                if (is_null($question)) {
                    return response('ok');
                }
                if ($question->status != BetQuestion::STATUS_ACTIVE
                    || ($question->closes_at && $question->closes_at < Carbon::now())
                )
                {
                    try {
                        Telegram::sendMessage([
                            'chat_id' => $telegramUser->telegram_id,
                            'text' => 'Sorry the bet is closed',
                        ]);
                    } catch (TelegramSDKException $e) {
                        Log::info("Failed to send message to telegram user {$telegramUser->id}");
                    }
                    return response('ok');
                }
                if (
                    $telegramUser->bet_questions()
                    ->where('bet_question_id', $question->id)
                    ->whereNotNull('bet_answer_id')
                    ->exists()
                )
                {
                    return response('ok');
                }
                $exitCode = Artisan::call('tmbot:send:question',
                                          [
                                              'id' => $question->id,
                                              'user_id' => $telegramUser->id
                                          ]);
                break;
            }
            return response('ok');
        }
        if ($command = $this->telegramService->getCommandFromUpdate($update)) {
            $response = $command->prepareResponse($update);
            if ($response) {
                if (!array_key_exists('reply_markup', $response)) {
                    $response['reply_markup'] = json_encode($this->telegramService->getMenu());
                }
                try {
                    Telegram::sendMessage(
                        array_merge(
                            $response,
                            ['chat_id' => $telegramUser->telegram_id]
                        )
                    );
                } catch (TelegramSDKException $e) {
                    Log::info("Failed to send message to telegram user {$telegramUser->id}");
                }
            }
            return response('ok');
        }
        if (!is_null($message->text)) {
            if ($message->has('entities')) {
                if (collect($message->get('entities'))
                    ->filter(function ($entity) {
                        return $entity['type'] === 'bot_command';
                    })->isNotEmpty())
                {
                    return response('ok');
                }
            }
            if ($telegramUser->current_bot_command) {
                switch($telegramUser->current_bot_command) {
                case app()->make(RegisterCommand::class)->getName():
                    if ($telegramUser->wallet_confirmed_at) {
                        return response('ok');
                    }
                    $command = Telegram::getCommands()[$telegramUser->current_bot_command];
                    break;
                case $this->telegramService::CONFIGURE_COMMAND:
                    $user_input_question = $telegramUser->configure_questions()
                                         ->whereHas('configure_answers', function($q) {
                                             $q->where('type', ConfigureAnswer::TYPE_USER_INPUT)
                                                 ->whereNull('configure_answer_id')
                                                 ->whereNull('comment');
                                         })->first();
                    if ($user_input_question) {
                        $telegramUser->configure_questions()
                            ->updateExistingPivot(
                                $user_input_question->id,
                                ['comment' => $message->text]
                            );
                    }
                    if ($telegramUser->configure_questions()
                        ->whereNull('configure_answer_id')
                        ->WhereNull('comment')
                        ->exists()
                        || ConfigureQuestion::whereNotIn(
                            'id',
                            $telegramUser->configure_questions
                            ->pluck('pivot.configure_question_id')
                        )->exists())
                    {
                        $this->telegramService->sendConfigureResponse($telegramUser);
                    } else {
                        $this->finishConfiguration($telegramUser);
                    }
                    break;
                case app()->make(WithdrawCommand::class)->getName():
                    $command = Telegram::getCommands()[$telegramUser->current_bot_command];
                    break;
                }
                if ($command) {
                    $response = $command->validateInput($update, $telegramUser);
                    if (!empty($response)) {
                        try {
                            Telegram::sendMessage(
                                array_merge(
                                    ['chat_id' => $telegramUser->telegram_id],
                                    $response
                                )
                            );
                        } catch (TelegramSDKException $e) {
                            Log::info("Failed to send message to telegram user {$telegramUser->id}");
                        }
                    }
                }
                try {
                    Telegram::editMessageReplyMarkup([
                        'chat_id' => $telegramUser->telegram_id,
                        'message_id' => (((int) $message->message_id) - 1),
                        'reply_markup' => ''
                    ]);
                } catch (TelegramSDKException $e) {
                    Log::info("Failed to edit reply markup to telegram user {$telegramUser->id}");
                }
                return response('ok');
            }
            try {
                Telegram::sendMessage([
                    'chat_id' => $telegramUser->telegram_id,
                    'reply_markup' => json_encode($this->telegramService->getMenu()),
                    'text' => "Sorry, I didn't get you \xf0\x9f\xa4\xb7\xe2\x80\x8d\xe2\x99\x80\xef\xb8\x8f. You can use /help to see all the available commands.",
                ]);
            } catch (TelegramSDKException $e) {
                Log::info("Failed to send message to telegram user {$telegramUser->id}");
            }
            return response('ok');
        }
        return response('ok');
    }

}
