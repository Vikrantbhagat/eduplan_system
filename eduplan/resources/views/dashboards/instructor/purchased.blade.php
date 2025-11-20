@extends('layouts.app')

@section('title', 'Purchased Courses')

@section('content')
<div class="container py-5">

    {{-- Back to Dashboard --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Purchased Courses for Your Students</h2>
        <a href="{{ route('instructor.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>

    @if($purchases->isEmpty())
        <div class="alert alert-info">No students have purchased your courses yet.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Course</th>
                        <th>Student</th>
                        <th>Email</th>
                        <th>Profile</th>
                        <th>Purchased At</th>
                        <th>Course Purchases</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchases as $purchase)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $purchase->course->title ?? 'N/A' }}</td>
                        <td>{{ $purchase->user->name ?? 'N/A' }}</td>
                        <td>
                            @if($purchase->user->email)
                                <a href="mailto:{{ $purchase->user->email }}">{{ $purchase->user->email }}</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @php
                                $photo = asset('images/default-profile.png');
                                if($purchase->user && $purchase->user->profile_photo) {
                                    $pp = $purchase->user->profile_photo;
                                    if (strpos($pp, 'http://') === 0 || strpos($pp, 'https://') === 0) {
                                        $photo = $pp;
                                    } elseif (\Illuminate\Support\Facades\Storage::disk('public')->exists($pp)) {
                                        $photo = asset('storage/' . $pp);
                                    } elseif (file_exists(public_path($pp))) {
                                        $photo = asset($pp);
                                    }
                                }
                            @endphp
                            <img src="{{ $photo }}" alt="Profile" class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                        </td>
                        <td>{{ $purchase->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            @if($purchase->course)
                                {{ $purchase->course->purchases()->count() }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if($purchase->course)
                                <a href="{{ route('courses.details', $purchase->course->id) }}" 
                                   class="btn btn-sm btn-primary mb-1">
                                    <i class="bi bi-eye"></i> View Course
                                </a>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<style>
    .table img {
        border-radius: 50%;
        border: 1px solid #ccc;
    }
</style>
@endsection
