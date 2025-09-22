<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();
            if ($user->hasRole('Admin')) {
                return redirect()->intended('admin/dashboard');
            } else {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with('error', 'Opps! You are unauthorized user.');
            }
        }
        return redirect()->route('admin.login')->with('error', 'Opps! You have entered invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    protected function guard() // And now finally this is our custom guard name
    {
        return Auth::guard('admin');
    }
}
