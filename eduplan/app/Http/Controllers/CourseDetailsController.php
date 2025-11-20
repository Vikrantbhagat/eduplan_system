<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseDetailsController extends Controller
{
    // Existing methods ...

    /**
     * Show the course details along with lectures and lecture contents
     */
    public function show($id)
    {
        // Load course, lectures, and their contents
        $course = Course::with(['lectures.contents'])->findOrFail($id);
        return view('courses.show', compact('course'));
    }   

}
