@extends('layouts.app')

@section('title', 'Create Sub Speciality')
@section('page-title', 'Create New Sub Speciality')

@section('header-buttons')
    <a href="{{ route('subspecialities.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Sub Speciality Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('subspecialities.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Sub Speciality Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="speciality_id" class="form-label">Speciality *</label>
                        <select class="form-select @error('speciality_id') is-invalid @enderror" 
                                id="speciality_id" name="speciality_id" required>
                            <option value="">Select Speciality</option>
                            @foreach($specialities as $speciality)
                                <option value="{{ $speciality->id }}" 
                                        {{ old('speciality_id') == $speciality->id ? 'selected' : '' }}>
                                    {{ $speciality->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('speciality_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>m 
                        @enderror
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Create Sub Speciality
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection