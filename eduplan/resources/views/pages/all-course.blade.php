@extends('layouts.app')

@section('title','All Courses')

@section('content') 
<div class="all-course-wrapper single-page-section-top-space single-page-section-bottom-space">

    <!-- breadcrumb area start -->
    <div class="breadcrumb-wrap style-01">
        <div class="container custom-container-01">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h3 class="title">We have {{ $courses->count() }} courses total</h3>
                        <p class="details">
                            We have professional alliance's with leading Universities and Colleges around the world.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- course area start -->
    <section class="course-area-wrapper">
        <div class="container custom-container-01">
            <div class="row column-gap-50">

                @forelse($courses as $course)
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <div class="single-course-item">
                            <div class="thumbnail zoom-in">
                                <div class="background-image"
                                    style="background-image: url('{{ $course->image ? asset('storage/'.$course->image) : asset('assets/img/course-placeholder.png') }}');">
                                </div>
                            </div>

                            <div class="contact">
                                <p class="tag">{{ $course->instructor->name ?? 'Unknown Instructor' }}</p>

                                <h3 class="title">
<a href="{{ route('courses.show', $course->id) }}">{{ $course->title }}</a>
                                </h3>

                                <div class="meta-box">
                                    <div class="left-content">
                                        <div class="feedback">
                                            <i class="fas fa-star icon"></i>
                                            <span class="text">{{ $course->rating ?? '4.5' }} ({{ $course->reviews_count ?? 0 }})</span>
                                        </div>
                                    </div>
                                    <div class="right-content">
                                        {{-- FIX: show price or fees --}}
                                        @php
                                            $price = $course->price ?? $course->fees ?? 0;
                                        @endphp
                                        <p class="price">
                                            {{ $price > 0 ? '₹' . number_format($price, 2) : 'Free' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="hover-option">
                                <div class="contact">
                                    <p class="tag">{{ $course->instructor->name ?? 'Unknown Instructor' }}</p>

                                    <h3 class="title">
                                        <a href="{{ route('courses.show', $course->id) }}">{{ $course->title }}</a>
                                    </h3>

                                    <p class="paragraph">
                                        {{ Str::limit($course->description ?? 'No description available', 100) }}
                                    </p>

                                    <div class="meta-box">
                                        <div class="left-content">
                                            <div class="feedback">
                                                <i class="fa-solid fa-user-group icon"></i>
                                                <span class="text">{{ $course->enrolled_count ?? 0 }}</span>
                                            </div>
                                        </div>
                                        <div class="right-content">
                                            <i class="fa-solid fa-clock icon"></i>
                                            <span class="duration">{{ $course->duration ?? 'N/A' }}</span>
                                        </div>
                                    </div>

                                    {{-- Optional video --}}
                                    @if($course->intro_video_url)
                                    <div class="video-play-wrapper">
                                        <a class="video-play-btn mfp-iframe" href="{{ $course->intro_video_url }}">
                                            <svg width="14" height="25" viewBox="0 0 14 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.124 12.6362L0.364909 24.7606L0.36491 0.511875L13.124 12.6362Z" fill="white"></path>
                                            </svg>
                                        </a>
                                        <p class="text">Watch Intro</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No courses available.</p>
                @endforelse

            </div>

            <!-- pagination -->
            <div class="row mt-5">
                <div class="col-lg-12">
                    {{ $courses->links('pagination::bootstrap-5') }}
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="pagination">
                        <ul class="pagination-list">
                            <li><a href="#" class="page-number able left-arrow">PREV</a></li>
                            <li><a href="#" class="page-number current">01</a></li>
                            <li><a href="#" class="page-number">02</a></li>
                            <li><a href="#" class="page-number">03</a></li>
                            <li><a href="#" class="page-number able right-arrow">NEXT</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- course area end -->
</div>
@endsection
