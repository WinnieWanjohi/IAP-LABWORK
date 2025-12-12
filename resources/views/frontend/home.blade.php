@extends('layouts.frontend')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    Welcome to <span class="text-primary">Thibitisha</span>
                </h1>
                <p class="lead mb-4">
                    A trusted medical verification system ensuring the authenticity and credentials of healthcare professionals across the country.
                </p>
                <p class="text-muted mb-5">
                    <em>"Verifying Trust in Healthcare"</em>
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('frontend.verify') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-check-circle me-2"></i> Start Verification
                    </a>
                    <a href="{{ route('frontend.about') }}" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-info-circle me-2"></i> Learn More
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Thibitisha Logo" class="img-fluid mb-4" style="max-height: 200px;">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="card-title text-primary">Quick Stats</h5>
                            <div class="row text-center mt-4">
                                <div class="col-6">
                                    <h3 class="text-primary">1,000+</h3>
                                    <p class="text-muted mb-0">Verified Doctors</p>
                                </div>
                                <div class="col-6">
                                    <h3 class="text-primary">50+</h3>
                                    <p class="text-muted mb-0">Hospitals</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-5">Why Choose Thibitisha?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="card-title">Secure Verification</h4>
                        <p class="card-text text-muted">
                            Our system uses advanced encryption and blockchain technology to ensure tamper-proof verification records.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4 class="card-title">Fast Processing</h4>
                        <p class="card-text text-muted">
                            Get verification results in minutes, not days. Our automated system processes requests efficiently.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon">
                            <i class="fas fa-globe-africa"></i>
                        </div>
                        <h4 class="card-title">Nationwide Coverage</h4>
                        <p class="card-text text-muted">
                            Access verification services across all regions with our comprehensive database of medical professionals.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="how-it-works py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">How It Works</h2>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-user-md fa-2x"></i>
                    </div>
                    <h4>1. Register</h4>
                    <p class="text-muted">Healthcare professionals register with their credentials</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-file-alt fa-2x"></i>
                    </div>
                    <h4>2. Submit Documents</h4>
                    <p class="text-muted">Upload required certificates and identification</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-search fa-2x"></i>
                    </div>
                    <h4>3. Verification</h4>
                    <p class="text-muted">Our system validates credentials against official databases</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-check fa-2x"></i>
                    </div>
                    <h4>4. Get Verified</h4>
                    <p class="text-muted">Receive digital verification badge and certificate</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection