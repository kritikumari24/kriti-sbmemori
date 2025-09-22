<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminChangePasswordRequest extends FormRequest
{

    private $auth_user;
    public function __construct()
    {
        $this->auth_user = Auth::guard('admin')->user();
        // dd($this->auth_user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'old_password' => ['required', function ($attribute, $value, $fail) {
                // dd($this->auth_user);
                if (!Hash::check($value, $this->auth_user->password)) {
                    return $fail(__('The old password is incorrect.'));
                }
            }],
            'password' => ['required', function ($attribute, $value, $fail) {
                if (Hash::check($value, $this->auth_user->password)) {
                    return $fail(__('please enter different to old password.'));
                }
            }],
            'confirm_password' => 'required|same:password',
        ];
    }
}
