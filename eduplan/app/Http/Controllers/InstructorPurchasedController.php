<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;
use App\Models\Course;

class InstructorPurchasedController extends Controller
{
    public function index()
    {
        $instructorId = Auth::id();

        // Get all purchases of this instructor's courses
        $purchases = Purchase::with('user', 'course')
            ->whereHas('course', function($q) use ($instructorId) {
                $q->where('instructor_id', $instructorId);
            })
            ->latest()
            ->get();

        return view('dashboards.instructor.purchased', compact('purchases'));
    }
}
