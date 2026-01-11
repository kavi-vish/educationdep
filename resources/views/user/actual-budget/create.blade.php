@extends('layouts.app')

@section('content')

<style>
/* =======================
   UI ENHANCEMENTS ONLY
   ======================= */

.card {
    border-radius: 16px;
    border: none;
}

.card-header {
    background: linear-gradient(135deg, #16a34a, #22c55e);
    border-radius: 16px 16px 0 0;
}

.section-box {
    background: #f8fafc;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 24px;
    border-left: 5px solid #22c55e;
}

.table {
    border-radius: 12px;
    overflow: hidden;
}

.table thead th {
    vertical-align: middle;
    text-align: center;
    font-weight: 600;
}

.table tbody tr:hover {
    background-color: #f1f5f9;
}

.form-control-sm {
    border-radius: 8px;
    text-align: right;
}

.amount {
    font-size: 0.95rem;
}

tfoot td {
    background: #f8fafc !important;
}

.btn-lg {
    border-radius: 50px;
}

.badge {
    border-radius: 50px;
    padding: 0.6em 1em;
}
</style>

<div class="flex">
    {{-- Sidebar --}}
    @include('user.partials.sidebar')

    {{-- Main Content --}}
    <div class="container py-5">
        <div class="card shadow-lg">

            <div class="card-header text-white text-center py-4">
                <h3 class="mb-0 fw-bold">Upload Your Actual Budget Details Here</h3>
            </div>

            <div class="card-body p-5">

                {{-- SUCCESS MESSAGE --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center fs-4" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($estimates->isEmpty())
                    <div class="text-center py-5 bg-light rounded">
                        <h4>No Approved Estimated Budget Found</h4>
                        <a href="{{ route('user.estimated-budget.create') }}" class="btn btn-primary btn-lg">
                            Go to Estimated Budget Form
                        </a>
                    </div>
                @else
                    {{-- Project Dropdown --}}
                    <div class="text-center mb-5">
                        <form method="GET" action="{{ route('user.actual-budget.create') }}">
                            <label class="form-label fw-bold fs-5">Select Approved Project:</label>
                            <select name="estimate_id" class="form-select w-50 mx-auto form-select-lg"
                                    onchange="this.form.submit()">
                                <option value="">-- Choose Project --</option>
                                @foreach($estimates as $est)
                                    <option value="{{ $est->id }}" {{ $estimate?->id == $est->id ? 'selected' : '' }}>
                                        {{ $est->activity_code }} - {{ $est->subject }} ({{ $est->zone }})
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    @if($estimate)
                        <form action="{{ route('user.actual-budget.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="estimated_budget_id" value="{{ $estimate->id }}">

                            {{-- PROJECT DETAILS --}}
                            <div class="section-box">
                                <div class="row g-3">
                                    <div class="col-md-6"><strong>Zone/Department:</strong> {{ $estimate->zone }}</div>
                                    <div class="col-md-6"><strong>Subject:</strong> {{ $estimate->subject }}</div>
                                    <div class="col-md-6"><strong>Activity code:</strong> {{ $estimate->activity_code }}</div>
                                    <div class="col-md-6"><strong>Activity description:</strong> {{ $estimate->activity_description }}</div>
                                    <div class="col-md-6"><strong>Programme:</strong> {{ $estimate->programme ?? '-' }}</div>
                                    <div class="col-md-6"><strong>Vote:</strong> {{ $estimate->vote ?? '-' }}</div>
                                    <div class="col-md-6"><strong>Venue:</strong> {{ $estimate->venue ?? '-' }}</div>
                                    <div class="col-md-6"><strong>Date:</strong> {{ $estimate->date ?? '-' }}</div>
                                    <div class="col-12"><strong>Funding source:</strong> {{ $estimate->funding_source ?? '-' }}</div>
                                    <div class="col-12"><strong>Estimate authorization circular:</strong> {{ $estimate->estimate_authorization_circular ?? '-' }}</div>
                                    <div class="col-12"><strong>Date submitted for settlement:</strong> {{ $estimate->date_submitted_for_settlement ?? '-' }}</div>
                                    <div class="col-12"><strong>Reference File No:</strong> {{ $estimate->reference_file_no ?? '-' }}</div>
                                    <div class="col-12"><strong>Invited participants:</strong> {{ $estimate->invited_participants ?? '-' }}</div>
                                </div>
                            </div>

                            {{-- ADVANCE AMOUNT --}}
                            <div class="section-box d-flex justify-content-between align-items-center">
                                <strong>Advanced Amount:</strong>
                                <span class="badge bg-info fs-5">
                                    Rs. {{ number_format($estimate->advance_amount ?? 0, 2) }}
                                </span>
                            </div>

                            <h4 class="text-center mb-4 fw-bold text-gray-800">
                                Estimated Amounts vs Actual Amounts
                            </h4>

                            {{-- TABLE --}}
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Category</th>
                                            <th colspan="4" class="bg-primary text-dark">Estimated Amounts</th>
                                            <th colspan="4" class="bg-warning text-dark">Actual Amounts</th>
                                        </tr>
                                        <tr>
                                            <th>Rate</th><th>Qty</th><th>Days/Hours</th><th>Amount</th>
                                            <th>Rate</th><th>Qty</th><th>Days/Hours</th><th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($estimate->items as $item)
                                        <tr>
                                            <td class="fw-medium">{{ $item->category }}</td>
                                            <td class="text-end">{{ number_format($item->rate, 2) }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-center">{{ $item->days_hours }}</td>
                                            <td class="text-end fw-bold text-primary">{{ number_format($item->amount, 2) }}</td>

                                            <td><input type="number" step="0.01" name="actual_rate_{{ $item->id }}" class="form-control form-control-sm calc rate" value="{{ $item->rate }}"></td>
                                            <td><input type="number" name="actual_qty_{{ $item->id }}" class="form-control form-control-sm calc qty" value="{{ $item->quantity }}"></td>
                                            <td><input type="number" name="actual_days_{{ $item->id }}" class="form-control form-control-sm calc days" value="{{ $item->days_hours }}"></td>
                                            <td class="text-end fw-bold text-danger amount">0.00</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="fw-bold fs-5">
                                        <tr>
                                            <td class="text-end">Total</td>
                                            <td colspan="3" class="text-end">
                                                Rs. {{ number_format($estimate->total_expenditure, 2) }}
                                            </td>
                                            <td colspan="3"></td>
                                            <td class="text-end" id="actualTotal">0.00</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            {{-- ACTION BUTTONS --}}
                            <div class="text-center mt-5 d-flex justify-content-center gap-4 flex-wrap">
                                <button type="submit" class="btn btn-success btn-lg px-5 shadow">
                                    Submit Actual Budget
                                </button>
                                <button type="button" onclick="window.print()" class="btn btn-secondary btn-lg px-5">
                                    Print
                                </button>
                            </div>

                        </form>
                    @endif
                @endif

            </div>
        </div>
    </div>
</div>

<script>
function calculate() {
    let total = 0;
    document.querySelectorAll('tbody tr').forEach(row => {
        let rate = parseFloat(row.querySelector('.rate')?.value) || 0;
        let qty  = parseFloat(row.querySelector('.qty')?.value) || 0;
        let days = parseFloat(row.querySelector('.days')?.value) || 0;
        let amt  = rate * qty * days;
        row.querySelector('.amount').textContent = amt.toFixed(2);
        total += amt;
    });
    document.getElementById('actualTotal').textContent = total.toFixed(2);
}
document.querySelectorAll('.calc').forEach(el => el.addEventListener('input', calculate));
calculate();
</script>

@endsection
