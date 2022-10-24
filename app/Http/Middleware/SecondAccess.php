<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecondAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd(\Request::route()->getName());
        if(!\Auth::guard('admin')->check()){
            return redirect('admin/login');
        }
        if(!\Auth::guard('admin')->user()->has_second_access()){
            if(\Request::route()->getName() == 'admin.balance_requests')
            {
                return redirect()->route('admin.admins.verify_form',['type' => 'balance_requests']);
            }
            elseif(\Request::route()->getName() == 'admin.wallet')
            {
                return redirect()->route('admin.admins.verify_form',['type' => 'wallet']);
            }
            // return redirect('admin/admins/second_auth/form');
        }
        
        return $next($request);
    }
}
