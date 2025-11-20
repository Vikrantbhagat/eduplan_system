<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TeamController extends Controller
{
    public function index()
    {
        // Fetch all instructors from users table
        $instructors = User::where('role', 'instructor')->get();


        // Return view with instructors
        return view('pages.our-team', compact('instructors'));
    }
}
