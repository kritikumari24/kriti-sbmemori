<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if (!request()->is('admin/users/create')) {
            return [
                'name' => 'required|max:150',
                'email' => 'required|email|max:150|unique:users,email,' . request()->id,
                // 'password' => 'required',
                'mobile_no' => 'required',
                'roles' => 'required',
                // 'image' => 'required',
            ];
        } else {
            return [
                'name' => 'required|max:150',
                'email' => 'required|max:150|email|unique:users,email,',
                'password' => 'required',
                'mobile_no' => 'required',
                'roles' => 'required',
                // 'image' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => 'Name']),
            'email.required' => __('validation.required', ['attribute' => 'Email']),
            'email.email' => __('validation.email', ['attribute' => 'Email']),
            'email.max' => __('validation.max', ['attribute' => 'Email']),
            'email.unique' => __('validation.unique', ['attribute' => 'Email']),
            'password.required' => __('validation.required', ['attribute' => 'Password']),
            'mobile_no.required' => __('validation.required', ['attribute' => 'Mobile Number']),
            'roles.required' => __('validation.required', ['attribute' => 'Role']),
            'image.required' => __('validation.required', ['attribute' => 'Image']),
        ];
    }
}
