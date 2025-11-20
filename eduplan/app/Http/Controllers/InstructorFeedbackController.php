<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;
use App\Models\Course;

class InstructorFeedbackController extends Controller
{
    public function index()
    {
        // Fetch all feedbacks for courses owned by the logged-in instructor
        $instructorId = Auth::id();

        $feedbacks = Feedback::with(['user', 'course'])
            ->whereHas('course', function ($query) use ($instructorId) {
                $query->where('instructor_id', $instructorId);
            })
            ->latest()
            ->get();

        return view('dashboards.instructor.feedbacks', compact('feedbacks'));
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);

        // Only instructor of the course can delete it
        if ($feedback->course->instructor_id === Auth::id()) {
            $feedback->delete();
            return back()->with('success', 'Feedback deleted successfully.');
        }

        return back()->with('error', 'Unauthorized action.');
    }
}
