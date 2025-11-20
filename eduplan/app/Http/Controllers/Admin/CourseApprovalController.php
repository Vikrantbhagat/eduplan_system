<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CourseApprovalController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 'pending')->latest()->get();
        return view('admin.courses.pending', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.show', compact('course'));
    }

    public function approve(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->status = 'approved';
        $course->published_at = now();
        $course->save();

        // optionally notify instructor (implement notification)
        $course->instructor->notify(new \App\Notifications\CourseApproved($course));

        return redirect()->route('admin.courses.pending')->with('success','Course approved and published.');
    }

    public function reject(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->status = 'rejected';
        $course->save();

        // optionally notify instructor of rejection
        $course->instructor->notify(new \App\Notifications\CourseRejected($course));

        return redirect()->route('admin.courses.pending')->with('success','Course rejected.');
    }
}
