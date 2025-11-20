@extends('layouts.auth')
@section('title','Student Register')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-sm p-4">
                <div class="text-center mb-4">
                    <a href="{{ url('/') }}"><img src="{{ asset('assets/img/Logos/logo-black.svg') }}" alt="Logo" style="height:48px;"></a>
                    <h4 class="mt-3">Create Student Account</h4>
                    <p class="text-muted">Join as a student to explore courses and track your progress.</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('student.register.submit') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-primary btn-lg">Create Account</button>
                    </div>

                    <div class="text-center mt-3">
                        <small class="text-muted">Already have account? <a href="{{ route('student.login') }}">Login here</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
