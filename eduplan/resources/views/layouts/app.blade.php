<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','EduPlan')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" sizes="20x20" type="image/png">

    <!-- CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/odometer.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <style>
        body { display:flex; flex-direction:column; min-height:100vh; }
        main { flex:1 0 auto; }
        footer { flex-shrink:0; }
    </style>
</head>
<body>

@php
    $role = auth()->check() ? auth()->user()->role : 'guest';
@endphp

{{-- ✅ Navbar --}}
@if($role === 'student')
    @include('layouts.navbar')
@elseif($role === 'admin' || $role === 'instructor')
    @include('partials.navbar')
@else
    @include('partials.navbar') {{-- guest --}}
@endif

{{-- ✅ Main Content --}}
<main>
    @yield('content')
</main>

{{-- ✅ Footer --}}
@if($role === 'student')
    @include('layouts.footer')
@elseif($role === 'admin' || $role === 'instructor')
    @include('partials.footer')
@else
    @include('partials.footer') {{-- guest --}}
@endif

<!-- JS -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/magnific-popup.js') }}"></script>
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nice-select.js') }}"></script>
<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('assets/js/odometer.min.js') }}"></script>
<script src="{{ asset('assets/js/viewport.jquery.js') }}"></script>
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<!-- in layouts.app footer or head -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@yield('scripts')
</body>
</html>
