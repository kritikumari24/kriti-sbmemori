<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
        return  [
            'answer' => 'required|max:1500',
            'question' => 'required|max:200',
            // 'app_type' => 'required',
            // 'priority' => 'nullable|numeric|max:10',
        ];
    }
    public function messages()
    {
        return [
            'app_type.required' => __('validation.required', ['attribute' => 'Type']),
            'answer.required' => __('validation.required', ['attribute' => 'Answer']),
            'answer.max' => __('validation.max', ['attribute' => 'Answer']),
            'question.required' => __('validation.required', ['attribute' => 'Question']),
            'question.max' => __('validation.max', ['attribute' => 'Question']),
            'priority.required' => __('validation.required', ['attribute' => 'Priority']),
            'priority.numeric' => __('validation.numeric', ['attribute' => 'Priority']),
            'priority.max' => __('validation.max', ['attribute' => 'Priority']),
        ];
    }
}
