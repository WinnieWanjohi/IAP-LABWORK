@extends('layouts.app')

@section('title', 'Specialities')
@section('page-title', 'Specialities')

@section('header-buttons')
    <a href="{{ route('specialities.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add Speciality
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if($specialities->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Practitioners</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($specialities as $speciality)
                        <tr>
                            <td>{{ $speciality->id }}</td>
                            <td>{{ $speciality->name }}</td>
                            <td>{{ Str::limit($speciality->description, 50) }}</td>
                            <td>
                                <span class="badge bg-primary">{{ $speciality->practitioners_count }}</span>
                            </td>
                            <td>{{ $speciality->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('specialities.show', $speciality) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('specialities.edit', $speciality) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('specialities.destroy', $speciality) }}" method="POST" class="d-inline">
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
                {{ $specialities->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-tag fa-3x text-muted mb-3"></i>
                <h4>No specialities found</h4>
                <p class="text-muted">Get started by adding your first speciality.</p>
                <a href="{{ route('specialities.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Add Speciality
                </a>
            </div>
        @endif
    </div>
</div>
@endsection