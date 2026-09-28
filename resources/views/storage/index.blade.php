@extends('layouts.app')

@section('title', 'Storage Rooms')

@section('content')
<div class="container-fluid px-0">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold mb-1 text-white">🏢 Storage Rooms & Compartments</h2>
            <p class="text-muted mb-0">Monitor room capacity, occupancy, and climate-controlled mortuary bays.</p>
        </div>
        <a href="{{ route('storage.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill"></i>
            <span>Add Storage Room</span>
        </a>
    </div>

    {{-- Storage Rooms Table Card --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-bold fs-6">Available & Occupied Rooms ({{ count($rooms) }})</span>
        </div>
        <div class="card-body p-0">
            @if($rooms->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-door-closed fs-1 d-block mb-3 opacity-50"></i>
                    <h5>No storage rooms created yet</h5>
                    <p class="small">Add storage rooms to manage mortuary capacity.</p>
                    <a href="{{ route('storage.create') }}" class="btn btn-sm btn-primary mt-2">
                        <i class="bi bi-plus-lg me-1"></i> Add Storage Room
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Room Number / Name</th>
                                <th>Max Capacity</th>
                                <th>Current Status</th>
                                <th>Current Occupants</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-white fs-6">
                                            <i class="bi bi-door-closed-fill text-primary me-2"></i>
                                            Room {{ $room->room_number }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $room->capacity }} bodies</span>
                                    </td>
                                    <td>
                                        @if(strtolower($room->status) === 'available')
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle me-1"></i> Available
                                            </span>
                                        @elseif(strtolower($room->status) === 'occupied' || strtolower($room->status) === 'full')
                                            <span class="badge bg-danger">
                                                <i class="bi bi-dash-circle me-1"></i> Occupied
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark">
                                                {{ ucfirst($room->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($room->deceaseds && count($room->deceaseds) > 0)
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach($room->deceaseds as $deceased)
                                                    <span class="badge bg-secondary">
                                                        {{ $deceased->full_name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-muted small fst-italic">Empty / Available</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('storage.edit', $room->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection