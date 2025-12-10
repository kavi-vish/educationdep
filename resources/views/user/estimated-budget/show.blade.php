{{-- resources/views/user/estimated-budget/show.blade.php --}}
@extends('layouts.app')
@section('title', 'View Estimated Budget')

@section('content')
<div class="flex">
    {{-- Sidebar --}}
    @include('user.partials.sidebar')

    {{-- Main Content --}}
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Estimated Budget Details</h4>
            <a href="{{ route('user.estimated-budget.my-list') }}" class="btn btn-light btn-sm">
                Back to List
            </a>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-borderless table-sm">
                        <tr><th width="40%">Zone/Department :</th><td><strong>{{ $budget->zone }}</strong></td></tr>
                        <tr><th>Subject :</th><td>{{ $budget->subject }}</td></tr>
                        <tr><th>Activity code :</th><td>{{ $budget->activity_code }}</td></tr>
                        <tr><th>Activity description :</th><td>{{ $budget->activity_description }}</td></tr>
                        <tr><th>Programme :</th><td>{{ $budget->programme }}</td></tr>
                        <tr><th>Vote :</th><td>{{ $budget->vote }}</td></tr>
                        <tr><th>Venue :</th><td>{{ $budget->venue }}</td></tr>
                        <tr><th>Date :</th><td>{{ $budget->date?->format('d/m/Y') }}</td></tr>
                        <tr><th>Funding source :</th><td>{{ $budget->funding_source }}</td></tr>
                        <tr><th>Estimate authorization circular :</th><td>{{ $budget->estimate_authorization_circular }}</td></tr>
                        <tr><th>Date submitted for settlement :</th><td>{{ $budget->date_submitted_for_settlement?->format('d/m/Y') }}</td></tr>
                        <tr><th>Reference File No :</th><td>{{ $budget->reference_file_no }}</td></tr>
                        <tr><th>Invited participants :</th><td>{{ $budget->invited_participants }}</td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless table-sm">
                        <tr><th width="40%">Advance date :</th><td>{{ $budget->advance_date?->format('d/m/Y') }}</td></tr>
                        <tr><th>Advance amount :</th><td class="fw-bold">Rs. {{ number_format($budget->advance_amount ?? 0, 2) }}</td></tr>
                        <tr><th>Total expenditure :</th><td class="fw-bold">Rs. {{ number_format($budget->estimated_total, 2) }}</td></tr>
                        <tr><th>Balance :</th><td class="fw-bold text-success">Rs. {{ number_format($budget->balance, 2) }}</td></tr>
                        <tr><th>Deficit Amount :</th>
                            <td class="fw-bold {{ $budget->deficit_amount > 0 ? 'text-danger' : '' }}">
                                Rs. {{ number_format($budget->deficit_amount, 2) }}
                            </td>
                        </tr>
                        <tr><th>Prepared By :</th><td>{{ $budget->prepared_by }}</td></tr>
                        <tr><th>Status :</th><td>{!! $budget->status_badge !!}</td></tr>
                        <tr><th>Submitted :</th><td>{{ $budget->created_at->format('d M Y h:i A') }}</td></tr>
                    </table>
                </div>
            </div>

            <h5 class="mb-3">Budget Details</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-sm text-center">
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
                            <td class="text-start">{{ $item->category }}</td>
                            <td>Rs. {{ number_format($item->rate, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->days_hours }}</td>
                            <td class="fw-bold">Rs. {{ number_format($item->amount, 2) }}</td>
                        </tr>
                        @endforeach
                        <tr class="table-primary fw-bold">
                            <td colspan="4" class="text-end">Total</td>
                            <td>Rs. {{ number_format($budget->estimated_total, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4">
                <button onclick="window.print()" class="btn btn-outline-secondary btn-lg">
                    Print / Save as PDF
                </button>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print { display: none !important; }
    body { background: white; }
    .card { box-shadow: none; border: 1px solid #000; }
}
</style>
@endsection