@extends('layouts.app')

@section('title', 'My Bookings - HandymanPro')

@section('content')
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('seeker.dashboard') }}">
            <i class="bi bi-arrow-left me-2"></i>My Bookings
        </a>
    </div>
</nav>

<div class="container py-5">
    <div class="card-hp p-4">
        <h4 class="fw-bold mb-4">All Bookings</h4>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Service</th>
                        <th>Provider</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td>{{ $booking->serviceRequest->category->name ?? 'N/A' }}</td>
                        <td>{{ $booking->provider->name ?? 'N/A' }}</td>
                        <td>{{ $booking->created_at->format('M d, Y') }}</td>
                        <td>Rs. {{ number_format($booking->total_amount) }}</td>
                        <td>
                            <span class="badge bg-{{ $booking->status->color() }} bg-opacity-10 text-{{ $booking->status->color() }}">
                                {{ $booking->status->label() }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-secondary">No bookings found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $bookings->links() }}
    </div>
</div>
@endsection