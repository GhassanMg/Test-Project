<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UpdatePasswordRequest;
use App\Http\Requests\Api\User\UpdateProfileRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function get_current_user_profile()
    {
        try {
            $user = auth()->user();
            return $this->sendResponse('', $user);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function update_user_profile(UpdateProfileRequest $request)
    {
        try {
            $user = $request->user();
            $user->update([
                'first_name'   => $request->first_name,
                'last_name'    => $request->last_name,
                'email'        => $request->email,
                'phone_number' => $request->phone_number,
            ]);
            return $this->sendResponse('profile updated successfully', $user);
        } catch (Exception $e) {
            return $this->sendError('profile update error', 500);
        }
    }

    public function update_password(UpdatePasswordRequest $request)
    {
        try {
            $user = $request->user();
            $user->update([
                'password' => $request->get('password')
            ]);
            return $this->sendResponse('password updated successfully', $user);
        } catch (Exception $e) {
            return $this->sendError('password update error', 500);
        }
    }
}
