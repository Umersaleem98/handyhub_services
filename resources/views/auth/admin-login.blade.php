@extends('layouts.app')

@section('title', 'Admin Login - HandymanPro')

@section('content')
<div class="container-fluid">
    <div class="row min-vh-100">
        <!-- Left Side -->
        <div class="col-lg-5 d-none d-lg-flex flex-column justify-content-center text-white p-5" 
             style="background: linear-gradient(135deg, #1f2937 0%, #111827 100%);">
            <div class="mb-4">
                <i class="bi bi-shield-lock fs-1"></i>
            </div>
            <h1 class="display-5 fw-bold mb-4">Admin Portal</h1>
            <p class="lead mb-5 opacity-75">Secure access to platform management.</p>
            
            <div class="d-flex flex-column gap-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-20 rounded-3 p-2">
                        <i class="bi bi-graph-up fs-4"></i>
                    </div>
                    <div>
                        <div class="fw-semibold">Analytics Dashboard</div>
                        <div class="small opacity-75">Real-time platform insights</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-20 rounded-3 p-2">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <div>
                        <div class="fw-semibold">User Management</div>
                        <div class="small opacity-75">Manage all users and providers</div>
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
                    <h2 class="fw-bold mb-1">Admin Sign In</h2>
                    <p class="text-secondary">Enter your admin credentials</p>
                </div>
                
                @if(session('error'))
                <div class="alert alert-danger rounded-3 d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ session('error') }}
                </div>
                @endif
                
                @if($errors->any())
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <form method="POST" action="{{ route('admin.login.post') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-secondary">Admin Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-envelope text-secondary"></i>
                            </span>
                            <input type="email" name="email" class="form-control-hp border-start-0" 
                                   placeholder="admin@handymanpro.local" required value="{{ old('email') }}">
                        </div>
                    </div>
                    
                    <div class="mb-4">
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
                    
                    <button type="submit" class="btn btn-hp-primary w-100 py-3 mb-3">
                        <i class="bi bi-shield-check me-2"></i>Admin Login
                    </button>
                    
                    <div class="text-center">
                        <a href="{{ route('seeker.login') }}" class="text-secondary text-decoration-none small">
                            <i class="bi bi-arrow-left me-1"></i>Back to Main Site
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection