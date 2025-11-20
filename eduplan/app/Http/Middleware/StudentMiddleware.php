<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
// app/Http/Middleware/EnsureStudent.php
public function handle($request, Closure $next)
{
    if (Auth::check() && Auth::user()->role === 'student') {
        return $next($request);
    }
    Auth::logout();
    return redirect()->route('student.login');
}
}
