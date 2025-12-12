@extends('layouts.frontend')

@section('title', 'Doctor Verification')

@push('styles')
<style>
    .verification-process {
        background: linear-gradient(135deg, #0D6EFD 0%, #0A4275 100%);
        color: white;
        border-radius: 1rem;
        overflow: hidden;
    }
    
    .verification-icon {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        opacity: 0.9;
    }
    
    .qr-code-container {
        background: white;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        max-width: 300px;
        margin: 0 auto;
    }
    
    .scan-animation {
        position: relative;
        height: 4px;
        background: rgba(255,255,255,0.3);
        overflow: hidden;
        border-radius: 2px;
    }
    
    .scan-animation::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 50%;
        background: #20C997;
        animation: scan 2s infinite ease-in-out;
    }
    
    @keyframes scan {
        0% { left: -50%; }
        100% { left: 100%; }
    }
</style>
@endpush

@section('content')
<!-- Verification Hero -->
<section class="py-5 verification-process">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center text-white">
                <div class="verification-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <h1 class="display-5 fw-bold mb-4">Doctor Verification Portal</h1>
                <p class="lead mb-5">
                    Verify the credentials of medical professionals instantly using our secure verification system.
                </p>
                
                <!-- QR Code Display (Creative Element) -->
                <div class="qr-code-container mb-5">
                    <h5 class="text-dark mb-3">Scan to Verify</h5>
                    <div class="scan-animation mb-3"></div>
                    
                    <!-- Creative QR Code Representation -->
                    <div class="border border-3 border-primary p-3 rounded d-inline-block mb-3">
                        <div class="text-center">
                            <div class="d-flex justify-content-center mb-2">
                                <div class="bg-dark" style="width: 20px; height: 20px; margin: 2px;"></div>
                                <div class="bg-white" style="width: 20px; height: 20px; margin: 2px;"></div>
                                <div class="bg-dark" style="width: 20px; height: 20px; margin: 2px;"></div>
                            </div>
                            <div class="d-flex justify-content-center mb-2">
                                <div class="bg-white" style="width: 20px; height: 20px; margin: 2px;"></div>
                                <div class="bg-dark" style="width: 20px; height: 20px; margin: 2px;"></div>
                                <div class="bg-white" style="width: 20px; height: 20px; margin: 2px;"></div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="bg-dark" style="width: 20px; height: 20px; margin: 2px;"></div>
                                <div class="bg-white" style="width: 20px; height: 20px; margin: 2px;"></div>
                                <div class="bg-dark" style="width: 20px; height: 20px; margin: 2px;"></div>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-muted small mb-0">Scan QR code with Thibitisha App</p>
                </div>
                
                <div class="alert alert-light" role="alert">
                    <i class="fas fa-info-circle me-2 text-primary"></i>
                    This is a verification placeholder. In production, this would connect to our verification API.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Verification Methods -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Verification Methods</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-qrcode fa-2x"></i>
                        </div>
                        <h4 class="card-title">QR Code Scan</h4>
                        <p class="card-text text-muted">
                            Scan a doctor's verification QR code using our mobile app for instant results.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-id-card fa-2x"></i>
                        </div>
                        <h4 class="card-title">ID Number Search</h4>
                        <p class="card-text text-muted">
                            Enter the doctor's national ID or license number to verify their credentials.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-search fa-2x"></i>
                        </div>
                        <h4 class="card-title">Name & Hospital</h4>
                        <p class="card-text text-muted">
                            Search by doctor's name and hospital affiliation for verification.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Verification Form -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        <h2 class="section-title text-center mb-4">Manual Verification</h2>
                        <p class="text-center text-muted mb-5">
                            Enter doctor details below to verify their credentials.
                        </p>
                        
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Enter first name">
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Enter last name">
                                </div>
                                <div class="col-md-6">
                                    <label for="licenseNumber" class="form-label">License Number</label>
                                    <input type="text" class="form-control" id="licenseNumber" placeholder="MMC-XXXXX">
                                </div>
                                <div class="col-md-6">
                                    <label for="specialization" class="form-label">Specialization</label>
                                    <select class="form-select" id="specialization">
                                        <option selected>Select specialization</option>
                                        <option value="cardiology">Cardiology</option>
                                        <option value="surgery">General Surgery</option>
                                        <option value="pediatrics">Pediatrics</option>
                                        <option value="orthopedics">Orthopedics</option>
                                        <option value="neurology">Neurology</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="hospital" class="form-label">Hospital/Clinic</label>
                                    <input type="text" class="form-control" id="hospital" placeholder="Enter hospital name">
                                </div>
                            </div>
                            
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-search me-2"></i> Verify Now
                                </button>
                                <p class="text-muted mt-3 small">
                                    <i class="fas fa-lock me-1"></i> All verification requests are encrypted and secure
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Verification Result Placeholder -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body text-center p-4">
                        <div class="d-flex justify-content-center mb-3">
                            <div class="spinner-border text-primary" role="status" style="display: none;">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <h5 class="text-muted">Verification results will appear here</h5>
                        <p class="text-muted small mb-0">
                            This is a placeholder. In a real system, this would show verification status, license validity, and certification details.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form submission simulation
        const form = document.querySelector('form');
        const spinner = document.querySelector('.spinner-border');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show spinner
            spinner.style.display = 'block';
            
            // Simulate API call
            setTimeout(() => {
                spinner.style.display = 'none';
                
                // Show success message
                const resultCard = document.querySelector('.card-body.text-center');
                resultCard.innerHTML = `
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading"><i class="fas fa-check-circle me-2"></i>Verification Successful!</h4>
                        <p>Dr. John Doe is a verified medical practitioner.</p>
                        <hr>
                        <p class="mb-0">
                            <strong>License Status:</strong> Active until Dec 2026<br>
                            <strong>Specialization:</strong> Cardiology<br>
                            <strong>Hospital:</strong> Nairobi General Hospital
                        </p>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-outline-primary" onclick="window.location.reload()">
                            <i class="fas fa-redo me-2"></i>Verify Another
                        </button>
                    </div>
                `;
            }, 2000);
        });
    });
</script>
@endpush