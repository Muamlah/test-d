<?php

namespace App\Traits;


/**
 * Trait PaymentGatewayTrait
 * @package App\Traits
 */
trait PaymentGatewayTrait
{


    /**
     * @return array
     */
    private function paymentGatewayInfo(): array
    {
        $info = [];
        $info['host'] = config('payment.production') ? config('payment.url') :  config('payment.test_url');
        $info['entityId'] = config('payment.production') ? config('payment.entity_id') :  config('payment.test_entity_id');
        $info['token'] = config('payment.production') ? config('payment.auth_key') :  config('payment.test_auth_key');
        $info['currency'] = 'SAR';
        $info['CURLOPT_SSL_VERIFYPEER'] = (config('payment.production')) ? true : false;
        return $info;
    }
    /**
     * جلب حالة الطلب
     * @param $id
     * @return mixed
     */
    private function getPaymentStatus($id)
    {
        $info = $this->paymentGatewayInfo();
        $url = $info['host'] . 'v1/checkouts/' . $id . '/payment';
        $url .= '?entityId=' . $info['entityId'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
            'Authorization: Bearer ' . $info['token'] . '']);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $info['CURLOPT_SSL_VERIFYPEER']);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return @json_decode($response, true);
    }


    /**
     * تجهيز البوابة لستقبال طلب
     * @param $amount //المبلغ
     * @param $order_id //رقم الطلب
     * @return mixed
     */
    private function paymentGatewayCheckout($amount, $order_id){
        $info = $this->paymentGatewayInfo();

        $url = $info['host'] . 'v1/checkouts';
        $data = [];
        $data['entityId'] = $info['entityId'];
        $data['amount'] = number_format($amount, 2, '.', '');
        $data['currency'] = $info['currency'];
        $data['paymentType'] = 'DB';
        $data['merchantTransactionId'] = '#' . $order_id;

        if ( !config('payment.production')) {
            $data['testMode'] = 'EXTERNAL';
        }

        $data = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
            'Authorization: Bearer ' . $info['token'] . '']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $info['CURLOPT_SSL_VERIFYPEER']);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return @json_decode($response, true);
    }

}
