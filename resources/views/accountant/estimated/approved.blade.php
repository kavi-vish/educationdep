@extends('layouts.app')

@section('content')
<div class="flex">
    @include('accountant.partials.sidebar')
<div class="max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold text-blue-700 mb-8 flex items-center gap-3">
        <i class="fas fa-check-circle"></i>
        Approved Estimated Budgets
    </h2>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="ps-6 py-4">No</th>
                        <th class="py-4">User</th>
                        <th class="py-4">Zone</th>
                        <th class="py-4">Subject</th>
                        <th class="py-4">Activity Code</th>
                        <th class="py-4 text-end">Total Amount</th>
                        <th class="py-4">Submitted Date</th>
                        <th class="pe-6 py-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($budgets as $budget)
                    <tr>
                        <td class="ps-6 py-4">{{ $loop->iteration }}</td>
                        <td class="py-4">{{ $budget->user?->name ?? 'N/A' }}</td>
                        <td class="py-4">{{ $budget->zone }}</td>
                        <td class="py-4">{{ Str::limit($budget->subject, 35) }}</td>
                        <td class="py-4 font-medium">{{ $budget->activity_code }}</td>
                        <td class="py-4 text-end font-bold text-green-600">
                            Rs. {{ number_format($budget->total_expenditure, 2) }}
                        </td>
                        <td class="py-4">{{ $budget->created_at->format('d M Y') }}</td>
                        <td class="pe-6 py-4 text-center">
                            <a href="{{ route('accountant.estimated.show', $budget->id) }}" 
                                class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> View Details
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-12 text-gray-500">
                            No approved estimated budgets found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection