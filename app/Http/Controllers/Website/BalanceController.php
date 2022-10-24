<?php

namespace App\Http\Controllers\Website;

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
use DB;
use App\Notifications\SendEmailToAdmins;
use App\Models\OrderLog;
use Illuminate\Support\Facades\Mail;
use App\Traits\FirebaseTrait;
use App\Notifications\SendCustomEmailsToAdmins;
use App\Models\PublicOrderOffer;

/**
 * Class PrivateOrderController
 * @package App\Http\Controllers\Website
 */
class BalanceController extends Controller
{
    use CommonTrait, FirebaseTrait, FeesTrait;

    public function private_order_index($id)
    {
        $this->data['order']=PrivateOrder::findOrFail($id);
        $this->data['admins']=Admin::get();
        $this->data['type']="private_order";
        $this->authorize('owner', $this->data['order']);

        return view('website.balance.index', $this->data);
    }

    public function private_order_payment_from_balance($id){

        $order = PrivateOrder::findOrFail($id);
        $user = Auth::user();
        if($user->available_balance >= $order->total_amount && $order->pay_status != 'complete_convert'){
            DB::beginTransaction();
            $total_cost = $order->total_amount;
            $order->pay_status = 'complete_convert';
            if($order->status_id!=11)
            {
                $order->status_id      = 2;

            }
            $order->deserved_price = 0;

            $admins             = Admin::get();
            $message1           = 'تم ارسال طلب جديد';
            $message2           = ' طلب تعميد خاص رقم ' . '#' . $order->id;
            $link               = route('privateOrder.create');
            foreach($admins as $admin){
                $this->sendEmail($message1,$message2,$admin->email);
            }
            $checkProvider      = User::where('phone', $order->service_provider_phone)->first();
            if (!$checkProvider) {
                $creat_provider         = $this->addNewUser($order->service_provider_phone, 'provider', $order->price, true);
                $order->provider_id=  $creat_provider->id;
            }
            $order->update();
            $users  = User::where('phone', $order->service_provider_phone)->get();
            Notification::send($users, new PrivateOrderNotify($order));
            $this->WithdrawingFromBalance($user, $total_cost);
            $this->newTransaction($user->id, $total_cost, $order->id, 'private', 'withdrawal', " سحب من رصيدك المتاح لدفع رسوم طلب تعميد خاص رقم $order->id");
            DB::commit();
            if(!is_null($agent = $order->agent))
            {
                $message = [
                    'message' => " يوجد طلب تعميد خاص جديد من موكلك ". $user->getName(),
                    'link' => route('privateOrder.show',['id' => $order->id]),
                ];
                Notification::send($agent, new \App\Notifications\NotifyAgent($order, $message));
            }
            return redirect()->route('privateOrder.show',['id' => $order->id])->with('success', 'تم خصم قيمة التعميد من رصيدك');
        } else{
            return back()->with('error', 'الرصيد غير كافي');
        }
    }
    public function sendEmail($message1,$message2,$email){

        $info = [
            'message1'         => $message1,
            'message2'         => $message2,
        ];

        Mail::to($email)->send(new SendCustomEmailsToAdmins($info));
    }
    public function public_order_index($id,$offer_id = null)
    {
        $this->data['order']    = PublicOrder::findOrFail($id);
        $this->data['admins']   = Admin::get();
        $this->data['type']     = "public_order";
        if(!empty($offer_id))
        {
            $this->data['offer']   = PublicOrderOffer::find($offer_id);
            $this->data['fees']    = $this->CalculatePublicOrderFees($this->data['offer']->price);
            $this->data['user']    = User::where('id', $this->data['order']->user_id)->first();
        }
        return view('website.balance.offer_index', $this->data);
    }

    public function public_order_payment_from_balance($id,$offer_id){

        $order                  = PublicOrder::findOrFail($id);
        $user                   = Auth::user();
        $offer                  = PublicOrderOffer::find($offer_id);
        $fees                   = $this->CalculatePublicOrderFees($offer->price);
        $deadline               = $offer->deadline;
        if($user->available_balance >= $offer->total_amount){
            DB::beginTransaction();
            $total_amount = $fees['order_fee'] + $fees['order_added_tax'] + (double)$offer->price;
            $order->update([
                'provider_id'               => $offer->user_id,
                'price'                     => $offer->price,
                'fees'                      => $fees['order_fee'],
                'total_amount'              => $total_amount,
                'deadline'                  => $deadline,
                'client_cancellation'       => 0,
                'value_added_tax'           => $fees['order_added_tax'],
                'payment_gateway_fee'       => $fees['payment_gateway_fee'],
                'master_order'              => $order->id,
                'payable_service_provider'  => $offer->deserved_price,
                'provider_fees'             => $offer->fees,
                'provider_value_added_tax'  => $offer->tax_amount,
            ]);
            if(!is_null($agent = $order->agent))
            {
                $order->agent_per = $this->calculateAgentAmount($order->total_amount);
                $order->total_amount += $order->agent_per;
                $order->save();
            }

            $total_amount = $order->total_amount;
            $order->deserved_price = 0;
            $order->pay_status  = 'complete_convert';
            $order->status      = 3;
            $order->save();
            $this->WithdrawingFromBalance($user, $total_amount);
            $this->newTransaction($user->id, $total_amount, $order->id, 'public', 'withdrawal', "تعميد عام رقم #' . $order->id");
            DB::commit();
            if(!is_null($agent = $order->agent))
            {
                $message = [
                    'message' => " يوجد طلب تعميد عام جديد من موكلك ". $user->getName(),
                    'link' => route('publicOrders.showDetails',['id' => $order->id]),
                ];
                Notification::send($agent, new \App\Notifications\NotifyAgent($order, $message));
            }

            return redirect()->route('publicOrders.showDetails',['id' => $order->id])->with('success', 'تم خصم قيمة التعميد من رصيدك');;
            }else{
            return back()->with('error', 'الرصيد غير كافي');
        }
    }

