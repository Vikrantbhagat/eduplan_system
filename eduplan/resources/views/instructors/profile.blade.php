@extends('layouts.app')

@section('title', 'Instructor Profile')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Instructor Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('instructor.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 text-center">
                    <img src="{{ $instructor->profile_image ? asset('storage/' . $instructor->profile_image) : asset('images/default-profile.png') }}" 
                         alt="Profile Image" class="rounded-circle" width="150" height="150">
                </div>

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $instructor->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ $instructor->email }}" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" class="form-control" rows="4">{{ $instructor->bio }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Profile Image</label>
                    <input type="file" name="profile_image" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
</div>
@endsection
