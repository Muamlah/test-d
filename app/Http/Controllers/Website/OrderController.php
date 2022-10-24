<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests\Website\PrivateOrder\Store;
use App\Http\Requests\Website\PublicOrderRequest;
use App\Models\Coupon;
use App\Models\CouponInstance;
use App\Models\eservices;
use App\Models\Settings;
use Illuminate\Http\Request;
use DateTime;
use App\Models\ForbiddenWord;
use App\Models\PublicOrder;
use App\Models\PublicOrderOffer;
use App\Notifications\PublicOrderOfferNotify;
use App\Models\Transaction;
use App\Models\WalletMuamlah;
use App\Models\User;
use App\Models\Invoices;
use App\Models\eservices_orders;
use App\Notifications\PrivateOrderNotify;
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
use Throwable;
use App\Notifications\PublicOrderNotify;
use App\Notifications\SendEmailToAdmins;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;
use App\Notifications\SendCustomEmailsToAdmins;
use App\Traits\CommonTrait;
use App\Traits\UserLogTreat;
use App\Models\Status;

/**
 * Class PrivateOrderController
 * @package App\Http\Controllers\Website
 */
class OrderController extends Controller
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

    public function index()
    {
        $this->data['order_status'] = Status::get();
        $this->data['electronic_provider_count'] = 0;
        $this->data['order_offer_count'] = 0;
        if (auth()->check()) {
            $this->data['electronic_provider_count'] = eservices_orders::where('provider_id', auth()->id())->
            whereDate('created_at', '=', Carbon::today()->toDateString())->count();
            $this->data['order_offer_count'] = PublicOrderOffer::where('user_id', auth()->id())->
            whereDate('created_at', '=', Carbon::today()->toDateString())->count();
        }
        return view('website.orders.index', $this->data);

    }

    public function userSeeMore()
    {
//        $user_id=auth()->user()->id;

        $my_orders = PublicOrder::orderBy('updated_at', 'desc')->whereIn('status', [1, 2])
            ->where(function ($q) {
                if (auth()->check()) {
                    $q->where(['status' => '1', 'user_id' => auth()->id()]);
                }
                return $q;
            })->paginate(10);
        $view = view('website.orders.ajax-view.ordersUser', compact('my_orders'))->render();
        return response()->json(['html' => $view]);
    }

    public function providerSeeMore()
    {


        if (auth()->check()) {
            $orders = PublicOrder::whereIn('status', [2])->where('parent_order', 0)->whereDoesntHave('followingOrders')
                ->orderBy('updated_at', 'desc')
                ->paginate(10);
            $view = view('website.orders.ajax-view.ordersProvider', compact('orders'))->render();
        } else {
            $orders = PublicOrder::whereIn('status', [2])->orderBy('updated_at', 'desc')
                ->paginate(10);
            $view = view('website.orders.ajax-view.ordersPublic', compact('orders'))->render();

        }
        return response()->json(['html' => $view]);
    }

    public function eservicesSeeMore()
    {


        $this->data['electronic_provider_count'] = 0;
        if (auth()->check()) {
            $this->data['electronic_provider_count'] = eservices_orders::where('provider_id', auth()->id())->
            whereDate('created_at', '=', Carbon::today()->toDateString())->count();
            $this->data['eservices_orders'] = eservices_orders::whereIn('status', [2])->where('pay_status', 'complete_convert')->orderBy('updated_at', 'DESC')/* ->where('user_id','<>',Auth::id()) */ ->paginate(10);
            $view = view('website.orders.ajax-view.eservicesOrders', $this->data)->render();
        } else {
            $this->data['eservices_orders'] = eservices_orders::whereIn('status', [2])->orderBy('updated_at', 'DESC')->paginate(10);
            $view = view('website.orders.ajax-view.eservicesOrdersPublic', $this->data)->render();

        }
        return response()->json(['html' => $view]);
    }


    /**
     * @param PublicOrderRequest $request
     * @return Application|Factory|View|RedirectResponse|Redirector
     * @throws GuzzleException
     * @throws Throwable
     */
    public function sendEmail($message1, $message2, $email)
    {

        $info = [
            'message1' => $message1,
            'message2' => $message2,
        ];

        Mail::to($email)->send(new SendCustomEmailsToAdmins($info));
    }

    public function store(Request $request)
    {
//        if (request()->has('provider_id')) {
//           echo 1;
//        }

//        exit();
        $chack_balance = $this->checkUserBalance(Auth::user());
        if (!$chack_balance) {
            return back()->with(['error' => 'عذراً لايمكنك انشاء خدمة الكترونية لأنه يوجد خطأ في رصيدك يرجى مراجعة المشرفين']);
        }

        try {
            $settings = Settings::query()->first();
            $public_count = PublicOrder::where('user_id', Auth::id())->
            whereDate('created_at', '=', Carbon::today()->toDateString())->count();
            if ($public_count >= $settings->public_order_limit) {
                return back()->with(['error' => 'عذراً تجاوزت الحد المسموح لعدد الطلبات اليومي']);
            }
            $user = auth()->user();
            $eservices = eservices::findorfail($request->id);
            $order = PublicOrder::create([
                'user_id' => Auth::id(),
                'title' => $eservices->service_name,
                'details' => $request->details,
                'eservices_id' => $request->id,
                'status' => 1
            ]);
            $order->master_order = $order->id;
            if (request()->has('agent') && request()->agent == '1' && !empty($user->agent_id)) {
                $order->agent_id = $user->agent_id;
            }
            if (request()->has('affiliate_id')) {
                $order->affiliate_id = $request->affiliate_id;
            }
            $order->update();

            $admins = Admin::get();
            $message01 = ' خدمة الكترونية رقم '.$order->id.'';
            $message02 = 'خدمة الكترونية من المستخدم  ' . auth()->user()->name . ' رقم# ' . $order->id;
            foreach ($admins as $admin) {
                $this->sendEmail($message01, $message02, $admin->email);
            }

            $message1 = 'اضافة خدمة الكترونية';
            $message2 = ' اضافة خدمة الكترونية رقم ' . '#' . $order->id;

            $this->AddUserLog($user, $message1, $message2, $order->price);

            return redirect()->route('publicOrders.offers.show', $order->id)->with('success', 'تم انشاء طلبك بنجاح يتم الان مراجعة الطلب من قبل المشرف للموافقة عليه');

        } catch (Throwable $throwable) {
            throw $throwable;
        }

    }

    public function storeProvider(Request $request)
    {
//        if (request()->has('provider_id')) {
//           echo 1;
//        }


        $chack_balance = $this->checkUserBalance(Auth::user());
        if (!$chack_balance) {
            return back()->with(['error' => 'عذراً لايمكنك انشاء خدمة الكترونية لأنه يوجد خطأ في رصيدك يرجى مراجعة المشرفين']);
        }

        try {
            $settings = Settings::query()->first();
            $public_count = PublicOrder::where('user_id', Auth::id())->
            whereDate('created_at', '=', Carbon::today()->toDateString())->count();
            if ($public_count >= $settings->public_order_limit) {
                return back()->with(['error' => 'عذراً تجاوزت الحد المسموح لعدد الطلبات اليومي']);
            }
            $provider = User::find($request->provider_id);
            $data = $provider->services()->where('favoriteable_id', $request->id)->first();
            $price = $data->pivot->price;
            $date = $data->pivot->date;
            $user = auth()->user();
            $eservices = eservices::findorfail($request->id);
//            $today = Carbon::now();
            $deadline = Carbon::now()->addDays($date);
//            $datetime1 = new DateTime($today);
//            $datetime2 = new DateTime($deadline);
//            $interval = $datetime1->diff($datetime2);
//            $duration = $interval->format('%a');
//            $offer          = PublicOrderOffer::find($offer_id);
//            $fees       = $this->CalculateServicesFees($offer->price);
//            $total_amount   =  (double)$offer->price;
            $fees = $this->CalculateServicesFees($price);
            $fee = [
                'fee' => round($fees['offer_fee'], 2),
                'tax_amount' => round($fees['offer_added_tax'], 2),
                'deserved_price' => round((double)$price - (double)$fees['offer_fee'] - (double)$fees['offer_added_tax'], 2),
            ];
            $order = new PublicOrder();
            $order->title = $eservices->service_name;
            $order->details = $request->details;
            $order->status = 2;
            $order->user_id = Auth::id();
            $order->provider_id = $request->provider_id;
            $order->price = $price;
            $order->eservices_id = $request->id;
            $order->total_amount = $price;
            $order->client_cancellation = 0;
            $order->deadline = $deadline;
            $order->value_added_tax = $fees['order_added_tax'];
            $order->deserved_price = $fee['deserved_price'];
            $order->payable_service_provider = $fee['deserved_price'];
            $order->provider_value_added_tax = $fee['tax_amount'];
            $order->provider_fees =  $fee['fee'];
            $order->fees =  $fees['order_fee'];
            $order->payment_gateway_fee = $fees['payment_gateway_fee'];
            $order->save();
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
            $order->master_order = $order->id;

            if (request()->has('agent') && request()->agent == '1' && !empty($user->agent_id)) {
                $order->agent_id = $user->agent_id;
            }
            $order->update();

            if (!is_null($agent = $order->agent)) {
                $order->agent_per = $this->calculateAgentAmount($order->total_amount);
                $order->total_amount += $order->agent_per;
                $order->save();
            }
            $admins = Admin::where('user_type', 'order_management')->get();
            $message01 = ' خدمة الكترونية';
            $message02 = 'خدمة الكترونية من المستخدم  ' . auth()->user()->name . ' رقم# ' . $order->id;
            foreach ($admins as $admin) {
                $this->sendEmail($message01, $message02, $admin->email);
            }

            $message1 = 'اضافة خدمة الكترونية';
            $message2 = ' اضافة خدمة الكترونية رقم ' . '#' . $order->id;

            $this->AddUserLog($user, $message1, $message2, $order->price);
            $total_amount = $fees['order_fee'] + $fees['order_added_tax'] + (double)$price;
            $net = $user->available_balance - $total_amount;
            if ($net < 0) {
                $net = $total_amount - $user->available_balance;
                $order->deserved_price = $net;
                $order->save();
                if (config('payment.payment_gateway_type') == 'rajhi_bank') {
                    return redirect(route('rajhiBank.index', ['id' => $order->id, 'type' => 'publicOrder']));
                } else {
                    $data_checkout = $this->paymentGatewayCheckout($net, $order->id);
                    if (isset($data_checkout['id'])) {
                        $order->payment_gateway_checkout_data = $data_checkout;
                        $order->save();
                        return redirect(route('hyperpay.index', ['id' => $order->id, 'type' => 'publicOrderProvider']));
                    } else {
                        return redirect()->back()->with('error', 'عذرا, بوابة الدفع غير متاحة حاليا.');
                    }
                }
            }
        } catch (Throwable $throwable) {
            throw $throwable;
        }

    }


    public function searchWord(Request $request)
    {
        $keyword = $request->keyword;
        $search_explode = explode(" ", $keyword);
        $condition_arr = array();
        foreach ($search_explode as $value) {
            $condition_arr[] = ForbiddenWord::query()->Where('name', $value)->first();
        }

        $finder = ForbiddenWord::query()
            ->Where('name', $keyword)
            ->first();
        return response()->json(['success' => $condition_arr]);

    }


}
