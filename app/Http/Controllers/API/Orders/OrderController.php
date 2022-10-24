<?php

namespace App\Http\Controllers\API\Orders;

use App\Http\Controllers\Website\Controller;
use App\Http\Requests\Website\Register\Store;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Throwable;
use App\Http\Controllers\API\Helpers\ReturnApi;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Models\PublicOrder;
use App\Models\Settings;
use App\Models\Invoices;
use Carbon\Carbon;
use App\Models\eservices_orders;
use App\Models\PrivateOrder;

class OrderController extends Controller
{

    use ReturnApi;

    public function __construct()
    {
        $this->middleware(['jwt.auth'], ['except' => [ 'publicServiceOrdersPublic' , 'publicOrdersPublic' ]]);
    }

    public function guard(){
        return Auth::guard();
    }


    public function addPublicOrder(Request $request){

        try {

            $inputs         = ['title','details'];
            $validate       = $this->validationInputs($inputs);

            $validator      = Validator::make($request->all(), $validate['rules'] , $validate['messages']);
            if($validator->fails()){
                $response       = $this->validationResponse($validator);
                return response()->json($response, 200);
            }

            $settings           = Settings::query()->first();
            $public_count       = PublicOrder::where('user_id',Auth::id())->whereDate('created_at', '=', Carbon::today()->toDateString())->count();

            if($public_count >= $settings->public_order_limit){
                $response       = $this->errorResponse('max_public_order_limit');
                return response()->json($response, 200);
            }

        } catch(\Exception $e) {
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

        
        try {
            $return = DB::transaction(function () use ($request) {

                $order                  = new PublicOrder;
                $order->title           = $request->title;
                $order->details         = $request->details;
                $order->user_id         = Auth::id();
                $order->status          = 1;
                $order->save();

                $invoice                = new Invoices();
                $invoice->order_id      = $order->id;
                $invoice->user_id       = Auth::id();
                $invoice->type          = 'public';
                $invoice->save();

                $response = $this->successResponse($order,'order',$invoice,'invoice');
                return response()->json($response, 200);

            }, 3);

            return $return;
            
        } catch(\Exception $e) {
            // dd($e);
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

        
    }

    public function publicServiceOrdersPublic(Request $request){

        try {
            
            $eservices_orders = eservices_orders::orderBy('created_at','desc')->paginate(10);

            $response = $this->successResponse($eservices_orders,'eservices_orders');
            return response()->json($response, 200);

        } catch(\Exception $e) {

            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

    }

    public function publicServiceOrdersUser(Request $request){

        try {

            $eservices_orders = eservices_orders::where('provider_id','0')
            ->where('pay_status','complete_convert')->where('user_id','<>',Auth::id())->paginate(10);

            $response           = $this->successResponse($eservices_orders,'eservices_orders');
            return response()->json($response, 200);

        } catch(\Exception $e) {

            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

    }

    public function publicOrdersPublic(Request $request){

        try {
            
            $orders = PublicOrder::orderBy('created_at','desc')->paginate(10);

            $response = $this->successResponse($orders,'orders');
            return response()->json($response, 200);

        } catch(\Exception $e) {

            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

    }

    public function publicOrdersUser(Request $request){

        try {

            if(auth()->user()->level == 'user'){

                $orders = PublicOrder::where('user_id',auth()->user()->id)->orderBy('created_at','desc')->paginate(10);

            }elseif(auth()->user()->level == 'provider'){

                $orders = PublicOrder::where('status', 2)->orderBy('created_at','desc')->paginate(10);

            }else{

                $response       = $this->errorResponse('type_must_be_user_or_provider');
                return response()->json($response, 200);

            }

            $response           = $this->successResponse($orders,'orders');
            return response()->json($response, 200);

        } catch(\Exception $e) {

            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

    }  

    public function myOrdersEservices(Request $request){

        try {

            $eservices_orders = eservices_orders::where('user_id', Auth::id())->where('pay_status','complete_convert')->orderBy('updated_at', 'DESC');

            if(request()->has('filter') && !empty($filter = request()->filter)){
                $order_status = Status::get();
                $array_filter = [];
                foreach($filter as $item){
                    $state = $order_status->find($item);
                    if(!empty($state)){
                        $array_filter[] = $state->status;
                    }
                }
                $eservices_orders = $eservices_orders->whereIn('status', $array_filter);
            }

            $eservices_orders = $eservices_orders->paginate(10);

            // $new = collect([]);
            
            foreach($eservices_orders as $key => $item){
                $item->test = 'asd';
            }
            
            $response           = $this->successResponse($eservices_orders,'eservices_orders');
            return response()->json($response, 200);

        } catch(\Exception $e) {
        
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

    }

    public function myOrdersPublic(Request $request){

        try {

            $publicOrders = PublicOrder::where('user_id', Auth::id())->orderBy('updated_at', 'DESC');

            if(request()->has('filter') && !empty($filter = request()->filter)){
                $publicOrders = $publicOrders->whereIn('status', $filter);
            }

            $publicOrders = $publicOrders->paginate(10);

            $response           = $this->successResponse($publicOrders,'public_orders');
            return response()->json($response, 200);

        } catch(\Exception $e) {
        
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

    }

    public function myOrdersPrivate(Request $request){

        try {

            $private_orders = PrivateOrder::where('user_id', Auth::id())->orderBy('updated_at', 'DESC');

            if (request()->has('filter') && !empty($filter = request()->filter)) {
                $this->data['order_status'] = Status::get();
                $array_filter = [];
                foreach ($filter as $item) {
                    $state = $this->data['order_status']->find($item);
                    if (!empty($state)) {
                        $array_filter[] = $state->status;
                    }
                }
                $private_orders = $private_orders->whereIn('status', $array_filter);
            }

            $private_orders = $private_orders->paginate(10);

            $response           = $this->successResponse($private_orders,'private_orders');
            return response()->json($response, 200);

        } catch(\Exception $e) {
        
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

    }

    // Orders Details
    public function eservicesOrderDetails(Request $request){

        try {

            $inputs         = ['order_id'];
            $validate       = $this->validationInputs($inputs);

            $validator      = Validator::make($request->all(), $validate['rules'] , $validate['messages']);

            if($validator->fails()){
                $response       = $this->validationResponse($validator);
                return response()->json($response, 200);
            }

            $order          = eservices_orders::with('eservices')->where('id',(int)$request->order_id)->where('user_id',Auth::id())->first();
            
            if(empty($order)){
                $response       = $this->errorResponse('order_not_found');
                return response()->json($response, 200);
            }

            $order->title   = '#' . $order->id . ' - ' . $order->eservices->service_name;

            $response           = $this->successResponse($order,'order');
            return response()->json($response, 200);

        } catch(\Exception $e) {
        
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

    }

    public function publicOrderDetails(Request $request){

        try {

            $inputs         = ['order_id'];
            $validate       = $this->validationInputs($inputs);

            $validator      = Validator::make($request->all(), $validate['rules'] , $validate['messages']);

            if($validator->fails()){
                $response       = $this->validationResponse($validator);
                return response()->json($response, 200);
            }

            $order          = PublicOrder::where('id',(int)$request->order_id)->first();
            
            if(empty($order)){
                $response       = $this->errorResponse('order_not_found');
                return response()->json($response, 200);
            }

            $response           = $this->successResponse($order,'order');
            return response()->json($response, 200);

        } catch(\Exception $e) {
        
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

    }

    public function privateOrderDetails(Request $request){

        try {

            $inputs         = ['order_id'];
            $validate       = $this->validationInputs($inputs);

            $validator      = Validator::make($request->all(), $validate['rules'] , $validate['messages']);

            if($validator->fails()){
                $response       = $this->validationResponse($validator);
                return response()->json($response, 200);
            }

            $order          = PrivateOrder::where('id',(int)$request->order_id)->first();
            
            if(empty($order)){
                $response       = $this->errorResponse('order_not_found');
                return response()->json($response, 200);
            }

            $order->title   = $order->id . ' ' . 'طلب تعميد  رقم' ;

            $response           = $this->successResponse($order,'order');
            return response()->json($response, 200);

        } catch(\Exception $e) {
        
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

    }
    
}