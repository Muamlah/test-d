<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Admin\Home as Set;
use Closure;

class EnsurePhoneIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( $request->user() and !$request->user()->hasVerifiedPhone()) {
            return redirect()->route('phoneVerification.notice');
        }
        return $next($request);
    }
}
