<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Only allow admin users
        if(auth()->check() && auth()->user()->role === 'admin'){
            return $next($request);
        }

        // Otherwise redirect
        return redirect('/')->with('error', 'You are not authorized to access this page.');
    }
}
