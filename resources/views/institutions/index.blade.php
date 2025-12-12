@extends('layouts.app')

@section('title', 'Institutions')
@section('page-title', 'Institutions')

@section('header-buttons')
    <a href="{{ route('institutions.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add Institution
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if($institutions->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Qualifications</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($institutions as $institution)
                        <tr>
                            <td>{{ $institution->id }}</td>
                            <td>{{ $institution->name }}</td>
                            <td>
                                @if($institution->city || $institution->country)
                                    {{ $institution->city ?? '' }}{{ $institution->city && $institution->country ? ', ' : '' }}{{ $institution->country ?? '' }}
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $institution->qualifications_count }}</span>
                            </td>
                            <td>{{ $institution->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('institutions.show', $institution) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('institutions.edit', $institution) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('institutions.destroy', $institution) }}" method="POST" class="d-inline">
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
                {{ $institutions->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-university fa-3x text-muted mb-3"></i>
                <h4>No institutions found</h4>
                <p class="text-muted">Get started by adding your first institution.</p>
                <a href="{{ route('institutions.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Add Institution
                </a>
            </div>
        @endif
    </div>
</div>
@endsection