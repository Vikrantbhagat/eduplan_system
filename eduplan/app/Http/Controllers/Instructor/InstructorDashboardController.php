<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user(); // Get the logged-in instructor
        $courses = $user->courses()->latest()->get(); // Get courses of this instructor
        return view('instructor.dashboard', compact('user', 'courses')); // Pass to view
    }
}
