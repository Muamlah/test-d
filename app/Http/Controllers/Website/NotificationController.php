<?php

namespace App\Http\Controllers\Website;


use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

/**
 * Class HomeController
 * @package App\Http\Controllers\Website
 */
class NotificationController  extends Controller
{

    /**
     * @param  int  $id  Notification ID
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
            return redirect($notification->data['link']);
        }
    }
}
