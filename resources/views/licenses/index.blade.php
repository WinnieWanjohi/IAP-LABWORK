@extends('layouts.app')

@section('title', 'Licenses')
@section('page-title', 'Licenses')

@section('header-buttons')
    <a href="{{ route('licenses.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add License
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if($licenses->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>License No.</th>
                            <th>Practitioner</th>
                            <th>Issue Date</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($licenses as $license)
                        @php
                            $renewalColors = [
                                'active' => 'success',
                                'expired' => 'danger',
                                'pending' => 'warning'
                            ];
                            $renewalColor = $renewalColors[$license->renewal_status] ?? 'secondary';
                        @endphp
                        <tr>
                            <td>{{ $license->id }}</td>
                            <td><strong>{{ $license->license_number }}</strong></td>
                            <td>
                                <a href="{{ route('practitioners.show', $license->practitioner_id) }}">
                                    {{ $license->practitioner->full_name }}
                                </a>
                            </td>
                            <td>{{ $license->issue_date->format('Y-m-d') }}</td>
                            <td>{{ $license->expiry_date->format('Y-m-d') }}</td>
                            <td>
                                <span class="badge bg-{{ $renewalColor }}">
                                    {{ ucfirst($license->renewal_status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('licenses.show', $license) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('licenses.edit', $license) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('licenses.destroy', $license) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
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
            
            <div class="d-flex justify-content-center">
                {{ $licenses->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-id-card fa-3x text-muted mb-3"></i>
                <h4>No licenses found</h4>
                <p class="text-muted">Get started by adding your first license.</p>
                <a href="{{ route('licenses.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Add License
                </a>
            </div>
        @endif
    </div>
</div>
@endsection