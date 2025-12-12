@extends('layouts.app')

@section('title', 'Statuses')
@section('page-title', 'Statuses')

@section('header-buttons')
    <a href="{{ route('statuses.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add Status
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if($statuses->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statuses as $status)
                        <tr>
                            <td>{{ $status->id }}</td>
                            <td>{{ $status->name }}</td>
                            <td>{{ Str::limit($status->description, 50) }}</td>
                            <td>{{ $status->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('statuses.show', $status) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('statuses.edit', $status) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('statuses.destroy', $status) }}" method="POST" class="d-inline">
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
                {{ $statuses->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                <h4>No statuses found</h4>
                <p class="text-muted">Get started by adding your first status.</p>
                <a href="{{ route('statuses.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Add Status
                </a>
            </div>
        @endif
    </div>
</div>
@endsection