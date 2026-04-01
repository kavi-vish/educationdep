@extends('layouts.accountant')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="card shadow-xl">
        <div class="card-header bg-primary text-white text-center py-4">
            <h3 class="mb-0 fw-bold">Estimated Budget Details - {{ $budget->activity_code }}</h3>
        </div>

        <div class="card-body p-5">

            <!-- Header Details -->
            <div class="row g-3 mb-5">
                <div class="col-md-6"><strong>Zone/Department:</strong> {{ $budget->zone }}</div>
                <div class="col-md-6"><strong>Subject:</strong> {{ $budget->subject }}</div>
                <div class="col-md-6"><strong>Activity Code:</strong> {{ $budget->activity_code }}</div>
                <div class="col-md-6"><strong>Activity Description:</strong> {{ $budget->activity_description }}</div>
                <div class="col-md-6"><strong>Programme:</strong> {{ $budget->programme ?? '-' }}</div>
                <div class="col-md-6"><strong>Vote:</strong> {{ $budget->vote ?? '-' }}</div>
                <div class="col-md-6"><strong>Venue:</strong> {{ $budget->venue ?? '-' }}</div>
                <div class="col-md-6"><strong>Date:</strong> {{ $budget->date ?? '-' }}</div>
                <div class="col-12"><strong>Funding Source:</strong> {{ $budget->funding_source ?? '-' }}</div>
                <div class="col-12"><strong>Prepared By:</strong> {{ $budget->prepared_by }}</div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    <strong>Total Expenditure:</strong><br>
                    <span class="badge bg-success fs-5">Rs. {{ number_format($budget->total_expenditure, 2) }}</span>
                </div>
                <div class="col-md-4">
                    <strong>Balance:</strong><br>
                    <span class="badge bg-info fs-5">Rs. {{ number_format($budget->balance, 2) }}</span>
                </div>
                <div class="col-md-4">
                    <strong>Deficit Amount:</strong><br>
                    <span class="badge bg-warning fs-5">Rs. {{ number_format($budget->deficit_amount, 2) }}</span>
                </div>
            </div>

            <hr>

            <h4 class="text-center mb-4 fw-bold">Expense Breakdown</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Category</th>
                            <th>Rate</th>
                            <th>Quantity</th>
                            <th>Days/Hours</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($budget->items as $item)
                        <tr>
                            <td>{{ $item->category }}</td>
                            <td>{{ number_format($item->rate, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->days_hours }}</td>
                            <td class="fw-bold text-primary">Rs. {{ number_format($item->amount, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-primary fw-bold">
                        <tr>
                            <td colspan="4" class="text-end">Total</td>
                            <td>Rs. {{ number_format($budget->total_expenditure, 2) }}</td>
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