@extends('layouts.app')

@section('content')
<div class="flex">
    @include('admin.partials.sidebar')
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center py-4">
            <h3>Estimated Budget Details - {{ $budget->activity_code }}</h3>
        </div>
        <div class="card-body p-5">

            @if(session('success'))
                <div class="alert alert-success text-center fs-4">{{ session('success') }}</div>
            @endif

            @if($budget->status == 'pending')
                <div class="text-center mb-4">
                    <form action="{{ route('admin.estimated.approve', $budget->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-success btn-lg px-5 shadow">Approve</button>
                    </form>
                    <form action="{{ route('admin.estimated.reject', $budget->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-lg px-5 shadow">Reject</button>
                    </form>
                </div>
            @else
                <div class="alert alert-info text-center fs-4">
                    This budget is already <strong>{{ ucfirst($budget->status) }}</strong>
                </div>
            @endif

            <!-- FULL HEADER -->
            <div class="row g-3 mb-4">
                <div class="col-md-6"><strong>Zone/Department:</strong> {{ $budget->zone }}</div>
                <div class="col-md-6"><strong>Subject:</strong> {{ $budget->subject }}</div>
                <div class="col-md-6"><strong>Activity code:</strong> {{ $budget->activity_code }}</div>
                <div class="col-md-6"><strong>Activity description:</strong> {{ $budget->activity_description }}</div>
                <!-- Add all other header fields here -->
            </div>

            <div class="mb-3">
                <strong>Advance date and amount:</strong> Rs. {{ number_format($budget->advance_amount ?? 0, 2) }}
            </div>

            <div class="mb-3">
                <strong>Total expenditure:</strong> Rs. {{ number_format($budget->total_expenditure, 2) }}
            </div>

            <div class="mb-3">
                <strong>Balance:</strong> Rs. {{ number_format($budget->balance, 2) }}
            </div>

            <div class="mb-3">
                <strong>Deficit Amount:</strong> Rs. {{ number_format($budget->deficit_amount, 2) }}
            </div>

            <div class="mb-4">
                <strong>Prepared By:</strong> {{ $budget->prepared_by }}
            </div>

            <hr class="my-5">

            <h4 class="text-center mb-4 fw-bold">Budget Details</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Category</th>
                            <th>rate</th>
                            <th>quantity</th>
                            <th>Number of days/hours</th>
                            <th>amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($budget->items as $item)
                        <tr>
                            <td class="text-start">{{ $item->category }}</td>
                            <td>{{ number_format($item->rate, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->days_hours }}</td>
                            <td class="fw-bold text-primary">{{ number_format($item->amount, 2) }}</td>
                        </tr>
                        @endforeach
                        <tr class="table-primary fw-bold fs-5">
                            <td class="text-end">Total</td>
                            <td colspan="4">Rs. {{ number_format($budget->total_expenditure, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-5">
                <button onclick="window.print()" class="btn btn-secondary btn-lg px-5">Print / Save as PDF</button>
            </div>
        </div>
    </div>
</div>
@endsection