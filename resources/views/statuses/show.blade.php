@extends('layouts.app')

@section('title', $status->name)
@section('page-title', $status->name)

@section('header-buttons')
    <a href="{{ route('statuses.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
    <a href="{{ route('statuses.edit', $status) }}" class="btn btn-warning">
        <i class="fas fa-edit me-1"></i>Edit
    </a>
    <form action="{{ route('statuses.destroy', $status) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
            <i class="fas fa-trash me-1"></i>Delete
        </button>
    </form>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Status Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">ID:</th>
                        <td>{{ $status->id }}</td>
                    </tr>
                    <tr>
                        <th>Name:</th>
                        <td>{{ $status->name }}</td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td>{{ $status->description ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Created:</th>
                        <td>{{ $status->created_at->format('F j, Y, g:i a') }}</td>
                    </tr>
                    <tr>
                        <th>Updated:</th>
                        <td>{{ $status->updated_at->format('F j, Y, g:i a') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Associated Practitioners</h5>
            </div>
            <div class="card-body">
                @if($status->practitioners->count() > 0)
                    <div class="list-group">
                        @foreach($status->practitioners as $practitioner)
                        <a href="{{ route('practitioners.show', $practitioner) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $practitioner->full_name }}</h6>
                                <small>{{ $practitioner->registration_number }}</small>
                            </div>
                            <p class="mb-1">Speciality: {{ $practitioner->speciality->name ?? 'N/A' }}</p>
                        </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No practitioners associated with this status.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection