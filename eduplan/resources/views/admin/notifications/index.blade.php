@extends('layouts.app')

@section('title', 'Admin Notifications')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">📩 Course Submission Notifications</h2>

    {{-- ✅ Success/Error Alert --}}
    <div id="alert-box" class="alert d-none shadow-sm"></div>

    @if($notifications->isEmpty())
        <div class="alert alert-info text-center shadow-sm">
            📭 No notifications right now.
        </div>
    @else
        <div class="row g-4">
            @foreach($notifications as $notification)
                @php
                    $courseId = $notification->data['course_id'] ?? null;
                    $course = $courseId ? \App\Models\Course::find($courseId) : null;
                    $title = $course->title ?? 'Untitled Course';
                    $instructor = $notification->data['instructor'] ?? 'Unknown';
                    $courseStatus = $course->status ?? 'pending';
                @endphp

                <div class="col-12 col-md-6 col-lg-4" id="notification-{{ $notification->id }}">
                    <div class="card shadow-sm border-0 h-100 notification-card">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title fw-bold">{{ $title }}</h5>
                                <p class="mb-1 text-muted">Submitted by <em>{{ $instructor }}</em></p>
                                <p class="mb-1 text-secondary">Received {{ $notification->created_at->diffForHumans() }}</p>
                                <span class="badge status-badge
                                    @if($courseStatus == 'approved') bg-success
                                    @elseif($courseStatus == 'rejected') bg-danger
                                    @else bg-warning text-dark
                                    @endif
                                ">
                                    {{ ucfirst($courseStatus) }}
                                </span>
                            </div>

                            <div class="mt-3 d-flex gap-2 flex-wrap action-buttons">
                                @if(!$notification->read_at && $course)
                                    <button class="btn btn-success btn-sm flex-fill btn-approve" data-id="{{ $notification->id }}">
                                        Approve
                                    </button>
                                    <button class="btn btn-danger btn-sm flex-fill btn-reject" data-id="{{ $notification->id }}">
                                        Reject
                                    </button>
                                @endif
                                <button class="btn btn-outline-secondary btn-sm flex-fill btn-delete" data-id="{{ $notification->id }}">
                                    Delete
                                </button>

                                @if($notification->read_at || !$course)
                                    <span class="badge bg-secondary w-100 text-center mt-2">Reviewed</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    @endif
</div>

{{-- ===== STYLES ===== --}}
<style>
.notification-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.notification-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
.card-title { font-size: 1.2rem; }
.action-buttons .btn { min-width: 100px; }
.action-buttons .badge { margin-top: 5px; }
@media (max-width: 576px) {
    .notification-card .btn { font-size: 0.85rem; }
}
</style>

{{-- ===== AJAX ===== --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    const alertBox = document.getElementById("alert-box");

    function showAlert(type, message) {
        alertBox.className = "alert alert-" + type + " shadow-sm";
        alertBox.textContent = message;
        alertBox.classList.remove("d-none");
        setTimeout(() => alertBox.classList.add("d-none"), 3000);
    }

    async function handleAction(id, action) {
        try {
            const response = await fetch(`/admin/notifications/${id}/${action}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            });

            const data = await response.json();

            if (data.status === "success") {
                showAlert("success", data.message);

                const card = document.getElementById("notification-" + id);
                const badge = card.querySelector(".status-badge");
                const actionBtns = card.querySelector(".action-buttons");

                if(action === "approve" || action === "reject") {
                    badge.textContent = data.course_status.charAt(0).toUpperCase() + data.course_status.slice(1);
                    badge.className = "badge status-badge " + 
                        (data.course_status === "approved" ? "bg-success" : "bg-danger");
                    actionBtns.innerHTML = `<span class="badge bg-secondary w-100 text-center">Reviewed</span>`;
                } else if(action === "delete") {
                    card.remove();
                }
            } else {
                showAlert("danger", data.message);
            }
        } catch (error) {
            console.error(error);
            showAlert("danger", "Something went wrong!");
        }
    }

    // Approve
    document.querySelectorAll(".btn-approve").forEach(btn => {
        btn.addEventListener("click", () => handleAction(btn.dataset.id, "approve"));
    });

    // Reject
    document.querySelectorAll(".btn-reject").forEach(btn => {
        btn.addEventListener("click", () => handleAction(btn.dataset.id, "reject"));
    });

    // Delete
    document.querySelectorAll(".btn-delete").forEach(btn => {
        btn.addEventListener("click", () => {
            if(confirm("Are you sure you want to delete this notification?")) {
                handleAction(btn.dataset.id, "delete");
            }
        });
    });
});
</script>
@endsection
    