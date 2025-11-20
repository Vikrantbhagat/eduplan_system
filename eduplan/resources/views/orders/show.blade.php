@extends('layouts.app')
@section('title', 'Order #' . $order->id)

@section('content')
<div class="container py-5">
    <h2>Order #{{ $order->id }} — {{ ucfirst($order->payment_status) }}</h2>

    <div class="card p-3 mb-3">
        <p><strong>Amount paid:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
        <p><strong>Payment ID (Stripe):</strong> {{ $order->stripe_payment_id }}</p>
        <p><strong>Placed at:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
    </div>

    <h4>Courses purchased</h4>
    <ul class="list-group mb-3">
        @foreach($courses as $course)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div>
                    <div class="fw-bold">{{ $course->title }}</div>
                    <small class="text-muted">{{ $course->short_description ?? '' }}</small>
                </div>
                <span>₹{{ number_format($course->fees ?? 0, 2) }}</span>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('cart.index') }}" class="btn btn-secondary">Back to courses</a>
</div>
@endsection
