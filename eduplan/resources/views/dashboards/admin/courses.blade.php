@extends('layouts.app')
@section('title','Instructor Courses')
@section('content')

<div class="container py-5">
    <h2 class="mb-4">{{ $instructor->name }}'s Courses</h2>

    {{-- Flash Success / Error Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" id="flash-success">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" id="flash-error">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($courses->isEmpty())
        <div class="alert alert-info">No courses found for this instructor.</div>
    @else
        <div class="row g-3">
            @foreach($courses as $course)
                <div class="col-md-4" id="course-card-{{ $course->id }}">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text mb-2">
                                Status:
                                <span class="badge {{ $course->status=='approved'?'bg-success':($course->status=='pending'?'bg-warning':'bg-danger') }}">
                                    {{ ucfirst($course->status) }}
                                </span>
                            </p>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($course->description,100) }}</p>
                            <div class="mt-auto d-flex gap-2">
                                    <a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-sm btn-info">View</a>

                                <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <button class="btn btn-sm btn-danger btn-delete-course" data-id="{{ $course->id }}">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-4">Back to Dashboard</a>
</div>

{{-- Scripts --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    const csrf = "{{ csrf_token() }}";

    // AJAX Delete Course
    document.querySelectorAll(".btn-delete-course").forEach(btn => {
        btn.addEventListener("click", async () => {
            const id = btn.dataset.id;
            if (!confirm("Delete this course?")) return;

            try {
                const res = await fetch(`/admin/courses/${id}`, {
                    method: "DELETE",
                    headers: {"X-CSRF-TOKEN": csrf, "Accept": "application/json"}
                });
                const data = await res.json();

                if (data.status === "success") {
                    document.getElementById("course-card-" + id).remove();

                    // Show dynamic success alert
                    const container = document.createElement('div');
                    container.innerHTML = `<div class="alert alert-success alert-dismissible fade show mt-3">${data.message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>`;
                    document.querySelector('.container').prepend(container);

                    // Auto close after 3 seconds
                    setTimeout(() => {
                        const alert = container.querySelector('.alert');
                        if(alert){
                            alert.classList.remove('show');
                            alert.classList.add('hide');
                        }
                    }, 3000);
                } else {
                    alert(data.message || "Error");
                }
            } catch (e) {
                console.error(e);
                alert("Something went wrong.");
            }
        });
    });

    // Auto-close flash messages
    const flashMessages = document.querySelectorAll('#flash-success, #flash-error');
    flashMessages.forEach(flash => {
        setTimeout(() => {
            flash.classList.remove('show');
            flash.classList.add('hide');
        }, 3000); // 3 seconds
    });
});
</script>

@endsection
