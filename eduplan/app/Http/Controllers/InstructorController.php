<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User; // <- Make sure this is imported
use App\Models\Course;



class InstructorController extends Controller
{
    public function profile()
    {
        // Assuming instructor is logged in and has role = 'instructor'
        $instructor = Auth::user(); // if using users table with role 'instructor'
        return view('instructors.profile', compact('instructor'));
    }

    public function update(Request $request)
    {
        $instructor = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $instructor->name = $request->name;
        $instructor->bio = $request->bio;

        // Handle image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($instructor->profile_image && Storage::exists($instructor->profile_image)) {
                Storage::delete($instructor->profile_image);
            }

            $path = $request->file('profile_image')->store('instructors', 'public');
            $instructor->profile_image = $path;
        }

        $instructor->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function dashboard()
{
    $user = Auth::user();
    $users = $user->students ?? collect(); // Assuming relation instructor->students
    $courses = \App\Models\Course::where('instructor_id', $user->id)->get();

    return view('instructor.dashboard', compact('user', 'users', 'courses'));
}



    // Show all instructors
    public function index()
    {
        // Correct model name
        $instructors = User::where('role', 'instructor')->get();


        

        return view('pages.instructors', compact('instructors'));
    }

    // Show single instructor and their courses
    public function show($id)
    {
        $instructor = User::with('courses')->findOrFail($id);
        return view('pages.instructor_show', compact('instructor'));
    }


    // Show all courses
    public function allCourses()
    {
        $courses = Course::with('instructor')->orderBy('created_at', 'desc')->paginate(12); // paginate

        return view('pages.all-course', compact('courses'));
    }

}
