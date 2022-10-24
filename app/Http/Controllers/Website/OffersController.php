<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests\Website\PrivateOrder\Store;
use App\Http\Requests\Website\PublicOrderRequest;
use App\Http\Requests\Website\PublicOrderOfferRequest;
use App\Models\Admin;
use App\Models\Fees;
use App\Models\PrivateOrder;
use App\Models\PublicOrder;
use App\Models\PublicOrderOffer;
use App\Models\Settings;
use App\Notifications\PublicOrderOfferNotify;
use App\Models\Transaction;
use App\Models\WalletMuamlah;
use App\Models\User;
use App\Models\eservices_orders;
use App\Notifications\PrivateOrderNotify;
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
use App\Notifications\PublicOrderNotify;
use DateTime;
use App\Traits\UserLogTreat;
use App\Models\Coupon;
use App\Models\CouponInstance;
/**
 * Class PrivateOrderController
 * @package App\Http\Controllers\Website
 */
class OffersController extends Controller
{

    use SMSTrait;
    use FeesTrait;
    use GrupoTrait;
    use PaymentGatewayTrait;
    use CommonTrait;
    use UserLogTreat;

    /**
     * @return Application|Factory|View
     */

    public function __construct()
    {
        view()->share([
            'fees' => Fees::query()->first(),
        ]);
    }

    public function index($id)
    {
        //        if ($user->can('showOrders',   $this->data['order'])) {
//            return 'yes';
//        }else{
//            return 'no';
//        }
        $user = auth()->user();
        $this->data['order'] = PublicOrder::findOrFail($id);
        if(!$user->chackUserAvailability($this->data['order'])){
            return back()->with(['error' => 'لا يمكنك القيام بهذا الإجراء لأنك لا تمتلك تصريح بذلك!']);
        }
        // $this->authorize('showOrders', $this->data['order']);
        $this->data['offers'] = PublicOrderOffer::where('order_id', $id)->get();
        return view('website.offers.index', $this->data);
    }

    public function create($id)
    {
        if (auth()->user()->level == 'user') {
            abort(404);
        }
        $settings = Settings::query()->first();
        $order_offer_count = PublicOrderOffer::where('user_id', Auth::id())->
        whereDate('created_at', '=', Carbon::today()->toDateString())->count();

        if ($order_offer_count >= $settings->offers_public_order_limit) {
            abort(401);
        }
        $checkOffer = PublicOrderOffer::where('user_id', auth()->user()->id)->
        where('order_id', $id)->first();
        if ($checkOffer) {
            // abort(403);
            return redirect()->route('publicOrders.offers.edit', ['id' => $checkOffer->order_id]);

        }
        $order = PublicOrder::findOrFail($id);
//        $user = auth()->user();

        return view('website.offers.create', [
            'order' => $order,
        ]);


    }

    public function edit($id)
    {
        // $this->authorize('editOffer', PublicOrderOffer::class);

        $user_id = auth()->user()->id;
        $order = PublicOrder::findOrFail($id);
        $offer = PublicOrderOffer::where('user_id', $user_id)->where('order_id', $id)->first();
        if (is_null($offer)) {
            abort(401);
        }
        $fees = $this->CalculatePublicOrderFees($offer->price);
        $fee = [
            'fee' => round($fees['offer_fee'], 2),
            'tax_amount' => round($fees['offer_added_tax'], 2),
            'deserved_price' => round((double)$offer->price - (double)$fees['offer_fee'] - (double)$fees['offer_added_tax'], 2),
        ];

        return view('website.offers.edit', [
            'offer' => $offer,
            'order' => $order,
            'fee' => $fee,
        ]);
    }

    public function show($id)
    {
        // $this->authorize('showOrders', PublicOrder::class);
        $user_id = auth()->user()->id;
        $item = PublicOrder::findOrFail($id);

        return view('website.offers.show', [
            'item' => $item,
        ]);
    }

    public function addOffer(PublicOrderOfferRequest $request, $id)
    {
        if (auth()->user()->level != "provider") {
            abort(401);
        }
        $checkOffer = PublicOrderOffer::where('user_id', auth()->user()->id)->where('order_id', $id)->first();
        if ($checkOffer) {
            abort(403);
        }

        // $chack_balance = $this->checkUserBalance(auth()->user());
        // if(!$chack_balance)
        // {
        //     return back()->with(['error' => 'عذراً لايمكنك إضافة عرض لأنه يوجد خطأ في رصيدك يرجى مراجعة المشرفين']);
        // }

        try {
            $today = Carbon::now();
            $deadline = Carbon::parse($request->date . ' ' . '00:00:00');
            $datetime1 = new DateTime($today);
            $datetime2 = new DateTime($deadline);
            $interval = $datetime1->diff($datetime2);
            $duration = $interval->format('%a');
            $fees = $this->CalculateServicesFees($request->price);
            $fee = [
                'fee' => round($fees['offer_fee'], 2),
                'tax_amount' => round($fees['offer_added_tax'], 2),
                'deserved_price' => round((double)$request->price - (double)$fees['offer_fee'] - (double)$fees['offer_added_tax'], 2),
            ];
            $offer = new PublicOrderOffer();
            $offer->user_id = Auth::id();
            $offer->order_id = $id;
            $offer->price = $request->price;
            $offer->duration = $duration;
            $offer->date = $request->date;
            $offer->time = '00:00:00';
            $offer->deadline = $deadline;
            $offer->fees = $fee['fee'];
            $offer->tax_amount = $fee['tax_amount'];
            $offer->deserved_price = $fee['deserved_price'];
            $offer->save();
            $order = PublicOrder::find($id);
            $user = User::where('id', $order->user_id)->first();
            Notification::send($user, new PublicOrderNotify($order));
            if(!is_null($agent = $order->agent)){
                $message = [
                    'message' => 'تم إضافة عرض جديد للخدمة رقم '.$order->id,
                    'link' => route('publicOrders.offers.show',$order->id),
                ];
                Notification::send($agent, new \App\Notifications\NotifyAgent([], $message));
            }
            $message1           = 'اضافة عرض سعر';
            $message2           = ' اضافة عرض سعر رقم ' . '#' . $offer->id;

            $this->AddUserLog($user,$message1,$message2,$offer->price);

            return redirect(route('orders.index'))->with('success', 'تم اضافة عرضك بنجاح !');

        } catch (Throwable $throwable) {
            throw $throwable;
        }

    }

    public function editOffer(PublicOrderOfferRequest $request, $id)
    {

        if (auth()->user()->level != "provider") {
            abort(401);
        }
//        if($order->status == 1){
//            return back()->with('error', 'الطلب قيد المراجعة');
//        }
        try {
            $today = Carbon::now();
            $deadline = Carbon::parse($request->date . ' ' . '00:00:00');
            $datetime1 = new DateTime($today);
            $datetime2 = new DateTime($deadline);
            $interval = $datetime1->diff($datetime2);
            $duration = $interval->format('%a');
            $fees = $this->CalculatePublicOrderFees($request->price);
            $fee = [
                'fee' => round($fees['offer_fee'], 2),
                'tax_amount' => round($fees['offer_added_tax'], 2),
                'deserved_price' => round((double)$request->price - (double)$fees['offer_fee'] - (double)$fees['offer_added_tax'], 2),
            ];
            $offer = PublicOrderOffer::with('order')->where('user_id', auth()->user()->id)->findOrFail($id);
            $order = $offer->order;
            if ($order->status != 2) {
                return back()->with('error', 'لم يعد بإمكانك تعديل العرض لأن حالة الطلب قد تغيرت');
            }
            $offer->price = $request->price;
            $offer->duration = $duration;
            $offer->date = $request->date;
            $offer->time = '00:00:00';
            $offer->deadline = $deadline;
            $offer->fees = $fee['fee'];
            $offer->tax_amount = $fee['tax_amount'];
            $offer->deserved_price = $fee['deserved_price'];
            $offer->save();

            return back()->with('success', 'تم تعديل عرضك بنجاح !');

        } catch (Throwable $throwable) {
            throw $throwable;
        }

    }

