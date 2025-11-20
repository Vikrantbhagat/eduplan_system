<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login form for role
    public function showLoginForm($role)
    {
        return view('auth.login', compact('role'));
    }

    // Handle login
    public function login(Request $request, $role)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->where('role', $role)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect('/dashboard')->with('success', ucfirst($role) . ' logged in successfully!');
        }

        return back()->withErrors(['email' => 'Invalid credentials or role!']);
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
