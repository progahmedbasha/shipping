<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ordersRequest extends FormRequest
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
            'total_price' => 'required|not_in:0',
            'servant_id' => 'required|exists:servants,id'
        ];
    }
}
