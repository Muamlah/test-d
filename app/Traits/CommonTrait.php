<?php

namespace App\Traits;

use App\Models\Fees;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Log;
use App\Models\WalletMuamlah;
use App\Traits\SMSTrait;
use GuzzleHttp\Exception\GuzzleException;
use App\Models\{eservices,PublicOrder,PrivateOrder};
/**
 * Trait GrupoTrait
 * @package App\Traits
 */
trait CommonTrait
{
    use SMSTrait;
    //انشاء مستخدم جديد مع ارسال رسالة له وانشاء اسم مستخدم جدسد على نظام غروبو
    /**
     * @param string $phone
     * @param string $level
     * @param float $price
     * @param false $sendSMS
     */

    public function checkUserBalance($user){

        $sub = $user->available_balance + $user->pinding_balance;

        if( floor($user->total_balance) < 0 ||  floor($user->available_balance) < 0 ||  floor($user->pinding_balance) < 0 || floor($sub) != floor( $user->total_balance)){
            return false;
        }
        return true;

    }
    public function checkUserBalancewithdrawal($user){
        if($user->publicOrdersReport->isNotEmpty() || $user->privateOrdersReport->isNotEmpty() || $user->eservicesOrdersReport->isNotEmpty())
        {
            return false;
        }
        return true;
    }
    public function addLog($action,$description){

        $admin              = auth()->guard('admin')->user();

        $log                = new Log();
        $log->admin_id      = $admin->id;
        $log->admin_name    = $admin->name;
        $log->admin_email   = $admin->email;
        $log->action        = $action;
        $log->description   = $description;
        $log->save();

    }

    public function newUser(string $phone, string $level, float $price, bool $sendSMS = false)
    {
        $password = rand(100000, 999999);
        $newUser = new User();
        $newUser->phone = $phone;
        $newUser->level = $level;
        $newUser->active = 0;
        $newUser->verification_code = rand(1000, 9999);
        $newUser->password = bcrypt($password);
        $newUser->save();
        $this->createUser($phone, $password);
        if ($sendSMS) {
            $url = 'https://app.muamlah.com/phone/verify';
            $msg = "عزيزي مقدم الخدمة" . "\n" . "لديك طلب تعميد بقيمة #" . " " . $price . "ر.س" . "\n" .
                " اذا لم تكن مسجل يمكنك استخدام الرمز لتفعيل حسابك تلقائيا على الرابط التالي" . " " . $url . "\n" . "رمز التفعيل :" . $newUser->verification_code . "\n" .
                "كلمة المرور :" . $password;

            $this->sendSMS($phone, $msg);
        }
    }

    /**
     * @param string $phone
     * @param string $level
     * @param float $price
     * @param bool $sendSMS
     * @return User
     * @throws GuzzleException
     */
    public function addNewUser(string $phone, string $level, float $price, bool $sendSMS = false): User
    {
        $password = rand(100000, 999999);
        $newUser = new User();
        $newUser->phone = $phone;
        $newUser->level = $level;
        $newUser->active = 0;
        $newUser->verification_code = rand(1000, 9999);
        $newUser->password = bcrypt($password);
        $newUser->save();
        if ($sendSMS) {
            $url = 'https://app.muamlah.com/phone/verify';
            $msg = "عزيزي مقدم الخدمة" . "\n" . "لديك طلب تعميد بقيمة #" . " " . $price . "ر.س" . "\n" .
                " اذا لم تكن مسجل يمكنك استخدام الرمز لتفعيل حسابك تلقائيا على الرابط التالي" . " " . $url . "\n" . "رمز التفعيل :" . $newUser->verification_code . "\n" .
                "كلمة المرور :" . $password;

            $this->sendSMS($phone, $msg);
        }
        return $newUser;
    }

