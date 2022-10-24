<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Website\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

/**
 * Class LoginController
 * @package App\Http\Controllers\Website\Auth
 */
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'phone';
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('web');
    }

    public function credentials(Request $request)
    {
        return [
            'phone' => $request->input('phone'),
            'password' => $request->input('password'),
            'status' => 'active'
        ];
    }

    protected function authenticated(Request $request, $user)
    {
        if($user->level == 'user')
        {
            return redirect()->route('privateOrder.index');
        }
        else
        {
            return redirect()->route('privateService.index');
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function showLoginForm()
    {
        return view('website.auth.login');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
//        $this->middleware('throttle:3,60,login')->only('login');
    }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        return redirect('/login');
    }
}
