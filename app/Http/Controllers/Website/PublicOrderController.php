<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests\Website\PrivateOrder\Store;
use App\Http\Requests\Website\PublicOrderRequest;
use App\Http\Requests\Website\PublicOrderOfferRequest;
use App\Models\Invoices;
use App\Models\PrivateOrder;
use App\Models\Fees;
use App\Models\PublicOrder;
use App\Models\PublicOrderOffer;
use App\Models\Settings;
use App\Notifications\EditPrivateOrderNotify;
use App\Notifications\PublicOrderOfferNotify;
use App\Models\Transaction;
use App\Models\WalletMuamlah;
use App\Models\User;
use App\Models\eservices_orders;
use App\Notifications\PrivateOrderNotify;
use App\Traits\FeesTrait;
use App\Traits\CommonTrait;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Mail;
use Illuminate\Http\Request;
use Throwable;
use App\Notifications\PublicOrderNotify;
use App\Notifications\ReceivePublicOrderNotify;
use App\Notifications\FinishPublicOrderNotify;
use App\Models\Message;
use App\Models\Admin;
use App\Notifications\SendEmailToAdmins;
use App\Notifications\StatusUpdatePublicOrderNotify;
use App\Traits\UserLogTreat;
use App\Models\Status;

/**
 * Class PrivateOrderController
 * @package App\Http\Controllers\Website
 */
class PublicOrderController extends Controller
{

