{{-- resources/views/user/estimated-budget/my-list.blade.php --}}
@extends('layouts.app')
@section('title', 'My Estimated Budgets')

@section('content')
<div class="flex">
    {{-- Sidebar --}}
    @include('user.partials.sidebar')
    {{-- Main Content --}}
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">My Submitted Estimated Budgets</h3>
        <a href="{{ route('user.estimated-budget.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Budget
        </a>
    </div>

    @if($budgets->count() == 0)
        <div class="alert alert-info text-center py-5">
            <h5>No budgets submitted yet</h5>
            <p>Start by creating your first estimated budget.</p>
            <a href="{{ route('user.estimated-budget.create') }}" class="btn btn-success mt-3">Create First Budget</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Zone</th>
                        <th>Subject</th>
                        <th>Activity Code</th>
                        <th>Estimated Total</th>
                        <th>Advance Amount</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Submitted</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($budgets as $budget)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $budget->zone }}</strong></td>
                        <td>{{ Str::limit($budget->subject, 30) }}</td>
                        <td>{{ $budget->activity_code }}</td>
                        <td class="text-end fw-bold">Rs. {{ number_format($budget->estimated_total, 2) }}</td>
                        <td class="text-end">Rs. {{ number_format($budget->advance_amount ?? 0, 2) }}</td>
                        <td class="text-end {{ $budget->balance < 0 ? 'text-danger' : 'text-success' }} fw-bold">
                            Rs. {{ number_format($budget->balance, 2) }}
                        </td>
                        <td>{!! $budget->status_badge !!}</td>
                        <td>{{ $budget->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('user.estimated-budget.show', $budget->id) }}" 
                               class="btn btn-sm btn-outline-primary" title="View Details">
                                View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $budgets->links() }}
        </div>
    @endif
</div>
@endsection