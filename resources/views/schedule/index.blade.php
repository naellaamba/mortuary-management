@extends('layouts.app')

@section('title', 'Pickup Schedules')

@section('content')
<div class="container-fluid px-0">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold mb-1 text-white">📅 Body Pickup & Release Schedules</h2>
            <p class="text-muted mb-0">Coordinate body pickups, burial appointments, and release authorizations.</p>
        </div>
        <a href="{{ route('schedule.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="bi bi-calendar-plus-fill"></i>
            <span>Schedule New Pickup</span>
        </a>
    </div>

    {{-- Schedules Table Card --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-bold fs-6">Scheduled Pickups ({{ count($schedules) }})</span>
        </div>
        <div class="card-body p-0">
            @if($schedules->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-calendar-x fs-1 d-block mb-3 opacity-50"></i>
                    <h5>No pickup schedules recorded</h5>
                    <p class="small">Book pickup appointments for registered deceased bodies.</p>
                    <a href="{{ route('schedule.create') }}" class="btn btn-sm btn-primary mt-2">
                        <i class="bi bi-calendar-plus me-1"></i> Add Schedule
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Schedule ID</th>
                                <th>Deceased Person</th>
                                <th>Pickup Date</th>
                                <th>Pickup Time</th>
                                <th>Burial Date</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td>
                                        <span class="font-monospace text-primary fw-bold">#SCH-{{ str_pad($schedule->id, 4, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-white">{{ optional($schedule->deceased)->full_name ?? 'Deceased Record #' . $schedule->deceased_id }}</div>
                                        @if($schedule->notes)
                                            <div class="text-muted small">{{ Str::limit($schedule->notes, 40) }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-white">{{ $schedule->pickup_date ? \Carbon\Carbon::parse($schedule->pickup_date)->format('M d, Y') : 'N/A' }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $schedule->pickup_time ?? '09:00' }}</span>
                                    </td>
                                    <td>
                                        <div class="text-muted">{{ $schedule->burial_date ? \Carbon\Carbon::parse($schedule->burial_date)->format('M d, Y') : 'N/A' }}</div>
                                    </td>
                                    <td>
                                        @if(strtolower($schedule->status) === 'confirmed' || strtolower($schedule->status) === 'completed')
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle me-1"></i> Confirmed
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark">
                                                <i class="bi bi-hourglass-split me-1"></i> Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if(strtolower($schedule->status) === 'pending')
                                            <form action="{{ route('schedule.confirm', $schedule->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="bi bi-check-lg me-1"></i> Confirm
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted small"><i class="bi bi-check-all text-success me-1"></i> Ready</span>
                                        @endif
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