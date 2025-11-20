<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // ✅ Store feedback
    public function store(Request $request, $courseId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'course_id' => $courseId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Your feedback has been submitted successfully!');
    }

    // 🗑️ Delete feedback
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);

        if ($feedback->user_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to delete this feedback.');
        }

        $feedback->delete();

        return back()->with('success', 'Your feedback has been removed.');
    }
}

