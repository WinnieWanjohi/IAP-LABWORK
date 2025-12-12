@extends('layouts.admin')

@section('title', 'View Role')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">View Role</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Role Details: {{ $role->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Roles
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Basic Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Role Name:</th>
                                    <td>{{ $role->name }}</td>
                                </tr>
                                <tr>
                                    <th>Slug:</th>
                                    <td><span class="badge bg-info">{{ $role->slug }}</span></td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $role->description ?? 'No description' }}</td>
                                </tr>
                                <tr>
                                    <th>Created:</th>
                                    <td>{{ $role->created_at->format('F d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated:</th>
                                    <td>{{ $role->updated_at->format('F d, Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Statistics</h5>
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h1 class="display-4 text-primary">{{ $role->users_count }}</h1>
                                    <p class="lead">Users with this role</p>
                                </div>
                            </div>
                            
                            @if($role->users_count > 0)
                            <div class="mt-3">
                                <h6>Recent Users:</h6>
                                <div class="list-group">
                                    @foreach($role->users->take(5) as $user)
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">{{ $user->name }}</h6>
                                                <small>{{ $user->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-1">{{ $user->email }}</p>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Role
                                </a>
                                <form action="{{ route('admin.roles.destroy', $role) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this role? This cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Delete Role
                                    </button>
                                </form>
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-list"></i> All Roles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection