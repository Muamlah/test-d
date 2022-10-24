<?php

namespace App\Traits;


use App\Models\User;

/**
 * Trait PaymentGatewayTrait
 * @package App\Traits
 */
trait OdooTrait
{

    /**
     * @param $amount //المبلغ
     * @param $order_id //رقم الطلب
     * @return mixed
     */
    private function odooLogin(){
        $url = 'https://erp.muamlah.com/web/session/authenticate';
        $curlObj = curl_init();
        $data = '{
    "jsonrpc": "2.0",
    "params": {
        "db": "MUAMLAH",
        "login": "haniiable@gmail.com",
        "password": "9xRGBqbwh9pFZG7k2hom"
    }}';
        curl_setopt($curlObj,  CURLOPT_URL,  $url);
        curl_setopt($curlObj,  CURLOPT_RETURNTRANSFER,  1);
        curl_setopt($curlObj,  CURLOPT_HEADER,  1);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlObj,  CURLOPT_SSL_VERIFYPEER,  false);
        $result = curl_exec($curlObj);
// Matching the response to extract cookie value
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi',$result,  $match_found);
        $cookies = array();
        foreach($match_found[1] as $item) {
            parse_str($item,  $cookie);
            $cookies = array_merge($cookies,  $cookie);
        }

        curl_close($curlObj);
        return $cookies['session_id'];
    }


    public function newUserOdoo( User $user,$password){
      $session_id=  $this->odooLogin();
        $url = 'https://erp.muamlah.com/muamlah/users';
        $curlObj = curl_init();
        $data = '{
    "user": {
        "id": "'.$user->id.'",
        "name": "'.$user->name.'",
        "login": "'.$user->email.'",
        "password": "'.$password.'",
        "phone": "'.$user->phone.'",
        "active": "True",
        "type": "'.$user->level.'"
	}
}';



        curl_setopt($curlObj, CURLOPT_URL, $url);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER,  ['Content-Type: application/json',"Cookie: session_id=".$session_id.""]);
        curl_setopt($curlObj, CURLOPT_POST, 1);
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curlObj);
        curl_close($curlObj);


        $user->odoo_response=$response;
// Matching the response to extract cookie value
        $result= json_decode($response, true);
            if (isset($result['result']) && $result['result']['code'] == '200') {
                $user->odoo_id=$result['result']['id'];
            }
        $user->save();

        curl_close($curlObj);
        return true;
    }
    public function updateUserOdoo( User $user, $password){
        $session_id=  $this->odooLogin();

        if ($user->odoo_id=='') {
            return true;
        }
        $url = 'https://erp.muamlah.com/muamlah/users';
        $curlObj = curl_init();
        if ($password !='null') {
            $data = '{
    "user": {
           "id": "'.$user->odoo_id.'",
        "name": "'.$user->name.'",
        "login": "'.$user->email.'",
        "password": "'.$password.'",
        "phone": "'.$user->phone.'",
        "active": "True",
        "type": "'.$user->level.'"
	}
}';
        }else{
            $data = '{
    "user": {
    "id": "'.$user->odoo_id.'",
        "name": "'.$user->name.'",
        "login": "'.$user->email.'",
        "phone": "'.$user->phone.'",
        "active": "True",
        "type": "'.$user->level.'"
	}
}';
        }

        curl_setopt($curlObj, CURLOPT_URL, $url);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER,  ['Content-Type: application/json',"Cookie: session_id=".$session_id.""]);
        curl_setopt($curlObj, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curlObj);
        curl_close($curlObj);
        $user->odoo_response=$response;

// Matching the response to extract cookie value
        $result= json_decode($response, true);
        $user->save();

        curl_close($curlObj);
        return true;
    }
}
