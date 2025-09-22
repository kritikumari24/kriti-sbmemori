<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if (!request()->is('admin/products/create')) {
            return [
                'title' => 'required',
                'name' => 'required',
                'quantity' => 'required',
                'price' => 'required',
            ];
        } else {
            return [
                'title' => 'required',
                'name' => 'required',
                'quantity' => 'required',
                'price' => 'required',
            ];
        }
    }
    public function messages()
    {
        return [
            'title.required' => __('validation.required', ['attribute' => 'Title']),
            'name.required' => __('validation.required', ['attribute' => 'Name']),
            'quantity.required' => __('validation.required', ['attribute' => 'Quantity']),
            'price.required' => __('validation.required', ['attribute' => 'Price']),
        ];
    }
}
