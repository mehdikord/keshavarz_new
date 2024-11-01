<?php
namespace App\Services\Core;

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class NotificationService
{
    public function sendNotification($message)
    {
        $auth = [
            'VAPID' => [
                'subject' => 'mailto:support@keshavarz.app',
                'publicKey' => env('VAPID_PUBLIC_KEY'),
                'privateKey' => env('VAPID_PRIVATE_KEY'),
            ],
        ];

        $webPush = new WebPush($auth);
        $notification = Subscription::create([
            'endpoint' => "https://fcm.googleapis.com/fcm/send/eyClTEG-uio:APA91bHBc3hGzpqnY4Bm0kz6Kp64l9vW-toJ0QzrDR-MtLzeVEAeL1iX-gvWoPFhPrBNf2AUGWyTqlCz4b7g75ua90PRNlxvTj0EQP3-0aKmSI_L1bKY4GQcr8KnrHpAq4trLTrFAMKF",
            'publicKey' => "BDu8anux9Ok/iuTAtvUWAx5JEncU8JICem3JlxK5bZzZcc7V2gMkSp93xuGz+C3aj8aco1NZ8Eg3ppCzuryW0Oo=",
            'authToken' => "JmIBhcmW8wsqQ/FyMXcakg==",
        ]);

        $webPush->sendOneNotification($notification, $message);
    }
}
