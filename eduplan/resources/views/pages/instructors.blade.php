@extends('layouts.app')
@section('title','Instructors')

@section('content')
<div class="instructors-wrapper single-page-section-top-space single-page-section-bottom-space">

    <!-- breadcrumb area start -->
    <div class="breadcrumb-wrap style-01">
        <div class="container custom-container-01">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h3 class="title">Our Expert Instructors</h3>
                        <p class="details">Step forward to your study abroad dream with us</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- team area start -->
    <section class="our-team-area-wrapper">
        <div class="our-team-inner">
            <div class="container custom-container-01">
                <div class="row column-gap-50">

                    @forelse($instructors as $instructor)
                        <div class="col-md-6 col-lg-6 col-xl-4">
                            <div class="single-team-item style-03">
                                <div class="thumbnail">
                                    <img src="{{ $instructor->profile_photo ? asset($instructor->profile_photo) : asset('assets/img/team/default.png') }}" 
                                         alt="{{ $instructor->name }}" class="img-fluid">
                                </div>

                                <div class="content">
                                    <h4 class="title">
                                        <a href="{{ route('instructors.show', $instructor->id) }}">{{ $instructor->name }}</a>
                                    </h4>
                                    <p class="designation">{{ $instructor->designation ?? 'Consultants, Eduxon' }}</p>
                                    <p class="paragraph">{{ Str::limit($instructor->bio ?? 'No bio available', 100) }}</p>
                                </div>

                                <div class="hover-content">
                                    <div class="btn-wrap">
                                        <a href="{{ route('instructors.show', $instructor->id) }}" class="btn-common btn-active">Read More</a>
                                    </div>
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
    <!-- team area end -->

</div>
@endsection
