@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Edit Profile</h2>
        <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle me-2"></i> Back to Profile
        </a>
    </div>

    {{-- Profile Form Card --}}
    <div class="card shadow-sm border-0 p-4">
<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="bio" class="form-label">Bio</label>
        <textarea name="bio" class="form-control" rows="3">{{ old('bio', $user->bio) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="profile_photo" class="form-label">Profile Photo</label>
        <input type="file" name="profile_photo" class="form-control">
        @if($user->profile_photo)
            <img src="{{ asset($user->profile_photo) }}" alt="Profile Photo" width="120" class="mt-2 rounded">
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Update Profile</button>
</form>


    </div>

</div>

<style>
.profile-img {
    width: 130px;
    height: 130px;
    object-fit: cover;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.profile-img:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(0, 123, 255, 0.5);
}
</style>
@endsection