    public function calculatePrice(Request $request)
    {
        try {
//            $fees = $this->CalculatePublicOrderFees($request->price);
            $fees = Fees::first();
            $fee = ($request->price / 100 * $fees['service_client_fees']);
            $response = [
                'fee' => round($fee, 2),
                'tax_amount' => round((($fees['value_added_tax'] / 100) * $fee), 2),
                'deserved_price' => round((double)$request->price - (double)$fee - (double)(($fees['value_added_tax'] / 100) * $fee), 2),
            ];
            return response()->json(["error" => 0, "message" => $response]);
        } catch (Exception $e) {
            return response()->json(["error" => 1, "message" => $e->getMessage()]);
        }
    }

    public function acceptOffer($offer_id, $order_id)
    {
//        if (auth()->user()->level != 'user') {
//            abort(404);
//        }
        try {
            $offer      = PublicOrderOffer::find($offer_id);
            $order      = PublicOrder::findOrFail($order_id);
            $user       = User::where('id', $order->user_id)->first();
//            $fees       = $this->CalculatePublicOrderFees($offer->price);
//            $deadline   = $offer->deadline;
            // $deserved_price_provider=(double)$offer->price -  $fees['offer_fee'] - (double)$fees['offer_added_tax'] ;
            //
            // $deserved_price = (double)$offer->price -  $fees['offer_fee'] - (double)$fees['offer_added_tax'] ;
            $fees = $this->CalculateServicesFees($offer->price);
            if(request()->coupon_code && !request()->reference_code){
                $coupon = Coupon::where('type', 'coupon')->where('code', request()->coupon_code)->first();
                $coupon_result = $this->couponValidation($coupon, $user);
                if(!$coupon_result['success']){
                    return back()->with('error', $coupon_result['message']);
                }
                $coupon_discount = $this->calculateDiscount($coupon, $fees['order_fee']);
                $provider_discount = $this->calculateOwnerDiscount($coupon, $fees['order_fee']);
                $instance = CouponInstance::create_new($coupon, $user, $coupon_discount, $provider_discount);
                $fees['order_fee']= $fees['order_fee'] - $coupon_discount;

                $instance->entity_id = $order->id;
                $instance->entity_type = PublicOrder::class;
                $instance->save();
            }
            $total_amount = $fees['order_fee'] + $fees['order_added_tax'] + (double)$offer->price;
            $order->total_amount=$total_amount;
            $order->update();
            $message1           = 'قبول عرض سعر';
            $message2           = ' قبول عرض سعر رقم ' . '#' . $offer->id;
            $this->AddUserLog($user,$message1,$message2,$offer->price);
            $net = $user->available_balance - $total_amount;
            if ($net < 0) {
                $net                    = $total_amount - $user->available_balance;
                $order->deserved_price  = $net;
                $order->save();
                if (config('payment.payment_gateway_type') == 'rajhi_bank') {
                    return redirect(route('rajhiBank.index', ['id' => $order->id, 'type' => 'publicOrder']));
                } else {
                    $data_checkout = $this->paymentGatewayCheckout($net, $order->id);
                    if (isset($data_checkout['id'])) {
                        $order->payment_gateway_checkout_data = $data_checkout;
                        $order->save();
                        return redirect(route('hyperpay.index', ['id' => $order->id, 'type' => 'publicOrder','offer_id' => $offer_id]));
                    } else {
                        return redirect(route('publicOrders.offers.show'))->with('hyperpay_error', 'عذرا, بوابة الدفع غير متاحة حاليا.');
                    }
                }
            } else {

                return redirect(route('balance.public_order_index', ['id' => $order->id,'offer_id' => $offer_id]));

            }

        } catch (Throwable $throwable) {
            throw $throwable;
        }

    }



//    public function acceptOffer($offer_id,$order_id)
//    {
//        try {
//            // $user = User::findOrfail(Auth::id());
//            $offer=PublicOrderOffer::find($offer_id);
//            $fees = $this->CalculatePublicOrderFees($offer->price);
//            $deadline =$offer->deadline;
//
//
//            PublicOrder::where('id',$order_id)->update([
//                'provider_id' => $offer->user_id,
//                'price' => $offer->price,
//                'fees' => $fees['order_fee'],
//                'total_amount' => $fees['order_fee'] + $fees['value_added_tax'] + (double)$offer->price ,
//                'status' => 3 ,
//                'deadline' => $deadline ,
//                'deserved_price' =>(double)$offer->price - $fees['offer_fee'],
//                'client_cancellation' => $fees['client_cancellation'],
//                'value_added_tax' => $fees['value_added_tax'],
//                'payment_gateway_fee' => $fees['payment_gateway_fee'],
//            ]);
//            $order=PublicOrder::find($order_id);
//
//            //انشاء قروب محادثة
//            $group = $this->createGroup("تعميد عام رقم #' . $order_id", false);
//
////ارسال ايميل الى المشرف و نتفكيشن لمقدم الخدمة
//
//            $adminUsers = User::where('level', 'admin')->orWhere('id', Auth::id())->get();
//            Notification::send($adminUsers, new PublicOrderNotify($order));
//
//            $checkProvider = User::where('id', $offer->user_id)->first();
//
//            if (isset($group->groupid)) {
//                $this->addUserToGroup($group->groupid, $order->user->phone);
//                $this->addUserToGroup($group->groupid, $offer->user->phone);
//            }
//            $url = 'https://app.muamlah.com/private-service/';
//
//            $msg = "عزيزي مقدم الخدمة" . "\n" . "تم قبول عرضك على الطلب رقم #" . ' ' . $order->id .
//                "\n" . "رابط الخدمة" . " " . $url;
//
//            $this->sendSMS($offer->user->phone, $msg);
//
//            $user = User::where('id', $order->user_id)->first();
//            $provider = User::where('phone', $offer->user->phone)->first();
//            Notification::send($provider, new PublicOrderOfferNotify($order));
//
//            $total_cost = $fees['order_fee'] + $fees['value_added_tax'] + (double)$offer->price;
//            $net = $user->available_balance - $total_cost;
//
//            if ($net <= 0) {
//                $data_checkout = $this->paymentGatewayCheckout($total_cost, $order->id);
//                if (isset($data_checkout['id'])) {
//                    $order->payment_gateway_checkout_data = $data_checkout;
//                    $order->save();
//                    return redirect(route('hyperpay.index', ['id'=>$order->id,'type'=>'publicOrder']));
//
//                } else {
//                    return redirect(route('publicOrders.offers.show'))->with('hyperpay_error', 'عذرا, بوابة الدفع غير متاحة حاليا.');
//                }
//            } else {
//                $user->available_balance = $net;
//                $user->pinding_balance = $user->pinding_balance + $total_cost;
//                $user->update();
//                $transaction = new Transaction();
//                $transaction->user_id = $user->id;
//                $transaction->amount = $total_cost;
//                $transaction->type = 'withdrawal';
//                $transaction->description = " تعميد عام رقم #' . $order->id";
//                $transaction->save();
//                return redirect(route('publicOrders.offers.show',$offer->id))->with('hyperpay_success', 'تم الخصم من رصيدك');
//            }
//
//        } catch (Throwable $throwable) {
//            throw $throwable;
//        }
//
//    }


}
