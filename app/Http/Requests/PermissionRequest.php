<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        if (!request()->is('admin/permissions/create')) {
            return [
                'name' => 'required|unique:permissions,name,' . request()->id,
            ];
        } else {
            return [
                'name' => 'required|unique:permissions,name',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => 'Name']),
            'name.unique' => __('validation.unique', ['attribute' => 'Name']),
        ];
    }
}
