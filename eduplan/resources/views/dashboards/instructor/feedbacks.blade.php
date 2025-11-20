@extends('layouts.app')

@section('title', 'Course Feedbacks')

@section('content')
<div class="container py-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1 text-primary">
                <i class="bi bi-chat-dots-fill me-2"></i>Student Feedbacks
            </h2>
            <p class="text-muted mb-0">All feedbacks received for your published courses.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>

    <!-- Success & Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Feedback List -->
    @if($feedbacks->isEmpty())
        <div class="alert alert-info shadow-sm rounded">
            <i class="bi bi-info-circle me-2"></i>No feedback available yet.
        </div>
    @else
        <div class="row g-3">
            @foreach($feedbacks as $feedback)
                <div class="col-md-6 col-lg-4">
                    <div class="card feedback-card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-0 fw-semibold text-dark">
                                    <i class="bi bi-person-circle me-1 text-primary"></i> 
                                    {{ $feedback->user->name ?? 'Anonymous' }}
                                </h5>
                                <form action="{{ route('instructor.feedbacks.destroy', $feedback->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this feedback?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-circle" title="Delete Feedback">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>

                            <p class="card-text text-muted mb-2">
                                "{{ $feedback->comment }}"
                            </p>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <small class="text-muted">
                                    <i class="bi bi-book me-1"></i>
                                    <strong>{{ $feedback->course->title }}</strong>
                                </small>
                                <div>
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa-solid fa-star {{ $i <= $feedback->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                    @endfor
                                </div>
                            </div>

                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-clock me-1"></i>{{ $feedback->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Custom Styles -->
<style>
.feedback-card {
    border-radius: 15px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    background: #fff;
}
.feedback-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.1);
}

.fa-star {
    font-size: 14px;
}
.text-warning {
    color: #fbc02d !important;
}
.btn-outline-danger {
    border-radius: 50%;
    padding: 5px 7px;
}
.alert {
    border-radius: 10px;
}
</style>
@endsection
