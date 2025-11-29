{{-- resources/views/admin/projects.blade.php --}}
@extends('layouts.app')

@section('title', 'Projects Management')

@section('content')
<div class="d-flex">
    {{-- Keep your existing sidebar --}}
    @include('admin.partials.sidebar')

    {{-- Main Content --}}
    <div class="flex-grow-1 bg-light" style="min-height: 100vh;">
        <div class="container-fluid py-4">

            {{-- Page Header with Export Button --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-primary mb-0">
                    <i class="fas fa-project-diagram me-2"></i> Projects Management
                </h3>
                <a href="{{ route('admin.projects.export') }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-download me-1"></i> Export Excel
                </a>
            </div>

            {{-- Success / Error Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Error!</strong> Please fix the following:
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Import Form Card --}}
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-body">
                    <form action="{{ route('admin.projects.import') }}" method="POST" enctype="multipart/form-data" class="row g-3 align-items-center">
                        @csrf
                        <div class="col-md-7">
                            <label for="file" class="form-label fw-bold">
                                <i class="fas fa-file-excel me-1"></i> Select Excel File
                            </label>
                            <input type="file" name="file" id="file" class="form-control" accept=".xlsx,.xls" required>
                            <div class="form-text text-muted">
                                Only <code>.xlsx</code> or <code>.xls</code> files (max 10MB)
                            </div>
                        </div>
                        <div class="col-md-3 d-grid">
                            <button type="submit" class="btn btn-success h-100">
                                <i class="fas fa-upload me-2"></i> Import Excel
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Projects Table Card --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 text-primary">
                        <i class="fas fa-table me-2"></i> List of Projects
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Strategy</th>
                                    <th>Activity No</th>
                                    <th>Activity</th>
                                    <th>Location</th>
                                    <th>Q1</th>
                                    <th>Q2</th>
                                    <th>Q3</th>
                                    <th>Q4</th>
                                    <th>Budget Head</th>
                                    <th>Programme</th>
                                    <th>Project</th>
                                    <th>Object Code</th>
                                    <th class="text-center">Units</th>
                                    <th class="text-end">Unit Cost ('000)</th>
                                    <th class="text-end">Est. R</th>
                                    <th class="text-end">Est. C</th>
                                    <th class="text-end">Est. T</th>
                                    <th>KPI</th>
                                    <th>Source of Funding</th>
                                    <th>Reference Plan</th>
                                    <th class="text-end">Total</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($projects as $p)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                        <td>{{ $p->strategy ?? '-' }}</td>
                                        <td><strong>{{ $p->activity_no }}</strong></td>
                                        <td>{{ Str::limit($p->activity_description, 60) }}</td>
                                        <td>{{ $p->location ?? '-' }}</td>
                                        <td>{{ $p->q1 ?? '-' }}</td>
                                        <td>{{ $p->q2 ?? '-' }}</td>
                                        <td>{{ $p->q3 ?? '-' }}</td>
                                        <td>{{ $p->q4 ?? '-' }}</td>
                                        <td>{{ $p->budget_head }}</td>
                                        <td>{{ $p->programme }}</td>
                                        <td>{{ $p->project }}</td>
                                        <td><code>{{ $p->object_code }}</code></td>
                                        <td class="text-center">{{ $p->no_of_units ?? '-' }}</td>
                                        <td class="text-end">{{ number_format($p->unit_cost, 2) }}</td>
                                        <td class="text-end">{{ number_format($p->estimated_cost_r, 2) }}</td>
                                        <td class="text-end">{{ number_format($p->estimated_cost_c, 2) }}</td>
                                        <td class="text-end">{{ number_format($p->estimated_cost_t, 2) }}</td>
                                        <td>{{ Str::limit($p->kpi, 30) }}</td>
                                        <td>
                                            <span class="badge bg-info text-dark">
                                                {{ $p->funding_source ?? '-' }}
                                            </span>
                                        </td>
                                        <td>{{ $p->reference_plan ?? '-' }}</td>
                                        <td class="text-end fw-bold text-primary">
                                            {{ number_format($p->total, 2) }}
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $statusClass = match($p->status) {
                                                    'Approved'  => 'bg-success',
                                                    'Pending'   => 'bg-warning text-dark',
                                                    'Rejected'  => 'bg-danger',
                                                    'Completed' => 'bg-primary',
                                                    default     => 'bg-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ $p->status }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="22" class="text-center py-5 text-muted">
                                            <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                            <h5>No projects yet.</h5>
                                            <p class="mb-0">Import an Excel file to get started.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer bg-white border-top d-flex justify-content-center py-3">
                        {{ $projects->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

{{-- Optional: Custom CSS --}}
@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #0056b3) !important;
    }
    .table th {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #495057;
    }
    .badge {
        font-size: 0.75rem;
    }
    .card {
        border-radius: 0.75rem;
    }
    .form-control, .btn {
        border-radius: 0.5rem;
    }
</style>
@endpush