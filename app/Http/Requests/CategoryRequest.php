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
            'name.required' => "Name cannot be blank",
            'name.unique' => "Category with this name already exists",
            'parent_id.required' => "Please select Parent Category for this Category"
        ];
    }
}
