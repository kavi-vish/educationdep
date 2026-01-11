{{-- resources/views/user/estimated-budget/my-list.blade.php --}}
@extends('layouts.app')

@section('title', 'My Estimated Budgets')

@section('content')
<div class="flex">
    {{-- Sidebar --}}
    @include('user.partials.sidebar')

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-xl-11">
                <!-- Header Card -->
                <div class="card border-0 shadow-sm rounded-4 mb-5 overflow-hidden">
                    <div class="card-header bg-gradient text-white py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="text-center d-flex justify-content-between align-items-center">
                            <h2 class="mb-1 fw-bold ">
                                <i class="fas fa-list-alt me-3 "></i>Submitted Estimated Budget List
                            </h2>
                            <div class="position-absolute bottom-0 start-50 translate-middle-x mb-3">
            <a href="{{ route('user.estimated-budget.create') }}" 
               class="btn btn-warning btn-lg rounded-pill shadow-lg px-5 py-3 fw-bold hover-lift border-0"
               style="font-size: 1.1rem;">
                <i class="fas fa-plus-circle me-2 fa-lg"></i>
                Create New Budget
            </a>
        </div>
                        </div>
                    </div>
                </div>

                @if($budgets->count() == 0)
                    <!-- Empty State Card -->
                    <div class="card border-0 shadow-lg rounded-4 text-center py-5">
                        <div class="card-body p-5">
                            <i class="fas fa-folder-open fa-5x text-muted mb-4 opacity-50"></i>
                            <h4 class="text-muted mb-3">No budgets submitted yet</h4>
                            <p class="text-secondary mb-4">Start planning by creating your first estimated budget.</p>
                            <a href="{{ route('user.estimated-budget.create') }}" class="btn btn-success btn-lg rounded-pill px-5 shadow hover-lift">
                                <i class="fas fa-plus me-2"></i>Create Your First Budget
                            </a>
                        </div>
                    </div>
                @else
                    <!-- Budgets List Card -->
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle mb-0 border border-3">
                                    <thead class="bg-light text-dark fw-semibold">
                                        <tr>
                                            <th class="ps-4">#</th>
                                            <th>Zone</th>
                                            <th>Subject</th>
                                            <th>Activity Code</th>
                                            <th class="text-end">Estimated Total</th>
                                            <th class="text-end">Advance Amount</th>
                                            <th class="text-end">Balance</th>
                                            <th>Status</th>
                                            <th>Submitted On</th>
                                            <th class="text-center pe-4">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @foreach($budgets as $budget)
                                        <tr class="border-bottom">
                                            <td class="ps-4 fw-medium">{{ $loop->iteration }}</td>
                                            <td>
                                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                                    {{ $budget->zone }}
                                                </span>
                                            </td>
                                            <td class="fw-medium">
                                                {{ Str::limit($budget->subject, 40) }}
                                            </td>
                                            <td>
                                                <code class="bg-light px-2 py-1 rounded">{{ $budget->activity_code }}</code>
                                            </td>
                                            <td class="text-end fw-bold text-primary">
                                                Rs. {{ number_format($budget->estimated_total, 2) }}
                                            </td>
                                            <td class="text-end fw-medium">
                                                Rs. {{ number_format($budget->advance_amount ?? 0, 2) }}
                                            </td>
                                            <td class="text-end fw-bold {{ $budget->balance < 0 ? 'text-danger' : 'text-success' }}">
                                                Rs. {{ number_format(abs($budget->balance), 2) }}
                                                @if($budget->balance < 0)
                                                    <small>(Deficit)</small>
                                                @endif
                                            </td>
                                            <td>{!! $budget->status_badge !!}</td>
                                            <td class="text-muted">
                                                <i class="fas fa-calendar-alt me-2"></i>
                                                {{ $budget->created_at->format('d M Y') }}
                                            </td>
                                            <td class="text-center pe-4">
                                                <a href="{{ route('user.estimated-budget.show', $budget->id) }}"
                                                   class="btn btn-outline-primary btn-sm rounded-pill px-4 shadow-sm hover-lift"
                                                   title="View Details">
                                                    <i class="fas fa-eye me-1"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="card-footer bg-white border-0 py-4">
                            <div class="d-flex justify-content-center">
                                {{ $budgets->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Hover Lift Effect -->
<style>
    .hover-lift {
        transition: all 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
</style>
@endsection