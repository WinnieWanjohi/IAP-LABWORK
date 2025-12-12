@extends('layouts.admin')

@section('title', 'Roles Management')
@section('page-title', 'Roles Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Roles</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Roles</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus-circle"></i> Add New Role
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 15%">Role Name</th>
                                <th style="width: 15%">Slug</th>
                                <th style="width: 30%">Description</th>
                                <th style="width: 10%">Users</th>
                                <th style="width: 15%">Created At</th>
                                <th style="width: 10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration + (($roles->currentPage() - 1) * $roles->perPage()) }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $role->slug }}</span>
                                    </td>
                                    <td>{{ $role->description ?? 'No description' }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $role->users_count > 0 ? 'success' : 'secondary' }}">
                                            {{ $role->users_count }}
                                        </span>
                                    </td>
                                    <td>{{ $role->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <!-- View Button -->
                                            <a href="{{ route('admin.roles.show', $role) }}" 
                                               class="btn btn-info" 
                                               title="View"
                                               data-toggle="tooltip">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.roles.edit', $role) }}" 
                                               class="btn btn-warning" 
                                               title="Edit"
                                               data-toggle="tooltip">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <!-- Delete Form -->
                                            <form action="{{ route('admin.roles.destroy', $role) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this role?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger" 
                                                        title="Delete"
                                                        data-toggle="tooltip"
                                                        {{ $role->users_count > 0 ? 'disabled' : '' }}>
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <h5>No Roles Found</h5>
                                            <p class="text-muted">Get started by creating your first role.</p>
                                            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus"></i> Create First Role
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <!-- Pagination -->
                    @if($roles->hasPages())
                    <div class="d-flex justify-content-center mt-3">
                        {{ $roles->links() }}
                    </div>
                    @endif
                </div>
                
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-0">
                                Showing {{ $roles->firstItem() ?? 0 }} to {{ $roles->lastItem() ?? 0 }} of {{ $roles->total() }} entries
                            </p>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Add New Role
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
        
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
        
        // Confirm delete with custom message for roles with users
        $('form').on('submit', function(e) {
            const deleteBtn = $(this).find('button[type="submit"]');
            if (deleteBtn.is(':disabled')) {
                e.preventDefault();
                alert('Cannot delete role that has users assigned. Please reassign users first.');
            }
        });
    });
</script>
@endpush