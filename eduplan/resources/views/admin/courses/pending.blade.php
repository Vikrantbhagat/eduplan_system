@extends('layouts.app')
@section('title','Pending Courses')
@section('content')
<div class="container py-5">
    <h3>Courses Pending Approval</h3>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    @if($courses->isEmpty())
        <div class="alert alert-info">No pending courses.</div>
    @else
        <div class="row g-3">
            @foreach($courses as $course)
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <img src="{{ $course->image ? asset('storage/'.$course->image) : asset('images/course-placeholder.png') }}" class="card-img-top" style="height:180px; object-fit:cover">
                    <div class="card-body">
                        <h5>{{ $course->title }}</h5>
                        <p class="mb-1"><strong>Instructor:</strong> {{ $course->instructor->name }}</p>
                        <p>{{ Str::limit($course->description, 120) }}</p>

                        <form method="POST" action="{{ route('admin.courses.approve', $course->id) }}" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Approve</button>
                        </form>

                        <form method="POST" action="{{ route('admin.courses.reject', $course->id) }}" class="d-inline ms-2">
                            @csrf
                            <button class="btn btn-danger btn-sm">Reject</button>
                        </form>

                        <a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-outline-primary btn-sm ms-2">View</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
