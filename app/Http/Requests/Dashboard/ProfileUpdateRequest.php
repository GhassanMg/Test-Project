<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255|min:3',
            'last_name' => 'required|string|max:255|min:3',
            'email' => ['required_without:phone_number', Rule::unique('users')->ignore($this->user), 'email', 'max:255', 'min:3', 'regex:/(.+)@(.+)\.(.+)/i'],
            'phone_number' => ['required_without:email', Rule::unique('users')->ignore($this->user), 'string', 'regex:/(^(\+)*(\d+)$)/u', 'max:255', 'min:6'],
        ];
    }

    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->password == null) {
            $this->request->remove('password');
        }
    }
}
