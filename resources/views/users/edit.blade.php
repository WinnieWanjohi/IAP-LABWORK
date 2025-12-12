@extends('layouts.app')

@section('title', 'Edit User')
@section('page-title', 'Edit User: ' . $user->name)

@section('header-buttons')
    <a href="{{ route('users.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Users
    </a>
    <a href="{{ route('users.show', $user) }}" class="btn btn-info">
        <i class="fas fa-eye me-1"></i>View
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-edit me-2"></i>Edit User Information
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">New Password (Leave blank to keep current)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Minimum 8 characters with letters, numbers, and symbols.
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" 
                                   id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="role_id" class="form-label">Role *</label>
                            <select class="form-select @error('role_id') is-invalid @enderror" 
                                    id="role_id" name="role_id" required>
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" 
                                            {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                   id="is_active" name="is_active" value="1" 
                                   {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                User is active
                            </label>
                            <div class="form-text">
                                Inactive users cannot log into the system.
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Current Information Card -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-user me-2"></i>Current Information
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Status:</span>
                        <span class="badge bg-{{ $user->status_color }}">
                            {{ $user->status_text }}
                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Current Role:</span>
                        <strong>{{ $user->role_name }}</strong>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Last Login:</span>
                        <strong>
                            @if($user->last_login_at)
                                {{ $user->last_login_at->format('M d, Y') }}
                            @else
                                Never
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
        
        <!-- Danger Zone Card -->
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>Danger Zone
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-danger">
                    <h6><i class="fas fa-skull-crossbones me-1"></i>Warning</h6>
                    <p class="small mb-2">These actions are irreversible. Proceed with caution.</p>
                    
                    <div class="d-grid gap-2">
                        <form action="{{ route('users.toggleStatus', $user) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-{{ $user->is_active ? 'danger' : 'success' }} w-100"
                                    onclick="return confirm('Are you sure you want to {{ $user->is_active ? 'deactivate' : 'activate' }} this user?')">
                                <i class="fas fa-{{ $user->is_active ? 'ban' : 'check' }} me-1"></i>
                                {{ $user->is_active ? 'Deactivate User' : 'Activate User' }}
                            </button>
                        </form>
                        
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100"
                                    onclick="return confirm('Are you absolutely sure? This will permanently delete the user and all their data. This action cannot be undone.')">
                                <i class="fas fa-trash me-1"></i>Delete User Permanently
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection