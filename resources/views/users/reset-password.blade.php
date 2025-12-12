@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Reset Password for: {{ $user->name }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.reset-password', $user) }}">
                        @csrf
                        @method('PATCH')

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            You are resetting the password for <strong>{{ $user->name }}</strong> ({{ $user->email }}).
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-text">
                                Password must be at least 8 characters long.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirm New Password</label>
                            <input id="password-confirm" type="password" class="form-control" 
                                   name="password_confirmation" required>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-key"></i> Reset Password
                            </button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
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