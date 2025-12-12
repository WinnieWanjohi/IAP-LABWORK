@extends('layouts.app')

@section('title', 'User Activity - ' . $user->name)
@section('page-title', 'User Activity: ' . $user->name)

@section('header-buttons')
    <a href="{{ route('users.show', $user) }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to User
    </a>
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-users me-1"></i>All Users
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <!-- User Summary Card -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-user-circle me-2"></i>User Summary
                </h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="avatar avatar-xl mb-3">
                        <div class="avatar-initial rounded-circle bg-primary text-white display-4">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    </div>
                    <h5>{{ $user->name }}</h5>
                    <p class="text-muted">{{ $user->email }}</p>
                    <div class="d-flex justify-content-center gap-2">
                        <span class="badge bg-{{ $user->status_color }}">
                            {{ $user->status_text }}
                        </span>
                        <span class="badge bg-info">
                            {{ $user->role_name }}
                        </span>
                    </div>
                </div>
                
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between">
                        <span><i class="fas fa-sign-in-alt me-2"></i>Last Login:</span>
                        <strong>{{ $lastLogin }}</strong>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span><i class="fas fa-calendar-plus me-2"></i>Account Created:</span>
                        <strong>{{ $user->created_at->format('M d, Y') }}</strong>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span><i class="fas fa-history me-2"></i>Last Updated:</span>
                        <strong>{{ $user->updated_at->format('M d, Y') }}</strong>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Stats Card -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-bar me-2"></i>Quick Stats
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h3 class="mb-1 text-primary">0</h3>
                                <p class="small mb-0">Login Count</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h3 class="mb-1 text-success">0</h3>
                                <p class="small mb-0">Actions Today</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h3 class="mb-1 text-warning">0</h3>
                                <p class="small mb-0">This Week</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h3 class="mb-1 text-danger">0</h3>
                                <p class="small mb-0">This Month</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <!-- Activity Timeline Card -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-stream me-2"></i>Recent Activity Timeline
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    This is a simplified activity view. In a production system, you would implement a full activity logging system.
                </div>
                
                <!-- Sample Activity Timeline -->
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <div class="d-flex justify-content-between">
                                <h6>Account Created</h6>
                                <small class="text-muted">{{ $user->created_at->format('M d, Y h:i A') }}</small>
                            </div>
                            <p class="mb-0">User account was created in the system.</p>
                        </div>
                    </div>
                    
                    @if($user->last_login_at)
                    <div class="timeline-item">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <div class="d-flex justify-content-between">
                                <h6>Last Login</h6>
                                <small class="text-muted">{{ $user->last_login_at->format('M d, Y h:i A') }}</small>
                            </div>
                            <p class="mb-0">User last logged into the system.</p>
                            <small class="text-muted">IP: 192.168.1.1 • Browser: Chrome</small>
                        </div>
                    </div>
                    @endif
                    
                    <div class="timeline-item">
                        <div class="timeline-marker bg-warning"></div>
                        <div class="timeline-content">
                            <div class="d-flex justify-content-between">
                                <h6>Profile Updated</h6>
                                <small class="text-muted">{{ $user->updated_at->format('M d, Y h:i A') }}</small>
                            </div>
                            <p class="mb-0">User profile information was last updated.</p>
                        </div>
                    </div>
                    
                    @if($user->email_verified_at)
                    <div class="timeline-item">
                        <div class="timeline-marker bg-info"></div>
                        <div class="timeline-content">
                            <div class="d-flex justify-content-between">
                                <h6>Email Verified</h6>
                                <small class="text-muted">{{ $user->email_verified_at->format('M d, Y h:i A') }}</small>
                            </div>
                            <p class="mb-0">User verified their email address.</p>
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Empty State if no activities -->
                @if(!$user->last_login_at && !$user->email_verified_at)
                <div class="text-center py-5">
                    <i class="fas fa-history fa-3x text-muted mb-3"></i>
                    <h5>No Recent Activity</h5>
                    <p class="text-muted">This user hasn't performed any recent activities.</p>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Activity Statistics Card -->
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-pie me-2"></i>Activity Statistics
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Activity Distribution</h6>
                        <div class="d-flex align-items-center mb-3">
                            <div class="progress flex-grow-1" style="height: 10px;">
                                <div class="progress-bar bg-success" style="width: 40%"></div>
                            </div>
                            <small class="ms-2">Logins (40%)</small>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="progress flex-grow-1" style="height: 10px;">
                                <div class="progress-bar bg-info" style="width: 25%"></div>
                            </div>
                            <small class="ms-2">Profile Updates (25%)</small>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="progress flex-grow-1" style="height: 10px;">
                                <div class="progress-bar bg-warning" style="width: 20%"></div>
                            </div>
                            <small class="ms-2">Content Edits (20%)</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="progress flex-grow-1" style="height: 10px;">
                                <div class="progress-bar bg-danger" style="width: 15%"></div>
                            </div>
                            <small class="ms-2">Other (15%)</small>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h6>Activity Over Time</h6>
                        <div class="text-center">
                            <div class="display-4 text-muted">0</div>
                            <p class="text-muted">Total Activities</p>
                        </div>
                        
                        <div class="row text-center mt-4">
                            <div class="col-4">
                                <div class="stat-number text-primary">0</div>
                                <small>Today</small>
                            </div>
                            <div class="col-4">
                                <div class="stat-number text-success">0</div>
                                <small>This Week</small>
                            </div>
                            <div class="col-4">
                                <div class="stat-number text-warning">0</div>
                                <small>This Month</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .timeline {
        position: relative;
        padding-left: 40px;
    }
    .timeline-item {
        position: relative;
        margin-bottom: 30px;
    }
    .timeline-marker {
        position: absolute;
        left: -40px;
        top: 5px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
    }
    .timeline-content {
        padding-left: 20px;
        border-left: 2px solid #e9ecef;
    }
    .timeline-item:last-child .timeline-content {
        border-left: 2px solid transparent;
    }
    .avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .avatar-initial {
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
    .avatar-xl {
        width: 80px;
        height: 80px;
        font-size: 32px;
    }
    .stat-number {
        font-size: 24px;
        font-weight: bold;
    }
</style>
@endsection