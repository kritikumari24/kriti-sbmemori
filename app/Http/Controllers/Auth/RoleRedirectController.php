<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoleRedirectController extends Controller
{
    public function redirectBasedOnRole()
    {
        $user = Auth::user();
        
        if ($user->hasRole('Admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('Staff')) {
            return redirect()->route('staff.dashboard');
        } elseif ($user->hasRole('Parents')) {
            return redirect()->route('parents.dashboard');
        }
        
        return redirect()->route('login')->with('error', 'No valid role assigned.');
    }
}