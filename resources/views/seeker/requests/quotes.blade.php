@extends('layouts.app')

@section('title', 'Quotes - HandymanPro')

@section('content')
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('seeker.requests.index') }}">
            <i class="bi bi-arrow-left me-2"></i>Back to Requests
        </a>
    </div>
</nav>

<div class="container py-5">
    <div class="card-hp p-4">
        <h4 class="fw-bold mb-2">Quotes for Request</h4>
        <p class="text-secondary mb-4">{{ Str::limit($serviceRequest->description, 100) }}</p>
        
        @if(session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
        @endif
        
        <div class="row g-4">
            @forelse($quotes as $quote)
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($quote->provider->name) }}&background=f97316&color=fff" 
                                 class="rounded-circle" width="48" height="48">
                            <div>
                                <div class="fw-bold">{{ $quote->provider->name }}</div>
                                <div class="small text-secondary">
                                    <i class="bi bi-star-fill text-warning"></i> 
                                    {{ number_format($quote->provider->providerProfile->rating ?? 0, 1) }}
                                    ({{ $quote->provider->providerProfile->total_reviews ?? 0 }} reviews)
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="fw-bold text-primary fs-4">Rs. {{ number_format($quote->proposed_price) }}</div>
                            <div class="text-secondary small">Estimated: {{ $quote->estimated_duration ?? 'N/A' }}</div>
                        </div>
                        
                        @if($quote->message)
                        <p class="text-secondary small mb-3">"{{ $quote->message }}"</p>
                        @endif
                        
                        <form method="POST" action="{{ route('seeker.requests.accept-quote', $serviceRequest) }}">
                            @csrf
                            <input type="hidden" name="quote_id" value="{{ $quote->id }}">
                            <button type="submit" class="btn btn-hp-primary w-100">
                                <i class="bi bi-check-lg me-2"></i>Accept Quote
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5 text-secondary">
                <i class="bi bi-inbox fs-1 mb-3 d-block"></i>
                <p>No quotes yet. Providers will send quotes soon.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection