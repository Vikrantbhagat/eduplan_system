@extends('layouts.app')
@section('title','Edit User')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Edit User</h2>

    <form method="POST" action="{{ route('admin.users.update',$user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name',$user->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email',$user->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-select" required>
                <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                <option value="instructor" {{ $user->role=='instructor'?'selected':'' }}>Instructor</option>
                <option value="student" {{ $user->role=='student'?'selected':'' }}>Student</option>
            </select>
        </div>

        <div class="mb-3">
            <label>New Password (optional)</label>
            <input type="password" name="password" class="form-control">
            <input type="password" name="password_confirmation" class="form-control mt-2" placeholder="Confirm password">
        </div>

        <button type="submit" class="btn btn-success">Update User</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
