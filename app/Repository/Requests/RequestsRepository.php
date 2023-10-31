<?php
namespace App\Repository\Requests;

use App\Interfaces\Requests\RequestsInterface;
use App\Models\Request_User;

class RequestsRepository implements RequestsInterface
{
    public function provider_pending()
    {
        $data = auth('users')->user()->provider_requests()->where('status',Request_User::STATUS_PENDING);
//        $data->with('user')
        return response_success($data);
    }

}
