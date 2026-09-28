@extends('layouts.app')

@section('title', 'Edit Storage Room')

@section('content')
<div class="container-fluid px-0">

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1 text-white">✏️ Edit Storage Room</h2>
                    <p class="text-muted mb-0">Update room parameters & status.</p>
                </div>
                <a href="{{ route('storage.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <div class="card p-4 p-md-5">
                <form method="POST" action="{{ route('storage.update', $storage->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Room Number / Identifier</label>
                        <input type="text" name="room_number" class="form-control" value="{{ old('room_number', $storage->room_number) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Capacity (Number of Bodies)</label>
                        <input type="number" name="capacity" class="form-control" min="1" value="{{ old('capacity', $storage->capacity) }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="available" {{ old('status', $storage->status) === 'available' ? 'selected' : '' }}>Available</option>
                            <option value="occupied" {{ old('status', $storage->status) === 'occupied' ? 'selected' : '' }}>Occupied</option>
                            <option value="maintenance" {{ old('status', $storage->status) === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('storage.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Update Room
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>
@endsection