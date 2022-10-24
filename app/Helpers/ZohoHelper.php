<?php
namespace App\Helpers;

class ZohoHelper
{
    protected $zoho_data = [];
    public function __construct()
    {
        $this->zoho_data['client_id'] = config('zoho.client_id');
        $this->zoho_data['client_secret'] = config('zoho.client_secret');
        $this->zoho_data['redirect_uri'] = config('zoho.redirect_uri');
        $this->zoho_data['user_email_id'] = config('zoho.user_email_id');
        $this->zoho_data['refresh_token'] = config('zoho.refresh_token');
        $this->zoho_data['access_token'] = config('zoho.access_token');
        $this->zoho_data['key'] = config('zoho.key');
        $this->zoho_data['base_url'] = "https://www.zohoapis.com/crm/v2/";
    }

    public function refreshToken()
    {
        $url = "https://accounts.zoho.com/oauth/v2/token";
        $data = [
            'client_id' => $this->zoho_data['client_id'],
            'client_secret' => $this->zoho_data['client_secret'],
            'refresh_token' => $this->zoho_data['refresh_token'],
            'grant_type' => 'refresh_token'
        ];
        $response = $this->curlPostByFullUrl($url, $data);
        if($response['success']){
            $token = $response['data']['access_token'];
            if(!empty($token)){
                config(['zoho.access_token' => $token]);
                $this->zoho_data['access_token'] = $token;
            }
        }
        return $response;
    }

    public function createModel($model, $data){
        $response = $this->curlPost($model, $data);
        return $response;
    }
    public function getOrgDeatis(){
        $response = $this->curlGet('org');
        if($response['success']){
            dd($response['data']);
        }
    }

    public function curlGet($end_point, $data = []){
        $curl_pointer = curl_init();

        $curl_options = array();
        $url = $this->zoho_data['base_url'].$end_point;

        $curl_options[CURLOPT_URL] = $url;
        $curl_options[CURLOPT_RETURNTRANSFER] = true;
        $curl_options[CURLOPT_HEADER] = 1;
        $curl_options[CURLOPT_CUSTOMREQUEST] = "GET";
        $headersArray = array();

        $headersArray[] = "Authorization". ":" . "Zoho-oauthtoken " .$this->zoho_data['access_token'];
        $curl_options[CURLOPT_HTTPHEADER]=$headersArray;

        curl_setopt_array($curl_pointer, $curl_options);

        $result = curl_exec($curl_pointer);
        $responseInfo = curl_getinfo($curl_pointer);
        curl_close($curl_pointer);
        list ($headers, $content) = explode("\r\n\r\n", $result, 2);
        if(strpos($headers," 100 Continue")!==false){
            list( $headers, $content) = explode( "\r\n\r\n", $content , 2);
        }
        $headerArray = (explode("\r\n", $headers, 50));
        $headerMap = array();
        foreach ($headerArray as $key) {
            if (strpos($key, ":") != false) {
                $firstHalf = substr($key, 0, strpos($key, ":"));
                $secondHalf = substr($key, strpos($key, ":") + 1);
                $headerMap[$firstHalf] = trim($secondHalf);
            }
        }
        $jsonResponse = json_decode($content, true);
        if ($jsonResponse == null && $responseInfo['http_code'] != 204) {
            list ($headers, $content) = explode("\r\n\r\n", $content, 2);
            $jsonResponse = json_decode($content, true);
        }
        // var_dump($headerMap);
        // var_dump($jsonResponse);
        // var_dump($responseInfo['http_code']);
        if($responseInfo['http_code'] == 200 || $responseInfo['http_code'] == 201){
            return [
                'status_code' => $responseInfo['http_code'],
                'success' => true,
                'data' => $jsonResponse
            ];
        }else{
            return [
                'status_code' => $responseInfo['http_code'],
                'success' => false,
                'data' => $jsonResponse
            ];
        }
    }
    public function curlPost($end_point, $data = []){
        $curl_pointer = curl_init();
        // $data['ApiKey'] = $this->zoho_data['key'];
        $curl_options = array();
        $url = $this->zoho_data['base_url'].$end_point;

        $curl_options[CURLOPT_URL] =$url;
        $curl_options[CURLOPT_RETURNTRANSFER] = true;
        $curl_options[CURLOPT_HEADER] = 1;
        $curl_options[CURLOPT_CUSTOMREQUEST] = "POST";
        $requestBody = array();
        $requestBody["data"] = $data;
        $curl_options[CURLOPT_POSTFIELDS]= json_encode($requestBody);
        $headersArray = array();
        $headersArray[] = "Authorization". ":" . "Zoho-oauthtoken " .$this->zoho_data['access_token'];

        $curl_options[CURLOPT_HTTPHEADER]=$headersArray;

        curl_setopt_array($curl_pointer, $curl_options);

        $result = curl_exec($curl_pointer);
        $responseInfo = curl_getinfo($curl_pointer);
        curl_close($curl_pointer);
        list ($headers, $content) = explode("\r\n\r\n", $result, 2);
        if(strpos($headers," 100 Continue")!==false){
            list( $headers, $content) = explode( "\r\n\r\n", $content , 2);
        }
        $headerArray = (explode("\r\n", $headers, 50));
        $headerMap = array();
        foreach ($headerArray as $key) {
            if (strpos($key, ":") != false) {
                $firstHalf = substr($key, 0, strpos($key, ":"));
                $secondHalf = substr($key, strpos($key, ":") + 1);
                $headerMap[$firstHalf] = trim($secondHalf);
            }
        }
        $jsonResponse = json_decode($content, true);
        if ($jsonResponse == null && $responseInfo['http_code'] != 204) {
            list ($headers, $content) = explode("\r\n\r\n", $content, 2);
            $jsonResponse = json_decode($content, true);
        }
        if($responseInfo['http_code'] == 200 || $responseInfo['http_code'] == 201){
            return [
                'status_code' => $responseInfo['http_code'],
                'success' => true,
                'data' => $jsonResponse
            ];
        }else{
            return [
                'status_code' => $responseInfo['http_code'],
                'success' => false,
                'data' => $jsonResponse
            ];
        }
    }

