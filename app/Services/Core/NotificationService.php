<?php
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class NotificationService
{
    public function sendNotification($subscription, $message)
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
            'endpoint' => $subscription->endpoint,
            'publicKey' => $subscription->public_key,
            'authToken' => $subscription->auth_token,
        ]);

        $webPush->sendNotification($notification, $message);
    }
}
