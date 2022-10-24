<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\EservicesOrder\EserviceOrderCollection;
use App\Models\{eservices_orders, PrivateOrder, PublicOrder, Settings, User, Fees};
use App\Models\Transaction;
use App\Models\WalletMuamlah;
use App\Traits\CommonTrait;
use App\Traits\PaymentGatewayTrait;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Auth;
use App\Notifications\EserviceNotify;
use App\Notifications\EserviceAcceptNotify;
use App\Notifications\ChangeStatusNotify;
use App\Notifications\StatusUpdateEservicesOrderNotify;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Notification;
use App\Traits\FeesTrait;
use App\Traits\GrupoTrait;
use App\Traits\SMSTrait;
use Throwable;
use App\Models\Coupon;
use App\Models\CouponInstance;
use App\Models\Status;
use App\Models\eservices;
use App\Http\Resources\Eservices\EservicesCollection;
use App\Notifications\NewMessageNotify;
use App\Models\Message;
use App\Models\Admin;
use App\Notifications\SendEmailToAdmins;
use App\Traits\UserLogTreat;
use App\Models\OrderLog;
use DB;

/**
 * Class EservicesOrdersController
 * @package App\Http\Controllers
 */
class EservicesOrdersController extends Controller
{

//    use SMSTrait;
    use FeesTrait;
    use GrupoTrait;
    use PaymentGatewayTrait;
    use CommonTrait;
    use UserLogTreat;


