@extends('layouts.app')

@section('title', 'Deceased Details')

@section('content')
<div class="container-fluid px-0">

    <div class="row justify-content-center">
        <div class="col-xl-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1 text-white">🪦 Deceased Record Details</h2>
                    <p class="text-muted mb-0">Identifier: <strong class="text-primary font-monospace">{{ $deceased->identifier ?? 'DEC-' . $deceased->id }}</strong></p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('faire-part.create', ['deceased_id' => $deceased->id]) }}" class="btn btn-outline-info">
                        <i class="bi bi-chat-quote me-1"></i> AI Notice
                    </a>
                    <a href="{{ route('deceased.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>

            <div class="card overflow-hidden">
                <div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.2) 0%, rgba(15, 23, 42, 0.6) 100%);">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon-circle mb-0" style="background: rgba(59, 130, 246, 0.3); color: #fff;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0 text-white">{{ $deceased->full_name }}</h4>
                            <div class="small text-muted">{{ ucfirst($deceased->gender) }} &bull; Admitted: {{ $deceased->admission_date ? \Carbon\Carbon::parse($deceased->admission_date)->format('M d, Y') : 'N/A' }}</div>
                        </div>
                    </div>
                    <div>
                        <span class="badge bg-success px-3 py-2">
                            <i class="bi bi-shield-check me-1"></i> Verified
                        </span>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="glass-card p-3" style="background: rgba(255, 255, 255, 0.02);">
                                <div class="text-muted small text-uppercase fw-bold mb-1">Date of Death</div>
                                <div class="fw-semibold text-white fs-6">{{ $deceased->date_of_death ? \Carbon\Carbon::parse($deceased->date_of_death)->format('F d, Y') : 'N/A' }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="glass-card p-3" style="background: rgba(255, 255, 255, 0.02);">
                                <div class="text-muted small text-uppercase fw-bold mb-1">Cause of Death</div>
                                <div class="fw-semibold text-white fs-6">{{ $deceased->cause_of_death ?? 'Not specified' }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="glass-card p-3" style="background: rgba(255, 255, 255, 0.02);">
                                <div class="text-muted small text-uppercase fw-bold mb-1">Storage Room & Type</div>
                                <div class="fw-semibold text-white fs-6">
                                    {{ $deceased->room_name ?? 'Room Unassigned' }}
                                    <span class="badge bg-secondary ms-2 text-uppercase">{{ $deceased->room_type ?? 'Standard' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="glass-card p-3" style="background: rgba(255, 255, 255, 0.02);">
                                <div class="text-muted small text-uppercase fw-bold mb-1">Unique Security Key</div>
                                <div class="fw-semibold text-warning font-monospace fs-6">{{ $deceased->security_key ?? 'N/A' }}</div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="glass-card p-3" style="background: rgba(255, 255, 255, 0.02);">
                                <div class="text-muted small text-uppercase fw-bold mb-1">Location & Address</div>
                                <div class="fw-semibold text-white">
                                    <i class="bi bi-geo-alt text-danger me-1"></i>
                                    {{ $deceased->location_address ?? 'No physical address provided' }}
                                </div>
                                @if($deceased->latitude && $deceased->longitude)
                                    <div class="text-muted small mt-1">Coordinates: {{ $deceased->latitude }}, {{ $deceased->longitude }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4 pt-3 border-top border-secondary border-opacity-25">
                        <a href="{{ route('deceased.edit', $deceased->id) }}" class="btn btn-primary">
                            <i class="bi bi-pencil me-1"></i> Edit Record
                        </a>
                        <a href="{{ route('payments.create') }}" class="btn btn-success">
                            <i class="bi bi-credit-card me-1"></i> Process Payment
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
