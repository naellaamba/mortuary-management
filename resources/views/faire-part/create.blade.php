@extends('layouts.app')

@section('title', 'AI Funeral Notice Generator')

@section('content')
<div class="container-fluid px-0">

    <div class="row justify-content-center">
        <div class="col-xl-9">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1 text-white">🕊️ AI Funeral Notice & Obituary Generator</h2>
                    <p class="text-muted mb-0">Generate a dignified, solemn funeral announcement powered by Google Gemini AI.</p>
                </div>
                <a href="{{ route('deceased.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            @if(session('error'))
                <div class="alert alert-danger border-0 mb-4" style="background: rgba(239, 68, 68, 0.15); color: #fca5a5;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger border-0 mb-4" style="background: rgba(239, 68, 68, 0.15); color: #fca5a5;">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card p-4 p-md-5">
                <form method="POST" action="{{ route('faire-part.generate') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Deceased Selection --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold text-white">
                            Select Deceased Person <span class="text-danger">*</span>
                        </label>
                        <select name="deceased_id" class="form-select form-select-lg" required>
                            <option value="">-- Choose Deceased Record --</option>
                            @foreach($deceaseds as $deceased)
                                <option
                                    value="{{ $deceased->id }}"
                                    {{ (old('deceased_id', request('deceased_id')) == $deceased->id) ? 'selected' : '' }}
                                >
                                    {{ $deceased->full_name }} ({{ $deceased->identifier ?? 'ID: ' . $deceased->id }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Visual Theme Selection --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold text-white">
                            🎨 Choose Visual Presentation Theme
                        </label>
                        <div class="row g-3">
                            <div class="col-6 col-md-3">
                                <label class="card h-100 p-3 text-center border cursor-pointer" style="border: 2px solid #c5a059 !important; background: rgba(197, 160, 89, 0.08); cursor: pointer;">
                                    <input type="radio" name="theme" value="gold" class="form-check-input mx-auto mb-2" checked>
                                    <div class="fw-bold" style="color: #d4af37;">✨ Gold & Solemn</div>
                                    <small class="text-muted" style="font-size: 11px;">Noble golden borders & serif typography</small>
                                </label>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="card h-100 p-3 text-center border cursor-pointer" style="border: 2px solid #64748b !important; background: rgba(255, 255, 255, 0.05); cursor: pointer;">
                                    <input type="radio" name="theme" value="classic" class="form-check-input mx-auto mb-2">
                                    <div class="fw-bold text-white">✦ Classic B&W</div>
                                    <small class="text-muted" style="font-size: 11px;">Timeless, sober black & white</small>
                                </label>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="card h-100 p-3 text-center border cursor-pointer" style="border: 2px solid #3b82f6 !important; background: rgba(59, 130, 246, 0.08); cursor: pointer;">
                                    <input type="radio" name="theme" value="peace" class="form-check-input mx-auto mb-2">
                                    <div class="fw-bold" style="color: #60a5fa;">🕊️ Celestial Peace</div>
                                    <small class="text-muted" style="font-size: 11px;">Soft blue tones and peaceful motif</small>
                                </label>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="card h-100 p-3 text-center border cursor-pointer" style="border: 2px solid #b45309 !important; background: rgba(180, 83, 9, 0.08); cursor: pointer;">
                                    <input type="radio" name="theme" value="cross" class="form-check-input mx-auto mb-2">
                                    <div class="fw-bold" style="color: #f59e0b;">✝️ Christian Hope</div>
                                    <small class="text-muted" style="font-size: 11px;">Solemn cross & warm sepia accents</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Bereaved Family & Relatives --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold text-white">
                            👨‍👩‍👧‍👦 Bereaved Families & Relatives (Optional)
                        </label>
                        <textarea
                            name="family_notes"
                            class="form-control"
                            rows="3"
                            placeholder="e.g. The Mbarga, Kouam, and Dupont families, together with the children and grandchildren, announce with deep sorrow..."
                        >{{ old('family_notes') }}</textarea>
                        <div class="form-text text-muted small">
                            Names of families, children, and close relatives announcing the funeral.
                        </div>
                    </div>

                    {{-- Ceremony & Funeral Program --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold text-white">
                            ⛪ Funeral Program & Ceremony Details (Optional)
                        </label>
                        <textarea
                            name="ceremony_program"
                            class="form-control"
                            rows="4"
                            placeholder="e.g.&#10;- Friday 18:00 : Wake-keep and prayer service at the family residence&#10;- Saturday 09:00 : Body removal from morgue followed by church service&#10;- Saturday 14:00 : Burial at the municipal cemetery"
                        >{{ old('ceremony_program') }}</textarea>
                        <div class="form-text text-muted small">
                            Dates, times, and venues for vigils, church service, body release, and burial.
                        </div>
                    </div>

                    {{-- Biblical Verse / Memorial Quote --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold text-white">
                            📖 Scripture Verse or Memorial Thought (Optional)
                        </label>
                        <input
                            type="text"
                            name="custom_message"
                            class="form-control"
                            value="{{ old('custom_message') }}"
                            placeholder="e.g. « The Lord gave, and the Lord hath taken away; blessed be the name of the Lord. »"
                        >
                    </div>

                    {{-- Photograph Upload --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold text-white">
                            📷 Deceased Photograph (Optional)
                        </label>
                        <input
                            type="file"
                            name="photo"
                            class="form-control"
                            accept="image/jpeg,image/png,image/webp"
                        >
                        <div class="form-text text-muted small">
                            Accepted formats: JPG, PNG, or WebP (Max size: 5 MB).
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top border-secondary border-opacity-25">
                        <a href="{{ route('deceased.index') }}" class="btn btn-outline-secondary">
                            &larr; Cancel
                        </a>

                        <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">
                            <i class="bi bi-stars me-1"></i> Generate AI Funeral Notice
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

</div>
@endsection