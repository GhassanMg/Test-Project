<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use Exception;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => $request->password,
            ]);
            $user->assignRole('user');

            return $this->sendResponse('register success', []);
        } catch(Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            if (is_numeric($request->get('login'))) {
                $credentials = ['phone_number' => $request->get('login'), 'password' => $request->get('password')];
                $user = User::where('phone_number', $request->login)->first();
            } else {
                $credentials = ['email' => $request->get('login'), 'password' => $request->get('password')];
                $user = User::where('email', $request->login)->first();
            }

            if (auth()->attempt($credentials)) {
                $data['token'] = $user->createToken('Laravel Password Grant Client')->accessToken;
            } else {
                return $this->sendError('auth wrong credentials', 401);
            }

            return $this->sendResponse('auth login success', $data);
        } catch(Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
