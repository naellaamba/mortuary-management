<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Crypt Dashboard') – Mortuary Management OS</title>

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
            --bg-body: #030509;
            --bg-sidebar: #060911;
            --bg-navbar: rgba(6, 9, 17, 0.90);
            --bg-card: #0a0f1d;
            --bg-card-subtle: #0f172a;
            --bg-hover: rgba(255, 255, 255, 0.04);
            --border-color: rgba(255, 255, 255, 0.08);
            --border-blood: rgba(153, 27, 27, 0.45);
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
            --blood-dark: #7f1d1d;
            --blood-crimson: #991b1b;
            --blood-bright: #ef4444;
            --ghost-cyan: #38bdf8;
            --candle-amber: #d97706;
            --sidebar-width: 270px;
            --navbar-height: 70px;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
            position: relative;
        }

        h1, h2, h3, h4, .brand-title, .nav-section-label, .gothic-heading {
            font-family: 'Cinzel', serif;
            letter-spacing: 0.03em;
        }

        /* ── Gloomy Sidebar ── */
        .app-sidebar {
            width: var(--sidebar-width);
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            border-right-color: rgba(153, 27, 27, 0.25);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-brand {
            height: var(--navbar-height);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            gap: 0.85rem;
            border-bottom: 1px solid var(--border-color);
            border-bottom-color: rgba(153, 27, 27, 0.3);
            text-decoration: none;
            color: var(--text-main);
        }

        .brand-logo-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: linear-gradient(135deg, #7f1d1d, #312e81);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fca5a5;
            font-size: 1.3rem;
            border: 1px solid rgba(239, 68, 68, 0.3);
            box-shadow: 0 0 15px rgba(153, 27, 27, 0.4);
        }

        .brand-text {
            display: flex;
            flex-direction: column;
        }

        .brand-title {
            font-weight: 800;
            font-size: 1.05rem;
            color: #f8fafc;
            line-height: 1.2;
            text-transform: uppercase;
        }

        .brand-subtitle {
            font-size: 0.68rem;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .sidebar-nav {
            padding: 1.25rem 0.85rem;
            flex: 1;
            overflow-y: auto;
            list-style: none;
        }

        .nav-section-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #64748b;
            padding: 0.75rem 0.75rem 0.35rem;
        }

        .nav-item-link {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.7rem 0.9rem;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.88rem;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 0.25rem;
            border-left: 3px solid transparent;
        }

        .nav-item-link i {
            font-size: 1.15rem;
            width: 22px;
            text-align: center;
            color: #64748b;
            transition: color 0.2s, transform 0.2s;
        }

        .nav-item-link:hover {
            color: #fff;
            background-color: var(--bg-hover);
            border-left-color: rgba(153, 27, 27, 0.6);
            transform: translateX(3px);
        }

        .nav-item-link:hover i {
            color: #f87171;
        }

        .nav-item-link.active {
            color: #fff;
            background: linear-gradient(90deg, rgba(153, 27, 27, 0.25), rgba(153, 27, 27, 0.05));
            border-left: 3px solid #ef4444;
            font-weight: 600;
        }

        .nav-item-link.active i {
            color: #ef4444;
        }

        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid var(--border-color);
            background: rgba(4, 6, 12, 0.85);
        }

        .user-snippet {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar-sm {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7f1d1d, #4338ca);
            border: 1px solid rgba(239, 68, 68, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .user-info-meta {
            flex: 1;
            min-width: 0;
        }

        .user-meta-name {
            font-size: 0.86rem;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-meta-role {
            font-size: 0.72rem;
            color: var(--text-muted);
            text-transform: capitalize;
        }

        /* ── Main Wrapper ── */
        .app-wrapper {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left 0.3s ease, width 0.3s ease;
        }

        /* ── Top Navbar ── */
        .app-navbar {
            height: var(--navbar-height);
            background: var(--bg-navbar);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-color);
            border-bottom-color: rgba(153, 27, 27, 0.2);
            position: sticky;
            top: 0;
            z-index: 1030;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sidebar-toggler-btn {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            width: 38px;
            height: 38px;
            border-radius: 8px;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .sidebar-toggler-btn:hover {
            color: #fff;
            background: var(--bg-hover);
        }

        .navbar-breadcrumbs {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.88rem;
            color: var(--text-muted);
        }

        .navbar-breadcrumbs strong {
            color: #fff;
            font-family: 'Cinzel', serif;
            letter-spacing: 0.05em;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        /* Notification Dropdown */
        .notification-btn {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            cursor: pointer;
            transition: all 0.2s;
        }

        .notification-btn:hover {
            color: #f87171;
            background: var(--bg-hover);
            border-color: rgba(239, 68, 68, 0.3);
        }

        .notification-badge {
            position: absolute;
            top: 2px;
            right: 2px;
            width: 10px;
            height: 10px;
            background-color: var(--blood-bright);
            border-radius: 50%;
            border: 2px solid var(--bg-sidebar);
            box-shadow: 0 0 8px #ef4444;
        }

        .dropdown-menu-dark-custom {
            background-color: #0b0f1a !important;
            border: 1px solid rgba(153, 27, 27, 0.35) !important;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.8) !important;
            border-radius: 12px !important;
            padding: 0.5rem !important;
        }

        .notification-item {
            display: flex;
            gap: 0.75rem;
            padding: 0.75rem;
            border-radius: 8px;
            transition: background 0.15s;
            text-decoration: none;
            color: var(--text-main);
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item:hover {
            background: var(--bg-hover);
            color: #fff;
        }

        .notification-icon-wrap {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 0.95rem;
        }

        /* Avatar dropdown pill */
        .user-nav-btn {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            background: rgba(153, 27, 27, 0.1);
            border: 1px solid rgba(153, 27, 27, 0.3);
            padding: 0.35rem 0.85rem 0.35rem 0.45rem;
            border-radius: 30px;
            cursor: pointer;
            color: var(--text-main);
            text-decoration: none;
            transition: all 0.2s;
        }

        .user-nav-btn:hover {
            background: rgba(153, 27, 27, 0.25);
            border-color: rgba(239, 68, 68, 0.5);
            color: #fff;
        }

        .user-nav-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7f1d1d, #312e81);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.85rem;
        }

        /* ── Main Content Body ── */
        .app-content {
            padding: 2rem;
            flex: 1;
        }

        /* ── Gloomy Card Components ── */
        .glass-card, .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-top: 1px solid rgba(153, 27, 27, 0.3);
            border-radius: 14px;
            color: var(--text-main);
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.4);
        }

        .card-header {
            background: rgba(255, 255, 255, 0.02);
            border-bottom: 1px solid var(--border-color);
            padding: 1.1rem 1.4rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.4rem;
        }

        /* ── Gloomy Tables ── */
        .table {
            color: var(--text-main);
            border-color: var(--border-color);
        }

        .table > :not(caption) > * > * {
            background-color: transparent;
            color: var(--text-main);
            border-bottom-color: var(--border-color);
            padding: 0.85rem 1rem;
        }

        .table thead th {
            font-size: 0.76rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            background: rgba(15, 23, 42, 0.5);
            border-bottom: 1px solid var(--border-color);
            font-family: 'Cinzel', serif;
        }

        .table-hover tbody tr:hover td {
            background-color: var(--bg-hover);
        }

        /* ── Gloomy Forms ── */
        .form-control, .form-select {
            background-color: #060912;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #f1f5f9;
            border-radius: 8px;
            padding: 0.65rem 0.95rem;
            font-size: 0.9rem;
        }

        .form-control:focus, .form-select:focus {
            background-color: #0b1120;
            border-color: #ef4444;
            color: #fff;
            box-shadow: 0 0 0 0.25rem rgba(239, 68, 68, 0.2);
        }

        .form-label {
            font-weight: 500;
            font-size: 0.875rem;
            color: #cbd5e1;
            margin-bottom: 0.4rem;
        }

        /* ── Gloomy Buttons ── */
        .btn-primary {
            background: linear-gradient(135deg, #7f1d1d, #991b1b);
            border: 1px solid #ef4444;
            box-shadow: 0 4px 14px rgba(153, 27, 27, 0.4);
            font-family: 'Cinzel', serif;
            font-weight: 700;
            letter-spacing: 0.05em;
            border-radius: 8px;
            padding: 0.6rem 1.25rem;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #991b1b, #b91c1c);
            border-color: #f87171;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.5);
        }

        .btn-success {
            background: linear-gradient(135deg, #065f46, #047857);
            border: 1px solid rgba(16, 185, 129, 0.3);
            font-family: 'Cinzel', serif;
            font-weight: 700;
            letter-spacing: 0.05em;
            border-radius: 8px;
            padding: 0.6rem 1.25rem;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #047857, #059669);
            transform: translateY(-1px);
        }

        .btn-outline-secondary {
            border-color: var(--border-color);
            color: var(--text-muted);
            border-radius: 8px;
        }

        .btn-outline-secondary:hover {
            background: var(--bg-hover);
            color: #fff;
            border-color: rgba(255, 255, 255, 0.25);
        }

        /* ── Stat Card Gradients ── */
        .stat-card-gradient {
            border-radius: 14px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            border: 1px solid var(--border-color);
            border-top: 1px solid rgba(153, 27, 27, 0.4);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .stat-icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            margin-bottom: 1rem;
        }

        /* ── Sidebar Overlay (Mobile) ── */
        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(6px);
            z-index: 1035;
        }

        /* ── Footer ── */
        .app-footer {
            padding: 1.5rem 2rem;
            border-top: 1px solid var(--border-color);
            text-align: center;
            font-size: 0.8rem;
            color: #64748b;
            margin-top: auto;
        }

        @media (max-width: 992px) {
            .app-sidebar {
                transform: translateX(-100%);
            }
            .app-sidebar.show {
                transform: translateX(0);
            }
            .sidebar-backdrop.show {
                display: block;
            }
            .app-wrapper {
                margin-left: 0;
                width: 100%;
            }
            .sidebar-toggler-btn {
                display: flex;
            }
            .app-content {
                padding: 1.25rem;
            }
            .app-navbar {
                padding: 0 1.25rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    {{-- Mobile Backdrop --}}
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    {{-- ─── GLOOMY SIDEBAR NAVIGATION ─────────────────────────────────────────────── --}}
    <aside class="app-sidebar" id="appSidebar">
        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'staff' ? route('staff.dashboard') : route('dashboard')) }}" class="sidebar-brand">
            <div class="brand-logo-icon">
                <span>⚰️</span>
            </div>
            <div class="brand-text">
                <span class="brand-title">Mortuary OS</span>
                <span class="brand-subtitle">Crypt & Body Registry</span>
            </div>
        </a>

        <ul class="sidebar-nav">
            <li class="nav-section-label">Operations</li>

            {{-- Role-based Dashboard Link --}}
            @if(auth()->user()->role === 'admin')
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="nav-item-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-shield-shaded"></i>
                        <span>Admin Crypt</span>
                    </a>
                </li>
            @elseif(auth()->user()->role === 'staff')
                <li>
                    <a href="{{ route('staff.dashboard') }}" class="nav-item-link {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-journal-medical"></i>
                        <span>Staff Console</span>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('dashboard') }}" class="nav-item-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Overview</span>
                    </a>
                </li>
            @endif

            <li class="nav-section-label">Post-Mortem Registry</li>

            <li>
                <a href="{{ route('deceased.index') }}" class="nav-item-link {{ request()->routeIs('deceased.*') ? 'active' : '' }}">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Deceased Bodies</span>
                </a>
            </li>

            <li>
                <a href="{{ route('storage.index') }}" class="nav-item-link {{ request()->routeIs('storage.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam-fill"></i>
                    <span>Cold Vaults & Trays</span>
                </a>
            </li>

            <li>
                <a href="{{ route('payments.index') }}" class="nav-item-link {{ request()->routeIs('payments.*') ? 'active' : '' }}">
                    <i class="bi bi-credit-card-2-front-fill"></i>
                    <span>Billing & Invoices</span>
                </a>
            </li>

            <li>
                <a href="{{ route('schedule.index') }}" class="nav-item-link {{ request()->routeIs('schedule.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event-fill"></i>
                    <span>Release & Pickups</span>
                </a>
            </li>

            <li class="nav-section-label">Services & Solemn Tools</li>

            <li>
                <a href="{{ route('faire-part.create') }}" class="nav-item-link {{ request()->routeIs('faire-part.*') ? 'active' : '' }}">
                    <i class="bi bi-chat-quote-fill"></i>
                    <span>AI Funeral Notices</span>
                </a>
            </li>

            <li>
                <a href="{{ route('geolocation.index') }}" class="nav-item-link {{ request()->routeIs('geolocation.*') ? 'active' : '' }}">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>Morgue Geolocation</span>
                </a>
            </li>

            <li>
                <a href="/verify" class="nav-item-link {{ request()->is('verify*') ? 'active' : '' }}">
                    <i class="bi bi-patch-check-fill"></i>
                    <span>Record Verification</span>
                </a>
            </li>

            @if(auth()->user()->role === 'admin')
                <li class="nav-section-label">Administration</li>
                <li>
                    <a href="/admin/users" class="nav-item-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i>
                        <span>Staff Access</span>
                    </a>
                </li>
            @endif
        </ul>

        {{-- Sidebar User Snippet --}}
        <div class="sidebar-footer">
            <div class="user-snippet">
                <div class="user-avatar-sm">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="user-info-meta">
                    <div class="user-meta-name">{{ auth()->user()->name }}</div>
                    <div class="user-meta-role">
                        <span class="badge bg-danger text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.05em;">
                            {{ ucfirst(auth()->user()->role ?? 'Staff') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    {{-- ─── MAIN CONTENT SHELL ─────────────────────────────────────────────── --}}
    <div class="app-wrapper">

        {{-- ─── TOP NAVBAR ─────────────────────────────────────────────────── --}}
        <header class="app-navbar">
            <div class="navbar-left">
                <button class="sidebar-toggler-btn" id="sidebarToggleBtn" type="button" aria-label="Toggle Sidebar">
                    <i class="bi bi-list fs-5"></i>
                </button>

                <div class="navbar-breadcrumbs">
                    <span>⚰️</span>
                    <span>/</span>
                    <strong>@yield('title', 'Dashboard')</strong>
                </div>
            </div>

            <div class="navbar-right">
                {{-- Quick Action Button --}}
                <a href="{{ route('deceased.create') }}" class="btn btn-sm btn-primary d-none d-md-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle-fill"></i>
                    <span>Register Body</span>
                </a>

                {{-- Notification Dropdown --}}
                <div class="dropdown">
                    <button class="notification-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifications">
                        <i class="bi bi-bell-fill"></i>
                        <span class="notification-badge"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark-custom" style="width: 320px;">
                        <div class="d-flex align-items-center justify-content-between p-2 pb-1 border-bottom border-secondary mb-2">
                            <span class="fw-bold fs-6 text-uppercase" style="font-family: 'Cinzel', serif;">Mortuary Dispatch</span>
                            <span class="badge bg-danger">3 Unread</span>
                        </div>

                        <div class="notification-item">
                            <div class="notification-icon-wrap" style="background: rgba(153, 27, 27, 0.25); color: #f87171;">
                                <i class="bi bi-person-plus-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fs-7 fw-semibold">Body Admitted to Cold Vault</div>
                                <div class="text-muted small">Assigned to Cold Storage Tray A</div>
                                <div class="text-muted" style="font-size: 0.68rem;">10 mins ago</div>
                            </div>
                        </div>

                        <div class="notification-item">
                            <div class="notification-icon-wrap" style="background: rgba(16, 185, 129, 0.25); color: #34d399;">
                                <i class="bi bi-cash-coin"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fs-7 fw-semibold">CamPay Payment Received</div>
                                <div class="text-muted small">Mobile Money voucher: 50,000 FCFA</div>
                                <div class="text-muted" style="font-size: 0.68rem;">1 hour ago</div>
                            </div>
                        </div>

                        <div class="notification-item">
                            <div class="notification-icon-wrap" style="background: rgba(245, 158, 11, 0.25); color: #fbbf24;">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fs-7 fw-semibold">Pickup Authorization Pending</div>
                                <div class="text-muted small">Body release scheduled for tomorrow 09:00</div>
                                <div class="text-muted" style="font-size: 0.68rem;">3 hours ago</div>
                            </div>
                        </div>

                        <div class="p-2 pt-2 border-top border-secondary text-center mt-1">
                            <a href="{{ route('schedule.index') }}" class="text-decoration-none small text-danger fw-semibold">
                                View all release schedules &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                {{-- User Avatar Dropdown --}}
                <div class="dropdown">
                    <div class="user-nav-btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-nav-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <span class="d-none d-sm-inline fw-semibold fs-7">
                            {{ auth()->user()->name ?? 'User' }}
                        </span>
                        <i class="bi bi-chevron-down small opacity-50 ms-1"></i>
                    </div>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark-custom" style="min-width: 210px;">
                        <li class="px-3 py-2 border-bottom border-secondary mb-1">
                            <div class="fw-bold text-white">{{ auth()->user()->name }}</div>
                            <div class="text-muted small">{{ auth()->user()->email }}</div>
                            <span class="badge bg-danger mt-1 text-white fw-bold text-uppercase" style="font-size: 0.65rem;">
                                {{ auth()->user()->role ?? 'Staff' }}
                            </span>
                        </li>

                        @if(auth()->user()->role === 'admin')
                            <li>
                                <a class="dropdown-item py-2 rounded text-white" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-shield-shaded me-2 text-danger"></i> Admin Crypt
                                </a>
                            </li>
                        @endif

                        <li>
                            <a class="dropdown-item py-2 rounded text-white" href="{{ route('deceased.index') }}">
                                <i class="bi bi-person-lines-fill me-2 text-info"></i> Deceased Records
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item py-2 rounded text-white" href="{{ route('payments.index') }}">
                                <i class="bi bi-credit-card me-2 text-success"></i> Invoices & Receipts
                            </a>
                        </li>

                        <li><hr class="dropdown-divider border-secondary my-1"></li>

                        <li>
                            <button type="button" class="dropdown-item py-2 rounded text-danger fw-semibold" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">
                                <i class="bi bi-box-arrow-right me-2"></i> Leave Crypt (Logout)
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        {{-- Flash Messages --}}
        <div class="px-4 pt-3">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="background: rgba(16, 185, 129, 0.15); border-left: 4px solid #10b981 !important; color: #6ee7b7;">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert" style="background: rgba(239, 68, 68, 0.15); border-left: 4px solid #ef4444 !important; color: #fca5a5;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('status'))
                <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm" role="alert" style="background: rgba(56, 189, 248, 0.15); border-left: 4px solid #38bdf8 !important; color: #93c5fd;">
                    <i class="bi bi-info-circle-fill me-2"></i> {{ session('status') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        {{-- ─── PAGE CONTENT BODY ─────────────────────────────────────────── --}}
        <main class="app-content">
            @yield('content')
        </main>

        {{-- ─── FOOTER ─────────────────────────────────────────────────────── --}}
        <footer class="app-footer">
            <div>
                &copy; {{ date('Y') }} <strong>Mortuary OS</strong> &bull; « Requiescat in Pace » &bull; All rights reserved.
            </div>
        </footer>

    </div>

    {{-- ─── LOGOUT CONFIRMATION POPUP MODAL ─────────────────────────────── --}}
    <div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-labelledby="logoutConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: #080d1a; border: 1px solid rgba(239, 68, 68, 0.4); box-shadow: 0 25px 60px rgba(0, 0, 0, 0.95); border-radius: 16px;">
                <div class="modal-header border-bottom border-secondary border-opacity-25 py-3">
                    <h5 class="modal-title text-white fw-bold" id="logoutConfirmModalLabel" style="font-family: 'Cinzel', serif; letter-spacing: 0.05em;">
                        <span class="text-danger me-2">⚰️</span> Leave Mortuary Crypt?
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4 text-center">
                    <div class="stat-icon-circle mx-auto mb-3" style="background: rgba(239, 68, 68, 0.15); color: #f87171; width: 64px; height: 64px; font-size: 1.75rem; border: 1px solid rgba(239, 68, 68, 0.3);">
                        <i class="bi bi-box-arrow-right"></i>
                    </div>
                    <h5 class="text-white fw-bold mb-2" style="font-family: 'Cinzel', serif;">Do you really want to sign out?</h5>
                    <p class="text-muted small mb-0 px-3">
                        Your post-mortem console session will be locked. Any unsaved changes will be lost.
                    </p>
                </div>
                <div class="modal-footer border-top border-secondary border-opacity-25 d-flex justify-content-between py-3">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Cancel & Stay
                    </button>
                    <form method="POST" action="{{ route('logout') }}" id="confirmedLogoutForm">
                        @csrf
                        <button type="submit" class="btn btn-primary px-4 fw-semibold" style="background: linear-gradient(135deg, #7f1d1d, #b91c1c); border-color: #ef4444;">
                            <i class="bi bi-box-arrow-right me-1"></i> Yes, Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap Bundle JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Sidebar Toggle Script for Mobile --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            const sidebar = document.getElementById('appSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');

            if (toggleBtn && sidebar && backdrop) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    backdrop.classList.toggle('show');
                });

                backdrop.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    backdrop.classList.remove('show');
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>