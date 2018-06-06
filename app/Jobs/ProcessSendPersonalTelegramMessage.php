<?php

namespace App\Jobs;

use App\Models\Bet\BetBonus;
use App\Models\TelegramUser;
use App\Services\TelegramService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Telegram\Bot\Laravel\Facades\Telegram;

class ProcessSendPersonalTelegramMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    const PERCENT_CHOICE = [
        30, 35, 40, 45, 50, 55, 60
    ];

    const MESSAGE_NEXT_TIER = 1;
    const MESSAGE_REFERRALS = 2;
    const MESSSAGE_BUY_TOKENS = 3;

    const WHALE_TIER = ['id' => -1, 'value' => 50000];
    const FIRST_TIER = ['id' => 1, 'value' => 20000, 'next' => self::WHALE_TIER['id']];
    const SECOND_TIER = ['id' => 2, 'value' => 10000, 'next' => self::FIRST_TIER['id']];
    const THIRD_TIER = ['id' => 3, 'value' => 5000, 'next' => self::SECOND_TIER['id']];
    const FOURTH_TIER = ['id' => 4, 'value' => 2000, 'next' => self::THIRD_TIER['id']];
    const FIFTH_TIER = ['id' => 5, 'value' => 500, 'next' => self::FOURTH_TIER['id']];
    const SIXTH_TIER = ['id' => 6, 'value' => -1, 'next' => self::FIFTH_TIER['id']];

    const TIERS = [
        self::WHALE_TIER['id'] => self::WHALE_TIER,
        self::FIRST_TIER['id'] => self::FIRST_TIER,
        self::SECOND_TIER['id'] => self::SECOND_TIER,
        self::THIRD_TIER['id'] => self::THIRD_TIER,
        self::FOURTH_TIER['id'] => self::FOURTH_TIER,
        self::FIFTH_TIER['id'] => self::FIFTH_TIER,
        self::SIXTH_TIER['id'] => self::SIXTH_TIER
    ];

    const BUTTONS = [
        'inline_keyboard' =>
        [
            [
                [
                    'text' => 'Buy tokens on Bit-Z',
                    'url' => 'https://www.bit-z.com/trade/team_btc'
                ],
                [
                    'text' => 'Buy tokens on OKEx',
                    'url' => 'https://www.okex.com/market?product=ace_btc'
                ]
            ]
        ]
    ];

    const MESSAGES = [
        self::MESSAGE_NEXT_TIER => [
            'text' => "Hi, notice that you need only {TOKENS} more tokens to reach the next Tier bonus. With this bonus You could be {PERCENT}% higher in the leaderbord!\n
Get more tokens on the exchanges: ACE or TEAM and raise your chances to win 3 iPhone X and 40,000+ TEAM tokens."
,
            'buttons' => self::BUTTONS
        ],
        self::MESSAGE_REFERRALS => [
            'text' => "You have invited {REFERRALS} active experts to the TokenStars Predictions and earned {REFERRAL_BONUS} TEAM tokens. Share your referral link to grow our predictions community and get 2.018 TEAM for each newcomer!",
        ],

        self::MESSSAGE_BUY_TOKENS => [
            'text' => "The more coins, the more chances to win. Click on the button below and buy more tokens to increase the Tier bonus and raise your leaderboard rating.",
            'buttons' => self::BUTTONS
        ]
    ];

    public $timeout = 0;

    protected $telegramService;

    public function __construct()
    {
        //
    }

    protected function getTierFromBalance($balance)
    {
        if ($balance > self::FIRST_TIER['value']) {
            return self::FIRST_TIER;
        } else if ($balance > self::SECOND_TIER['value']) {
            return self::SECOND_TIER;
        } else if ($balance > self::THIRD_TIER['value']) {
            return self::THIRD_TIER;
        } else if ($balance > self::FOURTH_TIER['value']) {
            return self::FOURTH_TIER;
        } else if ($balance > self::FIFTH_TIER['value']) {
            return self::FIFTH_TIER;
        } else {
            return self::SIXTH_TIER;
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
        $query = TelegramUser::query();
        Log::info("personal telegram message started for users " . $query->count());
        $deleted_bot_user_ids = [];
        $delayed_user_ids = [];
        $query->chunk(100, function($users) use (&$deleted_bot_user_ids, &$delayed_user_ids) {
            foreach ($users as $telegramUser) {
                if (is_null($telegramUser->profile_configured_at)) {
                    Log::info("personal message profile not configured user {$telegramUser->id}");
                    continue;
                }
                if (! is_null($telegramUser->deleted_bot)) {
                    Log::info("personal message deleted bot user {$telegramUser->id}");
                    continue;
                }

                $balance = (float) bcadd(
                    $telegramUser->balance,
                    bcadd($telegramUser->ace_tokens,
                          $telegramUser->team_tokens, 4), 4);
                if ($balance > self::WHALE_TIER['value']) {
                    Log::info("personal message balance > ".self::WHALE_TIER['value']." user {$telegramUser->id} {$balance}");
                    continue;
                }
//                $messageIndex = rand(self::MESSAGE_NEXT_TIER, self::MESSSAGE_BUY_TOKENS);
                $messageIndex = date('z') % self::MESSSAGE_BUY_TOKENS + self::MESSAGE_NEXT_TIER;
                $mes = self::MESSAGES[$messageIndex];
                $variables = [];
                if ($messageIndex == self::MESSAGE_NEXT_TIER) {
                    $tier = $this->getTierFromBalance($balance);
                    if (! array_key_exists('next', $tier)) {
                        Log::info("personal message next tier doesn't exsist user {$telegramUser->id}");
                        continue;
                    }
                    $nextTier = self::TIERS[$tier['next']];
                    $tokens = 0.5 + (float) $this->telegramService->format_number($nextTier['value'] - $balance, 4);
                    $tokens = round($tokens, 0, PHP_ROUND_HALF_UP);
                    $percentChoice = rand(0, count(self::PERCENT_CHOICE) - 1);
                    $percent = self::PERCENT_CHOICE[$percentChoice];
                    $variables['TOKENS'] = $tokens;
                    $variables['PERCENT'] = $percent;
                } else if ($messageIndex == self::MESSAGE_REFERRALS) {
                    $variables['REFERRALS'] = $telegramUser
                                            ->referrals()
                                            ->whereHas('bet_questions',
                                                       function($q) {
                                                           $q->whereNotNull('bet_answer_id');
                                                       }, '>=', 5)->count();
                    $variables['REFERRAL_BONUS'] = $this->telegramService
                                                 ->format_number(
                                                     $telegramUser
                                                     ->getTokensAmount(BetBonus::TYPE_REFERRAL),
                                                     4
                                                 );
                }
                $text = $mes['text'];
                foreach($variables as $key => $value) {
                    $text = str_replace('{'.strtoupper($key).'}', $value, $text);
                }
                $params = [
                    'text' => $text,
                    'parse_mode' => 'HTML',
                    'chat_id' => $telegramUser->telegram_id
                ];
                if (array_key_exists('buttons', $mes)) {
                    $params['reply_markup'] = json_encode($mes['buttons']);
                }
                try {
                    $message = Telegram::sendMessage($params);
                } catch (TelegramResponseException $e) {
                    $data = $e->getResponseData();
                    if (!empty($data) && array_key_exists('error_code', $data)) {
                        if (in_array($data['error_code'], [400, 403])) {
                            $deleted_bot_user_ids[] = $telegramUser->id;
                            Log::info("personal message set deleted bot to telegram user {$telegramUser->id}");
                        } else if ($data['error_code'] == 429) {
                            $delayed_user_ids[] = $telegramUser->id;
                            Log::info("personal message delayed to {$telegramUser->id}");
                            usleep(300000);
                        }
                    } else {
                        Log::info("personal message failed to send to telegram user {$telegramUser->id}");
                        Log::info($e);
                    }
                    continue;
                } catch (TelegramSDKException $e) {
                    Log::info("personal message failed to send to telegram user {$telegramUser->id}");
                    Log::info($e);
                    continue;
                }
                if ($message) {
                    Log::info("personal message {$messageIndex} sent to telegram user {$telegramUser->id} with message id {$message->message_id}");
                }
            }
        });
        if (!empty($delayed_user_ids)) {
            Log::info("personal message not sent (response code 429) to " . json_encode($delayed_user_ids));
        }

        if (!empty($deleted_bot_user_ids)) {
            TelegramUser::whereIn('id', $deleted_bot_user_ids)
                ->update(['deleted_bot' => Carbon::now()]);
        }
    }
}
