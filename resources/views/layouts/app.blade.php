<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Thibitisha'))</title>

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Custom CSS -->
        <style>
            body {
                font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
                background-color: #f8f9fa;
            }
            .bg-gray-100 {
                background-color: #f8f9fa;
            }
        </style>
    </head>
    <body>
        <!-- Simple Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand text-primary fw-bold" href="{{ route('home') }}">
                    <i class="fas fa-shield-alt me-2"></i>{{ config('app.name', 'Thibitisha') }}
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" 
                               href="{{ route('home') }}">
                                <i class="fas fa-home me-1"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" 
                               href="{{ route('about') }}">
                                <i class="fas fa-info-circle me-1"></i> About
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('verify') ? 'active' : '' }}" 
                               href="{{ route('verify') }}">
                                <i class="fas fa-check-circle me-1"></i> Verify
                            </a>
                        </li>
                        @if(request()->is('admin*') || request()->is('users*') || request()->is('practitioners*') || request()->is('roles*'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                               href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" 
                               href="{{ route('users.index') }}">
                                <i class="fas fa-users me-1"></i> Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('practitioners.*') ? 'active' : '' }}" 
                               href="{{ route('practitioners.index') }}">
                                <i class="fas fa-user-md me-1"></i> Practitioners
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}" 
                               href="{{ route('admin.roles.index') }}">
                                <i class="fas fa-user-tag me-1"></i> Roles
                            </a>
                        </li>
                        @endif
                    </ul>
                    
                    <div class="navbar-nav">
                        @if(request()->is('admin*') || request()->is('users*') || request()->is('practitioners*') || request()->is('roles*'))
                            <span class="nav-link text-success">
                                <i class="fas fa-unlock me-1"></i> Guest Access
                            </span>
                        @else
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-lock-open me-1"></i> Admin Panel
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Alerts -->
        @if(session('success'))
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <main class="py-4">
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>

        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        @stack('scripts')
    </body>
</html>