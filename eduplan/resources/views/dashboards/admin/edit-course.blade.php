@extends('layouts.app')
@section('title','Edit Course')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Edit Course</h2>

    <form method="POST" action="{{ route('admin.courses.update',$course->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title',$course->title) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" rows="4" class="form-control" required>{{ old('description',$course->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select" required>
                <option value="pending" {{ $course->status=='pending'?'selected':'' }}>Pending</option>
                <option value="approved" {{ $course->status=='approved'?'selected':'' }}>Approved</option>
                <option value="rejected" {{ $course->status=='rejected'?'selected':'' }}>Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Course</button>
        <a href="{{ route('admin.users.courses',$course->user_id) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
