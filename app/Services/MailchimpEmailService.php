<?php

namespace App\Services;


use DrewM\MailChimp\MailChimp;

class MailchimpEmailService implements EmailService {

    /**
     * @var MailChimp
     */
    protected $mailchimpClient;
    protected $apiKey;
    protected $members;

    public function __construct() {
        $this->apiKey = config('mailchimp.apiKey');
        if ($this->apiKey) {
            $this->mailchimpClient = new MailChimp(config('mailchimp.apiKey'));
        }
    }

    public function subscribe($email)
    {
        if (!$this->apiKey) {
            return [
                'status' => false,
                'error' => 'No mailchimp api key',
                'detail' => 'No mailchimp api key',
            ];
        }
        $listAllId = config('mailchimp.listAllId');
        $listConfirmedId = config('mailchimp.listConfirmedId');
        $resultAll = $this->mailchimpClient->post("lists/$listAllId/members", [
            'email_address' => $email,
            'status'        => 'subscribed',
        ]);
        if ($resultAll['status'] === 400 && $resultAll['title'] === 'Invalid Resource') {
            return [
                'status' => false,
                'error' => $resultAll['title'],
                'detail' => $resultAll['detail'],
            ];
        }

        $resultConfirmed = $this->mailchimpClient->post("lists/$listConfirmedId/members", [
            'email_address' => $email,
            'status'        => 'pending',
        ]);

        if ($resultAll['status'] === 400 && $resultConfirmed['status'] === 400) {
            return [
                'status' => false,
                'error' => $resultConfirmed['title'],
                'detail' => $resultConfirmed['detail'],
            ];
        }
        return [
            'status' => true,
        ];
    }

    public function getSubscribeDate($email) {
        $listConfirmedId = config('mailchimp.listConfirmedId');
        if ($this->members === null) {
            $result = $this->mailchimpClient->get("lists/$listConfirmedId/members", [
                'fields' => "members.email_address,members.timestamp_signup",
                "count" => 1000,
            ]);
            if (array_key_exists('members', $result)) {
                $this->members = $result['members'];
            } else {
                $this->members = [];
                return null;
            }
        }
        foreach ($this->members as $member) {
            if ($member['email_address'] == $email) {
                return $member['timestamp_signup'];
            }
        }
        return null;
    }

    public function getMemberCount()
    {
        $listConfirmedId = config('mailchimp.listConfirmedId');
        $result = $this->mailchimpClient->get("lists/$listConfirmedId");
        $memberCount = null;
        if (array_key_exists('stats', $result) && array_key_exists('member_count', $result['stats'])) {
            $memberCount = $result['stats']['member_count'];
        }
        return $memberCount;
    }
}
