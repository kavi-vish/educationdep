@extends('layouts.app')

@section('content')
<div class="flex">
    @include('admin.partials.sidebar')
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-dark text-center py-4">
            <h3 class="mb-0 fw-bold">Actual Budget Details - {{ $actual->estimatedBudget->activity_code }}</h3>
        </div>

        <div class="card-body p-5">

            @if(session('success'))
                <div class="alert alert-success text-center fs-4">{{ session('success') }}</div>
            @endif

            @if($actual->status == 'pending')
                <div class="text-center mb-4">
                    <form action="{{ route('admin.actual.approve', $actual->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-success btn-lg px-5 shadow">Approve</button>
                    </form>
                    <form action="{{ route('admin.actual.reject', $actual->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-lg px-5 shadow">Reject</button>
                    </form>
                </div>
            @else
                <div class="alert alert-info text-center fs-4">
                    This actual budget is already <strong>{{ ucfirst($actual->status) }}</strong>
                </div>
            @endif

            <!-- FULL HEADER -->
            <div class="row g-3 mb-4">
                <div class="col-md-6"><strong>Zone/Department:</strong> {{ $actual->estimatedBudget->zone }}</div>
                <div class="col-md-6"><strong>Subject:</strong> {{ $actual->estimatedBudget->subject }}</div>
                <div class="col-md-6"><strong>Activity code:</strong> {{ $actual->estimatedBudget->activity_code }}</div>
                <div class="col-md-6"><strong>Activity description:</strong> {{ $actual->estimatedBudget->activity_description }}</div>
                <div class="col-md-6"><strong>Programme:</strong> {{ $actual->estimatedBudget->programme ?? '-' }}</div>
                <div class="col-md-6"><strong>Vote:</strong> {{ $actual->estimatedBudget->vote ?? '-' }}</div>
                <div class="col-md-6"><strong>Venue:</strong> {{ $actual->estimatedBudget->venue ?? '-' }}</div>
                <div class="col-md-6"><strong>Date:</strong> {{ $actual->estimatedBudget->date ?? '-' }}</div>
                <div class="col-12"><strong>Funding source:</strong> {{ $actual->estimatedBudget->funding_source ?? '-' }}</div>
                <div class="col-12"><strong>Estimate authorization circular:</strong> {{ $actual->estimatedBudget->estimate_authorization_circular ?? '-' }}</div>
                <div class="col-12"><strong>Date submitted for settlement:</strong> {{ $actual->estimatedBudget->date_submitted_for_settlement ?? '-' }}</div>
                <div class="col-12"><strong>Reference File No:</strong> {{ $actual->estimatedBudget->reference_file_no ?? '-' }}</div>
                <div class="col-12"><strong>Invited participants:</strong> {{ $actual->estimatedBudget->invited_participants ?? '-' }}</div>
            </div>

            <div class="mb-3">
                <strong>Advance date and amount:</strong> 
                <span class="badge bg-info fs-5">Rs. {{ number_format($actual->estimatedBudget->advance_amount ?? 0, 2) }}</span>
            </div>

            <div class="mb-3">
                <strong>Total expenditure:</strong> 
                <span class="badge bg-danger fs-5">Rs. {{ number_format($actual->actual_total, 2) }}</span>
            </div>

            <div class="mb-3">
                <strong>Balance:</strong> 
                <span class="badge {{ $actual->balance >= 0 ? 'bg-success' : 'bg-warning' }} fs-5">Rs. {{ number_format($actual->balance, 2) }}</span>
            </div>

            <div class="mb-3">
                <strong>Deficit Amount:</strong> 
                <span class="badge bg-warning fs-5">Rs. {{ number_format($actual->deficit_amount, 2) }}</span>
            </div>

            <div class="mb-4">
                <strong>Prepared By:</strong> {{ $actual->prepared_by }}
            </div>

            <hr class="my-5">

            <h4 class="text-center mb-4 fw-bold">Estimated Amounts vs Actual Amounts</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr class="table-light">
                            <th rowspan="2" class="text-center">Category</th>
                            <th colspan="4" class="bg-primary text-white text-center">Estimated Amounts</th>
                            <th colspan="4" class="bg-warning text-dark text-center">Actual Amounts</th>
                        </tr>
                        <tr class="table-light">
                            <th>rate</th><th>quantity</th><th>Number of days/hours</th><th>amount</th>
                            <th>rate</th><th>quantity</th><th>Number of days/hours</th><th>amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($actual->items as $item)
                        <tr>
                            <td class="text-start fw-medium">{{ $item->category }}</td>
                            <!-- Estimated -->
                            <td>{{ number_format($item->est_rate, 2) }}</td>
                            <td>{{ $item->est_quantity }}</td>
                            <td>{{ $item->est_days_hours }}</td>
                            <td class="fw-bold text-primary">{{ number_format($item->est_amount, 2) }}</td>
                            <!-- Actual -->
                            <td>{{ number_format($item->actual_rate, 2) }}</td>
                            <td>{{ $item->actual_quantity }}</td>
                            <td>{{ $item->actual_days_hours }}</td>
                            <td class="fw-bold text-danger">{{ number_format($item->actual_amount, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-dark text-white fw-bold fs-5">
                        <tr>
                            <td class="text-end">Total</td>
                            <td colspan="3" class="text-end">Rs. {{ number_format($actual->estimatedBudget->total_expenditure, 2) }}</td>
                            <td colspan="3"></td>
                            <td class="text-end">Rs. {{ number_format($actual->actual_total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="text-center mt-5">
                <button onclick="window.print()" class="btn btn-secondary btn-lg px-5">Print / Save as PDF</button>
            </div>
        </div>
    </div>
</div>
@endsection