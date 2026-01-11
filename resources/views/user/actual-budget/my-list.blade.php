@extends('layouts.app')

@section('title', 'My Actual Budgets')

@section('content')
<div class="flex">
    @include('user.partials.sidebar')

    <div class="flex-grow-1 p-4" style="min-height: 100vh; background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);">
        <div class="container-fluid">

            {{-- Header Card --}}
            <div class="card border-0 mb-4" style="background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(37, 99, 235, 0.1);">
                <div class="card-header border-0 d-flex justify-content-between align-items-center py-4" style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); border-radius: 16px 16px 0 0;">
                    <h4 class="mb-0 text-white fw-bold">
                        <i class="fas fa-file-invoice-dollar me-2"></i> My Submitted Actual Budgets
                    </h4>
                    <a href="{{ route('user.actual-budget.create') }}" 
                       class="btn btn-light px-4"
                       style="border-radius: 10px; font-weight: 600; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15); transition: all 0.3s ease;">
                        <i class="fas fa-plus-circle me-2"></i> Submit New Budget
                    </a>
                </div>
            </div>

            @if($actualBudgets->count() == 0)
                {{-- Empty State --}}
                <div class="card border-0" style="background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(37, 99, 235, 0.08);">
                    <div class="card-body text-center py-5">
                        <div class="py-5">
                            <i class="fas fa-inbox mb-4" style="font-size: 5rem; color: #cbd5e1;"></i>
                            <h4 style="color: #64748b; font-weight: 600; margin-bottom: 1rem;">No Actual Budgets Submitted Yet</h4>
                            <p class="mb-4" style="color: #94a3b8; font-size: 1rem;">You haven't submitted any actual budget reports yet. Click the button below to get started.</p>
                            <a href="{{ route('user.actual-budget.create') }}" 
                               class="btn btn-lg px-5 py-3"
                               style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; border-radius: 12px; font-weight: 600; box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3); transition: all 0.3s ease;">
                                <i class="fas fa-plus-circle me-2"></i> Submit First Actual Budget
                            </a>
                        </div>
                    </div>
                </div>
            @else
                {{-- Budgets Table Card --}}
                <div class="card border-0" style="background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(37, 99, 235, 0.08); overflow: hidden;">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" style="border-collapse: separate; border-spacing: 0;">
                                <thead style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border-bottom: 2px solid #2563eb;">
                                    <tr>
                                        <th class="py-4 ps-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">#</th>
                                        <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Zone</th>
                                        <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Subject</th>
                                        <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Activity Code</th>
                                        <th class="py-4 text-end" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Estimated Total</th>
                                        <th class="py-4 text-end" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Actual Total</th>
                                        <th class="py-4 text-end" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Balance</th>
                                        <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                                        <th class="py-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Submitted</th>
                                        <th class="py-4 pe-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($actualBudgets as $actual)
                                        @php $est = $actual->estimatedBudget; @endphp
                                        <tr style="transition: all 0.3s ease; border-bottom: 1px solid #f1f5f9;">
                                            <td class="py-4 ps-4 align-middle" style="color: #64748b; font-weight: 600;">
                                                {{ $loop->iteration }}
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
                                                <span class="badge" style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); border-radius: 8px; padding: 6px 12px; font-size: 0.813rem; font-weight: 500;">
                                                    {{ $est->activity_code }}
                                                </span>
                                            </td>
                                            <td class="py-4 text-end align-middle">
                                                <div class="d-inline-block px-3 py-2" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border-radius: 8px; border-left: 4px solid #2563eb;">
                                                    <strong style="color: #1e40af; font-weight: 700; font-size: 0.95rem;">
                                                        Rs. {{ number_format($est->total_expenditure, 2) }}
                                                    </strong>
                                                </div>
                                            </td>
                                            <td class="py-4 text-end align-middle">
                                                <div class="d-inline-block px-3 py-2" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 8px; border-left: 4px solid #f59e0b;">
                                                    <strong style="color: #92400e; font-weight: 700; font-size: 0.95rem;">
                                                        Rs. {{ number_format($actual->actual_total, 2) }}
                                                    </strong>
                                                </div>
                                            </td>
                                            <td class="py-4 text-end align-middle">
                                                <div class="d-inline-block px-3 py-2" style="background: linear-gradient(135deg, {{ $actual->balance < 0 ? '#fee2e2, #fecaca' : '#d1fae5, #a7f3d0' }}); border-radius: 8px; border-left: 4px solid {{ $actual->balance < 0 ? '#ef4444' : '#10b981' }};">
                                                    <strong style="color: {{ $actual->balance < 0 ? '#991b1b' : '#065f46' }}; font-weight: 700; font-size: 0.95rem;">
                                                        Rs. {{ number_format($actual->balance, 2) }}
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
                                                <a href="{{ route('user.actual-budget.show', $actual) }}" 
                                                   class="btn btn-sm"
                                                   style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); color: white; border: none; border-radius: 8px; padding: 8px 16px; box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3); transition: all 0.3s ease; font-weight: 500;">
                                                    <i class="fas fa-eye me-1"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer border-0 d-flex justify-content-center py-4" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
                        {{ $actualBudgets->links('pagination::bootstrap-5') }}
                    </div>
                </div>

                {{-- Summary Cards --}}
                <div class="row g-4 mt-4">
                    <div class="col-md-4">
                        <div class="card border-0" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 12px; box-shadow: 0 4px 16px rgba(245, 158, 11, 0.3);">
                            <div class="card-body text-white p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="mb-1" style="opacity: 0.9; font-size: 0.875rem;">Pending Review</p>
                                        <h3 class="mb-0 fw-bold">{{ $actualBudgets->where('status', 'pending')->count() }}</h3>
                                    </div>
                                    <i class="fas fa-clock" style="font-size: 2.5rem; opacity: 0.3;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 12px; box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);">
                            <div class="card-body text-white p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="mb-1" style="opacity: 0.9; font-size: 0.875rem;">Approved</p>
                                        <h3 class="mb-0 fw-bold">{{ $actualBudgets->where('status', 'approved')->count() }}</h3>
                                    </div>
                                    <i class="fas fa-check-circle" style="font-size: 2.5rem; opacity: 0.3;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border-radius: 12px; box-shadow: 0 4px 16px rgba(239, 68, 68, 0.3);">
                            <div class="card-body text-white p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="mb-1" style="opacity: 0.9; font-size: 0.875rem;">Rejected</p>
                                        <h3 class="mb-0 fw-bold">{{ $actualBudgets->where('status', 'rejected')->count() }}</h3>
                                    </div>
                                    <i class="fas fa-times-circle" style="font-size: 2.5rem; opacity: 0.3;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

<style>
    /* Hover effects for table rows */
    tbody tr:hover {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%) !important;
        transform: scale(1.005);
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.1);
    }

    /* Button hover effects */
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3) !important;
    }

    /* Smooth transitions */
    .btn, tbody tr, .card {
        transition: all 0.3s ease;
    }

    /* Summary card hover effect */
    .row .card:hover {
        transform: translateY(-4px);
    }
</style>

@endsection