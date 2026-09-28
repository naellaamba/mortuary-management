@extends('layouts.app')

@section('title', 'Payment Receipt')

@section('content')
<div class="container-fluid px-0">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1 text-white">🧾 Official Payment Receipt</h2>
                    <p class="text-muted mb-0">Receipt #: <strong class="text-primary font-monospace">{{ $payment->receipt_number ?? 'N/A' }}</strong></p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('payments.receipt', $payment->id) }}" class="btn btn-danger">
                        <i class="bi bi-file-earmark-pdf me-1"></i> Download PDF
                    </a>
                    <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>

            <div class="card p-4 p-md-5">
                <div class="text-center mb-4 pb-3 border-bottom border-secondary border-opacity-25">
                    <div class="brand-logo-icon mx-auto mb-2" style="width: 50px; height: 50px; font-size: 1.5rem;">
                        <i class="bi bi-shield-shaded"></i>
                    </div>
                    <h4 class="fw-bold text-white mb-0">MORTUARY MANAGEMENT SYSTEM</h4>
                    <p class="text-muted small">Official Transaction & Billing Voucher</p>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tbody>
                            <tr>
                                <th style="width: 35%;" class="text-muted">Receipt Number</th>
                                <td class="font-monospace fw-bold text-primary">{{ $payment->receipt_number ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Deceased Name</th>
                                <td class="fw-semibold text-white">{{ optional($payment->deceased)->full_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Payment Date</th>
                                <td>{{ $payment->payment_date ? $payment->payment_date->format('M d, Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Amount Paid</th>
                                <td class="fs-5 fw-bold text-success">{{ number_format((float) $payment->amount, 0) }} FCFA</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Payment Method</th>
                                <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method ?? 'Mobile Money')) }}</td>
                            </tr>
                            @if($payment->mobile_operator)
                                <tr>
                                    <th class="text-muted">Mobile Network</th>
                                    <td><span class="badge bg-primary">{{ $payment->mobile_operator }}</span></td>
                                </tr>
                            @endif
                            @if($payment->phone_number)
                                <tr>
                                    <th class="text-muted">Payer Phone</th>
                                    <td>{{ $payment->phone_number }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th class="text-muted">Transaction Status</th>
                                <td>
                                    @if($payment->status === 'successful' || $payment->status === 'paid')
                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Successful</span>
                                    @elseif($payment->status === 'pending')
                                        <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i> Pending</span>
                                    @else
                                        <span class="badge bg-danger">{{ ucfirst($payment->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                            @if($payment->campay_reference)
                                <tr>
                                    <th class="text-muted">CamPay Reference</th>
                                    <td class="font-monospace small text-muted">{{ $payment->campay_reference }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top border-secondary border-opacity-25">
                    <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary">
                        &larr; Back to Payment List
                    </a>
                    <a href="{{ route('payments.receipt', $payment->id) }}" class="btn btn-danger px-4">
                        <i class="bi bi-file-earmark-pdf me-1"></i> Download PDF Receipt
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection