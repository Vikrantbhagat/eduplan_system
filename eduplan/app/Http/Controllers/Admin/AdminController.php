<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Mail\CourseApprovedNotification;
use Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pending = Course::where('status','pending')->latest()->get();
        $approved = Course::where('status','approved')->latest()->limit(10)->get();
        return view('admin.dashboard', compact('pending','approved'));
    }

    public function approve(Request $request, Course $course)
    {
        $course->status = 'approved';
        $course->save();

        // notify instructor
        Mail::to($course->instructor->email)->send(new CourseApprovedNotification($course));

        return back()->with('success', 'Course approved.');
    }

    public function reject(Request $request, Course $course)
    {
        $course->status = 'rejected';
        $course->save();
        return back()->with('success', 'Course rejected.');
    }

    
}
