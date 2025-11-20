@extends('layouts.app')

@section('title', $course->title)

@section('content')
@php
    use App\Models\Purchase;

    $isPurchased = Auth::check() && Purchase::where('user_id', Auth::id())
                                            ->where('course_id', $course->id)
                                            ->exists();

    $totalLectures = $course->lectures->sum(fn($lecture) => $lecture->contents->count());
    $totalMinutes = $course->lectures->sum(fn($lecture) => $lecture->contents->sum(fn($content) => intval($content->duration ?? 0)));
    $hours = floor($totalMinutes / 60);
    $minutes = $totalMinutes % 60;
@endphp

<div class="course-details-wrapper single-page-section-top-space single-page-section-bottom-space">
    <div class="container custom-container-01">
        <div class="row g-5">

            <!-- LEFT SIDE -->
            <div class="col-lg-7 col-xl-8">

                <!-- Title & Description -->
                <div class="breadcrumb-wrap style-01 mb-4">
                    <div class="breadcrumb-content">
                        <h3 class="title">{{ $course->title }}</h3>
                        <p class="details">{{ $course->description ? Str::limit($course->description, 180) : 'This course covers everything you need to learn.' }}</p>
                    </div>
                </div>

                <!-- Ratings -->
<div class="course-derails-inner mb-4">
    <div class="feedback-and-review">
        <div class="feedback">
            @php 
                // Calculate average rating (or fallback)
                $rating = $course->rating ?? 4.5; 
                $fullStars = floor($rating);

                // 🧮 Count total enrolled students (from purchases table)
                $studentsEnrolled = \App\Models\Purchase::where('course_id', $course->id)->count();
            @endphp

            {{-- ⭐ Display star icons --}}
            @for($i=1; $i<=5; $i++)
                <i class="fa-solid fa-star icon {{ $i <= $fullStars ? 'active' : '' }}"></i>
            @endfor

            {{-- 🌟 Show rating value --}}
            <span class="numb">{{ $rating }}</span>
        </div>

        {{-- 🧾 Reviews + Total Students Count --}}
        <span class="rating-review">
            {{ $course->reviews_count ?? 0 }} reviews 
            - <span class="review text-primary fw-semibold">
                {{ $studentsEnrolled }} students enrolled
              </span>
        </span>
    </div>
</div>


                <!-- What You'll Learn -->
                <div class="about-course mb-4">
                    <h3 class="details-title">What you'll learn</h3>
                    <ul class="ul check-point-list style-01 v-03">
                        <li class="single-check-point"><i class="fa-solid fa-check"></i> Practical projects and case studies</li>
                        <li class="single-check-point"><i class="fa-solid fa-check"></i> Step-by-step structured lessons</li>
                        <li class="single-check-point"><i class="fa-solid fa-check"></i> Downloadable resources and PDFs</li>
                        <li class="single-check-point"><i class="fa-solid fa-check"></i> Full lifetime access</li>
                        <li class="single-check-point"><i class="fa-solid fa-check"></i> Access on mobile and TV</li>
                    </ul>
                </div>

                <!-- Course Description -->
                <div class="course-description-wrap mb-4">
                    <h3 class="details-title">Course Description</h3>
                    <p class="tutorial-details paragraph">{{ $course->long_description ?? 'Comprehensive online course covering fundamentals to advanced concepts.' }}</p>
                </div>

                <!-- Who This Course is For -->
                <div class="course-description-wrap mb-4">
                    <h3 class="details-title">Who this course is for:</h3>
                    <p class="tutorial-details paragraph">{{ $course->target_audience ?? 'Beginners, students, aspiring professionals, and anyone who wants to upskill.' }}</p>
                </div>

                <!-- ✅ Course Content Section -->
                <div class="course-tutorial mb-4">
                    <h3 class="details-title">Course Content</h3>

                    @php
                        $totalLectures = $course->lectures->sum(fn($lecture) => $lecture->contents->count());
                        $totalMinutes = $course->lectures->sum(fn($lecture) => $lecture->contents->sum(fn($c) => intval($c->duration ?? 0)));
                        $hours = floor($totalMinutes / 60);
                        $minutes = $totalMinutes % 60;
                    @endphp

                    <p class="tutorial-details paragraph">
                        {{ $course->lectures->count() }} sections • {{ $totalLectures }} lectures • {{ $hours }}h {{ $minutes }}m total length
                    </p>

                    <div class="course-video-wrap">
                        <!-- Bootstrap accordion: each lecture expands to show its contents -->
                        <div class="accordion-wrapper style-03" id="accordionLectures">
                            @forelse($course->lectures as $index => $lecture)
                                @php
                                    $lectureId = 'lectureCollapse' . $lecture->id;
                                    $lectureHeaderId = 'heading' . $lecture->id;
                                    $lectureTotalMinutes = $lecture->contents->sum(fn($c) => intval($c->duration ?? 0));
                                    $lectureHours = floor($lectureTotalMinutes / 60);
                                    $lectureMinutes = $lectureTotalMinutes % 60;
                                @endphp

                                <div class="card mb-2 border rounded shadow-sm">
                                    <div class="card-header bg-light" id="{{ $lectureHeaderId }}">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link text-dark text-start w-100 d-flex justify-content-between align-items-center collapsed"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#{{ $lectureId }}"
                                                    aria-expanded="false"
                                                    aria-controls="{{ $lectureId }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="me-3"><i class="fa-solid fa-book-open"></i></span>
                                                    <span class="fw-semibold">{{ $lecture->title }}</span>
                                                </div>

                                                <div class="small text-muted">
                                                    {{ $lecture->contents->count() }} contents • {{ $lectureHours }}h {{ $lectureMinutes }}m
                                                </div>
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="{{ $lectureId }}" class="collapse"
                                         aria-labelledby="{{ $lectureHeaderId }}"
                                         data-bs-parent="#accordionLectures">
                                        <div class="card-body bg-white">
                                            <ul class="ul videos list-unstyled ps-2 mb-0">
                                                @forelse($lecture->contents as $content)
                                                    <li class="single-video d-flex justify-content-between align-items-start border-bottom py-3">
                                                        <div class="video-text d-flex align-items-start gap-3 w-100">
                                                            <span class="icon-wrap me-2 fs-5 mt-1">
                                                                @if($content->type === 'video')
                                                                    <i class="fa-solid fa-circle-play text-primary"></i>
                                                                @elseif($content->type === 'pdf')
                                                                    <i class="fa-regular fa-file-pdf text-danger"></i>
                                                                @elseif($content->type === 'text')
                                                                    <i class="fa-solid fa-file-lines text-secondary"></i>
                                                                @else
                                                                    <i class="fa-solid fa-file text-muted"></i>
                                                                @endif
                                                            </span>

                                                            <div class="w-100">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <strong>{{ $content->title }}</strong>
                                                                        <div class="small text-muted">
                                                                            @if(!empty($content->description))
                                                                                {{ Str::limit($content->description, 120) }}
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-end text-muted small">
                                                                        {{ $content->duration ? $content->duration . ' min' : '' }}
                                                                    </div>
                                                                </div>

                                                                <!-- Content rendering -->
                                                                <div class="mt-2">
                                                                    @if($content->type === 'video' && !empty($content->file_path))
                                                                        {{-- Local video stored in storage/app/public/... --}}
                                                                        <video width="100%" height="220" controls class="rounded shadow-sm">
                                                                            <source src="{{ asset('storage/' . $content->file_path) }}" type="video/mp4">
                                                                            Your browser does not support the video tag.
                                                                        </video>
                                                                    @elseif($content->type === 'video' && !empty($content->url))
                                                                        {{-- remote video (YouTube/Vimeo) — open in new tab or use iframe modal as required --}}
                                                                        <a href="{{ $content->url }}" target="_blank" class="btn btn-outline-primary btn-sm">Open Video</a>
                                                                    @elseif($content->type === 'pdf' && !empty($content->file_path))
                                                                        <a href="{{ asset('storage/' . $content->file_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                                            View PDF
                                                                        </a>
                                                                    @elseif($content->type === 'text' && !empty($content->text_content))
                                                                        <div class="card card-body mt-2 p-2">
                                                                            {!! nl2br(e($content->text_content)) !!}
                                                                        </div>
                                                                    @else
                                                                        <div class="text-muted small">No preview available for this content.</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li class="text-muted ps-3 py-2">No content available for this lecture.</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No lectures added yet for this course.</p>
                            @endforelse
                        </div>
                    </div>
                </div>



                

            </div>

            <!-- RIGHT SIDE CARD -->
            <div class="col-md-7 col-lg-5 col-xl-4">
                <div class="course-as-product-wrap">
                    <div class="thumbnail">
                        @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="img-fluid">
                        @else
                            <img src="{{ asset('assets/img/course-placeholder.png') }}" alt="No Image" class="img-fluid">
                        @endif
                        @if(!empty($course->intro_video_url))
                            <a class="video-play-btn mfp-iframe" href="{{ $course->intro_video_url }}">
                                <img src="{{ asset('assets/img/course-list/play.png') }}" alt="Play">
                            </a>
                        @endif
                    </div>

                    <div class="content">
                        <div class="price-and-enroll">
                            @if(!empty($course->fees) && $course->fees > 0)
                                <span class="price">₹{{ number_format($course->fees, 2) }}</span>
                            @else
                                <span class="price text-success">Free</span>
                            @endif
                            <span class="enroll">{{ $course->enrolled_count ?? 0 }} Enrolled</span>
                        </div>

                        <div class="btn-wrap my-3">
                            @if($isPurchased)
                                <span class="badge bg-success p-2 w-100 fs-6">✔ Course Purchased</span>
                            @else
                                <form action="{{ route('cart.add', $course->id) }}" method="POST" class="add-to-cart-form mb-2">
                                    @csrf
                                    <button type="submit" class="btn-common add-to-cart w-100">Add To Cart</button>
                                </form>
                                <a href="{{ route('checkout.buyNow', $course->id) }}" class="btn-common add-to-cart btn-active w-100 mt-2">Buy Now</a>
                            @endif
                        </div>

                        <p class="garunte-tag">30-Day Money-Back Guarantee</p>

                        <div class="feature-wrap">
                            <h5 class="feature-title">This course includes:</h5>
                            <ul class="ul check-point-list style-01 v-03">
                                <li class="single-check-point"><i class="fa-solid fa-check"></i> {{ $course->duration ?? '25 hours on-demand video' }}</li>
                                <li class="single-check-point"><i class="fa-solid fa-check"></i> 4 articles</li>
                                <li class="single-check-point"><i class="fa-solid fa-check"></i> 97 downloadable resources</li>
                                <li class="single-check-point"><i class="fa-solid fa-check"></i> Lifetime access</li>
                                <li class="single-check-point"><i class="fa-solid fa-check"></i> Mobile and TV access</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END RIGHT SIDE -->

        </div>
        <!-- ====================== -->
<!-- ====================== -->
<!-- 🎓 STUDENT FEEDBACK SECTION -->
<!-- ====================== -->
<div class="student-feedback mt-5">
    <h3 class="details-title mb-4">Student Feedback</h3>

    @auth
        @if(!$isPurchased)
            <div class="alert alert-info">
                You can submit feedback after purchasing this course.
            </div>
        @else
            <!-- Feedback Form -->
            <form action="{{ route('feedback.store', $course->id) }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-3">
                    <label for="rating" class="form-label fw-semibold">Rate this course:</label>
                    <select name="rating" id="rating" class="form-select" required>
                        <option value="">Select rating</option>
                        <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                        <option value="4">⭐⭐⭐⭐ (4)</option>
                        <option value="3">⭐⭐⭐ (3)</option>
                        <option value="2">⭐⭐ (2)</option>
                        <option value="1">⭐ (1)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label fw-semibold">Your Feedback:</label>
                    <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Share your learning experience..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit Feedback</button>
            </form>
        @endif
    @else
        <div class="alert alert-warning">
            <a href="{{ route('login') }}">Login</a> to submit feedback.
        </div>
    @endauth

    <!-- Display All Feedback -->
    <div class="feedback-list mt-4">
        <h5 class="fw-bold mb-3">Recent Reviews</h5>
        @php
            $feedbacks = \App\Models\Feedback::where('course_id', $course->id)
                        ->with('user')
                        ->latest()
                        ->get();
        @endphp

        @forelse($feedbacks as $feedback)
            <div class="border rounded p-3 mb-3 bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $feedback->user->name ?? 'Anonymous' }}</strong>
                        <div>
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star {{ $i <= $feedback->rating ? 'text-warning' : 'text-secondary' }}"></i>
                            @endfor
                        </div>
                    </div>
                    @auth
                        @if(Auth::id() === $feedback->user_id)
                            <!-- Delete Button -->
                            <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i> Remove
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>

                <p class="mt-2 mb-0">{{ $feedback->comment }}</p>
                <small class="text-muted">{{ $feedback->created_at->diffForHumans() }}</small>
            </div>
        @empty
            <p class="text-muted">No feedback yet. Be the first to review this course!</p>
        @endforelse
    </div>
</div>



    </div>
</div>

{{-- SweetAlert Messages --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
document.addEventListener("DOMContentLoaded", () => {
    Swal.fire({ icon: 'success', title: 'Added!', text: '{{ session('success') }}', showConfirmButton: false, timer: 2000 });
});
</script>
@endif

@if(session('info'))
<script>
document.addEventListener("DOMContentLoaded", () => {
    Swal.fire({ icon: 'info', title: 'Notice', text: '{{ session('info') }}', showConfirmButton: false, timer: 2000 });
});
</script>
@endif

<script>
    // Prevent multiple submissions for add-to-cart
    document.querySelectorAll(".add-to-cart-form").forEach(form => {
        form.addEventListener("submit", function() {
            const btn = form.querySelector("button");
            if (btn) {
                btn.disabled = true;
                btn.innerText = "Adding...";
            }
        });
    });

    // If Bootstrap JS isn't included for some reason, add a tiny fallback toggle for collapse UI (non-blocking)
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-bs-toggle="collapse"]');
        if(btn && typeof bootstrap === 'undefined') {
            const target = btn.getAttribute('data-bs-target') || btn.getAttribute('href');
            if(target) {
                const el = document.querySelector(target);
                if(el) el.classList.toggle('show');
            }
        }
    });
</script>

{{-- Small styling --}}
<style>
.accordion-button:not(.collapsed) {
    background-color: #e8f0fe;
    color: #0d6efd;
    box-shadow: none;
}
.accordion-body video {
    border: 1px solid #dee2e6;
}
.card .card-header .btn { text-decoration: none; }
.student-feedback .fa-star {
    font-size: 16px;
}
.student-feedback .fa-star.text-warning {
    color: #fbc02d !important;
}
.student-feedback form {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
}


</style>
@endsection
