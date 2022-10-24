<?php

namespace App\Http\Controllers\Website;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Throwable;
use Auth;
/**
 * Class HomeController
 * @package App\Http\Controllers\Website
 */
class PhoneVerificationController extends Controller
{
    /**
     * عرض صفحة كود التفعيل
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(Request $request)
    {

        return $request->user()->hasVerifiedPhone()
            ? redirect()->route('home')
            : view('website.auth.confirmCode');
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
            if (Auth::user()->verification_code != $request->verification_code) {
                throw ValidationException::withMessages([
                    'code' => ['الكود الذي ادخلته خاطئ. يرجى المحاولة مرة أخرى أو اطلب كود أخر.'],
                ]);
            }else{
                Auth::user()->update(['active'=>1]);
                return redirect('/')->with('status', 'تم تفعيل حسابكم!');
            }
        }catch (Throwable $throwable) {
            throw $throwable;
        }

    }
}
