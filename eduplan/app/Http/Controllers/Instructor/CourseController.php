<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\CourseSubmitted;
use App\Models\User;
use App\Models\Lecture;           // <-- Add this
use App\Models\LectureContent;

class CourseController extends Controller
{
// public function index()
// {
//     $courses = Course::where('instructor_id', Auth::id())->get();
//     return view('instructor.courses.index', compact('courses'));
// }


    public function index()
    {
        $courses = Course::where('instructor_id', Auth::id())->latest()->get();
        return view('instructor.courses.index', compact('courses'));
    }
    public function create()
    {
        $user = Auth::user();
        
        return view('instructor.courses.create', compact('user'));
    }

// public function store(Request $request)
// {
//     $data = $request->validate([
//         'title' => 'required|string|max:255',
//         'description' => 'required|string',
//         'fees' => 'required|numeric',
//     ]);

//     if ($request->hasFile('image')) {
//         $data['image'] = $request->file('image')->store('courses', 'public');
//     }
// $data['user_id'] = Auth::id();   // add this line

//     $data['instructor_id'] = Auth::id();
//     $data['status'] = 'pending';

//     $course = Course::create($data);

//     // Notify admins
//     $admins = User::where('role', 'admin')->get();
//     foreach ($admins as $admin) {
//         $admin->notify(new CourseSubmitted($course));
//     }

//     return redirect()->route('instructor.courses.index')
//         ->with('success', 'Course created successfully!');
// }

public function store(Request $request)
{
    // Validation
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'fees' => 'nullable|numeric',
        'image' => 'nullable|image|max:2048',
        'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:10240',
        'video_description' => 'nullable|string',
        'lectures.*.title' => 'required|string',
        'lectures.*.contents.*.type' => 'required|in:video,text,quiz',
        'lectures.*.contents.*.title' => 'required|string',
        'lectures.*.contents.*.url' => 'nullable|url',
    ]);

    // Course Data
    $courseData = $request->only(['title','description','fees','video_description']);
    $courseData['user_id'] = auth()->id();
    $courseData['instructor_id'] = auth()->id();

    if($request->hasFile('image')) {
        $courseData['image'] = $request->file('image')->store('courses','public');
    }

    if($request->hasFile('video')) {
        $courseData['video'] = $request->file('video')->store('courses','public');
    }

    // Create Course
    $course = Course::create($courseData);

    // Save Lectures & Lecture Contents
    if($request->has('lectures')) {
        foreach($request->lectures as $lectureInput) {
            $lecture = $course->lectures()->create([
                'title' => $lectureInput['title'],
                'description' => $lectureInput['description'] ?? '',
                'duration' => $lectureInput['duration'] ?? null,
            ]);

            if(isset($lectureInput['contents'])) {
                foreach($lectureInput['contents'] as $contentInput) {
                    $lecture->contents()->create($contentInput);
                }
            }
        }
    }

    return redirect()->route('instructor.courses.index')->with('success', 'Course created  successfully!');
}






    public function show($id)
    {
        $course = Course::findOrFail($id);
        if ($course->instructor_id !== Auth::id()) abort(403);
        return view('instructor.courses.show', compact('course'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        if ($course->instructor_id !== Auth::id()) abort(403);
        return view('instructor.courses.edit', compact('course'));
    }



public function update(Request $request, Course $course, $id)
{
    // ✅ Ensure $course is properly loaded
    $course = Course::findOrFail($id);

    $course->update([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'fees' => $request->input('fees'),
        'video_description' => $request->input('video_description'),
    ]);

    $lecturesInput = $request->input('lectures', []);
    $newLectureIds = [];

    foreach ($lecturesInput as $lectureInput) {

        // ✅ CASE 1: Update existing lecture
        if (!empty($lectureInput['id'])) {
            $lecture = Lecture::find($lectureInput['id']);
            if ($lecture) {
                $lecture->update([
                    'title' => $lectureInput['title'] ?? '',
                    'description' => $lectureInput['description'] ?? '',
                    'duration' => $lectureInput['duration'] ?? null,
                ]);
            }
        } 
        // ✅ CASE 2: Create new lecture and attach to course
        else {
            $lecture = $course->lectures()->create([
                'title' => $lectureInput['title'] ?? '',
                'description' => $lectureInput['description'] ?? '',
                'duration' => $lectureInput['duration'] ?? null,
            ]);
        }

        $newLectureIds[] = $lecture->id;

        // ✅ Create or update lecture contents
        if (!empty($lectureInput['contents']) && is_array($lectureInput['contents'])) {
            foreach ($lectureInput['contents'] as $contentInput) {
                if (isset($contentInput['id'])) {
                    // update
                    $content = $lecture->contents()->find($contentInput['id']);
                    if ($content) {
                        $content->update([
                            'type' => $contentInput['type'] ?? 'video',
                            'title' => $contentInput['title'] ?? '',
                            'url' => $contentInput['url'] ?? '',
                            'duration' => $contentInput['duration'] ?? null,
                        ]);
                    }
                } else {
                    // create
                    $lecture->contents()->create([
                        'type' => $contentInput['type'] ?? 'video',
                        'title' => $contentInput['title'] ?? '',
                        'url' => $contentInput['url'] ?? '',
                        'duration' => $contentInput['duration'] ?? null,
                    ]);
                }
            }
        }
    }

    // ✅ Delete old lectures that were removed
    $course->lectures()->whereNotIn('id', $newLectureIds)->delete();

    return redirect()->route('instructor.courses.index')->with('success', 'Course updated successfully!');
}



    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        if ($course->instructor_id !== Auth::id()) abort(403);

        if ($course->image) Storage::disk('public')->delete($course->image);

        $course->delete();

        return redirect()->route('instructor.courses.index')->with('success', 'Course deleted successfully.');
    }

    public function myCourses()
{
    $userId = Auth::id();

    $purchasedCourses = Course::whereIn('id', function($query) use ($userId) {
        $query->select('course_id')->from('purchases')->where('user_id', $userId);
    })->get();

    return view('courses.my-courses', compact('purchasedCourses'));
}
}
