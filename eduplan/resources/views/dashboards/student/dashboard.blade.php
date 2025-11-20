<!-- resources/views/layouts/navbar.blade.php -->
@extends('layouts.app')
@section('title','dashboard')

@section('content')


 <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Banner Area Start Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="banner-area home-01">
    <div class="container custom-container-01">
        <div class="banner-wrapper">
            <div class="row">
                <div class="col-xl-7 col-lg-10">
                    <div class="banner-inner">
                        <p class="subtitle">SPECIAL OFFER FIRST CUSTOMER</p>
                        <h1 class="title">Your <span>success</span> journey start with us!</h1>
                        <p>
                            Eduplan Education Can Fulfil Your International Education Dream <br>
                            As Per Your Best Fit with world top universities and colleges.
                        </p>
                        <div class="header-btn">
                            <div class="btn-wrap">
                                <a href="#0" class="btn-common flat-btn btn-active">apply online</a>
                            </div>
                            <div class="btn-wrap margin-left-20">
                                <a href="{{ url('contact') }}" class="btn-common fill-btn">Discover</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="thumbnail">
                        <img src="{{ asset('assets/img/shapes/Ellipse-01.png') }}" class="element-01" alt="Ellipse">
                        <img src="{{ asset('assets/img/shapes/Ellipse-02.png') }}" class="element-02" alt="Ellipse">
                        <img src="{{ asset('assets/img/shapes/Vector-15.png') }}" class="element-03" alt="Vector">
                        <img src="{{ asset('assets/img/header/plane.png') }}" class="element-04" alt="Plane">
                        <img src="{{ asset('assets/img/icon/location.png') }}" class="element-05" alt="Location">
                        <img src="{{ asset('assets/img/header/header-img.png') }}" class="banner-img" alt="Student">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Banner Area End Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

 <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Features Area Start Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="features-section margin-top-100">
    <img src="{{ asset('assets/img/shapes/graduation.png') }}" class="shape" alt="graduation cap">
    <div class="container custom-container-01">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="icon-box-item">
                    <div class="icon">
                        <img src="{{ asset('assets/img/icon/idea.png') }}" alt="Idea Icon">
                    </div>
                    <div class="content">
                        <h4 class="title">One Stop Study Solution</h4>
                        <p>Get a full view so you know where to save. Track spending, deta keep tab subscription
                            lorem ipsum text</p>
                    </div>
                    <div class="btn-wrap">
                        <a href="#0" class="more-btn">Learn More <i class="fa-solid fa-angle-right icon"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="icon-box-item">
                    <div class="icon">
                        <img src="{{ asset('assets/img/icon/coversation.png') }}" alt="Conversation Icon">
                    </div>
                    <div class="content">
                        <h4 class="title">One To One Discussion</h4>
                        <p>Get a full view so you know where to save. Track spending, deta keep tab subscription
                            lorem ipsum text</p>
                    </div>
                    <div class="btn-wrap">
                        <a href="#0" class="more-btn">Learn More <i class="fa-solid fa-angle-right icon"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="icon-box-item">
                    <div class="icon">
                        <img src="{{ asset('assets/img/icon/emergency.png') }}" alt="Emergency Icon">
                    </div>
                    <div class="content">
                        <h4 class="title">End To End Support</h4>
                        <p>Get a full view so you know where to save. Track spending, deta keep tab subscription
                            lorem ipsum text</p>
                    </div>
                    <div class="btn-wrap">
                        <a href="#0" class="more-btn">Learn More <i class="fa-solid fa-angle-right icon"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Features Area End Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


 <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Feedback Area Start Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="feedback-section margin-top-110">
    <div class="container custom-container-01">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="theme-section-title desktop-center text-center">
                    <span class="subtitle">FEEDBACKS</span>
                    <h4 class="title">Our students shared their <br> visa success stories
                        <svg class="title-shape" width="355" height="15" viewBox="0 0 355 15" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path class="path"
                                d="M351.66 12.6362C187.865 -6.32755 49.6478 6.37132 3.41142 12.6362"
                                stroke="#764AF1" stroke-width="3" stroke-linecap="square" />
                            <path class="path" d="M351.66 13C187.865 -5.96378 49.6478 6.73509 3.41142 13"
                                stroke="#764AF1" stroke-width="3" stroke-linecap="square" />
                            <path class="path" d="M2.5 5.5C168.5 2.0001 280.5 -1.49994 352.5 8.49985"
                                stroke="#FFC44E" stroke-width="3" stroke-linecap="square" />
                        </svg>
                    </h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="image-box-item">
                    <div class="thumbnail">
                        <img src="{{ asset('assets/img/sections/students/student-01.png') }}" alt="Student 01">
                        <a class="video-play-btn mfp-iframe" href="https://www.youtube.com/watch?v=c7XEhXZ_rsk">
                            <svg width="14" height="25" viewBox="0 0 14 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.124 12.6362L0.364909 24.7606L0.36491 0.511875L13.124 12.6362Z"
                                    fill="white" />
                            </svg>
                        </a>
                        <div class="content">
                            <h6 class="title">Annette Black</h6>
                            <p>University of Alberta ~ Canada</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="image-box-item">
                    <div class="thumbnail">
                        <img src="{{ asset('assets/img/sections/students/student-02.png') }}" alt="Student 02">
                        <a class="video-play-btn mfp-iframe" href="https://www.youtube.com/watch?v=c7XEhXZ_rsk">
                            <svg width="14" height="25" viewBox="0 0 14 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.124 12.6362L0.364909 24.7606L0.36491 0.511875L13.124 12.6362Z"
                                    fill="white" />
                            </svg>
                        </a>
                        <div class="content">
                            <h6 class="title">Robert Fox</h6>
                            <p>University of Alberta ~ Canada</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="image-box-item">
                    <div class="thumbnail">
                        <img src="{{ asset('assets/img/sections/students/student-03.png') }}" alt="Student 03">
                        <a class="video-play-btn mfp-iframe" href="https://www.youtube.com/watch?v=c7XEhXZ_rsk">
                            <svg width="14" height="25" viewBox="0 0 14 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.124 12.6362L0.364909 24.7606L0.36491 0.511875L13.124 12.6362Z"
                                    fill="white" />
                            </svg>
                        </a>
                        <div class="content">
                            <h6 class="title">Leslie Alexander</h6>
                            <p>University of Alberta ~ Canada</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="image-box-item">
                    <div class="thumbnail">
                        <img src="{{ asset('assets/img/sections/students/student-04.png') }}" alt="Student 04">
                        <a class="video-play-btn mfp-iframe" href="https://www.youtube.com/watch?v=c7XEhXZ_rsk">
                            <svg width="14" height="25" viewBox="0 0 14 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.124 12.6362L0.364909 24.7606L0.36491 0.511875L13.124 12.6362Z"
                                    fill="white" />
                            </svg>
                        </a>
                        <div class="content">
                            <h6 class="title">Kristin Watson</h6>
                            <p>University of Alberta ~ Canada</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Feedback Area End Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


 <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Destinations Area Start Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="margin-top-110 section-bottom-space">
    <div class="destination-section">
        <img src="{{ asset('assets/img/shapes/mountant.png') }}"
            class="shape-01 wow animate__animated animate__delay-1s animate__fadeInUp" alt="mountant">
        <div class="plane-wrap">
            <img src="{{ asset('assets/img/shapes/plane.png') }}" class="shape-02" alt="plane">
        </div>
        <div class="container custom-container-01">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="theme-section-title desktop-center text-center">
                        <h4 class="title">Top Destinations</h4>
                        <p>We have quality partners in variety of destinations around the globe.</p>
                    </div>
                </div>
            </div>
            <div class="destination-items-wrap">
                <div class="destination-single-item">
                    <div class="thumbnail">
                        <img src="{{ asset('assets/img/sections/destination/canda.png') }}" alt="Canada">
                    </div>
                    <h6 class="name">Canada</h6>
                </div>
                <div class="destination-single-item">
                    <div class="thumbnail">
                        <img src="{{ asset('assets/img/sections/destination/usa.png') }}" alt="America">
                    </div>
                    <h6 class="name">America</h6>
                </div>
                <div class="destination-single-item">
                    <div class="thumbnail">
                        <img src="{{ asset('assets/img/sections/destination/australia.png') }}" alt="Australia">
                    </div>
                    <h6 class="name">Australia</h6>
                </div>
                <div class="destination-single-item">
                    <div class="thumbnail">
                        <img src="{{ asset('assets/img/sections/destination/span.png') }}" alt="Spain">
                    </div>
                    <h6 class="name">Spain</h6>
                </div>
                <div class="destination-single-item">
                    <div class="thumbnail">
                        <img src="{{ asset('assets/img/sections/destination/franch.png') }}" alt="France">
                    </div>
                    <h6 class="name">France</h6>
                </div>
                <div class="destination-single-item">
                    <div class="thumbnail">
                        <img src="{{ asset('assets/img/sections/destination/swideen.png') }}" alt="Sweden">
                    </div>
                    <h6 class="name">Sweden</h6>
                </div>
                <div class="destination-single-item">
                    <div class="thumbnail">
                        <img src="{{ asset('assets/img/sections/destination/italy.png') }}" alt="Italy">
                    </div>
                    <h6 class="name">Italy</h6>
                </div>
            </div>
            <div class="btn-wrap desktop-center margin-top-40 text-center">
                <a href="contact.html" class="btn-common fill-btn style-01">apply online</a>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Destinations Area End Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    About Section Area Start Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="about-section-area section-top-space about-home-02">
    <div class="container custom-container-01">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="theme-section-title">
                    <span class="subtitle">ABOUT US & EXPERIENCE</span>
                    <h4 class="title">Moving beyond product innovation to gain a competitive advantage
                        <svg class="title-shape style-01" width="355" height="15" viewBox="0 0 355 15"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="path"
                                d="M351.66 12.6362C187.865 -6.32755 49.6478 6.37132 3.41142 12.6362"
                                stroke="#764AF1" stroke-width="3" stroke-linecap="square" />
                            <path class="path" d="M351.66 13C187.865 -5.96378 49.6478 6.73509 3.41142 13"
                                stroke="#764AF1" stroke-width="3" stroke-linecap="square" />
                            <path class="path" d="M2.5 5.5C168.5 2.0001 280.5 -1.49994 352.5 8.49985"
                                stroke="#FFC44E" stroke-width="3" stroke-linecap="square" />
                        </svg>
                    </h4>
                </div>
                <div class="about-content-wrap">
                    <p>Ouya Education, which is based in Victoria, British Columbia, Canada, frequently deals
                        with issues of employment (recruitment and retention) for temporary foreign workers
                        (TFW), as well as temporary and permanent residency applications and other general
                        immigration matters with Canadian federal departments (IRCC and CBSA).</p>
                    <p>Education also provides educational consulting services for student-clients who want to
                        study in Canada, and require help with the application process.</p>
                    <span class="core">Core strength</span>
                </div>
                <div class="counter-section-inner style-a">
                    <div class="single-counterup color-01">
                        <div class="content-wrap">
                            <div class="odo-area">
                                <h3 class="odometer odo-title" data-odometer-final="15">0</h3>
                            </div>
                            <div class="content">
                                <h6 class="subtitle">Years Experience</h6>
                            </div>
                        </div>
                    </div>
                    <div class="single-counterup color-02">
                        <div class="content-wrap">
                            <div class="odo-area">
                                <h3 class="odometer odo-title style-01" data-odometer-final="875">0</h3>
                            </div>
                            <div class="content">
                                <h6 class="subtitle">VISA Approved</h6>
                            </div>
                        </div>
                    </div>
                    <div class="single-counterup color-03">
                        <div class="content-wrap">
                            <div class="odo-area">
                                <h3 class="odometer odo-title style-02" data-odometer-final="96">0</h3>
                                <h3 class="title">%</h3>
                            </div>
                            <div class="content">
                                <h6 class="subtitle">Admission success</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-wrap">
                    <a href="#" class="btn-common fill-btn">Get Free Consultation</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="thumbnail">
                    <img src="{{ asset('assets/img/sections/about/student-in-library.png') }}" alt="Student in Library">
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    About Section Area End Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Category Section Area Start Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="category-section-area">
    <div class="container custom-container-01">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-wrapper d-flex justify-content-between">
                    <div class="theme-section-title">
                        <span class="subtitle">CATEGORIES</span>
                        <h4 class="title">Popular Discipline & College</h4>
                    </div>
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a href="#" class="nav-link active" data-bs-toggle="pill" data-bs-target="#discipline">Discipline</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-bs-toggle="pill" data-bs-target="#college">College</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <!-- Discipline Tab -->
            <div class="tab-pane fade show active" id="discipline">
                <div class="destination-items-wrap">
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/foresty.png') }}" alt="Agriculture & Foresty">
                        </div>
                        <h6 class="name">Agriculture & <br> Foresty</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/science.png') }}" alt="Science & Professional">
                        </div>
                        <h6 class="name">Science <br> & Professional</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/art.png') }}" alt="Art, Design & Culture">
                        </div>
                        <h6 class="name">Art, Design & <br> Culture</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/business.png') }}" alt="Business & Management">
                        </div>
                        <h6 class="name">Business & <br> Management</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/pc.png') }}" alt="Computer Science & IT">
                        </div>
                        <h6 class="name">Computer <br> Science & IT</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/book.png') }}" alt="Education & Training">
                        </div>
                        <h6 class="name">Education & <br> Training</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/click.png') }}" alt="Engineering & Technology">
                        </div>
                        <h6 class="name">Engineering & <br> Technology</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/french-fry.png') }}" alt="Hospitality & Sports">
                        </div>
                        <h6 class="name">Hospitality & <br> Sports</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/news-paper.png') }}" alt="Journalism & Media">
                        </div>
                        <h6 class="name">Journalism & <br> Media</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/first-aid-kit.png') }}" alt="Medicine & Health">
                        </div>
                        <h6 class="name">Medicine & <br> Health</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/law.png') }}" alt="Law">
                        </div>
                        <h6 class="name">Law</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/enverment.png') }}" alt="Social Science">
                        </div>
                        <h6 class="name">Social Science</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/humanity.png') }}" alt="Humanities">
                        </div>
                        <h6 class="name">Humanities</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/recicle.png') }}" alt="Environmental Studies">
                        </div>
                        <h6 class="name">Environmental <br> Studies</h6>
                    </div>
                </div>
            </div>

            <!-- College Tab -->
            <div class="tab-pane fade" id="college">
                <div class="destination-items-wrap">
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/french-fry.png') }}" alt="Hospitality & Sports">
                        </div>
                        <h6 class="name">Hospitality & <br> Sports</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/news-paper.png') }}" alt="Journalism & Media">
                        </div>
                        <h6 class="name">Journalism & <br> Media</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/first-aid-kit.png') }}" alt="Medicine & Health">
                        </div>
                        <h6 class="name">Medicine & <br> Health</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/law.png') }}" alt="Law">
                        </div>
                        <h6 class="name">Law</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/enverment.png') }}" alt="Social Science">
                        </div>
                        <h6 class="name">Social Science</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/humanity.png') }}" alt="Humanities">
                        </div>
                        <h6 class="name">Humanities</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/recicle.png') }}" alt="Environmental Studies">
                        </div>
                        <h6 class="name">Environmental <br> Studies</h6>
                    </div>

                                        <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/french-fry.png') }}" alt="Hospitality & Sports">
                        </div>
                        <h6 class="name">Hospitality & <br> Sports</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/news-paper.png') }}" alt="Journalism & Media">
                        </div>
                        <h6 class="name">Journalism & <br> Media</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/first-aid-kit.png') }}" alt="Medicine & Health">
                        </div>
                        <h6 class="name">Medicine & <br> Health</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/law.png') }}" alt="Law">
                        </div>
                        <h6 class="name">Law</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/enverment.png') }}" alt="Social Science">
                        </div>
                        <h6 class="name">Social Science</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/humanity.png') }}" alt="Humanities">
                        </div>
                        <h6 class="name">Humanities</h6>
                    </div>
                    <div class="destination-single-item style-01">
                        <div class="thumbnail">
                            <img src="{{ asset('assets/img/sections/desipline/recicle.png') }}" alt="Environmental Studies">
                        </div>
                        <h6 class="name">Environmental <br> Studies</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Category Section Area End Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


  <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Steps Section Area Start Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="destination-section style-01 margin-top-110 instruction">
    <div class="container custom-container-01">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="theme-section-title desktop-center text-center">
                    <span class="subtitle">STEPS</span>
                    <h4 class="title">Steps to Get your Destination</h4>
                </div>
            </div>
        </div>
        <div class="destination-items-wrap">
            <div class="destination-single-item style-02">
                <div class="thumbnail">
                    <img src="{{ asset('assets/img/icon/step-01.png') }}" alt="Step 1: Identify course, country & college">
                </div>
                <h6 class="name">Identify course <br> country & college</h6>
            </div>
            <div class="destination-single-item style-02">
                <div class="thumbnail">
                    <img src="{{ asset('assets/img/icon/step-02.png') }}" alt="Step 2: Research & Planning">
                </div>
                <h6 class="name">Research <br> & Planning</h6>
            </div>
            <div class="destination-single-item style-02">
                <div class="thumbnail">
                    <img src="{{ asset('assets/img/icon/step-03.png') }}" alt="Step 3: Application Process">
                </div>
                <h6 class="name">Application <br> Process</h6>
            </div>
            <div class="destination-single-item style-02">
                <div class="thumbnail">
                    <img src="{{ asset('assets/img/icon/step-04.png') }}" alt="Step 4: Visa Guidance">
                </div>
                <h6 class="name">Visa <br> Guidance</h6>
            </div>
            <div class="destination-single-item style-02">
                <div class="thumbnail">
                    <img src="{{ asset('assets/img/icon/step-05.png') }}" alt="Step 5: Pre-Departure Assistance">
                </div>
                <h6 class="name">Pre-Departure <br> Assistance</h6>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Steps Section Area End Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    News Section Area Start Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="news-section-area margin-top-110">
    <div class="container custom-container-01">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="theme-section-title desktop-center text-center">
                    <span class="subtitle">EDUPLAN UPDATES</span>
                    <h4 class="title">Eduplan Latest Blog</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="blog-grid-item">
                    <div class="thumbnail">
                        <img src="{{ asset('assets/img/h-blog/01.png') }}" alt="Overseas Education Fair Amravati 2023" class="border-radius-20">
                    </div>
                    <div class="content">
                        <ul class="post-categories">
                            <li><img src="{{ asset('assets/img/icon/calander.png') }}" alt="calendar icon">19th Jan 2022</li>
                            <li>12 noon to 4 pm</li>
                        </ul>
                        <h4 class="title">Overseas Education Fair Amravati 2023</h4>
                        <div class="btn-wrap">
                            <a href="#0" class="more-btn">Read More <i class="fa-solid fa-angle-right icon"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="blog-grid-item">
                    <div class="thumbnail">
                        <img src="{{ asset('assets/img/h-blog/02.png') }}" alt="Overseas Education Fair Amravati 2023" class="border-radius-20">
                    </div>
                    <div class="content">
                        <ul class="post-categories">
                            <li><img src="{{ asset('assets/img/icon/calander.png') }}" alt="calendar icon">19th Jan 2022</li>
                            <li>12 noon to 4 pm</li>
                        </ul>
                        <h4 class="title">Overseas Education Fair Amravati 2023</h4>
                        <div class="btn-wrap">
                            <a href="#0" class="more-btn">Read More <i class="fa-solid fa-angle-right icon"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="blog-grid-item">
                    <div class="thumbnail">
                        <img src="{{ asset('assets/img/h-blog/03.png') }}" alt="Overseas Education Fair Amravati 2023" class="border-radius-20">
                    </div>
                    <div class="content">
                        <ul class="post-categories">
                            <li><img src="{{ asset('assets/img/icon/calander.png') }}" alt="calendar icon">19th Jan 2022</li>
                            <li>12 noon to 4 pm</li>
                        </ul>
                        <h4 class="title">Overseas Education Fair Amravati 2023</h4>
                        <div class="btn-wrap">
                            <a href="#0" class="more-btn">Read More <i class="fa-solid fa-angle-right icon"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    News Section Area End Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

 <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Faq Section Area Start Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="faq-section-area margin-top-90">
    <div class="container custom-container-01">
        <div class="row">
            <div class="col-lg-6">
                <div class="theme-section-title">
                    <span class="subtitle">FAQ</span>
                    <h4 class="title">Frequently Asked Questions</h4>
                </div>
                <div class="faq-content">
                    <h6 class="subtitle">
                        Still have questions? <br> Feel free to ask our experts here.
                    </h6>
                    <div class="btn-wrap">
                        <a href="#0" class="btn-common flat-btn">ASK YOUR QUESTIONS</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="accordion-wrapper">
                    <div id="accordionFaq">
                        <!-- FAQ Item 1 -->
                        <div class="card">
                            <div class="card-header" id="faqHeadingOne">
                                <h5 class="mb-0">
                                    <a class="collapsed" role="button" data-bs-toggle="collapse"
                                       data-bs-target="#faqCollapseOne" aria-expanded="false"
                                       aria-controls="faqCollapseOne">
                                        1. How can I get admission in an abroad university?
                                    </a>
                                </h5>
                            </div>
                            <div id="faqCollapseOne" class="collapse" data-bs-parent="#accordionFaq">
                                <div class="card-body">
                                    Norway, USA, UK, Germany & Italy are among the safest countries for Bangladeshi students for higher studies.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="card">
                            <div class="card-header" id="faqHeadingTwo">
                                <h5 class="mb-0">
                                    <a class="collapsed" role="button" data-bs-toggle="collapse"
                                       data-bs-target="#faqCollapseTwo" aria-expanded="false"
                                       aria-controls="faqCollapseTwo">
                                        2. Do you offer complete solutions for students?
                                    </a>
                                </h5>
                            </div>
                            <div id="faqCollapseTwo" class="collapse" data-bs-parent="#accordionFaq">
                                <div class="card-body">
                                    Yes, we provide end-to-end guidance including admission, visa, and post-arrival support.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="card">
                            <div class="card-header" id="faqHeadingThree">
                                <h5 class="mb-0">
                                    <a class="collapsed" role="button" data-bs-toggle="collapse"
                                       data-bs-target="#faqCollapseThree" aria-expanded="true"
                                       aria-controls="faqCollapseThree">
                                        3. Which countries are safe and better for higher study?
                                    </a>
                                </h5>
                            </div>
                            <div id="faqCollapseThree" class="collapse show" data-bs-parent="#accordionFaq">
                                <div class="card-body">
                                    Norway, USA, UK, Germany & Italy are considered safe and top destinations for higher education.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="card">
                            <div class="card-header" id="faqHeadingFour">
                                <h5 class="mb-0">
                                    <a class="collapsed" role="button" data-bs-toggle="collapse"
                                       data-bs-target="#faqCollapseFour" aria-expanded="false"
                                       aria-controls="faqCollapseFour">
                                        4. Which countries offer PR after getting a job post-study?
                                    </a>
                                </h5>
                            </div>
                            <div id="faqCollapseFour" class="collapse" data-bs-parent="#accordionFaq">
                                <div class="card-body">
                                    Countries like Canada, Australia, and Germany provide pathways to PR after completing studies and securing a job.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 5 -->
                        <div class="card">
                            <div class="card-header" id="faqHeadingFive">
                                <h5 class="mb-0">
                                    <a class="collapsed" role="button" data-bs-toggle="collapse"
                                       data-bs-target="#faqCollapseFive" aria-expanded="false"
                                       aria-controls="faqCollapseFive">
                                        5. Can I get a scholarship with a low CGPA?
                                    </a>
                                </h5>
                            </div>
                            <div id="faqCollapseFive" class="collapse" data-bs-parent="#accordionFaq">
                                <div class="card-body">
                                    Scholarship eligibility depends on the university and program. Some offer merit-based and need-based scholarships even with lower CGPA.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 6 -->
                        <div class="card">
                            <div class="card-header" id="faqHeadingSix">
                                <h5 class="mb-0">
                                    <a class="collapsed" role="button" data-bs-toggle="collapse"
                                       data-bs-target="#faqCollapseSix" aria-expanded="false"
                                       aria-controls="faqCollapseSix">
                                        6. Do you provide accommodation for students abroad?
                                    </a>
                                </h5>
                            </div>
                            <div id="faqCollapseSix" class="collapse" data-bs-parent="#accordionFaq">
                                <div class="card-body">
                                    Yes, we guide students in finding safe and comfortable accommodation options abroad.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Faq Section Area End Here
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

@endsection




