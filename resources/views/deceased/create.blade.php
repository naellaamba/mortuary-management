@extends('layouts.app')

@section('title', 'Register Deceased')

@section('content')
<div class="container-fluid px-0">

    <div class="row justify-content-center">
        <div class="col-xl-9">

            {{-- Top Navigation / Breadcrumb --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1 text-white">🪦 Register Deceased Person</h2>
                    <p class="text-muted mb-0">Record personal details, admission date, storage assignment and coordinates.</p>
                </div>
                <a href="{{ route('deceased.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back to List
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger py-2 px-3 mb-4" style="background: rgba(239, 68, 68, 0.15); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.3);">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('deceased.store') }}" method="POST">
                        @csrf

                        <h5 class="fw-bold text-primary mb-3"><i class="bi bi-person-badge me-2"></i> Personal Information</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" placeholder="e.g. Jean-Pierre Mbarga" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Gender <span class="text-danger">*</span></label>
                                <select name="gender" class="form-select" required>
                                    <option value="">-- Select Gender --</option>
                                    <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Date of Death <span class="text-danger">*</span></label>
                                <input type="date" name="date_of_death" class="form-control" value="{{ old('date_of_death') }}" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Cause of Death <span class="text-danger">*</span></label>
                                <input type="text" name="cause_of_death" class="form-control" value="{{ old('cause_of_death') }}" placeholder="e.g. Natural causes / Illness" required>
                            </div>
                        </div>

                        <hr class="border-secondary opacity-25 my-4">

                        <h5 class="fw-bold text-info mb-3"><i class="bi bi-box-seam me-2"></i> Mortuary Admission & Storage</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Admission Date <span class="text-danger">*</span></label>
                                <input type="date" name="admission_date" class="form-control" value="{{ old('admission_date', date('Y-m-d')) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Estimated Release Date</label>
                                <input type="date" name="release_date" class="form-control" value="{{ old('release_date') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Room Type</label>
                                <select name="room_type" class="form-select">
                                    <option value="normal" {{ old('room_type') === 'normal' ? 'selected' : '' }}>Normal (10,000 FCFA/day)</option>
                                    <option value="vip" {{ old('room_type') === 'vip' ? 'selected' : '' }}>VIP (25,000 FCFA/day)</option>
                                    <option value="vvip" {{ old('room_type') === 'vvip' ? 'selected' : '' }}>VVIP (50,000 FCFA/day)</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Room / Compartment Name</label>
                                <input type="text" name="room_name" class="form-control" value="{{ old('room_name') }}" placeholder="e.g. Room A - Tray 04">
                            </div>
                        </div>

                        <hr class="border-secondary opacity-25 my-4">

                        <h5 class="fw-bold text-warning mb-3"><i class="bi bi-geo-alt me-2"></i> Location & Geolocation</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label class="form-label">Location Address</label>
                                <input type="text" name="location_address" class="form-control" value="{{ old('location_address') }}" placeholder="e.g. Yaoundé General Hospital, Quarter Centre">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Latitude</label>
                                <input type="text" name="latitude" class="form-control" value="{{ old('latitude') }}" placeholder="e.g. 3.8480">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Longitude</label>
                                <input type="text" name="longitude" class="form-control" value="{{ old('longitude') }}" placeholder="e.g. 11.5021">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top border-secondary border-opacity-25">
                            <a href="{{ route('deceased.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">
                                <i class="bi bi-check2-circle me-1"></i> Register Deceased & Generate Identifier
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection