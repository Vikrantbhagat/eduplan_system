<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('dashboards.admin.edit-course', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'nullable|string',
            'status'=>'required|in:approved,pending,rejected'
        ]);

        $course->update($request->only('title','description','status'));

        return redirect()->route('admin.users.courses',$course->user_id)->with('success','Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return response()->json([
            'status'=>'success',
            'message'=>"Course '{$course->title}' deleted successfully."
        ]);
    }
}
