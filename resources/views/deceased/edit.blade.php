@extends('layouts.app')

@section('title', 'Edit Deceased Record')

@section('content')
<div class="container-fluid px-0">

    <div class="row justify-content-center">
        <div class="col-xl-9">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1 text-white">✏️ Edit Deceased Record</h2>
                    <p class="text-muted mb-0">Update information for <strong>{{ $deceased->full_name }}</strong></p>
                </div>
                <a href="{{ route('deceased.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back to Records
                </a>
            </div>

            <div class="card">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('deceased.update', $deceased->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h5 class="fw-bold text-primary mb-3"><i class="bi bi-person-badge me-2"></i> Personal Details</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $deceased->full_name) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select" required>
                                    <option value="Male" {{ old('gender', $deceased->gender) === 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $deceased->gender) === 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $deceased->date_of_birth) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Date of Death</label>
                                <input type="date" name="date_of_death" class="form-control" value="{{ old('date_of_death', $deceased->date_of_death) }}" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Cause of Death</label>
                                <input type="text" name="cause_of_death" class="form-control" value="{{ old('cause_of_death', $deceased->cause_of_death) }}" required>
                            </div>
                        </div>

                        <hr class="border-secondary opacity-25 my-4">

                        <h5 class="fw-bold text-info mb-3"><i class="bi bi-box-seam me-2"></i> Admission & Storage Details</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Admission Date</label>
                                <input type="date" name="admission_date" class="form-control" value="{{ old('admission_date', $deceased->admission_date) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Release Date</label>
                                <input type="date" name="release_date" class="form-control" value="{{ old('release_date', $deceased->release_date) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Room Type</label>
                                <select name="room_type" class="form-select">
                                    <option value="normal" {{ old('room_type', $deceased->room_type) === 'normal' ? 'selected' : '' }}>Normal</option>
                                    <option value="vip" {{ old('room_type', $deceased->room_type) === 'vip' ? 'selected' : '' }}>VIP</option>
                                    <option value="vvip" {{ old('room_type', $deceased->room_type) === 'vvip' ? 'selected' : '' }}>VVIP</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Room / Compartment Name</label>
                                <input type="text" name="room_name" class="form-control" value="{{ old('room_name', $deceased->room_name) }}">
                            </div>
                        </div>

                        <hr class="border-secondary opacity-25 my-4">

                        <h5 class="fw-bold text-warning mb-3"><i class="bi bi-geo-alt me-2"></i> Location</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label class="form-label">Location Address</label>
                                <input type="text" name="location_address" class="form-control" value="{{ old('location_address', $deceased->location_address) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Latitude</label>
                                <input type="text" name="latitude" class="form-control" value="{{ old('latitude', $deceased->latitude) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Longitude</label>
                                <input type="text" name="longitude" class="form-control" value="{{ old('longitude', $deceased->longitude) }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top border-secondary border-opacity-25">
                            <a href="{{ route('deceased.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="bi bi-save me-1"></i> Update Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
