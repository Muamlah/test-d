<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = [];
    public function checkDate(Request $request){
        $duration=$request->duration;
        $today=date('Y-m-d');
        // $currentDay= \Carbon\Carbon::now()->addDays($duration);
        $date =\Carbon\Carbon::createFromFormat('Y-m-d', $today);
        $date = $date->addDays($duration);

        return  $date->format('Y-m-d');
    }
}
