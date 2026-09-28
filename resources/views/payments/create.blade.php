@extends('layouts.app')

@section('title', 'Make Payment')

@section('content')
<div class="container-fluid px-0">

    <div class="row justify-content-center">
        <div class="col-xl-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1 text-white">💳 Record / Process Payment</h2>
                    <p class="text-muted mb-0">Record cash receipts or process instant CamPay Mobile Money transactions.</p>
                </div>
                <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back to History
                </a>
            </div>

            <div class="card p-4 p-md-5">
                <form action="{{ route('payments.store') }}" method="POST">
                    @csrf

                    {{-- Deceased Selection --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">Select Deceased Record <span class="text-danger">*</span></label>
                        <select name="deceased_id" class="form-select" required>
                            <option value="">-- Choose Deceased Person --</option>
                            @foreach($deceaseds as $deceased)
                                <option value="{{ $deceased->id }}">
                                    {{ $deceased->full_name }} ({{ $deceased->identifier ?? 'ID: ' . $deceased->id }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Amount & Date --}}
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Amount (FCFA) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-muted">FCFA</span>
                                <input type="number" name="amount" class="form-control" placeholder="e.g. 50000" min="100" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Payment Date <span class="text-danger">*</span></label>
                            <input type="date" name="payment_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    {{-- Payment Method Selection --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">Payment Method <span class="text-danger">*</span></label>
                        <select name="payment_method" id="payment_method" class="form-select" required>
                            <option value="mobile_money">CamPay Mobile Money (MTN / Orange)</option>
                            <option value="cash">Cash Payment</option>
                            <option value="bank_transfer">Bank Transfer</option>
                        </select>
                    </div>

                    {{-- Mobile Money Sub-fields --}}
                    <div id="mobile-money-section" class="p-3 rounded-3 mb-4" style="background: rgba(59, 130, 246, 0.08); border: 1px dashed rgba(59, 130, 246, 0.3);">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Mobile Money Network</label>
                                <select name="mobile_operator" id="mobile_operator" class="form-select">
                                    <option value="MTN">MTN Mobile Money</option>
                                    <option value="ORANGE">Orange Money</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Payer Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="e.g. 677123456">
                                <small class="text-muted">Enter the Cameroon phone number to receive payment prompt.</small>
                            </div>
                        </div>
                    </div>

                    {{-- Balance --}}
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Remaining Balance (FCFA)</label>
                            <input type="number" name="balance" class="form-control" value="0" min="0">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="pending">Pending</option>
                                <option value="paid">Paid / Confirmed</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top border-secondary border-opacity-25">
                        <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-success px-4 py-2 fw-semibold">
                            <i class="bi bi-credit-card me-1"></i> Submit Payment
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const paymentMethod = document.getElementById('payment_method');
    const mobileMoneySection = document.getElementById('mobile-money-section');
    const mobileOperator = document.getElementById('mobile_operator');
    const phoneNumber = document.getElementById('phone_number');

    function toggleMobileMoney() {
        if (paymentMethod.value === 'mobile_money') {
            mobileMoneySection.style.display = 'block';
            mobileOperator.required = true;
            phoneNumber.required = true;
        } else {
            mobileMoneySection.style.display = 'none';
            mobileOperator.required = false;
            phoneNumber.required = false;
        }
    }

    paymentMethod.addEventListener('change', toggleMobileMoney);
    toggleMobileMoney();
});
</script>
@endpush
@endsection