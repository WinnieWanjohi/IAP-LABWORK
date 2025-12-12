@extends('layouts.app')

@section('title', 'Practitioners')
@section('page-title', 'Practitioners')

@section('header-buttons')
    <a href="{{ route('practitioners.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add Practitioner
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if($practitioners->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Registration No.</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Speciality</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($practitioners as $practitioner)
                        <tr>
                            <td>{{ $practitioner->id }}</td>
                            <td>
                                <strong>{{ $practitioner->registration_number }}</strong>
                            </td>
                            <td>{{ $practitioner->full_name }}</td>
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
                                <span class="badge bg-{{ $statusColor }}">
                                    {{ $practitioner->status->name }}
                                </span>
                            </td>
                            <td>{{ $practitioner->speciality->name ?? 'N/A' }}</td>
                            <td>{{ $practitioner->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('practitioners.show', $practitioner) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('practitioners.edit', $practitioner) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('practitioners.destroy', $practitioner) }}" method="POST" class="d-inline">
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
                {{ $practitioners->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-user-md fa-3x text-muted mb-3"></i>
                <h4>No practitioners found</h4>
                <p class="text-muted">Get started by adding your first practitioner.</p>
                <a href="{{ route('practitioners.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Add Practitioner
                </a>
                <a href="{{ route('kmpdc.import.index') }}" class="btn btn-success">
                    <i class="fas fa-file-import me-1"></i>Import from KMPDC
                </a>
            </div>
        @endif
    </div>
</div>
@endsection