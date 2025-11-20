@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h2>Welcome, Admin</h2>
<p>Here you can manage instructors and courses.</p>

<a href="{{ route('admin.courses') }}" class="btn btn-dark mt-3">Review Courses</a>
@endsection
