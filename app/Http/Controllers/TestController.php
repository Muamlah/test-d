<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ChatBotTrait;

class TestController extends Controller
{
    use ChatBotTrait;

    public function index(){
        return $this->bot_change_order_status(82, 127, 3, 'public', "ttt", 100);
    }
    
}
