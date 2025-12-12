@extends('layouts.app')

@section('title', $user->name)
@section('page-title', 'User Details: ' . $user->name)

@section('header-buttons')
    <a href="{{ route('users.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Users
    </a>
    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
        <i class="fas fa-edit me-1"></i>Edit
    </a>
    <form action="{{ route('users.toggleStatus', $user) }}" method="POST" class="d-inline">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-{{ $user->is_active ? 'danger' : 'success' }}"
                onclick="return confirm('Are you sure you want to {{ $user->is_active ? 'deactivate' : 'activate' }} this user?')">
            <i class="fas fa-{{ $user->is_active ? 'ban' : 'check' }} me-1"></i>
            {{ $user->is_active ? 'Deactivate' : 'Activate' }}
        </button>
    </form>
    <a href="{{ route('users.activity', $user) }}" class="btn btn-info">
        <i class="fas fa-chart-line me-1"></i>Activity
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <!-- User Profile Card -->
        <div class="card mb-4">
            <div class="card-body text-center">
                <div class="avatar avatar-xl mb-3">
                    <div class="avatar-initial rounded-circle bg-primary text-white display-4">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                </div>
                <h4>{{ $user->name }}</h4>
                <p class="text-muted">{{ $user->email }}</p>
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <span class="badge bg-{{ $user->status_color }}">
                        {{ $user->status_text }}
                    </span>
                    <span class="badge bg-info">
                        {{ $user->role_name }}
                    </span>
                </div>
                
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Phone:</span>
                        <strong>{{ $user->phone ?? 'N/A' }}</strong>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Email Verified:</span>
                        <strong>
                            @if($user->email_verified_at)
                                <span class="text-success">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif
                        </strong>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Last Login:</span>
                        <strong>
                            @if($user->last_login_at)
                                {{ $user->last_login_at->diffForHumans() }}
                            @else
                                <span class="text-muted">Never</span>
                            @endif
                        </strong>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Member Since:</span>
                        <strong>{{ $user->created_at->format('M d, Y') }}</strong>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions Card -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $user->email }}" class="btn btn-outline-primary">
                        <i class="fas fa-envelope me-1"></i>Send Email
                    </a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100"
                                onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                            <i class="fas fa-trash me-1"></i>Delete User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <!-- User Details Card -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>User Information
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Full Name:</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email Address:</th>
                        <td>
                            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                            @if($user->email_verified_at)
                                <span class="badge bg-success ms-2">Verified</span>
                            @else
                                <span class="badge bg-warning ms-2">Unverified</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Role:</th>
                        <td>
                            <span class="badge bg-info">{{ $user->role_name }}</span>
                            @if($user->role)
                                <p class="text-muted mt-1 mb-0">{{ $user->role->description }}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Phone Number:</th>
                        <td>{{ $user->phone ?? 'Not provided' }}</td>
                    </tr>
                    <tr>
                        <th>Account Status:</th>
                        <td>
                            <span class="badge bg-{{ $user->status_color }}">
                                {{ $user->status_text }}
                            </span>
                            <p class="text-muted mt-1 mb-0">
                                @if($user->is_active)
                                    User can log in and access the system.
                                @else
                                    User cannot log into the system.
                                @endif
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th>Last Login:</th>
                        <td>
                            @if($user->last_login_at)
                                {{ $user->last_login_at->format('F j, Y, g:i a') }}
                                <span class="text-muted">({{ $user->last_login_at->diffForHumans() }})</span>
                            @else
                                <span class="text-muted">User has never logged in</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Account Created:</th>
                        <td>{{ $user->created_at->format('F j, Y, g:i a') }}</td>
                    </tr>
                    <tr>
                        <th>Last Updated:</th>
                        <td>{{ $user->updated_at->format('F j, Y, g:i a') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <!-- Permissions & Role Information -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-shield-alt me-2"></i>Role Information
                </h5>
            </div>
            <div class="card-body">
                @if($user->role)
                    <h6>{{ $user->role->name }} Permissions</h6>
                    <p>{{ $user->role->description }}</p>
                    
                    <!-- Simulated permissions based on role -->
                    @php
                        $permissions = [
                            'admin' => ['Full system access', 'User management', 'Content management', 'System settings'],
                            'manager' => ['User management', 'Content management', 'Reports'],
                            'editor' => ['Content creation', 'Content editing', 'Media management'],
                            'viewer' => ['View content', 'View reports', 'Read-only access']
                        ];
                        
                        $rolePermissions = $permissions[$user->role->slug] ?? ['Basic access'];
                    @endphp
                    
                    <div class="row">
                        @foreach($rolePermissions as $permission)
                        <div class="col-md-6 mb-2">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>{{ $permission }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        This user has no role assigned. Please assign a role to grant permissions.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection