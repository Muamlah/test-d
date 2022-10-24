<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests\Website\PrivateOrder\Store;
use App\Http\Requests\Website\PrivateOrder\Update;
use App\Models\Fees;
use App\Models\Message;
use App\Models\PrivateOrder;
use App\Models\WpAbusmoApplications;
use App\Models\PublicOrder;
use App\Models\eservices_orders;
use App\Models\Settings;
use App\Models\Transaction;
use App\Models\WalletMuamlah;
//use App\Models\Invoices;
use App\Models\User;
use App\Models\Admin;
use App\Notifications\EditPrivateOrderNotify;
use App\Notifications\SendReceiptCodePrivateOrderNotify;
use App\Notifications\StatusUpdatePrivateOrderNotify;
use App\Traits\ARBPaymentGatewayTrait;
use App\Traits\CommonTrait;
use App\Traits\FeesTrait;
use App\Traits\GrupoTrait;
use App\Traits\PaymentGatewayTrait;
use App\Traits\SMSTrait;
use Auth;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Notification;
use Mail;
use Illuminate\Http\Request;
use Throwable;
use App\Notifications\PrivateOrderNotify;
use Illuminate\Support\Facades\DB;
use App\Models\Status;
use App\Notifications\SendEmailToAdmins;
use App\Models\Coupon;
use App\Models\CouponInstance;
use App\Models\PublicOrderOffer;
use App\Models\PrivateOrderInstance;
use App\Traits\UserLogTreat;
use App\Notifications\SendCustomEmailsToAdmins;
/**
 * Class PrivateOrderController
 * @package App\Http\Controllers\Website
 */
class PrivateOrderController extends Controller
{

    //    use SMSTrait;
    use FeesTrait;
    use GrupoTrait;
    use PaymentGatewayTrait;
    use ARBPaymentGatewayTrait;
    use CommonTrait;
    use UserLogTreat;

    public function update(Update $request, PrivateOrder $privateOrder)
    {

        try {

            $user               = User::findorfail($privateOrder->user_id);
            $fees               = $this->CalculateFees($request->price);
            $has_coupon         = false;
            $coupon_discount    = 0;
            if(!is_null($instance = $privateOrder->coupone_instance)){
                $coupon         = Coupon::where('type', 'coupon')->where('id', $instance->coupon_id)->first();
                $coupon_result  = $this->couponValidation($coupon, $user);
                if(!$coupon_result['success']){
                    $instance->delete();
                }else{
                    $has_coupon         = true;
                    $coupon_discount    = $this->calculateDiscount($coupon, $fees['fee']);
                    $provider_discount  = $this->calculateOwnerDiscount($coupon, $fees['fee']);
                    $instance           = CouponInstance::update_instance($instance, $coupon, $coupon_discount, $provider_discount);
                    $fees['fee'] = $fees['fee'] - $coupon_discount;
                }

            }

            $deadline       = Carbon::parse($request->date . ' ' . '00:00:00');
            $oldAmount      = $privateOrder->total_amount;
            $newAmount      = ($fees['fee'] + (($fees['value_added_tax'] / 100) * $fees['fee'])) + (float)$request->price;
            $oldDetails     = $privateOrder->details;
            $oldDeadline    = $privateOrder->deadline;
            if ( Carbon::parse($deadline)->format('Y-m-d') < Carbon::now()->format('Y-m-d')) {
                return redirect(route('privateOrder.edit', $privateOrder->id))->with('edit_error', 'لا يمكنك اختيار تاريخ اقل من تاريخ اليوم');
            }

            $admins         = Admin::get();
            $message1       = 'تم تعديل طلب تعميد خاص';
            $message2       = ' تعديل طلب تعميد خاص رقم ' . '#' . $privateOrder->id;
            $link           = route('privateOrder.edit', $privateOrder->id);
            // Notification::send($admins, new SendEmailToAdmins($message1, $message2, $link,$message2));
            // foreach($admins as $admin){
            //     $this->emailSend($message1,$message2,$admin->email);
            // }

             $this->AddUserLog($user,$message1,$message2,$request->price);

            $update_price   = 0;
            if($privateOrder->price < $request->price)
            {
                $update_price                   = ($request->price - $privateOrder->price) * 0.035;
                $privateOrder->update_price     = $update_price;
                $privateOrder->save();
            }
            $amount  = (( $request->price - $coupon_discount) + $fees['fee'] + (($fees['value_added_tax'] / 100) * $fees['fee'])) + $update_price;
            if ($privateOrder->price < $request->price || $privateOrder->deadline != $deadline || $privateOrder->details != $request->details) {
                Notification::send($privateOrder->provider, new EditPrivateOrderNotify($privateOrder));
                $privateOrder->update([
                    'edit_details'  => $request->details,
                    'edit_deadline' => $deadline,
                    'edit_price'    => $request->price,
                ]);
            }
            if ($privateOrder->price == $request->price) {
                if ($oldDeadline != $deadline || $oldDetails != $request->details) {
                    return redirect(route('privateOrder.edit', $privateOrder->id))->with('edit_success', 'تم التعديل بنجاح بإنتظار الموافقة على التعديلات.');
                } else {
                    return redirect(route('privateOrder.edit', $privateOrder->id))->with('edit_success', 'تم التعديل بنجاح.');
                }
            }
            else if ($oldAmount < $amount) {
                $new_instance       = PrivateOrderInstance::createInstance($privateOrder);
                $calculated_price = $amount - $oldAmount ;
                $the_balance = Auth::user()->available_balance - $calculated_price;
//                $order_instance       = PrivateOrderInstance::createInstance($privateOrder);
                if ($the_balance < 0) {
                    DB::beginTransaction();
                    $the_balance = $calculated_price - Auth::user()->available_balance;
//                    if (Auth::user()->available_balance > 0) {
                        $this->newTransaction($user->id, $user->available_balance, $privateOrder->id, 'private', 'withdrawal', "سحب رسوم من الرصيد المتاح لتعميد خاص رقم $privateOrder->id ");
//                    }
                    $this->WithdrawingFromBalance($user, $user->available_balance);
                    //update instance
                    $new_instance->fees = $fees['fee'];
                    $new_instance->total_amount = $newAmount ;
                    $new_instance->client_cancellation = $fees['client_cancellation'];
                    $new_instance->value_added_tax = (($fees['value_added_tax'] / 100) * $fees['fee']);
                    $new_instance->price = $request->price;
                    $new_instance->payable_service_provider = $request->price;
                    $new_instance->payment_gateway_fee = $fees['payment_gateway_fee'];
                    $new_instance->provider_fees = $fees['fee'];
                    $new_instance->provider_value_added_tax = (($fees['value_added_tax'] / 100) * $fees['fee']);
                    $new_instance->deserved_price = $the_balance;
                    $new_instance->save();
                    if (config('payment.payment_gateway_type') == 'rajhi_bank') {
                        $privateOrder->deserved_price   = $the_balance;
                        $privateOrder->edit_price       = $request->price;
                        $privateOrder->instance_id                      = $new_instance->id;
                        $privateOrder->save();
                        DB::commit();
                        return redirect(route('rajhiBank.index', ['id' => $privateOrder->id, 'type' => 'privateOrder']));
                    } else {
                        $data_checkout = $this->paymentGatewayCheckout($the_balance, $privateOrder->id);
                        $privateOrder->payment_gateway_checkout_data    = $data_checkout;
                        $privateOrder->deserved_price                   = $the_balance;
                        $privateOrder->edit_price                       = $request->price;
                        $privateOrder->instance_id                      = $new_instance->id;
                        $privateOrder->update();
                        $new_instance->payment_gateway_checkout_data = $data_checkout;
                        $new_instance->save();
                        DB::commit();
                        if (isset($data_checkout['id'])) {
                            return redirect(route('hyperpay.index', ['id' => $privateOrder->id, 'type' => 'privateOrder']));
                        } else {
                            return redirect(route('privateOrder.create'))->with('hyperpay_error', 'عذرا, بوابة الدفع غير متاحة حاليا.');
                        }
                    }
                } else {
                    DB::beginTransaction();

                    $fees       = $this->CalculateFees($privateOrder->edit_price);
                    $has_coupon = false;
                    $coupon_discount = 0;
                    if(!is_null($instance = $privateOrder->coupone_instance)){
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
                    $newAmount  = ($fees['fee'] + (($fees['value_added_tax'] / 100) * $fees['fee'])) + (double)$privateOrder->edit_price;

                    $privateOrder->update([
                        'fees'                      => $fees['fee'],
                        'total_amount'              => $newAmount,
                        'payable_service_provider'  => $privateOrder->edit_price,
                        'provider_value_added_tax'  => (($fees['value_added_tax'] / 100) * $fees['fee']),
                        'provider_fees'             => $fees['fee'],
                        'client_cancellation'       => $fees['client_cancellation'],
                        'value_added_tax'           => (($fees['value_added_tax'] / 100) * $fees['fee']),
                        'payment_gateway_fee'       => $fees['payment_gateway_fee'],
                        'details'                   => $privateOrder->edit_details,
                        'edit_details'              => '',
                        'status_id'                    => '2',
                        'edit_deadline'             => '',
                        'deadline'                  => $privateOrder->edit_deadline,
                        'edit_price'                => 0,
                        'price'                     => $privateOrder->edit_price,
                    ]);
                    Notification::send($privateOrder->provider, new EditPrivateOrderNotify($privateOrder));
                    $user->available_balance        = $user->available_balance - $calculated_price;
                    $user->pinding_balance          = $user->pinding_balance + $calculated_price;
                    $user->update();
                    $this->newTransaction($user->id, $calculated_price, $privateOrder->id, 'private', 'withdrawal', "سحب رسوم من الرصيد المتاح لتعميد خاص رقم $privateOrder->id ");
                    DB::commit();
                    return redirect(route('privateOrder.edit', $privateOrder->id))->with('edit_success', 'تم التعديل بنجاح.');
                }
            }
            else if ($oldAmount > $amount) {
                DB::beginTransaction();
                $calculated_price           =  $request->price;
                $this->CalculateFees($calculated_price);
                $has_coupon = false;
                $coupon_discount = 0;
                if(!is_null($instance = $privateOrder->coupone_instance)){
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
                $newAmount  = ($fees['fee'] + (($fees['value_added_tax'] / 100) * $fees['fee'])) + (double)$calculated_price;
                $privateOrder->update([
                    'fees'                      => $fees['fee'],
                    'total_amount'              => $newAmount,
                    'payable_service_provider'  => $calculated_price,
                    'provider_value_added_tax'  => (($fees['value_added_tax'] / 100) * $fees['fee']),
                    'provider_fees'             => $fees['fee'],
                    'client_cancellation'       => $fees['client_cancellation'],
                    'value_added_tax'           => (($fees['value_added_tax'] / 100) * $fees['fee']),
                    'payment_gateway_fee'       => $fees['payment_gateway_fee'],
                    'details'                   => $request->details,
                    'edit_details'              => '',
                    'status_id'                 => '2',
                    'edit_deadline'             => '',
                    'deadline'                  => $deadline,
                    'edit_price'                => 0,
                    'price'                     => $request->price,
                ]);
                $user->available_balance    = $user->available_balance + ($oldAmount-$newAmount);
                $user->pinding_balance      = $user->pinding_balance - ($oldAmount-$newAmount);
                $user->update();
                $this->newTransaction($user->id, ($oldAmount-$newAmount), $privateOrder->id, 'private', 'deposit', "استرجاع من التعميد الخاص رقم $privateOrder->id ");
                Notification::send($privateOrder->provider, new EditPrivateOrderNotify($privateOrder));
                DB::commit();
                return redirect(route('privateOrder.edit', $privateOrder->id))->with('edit_success', 'تم التعديل بنجاح بإنتظار الموافقة على التعديلات.');
            }
        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }

    public function edit(PrivateOrder $privateOrder)
    {
        $this->authorize('owner', $privateOrder);
        $this->data['order'] = $privateOrder;
        return view('website.privateOrders.edit', $this->data);
    }

    public function index()
    {
        $this->data['order_status'] = Status::get();
        $this->data['orders'] = [];
        $this->data['publicOrders'] = [];
        $this->data['eservices_orders'] = [];
        $this->data['electronic_provider_count'] = 0;
        $this->data['order_offer_count'] = 0;

        if(auth()->check()){
            $this->data['electronic_provider_count'] = eservices_orders::where('provider_id',auth()->id())->
            whereDate('created_at', '=', Carbon::today()->toDateString())->count();
            $this->data['order_offer_count'] = PublicOrderOffer::where('user_id',auth()->id())->
            whereDate('created_at', '=', Carbon::today()->toDateString())->count();
        }


        return view('website.privateOrders.index', $this->data);
    }
    public function open_chat ($id)
    {
        $exists=Message::where('entity_id',$id)->where('entity_type', PrivateOrder::class)->first();
        if (!$exists) {
            $order = PrivateOrder::whereNotIn('status_id',[1,5])->findOrFail($id);
            $user_id2 = $order->provider_id;
            if($user_id2 == Auth::id()){
                $user_id2 = $order->user_id;
            }
            $message = new Message();
            $message->user_id = Auth::id();
            $message->user_id2 = $user_id2;
            $message->subject = 'تعميد خاص رقم '.$id;
            $message->message = 'تعميد خاص رقم '.$id;
            $message->entity_id = $id;
            $message->entity_type = PrivateOrder::class;
            $message->save();
            $message->users()->sync([
                Auth::id() => ['entity_type' => User::class],
                $user_id2 => ['entity_type' => User::class]
            ]);
            $new_id=$message->id;
        }else{
            $new_id=$exists->id;
        }
        return redirect(route('chat.start',$new_id)) ;
    }

    public function seeMore()
    {
        $orders = PrivateOrder::where('user_id', Auth::id())->where('pay_status', 'complete_convert')
            ->orderBy('updated_at', 'DESC');
        if (request()->has('filter') && !empty($filter = request()->filter)) {
            $this->data['order_status'] = Status::get();
            $array_filter = [];
            foreach ($filter as $item) {
                $state = $this->data['order_status']->find($item);
                if (!empty($state)) {
                    $array_filter[] = $state->status;
                }
            }
            $orders = $orders->whereIn('status', $array_filter);
        }
        $orders = $orders->paginate(10);
        $view = view('website.privateOrders.ajax-view.data', compact('orders'))->render();
        return response()->json(['html' => $view]);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {

        $this->data['item'] = PrivateOrder::findOrFail($id);
        $this->authorize('owner', $this->data['item']);
        $this->data['chat_message'] = $this->data['item']->open_chat();
        return view('website.privateOrders.show', $this->data);
    }

    /**
     * ارسال رسالة
     * @param $id
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function sendSMSOTP($id): JsonResponse
    {
        $item = PrivateOrder::findOrFail($id);
        $code = rand(1000, 9999);
        $phone = Auth::user()->phone;
        $item->update(['verify_code' => $code]);
        $msg = 'لتأكيد استلامك الطلب' . "\n" . "ادخل الرمز " . $code . "\n" .
            'تنبيه : لا تشارك هذا الرمز ابدا مع اي شخص لحماية حسابك';
        $this->sendSMS($phone, $msg);
        return response()->json(["success" => 1, "message" => 'تمت العملية بنجاح', 'user' => Auth::user()]);
    }
    public function emailSend($message1,$message2,$email){

        $info = [
            'message1'         => $message1,
            'message2'         => $message2,
        ];

        Mail::to($email)->send(new SendCustomEmailsToAdmins($info));
    }
    public function sendEmail($id): JsonResponse
    {
        try {
            $item = PrivateOrder::findOrFail($id);
            $code = rand(100000, 999999);
            $phone = Auth::user()->phone;
            $item->update(['verify_code' => $code]);
            Auth::user()->notify(new SendReceiptCodePrivateOrderNotify($item));
            return response()->json(["success" => 1, "message" => 'تمت العملية بنجاح', 'user' => Auth::user()]);
        } catch (Throwable $throwable) {
            return response()->json(["error" => 1, "message" => 'لم يتم ارسال ايميل']);
        }
    }

    /**
     * تغير حالة الطلب
     * @param $id
     * @param $status
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function updateStatus($id, $status_id, Request $request)
    {
        // dd($status_id);
        try {
            $user               = auth()->user();
            $phone              = $user->phone;
            $password           = $request->password;
            $item               = PrivateOrder::where('pay_status', 'complete_convert')->where('verify', 'no')->where('id', $id)->first();
            $update_price= $item->instanceOrders()->where('payment_status',true)->sum('update_price');

            if(!$user->chackUserAvailability($item)){
                return back()->with(['error' => 'لا يمكنك القيام بهذا الإجراء لأنك لا تمتلك تصريح بذلك!']);
            }
            // $this->authorize('owner', $item);
            if(!$item->chechAvailableStatus($status_id)){
                return back()->with(['error' => 'لايمكنك تغيير حالة هذه الخدمة للحالة المختارة']);
            }
            // $provider           = User::where('phone', $item->service_provider_phone)->first();
            $provider           = User::where('id', $item->provider_id)->first();
           if($status_id == 6){
                $item->cancel_reason = $request->cancel_reason;
                $item->update();
           }


            $status_name    = Status::find($status_id);
            $message1       = 'تم تغيير الحالة';
            if(!empty($status_name)){
                $message2       = "تم تغيير حالة  طلب التعميد الخاص رقم #".$item->id . ' إلى الحالة ' . $status_name->name;
            }else{
                $message2       = "تم تغيير حالة  طلب التعميد الخاص رقم #".$item->id;
            }

            $this->AddUserLog(auth()->user(),$message1,$message2,$item->price);


            // if ($status == 'waiting') {
            if ($status_id == 2) {
                $item->status_id = 3;
                $item->update();
                return back()->with(['success' => 'تمت العملية بنجاح !']);
            // } elseif ($status == 'processing') {
            }elseif ($status_id == 11) {
                PrivateOrder::where('master_order', $item->master_order)->update(['status_id'=>11]);
                return back()->with(['success' => 'تمت العملية بنجاح !']);
                return back()->with(['success' => 'تمت العملية بنجاح !']);
            } elseif ($status_id == 3) {
                $item->status_id = 4;
                $item->update();
                return back()->with(['success' => 'تمت العملية بنجاح !']);
            }
            // elseif ($status == 'completed') {
            elseif ($status_id == 4) {
                $user = User::find($item->user_id);
                $phone = $user->phone;
                if(auth()->user()->id == $item->agent_id){
                    $phone = auth()->user()->phone;
                }
                if ($request->code && $request->code == $item->verify_code) {
                    DB::beginTransaction();
                    $offerData = [
                        'message' => "تم استلام  طلب التعميد خاص رقم $item->id من طرف العميل ",
                        'link' => route('privateService.show', $item->id),
                    ];
                    Notification::send($provider, new StatusUpdatePrivateOrderNotify($item, $offerData));
                    $data = PrivateOrder::where('master_order', $item->master_order)->get();
                    foreach ($data as $key => $value) {
                        $order_provider = User::where('id', $value->provider_id)->first();
                        $order_user     = User::find($value->user_id);
                        $amount = $value->payable_service_provider;
                        if ($value->parent_order == 0) {
                            $total_amount = $value->payable_service_provider  + $item->value_added_tax + $item->fees + $item->agent_per + $update_price;
                            if ($update_price!=0) {
                                $this->newTransaction($value->user_id, $total_amount, $value->id, 'private', 'withdrawal', "سحب رسوم تعديل تعميد خاص رقم $value->id ");
                                $this->userBalanceDiscount($user, $update_price);
                            }
                        } else {
                            $total_amount = $value->payable_service_provider;
                        }
                        if(!is_null($value->payment_status)){
                            $this->newTransaction($value->user_id, $total_amount, $value->id, 'private', 'withdrawal', "سحب رصيد تعميد خاص رقم $value->id ");
                        }
                        if ($value->parent_order == 0) {
                            $this->userBalanceDiscount($user, $total_amount- $item->agent_per);
                            if ($value->total_amount - $total_amount != 0) {
                                $this->newTransaction($user->id, ($value->total_amount - $total_amount), $item->id, 'public', 'deposit', " استرجاع مبلغ من  تعميد خاص رقم $item->id");
                                $this->ReturnRestToBalance($user, ($value->total_amount - $total_amount));
                            }
                        } else {
                            $this->providerBalanceDiscount($order_user, $total_amount);
                        }
                        $this->newTransaction($order_provider->id, $amount, $value->id, 'private', 'deposit', "ايداع رصيد تعميد خاص رقم $value->id ");
                        $this->providerBalance($order_provider, $amount);
                    }
                    $this->walletMuamlah(($item->provider_value_added_tax + $item->provider_fees), $item->price, $item->id, 'private', 'deposit', "ايداع عمولة تعميد خاص رقم $item->id ");
                    PrivateOrder::where('master_order', $item->master_order)->update(['status_id' => 5, 'verify' => 'yes']);
                    DB::commit();
                    $instance = $item->coupone_instance;
                    if(!is_null($instance) && $instance->owner_discount != 0){
                        $this->newTransaction($instance->owner_id, $instance->owner_discount, $instance->id, 'gift', 'deposit', " تم شحن الرصيد باستخدام كود الحسم" . $instance->code ."للطلب رقم: " .  $item->id);
                        $this->walletMuamlah($instance->owner_discount, $item->price, $item->id, 'private', 'withdrawal', "سحب عمولة كوبون على تعميد خاص رقم $item->id ");
                        $this->providerBalance($instance->owner,$instance->owner_discount);
                    }
                    if(!is_null($agent = $item->agent)){
                        $this->newTransaction($agent->id, $item->agent_per, $item->id, 'gift', 'deposit', " ايداع رصيد عمولة طلب تعميد خاص  رقم $item->id");
                        $this->providerBalance($agent,$item->agent_per);
                        $this->userBalanceDiscount($user,  $item->agent_per);
                        $this->newTransaction($user->id, $item->agent_per, $item->id, 'gift', 'withdrawal', " سحب عمولة وكيل  تعميد خاص رقم $item->id");

                    }
                    return redirect("/user/reviews-form/private-order/$id/$item->provider_id"); // send id of inserted
                }
                elseif ($request->password && Auth::attempt(['phone' => $phone, 'password' => $password])) {

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
                            if ($update_price!=0) {
                                $this->newTransaction($value->user_id, $total_amount, $value->id, 'private', 'withdrawal', "سحب رسوم تعديل تعميد خاص رقم $value->id ");
                                $this->userBalanceDiscount($user, $update_price);
                            }
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
//                        if ($value->total_amount - $total_amount != 0) {
//                            $this->ReturnRestToBalance($user, ($value->total_amount - $total_amount));
//                            $this->newTransaction($user->id, ($value->total_amount - $total_amount), $item->id, 'private', 'deposit', " ايداع رصيد فرق طلب تعميد خاص  رقم $item->id");
//                        }
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
                    return redirect("/user/reviews-form/private-order/$id/$item->provider_id"); // send id of inserted
                } else {
                    return back()->with(['error' => 'كلمة المرور او رمز التحقق المدخل خاطيء !']);
                }
            }
            // elseif ($status == 'canceled' && ($item->status =='processing' || $item->status =='waiting')) {
            elseif ($status_id == 6 && ($item->status_id == 3 || $item->status_id == 2 || $item->status_id == 6)) {
                DB::beginTransaction();
                $lastItem = PrivateOrder::where('master_order', $item->master_order)->orderBy('id', 'DESC')->first();
                $data = [
                    'message' => "تم الغاء  طلب التعميد خاص رقم $lastItem->id من طرف العميل ",
                    'link' => route('privateService.show', $lastItem->id),
                ];
                Notification::send($lastItem->provider, new StatusUpdatePrivateOrderNotify($lastItem, $data));

                if (Carbon::now() < $item->deadline && $item->status_id == 2) {
                    //  $item->status = 'canceled';
                    // PrivateOrder::where('master_order', $item->master_order)->update(['status' => 'canceled']);
                    PrivateOrder::where('master_order', $item->master_order)->update(['cancellation' => 'user','status_id' => 6]);
                } else {
                    $fees = Fees::first();
                    $user = User::find($item->user_id);
                    $this->userBalance($user, false, $item->total_amount, $fees->service_cancellation);
                    $this->newTransaction($user->id, ($item->total_amount - $fees->service_cancellation), $item->id, 'private', 'deposit', "ايداع رصيد الغاء تعميد رقم $item->id ");
                    $this->walletMuamlah($fees->service_cancellation, $item->price, $item->id, 'private', 'deposit', "رسوم الغاء طلب تعميد رقم $item->id");
                    //  $item = PrivateOrder::where('pay_status', 'complete_convert')->where('verify', 'no')->where('id', $id)->first();
                    //  $item->status = 'confirm_canceled';
                    //  $item->verify = 'yes';
                    PrivateOrder::where('master_order', $item->master_order)->update(['cancellation' => 'user','status_id' => 7, 'verify' => 'yes']);
                }

                DB::commit();
                return back()->with(['success' => 'تمت العملية بنجاح !']);
            // } elseif ($status == 'extension') {
            }
            elseif ($status_id == 'extension') {
                if ($user->id == $item->user_id) {
                    $item->duration = $item->duration + $request->day;
                    $item->update();
                    return back()->with(['success' => 'تمت العملية بنجاح !']);
                } else {
                    return back()->with(['error' => 'فقط مقدم الطلب يحق لة تمديد الطلب']);
                }
            // } elseif ($status == 'confirm_canceled' && $item->status =='canceled') {
            }
            elseif ($status_id == 7 && $item->status_id == 6) {

                DB::beginTransaction();
                $fees = Fees::first();
                $user = User::find($item->user_id);
                $this->userBalance($user, false, $item->total_amount, $fees->service_cancellation);
                $this->newTransaction($user->id, ($item->total_amount - $fees->service_cancellation), $item->id, 'private', 'deposit', "ايداع رصيد الغاء تعميد رقم $item->id ");
                $this->walletMuamlah($fees->service_cancellation, $item->price, $item->id, 'private', 'deposit', "رسوم الغاء طلب تعميد رقم $item->id");
                $data = [
                    'message' => "تم تاكيد الغاء  طلب التعميد خاص رقم $item->id من طرف العميل ",
                    'link' => route('privateService.show', $item->id),
                ];
                Notification::send($provider, new StatusUpdatePrivateOrderNotify($item, $data));
                // PrivateOrder::where('master_order', $item->master_order)->update(['status' => 'confirm_canceled', 'verify' => 'yes']);
                PrivateOrder::where('master_order', $item->master_order)->update(['status_id' => 7, 'verify' => 'yes']);
                DB::commit();
                return back()->with(['success' => 'تمت العملية بنجاح !']);
            }elseif($status_id == 8){

                $item->status_id   = 8;
                $item->update();
                $message = new Message;
                $message->user_id = $user ? $user->id : NULL;
                $message->name = $user->name;
                $message->subject = "إبلاغ على طلب تعميد خاص رقم :".$item->id;
                $message->email = $user->email;
                $message->message = $request->message;
                $message->entity_id = $item->id;
                $message->entity_type = PrivateOrder::class;
                $message->save();
                $data = [
                    'message' => "تم الإبلاغ على  طلب التعميد الخاص رقم $item->id ",
                    'link' => route('privateService.show', $item->id),
                ];
                Notification::send($provider, new StatusUpdatePrivateOrderNotify($item, $data));
                return back()->with(['success' => 'تمت العملية بنجاح !']);

            }
        } catch (Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $public_orders_status = Settings::getSetting('public_orders_status');
        $private_orders_status = Settings::getSetting('private_orders_status');
        $private_count = 0;
        $public_count = 0;
        if(auth()->check()){
            $private_count=PrivateOrder::where('user_id',auth()->id())->
            whereDate('created_at', '=', Carbon::today()->toDateString())->count();
            $public_count=PublicOrder::where('user_id', auth()->id())->
              whereDate('created_at', '=', Carbon::today()->toDateString())->count();
        }
        return view('website.privateOrders.create', compact('public_orders_status', 'private_orders_status', 'private_count', 'public_count'));
    }


    /**
     * @param Store $request
     * @return Application|Factory|View|RedirectResponse|Redirector
     * @throws GuzzleException
     * @throws Throwable
     */
    public function store(Store $request)
    {
        $provider = User::where('phone', $request->service_provider_phone)->first();
        if(!empty($provider)  && $provider->work_status == 'offline')
        {
            return back()->with(['error' => 'عذراً.. مزود الخدمة المختار غير متاح حالياً']);
        }

        $chack_balance = $this->checkUserBalance(Auth::user());
        if(!$chack_balance)
        {
            return back()->with(['error' => 'عذراً لايمكنك انشاء طلب تعميد خاص لأنه يوجد خطأ في رصيدك يرجى مراجعة المشرفين']);
        }

        $status = Settings::getSetting('private_orders_status');
        if ($status != 'active') {
            return view('website.passive');
        }
        try {
            $settings = Settings::query()->first();
            $private_count = PrivateOrder::where('user_id', Auth::id())->whereDate('created_at', '=', Carbon::today()->toDateString())->count();
            if ($private_count >= $settings->private_order_limit) {
                abort(401);
            }
            if ($request->price >= $settings->order_price_limit) {
                return redirect(route('privateOrder.create'))->with('error', 'قيمة التعميد اعلى من الحد المسموح به');
            }
            if ($request->price < 0) {
                return redirect(route('privateOrder.create'))->with('error', 'قيمة العقد يجب ان تكون أكبر او يساوي الصفر');
            }
            $check_if_user = User::where('level', 'user')->where('phone', $request->service_provider_phone)->first();
            if (!empty($check_if_user)) {
                return redirect(route('privateOrder.create'))->with('error', 'يرجى إضافة رقم مزود خدمة صحيح');
            }
            $user               = Auth::user();
            $has_coupon = false;
            if($request->coupon_code && !$request->reference_code){
                $coupon = Coupon::where('type', 'coupon')->where('code', $request->coupon_code)->first();
                $coupon_result = $this->couponValidation($coupon, $user);
                if(!$coupon_result['success']){
                    return back()->with('error', $coupon_result['message']);
                }
                $has_coupon = true;

            }
            $coupon_discount = 0;
            $order_price        = request()->input('price');
            $fees               = $this->CalculateFees($request->price);
            $deadline           = Carbon::parse($request->date . ' ' . '00:00:00');
            if($has_coupon){
                $coupon_discount = $this->calculateDiscount($coupon, $fees['fee']);
                $provider_discount = $this->calculateOwnerDiscount($coupon, $fees['fee']);
                $instance = CouponInstance::create_new($coupon, $user, $coupon_discount, $provider_discount);
                $fees['fee']= $fees['fee'] - $coupon_discount;
            }
            $has_reference_code = false;
            if($request->reference_code && !$request->coupon_code){
                $owner_reference_code = User::where('reference_code', $request->reference_code)->where('id', '!=', $user->id)->first();
                if(is_null($owner_reference_code)){
                    return back()->with('error', 'كود الخصم غير صحيح');
                }
                $has_reference_code = true;
            }
            $reference_code_discount = 0;
            if($has_reference_code){
                $reference_code_discount = $this->calculateReferenceCodeDiscount($owner_reference_code, $fees['fee']);
                $fees['fee']= $fees['fee'] - $reference_code_discount['user_discount'];
            }
            $order              = PrivateOrder::create($request->all() + [
                'user_id'                   => Auth::id(),
                'deadline'                  => $deadline,
                'fees'                      => $fees['fee'],
                'provider_fees'             => $fees['fee'],
                'total_amount'              => ($fees['fee']+ (($fees['value_added_tax'] / 100) * $fees['fee'])) + (double)$request->price,
                'payable_service_provider'  => (double)($request->price),
                'client_cancellation'       => $fees['client_cancellation'],
                'value_added_tax'           => (($fees['value_added_tax'] / 100) * $fees['fee']),
                'provider_value_added_tax'  => (($fees['value_added_tax'] / 100) * $fees['fee']),
                'payment_gateway_fee'       => $fees['payment_gateway_fee'],
                'status_id'                 => 2,
            ]);

            $message1           = 'اضافة طلب تعميد خاص';
            $message2           = ' اضافة طلب تعميد خاص رقم ' . '#' . $order->id;

            $this->AddUserLog($user,$message1,$message2,$order->price);

            $order->master_order    = $order->id;
            if($has_coupon){
                $instance->entity_id = $order->id;
                $instance->entity_type = PrivateOrder::class;
                $instance->save();
            }
            if($has_reference_code){
                $order->reference_code = $request->reference_code;
                $order->owner_discount = $reference_code_discount['owner_discount'];
                $order->user_discount = $reference_code_discount['user_discount'];
                $order->save();
            }
            //يجب ان يكون رقم الهاتف فقط
             $checkProvider              = User::where('phone', $order->service_provider_phone)->first();
            if ( isset($checkProvider->id) ) {
                $order->provider_id         = $checkProvider->id;
            }
            if(request()->has('whatsapp') && request()->whatsapp == '11')
            {
                $order->status_id = 11;
                $order->save();

            }
            if(request()->has('agent') && request()->agent == '1' && !empty($user->agent_id))
            {
                $order->provider_id = $user->agent_id;
                $order->service_provider_phone = $user->phone;
                $order->save();
            }
            $order->update();
            $total_cost                 = $order->total_amount;

            //ارسال ايميل الى المشرف و نتفكيشن لمقدم الخدمة
            //  $admins                 = Admin::get();
            //  Notification::send($admins, new PrivateOrderNotify($order));
            $net = $user->available_balance - $order->total_amount;

            if ($net < 0) {
                $net = $order->total_amount - $user->available_balance;
                if ($user->available_balance > 0) {
                    $this->newTransaction($user->id, $user->available_balance, $order->id, 'private', 'withdrawal', "سحب رصيدة  لتعميد خاص رقم $order->id ");
                }
                $this->WithdrawingFromBalance($user, $total_cost);
                if (config('payment.payment_gateway_type') == 'rajhi_bank') {
                    $order->deserved_price = $net;
                    $order->save();
                    return redirect(route('rajhiBank.index', ['id' => $order->id, 'type' => 'privateOrder']));
                } else {
                    $data_checkout = $this->paymentGatewayCheckout($net, $order->id);
                    if (isset($data_checkout['id'])) {
                        $order->payment_gateway_checkout_data = $data_checkout;
                        $order->deserved_price = $net;
                        $order->save();
                        return redirect(route('hyperpay.index', ['id' => $order->id, 'type' => 'privateOrder']));
                    } else {
                        return redirect(route('privateOrder.create'))->with('hyperpay_error', 'عذرا, بوابة الدفع غير متاحة حاليا.');
                    }
                }
            } else {
                //  DB::beginTransaction();
                //  if ( !isset($checkProvider->id) ) {
                //  $creat_provider         = $this->addNewUser($this->data['order']->service_provider_phone, 'provider', $this->data['order']->price, true);
                //  $order->provider_id           = $creat_provider->id;
                //  }
                //  $order->pay_status = 'complete_convert';
                //  $order->deserved_price = $total_cost;
                //  $order->update();
                //  $users = User::where('phone', $order->provider_id)->get();
                //  Notification::send($users, new PrivateOrderNotify($order));
                //  $this->WithdrawingFromBalance($user, $total_cost);
                //  $this->newTransaction($user->id, $total_cost, $order->id, 'private', 'withdrawal', " سحب من رصيدك المتاح لدفع رسوم طلب تعميد خاص رقم $order->id");
                //  DB::commit();
                return redirect(route('balance.private_order_index',$order->id));
            }
        } catch (Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }
    }

    public function mapingPrivateOrder(){

        // $old_orders = \DB::table('wp_abusmo_applications')->limit(2)->get();
        $old_orders = WpAbusmoApplications::orderBy('id','ASC')->limit(10)->get();

        foreach($old_orders as $old_order){
            try{

                // get users
                $user                       = User::where('level','user')->where('phone',$old_order->app_customer_phone)->orderBy('id','DESC')->first();
                // $user                       = User::find(117);

                // get provider
                $provider                   = User::where('level','provider')->where('phone',$old_order->app_supervisor_phone)->orderBy('id','DESC')->first();
                // $provider                   = User::find(118);

                // get order date and order deadline
                $deadline                   = Carbon::parse($old_order->app_time)->subDays($old_order->app_period)->format('Y-m-d H:i:s');
                $created_at                 = $old_order->app_time;

                // get details
                $details                    = $old_order->app_details;

                // get prices
                $price                      = $old_order->app_budget;
                $fees                       = $this->CalculateFees($price);
                $provider_fees              = $fees['fee'];
                $total_amount               = ($fees['fee'] + (($fees['value_added_tax'] / 100) * $fees['fee'])) + (double)$price;
                $payable_service_provider   = (double)$price;
                $client_cancellation        = $fees['client_cancellation'];
                $value_added_tax            = (($fees['value_added_tax'] / 100) * $fees['fee']);
                $provider_value_added_tax   = (($fees['value_added_tax'] / 100) * $fees['fee']);
                $payment_gateway_fee        = $fees['payment_gateway_fee'];

                // get payment status
                $payment_status             = $old_order->payment_gateway_data;

                if( !empty($user) && !empty($provider) && !empty($deadline) && !empty($created_at) && !empty($price) && !empty($fees) ){

                    try{

                        DB::beginTransaction();

                        $order              = PrivateOrder::create([
                            'user_id'                   => $user->id,
                            'provider_id'               => $provider->id,
                            'service_provider_phone'    => $provider->phone,
                            'user_phone'                => $user->phone,
                            'price'                     => $price,
                            'fees'                      => $fees['fee'],
                            'provider_fees'             => $fees['fee'],
                            'total_amount'              => $total_amount,
                            'payable_service_provider'  => $payable_service_provider,
                            'client_cancellation'       => $client_cancellation,
                            'value_added_tax'           => $value_added_tax,
                            'provider_value_added_tax'  => $provider_value_added_tax,
                            'payment_gateway_fee'       => $payment_gateway_fee,
                            'status_id'                 => 3,
                            'payment_status'            => $payment_status,
                            'deadline'                  => $deadline,
                            'created_at'                => $created_at,
                            'details'                   => $details,
                            'parent_order'              => 0
                        ]);

                        $net                            = $user->available_balance - $order->total_amount;
                        $order->deserved_price          = 0;
                        $order->master_order            = $order->id;
                        $order->save();

                        $old_order->maping_status       = 'success';
                        $old_order->save();

                        DB::commit();

                    }catch(Throwable $throwable){

                        $old_order->maping_status = 'fail';
                        $old_order->save();
                    }

                }else{
                    $old_order->maping_status = 'fail';
                    $old_order->save();
                }

            }catch(Throwable $throwable){
                // dd($throwable);
                $old_order->maping_status = 'fail';
                $old_order->save();
            }

        }
        return 'done';
    }


    /**
     * @param Request $request
     * @return string
     */
    public function checkDate(Request $request): string
    {

        $duration = $request->duration;
        $today = date('Y-m-d');
        $date = Carbon::createFromFormat('Y-m-d', $today);
        $date = $date->addDays($duration);
        return $date->format('Y-m-d');
    }

    public function checkServiceProviderPhone(Request $request)
    {

        $user = auth()->user();

        if (is_null($user)) {
            return response(['message' => 'لا تملك الصلاحية للقيام بهذه العملية'], 401);
        }
        if (auth()->user()->phone == $request->service_provider_phone) {
            return response(['message' => 'عذراً.. لا يمكنك تقديم خدمة لنفسكً'], 403);
        }

        try {

            if (empty($request->service_provider_phone)) {
                return response(['message' => 'يرجى إضافة رقم هاتف مزود الخدمة'], 404);
            }

            $service_provider = User::where('level', 'provider')->where('phone', $request->service_provider_phone)->first();

            if (is_null($service_provider)) {
                return response(['message' => ' لايوجد مزود خدمة بهذا الرقم سوف يتم اضافته'], 200);
            }

            if ($service_provider->work_status == 'offline') {
                return response(['message' => 'عذراً.. مزود الخدمة المختار غير متاح حالياً'], 403);
            }
            if ($service_provider->level != 'provider') {
                return response(['message' => 'عذراً.. يمكنك تقديم الخدمة لمزود الخدمة فقط'], 403);
            }

            return response(['message' => 'مزود الخدمة المختار متاح'], 200);

            //            return response (['name' => $user->name,'bio' => $user->bio], 200);
        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }
}