    public function curlPostByFullUrl($url, $data = []){
        $curl_pointer = curl_init();
        $curl_options = array();

        $curl_options[CURLOPT_URL] =$url;
        $curl_options[CURLOPT_RETURNTRANSFER] = true;
        $curl_options[CURLOPT_HEADER] = 1;
        $curl_options[CURLOPT_CUSTOMREQUEST] = "POST";
        $requestBody = array();
        $curl_options[CURLOPT_POSTFIELDS]= $data;
        // dd($curl_options[CURLOPT_POSTFIELDS]);
        $headersArray = array();

        $curl_options[CURLOPT_HTTPHEADER]=$headersArray;

        curl_setopt_array($curl_pointer, $curl_options);

        $result = curl_exec($curl_pointer);
        $responseInfo = curl_getinfo($curl_pointer);
        curl_close($curl_pointer);
        list ($headers, $content) = explode("\r\n\r\n", $result, 2);
        if(strpos($headers," 100 Continue")!==false){
            list( $headers, $content) = explode( "\r\n\r\n", $content , 2);
        }
        $headerArray = (explode("\r\n", $headers, 50));
        $headerMap = array();
        foreach ($headerArray as $key) {
            if (strpos($key, ":") != false) {
                $firstHalf = substr($key, 0, strpos($key, ":"));
                $secondHalf = substr($key, strpos($key, ":") + 1);
                $headerMap[$firstHalf] = trim($secondHalf);
            }
        }
        $jsonResponse = json_decode($content, true);
        if ($jsonResponse == null && $responseInfo['http_code'] != 204) {
            list ($headers, $content) = explode("\r\n\r\n", $content, 2);
            $jsonResponse = json_decode($content, true);
        }
        if($responseInfo['http_code'] == 200 || $responseInfo['http_code'] == 201){
            return [
                'status_code' => $responseInfo['http_code'],
                'success' => true,
                'data' => $jsonResponse
            ];
        }else{
            return [
                'status_code' => $responseInfo['http_code'],
                'success' => false,
                'data' => $jsonResponse
            ];
        }
    }
}
