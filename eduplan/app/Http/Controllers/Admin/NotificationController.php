<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Course;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->latest()->get();
        return view('admin.notifications.index', compact('notifications'));
    }

    public function approve($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $courseId = $notification->data['course_id'] ?? null;

        if ($courseId && $course = Course::find($courseId)) {
            $course->status = 'approved';
            $course->save();

            $notification->markAsRead();

            return response()->json([
                'status' => 'success',
                'message' => "✅ Course '{$course->title}' approved successfully.",
                'course_status' => $course->status
            ]);
        }

        return response()->json(['status'=>'error','message'=>'❌ Course not found.'],404);
    }

    public function reject($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $courseId = $notification->data['course_id'] ?? null;

        if ($courseId && $course = Course::find($courseId)) {
            $course->status = 'rejected';
            $course->save();

            $notification->markAsRead();

            return response()->json([
                'status' => 'success',
                'message' => "❌ Course '{$course->title}' rejected successfully.",
                'course_status' => $course->status
            ]);
        }

        return response()->json(['status'=>'error','message'=>'❌ Course not found.'],404);
    }

    public function delete($id)
{
    $notification = Auth::user()->notifications()->findOrFail($id);
    $notification->delete();

    return response()->json([
        'status' => 'success',
        'message' => "🗑️ Notification deleted successfully."
    ]);
}

}
