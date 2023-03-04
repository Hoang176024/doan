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
            'name.required' => "Tên Sản Phẩm không được để trống",
            'name.unique' => "Tên Sản Phẩm đã tồn tại trong",
            'price_in.required'=> "Giá Nhập không được để trống",
            'price_in.integer'=> "Giá Nhập là một số nguyên",
            'price_in.min'=> "Giá Nhập nhỏ nhất là 2000",
            'price_out.required'=> "Giá Bán được để trống",
            'price_out.gt'=> "Giá Bán phải lớn hơn Giá Nhập",
            'quantity.required' => "Số Lượng không được để trống",
            'quantity.integer' => "Số Lượng phải là số nguyên",
            'quantity.min' => "Số Lượng phải lớn hơn 20",
            'photo.mimes' => "File ảnh phải có đuôi là .jpg, .svg, .bmp, png",
            'category_id.required' => "Phải chọn Danh Mục",
            'brand_id.required' => "Phải chọn Thương Hiệu",
            'supplier_id.required'=>"Phải chọn Nhà Cung Cấp",
            'unit_id.required'=>"Phải chọn Đơn Vị Tính",
            'barcode.required'=>"Mã Vạch không được để trống",
            'barcode_digits'=>"Mã Vạch chứa 13 ký tự số",
            'mfg.before' => "Ngày Sản Xuất không được sau Hiện Tại",
            'exp.after' =>"Hạn Sử Dụng không được trước Ngày Sản Xuất"
        ];
    }
}
