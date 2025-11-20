@extends('layouts.app')
@section('title','Course Details')
@section('content')
<div class="container py-5">
    <h3>{{ $course->title }}</h3>
    <p>Status: 
        <span class="badge bg-{{ $course->status == 'approved' ? 'success' : ($course->status == 'pending' ? 'warning' : 'danger') }}">
            {{ ucfirst($course->status) }}
        </span>
    </p>
    @if($course->image)
        <img src="{{ asset('storage/'.$course->image) }}" alt="course image" class="img-fluid mb-3" style="max-height:300px;">
    @endif
    <p>{{ $course->description }}</p>
    <p>Fees: {{ $course->fees ?? 'N/A' }}</p>
    @if($course->video)
    <div class="my-3">
        <video width="100%" controls>
            <source src="{{ asset('storage/' . $course->video) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        @if($course->video_description)
            <p class="mt-2 text-muted">{{ $course->video_description }}</p>
        @endif
    </div>
@endif


    <a href="{{ route('instructor.courses.edit', $course->id) }}" class="btn btn-success">Edit</a>
    <a href="{{ route('instructor.courses.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
