<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\eservices_orders;
use App\Models\PublicOrder;
use App\Models\PrivateOrder;
use App\Models\WalletMuamlah;
use App\Models\eservices;
use App\Models\BalanceRequest;
use App\Models\PublicOrderOffer;
use \Carbon\Carbon;
use \Carbon\CarbonPeriod;
use App\Http\Resources\PrivateOrder\PrivateOrderCollection;
use App\Http\Resources\PublicOrder\PublicOrderCollection;
use App\Http\Resources\EservicesOrder\EserviceOrderCollection;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    protected $data = [];
    public function __construct()
    {
        $this->middleware('canPermission:READ_PRIVATE_ORDER');
        $this->middleware('canPermission:READ_PUBLIC_ORDER');
        $this->middleware('canPermission:READ_ELECTRONIC_ORDER');


    }
    public function index()
    {
        $this->reportOrders();
        $this->data['electronic_provider_count'] = 0;
        if(auth()->check()){
            $this->data['electronic_provider_count']=eservices_orders::where('provider_id',auth()->id())->
            whereDate('created_at', '=', Carbon::today()->toDateString())->count();
        }
        $this->data['electronic_provider_count'] = 0;
        $this->data['order_offer_count'] = 0;
        if(auth()->check()){
            $this->data['electronic_provider_count'] = eservices_orders::where('provider_id',auth()->id())->
            whereDate('created_at', '=', Carbon::today()->toDateString())->count();
            $this->data['order_offer_count'] = PublicOrderOffer::where('user_id',auth()->id())->
                      whereDate('created_at', '=', Carbon::today()->toDateString())->count();
        }
        return view('admin.orders.index', $this->data);
    }

    public function getReportPrivateOrder(Request $request) 
    {
        $page           = $request->input('pagination.page','1');
        $search         = $request->input('query.generalSearch',null);
        $perpage        = $request->input('pagination.perpage',10);
        $sortOrder      = $request->input('sort.sort','asc');
        $sortField      = $request->input('sort.field','id');
        $offset         = ($page - 1) * $perpage;

        $query          = PrivateOrder::where('status_id',8)->whereNotNull('id')->orderBy('id', 'DESC');
        
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
    public function getReportPublicOrder(Request $request)
    {
        $page           = $request->input('pagination.page', '1');
        $search         = $request->input('query.generalSearch', null);
        $perpage        = $request->input('pagination.perpage', 10);
        $sortOrder      = $request->input('sort.sort', 'asc');
        $sortField      = $request->input('sort.field', 'id');
        $offset         = ($page - 1) * $perpage;
        $query          = PublicOrder::where('status',8)->orderBy('id', 'DESC');
        
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
    public function getReportEservicesOrders(Request $request)
    {
        $page           = $request->input('pagination.page','1');
        $search         = $request->input('query.generalSearch',null);
        $perpage        = $request->input('pagination.perpage',10);
        $sortOrder      = $request->input('sort.sort','asc');
        $sortField      = $request->input('sort.field','id');
        $offset         = ($page - 1) * $perpage;
        $query          = eservices_orders::where('status',8)->with('eservices','user','provider','paymentMathod')->orderBy('id', 'DESC');
        
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

    // طلبات جديدة
    public function reportOrders(){
        $this->data['eservices_orders_count']    = eservices_orders::with(['users', 'providers'])->where('status', '8')->count();
        $this->data['public_orders_count']      = PublicOrder::with(['user', 'provider'])->where('status', 8)->count();
        $this->data['private_orders_count']     = PrivateOrder::with(['user', 'provider'])->where('status_id', '8')->count();
    }
    public function report_orders($type){
        switch($type){
            case 'eservices':
                $this->data['eservices_orders'] = eservices_orders::with(['users', 'providers'])->where('status', '8')->orderBy('created_at', 'DESC')->paginate(10);
                return view('admin.include.table-rows.eservices', $this->data);
                break;
            case 'public':
                $this->data['public_orders'] = PublicOrder::with(['user', 'provider'])->where('status', 8)->orderBy('created_at', 'DESC')->paginate(10);
                return view('admin.include.table-rows.public', $this->data);
                break;
            case 'private':
                $this->data['private_orders'] = PrivateOrder::with(['user', 'provider'])->where('status_id', '8')->orderBy('created_at', 'DESC')->paginate(10);
                return view('admin.include.table-rows.private', $this->data);
                break;
        }
    }
}
