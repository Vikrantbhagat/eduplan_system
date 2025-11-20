<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Admin registers instructors/users
    public function showAdminRegisterForm()
    {
        return view('auth.admin-register');
    }

    public function registerAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|string'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Redirect to admin login after registration
        return redirect()->route('login.form', 'admin')->with('success', 'User registered successfully! Please login.');
    }

    // Instructor registers students
    public function showInstructorRegisterForm()
    {
        return view('auth.instructor-register');
    }

    public function registerInstructor(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'instructor',
        ]);

        // Redirect to instructor login after registration
        return redirect()->route('login.form', 'instructor')->with('success', 'instructor registered successfully! Please login.');
    }
}
