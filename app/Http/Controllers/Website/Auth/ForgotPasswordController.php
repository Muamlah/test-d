<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Website\Controller;
use App\Http\Requests\Website\Password\Reset;
use App\Models\User;
use App\Traits\OdooTrait;
use App\Traits\SMSTrait;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Notifications\SendCustomEmailsToUser;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    use SMSTrait;
    use OdooTrait;

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('website.auth.passwords.phone');
    }

    /**
     * Send a password to the given user.
     * @param Reset $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function sendPasswordByPhone(Reset $request)
    {

        try {
            DB::beginTransaction();
            $password = $this->generateRandomString();
            $user= User::where('phone', $request->phone)->first();
//            if ($user->activation_type=='email') {
                $code = $user->verification_code  ;

                // $details = [
                //     'name' => $user->name,
                //     'userName' => $user->phone,
                //     'password' => $password
                // ];
                // \Mail::to($user->email)->bcc('muhammad.h.alali@gmail.com')->send(new \App\Mail\ResetPasswordMail($details));

                $title      = 'السلام عليكم ' . $user->name;
                $message1   = 'تم اعادة تعين كلمة المرور بنجاح';
                $message2   = 'رقم المستخدم ' . $user->phone;
                $message3   = 'كلمة المرور ' . $password;

                $this->sendEmail($title,$message1,$message2,$message3,$user->email);

                $mass="تم ارسال كلمة المرور الى البريد الاكتروني $user->email ";
//            }else{
//                $message = "عزيزي العميل ..
//                تم اعادة تعين كلمة المرور
//                اسم المستخدم:$request->phone
//                كلمة المرور:$password
//                الرابط https://app.muamlah.com
//                نسعد بخدمتكم على مدار ٢٤ ساعة";
//                $this->sendSMS($user->phone, $message);
//                $mass="سوف تصلك رسالة SMS بكلمة المرور الجديدة خلال دقائق";
//
//            }
            $user->update(['password' => bcrypt($password)]);
//            $this->updateUserOdoo($user, $password);
            DB::commit();
            return redirect()->route('login')->with("success", $mass); // send id of inserted;

        } catch (Throwable $throwable) {
            throw $throwable;
        }

    }
    public function sendEmail($title,$message1,$message2,$message3,$email){

        $info = [
            'title'             => $title,
            'message1'          => $message1,
            'message2'          => $message2,
            'message3'          => $message3,
        ];

        Mail::to($email)->bcc('muhammad.h.alali@gmail.com')->send(new SendCustomEmailsToUser($info));
    }
    public function generateRandomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
