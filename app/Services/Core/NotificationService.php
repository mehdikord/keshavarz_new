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
            'endpoint' => "https://fcm.googleapis.com/fcm/send/c2e73jN_DFw:AP…mgGCmt64GhScI9ohHl8QMQ25rX1FrQgyxactGlyL2T_YLhLgo",
            'publicKey' => "BKeKoSxYNQCulTFAAnNB7hyX0j9pNbVQpxWI/tZe0eb6dSmVIDmJ4/0uUYkbsAAda1S52pzcveUcSAnTOkMqziA=",
            'authToken' => "hgaN6xCF8b21jXkCKgUW5g==",
        ]);

        $webPush->sendOneNotification($notification, $message);
    }
}
