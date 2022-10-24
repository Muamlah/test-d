<?php

namespace App\Http\Controllers\Website;

use App\Models\Admin;
use App\Models\Coupon;
use App\Models\CouponInstance;
use App\Models\PrivateOrder;
use App\Models\PublicOrder;
use App\Models\eservices_orders;
//use App\Models\Transaction;
use App\Models\User;
use App\Notifications\EditPrivateOrderNotify;
use App\Notifications\PrivateOrderNotify;
use App\Notifications\PublicOrderOfferNotify;
use App\Notifications\PayEserviceNotify;
use App\Notifications\PublicOrderProviderNotify;
use App\Notifications\SendEmailToAdmins;
use App\Notifications\SendCustomEmailsToAdmins;
//use App\Traits\ARBPaymentGatewayTrait;
use App\Traits\CommonTrait;
use App\Traits\FeesTrait;
//use App\Traits\GrupoTrait;
use App\Models\Fees;
use App\Traits\PaymentGatewayTrait;
use App\Traits\SMSTrait;
use App\Traits\WhatsappGroupTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Throwable;
use Auth;
use App\Traits\UserLogTreat;
use App\Models\OrderLog;
use Illuminate\Support\Facades\Mail;
use App\Traits\FirebaseTrait;
use App\Models\PublicOrderOffer;

/**
 * Class PrivateOrderController
 * @package App\Http\Controllers\Website
 */
class HyperpayController extends Controller
{

    use PaymentGatewayTrait;
//    use GrupoTrait;
    use WhatsappGroupTrait;
    use SMSTrait;
    use CommonTrait;
    use FeesTrait;
    use UserLogTreat;
    use FirebaseTrait;

