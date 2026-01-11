@extends('layouts.app')

@section('content')
<div class="flex">
    @include('admin.partials.sidebar')

    <div class="flex-grow-1 p-4" style="min-height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container-fluid">

            {{-- Page Header --}}
            <div class="card border-0 mb-4" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 16px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);">
                <div class="card-header border-0 d-flex justify-content-between align-items-center py-4" style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); border-radius: 16px 16px 0 0;">
                    <h4 class="mb-0 text-white fw-bold">
                        <i class="fas fa-project-diagram me-2"></i> Projects Management
                    </h4>
                    <a href="{{ route('admin.projects.export') }}" 
                       class="btn btn-light px-4"
                       style="border-radius: 10px; font-weight: 500; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15); transition: all 0.3s ease;">
                        <i class="fas fa-download me-2"></i> Export Excel
                    </a>
                </div>
            </div>

            {{-- Success Alert --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 mb-4" style="border-radius: 12px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Error Alert --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 mb-4" style="border-radius: 12px; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; box-shadow: 0 4px 16px rgba(239, 68, 68, 0.3);">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-exclamation-triangle me-3" style="font-size: 1.5rem;"></i>
                        <div class="flex-grow-1">
                            <strong>Error!</strong> Please fix the following:
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Import Form Card --}}
            <div class="card border-0 mb-4" style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px); border-radius: 16px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);">
                <div class="card-body p-4">
                    <form action="{{ route('admin.projects.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4 align-items-end">
                            <div class="col-md-8">
                                <label for="file" class="form-label fw-semibold mb-2" style="color: #1e293b;">
                                    <i class="fas fa-file-excel me-2" style="color: #10b981;"></i> Select Excel File
                                </label>
                                <input type="file" 
                                       name="file" 
                                       id="file" 
                                       class="form-control" 
                                       accept=".xlsx,.xls" 
                                       required
                                       style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px; font-size: 1rem;">
                                <small class="text-muted mt-2 d-block">
                                    <i class="fas fa-info-circle me-1"></i> Only <code>.xlsx</code> or <code>.xls</code> files (max 10MB)
                                </small>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" 
                                        class="btn w-100 py-3"
                                        style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; border-radius: 10px; font-weight: 600; font-size: 1.1rem; box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3); transition: all 0.3s ease;">
                                    <i class="fas fa-upload me-2"></i> Import Excel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Projects Table Card --}}
            <div class="card border-0" style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px); border-radius: 16px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); overflow: hidden;">
                <div class="card-header border-0 py-4" style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);">
                    <h5 class="mb-0 fw-bold" style="color: #1e40af;">
                        <i class="fas fa-table me-2"></i> List of Projects
                        <span class="badge ms-2" style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); border-radius: 8px; padding: 6px 12px;">
                            Total: {{ $projects->total() }}
                        </span>
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="border-collapse: separate; border-spacing: 0;">
                            <thead style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-bottom: 2px solid #2563eb;">
                                <tr>
                                    <th class="py-3 ps-4 text-center" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">#</th>
                                    <th class="py-3" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Strategy</th>
                                    <th class="py-3" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Activity No</th>
                                    <th class="py-3" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Description</th>
                                    <th class="py-3" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Location</th>
                                    <th class="py-3 text-center" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Q1</th>
                                    <th class="py-3 text-center" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Q2</th>
                                    <th class="py-3 text-center" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Q3</th>
                                    <th class="py-3 text-center" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Q4</th>
                                    <th class="py-3" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Budget Head</th>
                                    <th class="py-3" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Programme</th>
                                    <th class="py-3" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Project</th>
                                    <th class="py-3" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Object Code</th>
                                    <th class="py-3 text-center" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Units</th>
                                    <th class="py-3 text-end" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Unit Cost</th>
                                    <th class="py-3 text-end" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Est. R</th>
                                    <th class="py-3 text-end" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Est. C</th>
                                    <th class="py-3 text-end" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Est. T</th>
                                    <th class="py-3" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">KPI</th>
                                    <th class="py-3" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Funding</th>
                                    <th class="py-3" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Reference</th>
                                    <th class="py-3 text-end" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Total</th>
                                    <th class="py-3 pe-4 text-center" style="color: #1e40af; font-weight: 600; font-size: 0.813rem; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($projects as $p)
                                    <tr style="transition: all 0.3s ease; border-bottom: 1px solid #e5e7eb;">
                                        <td class="py-3 ps-4 text-center align-middle" style="color: #64748b; font-weight: 600;">{{ $loop->iteration }}</td>
                                        <td class="py-3 align-middle" style="color: #475569; font-size: 0.875rem;">{{ $p->strategy ?? '-' }}</td>
                                        <td class="py-3 align-middle">
                                            <span class="badge" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 6px; padding: 4px 10px; font-size: 0.813rem;">
                                                {{ $p->activity_no }}
                                            </span>
                                        </td>
                                        <td class="py-3 align-middle" style="color: #475569; font-size: 0.875rem; max-width: 250px;">
                                            <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $p->activity_description }}">
                                                {{ Str::limit($p->activity_description, 100) }}
                                            </div>
                                        </td>
                                        <td class="py-3 align-middle" style="color: #64748b; font-size: 0.875rem;">{{ $p->location ?? '-' }}</td>
                                        <td class="py-3 text-center align-middle" style="color: #64748b; font-size: 0.875rem;">{{ $p->q1 ?? '-' }}</td>
                                        <td class="py-3 text-center align-middle" style="color: #64748b; font-size: 0.875rem;">{{ $p->q2 ?? '-' }}</td>
                                        <td class="py-3 text-center align-middle" style="color: #64748b; font-size: 0.875rem;">{{ $p->q3 ?? '-' }}</td>
                                        <td class="py-3 text-center align-middle" style="color: #64748b; font-size: 0.875rem;">{{ $p->q4 ?? '-' }}</td>
                                        <td class="py-3 align-middle" style="color: #475569; font-size: 0.875rem;">{{ $p->budget_head }}</td>
                                        <td class="py-3 align-middle" style="color: #475569; font-size: 0.875rem;">{{ $p->programme }}</td>
                                        <td class="py-3 align-middle" style="color: #475569; font-size: 0.875rem;">{{ $p->project }}</td>
                                        <td class="py-3 align-middle">
                                            <code style="background: #f1f5f9; padding: 4px 8px; border-radius: 6px; color: #1e40af; font-size: 0.813rem;">
                                                {{ $p->object_code }}
                                            </code>
                                        </td>
                                        <td class="py-3 text-center align-middle" style="color: #64748b; font-size: 0.875rem; font-weight: 500;">{{ $p->no_of_units ?? '-' }}</td>
                                        <td class="py-3 text-end align-middle" style="color: #64748b; font-size: 0.875rem;">{{ number_format($p->unit_cost, 2) }}</td>
                                        <td class="py-3 text-end align-middle" style="color: #64748b; font-size: 0.875rem;">{{ number_format($p->estimated_cost_r, 2) }}</td>
                                        <td class="py-3 text-end align-middle" style="color: #64748b; font-size: 0.875rem;">{{ number_format($p->estimated_cost_c, 2) }}</td>
                                        <td class="py-3 text-end align-middle" style="color: #64748b; font-size: 0.875rem;">{{ number_format($p->estimated_cost_t, 2) }}</td>
                                        <td class="py-3 align-middle" style="color: #475569; font-size: 0.875rem; max-width: 200px;">
                                            <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $p->kpi }}">
                                                {{ Str::limit($p->kpi, 30) }}
                                            </div>
                                        </td>
                                        <td class="py-3 align-middle">
                                            <span class="badge" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); border-radius: 6px; padding: 5px 10px; font-size: 0.75rem;">
                                                {{ $p->funding_source ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="py-3 align-middle" style="color: #64748b; font-size: 0.875rem;">{{ $p->reference_plan ?? '-' }}</td>
                                        <td class="py-3 text-end align-middle">
                                            <strong style="color: #059669; font-weight: 700; font-size: 0.95rem;">
                                                {{ number_format($p->total, 2) }}
                                            </strong>
                                        </td>
                                        <td class="py-3 pe-4 text-center align-middle">
                                            @php
                                                $statusStyle = match($p->status) {
                                                    'Approved'  => 'background: linear-gradient(135deg, #10b981 0%, #059669 100%);',
                                                    'Pending'   => 'background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);',
                                                    'Rejected'  => 'background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);',
                                                    'Completed' => 'background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);',
                                                    default     => 'background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);'
                                                };
                                            @endphp
                                            <span class="badge" style="{{ $statusStyle }} border-radius: 8px; padding: 6px 12px; font-size: 0.75rem; font-weight: 500; color: white;">
                                                {{ $p->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="23" class="text-center py-5">
                                            <div class="py-5">
                                                <i class="fas fa-inbox mb-3" style="font-size: 4rem; color: #cbd5e1;"></i>
                                                <h5 style="color: #64748b; font-weight: 600;">No Projects Yet</h5>
                                                <p class="mb-0" style="color: #94a3b8; font-size: 0.875rem;">Import an Excel file to get started.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer border-0 d-flex justify-content-center py-4" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
                    {{ $projects->links('pagination::bootstrap-5') }}
                </div>
            </div>

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

    /* Form input focus effects */
    .form-control:focus {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
    }

    /* Code tag styling */
    code {
        font-family: 'Monaco', 'Menlo', 'Courier New', monospace;
    }
</style>

@endsection