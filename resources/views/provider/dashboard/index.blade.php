@extends('layouts.app')

@section('title', 'Provider Dashboard - HandymanPro')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            <div class="bg-primary rounded-2 p-2">
                <i class="bi bi-tools text-white fs-5"></i>
            </div>
            <span class="fw-bold fs-4">Handyman<span class="text-primary">Pro</span></span>
        </a>
        
        <div class="collapse navbar-collapse" id="providerNav">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item"><a class="nav-link active" href="{{ route('provider.dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('provider.bookings') }}">Bookings</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=f97316&color=fff" 
                             class="rounded-circle" width="32" height="32">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">
    @if(!$verificationProgress['is_fully_verified'])
    <div class="alert alert-warning rounded-3 d-flex align-items-center gap-3 mb-4">
        <i class="bi bi-exclamation-triangle-fill fs-4"></i>
        <div class="flex-grow-1">
            <div class="fw-bold">Complete Verification</div>
            <div class="small">Upload documents to receive bookings.</div>
            <div class="progress mt-2" style="height: 8px;">
                <div class="progress-bar bg-warning" style="width: {{ $verificationProgress['percentage'] }}%"></div>
            </div>
        </div>
        <a href="{{ route('provider.documents.upload') }}" class="btn btn-warning">Complete</a>
    </div>
    @endif

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card-hp">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2">
                        <i class="bi bi-calendar-check fs-4"></i>
                    </div>
                </div>
                <div class="fw-bold fs-2">{{ $stats['total_bookings'] }}</div>
                <div class="text-secondary small">Total Bookings</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card-hp" style="--hp-primary: var(--hp-success);">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-2">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                </div>
                <div class="fw-bold fs-2">{{ $stats['completed_jobs'] }}</div>
                <div class="text-secondary small">Completed</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card-hp" style="--hp-primary: var(--hp-warning);">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-2">
                        <i class="bi bi-star-fill fs-4"></i>
                    </div>
                </div>
                <div class="fw-bold fs-2">{{ number_format($stats['rating'], 1) }}</div>
                <div class="text-secondary small">Rating</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card-hp" style="--hp-primary: var(--hp-secondary);">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2">
                        <i class="bi bi-wallet2 fs-4"></i>
                    </div>
                </div>
                <div class="fw-bold fs-2">Rs. {{ number_format($stats['earnings']) }}</div>
                <div class="text-secondary small">Earnings</div>
            </div>
        </div>
    </div>

    <div class="card-hp p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">Recent Bookings</h5>
            <a href="{{ route('provider.bookings') }}" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Service</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBookings as $booking)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $booking->serviceRequest->category->name ?? 'N/A' }}</div>
                        </td>
                        <td>{{ $booking->seeker->name ?? 'N/A' }}</td>
                        <td>{{ $booking->created_at->format('M d, Y') }}</td>
                        <td class="fw-semibold">Rs. {{ number_format($booking->agreed_price) }}</td>
                        <td>
                            <span class="badge bg-{{ $booking->status->color() }} bg-opacity-10 text-{{ $booking->status->color() }}">
                                {{ $booking->status->label() }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-secondary">No bookings yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection