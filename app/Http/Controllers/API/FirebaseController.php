<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FirebaseToken;
use DB;
use App\Traits\FirebaseTrait;
use App\Traits\SMSTrait;

class FirebaseController extends Controller
{
    use FirebaseTrait, SMSTrait;
    public function save_token(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'data_token'=>'required',
            // 'id'=>'required|exists:sessions,id',
            'type'=>'required',
        ]);
        $user_id = $request->user_id ?? auth()->id();
        if (! $user_id) {
            $session = DB::table('sessions')->whereNotNull('user_id')->where('last_activity', time())->get();
            if ($session) {
                $user_id = $session->user_id;
            }
        }
        if (! $user_id) {
            return response()->json([
                'data' => [
                    'message' => 'Unauthorized',
                ],
            ], 403);
        }

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
            DB::transaction(function() use ($data_token, $request, $user_id) {
                if(is_null($data_token))
                    $data_token = new FirebaseToken();
                $data_token->type = $request->type;
                $data_token->token = $request->data_token;
                $data_token->user_id = $user_id;
                $data_token->save();
            }, 5);
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
        // $this->desktopNotifications('title', 'message', 'https://www.google.com', [127]);
        $this->sendSms('0555067553', 'شكرا على استخدامك منصة معاملة');
    }
}
