<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Admin\ChatAPI;
use App\Models\Admin;
use App\Models\BalanceRequest;
use App\Models\PrivateOrder;
use App\Models\PublicOrder;
use App\Models\eservices_orders;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\EditPrivateOrderNotify;
use App\Notifications\PrivateOrderNotify;
use App\Notifications\PublicOrderOfferNotify;
use App\Traits\ARBPaymentGatewayTrait;
use App\Traits\CommonTrait;
use App\Traits\FeesTrait;
use App\Traits\GrupoTrait;
use App\Models\Fees;
use App\Traits\PaymentGatewayTrait;
use App\Traits\SMSTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Throwable;
use Auth;
use App\Notifications\SendEmailToAdmins;
use App\Traits\WhatsappGroupTrait;
use App\Models\Coupon;
use App\Models\CouponInstance;
use App\Traits\UserLogTreat;
use App\Models\OrderLog;
use Illuminate\Support\Facades\Mail;
use App\Notifications\SendCustomEmailsToAdmins;
/**
 * Class PrivateOrderController
 * @package App\Http\Controllers\Website
 */
class ARBController extends Controller
{
    use ARBPaymentGatewayTrait;
    use GrupoTrait;
    use WhatsappGroupTrait;
    use SMSTrait;
    use CommonTrait;
    use FeesTrait;
    use UserLogTreat;

    /**
     * @throws Throwable
     */

    public function sendEmail($message1,$message2,$email){

        $info = [
            'message1'         => $message1,
            'message2'         => $message2,
        ];

        Mail::to($email)->send(new SendCustomEmailsToAdmins($info));
    }

