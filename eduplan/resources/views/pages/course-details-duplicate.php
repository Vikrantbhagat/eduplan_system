@extends('layouts.app')
@section('title', $course->title)

@section('content')
<div class="course-details-wrapper single-page-section-top-space single-page-section-bottom-space">
    <div class="container custom-container-01">
        <div class="row g-5">
            
            <!-- LEFT SIDE CONTENT -->
            <div class="col-lg-7 col-xl-8">
                
                <!-- Breadcrumb / Title Section -->
                <div class="breadcrumb-wrap style-01 mb-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb-content">
                                <h3 class="title">{{ $course->title }}</h3>
                                <p class="details">
                                    {{ $course->description ? Str::limit($course->description, 180) : 'This course covers everything you need to learn.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ratings and Reviews -->
                <div class="course-derails-inner mb-4">
                    <div class="feedback-and-review">
                        <div class="feedback">
                            @php 
                                $rating = $course->rating ?? 4.5; 
                                $fullStars = floor($rating);
                            @endphp
                            @for($i=1; $i<=5; $i++)
                                <i class="fa-solid fa-star icon {{ $i <= $fullStars ? 'active' : '' }}"></i>
                            @endfor
                            <span class="numb">{{ $rating }}</span>
                        </div>
                        <span class="rating-review">
                            {{ $course->reviews_count ?? 0 }} reviews 
                            <span class="hypen">-</span> 
                            <span class="review">{{ $course->enrolled_count ?? 0 }} students enrolled</span>
                        </span>
                    </div>
                </div>

                <!-- What You'll Learn -->
                <div class="about-course mb-4">
                    <h3 class="details-title">What you'll learn</h3>
                    <p class="paragraph">
                        {{ $course->short_overview ?? 'This course provides complete guidance to master the subject with hands-on examples and resources.' }}
                    </p>
                    <ul class="ul check-point-list style-01 v-03">
                        <li class="single-check-point"><span class="icon-wrap"><i class="fa-solid fa-check icon"></i></span><span class="content"><p class="text">Practical projects and case studies</p></span></li>
                        <li class="single-check-point"><span class="icon-wrap"><i class="fa-solid fa-check icon"></i></span><span class="content"><p class="text">Step-by-step structured lessons</p></span></li>
                        <li class="single-check-point"><span class="icon-wrap"><i class="fa-solid fa-check icon"></i></span><span class="content"><p class="text">Downloadable resources and PDFs</p></span></li>
                        <li class="single-check-point"><span class="icon-wrap"><i class="fa-solid fa-check icon"></i></span><span class="content"><p class="text">Full lifetime access</p></span></li>
                        <li class="single-check-point"><span class="icon-wrap"><i class="fa-solid fa-check icon"></i></span><span class="content"><p class="text">Access on mobile and TV</p></span></li>
                    </ul>
                </div>

                <!-- Course Description -->
                <div class="course-description-wrap mb-4">
                    <h3 class="details-title">Course Description</h3>
                    <p class="tutorial-details paragraph">
                        {{ $course->long_description ?? 'This is one of the most comprehensive online courses covering fundamentals to advanced concepts. Learn everything you need step by step.' }}
                    </p>
                </div>

                <!-- Who this course is for -->
                <div class="course-description-wrap">
                    <h3 class="details-title">Who this course is for:</h3>
                    <p class="tutorial-details paragraph">
                        {{ $course->target_audience ?? 'This course is designed for beginners, students, aspiring professionals, and anyone who wants to upskill.' }}
                    </p>
                    <ul class="ul check-point-list style-01 v-03">
                        <li class="single-check-point"><span class="icon-wrap"><i class="fa-solid fa-check icon"></i></span><span class="content"><p class="text">Beginners with no prior knowledge</p></span></li>
                        <li class="single-check-point"><span class="icon-wrap"><i class="fa-solid fa-check icon"></i></span><span class="content"><p class="text">Students wanting to boost career skills</p></span></li>
                        <li class="single-check-point"><span class="icon-wrap"><i class="fa-solid fa-check icon"></i></span><span class="content"><p class="text">Entrepreneurs and Freelancers</p></span></li>
                        <li class="single-check-point"><span class="icon-wrap"><i class="fa-solid fa-check icon"></i></span><span class="content"><p class="text">Professionals seeking advanced skills</p></span></li>
                    </ul>
                </div>
            </div>

            <!-- RIGHT SIDE CARD -->
            <div class="col-md-7 col-lg-5 col-xl-4">
                <div class="course-as-product-wrap">
                    
                    <!-- Thumbnail -->
                    <div class="thumbnail">
                        <img src="{{ $course->image ? asset('storage/'.$course->image) : asset('assets/img/course-placeholder.png') }}" alt="{{ $course->title }}">
                        @if($course->intro_video_url)
                        <a class="video-play-btn mfp-iframe" href="{{ $course->intro_video_url }}">
                            <img src="{{ asset('assets/img/course-list/play.png') }}" alt="Play">
                        </a>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="content">
                        <div class="price-and-enroll">
                            <span class="price">${{ $course->price ?? 'Free' }}</span>
                            <span class="enroll">{{ $course->enrolled_count ?? 0 }} Enrolled</span>
                        </div>

<div class="btn-wrap my-3">
    <form action="{{ route('cart.add', $course->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn-common add-to-cart">Add To Cart</button>
    </form>
    <a href="#" class="btn-common add-to-cart btn-active">Buy Now</a>
</div>


                        <p class="garunte-tag">30-Day Money-Back Guarantee</p>

                        <!-- Includes -->
                        <div class="feature-wrap">
                            <h5 class="feature-title">This course includes:</h5>
                            <ul class="ul check-point-list style-01 v-03">
                                <li class="single-check-point"><span class="icon-wrap"><i class="fa-solid fa-check icon"></i></span><span class="content"><p class="text">{{ $course->duration ?? '25 hours on-demand video' }}</p></span></li>
                                <li class="single-check-point"><span class="icon-wrap"><i class="fa-solid fa-check icon"></i></span><span class="content"><p class="text">4 articles</p></span></li>
                                <li class="single-check-point"><span class="icon-wrap"><i class="fa-solid fa-check icon"></i></span><span class="content"><p class="text">97 downloadable resources</p></span></li>
                                <li class="single-check-point"><span class="icon-wrap"><i class="fa-solid fa-check icon"></i></span><span class="content"><p class="text">Lifetime access</p></span></li>
                                <li class="single-check-point"><span class="icon-wrap"><i class="fa-solid fa-check icon"></i></span><span class="content"><p class="text">Mobile and TV access</p></span></li>
                            </ul>
                        </div>

                        <!-- Divider -->
                        <div class="bar">
                            <img src="{{ asset('assets/img/course-list/bar.png') }}" alt="divider">
                        </div>

                        <!-- Business offer -->
                        <div class="conclution-text">
                            <h5 class="feature-title">Training 6 or more people?</h5>
                            <p class="paragraph">Get your team access to 16,000+ top courses anytime, anywhere.</p>
                            <div class="btn-wrap">
                                <a href="#" class="btn-common add-to-cart">Try for business</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END RIGHT SIDE -->
        </div>
    </div>
</div>
@endsection
