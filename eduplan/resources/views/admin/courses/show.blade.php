@extends('layouts.app')
@section('title','Course Review')
@section('content')
<div class="container py-5">

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ $course->image ? asset('storage/'.$course->image) : asset('images/course-placeholder.png') }}" 
                     class="img-fluid h-100" style="object-fit:cover">
            </div>
            <div class="col-md-8 p-4">
                <form method="POST" action="{{ route('admin.courses.update', $course->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Course Title --}}
                    <div class="mb-3">
                        <label class="form-label">Course Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $course->title) }}">
                    </div>

                    {{-- Instructor --}}
                    <div class="mb-3">
                        <label class="form-label">Instructor</label>
                        <input type="text" class="form-control" value="{{ $course->instructor->name }}" disabled>
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $course->description) }}</textarea>
                    </div>

                    {{-- Fees --}}
                    <div class="mb-3">
                        <label class="form-label">Fees ($)</label>
                        <input type="number" step="0.01" name="fees" class="form-control" value="{{ old('fees', $course->fees) }}">
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $course->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $course->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $course->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    {{-- Image Upload --}}
                    <div class="mb-3">
                        <label class="form-label">Course Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    {{-- Course Videos (from videos table) --}}
                    @if($course->videos->isNotEmpty())
                        <hr>
                        <h5>Course Videos</h5>
                        @foreach($course->videos as $video)
                            <div class="mb-4">
                                <video width="100%" controls>
                                    <source src="{{ asset('storage/'.$video->file_path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <label class="form-label mt-2">Video Description</label>
                                <textarea name="video_descriptions[{{ $video->id }}]" class="form-control" rows="2">{{ old('video_descriptions.'.$video->id, $video->description) }}</textarea>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">No videos uploaded for this course.</p>
                    @endif

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Update Course</button>
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary ms-2">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
