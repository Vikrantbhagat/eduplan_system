@extends('layouts.app')
@section('title', 'Edit Course')
@section('content')
<div class="container py-5">
    <h3>Edit Course</h3>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Success --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('instructor.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $course->title) }}" required>
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $course->description) }}</textarea>
        </div>

        {{-- Fees --}}
        <div class="mb-3">
            <label class="form-label">Fees</label>
            <input type="number" name="fees" class="form-control" value="{{ old('fees', $course->fees) }}">
        </div>

        {{-- Image --}}
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            @if($course->image)
                <img src="{{ asset('storage/'.$course->image) }}" alt="Course Image" class="mt-2" style="height:100px;">
            @endif
        </div>

        {{-- Video --}}
        <div class="mb-3">
            <label class="form-label">Video</label>
            <input type="file" name="video" class="form-control">
            @if($course->video)
                <video class="mt-2" width="200" controls>
                    <source src="{{ asset('storage/'.$course->video) }}" type="video/mp4">
                </video>
            @endif
        </div>

        {{-- Video Description --}}
        <div class="mb-3">
            <label class="form-label">Video Description</label>
            <textarea name="video_description" class="form-control">{{ old('video_description', $course->video_description) }}</textarea>
        </div>

        <hr class="my-4">

        {{-- Lectures Section --}}
        <div id="lectures-wrapper">
            <h4>Course Lectures</h4>
            <button type="button" class="btn btn-success mb-3" id="add-lecture-btn">Add Lecture</button>

            @foreach($course->lectures as $lectureIndex => $lecture)
            <div class="card mb-3 p-3" id="lecture-{{ $lectureIndex }}">
                <input type="hidden" name="lectures[{{ $lectureIndex }}][id]" value="{{ $lecture->id }}">
                <div class="mb-2">
                    <label>Lecture Title</label>
                    <input type="text" name="lectures[{{ $lectureIndex }}][title]" class="form-control" value="{{ $lecture->title }}" required>
                </div>
                <div class="mb-2">
                    <label>Lecture Description</label>
                    <textarea name="lectures[{{ $lectureIndex }}][description]" class="form-control">{{ $lecture->description }}</textarea>
                </div>
                <div class="mb-2">
                    <label>Lecture Duration</label>
                    <input type="text" name="lectures[{{ $lectureIndex }}][duration]" class="form-control" value="{{ $lecture->duration }}">
                </div>

                <div class="contents-wrapper" id="contents-{{ $lectureIndex }}">
                    <h6>Lecture Contents</h6>
                    <button type="button" class="btn btn-info mb-2 add-content-btn" data-lecture="{{ $lectureIndex }}">Add Content</button>

                    @foreach($lecture->contents as $contentIndex => $content)
                    <div class="content-item mb-2 p-2 border rounded">
                        <input type="hidden" name="lectures[{{ $lectureIndex }}][contents][{{ $contentIndex }}][id]" value="{{ $content->id }}">
                        <select name="lectures[{{ $lectureIndex }}][contents][{{ $contentIndex }}][type]" class="form-select mb-1">
                            <option value="video" {{ $content->type=='video'?'selected':'' }}>Video</option>
                            <option value="text" {{ $content->type=='text'?'selected':'' }}>Text</option>
                            <option value="quiz" {{ $content->type=='quiz'?'selected':'' }}>Quiz</option>
                        </select>
                        <input type="text" name="lectures[{{ $lectureIndex }}][contents][{{ $contentIndex }}][title]" class="form-control mb-1" value="{{ $content->title }}" required>
                        <input type="text" name="lectures[{{ $lectureIndex }}][contents][{{ $contentIndex }}][url]" class="form-control mb-1" value="{{ $content->url }}" placeholder="Video URL (if any)">
                        <input type="text" name="lectures[{{ $lectureIndex }}][contents][{{ $contentIndex }}][duration]" class="form-control mb-1" value="{{ $content->duration }}" placeholder="Duration e.g. 08 min">
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <button class="btn btn-success mt-3">Update Course</button>
    </form>
</div>

<script>
let lectureIndex = {{ $course->lectures->count() }};

// Add new lecture dynamically
document.getElementById('add-lecture-btn').addEventListener('click', function(){
    const wrapper = document.getElementById('lectures-wrapper');
    const lectureHTML = `
        <div class="card mb-3 p-3" id="lecture-${lectureIndex}">
            <input type="hidden" name="lectures[${lectureIndex}][contents]" value="[]">
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

// Add new content dynamically
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
                <input type="text" name="lectures[${lectureId}][contents][${contentIndex}][duration]" class="form-control mb-1" placeholder="Duration e.g. 08 min">
            </div>
        `;
        contentWrapper.insertAdjacentHTML('beforeend', contentHTML);
    }
});
</script>
@endsection
