<?php

namespace App\Observers;

use App\Events\UserCreated;
use App\Models\User;
use App\Repositories\AccountRepository;
use App\Services\EmailService;
use Illuminate\Support\Str;

class UserObserver
{
    protected $accountRepository;
    protected $emailService;

    public function __construct(AccountRepository $accountRepository, EmailService $emailService)
    {
        $this->accountRepository = $accountRepository;
        $this->emailService = $emailService;
    }

    /**
     * Handle the event.
     *
     * @param UserCreated $event
     */
    public function created(User $user)
    {
        $user->register_token = Str::random(60);
        $user->save();
    }
}
