<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productsRequest extends FormRequest
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
            'resever_name'  => 'required',
            'resver_phone'  => 'required|unique:products,resver_phone,'.$this->id,
            'supplier_id'   => 'required|exists:suppliers,id',
            'city_id'       => 'required|exists:cities,id',
            // 'status_id'     => 'required|exists:status,id',
            'adress'        => 'required',
            'product_price' => 'required',
            'notes'         => 'nullable',
        ];
    }

    public function messages()
    {
        return
        [
            
            'name.required'             => 'يجب ادخال اسم المستلم',
            'supplier_id.required'      => 'يجب اختيار اسم المورد',
            'city_id.required'          => 'يجب اختيار المدينة',
            'status_id.required'        => 'يجب اختيار حالة الشحنة',
            'adress.required'           => 'يجب ادخال عنوان المستلم ',
            'product_price.required'    => 'يجب ادخال سعر الشحنة ',
            'resver_phone.required'     => 'رقم التليفون مطلوب ',
            'resver_phone.unique'       => 'هذا الرقم مستخدم من قبل',    
        ];
    }
}
