<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PushNotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $users_validation = 'nullable';
        if (isset(request()->user)) {
            if (request()->user == 0) {
                $users_validation = 'required';
            }
        }
        return [
            'user_type' => 'required',
            'users' => $users_validation,
            'title' => 'required|max:100',
            // 'notification_time' => 'nullable',
            // 'direct_notification' => 'nullable',
            'messages' => 'required',
            'image' => 'nullable|image',
            'icon' => 'nullable|image',
            'link_id' => 'nullable',
            'link_type' => 'required',
        ];
    }
}
