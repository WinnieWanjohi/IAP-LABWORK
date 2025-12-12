@extends('layouts.app')

@section('title', 'Qualifications')
@section('page-title', 'Qualifications')

@section('header-buttons')
    <a href="{{ route('qualifications.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add Qualification
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if($qualifications->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Practitioner</th>
                            <th>Degree</th>
                            <th>Institution</th>
                            <th>Year</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($qualifications as $qualification)
                        <tr>
                            <td>{{ $qualification->id }}</td>
                            <td>
                                <a href="{{ route('practitioners.show', $qualification->practitioner_id) }}">
                                    {{ $qualification->practitioner->full_name }}
                                </a>
                            </td>
                            <td>{{ $qualification->degree->name }}</td>
                            <td>{{ $qualification->institution->name }}</td>
                            <td>{{ $qualification->year_awarded ?? 'N/A' }}</td>
                            <td>{{ $qualification->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('qualifications.show', $qualification) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('qualifications.edit', $qualification) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('qualifications.destroy', $qualification) }}" method="POST" class="d-inline">
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
                {{ $qualifications->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
                <h4>No qualifications found</h4>
                <p class="text-muted">Get started by adding your first qualification.</p>
                <a href="{{ route('qualifications.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Add Qualification
                </a>
            </div>
        @endif
    </div>
</div>
@endsection