@extends('layouts.app')
@section('title','Admin Dashboard')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center text-md-start">Admin Dashboard - Users</h2>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Action Buttons --}}
    <div class="d-flex flex-column flex-md-row justify-content-end align-items-center gap-2 mb-4">
        <a href="{{ route('admin.purchases') }}" class="btn btn-success d-flex align-items-center gap-2 shadow-sm">
            💳 <span>View Transaction History</span>
        </a>
        <a href="{{ route('admin.analytics') }}" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm">
            📊 <span>View Graphical Analytics</span>
        </a>
    </div>

    {{-- Users Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Courses</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $u)
                <tr id="user-row-{{ $u->id }}">
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td><span class="badge bg-info">{{ ucfirst($u->role) }}</span></td>
                    <td class="text-center">
                        @if($u->role === 'instructor')
                            <a href="{{ route('admin.users.courses',$u->id) }}" class="btn btn-sm btn-warning">View Courses</a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.users.edit',$u->id) }}" class="btn btn-sm btn-primary mb-1 mb-md-0 me-1">Edit</a>
                        <button class="btn btn-sm btn-danger btn-delete-user" data-id="{{ $u->id }}">Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Delete Script --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    const csrf = "{{ csrf_token() }}";
    document.querySelectorAll(".btn-delete-user").forEach(btn => {
        btn.addEventListener("click", async () => {
            const id = btn.dataset.id;
            if (!confirm("Delete this user?")) return;
            try {
                const res = await fetch(`/admin/users/${id}`, {
                    method: "DELETE",
                    headers: {"X-CSRF-TOKEN": csrf, "Accept": "application/json"}
                });
                const data = await res.json();
                if (data.status === "success") {
                    document.getElementById("user-row-" + id).remove();
                    alert(data.message);
                } else {
                    alert(data.message || "Error");
                }
            } catch (e) {
                alert("Something went wrong.");
            }
        });
    });
});
</script>
@endsection
