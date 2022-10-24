<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use mysql_xdevapi\Exception;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $token = Auth::guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user =  Auth::guard('api')->user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);

    }

    public function register(Request $request){
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'active' => 'required',
                'type' => 'required',
                'phone' => 'required|unique:users',
            ]);

            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'level' => $request->type,
                'email' => $request->email,
                'active' => $request->active,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'status' => 'success',
                'user_id' => $user->id,
                'message' => 'User created successfully',
            ]);
        }catch (\Error $e){
            return response()->json([
                'success' => "false",
                "message"=> 'There is something wrong'
            ]);
        }

    }
    public function update(Request $request,$id){
        try {

            $request->validate([
                'email' => 'required|string|email|max:255|unique:users,email,'.$id,
                'phone' => 'required|unique:users,phone,'.$id,
            ]);
          if ($request->has('password')) {
              $request->merge([
                  'password' => Hash::make($request->password),
              ]);
          }
            User::where('id',$id)->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'User Updated successfully',
            ]);
        }catch (\Error $e){
            return response()->json([
                'success' => "false",
                "message"=> 'There is something wrong'
            ]);
        }

    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

}
