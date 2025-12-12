@extends('layouts.app')

@section('title', 'Contacts')
@section('page-title', 'Contacts')

@section('header-buttons')
    <a href="{{ route('contacts.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add Contact
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if($contacts->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Practitioner</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Fax</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>
                                <a href="{{ route('practitioners.show', $contact->practitioner_id) }}">
                                    {{ $contact->practitioner->full_name }}
                                </a>
                            </td>
                            <td>{{ $contact->phone ?? 'N/A' }}</td>
                            <td>
                                @if($contact->email)
                                    <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $contact->fax ?? 'N/A' }}</td>
                            <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('contacts.show', $contact) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline">
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
                {{ $contacts->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-address-book fa-3x text-muted mb-3"></i>
                <h4>No contacts found</h4>
                <p class="text-muted">Get started by adding your first contact.</p>
                <a href="{{ route('contacts.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Add Contact
                </a>
            </div>
        @endif
    </div>
</div>
@endsection