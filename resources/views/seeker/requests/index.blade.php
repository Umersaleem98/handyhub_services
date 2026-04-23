@extends('layouts.app')

@section('title', 'My Requests - HandymanPro')

@section('content')
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('seeker.dashboard') }}">
            <i class="bi bi-arrow-left me-2"></i>My Requests
        </a>
        <a href="{{ route('seeker.requests.create') }}" class="btn btn-hp-primary btn-sm">
            <i class="bi bi-plus-lg me-2"></i>New Request
        </a>
    </div>
</nav>

<div class="container py-5">
    <div class="card-hp p-4">
        <h4 class="fw-bold mb-4">All Requests</h4>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Service</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $request)
                    <tr>
                        <td>{{ $request->category->name ?? 'N/A' }}</td>
                        <td>{{ Str::limit($request->description, 50) }}</td>
                        <td>{{ $request->created_at->format('M d, Y') }}</td>
                        <td>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary">{{ ucfirst($request->status) }}</span>
                        </td>
                        <td>
                            @if($request->status === 'published')
                            <a href="{{ route('seeker.requests.quotes', $request) }}" class="btn btn-sm btn-primary">View Quotes</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-secondary">No requests found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $requests->links() }}
    </div>
</div>
@endsection