@extends('layouts.app')

@section('content')
<div class="flex">
    @include('admin.partials.sidebar')

    <div class="flex-grow-1 p-4" style="min-height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container-fluid">

            <!-- Header Card -->
            <div class="card border-0 mb-4" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 16px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);">
                <div class="card-header border-0 d-flex justify-content-between align-items-center py-4" style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); border-radius: 16px 16px 0 0;">
                    <h2 class="mb-0 text-white fw-bold text-center">
                        <i class="fas fa-receipt me-2 text-center"></i> All Actual Budgets
                    </h2>
                    <div class="d-flex gap-2 border-0 d-flex justify-content-between align-items-center py-4">
                        <span class="badge px-3 py-2  " style="background: rgba(255, 255, 255, 0.2); color: white; font-size: 0.875rem; border-radius: 8px;">
                            <i class="fas fa-list me-1 "></i> Total: {{ $budgets->total() }}
                        </span>
                    </div>
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

            <!-- Actual Budgets Table Card -->
            <div class="card border-0" style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px); border-radius: 16px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); overflow: hidden;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="border-collapse: separate; border-spacing: 10;">
                            <thead style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border-bottom: 2px solid #2563eb;">
                                <tr>
                                    <th class="py-4 ps-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">#</th>
                                    <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">User</th>
                                    <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Zone</th>
                                    <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Subject</th>
                                    <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Activity Code</th>
                                    <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Actual Total</th>
                                    <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                                    <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Submitted</th>
                                    <th class="py-4 pe-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($budgets as $actual)
                                    @php $est = $actual->estimatedBudget; @endphp
                                    <tr style="transition: all 0.3s ease; border-bottom: 1px solid #e5e7eb;">
                                        <td class="py-4 ps-4 align-middle" style="color: #64748b; font-weight: 500;">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="py-4 align-middle">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center me-2" 
                                                     style="width: 36px; height: 36px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; font-weight: 600; font-size: 0.875rem;">
                                                    {{ strtoupper(substr($actual->user?->name ?? 'U', 0, 1)) }}
                                                </div>
                                                <strong style="color: #1e293b; font-weight: 600;">{{ $actual->user?->name ?? 'User' }}</strong>
                                            </div>
                                        </td>
                                        <td class="py-4 align-middle">
                                            <span class="badge" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 8px; padding: 6px 12px; font-size: 0.813rem; font-weight: 500;">
                                                {{ $est->zone }}
                                            </span>
                                        </td>
                                        <td class="py-4 align-middle" style="color: #475569; max-width: 250px;">
                                            <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $est->subject }}">
                                                {{ Str::limit($est->subject, 30) }}
                                            </div>
                                        </td>
                                        <td class="py-4 align-middle">
                                            <span class="badge" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); border-radius: 8px; padding: 6px 12px; font-size: 0.813rem; font-weight: 500;">
                                                {{ $est->activity_code }}
                                            </span>
                                        </td>
                                        <td class="py-4 align-middle text-end">
                                            <div class="d-inline-block px-3 py-2" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 8px; border-left: 4px solid #f59e0b;">
                                                <strong style="color: #92400e; font-weight: 700; font-size: 1rem;">
                                                    Rs. {{ number_format($actual->actual_total, 2) }}
                                                </strong>
                                            </div>
                                        </td>
                                        <td class="py-4 align-middle">
                                            @if($actual->status == 'pending')
                                                <span class="badge" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 8px; padding: 6px 14px; font-size: 0.813rem; font-weight: 500;">
                                                    <i class="fas fa-clock me-1"></i> Pending
                                                </span>
                                            @elseif($actual->status == 'approved')
                                                <span class="badge" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 8px; padding: 6px 14px; font-size: 0.813rem; font-weight: 500;">
                                                    <i class="fas fa-check-circle me-1"></i> Approved
                                                </span>
                                            @else
                                                <span class="badge" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border-radius: 8px; padding: 6px 14px; font-size: 0.813rem; font-weight: 500;">
                                                    <i class="fas fa-times-circle me-1"></i> Rejected
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 align-middle" style="color: #64748b;">
                                            <i class="far fa-calendar-alt me-1" style="color: #94a3b8;"></i>
                                            {{ $actual->created_at->format('d M Y') }}
                                        </td>
                                        <td class="py-4 pe-4 align-middle">
                                            <a href="{{ route('admin.actual.show', $actual->id) }}" 
                                               class="btn btn-sm" 
                                               style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); color: white; border: none; border-radius: 8px; padding: 8px 16px; box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3); transition: all 0.3s ease; font-weight: 500;">
                                                <i class="fas fa-eye me-1"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-5">
                                            <div class="py-5">
                                                <i class="fas fa-inbox mb-3" style="font-size: 4rem; color: #cbd5e1;"></i>
                                                <h5 style="color: #64748b; font-weight: 600;">No Actual Budgets Found</h5>
                                                <p style="color: #94a3b8; font-size: 0.875rem;">There are no actual budgets to display at the moment.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer border-0 d-flex justify-content-center py-4" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
                    {{ $budgets->links('pagination::bootstrap-5') }}
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row mt-4">
                <div class="col-md-3 mb-3">
                    <div class="card border-0" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 12px; box-shadow: 0 4px 16px rgba(59, 130, 246, 0.3);">
                        <div class="card-body text-white p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1" style="opacity: 0.9; font-size: 0.875rem;">Total Budgets</p>
                                    <h3 class="mb-0 fw-bold">{{ $budgets->total() }}</h3>
                                </div>
                                <i class="fas fa-file-invoice" style="font-size: 2.5rem; opacity: 0.3;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 12px; box-shadow: 0 4px 16px rgba(245, 158, 11, 0.3);">
                        <div class="card-body text-white p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1" style="opacity: 0.9; font-size: 0.875rem;">Pending</p>
                                    <h3 class="mb-0 fw-bold">{{ $budgets->where('status', 'pending')->count() }}</h3>
                                </div>
                                <i class="fas fa-clock" style="font-size: 2.5rem; opacity: 0.3;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 12px; box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);">
                        <div class="card-body text-white p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1" style="opacity: 0.9; font-size: 0.875rem;">Approved</p>
                                    <h3 class="mb-0 fw-bold">{{ $budgets->where('status', 'approved')->count() }}</h3>
                                </div>
                                <i class="fas fa-check-circle" style="font-size: 2.5rem; opacity: 0.3;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border-radius: 12px; box-shadow: 0 4px 16px rgba(239, 68, 68, 0.3);">
                        <div class="card-body text-white p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1" style="opacity: 0.9; font-size: 0.875rem;">Rejected</p>
                                    <h3 class="mb-0 fw-bold">{{ $budgets->where('status', 'rejected')->count() }}</h3>
                                </div>
                                <i class="fas fa-times-circle" style="font-size: 2.5rem; opacity: 0.3;"></i>
                            </div>
                        </div>
                    </div>
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
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3) !important;
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

    /* Summary card hover effect */
    .row .card:hover {
        transform: translateY(-4px);
        transition: all 0.3s ease;
    }
</style>

@endsection