<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;

class CourseFilterController extends Controller
{
    /**
     * Show filtered list of all courses
     */
    public function filter(Request $request)
    {
        // Eager load instructor to avoid N+1 problem
        $query = Course::with('instructor');

        // Filter by course title
        if ($request->filled('course_name')) {
            $query->where('title', 'like', '%' . trim($request->course_name) . '%');
        }

        // Filter by instructor name
        if ($request->filled('instructor_name')) {
            $instructorName = trim($request->instructor_name);
            $query->whereHas('instructor', function ($q) use ($instructorName) {
                $q->where('name', 'like', '%' . $instructorName . '%');
            });
        }

        // Paginate and retain filters
        $courses = $query->latest()->paginate(10)->withQueryString();

        // Get all instructors for dropdown
        $instructors = User::where('role', 'instructor')->get();

        return view('pages.all-course', compact('courses', 'instructors'));
    }

    /**
     * Show single course details
     */
    public function show($id)
    {
        // Eager load instructor for full course info
        $course = Course::with('instructor')->findOrFail($id);

        return view('pages.course-details', compact('course'));
    }
}