    public function response($id, $type, Request $request)
    {
        try {
            $this->data['admins']       = Admin::get();
            $this->data['type']         = $type;
            if ($type == 'privateOrder') {
                $this->data['order']    = PrivateOrder::find($id);
                $user                   = User::findOrfail($this->data['order']->user_id);

                if ($request->method() == 'POST' && $this->data['order']->pay_status != 'complete_convert') {
                    $trandata                               = urldecode($this->decryptAES($request->get('trandata'), $this->termresourcekey));
                    $this->data['order']->payment_status    = $trandata;
                    $data_trandata                          = json_decode($this->data['order']->payment_status)[0];

                    if (isset($data_trandata->ref) && $data_trandata->ref!='') {
                        $this->data['order']->pay_status        = 'complete_convert';
                        $this->data['order']->deserved_price    = 0;

                        if ( $this->data['order']->edit_price!=0){
                            $fees       = $this->CalculateFees($this->data['order']->edit_price);
                            $has_coupon = false;
                            $coupon_discount = 0;
                            if(!is_null($instance = $this->data['order']->coupone_instance)){
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
                            if(!empty($this->data['order']->reference_code) && $this->data['order']->owner_discount != 0){
                                $owner_reference_code = User::where('reference_code', $this->data['order']->reference_code)->first();
                                $this->newTransaction($owner_reference_code->id, $this->data['order']->owner_discount, $this->data['order']->id, 'private', 'deposit', " تم شحن الرصيد باستخدام كود الخصم" . $this->data['order']->reference_code ."للطلب رقم: " .  $this->data['order']->id);
                                $this->walletMuamlah($this->data['order']->owner_discount, $this->data['order']->price, $this->data['order']->id, 'private', 'withdrawal', "سحب عمولة كوبون على تعميد خاص رقم $this->data['order']->id ");
                            }
                            $newAmount  = ($fees['fee'] + (($fees['value_added_tax'] / 100) * $fees['fee'])) + (double)$this->data['order']->edit_price;
                            $this->data['order']->update([
                                'fees'                      => $fees['fee'],
                                'total_amount'              => $newAmount,
                                'payable_service_provider'  => $this->data['order']->edit_price,
                                'provider_value_added_tax'  => (($fees['value_added_tax'] / 100) * $fees['fee']),
                                'provider_fees'             => $fees['fee'],
                                'client_cancellation'       => $fees['client_cancellation'],
                                'value_added_tax'           => (($fees['value_added_tax'] / 100) * $fees['fee']),
                                'payment_gateway_fee'       => $fees['payment_gateway_fee'],
                                'details'                   => $this->data['order']->edit_details,
                                'edit_details'              => '',
                                'status'                    => '2',
                                'edit_deadline'             => '',
                                'deadline'                  => $this->data['order']->edit_deadline,
                                'edit_price'                => 0,
                                'price'                     => $this->data['order']->edit_price,
                            ]);
                            Notification::send($this->data['order']->provider, new EditPrivateOrderNotify($this->data['order']));

                            $message1           = 'تم تعديل طلب تعميد خاص';
                            $message2           = ' تعديل طلب تعميد خاص رقم ' . '#' . $this->data['order']->id;

                            $this->AddUserLog($user,$message1,$message2,$this->data['order']->price);
                        }else{
                            $admins             = Admin::get();
                            $message1           = 'تم ارسال طلب جديد';
                            $message2           = ' طلب تعميد خاص رقم ' . '#' . $this->data['order']->id;
                            $link               = route('admin.private_orders');
                            // Notification::send($admins, new SendEmailToAdmins($message1,$message2,$link,$message2));
                            foreach($admins as $admin){
                                $this->sendEmail($message1,$message2,$admin->email);
                            }
                            $this->AddUserLog($user,$message1,$message2,$this->data['order']->price);
                            $checkProvider      = User::where('phone', $this->data['order']->service_provider_phone)->first();
                            if (!$checkProvider) {
                                $creat_provider         = $this->addNewUser($this->data['order']->service_provider_phone, 'provider', $this->data['order']->price, true);
                                $this->data['order']->provider_id=  $creat_provider->id;
                            }

                            $users  = User::where('phone', $this->data['order']->service_provider_phone)->get();
                            Notification::send($users, new PrivateOrderNotify($this->data['order']));
                            $this->data['order']->deserved_price    = 0;
                            if(!is_null($agent = $this->data['order']->agent))
                            {
                                $message = [
                                    'message' => " يوجد طلب تعميد خاص جديد من موكلك". $user->getName(),
                                    'link' => '',
                                ];
                                Notification::send($agent, new \App\Notifications\NotifyAgent($this->data['order'], $message));
                            }

                        }
                        //  $user = User::findOrfail($this->data['order']->user_id);

                        $this->newTransaction($user->id, $data_trandata->amt, $this->data['order']->id, 'private','deposit', "ايداع رصيد تعميد رقم " . $this->data['order']->id);
                        $this->userBalance($user, true, $data_trandata->amt);
                    }
                    $this->data['order']->update();
                }

                $this->data['payment_status']   = json_decode($this->data['order']->payment_status);
                $this->data['url']              = route('privateOrder.show', $id);

                if ($this->data['order']->pay_status != 'complete_convert') {
                    $checkout       = $this->ARBCheckout($this->data['order']->deserved_price, $this->data['order']->id, $type);
                    $data_checkout  = json_decode($checkout, true);
                    if (!isset($data_checkout[0]['status']) || $data_checkout[0]['status'] != 1) {
                        return redirect(route('privateOrder.create'))->with('hyperpay_error', 'عذرا, بوابة الدفع غير متاحة حاليا.');
                    }
                    $this->data['order']->payment_gateway_checkout_data = $checkout;
                    $this->data['order']->update();
                    $data                                               = explode(":", $data_checkout[0]['result']);
                    $this->data['url']                                  = $data[1] . ':' . $data[2] . '?PaymentID=' . $data[0];
                } else {
                    $this->data['payment_status']                       = json_decode($this->data['order']->payment_status);
                    $this->data['url']                                  = route('privateOrder.show', $id);
                }
                if ($this->data['url'] == route('privateOrder.show', $id)) {
                    return redirect(route('publicOrders.showDetails',$this->data['order']->id))->with('success', "تم الدفع بنجاح !" );
                }
                return view('website.rajhi_bank.response.private', $this->data);
            }
            elseif ($type == 'publicOrder') {
                $order                  = PublicOrder::find($id);
                $this->data['order']    = $order;
                $user                   = User::findOrfail($order->user_id);
                if ($request->method() == 'POST' && $order->pay_status != 'complete_convert') {
                    $trandata               = urldecode($this->decryptAES($request->get('trandata'), $this->termresourcekey));
                    $order->payment_status  = $trandata;
                    $data_trandata          = json_decode($order->payment_status)[0];
                    if (isset(json_decode($order->payment_status)[0]->ref) && json_decode($order->payment_status)[0]->ref != '') {
                        $users = User::where('id', $order->provider_id)->get();
                        Notification::send($users, new PublicOrderOfferNotify($order));
                        $this->newTransaction($user->id, $data_trandata->amt, $order->id, 'public','deposit', " ايداع رصيد تعميد رقم #' . $order->id");
                        $order->pay_status  = 'complete_convert';
                        $order->status      = 3;
                        $order->save();
                        $admins         = Admin::get();
                        $message1       = 'تم ارسال طلب جديد';
                        $message2       = ' طلب تعميد عام رقم ' . '#' . $this->data['order']->id;
                        $link           = route('privateOrder.create');
                        // Notification::send($admins, new SendEmailToAdmins($message1,$message2,$link,$message2));
                        foreach($admins as $admin){
                            $this->sendEmail($message1,$message2,$admin->email);
                        }

                        $this->AddUserLog($user,$message1,$message2,$this->data['order']->price);
                        $this->userBalance($user, true, $data_trandata->amt);
                        if(!is_null($agent = $this->data['order']->agent))
                        {
                            $message = [
                                'message' => " يوجد طلب تعميد عام جديد من موكلك". $user->getName(),
                                'link' => '',
                            ];
                            Notification::send($agent, new \App\Notifications\NotifyAgent($this->data['order'], $message));
                        }
                    }
                    $this->data['payment_status']   = $data_trandata;
                    $this->data['url']              = route('publicOrders.showDetails', $id);


                }
                if ($order->pay_status != 'complete_convert') {
                    $checkout           = $this->ARBCheckout($order->deserved_price, $order->id, $type);
                    $data_checkout      = json_decode($checkout, true);
                    if (!isset($data_checkout[0]['status']) || $data_checkout[0]['status'] != 1) {
                        return redirect(route('rajhiBank.index', ['id' => $order->id, 'type' => $type]));
                    }
                    $order->payment_gateway_checkout_data   = $checkout;
                    $order->update();
                    $data                                   = explode(":", $data_checkout[0]['result']);
                    $this->data['url']                      = $data[1] . ':' . $data[2] . '?PaymentID=' . $data[0];
                } else {
                    $this->data['payment_status']           = json_decode($order->payment_status);
                    $this->data['url']                      = route('publicOrders.showDetails', $id);
                }
                if ($this->data['url']==route('publicOrders.showDetails', $id)) {
                    return redirect(route('publicOrders.showDetails',$order->id))->with('success', 'تم انشاء الخدمة بنجاح بانتظار موافقة المشرف على الطلب !');

                }
                return view('website.rajhi_bank.response.private', $this->data);

            } elseif ($type == 'eservices') {
                $order                          = eservices_orders::find($id);
                $this->data['order']            = $order;
                $user                           = User::findOrfail($order->user_id);
                if ($order->user_id == $user->id) {
                    if ($request->method() == 'POST' && $order->pay_status != 'complete_convert') {
                        $trandata               = urldecode($this->decryptAES($request->get('trandata'), $this->termresourcekey));
                        $order->payment_status  = $trandata;
                        $data_trandata = json_decode($this->data['order']->payment_status)[0];
                        if (isset($data_trandata->ref) && $data_trandata->ref!='' ) {

                            if($this->data['order']->order_log == 'yes')
                            {
                                $instance                                       = $order->coupone_instance;
                                // dd($instance);
                                $this->data['order_log']                        = OrderLog::where('order_id',$this->data['order']->id)->firstOrFail();

                                $this->data['order']->fees                      = $this->data['order_log']->fees;
                                $this->data['order']->provider_fees             = $this->data['order_log']->provider_fees;
                                $this->data['order']->price                     = $this->data['order_log']->price;
                                $this->data['order']->value_added_tax           = $this->data['order_log']->value_added_tax;
                                $this->data['order']->provider_value_added_tax  = $this->data['order_log']->provider_value_added_tax;
                                $this->data['order']->total_amount              = $this->data['order_log']->total_amount;
                                $this->data['order']->provider_total_amount     = $this->data['order_log']->provider_total_amount;
                                $this->data['order']->order_log                 = 'no';
                                $this->data['order']->update();
                                if(!empty($instance))
                                {
                                    $instance->amount                           = $this->data['order_log']->amount;
                                    $instance->owner_discount                = $this->data['order_log']->provider_discount;
                                    $instance->save();
                                }
                            }
                            $this->newTransaction($user->id, $data_trandata->amt, $order->id, 'eservices', 'deposit', " ايداع  رصيد خدمة الكترونية رقم  $order->id");
                            $order->pay_status = 'complete_convert';
                            $order->save();
                            //  $this->createWhatsappGroup($order, $type);
                            $this->userBalance($user, true, $data_trandata->amt);
                            $admins         = Admin::get();
                            $message1       = 'تم ارسال طلب خدمة الكترونية';
                            $message2       = ' طلب خدمة الكترونية رقم ' . '#' . $this->data['order']->id;
                            $link           = route('weblist');
                            // Notification::send($admins, new SendEmailToAdmins($message1,$message2,$link,$message2));
                            foreach($admins as $admin){
                                $this->sendEmail($message1,$message2,$admin->email);
                            }
                            $fav_providers = User::favProviders($order->eservice_id);
                            if(!is_null($agent = $user->agent))
                            {
                                $message = [
                                    'message' => " يوجد طلب خدمة إلكترونية جديد من موكلك". $user->getName(),
                                    'link' => '',
                                ];
                                Notification::send($agent, new \App\Notifications\NotifyAgent($this->data['order'], $message));
                            }
                            if(!empty($order->provider_id) && $order->provider_id != 0)
                            {
                                $provider = User::find($order->provider_id);
                                Notification::send($provider, new PayEserviceNotify($order));
                            }
                            if(count($fav_providers)){
                                $providers_ids = $fav_providers->pluck('id')->toArray();
                                $title = 'يوجد طلب خدمة إلكترونية جديد بانتظار تقديم الخدمة';
                                $body = 'طلب خدمة إلكترونية جديد بانتظار تقديم الخدمة المناسبة';
                                $this->desktopNotifications( $title, $body,  url('orders'), [$providers_ids]);
                                Notification::send($fav_providers, new \App\Notifications\NewEserviceNotify($order));
                            }
                            $this->AddUserLog($user,$message1,$message2,$this->data['order']->price);


                        }
                        $this->data['payment_status']   = json_decode($order->payment_status);
                        $this->data['url']              = route('privateOrder.index');
                    }
                    if ($order->pay_status != 'complete_convert') {
                        $checkout       = $this->ARBCheckout($order->deserved_price, $order->id, $type);
                        $data_checkout  = json_decode($checkout, true);
                        if (!isset($data_checkout[0]['status']) || $data_checkout[0]['status'] != 1) {
                            return redirect(route('rajhiBank.index', ['id' => $order->id, 'type' => $type]));
                        }
                        $order->payment_gateway_checkout_data   = $checkout;
                        $order->update();
                        $data                                   = explode(":", $data_checkout[0]['result']);
                        $this->data['url']                      = $data[1] . ':' . $data[2] . '?PaymentID=' . $data[0];
                    } else {
                        $this->data['payment_status']   = json_decode($order->payment_status);
                        $this->data['url']              = route('eservices_orders.show', $id);
                    }
                    if ($this->data['url'] == route('eservices_orders.show', $id)) {
                        return redirect(route('eservices_orders.show', $id))->with('success', 'تم انشاء الخدمة بنجاح بانتظار موافقة احد مقدمي الخدمة !');
                    }
                    return view('website.rajhi_bank.response.private', $this->data);
                } else {
                    abort(404);
                }
            }
        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }

    public function payout_response($id, $type, Request $request)
    {
        try {
            if ($type == 'balance-withdrawal') {
                $data = BalanceRequest::find($id);
                $trandata = urldecode($this->decryptAES($request->get('trandata'), $this->termresourcekey));
                $data->payment_status = $trandata;
                if ($request->method() == 'POST' && $data->status_id == '2') {
                    if (isset(json_decode($data->payment_status)[0]->ref)) {
                        //خصم من رصيد العميل
                        $user = User::where('id', $data->user_id)->first();
                        $available_balance = $user->available_balance - $data->amount;
                        $total_balance = $available_balance + $user->pinding_balance;
                        $user->available_balance = $available_balance;
                        $user->total_balance = $total_balance;
                        $user->save();
                        $this->newTransaction($user->id, $data->amount, '0', 'withdrawal', 'Balance withdrawal');
                        // تعديل حالة الطلب الى تم التحويل
                        $data->status = 4;
                        $data->ref = json_decode($data->payment_status)[0]->ref;
                        $data->update();
                        return redirect(route('admin.balance_requests'));
                    } else {
                        return redirect(route('admin.balance_requests'));

                    }
                }
            }

        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }

    public function index($id, $type)
    {
        try {

            if ($type == 'privateOrder') {
                $this->data['order'] = PrivateOrder::where('user_id',Auth::id())->findOrFail($id);
                $this->authorize('owner', $this->data['order']);
                $amount = $this->data['order']->deserved_price;
            } elseif ($type == 'publicOrder') {
                $this->data['order'] = PublicOrder::where('user_id',Auth::id())->findOrFail($id);
                $amount = $this->data['order']->deserved_price;
            }
            elseif ($type == 'eservices') {
                $this->data['order'] = eservices_orders::where('user_id',Auth::id())->findOrFail($id);
                if($this->data['order']->order_log == 'yes')
                {
                    $order_log      = OrderLog::where('order_id',$this->data['order']->id)->firstOrFail();
                    $amount         = $order_log->deserved_price;
                }
                else
                {
                    $amount = $this->data['order']->deserved_price;
                }
            }
            $now            = \Carbon\Carbon::now();
            $order_date     = $this->data['order']->created_at->addDays(1);
            if($now->greaterThan($order_date)){
                abort(404);
            }

            $checkout = $this->ARBCheckout($amount, $this->data['order']->id, $type);
            $data_checkout = json_decode($checkout, true);
            if (!isset($data_checkout[0]['status']) || $data_checkout[0]['status'] != 1) {
                return redirect()->back()->with('hyperpay_error', 'عذرا, بوابة الدفع غير متاحة حاليا.');
            }
            $this->data['order']->payment_gateway_checkout_data = $checkout;
            $this->data['order']->update();
            $data = explode(":", $data_checkout[0]['result']);
            $this->data['paymentUrl'] = $data[1] . ':' . $data[2] . '?PaymentID=' . $data[0];
            $this->data['admins'] = Admin::get();
            $this->data['type'] = $type;

            if ($type == 'privateOrder') {
                return view('website.rajhi_bank.index', $this->data);
            } elseif ($type == 'publicOrder') {
                return view('website.rajhi_bank.indexPublic', $this->data);
            } elseif ($type == 'eservices') {
                $this->data['order'] = eservices_orders::where('id',$id)->where('user_id',Auth::id())->first();
                if($this->data['order']->order_log == 'yes')
                {
                    $this->data['order']    = OrderLog::where('order_id',$this->data['order']->id)->firstOrFail();
                    return view('website.rajhi_bank.indexEserviceSecond', $this->data);
                }
                else
                {
                    return view('website.rajhi_bank.indexEservice', $this->data);
                }
            }

        } catch (Throwable $throwable) {
            throw $throwable;
        }


    }


}
