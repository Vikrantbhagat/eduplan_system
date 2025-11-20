@extends('layouts.app')

@section('title', 'My Cart')

@section('content')

<div class="course-details-wrapper single-page-section-top-space single-page-section-bottom-space">
    <!-- breadcrumb -->
    <div class="breadcrumb-wrap style-01">
        <div class="container custom-container-01">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h3 class="title">Shopping Cart</h3>
                        <p class="details">{{ $cartItems->count() }} Items in your cart</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container custom-container-01 py-5">
        {{-- Flash messages --}}
        @foreach (['success','info','error'] as $msg)
            @if(session($msg))
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        Swal.fire({
                            icon: "{{ $msg == 'success' ? 'success' : ($msg == 'info' ? 'info' : 'error') }}",
                            title: "{{ ucfirst($msg) }}",
                            text: "{{ session($msg) }}",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    });
                </script>
            @endif
        @endforeach

        @if($cartItems->count() > 0)
            <div class="row">
                {{-- Left Side: Cart Items --}}
                <div class="col-lg-8">
                    <div class="similler-course-list-wrap mt-0">
                        <ul class="ul simillar-course-list style-02 mt-0">
                            @foreach($cartItems as $item)
                                @php
                                    $course = $item->course;
                                    $instructor = $course->instructor ?? null;
                                @endphp

                                <li class="single-simillar-course-item">
                                    <div class="thumb">
                                        @if($course->image)
                                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}">
                                        @else
                                            <img src="{{ asset('assets/img/course-placeholder.png') }}" alt="No Image">
                                        @endif
                                    </div>

                                    <div class="content">
                                        <div class="left-content">
                                            <h4 class="title">
                                                <a href="#">{{ $course->title }}</a>
                                            </h4>

                                            @if($instructor)
                                                <p class="small text-muted mb-1">
                                                    👨‍🏫 {{ $instructor->name }} ({{ $instructor->designation }})
                                                </p>
                                            @endif

                                            <div class="rating-and-enrolled">
                                                <div class="rating-wrap">
                                                    <span class="star"><i class="fa-solid fa-star icon"></i></span>
                                                    <span class="nubm">4.8 (756)</span>
                                                </div>
                                                <div class="enrolled-wrap">
                                                    <i class="fa-solid fa-user-group icon"></i>
                                                    <span class="text">97538 Enrolled</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="right-content text-end">
                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="remove-form d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <span class="remove remove-btn">Remove</span>
                                            </form>

                                            {{-- Show Real Fees --}}
                                            <span class="price fw-bold d-block mt-2">
                                                ₹{{ number_format($course->fees ?? 0, 2) }}
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- Right Side: Checkout Summary --}}
                <div class="col-lg-4">
                    <div class="checkout-wrap">
                        @php
                            $total = $cartItems->sum(fn($i) => $i->course->fees ?? 0);
                        @endphp

                        <span class="total">Total</span>
                        <span class="price fw-bold fs-4 text-success d-block mb-3">
                            ₹{{ number_format($total, 2) }}
                        </span>

                        <span class="text">Have coupon code?</span>
                        <div class="copun-box">
                            <input type="text" placeholder="Enter coupon">
                            <button type="submit">Apply</button>
                        </div>

                        <div class="form-submit mt-3">
                            {{-- LINK Checkout Now button to checkout page --}}
                            <a href="{{ route('checkout.index') }}" class="btn-common btn-active w-100 text-center text-white">Checkout Now</a>
                        </div>
                    </div>
                </div>
            </div>

        @else
            {{-- Empty Cart Section --}}
            <div class="error-wrapper">
                <div class="container custom-container-01">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="error-inner">
                                <div class="row align-items-center row-reverse">
                                    <div class="offset-lg-1 col-lg-5">
                                        <div class="content">
                                            <h5 class="title">Empty Cart!</h5>
                                            <span class="text">Your cart is empty. Keep shopping to find a course!</span>
                                            <div class="btn-wrap mt-3">
                                                <a href="{{ url('/') }}" class="btn-common add-to-cart btn-active">Back to homepage</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <img src="{{ asset('assets/img/404/02.png') }}" alt="Empty Cart">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Confirm remove course
    document.querySelectorAll(".remove-form").forEach(form => {
        const removeBtn = form.querySelector(".remove-btn");
        removeBtn.addEventListener("click", (e) => {
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "This course will be removed from your cart.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, remove it"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@endsection
