<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        // Start query and eager load instructor
        $query = Course::query()->with('instructor');

        // Filter by course title
        if ($request->filled('course_name')) {
            $query->where('title', 'like', '%'.$request->course_name.'%');
        }

        // Filter by instructor
        if ($request->filled('instructor_name')) {
            $query->whereHas('instructor', function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->instructor_name.'%');
            });
        }

        // Pagination (12 per page) + keep query string
        $courses = $query->paginate(12)->withQueryString();

        // Get all instructors for dropdown
        $instructors = User::where('role', 'instructor')->get();

        // Return view with courses + instructors
        return view('pages.all-courses', compact('courses', 'instructors'));
    }

    public function show($id)
{
    $course = Course::with('instructor')->findOrFail($id);
    return view('pages.course-details', compact('course'));
}





}
