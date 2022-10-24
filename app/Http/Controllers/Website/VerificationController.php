<?php

namespace App\Http\Controllers\Website;


use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Throwable;
use Auth;
use Session;

/**
 * Class HomeController
 * @package App\Http\Controllers\Website
 */
class VerificationController extends Controller
{
    /**
     * عرض صفحة كود التفعيل
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(Request $request)
    {
        return view('website.auth.confirmCode');

        // return $request->user()->hasVerifiedPhone()
        //     ? redirect()->route('home')
        //     : view('website.auth.confirmCode');
    }


    /**
     * تاكيد تسجل الدخول عن طريق كود التفعيل
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws Throwable
     * @throws ValidationException
     */
    public function verify(Request $request)
    {
        try {
            if (Auth::user()->v_code != $request->verification_code) {
                throw ValidationException::withMessages([
                    'code' => ['الكود الذي ادخلته خاطئ. يرجى المحاولة مرة أخرى أو اطلب كود أخر.'],
                ]);
            } else {
                if (!empty(Auth::user()->phone_code)){
                    $users = User::where('phone', '=', $request->input('phone'))->first();
                    if ($users != null) {
                        throw ValidationException::withMessages([
                            'code' => ['رقم الهاتف  مستخدم من قبل عميل اخر'],
                        ]);
                    }
                    Auth::user()->update(['phone' => Auth::user()->phone_code]);
                }
                if (!empty(Auth::user()->email_code)){
                    $users = User::where('email', '=', $request->input('email'))->first();
                    if ($users != null) {
                        throw ValidationException::withMessages([
                            'code' => ['هذا الايميل مستخدم من قبل عميل اخر'],
                        ]);
                    }
                    Auth::user()->update(['email' => Auth::user()->email_code]);
                }

                Auth::user()->email_code = '';
                Auth::user()->phone_code = '';
                Auth::user()->save();

                // session()->forget('phone');
                // session()->forget('email');
                session()->flush();

                return redirect()->route('user.profile')->with('success', 'تم تعديل بنجاح!');
            }
        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }
}
