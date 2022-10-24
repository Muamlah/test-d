<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CanPermission {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission, $guard = null) {

        $admin=  Auth::guard('admin')->user();
        if(!$admin->roles->isEmpty()){
            foreach ($admin->roles as $role){
                $admin_permission=$role->permissions->pluck('name')->toArray();
            }
            if(in_array($permission, $admin_permission) == true){
                return $next($request);
            }else{
               abort(403);
            }

        }else{
            return $next($request);
        }
    }



}
