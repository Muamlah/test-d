<?php

namespace App\Traits;


use App\Http\Controllers\EservicesController;

/**
 * Trait PaymentGatewayTrait
 * @package App\Traits
 */
trait ARBPaymentGatewayTrait
{

    protected $AES_IV = "PGKEYENCDECIVSPC"; //For Encryption/Decryption
    protected $AES_METHOD = "AES-256-CBC";

    public function __construct()
    {
//        $this->init_form_fields();
        $this->gateway_url = 'https://securepayments.alrajhibank.com.sa/pg/payment/hosted.htm';
        $this->response_url = 'https://localhost/muamlah-4/payment-rag';
        $this->error_url = 'https://localhost/muamlah-4/payment-rag';
        $this->tranportalid = '17Prv63O4LscsAK';
        $this->tranportalpassword = '02@bTdG4$2FtiR!';
        $this->termresourcekey = '11301926592711301926592711301926';
        $this->encryption = "aes"; // || "TDES"
    }


    /**
     * @param $amount
     * @param $order_id
     * @param $type
     * @return bool|string
     */
    public function ARBCheckout($amount, $order_id, $type)
    {
        $responseURL=route('rajhiBank.response',['id'=>$order_id,'type'=>$type]);
        $data2 = '[{
            "amt":"'.number_format($amount, 2, '.', '').'",
            "action":"1",
            "password":"' . $this->tranportalpassword . '",
            "id":"' . $this->tranportalid . '",
            "currencyCode":"682",
            "udf1":"'.$type.'",
            ”udf3”:”iframe”,
            "langid":"ar",
            "trackId":"'.$order_id.time().'",
            "responseURL":"'.$responseURL.'",
            "errorURL":"'.$responseURL.'"}]';
        $trandata = $this->encryptAES($data2, $this->termresourcekey);
        $data = '[{"id":"17Prv63O4LscsAK","trandata":"' . $trandata . '","responseURL":"'.$responseURL.'","errorURL":"'.$responseURL.'"}]';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->gateway_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    /**
     * @param $amount
     * @param $order_id
     * @param $type
     * @return bool|string
     */
    public function ARBPayout($amount, $order_id, $type)
    {
        $successResponseURL=route('admin.rajhiBank.success_payout_response',['id'=>$order_id,'type'=>$type]);
        $errorResponseURL=route('admin.rajhiBank.error_payout_response',['id'=>$order_id,'type'=>$type]);
        $data2 = '[{
            "amt":"'.number_format($amount, 2, '.', '').'",
            "action":"1",
            "password":"02@bTdG4$2FtiR!",
            "id":"17Prv63O4LscsAK",
            "currencyCode":"682",
            "udf1":"'.$type.'",
            "langid":"ar",
            "trackId":"'.$order_id.time().'",
            "responseURL":"'.$successResponseURL.'",
            "errorURL":"'.$errorResponseURL.'",
            "accountDetails":[{"bankIdCode":"12345d6f","iBanNum": "567896743281926354276254",
"benificiaryName":"AlRajhi Bank Services",
"serviceAmount":"'.number_format($amount, 2, '.', '').'","valueDate":"20201231" }] }]';

        $trandata = $this->encryptAES($data2, '11301926592711301926592711301926');
        $data = '[{"id":"17Prv63O4LscsAK","trandata":"' . $trandata . '","responseURL":"'.$successResponseURL.'","errorURL":"'.$errorResponseURL.'"}]';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://securepayments.alrajhibank.com.sa/pg/payment/hosted.htm');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }




    /* AES IV 256 Bit  Encryption/Decryption Methods */
    function encryptAES($str, $key)
    {
        $str = $this->pkcs5_pad($str);
        $encrypted = openssl_encrypt($str, $this->AES_METHOD, $key, OPENSSL_ZERO_PADDING, $this->AES_IV);
        $encrypted = base64_decode($encrypted);
        $encrypted = unpack('C*', ($encrypted));
        $encrypted = $this->byteArray2Hex($encrypted);
        $encrypted = urlencode($encrypted);
        return $encrypted;
    }

    function decryptAES($code, $key)
    {
        $code = $this->hex2ByteArray(trim($code));
        $code = $this->byteArray2String($code);
        $code = base64_encode($code);
        $decrypted = openssl_decrypt($code, $this->AES_METHOD, $key, OPENSSL_ZERO_PADDING, $this->AES_IV);
        return $this->pkcs5_unpad($decrypted);
    }

    function pkcs5_pad($text)
    {
        $blocksize = openssl_cipher_iv_length($this->AES_METHOD);
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    function pkcs5_unpad($text)
    {
        $pad = ord($text[strlen($text) - 1]);
        if ($pad > strlen($text)) {
            return false;
        }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
            return false;
        }
        return substr($text, 0, -1 * $pad);
    }

    function byteArray2Hex($byteArray)
    {
        $chars = array_map("chr", $byteArray);
        $bin = join($chars);
        return bin2hex($bin);
    }

    function hex2ByteArray($hexString)
    {
        $string = hex2bin($hexString);
        return unpack('C*', $string);
    }

    function byteArray2String($byteArray)
    {
        $chars = array_map("chr", $byteArray);
        return join($chars);
    }

    function encryptTDES($payload, $key)
    {
        $chiper = "DES-EDE3-CBC";  //Algorthim used to encrypt
        if ((strlen($payload) % 8) != 0) {
            //Perform right padding
            $payload = $this->rightPadZeros($payload);
        }
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($chiper));
        $encrypted = openssl_encrypt($payload, $chiper, $key, OPENSSL_RAW_DATA, $iv);

        $encrypted = unpack('C*', ($encrypted));
        $encrypted = $this->byteArray2Hex($encrypted);
        return strtoupper($encrypted);
    }

    function decryptTDES($data, $key)
    {
        $chiper = "DES-EDE3-CBC";  //Algorthim used to decrypt
        $data = $this->hex2ByteArray($data);
        $data = $this->byteArray2String($data);
        $data = base64_encode($data);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($chiper));
        $decrypted = openssl_decrypt($data, $chiper, $key, OPENSSL_ZERO_PADDING, $iv);
        return $decrypted;
    }

    function rightPadZeros($Str)
    {
        if (null == $Str) {
            return null;
        }
        $PadStr = $Str;

        for ($i = strlen($Str); ($i % 8) != 0; $i++) {
            $PadStr .= "^";
        }
        return $PadStr;
    }
}
