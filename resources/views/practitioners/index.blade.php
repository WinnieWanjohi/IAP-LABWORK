cat > resources/views/practitioners/index.blade.php << 'VIEW'
@extends('layouts.admin')

@section('title', 'Practitioners Management')
@section('page-title', 'Practitioners')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Practitioners</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Practitioners</h3>
        <div class="card-tools">
            <a href="{{ route('practitioners.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Add New Practitioner
            </a>
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#importModal">
                <i class="bi bi-upload"></i> Import KMPDC Data
            </button>
        </div>
    </div>
    <div class="card-body">
        @if($practitioners->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Reg Number</th>
                        <th>Name</th>
                        <th>Speciality</th>
                        <th>Status</th>
                        <th>Registration Date</th>
                        <th>Expiry Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($practitioners as $practitioner)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $practitioner->registration_number }}</strong>
                        </td>
                        <td>{{ $practitioner->fullname }}</td>
                        <td>
                            @if($practitioner->speciality)
                                <span class="badge bg-info">{{ $practitioner->speciality->name }}</span>
                                @if($practitioner->subSpeciality)
                                    <small class="text-muted">({{ $practitioner->subSpeciality->name }})</small>
                                @endif
                            @else
                                <span class="badge bg-secondary">Not Specified</span>
                            @endif
                        </td>
                        <td>
                            @if($practitioner->status)
                                <span class="badge bg-{{ $practitioner->status->code == 'ACTIVE' ? 'success' : ($practitioner->status->code == 'EXPIRED' ? 'danger' : 'warning') }}">
                                    {{ $practitioner->status->name }}
                                </span>
                            @endif
                        </td>
                        <td>{{ $practitioner->registration_date ? $practitioner->registration_date->format('Y-m-d') : 'N/A' }}</td>
                        <td>
                            @if($practitioner->expiry_date)
                                @if($practitioner->expiry_date->isPast())
                                    <span class="text-danger">{{ $practitioner->expiry_date->format('Y-m-d') }}</span>
                                @elseif($practitioner->expiry_date->diffInDays(now()) < 30)
                                    <span class="text-warning">{{ $practitioner->expiry_date->format('Y-m-d') }}</span>
                                @else
                                    <span class="text-success">{{ $practitioner->expiry_date->format('Y-m-d') }}</span>
                                @endif
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('practitioners.show', $practitioner) }}" 
                                   class="btn btn-info btn-sm" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('practitioners.edit', $practitioner) }}" 
                                   class="btn btn-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('practitioners.destroy', $practitioner) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this practitioner?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $practitioners->links() }}
        </div>
        @else
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i>
            No practitioners found. Click "Add New Practitioner" to create your first practitioner.
        </div>
        @endif
    </div>
    <div class="card-footer">
        <strong>Total:</strong> {{ $practitioners->total() }} practitioner(s)
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import KMPDC Data</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Use KMPDC Seeder package commands:</p>
                <div class="alert alert-info">
                    <code>php artisan kmpdc:sync</code><br>
                    <code>php artisan kmpdc:extract</code><br>
                    <code>php artisan kmpdc:import</code>
                </div>
                <p class="text-muted">Run these commands in your terminal to import actual KMPDC data.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .badge {
        font-size: 0.85em;
    }
    .table td {
        vertical-align: middle;
    }
</style>
@endpush
VIEW