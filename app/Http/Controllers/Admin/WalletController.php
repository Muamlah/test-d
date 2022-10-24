<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\PrivateOrder\PrivateOrderCollection;
use App\Http\Resources\PublicOrder\PublicOrderCollection;
use App\Http\Resources\PublicOrder\BalanceRequestCollection;

use App\Exports\WalletsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Http\Resources\Wallet\WalletCollection;
use App\Http\Resources\Wallet\WalletResource;
use App\Http\Resources\WalletMuamlah\WalletMuamlahCollection;
use App\Models\PrivateOrder;
use App\Models\Transaction;
use App\Traits\ARBPaymentGatewayTrait;
use Illuminate\Http\Request;
use App\Models\WalletMuamlah;
use App\Models\BalanceRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Log;
use App\Traits\CommonTrait;
use Illuminate\Support\Str;
use App\Models\PublicOrder;
use App\Models\eservices_orders;
use App\Http\Resources\EservicesOrder\EserviceOrderCollection;
use Illuminate\Support\Facades\Notification;


class WalletController extends Controller
{
    use ARBPaymentGatewayTrait, CommonTrait;

    public function __construct()
    {
        // PREMISSIONS MIDDLEWARE
        //  $this->middleware('canPermission:READ_WALLET')->only('index');
        $this->middleware('auth:admin');
        $this->middleware('SecondAccess');
        $this->middleware('canPermission:READ_WALLET', ['only' => ['index']]);
        $this->middleware('canPermission:READ_REQUEST_BALANCE', ['only' => ['getBalanceRequests']]);
        $this->middleware('canPermission:UPDATE_REQUEST_BALANCE', ['only' => ['updateBalanceRequests']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $items = WalletMuamlah::orderBy('id', 'desc')->paginate(10);
        $totalBalance = WalletMuamlah::sum('balance');
        $totalOrder = User::sum('pinding_balance');
        $totalAvailable = User::sum('available_balance');
        return view('admin.wallet.index', [
            'items' => $items,
            'totalBalance' => $totalBalance,
            'totalOrder' => $totalOrder,
            'totalAvailable' => $totalAvailable,
        ]);
    }

    public function get_all(Request $request)
    {
        $page = $request->input('pagination.page', '1');
        $search = $request->input('query.generalSearch', null);
        $perpage = $request->input('pagination.perpage', 10);
        $sortOrder = $request->input('sort.sort', 'asc');
        $sortField = $request->input('sort.field', 'id');
        $offset = ($page - 1) * $perpage;

        $query = WalletMuamlah::whereNotNull('id');
        $period = $request->input('query.search_period');

        if ($period != null) {

            if ($period == 'tody')
                $query->whereDate('created_at', Carbon::today());
            if ($period == 'week')
                $query->where('created_at', '>=', Carbon::now()->subDays(7));
            if ($period == 'month')
                $query->where('created_at', '>=', Carbon::now()->subDays(30));
            if ($period == 'year')
                $query->where('created_at', '>=', Carbon::now()->subDays(365));
        }

        if ($request->input('query.date_from') != null) {
            $query->where('created_at', '>=', $request->input('query.date_from'));
        }

        if ($request->input('query.date_to') != null) {
            $query->where('created_at', '<=', $request->input('query.date_to'));
        }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy($sortField, $sortOrder);
        $data = $query->get();
        $request->offsetSet('pages', ceil($totalCount / $perpage));
        $request->offsetSet('total', $totalCount);
        return (new WalletCollection($data));
    }

    public function export($type, $search_period = 'all_days', $date_from = null, $date_to = null)

    {

        if ($type == 'xls')
            return (new WalletsExport($search_period, $date_from, $date_to))->download('wallet' . now() . '.xls', \Maatwebsite\Excel\Excel::XLS);
        if ($type == 'pdf')
            return (new WalletsExport($search_period, $date_from, $date_to))->download('wallet' . now() . '.pdf', \Maatwebsite\Excel\Excel::MPDF);
    }

    public function getBalanceRequests()
    {
        // $data = BalanceRequest::with('credit', 'user')->orderBy('id', 'desc')->paginate(10);
        return view('admin.balance_requests.index');
    }

    public function get_all_balance_requests(Request $request) {
        $page = $request->input('pagination.page','1');
        $search = $request->input('query.generalSearch',null);
        $perpage = $request->input('pagination.perpage',10);
        $sortOrder = $request->input('sort.sort','asc');
        $sortField = $request->input('sort.field','id');
        $offset = ($page - 1) * $perpage;
        $query = BalanceRequest::whereNotNull('id')->orderBy('id', 'DESC');

        if ( $request->input('query.date_from')!=null ) {
            $query->where('created_at', '>=',$request->input('query.date_from'));
        }

        if ( $request->input('query.date_to')!=null ) {
            $query->where('created_at', '<=',$request->input('query.date_to'));
        }

        if ( $request->input('query.phone')!=null ) {
            $query->whereHas('user', function($q) use ($request){
                return $q->where('phone','like' , "%" . $request->input('query.phone') . "%");
            });
        }

        if ( $request->input('query.name')!=null ) {
            $query->whereHas('user', function($q) use ($request){
                return $q->where('name','like' , "%" . $request->input('query.name') . "%");
            });
        }

        $totalCount = $query->count();

        $query->offset($offset)
            ->limit($perpage)
            ->orderBy('id','DESC');
        $data = $query->get();
        $request->offsetSet('pages',ceil($totalCount / 50));
        $request->offsetSet('total',$totalCount);
        return (new BalanceRequestCollection($data));
    }

    public function getUserBalanceRequests($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('admin.balance_requests.list', [
            'user' => $user,
        ]);
    }

    public function getUserPrivateOrder(Request $request,$user_id,$status = null)
    {


        $page           = $request->input('pagination.page','1');
        $search         = $request->input('query.generalSearch',null);
        $perpage        = $request->input('pagination.perpage',10);
        $sortOrder      = $request->input('sort.sort','asc');
        $sortField      = $request->input('sort.field','id');
        $offset         = ($page - 1) * $perpage;

        if($status == 8)
        {
            $query          = PrivateOrder::where(function ($query) use ($user_id) {
                $query->where('user_id', $user_id)
                ->orWhere('provider_id', $user_id);
            })->where('status_id',8)->orderBy('id', 'DESC');
        }
        else{
            $query          = PrivateOrder::where(function ($query) use ($user_id) {
                $query->where('user_id', $user_id)
                ->orWhere('provider_id', $user_id);
            })->orderBy('id', 'DESC');
        }


        if ( $request->input('query.status_id')!=null) {
            $query->where('status_id',$request->input('query.status_id'));
        }
        if ( $request->input('query.all_status')!=null && $request->input('query.all_status')!='all') {
            $query->where('status_id',$request->input('query.all_status'));
        }
        if ( $request->input('query.pay_status')!=null ) {
            $query->where('pay_status',$request->input('query.pay_status'));
        }
        if ( $request->input('query.amount_from')!=null ) {
            $query->where('price', '>=',$request->input('query.amount_from'));
        }

        if ( $request->input('query.amount_to')!=null ) {
            $query->where('price', '<=',$request->input('query.amount_to'));
        }
        // dd($request->input('query.date_from'),$request->input('query.date_to'));
        if ( $request->input('query.date_from')!=null ) {
            $query->where('created_at', '>=',$request->input('query.date_from'));
        }

        if ( $request->input('query.date_to')!=null ) {
            $query->where('created_at', '<=',$request->input('query.date_to'));
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
            ->orderBy($sortField,$sortOrder);
        $data = $query->get();
        $request->offsetSet('pages',ceil($totalCount / 50));
        $request->offsetSet('total',$totalCount);
        return (new PrivateOrderCollection($data));
    }
    public function getUserPublicOrder(Request $request,$user_id,$status = null)
    {
        $page           = $request->input('pagination.page', '1');
        $search         = $request->input('query.generalSearch', null);
        $perpage        = $request->input('pagination.perpage', 10);
        $sortOrder      = $request->input('sort.sort', 'asc');
        $sortField      = $request->input('sort.field', 'id');
        $offset         = ($page - 1) * $perpage;
        if($status == 8)
        {
            $query          = PublicOrder::where(function ($query) use ($user_id) {
                $query->where('user_id', $user_id)
                    ->orWhere('provider_id', $user_id);
            })->where('status',8)->orderBy('id', 'DESC');
        }else{
            $query          = PublicOrder::where(function ($query) use ($user_id) {
                $query->where('user_id', $user_id)
                    ->orWhere('provider_id', $user_id);
            })->orderBy('id', 'DESC');
        }


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
        ->orderBy('id', 'desc');
        $data = $query->get();

        $request->offsetSet('pages', ceil($totalCount / $perpage));
        $request->offsetSet('total', $totalCount);

        return (new PublicOrderCollection($data));
    }
    public function getUserEservicesOrders(Request $request,$user_id,$status = null)
    {
        $page           = $request->input('pagination.page','1');
        $search         = $request->input('query.generalSearch',null);
        $perpage        = $request->input('pagination.perpage',10);
        $sortOrder      = $request->input('sort.sort','asc');
        $sortField      = $request->input('sort.field','id');
        $offset         = ($page - 1) * $perpage;
        if($status == 8)
        {
            $query          = eservices_orders::where(function ($query) use ($user_id) {
                $query->where('user_id', $user_id)
                    ->orWhere('provider_id', $user_id);
            })->where('status',8)->with('eservices','user','provider','paymentMathod')->orderBy('id', 'DESC');
        }
        else
        {
            $query          = eservices_orders::where(function ($query) use ($user_id) {
                $query->where('user_id', $user_id)
                    ->orWhere('provider_id', $user_id);
            })->with('eservices','user','provider','paymentMathod')->orderBy('id', 'DESC');
        }


        if ( $request->input('query.status')!=null) {
            $query->where('status',$request->input('query.status'));
        }
        if ( $request->input('query.pay_status')!=null ) {
            $query->where('pay_status',$request->input('query.pay_status'));
        }
        if ( $request->input('query.amount_from')!=null ) {
            $query->where('price', '>=',$request->input('query.amount_from'));
        }

        if ( $request->input('query.amount_to')!=null ) {
            $query->where('price', '<=',$request->input('query.amount_to'));
        }

        if ( $request->input('query.date_from')!=null ) {
            $query->where('created_at', '>=',$request->input('query.date_from'));
        }

        if ( $request->input('query.date_to')!=null ) {
            $query->where('created_at', '<=',$request->input('query.date_to'));
        }

        if ( $request->input('query.phone')!=null ) {
            $query->whereHas('user', function($q) use ($request){
                return $q->where('phone','like' , "%" . $request->input('query.phone') . "%");
            })->orWhereHas('provider', function($q) use ($request){
                return $q->where('phone','like' , "%" . $request->input('query.phone') . "%");
            });
        }

        $totalCount = $query->count();

        $query->offset($offset)->limit($perpage)->orderBy('id', 'desc');
        $data       = $query->get();

        $request->offsetSet('pages',ceil($totalCount / $perpage));
        $request->offsetSet('total',$totalCount);
        return (new EserviceOrderCollection($data));
    }



    public function getBalanceRequest($id)
    {
        $data = BalanceRequest::with('credit', 'user')->find($id);
        return view('admin.balance_requests.update', [
            'data' => $data,
        ]);
    }

    public function updateBalanceRequest(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'description'       =>'nullable|string',
            'ref'               =>'nullable|string',
            'payment_status'    =>'required|in:waiting,completed,refused',
            'file'              =>'nullable|file|mimes:pdf,jpeg,png,jpg|max:3072',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = BalanceRequest::with('user')->find($id);
        $data->payment_status = $request->payment_status;
        $data->ref = $request->ref;
        $data->description = $request->description;
        if($request->hasFile('file')){
            $file_name          = time() . Str::random(10) . '.' . $request->file('file')->getClientOriginalExtension();
            $filePath           = $request->file('file')->move(public_path('files'),$file_name);
            $data->file         = $file_name;
        }
        $data->save();
        if($request->payment_status == 'completed')
        {
            $message = [
                'message' => "لقد تم قبول عملية سحب الرصيد",
                'link' => '',
            ];
            Notification::send($data->user, new \App\Notifications\NotifyAgent('',$message));
        }elseif($request->payment_status == 'refused')
        {
            $message = [
                'message' => "لقد تم رفض عملية سحب الرصيد من قبل المشرفين",
                'link' => '',
            ];
            Notification::send($data->user, new \App\Notifications\NotifyAgent('',$message));
        }
        $description = ' تم تعديل طلب سحب رصيد رقم  '.$data->id.' ';
        $this->addLog('تعديل طلب سحب رصيد ',$description);
        return back()->with('success', 'تم تعديل الطلب بنجاح');
    }
    public function createBalanceRequest($id){
        $data = BalanceRequest::with('credit', 'user')->find($id);
        return view('admin.balance_requests.create', [
            'data' => $data,
        ]);

    }

    public function updateBalanceRequests($id)
    {
        $data = BalanceRequest::find($id);
        $user = User::where('id', $data->user_id)->first();
        $available_balance = $user->available_balance - $data->amount;
//        if ($available_balance >= 0) {
            $checkout = $this->ARBPayout($data->amount, $id, 'balance-withdrawal');
            $data_checkout = json_decode($checkout, true);
            if (!isset($data_checkout[0]['status']) || $data_checkout[0]['status'] != 1) {
                return back()->with('success', 'يوجد خطأ في بوابة الدفع الرجاء المحاولة لاحقاً');
            }
            $data->payment_gateway_checkout_data = $checkout;
            $data->update();
            $data2 = explode(":", $data_checkout[0]['result']);
            $this->data['paymentUrl'] = $data2[1] . ':' . $data2[2] . '?PaymentID=' . $data2[0];
            return Redirect::to($this->data['paymentUrl']);
//        } else {
//            return back()->with('success', 'لا يوجد رصيد كافي');
//        }

        //        //خصم من رصيد العميل
        //
        //
        //        $total_balance=$available_balance + $user->pinding_balance ;
        //        $user->available_balance= $available_balance;
        //        $user->total_balance= $total_balance;
        //        $user->save();
        //
        //        // تسجيل في سجل الحركة لليوزر
        //        $item=new Transaction();
        //        $item->user_id=$user->id;
        //        $item->amount=$data->amount;
        //        $item->type='withdrawal';
        //        $item->description='Balance withdrawal';
        //        $item->save();
        //        // تعديل حالة الطلب الى تم التحويل
        //        $data->update(['status' =>'completed']);
        //
        //         return back()->with('success','تمت عملية التحويل بنجاح');

    }
}
