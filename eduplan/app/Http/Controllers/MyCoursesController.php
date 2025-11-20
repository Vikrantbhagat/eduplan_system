<?php
// app/Http/Controllers/MyCoursesController.php
namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class MyCoursesController extends Controller
{
    public function index()
    {
        // Fetch all purchased courses of the logged-in user
        $purchases = Purchase::with('course')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('student.mycourses', compact('purchases'));
    }
}
