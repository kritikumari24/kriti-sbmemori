<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ParentsAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (!Auth::user()->hasRole('Parents')) {
            return redirect()->route('login')->with('error', 'Access denied. Parents access required.');
        }
        
        return $next($request);
    }
}