<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Thibitisha - Medical Verification System">
    
    <!-- Page Title -->
    <title>@yield('title', 'Thibitisha') - Medical Verification</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-blue: #0D6EFD;      /* Medical Blue */
            --secondary-green: #20C997;   /* Soft Green */
            --accent-teal: #0A4275;       /* Navy/Teal */
            --light-bg: #F8F9FA;          /* Light Gray */
            --text-dark: #212529;
            --text-light: #6C757D;
        }
        
        /* Minimalist Design Principles */
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
            background-color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Navigation */
        .navbar {
            background-color: white;
            border-bottom: 1px solid rgba(13, 110, 253, 0.1);
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-blue) !important;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }
        
        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--primary-blue) !important;
        }
        
        .nav-link.active {
            color: var(--primary-blue) !important;
            border-bottom: 2px solid var(--primary-blue);
        }
        
        /* Main Content */
        main {
            flex: 1;
            padding: 3rem 0;
        }
        
        /* Footer */
        footer {
            background-color: var(--light-bg);
            padding: 2rem 0;
            border-top: 1px solid rgba(0,0,0,0.05);
            margin-top: auto;
        }
        
        /* Utility Classes */
        .btn-primary {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
            padding: 0.75rem 2rem;
            font-weight: 500;
            border-radius: 0.375rem;
        }
        
        .btn-primary:hover {
            background-color: var(--accent-teal);
            border-color: var(--accent-teal);
        }
        
        .btn-outline-primary {
            color: var(--primary-blue);
            border-color: var(--primary-blue);
            padding: 0.75rem 2rem;
            font-weight: 500;
            border-radius: 0.375rem;
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
        }
        
        .section-title {
            color: var(--accent-teal);
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--secondary-green);
        }
        
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }
        
        .feature-icon {
            color: var(--primary-blue);
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-brand span {
                display: none;
            }
            
            .navbar-nav {
                text-align: center;
            }
            
            .nav-link {
                margin: 0.5rem 0;
            }
            
            main {
                padding: 2rem 0;
            }
        }
    </style>
    
    <!-- Page-specific styles -->
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <!-- Logo and Brand -->
            <a class="navbar-brand" href="{{ route('frontend.home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Thibitisha Logo">
                <span>Thibitisha</span>
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('frontend.home') }}">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('frontend.about') }}">
                            <i class="fas fa-info-circle me-1"></i> About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('verify') ? 'active' : '' }}" href="{{ route('frontend.verify') }}">
                            <i class="fas fa-check-circle me-1"></i> Verification
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary ms-2" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-lock me-1"></i> Admin Panel
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <a class="navbar-brand mb-3 mb-md-0" href="{{ route('frontend.home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Thibitisha Logo" height="30">
                        <span class="ms-2">Thibitisha</span>
                    </a>
                    <p class="text-muted mb-0 mt-2">
                        Trusted medical verification system for healthcare professionals.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="social-links mb-3">
                        <a href="#" class="text-muted me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-muted me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-muted me-3"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-instagram"></i></a>
                    </div>
                    <p class="text-muted mb-0">
                        <small>&copy; {{ date('Y') }} Thibitisha Medical Verification System. All rights reserved.</small>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Simple script for active nav links
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide mobile menu after click
            const navLinks = document.querySelectorAll('.nav-link');
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (navbarCollapse.classList.contains('show')) {
                        navbarToggler.click();
                    }
                });
            });
        });
    </script>
    
    <!-- Page-specific scripts -->
    @stack('scripts')
</body>
</html>