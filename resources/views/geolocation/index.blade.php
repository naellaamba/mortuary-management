@extends('layouts.app')

@section('title', 'Mortuary Geolocation')

@section('content')
<div class="container-fluid px-0">

    {{-- Page Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1 text-white">📍 Nearby Mortuary Facilities & Geolocation</h2>
        <p class="text-muted mb-0">Search any city and area to locate available morgue facilities, distances, and contact details.</p>
    </div>

    {{-- Search Form Card --}}
    <div class="card mb-4">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('geolocation.search') }}">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-9">
                        <label for="location" class="form-label fw-bold">
                            Enter Location / City & Quarter
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-secondary text-muted"><i class="bi bi-geo-alt"></i></span>
                            <input
                                type="text"
                                name="location"
                                id="location"
                                class="form-control form-control-lg"
                                placeholder="e.g. Yaoundé, Odza or Douala, Akwa"
                                value="{{ old('location', $location ?? '') }}"
                                required
                            >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold">
                            <i class="bi bi-search me-1"></i> Locate Morgues
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Location Found Banner --}}
    @isset($displayName)
        <div class="alert alert-info border-0 mb-4 d-flex align-items-center gap-2" style="background: rgba(59, 130, 246, 0.15); color: #93c5fd;">
            <i class="bi bi-geo-fill fs-5"></i>
            <div>
                <strong>Matched Area:</strong> {{ $displayName }}
            </div>
        </div>
    @endisset

    {{-- Mortuary Results Grid --}}
    @isset($nearbyMortuaries)
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold mb-0 text-white">🏥 Nearby Mortuary Facilities</h4>
                <p class="text-muted small mb-0">{{ count($nearbyMortuaries) }} facilities found near your query</p>
            </div>
        </div>

        @if(count($nearbyMortuaries) > 0)
            <div class="row g-4 mb-4">
                @foreach($nearbyMortuaries as $mortuary)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title fw-bold text-white mb-0">
                                            🏥 {{ $mortuary['name'] }}
                                        </h5>
                                        <span class="badge bg-primary">
                                            {{ $mortuary['distance'] }} km
                                        </span>
                                    </div>

                                    <p class="text-info small mb-2">
                                        <i class="bi bi-pin-map-fill me-1"></i>
                                        {{ $mortuary['quarter'] }}, {{ $mortuary['city'] }}
                                    </p>

                                    @if(!empty($mortuary['address']))
                                        <p class="text-muted small mb-2">
                                            {{ $mortuary['address'] }}
                                        </p>
                                    @endif

                                    @if(!empty($mortuary['description']))
                                        <p class="text-muted small">
                                            {{ $mortuary['description'] }}
                                        </p>
                                    @endif
                                </div>

                                @if(!empty($mortuary['phone']))
                                    <div class="mt-3 pt-2 border-top border-secondary border-opacity-25 small text-white-50">
                                        <i class="bi bi-telephone-fill text-success me-1"></i> {{ $mortuary['phone'] }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Interactive Leaflet Map --}}
            <div class="card mb-4">
                <div class="card-header fw-bold">
                    <i class="bi bi-map-fill text-primary me-2"></i> Interactive Facility Map
                </div>
                <div class="card-body p-3">
                    <div id="mortuary-map" style="height: 450px; width: 100%; border-radius: 10px; overflow: hidden;"></div>
                </div>
            </div>

            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const mortuaries = @json($nearbyMortuaries);
                    if (!mortuaries || !mortuaries.length) return;

                    const map = L.map('mortuary-map');

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(map);

                    const markers = [];
                    mortuaries.forEach(function (mortuary) {
                        const marker = L.marker([mortuary.latitude, mortuary.longitude]).addTo(map);
                        marker.bindPopup(`
                            <div style="font-family: sans-serif; color: #111;">
                                <strong>${mortuary.name}</strong><br>
                                <span>${mortuary.quarter}, ${mortuary.city}</span><br>
                                <span style="color: #2563eb; font-weight: bold;">${mortuary.distance} km away</span>
                            </div>
                        `);
                        markers.push(marker);
                    });

                    const group = L.featureGroup(markers);
                    map.fitBounds(group.getBounds(), { padding: [40, 40] });
                });
            </script>
        @else
            <div class="alert alert-warning border-0" style="background: rgba(245, 158, 11, 0.15); color: #fde68a;">
                <i class="bi bi-exclamation-circle-fill me-2"></i> No mortuaries found for this search. Try searching for "Yaoundé" or "Douala".
            </div>
        @endif
    @endisset

</div>
@endsection