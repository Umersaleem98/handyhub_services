@extends('layouts.app')

@section('title', 'Provider Registration - HandymanPro')

@section('content')
<div class="bg-light min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Steps -->
                <div class="steps-hp mb-4" style="max-width: 500px; margin: 0 auto;">
                    <div class="step-hp active">
                        <div class="step-circle">1</div>
                        <div class="step-label">Account</div>
                    </div>
                    <div class="step-hp">
                        <div class="step-circle">2</div>
                        <div class="step-label">Profile</div>
                    </div>
                    <div class="step-hp">
                        <div class="step-circle">3</div>
                        <div class="step-label">Documents</div>
                    </div>
                </div>
                
                <div class="card-hp p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                            <i class="bi bi-briefcase-fill fs-2"></i>
                        </div>
                        <h3 class="fw-bold mb-1">Create Provider Account</h3>
                        <p class="text-secondary">Start earning with your skills</p>
                    </div>
                    
                    <form method="POST" action="{{ route('provider.register.post') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-secondary">Full Name (as per CNIC)</label>
                            <input type="text" name="name" class="form-control-hp" placeholder="Your full name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-secondary">Email</label>
                            <input type="email" name="email" class="form-control-hp" placeholder="name@example.com" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-secondary">Phone</label>
                            <div class="input-group">
                                <span class="input-group-text">+92</span>
                                <input type="tel" name="phone" class="form-control-hp" placeholder="300 1234567" required>
                            </div>
                        </div>
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-secondary">Password</label>
                                <input type="password" name="password" class="form-control-hp" placeholder="Min 8 chars" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-secondary">Confirm</label>
                                <input type="password" name="password_confirmation" class="form-control-hp" placeholder="Confirm" required>
                            </div>
                        </div>
                        
                        <div class="alert alert-warning rounded-3 d-flex gap-3">
                            <i class="bi bi-info-circle-fill"></i>
                            <div class="small">You'll need CNIC and professional documents for verification.</div>
                        </div>
                        
                        <button type="submit" class="btn btn-hp-primary w-100 py-3">
                            Continue <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection