<?php

namespace App\Traits;

use App\Models\Fees;
use App\Models\UserLog;

trait UserLogTreat
{

    public function AddUserLog($user,$action,$description,$price = null){

        $log                    = new UserLog();
        $log->user_id           = $user->id;
        $log->user_name         = $user->name;
        $log->user_email        = $user->email;
        $log->price             = $price;
        $log->action            = $action;
        $log->description       = $description;
        $log->date              = \Carbon\Carbon::now()->toDateTimeString();
        $log->save();
    }

}
