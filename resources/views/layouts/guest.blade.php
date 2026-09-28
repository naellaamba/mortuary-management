<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mortuary Management') }} – Vault Access</title>

    {{-- Google Fonts: Cinzel & Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --auth-bg: #040609;
            --card-bg: rgba(6, 10, 18, 0.85);
            --card-border: rgba(255, 255, 255, 0.08);
            --blood-crimson: #991b1b;
            --accent-glow: rgba(153, 27, 27, 0.35);
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--auth-bg);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            padding: 2rem 1rem;
        }

        /* Ambient gloomy red & fog background */
        .ambient-glow-morbid {
            position: fixed;
            top: -150px;
            left: -150px;
            width: 550px;
            height: 550px;
            background: radial-gradient(circle, rgba(153, 27, 27, 0.2) 0%, rgba(153, 27, 27, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .ambient-glow-cold {
            position: fixed;
            bottom: -150px;
            right: -150px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(30, 41, 59, 0.4) 0%, rgba(30, 41, 59, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .auth-container {
            width: 100%;
            max-width: 1050px;
            background: var(--card-bg);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--card-border);
            border-top: 2px solid rgba(153, 27, 27, 0.6);
            border-radius: 20px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.9), 0 0 35px rgba(153, 27, 27, 0.15);
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        /* Left Hero Banner with Mortuary Photo */
        .auth-hero-pane {
            background: linear-gradient(135deg, rgba(3, 6, 10, 0.8) 0%, rgba(15, 23, 42, 0.9) 100%),
                        url('{{ asset("images/mortuary-auth-bg.jpg") }}') center/cover no-repeat;
            padding: 3.5rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            color: #fff;
        }

        .auth-brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: #fff;
        }

        .brand-logo-glow {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: linear-gradient(135deg, #7f1d1d, #312e81);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            box-shadow: 0 0 20px rgba(153, 27, 27, 0.5);
        }

        .hero-headline {
            font-family: 'Cinzel', serif;
            font-size: 1.85rem;
            font-weight: 800;
            line-height: 1.3;
            letter-spacing: 0.02em;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }

        .hero-desc {
            font-size: 0.9rem;
            color: #94a3b8;
            line-height: 1.65;
            margin-bottom: 2rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            margin-bottom: 0.95rem;
            font-size: 0.88rem;
            color: #cbd5e1;
        }

        .feature-icon-box {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(153, 27, 27, 0.2);
            border: 1px solid rgba(153, 27, 27, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            color: #f87171;
            flex-shrink: 0;
        }

        /* Right Form Pane */
        .auth-form-pane {
            padding: 3.5rem 3rem;
            background: rgba(8, 12, 22, 0.8);
        }

        .form-title {
            font-family: 'Cinzel', serif;
            font-size: 1.65rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: 0.02em;
            text-transform: uppercase;
            margin-bottom: 0.35rem;
        }

        .form-subtitle {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        /* Modern Inputs */
        .input-group-custom {
            position: relative;
            margin-bottom: 1.35rem;
        }

        .input-group-custom .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1.1rem;
            pointer-events: none;
            transition: color 0.2s;
            z-index: 5;
        }

        .auth-input {
            width: 100%;
            background-color: #070a12;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #f8fafc;
            padding: 0.8rem 1rem 0.8rem 2.75rem;
            border-radius: 10px;
            font-size: 0.92rem;
            transition: all 0.2s ease;
        }

        .auth-input:focus {
            outline: none;
            background-color: #0c1220;
            border-color: #ef4444;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.2);
            color: #fff;
        }

        .auth-input:focus ~ .input-icon {
            color: #ef4444;
        }

        .btn-auth-submit {
            width: 100%;
            background: linear-gradient(135deg, #7f1d1d 0%, #312e81 100%);
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #fff;
            padding: 0.85rem 1.5rem;
            border-radius: 10px;
            font-family: 'Cinzel', serif;
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 0.05em;
            box-shadow: 0 4px 20px rgba(127, 29, 29, 0.4);
            transition: all 0.25s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-auth-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(153, 27, 27, 0.6);
            background: linear-gradient(135deg, #991b1b 0%, #4338ca 100%);
        }

        .demo-credentials-box {
            background: rgba(153, 27, 27, 0.08);
            border: 1px dashed rgba(153, 27, 27, 0.3);
            border-radius: 10px;
            padding: 0.85rem;
            margin-top: 1.5rem;
        }

        .demo-pill {
            background: rgba(153, 27, 27, 0.2);
            border: 1px solid rgba(153, 27, 27, 0.4);
            color: #fca5a5;
            padding: 0.3rem 0.65rem;
            border-radius: 6px;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.15s;
            font-family: 'Cinzel', serif;
            font-weight: 600;
        }

        .demo-pill:hover {
            background: rgba(153, 27, 27, 0.4);
            color: #fff;
        }

        @media (max-width: 991px) {
            .auth-hero-pane {
                display: none;
            }
            .auth-form-pane {
                padding: 2.5rem 1.75rem;
            }
        }
    </style>
</head>
<body>

    {{-- Ambient light effects --}}
    <div class="ambient-glow-morbid"></div>
    <div class="ambient-glow-cold"></div>

    <div class="auth-container">
        <div class="row g-0">

            {{-- Left Side: Hero / System Highlights --}}
            <div class="col-lg-6 auth-hero-pane">
                <div>
                    <a href="/" class="auth-brand-badge mb-5">
                        <div class="brand-logo-glow">
                            <span>⚰️</span>
                        </div>
                        <div>
                            <div class="fw-bold fs-5 tracking-tight" style="font-family: 'Cinzel', serif;">Mortuary OS</div>
                            <div class="small opacity-75 text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.1em;">Crypt & Body Registry</div>
                        </div>
                    </a>

                    <h1 class="hero-headline">
                        Solemn, Cold & Secure Mortuary System
                    </h1>

                    <p class="hero-desc">
                        Post-mortem registry, body identification codes, cold storage tray assignments, CamPay mobile money invoicing, and AI funeral notices.
                    </p>

                    <div class="features-list">
                        <div class="feature-item">
                            <div class="feature-icon-box">💀</div>
                            <span>Encrypted Deceased Identifiers & Security Keys</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon-box">🧊</div>
                            <span>Cold Storage Tray & Vault Capacity Tracking</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon-box">💳</div>
                            <span>CamPay Automated Billing & Official Receipts</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon-box">🕯️</div>
                            <span>AI-Generated Funeral Notices & PDF Obituaries</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-top border-white border-opacity-10 text-white-50 small d-flex justify-content-between">
                    <span>&copy; {{ date('Y') }} Mortuary OS</span>
                    <span>« Requiescat in Pace »</span>
                </div>
            </div>

            {{-- Right Side: Dynamic Auth Form Content --}}
            <div class="col-lg-6 auth-form-pane">
                {{ $slot }}
            </div>

        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
