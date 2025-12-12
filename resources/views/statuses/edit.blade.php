@extends('layouts.app')

@section('title', 'Edit Status')
@section('page-title', 'Edit Status: ' . $status->name)

@section('header-buttons')
    <a href="{{ route('statuses.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
    <a href="{{ route('statuses.show', $status) }}" class="btn btn-info">
        <i class="fas fa-eye me-1"></i>View
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Status Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('statuses.update', $status) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Status Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $status->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description', $status->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection