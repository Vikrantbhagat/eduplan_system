@extends('layouts.app')
@section('title','Create Course')
@section('content')
<div class="container py-5">
    <h3>Create New Course</h3>

    <!-- Errors & Success -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('instructor.courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Course Info -->
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Fees</label>
            <input type="number" name="fees" class="form-control" value="{{ old('fees') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Course Video</label>
            <input type="file" name="video" class="form-control" accept="video/*">
            <small class="text-muted">Supported: mp4, mov, avi, wmv (Max 10MB)</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Video Description</label>
            <textarea name="video_description" class="form-control" rows="3">{{ old('video_description') }}</textarea>
        </div>

        <hr class="my-4">

        <!-- Lectures -->
        <div id="lectures-wrapper">
            <h4>Course Lectures</h4>
            <button type="button" class="btn btn-success mb-3" id="add-lecture-btn">Add Lecture</button>
        </div>

        <button class="btn btn-primary">Create Course</button>
    </form>
</div>

<!-- JS -->
<script>
let lectureIndex = 0;

// Add Lecture
document.getElementById('add-lecture-btn').addEventListener('click', function(){
    const wrapper = document.getElementById('lectures-wrapper');
    const lectureHTML = `
        <div class="card mb-3 p-3" id="lecture-${lectureIndex}">
            <div class="mb-2">
                <label>Lecture Title</label>
                <input type="text" name="lectures[${lectureIndex}][title]" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Lecture Description</label>
                <textarea name="lectures[${lectureIndex}][description]" class="form-control"></textarea>
            </div>
            <div class="mb-2">
                <label>Lecture Duration</label>
                <input type="text" name="lectures[${lectureIndex}][duration]" class="form-control" placeholder="08 min">
            </div>

            <div class="contents-wrapper" id="contents-${lectureIndex}">
                <h6>Lecture Contents</h6>
                <button type="button" class="btn btn-info mb-2 add-content-btn" data-lecture="${lectureIndex}">Add Content</button>
            </div>
        </div>
    `;
    wrapper.insertAdjacentHTML('beforeend', lectureHTML);
    lectureIndex++;
});

// Add Content to Lecture
document.addEventListener('click', function(e){
    if(e.target && e.target.classList.contains('add-content-btn')){
        const lectureId = e.target.dataset.lecture;
        const contentWrapper = document.getElementById('contents-' + lectureId);
        const contentIndex = contentWrapper.querySelectorAll('.content-item').length;

        const contentHTML = `
            <div class="content-item mb-2 p-2 border rounded">
                <select name="lectures[${lectureId}][contents][${contentIndex}][type]" class="form-select mb-1">
                    <option value="video">Video</option>
                    <option value="text">Text</option>
                    <option value="quiz">Quiz</option>
                </select>
                <input type="text" name="lectures[${lectureId}][contents][${contentIndex}][title]" class="form-control mb-1" placeholder="Content Title" required>
                <input type="text" name="lectures[${lectureId}][contents][${contentIndex}][url]" class="form-control mb-1" placeholder="Video URL (if any)">
                <input type="text" name="lectures[${lectureId}][contents][${contentIndex}][duration]" class="form-control mb-1" placeholder="Duration e.g 08 min">
            </div>
        `;
        contentWrapper.insertAdjacentHTML('beforeend', contentHTML);
    }
});
</script>
@endsection
