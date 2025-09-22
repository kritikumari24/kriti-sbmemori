<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Only guests for "admin" guard are allowed except
     * for logout.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest');
    }

    public function showResetForm(Request $request, $token = null)
    {
        $admin = User::whereHas('roles', function ($q) {
            $q->where('name', 'Admin');
        })->where('email', $request->email)->first();
        if (!$admin) {
            abort(403);
        }
        return view('admin.auth.passwords.reset', [
            'token' => $token,
            'email' => $admin->email,
        ]);
    }
    // public function reset(Request $request, $token = null){
    //     $request->validate($this->rules(), $this->validationErrorMessages());
    //     $admin = User::where('remember_token', $request->token)->first();
    //     if(!$admin)
    //     {
    //         abort(403);
    //     }
    //     $admin->password = Hash::make($request->password);
    //     $admin->remember_token = Str::random(50);
    //     $admin->save();
    //     return redirect()->route('admin.login')->with('success','Sucessfully Password reset !');
    // }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    // protected function rules()
    // {
    //     return [
    //         'token' => 'required',
    //         'email' => 'required|email',
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ];
    // }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    // protected function validationErrorMessages()
    // {
    //     return [];
    // }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    protected function broker()
    {
        return Password::broker('admins');
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
