@extends('layouts.app')

@section('title', 'Provider Login - HandymanPro')

@section('content')
<div class="container-fluid">
    <div class="row min-vh-100">
        <div class="col-lg-5 d-none d-lg-flex flex-column justify-content-center text-white p-5" 
             style="background: linear-gradient(135deg, #1f2937 0%, #111827 100%);">
            <div class="mb-4">
                <i class="bi bi-briefcase fs-1"></i>
            </div>
            <h1 class="display-5 fw-bold mb-4">Welcome Back, Provider!</h1>
            <p class="lead mb-5 opacity-75">Manage your services and grow your business.</p>
        </div>
        
        <div class="col-lg-7 d-flex align-items-center justify-content-center p-4 bg-light">
            <div style="max-width: 450px; width: 100%;">
                <div class="text-center mb-4">
                    <h2 class="fw-bold mb-1">Provider Sign In</h2>
                    <p class="text-secondary">Access your provider dashboard</p>
                </div>
                
                @if(session('error'))
                <div class="alert alert-danger rounded-3">
                    {{ session('error') }}
                </div>
                @endif
                
                <form method="POST" action="{{ route('provider.login.post') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-secondary">Email</label>
                        <input type="email" name="email" class="form-control-hp" placeholder="name@example.com" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold small text-secondary">Password</label>
                        <input type="password" name="password" class="form-control-hp" placeholder="Enter password" required>
                    </div>
                    
                    <button type="submit" class="btn btn-hp-primary w-100 py-3 mb-3">
                        Sign In
                    </button>
                    
                    <div class="text-center">
                        <p class="text-secondary">
                            New provider? 
                            <a href="{{ route('provider.register') }}" class="text-primary fw-semibold text-decoration-none">Register</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection