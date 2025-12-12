@extends('layouts.app')

@section('title', 'Create Practitioner')
@section('page-title', 'Create New Practitioner')

@section('header-buttons')
    <a href="{{ route('practitioners.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Practitioner Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('practitioners.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="registration_number" class="form-label">Registration Number *</label>
                            <input type="text" class="form-control @error('registration_number') is-invalid @enderror" 
                                   id="registration_number" name="registration_number" 
                                   value="{{ old('registration_number') }}" required>
                            @error('registration_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="full_name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                                   id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status_id" class="form-label">Status *</label>
                            <select class="form-select @error('status_id') is-invalid @enderror" 
                                    id="status_id" name="status_id" required>
                                <option value="">Select Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" 
                                            {{ old('status_id') == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="speciality_id" class="form-label">Speciality</label>
                            <select class="form-select @error('speciality_id') is-invalid @enderror" 
                                    id="speciality_id" name="speciality_id">
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
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sub_speciality_id" class="form-label">Sub Speciality</label>
                            <select class="form-select @error('sub_speciality_id') is-invalid @enderror" 
                                    id="sub_speciality_id" name="sub_speciality_id">
                                <option value="">Select Sub Speciality</option>
                                @foreach($subSpecialities as $subSpeciality)
                                    <option value="{{ $subSpeciality->id }}" 
                                            {{ old('sub_speciality_id') == $subSpeciality->id ? 'selected' : '' }}>
                                        {{ $subSpeciality->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sub_speciality_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="profile_link" class="form-label">Profile Link</label>
                            <input type="url" class="form-control @error('profile_link') is-invalid @enderror" 
                                   id="profile_link" name="profile_link" value="{{ old('profile_link') }}">
                            @error('profile_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" name="address" rows="3">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Create Practitioner
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const specialitySelect = document.getElementById('speciality_id');
        const subSpecialitySelect = document.getElementById('sub_speciality_id');
        
        // Initially disable sub-speciality
        subSpecialitySelect.disabled = true;
        
        specialitySelect.addEventListener('change', function() {
            if (this.value) {
                subSpecialitySelect.disabled = false;
                // Here you could filter sub-specialities based on selected speciality
                // For now, we'll just enable it
            } else {
                subSpecialitySelect.disabled = true;
                subSpecialitySelect.selectedIndex = 0;
            }
        });
    });
</script>
@endsection
@endsection