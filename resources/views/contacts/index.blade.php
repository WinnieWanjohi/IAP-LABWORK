@extends('layouts.admin')

@section('title', 'Contacts Management')
@section('page-title', 'Contacts')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Contacts</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Contacts</h3>
        <div class="card-tools">
            <a href="{{ route('contacts.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Add New
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Sample Contacts</td>
                    <td>{{ date('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('contacts.show', 1) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('contacts.edit', 1) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
