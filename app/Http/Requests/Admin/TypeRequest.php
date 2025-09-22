<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest
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
        if (!request()->is('admin/types/create')) {
            return [
                'name' => 'required|max:150|unique:types,name,' . request()->id,
                'is_active' => 'required',
            ];
        } else {
            return [
                'name' => 'required|max:150|unique:types,name',
                'is_active' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => 'Name']),
            'is_active.required' => __('validation.required', ['attribute' => 'Is active']),
        ];
    }
}
