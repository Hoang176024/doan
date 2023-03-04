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
            'terms' => 'required',
            'grecaptcha' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Full Name không được để trống',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email này đã tồn tại',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password phải có ít nhất 6 ký tự',
            'retype_password.required' => 'Retype Password không được để trống',
            'retype_password.same' => 'Retype Password phải giống password',
            'terms.required' => 'Phải đồng ý với các điều khoản của chúng tôi',
            'grecaptcha.required' => 'Phải nhập Google Recaptcha',
        ];
    }
}
