<?php

namespace App\Http\Controllers\Website;

use App\Models\Admin;
use App\Models\Coupon;
use App\Models\CouponInstance;
use App\Models\PrivateOrder;
use App\Models\PublicOrder;
use App\Models\eservices_orders;
use App\Models\User;
use App\Notifications\EditPrivateOrderNotify;
use App\Notifications\PrivateOrderNotify;
use App\Notifications\PublicOrderOfferNotify;
use App\Notifications\PayEserviceNotify;
use App\Notifications\PublicOrderProviderNotify;

use App\Traits\OdooTrait;
use Illuminate\Support\Facades\Notification;
use Throwable;
use Auth;
use App\Models\OrderLog;
use App\Models\PublicOrderOffer;

/**
 * Class PrivateOrderController
 * @package App\Http\Controllers\Website
 */
class OdooController extends Controller
{

    use OdooTrait;



    public function login()
    {

        $this->odooLogin();

    }
    public function newUser()
    {
        $user=User::where('email','muhammad.h.alali@gmail.com')->first();
        $this->newUserOdoo($user,'123456');

    }

}
