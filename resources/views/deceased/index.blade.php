@extends('layouts.app')

@section('title', 'Deceased Records')

@section('content')
<div class="container-fluid px-0">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold mb-1 text-white">🪦 Deceased Records</h2>
            <p class="text-muted mb-0">Manage registered deceased bodies, storage assignments, and status.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('faire-part.create') }}" class="btn btn-outline-info d-flex align-items-center gap-2">
                <i class="bi bi-chat-quote-fill"></i>
                <span>AI Funeral Notice</span>
            </a>
            <a href="{{ route('deceased.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="bi bi-plus-circle-fill"></i>
                <span>Register New Body</span>
            </a>
        </div>
    </div>

    {{-- Search and Filter Bar --}}
    <div class="card mb-4 border-0" style="background: rgba(255, 255, 255, 0.03);">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('deceased.index') }}" class="row g-2 align-items-center">
                <div class="col-md-9">
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-secondary text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Search by name, identifier or cause of death..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">Search</button>
                    @if(request('search'))
                        <a href="{{ route('deceased.index') }}" class="btn btn-outline-secondary">Clear</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Deceased Records Table Card --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-bold fs-6">Registered Records ({{ count($deceaseds) }})</span>
        </div>
        <div class="card-body p-0">
            @if($deceaseds->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-inbox fs-1 d-block mb-3 opacity-50"></i>
                    <h5>No deceased records found</h5>
                    <p class="small">Get started by registering a new record.</p>
                    <a href="{{ route('deceased.create') }}" class="btn btn-sm btn-primary mt-2">
                        <i class="bi bi-plus-lg me-1"></i> Register Deceased
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Identifier / Name</th>
                                <th>Gender</th>
                                <th>Date of Death</th>
                                <th>Admission Date</th>
                                <th>Location / Address</th>
                                <th>Room Type</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deceaseds as $deceased)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-white">{{ $deceased->full_name }}</div>
                                        <div class="small text-primary font-monospace">
                                            {{ $deceased->identifier ?? 'DEC-' . $deceased->id }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ strtolower($deceased->gender) === 'male' ? 'bg-info text-dark' : 'bg-pink text-white' }}" style="background-color: {{ strtolower($deceased->gender) === 'male' ? '#38bdf8' : '#f472b6' }};">
                                            {{ ucfirst($deceased->gender ?? 'N/A') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-white">{{ $deceased->date_of_death ? \Carbon\Carbon::parse($deceased->date_of_death)->format('M d, Y') : 'N/A' }}</div>
                                        @if($deceased->date_of_birth)
                                            <div class="text-muted small" style="font-size: 0.75rem;">Born: {{ \Carbon\Carbon::parse($deceased->date_of_birth)->format('M d, Y') }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-muted">{{ $deceased->admission_date ? \Carbon\Carbon::parse($deceased->admission_date)->format('M d, Y') : 'N/A' }}</div>
                                    </td>
                                    <td>
                                        <div class="text-muted small">
                                            <i class="bi bi-geo-alt text-danger me-1"></i>
                                            {{ $deceased->location_address ?? 'Not specified' }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary text-uppercase" style="font-size: 0.7rem;">
                                            {{ $deceased->room_type ?? 'Standard' }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('faire-part.create', ['deceased_id' => $deceased->id]) }}" class="btn btn-outline-info" title="Generate AI Obituary">
                                                <i class="bi bi-chat-quote"></i>
                                            </a>
                                            <a href="{{ route('deceased.edit', $deceased->id) }}" class="btn btn-outline-warning" title="Edit Record">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('deceased.destroy', $deceased->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this deceased record?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
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