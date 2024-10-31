<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Interfaces\News\NewsInterface;
use Illuminate\Http\Request;
use Jose\Component\Core\Util\ECKey;
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

        $vapidKeys = ECKey::createECKey('P-256');
        return $vapidKeys;

        return $this->repository->index();
    }

    public function latest()
    {

        return $this->repository->latest();

    }


}
