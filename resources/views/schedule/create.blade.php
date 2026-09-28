@extends('layouts.app')

@section('title', 'Schedule Body Pickup')

@section('content')
<div class="container-fluid px-0">

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1 text-white">📅 Schedule Body Pickup</h2>
                    <p class="text-muted mb-0">Record release time, pickup logistics, and burial dates.</p>
                </div>
                <a href="{{ route('schedule.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <div class="card p-4 p-md-5">
                <form action="{{ route('schedule.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Select Deceased Person <span class="text-danger">*</span></label>
                        <select name="deceased_id" class="form-select" required>
                            <option value="">-- Choose Deceased Record --</option>
                            @foreach($deceaseds as $deceased)
                                <option value="{{ $deceased->id }}">
                                    {{ $deceased->full_name }} ({{ $deceased->identifier ?? 'ID: ' . $deceased->id }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Pickup / Release Date <span class="text-danger">*</span></label>
                            <input type="date" name="pickup_date" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pickup Time <span class="text-danger">*</span></label>
                            <input type="time" name="pickup_time" class="form-control" value="09:00" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Burial Date</label>
                        <input type="date" name="burial_date" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Special Notes & Family Instructions</label>
                        <textarea name="notes" rows="3" class="form-control" placeholder="e.g. Casket delivery, hearse arrangements, family representative contact..."></textarea>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('schedule.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-calendar-check me-1"></i> Save Schedule
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>
@endsection