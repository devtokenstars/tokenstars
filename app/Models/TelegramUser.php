<?php

namespace App\Models;

use App\Models\Bet\BetQuestion;
use App\Models\Bet\BetBonus;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class TelegramUser
 * @package App\Models
 * @property string telegram_id
 * @property string username
 * @property string first_name
 * @property string last_name
 * @property string status
 * @property BetQuestion[] bet_questions
 */
class TelegramUser extends Authenticatable
{
    use Notifiable;

    const REFERRER_FRACTION = 0.1;

    const KYC_STATUS_NEW = 'new';
    const KYC_STATUS_WAITING = 'waiting';
    const KYC_STATUS_APPROVED = 'approved';
    const KYC_STATUS_REJECTED = 'rejected';
    const KYC_STATUS_HALF = 'half';
    const KYC_STATUS_RESTRICTED = 'restricted';
    const KYC_STATUS_TOKEN_SENDING = 'token_sending';
    const KYC_STATUS_ACE_SENT = 'ace_sent';

    const KYC_STATUSES = [
        self::KYC_STATUS_NEW,
        self::KYC_STATUS_WAITING,
        self::KYC_STATUS_APPROVED,
        self::KYC_STATUS_REJECTED,
        self::KYC_STATUS_HALF,
        self::KYC_STATUS_RESTRICTED,
        self::KYC_STATUS_TOKEN_SENDING,
        self::KYC_STATUS_ACE_SENT,
    ];

    const PRIVATE_KYC_STATUS_MAPS = [
        1 => self::KYC_STATUS_NEW,
        2 => self::KYC_STATUS_WAITING,
        3 => self::KYC_STATUS_APPROVED,
        4 => self::KYC_STATUS_HALF,
        5 => self::KYC_STATUS_RESTRICTED,
        6 => self::KYC_STATUS_REJECTED,
        10 => self::KYC_STATUS_TOKEN_SENDING,
        11 => self::KYC_STATUS_ACE_SENT,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    protected $dates = [
        'confirmed_at', 'join_group', 'left_group', 'started_bot', 'deleted_bot', 'withdrawn_at'
    ];


    public static function fromAPIUser($user) : TelegramUser
    {
        $telegramUser = new TelegramUser();
        if (is_array($user)) {
            $telegramUser->username = array_has($user, 'username') ? $user['username'] : null;
            $telegramUser->first_name = array_has($user, 'first_name') ? $user['first_name'] : null;
            $telegramUser->last_name = array_has($user, 'last_name') ? $user['last_name'] : null;
            $telegramUser->telegram_id = array_has($user, 'id') ? $user['id'] : null;
        } else {
            $telegramUser->username = $user->username;
            $telegramUser->first_name = $user->firstName;
            $telegramUser->last_name = $user->lastName;
            $telegramUser->telegram_id = $user->id;
        }
        return $telegramUser;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function bet_questions()
    {
        return $this->belongsToMany('App\Models\Bet\BetQuestion')
            ->withTimeStamps()
            ->withPivot([
                'bet_answer_id',
                'telegram_message_id',
                'ace_tokens',
                'team_tokens',
                'bet_bonuses',
                'rating',
            ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function bet_sports()
    {
        return $this->belongsToMany('App\Models\Bet\BetSport')->withTimeStamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function configure_questions()
    {
        return $this->belongsToMany('App\Models\Bet\ConfigureQuestion')
            ->withTimeStamps()
            ->withPivot(['configure_answer_id', 'comment']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function bet_bonuses()
    {
        return $this->hasMany('App\Models\Bet\BetBonus');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function quizzes()
    {
        return $this->belongsToMany('App\Models\Quiz\Quiz')
            ->withTimeStamps()
            ->withPivot(['started_at', 'finished_at']);
    }

    public function quiz_questions()
    {
        return $this->belongsToMany('App\Models\Quiz\QuizQuestion')
            ->withTimeStamps()
            ->withPivot(['quiz_answer_id', 'answered_at']);
    }

    public function getBalanceAttribute() {
        return $this->bet_bonuses()->sum('amount');
    }

    public function getTokensAmount($type) {
        return $this->bet_bonuses()->where('type', $type)->sum('amount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function referrals()
    {
        return $this->hasMany('App\Models\TelegramUser', 'referrer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referrer()
    {
        return $this->belongsTo('App\Models\TelegramUser', 'referrer_id');
    }

    public function telegram_messages()
    {
        return $this->belongsToMany('App\Models\Telegram\TelegramMessage')
            ->withTimeStamps();
    }

    public function scheduled_messages()
    {
        return $this->belongsToMany('App\Models\Telegram\ScheduledMessage')
            ->withTimeStamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function withdraw_requests()
    {
        return $this->hasMany('App\Models\WithdrawRequest');
    }

    public function addBonus(BetBonus $bonus)
    {
        $add_bonus = true;
        if ($bonus->type == BetBonus::TYPE_CONFIGURE) {
            $add_bonus = ! $this->bet_bonuses()
                       ->where('type', BetBonus::TYPE_CONFIGURE)->exists();
        }
        if ($add_bonus) {
            $this->bet_bonuses()->save($bonus);
        }
    }

    public function getTotalBalanceAttribute()
    {
        return bcadd(
            $this->balance,
            bcadd($this->ace_tokens, $this->team_tokens, 20),
            20);
    }
}
