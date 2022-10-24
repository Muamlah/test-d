<?php

namespace App\Traits;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

/**
 * Trait GrupoTrait
 * @package App\Traits
 */
trait SMSTrait
{

//    ارسال رسالة الى المستخدم
    /**
     * @param $number
     * @param $msg
     * @throws GuzzleException
     */
     public function sendSMS($number, $msg){

         $user = config('sms.user');
         $password = config('sms.key');
         $sendername = config('sms.sender_name');
         $phone=$number;
         $message = urlencode($msg);
         $url = "https://sms.malath.net.sa/httpSmsProvider.aspx?username={$user}&password={$password}&mobile={$phone}&unicode=E&message={$message}&sender={$sendername}";
         $client =  new \GuzzleHttp\Client();
         $request = $client->post($url);
         $response = $request->getBody()->getContents();
         Log::debug('-sendSMS-');
         Log::debug($response);
         Log::debug($phone);
         Log::debug($url);
         if ($response==0) {
             return true;
         }else{
             return false;
         }
     }

//    public function sendSms($number, $msg = ""){
//        if (substr($number, 0, 1) == "0") {
//            $number = ltrim($number, '0');
//        }
//        $number = '966' . $number;
//        $curl = curl_init();
//        curl_setopt_array($curl, array(
//        CURLOPT_URL => "http://basic.unifonic.com/rest/SMS/messages",
//        CURLOPT_RETURNTRANSFER => true,
//        CURLOPT_ENCODING => "",
//        CURLOPT_MAXREDIRS => 10,
//        CURLOPT_TIMEOUT => 30,
//        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//        CURLOPT_CUSTOMREQUEST => "POST",
//        CURLOPT_POSTFIELDS => "AppSid=Wv8aUwvfpvSIra01Y3M15uXGSlCHEB&SenderID=unifonicsms&source=منصة معاملة&Recipient=".$number."&Body=".$msg,
//
//        ));
//        $response = curl_exec($curl);
//        $err = curl_error($curl);
//        curl_close($curl);
//        if ($err) {
//            return false;
//        }
//        $result = json_decode($response);
//        print_r($result) ;
//        if($result->success){
//            return true;
//        }else{
//            Log::channel('sms')->error($number);
//            Log::channel('sms')->error($response);
//            return false;
//        }
//    }

}
