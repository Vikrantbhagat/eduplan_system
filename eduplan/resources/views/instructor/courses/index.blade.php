@extends('layouts.app')
@section('title','My Courses')
@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Your Courses</h3>
        <a href="{{ route('instructor.courses.create') }}" class="btn btn-primary">Create New Course</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($courses->isEmpty())
        <div class="alert alert-info">You have not created any courses yet.</div>
    @else
        <div class="row g-3">
            @foreach($courses as $course)
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="row g-0">
                            <div class="col-4">
                                <img src="{{ $course->image ? asset('storage/'.$course->image) : asset('images/course-placeholder.png') }}" 
                                     class="img-fluid rounded-start" style="height:100%; object-fit:cover;">
                            </div>
                            <div class="col-8 p-3 d-flex flex-column">
                                <h5 class="mb-1">{{ $course->title }}</h5>
                                <p class="mb-1 text-muted small">
                                    Status: 
                                    <span class="badge bg-{{ $course->status == 'approved' ? 'success' : ($course->status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($course->status) }}
                                    </span>
                                </p>
                                <p class="mb-2">{{ Str::limit($course->description, 100) }}</p>

                                <div class="mt-auto d-flex gap-2">
                                    <a href="{{ route('instructor.courses.show', $course->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    <a href="{{ route('instructor.courses.edit', $course->id) }}" class="btn btn-sm btn-outline-success">Edit</a>

                                    <form action="{{ route('instructor.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <td>
    @if($course->status == 'approved')
        <span class="badge bg-success">Approved</span>
    @elseif($course->status == 'rejected')
        <span class="badge bg-danger">Rejected</span>
    @else
        <span class="badge bg-warning text-dark">Pending</span>
    @endif
</td>


</div>
@endsection
