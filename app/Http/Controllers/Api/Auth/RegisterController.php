<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try{
            User::create([
                'first_name' => $request->full_name,
                'last_name' => $request->last_name,
                'phone_Number' => $request->phone_Number,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            return $this->sendResponse('register_success', );
        }
        catch(Exception $e){
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function login(LoginRequest $request){
        try {
            if(is_numeric($request->get('email'))){
                return ['phone_number'=>$request->get('email'),'password'=>$request->get('password')];
                }
                else{
                return ['email' => $request->get('email'), 'password'=>$request->get('password')];
                }

            if (isset($request->email)) {
                $credentials = $request->only(['email', 'password']);
                $user = User::where('email', $request->email)->first();
            } else {
                $credentials = $request->only(['phone', 'password']);
                $user = User::where('phone', $request->phone)->first();
            }

            $data['token'] = $user->createToken('Laravel Password Grant Client')->accessToken;
            $data['role_type'] = $role->role_type;

            return $this->sendResponse(__('auth.login_success'), $data);
        } catch(Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    protected function credentials(Request $request)
    {
        if(is_numeric($request->get('email'))){
        return ['phone_number'=>$request->get('email'),'password'=>$request->get('password')];
        }
        else{
        return ['email' => $request->get('email'), 'password'=>$request->get('password')];
        }
    }
}
