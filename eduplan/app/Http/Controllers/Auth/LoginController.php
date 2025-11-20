<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm($role)
    {
        return view('auth.login', compact('role'));
    }

    // Handle login request
    public function login(Request $request, $role)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => $role, // ensure role matches
        ])) {
            $request->session()->regenerate();

            // Redirect based on role
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'instructor') {
                return redirect()->route('instructor.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Invalid credentials for ' . ucfirst($role),
        ]);
    }


public function logout(Request $request)
{
    // Get user role BEFORE logging out
    $role = Auth::user()->role;

    // Logout the user
    Auth::logout();

    // Optionally, invalidate session
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect based on role
    if ($role === 'admin') {
        return redirect()->route('login.form', 'admin');
    } else {
        return redirect()->route('login.form', 'instructor');
    }
}
}
