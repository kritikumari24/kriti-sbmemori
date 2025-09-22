<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
                'name' => 'required',
                'email' => 'required|email|max:150|unique:users,email,' . request()->id,
            ];
        } else {
            return [
                'name' => 'required',
                'email' => 'required|max:150|email|unique:users,email,',
            ];
        }
    }
    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => 'Name']),
        ];
    }
}
