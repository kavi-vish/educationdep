@extends('layouts.app')

@section('content')
<div class="flex">
    @include('admin.partials.sidebar')

    <div class="flex-grow-1 p-4" style="min-height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container-fluid">

            {{-- Page Header --}}
            <div class="card border-0 mb-4" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 16px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);">
                <div class="card-body text-center py-5">
                    <h2 class="mb-2" style="color: #1e40af; font-weight: 700; font-size: 2rem;">
                        <i class="fas fa-coins me-2"></i> Vote & Fund Management
                    </h2>
                    <p class="mb-0" style="color: #64748b; font-size: 1rem;">
                        Create votes, allocate monthly funds, and monitor balances easily
                    </p>
                </div>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 mb-4" style="border-radius: 12px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Create Vote Card --}}
            <div class="card border-0 mb-4" style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px); border-radius: 16px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); overflow: hidden;">
                <div class="card-header border-0" style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);">
                    <button class="btn w-100 text-start flex justify-content-between align-items-center p-3" 
                            type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#createVoteForm"
                            style="background: none; border: none; color: white; font-size: 1.25rem; font-weight: 600;">
                        <span><i class="fas fa-plus-circle me-2"></i> Create New Vote</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>

                <div class="collapse" id="createVoteForm">
                    <div class="card-body p-4" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
                        <form action="{{ route('admin.votes.create') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="color: #1e293b;">
                                        <i class="fas fa-hashtag me-1" style="color: #2563eb;"></i> Vote Number
                                    </label>
                                    <input type="text" 
                                           name="vote_number" 
                                           class="form-control" 
                                           placeholder="Eg: 1001" 
                                           required
                                           style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px; font-size: 1rem;">
                                    <small class="text-muted mt-1 d-block">Unique identifier for this vote</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="color: #1e293b;">
                                        <i class="fas fa-align-left me-1" style="color: #2563eb;"></i> Description
                                    </label>
                                    <input type="text" 
                                           name="description" 
                                           class="form-control" 
                                           placeholder="Eg: Training Programs" 
                                           required
                                           style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px; font-size: 1rem;">
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" 
                                            class="btn px-5 py-3"
                                            style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); color: white; border: none; border-radius: 10px; font-weight: 600; font-size: 1.1rem; box-shadow: 0 4px 16px rgba(37, 99, 235, 0.3); transition: all 0.3s ease;">
                                        <i class="fas fa-save me-2"></i> Create Vote
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Fund Allocation & Balances Grid --}}
            <div class="row g-4">

                {{-- Add Monthly Fund --}}
                <div class="col-lg-6">
                    <div class="card border-0 h-100" style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px); border-radius: 16px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);">
                        <div class="card-header border-0 py-4" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 16px 16px 0 0;">
                            <h4 class="mb-1 text-white fw-bold">
                                <i class="fas fa-money-bill-wave me-2"></i> Add Monthly Fund
                            </h4>
                            <p class="mb-0 text-white-50" style="font-size: 0.9rem;">
                                Allocate funds to an existing vote
                            </p>
                        </div>

                        <div class="card-body p-4">
                            <form action="{{ route('admin.votes.fund.add') }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label class="form-label fw-semibold" style="color: #1e293b;">
                                        <i class="fas fa-vote-yea me-1" style="color: #10b981;"></i> Select Vote
                                    </label>
                                    <select name="vote_id" 
                                            class="form-select" 
                                            required
                                            style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px; font-size: 1rem;">
                                        <option value="">-- Choose Vote --</option>
                                        @foreach($votes as $vote)
                                            <option value="{{ $vote->id }}">
                                                {{ $vote->vote_number }} - {{ $vote->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-6">
                                        <label class="form-label fw-semibold" style="color: #1e293b;">
                                            <i class="far fa-calendar me-1" style="color: #10b981;"></i> Year
                                        </label>
                                        <input type="number" 
                                               name="year" 
                                               class="form-control" 
                                               value="{{ date('Y') }}" 
                                               required
                                               style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px; font-size: 1rem;">
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label fw-semibold" style="color: #1e293b;">
                                            <i class="far fa-calendar-alt me-1" style="color: #10b981;"></i> Month
                                        </label>
                                        <select name="month" 
                                                class="form-select" 
                                                required
                                                style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px; font-size: 1rem;">
                                            @for($m = 1; $m <= 12; $m++)
                                                <option value="{{ $m }}" {{ $m == date('n') ? 'selected' : '' }}>
                                                    {{ date('F', mktime(0,0,0,$m,1)) }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold" style="color: #1e293b;">
                                        <i class="fas fa-dollar-sign me-1" style="color: #10b981;"></i> Amount (Rs.)
                                    </label>
                                    <input type="number" 
                                           step="0.01" 
                                           name="amount" 
                                           class="form-control text-end fw-bold" 
                                           placeholder="0.00" 
                                           required
                                           style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px; font-size: 1.25rem; color: #059669;">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold" style="color: #1e293b;">
                                        <i class="fas fa-comment me-1" style="color: #10b981;"></i> Remarks (Optional)
                                    </label>
                                    <textarea name="remarks" 
                                              class="form-control" 
                                              rows="3"
                                              style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 12px; font-size: 1rem;"></textarea>
                                </div>

                                <div class="text-end">
                                    <button type="submit" 
                                            class="btn px-5 py-3"
                                            style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; border-radius: 10px; font-weight: 600; font-size: 1.1rem; box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3); transition: all 0.3s ease;">
                                        <i class="fas fa-plus-circle me-2"></i> Add Fund
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Vote Balances --}}
                <div class="col-lg-6">
                    <div class="card border-0 h-100" style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px); border-radius: 16px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);">
                        <div class="card-header border-0 text-center py-4" style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); border-radius: 16px 16px 0 0;">
                            <h4 class="mb-0 text-white fw-bold">
                                <i class="fas fa-balance-scale me-2"></i> Current Vote Balances
                            </h4>
                        </div>

                        <div class="card-body p-4" style="max-height: 600px; overflow-y: auto;">
                            <div class="d-flex flex-column gap-3">
                                @forelse($votes as $vote)
                                    <div class="card border-0" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 12px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); transition: all 0.3s ease;">
                                        <div class="card-body p-4">
                                            <div class="mb-3">
                                                <h5 class="fw-bold mb-1" style="color: #1e293b;">
                                                    Vote {{ $vote->vote_number }}
                                                </h5>
                                                <p class="mb-0 text-muted" style="font-size: 0.9rem;">
                                                    {{ $vote->description }}
                                                </p>
                                            </div>

                                            <div class="row g-3">
                                                <div class="col-4 text-center">
                                                    <div class="p-3 rounded-3" style="background: rgba(16, 185, 129, 0.1);">
                                                        <p class="mb-1 text-muted small">Allocated</p>
                                                        <p class="mb-0 fw-bold" style="color: #059669; font-size: 0.95rem;">
                                                            Rs. {{ number_format($vote->total_allocated, 2) }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-4 text-center">
                                                    <div class="p-3 rounded-3" style="background: rgba(239, 68, 68, 0.1);">
                                                        <p class="mb-1 text-muted small">Used</p>
                                                        <p class="mb-0 fw-bold" style="color: #dc2626; font-size: 0.95rem;">
                                                            Rs. {{ number_format($vote->total_used, 2) }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-4 text-center">
                                                    <div class="p-3 rounded-3" style="background: {{ $vote->remaining < 0 ? 'rgba(239, 68, 68, 0.1)' : 'rgba(37, 99, 235, 0.1)' }};">
                                                        <p class="mb-1 text-muted small">Balance</p>
                                                        <p class="mb-0 fw-bold" style="color: {{ $vote->remaining < 0 ? '#dc2626' : '#1e40af' }}; font-size: 1rem;">
                                                            Rs. {{ number_format($vote->remaining, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-5">
                                        <i class="fas fa-inbox mb-3" style="font-size: 3rem; color: #cbd5e1;"></i>
                                        <h6 style="color: #64748b;">No votes created yet</h6>
                                        <p class="text-muted small">Create a vote to get started</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<style>
    /* Button hover effects */
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3) !important;
    }

    /* Card hover effects for vote balances */
    .card-body .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 16px rgba(37, 99, 235, 0.2) !important;
    }

    /* Smooth transitions */
    .btn, .card {
        transition: all 0.3s ease;
    }

    /* Custom scrollbar for vote balances */
    .card-body::-webkit-scrollbar {
        width: 6px;
    }

    .card-body::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    .card-body::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        border-radius: 10px;
    }

    /* Form input focus effects */
    .form-control:focus, .form-select:focus {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
    }

    /* Collapse icon rotation */
    [data-bs-toggle="collapse"] i.fa-chevron-down {
        transition: transform 0.3s ease;
    }

    [data-bs-toggle="collapse"]:not(.collapsed) i.fa-chevron-down {
        transform: rotate(180deg);
    }
</style>

@endsection