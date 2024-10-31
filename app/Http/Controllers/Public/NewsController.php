<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Interfaces\News\NewsInterface;
use Illuminate\Http\Request;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\VAPID;

class NewsController extends Controller
{
    protected NewsInterface $repository;

    public function __construct(NewsInterface $news)
    {

        $this->repository=$news;
    }

    public function index()
    {
//        $subscription = Subscription::find($request->input('subscription_id'));
        $message = json_encode([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ], JSON_THROW_ON_ERROR);

        app(\NotificationService::class)->sendNotification($subscription, $message);

        return response()->json(['message' => 'Notification sent']);
//        return $this->repository->index();
    }

    public function latest()
    {

        return $this->repository->latest();

    }

    public function send(Request $request)
    {

    }



}
