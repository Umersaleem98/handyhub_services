@extends('layouts.app')

@section('title', 'Seeker Registration - HandymanPro')

@section('content')
<div class="min-vh-100 d-flex align-items-center py-5" style="background: linear-gradient(135deg, #1f2937 0%, #111827 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card-hp p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <a href="/" class="d-inline-flex align-items-center gap-2 text-decoration-none mb-3">
                            <div class="bg-primary rounded-2 p-2">
                                <i class="bi bi-tools text-white fs-5"></i>
                            </div>
                            <span class="fw-bold fs-4 text-dark">Handyman<span class="text-primary">Pro</span></span>
                        </a>
                        <h2 class="fw-bold mb-1">Create Account</h2>
                        <p class="text-secondary">Join thousands of happy customers</p>
                    </div>
                    
                    <form method="POST" action="{{ route('seeker.register.post') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-secondary">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-person text-secondary"></i>
                                </span>
                                <input type="text" name="name" class="form-control-hp border-start-0" 
                                       placeholder="John Doe" required>
                            </div>
                        </div>
                        
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
                            <label class="form-label fw-semibold small text-secondary">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">+92</span>
                                <input type="tel" name="phone" class="form-control-hp border-start-0" 
                                       placeholder="300 1234567" required>
                            </div>
                        </div>
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-secondary">Password</label>
                                <input type="password" name="password" class="form-control-hp" 
                                       placeholder="Min 8 chars" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-secondary">Confirm</label>
                                <input type="password" name="password_confirmation" class="form-control-hp" 
                                       placeholder="Confirm password" required>
                            </div>
                        </div>
                        
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" required id="terms">
                            <label class="form-check-label small text-secondary" for="terms">
                                I agree to the <a href="#" class="text-primary">Terms</a> and <a href="#" class="text-primary">Privacy Policy</a>
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-hp-primary w-100 py-3 mb-3">
                            <i class="bi bi-person-plus me-2"></i>Create Account
                        </button>
                        
                        <div class="text-center">
                            <p class="text-secondary">
                                Already have an account? 
                                <a href="{{ route('seeker.login') }}" class="text-primary fw-semibold text-decoration-none">Sign In</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection