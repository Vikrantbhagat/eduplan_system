@extends('layouts.auth')
@section('title','Student Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card shadow-sm p-4">
                <div class="text-center mb-4">
                    <a href="{{ url('/') }}"><img src="{{ asset('assets/img/Logos/logo-black.svg') }}" alt="Logo" style="height:48px;"></a>
                    <h4 class="mt-3">Student Login</h4>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('student.login.submit') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <a href="#" class="small">Forgot password?</a>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-primary btn-lg">Login</button>
                    </div>

                    <div class="text-center mt-3">
                        <small class="text-muted">Don't have an account? <a href="{{ route('student.register') }}">Register now</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
