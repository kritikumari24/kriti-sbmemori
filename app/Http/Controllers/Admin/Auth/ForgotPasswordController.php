<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\ForgotPasswordMail;
use Exception;
use Illuminate\Support\Facades\Password;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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

    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $admin = User::whereHas('roles', function ($q) {
            $q->where('name', 'Admin');
        })->where('email', $request->email)->first();
        if (!$admin) {
            return redirect()->back()->with('error', 'you are not admin !');
        }
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    // public function sendResetLinkEmail(Request $request){
    //     $admin = User::whereHas('roles', function($q){
    //         $q->where('name', 'Admin');
    //     })->where('email', $request->email)->first();
    //     if(!$admin)
    //     {
    //         return redirect()->back()->with('error', "We can't find a user with that email address.");
    //     }
    //     $admin->remember_token = Str::random(50);
    //     $admin->save();
    //     try{
    //         Mail::to($request->email)->send(new ForgotPasswordMail($admin));
    //     }catch(Exception $e)
    //     {
    //         return redirect()->back()->with('error',$e->getMessage());
    //     }
    //     return redirect()->back()->with('success', 'We have emailed your password reset link!');

    // }

    /**
     * password broker for admin guard.
     *
     * @return PasswordBroker
     */
    public function broker()
    {
        return Password::broker('admins');
    }

    /**
     * Get the guard to be used during authentication
     * after password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    public function guard()
    {
        return Auth::guard('admin');
    }
}
