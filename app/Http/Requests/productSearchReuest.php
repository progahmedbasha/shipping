<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productSearchReuest extends FormRequest
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
        return 
        [
            'governorate_id'    => 'required|exists:governorates,id',
            'city_id'           => 'required|exists:cities,id',
            // 'servant_id'        => 'required|exists:servants,id',
            // 'servant_id'        => 'required|exists:servants,id',
            // 'shipping_price'    => 'required',
        ];
    }

    public function messages()
    {
        return
        [
            
            'governorate_id.required'     => 'يجب اختيار اسم المحافظة',
            'governorate_id.exists'       => 'هذه المحافظة غير موجودة في هذا الجدول',

            'city_id.required'     => 'يجب اختيار اسم المدينة',
            'city_id.exists'       => 'هذه المدينة غير موجودة في هذا الجدول',
            
            // 'servant_id.required'     => 'يجب اختيار اسم المندوب',
            // 'servant_id.exists'       => 'هذا المندوب غير موجود في هذا الجدول',

            // 'shipping_price.required'    => ' قيمة الشحن مطلوبة',
            
        ];
    }
}
