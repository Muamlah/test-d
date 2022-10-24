<?php

namespace App\Http\Controllers;

use App\Models\ChatbotMessage;
use Illuminate\Http\Request;

class ChatbotMessageController extends Controller
{
    public static function store($request)
    {

        return 0;//nothing to do.. we will start with direct communiction with tech. support

        $newMessage = new ChatbotMessage();

        $newMessage->chatId         = $request->chatId;
        $newMessage->user_id        = $request->user_id;
        $newMessage->type           = $request->type;
        $newMessage->message        = $request->message;
        $newMessage->file           = $request->file;
        $newMessage->response       = $request->response;
        $newMessage->status         = $request->status;
        $newMessage->sent_at        = $request->sent_at;
        $newMessage->delivered_at   = $request->delivered_at;

        $newMessage->save();
    }


    //
}
