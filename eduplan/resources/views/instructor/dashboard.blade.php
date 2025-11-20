@extends('layouts.app')

@section('title', 'Instructor Dashboard')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Welcome Instructor, {{ $user->name }}</h2>

    {{-- Courses Section --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Your Courses</h4>
        <a href="{{ route('instructor.courses.create') }}" class="btn btn-primary">+ Add New Course</a>
    </div>

    @if($courses->isEmpty())
        <div class="alert alert-info">You have not created any courses yet.</div>
    @else
        <div class="row g-3">
            @foreach($courses as $course)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    @if($course->image)
                        <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" style="height:180px; object-fit:cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
                        <span class="badge bg-{{ $course->status == 'approved' ? 'success' : ($course->status == 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($course->status) }}
                        </span>
                        <div class="mt-auto pt-2 d-flex justify-content-between">
                            <a href="{{ route('instructor.courses.edit', $course->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>

                            <form action="{{ route('instructor.courses.destroy', $course->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this course?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
