@extends('layouts.app')

@section('title', 'Verify Deceased Information')

@section('content')
<div class="container-fluid px-0">

    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">

            <div class="text-center mb-4">
                <div class="stat-icon-circle mx-auto mb-3" style="background: rgba(59, 130, 246, 0.2); color: #60a5fa; width: 64px; height: 64px; font-size: 1.8rem;">
                    <i class="bi bi-patch-check-fill"></i>
                </div>
                <h2 class="fw-bold text-white mb-2">Record Verification</h2>
                <p class="text-muted">Enter the unique security key provided upon admission to verify the deceased's identity and records.</p>
            </div>

            @if(session('error'))
                <div class="alert alert-danger border-0 mb-4" style="background: rgba(239, 68, 68, 0.15); color: #fca5a5;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                </div>
            @endif

            <div class="card p-4 p-md-5">
                <form action="/verify" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-bold text-white">Unique Security Key / Identifier</label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-secondary text-muted"><i class="bi bi-key-fill"></i></span>
                            <input
                                type="text"
                                name="key"
                                class="form-control form-control-lg font-monospace"
                                placeholder="e.g. 10-character key"
                                required
                                autofocus
                            >
                        </div>
                        <div class="form-text text-muted small mt-2">
                            The security key was generated during body registration to protect confidential records.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 fw-semibold">
                        <i class="bi bi-search me-2"></i> Verify & Retrieve Record
                    </button>
                </form>
            </div>

        </div>
    </div>

</div>
@endsection