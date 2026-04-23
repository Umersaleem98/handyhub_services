@extends('layouts.app')

@section('title', 'My Dashboard - HandymanPro')

@section('content')
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            <div class="bg-primary rounded-2 p-2">
                <i class="bi bi-tools text-white fs-5"></i>
            </div>
            <span class="fw-bold fs-4">Handyman<span class="text-primary">Pro</span></span>
        </a>
        
        <div class="collapse navbar-collapse" id="seekerNav">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item"><a class="nav-link active" href="{{ route('seeker.dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('seeker.requests.index') }}">Requests</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('seeker.bookings') }}">Bookings</a></li>
                <li class="nav-item">
                    <a href="{{ route('seeker.requests.create') }}" class="btn btn-hp-primary btn-sm">
                        <i class="bi bi-plus-lg me-2"></i>New Request
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=3b82f6&color=fff" 
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
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card-hp">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2">
                        <i class="bi bi-file-text fs-4"></i>
                    </div>
                </div>
                <div class="fw-bold fs-2">{{ $stats['total_requests'] }}</div>
                <div class="text-secondary small">Total Requests</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card-hp" style="--hp-primary: var(--hp-warning);">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-2">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                </div>
                <div class="fw-bold fs-2">{{ $stats['active_bookings'] }}</div>
                <div class="text-secondary small">Active Bookings</div>
            </div>
        </div>
        <div class="col-md-4">
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
    </div>

    @if($activeBookings->count() > 0)
    <div class="card-hp p-4 mb-4">
        <h5 class="fw-bold mb-4">Active Bookings</h5>
        @foreach($activeBookings as $booking)
        <div class="d-flex align-items-center gap-4 p-3 bg-light rounded-3 mb-3">
            <div class="bg-white rounded-3 p-3">
                <i class="bi bi-tools text-primary fs-2"></i>
            </div>
            <div class="flex-grow-1">
                <div class="fw-bold">{{ $booking->serviceRequest->category->name ?? 'Service' }}</div>
                <div class="text-secondary small">
                    <i class="bi bi-person me-1"></i>{{ $booking->provider->name ?? 'Provider' }}
                </div>
            </div>
            <div class="text-end">
                <span class="badge bg-{{ $booking->status->color() }} bg-opacity-10 text-{{ $booking->status->color() }} mb-2">
                    {{ $booking->status->label() }}
                </span>
                <div class="fw-bold">Rs. {{ number_format($booking->total_amount) }}</div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <div class="card-hp p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">Recent Requests</h5>
            <a href="{{ route('seeker.requests.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        
        @forelse($recentRequests as $request)
        <div class="d-flex align-items-center gap-4 p-3 border-bottom">
            <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                <i class="bi bi-tools fs-4"></i>
            </div>
            <div class="flex-grow-1">
                <div class="fw-bold">{{ $request->category->name ?? 'Service' }}</div>
                <div class="text-secondary small">{{ Str::limit($request->description, 50) }}</div>
            </div>
            <div class="text-end">
                <span class="badge bg-secondary bg-opacity-10 text-secondary">{{ ucfirst($request->status) }}</span>
                <div class="small text-secondary mt-1">{{ $request->created_at->diffForHumans() }}</div>
            </div>
        </div>
        @empty
        <div class="text-center py-4 text-secondary">
            <i class="bi bi-inbox fs-1 mb-2 d-block"></i>
            <p>No requests yet. <a href="{{ route('seeker.requests.create') }}">Create one now</a></p>
        </div>
        @endforelse
    </div>
</div>
@endsection