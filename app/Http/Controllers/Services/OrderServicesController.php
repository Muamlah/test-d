<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\eservices_orders;
use App\Models\Fees;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use  App\Http\Controllers\API\Helpers\ReturnApi;
class OrderServicesController extends Controller
{
 use ReturnApi;


 //*START*  storeNewOrder >>>>>>>>>>>> >>>>>>>>>>>> >>>>>>>>>>
  public function storeNewOrder(Request $request, $service_id)
  {
      try {
            //validat

        $rules = [
            "details"     => "required|max:255",];
          
        $validator = Validator::make($request->all(), $rules);
          
        if ($validator->fails())
        {
            $code  =  $this->returnCodeAccordingToInput ($validator);
            return    $this->returnValidationError      ($code, $validator);
        }

        $user_id  =  auth()->user()->id;
        $details  =  $request->input('details','');
        $status   =  "waiting" ;

        $eservice =  eservices_orders::create([
            "user_id"      => $user_id,
            "details"      => $details ,
            "eservice_id"  => $service_id,
            "status"       => $status,
          ]);

          $fees                               =  Fees::first();
          $eservice->fees                     =  ($eservice->eservices->price / 100 * $fees['service_client_fees']);
          $eservice->provider_fees            =  ($eservice->eservices->price / 100 * $fees['service_platform_fee']);
          $eservice->price                    =  $eservice->eservices->price;
          $eservice->value_added_tax          =  (($fees['value_added_tax'] /100) * ($eservice->eservices->price / 100 * $fees['service_client_fees']) );
          $eservice->provider_value_added_tax =  (($fees['value_added_tax'] /100) * ($eservice->eservices->price / 100 * $fees['service_platform_fee']) );
          $eservice->total_amount             =  $eservice->eservices->price + $eservice->fees +  $eservice->value_added_tax;
          $eservice->provider_total_amount    =  $eservice->eservices->price -( $eservice->provider_fees +  $eservice->provider_value_added_tax);
          $eservice->save();
  
          $total_cost = $eservice->total_amount;
          $users      = User::findorfail(auth()->user()->id);

          $net  = $users->available_balance - $total_cost;
         
          
        //NOT READY !!!

        if ($net < 0) {

            $code = "201";

            $net  =  $total_cost - $users->available_balance;
          

            if($users->available_balance==0)
            {
                $msg="لا يوجد رصيد كافٍ لإتمام العملية ";
            }
            else
            {
                $msg= " يلزمك  " . ($net) ." ريال لإتمام العملية " ;
            }
            return $this->Data('service_id',$eservice->id,$code,$msg);
            
        }
        else{
            $code = "202";

            $eservice->pay_status = 'complete_convert';
            $eservice->update();

            // if he have a balance in his account
            $users->available_balance  = $net;
            $users->pinding_balance    = $users->pinding_balance + $total_cost;
            $users->total_balance      = $users->pinding_balance + $users->available_balance;
            $users->update();

            //New Transaction
            $transaction              =  new Transaction();
            $transaction->user_id     =  $users->id;
            $transaction->amount      =  $total_cost;
            $transaction->type        = 'withdrawal';
            $transaction->description = "خدمة الكترونية رقم #' . $eservice->id";
            $transaction->save();

            $msg  = " تم خصم " .$total_cost ." ريال , تكلفة الخدمة ";
            return $this->Data('service_id',$eservice->id,$code,$msg);

        }

       
        
      }
          catch (\Exception $ex) 
          {
              return $this->Error($ex->getCode(), $ex->getMessage());
          }
  
}
//*END*  storeNewOrder >>>>>>>>>>>> >>>>>>>>>>>> >>>>>>>>>>



//*START*  OrderServices >>>>>>>>>>>> >>>>>>>>>>>> >>>>>>>>>>
public function OrderServices (Request $request)
{
   try{
       
    if(isset($request['page']) && $request['page']<=0 )
        return  $this->Error('e007','ادخل رقم صحيح للصفحة  , أكبر من الصفر ');

    $count    =   count(eservices_orders::all());
    $perPage  =   $request->input('perPage' , 25);
    $page     =   $request->input('page', 1 );
    $orderBy  =   $request->input('orderBy', 'DESC' );
    $lastPage =   ceil($count/$perPage) ;
    $offset   =   ($page-1) * $perPage;
    $code     =   "S011";
    $msg      =   "";
    $user_id  =   auth()->user()->id;

    if( $count == 0)
        return  $this->Success('e015','   لايوجد بيانات لعرضها  ');
    else if($page > $lastPage )
        return  $this->Error('e008',' رقم الصفحة الأخيرة '.$lastPage);

   $o_services = eservices_orders::where('user_id', $user_id)->orderBy('updated_at', $orderBy)->offset($offset)->limit($perPage)->get();

   return $this->Data("odrdeeServices",$o_services,$code,$msg,$page,$count,$lastPage);

   }
   catch (\Exception $ex) 
   {
       return $this->Error($ex->getCode(), $ex->getMessage());
   }

}
//*END*  OrderServices >>>>>>>>>>>> >>>>>>>>>>>> >>>>>>>>>>




//*START*  GetOneOrderService >>>>>>>>>>>> >>>>>>>>>>>> >>>>>>>>>>
public function GetOneOrderService($id)
{
    try{
        $user_id = (auth()->user()->id);
        $service = eservices_orders::where('id',$id)->where('user_id',$user_id)->first();
        if($service)
            return $this->Data('service',$service,'s011');
        else
            return $this->Error('404','Not Found !');

    }
     
       catch (\Exception $ex) {
        return $this->Error($ex->getCode(), $ex->getMessage());
    }
}
//*END*  GetOneOrderService >>>>>>>>>>>> >>>>>>>>>>>> >>>>>>>>>>

}
