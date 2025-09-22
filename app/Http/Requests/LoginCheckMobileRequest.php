<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginCheckMobileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mobile_no' => 'required|numeric|phone:IN',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'mobile_no.required' => __('validation.required', ['attribute' => 'Mobile Number ']),
            'mobile_no.unique' => __('validation.unique', ['attribute' => 'Mobile Number ']),
        ];
    }
}
