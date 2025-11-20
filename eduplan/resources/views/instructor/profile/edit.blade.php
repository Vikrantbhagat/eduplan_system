@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Edit Profile</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Back to Dashboard Button --}}
    <div class="mb-4">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            &larr; Back to Dashboard
        </a>
    </div>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Profile Image Preview --}}
        <div class="mb-3 text-center">
            <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('images/default-profile.png') }}"
                 alt="Profile" class="rounded-circle" width="120" height="120" style="object-fit: cover; border: 2px solid #ddd;">
        </div>

        {{-- Profile Image Upload --}}
        <div class="mb-3">
            <label for="profile_photo" class="form-label">Change Profile Image</label>
            <input type="file" class="form-control" name="profile_photo" id="profile_photo" accept="image/*">
        </div>

        {{-- Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', Auth::user()->name) }}" required>
        </div>

        {{-- Bio --}}
        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea class="form-control" name="bio" rows="3">{{ old('bio', Auth::user()->bio) }}</textarea>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