    /**
     * @param User $user
     * @param bool $type //true  ايداع of false  ارجاع
     * @param float $amount
     * @param float $service_cancellation
     */
    public function userBalance(User $user, bool $type,  float $amount,  float $service_cancellation = 0)
    {
        if ($type) {
            $user->pinding_balance = $user->pinding_balance + $amount;
            $user->total_balance = $user->total_balance + $amount;
            $user->update();

        } else {
            $user->pinding_balance = $user->pinding_balance - $amount;
            $user->available_balance = $user->available_balance + $amount - $service_cancellation;
            $user->total_balance = $user->total_balance - $service_cancellation;
            $user->update();
        }
    }

    /**
     * @param User $user
     * @param float $amount
     */
    public function userBalanceDiscount (User $user, float $amount )
    {
            $user->pinding_balance = $user->pinding_balance - $amount;
            $user->total_balance = $user->total_balance - $amount;
//            echo $user . " userBalanceDiscount  <br>";
            $user->update();

    }
    /**
     * @param User $provider
     * @param float $amount
     */
    public function providerBalanceDiscount (User $provider, float $amount )
    {
        $provider->available_balance = $provider->available_balance - $amount;
        $provider->total_balance = $provider->total_balance - $amount;
//            echo $provider . " providerBalanceDiscount <br>";
        $provider->update();

    }
   /**
     * @param User $user
     * @param float $amount
     */
    public function ReturnRestToBalance (User $user, float $amount )
    {
            $user->pinding_balance = $user->pinding_balance - $amount;
            $user->available_balance = $user->available_balance + $amount;
            $user->update();
    }
    /**
     * @param User $user
     * @param float $amount
     */
    public function providerReturnRestToBalance (User $user, float $amount )
    {
            $user->available_balance = $user->available_balance + $amount;
            $user->total_balance = $user->total_balance + $amount;
            $user->update();

    }


    /**
     * @param User $user
     * @param float $amount
     */
    public function WithdrawingFromBalance(User $user, float $amount)
    {

        if ($user->available_balance - $amount < 0) {
            $user->pinding_balance = $user->available_balance + $user->pinding_balance  ;
            $user->available_balance = 0;

        } else {
            $user->pinding_balance = $user->pinding_balance + $amount;
            $user->available_balance = $user->available_balance - $amount;
        }
        $user->update();
    }


    /**
     * @param User $provider
     * @param float $amount
     */
    public function providerBalance(User $provider, float $amount)
    {
        $provider->available_balance = $provider->available_balance + $amount;
        $provider->total_balance = $provider->total_balance + $amount;
        $provider->update();
    }

//عملية تحويل جديدة

    /**
     * @param int $user_id
     * @param float $amount
     * @param int $order_id
     * @param string|null $order_type
     * @param string $type
     * @param string $description
     */
    public function newTransaction(int $user_id, float $amount, int $order_id, string $order_type, string $type, string $description)
    {
        if ($amount!=0) {
        $transaction = new Transaction();
        $transaction->user_id = $user_id;
        $transaction->amount = $amount;
        $transaction->type = $type;
        $transaction->order_id = $order_id;
        $transaction->order_type = $order_type;
        $transaction->description = $description;
        $transaction->save();
        }
    }

    /**
     * @param float $balance
     * @param float $amount
     * @param int $order_id
     * @param string $order_type
     * @param string $type
     * @param string $description
     */
    public function walletMuamlah(float $balance, float $amount, int $order_id, string $order_type, string $type, string $description)
    {
        if ($amount!=0) {
        $wallet_muamlah = new WalletMuamlah();
        $wallet_muamlah->order_id = $order_id;
        $wallet_muamlah->order_type = $order_type;
        $wallet_muamlah->amount = $amount;
        $wallet_muamlah->balance = $balance;
        $wallet_muamlah->type = $type;
        $wallet_muamlah->description = $description;

            $wallet_muamlah->save();
        }

    }

