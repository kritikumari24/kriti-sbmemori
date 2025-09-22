<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            // 'data.tax' => 'required|min:1',
            // 'data.language' => 'required',
            // 'data.contact_number' => 'required',
            // 'data.address' => 'required',
            // 'data.company_full_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'data.tax.required' => __('validation.required', ['attribute' => 'Sales Tax']),
            'data.tax.min' => __('validation.min', ['attribute' => 'Sales Tax']),
            'data.language.required' => __('validation.required', ['attribute' => 'Language']),
            'data.contact_number.required' => __('validation.required', ['attribute' => 'Contact Number']),
            'data.address.required' => __('validation.required', ['attribute' => 'Address']),
            'data.company_full_name.required' => __('validation.required', ['attribute' => 'Company Full Name']),
        ];
    }
}
