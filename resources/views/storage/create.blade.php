@extends('layouts.app')

@section('title', 'Add Storage Room')

@section('content')
<div class="container-fluid px-0">

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1 text-white">🏢 Add Storage Room</h2>
                    <p class="text-muted mb-0">Create a new morgue room or bay.</p>
                </div>
                <a href="{{ route('storage.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <div class="card p-4 p-md-5">
                <form method="POST" action="{{ route('storage.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Room Number / Identifier <span class="text-danger">*</span></label>
                        <input type="text" name="room_number" class="form-control" placeholder="e.g. A-101 or Cold Bay 2" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Capacity (Number of Bodies) <span class="text-danger">*</span></label>
                        <input type="number" name="capacity" class="form-control" min="1" value="1" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Initial Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="available">Available</option>
                            <option value="occupied">Occupied</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('storage.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i> Save Room
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>
@endsection