    use SMSTrait;
    use FeesTrait;
    use CommonTrait;
    use GrupoTrait;
    use PaymentGatewayTrait;
    use UserLogTreat;


    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function seeMore()
    {
//        $publicOrders = PublicOrder::with('provider','user')->where('user_id', Auth::id())
//            ->orderBy('updated_at', 'DESC');
        $privateOrders = PrivateOrder::with('provider','user')->where('user_id', Auth::id())
             ->where('pay_status','complete_convert')
            ->orderBy('updated_at', 'DESC');
        if(request()->has('filter') && !empty($filter = request()->filter)){
//            $publicOrders = $publicOrders->whereIn('status', $filter);
            $privateOrders = $privateOrders->whereIn('status_id', $filter);
        }
//        $publicOrders = $publicOrders->paginate(5);
        $privateOrders = $privateOrders->paginate(10);
        $orders = collect([]);
//        foreach($publicOrders as $order){
//            $item = new \stdClass;
//            $item->id = $order->id;
//            $item->type = "public";
//            $item->provider_id = !is_null($order->provider) ? $order->provider->id : "";
//            $item->provider_name = !is_null($order->provider) ? $order->provider->name : "";
//            $item->user_name = !is_null($order->user) ? $order->user->name : "";
//            $item->provider_phone = !is_null($order->provider) ? $order->provider->phone : "";
//            $item->user_phone = !is_null($order->user) ? $order->user->phone : "";
//            $item->status_id = $order->status;
//            $item->pay_status = $order->pay_status;
//            $item->status_name = $order->statusName();
//            $item->created_at = $order->created_at;
//            $item->formated_created_at = $order->created_at->format('d-m-Y');
//            $orders->push($item);
//        }
        foreach($privateOrders as $order){
            $item = new \stdClass;
            $item->id = $order->id;
            $item->type = "private";
            $item->provider_id = !is_null($order->provider) ? $order->provider->id : "";
            $item->user_name = !is_null($order->user) ? $order->user->name : "";
            $item->provider_name = !is_null($order->provider) ? $order->provider->name : "";
            $item->provider_phone = !is_null($order->provider) ? $order->provider->phone : "";
            $item->user_phone = !is_null($order->user) ? $order->user->phone : "";
            $item->status_id = $order->status_id;
            $item->pay_status = $order->pay_status;
            $item->status_name = $order->statusName();
            $item->created_at = $order->created_at;
            $item->formated_created_at = $order->created_at->format('d-m-Y');
            $orders->push($item);
        }
        $orders = $orders->sortByDesc('created_at');
        // $view = view('website.orders.ajax-view.data', compact('orders'))->render();
        $view = view('website.privateOrders.ajax-view.row', compact('orders'))->render();
        return response()->json(['html' => $view]);
    }
    public function seeMoreMarket(){

        if(auth()->check()){
            $user_id            = auth()->user()->id;
            $eservices_orders   = eservices_orders::whereIn('status', [1, 2])->where('pay_status', 'complete_convert')->with('eservices')->whereHas('eservices')
            ->where(function($q){
                return $q->whereNull('provider_id')->orWhere('provider_id', '0');
            });
            if(auth()->user()->level == "provider"){
                $public_orders      = PublicOrder::whereDoesntHave('followingOrders')->whereIn('status', [2])
                ->orderBy('created_at','desc')->where('parent_order', 0);
            }
            if(auth()->user()->level == "user"){
                $public_orders = PublicOrder::whereIn('status', [2])->where(function($q){
                    if(auth()->check()){
                        $q->where([ 'user_id' => auth()->id()]);
                    }
                    return $q;
                })->orderBy('created_at','desc');
            }
        }
        else
        {
            $eservices_orders   = eservices_orders::whereIn('status', [1, 2])->where('pay_status', 'complete_convert')->where(function($q){
                return $q->whereNull('provider_id')->orWhere('provider_id', '0');
            })->orderBy('created_at','desc');
            $public_orders      = PublicOrder::whereIn('status', [2])->orderBy('created_at','desc')->where('parent_order', 0);
        }
        if(request()->has('filter') && !empty($filter = request()->filter)){
            $eservices_orders   = $eservices_orders->whereIn('status', $filter);
            $public_orders      = $public_orders->whereIn('status', $filter);
        }
        if(request()->has('input_val') && !empty($input_val = request()->input_val)){
            // dd($input_val = request()->input_val);
            $eservices_orders           = $eservices_orders->where('details', 'like', '%' . $input_val . '%');
            $public_orders              = $public_orders->where('details', 'like', '%' . $input_val . '%');
        }

        $eservices_orders       = $eservices_orders->paginate(5);
        $public_orders          = $public_orders->paginate(5);

        $orders = collect([]);
        foreach($eservices_orders as $order){
            $item                       = new \stdClass;
            $item->id                   = $order->id;
            $item->type                 = "eservice";
            $item->provider_id          = !is_null($order->provider) ? $order->provider->id : "";
            $item->user_name            = !is_null($order->user) ? $order->user->name : "";
            $item->provider_name        = !is_null($order->provider) ? $order->provider->name : "";
            $item->provider_phone       = !is_null($order->provider) ? $order->provider->phone : "";
            $item->user_phone           = !is_null($order->user) ? $order->user->phone : "";
            $item->status_id            = $order->status;
            $item->pay_status           = $order->pay_status;
            $item->status_name          = $order->statusName();
            $item->status_html          = $order->getHtmlStatus('float-left');
            $item->order_owner          = !is_null($order->user) ? $order->user->checkOrderFromLabel($order) : '';
            $item->created_at           = $order->created_at;
            $item->formated_created_at  = $order->created_at->format('d-m-Y');
            $item->service_name         = !empty($order->eservices) ? $order->eservices->service_name : '';
            $item->service_image        = $order->eservices->img;
            $item->service_price        = $order->eservices->price;
            $orders->push($item);
        }
        foreach($public_orders as $order){
            $item                       = new \stdClass;
            $item->id                   = $order->id;
            $item->type                 = "public";
            $item->provider_id          = !is_null($order->provider) ? $order->provider->id : "";
            $item->provider_name        = !is_null($order->provider) ? $order->provider->name : "";
            $item->user_name            = !is_null($order->user) ? $order->user->name : "";
            $item->provider_phone       = !is_null($order->provider) ? $order->provider->phone : "";
            $item->user_phone           = !is_null($order->user) ? $order->user->phone : "";
            $item->status               = $order->status;
            $item->pay_status           = $order->pay_status;
            $item->status_name          = $order->statusName();
            $item->status_html          = $order->getHtmlStatus();
            $item->order_owner          = !is_null($order->user) ? $order->user->checkOrderFromLabel($order) : '';
            $item->created_at           = $order->created_at;
            $item->formated_created_at  = $order->created_at->format('d-m-Y');
            $item->title                = $order->title;
            $item->details              = $order->details;
            $item->user_id              = $order->user_id;
            $orders->push($item);

        }
        $orders = $orders->sortByDesc('created_at');
        $electronic_provider_count = 0;
        if(auth()->check()){
            $electronic_provider_count = eservices_orders::where('provider_id',auth()->id())->
            whereDate('created_at', '=', Carbon::today()->toDateString())->count();

        }
        $order_offer_count = PublicOrderOffer::where('user_id', Auth::id())->
        whereDate('created_at', '=', Carbon::today()->toDateString())->count();
        $view = view('website.privateOrders.ajax-view.market', compact('orders', 'electronic_provider_count','order_offer_count'))->render();
        return response()->json(['html' => $view]);

    }

