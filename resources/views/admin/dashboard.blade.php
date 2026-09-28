@extends('layouts.app')

@section('title', 'Admin Crypt Control')

@section('content')
<div class="container-fluid px-0">

    {{-- Admin Header Hero --}}
    <div class="glass-card p-4 p-md-5 mb-4 position-relative overflow-hidden" style="background: linear-gradient(135deg, rgba(127, 29, 29, 0.35) 0%, rgba(6, 10, 18, 0.9) 100%); border-color: rgba(239, 68, 68, 0.35);">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3" style="background: rgba(153, 27, 27, 0.2); border: 1px solid rgba(239, 68, 68, 0.4);">
                    <span class="badge bg-danger">Supreme Crypt Authority</span>
                    <span class="small text-danger-emphasis fw-semibold" style="font-family: 'Cinzel', serif;">Vault Registry & Operations</span>
                </div>
                <h1 class="fw-bold mb-2 text-white display-6 gothic-heading">
                    Administrator Crypt Control ⚰️
                </h1>
                <p class="text-muted mb-0" style="font-size: 0.95rem;">
                    Full oversight of mortuary capacity, financial transactions, deceased admissions, and staff activities.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <a href="{{ route('deceased.create') }}" class="btn btn-primary px-3 py-2 me-2">
                    <i class="bi bi-person-plus-fill me-1"></i> Admit Body
                </a>
                <a href="{{ route('payments.index') }}" class="btn btn-outline-light px-3 py-2">
                    <i class="bi bi-credit-card me-1"></i> Invoices
                </a>
            </div>
        </div>
    </div>

    {{-- 4 Primary Metric Cards --}}
    <div class="row g-4 mb-4">
        {{-- Total Deceased --}}
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card-gradient" style="background: linear-gradient(135deg, #450a0a 0%, #060911 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-icon-circle" style="background: rgba(239, 68, 68, 0.2); color: #fca5a5;">
                            💀
                        </div>
                        <div class="text-white-50 small text-uppercase fw-bold" style="font-family: 'Cinzel', serif; letter-spacing: 0.08em;">Total Bodies</div>
                        <div class="text-white fw-bold fs-2 mt-1">{{ $totalDeceased }}</div>
                    </div>
                    <a href="{{ route('deceased.index') }}" class="btn btn-sm btn-outline-light rounded-circle p-2" style="width: 36px; height: 36px;" title="View all">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="mt-3 pt-3 border-top border-white border-opacity-10 d-flex justify-content-between small text-white-50">
                    <span>Admitted to morgue</span>
                    <span class="text-danger"><i class="bi bi-shield-check"></i> Recorded</span>
                </div>
            </div>
        </div>

        {{-- Total Invoices --}}
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card-gradient" style="background: linear-gradient(135deg, #022c22 0%, #060911 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-icon-circle" style="background: rgba(16, 185, 129, 0.2); color: #6ee7b7;">
                            📜
                        </div>
                        <div class="text-white-50 small text-uppercase fw-bold" style="font-family: 'Cinzel', serif; letter-spacing: 0.08em;">Total Invoices</div>
                        <div class="text-white fw-bold fs-2 mt-1">{{ $totalPayments }}</div>
                    </div>
                    <a href="{{ route('payments.index') }}" class="btn btn-sm btn-outline-light rounded-circle p-2" style="width: 36px; height: 36px;" title="View all">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="mt-3 pt-3 border-top border-white border-opacity-10 d-flex justify-content-between small text-white-50">
                    <span>CamPay & Cash</span>
                    <span class="text-success"><i class="bi bi-check-circle"></i> Logged</span>
                </div>
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card-gradient" style="background: linear-gradient(135deg, #451a03 0%, #060911 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-icon-circle" style="background: rgba(245, 158, 11, 0.2); color: #fde68a;">
                            💰
                        </div>
                        <div class="text-white-50 small text-uppercase fw-bold" style="font-family: 'Cinzel', serif; letter-spacing: 0.08em;">Crypt Revenue</div>
                        <div class="text-white fw-bold fs-2 mt-1">{{ number_format($totalRevenue, 0) }} <small class="fs-6 text-white-50">FCFA</small></div>
                    </div>
                    <a href="{{ route('payments.index') }}" class="btn btn-sm btn-outline-light rounded-circle p-2" style="width: 36px; height: 36px;" title="View all">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="mt-3 pt-3 border-top border-white border-opacity-10 d-flex justify-content-between small text-white-50">
                    <span>Total billed</span>
                    <span class="text-warning"><i class="bi bi-graph-up-arrow"></i> Financials</span>
                </div>
            </div>
        </div>

        {{-- Total Schedules --}}
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card-gradient" style="background: linear-gradient(135deg, #3b0764 0%, #060911 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-icon-circle" style="background: rgba(168, 85, 247, 0.2); color: #d8b4fe;">
                            ⚰️
                        </div>
                        <div class="text-white-50 small text-uppercase fw-bold" style="font-family: 'Cinzel', serif; letter-spacing: 0.08em;">Body Pickups</div>
                        <div class="text-white fw-bold fs-2 mt-1">{{ $totalSchedules }}</div>
                    </div>
                    <a href="{{ route('schedule.index') }}" class="btn btn-sm btn-outline-light rounded-circle p-2" style="width: 36px; height: 36px;" title="View all">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="mt-3 pt-3 border-top border-white border-opacity-10 d-flex justify-content-between small text-white-50">
                    <span>Release bookings</span>
                    <span class="text-info"><i class="bi bi-clock"></i> Scheduled</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Secondary Analytics & Overview --}}
    <div class="row g-4 mb-4">
        {{-- System Overview --}}
        <div class="col-lg-7">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="fw-bold gothic-heading"><i class="bi bi-activity text-danger me-2"></i> Vault Capacities & System Health</span>
                    <span class="badge bg-danger">Crypt Sealed</span>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="glass-card p-3" style="background: rgba(255, 255, 255, 0.02);">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="text-muted small">Available Cold Vaults</span>
                                    <span class="badge bg-danger">{{ $availableRooms }}</span>
                                </div>
                                <div class="progress" style="height: 6px; background-color: #060912;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="glass-card p-3" style="background: rgba(255, 255, 255, 0.02);">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="text-muted small">Unconfirmed Invoices</span>
                                    <span class="badge bg-warning text-dark">{{ $pendingPayments }}</span>
                                </div>
                                <div class="progress" style="height: 6px; background-color: #060912;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="glass-card p-3" style="background: rgba(255, 255, 255, 0.02);">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="text-muted small">Registered Vault Keepers</span>
                                    <span class="badge bg-info text-dark">{{ $totalUsers }}</span>
                                </div>
                                <div class="progress" style="height: 6px; background-color: #060912;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="glass-card p-3" style="background: rgba(255, 255, 255, 0.02);">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="text-muted small">CamPay Mobile Money API</span>
                                    <span class="badge bg-success">Online</span>
                                </div>
                                <div class="progress" style="height: 6px; background-color: #060912;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top border-secondary border-opacity-25 d-flex justify-content-between align-items-center">
                        <span class="text-muted small">Crypt database synchronized in real-time</span>
                        <a href="{{ route('deceased.index') }}" class="btn btn-sm btn-outline-danger">
                            View All Admitted Bodies &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Admin Tools --}}
        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-header fw-bold gothic-heading">
                    <i class="bi bi-tools text-danger me-2"></i> Supreme Vault Directives
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush bg-transparent">
                        <a href="{{ route('storage.create') }}" class="list-group-item list-group-item-action bg-transparent text-white border-secondary border-opacity-25 d-flex align-items-center justify-content-between py-3">
                            <div>
                                <span class="me-2">🧊</span>
                                <strong>Add Cold Storage Tray / Chamber</strong>
                                <div class="text-muted small">Expand morgue compartment capacity</div>
                            </div>
                            <i class="bi bi-chevron-right text-muted"></i>
                        </a>

                        <a href="{{ route('faire-part.create') }}" class="list-group-item list-group-item-action bg-transparent text-white border-secondary border-opacity-25 d-flex align-items-center justify-content-between py-3">
                            <div>
                                <span class="me-2">🕯️</span>
                                <strong>AI Funeral Notice & Obituary</strong>
                                <div class="text-muted small">Draft solemn memorial announcements</div>
                            </div>
                            <i class="bi bi-chevron-right text-muted"></i>
                        </a>

                        <a href="{{ route('geolocation.index') }}" class="list-group-item list-group-item-action bg-transparent text-white border-0 d-flex align-items-center justify-content-between py-3">
                            <div>
                                <span class="me-2">📍</span>
                                <strong>Morgue Geolocation Map</strong>
                                <div class="text-muted small">Interactive map of mortuary facilities</div>
                            </div>
                            <i class="bi bi-chevron-right text-muted"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection