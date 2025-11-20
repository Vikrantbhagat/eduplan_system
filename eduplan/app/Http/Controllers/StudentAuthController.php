<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class StudentAuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.student-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'student',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('student.dashboard'))
            ->with('success', 'Welcome! Your student account has been created.');
    }

    public function showLogin()
    {
        return view('auth.student-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->role !== 'student') {
                Auth::logout();
                return back()->withErrors(['email' => 'This login is only for students.']);
            }

            return redirect()->intended(route('student.dashboard'));
        }

        return back()->withErrors(['email' => 'Invalid credentials'])
                     ->withInput($request->only('email'));
    }

public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('student.login'); // Redirect back to login
}

}
