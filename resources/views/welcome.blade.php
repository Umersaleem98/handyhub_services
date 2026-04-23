@extends('layouts.app')

@section('title', 'HandymanPro - Professional Home Services')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            <div class="bg-primary rounded-3 p-2">
                <i class="bi bi-tools text-white fs-5"></i>
            </div>
            <span class="fw-bold fs-4 text-dark">Handyman<span class="text-primary">Pro</span></span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#how-it-works">How It Works</a></li>
                <li class="nav-item ms-lg-3">
                    <a href="{{ route('seeker.login') }}" class="btn btn-outline-primary rounded-3">
                        <i class="bi bi-person me-2"></i>Login
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('seeker.register') }}" class="btn btn-hp-primary">
                        <i class="bi bi-person-plus me-2"></i>Get Started
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="position-relative overflow-hidden" style="background: linear-gradient(135deg, #fff7ed 0%, #ffffff 50%, #eff6ff 100%); padding: 5rem 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2 mb-3 fw-semibold">
                    <i class="bi bi-lightning-charge-fill me-2"></i>Fast & Reliable Service
                </div>
                <h1 class="display-4 fw-bold text-dark mb-3">
                    Expert Home Services<br>
                    <span class="text-primary">At Your Doorstep</span>
                </h1>
                <p class="lead text-secondary mb-4">
                    Connect with verified plumbers, electricians, cleaners, and more. 
                    Book in seconds, track in real-time, pay securely.
                </p>
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="{{ route('seeker.register') }}" class="btn btn-hp-primary btn-lg">
                        <i class="bi bi-search me-2"></i>Find a Service
                    </a>
                    <a href="{{ route('provider.register') }}" class="btn btn-hp-secondary btn-lg">
                        <i class="bi bi-briefcase me-2"></i>Join as Provider
                    </a>
                </div>
                <div class="d-flex gap-4 text-secondary">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-shield-check text-success fs-5"></i>
                        <span class="fw-semibold small">Verified Pros</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-clock text-primary fs-5"></i>
                        <span class="fw-semibold small">24/7 Available</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-star-fill text-warning fs-5"></i>
                        <span class="fw-semibold small">4.9 Rating</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <div class="bg-primary bg-opacity-10 rounded-4 p-5 text-center">
                        <i class="bi bi-house-door-fill text-primary" style="font-size: 8rem;"></i>
                    </div>
                    <div class="position-absolute bottom-0 start-0 bg-white rounded-3 shadow p-3" style="width: 180px;">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-success bg-opacity-10 rounded-2 p-2 text-success">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div>
                                <div class="fw-bold">2,500+</div>
                                <div class="small text-secondary">Active Providers</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-5 my-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-6 mb-2">Our Services</h2>
            <p class="text-secondary">From emergency repairs to routine maintenance</p>
        </div>
        
        <div class="row g-4">
            @php
                $services = [
                    ['name' => 'Plumbing', 'icon' => 'droplet-fill', 'price' => '1,500', 'color' => 'primary'],
                    ['name' => 'Electrical', 'icon' => 'lightning-charge-fill', 'price' => '2,000', 'color' => 'warning'],
                    ['name' => 'Cleaning', 'icon' => 'stars', 'price' => '1,000', 'color' => 'success'],
                    ['name' => 'AC Repair', 'icon' => 'fan', 'price' => '3,000', 'color' => 'danger'],
                    ['name' => 'Carpentry', 'icon' => 'hammer', 'price' => '2,500', 'color' => 'info'],
                    ['name' => 'Painting', 'icon' => 'palette-fill', 'price' => '5,000', 'color' => 'secondary'],
                    ['name' => 'Pest Control', 'icon' => 'bug-fill', 'price' => '3,500', 'color' => 'dark'],
                    ['name' => 'More Services', 'icon' => 'grid-3x3-gap-fill', 'price' => 'Varies', 'color' => 'primary'],
                ];
            @endphp
            
            @foreach($services as $service)
            <div class="col-md-6 col-lg-3">
                <div class="card-hp p-4 h-100 text-center">
                    <div class="bg-{{ $service['color'] }} bg-opacity-10 text-{{ $service['color'] }} rounded-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                        <i class="bi bi-{{ $service['icon'] }} fs-2"></i>
                    </div>
                    <h5 class="fw-bold mb-2">{{ $service['name'] }}</h5>
                    <p class="text-secondary small mb-3">Professional {{ strtolower($service['name']) }} services at your doorstep.</p>
                    <div class="fw-bold text-primary">From Rs. {{ $service['price'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- How It Works -->
<section id="how-it-works" class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-6 mb-2">How It Works</h2>
            <p class="text-secondary">Book a service in 3 simple steps</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="bg-primary bg-opacity-10 text-primary rounded-4 d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem; font-weight: 800;">1</div>
                <h4 class="fw-bold mb-2">Describe Your Need</h4>
                <p class="text-secondary">Tell us what service you need and upload photos.</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="bg-primary bg-opacity-10 text-primary rounded-4 d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem; font-weight: 800;">2</div>
                <h4 class="fw-bold mb-2">Get Matched</h4>
                <p class="text-secondary">We connect you with verified professionals.</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="bg-primary bg-opacity-10 text-primary rounded-4 d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem; font-weight: 800;">3</div>
                <h4 class="fw-bold mb-2">Job Done!</h4>
                <p class="text-secondary">Track arrival and pay securely after completion.</p>
            </div>
        </div>
    </div>
</section>

<!-- Security -->
<section class="py-5 my-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="bg-success bg-opacity-10 rounded-4 p-5 text-center">
                    <i class="bi bi-shield-check text-success" style="font-size: 8rem;"></i>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5">
                <div class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 mb-3 fw-semibold">
                    <i class="bi bi-shield-check me-2"></i>Your Safety First
                </div>
                <h2 class="fw-bold display-6 mb-3">Verified & Secure Providers</h2>
                <p class="text-secondary mb-4">Every provider undergoes strict background checks.</p>
                
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex gap-3">
                        <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                            <i class="bi bi-card-text fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">CNIC Verification</h5>
                            <p class="text-secondary small mb-0">Government ID verification</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                            <i class="bi bi-file-earmark-check fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Police Clearance</h5>
                            <p class="text-secondary small mb-0">Criminal background check</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                            <i class="bi bi-award fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Skill Assessment</h5>
                            <p class="text-secondary small mb-0">Practical tests before approval</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="bg-primary rounded-2 p-2">
                        <i class="bi bi-tools fs-5"></i>
                    </div>
                    <span class="fw-bold fs-4">Handyman<span class="text-primary">Pro</span></span>
                </div>
                <p class="text-secondary">Pakistan's most trusted home services platform.</p>
            </div>
            <div class="col-lg-2">
                <h6 class="fw-bold mb-3">Services</h6>
                <ul class="list-unstyled text-secondary">
                    <li class="mb-2">Plumbing</li>
                    <li class="mb-2">Electrical</li>
                    <li class="mb-2">Cleaning</li>
                    <li class="mb-2">AC Repair</li>
                </ul>
            </div>
            <div class="col-lg-2">
                <h6 class="fw-bold mb-3">Company</h6>
                <ul class="list-unstyled text-secondary">
                    <li class="mb-2">About Us</li>
                    <li class="mb-2">Careers</li>
                    <li class="mb-2">Contact</li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h6 class="fw-bold mb-3">Download App</h6>
                <div class="d-flex gap-3">
                    <button class="btn btn-outline-light btn-sm">
                        <i class="bi bi-apple me-2"></i>App Store
                    </button>
                    <button class="btn btn-outline-light btn-sm">
                        <i class="bi bi-google-play me-2"></i>Google Play
                    </button>
                </div>
            </div>
        </div>
        <hr class="my-4 border-secondary">
        <div class="text-center text-secondary">
            <small>© 2026 HandymanPro. All rights reserved.</small>
        </div>
    </div>
</footer>
@endsection