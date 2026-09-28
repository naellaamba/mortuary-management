@extends('layouts.app')

@section('title', 'Funeral Notice & Obituary')

@section('content')

<style>
    /* Theme Gold */
    .card-theme-gold {
        background: #fdfbf7;
        border: 3px double #c5a059 !important;
        box-shadow: 0 10px 30px rgba(197, 160, 89, 0.2);
        color: #2c2317;
    }
    .card-theme-gold .theme-accent {
        color: #966f27;
    }
    .card-theme-gold .theme-divider {
        border-top: 1px solid #c5a059;
        border-bottom: 1px solid #c5a059;
        height: 4px;
        margin: 20px auto;
        width: 60%;
    }
    .card-theme-gold .photo-frame {
        border: 4px double #c5a059;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    /* Theme Classic */
    .card-theme-classic {
        background: #ffffff;
        border: 3px double #1a1a1a !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        color: #111111;
    }
    .card-theme-classic .theme-accent {
        color: #111111;
    }
    .card-theme-classic .theme-divider {
        border-top: 1px solid #1a1a1a;
        border-bottom: 1px solid #1a1a1a;
        height: 3px;
        margin: 20px auto;
        width: 50%;
    }
    .card-theme-classic .photo-frame {
        border: 3px solid #1a1a1a;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    /* Theme Peace */
    .card-theme-peace {
        background: #f8fafc;
        border: 3px double #1e3a8a !important;
        box-shadow: 0 10px 30px rgba(30, 58, 138, 0.15);
        color: #1e293b;
    }
    .card-theme-peace .theme-accent {
        color: #1e3a8a;
    }
    .card-theme-peace .theme-divider {
        border-top: 2px solid #3b82f6;
        margin: 20px auto;
        width: 55%;
    }
    .card-theme-peace .photo-frame {
        border: 3px solid #1e3a8a;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    /* Theme Cross */
    .card-theme-cross {
        background: #faf8f5;
        border: 3px double #4a3b32 !important;
        box-shadow: 0 10px 30px rgba(74, 59, 50, 0.18);
        color: #33261f;
    }
    .card-theme-cross .theme-accent {
        color: #634832;
    }
    .card-theme-cross .theme-divider {
        border-top: 2px solid #8c6d53;
        margin: 20px auto;
        width: 50%;
    }
    .card-theme-cross .photo-frame {
        border: 3px solid #634832;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    @media print {
        .no-print, .app-sidebar, .app-navbar, .app-footer {
            display: none !important;
        }
        body, .app-wrapper, .app-content {
            background: #ffffff !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }
        .container {
            max-width: 100% !important;
            padding: 0 !important;
        }
        .card {
            box-shadow: none !important;
            border: 2px solid #000000 !important;
        }
    }
</style>

<div class="container-fluid px-0">

    {{-- Top Action Bar --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 no-print gap-3">
        <div>
            <h2 class="fw-bold mb-1 text-white">
                🕊️ Funeral Notice & Obituary Announcement
            </h2>
            <p class="text-muted mb-0">
                Generated in loving memory of <strong class="text-white">{{ $deceased->full_name }}</strong>
            </p>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
            {{-- Change Theme Dropdown --}}
            @if(!empty($notice))
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-palette me-1"></i> Theme: {{ ucfirst($theme ?? 'Gold') }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark-custom">
                        <li><a class="dropdown-item text-white {{ ($theme ?? '') === 'gold' ? 'active' : '' }}" href="{{ route('faire-part.show', ['notice' => $notice->id, 'theme' => 'gold']) }}">✨ Gold & Solemn</a></li>
                        <li><a class="dropdown-item text-white {{ ($theme ?? '') === 'classic' ? 'active' : '' }}" href="{{ route('faire-part.show', ['notice' => $notice->id, 'theme' => 'classic']) }}">✦ Classic B&W</a></li>
                        <li><a class="dropdown-item text-white {{ ($theme ?? '') === 'peace' ? 'active' : '' }}" href="{{ route('faire-part.show', ['notice' => $notice->id, 'theme' => 'peace']) }}">🕊️ Celestial Peace</a></li>
                        <li><a class="dropdown-item text-white {{ ($theme ?? '') === 'cross' ? 'active' : '' }}" href="{{ route('faire-part.show', ['notice' => $notice->id, 'theme' => 'cross']) }}">✝️ Christian Hope</a></li>
                    </ul>
                </div>

                {{-- Download PDF Button --}}
                <a href="{{ route('faire-part.pdf', ['notice' => $notice->id, 'theme' => $theme ?? 'gold']) }}" class="btn btn-danger">
                    <i class="bi bi-file-earmark-pdf me-1"></i> Download PDF (HD)
                </a>
            @endif

            {{-- Print Button --}}
            <button onclick="window.print()" class="btn btn-primary">
                <i class="bi bi-printer me-1"></i> Print Notice
            </button>
        </div>
    </div>

    {{-- Funeral Notice Presentation Card --}}
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="card p-4 p-md-5 card-theme-{{ $theme ?? 'gold' }} border-0 rounded-4">

                {{-- Decorative Header --}}
                <div class="text-center mb-3">
                    <div class="theme-accent fs-1">
                        @if(($theme ?? '') === 'cross')
                            ✝
                        @elseif(($theme ?? '') === 'peace')
                            🕊
                        @elseif(($theme ?? '') === 'classic')
                            ✦
                        @else
                            🕊
                        @endif
                    </div>
                    <div class="theme-accent fw-bold text-uppercase" style="letter-spacing: 4px; font-size: 14px;">
                        Funeral Notice & Obituary
                    </div>
                    <div class="theme-divider"></div>
                </div>

                {{-- Deceased Photograph --}}
                @if(!empty($photoDataUrl))
                    <div class="text-center mb-4">
                        <img
                            src="{{ $photoDataUrl }}"
                            alt="{{ $deceased->full_name }}"
                            class="photo-frame"
                            style="max-width: 170px; max-height: 210px; object-fit: cover; border-radius: 6px;"
                        >
                    </div>
                @endif

                {{-- Main Content --}}
                <div
                    style="
                        max-width: 720px;
                        margin: auto;
                        font-family: 'Cinzel', 'Playfair Display', Georgia, serif;
                        line-height: 2;
                        font-size: 16px;
                        white-space: pre-line;
                        text-align: center;
                    "
                >
                    {!! nl2br(e($fairePart)) !!}
                </div>

                {{-- Decorative Footer --}}
                <div class="text-center mt-4">
                    <div class="theme-divider"></div>
                    <p class="fst-italic text-muted small mb-0">
                        « May their gentle soul rest in perfect peace. »
                    </p>
                </div>

            </div>
        </div>
    </div>

    {{-- Navigation Back Button --}}
    <div class="mt-4 text-center no-print">
        <a href="{{ route('faire-part.create') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Draft Another Notice
        </a>
        <a href="{{ route('deceased.index') }}" class="btn btn-outline-primary ms-2">
            View All Deceased
        </a>
    </div>

</div>

@endsection