    public function seeMoreMyService(){

        $eservicesOrders            = eservices_orders::where('provider_id', Auth::id())->where('pay_status','complete_convert')
            ->orderBy('updated_at', 'DESC');
        $privateOrders = PrivateOrder::with('provider','user')->where('provider_id', Auth::user()->id)->where('pay_status','complete_convert')
            ->orderBy('updated_at', 'DESC');
        $publicOrders = PublicOrder::with('provider','user')->where('provider_id', Auth::user()->id)->where('pay_status','complete_convert')
            ->orderBy('updated_at', 'DESC');


        if(request()->has('filter') && !empty($filter = request()->filter)){
            $publicOrders           = $publicOrders->whereIn('status', $filter);
            $privateOrders          = $privateOrders->whereIn('status_id', $filter);
            $eservicesOrders        = $eservicesOrders->whereIn('status', $filter);
        }

        if(request()->has('input_val') && !empty($input_val = request()->input_val)){
            $publicOrders           = $publicOrders->where('details', 'like', '%' . $input_val . '%');
            $privateOrders          = $privateOrders->where('details', 'like', '%' . $input_val . '%');
            $eservicesOrders        = $eservicesOrders->where('details', 'like', '%' . $input_val . '%');
        }

        $publicOrders               = $publicOrders->paginate(5);
        $privateOrders              = $privateOrders->paginate(5);
        $eservicesOrders            = $eservicesOrders->paginate(5);

        $orders = collect([]);
        foreach($eservicesOrders as $order){
            $item                       = new \stdClass;
            $item->id                   = $order->id;
            $item->type                 = "eservice";
            $item->provider_id          = !is_null($order->provider) ? $order->provider->id : "";
            $item->user_name            = !is_null($order->user) ? $order->user->name : "";
            $item->provider_name        = !is_null($order->provider) ? $order->provider->name : "";
            $item->provider_phone       = !is_null($order->provider) ? $order->provider->phone : "";
            $item->user_phone           = !is_null($order->user) ? $order->user->phone : "";
            $item->status_id            = $order->status;
            $item->pay_status           = $order->pay_status;
            $item->status_name          = $order->statusName();
            $item->status_html          = $order->getHtmlStatus('float-left');
            $item->order_owner          = !is_null($order->user) ? $order->user->checkOrderFromLabel($order) : '';
            $item->created_at           = $order->created_at;
            $item->formated_created_at  = $order->created_at->format('d-m-Y');
            $item->service_name         = !empty($order->eservices) ? $order->eservices->service_name : '';
            $orders->push($item);
        }
        foreach($publicOrders as $order){
            $item                       = new \stdClass;
            $item->id                   = $order->id;
            $item->type                 = "public";
            $item->provider_id          = !is_null($order->provider) ? $order->provider->id : "";
            $item->provider_name        = !is_null($order->provider) ? $order->provider->name : "";
            $item->provider_phone       = !is_null($order->provider) ? $order->provider->phone : "";
            $item->user_name            = !is_null($order->user) ? $order->user->name : "";
            $item->user_phone           = !is_null($order->user) ? $order->user->phone : "";
            $item->status_id            = $order->status;
            $item->status_name          = $order->statusName();
            $item->created_at           = $order->created_at;
            $item->formated_created_at  = $order->created_at->format('d-m-Y');
            $orders->push($item);
        }
        foreach($privateOrders as $order){
            $item                       = new \stdClass;
            $item->id                   = $order->id;
            $item->type                 = "private";
            $item->provider_id          = !is_null($order->provider) ? $order->provider->id : "";
            $item->provider_name        = !is_null($order->provider) ? $order->provider->name : "";
            $item->provider_phone       = !is_null($order->provider) ? $order->provider->phone : "";
            $item->user_name            = !is_null($order->user) ? $order->user->name : "";
            $item->user_phone           = !is_null($order->user) ? $order->user->phone : "";
            $item->status_id            = $order->status_id;
            $item->status_name          = $order->statusName();
            $item->created_at           = $order->created_at;
            $item->formated_created_at  = $order->created_at->format('d-m-Y');
            $orders->push($item);
        }

        $orders = $orders->sortByDesc('created_at');

        $view = view('website.privateOrders.ajax-view.my_service', compact('orders'))->render();
        return response()->json(['html' => $view]);
    }

