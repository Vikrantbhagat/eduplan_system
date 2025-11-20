@extends('layouts.app')
@section('title','our-team')

@section('content') 
      

      <!-- about page start here  -->
        <div class="our-team-wrapper single-page-section-top-space single-page-section-bottom-space">

            <!-- breadcrumb area start here  -->
            <div class="breadcrumb-wrap style-01">
                <div class="container custom-container-01">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb-content">
                                <h3 class="title">Our Team</h3>
                                <p class="details">Step forward to your study abroad dream with us</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb area end here  -->

            <!-- about area start here  -->
            <section class="our-team-single-details-wrap section-bottom-space">
                <div class="container custom-container-01">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="img-wrap">
                                <img src="assets/img/team-details/01.jpg" alt="">

                                <div class="badge-wrap">
                                    <span class="numb">12</span>
                                    <span class="text">Years of Experience</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="content">
                                <p class="quote"> <i class="fa-solid fa-quote-left icon"></i>
                                    I went to many educational consultancy firms, talked to many of them but ultimately
                                    came back to Eduplan because it clearly stands out from others. It is a very running
                                    & experienced firm.
                                </p>

                                <p class="paragraph">We, as a consultancy firm, have been serving our students since
                                    2005 and this is how our students treat us in return. Their good words and
                                    references help us growing further and give us strengths to ensure a fastest, finest
                                    and quality services toward our beloved students.
                                </p>

                                <p class="paragraph">Since 2005, we have managed to build up a strong relationship
                                    within our partner institutes in abroad which helps us to assure genuine guidance to
                                    our students and their parents.</p>

                                <ul class="ul check-point-list style-01">
                                    <li class="single-check-point">
                                        <span class="icon-wrap">
                                            <i class="fa-solid fa-check icon"></i>
                                        </span>
                                        <span class="content">
                                            <p class="text">A firm which you can trust based on expertise and
                                                professionalism.
                                            </p>
                                        </span>
                                    </li>

                                    <li class="single-check-point">
                                        <span class="icon-wrap">
                                            <i class="fa-solid fa-check icon"></i>
                                        </span>
                                        <span class="content">
                                            <p class="text">We deal with multi-national students which allow us to know
                                                and
                                                resolve different problems.
                                            </p>
                                        </span>
                                    </li>
                                </ul>

                                <div class="btn-wrap">
                                    <a href="#" class="btn-common btn-new">Get Free Consultation</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- about area end here  -->



<!-- team area start here -->
<section class="our-team-area-wrapper section-top-space section-bottom-space">
    <div class="our-team-inner">
        <div class="container custom-container-01">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title-wrapper text-center">
                        <h4 class="section-title">Meet Experts</h4>
                        <p class="description">87% of people learning for professional development report career benefits</p>
                    </div>
                </div>
            </div>

            <div class="row column-gap-50">

                @forelse($instructors as $instructor)
                    <div class="col-md-6 col-lg-4">
                        <div class="single-team-item style-02">
                            <div class="thumbnail">
                                <img src="{{ $instructor->profile_photo ? asset($instructor->profile_photo) : asset('assets/img/team/default.png') }}" 
                                         alt="{{ $instructor->name }}" class="img-fluid">
                            </div>

                            <div class="content">
                                <h4 class="title">
                                    <a href="#" tabindex="-1">{{ $instructor->name }}</a>
                                </h4>
                                <p class="designation">{{ $instructor->designation ?? 'Consultant' }}</p>
                                <p class="email">
                                    <span class="icon-wrap"><i class="fa-regular fa-envelope icon"></i></span>
                                    <span class="text">{{ $instructor->email ?? 'noemail@example.com' }}</span>
                                </p>
                            </div>

                            <div class="hover-content">
                                <h4 class="title">
                                    <a href="#" tabindex="-1">{{ $instructor->name }}</a>
                                </h4>
                                <p class="designation">{{ $instructor->designation ?? 'Consultant' }}</p>
                                <p class="paragraph">{{ Str::limit($instructor->bio ?? 'No bio available', 120) }}</p>

                                <ul class="ul social-media-list style-01 color-02">
                                    <li class="single-social-item">
                                        <a href="#" tabindex="-1"><i class="fa-brands fa-instagram icon"></i></a>
                                    </li>
                                    <li class="single-social-item">
                                        <a href="#" tabindex="-1"><i class="fa-brands fa-facebook-f icon"></i></a>
                                    </li>
                                    <li class="single-social-item">
                                        <a href="#" tabindex="-1"><i class="fa-brands fa-youtube icon"></i></a>
                                    </li>
                                    <li class="single-social-item">
                                        <a href="#" tabindex="-1"><i class="fa-brands fa-linkedin-in icon"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No instructors found.</p>
                @endforelse

            </div>
        </div>
    </div>
</section>
<!-- team area end here -->


            <!-- about area start here  -->
            <section class="about-section-area-wrapper section-top-space">
                <div class="container custom-container-01">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="thumbnail ">
                                <div class="left-frame">
                                    <img src="assets/img/country-details/02.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="about-content">
                                <h3 class="content-title">Study in Canada with
                                    <br> Eduplan</h3>

                                <p class="paragraph">Most of the students struggle to submit their applications to
                                    Canadian universities or colleges. It has deadlines and very rare any Canadian
                                    institutes consider applications after the deadline. As a reason, we have noticed
                                    that many students miss a year and they need to wait until the next intake is open.
                                    We, at IECC are dealing with Canadian Universities since 2005 and our expertise are
                                    well-known about the key deadline which ensure a smooth admission journey.</p>

                                <p class="paragraph">We have dedicated teams of experts to help students with the entire
                                    visa processing and take care of the other things like health cover, insurance, any
                                    English language requirements and financial aid.
                                </p>

                                <div class="btn-wrap">
                                    <a href="#" class="btn-common btn-new">Get Free Consultation</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- about area end here  -->
        </div>
        <!-- about page end here  -->
@endsection