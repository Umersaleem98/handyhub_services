@extends('layouts.app')

@section('title', 'Admin Dashboard - HandymanPro')

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar-hp d-none d-lg-flex flex-column">
        <div class="p-4 border-bottom border-secondary">
            <a href="/" class="d-flex align-items-center gap-2 text-decoration-none">
                <div class="bg-primary rounded-2 p-2">
                    <i class="bi bi-tools text-white fs-5"></i>
                </div>
                <span class="fw-bold fs-5 text-white">Handyman<span class="text-primary">Pro</span></span>
            </a>
        </div>
        
        <div class="nav flex-column py-3 flex-grow-1">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('admin.verifications.pending') }}" class="nav-link">
                <i class="bi bi-shield-check"></i> Verifications
                @php
                    $pendingCount = \App\Models\VerificationDocument::where('status', 'pending')->count();
                @endphp
                @if($pendingCount > 0)
                    <span class="badge bg-danger ms-auto">{{ $pendingCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.users') }}" class="nav-link">
                <i class="bi bi-people"></i> Users
            </a>
            <a href="#" class="nav-link">
                <i class="bi bi-grid"></i> Categories
            </a>
            <a href="#" class="nav-link">
                <i class="bi bi-calendar-check"></i> Bookings
            </a>
            <a href="#" class="nav-link">
                <i class="bi bi-graph-up"></i> Analytics
            </a>
            <a href="#" class="nav-link">
                <i class="bi bi-gear"></i> Settings
            </a>
        </div>
        
        <div class="p-4 border-top border-secondary">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="bg-white bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="bi bi-person text-white"></i>
                </div>
                <div class="text-white">
                    <div class="fw-semibold small">{{ auth()->user()->name }}</div>
                    <div class="text-secondary" style="font-size: 0.75rem;">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm w-100">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Mobile Sidebar Toggle -->
    <div class="d-lg-none position-fixed top-0 start-0 p-3 z-3">
        <button class="btn btn-dark" onclick="document.querySelector('.sidebar-hp').classList.toggle('d-none'); document.querySelector('.sidebar-hp').classList.toggle('d-flex');">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <!-- Top Bar -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Dashboard</h2>
                <p class="text-secondary mb-0">Platform Overview</p>
            </div>
            <div class="text-secondary small">
                <i class="bi bi-calendar3 me-2"></i>{{ now()->format('F d, Y') }}
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-circle-fill"></i>
            {{ session('error') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Stats Row -->
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="stat-card-hp">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success">+12%</span>
                    </div>
                    <div class="fw-bold fs-2">{{ $stats['users']['total'] ?? 0 }}</div>
                    <div class="text-secondary small">Total Users</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card-hp" style="--hp-primary: var(--hp-success);">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="bg-success bg-opacity-10 text-success rounded-3 p-2">
                            <i class="bi bi-briefcase fs-4"></i>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success">+8%</span>
                    </div>
                    <div class="fw-bold fs-2">{{ $stats['bookings']['completed'] ?? 0 }}</div>
                    <div class="text-secondary small">Completed Jobs</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card-hp" style="--hp-primary: var(--hp-warning);">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-2">
                            <i class="bi bi-currency-dollar fs-4"></i>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success">+24%</span>
                    </div>
                    <div class="fw-bold fs-2">Rs. {{ number_format($stats['revenue']['today'] ?? 0) }}</div>
                    <div class="text-secondary small">Today's Revenue</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card-hp" style="--hp-primary: var(--hp-danger);">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-2">
                            <i class="bi bi-shield-exclamation fs-4"></i>
                        </div>
                        @if(($stats['verifications']['pending'] ?? 0) > 0)
                            <span class="badge bg-danger">{{ $stats['verifications']['pending'] }}</span>
                        @endif
                    </div>
                    <div class="fw-bold fs-2">{{ $stats['verifications']['pending'] ?? 0 }}</div>
                    <div class="text-secondary small">Pending Verifications</div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Platform Overview -->
            <div class="col-lg-8">
                <div class="card-hp p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Platform Overview</h5>
                        <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-4 text-center p-3 bg-light rounded-3">
                            <div class="fw-bold fs-3 text-primary">{{ $stats['users']['seekers'] ?? 0 }}</div>
                            <div class="text-secondary small">Service Seekers</div>
                        </div>
                        <div class="col-md-4 text-center p-3 bg-light rounded-3">
                            <div class="fw-bold fs-3 text-success">{{ $stats['users']['providers'] ?? 0 }}</div>
                            <div class="text-secondary small">Service Providers</div>
                        </div>
                        <div class="col-md-4 text-center p-3 bg-light rounded-3">
                            <div class="fw-bold fs-3 text-warning">{{ $stats['bookings']['pending'] ?? 0 }}</div>
                            <div class="text-secondary small">Pending Bookings</div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <h6 class="fw-bold mb-3">Top Services</h6>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr class="text-secondary small text-uppercase">
                                    <th>Service</th>
                                    <th>Requests</th>
                                    <th>Trend</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stats['top_services'] ?? [] as $service)
                                <tr>
                                    <td class="fw-semibold">{{ $service->name }}</td>
                                    <td>{{ $service->count }}</td>
                                    <td>
                                        <div class="progress" style="height: 6px; width: 100px;">
                                            <div class="progress-bar bg-success" style="width: {{ min(100, $service->count * 5) }}%"></div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-secondary py-3">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="col-lg-4">
                <div class="card-hp p-4">
                    <h5 class="fw-bold mb-4">Quick Actions</h5>
                    
                    <div class="d-flex flex-column gap-3">
                        <a href="{{ route('admin.verifications.pending') }}" class="btn btn-outline-primary d-flex align-items-center gap-3 p-3 text-start">
                            <i class="bi bi-shield-check fs-4"></i>
                            <div>
                                <div class="fw-semibold">Review Verifications</div>
                                <div class="small text-secondary">{{ $stats['verifications']['pending'] ?? 0 }} pending</div>
                            </div>
                        </a>
                        
                        <a href="{{ route('admin.users') }}" class="btn btn-outline-success d-flex align-items-center gap-3 p-3 text-start">
                            <i class="bi bi-people fs-4"></i>
                            <div>
                                <div class="fw-semibold">Manage Users</div>
                                <div class="small text-secondary">{{ $stats['users']['total'] ?? 0 }} total users</div>
                            </div>
                        </a>
                        
                        <a href="#" class="btn btn-outline-warning d-flex align-items-center gap-3 p-3 text-start">
                            <i class="bi bi-grid fs-4"></i>
                            <div>
                                <div class="fw-semibold">Service Categories</div>
                                <div class="small text-secondary">Manage services</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection