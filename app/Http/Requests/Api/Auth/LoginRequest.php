<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'email' => 'nullable|email|exists:users,email|max:255|min:1|regex:/(.+)@(.+)\.(.+)/i',
            // 'phone' => 'nullable|string|exists:users,phone|regex:/(^(\+)*(\d+)$)/u|max:255|min:6',
            'login' => 'required|string|max:55|min:10',
            'password' => 'required|string|max:255|min:8',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 400)
        );
    }
}
