@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="d-flex">
    @include('admin.partials.sidebar')

    <div class="flex-grow-1 p-4 bg-light" style="min-height: 100vh;">
        <div class="container-fluid">

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-gradient-primary text-black d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0"><i class="fas fa-users me-2"></i> Manage Users</h4>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-1"></i> Add User
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="mb-3">
    <a href="{{ route('admin.users.index') }}?trashed={{ request('trashed') ? '0' : '1' }}"
       class="btn btn-sm {{ request('trashed') ? 'btn-warning' : 'btn-outline-secondary' }}">
        <i class="fas fa-trash"></i> {{ request('trashed') ? 'Show Active' : 'Show Trash' }}
    </a>
 </div>
            @forelse($users as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
            <strong>{{ $user->name }}</strong>
            @if($user->trashed()) <span class="badge bg-danger">Deleted</span> @endif
        </td>
        <td>{{ $user->email }}</td>
        <td>
            <span class="badge bg-{{ 
                $user->role == 'admin' ? 'danger' : 
                ($user->role == 'zonal director' ? 'primary' : 
                ($user->role == 'accountant' ? 'info' : 'secondary')) 
            }}">{{ $user->role }}</span>
        </td>
        <td>{{ $user->zone?->zone_name ?? '-' }}</td>
        <td>{{ $user->created_at->format('d/m/Y') }}</td>
        <td>
            @if($user->trashed())
                <form action="{{ route('admin.users.restore', $user->user_id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Restore this user?')">
                        <i class="fas fa-undo"></i>
                    </button>
                </form>
                <form action="{{ route('admin.users.forceDelete', $user->user_id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Permanently delete? This cannot be undone.')">
                        <i class="fas fa-times"></i>
                    </button>
                </form>
            @else
                <a href="{{ route('admin.users.edit', $user->user_id) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i>
                </a>
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->user_id }}">
                    <i class="fas fa-trash"></i>
                </button>
            @endif
        </td>
    </tr>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal{{ $user->user_id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong>{{ $user->name }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@empty
    <tr><td colspan="7" class="text-center py-5 text-muted">No users found.</td></tr>
@endforelse

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Zone</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $user->name }}</strong></td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge bg-{{ 
                                                $user->role == 'Admin' ? 'danger' : 
                                                ($user->role == 'Zonal Director' ? 'primary' : 
                                                ($user->role == 'Accountant' ? 'info' : 'secondary')) 
                                            }}">
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                        <td>{{ $user->zone?->name ?? '-' }}</td>
                                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="fas fa-users-slash fa-3x mb-3"></i>
                                            <h5>No users found.</h5>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white d-flex justify-content-center">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection