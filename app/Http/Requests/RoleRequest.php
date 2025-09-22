<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        if (!request()->is('admin/roles/create')) {
            return [
                'name' => 'required|unique:roles,name,' . request()->id,
                'permissions' => 'required',
            ];
        } else {
            return [
                'name' => 'required|unique:roles,name',
                'permissions' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => 'Name']),
            'name.unique' => __('validation.unique', ['attribute' => 'Name']),
            'permissions.required' => 'Permission is Required',
        ];
    }
}
