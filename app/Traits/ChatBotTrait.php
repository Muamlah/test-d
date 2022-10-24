<?php

namespace App\Traits;

use App\Models\{PublicOrder, PublicOrderOffer, PrivateOrder, eservices_orders, User, eservice, CouponInstance, Coupon, Message, Fees};
use App\Traits\{FeesTrait, CommonTrait, PaymentGatewayTrait, GrupoTrait, SMSTrait, UserLogTreat};
use App\Notifications\{StatusUpdatePublicOrderNotify, FinishPublicOrderNotify, NewMessageNotify, SendEmailToAdmins, ChangeStatusNotify, StatusUpdatePrivateOrderNotify, SendReceiptCodePrivateOrderNotify, ReceivePublicOrderNotify};
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

use DB;
/**
 * Trait GrupoTrait
 * @package App\Traits
 */
trait ChatBotTrait
{
    use FeesTrait;
    use GrupoTrait;
    use PaymentGatewayTrait;
    use CommonTrait;
    use UserLogTreat;

//    ارسال رسالة الى المستخدم
    /**
     * @param $number
     * @param $msg
     * @throws GuzzleException
     */
    public function send_message($number, $msg){

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

    }

    /**
     * $order_type = eservice | public | private
     * $status = 1:complete | 2:cancel | 3:report
     */
    public function bot_change_order_status($order_id = null, $user_id = null, $status = 1, $order_type = 'eservices', $message= "", $deserved_price = 0){
        $user = User::find($user_id);

        if($user){
            switch ($order_type) {
                case 'eservices':
                    return $this->bot_change_eservices_order_status($order_id, $user, $status, $message);
                    break;
                case 'private':
                    return $this->bot_change_privte_order_status($order_id, $user, $status, $message, $deserved_price);
                    break;
                case 'public':
                    return $this->bot_change_public_order_status($order_id, $user, $status, $message, $deserved_price);
                    break;
                default: return static::sendResponse(false, "fail", []);
                    break;
            }
        }else{
            return static::sendResponse(false, "fail", []);
        }
    }

