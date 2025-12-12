@extends('layouts.admin')

@section('title', 'Edit Role')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">Edit Role</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Role: {{ $role->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Roles
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Role Name *</label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $role->name) }}"
                                           placeholder="e.g., Administrator"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slug">Slug *</label>
                                    <input type="text" 
                                           class="form-control @error('slug') is-invalid @enderror" 
                                           id="slug" 
                                           name="slug" 
                                           value="{{ old('slug', $role->slug) }}"
                                           placeholder="e.g., admin"
                                           required>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Unique identifier (cannot be changed if users have this role)</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3" 
                                      placeholder="Brief description of the role's permissions...">{{ old('description', $role->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Users with this role -->
                        <div class="form-group">
                            <label>Users with this role:</label>
                            @if($role->users->count() > 0)
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> This role is assigned to {{ $role->users->count() }} user(s).
                                    Changing the slug may affect their permissions.
                                </div>
                                <ul class="list-group">
                                    @foreach($role->users->take(5) as $user)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $user->name }}
                                            <span class="badge bg-primary">{{ $user->email }}</span>
                                        </li>
                                    @endforeach
                                    @if($role->users->count() > 5)
                                        <li class="list-group-item text-center">
                                            <small>... and {{ $role->users->count() - 5 }} more users</small>
                                        </li>
                                    @endif
                                </ul>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle"></i> This role is not assigned to any users yet.
                                </div>
                            @endif
                        </div>
                        
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Role
                            </button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection