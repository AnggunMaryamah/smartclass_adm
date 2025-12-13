<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover" />
    <title>SmartClass - Kontak Kami</title>
    <meta name="description" content="Hubungi SmartClass untuk informasi paket, pendaftaran, atau dukungan." />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- THEME: apply saved theme ASAP to avoid flash & setup BroadcastChannel -->
    <script>
        (function() {
            const KEY = 'smartclass-theme';
            try {
                const saved = localStorage.getItem(KEY);
                if (saved === 'dark') document.documentElement.classList.add('theme-dark');
                else if (saved === 'light') document.documentElement.classList.add('theme-light');
            } catch (e) {
                /* ignore */
            }

            // Prepare BroadcastChannel (if available) so pages can receive theme changes immediately
            if ('BroadcastChannel' in window) {
                try {
                    window.__sc_theme_channel = new BroadcastChannel('smartclass-theme');
                    window.__sc_theme_channel.onmessage = (ev) => {
                        const v = ev.data;
                        if (v === 'dark') {
                            document.documentElement.classList.remove('theme-light');
                            document.documentElement.classList.add('theme-dark');
                        } else if (v === 'light') {
                            document.documentElement.classList.remove('theme-dark');
                            document.documentElement.classList.add('theme-light');
                        }

                        // update toggle button text if present
                        const t = document.getElementById('themeToggle');
                        if (t) t.textContent = v === 'dark' ? '☀️' : '🌙';
                    };
                } catch (e) {
                    /* ignore */
                }
            }
        })();
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <style>
        /* ---------- THEME COLORS (kept symmetrical for dark/light) ---------- */
        :root {
            --bg: #f7fafc;
            /* light default */
            --nav-bg: rgba(255, 255, 255, 0.85);
            --card-bg: #ffffff;
            --text: #0b1720;
            --muted: #4b5563;
            --accent-from: #06b6d4;
            --accent-to: #1e3a5f;
            --glass-border: rgba(2, 6, 23, 0.04);
            --shadow-soft: 0 12px 30px rgba(2, 6, 23, 0.06);
            --transition: 200ms;
        }

        /* Dark theme tokens */
        .theme-dark {
            --bg: #071426;
            --nav-bg: rgba(6, 12, 20, 0.92);
            --card-bg: #071224;
            --text: #e6eef7;
            --muted: #9fb2c6;
            --accent-from: #2dd4bf;
            --accent-to: #1e3a5f;
            --glass-border: rgba(255, 255, 255, 0.04);
            --shadow-soft: 0 20px 50px rgba(0, 0, 0, 0.45);
        }

        /* Force a light theme class too for explicitness */
        .theme-light {
            --bg: #f7fafc;
            --nav-bg: rgba(255, 255, 255, 0.92);
            --card-bg: #ffffff;
            --text: #0b1720;
            --muted: #4b5563;
            --glass-border: rgba(2, 6, 23, 0.06);
            --shadow-soft: 0 12px 30px rgba(2, 6, 23, 0.06);
        }

        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            transition: background var(--transition), color var(--transition);
        }

        /* layout container */
        .container {
            max-width: 1100px;
            margin: 120px auto;
            padding: 20px;
        }

        /* ---------- NAV ---------- */
        .site-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 990;
            background: var(--nav-bg);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid var(--glass-border);
            transition: padding var(--transition), background var(--transition);
        }

        /* compact header when scrolled */
        .site-nav.compact {
            padding: 6px 0;
            box-shadow: var(--shadow-soft);
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .brand {
            display: flex;
            gap: .5rem;
            align-items: center;
            font-weight: 800;
            color: var(--text);
            text-decoration: none;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff;
        }

        .brand-logo img {
            width: 28px;
            height: 28px;
            display: block
        }

        .brand-text {
            font-weight: 800;
            font-size: 1rem
        }

        /* center nav links like SD page, but hide on smaller screens */
        .nav-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 16px;
            pointer-events: auto;
        }

        .nav-link {
            color: var(--text);
            font-weight: 700;
            padding: 8px 10px;
            border-radius: 8px;
            text-decoration: none
        }

        .search-icon {
            font-size: 1rem;
            padding: 6px;
            border-radius: 8px;
            background: transparent;
            border: none;
            cursor: pointer
        }

        /* dropdown button */
        .nav-btn {
            background: transparent;
            border: none;
            color: var(--text);
            font-weight: 700;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer
        }

        .nav-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            min-width: 200px;
            background: var(--card-bg);
            border-radius: 12px;
            padding: 8px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-soft);
            opacity: 0;
            pointer-events: none;
            transform: translateY(-8px);
            transition: all 160ms ease;
            z-index: 120;
        }

        .nav-dropdown.show {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0)
        }

        .nav-dropdown a {
            display: block;
            padding: 8px 10px;
            border-radius: 8px;
            color: var(--text);
            text-decoration: none;
            font-weight: 700
        }

        .nav-actions {
            display: flex;
            gap: 12px;
            align-items: center
        }

        .theme-toggle {
            width: 44px;
            height: 44px;
            border-radius: 999px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            background: var(--card-bg);
            display: grid;
            place-items: center;
            cursor: pointer;
            font-size: 1.1rem;
            transition: transform var(--transition)
        }

        .btn-cta {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff;
            padding: .5rem .85rem;
            border-radius: 999px;
            font-weight: 800;
            border: none;
            cursor: pointer;
            text-decoration: none
        }

        .hamburger {
            display: none;
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--card-bg);
            border: 1px solid var(--glass-border);
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 4px;
            cursor: pointer;
            padding: 6px;
            transition: all var(--transition)
        }

        .hamburger .line {
            width: 20px;
            height: 2px;
            background: var(--text);
            border-radius: 2px;
            transition: transform var(--transition), opacity var(--transition)
        }

        .hamburger.open .line.top {
            transform: translateY(6px) rotate(45deg)
        }

        .hamburger.open .line.mid {
            opacity: 0
        }

        .hamburger.open .line.bot {
            transform: translateY(-6px) rotate(-45deg)
        }

        /* mobile drawer */
        .mobile-drawer {
            position: fixed;
            inset: 0;
            background: rgba(2, 6, 23, 0.45);
            display: none;
            z-index: 900;
            backdrop-filter: blur(4px)
        }

        .mobile-drawer.show {
            display: block
        }

        .mobile-drawer .panel {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 86%;
            max-width: 420px;
            background: var(--card-bg);
            padding: 18px;
            overflow: auto;
            border-left: 1px solid var(--glass-border);
            box-shadow: -20px 0 60px rgba(0, 0, 0, 0.5)
        }

        /* form + cards */
        .card {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.02), rgba(0, 0, 0, 0.01));
            padding: 22px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.03)
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: var(--muted);
            font-weight: 700
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            background: transparent;
            color: var(--text);
            transition: background var(--transition), border-color var(--transition), color var(--transition);
        }

        /* Make form controls visibly distinct in dark theme */
        .theme-dark input,
        .theme-dark textarea,
        .theme-dark select {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.06);
            color: var(--text);
        }

        /* Make form controls visibly distinct in light theme */
        .theme-light input,
        .theme-light textarea,
        .theme-light select {
            background: rgba(2, 6, 23, 0.02);
            border: 1px solid rgba(2, 6, 23, 0.06);
            color: var(--text);
        }

        /* placeholder color for better contrast */
        input::placeholder,
        textarea::placeholder {
            color: rgba(127, 140, 153, 0.6);
        }

        textarea {
            min-height: 140px;
            resize: vertical;
        }

        textarea {
            min-height: 140px;
            resize: vertical
        }

        .actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 12px
        }

        .btn {
            padding: 10px 14px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            border: none
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid rgba(0, 0, 0, 0.06);
            color: var(--text)
        }

        .toast {
            position: fixed;
            right: 20px;
            bottom: 20px;
            padding: 12px 16px;
            border-radius: 10px;
            display: none;
            z-index: 1200;
            min-width: 260px
        }

        .toast.show {
            display: block
        }

        .toast.success {
            border-left: 5px solid #10b981;
            background: #052e1f;
            color: #dff7ec
        }

        .toast.error {
            border-left: 5px solid #ef4444;
            background: #4b1212;
            color: #ffdede
        }

        /* ----------------- Mobile specific improvements ----------------- */
        @media (max-width: 880px) {
            .nav-center {
                display: none
            }

            .hamburger {
                display: flex
            }

            .brand-text {
                display: none
            }

            .nav-inner {
                padding: 10px 12px
            }

            .site-nav {
                padding: 8px 0
            }

            .container {
                margin: 88px 12px;
                padding: 14px
            }

            .grid-responsive {
                display: block
            }

            .card {
                padding: 16px
            }

            .actions {
                justify-content: stretch;
                flex-direction: column-reverse
            }

            .actions .btn {
                width: 100%
            }

            .toast {
                right: 12px;
                left: 12px;
                min-width: 0
            }

            .mobile-compact-contact {
                display: flex;
                gap: 8px;
                align-items: center
            }

            .mobile-compact-contact .brand-logo {
                width: 36px;
                height: 36px
            }

            /* mobile drawer tweaks */
            .mobile-drawer .panel {
                width: 92%;
                max-width: 420px
            }
        }

        /* tighter layout on very small screens */
        @media (max-width: 420px) {
            .container {
                margin: 72px 10px
            }

            input,
            textarea {
                padding: 12px;
                font-size: 0.95rem
            }

            .nav-actions {
                gap: 8px
            }

            .theme-toggle {
                width: 40px;
                height: 40px
            }
        }

        /* tablet tweaks */
        @media (min-width: 721px) and (max-width: 880px) {
            .container {
                margin: 100px 18px
            }

            .grid-responsive {
                display: grid;
                grid-template-columns: 1fr 360px;
                gap: 16px
            }
        }

        /* ---------------------- FIXED RESPONSIVE PATCH (UPDATE) ---------------------- */

        /* Default for wider screens: force a balanced two-column layout (override inline) */
        @media (min-width: 881px) {
            .grid-responsive {
                display: grid !important;
                grid-template-columns: 1fr 360px !important;
                /* main form + sidebar */
                gap: 20px !important;
                align-items: start;
            }

            /* ensure sidebar isn't too narrow visually */
            .grid-responsive aside.card {
                min-width: 260px;
                max-width: 380px;
            }

            /* make form column flexible */
            .grid-responsive>.card {
                min-width: 0;
                /* allow shrinking properly */
            }
        }

        /* Only collapse to single column on smaller devices (<= 780px) */
        @media (max-width: 780px) {
            .grid-responsive {
                grid-template-columns: 1fr !important;
                gap: 18px !important;
            }

            /* put the contact info above form is optional — keep original order but ensure spacing */
            aside.card {
                order: 0;
                width: 100%;
            }

            /* slightly bigger inputs on small screens */
            input,
            textarea {
                padding: 14px !important;
                font-size: 1rem !important;
            }

            .actions {
                flex-direction: column-reverse;
                gap: 12px;
            }

            .actions .btn {
                width: 100% !important;
            }
        }

        /* Smallest screens: tighten header/icon sizes */
        @media (max-width: 360px) {
            .brand-logo {
                width: 32px !important;
                height: 32px !important;
            }

            .hamburger {
                width: 38px !important;
                height: 38px !important;
            }

            .nav-inner {
                padding: 8px !important;
            }
        }

        /* Mobile drawer padding nicety */
        @media (max-width: 480px) {
            .mobile-drawer .panel {
                padding: 14px !important;
            }

            #mobileJenjang a {
                padding: 12px !important;
            }
        }
    </style>
</head>

<body>
    <!-- NAVIGATION (improved: compact on mobile, explicit light/dark support, small nav tweak: search icon + compact brand on mobile) -->
    <header class="site-nav" role="navigation" aria-label="Main Navigation">
        <div class="nav-inner">
            <a href="{{ url('/') }}" class="brand mobile-compact-contact" aria-label="SmartClass">
                <div class="brand-logo"><img src="{{ asset('images/smartclass-logo.png') }}" alt="Logo"></div>
                <span class="brand-text">SmartClass</span>
            </a>

            <!-- centered links (hidden on mobile) -->
            <div class="nav-center" aria-hidden="false">
                <a href="{{ url('/') }}" class="nav-link">Beranda</a>

                <div style="position:relative;">
                    <button class="nav-btn" id="jenjangBtn" aria-expanded="false" aria-haspopup="true"
                        aria-controls="jenjangDropdown">Pilih Jenjang ▾</button>
                    <div class="nav-dropdown" id="jenjangDropdown" role="menu" aria-hidden="true">
                        <a href="/jenjang/sd" role="menuitem">SD</a>
                        <a href="/jenjang/smp" role="menuitem">SMP</a>
                        <a href="/jenjang/sma" role="menuitem">SMK/SMA</a>
                    </div>
                </div>
                
                <a href="{{ route('guru.index') }}" class="nav-link">Guru</a>
                <a href="{{ route('kontak') }}"class="nav-link">Kontak</a>
            </div>

            <div class="nav-actions" role="group" aria-label="Actions">

                <button class="theme-toggle" id="themeToggle" aria-pressed="false" title="Toggle gelap/terang"
                    aria-label="Toggle tema gelap-terang">🌙</button>

                {{-- AUTH: tampilkan avatar/inisial + nama ketika login, jika tidak tampil Login --}}
                {{-- AUTH: tampilkan avatar/inisial + nama ketika login, jika tidak tampil Login --}}
                @if (auth()->check())
                    @php
                        $user = auth()->user();
                        $displayName = $user->name ?? ($user->username ?? ($user->email ?? 'User'));
                        $avatar = $user->avatar ?? ($user->photo ?? null);
                        $initials = collect(explode(' ', trim($displayName)))
                            ->filter()
                            ->map(fn($s) => strtoupper(substr($s, 0, 1)))
                            ->slice(0, 2)
                            ->join('');

                        $role = strtolower($user->role ?? '');
                        if ($role === 'admin') {
                            $dashRoute = route('admin.dashboard');
                        } elseif ($role === 'guru' || $role === 'teacher') {
                            $dashRoute = route('guru.dashboard');
                        } else {
                            $dashRoute = route('siswa.dashboard');
                        }

                        // unique ids to avoid collisions
                        $menuBtnId = 'userMenuBtn';
                        $menuId = 'userMenu';
                    @endphp

                    <div id="auth-menu" style="position:relative;display:flex;align-items:center;gap:8px;">
                        <button id="{{ $menuBtnId }}" aria-haspopup="true" aria-expanded="false"
                            aria-controls="{{ $menuId }}" title="Menu akun {{ $displayName }}"
                            style="display:inline-flex;align-items:center;gap:8px;padding:6px;border-radius:999px;border:1px solid transparent;background:transparent;cursor:pointer;">
                            {{-- avatar / initials --}}
                            @if ($avatar)
                                <img src="{{ $avatar }}" alt="Avatar {{ $displayName }}"
                                    style="width:40px;height:40px;border-radius:10px;object-fit:cover;border:1px solid rgba(255,255,255,0.06);display:block;">
                            @else
                                <div aria-hidden="true"
                                    style="width:40px;height:40px;border-radius:10px;display:grid;place-items:center;font-weight:900;color:#fff;background:linear-gradient(135deg,var(--accent-from),var(--accent-to));font-size:0.95rem;">
                                    {{ $initials ?: 'U' }}
                                </div>
                            @endif

                            <span class="avatar-name"
                                style="display:none;font-weight:700;color:var(--text)">{{ \Illuminate\Support\Str::limit($displayName, 15) }}</span>

                            <svg aria-hidden="true" style="width:14px;height:14px;opacity:.9"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- dropdown menu -->
                        <div id="{{ $menuId }}" role="menu" aria-labelledby="{{ $menuBtnId }}"
                            class="hidden"
                            style="position:absolute;right:0;top:calc(100% + 8px);min-width:180px;background:var(--card-bg);border:1px solid var(--glass-border);border-radius:10px;padding:6px;box-shadow:var(--shadow-soft);transform-origin:top right;opacity:0;pointer-events:none;transition:opacity 140ms,transform 140ms;">
                            <a href="{{ $dashRoute }}" role="menuitem"
                                style="display:block;padding:10px;border-radius:8px;font-weight:700;text-decoration:none;color:var(--text);">
                                Dashboard
                            </a>

                            <form method="POST" action="{{ route('logout') }}" role="none" style="margin:0;">
                                @csrf
                                <button type="submit" role="menuitem"
                                    style="width:100%;text-align:left;padding:10px;border-radius:8px;border:none;background:transparent;font-weight:700;color:var(--text);cursor:pointer;">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- small JS to toggle menu (no external libs) --}}
                    <script>
                        (function() {
                            const btn = document.getElementById('{{ $menuBtnId }}');
                            const menu = document.getElementById('{{ $menuId }}');
                            if (!btn || !menu) return;

                            function openMenu() {
                                menu.classList.remove('hidden');
                                menu.style.opacity = '1';
                                menu.style.pointerEvents = 'auto';
                                menu.style.transform = 'translateY(0)';
                                btn.setAttribute('aria-expanded', 'true');
                                // focus first focusable item
                                const first = menu.querySelector('a, button, [tabindex]:not([tabindex="-1"])');
                                if (first) first.focus();
                            }

                            function closeMenu() {
                                menu.style.opacity = '0';
                                menu.style.pointerEvents = 'none';
                                menu.style.transform = 'translateY(-6px)';
                                btn.setAttribute('aria-expanded', 'false');
                                // keep focus sensible
                                try {
                                    btn.focus();
                                } catch (e) {}
                            }

                            // initialize hidden state styles (in case)
                            menu.style.transform = 'translateY(-6px)';

                            btn.addEventListener('click', (e) => {
                                e.stopPropagation();
                                const open = btn.getAttribute('aria-expanded') === 'true';
                                if (open) closeMenu();
                                else openMenu();
                            });

                            // close on outside click
                            document.addEventListener('click', (e) => {
                                if (!menu.contains(e.target) && !btn.contains(e.target)) {
                                    closeMenu();
                                }
                            });

                            // keyboard: Esc to close, ArrowDown to open & focus first
                            document.addEventListener('keydown', (e) => {
                                if (e.key === 'Escape') {
                                    if (btn.getAttribute('aria-expanded') === 'true') closeMenu();
                                } else if (e.key === 'ArrowDown') {
                                    if (document.activeElement === btn) {
                                        e.preventDefault();
                                        openMenu();
                                    }
                                }
                            });

                            // close when menu loses focus entirely
                            menu.addEventListener('focusout', () => {
                                setTimeout(() => {
                                    const active = document.activeElement;
                                    if (!menu.contains(active) && active !== btn) closeMenu();
                                }, 10);
                            });
                        })();
                    </script>
                @else
                    <a href="{{ route('login') }}" class="btn-cta" id="loginBtnHeader">Login</a>
                @endif

                <button class="hamburger" id="hamburger" aria-controls="mobileDrawer" aria-expanded="false"
                    aria-label="Buka menu">
                    <span class="line top"></span>
                    <span class="line mid"></span>
                    <span class="line bot"></span>
                </button>
            </div>
        </div>
    </header>

    <!-- MOBILE DRAWER -->
    <div class="mobile-drawer" id="mobileDrawer" aria-hidden="true">
        <div class="panel">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px">
                <div class="brand">
                    <div class="brand-logo"><img src="{{ asset('images/smartclass-logo.png') }}" alt="Logo"
                            style="width:28px;height:28px;"></div>
                    <strong>SmartClass</strong>
                </div>
                <button id="closeDrawer"
                    style="font-size:1.4rem;background:none;border:none;cursor:pointer;color:var(--text)">✕</button>
            </div>

            <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:8px">
                <li><a href="/"
                        style="display:block;padding:12px;text-decoration:none;color:var(--text);font-weight:800;border-radius:8px">Beranda</a>
                </li>
                <li>
                    <button id="mobileJenjangBtn"
                        style="width:100%;text-align:left;background:none;border:none;padding:12px;font-weight:800;cursor:pointer;color:var(--text);display:flex;justify-content:space-between;border-radius:8px">Pilih
                        Jenjang ▾</button>
                    <div id="mobileJenjang" style="display:none;padding-left:8px;margin-top:6px">
                        <a href="/jenjang/sd"
                            style="display:flex;gap:10px;align-items:center;padding:10px;border-radius:8px;text-decoration:none;color:var(--text);font-weight:700"><span
                                style="width:34px;height:34px;background:linear-gradient(135deg,var(--accent-from),var(--accent-to));display:grid;place-items:center;border-radius:8px;color:#fff">SD</span>
                            SD</a>
                        <a href="/jenjang/smp"
                            style="display:flex;gap:10px;align-items:center;padding:10px;border-radius:8px;text-decoration:none;color:var(--text);font-weight:700"><span
                                style="width:34px;height:34px;background:linear-gradient(135deg,var(--accent-from),var(--accent-to));display:grid;place-items:center;border-radius:8px;color:#fff">SMP</span>
                            SMP</a>
                        <a href="/jenjang/sma"
                            style="display:flex;gap:10px;align-items:center;padding:10px;border-radius:8px;text-decoration:none;color:var(--text);font-weight:700"><span
                                style="width:34px;height:34px;background:linear-gradient(135deg,var(--accent-from),var(--accent-to));display:grid;place-items:center;border-radius:8px;color:#fff">SMA</span>
                            SMK/SMA</a>
                    </div>
                </li>
                <li><a href="{{ route('guru.index') }}" class="nav-link" style="font-weight:800">Guru</a></li>
                <li><a href="#kontak"
                        style="display:block;padding:12px;text-decoration:none;color:var(--text);font-weight:800;border-radius:8px">Kontak</a>
                </li>
            </ul>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <main class="container" role="main">
        <h1 style="margin-top:0">Kontak Kami</h1>
        <p style="color:var(--muted)">Isi form di bawah untuk pertanyaan tentang paket, pendaftaran guru, atau dukungan
            teknis.</p>

        <!-- wrapper: grid-responsive keeps markup stable but CSS fully controls layout -->
        <div class="grid-responsive" style="display:grid;grid-template-columns:1fr 420px;gap:20px;margin-top:18px">
            <div class="card">
                <form id="contactForm" novalidate>
                    <div style="margin-bottom:10px">
                        <label for="name">Nama <span style="color:#ef4444">*</span></label>
                        <input id="name" name="name" type="text" autocomplete="name">
                        <div class="field-error" id="err_name" style="display:none;color:#ef4444;font-size:.9rem">
                        </div>
                    </div>

                    <div style="display:flex;gap:12px;margin-bottom:10px;flex-wrap:wrap">
                        <div style="flex:1;min-width:160px">
                            <label for="email">Email <span style="color:#ef4444">*</span></label>
                            <input id="email" name="email" type="email" autocomplete="email">
                            <div class="field-error" id="err_email"
                                style="display:none;color:#ef4444;font-size:.9rem"></div>
                        </div>

                        <div style="width:160px;min-width:120px">
                            <label for="phone">Telepon</label>
                            <input id="phone" name="phone" type="tel">
                            <div class="field-error" id="err_phone"
                                style="display:none;color:#ef4444;font-size:.9rem"></div>
                        </div>
                    </div>

                    <div style="margin-bottom:10px">
                        <label for="subject">Subjek</label>
                        <input id="subject" name="subject" type="text">
                        <div class="field-error" id="err_subject" style="display:none;color:#ef4444;font-size:.9rem">
                        </div>
                    </div>

                    <div style="margin-bottom:10px">
                        <label for="message">Pesan <span style="color:#ef4444">*</span></label>
                        <textarea id="message" name="message"></textarea>
                        <div class="field-error" id="err_message" style="display:none;color:#ef4444;font-size:.9rem">
                        </div>
                    </div>

                    <div class="actions">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" id="btnSubmit" class="btn btn-primary">Kirim Pesan</button>
                    </div>
                </form>
            </div>

            <aside class="card">
                <h3 style="margin-top:0">Informasi Kontak</h3>
                <p style="color:var(--muted);margin:8px 0">Kantor pusat, email admin, dan jam operasional.</p>
                <div style="margin-top:10px"><strong>Alamat</strong>
                    <div style="color:var(--muted)">Jl. Contoh No.12, Jakarta</div>
                </div>
                <div style="margin-top:10px"><strong>Email</strong>
                    <div style="color:var(--muted)">windanur337@gmail.com</div>
                </div>
                <div style="margin-top:10px"><strong>WhatsApp</strong>
                    <div style="color:var(--muted)">+62 812-3456-7890</div>
                </div>
            </aside>
        </div>
    </main>

    <div id="toast" class="toast" role="status" aria-live="polite"></div>

    <!-- AJAX contact form -->
    <script>
        (function() {
            const form = document.getElementById('contactForm');
            const toast = document.getElementById('toast');
            const btn = document.getElementById('btnSubmit');

            function showToast(msg, type = 'success') {
                toast.textContent = msg;
                toast.className = 'toast show ' + (type === 'error' ? 'error' : 'success');
                clearTimeout(toast._t);
                toast._t = setTimeout(() => toast.classList.remove('show'), 4200);
            }

            function clearErrors() {
                ['name', 'email', 'phone', 'subject', 'message'].forEach(k => {
                    const el = document.getElementById('err_' + k);
                    if (el) {
                        el.style.display = 'none';
                        el.textContent = '';
                    }
                });
            }

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                clearErrors();
                btn.disabled = true;
                btn.textContent = 'Mengirim...';
                const payload = {
                    name: document.getElementById('name').value.trim(),
                    email: document.getElementById('email').value.trim(),
                    phone: document.getElementById('phone').value.trim(),
                    subject: document.getElementById('subject').value.trim(),
                    message: document.getElementById('message').value.trim()
                };
                try {
                    const res = await fetch("{{ route('kontak.kirim') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });
                    const data = await res.json().catch(() => ({}));
                    if (res.ok) {
                        form.reset();
                        showToast(data.message || 'Pesan terkirim. Terima kasih!', 'success');
                    } else if (res.status === 422) {
                        const errors = data.errors || {};
                        Object.keys(errors).forEach(k => {
                            const el = document.getElementById('err_' + k);
                            if (el) {
                                el.style.display = 'block';
                                el.textContent = errors[k].join(' ');
                            }
                        });
                        showToast('Periksa kembali isian form.', 'error');
                    } else showToast(data.message || 'Terjadi kesalahan server.', 'error');
                } catch (err) {
                    console.error(err);
                    showToast('Kesalahan jaringan. Silakan coba lagi.', 'error');
                } finally {
                    btn.disabled = false;
                    btn.textContent = 'Kirim Pesan';
                }
            });
        })();
    </script>

    <!-- THEME: toggle handler, BroadcastChannel post, and storage listener (fallback) -->
    <script>
        (function() {
            const KEY = 'smartclass-theme';
            const toggle = document.getElementById('themeToggle');
            const bc = (typeof BroadcastChannel !== 'undefined') ? new BroadcastChannel('smartclass-theme') : null;

            function applyTheme(name) {
                document.documentElement.classList.remove('theme-dark', 'theme-light');
                if (name === 'dark') document.documentElement.classList.add('theme-dark');
                else document.documentElement.classList.add('theme-light');
                if (toggle) toggle.textContent = name === 'dark' ? '☀️' : '🌙';
            }

            // initial apply (safe)
            try {
                const saved = localStorage.getItem(KEY);
                if (saved) applyTheme(saved);
                else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) applyTheme(
                    'dark');
                else applyTheme('light');
            } catch (e) {
                applyTheme('light');
            }

            // click handler for toggle button
            if (toggle) {
                toggle.addEventListener('click', () => {
                    const isDark = document.documentElement.classList.toggle('theme-dark');
                    const isLight = document.documentElement.classList.contains('theme-light');
                    const val = isDark ? 'dark' : (isLight ? 'light' : 'light');
                    try {
                        localStorage.setItem(KEY, val);
                    } catch (e) {}
                    if (bc) try {
                        bc.postMessage(val);
                    } catch (e) {}
                    applyTheme(val);
                });
            }

            // respond to storage events (other tabs/windows)
            window.addEventListener('storage', (e) => {
                if (e.key === KEY && e.newValue) {
                    applyTheme(e.newValue);
                }
            });

            // listen to BroadcastChannel messages too (for tabs that support it)
            if (bc) {
                bc.onmessage = (ev) => {
                    const v = ev.data;
                    if (v === 'dark' || v === 'light') applyTheme(v);
                };
            }
        })();
    </script>

    <!-- NAV + DRAWER SCRIPTS (unchanged logic, small additions: search toggle & compact header on scroll) -->
    <script>
        (function() {
            const jenjangBtn = document.getElementById('jenjangBtn');
            const jenjangDropdown = document.getElementById('jenjangDropdown');
            if (jenjangBtn && jenjangDropdown) {
                jenjangBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const opened = jenjangDropdown.classList.toggle('show');
                    jenjangBtn.setAttribute('aria-expanded', opened ? 'true' : 'false');
                    jenjangDropdown.setAttribute('aria-hidden', opened ? 'false' : 'true');
                });

                document.addEventListener('click', (e) => {
                    if (!jenjangBtn.contains(e.target) && !jenjangDropdown.contains(e.target)) {
                        jenjangDropdown.classList.remove('show');
                        jenjangBtn.setAttribute('aria-expanded', 'false');
                        jenjangDropdown.setAttribute('aria-hidden', 'true');
                    }
                });
            }

            const hamburger = document.getElementById('hamburger');
            const mobileDrawer = document.getElementById('mobileDrawer');
            const closeDrawer = document.getElementById('closeDrawer');

            function openDrawer() {
                mobileDrawer.classList.add('show');
                mobileDrawer.style.display = 'block';
                hamburger.classList.add('open');
                hamburger.setAttribute('aria-expanded', 'true');
                document.body.style.overflow = 'hidden';
            }

            function closeDrawerFn() {
                mobileDrawer.classList.remove('show');
                mobileDrawer.style.display = 'none';
                hamburger.classList.remove('open');
                hamburger.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }

            if (hamburger && mobileDrawer) {
                hamburger.addEventListener('click', () => {
                    if (mobileDrawer.classList.contains('show')) closeDrawerFn();
                    else openDrawer();
                });
                closeDrawer.addEventListener('click', closeDrawerFn);
                mobileDrawer.addEventListener('click', (e) => {
                    if (e.target === mobileDrawer) closeDrawerFn();
                });
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && mobileDrawer.classList.contains('show')) closeDrawerFn();
                });
                window.addEventListener('resize', () => {
                    if (window.innerWidth > 880) closeDrawerFn();
                });
            }

            const mobileJenjangBtn = document.getElementById('mobileJenjangBtn');
            const mobileJenjang = document.getElementById('mobileJenjang');
            if (mobileJenjangBtn && mobileJenjang) {
                mobileJenjangBtn.addEventListener('click', () => {
                    const is = mobileJenjang.style.display === 'block';
                    mobileJenjang.style.display = is ? 'none' : 'block';
                    mobileJenjangBtn.setAttribute('aria-expanded', !is ? 'true' : 'false');
                });
            }

            // search toggle (small nav tweak) — shows a quick prompt (keeps simple, non-intrusive)
            const searchToggle = document.getElementById('searchToggle');
            if (searchToggle) {
                searchToggle.addEventListener('click', () => {
                    const q = prompt('Cari halaman atau guru:');
                    if (q) {
                        // basic client-side navigation attempt — adapt to your app's search route
                        const url = '/search?q=' + encodeURIComponent(q);
                        window.location.href = url;
                    }
                });
            }

            // compact header on scroll for better mobile screen real-estate
            const header = document.querySelector('.site-nav');
            let lastScroll = 0;
            window.addEventListener('scroll', () => {
                const y = window.scrollY || window.pageYOffset;
                if (y > 60 && y > lastScroll) header.classList.add('compact');
                else header.classList.remove('compact');
                lastScroll = y;
            });

        })();
    </script>
</body>

</html>