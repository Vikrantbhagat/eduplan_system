@extends('layouts.app')

@section('title', 'EduPlan Analytics')

@section('content')
<style>
/* ==== Modern Analytics Dashboard Styles ==== */
.analytics-header {
    font-weight: 700;
    color: #0d6efd;
    letter-spacing: 0.5px;
}

.analytics-container {
    background: linear-gradient(135deg, #f9fbfd, #eef2f7);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

/* Stat Cards */
.analytics-card {
    border: none;
    border-radius: 15px;
    color: #fff;
    transition: all 0.3s ease-in-out;
    position: relative;
    overflow: hidden;
}
.analytics-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
.analytics-card .card-body {
    z-index: 2;
    position: relative;
}
.analytics-card::before {
    content: '';
    position: absolute;
    inset: 0;
    opacity: 0.25;
    background: radial-gradient(circle at top left, #fff, transparent);
}

/* Gradient backgrounds */
.bg-students { background: linear-gradient(135deg, #007bff, #00b4d8); }
.bg-instructors { background: linear-gradient(135deg, #28a745, #20c997); }
.bg-courses { background: linear-gradient(135deg, #ffc107, #ff8800); }
.bg-revenue { background: linear-gradient(135deg, #dc3545, #f87171); }

/* Chart Card */
.chart-card {
    border-radius: 20px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 6px 25px rgba(0,0,0,0.1);
}
</style>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="analytics-header display-6">📊 EduPlan Analytics Dashboard</h2>
        <p class="text-muted">Track students, instructors, courses, and revenue insights in real time</p>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
            ← Back
        </a>
        <a href="{{ url()->previous() }}" class="btn btn-dark mt-3">← Go Back</a>

    </div>

    <!-- Stats Section -->
    <div class="analytics-container mb-5">
        <div class="row g-4 text-center">
            <div class="col-md-3 col-6">
                <div class="card analytics-card bg-students">
                    <div class="card-body">
                        <h5 class="fw-bold">👨‍🎓 Students</h5>
                        <h2 class="fw-bold mt-2">{{ $totalStudents }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card analytics-card bg-instructors">
                    <div class="card-body">
                        <h5 class="fw-bold">🧑‍🏫 Instructors</h5>
                        <h2 class="fw-bold mt-2">{{ $totalInstructors }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card analytics-card bg-courses">
                    <div class="card-body">
                        <h5 class="fw-bold">📚 Courses</h5>
                        <h2 class="fw-bold mt-2">{{ $totalCourses }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card analytics-card bg-revenue">
                    <div class="card-body">
                        <h5 class="fw-bold">💰 Total Revenue</h5>
                        <h2 class="fw-bold mt-2">₹{{ number_format($totalRevenue, 2) }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="chart-card p-4">
        <h4 class="mb-4 text-center fw-bold text-dark">📈 Monthly Revenue & Purchases Overview</h4>
        <canvas id="analyticsChart" height="120"></canvas>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('analyticsChart').getContext('2d');

const months = {!! json_encode($months) !!};
const revenues = {!! json_encode($revenues) !!};
const purchases = {!! json_encode($purchaseCounts) !!};

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: months,
        datasets: [
            {
                label: 'Revenue (₹)',
                data: revenues,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                borderRadius: 8,
                yAxisID: 'y',
            },
            {
                label: 'Purchases',
                type: 'line',
                data: purchases,
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.3)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                yAxisID: 'y1',
            }
        ]
    },
    options: {
        responsive: true,
        interaction: { mode: 'index', intersect: false },
        stacked: false,
        scales: {
            y: {
                beginAtZero: true,
                title: { display: true, text: 'Revenue (₹)' },
                grid: { color: '#f0f0f0' }
            },
            y1: {
                beginAtZero: true,
                position: 'right',
                title: { display: true, text: 'Purchases' },
                grid: { drawOnChartArea: false }
            }
        },
        plugins: {
            legend: { position: 'top' },
            tooltip: {
                backgroundColor: '#fff',
                titleColor: '#000',
                bodyColor: '#000',
                borderColor: '#ddd',
                borderWidth: 1
            }
        }
    }
});
</script>
@endsection
