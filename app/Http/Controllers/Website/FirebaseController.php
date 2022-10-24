<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\PublicOrder;
use App\Models\User;
use App\Notifications\FinishPublicOrderNotify;
use App\Traits\PaymentGatewayTrait;
use Illuminate\Http\Request;
use App\Models\FirebaseToken;
use DB;
use App\Traits\FirebaseTrait;
use App\Traits\SMSTrait;
use Illuminate\Support\Facades\Notification;

class FirebaseController extends Controller
{    use PaymentGatewayTrait;

    use FirebaseTrait, SMSTrait;
    public function save_web_token(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'data_token' => 'required',
        ],
        [
            'required' => 'this_field_is_required',
        ]);

        if ( $validator->fails() ) {
            $toReturn['message']               = 'fail';
            $toReturn['data']['result']        = '';
            $toReturn['errors']['global']      = '';
            $messages = $validator->messages()->toArray();
            foreach ($messages as $key => $value) {
                $toReturn['errors'][$key] = $value[0];
            }
            return response()->json($toReturn, 200);
        }


        try {
            $data_token = FirebaseToken::where('token', $request->data_token)->first();
                if(is_null($data_token))
                $data_token = new FirebaseToken();
                $data_token->type = "WEB";
                $data_token->token = "{$request->data_token}";
                $data_token->user_id = auth()->check() ? auth()->user()->id : NULL;
                $data_token->save();
        } catch (\Exception $e) {
            $toReturn['message'] = 'fail';
            $toReturn['data']['result'] = '';
            $toReturn['errors']['global'] = 'an_error_occurred';
            return response()->json($toReturn, 200);
        }

        $toReturn['message'] = 'success';
        $toReturn['data']['result'] = 'saved_successfully';
        $toReturn['errors']['global'] = '';
        return response()->json($toReturn, 200);
    }

    public function test(){
        echo '86424803DF1EB5441C7E82CE1CE59047.prod02-vm-tx18';
        $payment_status = $this->getPaymentStatus('86424803DF1EB5441C7E82CE1CE59047.prod02-vm-tx18');
print_r($payment_status);
//        $order_provider=User::findOrFail(1);
//        $item = PublicOrder::findOrFail(6);
//
//        Notification::send($order_provider, new FinishPublicOrderNotify($item));

//        $this->desktopNotifications('title', 'message', 'https://www.google.com', [8528]);
//            $this->sendSms('0555067553', 'شكرا على استخدامك منصة معاملة');
    }
}
