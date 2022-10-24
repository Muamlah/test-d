<?php

namespace App\Http\Controllers\Website;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package App\Http\Controllers\Website
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = [];

    static $categories = [
        'eservices_page' => [
            'key' => 'eservices_page',
            'title' => 'دليل الخدمات الإلكترونية',
        ],
        'public_page' => [
            'key' => 'public_page',
            'title' => 'دليل خدمات التعميد العام',
        ],
        'private_page' => [
            'key' => 'private_page',
            'title' => 'دليل خدمات التعميد الخاص',
        ]
    ];


    public function checkDate(Request $request){
        $duration=$request->duration;
        $today=date('Y-m-d');
        // $currentDay= \Carbon\Carbon::now()->addDays($duration);
        $date =\Carbon\Carbon::createFromFormat('Y-m-d', $today);
        $date = $date->addDays($duration);

        return  $date->format('Y-m-d');
    }
}