    public function open_chat ($id)
    {
        $exists=Message::where('entity_id',$id)->where('entity_type', PublicOrder::class)->first();

        if (!$exists) {
            $order = PublicOrder::findOrFail($id);
            $user_id2 = $order->provider_id;
            if($user_id2 == Auth::id()){
                $user_id2 = $order->user_id;
            }
            $message = new Message();
            $message->user_id = Auth::id();
            $message->user_id2 = $user_id2;
            $message->subject = 'خدمة الكترونية رقم '.$id;
            $message->message = 'خدمة الكترونية رقم '.$id;
            $message->entity_id = $id;
            $message->entity_type = PublicOrder::class;
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

    public function showDetails($id)
    {
        $item = PublicOrder::findOrFail($id);
        $message = $item->open_chat();
        return view('website.myOrders.showDetails',[
            'item'=>$item,
            'chat_message'=>$message,
        ]);
    }

    public function edit($id)
    {
        $order = PublicOrder::findOrFail($id);
        if ($order->status == 8) {
            return back()->with(['error' => 'لايمكنك تغيير حالة هذا الطلب بسبب وجود بلاغ']);
        }
        if ($order->status == 9) {
            return back()->with(['error' => 'لايمكنك تغيير حالة هذا الطلب لأنه غير موافق عليه']);
        }
        $user = auth()->user();
        if($order->user_id != $user->id){
            abort(403);
        }
        return view('website.myOrders.edit',[
            'order'=>$order,
        ]);
    }

    /**
     * ارسال رسالة
     * @param $id
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function sendSMSOTP($id): JsonResponse
    {
        try {
        $item = PublicOrder::findOrFail($id);
        $code = rand(1000, 9999);
        $phone = Auth::user()->phone;
        $item->update(['verify_code' => $code]);
        $msg = 'لتأكيد استلامك الطلب' . "\n" . "ادخل الرمز ". $code .  "\n" .
            'تنبيه : لا تشارك هذا الرمز ابدا مع اي شخص لحماية حسابك' ;
        $this->sendSMS($phone, $msg);
        return response()->json(["error" => 0,"message" => 'تمت العملية بنجاح', 'user' => Auth::user()]);
    } catch (Exception $e) {
        return response()->json(["error" => 1, "message" => '00000']);
           }
    }



    /**
     * @param PublicOrderRequest $request
     * @return Application|Factory|View|RedirectResponse|Redirector
     * @throws GuzzleException
     * @throws Throwable
     */
    public function store(PublicOrderRequest $request)
    {
        $user = auth()->user();
        $status = Settings::getSetting('public_orders_status');
        if($status != 'active'){
            return view('website.passive');
        }
        try {

            $order = PublicOrder::create($request->all() + [
                'user_id' => Auth::id(),
                'status' => 1
            ]);
            if(request()->has('agent') && request()->agent == '1' && !empty($user->agent_id))
            {

                $order->agent_id = $user->agent_id;
                $order->save();
            }
            return redirect()->route('publicOrders.offers.show',$order->id)->with('success', 'طلبك قيد المراجعة ، عند التفعيل يمكنك اختيار عرض من مقدمي الخدمات');

        } catch (Throwable $throwable) {
            throw $throwable;
        }

    }

    /**
     * @param PublicOrderRequest $request
     * @return Application|Factory|View|RedirectResponse|Redirector
     * @throws GuzzleException
     * @throws Throwable
     *
     */

    public function updateStatus($id, $status, Request $request)
    {
        try {
            $user = auth()->user();
            $phone = $user->phone;
            $password = $request->password;
            $item = PublicOrder::findOrFail($id);
            if(!$user->chackUserAvailability($item)){
                return back()->with(['error' => 'لا يمكنك القيام بهذا الإجراء لأنك لا تمتلك تصريح بذلك!']);
            }
            if(!$item->chechAvailableStatus($status)){
                return back()->with(['error' => 'لايمكنك تغيير حالة هذه الخدمة للحالة المختارة']);
            }
            if ($item->status == 8) {
                return back()->with(['error' => 'لايمكنك تغيير حالة هذا الطلب بسبب وجود بلاغ']);
            }
            if ($item->status == 9) {
                return back()->with(['error' => 'لايمكنك تغيير حالة هذا الطلب لأنه غير موافق عليه']);
            }
            $notify_user = !is_null($item->agent_id) ? $item->agent : $item->user;
            $status_name    = Status::find($status);
            $message1       = 'تم تغيير الحالة';
            if(!empty($status_name)){
                $message2       = "تم تغيير حالة  طلب التعميد العام رقم #".$item->id . ' إلى الحالة ' . $status_name->name;
            }else{
                $message2       = "تم تغيير حالة  طلب التعميد العام رقم #".$item->id;
            }
            $this->AddUserLog($user,$message1,$message2,$request->amount);

            if ($status == 8) {
                DB::beginTransaction();
                $item->status = 8;
                $item->update();
                $message = new Message();
                $message->user_id = $user ? $user->id : NULL;
                $message->name = $user->getName();
                $message->subject = "إبلاغ على طلب التعمبد العام رقم :".$id;
                $message->email = $user->email;
                $message->message = $request->message;
                $message->entity_id = $id;
                $message->entity_type = PublicOrder::class;
                $message->save();
                $data = [
                    'message' => "تم فتح نزاع  لطلب التعميد العام رقم #".$item->id,
                    'link' => route('publicOrders.showDetails', $item->id),
                ];
                Notification::send([$item->provider,$notify_user], new StatusUpdatePublicOrderNotify($item, $data));
                DB::commit();
                return back()->with(['success' => 'تم وضع الطلب في حالة إبلاغ']);
            }
            $provider = User::where('id', $item->provider_id)->first();
            if ($status == 2) {
                $item->status = 3;
                $item->update();
                return back()->with(['success' => 'تمت العملية بنجاح !']);
            }
            elseif ($status == 3) {
                $item->status = 4;
                $item->update();
                return back()->with(['success' => 'تمت العملية بنجاح !']);

            }
            elseif ($status == 4 && $item->status!=5) {
                $user = User::find($item->user_id);
                $phone = $user->phone;
                if(auth()->user()->id == $item->agent_id){
                    $phone = auth()->user()->phone;
                }
                if (($request->code && $request->code == $item->verify_code) || ($request->password)) {
                    DB::beginTransaction();
                    $data = PublicOrder::where('master_order', $item->master_order)->get();
                    foreach ($data as $key => $value) {
                        // $order_provider = User::where('phone', $value->service_provider_phone)->first();
                        $order_provider = User::where('id', $value->provider_id)->first();
                        $order_user     = User::find($value->user_id);
                        $amount = $value->payable_service_provider;
                        if ($value->parent_order == 0) {
                            $total_amount = $value->total_amount ;
                        } else {
                            $total_amount = $value->payable_service_provider;
                        }
                        if(!is_null($value->payment_status)){
                            $this->newTransaction($value->user_id, $total_amount, $value->id, 'public', 'withdrawal', "سحب رصيد خدمة الكترونية رقم $value->id ");
                        }
                        if ($value->parent_order == 0) {
                            $this->userBalanceDiscount($user, $total_amount - $item->agent_per);
                            if ($value->total_amount - $total_amount != 0) {
                                $this->newTransaction($user->id, ($value->total_amount - $total_amount), $item->id, 'public', 'deposit', " استرجاع مبلغ من  خدمة الكترونية  رقم $item->id");
                                $this->ReturnRestToBalance($user, ($value->total_amount - $total_amount));
                            }
                        } else {
                            $this->providerBalanceDiscount($order_user, $total_amount);
                        }
                        $this->newTransaction($order_provider->id, $amount, $value->id, 'public', 'deposit', "ايداع رصيد خدمة الكترونية رقم $value->id ");
                        $this->providerBalance($order_provider, $amount);
                    }
                    $this->walletMuamlah(($item->provider_value_added_tax + $item->provider_fees + $item->fees +$item->value_added_tax ), $item->price, $item->id, 'public', 'deposit', "ايداع عمولة خدمة الكترونية رقم $item->id ");
                    PublicOrder::where('master_order', $item->master_order)->update(['status' => 5, 'verify' => 'yes']);
                    $instance = $item->coupone_instance;
                    if(!is_null($instance) && $instance->owner_discount != 0){
                        $this->newTransaction($instance->owner_id, $instance->owner_discount, $instance->id, 'gift', 'deposit', " تم شحن الرصيد باستخدام كود الحسم" . $instance->code ."للطلب رقم: " .  $item->id);
                        $this->walletMuamlah($instance->owner_discount, $item->price, $item->id, 'private', 'withdrawal', "سحب عمولة كوبون على خدمة الكترونية رقم $item->id ");
                        $this->providerBalance($instance->owner,$instance->owner_discount);
                    }

                    if( $item->affiliate_id != 0){
                        $this->newTransaction($item->affiliate_id,(($item->fees / 100 * Settings::getSetting('affiliate') )  ), $item->id, 'gift', 'deposit', "ارباح من التسويق بالعمولة");
                        $this->walletMuamlah((($item->fees / 100 * Settings::getSetting('affiliate') )  ), $item->price, $item->id, 'private', 'withdrawal', "سحب تسويق بالعمولة للخدمة الكترونية رقم $item->id ");
                        $this->providerBalance(User::find($item->affiliate_id) ,(($item->fees / 100 * Settings::getSetting('affiliate') )  ));
                    }
                    if(!is_null($agent = $item->agent)){
                        $this->newTransaction($agent->id, $item->agent_per, $item->id, 'gift', 'deposit', " ايداع  عمولة  خدمة الكترونية  رقم $item->id");
                        $this->providerBalance($agent,$item->agent_per);
                        $this->userBalanceDiscount($user,  $item->agent_per);
                        $this->newTransaction($user->id, $item->agent_per, $item->id, 'gift', 'withdrawal', " سحب عمولة وكيل  خدمة الكترونية رقم $item->id");
                    }
                    Notification::send($order_provider, new FinishPublicOrderNotify($item));
                    DB::commit();
                    return redirect("/user/reviews-form/public-order/$item->id/$order_provider->id"); // send id of inserted

                } else {
                    return back()->with(['error' => 'كلمة المرور او رمز التحقق المدخل خاطيء !']);
                }
            }
            elseif ($status == 6) {
                if(!$user->chackUserAvailability($item)){
                    return back()->with(['error' => 'لا يمكنك القيام بهذا الإجراء لأنك لا تمتلك تصريح بذلك!']);
                }
                $item->cancel_reason = $request->cancel_reason;
                if (Carbon::now() < $item->deadline) {
//                    $item->status = 6;
//                    $item->cancellation = 'user';
//                    $item->update();
                    PublicOrder::where('master_order', $item->master_order)->update(['status' => 6, 'cancellation' => 'user', 'verify' => 'yes']);

                    $data = [
                        'message' => "تم  الغاء  طلب التعميد العام رقم $item->id من طرف العميل ",
                        'link' => route('publicService.show', $item->id),
                    ];
                    Notification::send($provider, new StatusUpdatePublicOrderNotify($item, $data));
                } else {
                    DB::beginTransaction();
//                    $item->status = 7;
//                    $item->cancellation = 'user';
//                    $item->update();
                    PublicOrder::where('master_order', $item->master_order)->update(['status' => 7, 'cancellation' => 'user', 'verify' => 'yes']);

                    $fees = Fees::first();
                    $this->userBalance($user, false, $item->total_amount, $fees->service_cancellation);
                    $this->newTransaction($user->id, ($item->total_amount - $fees->service_cancellation), $item->id, 'public', 'deposit', "ايداع رصيد الغاء خدمة الكترونية رقم $item->id ");
                    $this->walletMuamlah($fees->service_cancellation, $item->price, $item->id, 'public', 'deposit', "رسوم الغاء طلب خدمة الكترونية رقم $item->id");
                    $data = [
                        'message' => "تم تاكيد الغاء  طلب التعميد العام رقم $item->id من طرف العميل ",
                        'link' => route('publicService.show', $item->id),
                    ];
                    Notification::send($provider, new StatusUpdatePublicOrderNotify($item, $data));
                    DB::commit();
                }

                return back()->with(['success' => 'تمت العملية بنجاح !']);
            }elseif ($status == 7 && $item->status == 6) {
                DB::beginTransaction();
//                $item->status =7;
//                $item->cancellation='user';
//                $item->update();
                PublicOrder::where('master_order', $item->master_order)->update(['status' => 7, 'cancellation' => 'user', 'verify' => 'yes']);

                $fees = Fees::first();
                $this->userBalance($user, false, $item->total_amount, $fees->service_cancellation);
                $this->newTransaction($user->id, ($item->total_amount - $fees->service_cancellation), $item->id, 'public', 'deposit', "ايداع رصيد الغاء خدمة الكترونية رقم $item->id ");
                $this->walletMuamlah($fees->service_cancellation, $item->price, $item->id, 'public', 'deposit', "رسوم الغاء طلب خدمة الكترونية رقم $item->id");
                $data = [
                    'message' => "تم تاكيد الغاء  طلب التعميد العام رقم $item->id من طرف العميل ",
                    'link' => route('publicService.show', $item->id),
                ];
                Notification::send($provider, new StatusUpdatePublicOrderNotify($item, $data));
                DB::commit();
                return back()->with(['success' => 'تمت العملية بنجاح !']);
            }
        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }

public function notify_customers(){
    $from = \Carbon\Carbon::now()->subHours(48)->format('Y-m-d H:i:s');
    $to = \Carbon\Carbon::now()->subHours(24)->format('Y-m-d H:i:s');
    $orders = PublicOrder::with('user')->whereDoesntHave('offers')->whereIn('status', [1,2])->where('created_at','>', $from)->where('created_at','<', $to)->get();
    foreach($orders as $order){
        $message = [
            'message' => "لا يوجد مقدم خدمة متاح الآن ، قد يكونوا في خدمة عملاء آخرين ، حاول لاحقا",
            'link' => '',
        ];
        $notify_user = !is_null($order->agent_id) ? $order->agent : $order->user;
        Notification::send($notify_user, new StatusUpdatePublicOrderNotify($order, $message));
        echo "success".$order->id." <br/>";
    }
}


}
