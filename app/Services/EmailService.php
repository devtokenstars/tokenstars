<?php

namespace App\Services;


interface EmailService {

    /**
     * @param $email
     * @return array
     */
    public function subscribe($email);

    public function getSubscribeDate($email);

    public function getMemberCount();

}
