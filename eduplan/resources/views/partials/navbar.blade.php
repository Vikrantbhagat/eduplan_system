@php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

$photoUrl = asset('images/default-profile.png');

if (Auth::check()) {
    $pp = Auth::user()->profile_photo ?? null;

    if ($pp) {
        if (strpos($pp, 'http://') === 0 || strpos($pp, 'https://') === 0) {
            $photoUrl = $pp;
        } else {
            if (Storage::disk('public')->exists($pp)) {
                $photoUrl = asset('storage/' . $pp);
            } elseif (file_exists(public_path($pp))) {
                $photoUrl = asset($pp);
            }
        }
    }
}

$unreadCount = Auth::check() && Auth::user()->role === 'admin' 
    ? Auth::user()->unreadNotifications->count() 
    : 0;
@endphp
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold fs-4" href="#">Eduplan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center flex-row flex-wrap">

                @auth
                    <li class="nav-item me-2 mb-2 mb-lg-0">
                        <a class="nav-link fw-medium text-white" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>

                    <!-- <div class="text-end mb-3">
    <a href="{{ route('admin.purchases') }}" class="btn btn-success">View All Transactions</a>
</div> -->


                    {{-- Admin Notification Icon --}}
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item me-2 mb-2 mb-lg-0">
                            <a href="{{ route('admin.notifications.index') }}" class="nav-link position-relative">
                                <i class="bi bi-bell fs-4 text-white"></i>
                                @if($unreadCount > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $unreadCount }}
                                        <span class="visually-hidden">unread notifications</span>
                                    </span>
                                @endif
                            </a>
                        </li>
                    @endif


                    @auth
   @if(Auth::user()->role === 'instructor')
    <li class="nav-item me-2 mb-2 mb-lg-0">
        <a class="nav-link fw-medium text-white" href="{{ route('instructor.purchased.index') }}">
            Purchased Courses
        </a>
    </li>

    <li class="nav-item me-2 mb-2 mb-lg-0">
        <a class="nav-link position-relative fw-medium text-white" href="{{ route('instructor.feedbacks') }}">
            <i class="bi bi-chat-dots fs-5"></i> Feedbacks
        </a>
    </li>
@endif

@endauth





                    {{-- Profile --}}
                    <li class="nav-item me-2 mb-2 mb-lg-0">
                        <a href="{{ route('profile.show') }}">
                            <img src="{{ $photoUrl }}" alt="Profile" class="rounded-circle profile-icon">
                        </a>
                    </li>

                    <li class="nav-item mb-2 mb-lg-0">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="nav-item me-2 mb-2 mb-lg-0">
                        <a class="nav-link text-white" href="{{ route('login.form', ['role' => 'admin']) }}">Admin Login</a>
                    </li>
                    <li class="nav-item mb-2 mb-lg-0">
                        <a class="nav-link text-white" href="{{ route('login.form', ['role' => 'instructor']) }}">Instructor Login</a>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>

<style>
.profile-icon {
    width: 42px;
    height: 42px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid #fff;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.profile-icon:hover {
    transform: scale(1.05);
    box-shadow: 0 0 8px rgba(255,255,255,0.6);
}

/* Ensure navbar items wrap nicely on small screens */
@media (max-width: 576px) {
    .navbar-nav .nav-item {
        flex: 1 1 100%;
        text-align: center;
    }
    .profile-icon {
        margin-top: 4px;
        margin-bottom: 4px;
    }
}
</style>
