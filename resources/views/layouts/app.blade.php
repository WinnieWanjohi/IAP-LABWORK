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
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .card {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .table th {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-stethoscope me-2"></i>KMPDC Admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('practitioners.index') }}">
                            <i class="fas fa-user-md me-1"></i>Practitioners
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-tags me-1"></i>Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('specialities.index') }}">Specialities</a></li>
                            <li><a class="dropdown-item" href="{{ route('subspecialities.index') }}">Sub Specialities</a></li>
                            <li><a class="dropdown-item" href="{{ route('statuses.index') }}">Statuses</a></li>
                            <li><a class="dropdown-item" href="{{ route('institutions.index') }}">Institutions</a></li>
                            <li><a class="dropdown-item" href="{{ route('degrees.index') }}">Degrees</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contacts.index') }}">
                            <i class="fas fa-address-book me-1"></i>Contacts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('qualifications.index') }}">
                            <i class="fas fa-graduation-cap me-1"></i>Qualifications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('licenses.index') }}">
                            <i class="fas fa-id-card me-1"></i>Licenses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-sm btn-light text-dark ms-2" href="{{ route('kmpdc.import.index') }}">
                            <i class="fas fa-file-import me-1"></i>KMPDC Import
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>@yield('page-title')</h1>
            <div>
                @yield('header-buttons')
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    </script>
    
    @yield('scripts')
</body>
</html>