<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course; // Import Course model

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            // Admin sees all users + notifications
            $users = User::all();
            $notifications = $user->notifications()->latest()->get();
            return view('dashboards.admin.dashboard', compact('user', 'users', 'notifications'));
        } elseif ($user->role == 'instructor') {
            $users = User::where('role', 'student')->get();
            $courses = Course::where('instructor_id', $user->id)->latest()->get();
            return view('dashboards.instructor.dashboard', compact('user', 'users', 'courses'));
        } else {
            $users = collect([$user]);
            return view('dashboards.student.dashboard', compact('user', 'users'));
        }
    }
    public function dashboard()
    {
        $user = Auth::user(); // Get the logged-in instructor
        $courses = $user->courses()->latest()->get(); // Get courses of this instructor
        return view('instructor.dashboard', compact('user', 'courses')); // Pass to view
    }
}