    public function __construct()
    {
        view()->share([
            'fees' => Fees::query()->first(),
        ]);
    }
    public function sendEmail($message1,$message2,$email){

        $info = [
            'message1'         => $message1,
            'message2'         => $message2,
        ];

        Mail::to($email)->send(new SendCustomEmailsToAdmins($info));
    }
    public function index($id,$type,$offer_id = null)
    {
        try {

            if ($type=='privateOrder')
            {
                $this->data['order']        = PrivateOrder::find($id);
                $this->data['checkout_id']  = json_decode($this->data['order']->payment_gateway_checkout_data)->id;
                $this->data['admins']       = Admin::get();
                $this->data['type']         = $type;
            }
            elseif ($type=='publicOrder')
            {
                ///////// publicOrder/////////////
                $this->data2['order']       = PublicOrder::find($id);
                // dd(($this->data2['order']->payment_gateway_checkout_data));
                 $this->data2['checkout_id'] = json_decode($this->data2['order']->payment_gateway_checkout_data)->id;
//                $this->data2['admins']      = Admin::get();
                if(!empty($offer_id)){
                    $this->data2['offer']   = PublicOrderOffer::find($offer_id);
                    $this->data2['fees']    = $this->CalculateServicesFees($this->data2['offer']->price);
                    $this->data2['user']    = User::where('id', $this->data2['order']->user_id)->first();
                }
                $this->data2['type']        = $type;

            }elseif ($type=='publicOrderProvider')
            {
                ///////// publicOrder/////////////
                $this->data2['order']       = PublicOrder::find($id);
                $this->data2['user']    = User::where('id', $this->data2['order']->user_id)->first();

                // dd(($this->data2['order']->payment_gateway_checkout_data));
                 $this->data2['checkout_id'] = json_decode($this->data2['order']->payment_gateway_checkout_data)->id;
//                $this->data2['admins']      = Admin::get();
                $this->data2['type']        = $type;

            }
            elseif ($type=='eservices')
            {
                ///////// Eservices/////////////
                $this->data3['order']       = eservices_orders::find($id);
                $this->data3['checkout_id'] = json_decode($this->data3['order']->payment_gateway_checkout_data)->id;
                // $this->data3['admins']      = Admin::get();
                $this->data3['type']        = $type;
                $this->data3['fees']        = Fees::all();
            }
            if ($type=='privateOrder'){
                if(!empty($this->data['order']->instance_id)){
                    $this->data['order'] = $this->data['order']->instance;
                    return view('website.hyperpay.indexPrivateUpdate', $this->data);
                }
                return view('website.hyperpay.index', $this->data);
            }
            elseif ($type=='publicOrder'){
                return view('website.hyperpay.indexPublic', $this->data2);
            } elseif ($type=='publicOrderProvider'){
                return view('website.hyperpay.indexPublicProvider', $this->data2);
            }
            elseif ($type=='eservices'){
                if($this->data3['order']->order_log == 'yes')
                {
                    $this->data3['order_id']    = $this->data3['order']->id;

                    $this->data3['order_log']    = OrderLog::where('order_id',$this->data3['order']->id)->firstOrFail();
                    return view('website.hyperpay.indexEserviceSecond', $this->data3);
                }
                else
                {
                    return view('website.hyperpay.indexEservice', $this->data3);
                }
            }

        } catch (Throwable $throwable) {
            throw $throwable;
        }


    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Throwable
     */
    public function response($id, $type,$offer_id = null)
    {



        try {
            $success_codes = [
                '000.000.000',
                '000.000.100',
                '000.100.110',
                '000.100.111',
                '000.100.112',
                '000.300.000',
                '000.300.100',
                '000.300.101',
                '000.300.102',
                '000.310.100',
                '000.310.101',
                '000.310.110',
                '000.600.000'
            ];

            if ($type=='privateOrder'){
                $order = PrivateOrder::find($id);
                if ($order->user_id == Auth::id()) {
                    $user = User::findOrfail(Auth::id());

                    if (request('id') && request('resourcePath')) {
                        $payment_status = $this->getPaymentStatus(request('id'));
                        if (in_array($payment_status['result']['code'], $success_codes)) {
                            $order->pay_status        = 'complete_convert';
                            $order->payment_status = json_encode($payment_status);
                            if ( $order->edit_price > 0){
                                $fees       = $this->CalculateFees($order->edit_price);
                                $has_coupon = false;
                                $coupon_discount = 0;
                                if(!is_null($instance = $order->coupone_instance)){
                                    $coupon = Coupon::where('type', 'coupon')->where('id', $instance->coupon_id)->first();
                                    $coupon_result = $this->couponValidation($coupon, $user);
                                    if(!$coupon_result['success']){
                                        $instance->delete();
                                    }else{
                                        $has_coupon = true;
                                        $coupon_discount = $this->calculateDiscount($coupon, $fees['fee']);
                                        $provider_discount = $this->calculateOwnerDiscount($coupon, $fees['fee']);
                                        $instance = CouponInstance::update_instance($instance, $coupon, $coupon_discount, $provider_discount);
                                        $fees['fee'] = $fees['fee'] - $coupon_discount;
                                    }
                                }
                                $newAmount  = ($fees['fee'] + (($fees['value_added_tax'] / 100) * $fees['fee'])) + (double)$order->edit_price ;
                                $order->update([
                                    'fees'                      => $fees['fee'],
                                    'total_amount'              => $newAmount,
                                    'payable_service_provider'  => $order->edit_price,
                                    'provider_value_added_tax'  => (($fees['value_added_tax'] / 100) * $fees['fee']),
                                    'provider_fees'             => $fees['fee'],
                                    'client_cancellation'       => $fees['client_cancellation'],
                                    'value_added_tax'           => (($fees['value_added_tax'] / 100) * $fees['fee']),
                                    'payment_gateway_fee'       => $fees['payment_gateway_fee'],
                                    'details'                   => $order->edit_details,
                                    'edit_details'              => '',
                                    'edit_deadline'             => '',
                                    'deadline'                  => $order->edit_deadline,
                                    'edit_price'                => 0,
                                    'deserved_price'            => 0,
                                    'price'                     => $order->edit_price,
                                    'instance_id'               => NULL,
                                ]);
                                if ($order->status_id!=11) {
                                    $order->status_id==2;
                                }
                                $instance = $order->instance;
                                $instance->payment_status=1;
                                $instance->update();
                                Notification::send($order->provider, new EditPrivateOrderNotify($order));
                            }else{
                                $admins             = Admin::get();
                                $message1           = 'تم ارسال طلب جديد '. $order->id;
                                $message2           = ' طلب تعميد خاص رقم ' . '#' . $order->id;
                                $link               = route('privateOrder.create');
                                // Notification::send($admins, new SendEmailToAdmins($message1,$message2,$link,$message2));
                                foreach($admins as $admin){
                                    $this->sendEmail($message1,$message2,$admin->email);
                                }
                                $this->AddUserLog($user,$message1,$message2,$order->price);
                                $checkProvider      = User::where('phone', $order->service_provider_phone)->first();
                                if (!$checkProvider) {
                                    $creat_provider         = $this->addNewUser($order->service_provider_phone, 'provider', $order->price, true);
                                    $order->provider_id=  $creat_provider->id;
                                }
                                $users  = User::where('phone', $order->service_provider_phone)->get();
                                Notification::send($users, new PrivateOrderNotify($order));
                            }

                            $this->newTransaction($user->id, $payment_status['amount'], $order->id, 'private','deposit', "ايداع  رصيد تعميد رقم " . $order->id);
                            $this->userBalance($user, true,$payment_status['amount']);
                            $order->deserved_price    = 0;
                            $order->update();

                            if(!is_null($agent = $order->agent))
                            {
                                $message = [
                                    'message' => " يوجد طلب تعميد خاص جديد من موكلك ". $user->getName(),
                                    'link' => route('privateOrder.show',['id' => $order->id]),
                                ];
                                Notification::send($agent, new \App\Notifications\NotifyAgent($order, $message));
                            }
//                            $this->createWhatsappGroup($order,'privateOrder');
                            return redirect(route('privateOrder.show',$order->id))->with('success', "تم انشاء التعميد بنجاح بانتظار موافقة مقدم الخدمة!" );
                        } else {
                            $data_checkout = $this->paymentGatewayCheckout($order->deserved_price, $order->id);
                            if (isset($data_checkout['id'])) {
                                $order->payment_gateway_checkout_data = $data_checkout;
                                $order->payment_status = json_encode($payment_status);
                                $order->save();
                                return redirect(route('hyperpay.index',['id'=>$id,'type'=>$type]))->with('hyperpay_error', 'عذرا, هناك خطأ في عملبة الدفع الرجاء المحاولة مرة اخرى.');
                            } else {
                                return redirect(route('privateOrder.create'))->with('hyperpay_error', 'عذرا, بوابة الدفع غير متاحة حاليا.');
                            }
                        }

                    }
                }else {
                    abort(404);
                }
            }
            elseif($type=='publicOrder'){
                $order = PublicOrder::find($id);
                if ($order->user_id == Auth::id()) {
                    $user = User::findOrfail(Auth::id());
                    if (request('id') && request('resourcePath')) {
                        $payment_status = $this->getPaymentStatus(request('id'));
                        if (in_array($payment_status['result']['code'], $success_codes)) {
                            if(!empty($offer_id)){
                                // for offer
                                $offer          = PublicOrderOffer::find($offer_id);
                                $fees       = $this->CalculateServicesFees($offer->price);
                                $total_amount   =  (double)$offer->price;
                                $deadline       = $offer->deadline;
                                $order->update([
                                    'provider_id'               => $offer->user_id,
                                    'price'                     => $offer->price,
                                    'fees'                      => $fees['order_fee'],
                                    'deadline'                  => $deadline,
                                    'client_cancellation'       => 0,
                                    'value_added_tax'           => $fees['order_added_tax'],
                                    'payment_gateway_fee'       => $fees['payment_gateway_fee'],
                                    'master_order'              => $order->id,
                                    'payable_service_provider'  => $offer->deserved_price,
                                    'provider_fees'             => $offer->fees,
                                    'provider_value_added_tax'  => $offer->tax_amount,
                                ]);
                                $offer_user       = User::where('id', $order->user_id)->first();
                                if(!is_null($agent = $order->agent))
                                {
                                    $order->agent_per = $this->calculateAgentAmount($order->total_amount);
                                    $order->total_amount += $order->agent_per;
                                    $order->save();
                                }
                                $net = $user->available_balance - $order->total_amount;
                                if ($net < 0) {
                                    $net                    = $order->total_amount - $user->available_balance;
                                    if ($net < 0) {
                                       abort(500);
                                    }
//                                    $order->deserved_price  = $net;
//                                    $order->save();
                                    $this->WithdrawingFromBalance($user, $user->available_balance);
                                }
                                // end offer
                            }

                            $users = User::where('id', $order->provider_id)->get();
                            Notification::send($users, new PublicOrderOfferNotify($order));
                            $this->newTransaction($user->id, $payment_status['amount'], $order->id, 'public','deposit', " ايداع رصيد خدمة الكترونية رقم #' . $order->id");
                            $order->payment_status = json_encode($payment_status);
                            $order->pay_status  = 'complete_convert';
                            $order->status      = 3;

                            $admins         = Admin::get();
                            $message1       = 'تم ارسال طلب جديد '. $order->id;
                            $message2       = ' خدمة الكترونية رقم ' . '#' . $order->id;
                            $link           = route('privateOrder.create');
                            // Notification::send($admins, new SendEmailToAdmins($message1,$message2,$link,$message2));
                            foreach($admins as $admin){
                                $this->sendEmail($message1,$message2,$admin->email);
                            }
                            $this->AddUserLog($user,$message1,$message2,$order->price);
                            $this->userBalance($user, true, $payment_status['amount']);
                            $order->deserved_price    = 0;
                            $order->save();
                            if(!is_null($agent = $order->agent))
                            {
                                $message = [
                                    'message' => ' يوجد خدمة الكترونية جديد من موكلك' . $user->getName(),
                                    'link' => route('publicOrders.showDetails',['id' => $order->id]),
                                ];
                                Notification::send($agent, new \App\Notifications\NotifyAgent($order, $message));
                            }
                            return redirect(route('publicOrders.showDetails',$order->id))->with('success', 'تم انشاء الطلب بنجاح  !');

                        } else {
                            $data_checkout = $this->paymentGatewayCheckout($order->deserved_price, $order->id);
                            if (isset($data_checkout['id'])) {
                                $order->payment_gateway_checkout_data = $data_checkout;
                                $order->payment_status = json_encode($payment_status);
                                $order->save();
                                return redirect(route('hyperpay.index',['id'=>$id,'type'=>$type,'offer_id'=>$offer_id]))->with('hyperpay_error', 'عذرا, هناك خطأ في عملبة الدفع الرجاء المحاولة مرة اخرى.');
                            } else {
                                return redirect(route('privateOrder.create'))->with('hyperpay_error', 'عذرا, بوابة الدفع غير متاحة حاليا.');
                            }
                        }

                    }
                }else {
                    abort(404);
                }
            }
            elseif($type=='publicOrderProvider'){
                $order = PublicOrder::find($id);
                if ($order->user_id == Auth::id()) {
                    $user = User::findOrfail(Auth::id());
                    if (request('id') && request('resourcePath')) {
                        $payment_status = $this->getPaymentStatus(request('id'));

                        if (in_array($payment_status['result']['code'], $success_codes)) {
                            $users = User::where('id', $order->provider_id)->get();
                            Notification::send($users, new PublicOrderProviderNotify($order));
                            $this->newTransaction($user->id, $payment_status['amount'], $order->id, 'public','deposit', " ايداع رصيد خدمة الكترونية رقم #' . $order->id");
                            $order->payment_status = json_encode($payment_status);
                            $order->pay_status  = 'complete_convert';
                            $order->status      = 3;
                            $admins         = Admin::get();
                            $message1       = 'تم ارسال طلب جديد '. $order->id;
                            $message2       = ' خدمة الكترونية رقم ' . '#' . $order->id;
                            $link           = route('privateOrder.create');
                            // Notification::send($admins, new SendEmailToAdmins($message1,$message2,$link,$message2));
                            foreach($admins as $admin){
                                $this->sendEmail($message1,$message2,$admin->email);
                            }
                            $this->AddUserLog($user,$message1,$message2,$order->price);
                            $this->userBalance($user, true, $payment_status['amount']);
                            $order->deserved_price    = 0;
                            $order->save();
                            if(!is_null($agent = $order->agent))
                            {
                                $message = [
                                    'message' => ' يوجد خدمة الكترونية جديد من موكلك' . $user->getName(),
                                    'link' => route('publicOrders.showDetails',['id' => $order->id]),
                                ];
                                Notification::send($agent, new \App\Notifications\NotifyAgent($order, $message));
                            }
                            $total_amount   =  (double)$order->total_amount;

                            $net = $user->available_balance - $total_amount;
                            if ($net < 0) {
                                $net                    = $order->total_amount - $user->available_balance;
                                if ($net < 0) {
                                    abort(500);
                                }
//                                    $order->deserved_price  = $net;
//                                    $order->save();
                                $this->WithdrawingFromBalance($user, $user->available_balance);
                            }
                            return redirect(route('publicOrders.showDetails',$order->id))->with('success', 'تم انشاء الطلب بنجاح  !');

                        } else {
                            $data_checkout = $this->paymentGatewayCheckout($order->deserved_price, $order->id);
                            if (isset($data_checkout['id'])) {
                                $order->payment_gateway_checkout_data = $data_checkout;
                                $order->payment_status = json_encode($payment_status);
                                $order->save();
                                return redirect(route('hyperpay.index',['id'=>$id,'type'=>$type]))->with('hyperpay_error', 'عذرا, هناك خطأ في عملبة الدفع الرجاء المحاولة مرة اخرى.');
                            } else {
                                return redirect(route('privateOrder.create'))->with('hyperpay_error', 'عذرا, بوابة الدفع غير متاحة حاليا.');
                            }
                        }

                    }
                }else {
                    abort(404);
                }
            }
            elseif($type=='eservices'){
                $order = eservices_orders::find($id);
                if ($order->user_id == Auth::id()) {
                    $user = User::findOrfail(Auth::id());
                    if (request('id') && request('resourcePath')) {
                        $payment_status = $this->getPaymentStatus(request('id'));
                        if (in_array($payment_status['result']['code'], $success_codes)) { //success payment id -> transaction bank id
                            // $this->createWhatsappGroup($order, $type);
                            $order->pay_status = 'complete_convert';
                            $order->payment_status = json_encode($payment_status);
                            $order->save();
                            $this->userBalance($user, true, $payment_status['amount']);
                            if($order->order_log == '') {
                                $admins = Admin::get();
                                $message1 = 'تم ارسال طلب خدمة الكترونية ' . $order->id;
                                $message2 = ' طلب خدمة الكترونية رقم ' . '#' . $order->id;
                                $link = route('weblist');
                                foreach ($admins as $admin) {
                                    $this->sendEmail($message1, $message2, $admin->email);
                                }
                                $fav_providers = User::favProviders($order->eservice_id);
                                if (count($fav_providers)) {
                                    $providers_ids = $fav_providers->pluck('id')->toArray();
                                    $title = 'يوجد طلب خدمة إلكترونية جديد ';
                                    $body = 'طلب خدمة إلكترونية جديد بانتظار الاستلام ';
                                    $this->desktopNotifications($title, $body, url('orders'), [$providers_ids]);
                                    Notification::send($fav_providers, new \App\Notifications\NewEserviceNotify($order));
                                }
                                $this->AddUserLog($user, $message1, $message2, $order->price);
                                $this->newTransaction($user->id, $payment_status['amount'], $order->id, 'eservices', 'deposit', " ايداع  رصيد خدمة الكترونية رقم  $order->id");

                                if(!empty($order->provider_id) && $order->provider_id != 0)
                                {
                                    $provider = User::find($order->provider_id);
                                    Notification::send($provider, new PayEserviceNotify($order));
                                }

                                return redirect(route('eservices_orders.show',$order->id))->with('success', 'تم انشاء الخدمة بنجاح بانتظار موافقة احد مقدمي الخدمة !');

                            }
                            if($order->order_log == 'yes')
                            {
                                $instance                               = $order->coupone_instance;
                                $this->data['order_log']                = OrderLog::where('order_id',$order->id)->firstOrFail();
                                $order->fees                            = $this->data['order_log']->fees;
                                $order->provider_fees                   = $this->data['order_log']->provider_fees;
                                $order->price                           = $this->data['order_log']->price;
                                $order->value_added_tax                 = $this->data['order_log']->value_added_tax;
                                $order->provider_value_added_tax        = $this->data['order_log']->provider_value_added_tax;
                                $order->total_amount                    = $this->data['order_log']->total_amount;
                                $order->provider_total_amount           = $this->data['order_log']->provider_total_amount;
                                $order->order_log                       = 'no';
                                $order->update();
                                if(!empty($instance))
                                {
                                    $instance->amount                           = $this->data['order_log']->amount;
                                    $instance->owner_discount                = $this->data['order_log']->provider_discount;
                                    $instance->save();
                                }
                                $this->newTransaction($user->id, $payment_status['amount'], $order->id, 'eservices', 'deposit', " اضاقة رصيد للخدمة الكترونية رقم  $order->id");

                                return redirect(route('eservices_orders.show',$order->id))->with('success', 'تم اضافة المبلغ الى الخدمة بنجاح!');

                            }


                        } else {
                            $data_checkout = $this->paymentGatewayCheckout($order->deserved_price, $order->id);
                            if (isset($data_checkout['id'])) {
                                $order->payment_gateway_checkout_data = $data_checkout;
                                $order->payment_status = json_encode($payment_status);
                                $order->save();
                                return redirect(route('hyperpay.index',['id'=>$id,'type'=>$type]))->with('hyperpay_error', 'عذرا, هناك خطأ في عملبة الدفع الرجاء المحاولة مرة اخرى.');
                            } else {
                                return redirect(route('privateOrder.index'))->with('hyperpay_error', 'عذرا, بوابة الدفع غير متاحة حاليا.');
                            }
                        }

                    }
                }else {
                    abort(404);
                }
            }
        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }

}
