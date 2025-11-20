@extends('layouts.app')
@section('title','Instructor Courses')
@section('content')

<div class="container py-5">

    <h2 class="mb-4">{{ $instructor->name }}'s Courses</h2>

    {{-- Success message placeholder --}}
    <div id="success-msg-container"></div>

    @if($courses->isEmpty())
        <div class="alert alert-info">No courses found for this instructor.</div>
    @else
        <div class="row g-3">
            @foreach($courses as $course)
                <div class="col-md-4" id="course-card-{{ $course->id }}">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title" id="course-title-{{ $course->id }}">{{ $course->title }}</h5>
                            <p class="card-text mb-2">
                                Status:
                                <span id="course-status-{{ $course->id }}" class="badge {{ $course->status=='approved'?'bg-success':($course->status=='pending'?'bg-warning':'bg-danger') }}">
                                    {{ ucfirst($course->status) }}
                                </span>
                            </p>
                            <p class="card-text" id="course-desc-{{ $course->id }}">{{ Str::limit($course->description,100) }}</p>
                            <div class="mt-auto d-flex gap-2">
                                <button class="btn btn-sm btn-primary btn-edit-course" data-id="{{ $course->id }}">Edit</button>
                                <button class="btn btn-sm btn-danger btn-delete-course" data-id="{{ $course->id }}">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Hidden inline edit form --}}
                <div class="col-md-4 d-none" id="edit-form-{{ $course->id }}">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body">
                            <h5>Edit Course</h5>
                            <form class="edit-course-form" data-id="{{ $course->id }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-2">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $course->title }}" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="3" required>{{ $course->description }}</textarea>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="approved" {{ $course->status=='approved'?'selected':'' }}>Approved</option>
                                        <option value="pending" {{ $course->status=='pending'?'selected':'' }}>Pending</option>
                                        <option value="rejected" {{ $course->status=='rejected'?'selected':'' }}>Rejected</option>
                                    </select>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                                    <button type="button" class="btn btn-secondary btn-sm btn-cancel-edit" data-id="{{ $course->id }}">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    @endif

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-4">Back to Dashboard</a>

</div>

{{-- AJAX functionality --}}
<script>
document.addEventListener("DOMContentLoaded",()=>{
    const csrfToken = "{{ csrf_token() }}";

    // 🔹 Edit button -> show form
    document.querySelectorAll(".btn-edit-course").forEach(btn=>{
        btn.addEventListener("click",()=>{
            const id = btn.dataset.id;
            document.getElementById(`course-card-${id}`).classList.add("d-none");
            document.getElementById(`edit-form-${id}`).classList.remove("d-none");
        });
    });

    // 🔹 Cancel button -> hide form
    document.querySelectorAll(".btn-cancel-edit").forEach(btn=>{
        btn.addEventListener("click",()=>{
            const id = btn.dataset.id;
            document.getElementById(`edit-form-${id}`).classList.add("d-none");
            document.getElementById(`course-card-${id}`).classList.remove("d-none");
        });
    });

    // 🔹 Save (AJAX update)
    document.querySelectorAll(".edit-course-form").forEach(form=>{
        form.addEventListener("submit",async(e)=>{
            e.preventDefault();
            const id = form.dataset.id;
            const formData = new FormData(form);

            const res = await fetch(`/admin/courses/${id}`,{
                method:"POST",
                headers:{"X-CSRF-TOKEN":csrfToken,"Accept":"application/json","X-HTTP-Method-Override":"PUT"},
                body:formData
            });
            const data = await res.json();

            if(data.status==="success"){
                // Update UI
                document.getElementById(`course-title-${id}`).innerText = data.course.title;
                document.getElementById(`course-desc-${id}`).innerText = data.course.description.substring(0,100);
                const statusEl = document.getElementById(`course-status-${id}`);
                statusEl.innerText = data.course.status.charAt(0).toUpperCase() + data.course.status.slice(1);
                statusEl.className = "badge " + (data.course.status==="approved"?"bg-success":(data.course.status==="pending"?"bg-warning":"bg-danger"));

                // Hide form, show card
                document.getElementById(`edit-form-${id}`).classList.add("d-none");
                document.getElementById(`course-card-${id}`).classList.remove("d-none");

                // Show success message
                document.getElementById("success-msg-container").innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show">
                        ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>`;
            }
        });
    });

    // 🔹 Delete (AJAX)
    document.querySelectorAll(".btn-delete-course").forEach(btn=>{
        btn.addEventListener("click",async()=>{
            const id=btn.dataset.id;
            if(confirm("Are you sure you want to delete this course?")){
                const res=await fetch(`/admin/courses/${id}`,{
                    method:"DELETE",
                    headers:{"X-CSRF-TOKEN":csrfToken,"Accept":"application/json"}
                });
                const data=await res.json();
                if(data.status==="success"){
                    document.getElementById(`course-card-${id}`).remove();
                    document.getElementById(`edit-form-${id}`)?.remove();
                    document.getElementById("success-msg-container").innerHTML = `
                        <div class="alert alert-success alert-dismissible fade show">
                            ${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>`;
                }
            }
        });
    });
});
</script>

@endsection