    public function bot_change_eservices_order_status($order_id, $user, $status, $message){

        switch($status){
            case 1:
                if($user->level == "provider"){
                    $status = '4';
                }else{
                    $status = '5';
                }
            break;
            case 2:
                $status = '7';
            break;
            case 3:
                $status = '8';
            break;
        }
        $item = eservices_orders::where('id', $order_id)->first();
        $notify_user = !is_null($item->agent_id) ? $item->agent : $user;

        if (!$item) {
            return static::sendResponse(false, "الطلب غير موجود", []);
        }
        if (!$item->chechAvailableStatus($status)) {
            return static::sendResponse(false, "لايمكنك تغيير حالة هذه الخدمة للحالة المختارة", []);
        }
        if ($item->status == '8') {
            return static::sendResponse(false, "لايمكنك تغيير حالة هذه الخدمة لأنه يوجد بلاغ", []);
        }
        $provider = User::find($item->provider_id);
        if ($status == '5') {
            $phone = $user->phone;

            if (!is_null($item->payment_status)) {
                $this->newTransaction($item->user_id, $item->total_amount, $item->id, 'electronic', 'withdrawal', "سحب رصيد الخدمة الإلكترونية  رقم $item->id ");
            }
            $amount = ($item->price - ($item->provider_value_added_tax + $item->provider_fees));
            $this->newTransaction($provider->id, $amount, $item->id, 'electronic', 'deposit', "ايداع رصيد  الخدمة الإلكترونية  رقم $item->id ");
            $this->userBalanceDiscount($user, $item->total_amount);
            $this->providerBalance($provider, $amount);
            $this->walletMuamlah(($item->value_added_tax + $item->fees + $item->provider_value_added_tax + $item->provider_fees), $item->price, $item->id, 'electronic', 'deposit', 'ايداع عمولة طلب خدمة الكترونية');
            $item->status = '5';
            $item->verify = true;
            $item->update();
            $instance = $item->coupone_instance;
            if (!is_null($instance) && $instance->owner_discount != 0) {
                $this->newTransaction($instance->owner_id, $instance->owner_discount, $instance->id, 'gift', 'deposit', ' تم شحن الرصيد باستخدام كود الحسم' . $instance->code . 'للطلب رقم: ' . $item->id);
                $this->walletMuamlah($instance->owner_discount, $item->price, $item->id, 'electronic', 'withdrawal', 'سحب عمولة كوبون طلب الخدمة الإلكترونية');
                $this->providerBalance($instance->owner, $instance->owner_discount);


            }
            if (!empty($item->reference_code) && $item->owner_discount != 0) {
                $owner_reference_code = User::where('reference_code', $item->reference_code)->first();
                $this->newTransaction($owner_reference_code->id, $item->owner_discount, $item->id, 'private', 'deposit', ' تم شحن الرصيد باستخدام كود الحسم' . $item->reference_code . 'للطلب رقم: ' . $item->id);
                $this->walletMuamlah($item->owner_discount, $item->price, $item->id, 'private', 'withdrawal', " سحب عمولة كود  للخدمة الإلكترونية رقم:$item->id ");
                $this->providerBalance($owner_reference_code, $item->owner_discount);

            }
            if (!is_null($agent = $item->agent)) {
                $this->newTransaction($agent->id, $item->agent_per, $item->id, 'gift', 'deposit', " ايداع رصيد عمولة الخدمة الإلكترونية  رقم $item->id");
                $this->providerBalance($agent, $item->agent_per);

            }
            Notification::send($notify_user, new ChangeStatusNotify($item, '5', 'eservices_orders/show/' . $item->id . ''));
            Notification::send($provider, new ChangeStatusNotify($item, '5', 'eservices_orders/myservice_details/' . $item->id . ''));

            return static::sendResponse(true, "success", []);
        }elseif($status == "4"){
            Notification::send($notify_user, new ChangeStatusNotify($item, '4', 'eservices_orders/show/' . $item->id . ''));
            Notification::send($provider, new ChangeStatusNotify($item, '4', 'eservices_orders/myservice_details/' . $item->id . ''));
            $item->status = '4';
            $item->save();
            return static::sendResponse(true, "success", []);

        }elseif($status == "7"){
            $item->status = "7" ;
            $item->verify = true;
            $fees = Fees::first();
            $this->userBalance($user, false, $item->total_amount, $fees->service_cancellation);
            $this->walletMuamlah($fees->service_cancellation, $item->price, $item->id, 'electronic', 'deposit', 'رسوم الغاء خدمة اكترونية');
            // send notification to user
            if ($user->level == 'user') {
                Notification::send($notify_user, new ChangeStatusNotify($item, '6', 'eservices_orders/show/' . $item->id . ''));
            }
            $item->update();
            return static::sendResponse(true, "success", []);
        }elseif ($status == '8') {
            $provider = User::find($item->provider_id);

            Notification::send($notify_user, new ChangeStatusNotify($item, '8', 'eservices_orders/show/' . $item->id . ''));
            if (!empty($provider)) {
                Notification::send($provider, new ChangeStatusNotify($item, '8', 'eservices_orders/myservice_details/' . $item->id . ''));
            }
            $item->status = $status;
            $item->save();
            $chat_message = new Message();
            $chat_message->user_id = $user ? $user->id : NULL;
            $chat_message->name = $user->name;
            $chat_message->subject = 'إبلاغ على طلب خدمة إلكترونية رقم :' . $item->id;
            $chat_message->email = $user->email;
            $chat_message->message = $message;
            $chat_message->entity_id = $item->id;
            $chat_message->entity_type = eservices_orders::class;
            $chat_message->save();
            return static::sendResponse(true, "success", []);

        }
        return static::sendResponse(false, "status_not_support", []);
    }

    public function bot_change_public_order_status($order_id, $user, $status, $message, $deserved_price = 0){
        switch($status){
            case 1:
                if($user->level == "provider"){
                    $status = '4';
                }else{
                    $status = '5';
                }
            break;
            case 2:
                $status = '7';
            break;
            case 3:
                $status = '8';
            break;
        }

        $item = PublicOrder::where('id', $order_id)->first();
        $notify_user = !is_null($item->agent_id) ? $item->agent : $user;
        if (!$item) {
            return static::sendResponse(false, "الطلب غير موجود", []);
        }
        if (!$item->chechAvailableStatus($status)) {
            return static::sendResponse(false, "لايمكنك تغيير حالة هذه الخدمة للحالة المختارة", []);
        }
        if ($item->status == '8') {
            return static::sendResponse(false, "لايمكنك تغيير حالة هذه الخدمة لأنه يوجد بلاغ", []);
        }
        if ($item->status == '9') {
            return static::sendResponse(false, "لايمكنك تغيير حالة هذا الطلب لأنه غير موافق عليه", []);
        }
        $provider = User::find($item->provider_id);
        $phone = $user->phone;
        if($status == "5"){

            DB::beginTransaction();
            $data = PublicOrder::where('master_order', $item->master_order)->get();
            foreach ($data as $key => $value) {
                $order_provider = User::where('id', $value->provider_id)->first();
                $order_user     = User::find($value->user_id);
                $amount = $value->payable_service_provider;
                if ($value->parent_order == 0) {
                    $total_amount = $value->payable_service_provider + $item->provider_value_added_tax + $item->provider_fees + $item->value_added_tax + $item->fees + $item->agent_per;
                } else {
                    $total_amount = $value->payable_service_provider;
                }
                if(!is_null($value->payment_status)){
                    $this->newTransaction($value->user_id, $total_amount, $value->id, 'public', 'withdrawal', "سحب رصيد تعميد عام رقم $value->id ");
                }
                if ($value->parent_order == 0) {
                    $this->userBalanceDiscount($user, $total_amount - $item->agent_per);
                    if ($value->total_amount - $total_amount != 0) {
                        $this->newTransaction($user->id, ($value->total_amount - $total_amount), $item->id, 'public', 'deposit', " استرجاع مبلغ من  تعميد عام  رقم $item->id");
                        $this->ReturnRestToBalance($user, ($value->total_amount - $total_amount));
                    }
                } else {
                    $this->providerBalanceDiscount($order_user, $total_amount);
                }
                $this->newTransaction($order_provider->id, $amount, $value->id, 'public', 'deposit', "ايداع رصيد تعميد عام رقم $value->id ");
                $this->providerBalance($order_provider, $amount);
            }
            $this->walletMuamlah(($item->provider_value_added_tax + $item->provider_fees + $item->fees +$item->value_added_tax ), $item->price, $item->id, 'public', 'deposit', "ايداع عمولة تعميد عام رقم $item->id ");
            PublicOrder::where('master_order', $item->master_order)->update(['status' => 5, 'verify' => 'yes']);
            $instance = $item->coupone_instance;
            if(!is_null($instance) && $instance->owner_discount != 0){
                $this->newTransaction($instance->owner_id, $instance->owner_discount, $instance->id, 'gift', 'deposit', " تم شحن الرصيد باستخدام كود الحسم" . $instance->code ."للطلب رقم: " .  $item->id);
                $this->walletMuamlah($instance->owner_discount, $item->price, $item->id, 'private', 'withdrawal', "سحب عمولة كوبون على تعميد عام رقم $item->id ");
                $this->providerBalance($instance->owner,$instance->owner_discount);
            }
            if(!is_null($agent = $item->agent)){
                $this->newTransaction($agent->id, $item->agent_per, $item->id, 'gift', 'deposit', " ايداع  عمولة  تعميد عام  رقم $item->id");
                $this->providerBalance($agent,$item->agent_per);
                $this->userBalanceDiscount($user,  $item->agent_per);
                $this->newTransaction($user->id, $item->agent_per, $item->id, 'gift', 'withdrawal', " سحب عمولة وكيل  تعميد عام رقم $item->id");
            }
            Notification::send($order_provider, new FinishPublicOrderNotify($item));
            DB::commit();
            return static::sendResponse(true, "success", []);

        }else if($status == "4"){
            DB::beginTransaction();
            $fees = $this->CalculatePublicOrderFees($deserved_price);
            if( $item->followingOrdersCount() == 1) {
                $price = $item->price;
            } else{
                $price = $item->payable_service_provider;
            }
            if($price == $deserved_price){
                $item->payable_service_provider=round((double)$deserved_price - (double)$fees['offer_fee'] - (double)$fees['offer_added_tax']  , 2);
                $item->update();
            }elseif($price > $deserved_price){
                $offer = PublicOrderOffer::where('order_id', $item->master_order)->where('user_id', $item->provider_id)->first();
                $fee = [
                    'fee' =>  round($fees['offer_fee'] , 2) ,
                    'tax_amount' => round($fees['offer_added_tax'] , 2) ,
                    'deserved_price' => round((double)$deserved_price - (double)$fees['offer_fee'] - (double)$fees['offer_added_tax']  , 2),
                ];

                if (!is_null($offer)) {
                    $payable_service_provider     = $fee['deserved_price'];
                    $provider_fees                = $fee['fee'];
                    $provider_value_added_tax     =$fees['offer_added_tax'];
                    $offer->price=$deserved_price;
                    $offer->fees=$fee['fee'];
                    $offer->tax_amount=$fee['tax_amount'];
                    $offer->deserved_price=$fee['deserved_price'];
                    $offer->value_added_tax=$fees['offer_added_tax'];
                    $offer->save();
                }else{
                    $payable_service_provider     = $deserved_price;
                    $provider_fees                = 0;
                    $provider_value_added_tax     = 0;
                }
                $total_amount = $fees['order_fee'] + $fees['order_added_tax'] + (double)  $deserved_price;
                $item->update([
                    'fees' => $fees['order_fee'],
                    'value_added_tax' => $fees['order_added_tax'],
                    'deserved_price' =>  $total_amount,
                    'provider_fees' =>  $provider_fees,
                    'payable_service_provider' =>  $payable_service_provider,
                    'provider_value_added_tax' =>  $provider_value_added_tax,
                ]);
                if(!empty($item->agent_id))
                {
                    $item->agent_per = $this->calculateAgentAmount($total_amount);
                    $item->save();
                }
                DB::commit();
            }else{
                return static::sendResponse(false, "الرقم المدخل يجب أن يكون أقل أو يساوي قيمة العرض", []);
            }

            $all_orders = PublicOrder::whereIn('id',[$item->id,$item->master_order]);
            $all_orders->update(['status' => 4]);

            Notification::send($notify_user, new ReceivePublicOrderNotify($item));
            return static::sendResponse(true, "success", []);

        }else if($status == "7"){
            DB::beginTransaction();
            PublicOrder::where('master_order', $item->master_order)->update(['status' => 7, 'cancellation' => 'user', 'verify' => 'yes']);

            $fees = Fees::first();
            $this->userBalance($user, false, $item->total_amount, $fees->service_cancellation);
            $this->newTransaction($user->id, ($item->total_amount - $fees->service_cancellation), $item->id, 'public', 'deposit', "ايداع رصيد الغاء تعميد عام رقم $item->id ");
            $this->walletMuamlah($fees->service_cancellation, $item->price, $item->id, 'public', 'deposit', "رسوم الغاء طلب تعميد عام رقم $item->id");
            $data = [
                'message' => "تم تاكيد الغاء  طلب التعميد العام رقم $item->id من طرف العميل ",
                'link' => route('publicService.show', $item->id),
            ];
            Notification::send($provider, new StatusUpdatePublicOrderNotify($item, $data));
            DB::commit();
            return static::sendResponse(true, "success", []);

        }else if($status == "8"){
            DB::beginTransaction();
            $item->status = 8;
            $item->update();
            $chat_message = new Message();
            $chat_message->user_id = $user ? $user->id : NULL;
            $chat_message->name = $user->getName();
            $chat_message->subject = "إبلاغ على طلب التعمبد العام رقم :".$item->id;
            $chat_message->email = $user->email;
            $chat_message->message = $message;
            $chat_message->entity_id = $item->id;
            $chat_message->entity_type = PublicOrder::class;
            $chat_message->save();
            $data = [
                'message' => "تم فتح نزاع  لطلب التعميد العام رقم #".$item->id,
                'link' => route('publicOrders.showDetails', $item->id),
            ];
            Notification::send([$item->provider,$notify_user], new StatusUpdatePublicOrderNotify($item, $data));
            DB::commit();
            return static::sendResponse(true, "success", []);

        }
        return static::sendResponse(false, "status_not_support", []);
    }
    public function bot_change_privte_order_status($order_id, $user, $status, $message, $deserved_price){
        $notify_user = $user;
        switch($status){
            case 1:
                if($user->level == "provider"){
                    $status = '4';
                }else{
                    $status = '5';
                }
            break;
            case 2:
                $status = '7';
            break;
            case 3:
                $status = '8';
            break;
        }
        $item = PrivateOrder::where('id', $order_id)->first();
        if (!$item) {
            return static::sendResponse(false, "الطلب غير موجود", []);
        }
        if (!$item->chechAvailableStatus($status)) {
            return static::sendResponse(false, "لايمكنك تغيير حالة هذه الخدمة للحالة المختارة", []);
        }
        if ($item->status == '8') {
            return static::sendResponse(false, "لايمكنك تغيير حالة هذه الخدمة لأنه يوجد بلاغ", []);
        }
        $provider = User::find($item->provider_id);
        $phone = $user->phone;
        if($status == "5"){
            DB::beginTransaction();
            $offerData = [
                'message' => "تم استلام  طلب التعميد خاص رقم $item->id من طرف العميل ",
                'link' => route('privateService.show', $item->id),
            ];
            Notification::send($provider, new StatusUpdatePrivateOrderNotify($item, $offerData));
            $data = PrivateOrder::where('master_order', $item->master_order)->get();
            foreach ($data as $key => $value) {
                // $order_provider = User::where('phone', $value->service_provider_phone)->first();
                $order_provider = User::where('id', $value->provider_id)->first();
                $order_user     = User::find($value->user_id);
                $amount = $value->payable_service_provider;
                if ($value->parent_order == 0) {
                    $total_amount = $value->payable_service_provider + ($item->provider_value_added_tax + $item->provider_fees);
                } else {
                    $total_amount = $value->payable_service_provider;
                }
                $total_amount += $value->agent_per;
                if(!is_null($value->payment_status)){
                    $this->newTransaction($value->user_id, $total_amount, $value->id, 'private', 'withdrawal', "سحب رسوم تعميد خاص رقم $value->id ");
                }
                if ($value->parent_order == 0) {
                    $this->userBalanceDiscount($user, $total_amount);
                     if ($value->total_amount - $total_amount != 0) {
                         $this->ReturnRestToBalance($user, ($value->total_amount - $total_amount));
                         $this->newTransaction($user->id, ($value->total_amount - $total_amount), $item->id, 'private', 'deposit', " ايداع رصيد فرق  تعميد خاص  رقم $item->id");
                     }
                } else {
                    $this->providerBalanceDiscount($order_user, $total_amount);
                }
                $this->newTransaction($order_provider->id, $amount, $value->id, 'private', 'deposit', "ايداع رصيد تعميد رقم $value->id ");
                $this->providerBalance($order_provider, $amount);
            }
            $this->walletMuamlah(($item->provider_value_added_tax + $item->provider_fees), $item->price, $item->id, 'private', 'deposit', "ايداع عمولة تعميد رقم $item->id ");
            // PrivateOrder::where('master_order', $item->master_order)->update(['status' => 'confirm_completed', 'verify' => 'yes']);
            PrivateOrder::where('master_order', $item->master_order)->update(['status_id' => 5, 'verify' => 'yes']);
            DB::commit();
            $instance = $item->coupone_instance;
            if(!is_null($instance) && $instance->owner_discount != 0){
                $this->newTransaction($instance->owner_id, $instance->owner_discount, $instance->id, 'gift', 'deposit', " تم شحن الرصيد باستخدام كود الحسم" . $instance->code ."للطلب رقم: " .  $item->id);
                $this->walletMuamlah($instance->owner_discount, $item->price, $item->id, 'private', 'withdrawal', "سحب عمولة كوبون على تعميد خاص رقم $item->id ");
                $this->providerBalance($instance->owner,$instance->owner_discount);
            }
            if(!is_null($agent = $item->agent)){
                $this->newTransaction($agent->id, $item->agent_per, $item->id, 'gift', 'deposit'," ايداع رصيد عمولة طلب تعميد خاص  رقم $item->id");
                $this->providerBalance($agent,$item->agent_per);

            }
            return static::sendResponse(true, "success", []);

        }else if($status == "4"){
            $id = $item->id;
            $fees = $this->CalculateFees($deserved_price);
            $has_coupon = false;
            $coupon_discount = 0;
            if (!is_null($instance = $item->coupone_instance)) {
                $coupon = Coupon::where('type', 'coupon')->where('id', $instance->coupon_id)->first();
                $has_coupon = true;
                $coupon_discount = $this->calculateDiscount($coupon, $fees['fee']);
                $provider_discount = $this->calculateOwnerDiscount($coupon, $fees['fee']);
                $instance = CouponInstance::update_instance($instance, $coupon, $coupon_discount, $provider_discount);
                $fees['fee'] = $fees['fee'] - $coupon_discount;

            }
            $total_amount = (($fees['value_added_tax'] / 100) * $fees['fee']) + $deserved_price + $fees['fee'];
            $item->payable_service_provider = $deserved_price;
            $item->provider_fees = $fees['fee'];
            $item->provider_value_added_tax = (($fees['value_added_tax'] / 100) * $fees['fee']);
            $item->update();
            if (!empty($item->agent_id)) {
                $item->agent_per = $this->calculateAgentAmount($total_amount);
                $item->save();
            }
            $orders = PrivateOrder::where('master_order', $item->master_order)->where('parent_order', '!=', 0)->where('id', '!=', $id);
            // $orders->update(['status' => 'confirm_completed', 'verify' => 'yes']);
            $orders->update(['status_id' => 4, 'verify' => 'yes']);
            $all_orders = PrivateOrder::whereIn('id', [$id, $item->master_order]);
            // $all_orders->update(['status' => 'completed']);
            $all_orders->update(['status_id' => 4]);
            $offerData = [
                'message' => "تم تسليم  طلب التعميد خاص رقم $item->master_order من طرف مقدم الخدمة ",
                'link' => route('privateOrder.show', $item->master_order),
            ];

            Notification::send($notify_user, new StatusUpdatePrivateOrderNotify($item, $offerData));
            return static::sendResponse(true, "success", []);

        }else if($status == "7"){
            DB::beginTransaction();
            $fees = Fees::first();
            $this->userBalance($user, false, $item->total_amount, $fees->service_cancellation);
            $this->newTransaction($user->id, ($item->total_amount - $fees->service_cancellation), $item->id, 'private', 'deposit', "ايداع رصيد الغاء تعميد رقم $item->id ");
            $this->walletMuamlah($fees->service_cancellation, $item->price, $item->id, 'private', 'deposit', "رسوم الغاء طلب تعميد رقم $item->id");

            $data = [
                'message' => "تم تاكيد الغاء  طلب التعميد خاص رقم $item->id من طرف العميل ",
                'link' => route('privateService.show', $item->id),
            ];
            Notification::send($provider, new StatusUpdatePrivateOrderNotify($item, $data));
            PrivateOrder::where('master_order', $item->master_order)->update(['status_id' => 8, 'verify' => 'yes']);
            DB::commit();
            return static::sendResponse(true, "success", []);
        }else if($status == "8"){
            $item->status_id   = 8;
            $item->update();
            $chat_message = new Message;
            $chat_message->user_id = $user ? $user->id : NULL;
            $chat_message->name = $user->name;
            $chat_message->subject = "إبلاغ على طلب تعميد خاص رقم :".$item->id;
            $chat_message->email = $user->email;
            $chat_message->message = $message;
            $chat_message->entity_id = $item->id;
            $chat_message->entity_type = PrivateOrder::class;
            $chat_message->save();
            $data = [
                'message' => "تم الإبلاغ على  طلب التعميد الخاص رقم $item->id ",
                'link' => route('privateService.show', $item->id),
            ];
            Notification::send($provider, new StatusUpdatePrivateOrderNotify($item, $data));
            return static::sendResponse(true, "success", []);
        }
        return static::sendResponse(false, "status_not_support", []);
    }


    static public function sendResponse($status, $message, $data = []){
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }
}
