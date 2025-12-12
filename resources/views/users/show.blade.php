@extends('layouts.app')

@section('title', 'View User')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">User Details: {{ $user->name }}</h5>
                    <div>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <div class="mb-3">
                                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" 
                                     style="width: 100px; height: 100px; font-size: 40px;">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <h5>{{ $user->name }}</h5>
                            <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 30%">Email</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $user->phone ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Role</th>
                                        <td>
                                            <span class="badge bg-info">{{ $user->role->name ?? 'No Role' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Account Created</th>
                                        <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Updated</th>
                                        <td>{{ $user->updated_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Login</th>
                                        <td>
                                            @if($user->last_login_at)
                                                {{ $user->last_login_at->format('M d, Y H:i') }}
                                                <small class="text-muted">({{ $user->last_login_at->diffForHumans() }})</small>
                                            @else
                                                Never logged in
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection