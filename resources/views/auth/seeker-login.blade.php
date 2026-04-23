@extends('layouts.app')

@section('title', 'Seeker Login - HandymanPro')

@section('content')
<div class="container-fluid">
    <div class="row min-vh-100">
        <!-- Left Side -->
        <div class="col-lg-5 d-none d-lg-flex flex-column justify-content-center text-white p-5" 
             style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);">
            <div class="mb-4">
                <i class="bi bi-tools fs-1"></i>
            </div>
            <h1 class="display-5 fw-bold mb-4">Welcome Back!</h1>
            <p class="lead mb-5 opacity-75">Book trusted home services in minutes.</p>
            
            <div class="d-flex flex-column gap-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-20 rounded-3 p-2">
                        <i class="bi bi-shield-check fs-4"></i>
                    </div>
                    <div>
                        <div class="fw-semibold">Verified Professionals</div>
                        <div class="small opacity-75">Background checked</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-20 rounded-3 p-2">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                    <div>
                        <div class="fw-semibold">Real-time Tracking</div>
                        <div class="small opacity-75">Know when they arrive</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Side -->
        <div class="col-lg-7 d-flex align-items-center justify-content-center p-4 bg-light">
            <div style="max-width: 450px; width: 100%;">
                <div class="text-center mb-4">
                    <a href="/" class="d-inline-flex align-items-center gap-2 text-decoration-none mb-3">
                        <div class="bg-primary rounded-2 p-2">
                            <i class="bi bi-tools text-white fs-5"></i>
                        </div>
                        <span class="fw-bold fs-4 text-dark">Handyman<span class="text-primary">Pro</span></span>
                    </a>
                    <h2 class="fw-bold mb-1">Sign In</h2>
                    <p class="text-secondary">Access your account</p>
                </div>
                
                @if(session('error'))
                <div class="alert alert-danger rounded-3 d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ session('error') }}
                </div>
                @endif
                
                <form method="POST" action="{{ route('seeker.login.post') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-secondary">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-envelope text-secondary"></i>
                            </span>
                            <input type="email" name="email" class="form-control-hp border-start-0" 
                                   placeholder="name@example.com" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-secondary">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-lock text-secondary"></i>
                            </span>
                            <input type="password" name="password" class="form-control-hp border-start-0 border-end-0" 
                                   placeholder="Enter password" required>
                            <span class="input-group-text bg-white border-start-0">
                                <i class="bi bi-eye text-secondary"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label small text-secondary" for="remember">Remember me</label>
                        </div>
                        <a href="#" class="text-primary text-decoration-none small fw-semibold">Forgot Password?</a>
                    </div>
                    
                    <button type="submit" class="btn btn-hp-primary w-100 py-3 mb-3">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                    </button>
                    
                    <div class="text-center">
                        <p class="text-secondary">
                            Don't have an account? 
                            <a href="{{ route('seeker.register') }}" class="text-primary fw-semibold text-decoration-none">Sign Up</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection