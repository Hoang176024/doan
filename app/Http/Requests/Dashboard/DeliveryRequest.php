<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
            'province_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            'fee' => 'required|integer|min:10000|max:99000'
        ];
    }

    public function messages()
    {
       return[
           'province_id.required' => 'Phải Chọn 1 Tỉnh/Thành Phố',
           'district_id.required' =>  'Phải Chọn 1 Quận/Huyện',
           'ward_id.required' => 'Phải Chọn 1 Phường/Thị Trấn/Xã',
           'fee.required' => 'Phí Vận Chuyển không được để trống',
           'fee.min' => 'Phí Vận Chuyển thấp nhất là 10,000 VNĐ',
           'fee.max' => 'Phí Vận Chuyển cao nhất là 99,000 VNĐ',
       ];
    }
}
