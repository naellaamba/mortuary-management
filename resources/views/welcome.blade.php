<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mortuary Management OS – Crypt & Post-Mortem Registry</title>

    {{-- Google Fonts: Cinzel (Gothic / Solemn) & Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --bg-void: #03060a;
            --card-morbid: rgba(6, 10, 18, 0.82);
            --border-steel: rgba(255, 255, 255, 0.08);
            --border-glow: rgba(153, 27, 27, 0.4);
            --blood-crimson: #991b1b;
            --ghost-cyan: #38bdf8;
            --candle-amber: #d97706;
            --text-pale: #e2e8f0;
            --text-corpse: #94a3b8;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: 
                radial-gradient(ellipse at center, rgba(3, 6, 10, 0.35) 0%, rgba(3, 6, 10, 0.85) 100%),
                linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.75)),
                url('{{ asset("images/mortuary-landing-bg.jpg") }}') center/cover no-repeat fixed;
            color: var(--text-pale);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            position: relative;
        }

        /* ── Top Navigation Bar ── */
        .landing-nav {
            padding: 1.25rem 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(3, 6, 10, 0.7);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(153, 27, 27, 0.3);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .brand-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: #fff;
        }

        .brand-icon-box {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background: linear-gradient(135deg, #7f1d1d, #312e81);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            border: 1px solid rgba(239, 68, 68, 0.4);
            box-shadow: 0 0 15px rgba(153, 27, 27, 0.5);
        }

        .hero-section {
            position: relative;
            z-index: 2;
            padding: 4rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
        }

        .morbid-welcome-card {
            background: var(--card-morbid);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-top: 2px solid rgba(153, 27, 27, 0.7);
            border-radius: 24px;
            padding: 3.5rem 2.75rem;
            max-width: 860px;
            text-align: center;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.9), 0 0 40px rgba(153, 27, 27, 0.2);
            position: relative;
        }

        .gothic-title {
            font-family: 'Cinzel', serif;
            font-size: 2.85rem;
            font-weight: 900;
            letter-spacing: 0.04em;
            line-height: 1.2;
            background: linear-gradient(180deg, #ffffff 40%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1.25rem;
            text-transform: uppercase;
        }

        .brand-badge-morbid {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.45rem 1.4rem;
            background: rgba(153, 27, 27, 0.2);
            border: 1px solid rgba(153, 27, 27, 0.4);
            border-radius: 50px;
            margin-bottom: 2rem;
            box-shadow: 0 0 15px rgba(153, 27, 27, 0.2);
        }

        .hero-subtitle-somber {
            font-size: 1.05rem;
            color: #94a3b8;
            line-height: 1.75;
            max-width: 680px;
            margin: 0 auto 2.5rem;
        }

        .btn-morbid-primary {
            background: linear-gradient(135deg, #7f1d1d 0%, #3b0764 100%);
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #f8fafc;
            padding: 0.9rem 2.2rem;
            border-radius: 12px;
            font-family: 'Cinzel', serif;
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 0.05em;
            box-shadow: 0 4px 25px rgba(127, 29, 29, 0.5);
            transition: all 0.25s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
        }

        .btn-morbid-primary:hover {
            background: linear-gradient(135deg, #991b1b 0%, #4c1d95 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 35px rgba(153, 27, 27, 0.7);
            color: #fff;
        }

        .btn-morbid-ghost {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #cbd5e1;
            padding: 0.9rem 2.2rem;
            border-radius: 12px;
            font-family: 'Cinzel', serif;
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 0.05em;
            transition: all 0.25s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
        }

        .btn-morbid-ghost:hover {
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(255, 255, 255, 0.35);
            color: #fff;
            transform: translateY(-2px);
        }

        .morbid-features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 1.15rem;
            margin-top: 3.5rem;
            text-align: left;
        }

        .morbid-feature-box {
            background: rgba(15, 23, 42, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-left: 2px solid rgba(153, 27, 27, 0.5);
            border-radius: 12px;
            padding: 1.25rem;
            transition: all 0.2s;
        }

        .morbid-feature-box:hover {
            border-color: rgba(153, 27, 27, 0.8);
            background: rgba(15, 23, 42, 0.8);
            transform: translateY(-2px);
        }

        .morbid-feature-icon {
            font-size: 1.4rem;
            margin-bottom: 0.4rem;
            color: #f87171;
        }

        .morbid-feature-title {
            font-family: 'Cinzel', serif;
            font-weight: 700;
            font-size: 0.9rem;
            color: #f1f5f9;
            margin-bottom: 0.25rem;
            letter-spacing: 0.02em;
        }

        .morbid-feature-desc {
            font-size: 0.78rem;
            color: #94a3b8;
            line-height: 1.4;
        }

        .morbid-footer {
            position: relative;
            z-index: 2;
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            background: rgba(3, 6, 10, 0.92);
            text-align: center;
            font-size: 0.8rem;
            color: #64748b;
        }

        @media (max-width: 768px) {
            .landing-nav {
                padding: 1rem 1.25rem;
            }
            .gothic-title {
                font-size: 2rem;
            }
            .morbid-welcome-card {
                padding: 2.25rem 1.5rem;
            }
        }
    </style>
</head>
<body>

    {{-- Top Navigation Bar --}}
    <nav class="landing-nav">
        <a href="/" class="brand-link">
            <div class="brand-icon-box">
                <span>⚰️</span>
            </div>
            <div>
                <span class="fw-bold fs-5" style="font-family: 'Cinzel', serif; letter-spacing: 0.05em;">Mortuary OS</span>
            </div>
        </a>

        <div class="d-flex align-items-center gap-2">
            @auth
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'staff' ? route('staff.dashboard') : route('dashboard')) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-shield-shaded me-1"></i> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light px-3">
                    Sign In
                </a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-primary px-3">
                    Register
                </a>
            @endauth
        </div>
    </nav>

    {{-- Hero Container with Mortuary Photo Background --}}
    <section class="hero-section">
        <div class="morbid-welcome-card">

            <div class="brand-badge-morbid">
                <span style="font-size: 1.1rem;">⚰️</span>
                <span class="small fw-bold text-white text-uppercase" style="font-family: 'Cinzel', serif; letter-spacing: 0.1em;">
                    Crypt & Mortuary Operating System
                </span>
            </div>

            <h1 class="gothic-title">
                Solemn & Dignified Mortuary Registry
            </h1>

            <p class="hero-subtitle-somber">
                A gloomy, secure management system for cold vault storage, deceased body tracking, automated CamPay mobile money invoicing, and AI-generated funeral notices.
            </p>

            <div class="d-flex flex-wrap justify-content-center gap-3">
                @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'staff' ? route('staff.dashboard') : route('dashboard')) }}" class="btn-morbid-primary">
                        <span>Enter Crypt Dashboard</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-morbid-primary">
                        <span>Access Vault Portal</span>
                        <i class="bi bi-key-fill"></i>
                    </a>

                    <a href="{{ route('register') }}" class="btn-morbid-ghost">
                        <span>Register Staff</span>
                        <i class="bi bi-shield-lock"></i>
                    </a>
                @endauth
            </div>

            <div class="morbid-features-grid">
                <div class="morbid-feature-box">
                    <div class="morbid-feature-icon">💀</div>
                    <div class="morbid-feature-title">Deceased Tracking</div>
                    <div class="morbid-feature-desc">Crypt identification, body intake timestamps & security keys.</div>
                </div>

                <div class="morbid-feature-box">
                    <div class="morbid-feature-icon">🧊</div>
                    <div class="morbid-feature-title">Cold Storage Vaults</div>
                    <div class="morbid-feature-desc">Monitoring tray capacity, room status & temperature assignments.</div>
                </div>

                <div class="morbid-feature-box">
                    <div class="morbid-feature-icon">🕯️</div>
                    <div class="morbid-feature-title">AI Funeral Notices</div>
                    <div class="morbid-feature-desc">Solemn obituaries & respectful notices powered by Gemini AI.</div>
                </div>

                <div class="morbid-feature-box">
                    <div class="morbid-feature-icon">💳</div>
                    <div class="morbid-feature-title">CamPay Billing</div>
                    <div class="morbid-feature-desc">Automated Mobile Money receipts and PDF verification vouchers.</div>
                </div>
            </div>

        </div>
    </section>

    <footer class="morbid-footer">
        <div>
            &copy; {{ date('Y') }} <strong>Mortuary OS</strong> &bull; « Requiescat in Pace » &bull; Confidential & Secure System
        </div>
    </footer>

    {{-- Bootstrap Bundle JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>