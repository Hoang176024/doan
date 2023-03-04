<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'name'=> "required|max:120|unique:suppliers,name,{$this->id}",
            'address'=>'required|max:200',
            'phone'=>'required|min:11|numeric',
            'email'=>'required|email|unique:suppliers,email,'.$this->id,
        ];
    }
}
