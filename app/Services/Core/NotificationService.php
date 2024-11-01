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
            'endpoint' => "https://fcm.googleapis.com/fcm/send/fmCjnWleGVc:APA91bH5wFT9Y0Oz-8gNQQayb2w1j3weB83ssUBe7pjyPdR6OZoOVuPEE6I5oshjeahVY8n2ZELmyflXm3NAHg_gTsZ_t-rH6MGwSmqMtkEnOuCoWiW9tRUPiEDwNGD9mv0GOO-nGNO7",
            'publicKey' => "BAfYZYeahCDMB3zUTANidtRWXt8fvbUpAnyuvdfNwvYk2hURZDgRXzaiUg+Kxko7mYXFcXJc6AnOW8W4+AiKip0=",
            'authToken' => "Gl40wyAjmVKCs3XX8uSTKg==",
        ]);

        $webPush->sendOneNotification($notification, $message);
    }
}
