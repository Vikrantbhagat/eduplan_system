@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Profile Details</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle me-2"></i> Back to Dashboard
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Profile Card --}}
    <div class="card shadow-sm border-0 mb-4 text-center p-4">
        <img 
    src="{{ $user->profile_photo && file_exists(public_path($user->profile_photo)) 
            ? asset($user->profile_photo) 
            : 'https://via.placeholder.com/150' }}" 
    alt="Profile Photo" 
    class="rounded-circle mb-3" 
    width="150" 
    height="150">


        <h3 class="fw-bold">{{ $user->name }}</h3>
        <p class="text-muted mb-1">{{ $user->email }}</p>
        <p class="text-secondary">{{ $user->bio ?? 'No bio added yet.' }}</p>

        <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3 px-4">
            <i class="bi bi-pencil-square me-2"></i> Edit Profile
        </a>
    </div>

</div>

<style>
.profile-img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.profile-img:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(0,123,255,0.5);
}
</style>
@endsection
