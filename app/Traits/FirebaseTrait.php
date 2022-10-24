<?php

namespace App\Traits;

use App\Models\FirebaseToken;
use Namshi\JOSE\Signer\OpenSSL\ECDSA;

/**
 * Trait FirebaseTrait
 * @package App\Traits
 */
trait FirebaseTrait
{


    public function desktopNotifications($titel = "Muamlah", $body = "", $link = "", $users_ids = array(), $more_data = [], $to_status = null)
    {
        try {

//            $API_ACCESS_KEY = "AAAAXU2sbLo:APA91bESRY6j-iKiHA7c93hPAr0tN7WeExTPu6pCxsgflbidBQ-B8LJRaM2mk81Q3H0d79yOKgcGqjP_L_S3hFFSJPGzjM7r2dHCwJhi1qRwvEr3x4Q4kbWUPjSajxi1eawkhhVWqhni";
            // echo  $link;
            $msg = array(
                "title" => $titel,
                "body" => $body,
                "icon" => "https://app.muamlah.com/public/template-muamlah/images/logo.png",
                "click_action" => $link,
            );
            $registrationIds = [];
            $registrations_tokens = [
                'WEB' => [],
                'IOS' => [],
                'ANDROID' => [],
            ];
            if ($to_status == 'eservices_orders') {
                $_tokens = FirebaseToken::whereIn('user_id', $users_ids)->where('eservices_orders_notifications', '1')->select('token', 'type');
            } else if ($to_status == 'private_public_orders') {
                $_tokens = FirebaseToken::whereIn('user_id', $users_ids)->where('public_private_orders_notifications', '1')->select('token', 'type');
            } else {
                $_tokens = FirebaseToken::whereIn('user_id', $users_ids)->select('token', 'type');
            }

            $clonedQuery_1 = clone $_tokens;
            $clonedQuery_2 = clone $_tokens;
            $registrations_tokens['WEB'] =   $_tokens->where('type', 'WEB')->get()->pluck('token')->toArray();
            $registrations_tokens['IOS'] =   $clonedQuery_1->where('type', 'IOS')->get()->pluck('token')->toArray();
            $registrations_tokens['ANDROID'] =   $clonedQuery_2->where('type', 'ANDROID')->get()->pluck('token')->toArray();
//            foreach($registrations_tokens as $key => $value){
//                $registrations_tokens[$key] = clone  $key->where('type', $key)->get()->pluck('token')->toArray();
//            }
//            print_r($registrations_tokens);
//            exit();
            // $collection_tokens = $_tokens->get();
//            if (!is_null($_tokens)) {
//                $collection_tokens = $_tokens->get();
//                foreach ($collection_tokens as $token) {
//                    $desktop_tokens[] = $token->token;
//                }
//            }
//            $registration_tokens = array_chunk($desktop_tokens, 950);
//
//            $result = "";
            foreach ($registrations_tokens as $key => $registrationToken) {
                if(empty($registrationToken)) continue;
                if ($key == 'WEB') {
                    $API_ACCESS_KEY = "AAAAXU2sbLo:APA91bESRY6j-iKiHA7c93hPAr0tN7WeExTPu6pCxsgflbidBQ-B8LJRaM2mk81Q3H0d79yOKgcGqjP_L_S3hFFSJPGzjM7r2dHCwJhi1qRwvEr3x4Q4kbWUPjSajxi1eawkhhVWqhni";
                } elseif ($key == 'IOS') {
                    $API_ACCESS_KEY = "AAAAh1vrEqk:APA91bGuxUOrvzZ7LGoH-mxTvAPg3fbHS7GCEtSMO8Aulud8SJSl1nQDkeYqkB2Y_fwQ7uEyMtNWPGINkJe22jqHHx4LlluBg4UER89F7ewQb_XUrZzBOZ0llvnip1DQDmcixNl_2bol";
                } elseif ($key == 'ANDROID') {
                    $API_ACCESS_KEY = "AAAAh1vrEqk:APA91bGuxUOrvzZ7LGoH-mxTvAPg3fbHS7GCEtSMO8Aulud8SJSl1nQDkeYqkB2Y_fwQ7uEyMtNWPGINkJe22jqHHx4LlluBg4UER89F7ewQb_XUrZzBOZ0llvnip1DQDmcixNl_2bol";
                }

                $data = [
                    "registration_ids" => $registrationToken, // for single device id
                    "notification" =>$msg,
                ];


                $headers = array
                (
                    'Authorization: key=' . $API_ACCESS_KEY,
                    'Content-Type: application/json'
                );
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                $result = curl_exec($ch);
                curl_close($ch);
                $registrationIds = [];

            }
//            return json_decode($result);
        } catch (\Exciption $e) {

        }
    }
}
