@extends('layouts.admin')

@section('title', 'Subspecialities Management')
@section('page-title', 'Subspecialities')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Subspecialities</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Subspecialities</h3>
        <div class="card-tools">
            <a href="{{ route('subspecialities.create') }}" class="btn btn-primary btn-sm">
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
                    <td>Sample Subspecialities</td>
                    <td>{{ date('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('subspecialities.show', 1) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('subspecialities.edit', 1) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
