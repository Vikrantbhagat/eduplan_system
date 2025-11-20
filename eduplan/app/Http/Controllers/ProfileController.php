<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Show Profile Page
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    // Edit Profile Page
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Update Profile Data
public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'bio' => 'nullable|string|max:500',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = auth()->user();
    $user->name = $request->name;
    $user->bio = $request->bio;

    if ($request->hasFile('profile_photo')) {
        $file = $request->file('profile_photo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/profile'), $filename);

        $user->profile_photo = 'uploads/profile/' . $filename;
    }

    $user->save();

    return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
}

}
