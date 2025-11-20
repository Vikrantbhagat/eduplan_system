@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <h2 class="fw-bold mb-0 text-primary">
            <i class="bi bi-mortarboard-fill me-2"></i> My Purchased Courses
        </h2>

        {{-- Safe link check --}}
        @if(Route::has('courses.index'))
            <a href="{{ route('courses.index') }}" class="btn btn-outline-primary mt-2 mt-md-0">
                <i class="bi bi-shop me-1"></i> Browse More Courses
            </a>
        @else
            <a href="{{ url('/') }}" class="btn btn-outline-primary mt-2 mt-md-0">
                <i class="bi bi-shop me-1"></i> Browse Courses
            </a>
        @endif
    </div>

    {{-- Purchased courses list --}}
    @if($purchases->count() > 0)
        <div class="row g-4">
            @foreach($purchases as $purchase)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden course-card h-100 position-relative">
                        <div class="ratio ratio-16x9">
                            @if($purchase->course->image)
                                <img src="{{ asset('storage/'.$purchase->course->image) }}" 
                                     class="card-img-top" alt="Course Image">
                            @else
                                <img src="{{ asset('images/default-course.jpg') }}" 
                                     class="card-img-top" alt="Default Image">
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-semibold text-dark">{{ $purchase->course->title }}</h5>
                            <p class="card-text text-muted small flex-grow-1">
                                {{ Str::limit($purchase->course->description, 100) }}
                            </p>

                            <div class="d-grid gap-2 mt-2">
                                <a href="{{ route('courses.show', $purchase->course->id) }}" class="btn btn-primary">
                                    <i class="bi bi-play-circle me-1"></i> Go to Course
                                </a>

                                {{-- Remove Course Form --}}
                                <form action="{{ route('purchases.destroy', $purchase->course->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure you want to remove this course?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger w-100">
                                        <i class="bi bi-trash me-1"></i> Remove Course
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Empty state --}}
        <div class="text-center py-5">
            <img src="{{ asset('images/empty-state.svg') }}" 
                 alt="No Courses" 
                 class="img-fluid mb-3" 
                 style="max-width: 300px; opacity: 0.85;">
            <h4 class="fw-semibold text-secondary mb-3">You haven’t purchased any courses yet.</h4>
            <p class="text-muted mb-4">Start exploring our latest courses and enhance your skills.</p>

            @if(Route::has('courses.index'))
                <a href="{{ route('courses.index') }}" class="btn btn-primary px-4 py-2">
                    <i class="bi bi-shop me-1"></i> Browse Courses
                </a>
            @else
                <a href="{{ url('/') }}" class="btn btn-primary px-4 py-2">
                    <i class="bi bi-shop me-1"></i> Browse Courses
                </a>
            @endif
        </div>
    @endif
</div>

{{-- Custom Styling --}}
<style>
.course-card {
    transition: all 0.3s ease-in-out;
    background: #fff;
}
.course-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.12);
}
.card-body h5 {
    color: #0d6efd;
}
</style>
@endsection
