@extends('layouts.app')
@section('title', 'Admin - Transaction History')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center text-md-start">💰 Course Purchase Transactions</h2>

    <div class="table-responsive shadow-sm rounded-3">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Course Title</th>
                    <th>Purchased On</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchases as $purchase)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $purchase->user->name ?? 'N/A' }}</td>
                        <td>{{ $purchase->user->email ?? 'N/A' }}</td>
                        <td>{{ $purchase->course->title ?? 'N/A' }}</td>
                        <td>{{ $purchase->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">No transactions found yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
