<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Website\Controller;
use App\Http\Requests\Website\Register\Store;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Traits\GrupoTrait;
use App\Traits\OdooTrait;
use App\Traits\SMSTrait;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Throwable;
use App\Traits\UserLogTreat;
use App\Notifications\SendCustomEmailsToUser;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Models\Settings;
use App\Helpers\ZohoHelper;
/**
 * Class RegisterController
 * @package App\Http\Controllers\Website\Auth
 */
class RegisterController extends Controller
{
    use GrupoTrait;
    use SMSTrait;
    use UserLogTreat;
    use OdooTrait;

    /**
     * @return View
     */
    public function showRegistrationForm(): View
    {
        return view('website.auth.register');
    }
    /**
     * @return View
     */
    public function showCustomerRegistrationForm(): View
    {
        return view('website.auth.customer_register');
    }


    //// انشاء مستخدم جديد
    /**
     * @param Store $request
     * @return Application|RedirectResponse|Redirector
     * @throws Throwable
     */
    public function sendEmail($title,$message1,$message2,$message3,$email){

        $info = [
            'title'             => $title,
            'message1'          => $message1,
            'message2'          => $message2,
            'message3'          => $message3,
        ];

        Mail::to($email)->send(new SendCustomEmailsToUser($info));
    }
    public function register(Store $request)
    {

        try {
            DB::beginTransaction();
            $user = new User();
            $user->phone = $request->phone;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->level = "$request->typeUser";
            $user->activation_type = 'email';
            $user->active = 0;
            $user->verification_code = rand(1000, 9999);
            $user->password = bcrypt($request->password);
            $user->save();
//            $this->newUserOdoo($user, $request->password);
            Auth::login($user,  true);
            $send_to_email = Settings::first();
            if(!empty($send_to_email->email))
            {
                $title      = 'تم انشاء حساب جديد';
                $message1   = $user->name . ' - ' . $user->level;
                $message2   = '';
                $message3   = '';
                $this->sendEmail($title,$message1,$message2,$message3,$send_to_email->email);
            }

            if ($user->activation_type=='email') {
                $code = $user->verification_code  ;
                $details = [
                    'name' => $request->name,
                    'code' => $code
                ];
                // \Mail::to($user->email)->send(new \App\Mail\ActivationMail($details));
                $title      = 'السلام عليكم ' . $user->name;
                $message1   = 'تم تفعيل حساب';
                $message2   = 'كود تفعيل حسابك على منصة معاملة:  ' . $user->verification_code;
                $message3   = 'تنبيه : لا تشارك هذا الرمز ابدا مع اي شخص لحماية حسابك ';
                $this->sendEmail($title,$message1,$message2,$message3,$user->email);
            }else{
                $msg = 'كود تفعيل حسابك على منصة معاملة:' . "\n" . $user->verification_code .  "\n" .
                    'تنبيه : لا تشارك هذا الرمز ابدا مع اي شخص لحماية حسابك' ;
                $this->sendSMS($user->phone, $msg);
            }

            $message1       = 'إنشاء حساب';
            $message2       = 'تم إنشاء حساب جديد' ;
            $this->AddUserLog($user,$message1,$message2);

            DB::commit();
            $data = [];
            $zoho = new ZohoHelper;
            $item = [
                'First_Name' => $user->getFirstName(),
                'Last_Name' => $user->getName(),
                'Vendor_Name' => $user->getName(),
                'Email' => empty($user->email) ? $user->id.'@empty.com' : $user->email,
                'Phone' => $user->phone,
                'Is_Agent' => (bool) $user->is_agent,
                'In_Review' => (bool) $user->in_review,
                'Nationality' => empty($user->nationality) ? '' : $user->nationality,
                'Status' => $user->status,
                'Total_Balance' => $user->total_balance,
                'Pinding_Balance' => $user->pinding_balance,
                'Available_Balance' => $user->available_balance,
                'Instagram' => $user->instagram,
                'Facebook' => $user->facebook,
                'Twitter' => $user->twitter,
                'WhatsApp' => $user->whatsapp,
                'Description' => $user->bio,
            ];
            // dd($item);
            $data[] = $item;
            $response = $zoho->createModel('Vendors', $data);
            unset($data[0]['Vendor_Name']);
            $response2 = $zoho->createModel('Contacts', $data);
            if($response['success'] && $response2['success']){
                $user->added_to_zoho = "1";
            }
            $user->zoho_response = $response['data'];
            $user->zoho_response_code = $response['status_code'];
            $user->save();
            return redirect(route('phoneVerification.notice'));
        } catch (Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }


    }




}
