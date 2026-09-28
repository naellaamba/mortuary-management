@extends('layouts.app')

@section('title', 'Staff Crypt Portal')

@section('content')
<div class="container-fluid px-0">

    {{-- Welcome Hero Card --}}
    <div class="glass-card p-4 p-md-5 mb-4 position-relative overflow-hidden" style="background: linear-gradient(135deg, rgba(127, 29, 29, 0.25) 0%, rgba(6, 10, 18, 0.9) 100%); border-color: rgba(239, 68, 68, 0.25);">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3" style="background: rgba(153, 27, 27, 0.2); border: 1px solid rgba(239, 68, 68, 0.3);">
                    <span class="badge bg-danger">Staff Keeper Active</span>
                    <span class="small text-danger-emphasis fw-semibold" style="font-family: 'Cinzel', serif;">Mortuary Staff Console</span>
                </div>
                <h1 class="fw-bold mb-2 text-white display-6 gothic-heading">
                    Vault Keeper Console, {{ auth()->user()->name }} 💀
                </h1>
                <p class="text-muted mb-0" style="font-size: 0.95rem;">
                    Record deceased body admissions, manage cold storage trays, process CamPay Mobile Money billing, and draft obituaries.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <a href="{{ route('deceased.create') }}" class="btn btn-primary px-4 py-2 me-2">
                    <i class="bi bi-person-plus-fill me-2"></i> Admit New Body
                </a>
            </div>
        </div>
    </div>

    {{-- Metric Cards --}}
    <div class="row g-4 mb-4">
        {{-- My Registered Deceased --}}
        <div class="col-md-4">
            <div class="stat-card-gradient" style="background: linear-gradient(135deg, #450a0a 0%, #060911 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-icon-circle" style="background: rgba(239, 68, 68, 0.2); color: #fca5a5;">
                            💀
                        </div>
                        <div class="text-white-50 small text-uppercase fw-bold" style="font-family: 'Cinzel', serif; letter-spacing: 0.08em;">Bodies Admitted by You</div>
                        <div class="text-white fw-bold fs-2 mt-1">{{ $totalDeceased ?? 0 }}</div>
                    </div>
                    <a href="{{ route('deceased.index') }}" class="btn btn-sm btn-outline-light rounded-circle p-2" style="width: 36px; height: 36px;">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="mt-3 pt-3 border-top border-white border-opacity-10 d-flex justify-content-between small text-white-50">
                    <span>Logged in crypt register</span>
                    <span class="text-danger"><i class="bi bi-check-circle"></i> Active</span>
                </div>
            </div>
        </div>

        {{-- My Payments / Revenue Processed --}}
        <div class="col-md-4">
            <div class="stat-card-gradient" style="background: linear-gradient(135deg, #022c22 0%, #060911 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-icon-circle" style="background: rgba(16, 185, 129, 0.2); color: #6ee7b7;">
                            💰
                        </div>
                        <div class="text-white-50 small text-uppercase fw-bold" style="font-family: 'Cinzel', serif; letter-spacing: 0.08em;">Payments Handled</div>
                        <div class="text-white fw-bold fs-2 mt-1">{{ number_format($myPayments->sum('amount') ?? 0, 0) }} <small class="fs-6 text-white-50">FCFA</small></div>
                    </div>
                    <a href="{{ route('payments.index') }}" class="btn btn-sm btn-outline-light rounded-circle p-2" style="width: 36px; height: 36px;">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="mt-3 pt-3 border-top border-white border-opacity-10 d-flex justify-content-between small text-white-50">
                    <span>Invoices processed</span>
                    <span class="text-info">{{ $myPayments->count() }} vouchers</span>
                </div>
            </div>
        </div>

        {{-- Available Storage Rooms --}}
        <div class="col-md-4">
            <div class="stat-card-gradient" style="background: linear-gradient(135deg, #451a03 0%, #060911 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-icon-circle" style="background: rgba(245, 158, 11, 0.2); color: #fde68a;">
                            🧊
                        </div>
                        <div class="text-white-50 small text-uppercase fw-bold" style="font-family: 'Cinzel', serif; letter-spacing: 0.08em;">Cold Vaults Ready</div>
                        <div class="text-white fw-bold fs-2 mt-1">{{ $availableRooms ?? 0 }}</div>
                    </div>
                    <a href="{{ route('storage.index') }}" class="btn btn-sm btn-outline-light rounded-circle p-2" style="width: 36px; height: 36px;">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="mt-3 pt-3 border-top border-white border-opacity-10 d-flex justify-content-between small text-white-50">
                    <span>Available morgue trays</span>
                    <span class="text-warning">Ready for intake</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Operations & Workflow Links --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header fw-bold gothic-heading">
                    <i class="bi bi-grid-fill text-danger me-2"></i> Vault Keeper Tasks
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('deceased.create') }}" class="glass-card p-3 d-flex align-items-center gap-3 text-decoration-none text-white h-100" style="background: rgba(255, 255, 255, 0.02); border-left: 3px solid #ef4444;">
                                <div class="stat-icon-circle mb-0" style="background: rgba(239, 68, 68, 0.15); color: #f87171;">
                                    💀
                                </div>
                                <div>
                                    <div class="fw-bold" style="font-family: 'Cinzel', serif;">Admit Body</div>
                                    <div class="text-muted small">Admit body & generate security key</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a href="{{ route('payments.create') }}" class="glass-card p-3 d-flex align-items-center gap-3 text-decoration-none text-white h-100" style="background: rgba(255, 255, 255, 0.02); border-left: 3px solid #10b981;">
                                <div class="stat-icon-circle mb-0" style="background: rgba(16, 185, 129, 0.15); color: #34d399;">
                                    💳
                                </div>
                                <div>
                                    <div class="fw-bold" style="font-family: 'Cinzel', serif;">Record Payment</div>
                                    <div class="text-muted small">Process Mobile Money or Cash</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a href="{{ route('schedule.create') }}" class="glass-card p-3 d-flex align-items-center gap-3 text-decoration-none text-white h-100" style="background: rgba(255, 255, 255, 0.02); border-left: 3px solid #f59e0b;">
                                <div class="stat-icon-circle mb-0" style="background: rgba(245, 158, 11, 0.15); color: #fbbf24;">
                                    ⚰️
                                </div>
                                <div>
                                    <div class="fw-bold" style="font-family: 'Cinzel', serif;">Schedule Pickup</div>
                                    <div class="text-muted small">Coordinate body release & burial</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a href="{{ route('faire-part.create') }}" class="glass-card p-3 d-flex align-items-center gap-3 text-decoration-none text-white h-100" style="background: rgba(255, 255, 255, 0.02); border-left: 3px solid #8b5cf6;">
                                <div class="stat-icon-circle mb-0" style="background: rgba(139, 92, 246, 0.15); color: #c084fc;">
                                    🕯️
                                </div>
                                <div>
                                    <div class="fw-bold" style="font-family: 'Cinzel', serif;">AI Obituary Generator</div>
                                    <div class="text-muted small">Draft notices & export PDF</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header fw-bold gothic-heading">
                    <i class="bi bi-qr-code text-danger me-2"></i> Security Verification
                </div>
                <div class="card-body">
                    <p class="text-muted small">
                        Verify identity and registration integrity by searching with the security key.
                    </p>
                    <form action="/verify" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small">Enter Security Key / Identifier</label>
                            <input type="text" name="key" class="form-control font-monospace" placeholder="DEC-..." required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-check-circle me-1"></i> Check Crypt Record
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection