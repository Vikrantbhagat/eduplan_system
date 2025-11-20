@extends('layouts.app')
@section('title', $instructor->name)

@section('content')
<!-- about page start here -->
<div class="team-details-wrapper single-page-section-top-space single-page-section-bottom-space">

    <!-- about area start here -->
    <section class="about-section-area-wrapper section-bottom-space">
        <div class="container custom-container-01">
            <div class="row align-items-center row-reverse">
                
                <!-- Instructor info text -->
                <div class="col-lg-6 col-md-12">
                    <div class="about-content">
                        <h3 class="content-title">About Instructor</h3>

                        <p class="paragraph">
                            {{ $instructor->bio ?? 'No bio available for this instructor.' }}
                        </p>

                        <div class="check-point-wrap">
                            <p class="details-title">Clients and publications include:</p>

                            <ul class="ul check-point-list style-01 v-02">
                                @if($instructor->clients)
                                    @foreach($instructor->clients as $client)
                                    <li class="single-check-point">
                                        <span class="icon-wrap">
                                            <i class="fa-solid fa-check icon"></i>
                                        </span>
                                        <span class="content">
                                            <span class="text">{{ $client }}</span>
                                        </span>
                                    </li>
                                    @endforeach
                                @else
                                    <li class="single-check-point">
                                        <span class="icon-wrap">
                                            <i class="fa-solid fa-check icon"></i>
                                        </span>
                                        <span class="content">
                                            <span class="text">No clients/publications available</span>
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Instructor photo and stats -->
                <div class="offset-xl-1 col-lg-6 col-md-7 col-xl-4">
                    <div class="single-instructor-details-wrap">
                        <div class="thumb">
                            <img src="{{ $instructor->profile_photo ? asset($instructor->profile_photo) : asset('assets/img/team/default.png') }}" 
                                 alt="{{ $instructor->name }}">
                        </div>

                        <div class="content">
                            @if($instructor->badge)
                            <div class="badge-box">
                                <span class="badges">{{ $instructor->badge }}</span>
                            </div>
                            @endif

                            <h4 class="title">{{ $instructor->name }}</h4>
                            <p class="paragraph">{{ $instructor->designation ?? 'Instructor' }}</p>

                            <div class="student-review">
                                <div class="student-wrap">
                                    <span class="number">{{ $instructor->total_students ?? 0 }}</span>
                                    <span class="text">Total Students</span>
                                </div>
                                <div class="review-wrap">
                                    <span class="number">{{ $instructor->reviews ?? 0 }}</span>
                                    <span class="text">Reviews</span>
                                </div>
                            </div>

                            @if($instructor->social_links)
                            <ul class="ul social-media-list style-01 color-02">
                                @foreach($instructor->social_links as $platform => $link)
                                <li class="single-social-item">
                                    <a href="{{ $link }}" target="_blank">
                                        <i class="fa-brands fa-{{ $platform }} icon"></i>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- about area end here -->





<!-- instructor courses start here -->
<section class="course-area-wrapper section-top-space">
    <div class="container custom-container-01">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title-wrapper text-center">
                    <h4 class="section-title">Courses by {{ $instructor->name }}</h4>
                    <p class="description">
                        I have total {{ $instructor->courses->count() }} courses live on Eduplan platform
                    </p>
                </div>
            </div>
        </div>

        <div class="row column-gap">
            @forelse($instructor->courses as $course)
                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <div class="single-course-item">
                        <!-- Thumbnail -->
                        <div class="thumbnail zoom-in">
                            <div class="background-image"
                                style="background-image: url('{{ $course->image ? asset('storage/'.$course->image) : asset('assets/img/course/default.png') }}');">
                            </div>
                        </div>

                        <!-- Main content -->
                        <div class="contact">
                            <p class="tag">{{ $instructor->name }}</p>
                            <h3 class="title">
                                <a href="{{ route('courses.show', $course->id) }}">{{ $course->title }}</a>
                            </h3>

                            <div class="meta-box">
                                <div class="left-content">
                                    <div class="feedback">
                                        <i class="fas fa-star icon"></i>
                                        <span class="text">4.8 ({{ rand(100,999) }})</span>
                                    </div>
                                </div>
                                <div class="right-content">
                                    <p class="price">${{ $course->price ?? 'Free' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Hover Option -->
                        <div class="hover-option">
                            <div class="contact">
                                <p class="tag">{{ $instructor->name }}</p>
                                <h3 class="title">
                                    <a href="{{ route('courses.show', $course->id) }}">{{ $course->title }}</a>
                                </h3>

                                <p class="paragraph">
                                    {{ Str::limit($course->description ?? 'No description available', 120) }}
                                </p>

                                <div class="meta-box">
                                    <div class="left-content">
                                        <div class="feedback">
                                            <i class="fa-solid fa-user-group icon"></i>
                                            <span class="text">{{ rand(1000,9999) }}</span>
                                        </div>
                                    </div>
                                    <div class="right-content">
                                        <i class="fa-solid fa-clock icon"></i>
                                        <span class="duration">{{ $course->duration ?? 'N/A' }}</span>
                                    </div>
                                </div>

                                @if($course->video)
                                    <div class="video-play-wrapper">
                                        <a class="video-play-btn mfp-iframe" href="{{ asset('storage/'.$course->video) }}">
                                            <svg width="14" height="25" viewBox="0 0 14 25" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.124 12.6362L0.364909 24.7606L0.36491 0.511875L13.124 12.6362Z"
                                                    fill="white"></path>
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
                <p class="text-center">No courses found for this instructor.</p>
            @endforelse
        </div>
    </div>
</section>
<!-- instructor courses end here -->




</div>
<!-- about page end here -->
@endsection
