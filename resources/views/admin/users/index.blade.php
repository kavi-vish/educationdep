@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="flex ">
    @include('admin.partials.sidebar')

    <div class="flex-grow-1 p-4" style="min-height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container-fluid">

            <div class="card border-0 mb-4" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 16px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);">
    <div class="card-header border-0 d-flex flex-column align-items-center justify-content-center py-4" style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); border-radius: 16px 16px 0 0;">
        <!-- Centered Title -->
        <h4 class="mb-3 text-white fw-bold text-center">
            <i class="fas fa-users me-2"></i> User Management
        </h4>
        
        <!-- Centered Button below the title -->
        <a href="{{ route('admin.users.create') }}" class="btn btn-light btn-sm px-1 " style="border-radius: 8px; font-weight: 500; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);margin-left: auto;">
            <i class="fas fa-plus me-2"></i> Add New User
        </a>
    </div>
</div>

            <!-- Success Alert -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0" style="border-radius: 12px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Filter Button -->
            <div class="mb-4">
                <a href="{{ route('admin.users.index') }}?trashed={{ request('trashed') ? '0' : '1' }}" 
                   class="btn {{ request('trashed') ? 'btn-warning' : 'btn-light' }} px-4" 
                   style="border-radius: 10px; font-weight: 500; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); border: none;">
                    <i class="fas fa-trash me-2"></i> 
                    {{ request('trashed') ? 'Show Active Users' : 'Show Deleted Users' }}
                </a>
            </div>

            <!-- Users Table Card -->
            <div class="card border-0" style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px); border-radius: 16px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); overflow: hidden;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="border-collapse: separate; border-spacing: 0;">
                            <thead style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border-bottom: 2px solid #2563eb;">
                                <tr>
                                    <th class="py-4 ps-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">#</th>
                                    <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Name</th>
                                    <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Email</th>
                                    <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Role</th>
                                    <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Zone</th>
                                    <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Created</th>
                                    <th class="py-4 pe-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr style="transition: all 0.3s ease; border-bottom: 1px solid #e5e7eb;">
                                        <td class="py-4 ps-4 align-middle" style="color: #64748b; font-weight: 500;">{{ $loop->iteration }}</td>
                                        <td class="py-4 align-middle">
                                            <strong style="color: #1e293b; font-weight: 600;">{{ $user->name }}</strong>
                                            @if($user->trashed()) 
                                                <span class="badge ms-2" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border-radius: 6px; padding: 4px 10px; font-size: 0.75rem; font-weight: 500;">Deleted</span> 
                                            @endif
                                        </td>
                                        <td class="py-4 align-middle" style="color: #64748b;">{{ $user->email }}</td>
                                        <td class="py-4 align-middle">
                                            <span class="badge" style="background: linear-gradient(135deg, 
                                                {{ $user->role == 'admin' ? '#ef4444, #dc2626' : 
                                                   ($user->role == 'zonal director' ? '#2563eb, #1e40af' : 
                                                   ($user->role == 'accountant' ? '#06b6d4, #0891b2' : '#6b7280, #4b5563')) }}); 
                                                border-radius: 8px; padding: 6px 14px; font-size: 0.813rem; font-weight: 500; text-transform: capitalize;">
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                        <td class="py-4 align-middle" style="color: #64748b;">{{ $user->zone?->zone_name ?? '-' }}</td>
                                        <td class="py-4 align-middle" style="color: #64748b;">{{ $user->created_at->format('d/m/Y') }}</td>
                                        <td class="py-4 pe-4 align-middle">
                                            <div class="d-flex gap-2">
                                                @if($user->trashed())
                                                    <form action="{{ route('admin.users.restore', $user->user_id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="btn btn-sm" onclick="return confirm('Restore this user?')" 
                                                                style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; border-radius: 8px; padding: 6px 12px; box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3); transition: all 0.3s ease;">
                                                            <i class="fas fa-undo"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.users.forceDelete', $user->user_id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm" onclick="return confirm('Permanently delete? This cannot be undone.')"
                                                                style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; border-radius: 8px; padding: 6px 12px; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3); transition: all 0.3s ease;">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('admin.users.edit', $user->user_id) }}" class="btn btn-sm" 
                                                       style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); color: white; border: none; border-radius: 8px; padding: 6px 12px; box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3); transition: all 0.3s ease;">
                                                        <i class="fas fa-edit">-Edit-</i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->user_id }}"
                                                            style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; border-radius: 8px; padding: 6px 12px; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3); transition: all 0.3s ease;">
                                                        <i class="fas fa-trash">Delete</i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal{{ $user->user_id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" style="border: none; border-radius: 16px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);">
                                                <div class="modal-header border-0 pt-4" style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);">
                                                    <h5 class="modal-title fw-bold" style="color: #1e40af;">
                                                        <i class="fas fa-exclamation-triangle me-2" style="color: #f59e0b;"></i>
                                                        Confirm Delete
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body px-4 py-4" style="color: #475569;">
                                                    Are you sure you want to delete <strong style="color: #1e293b;">{{ $user->name }}</strong>?
                                                </div>
                                                <div class="modal-footer border-0 px-4 pb-4" style="background: #f8fafc;">
                                                    <button type="button" class="btn px-4" data-bs-dismiss="modal" style="background: #e2e8f0; color: #475569; border: none; border-radius: 8px; font-weight: 500;">Cancel</button>
                                                    <form action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn px-4" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; border-radius: 8px; font-weight: 500; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="py-5">
                                                <i class="fas fa-users-slash mb-3" style="font-size: 4rem; color: #cbd5e1;"></i>
                                                <h5 style="color: #64748b; font-weight: 600;">No users found</h5>
                                                <p style="color: #94a3b8; font-size: 0.875rem;">There are no users to display at the moment.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer border-0 d-flex justify-content-center py-4" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Hover effects for table rows */
    tbody tr:hover {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%) !important;
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1);
    }

    /* Button hover effects */
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2) !important;
    }

    /* Smooth transitions */
    .btn, tbody tr {
        transition: all 0.3s ease;
    }

    /* Custom scrollbar */
    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
    }
</style>

@endsection