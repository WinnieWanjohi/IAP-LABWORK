@extends('layouts.admin')

@section('title', 'My Profile')

@section('page-title', 'My Profile')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User Profile</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h5><i class="bi bi-info-circle me-2"></i> Authentication Not Installed</h5>
                    <p>This is a placeholder profile page. Install Laravel Breeze or Jetstream for full authentication features.</p>
                    <a href="https://laravel.com/docs/starter-kits" target="_blank" class="btn btn-sm btn-info mt-2">
                        <i class="bi bi-book me-1"></i> View Laravel Docs
                    </a>
                </div>
                
                <div class="text-center py-5">
                    <i class="bi bi-person-circle display-1 text-muted"></i>
                    <h4 class="mt-3">Guest User</h4>
                    <p class="text-muted">No authentication system installed yet</p>
                    
                    <div class="mt-4">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection