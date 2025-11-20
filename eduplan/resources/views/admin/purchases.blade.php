@extends('layouts.app')

@section('title', 'All Purchases')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">💳 All Course Purchase Transactions</h2>
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">← Go Back</a>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($purchases->isEmpty())
        <div class="alert alert-info">No purchases have been made yet.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Course Name</th>
                    <th>Purchase Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->id }}</td>
                        <td>{{ $purchase->user->name ?? 'Unknown' }}</td>
                        <td>{{ $purchase->course->title ?? 'Deleted Course' }}</td>
                        <td>{{ $purchase->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
