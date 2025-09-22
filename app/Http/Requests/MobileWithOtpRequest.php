<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MobileWithOtpRequest extends FormRequest
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
            'otp' => 'required'
        ];
    }
}
