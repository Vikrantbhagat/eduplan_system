<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminDashboardController extends Controller
{
    // ==============================
    // 🏠 ADMIN DASHBOARD OVERVIEW
    // ==============================
    public function index()
    {
        $user = auth()->user(); // Logged-in admin
        $users = User::with('courses')->get();

        // Dashboard stats
        $totalStudents = User::where('role', 'student')->count();
        $totalInstructors = User::where('role', 'instructor')->count();
        $totalCourses = Course::count();
        $totalPurchases = Purchase::count();

        return view('dashboards.admin.dashboard', compact(
            'user',
            'users',
            'totalStudents',
            'totalInstructors',
            'totalCourses',
            'totalPurchases'
        ));
    }

    // ==============================
    // 📊 ADMIN ANALYTICS PAGE
    // ==============================
    public function analytics()
    {
        $totalStudents = User::where('role', 'student')->count();
        $totalInstructors = User::where('role', 'instructor')->count();
        $totalCourses = Course::count();
        $totalPurchases = Purchase::count();

        // 💰 Calculate total revenue from purchases
        $totalRevenue = Purchase::join('courses', 'purchases.course_id', '=', 'courses.id')
            ->sum('courses.price');

        // 📅 Monthly purchase stats for chart
        $monthlyStats = Purchase::join('courses', 'purchases.course_id', '=', 'courses.id')
            ->select(
                DB::raw('MONTH(purchases.created_at) as month'),
                DB::raw('COUNT(purchases.id) as purchase_count'),
                DB::raw('SUM(courses.price) as monthly_revenue')
            )
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $months = [];
        $purchaseCounts = [];
        $revenues = [];

        foreach ($monthlyStats as $data) {
            $months[] = date("M", mktime(0, 0, 0, $data->month, 1));
            $purchaseCounts[] = $data->purchase_count;
            $revenues[] = $data->monthly_revenue;
        }

        return view('dashboards.admin.analytics', compact(
            'totalStudents',
            'totalInstructors',
            'totalCourses',
            'totalPurchases',
            'totalRevenue',
            'months',
            'purchaseCounts',
            'revenues'
        ));
    }

    // ==============================
    // 👤 USER MANAGEMENT
    // ==============================
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('dashboards.admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => 'required|in:admin,instructor,student',
            'password' => 'nullable|string|min:6|confirmed'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully.');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->id == auth()->id()) {
            return response()->json(['status' => 'error', 'message' => "You cannot delete your own account."]);
        }

        $user->delete();

        return response()->json(['status' => 'success', 'message' => "User '{$user->name}' deleted successfully."]);
    }

    // ==============================
    // 🎓 INSTRUCTOR COURSES MANAGEMENT
    // ==============================
    public function viewCourses($id)
    {
        $instructor = User::with('courses')->findOrFail($id);

        if ($instructor->role !== 'instructor') {
            return redirect()->route('admin.dashboard')->with('error', 'User is not an instructor.');
        }

        $courses = $instructor->courses()->latest()->get();
        return view('dashboards.admin.courses', compact('instructor', 'courses'));
    }

    public function editCourse($id)
    {
        $course = Course::findOrFail($id);
        $instructor = $course->instructor;
        return view('dashboards.admin.edit-course', compact('course', 'instructor'));
    }

    public function updateCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()->route('admin.users.courses', $course->user_id)
                         ->with('success', "Course '{$course->title}' updated successfully.");
    }

    public function destroyCourse($id)
    {
        $course = Course::findOrFail($id);
        $title = $course->title;
        $course->delete();

        return response()->json(['status' => 'success', 'message' => "Course '{$title}' deleted successfully."]);
    }

    // ==============================
    // 📘 VIEW SINGLE COURSE
    // ==============================
    public function show($id)
    {
        $course = Course::with('instructor')->findOrFail($id);
        return view('dashboards.admin.course_show', compact('course'));
    }
}
