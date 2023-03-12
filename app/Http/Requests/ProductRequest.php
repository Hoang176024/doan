<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class ProductRequest extends FormRequest
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
            'name' => "required|unique:products,name,{$this->id}",
            'price_in' => 'required|integer|min:2000|max:99999999',
            'price_out' => 'required|gt:price_in|max:99999999',
            'quantity' => 'required|integer|min:20',
            'photo' => 'nullable|mimes:jpg,svg,bmp,png|dimensions:min_width=100,min_height=200|max:2048',
            'sale' => 'nullable|integer|max:95',
            'category_id' => 'required',
            'brand_id' => 'required',
            'supplier_id'=> 'required',
            'unit_id' => 'required',
            'barcode' => 'required|digits:13',
            'description'=>'nullable',
            'mfg' => 'nullable|date_format:"d-m-Y"|before:today',
            'exp' => 'nullable|date_format:"d-m-Y"|after:mfg',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Product Name cannot be blank",
            'name.unique' => "The Product Name already exists",
            'price_in.required'=> "Price Entry cannot be blank",
            'price_in.integer'=> "Entry Price is an integer",
            'price_in.min'=> "Minimum Entry Price is 2000",
            'price_out.required'=> "Price cannot be blank",
            'price_out.gt'=> "The Selling Price must be greater than the Entry Price",
            'quantity.required' => "Quantity cannot be left blank",
            'quantity.integer' => "Quantity must be an integer",
            'quantity.min' => "Quantity must be more than 20",
            'photo.mimes' => "Image files must have the extension .jpg, .svg, .bmp, png",
            'category_id.required' => "Must choose Category",
            'brand_id.required' => "Must choose Brand",
            'supplier_id.required'=>"Must choose a Provider",
            'unit_id.required'=>"Must select Unit of Calculation",
            'barcode.required'=>"Barcode cannot be blank",
            'barcode_digits'=>"Barcode contains 13 numeric characters",
            'mfg.before' => "Manufacture Date cannot be after Current date",
            'exp.after' =>"The Expiry Date cannot be before the Manufacture Date"
        ];
    }
}