    public function __construct()
    {
        // PREMISSIONS MIDDLEWARE
//        $this->middleware('auth:admin');
        // $this->middleware('permission:READ_ELECTRONIC_ORDER', ['only' => ['list']]);
        // $this->middleware('permission:UPDATE_ELECTRONIC_ORDER', ['only' => ['edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|RedirectResponse|Response|Redirector
     * @throws Throwable
     */
    public function update_status_client($order_id, $status, Request $request)
    {
        try {
            $user = auth()->user();
            $item = eservices_orders::where('id', $order_id)
                ->where('pay_status', 'complete_convert')
                ->first();

            if (!$user->chackUserAvailability($item)) {
                return back()->with(['error' => 'لا يمكنك القيام بهذا الإجراء لأنك لا تمتلك تصريح بذلك!']);
            }
            if (!$item->chechAvailableStatus($status)) {
                return back()->with(['error' => 'لايمكنك تغيير حالة هذه الخدمة للحالة المختارة']);
            }
            if ($status == '6') {
                $item->cancel_reason = $request->cancel_reason;
            }
            $notify_user = !is_null($item->agent_id) ? $item->agent : $item->user;

            if ($item == null) {
                return redirect('my-orders');
            }

            if (is_null($item->providers) && $status == '6') {

                $status = '7';

                $item->verify = true;
                $fees = Fees::first();
                $user = User::find($item->user_id);
                $this->userBalance($user, false, $item->total_amount, $fees->service_cancellation);
                $this->walletMuamlah($fees->service_cancellation, $item->price, $item->id, 'electronic', 'deposit', 'رسوم الغاء خدمة اكترونية');
                // send notification to user
                if ($user->level == 'user') {
                    Notification::send($notify_user, new ChangeStatusNotify($item, '6', 'eservices_orders/show/' . $item->id . ''));
                }

            }

            $status_name = Status::find($status);
            $message1 = 'تم تغيير الحالة';
            if (!empty($status_name)) {
                $message2 = 'تم تغيير حالة  طلب الخدمة الإلكترونية رقم #' . $item->id . ' إلى الحالة ' . $status_name->name;
            } else {
                $message2 = 'تم تغيير حالة  طلب الخدمة الإلكترونية رقم #' . $item->id;
            }

            $this->AddUserLog(auth()->user(), $message1, $message2, $item->price);

            if ($status == '5') {
                $user = User::find($item->user_id);
                $phone = $user->phone;
                if (auth()->user()->id == $item->agent_id) {
                    $phone = auth()->user()->phone;
                }
                $password = $request->password;

                if ($request->code && $request->code == $item->verify_code) {

                    $provider = User::find($item->provider_id);
                    if (!is_null($item->payment_status)) {
                        $this->newTransaction($item->user_id, $item->total_amount, $item->id, 'electronic', 'withdrawal', "$item->id سحب رصيد الخدمة الإلكترونية رقم ");
                    }
                    $amount = ($item->price - ($item->provider_value_added_tax + $item->provider_fees));
                    $this->newTransaction($item->user_id, $amount, $item->id, 'electronic', 'deposit', "$item->id ايداع رصيد  الخدمة الإلكترونية  رقم ");
                    $this->userBalanceDiscount($user, $item->total_amount);
                    $this->providerBalance($provider, $amount);
                    $this->walletMuamlah(($item->value_added_tax + $item->fees + $item->provider_value_added_tax + $item->provider_fees), $item->price, $item->id, 'electronic', 'deposit', 'ايداع عمولة  الخدمة الإلكترونية');
                    $item->status = '5';
                    $item->verify = true;
                    $item->update();
                    Notification::send($notify_user, new ChangeStatusNotify($item, '5', 'eservices_orders/show/' . $item->id . ''));
                    Notification::send($provider, new ChangeStatusNotify($item, '5', 'eservices_orders/myservice_details/' . $item->id . ''));
                    $instance = $item->coupone_instance;
                    if (!is_null($instance) && $instance->owner_discount != 0) {
                        $this->newTransaction($instance->owner_id, $instance->owner_discount, $instance->id, 'gift', 'deposit', ' تم شحن الرصيد باستخدام كود الحسم ' . $instance->code . ' للطلب رقم: ' . $item->id);
                        $this->walletMuamlah($instance->owner_discount, $item->price, $item->id, 'electronic', 'withdrawal', 'سحب عمولة كوبون  الخدمة الإلكترونية');
                        $this->providerBalance($instance->owner, $instance->owner_discount);

                    }
                    if (!is_null($agent = $item->agent)) {
                        $this->newTransaction($agent->id, $item->agent_per, $item->id, 'gift', 'deposit', " ايداع رصيد عمولة الخدمة الإلكترونية  رقم $item->id");
                        $this->providerBalance($agent, $item->agent_per);

                    }
                    return redirect("/user/reviews-form/eservice-order/$order_id/$item->provider_id"); // send id of inserted

                } elseif ($request->password && Auth::attempt(['phone' => $phone, 'password' => $password])) {

                    $provider = User::find($item->provider_id);
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
                    // }

                    return redirect("/user/reviews-form/eservice-order/$order_id/$item->provider_id"); // send id of inserted
//                    return back()->with(['success' => 'تم تأكيد استلام الطلب !']);

                } else {
                    return back()->with(['error' => 'كلمة المرور او رمز التحقق المدخل خاطيء !']);
                }
            } elseif ($status == '8') {
                $provider = User::find($item->provider_id);

                Notification::send($notify_user, new ChangeStatusNotify($item, '8', 'eservices_orders/show/' . $item->id . ''));
                if (!empty($provider)) {
                    Notification::send($provider, new ChangeStatusNotify($item, '8', 'eservices_orders/myservice_details/' . $item->id . ''));
                }
                $item->status = $status;
                $item->save();
                $message = new Message();
                $message->user_id = $user ? $user->id : NULL;
                $message->name = $user->name;
                $message->subject = 'إبلاغ على طلب خدمة إلكترونية رقم :' . $item->id;
                $message->email = $user->email;
                $message->message = $request->message;
                $message->entity_id = $item->id;
                $message->entity_type = eservices_orders::class;
                $message->save();
                return redirect('eservices_orders/show/' . $order_id);
            } else {
                $item->status = $status;
                $item->save();
                return redirect('eservices_orders/show/' . $order_id);
            }

        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }

    /**
     * @return JsonResponse
     */
    public function seeMore()
    {
        $publicOrders = PublicOrder::where('user_id', Auth::id())
            ->orderBy('updated_at', 'DESC');
        if(request()->has('filter') && !empty($filter = request()->filter)){
            $order_status = Status::get();
            $array_filter = [];
            foreach($filter as $item){
                $state = $order_status->find($item);
                if(!empty($state)){
                    $array_filter[] = $state->status;
                }
            }
            $publicOrders = $publicOrders->whereIn('status', $array_filter);
        }
        $publicOrders = $publicOrders->paginate(10);
        $view = view('website.eservices_orders.ajax-view.data',compact('publicOrders'))->render();
        return response()->json(['html'=>$view]);
    }

    /**
     * @return JsonResponse
     */
    public function providerSeeMore(): JsonResponse
    {

        $publicOrders = PublicOrder::where('provider_id', Auth::user()->id)
            ->where('pay_status', 'complete_convert')
            ->orderBy('updated_at', 'DESC')
            ->paginate(10);
        $view = view('website.privateService.ajax-view.eservices_data', compact('publicOrders'))->render();
        return response()->json(['html' => $view]);
    }

    public function open_chat($id)
    {
        $exists = Message::where('entity_id', $id)->where('entity_type', eservices_orders::class)->exists();
        if (!$exists) {
            $order = eservices_orders::whereNotIn('status', [1, 5])->findOrFail($id);
            $user_id2 = $order->provider_id;
            if ($user_id2 == Auth::id()) {
                $user_id2 = $order->user_id;
            }
            $message = new Message();
            $message->user_id = Auth::id();
            $message->user_id2 = $user_id2;
            $message->subject = 'طلب خدمة إلكترونية رقم ' . $id;
            $message->message = 'طلب خدمة إلكترونية رقم ' . $id;
            $message->entity_id = $id;
            $message->entity_type = eservices_orders::class;
            $message->save();
            $message->users()->sync([
                Auth::id() => ['entity_type' => User::class],
                $user_id2 => ['entity_type' => User::class]
            ]);
        } else {
            $message = Message::where('entity_id', $id)->where('entity_type', eservices_orders::class)->first();
        }
        return redirect(route('chat.start', $message->id));
    }


    /**
     * @param $id
     * @return Application|JsonResponse|RedirectResponse|Redirector
     * @throws GuzzleException
     * @throws Throwable
     */
    public function sendSMSOTP($id)
    {
        try {
            $item = eservices_orders::where('id', $id)->where('status', '!=', '5')->where('user_id', Auth::id())->first();

            if ($item == null) {
                return redirect('my-orders');
            }
            $code = rand(1000, 9999);
            $phone = Auth::user()->phone;
            $item->verify_code = $code;
            $item->update();
            $msg = 'رمز التحقق OTP :' . "\n" . $code;
            $this->sendSMS($phone, $msg);
            return response()->json(['success' => 1, 'message' => 'تمت العملية بنجاح', 'user' => Auth::user()]);
        } catch (Throwable $throwable) {

            throw $throwable;
        }
    }

    /**
     * @param $order_id
     * @param $status
     * @return Application|RedirectResponse|Redirector
     * @throws Throwable
     */
    public function update_status($order_id, $status)
    {
        try {

            $item = eservices_orders::where('id', $order_id)->where('provider_id', Auth::id())->first();
//            if ($item == null) {
//                return redirect('private-service');
//            }
//            if ($status == '4' && $item->pay_status != 'complete_convert') {
//                return back()->with(['error' => 'لايمكنك تسليم الخدمة لأنه لم يتم الدفع من قبل العميل']);
//            }
            if ($item->status == '8') {
                return back()->with(['error' => 'لايمكنك تغيير حالة هذه الخدمة لأنه يوجد بلاغ']);
            }

            if ($status == '4' && $item->status == '6') {
                return back()->with(['error' => 'لايمكنك تسليم الطلب لأن صاحب الطلب قام بإلغاء الطلب']);
            }
            $notify_user = !is_null($item->agent_id) ? $item->agent : $item->user;
            if ($item->provider_id == Auth::id()) {
                DB::beginTransaction();
                if ($status == '7') {
                    $item->verify = true;
                    $fees = Fees::first();
                    $user = User::find($item->user_id);
                    $this->userBalance($user, false, $item->total_amount, $fees->service_cancellation);
                    $this->walletMuamlah($fees->service_cancellation, $item->price, $item->id, 'electronic', 'deposit', 'رسوم الغاء خدمة اكترونية');
                    $this->newTransaction($user->id, ($item->total_amount - $fees->service_cancellation), $item->id, 'eservices', 'deposit', "ايداع رصيد خدمة اكترونيةس رقم $item->id ");
                    Notification::send($notify_user, new ChangeStatusNotify($item, '7', 'eservices_orders/show/' . $item->id . ''));
                    Notification::send(auth()->user(), new ChangeStatusNotify($item, '7', 'eservices_orders/myservice_details/' . $item->id . ''));
                } elseif ($status == '4') {
                    $user = User::find($item->user_id);
                    Notification::send($notify_user, new ChangeStatusNotify($item, '4', 'eservices_orders/show/' . $item->id . ''));
                    Notification::send(auth()->user(), new ChangeStatusNotify($item, '4', 'eservices_orders/myservice_details/' . $item->id . ''));
                } elseif ($status == '8') {

                    $user = User::find($item->user_id);
                    $current_user = auth()->user();
                    $message = new Message();
                    $message->user_id = $current_user ? $current_user->id : NULL;
                    $message->name = $current_user->name;
                    $message->subject = 'إبلاغ على طلب خدمة إلكترونية رقم :' . $item->id;
                    $message->email = $current_user->email;
                    $message->message = request()->message;
                    $message->entity_id = $item->id;
                    $message->entity_type = eservices_orders::class;
                    $message->save();

                    Notification::send($notify_user, new ChangeStatusNotify($item, '8', 'eservices_orders/show/' . $item->id . ''));
                    Notification::send(auth()->user(), new ChangeStatusNotify($item, '8', 'eservices_orders/myservice_details/' . $item->id . ''));
                }
                $item->status = $status;
                $item->save();
                DB::commit();
            }
            else {
                abort(401);
            }
        } catch (Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }


        return redirect('eservices_orders/myservice_details/' . $order_id);
    }

    /**
     * @param $order_id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function show_myservice($order_id)
    {

        $fees = Fees::first();
        $item = eservices_orders::where('id', $order_id)->where('provider_id', Auth::id())->first();
        $eservices = eservices::findorfail($item->eservice_id);
        $chat_message = $item->open_chat();
        if ($item == null) {
            return redirect('private-service');
        } else {
            return view('website/eservices_orders/myservice_details', compact('item', 'fees', 'eservices', 'chat_message'));
        }
    }


    /**
     * @param $order_id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function show_order($order_id)
    {
        $user = auth()->user();
        $fees = Fees::first();
        $item = eservices_orders::where('id', $order_id)->first();
        if (!$user->chackUserAvailability($item)) {
            return redirect('my-orders');
        }
        $chat_message = $item->open_chat();
        return view('website/eservices_orders/show', compact('item', 'fees', 'chat_message'));
    }


    /**
     * @param $order_id
     * @return Application|RedirectResponse|Redirector
     */
    public function accept($order_id)
    {
        $settings = Settings::query()->first();

        $check_balance = $this->checkUserBalance(auth()->user());
        if (!$check_balance) {
            return back()->with(['error' => 'عذراً لايمكنك قبول الخدمة لأنه يوجد خطأ في رصيدك يرجى مراجعة المشرفين']);
        }

        $electronic_provider_count = eservices_orders::where('provider_id', Auth::id())->
        whereDate('created_at', '=', Carbon::today()->toDateString())->count();
        if ($electronic_provider_count >= $settings->electronic_order_provider_limit) {
            abort(401);
        }
        if (auth()->user()->level != 'provider') {
            abort(401);
        }

        $eservices_order = eservices_orders::findorfail($order_id);
        if ($eservices_order->provider_id) {
            return redirect('/orders')->with('error', 'تم قبول الخدمة من شخص اخر');
        }


        $eservices_order->provider_id = Auth::id();
        $eservices_order->status = '3';
        $eservices_order->save();

        $notify_user = !is_null($eservices_order->agent_id) ? $eservices_order->agent : $eservices_order->user;
        $message1 = 'قبول خدمة إلكترونية';
        $message2 = 'تم قبول الخدمة الإلكترونية من قبل مزود الخدمة';
        $this->AddUserLog(auth()->user(), $message1, $message2, $eservices_order->price);
        return redirect('/eservices_orders/myservice_details/' . $order_id)->with('success', 'تم قبول الخدمة بنجاح');
    }


    public function list()
    {
        // $eservices_orders = eservices_orders::all();

        $all_status         = eservices_orders::whereNotNull('id')->orderBy('id', 'DESC')->select('status')->get();
        $pending            = clone $all_status->where('status',1);
        $waiting            = clone $all_status->where('status',2);
        $processing         = clone $all_status->where('status',3);
        $completed          = clone $all_status->where('status',4);
        $confirm_completed  = clone $all_status->where('status',5);
        $canceled           = clone $all_status->where('status',6);
        $confirm_canceled   = clone $all_status->where('status',7);
        $report             = clone $all_status->where('status',8);

        return view('admin.eservices_orders.list',compact('pending','waiting','processing','completed','confirm_completed','canceled','confirm_canceled','report'));
    }

    public function get_all(Request $request)
    {
        $page = $request->input('pagination.page', '1');
        $search = $request->input('query.generalSearch', null);
        $perpage = $request->input('pagination.perpage', 10);
        $sortOrder = $request->input('sort.sort', 'asc');
        $sortField = $request->input('sort.field', 'id');
        $offset = ($page - 1) * $perpage;
        $query = eservices_orders::with('eservices', 'user', 'provider', 'paymentMathod');
        // $query = eservices_orders::with('eservices','user','provider');
        // dd($request->input('query.status'));
        if ($request->input('query.status') != null) {
            $query->where('status', $request->input('query.status'));
        }
        if ($request->input('query.pay_status') != null) {
            $query->where('pay_status', $request->input('query.pay_status'));
        }
        if ($request->input('query.amount_from') != null) {
            $query->where('price', '>=', $request->input('query.amount_from'));
        }

        if ($request->input('query.amount_to') != null) {
            $query->where('price', '<=', $request->input('query.amount_to'));
        }

        if ($request->input('query.date_from') != null) {
            $query->where('created_at', '>=', $request->input('query.date_from'));
        }

        if ($request->input('query.date_to') != null) {
            $query->where('created_at', '<=', $request->input('query.date_to'));
        }
        if ( $request->input('query.order_number')!=null ) {
            $query->where('id',$request->input('query.order_number'));
        }
        if ($request->input('query.phone') != null) {
            $query->whereHas('user', function ($q) use ($request) {
                return $q->where('phone', 'like', '%' . $request->input('query.phone') . '%');
            })->orWhereHas('provider', function ($q) use ($request) {
                return $q->where('phone', 'like', '%' . $request->input('query.phone') . '%');
            });
        }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField, $sortOrder);
        $data = $query->get();

        $request->offsetSet('pages', ceil($totalCount / $perpage));
        $request->offsetSet('total', $totalCount);
        return (new EserviceOrderCollection($data));
    }

//    public function details($id)
//    {
//
//        $eservices_orders = eservices_orders::findorfail($id);
//        return view('website/eservices_orders/details', compact('eservices_orders'));
//
//    }


    public function create()
    {
        return view('admin.eservices_orders.create');
    }

    public function addPrice($order_id, $service_id, $slug)
    {

        $status = Settings::getSetting('eservices_orders_status');
        if ($status != 'active') {
            return view('website.passive');
        }
        $settings = Settings::query()->first();
        $electronic_user_count = eservices_orders::where('user_id', Auth::id())->whereDate('created_at', '=', Carbon::today()->toDateString())->count();

        if ($electronic_user_count >= $settings->electronic_order_limit) {
            abort(401);
        }

        $eservices = eservices::findorfail($service_id);
        $eservices_order = eservices_orders::where('id', $order_id)->where('user_id', Auth::id())->first();

        $fees = Fees::first();
        $e_fees = ($eservices->price / 100 * $fees['service_client_fees']);
        $value_added_tax = (($fees['value_added_tax'] / 100) * ($eservices->price / 100 * $fees['service_client_fees']));
        $total_amount = $eservices->price + $e_fees + $value_added_tax;
        $users = Auth::user();
        $net = $users->available_balance - $total_amount;

        if ($eservices_order == null) {
            return redirect('my-orders');
        } else {
            return view('website/eservices_orders/add_price', compact('eservices', 'eservices_order', 'net'));
        }
    }

    public function addPricePost(Request $request)
    {
        // dd($request->all());
        $users = Auth::user();
        $status = Settings::getSetting('eservices_orders_status');
        if ($status != 'active') {
            return view('website.passive');
        }

        $order = eservices_orders::where('user_id', Auth::user()->id)->where('eservice_id', $request->eservice_id)
            ->findOrFail($request->order_id); // get service order


        $has_coupon = false;
        $instance = $order->coupone_instance;
        if (!empty($instance)) {
            $coupon = Coupon::findOrFail($instance->coupon_id);
            $has_coupon = true;
        }
        $coupon_discount = 0;

        $fees = Fees::first();
        $all_price = $order->price + $request->price;
        $fee = ($all_price / 100 * $fees['service_client_fees']);
        $total_cost = ($all_price + $order->fees + $order->value_added_tax) - $order->total_amount;

        if ($has_coupon) {
            $coupon_discount = $this->calculateDiscount($coupon, $fee);
            $provider_discount = $this->calculateOwnerDiscount($coupon, $fee);
            // $instance               = CouponInstance::create_new($coupon, $users, $coupon_discount, $provider_discount);
            $fee = $fee - $coupon_discount;
        }

        // dd($order->price+$order->fees+$order->value_added_tax);
        // dd($all_price + $order->fees +  $order->value_added_tax,$order->total_amount);
        if (!empty($request->details)) {
            $eservices = eservices::findorfail($request->eservice_id);
            $eservices->details = $request->details;
            $eservices->save();
        }

        $order_log = OrderLog::where('order_id', $order->id)->firstOrNew();
        $order_log->order_id = $order->id;
        $order_log->fees = $fee;
        $order_log->provider_fees = ($all_price / 100 * $fees['service_platform_fee']);
        $order_log->price = $all_price;
        $order_log->value_added_tax = (($fees['value_added_tax'] / 100) * $fee);
        $order_log->provider_value_added_tax = (($fees['value_added_tax'] / 100) * ($all_price / 100 * $fees['service_platform_fee']));
        $order_log->total_amount = $all_price + $fee + $order_log->value_added_tax;
        $order_log->provider_total_amount = $all_price - ($order_log->provider_fees + $order_log->provider_value_added_tax);
        $order_log->diff_amount = $total_cost;
        if ($has_coupon) {
            $order_log->amount = $coupon_discount;
            $order_log->provider_discount = $provider_discount;
        }
        $order_log->save();

        // $total_cost                             = $order_log->total_amount;
        // $net                                    = $users->available_balance - $total_cost;
        $net = $users->available_balance - $total_cost;

        $order->order_log = 'yes';
//        $order->pay_status  = 'processing_convert';
        $order->save();

        if ($net < 0) {
            $net = $total_cost - $users->available_balance;
            $order_log->deserved_price = $net;
            $order_log->update();

            if (config('payment.payment_gateway_type') == 'rajhi_bank') {


                return redirect(route('rajhiBank.index', ['id' => $order->id, 'type' => 'eservices']));
            } else {
                $data_checkout = $this->paymentGatewayCheckout($net, $order->id);
                if (isset($data_checkout['id'])) {
                    $order->payment_gateway_checkout_data = $data_checkout;
                    $order->save();
                    return redirect(route('hyperpay.index', ['id' => $order->id, 'type' => 'eservices']));
                } else {
                    return redirect('eservices')->with('error', 'عذرا, بوابة الدفع غير متاحة حاليا.');
                }
            }
        } else {
            return redirect(route('balance.eservicePay', ['id' => $order->id]));
        }

        // $admins         = Admin::get();
        // $message1       = 'تم اضافة سعر جديد لخدمة الكترونية';
        // $message2       = ' اضافة سعر جديد لخدمة الكترونية رقم ' . '#' . $order->id;
        // $link           = route('weblist');


    }

    public function payEservice($order_id)
    {
        $users = auth()->user();
        $eservice = eservices_orders::where('user_id', $users->id)->findOrFail($order_id);
        $total_cost = $eservice->total_amount;
        $net = $users->available_balance - $total_cost;

        if ($net < 0) {
            $net = $total_cost - $users->available_balance;
            if ($net > 0) {
                $this->newTransaction($users->id, $users->available_balance, $eservice->id, 'electronic', 'withdrawal', "سحب رصيد للخدمة الكترونية رقم $eservice->id ");
            }
            $eservice->deserved_price = $net;
            $eservice->update();
            $this->WithdrawingFromBalance($users, $total_cost);

            if (config('payment.payment_gateway_type') == 'rajhi_bank') {
                return redirect(route('rajhiBank.index', ['id' => $eservice->id, 'type' => 'eservices']));
            } else {
                $data_checkout = $this->paymentGatewayCheckout($net, $eservice->id);
                if (isset($data_checkout['id'])) {
                    $eservice->payment_gateway_checkout_data = $data_checkout;
                    $eservice->save();
                    return redirect(route('hyperpay.index', ['id' => $eservice->id, 'type' => 'eservices']));
                } else {
                    return redirect('eservices')->with('error', 'عذرا, بوابة الدفع غير متاحة حاليا.');
                }
            }

        } else {
            return redirect(route('balance.eservicePay', ['id' => $eservice->id]));
        }
    }

    public function store()
    {

        $users = Auth::user();

        $settings = Settings::query()->first();
        $electronic_user_count = eservices_orders::where('user_id', Auth::id())->whereDate('created_at', '=', Carbon::today()->toDateString())->count();
        if ($electronic_user_count >= $settings->electronic_order_limit) {
            abort(401);
        }

        // chack balance
        $check_balance = $this->checkUserBalance($users);
        if (!$check_balance) {
            return back()->with(['error' => 'عذراً لايمكنك التقديم على الخدمة لأنه يوجد خطأ في رصيدك يرجى مراجعة المشرفين']);
        }

        $status = Settings::getSetting('eservices_orders_status');
        if ($status != 'active') {
            return view('website.passive');
        }
        $eservice = eservices_orders::create($this->validateData() + ['user_id' => Auth::id()]); // insert
        $order = $eservice;
        if (request()->has('provider_id')) {
            $eservice->provider_id = request()->provider_id;
        }
        $has_coupon = false;
        if (request()->coupon_code) {
            $coupon = Coupon::where('type', 'coupon')->where('code', request()->coupon_code)->first();
            $coupon_result = $this->couponValidation($coupon, $users);
            if (!$coupon_result['success']) {
                return back()->with('error', $coupon_result['message']);
            }
            $has_coupon = true;

        }
        $coupon_discount = 0;
        $fees = Fees::first();
        $fee = ($eservice->eservices->price / 100 * $fees['service_client_fees']);
        if ($has_coupon) {
            $coupon_discount = $this->calculateDiscount($coupon, $fee);
            $owner_discount = $this->calculateOwnerDiscount($coupon, $fee);
            $instance = CouponInstance::create_new($coupon, $users, $coupon_discount, $owner_discount);
            $fee = $fee - $coupon_discount;
        }
        $has_reference_code = false;
        $eservice->fees = $fee;
        $eservice->provider_fees = ($eservice->eservices->price / 100 * $fees['service_platform_fee']);
        $eservice->price = $eservice->eservices->price;
        $eservice->value_added_tax = (($fees['value_added_tax'] / 100) * $eservice->fees);
        $eservice->provider_value_added_tax = (($fees['value_added_tax'] / 100) * ($eservice->eservices->price / 100 * $fees['service_platform_fee']));
        $eservice->total_amount = $eservice->eservices->price + $eservice->fees + $eservice->value_added_tax;
        $eservice->provider_total_amount = $eservice->eservices->price - ($eservice->provider_fees + $eservice->provider_value_added_tax);
        if (request()->has('agent') && request()->agent == '1' && !empty($users->agent_id)) {
            $eservice->agent_id = $users->agent_id;
            $eservice->agent_per = $this->calculateAgentAmount($eservice->total_amount);
            $eservice->total_amount += $eservice->agent_per;
        }
        $eservice->save();
        if ($has_coupon) {
            $instance->entity_id = $eservice->id;
            $instance->entity_type = eservices_orders::class;
            $instance->save();
        }
//        $admins = Admin::get();
//        $message1 = 'تم ارسال طلب جديد';
//        $message2 = ' طلب خدمة الكترونية رقم ' . '#' . $eservice->id;
//        $link = route('weblist');
//        Notification::send($admins, new SendEmailToAdmins($message1, $message2, $link));


        $message1 = 'اضافة خدمة الكترونية';
        $message2 = ' اضافة خدمة الكترونية رقم ' . '#' . $order->id;

        $this->AddUserLog($users, $message1, $message2, $order->price);

        $total_cost = $eservice->total_amount;

        $net = $users->available_balance - $total_cost;

        if ($net < 0) {
            $net = $total_cost - $users->available_balance;
            if ($net > 0) {
                $this->newTransaction($users->id, $users->available_balance, $eservice->id, 'electronic', 'withdrawal', "سحب رصيد للخدمة الكترونية رقم $eservice->id ");
            }
            $eservice->deserved_price = $net;
            $eservice->update();
            $this->WithdrawingFromBalance($users, $total_cost);


            if (config('payment.payment_gateway_type') == 'rajhi_bank') {
                return redirect(route('rajhiBank.index', ['id' => $eservice->id, 'type' => 'eservices']));
            } else {
                $data_checkout = $this->paymentGatewayCheckout($net, $eservice->id);
                if (isset($data_checkout['id'])) {
                    $eservice->payment_gateway_checkout_data = $data_checkout;
                    $eservice->save();
                    return redirect(route('hyperpay.index', ['id' => $order->id, 'type' => 'eservices']));
                } else {
                    return redirect('eservices')->with('error', 'عذرا, بوابة الدفع غير متاحة حاليا.');
                }
            }

        } else {
            return redirect(route('balance.eservicePay', ['id' => $eservice->id]));
        }
//
//        $item = eservices_orders::where('id',$order->id)->first();
//        if(!$users->chackUserAvailability($item)){
//            return redirect('my-orders');
//        }
//        return view('website/eservices_orders/show',compact('item','fees'));
    }

    public function show(eservices_orders $eservices_orders)
    {
        //
    }


    public function edit(eservices_orders $eservices_orders)
    {
        $status = Status::where('id','!=',9);
        if (!can('COMPLETED_ORDERS')) {
            $status = $status->where('status', '!=', 'confirm_completed');
        }
        if (!can('CANCELED_ORDERS')) {
            $status = $status->where('status', '!=', 'confirm_canceled');
        }
        $status = $status->get();
        return view('admin.eservices_orders.edit', compact('eservices_orders', 'status'));
    }


    public function update(Request $request, eservices_orders $eservices_orders)
    {
        if(
            ($request->status == 3 || $request->status == 4 || $request->status == 5 || $request->status == 6)
            && ($eservices_orders->provider_id == 0 || empty($eservices_orders->provider_id))
        ){
            return redirect('/admin/eservices_orders/'. $eservices_orders->id . "/edit")->with('error', 'Error');
        }

        $check_status = Status::find($request->status);
        if ($check_status->status == 'confirm_completed') {
            if (!can('COMPLETED_ORDERS')) {
                abort(403);
            }
        }
        if ($check_status->status == 'confirm_canceled') {
            if (!can('CANCELED_ORDERS')) {
                abort(403);
            }
        }
        if($request->status == 5 ||  $request->status == 10)
        {
            $item = $eservices_orders;
            if(empty($item->provider_id)){

                abort(404);
            }
            $provider = User::find($item->provider_id);
            $user = User::find($item->user_id);
            $notify_user = !is_null($item->agent_id) ? $item->agent : $item->user;
            if(!is_null($item->payment_status)){
                $this->newTransaction($item->user_id,$item->total_amount,$item->id,'electronic','withdrawal',"سحب رصيد خدمة الكترونية  رقم $item->id ");
            }
            $amount = ($item->price - ($item->provider_value_added_tax + $item->provider_fees));
            $this->newTransaction($provider->id,$amount,$item->id,'electronic','deposit',"ايداع رصيد  خدمة الكترونية  رقم $item->id ");
            $this->userBalanceDiscount($user,$item->total_amount);
            $this->providerBalance($provider,$amount);
            $this->walletMuamlah(($item->value_added_tax + $item->fees+$item->provider_value_added_tax+$item->provider_fees),$item->price, $item->id,'electronic','deposit','ايداع عمولة طلب خدمة الكترونية');
            $item->status = '5';
            $item->verify = true;
            $item->update();
            $instance = $item->coupone_instance;
            if(!is_null($instance) && $instance->owner_discount != 0){
                $this->newTransaction($instance->owner_id, $instance->owner_discount, $instance->id, 'gift', 'deposit', " تم شحن الرصيد باستخدام كود الحسم" . $instance->code ."للطلب رقم: " .  $item->id);
                $this->walletMuamlah( $instance->owner_discount,$item->price, $item->id,'electronic','withdrawal','سحب عمولة كوبون طلب خدمة الكترونية');
                $this->providerBalance($provider,$instance->owner_discount);


            }
            if(!is_null($agent = $item->agent)){
                $this->newTransaction($agent->id, $item->agent_per, $item->id, 'gift', 'deposit', " ايداع رصيد عمولة خدمة الكترونية  رقم $item->id");
                $this->providerBalance($agent,$item->agent_per);

            }
            Notification::send($notify_user, new ChangeStatusNotify($item,'5','eservices_orders/show/'.$item->id.''));
            Notification::send($provider, new ChangeStatusNotify($item,'5','eservices_orders/myservice_details/'.$item->id.''));
        }

        elseif($request->status == 7 ||  $request->status == 9)
        {
            $eservices_orders->verify   = true;
            $fees                       = Fees::first();
            $user                       = User::find($eservices_orders->user_id);
            $this->userBalance($user,false,$eservices_orders->total_amount,$fees->service_cancellation);
            $this->walletMuamlah($fees->service_cancellation,$eservices_orders->price, $eservices_orders->id,'electronic','deposit','رسوم الغاء خدمة اكترونية');

            $eservices_orders->status = 7;
            $eservices_orders->save();
        }

        $eservices_orders->update($this->validateData());

        $description = '
            تم تعديل حالة الخدمة رقم ' . $eservices_orders->id . '
            إلى الحالة
            ' . Status::find($request->status)->name . '
        ';
        $this->addLog('تعديل حالة خدمة الكترونية ', $description);

        return redirect('/admin/eservices_orders/' . $eservices_orders->id . '/edit')->with('success', 'تم التحديث بنجاح');

    }


    public function destroy(eservices_orders $eservices_orders)
    {


        $eservices_orders->delete();
        return redirect('/admin/eservices_orders');
    }


    protected function validateData()
    {


        $mydata = [
            'details' => 'required',
            'eservice_id' => 'required',
            'status' => 'required',
        ];

        if (request()->hasFile('header_img')) {
            $mydata['header_img'] = 'file|image';
        }

        $validatedData = request()->validate($mydata);
        return $validatedData;


    }

    public function notify_customers()
    {
        $from = Carbon::now()->subHours(48)->format('Y-m-d H:i:s');
        $to = Carbon::now()->subHours(24)->format('Y-m-d H:i:s');
        $orders = eservices_orders::with('user')->where('provider_id', 0)->where('created_at', '>', $from)->where('created_at', '<', $to)->get();
        foreach ($orders as $order) {
            $message = [
                'message' => 'لا يوجد مقدم خدمة متاح الآن ، قد يكونوا في خدمة عملاء آخرين ، حاول لاحقا',
                'link' => '',
            ];
            $notify_user = !is_null($order->agent_id) ? $order->agent : $order->user;
            Notification::send($notify_user, new StatusUpdateEservicesOrderNotify($order, $message));
            echo 'success' . $order->id . ' <br/>';
        }
    }

}
