<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            // 'name' => 'required|max:120|unique:brands,name' . $this->id,
            // 'photo' => 'nullable|mimes:jpg,svg,png|dimensions:min_width=100, max_height=200|max:2048',
            'name'=> "required|max:120|unique:brands,name,{$this->id}",
            'photo' => 'nullable|mimes:jpg,svg,png|dimensions:min_width=100, max_height=200|max:2048',
        ];
    }
}
