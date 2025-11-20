@extends('layouts.app')

@section('title', 'My Courses')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">My Purchased Courses</h2>

    @if($purchasedCourses->isEmpty())
        <p>You have not purchased any courses yet.</p>
    @else
        <div class="row g-4">
            @foreach($purchasedCourses as $course)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    @if($course->image)
                        <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" alt="{{ $course->title }}">
                    @else
                        <img src="{{ asset('assets/img/course-placeholder.png') }}" class="card-img-top" alt="No Image">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
                        <div class="mt-auto">
                            <span class="badge bg-success p-2 w-100 fs-6">✔ Purchased</span>
<a href="{{ route('courses.details', $course->id) }}" class="btn btn-primary w-100 mt-2">Go to Course</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
