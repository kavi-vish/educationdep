@extends('layouts.app')

@section('title', 'My Actual Budgets')

@section('content')
<div class="flex">
    @include('user.partials.sidebar')
<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white text-center py-4">
            <h3 class="mb-0 fw-bold">Actual Budget Details</h3>
        </div>

        <div class="card-body p-5">

            <!-- Header -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <strong>Zone/Department :</strong>
                    <div class="border rounded p-2 bg-light">{{ $actual->estimatedBudget->zone }}</div>
                </div>
                <div class="col-md-6">
                    <strong>Subject :</strong>
                    <div class="border rounded p-2 bg-light">{{ $actual->estimatedBudget->subject }}</div>
                </div>
            </div>

            <div class="mb-3">
                <strong>Activity code :</strong>
                <div class="border rounded p-2 bg-light">{{ $actual->estimatedBudget->activity_code }}</div>
            </div>

            <div class="mb-3">
                <strong>Activity description :</strong>
                <div class="border rounded p-2 bg-light">{{ $actual->estimatedBudget->activity_description }}</div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6"><strong>Programme :</strong><div class="border rounded p-2 bg-light">{{ $actual->estimatedBudget->programme ?? '-' }}</div></div>
                <div class="col-md-6"><strong>Vote :</strong><div class="border rounded p-2 bg-light">{{ $actual->estimatedBudget->vote ?? '-' }}</div></div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6"><strong>Venue :</strong><div class="border rounded p-2 bg-light">{{ $actual->estimatedBudget->venue ?? '-' }}</div></div>
                <div class="col-md-6"><strong>Date :</strong><div class="border rounded p-2 bg-light">{{ $actual->estimatedBudget->date ?? '-' }}</div></div>
            </div>

            <div class="mb-3"><strong>Funding source :</strong><div class="border rounded p-2 bg-light">{{ $actual->estimatedBudget->funding_source ?? '-' }}</div></div>
            <div class="mb-3"><strong>Estimate authorization circular :</strong><div class="border rounded p-2 bg-light">{{ $actual->estimatedBudget->estimate_authorization_circular ?? '-' }}</div></div>
            <div class="mb-3"><strong>Date submitted for settlement :</strong><div class="border rounded p-2 bg-light">{{ $actual->estimatedBudget->date_submitted_for_settlement ?? '-' }}</div></div>
            <div class="mb-3"><strong>Reference File No :</strong><div class="border rounded p-2 bg-light">{{ $actual->estimatedBudget->reference_file_no ?? '-' }}</div></div>
            <div class="mb-3"><strong>Invited participants :</strong><div class="border rounded p-2 bg-light">{{ $actual->estimatedBudget->invited_participants ?? '-' }}</div></div>

            <div class="mb-3">
                <strong>Advance date and amount :</strong>
                <div class="border rounded p-2 bg-info text-dark fw-bold">
                    {{ $actual->estimatedBudget->advance_date ?? '-' }} | Rs. {{ number_format($actual->estimatedBudget->advance_amount ?? 0, 2) }}
                </div>
            </div>

            <div class="mb-3">
                <strong>Total expenditure :</strong>
                <div class="border rounded p-2 bg-danger text-dark fw-bold">
                    Rs. {{ number_format($actual->actual_total, 2) }}
                </div>
            </div>

            <div class="mb-3">
                <strong>Balance :</strong>
                <div class="border rounded p-2 {{ $actual->balance >= 0 ? 'bg-success text-dark' : 'bg-warning text-dark' }} fw-bold">
                    Rs. {{ number_format($actual->balance, 2) }}
                </div>
            </div>

            <div class="mb-3">
                <strong>Deficit Amount :</strong>
                <div class="border rounded p-2 bg-warning text-dark fw-bold">
                    Rs. {{ number_format($actual->deficit_amount, 2) }}
                </div>
            </div>

            <div class="mb-4">
                <strong>Prepared By :</strong>
                <div class="border rounded p-2 bg-light">{{ $actual->prepared_by }}</div>
            </div>

            <hr class="my-5">

            <h4 class="text-center mb-4 fw-bold">Estimated Amounts vs Actual Amounts</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th rowspan="2" width="22%">Category</th>
                            <th colspan="4" class="bg-primary text-dark">Estimated Amounts</th>
                            <th colspan="4" class="bg-warning text-dark">Actual Amounts</th>
                        </tr>
                        <tr>
                            <th>rate</th><th>quantity</th><th>Number of days/hours</th><th>amount</th>
                            <th>rate</th><th>quantity</th><th>Number of days/hours</th><th>amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($actual->items as $item)
                        <tr>
                            <td class="text-start fw-medium">{{ $item->category }}</td>
                            <td>{{ number_format($item->est_rate, 2) }}</td>
                            <td>{{ $item->est_quantity }}</td>
                            <td>{{ $item->est_days_hours }}</td>
                            <td class="fw-bold text-primary">{{ number_format($item->est_amount, 2) }}</td>
                            <td>{{ number_format($item->actual_rate, 2) }}</td>
                            <td>{{ $item->actual_quantity }}</td>
                            <td>{{ $item->actual_days_hours }}</td>
                            <td class="fw-bold text-danger">{{ number_format($item->actual_amount, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-dark text-dark fw-bold fs-5">
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
                <a href="{{ route('user.actual-budget.my-list') }}" class="btn btn-secondary btn-lg px-5">Back to List</a>
                <button onclick="window.print()" class="btn btn-success btn-lg px-5 shadow">Print / Save as PDF</button>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    body { background: white; }
    .card { box-shadow: none; border: 1px solid #000; }
}
</style>
@endsection