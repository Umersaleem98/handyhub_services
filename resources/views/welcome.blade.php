<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FixIt Pro - Handyman Services</title>
    <!-- Bootstrap 5 CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
   <link rel="stylesheet" href="{{ asset('assets/bootstap/bootstap.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-tools me-2"></i>FixIt Pro</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how-it-works">How it Works</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimonials">Testimonials</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="#provider" class="btn btn-primary-custom">Become a Provider</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section d-flex align-items-center">
        <div class="hero-shape"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="reveal active">
                        <h1 class="hero-title">Expert Handyman <span>Services</span> At Your Doorstep</h1>
                        <p class="lead text-muted mb-4">Connect with verified professionals for all your home repair needs. From plumbing to electrical, we fix it all.</p>
                        <div class="d-flex gap-3">
                            <a href="#booking" class="btn btn-primary-custom btn-lg">Book a Service</a>
                            <a href="#services" class="btn btn-outline-dark btn-lg rounded-pill px-4">Explore Services</a>
                        </div>
                        
                        <div class="mt-5 d-flex gap-4">
                            <div>
                                <h4 class="fw-bold mb-0">15k+</h4>
                                <small class="text-muted">Services Done</small>
                            </div>
                            <div class="border-start ps-4">
                                <h4 class="fw-bold mb-0">500+</h4>
                                <small class="text-muted">Experts</small>
                            </div>
                            <div class="border-start ps-4">
                                <h4 class="fw-bold mb-0">4.9/5</h4>
                                <small class="text-muted">Rating</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-card" id="booking">
                        <h4 class="mb-4 fw-bold">Book a Service Now</h4>
                        <form>
                            <div class="mb-3">
                                <select class="form-select form-select-lg">
                                    <option selected>Select a Service</option>
                                    <option>Plumbing</option>
                                    <option>Electrical</option>
                                    <option>Carpentry</option>
                                    <option>Painting</option>
                                    <option>AC Repair</option>
                                    <option>Cleaning</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control form-control-lg" placeholder="Your Location / Address">
                            </div>
                            <div class="mb-3">
                                <input type="date" class="form-control form-control-lg">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="3" placeholder="Describe the issue..."></textarea>
                            </div>
                            <button type="button" class="btn btn-primary-custom w-100 btn-lg">Find Providers</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5 reveal">
                <h6 class="text-uppercase text-primary fw-bold">Our Services</h6>
                <h2 class="fw-bold display-5">What We Offer</h2>
                <p class="text-muted">Comprehensive home maintenance solutions for Service Seekers</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4 reveal">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-faucet"></i>
                        </div>
                        <h4>Plumbing</h4>
                        <p class="text-muted">Leak repairs, pipe installations, drain cleaning, and bathroom fittings by certified plumbers.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4>Electrical</h4>
                        <p class="text-muted">Wiring, fixture installation, panel upgrades, and emergency electrical repairs.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-paint-roller"></i>
                        </div>
                        <h4>Painting</h4>
                        <p class="text-muted">Interior and exterior painting, wall preparation, and decorative finishes.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-hammer"></i>
                        </div>
                        <h4>Carpentry</h4>
                        <p class="text-muted">Furniture repair, custom woodwork, door installations, and shelving.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-wind"></i>
                        </div>
                        <h4>AC & HVAC</h4>
                        <p class="text-muted">AC installation, servicing, gas refilling, and heating system maintenance.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-broom"></i>
                        </div>
                        <h4>Cleaning</h4>
                        <p class="text-muted">Deep cleaning, sofa shampooing, kitchen cleaning, and move-in/move-out services.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works (Dual Role) -->
    <section id="how-it-works" class="py-5">
        <div class="container py-5">
            <!-- For Service Seekers -->
            <div class="row mb-5 align-items-center">
                <div class="col-lg-6 reveal">
                    <h6 class="text-uppercase text-primary fw-bold">For Service Seekers</h6>
                    <h2 class="fw-bold mb-4">Get Things Fixed in 3 Easy Steps</h2>
                    
                    <div class="step-card mb-4">
                        <span class="step-number">01</span>
                        <h5 class="fw-bold">Choose a Service</h5>
                        <p class="text-muted">Select from our wide range of home repair and maintenance services.</p>
                    </div>
                    <div class="step-card mb-4">
                        <span class="step-number">02</span>
                        <h5 class="fw-bold">Book an Appointment</h5>
                        <p class="text-muted">Pick a date and time that works for you. We offer same-day services.</p>
                    </div>
                    <div class="step-card">
                        <span class="step-number">03</span>
                        <h5 class="fw-bold">Relax & Enjoy</h5>
                        <p class="text-muted">A verified professional will arrive and fix the issue with guaranteed satisfaction.</p>
                    </div>
                </div>
                <div class="col-lg-6 reveal">
                    <img src="https://images.unsplash.com/photo-1581578731117-104f2a41272c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Handyman working" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>

            <hr class="my-5">

            <!-- For Service Providers -->
            <div class="row align-items-center flex-row-reverse">
                <div class="col-lg-6 reveal">
                    <h6 class="text-uppercase text-primary fw-bold">For Service Providers</h6>
                    <h2 class="fw-bold mb-4">Grow Your Business With Us</h2>
                    
                    <div class="step-card mb-4">
                        <span class="step-number">01</span>
                        <h5 class="fw-bold">Register Your Profile</h5>
                        <p class="text-muted">Sign up and create your professional profile showcasing your skills.</p>
                    </div>
                    <div class="step-card mb-4">
                        <span class="step-number">02</span>
                        <h5 class="fw-bold">Get Verified</h5>
                        <p class="text-muted">Complete our background check and skill verification process.</p>
                    </div>
                    <div class="step-card">
                        <span class="step-number">03</span>
                        <h5 class="fw-bold">Start Earning</h5>
                        <p class="text-muted">Receive job requests in your area and get paid securely through our platform.</p>
                    </div>
                </div>
                <div class="col-lg-6 reveal">
                    <img src="https://images.unsplash.com/photo-1504148455328-c376907d081c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Professional tools" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4 mb-md-0 reveal">
                    <div class="stat-item">
                        <h2 class="counter" data-target="15000">0</h2>
                        <p>Jobs Completed</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0 reveal">
                    <div class="stat-item">
                        <h2 class="counter" data-target="850">0</h2>
                        <p>Active Providers</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0 reveal">
                    <div class="stat-item">
                        <h2 class="counter" data-target="98">0</h2>
                        <p>% Satisfaction</p>
                    </div>
                </div>
                <div class="col-md-3 reveal">
                    <div class="stat-item">
                        <h2 class="counter" data-target="24">0</h2>
                        <p>Hour Support</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5 reveal">
                <h6 class="text-uppercase text-primary fw-bold">Testimonials</h6>
                <h2 class="fw-bold display-5">What People Say</h2>
            </div>

            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="testimonial-card text-center reveal">
                                    <i class="fas fa-quote-left quote-icon"></i>
                                    <p class="lead mb-4">"I needed an emergency plumber at midnight. FixIt Pro connected me with a professional within 30 minutes. Absolutely lifesaving service!"</p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle me-3" width="60" alt="User">
                                        <div class="text-start">
                                            <h5 class="mb-0 fw-bold">Sarah Jenkins</h5>
                                            <small class="text-muted">Homeowner</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="testimonial-card text-center reveal">
                                    <i class="fas fa-quote-left quote-icon"></i>
                                    <p class="lead mb-4">"As a carpenter, this platform has doubled my monthly income. The verification process was smooth and I get quality leads daily."</p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle me-3" width="60" alt="User">
                                        <div class="text-start">
                                            <h5 class="mb-0 fw-bold">Mike Ross</h5>
                                            <small class="text-muted">Service Provider</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </section>

    <!-- Provider CTA -->
    <section id="provider" class="provider-section text-center">
        <div class="container reveal">
            <h2 class="display-4 fw-bold mb-4">Are You a Skilled Professional?</h2>
            <p class="lead mb-5 mx-auto" style="max-width: 700px;">Join our network of trusted service providers. Get access to thousands of customers in your area, set your own schedule, and grow your business.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#" class="btn btn-primary-custom btn-lg px-5">Apply as Provider</a>
                <a href="#" class="btn btn-outline-light btn-lg px-5 rounded-pill">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h3 class="text-white mb-3"><i class="fas fa-tools me-2"></i>FixIt Pro</h3>
                    <p>Your trusted partner for all home maintenance and repair needs. Quality service, guaranteed satisfaction.</p>
                    <div class="mt-4">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="text-white mb-3">Services</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">Plumbing</a></li>
                        <li class="mb-2"><a href="#">Electrical</a></li>
                        <li class="mb-2"><a href="#">Carpentry</a></li>
                        <li class="mb-2"><a href="#">Cleaning</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="text-white mb-3">Company</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">About Us</a></li>
                        <li class="mb-2"><a href="#">Careers</a></li>
                        <li class="mb-2"><a href="#">Blog</a></li>
                        <li class="mb-2"><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="text-white mb-3">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-primary"></i> 123 Service Street, NY 10001</li>
                        <li class="mb-2"><i class="fas fa-phone me-2 text-primary"></i> +1 (555) 123-4567</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2 text-primary"></i> support@fixitpro.com</li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary mt-4">
            <div class="text-center pt-3">
                <p class="mb-0">&copy; 2026 FixIt Pro. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <script src="{{ asset('assets/js/home.js') }}"></script>
    <script src="{{ asset('assets/bootstap/bootstap.js') }}"></script>
</body>
</html>