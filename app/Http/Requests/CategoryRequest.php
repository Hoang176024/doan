<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => "required|max:120|unique:categories,name,{$this->id}",
            'parent_id' => "required"
        ];

    }
    public function messages()
    {
        return [
            'name.required' => "Tên không được để trống",
            'name.unique' => "Danh Mục với tên này đã tồn tại",
            'parent_id.required' => "Phải chọn Danh Mục Cha cho Danh Mục này"
        ];
    }
}
