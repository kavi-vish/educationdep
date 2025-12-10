@extends('layouts.app')

@section('title', 'Upload Estimated Budget')


@section('content')
<div class="flex">
    {{-- Sidebar --}}
    @include('user.partials.sidebar')

    {{-- Main Content --}}
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h4 class="mb-0 text-center text-primary fw-bold">
                        Upload Your Estimated Budget Details Here
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('user.estimated-budget.store') }}" method="POST">
                        @csrf

                        <!-- Zone -->
                        <div class="mb-3">
                            <label class="form-label">Zone/Department :</label>
                            <select name="zone" class="form-select @error('zone') is-invalid @enderror" required>
                                <option value="">Select Zone</option>
                                @foreach(['Galle','Ambalangoda','Elpitiya','Udugama','Matara','Akuressa','Mulatiyana','Deniyaya','Hambantota','Tangalle','Walasmulla'] as $zone)
                                    <option value="{{ $zone }}" {{ old('zone') == $zone ? 'selected' : '' }}>{{ $zone }}</option>
                                @endforeach
                            </select>
                            @error('zone') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <!-- Subject -->
                        <div class="mb-3">
                            <label class="form-label">Subject :</label>
                            <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required>
                        </div>

                       

                        <!-- Activity Code -->
                        <div class="mb-3">
                            <label class="form-label">Activity code :</label>
                            <input type="text" name="activity_code" class="form-control" value="{{ old('activity_code') }}" required>
                        </div>

                        <!-- Activity Description -->
                        <div class="mb-3">
                            <label class="form-label">Activity description :</label>
                            <textarea name="activity_description" class="form-control" rows="2" required>{{ old('activity_description') }}</textarea>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Programme :</label>
                                <input type="text" name="programme" class="form-control" value="{{ old('programme') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Vote :</label>
                                <input type="text" name="vote" class="form-control" value="{{ old('vote') }}">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Venue :</label>
                                <input type="text" name="venue" class="form-control" value="{{ old('venue') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date :</label>
                                <input type="date" name="date" class="form-control" value="{{ old('date') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Funding source :</label>
                            <input type="text" name="funding_source" class="form-control" value="{{ old('funding_source') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estimate authorization circular :</label>
                            <input type="text" name="estimate_authorization_circular" class="form-control" value="{{ old('estimate_authorization_circular') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date submitted for settlement :</label>
                            <input type="date" name="date_submitted_for_settlement" class="form-control" value="{{ old('date_submitted_for_settlement') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Reference File No :</label>
                            <input type="text" name="reference_file_no" class="form-control" value="{{ old('reference_file_no') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Invited participants :</label>
                            <textarea name="invited_participants" class="form-control" rows="2">{{ old('invited_participants') }}</textarea>
                        </div>

                        <!-- Advance Date & Amount (Separate) -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Advance date :</label>
                                <input type="date" name="advance_date" class="form-control" value="{{ old('advance_date') }}">
                            </div>
                            <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="fw-bold">Estimated Total (from table) :</label>
                                <input type="text" id="estimatedTotalDisplay" class="form-control bg-light" readonly value="0.00">
                                <input type="hidden" name="estimated_total" id="estimatedTotalInput">
                            </div>

                            

                            <div class="col-md-4">
                               <label class="fw-bold">Advance Amount :</label>
                               <input type="number" step="0.01" name="advance_amount" id="advanceAmount" class="form-control bg-info text-black fw-bold" 
                                value="{{ old('advance_amount') }}" placeholder="0.00">
                            </div>
                        </div>
                        <div class="col-md-4">
                                <label class="fw-bold text-danger">Total expenditure (Actual Spent) :</label>
                                <input type="number" step="0.01" name="total_expenditure" id="actualSpent" class="form-control border-danger" 
                                  value="{{ old('total_expenditure', 0) }}" placeholder="How much did you spend?">
                            </div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <label class="fw-bold text-success">Balance (Auto) :</label>
        <input type="text" id="balanceDisplay" class="form-control bg-success text-black fw-bold" readonly value="0.00">
        <input type="hidden" name="balance" id="balanceInput">
    </div>

    <div class="col-md-6">
        <label class="fw-bold text-danger">Deficit Amount (if spent more) :</label>
        <input type="text" id="deficitDisplay" class="form-control {{ old('total_expenditure',0) > old('advance_amount',0) ? 'bg-danger text-white' : 'bg-light' }} fw-bold" readonly value="0.00">
        <input type="hidden" name="deficit_amount" id="deficitInput" value="0">
    </div>
</div>

                        <div class="mb-4">
                            <label class="form-label">Prepared By :</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                            <input type="hidden" name="prepared_by" value="{{ auth()->user()->name }}">
                        </div>

                        <!-- Budget Table -->
                        <h5 class="mb-3">Budget Details</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm text-center align-middle">
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
                                    <tr>
                                        <td class="text-start fw-medium">{{ $cat }}
                                            <input type="hidden" name="categories[]" value="{{ $cat }}">
                                        </td>
                                        <td><input type="number" step="0.01" name="rates[]" class="form-control form-control-sm rate"></td>
                                        <td><input type="number" name="quantities[]" class="form-control form-control-sm qty"></td>
                                        <td><input type="number" name="days_hours[]" class="form-control form-control-sm days"></td>
                                        <td><input type="text" class="form-control form-control-sm amount bg-light" readonly value="0.00" readonly></td>
                                    </tr>
                                    @endforeach

                                    <tr class="table-primary fw-bold">
                                        <td colspan="4" class="text-end">Total</td>
                                        <td><span id="grandTotal">0.00</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success btn-lg px-5 shadow">
                                Submit for Approval
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<!-- Auto Calculation Script -->
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
        document.querySelectorAll('tr').forEach(row => {
            const rate = parseFloat(row.querySelector('.rate')?.value) || 0;
            const qty  = parseFloat(row.querySelector('.qty')?.value) || 0;
            const day  = parseFloat(row.querySelector('.days')?.value) || 0;
            const amt  = rate * qty * day;
            if (row.querySelector('.amount')) {
                row.querySelector('.amount').value = amt.toFixed(2);
                estimatedTotal += amt;
            }
        });

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

        // Color coding
        const deficitField = document.getElementById('deficitDisplay');
        if (deficit > 0) {
            deficitField.classList.add('bg-danger', 'text-white');
            deficitField.classList.remove('bg-light');
        } else {
            deficitField.classList.remove('bg-danger', 'text-white');
            deficitField.classList.add('bg-light');
        }
    }

    // Run on any input change
    document.querySelectorAll('.rate, .qty, .days, #actualSpent, #advanceAmount').forEach(el => {
        el.addEventListener('input', calculateAll);
    });

    // Run once on page load (in case of validation errors)
    calculateAll();
});
</script>
@endsection