@extends('layouts.admin')

@section('title', 'View Role: ' . $role->name)

@section('page-title', 'Role Details: ' . $role->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">View</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Role Information</h3>
                <div class="card-tools">
                    <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                </div>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Role Name</dt>
                    <dd class="col-sm-9">
                        <span class="badge bg-primary">{{ $role->name }}</span>
                    </dd>
                    
                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9">
                        {{ $role->description ?? 'No description provided' }}
                    </dd>
                    
                    <dt class="col-sm-3">Created At</dt>
                    <dd class="col-sm-9">
                        {{ $role->created_at->format('F d, Y \a\t h:i A') }}
                        <small class="text-muted">({{ $role->created_at->diffForHumans() }})</small>
                    </dd>
                    
                    <dt class="col-sm-3">Updated At</dt>
                    <dd class="col-sm-9">
                        {{ $role->updated_at->format('F d, Y \a\t h:i A') }}
                        <small class="text-muted">({{ $role->updated_at->diffForHumans() }})</small>
                    </dd>
                    
                    <dt class="col-sm-3">Total Users</dt>
                    <dd class="col-sm-9">
                        <span class="badge bg-success">{{ $role->users_count ?? 0 }} users</span>
                    </dd>
                </dl>
            </div>
        </div>
        
        @if($role->users_count > 0)
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Assigned Users ({{ $role->users_count }})</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{ $users->links() }}
            </div>
        </div>
        @endif
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quick Actions</h3>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i> Edit Role
                    </a>
                    
                    @if($role->users_count === 0)
                    <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-grid">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this role?')">
                            <i class="bi bi-trash me-2"></i> Delete Role
                        </button>
                    </form>
                    @else
                    <button class="btn btn-danger" disabled title="Cannot delete role with assigned users">
                        <i class="bi bi-trash me-2"></i> Delete Role
                    </button>
                    @endif
                    
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Statistics</h3>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h1 class="display-4">{{ $role->users_count ?? 0 }}</h1>
                    <p class="text-muted">Users with this role</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection