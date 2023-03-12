<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'retype_password' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Full Name cannot be empty',
            'email.required' => 'Email cannot be empty',
            'email.unique' => 'This email already exists',
            'password.required' => 'Password cannot be empty',
            'password.min' => 'Password must be at least 6 characters',
            'retype_password.required' => 'Retype Password cannot be empty',
            'retype_password.same' => 'Retype Password must be same as password',
        ];
    }
}