    public function getQrCode($link, $file_name){
        $origin_path = '/qr_images/'.$file_name.'.png';
        $path = public_path() . $origin_path;
        if(file_exists($path)){
            return asset($origin_path);
        }
        try{
            $qr_link = 'https://api.qrserver.com/v1/create-qr-code?size=200x200&data='.$link;
            $arrContextOptions = array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
                'http' => array('user_agent' => 'muamlah')
            );
            $file = file_get_contents($qr_link,false,stream_context_create($arrContextOptions));
            if($file){
                $result = file_put_contents($path, $file);
                return asset($origin_path);
            }
            return "";
        }catch(\Exception $e){
            return "";
        }
    }

    public function couponValidation($coupon, $user){
        if(is_null($coupon)){
            return [
                'success' => false,
                'message' => 'كود الخصم غير صحيح'
            ];
        }
        $now = \Carbon\Carbon::now()->format('Y-m-d H-i-s');
        if($coupon->coupon > $now){
            return [
                'success' => false,
                'message' => 'انتهت صلاحية كود الخصم'
            ];
        }
        if($coupon->Instances()->count() >= $coupon->instances_count){
            return [
                'success' => false,
                'message' => 'كود الخصم لم تعد صالحة'
            ];
        }
        if($coupon->Instances()->where('user_id', $user->id)->where('code', $coupon->code)->count() >= $coupon->number_of_use){
            return [
                'success' => false,
                'message' => 'تجاوزت العدد المسموح للاستخدام كود الخصم '
            ];
        }
        return [
            'success' => true,
            'message' => 'البطاقة صالحة للإستخدام'
        ];
    }
    public function calculateDiscount($coupon, $value){
        $discount_type = $coupon->discount_type;
        $discount = $coupon->discount;
        $limit = $coupon->max_discount;

        if($discount_type == 'percentage')
        {
            $discountAmount = $value * ($discount / 100);
        }
        else // AMOUNT
        {
            $discountAmount = ($value - $discount);

        }

        if(!is_null($limit) && $discountAmount > $limit)
        {
            $discountAmount = $limit;
        }

        if(!is_null($limit) && $discountAmount > $value)
        {
            $discountAmount = $value;
        }

        $result = round($discountAmount, 1);

        if($result < 0)
        {
            $result = 0;
        }

        return $result;
    }
    public function calculateOwnerDiscount($coupon, $value){
        $discount_type = $coupon->discount_type;
        $discount = $coupon->owner_discount;
        if(is_null($discount) || $discount == 0) return 0;
        $limit = $coupon->max_discount;
        if($discount_type == 'percentage')
        {
            $discountAmount = $value * ($discount / 100);
        }
        else // AMOUNT
        {
            $discountAmount = ($value - $discount);

        }

        if(!is_null($limit) && $discountAmount > $limit)
        {
            $discountAmount = $limit;
        }

        if(!is_null($limit) && $discountAmount > $value)
        {
            $discountAmount = $value;
        }

        $result = round($discountAmount, 1);

        if($result < 0)
        {
            $result = 0;
        }

        return $result;
    }

    public function calculateReferenceCodeDiscount($owner_reference_code, $value){
        $settings = \App\Models\Settings::first();
        $discount_type = 'percentage';
        $owner_discount = $settings->reference_code_discount_for_owner;
        $user_discount = $settings->reference_code_discount_for_user;

        if($discount_type == 'percentage')
        {
            $ownerDiscountAmount = $value * ($owner_discount / 100);
            $userDiscountAmount = $value * ($user_discount / 100);
        }

        if($ownerDiscountAmount > $value)
        {
            $ownerDiscountAmount = $value;
        }

        $data['owner_discount'] = round($ownerDiscountAmount, 1);

        if($data['owner_discount'] < 0)
        {
            $data['owner_discount'] = 0;
        }

        //
        if($userDiscountAmount > $value)
        {
            $userDiscountAmount = $value;
        }

        $data['user_discount'] = round($userDiscountAmount, 1);

        if($data['user_discount'] < 0)
        {
            $data['user_discount'] = 0;
        }

        return $data;
    }
    public function calculateAgentAmount($value){
        $amount = 0;
        $settings = \App\Models\Settings::first();
        $discount_type = 'percentage';
        $percentage = $settings->agent_per;

        if($discount_type == 'percentage')
        {
            $amount = $value * ($percentage / 100);
        }
        if($amount < 0)
        {
            $amount = 0;
        }
        return $amount;
    }
}
