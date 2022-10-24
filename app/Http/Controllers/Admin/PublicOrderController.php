<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\FinishPublicOrderNotify;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Models\{Fees, PublicOrder, PublicOrderOffer, Status, Tameeds, PrivateOrder, User};
use Illuminate\Http\Request;
use App\Http\Resources\PublicOrder\PublicOrderCollection;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Traits\CommonTrait;
use App\Traits\FirebaseTrait;
class PublicOrderController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use CommonTrait, FirebaseTrait;

    public function __construct()
    {
        // PREMISSIONS MIDDLEWARE
        $this->middleware('auth:admin');
        $this->middleware('canPermission:READ_PUBLIC_ORDER', ['only' => ['index']]);
        $this->middleware('canPermission:UPDATE_PUBLIC_ORDER', ['only' => ['updateStatus']]);
    }

    public function index()
    {
        //
        // $orders = PublicOrder::orderBy('created_at','desc')->get();
        // $status = Status::get();
        // return view('admin.public_order.index',[
        //      'orders'=>$orders ,
        //      'status'=>$status ,
        // ]);

        $all_status         = PublicOrder::whereNotNull('id')->orderBy('id', 'DESC')->select('status')->get();
        $pending            = clone $all_status->where('status',1);
        $waiting            = clone $all_status->where('status',2);
        $processing         = clone $all_status->where('status',3);
        $completed          = clone $all_status->where('status',4);
        $confirm_completed  = clone $all_status->where('status',5);
        $canceled           = clone $all_status->where('status',6);
        $confirm_canceled   = clone $all_status->where('status',7);
        $report             = clone $all_status->where('status',8);

        return view('admin.public_order.list',compact('pending','waiting','processing','completed','confirm_completed','canceled','confirm_canceled','report'));

    }

    public function following_public_orders($order_id)
    {
        return view('admin.public_order.following_list',compact('order_id'));
    }
    public function get_all_following(Request $request)
    {
        $master_id = PublicOrder::where('id',$request->order_id)->first()->master_order;
        $page = $request->input('pagination.page', '1');
        $search = $request->input('query.generalSearch', null);
        $perpage = $request->input('pagination.perpage', 10);
        $sortOrder = $request->input('sort.sort', 'asc');
        $sortField = $request->input('sort.field', 'id');
        $offset = ($page - 1) * $perpage;
        $query = PublicOrder::where('master_order',$master_id)->whereNotNull('id')->orderBy('id', 'DESC');
        if ($request->input('query.status') != null) {
            $query->where('status', $request->input('query.status'));
        }
        if ( $request->input('query.all_status')!=null && $request->input('query.all_status')!='all') {
            $query->where('status',$request->input('query.all_status'));
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


        if ($request->input('query.user_phone') != null) {
            $query->whereHas('user', function ($q) use ($request) {
                return $q->where('level', 'user')->where('phone', 'like', "%" . $request->input('query.user_phone') . "%");
            });
        }

        if ( $request->input('query.phone')!=null ) {
            $query->whereHas('user', function($q) use ($request){
                return $q->where('phone','like' , "%" . $request->input('query.phone') . "%");
            })->orWhereHas('provider', function($q) use ($request){
                return $q->where('phone','like' , "%" . $request->input('query.phone') . "%");
            });
        }

        $query->where('master_order',$master_id);

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField, $sortOrder);
        $data = $query->get();
        $request->offsetSet('pages', ceil($totalCount / $perpage));
        $request->offsetSet('total', $totalCount);
        return (new PublicOrderCollection($data));
    }

    public function edit(PublicOrder $order)
    {
        $status = Status::query();
        if(!can('COMPLETED_ORDERS')){
            $status = $status->where('status', '!=', 'confirm_completed');
        }
        if(!can('CANCELED_ORDERS')){
            $status = $status->where('status', '!=', 'confirm_canceled');
        }
        $status = $status->get();
        return view('admin.public_order.edit', compact('order', 'status'));
    }

    public function get_all(Request $request)
    {
        $page = $request->input('pagination.page', '1');
        $search = $request->input('query.generalSearch', null);
        $perpage = $request->input('pagination.perpage', 10);
        $sortOrder = $request->input('sort.sort', 'asc');
        $sortField = $request->input('sort.field', 'id');
        $offset = ($page - 1) * $perpage;
        $query = PublicOrder::whereNotNull('id')->orderBy('id', 'DESC');

        if ($request->input('query.status') != null) {
            $query->where('status', $request->input('query.status'));
        }
        if ( $request->input('query.all_status')!=null && $request->input('query.all_status')!='all') {
            $query->where('status',$request->input('query.all_status'));
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


        if ( $request->input('query.phone')!=null ) {
            $query->whereHas('user', function($q) use ($request){
                return $q->where('phone','like' , "%" . $request->input('query.phone') . "%");
            })->orWhereHas('provider', function($q) use ($request){
                return $q->where('phone','like' , "%" . $request->input('query.phone') . "%");
            });
        }


        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField, $sortOrder);
        $data = $query->get();
        $request->offsetSet('pages', ceil($totalCount / $perpage));
        $request->offsetSet('total', $totalCount);
        return (new PublicOrderCollection($data));
    }


    public function updateStatus($id, Request $request)
    {
        try {
            $status = $request->status;
            $check_status = Status::find($status);
            if($check_status->status == 'confirm_completed'){
                if(!can('COMPLETED_ORDERS')){
                    abort(403);
                }
            }
            if($check_status->status == 'confirm_canceled'){
                if(!can('CANCELED_ORDERS')){
                    abort(403);
                }
            }
            $item = PublicOrder::findOrFail($id);
            if($item->pay_status != 'complete_convert' &&  $item->status !=1){
                return back()->with('error', 'لا يمكنك تعديل حالة طلب الغير المدفوعه');
            }
            if ($status == 7 || $status == 5) {
                $verify = 'yes';
            } else {
                $verify = 'no';
            }
            $description = '
                تم تعديل حالة الطلب رقم ' . $id . '
                إلى الحالة
                ' . Status::find($status)->name . '
            ';
            $this->addLog('تعديل حالة طلب خدمة الكترونية ', $description);

        if ( ($status == 7 || $status == 10 ) && ($item->provider_id == 0 || empty($item->provider_id))) {
            DB::beginTransaction();
            $fees = Fees::first();
            $this->userBalance($item->user, false, $item->total_amount, $fees->service_cancellation);
            $this->newTransaction($item->user->id, ($item->total_amount - $fees->service_cancellation), $item->id, 'public', 'deposit', "ايداع رصيد خدمة الكترونية رقم $item->id ");
            $this->walletMuamlah($fees->service_cancellation, $item->price, $item->id, 'public', 'deposit', "رسوم الغاء طلب خدمة الكترونية رقم $item->id");
//            PublicOrder::where('master_order', $item->master_order)->update(['status' =>  $status, 'verify' => $verify]);;
            DB::commit();
        } elseif (($status == 5 || $status == 10) && ($item->provider_id == 0 || empty($item->provider_id))) {

            DB::beginTransaction();
            $data = PublicOrder::where('master_order', $item->master_order)->get();
            foreach ($data as $key => $value) {
                // $order_provider = User::where('phone', $value->service_provider_phone)->first();
                $order_provider = User::where('id', $value->provider_id)->first();
                $order_user     = User::find($value->user_id);
                $amount = $value->payable_service_provider;
                if ($value->parent_order == 0) {
                    $total_amount = $value->payable_service_provider + $item->provider_value_added_tax + $item->provider_fees + $item->value_added_tax + $item->fees + $item->agent_per;
                } else {
                    $total_amount = $value->payable_service_provider;
                }
                if(!is_null($value->payment_status)){
                    $this->newTransaction($value->user_id, $total_amount, $value->id, 'public', 'withdrawal', "سحب رصيد خدمة الكترونية رقم $value->id ");
                }
                if ($value->parent_order == 0) {
                    $this->userBalanceDiscount($order_user, $total_amount - $item->agent_per);
                    if ($value->total_amount - $total_amount != 0) {
                        $this->newTransaction($order_user->id, ($value->total_amount - $total_amount), $item->id, 'public', 'deposit', " استرجاع مبلغ من  خدمة الكترونية  رقم $item->id");
                        $this->ReturnRestToBalance($order_user, ($value->total_amount - $total_amount));
                    }
                } else {
                    $this->providerBalanceDiscount($order_user, $total_amount);
                }
                $this->newTransaction($order_provider->id, $amount, $value->id, 'public', 'deposit', "ايداع رصيد خدمة الكترونية رقم $value->id ");
                $this->providerBalance($order_provider, $amount);
            }
            $this->walletMuamlah(($item->provider_value_added_tax + $item->provider_fees + $item->fees +$item->value_added_tax ), $item->price, $item->id, 'public', 'deposit', "ايداع عمولة خدمة الكترونية رقم $item->id ");
//            PublicOrder::where('master_order', $item->master_order)->update(['status' =>  $status, 'verify' => 'yes']);
            $instance = $item->coupone_instance;
            if(!is_null($instance) && $instance->owner_discount != 0){
                $this->newTransaction($instance->owner_id, $instance->owner_discount, $instance->id, 'gift', 'deposit', " تم شحن الرصيد باستخدام كود الحسم" . $instance->code ."للطلب رقم: " .  $item->id);
                $this->walletMuamlah($instance->owner_discount, $item->price, $item->id, 'private', 'withdrawal', "سحب عمولة كوبون على خدمة الكترونية رقم $item->id ");
                $this->providerBalance($instance->owner,$instance->owner_discount);
            }
            if(!is_null($agent = $item->agent)){
                $this->newTransaction($agent->id, $item->agent_per, $item->id, 'gift', 'deposit', " ايداع  عمولة  خدمة الكترونية  رقم $item->id");
                $this->providerBalance($agent,$item->agent_per);
                $this->userBalanceDiscount($order_user,  $item->agent_per);
                $this->newTransaction($order_user->id, $item->agent_per, $item->id, 'gift', 'withdrawal', " سحب عمولة وكيل  خدمة الكترونية رقم $item->id");
            }
            Notification::send($order_provider, new FinishPublicOrderNotify($item));
            DB::commit();
        }
            PublicOrder::where('master_order', $item->master_order)->update(['status' =>$status, 'verify' => $verify]);

//        if($status == 2){
//            $providers = User::providers();
//            if(count($providers)){
//                $providers_ids = $providers->pluck('id')->toArray();
//                $title = 'يوجد طلب خدمة الكترونية جديد ';
//                $body = 'طلب خدمة الكترونية جديد بانتظار تقديم العروض';
//                $this->desktopNotifications( $title, $body,  route('publicOrders.offers.create', ['id' => $item->id]), [$providers_ids]);
//                Notification::send($providers, new \App\Notifications\NewPublicOrderNotify($item));
//            }
//        }
//            $item->update(['status' => $status]);

            return back()->with('success', 'تمت العملية بنجاح');
        } catch (Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }
    }

}
