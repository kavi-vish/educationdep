@extends('layouts.app')

@section('title', 'Upload Estimated Budget')

@section('content')
<div class="flex">
    @include('user.partials.sidebar')

    <div class="flex-grow-1 p-4" style="min-height: 100vh; background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-xl-10">

                    {{-- Header Card --}}
                    <div class="card border-0 mb-4" style="background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(37, 99, 235, 0.1);">
                        <div class="card-header border-0 py-4" style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); border-radius: 16px 16px 0 0;">
                            <h4 class="mb-0 text-center text-white fw-bold">
                                <i class="fas fa-file-upload me-2"></i> Upload Your Estimated Budget Details
                            </h4>
                        </div>
                    </div>

                    {{-- Main Form Card --}}
                    <div class="card border-0" style="background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(37, 99, 235, 0.08);">
                        <div class="card-body p-4 p-md-5">
                            <form action="{{ route('user.estimated-budget.store') }}" method="POST">
                                @csrf

                                {{-- Basic Information Section --}}
                                <div class="mb-5">
                                    <h5 class="mb-4 pb-2" style="color: #1e40af; font-weight: 700; border-bottom: 3px solid #dbeafe;">
                                        <i class="fas fa-info-circle me-2"></i> Basic Information
                                    </h5>

                                    <div class="row g-4">
                                        {{-- Zone --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-map-marker-alt me-1" style="color: #2563eb;"></i> Zone/Department <span class="text-danger">*</span>
                                            </label>
                                            <select name="zone" class="form-select @error('zone') is-invalid @enderror" required style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px;">
                                                <option value="">Select Zone</option>
                                                @foreach(['Galle','Ambalangoda','Elpitiya','Udugama','Matara','Akuressa','Mulatiyana','Deniyaya','Hambantota','Tangalle','Walasmulla'] as $zone)
                                                    <option value="{{ $zone }}" {{ old('zone') == $zone ? 'selected' : '' }}>{{ $zone }}</option>
                                                @endforeach
                                            </select>
                                            @error('zone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                        </div>

                                        {{-- Subject --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-tag me-1" style="color: #2563eb;"></i> Subject <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px;">
                                        </div>

                                        {{-- Activity Code --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-code me-1" style="color: #2563eb;"></i> Activity Code <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="activity_code" class="form-control" value="{{ old('activity_code') }}" required style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px;">
                                        </div>

                                        {{-- Programme --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-project-diagram me-1" style="color: #2563eb;"></i> Programme
                                            </label>
                                            <input type="text" name="programme" class="form-control" value="{{ old('programme') }}" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px;">
                                        </div>

                                        {{-- Activity Description --}}
                                        <div class="col-12">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-align-left me-1" style="color: #2563eb;"></i> Activity Description <span class="text-danger">*</span>
                                            </label>
                                            <textarea name="activity_description" class="form-control" rows="3" required style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px;">{{ old('activity_description') }}</textarea>
                                        </div>

                                        {{-- Vote --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-vote-yea me-1" style="color: #2563eb;"></i> Vote <span class="text-danger">*</span>
                                            </label>
                                            <select name="vote" class="form-select" required style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px;">
                                                <option value="">-- Select Vote --</option>
                                                @foreach(\App\Models\Vote::all() as $vote)
                                                    <option value="{{ $vote->vote_number }}" {{ old('vote') == $vote->vote_number ? 'selected' : '' }}>
                                                        {{ $vote->vote_number }} - {{ $vote->description }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- Venue --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-map-pin me-1" style="color: #2563eb;"></i> Venue
                                            </label>
                                            <input type="text" name="venue" class="form-control" value="{{ old('venue') }}" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px;">
                                        </div>

                                        {{-- Date --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="far fa-calendar-alt me-1" style="color: #2563eb;"></i> Date
                                            </label>
                                            <input type="date" name="date" class="form-control" value="{{ old('date') }}" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px;">
                                        </div>

                                        {{-- Funding Source --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-money-bill-wave me-1" style="color: #2563eb;"></i> Funding Source
                                            </label>
                                            <input type="text" name="funding_source" class="form-control" value="{{ old('funding_source') }}" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px;">
                                        </div>

                                        {{-- Authorization Circular --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-file-alt me-1" style="color: #2563eb;"></i> Estimate Authorization Circular
                                            </label>
                                            <input type="text" name="estimate_authorization_circular" class="form-control" value="{{ old('estimate_authorization_circular') }}" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px;">
                                        </div>

                                        {{-- Date Submitted --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="far fa-calendar-check me-1" style="color: #2563eb;"></i> Date Submitted for Settlement
                                            </label>
                                            <input type="date" name="date_submitted_for_settlement" class="form-control" value="{{ old('date_submitted_for_settlement') }}" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px;">
                                        </div>

                                        {{-- Reference File --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-folder me-1" style="color: #2563eb;"></i> Reference File No
                                            </label>
                                            <input type="text" name="reference_file_no" class="form-control" value="{{ old('reference_file_no') }}" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px;">
                                        </div>

                                        {{-- Invited Participants --}}
                                        <div class="col-12">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-users me-1" style="color: #2563eb;"></i> Invited Participants
                                            </label>
                                            <textarea name="invited_participants" class="form-control" rows="2" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px;">{{ old('invited_participants') }}</textarea>
                                        </div>
                                        {{-- Financial Summary Section --}}
                                <div class="mb-5">
                                    <h5 class="mb-4 pb-2" style="color: #1e40af; font-weight: 700; border-bottom: 3px solid #dbeafe;">
                                        <i class="fas fa-calculator me-2"></i> Financial Summary
                                    </h5>

                                    <div class="row g-4">
                                        {{-- Estimated Total --}}
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-chart-line me-1" style="color: #2563eb;"></i> Estimated Total
                                            </label>
                                            <input type="text" id="estimatedTotalDisplay" class="form-control fw-bold text-end" readonly value="0.00" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border: 2px solid #2563eb; border-radius: 10px; padding: 12px; color: #1e40af; font-size: 1.1rem;">
                                            <input type="hidden" name="estimated_total" id="estimatedTotalInput">
                                        </div>

                                        {{-- Advance Date --}}
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="far fa-calendar me-1" style="color: #2563eb;"></i> Advance Date
                                            </label>
                                            <input type="date" name="advance_date" class="form-control" value="{{ old('advance_date') }}" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px;">
                                        </div>

                                        {{-- Advance Amount --}}
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-money-check-alt me-1" style="color: #06b6d4;"></i> Advance Amount
                                            </label>
                                            <input type="number" step="0.01" name="advance_amount" id="advanceAmount" class="form-control fw-bold text-end" value="{{ old('advance_amount') }}" placeholder="0.00" style="background: linear-gradient(135deg, #cffafe 0%, #a5f3fc 100%); border: 2px solid #06b6d4; border-radius: 10px; padding: 12px; color: #0e7490; font-size: 1.1rem;">
                                        </div>

                                        {{-- Total Expenditure --}}
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-receipt me-1" style="color: #f59e0b;"></i> Total Expenditure (Actual Spent)
                                            </label>
                                            <input type="number" step="0.01" name="total_expenditure" id="actualSpent" class="form-control fw-bold text-end" value="{{ old('total_expenditure', 0) }}" placeholder="0.00" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border: 2px solid #f59e0b; border-radius: 10px; padding: 12px; color: #92400e; font-size: 1.1rem;">
                                        </div>

                                        {{-- Balance --}}
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-balance-scale me-1" style="color: #10b981;"></i> Balance (Auto)
                                            </label>
                                            <input type="text" id="balanceDisplay" class="form-control fw-bold text-end" readonly value="0.00" style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border: 2px solid #10b981; border-radius: 10px; padding: 12px; color: #065f46; font-size: 1.1rem;">
                                            <input type="hidden" name="balance" id="balanceInput">
                                        </div>

                                        {{-- Deficit Amount --}}
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-exclamation-triangle me-1" style="color: #ef4444;"></i> Deficit Amount
                                            </label>
                                            <input type="text" id="deficitDisplay" class="form-control fw-bold text-end" readonly value="0.00" style="background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px; color: #64748b; font-size: 1.1rem;">
                                            <input type="hidden" name="deficit_amount" id="deficitInput" value="0">
                                        </div>
                                    </div>
                                </div>

                                        {{-- Prepared By --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="color: #1e293b;">
                                                <i class="fas fa-user-edit me-1" style="color: #2563eb;"></i> Prepared By
                                            </label>
                                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px; background: #f8fafc;">
                                            <input type="hidden" name="prepared_by" value="{{ auth()->user()->name }}">
                                        </div>
                                    </div>
                                </div>

                                {{-- Budget Details Table Section --}}
                                <div class="mb-5">
                                    <h5 class="mb-4 pb-2" style="color: #1e40af; font-weight: 700; border-bottom: 3px solid #dbeafe;">
                                        <i class="fas fa-table me-2"></i> Budget Details
                                    </h5>

                                    <div class="table-responsive" style="border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(37, 99, 235, 0.08);">
                                        <table class="table table-hover mb-0" style="background: white;">
                                            <thead style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);">
                                                <tr>
                                                    <th class="py-3 ps-4" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase;">Category</th>
                                                    <th class="py-3 text-center" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase;">Rate</th>
                                                    <th class="py-3 text-center" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase;">Quantity</th>
                                                    <th class="py-3 text-center" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase;">Days/Hours</th>
                                                    <th class="py-3 pe-4 text-center" style="color: #1e40af; font-weight: 600; font-size: 0.875rem; text-transform: uppercase;">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $categories = [
                                                        'Resource Allowance 1','Resource Allowance 2','Resource Allowance 3',
                                                        'Workshop supervision','Financial supervision','subject coordinator allowance',
                                                        'subject clerk allowance','Account clerk allowance','K.K.S allowance',
                                                        'Driver allowance','Hall Charges','Refreshment cost','Stationery Cost',
                                                        'Fuel','Other 1','Other 2','Technical support allowance'
                                                    ];
                                                @endphp

                                                @foreach($categories as $i => $cat)
                                                <tr style="border-bottom: 1px solid #f1f5f9;">
                                                    <td class="py-3 ps-4" style="color: #475569; font-weight: 500;">
                                                        {{ $cat }}
                                                        <input type="hidden" name="categories[]" value="{{ $cat }}">
                                                    </td>
                                                    <td class="py-3 text-center">
                                                        <input type="number" step="0.01" name="rates[]" class="form-control form-control-sm rate text-center" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                                                    </td>
                                                    <td class="py-3 text-center">
                                                        <input type="number" name="quantities[]" class="form-control form-control-sm qty text-center" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                                                    </td>
                                                    <td class="py-3 text-center">
                                                        <input type="number" name="days_hours[]" class="form-control form-control-sm days text-center" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                                                    </td>
                                                    <td class="py-3 pe-4 text-center">
                                                        <input type="text" class="form-control form-control-sm amount text-center" readonly value="0.00" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; font-weight: 600; color: #059669;">
                                                    </td>
                                                </tr>
                                                @endforeach

                                                <tr style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);">
                                                    <td colspan="4" class="py-3 ps-4 text-end fw-bold" style="color: #1e40af; font-size: 1.1rem;">Grand Total</td>
                                                    <td class="py-3 pe-4 text-center fw-bold" style="color: #1e40af; font-size: 1.1rem;">
                                                        <span id="grandTotal">0.00</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                

                                {{-- Submit Button --}}
                                <div class="text-center">
                                    <button type="submit" class="btn btn-lg px-5 py-3" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; border-radius: 12px; font-weight: 600; font-size: 1.2rem; box-shadow: 0 4px 16px rgba(16, 185, 129, 0.4); transition: all 0.3s ease;">
                                        <i class="fas fa-paper-plane me-2"></i> Submit for Approval
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Auto Calculation Script --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const rates = document.querySelectorAll('.rate');
    const qtys  = document.querySelectorAll('.qty');
    const days  = document.querySelectorAll('.days');
    const actualSpentInput = document.getElementById('actualSpent');
    const advanceInput = document.getElementById('advanceAmount');

    function calculateAll() {
        // 1. Calculate Estimated Total from table
        let estimatedTotal = 0;
        document.querySelectorAll('tbody tr').forEach(row => {
            const rate = parseFloat(row.querySelector('.rate')?.value) || 0;
            const qty  = parseFloat(row.querySelector('.qty')?.value) || 0;
            const day  = parseFloat(row.querySelector('.days')?.value) || 0;
            const amt  = rate * qty * day;
            if (row.querySelector('.amount')) {
                row.querySelector('.amount').value = amt.toFixed(2);
                estimatedTotal += amt;
            }
        });

        document.getElementById('grandTotal').textContent = estimatedTotal.toFixed(2);
        document.getElementById('estimatedTotalDisplay').value = estimatedTotal.toFixed(2);
        document.getElementById('estimatedTotalInput').value = estimatedTotal.toFixed(2);

        // 2. Calculate Balance & Deficit
        const actualSpent = parseFloat(actualSpentInput.value) || 0;
        const advanceAmt  = parseFloat(advanceInput.value) || 0;
        const balance = advanceAmt - actualSpent;

        // Balance
        document.getElementById('balanceDisplay').value = balance.toFixed(2);
        document.getElementById('balanceInput').value = balance.toFixed(2);

        // Deficit (if spent more than advance)
        const deficit = actualSpent > advanceAmt ? (actualSpent - advanceAmt) : 0;
        document.getElementById('deficitDisplay').value = deficit.toFixed(2);
        document.getElementById('deficitInput').value = deficit.toFixed(2);

        // Color coding for deficit
        const deficitField = document.getElementById('deficitDisplay');
        if (deficit > 0) {
            deficitField.style.background = 'linear-gradient(135deg, #fee2e2 0%, #fecaca 100%)';
            deficitField.style.borderColor = '#ef4444';
            deficitField.style.color = '#991b1b';
        } else {
            deficitField.style.background = '#f8fafc';
            deficitField.style.borderColor = '#e2e8f0';
            deficitField.style.color = '#64748b';
        }
    }

    // Run on any input change
    document.querySelectorAll('.rate, .qty, .days, #actualSpent, #advanceAmount').forEach(el => {
        el.addEventListener('input', calculateAll);
    });

    // Run once on page load
    calculateAll();
});
</script>

<style>
    /* Button hover effect */
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(16, 185, 129, 0.5) !important;
    }

    /* Form input focus effects */
    .form-control:focus, .form-select:focus {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
    }

    /* Table row hover */
    tbody tr:hover {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%) !important;
    }

    /* Smooth transitions */
    .btn, .form-control, .form-select, tbody tr {
        transition: all 0.3s ease;
    }
</style>

@endsection