@extends('layouts.app')

@section('title', $practitioner->full_name)
@section('page-title', $practitioner->full_name)

@section('header-buttons')
    <a href="{{ route('practitioners.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
    <a href="{{ route('practitioners.edit', $practitioner) }}" class="btn btn-warning">
        <i class="fas fa-edit me-1"></i>Edit
    </a>
    <form action="{{ route('practitioners.destroy', $practitioner) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
            <i class="fas fa-trash me-1"></i>Delete
        </button>
    </form>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <!-- Practitioner Info Card -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-user-md me-2"></i>Practitioner Information
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">Registration No:</th>
                        <td><strong>{{ $practitioner->registration_number }}</strong></td>
                    </tr>
                    <tr>
                        <th>Full Name:</th>
                        <td>{{ $practitioner->full_name }}</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            @php
                                $statusColors = [
                                    'ACTIVE' => 'success',
                                    'INACTIVE' => 'danger',
                                    'SUSPENDED' => 'warning',
                                    'RETIRED' => 'info'
                                ];
                                $statusColor = $statusColors[$practitioner->status->name] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $statusColor }}">{{ $practitioner->status->name }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Speciality:</th>
                        <td>{{ $practitioner->speciality->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Sub Speciality:</th>
                        <td>{{ $practitioner->subSpeciality->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td>{{ $practitioner->address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Profile Link:</th>
                        <td>
                            @if($practitioner->profile_link)
                                <a href="{{ $practitioner->profile_link }}" target="_blank">
                                    {{ Str::limit($practitioner->profile_link, 30) }}
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created:</th>
                        <td>{{ $practitioner->created_at->format('F j, Y, g:i a') }}</td>
                    </tr>
                    <tr>
                        <th>Updated:</th>
                        <td>{{ $practitioner->updated_at->format('F j, Y, g:i a') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Contacts Card -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-address-book me-2"></i>Contacts
                    <a href="{{ route('contacts.create') }}?practitioner_id={{ $practitioner->id }}" 
                       class="btn btn-sm btn-light float-end">
                        <i class="fas fa-plus"></i> Add
                    </a>
                </h5>
            </div>
            <div class="card-body">
                @if($practitioner->contacts->count() > 0)
                    <div class="list-group">
                        @foreach($practitioner->contacts as $contact)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    @if($contact->phone)
                                        <div><i class="fas fa-phone text-success me-2"></i>{{ $contact->phone }}</div>
                                    @endif
                                    @if($contact->email)
                                        <div><i class="fas fa-envelope text-primary me-2"></i>{{ $contact->email }}</div>
                                    @endif
                                    @if($contact->fax)
                                        <div><i class="fas fa-fax text-secondary me-2"></i>{{ $contact->fax }}</div>
                                    @endif
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" 
                                                onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted mb-0">No contacts added yet.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <!-- Qualifications Card -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-graduation-cap me-2"></i>Qualifications
                    <a href="{{ route('qualifications.create') }}?practitioner_id={{ $practitioner->id }}" 
                       class="btn btn-sm btn-light float-end">
                        <i class="fas fa-plus"></i> Add
                    </a>
                </h5>
            </div>
            <div class="card-body">
                @if($practitioner->qualifications->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Degree</th>
                                    <th>Institution</th>
                                    <th>Year Awarded</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($practitioner->qualifications as $qualification)
                                <tr>
                                    <td>{{ $qualification->degree->name }}</td>
                                    <td>{{ $qualification->institution->name }}</td>
                                    <td>{{ $qualification->year_awarded ?? 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('qualifications.edit', $qualification) }}" 
                                               class="btn btn-outline-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('qualifications.destroy', $qualification) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" 
                                                        onclick="return confirm('Are you sure?')">
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
                @else
                    <p class="text-muted mb-0">No qualifications added yet.</p>
                @endif
            </div>
        </div>

        <!-- Licenses Card -->
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h5 class="card-title mb-0">
                    <i class="fas fa-id-card me-2"></i>Licenses
                    <a href="{{ route('licenses.create') }}?practitioner_id={{ $practitioner->id }}" 
                       class="btn btn-sm btn-light float-end">
                        <i class="fas fa-plus"></i> Add
                    </a>
                </h5>
            </div>
            <div class="card-body">
                @if($practitioner->licenses->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>License No.</th>
                                    <th>Issue Date</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($practitioner->licenses as $license)
                                @php
                                    $renewalColors = [
                                        'active' => 'success',
                                        'expired' => 'danger',
                                        'pending' => 'warning'
                                    ];
                                    $renewalColor = $renewalColors[$license->renewal_status] ?? 'secondary';
                                @endphp
                                <tr>
                                    <td>{{ $license->license_number }}</td>
                                    <td>{{ $license->issue_date->format('Y-m-d') }}</td>
                                    <td>{{ $license->expiry_date->format('Y-m-d') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $renewalColor }}">
                                            {{ ucfirst($license->renewal_status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('licenses.edit', $license) }}" 
                                               class="btn btn-outline-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('licenses.destroy', $license) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" 
                                                        onclick="return confirm('Are you sure?')">
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
                @else
                    <p class="text-muted mb-0">No licenses added yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection