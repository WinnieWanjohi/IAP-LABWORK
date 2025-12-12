<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KMPDC System')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- DataTables CSS (Optional - for enhanced tables) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #0dcaf0;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .navbar-brand i {
            margin-right: 8px;
        }
        
        .card {
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border: none;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: transform 0.2s ease-in-out;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .card-header {
            border-radius: 10px 10px 0 0 !important;
            font-weight: 600;
        }
        
        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.05);
        }
        
        .badge {
            font-weight: 500;
            padding: 5px 10px;
        }
        
        .btn {
            border-radius: 6px;
            font-weight: 500;
            padding: 8px 16px;
        }
        
        .btn-group .btn {
            border-radius: 6px;
        }
        
        .alert {
            border: none;
            border-radius: 8px;
        }
        
        .form-control, .form-select {
            border-radius: 6px;
            border: 1px solid #ced4da;
            padding: 10px 15px;
        }
        
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
            border-color: #86b7fe;
        }
        
        .pagination .page-link {
            border-radius: 6px;
            margin: 0 3px;
        }
        
        .nav-link {
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }
        
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .dropdown-menu {
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: none;
        }
        
        .dropdown-item {
            padding: 8px 16px;
            border-radius: 6px;
            margin: 2px 8px;
            width: auto;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        
        /* Sidebar style for dropdowns */
        .navbar-nav .dropdown-menu {
            min-width: 220px;
        }
        
        /* Avatar styles */
        .avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        
        .avatar-sm {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }
        
        .avatar-md {
            width: 48px;
            height: 48px;
            font-size: 18px;
        }
        
        .avatar-lg {
            width: 64px;
            height: 64px;
            font-size: 24px;
        }
        
        .avatar-initial {
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        /* Custom focus styles */
        .btn:focus, .form-control:focus, .form-select:focus {
            outline: none;
        }
        
        /* Status colors */
        .status-active {
            color: var(--success-color);
        }
        
        .status-inactive {
            color: var(--danger-color);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
            
            .card {
                margin-bottom: 15px;
            }
            
            .table-responsive {
                font-size: 14px;
            }
            
            .btn-group {
                flex-wrap: wrap;
            }
            
            .btn-group .btn {
                margin-bottom: 5px;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <!-- Brand/Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-stethoscope fa-lg"></i>
                <span class="ms-2">KMPDC Admin</span>
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Items -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    
                    <!-- Practitioners Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-md me-1"></i>Practitioners
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('practitioners.index') }}">
                                <i class="fas fa-list me-2"></i>All Practitioners
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('practitioners.create') }}">
                                <i class="fas fa-plus me-2"></i>Add New Practitioner
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('contacts.index') }}">
                                <i class="fas fa-address-book me-2"></i>Contacts
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('qualifications.index') }}">
                                <i class="fas fa-graduation-cap me-2"></i>Qualifications
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('licenses.index') }}">
                                <i class="fas fa-id-card me-2"></i>Licenses
                            </a></li>
                        </ul>
                    </li>
                    
                    <!-- Categories Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-tags me-1"></i>Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('specialities.index') }}">
                                <i class="fas fa-stethoscope me-2"></i>Specialities
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('subspecialities.index') }}">
                                <i class="fas fa-tag me-2"></i>Sub Specialities
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('statuses.index') }}">
                                <i class="fas fa-circle me-2"></i>Statuses
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('institutions.index') }}">
                                <i class="fas fa-university me-2"></i>Institutions
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('degrees.index') }}">
                                <i class="fas fa-graduation-cap me-2"></i>Degrees
                            </a></li>
                        </ul>
                    </li>
                    
                    <!-- Users & Roles Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-users me-1"></i>Users & Roles
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('users.index') }}">
                                <i class="fas fa-user-friends me-2"></i>User Management
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                                <i class="fas fa-user-tag me-2"></i>Role Management
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('users.create') }}">
                                <i class="fas fa-user-plus me-2"></i>Add New User
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.roles.create') }}">
                                <i class="fas fa-plus-circle me-2"></i>Add New Role
                            </a></li>
                        </ul>
                    </li>
                    
                    <!-- KMPDC Import -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kmpdc.import.index') }}">
                            <i class="fas fa-file-import me-1"></i>KMPDC Import
                        </a>
                    </li>
                    
                    <!-- Frontend Links -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-globe me-1"></i>Frontend
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('frontend.home') }}">
                                <i class="fas fa-home me-2"></i>Home
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('frontend.about') }}">
                                <i class="fas fa-info-circle me-2"></i>About
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('frontend.verify') }}">
                                <i class="fas fa-search me-2"></i>Verify Practitioner
                            </a></li>
                        </ul>
                    </li>
                    
                    <!-- User Profile Dropdown (Right Aligned) -->
                    @auth
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <div class="avatar avatar-sm me-2">
                                <div class="avatar-initial bg-light text-dark">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            </div>
                            <span>{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header">Signed in as</h6></li>
                            <li><a class="dropdown-item" href="#">
                                <i class="fas fa-user me-2"></i>{{ auth()->user()->email }}
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">
                                <i class="fas fa-cog me-2"></i>Settings
                            </a></li>
                            <li><a class="dropdown-item" href="#">
                                <i class="fas fa-key me-2"></i>Change Password
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else

                    @endauth
                    
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2 fw-bold text-dark">@yield('page-title', 'Dashboard')</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@yield('breadcrumb', 'Page')</li>
                    </ol>
                </nav>
            </div>
            <div>
                @yield('header-buttons')
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2 fa-lg"></i>
                    <div class="flex-grow-1">
                        {{ session('success') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-2 fa-lg"></i>
                    <div class="flex-grow-1">
                        {{ session('error') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show shadow-sm">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-2 fa-lg"></i>
                    <div class="flex-grow-1">
                        {{ session('warning') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show shadow-sm">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle me-2 fa-lg"></i>
                    <div class="flex-grow-1">
                        {{ session('info') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Validation Errors -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-2 fa-lg"></i>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">Please fix the following errors:</h6>
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Main Content Section -->
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>KMPDC System</h5>
                    <p class="mb-0 text-muted">A comprehensive system for managing Kenya Medical Practitioners and Dentists Council data.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">
                        <small class="text-muted">
                            &copy; {{ date('Y') }} KMPDC System. All rights reserved.
                        </small>
                    </p>
                    <p class="mb-0">
                        <small class="text-muted">
                            <i class="fas fa-code"></i> Built with Laravel & Bootstrap
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript Libraries -->
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (for DataTables if used) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables JS (Optional) -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- Chart.js (Optional - for charts) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Auto-dismiss alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });

        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Initialize popovers
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });
        });

        // Confirm before delete
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form[data-confirm]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm(this.getAttribute('data-confirm') || 'Are you sure?')) {
                        e.preventDefault();
                    }
                });
            });
        });

        // Initialize DataTables if any table has the 'datatable' class
        document.addEventListener('DOMContentLoaded', function() {
            if ($.fn.DataTable) {
                $('.datatable').DataTable({
                    pageLength: 25,
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search..."
                    }
                });
            }
        });

        // Add active class to current page in navbar
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
                
                // Also check for dropdown items
                if (link.parentElement.classList.contains('dropdown')) {
                    const dropdownItems = link.nextElementSibling.querySelectorAll('.dropdown-item');
                    dropdownItems.forEach(item => {
                        if (item.getAttribute('href') === currentPath) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        });
    </script>
    
    <!-- Custom Page Scripts -->
    @yield('scripts')
</body>
</html>