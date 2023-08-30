<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Single\ContactSendMessageRequest;
use App\Models\Contacts;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send_message(ContactSendMessageRequest $request)
    {
        Contacts::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
        ]);
        return response_success('','پیام شما باموفقیت ارسال شد با تشکر از شما');
    }
}
