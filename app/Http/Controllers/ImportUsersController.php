<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use App\Models\eservices_orders;
use App\Models\PrivateOrder;
use App\Models\PublicOrder;
use App\Models\PublicOrderOffer;
use App\Traits\GrupoTrait;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Traits\SMSTrait;

class ImportUsersController extends Controller

{
    use SMSTrait;
    use GrupoTrait;

    public function imaportCustomers()
    {

           $user_id= PublicOrder::select('user_id')->distinct()->pluck('user_id');
           $provider_id= PublicOrder::select('provider_id')->distinct()->pluck('provider_id');
           $user_id2= PrivateOrder::select('user_id')->distinct()->pluck('user_id');
           $provider_id2= PrivateOrder::select('provider_id')->distinct()->pluck('provider_id');
        $phone= PrivateOrder::select('service_provider_phone')->distinct()->pluck('service_provider_phone');
           $user_id3= eservices_orders::select('user_id')->distinct()->pluck('user_id');
           $provider_id3= eservices_orders::select('provider_id')->distinct()->pluck('provider_id');
           $user3= CreditCard::select('user_id')->distinct()->pluck('user_id');
//        echo $user_id."<br>";

        $provider_id->map(function ($item) use ($user_id) {
            $user_id->push($item)  ;
        });
//echo $user_id."<br>";
        $user_id2->map(function ($item) use ($user_id) {
            $user_id->push($item)  ;
        });
//echo $user_id."<br>";
        $provider_id2->map(function ($item) use ($user_id) {
            $user_id->push($item)  ;
        });
//echo $user_id."<br>";
        $user_id3->map(function ($item) use ($user_id) {
            $user_id->push($item)  ;
        });
//echo $user_id."<br>";
        $provider_id3->map(function ($item) use ($user_id) {
            $user_id->push($item)  ;
        });
        $user3->map(function ($item) use ($user_id) {
            $user_id->push($item)  ;
        });
        $unique = $user_id->unique();

//        print_r($unique->values()->all()) ;

echo 1;
            User::whereNotIn('id',$unique->values()->all())->whereNotNull('email')->whereNotNull('name')->whereNotNull('full_name')->whereNotIn('phone',$phone)->delete();
//          $test=  $this->createUser($phone,$wp_customer->password);
//            $password = $this->generateRandomString();
//            $checkProvider = User::where('phone', $phone)->first();

//            if (!$checkProvider) {
//                $user = new User;
//                $user->phone = $phone;
//                $user->password = bcrypt($password);
//                $user->level = 'user';
//                $user->active = 1;
//                $user->save();
//                $message = "عزيزي العميل ..
//تم تسجيل عضوية جديدة على منصة معاملة الجديدة بشكل تلقائي
//اسم المستخدم:$phone
//كلمة المرور:$password
//الرابط https://app.muamlah.com
//نسعد بخدمتكم على مدار ٢٤ ساعة";
//                $result = $this->sendSms($phone, $message);
//                // if sms sended set 1 else set 2
//                if ($result) {
//                    DB::table('wp_customers')->where('id', $wp_customer->id)->update(['status' => 4]);
//                    echo "success </br>";
//                } else {
//                    DB::table('wp_customers')->where('id', $wp_customer->id)->update(['status' => 2, 'password' => $password]);
//                }
//
//            } else {
//                DB::table('wp_customers')->where('id', $wp_customer->id)->update(['status' => 3, 'password' => 0]);
//
//            }
    }

    public function imaportProviders()
    {
        $minute = date('i');
        $wp_providers = DB::table('wp_providers')->where('status',1)->limit(100)->get();
        foreach ($wp_providers as $wp_provider) {
            if ($minute != date('i')) {
                exit();
            }
            $phone = $wp_provider->phone;
            if (substr($wp_provider->phone, 0, 1) != "0") {
                $phone = 0 . $wp_provider->phone;
            }
            $this->createUser($phone,$wp_provider->password);
//            $checkProvider = User::where('phone', $phone)->first();
//            if (!$checkProvider) {
//                $password = $this->generateRandomString();
//                $user = new User;
//                $user->phone = $phone;
//                $user->password = bcrypt($password);
//                $user->level = 'provider';
//                $user->active = 1;
//                $user->save();
//                //sms message
//                $message = "عزيزي العميل ..
//تم تسجيل عضوية جديدة على منصة معاملة الجديدة بشكل تلقائي
//اسم المستخدم:$phone
//كلمة المرور:$password
//الرابط https://app.muamlah.com
//نسعد بخدمتكم على مدار ٢٤ ساعة";
////            $msg = 'كود تفعيل حسابك على منصة معاملة:' . "\n" . $verification_code .  "\n" .
////                'تنبيه : لا تشارك هذا الرمز ابدا مع اي شخص لحماية حسابك' ;
//                $result = $this->sendSms($phone, $message);
//                // if sms sended set 1 else set 2
//                if ($result) {
                    DB::table('wp_providers')->where('id', $wp_provider->id)->update(['status' => 4]);
//                    echo "success </br>";
//                } else {
//                    DB::table('wp_providers')->where('id', $wp_provider->id)->update(['status' => 2, 'password' => $password]);
//                }
//
//            } else {
//                DB::table('wp_providers')->where('id', $wp_provider->id)->update(['status' => 3, 'password' => 0]);
//
//            }
        }
    }

    //sms service her


    public function generateRandomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
