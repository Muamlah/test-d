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

use DateTime;
use Carbon\Carbon;
use App\Models\PublicOrderOffer;
use App\Traits\FeesTrait;


class OffersController extends Controller
{

    use ReturnApi;
    use FeesTrait;
    
    public function __construct()
    {
        $this->middleware(['jwt.auth'], ['except' => ['']]);
    }

    public function guard(){
        return Auth::guard();
    }

    public function addOffer(Request $request){

        try {

            $inputs         = ['order_id','date','time','price'];
            $validate       = $this->validationInputs($inputs);

            $validator      = Validator::make($request->all(), $validate['rules'] , $validate['messages']);
            if($validator->fails()){
                $response       = $this->validationResponse($validator);
                return response()->json($response, 200);
            }

            if(auth()->user()->level == 'user'){
                $response       = $this->errorResponse('this_user_is_not_service_provider');
                return response()->json($response, 200);
            }

            $checkOffer     = PublicOrderOffer::where('user_id',auth()->user()->id)->where('order_id',$request->order_id)->first();
            if($checkOffer){
                $response       = $this->errorResponse('this_service_provider_has_submitted_an_offer_for_this_request_before');
                return response()->json($response, 200);
            }

        } catch(\Exception $e) {
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

        try {
            
            $return = DB::transaction(function () use ($request) {
                $today                  = Carbon::now();
                $deadline               = Carbon::parse($request->date . ' ' . $request->time);
                $datetime1              = new DateTime($today);
                $datetime2              = new DateTime($deadline);
                $interval               = $datetime1->diff($datetime2);
                $duration               = $interval->format('%a');
                $fees                   = $this->CalculatePublicOrderFees($request->price);
                $fee = [
                    'fee'               => round($fees['offer_fee'] , 2) ,
                    'tax_amount'        => round($fees['offer_added_tax'] , 2) ,
                    'deserved_price'    => round((double)$request->price - (double)$fees['offer_fee'] - (double)$fees['offer_added_tax']  , 2),
                ];

                $offer                  = new PublicOrderOffer;
                $offer->user_id         = Auth::id();
                $offer->order_id        = $request->order_id;
                $offer->price           = $request->price;
                $offer->duration        = $duration;
                $offer->date            = $request->date;
                $offer->time            = $request->time;
                $offer->deadline        = $deadline;
                $offer->fees            = $fee['fee'];
                $offer->tax_amount      = $fee['tax_amount'];
                $offer->deserved_price  = $fee['deserved_price'];
                $offer->save();

                $response = $this->successResponse($offer,'offer');
                return response()->json($response, 200);

            }, 3);

            return $return;
            
        } catch(\Exception $e) {
            // dd($e);
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }
    }

    public function editOffer(Request $request){
       
        try {

            $inputs         = ['public_offer_id','date','time','price'];
            $validate       = $this->validationInputs($inputs);

            $validator      = Validator::make($request->all(), $validate['rules'] , $validate['messages']);
            if($validator->fails()){
                $response       = $this->validationResponse($validator);
                return response()->json($response, 200);
            }

            if(auth()->user()->level == 'user'){
                $response       = $this->errorResponse('this_user_is_not_service_provider');
                return response()->json($response, 200);
            }

            $checkOffer         = PublicOrderOffer::where('user_id',auth()->user()->id)->where('id',$request->public_offer_id)->first();
            if(empty($checkOffer)){
                $response       = $this->errorResponse('offer_not_found');
                return response()->json($response, 200);
            }
        } catch(\Exception $e) {
            // dd($e);
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

        try {
            
            $return = DB::transaction(function () use ($request) {
                
                $today                  = Carbon::now();
                $deadline               = Carbon::parse($request->date . ' ' . $request->time);
                $datetime1              = new DateTime($today);
                $datetime2              = new DateTime($deadline);
                $interval               = $datetime1->diff($datetime2);
                $duration               = $interval->format('%a');
                $fees                   = $this->CalculatePublicOrderFees($request->price);
                $fee = [
                    'fee'               => round($fees['offer_fee'] , 2) ,
                    'tax_amount'        => round($fees['offer_added_tax'] , 2) ,
                    'deserved_price'    => round((double)$request->price - (double)$fees['offer_fee'] - (double)$fees['offer_added_tax']  , 2),
                ];
                
                $offer                  = PublicOrderOffer::find($request->public_offer_id);
                $offer->price           = $request->price;
                $offer->duration        = $duration;
                $offer->date            = $request->date;
                $offer->time            = $request->time;
                $offer->deadline        = $deadline;
                $offer->fees            = $fee['fee'];
                $offer->tax_amount      = $fee['tax_amount'];
                $offer->deserved_price  = $fee['deserved_price'];
                
                $offer->save();

                $response = $this->successResponse($offer,'offer');
                return response()->json($response, 200);

            }, 3);

            return $return;
            
        } catch(\Exception $e) {
            // dd($e);
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }
    }

    public function acceptOffer(Request $request){

        $inputs         = ['order_id','public_offer_id'];
        $validate       = $this->validationInputs($inputs);

        $validator      = Validator::make($request->all(), $validate['rules'] , $validate['messages']);
        if($validator->fails()){
            $response       = $this->validationResponse($validator);
            return response()->json($response, 200);
        }

        if(auth()->user()->level == 'provider'){
            $response       = $this->errorResponse('service_provider_can_not_accept_offer');
            return response()->json($response, 200);
        }

        
    }
}