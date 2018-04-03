<?php

namespace App\Services;
use App\Models\TelegramUser;

interface DataService {

    public function paymentData($out, $promoId);
    public function tokenData($out, $promoId=null);
    public function userData($out);
    public function promoStat($out);
    public function userBalance($out);
    public function winners($out);
    public function losers($out);
    public function betUsers($out);
    public function betUser($out, TelegramUser $user);
    public function betUserQuestionsCount($out);
}
