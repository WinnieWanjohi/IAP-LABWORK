@extends('layouts.app')

@section('title', 'Users')
@section('page-title', 'User Management')

@section('header-buttons')
    <a href="{{ route('users.create') }}" class="btn btn-primary">
        <i class="fas fa-user-plus me-1"></i>Add User
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Search and Filter Card -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">
                    <i class="fas fa-search me-2"></i>Search & Filter Users
                </h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('users.index') }}">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="search" class="form-label">Search</label>
                            <input type="text" class="form-control" id="search" name="search" 
                                   value="{{ request('search') }}" placeholder="Search by name, email, phone...">
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role">
                                <option value="">All Roles</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->slug }}" {{ request('role') == $role->slug ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-2 mb-3 d-flex align-items-end">
                            <div class="d-grid gap-2 w-100">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter me-1"></i>Filter
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-redo me-1"></i>Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Users List Card -->
        <div class="card">
            <div class="card-body">
                @if($users->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Last Login</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-3">
                                                <div class="avatar-initial rounded-circle bg-primary text-white">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $user->name }}</h6>
                                                <small class="text-muted">Created: {{ $user->created_at->format('M d, Y') }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                        @if($user->email_verified_at)
                                            <span class="badge bg-success ms-1">Verified</span>
                                        @else
                                            <span class="badge bg-warning ms-1">Unverified</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $user->role_name }}</span>
                                    </td>
                                    <td>{{ $user->phone ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->status_color }}">
                                            {{ $user->status_text }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($user->last_login_at)
                                            {{ $user->last_login_at->diffForHumans() }}
                                        @else
                                            <span class="text-muted">Never</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-info" 
                                               data-bs-toggle="tooltip" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning"
                                               data-bs-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('users.toggleStatus', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-{{ $user->is_active ? 'danger' : 'success' }}"
                                                        data-bs-toggle="tooltip" title="{{ $user->is_active ? 'Deactivate' : 'Activate' }}"
                                                        onclick="return confirm('Are you sure you want to {{ $user->is_active ? 'deactivate' : 'activate' }} this user?')">
                                                    <i class="fas fa-{{ $user->is_active ? 'ban' : 'check' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                        data-bs-toggle="tooltip" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Statistics -->
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h4 class="mb-1">{{ \App\Models\User::count() }}</h4>
                                    <p class="mb-0">Total Users</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h4 class="mb-1">{{ \App\Models\User::active()->count() }}</h4>
                                    <p class="mb-0">Active Users</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body text-center">
                                    <h4 class="mb-1">{{ \App\Models\User::inactive()->count() }}</h4>
                                    <p class="mb-0">Inactive Users</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h4 class="mb-1">{{ \App\Models\User::whereHas('role', function($q) {
                                        $q->where('slug', 'admin');
                                    })->count() }}</h4>
                                    <p class="mb-0">Admins</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <h4>No users found</h4>
                        <p class="text-muted">Get started by adding your first user.</p>
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            <i class="fas fa-user-plus me-1"></i>Add User
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection