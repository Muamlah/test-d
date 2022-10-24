<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Helpers\ReturnApi;
use App\Http\Controllers\Controller;
use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Invoices;
use DB;
use App\Models\Transaction;

class UserController extends Controller
{
	use ReturnApi;

	public function __construct()
    {
        $this->middleware(['jwt.auth'], ['except' => ['']]);
    }

	private function storeImage($user) {

        if(request()->hasFile('image')) {

			$file = request()->file('image');
			$extension = $file->getClientOriginalExtension(); // you can also use file name
			$fileName = time().'.'.$extension;
			$path = public_path().'/storage/uploads';
			$uplaod = $file->move($path,$fileName);

			$user->image = 'uploads/'.$fileName;
			$user->save();

			return $user->image;
        }

    }

	public function updateProfile(Request $request){
		
		try {

			$inputs         = ['user_password'  , 'name' , auth()->user()->id => 'email','image'];
			$validate       = $this->validationInputs($inputs);

			$validator      = Validator::make($request->all(), $validate['rules'] , $validate['messages']);
			// dd($validator);
			if($validator->fails()){
				$response       = $this->validationResponse($validator);
				return response()->json($response, 200);
			}

			$rules['phone']					= 'required|numeric|max:999999999999999999|min:999|unique:users,phone,'.auth()->user()->id;
			$messages['phone.required']		= 'phone_is_required';
			$messages['phone.numeric']		= 'phone_must_be_numeric';
			$messages['phone.max']			= 'phone_must_be_less_than_999999999999999999';
			$messages['phone.unique']       = 'phone_has_already_been_taken';

			$validator = Validator::make($request->all(), $rules, $messages);
			if($validator->fails()){
				$response       = $this->validationResponse($validator);
				return response()->json($response, 200);
			}

		} catch(\Exception $e) {
			// dd($e);
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

		try {
            
            $return = DB::transaction(function () use ($request) {

				$user = auth()->user();

				if(!empty($request->user_password)){
					$user->password 		= bcrypt($request->user_password);
				}

				$image = $this->storeImage($user);
				
				$user->phone 			= $request->phone;
				$user->name 			= $request->name;
				$user->email 			= $request->email;
				$user->save();

				$response = $this->successResponse($user,'user');
                return response()->json($response, 200);

            }, 3);

            return $return;
            
        } catch(\Exception $e) {
            // dd($e);
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }
		
	}

	public function updateCreditCard(Request $request){

		try {

			$inputs         = ['name' ,  'bank_name' , 'account_number'];
			$validate       = $this->validationInputs($inputs);

			$validator      = Validator::make($request->all(), $validate['rules'] , $validate['messages']);
			if($validator->fails()){
				$response       = $this->validationResponse($validator);
				return response()->json($response, 200);
			}

		} catch(\Exception $e) {
			
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

		try {
            
            $return = DB::transaction(function () use ($request) {
				
				$check_card						= CreditCard::where('user_id',auth()->user()->id)->first();
				
				if(empty($check_card)){
					$credit_card					= new CreditCard;
				}else{
					$credit_card					= $check_card;
				}
				
				$credit_card->user_id			= auth()->user()->id;
				$credit_card->name				= $request->name;
				$credit_card->bank_name			= $request->bank_name;
				$credit_card->account_number	= $request->account_number;
				$credit_card->save();

				$response = $this->successResponse($credit_card,'credit_card');
                return response()->json($response, 200);

            }, 3);

            return $return;
            
        } catch(\Exception $e) {
            // dd($e);
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

	}

	public function invoices(Request $request){

		try {

			$invoices	=	Invoices::where('user_id', auth()->user()->id)->with('order')->paginate(10);

			foreach($invoices as $invoice){
				if($invoice->order->status == 1 || $invoice->order->status == "pinding"){
					$invoice->status = 'جاري المراجعة';

				}elseif($invoice->order->status == 2 || $invoice->order->status == "waiting"){
					$invoice->status = 'مفتوح';

				}elseif($invoice->order->status == 3 || $invoice->order->status == "processing"){
					$invoice->status = 'بانتظار التنفيذ';
					
				}elseif($invoice->order->status == 4 || $invoice->order->status == "completed"){
					$invoice->status = 'بانتظار تأكيد التسليم';
					
				}elseif($invoice->order->status == 5 || $invoice->order->status == "confirm_completed"){
					$invoice->status = 'تم التسليم';
					
				}elseif($invoice->order->status == 6 || $invoice->order->status == "canceled"){
					$invoice->status = 'بانتظار تأكيد الغاء مقدم الخدمة';
					
				}elseif($invoice->order->status == 7 || $invoice->order->status == "confirm_canceled"){
					$invoice->status = 'ملغي';
					
				}

				if($invoice->type == 'private'){
					$invoice->type = '# طلب تعميد خاص ';

				}elseif($invoice->type == 'public'){
					$invoice->type = '# طلب تعميد عام';

				}else{
					$invoice->type = '# طلب خدمة الكترونية';

				}

				if(!empty($invoice->order->created_at)){
					$invoice->date = $invoice->order->created_at->format('d M Y');
				}else{
					$invoice->date = '';
				}

			}

			$response = $this->successResponse($invoices,'invoices');
			return response()->json($response, 200);

		} catch(\Exception $e) {
			
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

		

	}

	public function transactions(Request $request){

		try {

			$items 				= Transaction::where('user_id', auth()->user()->id)->paginate(10);
			$sumDeposit			= Transaction::where('user_id', auth()->user()->id)->where('type','deposit')->sum('amount');
            $sumWithdrawal		= Transaction::where('user_id', auth()->user()->id)->where('type','withdrawal')->sum('amount');

			$response = $this->successResponse($items,'items',$sumDeposit,'sum_deposit',$sumWithdrawal,'sum_withdrawal');
			return response()->json($response, 200);

		} catch(\Exception $e) {
			
            $response       = $this->errorResponse($e->getMessage());
            return response()->json($response, 200);
        }

	}
	



	public function profile ()
	{

	
		$user  =auth()->user();

		$code  =  "";
		$msg   =  "";
		
		if(!$user->active)
		{
			$user ->verification_code = '';
			$code =  "s009";
			$msg  =  "   عليك تأكيد حسابك  ! ";

		}

		return $this->Data('profile' , $user ,$code , $msg );
	
	
	
	}

}
