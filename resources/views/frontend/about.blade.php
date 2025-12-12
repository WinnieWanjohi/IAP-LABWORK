@extends('layouts.frontend')

@section('title', 'About Us')

@section('content')
<!-- About Hero -->
<section class="about-hero py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold mb-4">About Thibitisha</h1>
                <p class="lead text-muted">
                    Thibitisha (Swahili for "Verify") is a pioneering medical verification platform designed to bring transparency and trust to healthcare systems.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Our Mission -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title mb-4">Our Mission</h2>
                <p class="mb-4">
                    To create a secure, efficient, and reliable system for verifying the credentials of healthcare professionals, ensuring patient safety and trust in medical services.
                </p>
                <p class="mb-4">
                    In an era where medical fraud and unqualified practitioners pose significant risks, Thibitisha stands as a guardian of healthcare integrity.
                </p>
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-check-circle text-primary me-3"></i>
                    <span>Ensure only qualified professionals practice</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-check-circle text-primary me-3"></i>
                    <span>Protect patients from unverified practitioners</span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle text-primary me-3"></i>
                    <span>Streamline verification processes for institutions</span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="card-title text-primary mb-4">Key Benefits</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-user-shield text-primary fa-lg"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6>Patient Safety</h6>
                                        <p class="small text-muted mb-0">Ensuring treatment by qualified professionals</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-clock text-primary fa-lg"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6>Time Efficiency</h6>
                                        <p class="small text-muted mb-0">Reducing verification time from days to minutes</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-database text-primary fa-lg"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6>Centralized Database</h6>
                                        <p class="small text-muted mb-0">Single source of truth for medical credentials</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-shield-alt text-primary fa-lg"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6>Fraud Prevention</h6>
                                        <p class="small text-muted mb-0">Advanced technology to prevent credential forgery</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-5">Our Vision</h2>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center">
                                <i class="fas fa-eye fa-4x text-primary mb-4"></i>
                                <h4>Transparency</h4>
                            </div>
                            <div class="col-md-8">
                                <blockquote class="blockquote mb-0">
                                    <p class="lead">
                                        "We envision a healthcare ecosystem where every patient can easily verify their doctor's qualifications, and every qualified professional receives the recognition they deserve."
                                    </p>
                                    <footer class="blockquote-footer mt-3">Thibitisha Team</footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title mb-4">Get in Touch</h2>
                <p class="text-muted mb-5">
                    Have questions about Thibitisha? We're here to help healthcare institutions, professionals, and regulatory bodies implement our verification system.
                </p>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="p-3">
                            <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                            <h5>Email</h5>
                            <p class="text-muted mb-0">info@thibitisha.co.ke</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3">
                            <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                            <h5>Phone</h5>
                            <p class="text-muted mb-0">+254 700 123 456</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3">
                            <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
                            <h5>Location</h5>
                            <p class="text-muted mb-0">Nairobi, Kenya</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection