<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\TelegramUser;
use App\Models\Bet\BetQuestion;
use App\Services\EthereumService;
use GuzzleHttp\Exception\TransferException;

class ProcessUpdateTelegramUserBalance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 0;

    protected $bet_question_id;

    protected $ethereumService;

    protected $aceTokenAddress;
    protected $teamTokenAddress;
    protected $question;
    protected $numOfQueues;

    protected $queueId;
    const QUEUE_PREFIX = 'user_balance_';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(BetQuestion $question)
    {
        $this->aceTokenAddress = env('ACE_TOKEN_ADDRESS');
        $this->teamTokenAddress = env('TEAM_TOKEN_ADDRESS');
        $this->numOfQueues = (int) env('USER_BALANCE_QUEUES_NUM');
        $this->question = $question;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(EthereumService $ethereumService)
    {
        $this->ethereumService = $ethereumService;
        $reg = '/' . self::QUEUE_PREFIX . '(?<value>\d)/';
        if (! preg_match($reg, $this->queue, $matches)) {
            Log::info("queue regex doesnt match at " . self::class);
            return;
        }
        $this->queueId = $matches['value'];
        Log::info(self::QUEUE_PREFIX."{$this->queueId} started");
        TelegramUser::select('id', 'wallet', DB::raw("MOD(`id`, ".$this->numOfQueues.") AS mod_id"))
            ->whereHas('bet_questions', function($q) {
                $q->where('bet_question_id', $this->question->id);
            })
            ->whereNotNull('profile_configured_at')
            ->whereNull('deleted_bot')
            ->whereNotNull('wallet')
            ->whereNotNull('wallet_confirmed_at')
            ->having('mod_id', $this->queueId)
            ->each(function($telegramUser) {
                Log::info("updating balance for user {$telegramUser->id} in queue ".self::QUEUE_PREFIX."{$this->queueId}");
                try {
                    $telegramUser->ace_tokens = $this->ethereumService->getBalance($telegramUser->wallet, $this->aceTokenAddress);
                    $telegramUser->team_tokens = bcdiv($this->ethereumService->getBalance($telegramUser->wallet, $this->teamTokenAddress), 10000, 4);
                    $telegramUser->save();
                } catch (TransferException $e) {
                    Log::info($e);
                }

                $telegramUser->bet_questions()
                    ->updateExistingPivot(
                        $this->question->id,
                        [
                            'bet_bonuses' => $telegramUser->balance,
                            'ace_tokens' => $telegramUser->ace_tokens,
                            'team_tokens' => $telegramUser->team_tokens
                        ]
                    );

        });
    }
}