    public function eservicePay($id){

        $this->data['order']        = eservices_orders::where('id',$id)->where('user_id',Auth::id())->firstOrFail();
        $this->data['admins']       = Admin::get();

        if($this->data['order']->order_log == 'yes')
        {
            $this->data['order']    = OrderLog::where('order_id',$id)->firstOrFail();
            return view('website.balance.eservice_scond_pay', $this->data);
        }

        return view('website.balance.eservice_pay', $this->data);

    }


    public function eserviceStore($id){
        $this->data['order']                = eservices_orders::where('id',$id)->where('user_id',Auth::id())->firstOrFail();

        $this->data['admins']               = Admin::get();

        $this->data['order']->pay_status    = 'complete_convert';
        $this->data['order']->update();
        $total_cost                         = $this->data['order']->total_amount;
        $users                              = User::findorfail(Auth::id());

        $this->WithdrawingFromBalance($users,$total_cost);
        $this->newTransaction($users->id,$total_cost,$this->data['order']->id,'electronic','withdrawal',"ايداع رصيد  خدمة الكترونية  رقم $id ");
        if(!is_null($agent = $users->agent))
        {
            $message = [
                'message' => " يوجد طلب خدمة إلكترونية جديد من موكلك ". $users->getName(),
                'link' => route('eservices_orders.show', ['order_id' => $this->data['order']->id]),
            ];
            Notification::send($agent, new \App\Notifications\NotifyAgent($this->data['order'], $message));
        }
        $fav_providers = User::favProviders($this->data['order']->eservice_id);
        if(count($fav_providers)){
            $fav_providers = User::favProviders($id);
            $providers_ids = $fav_providers->pluck('id')->toArray();
            $title = 'يوجد طلب خدمة إلكترونية جديد ';
            $body = 'طلب خدمة إلكترونية جديد بانتظار الأستلام';
            $this->desktopNotifications( $title, $body,  url('orders'), $providers_ids);
            Notification::send($fav_providers, new \App\Notifications\NewEserviceNotify($this->data['order']));
        }
        return redirect('eservices')->with('success','تم الخصم من رصيدك');

        return view('website.balance.eservice_pay', $this->data);

    }

    public function eserviceStoreSecond($id){

        $this->data['order']                            = eservices_orders::where('id',$id)->where('user_id',Auth::id())->firstOrFail();
        $this->data['admins']                           = Admin::get();

        $this->data['order_log']                        = OrderLog::where('order_id',$this->data['order']->id)->firstOrFail();

        $this->data['order']->pay_status                = 'complete_convert';
        $this->data['order']->fees                      = $this->data['order_log']->fees;
        $this->data['order']->provider_fees             = $this->data['order_log']->provider_fees;
        $this->data['order']->price                     = $this->data['order_log']->price;
        $this->data['order']->value_added_tax           = $this->data['order_log']->value_added_tax;
        $this->data['order']->provider_value_added_tax  = $this->data['order_log']->provider_value_added_tax;
        $this->data['order']->total_amount              = $this->data['order_log']->total_amount;
        $this->data['order']->provider_total_amount     = $this->data['order_log']->provider_total_amount;
        $this->data['order']->order_log                 = 'no';
        $this->data['order']->update();
        $instance                                       = $this->data['order']->coupone_instance;
        if(!empty($instance))
        {
            $instance->amount                           = $this->data['order_log']->amount;
            $instance->owner_discount                = $this->data['order_log']->provider_discount;
            $instance->save();
        }

        $total_cost                                     = $this->data['order_log']->diff_amount;
        $users                                          = User::findorfail(Auth::id());

        $this->WithdrawingFromBalance($users,$total_cost);

        $this->newTransaction($users->id,$total_cost,$this->data['order']->id,'electronic','withdrawal',"ايداع رصيد  خدمة الكترونية  رقم $id ");
        return redirect('eservices')->with('success','تم الخصم من رصيدك');

        return view('website.balance.eservice_pay', $this->data);

    }



}
