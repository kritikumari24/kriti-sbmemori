<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StaffAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (!Auth::user()->hasRole('Staff')) {
            return redirect()->route('login')->with('error', 'Access denied. Staff access required.');
        }
        
        return $next($request);
    }
}