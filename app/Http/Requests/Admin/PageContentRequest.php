<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageContentRequest extends FormRequest
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
            'title' => 'required|alpha_spaces',
            'content' => 'required|min:50',
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
            'title.required' => __('validation.required', ['attribute' => 'Title']),
            // 'title.alpha_spaces' => __('validation.alpha_spaces', ['attribute' => 'Title']),
            'content.required' => __('validation.required', ['attribute' => 'Content']),
        ];
    }
}
