<?php

namespace App\Http\Controllers\API\Auth;
use App\Http\Controllers\API\Helpers\ReturnApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use App\Traits\SMSTrait;
use Throwable;
use Auth;
use Error;
use Validator;

class PhoneVerificationController extends Controller
{
    use ReturnApi;
    use SMSTrait;
    //*START*  verify CODE >>>>>>>>>>>> >>>>>>>>>>>> >>>>>>>>>>>>
    public function verify(Request $request)
    {
         //*START* validat >>
    try {
        if(auth()->user()->active)
        {
            $code="e006";
            $msg="تم التحقق مسبقاً ";
            return $this->Error($code, $msg);
        }
         $rules = [
            "verification_code"    => "required|integer",
        ];

        $validator   =   Validator::make($request->all(), $rules);

        if ($validator->fails()) 
        {
            $code  =  $this->returnCodeAccordingToInput ($validator);
            return    $this->returnValidationError      ($code, $validator);
        }
         //*END* validat >>


        $requestCode  =  $request['verification_code'];
        $orginalCode  =  Auth::user()->verification_code;

        if( $requestCode ==  $orginalCode )
            {
                        Auth::user()->update(['active' => 1]);
                        $msg    =   "تم تفعيل الحساب بنجاح .. " ;
                        $code   =   "s005";
                        return $this->Success($msg,$code);
            }
        else
             {
                        $msg    =   "رمز التحقق خاطئ " ;
                        $code   =   "e005";
                        return $this->Error($msg,$code);
            }
         }
    catch (\Exception $ex) 
        {
        return $this->Error($ex->getCode(), $ex->getMessage());
        }
        
    }
    //*END*  verify CODE >>>>>>>>>>>> >>>>>>>>>>>> >>>>>>>>>>>>




     //*START*  Resend CODE >>>>>>>>>>>> >>>>>>>>>>>> >>>>>>>>>>>>
     public function resendCode(Request $request)
     {
         try{
        
            if(auth()->user()->active)
            {
                $code="e006";
                $msg="تم التحقق مسبقاً ";
                return $this->Error($code, $msg);
            }

            $verification_code = rand(1000,9999);
            Auth::user()->update(['verification_code' => $verification_code]);   
        
            $msg = 'كود تفعيل حسابك على منصة معاملة:' . "\n" . $verification_code .  "\n" .
            'تنبيه : لا تشارك هذا الرمز ابدا مع اي شخص لحماية حسابك' ;
    
            //Send Code SMS
            $this->sendSMS($request['phone'], $msg);

            $msg  =  "تمت إعادة إرسال رمز التحقق  ";
            $code =  "S007" ;
            return $this->Success($msg,$code);
                
        }
        catch (\Exception $ex) 
        {
            return $this->Error($ex->getCode(), $ex->getMessage());
        }

        }
     //*END*  Resend CODE >>>>>>>>>>>> >>>>>>>>>>>> >>>>>>>>>>>>
}


