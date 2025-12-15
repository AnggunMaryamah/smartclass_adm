<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover" />
    <title>SmartClass - Pendaftaran Guru Bimbel</title>
    <meta name="description"
        content="Bergabunglah sebagai guru bimbel di SmartClass. Fleksibel, kompensasi kompetitif, dan bantu ribuan siswa meraih prestasi." />

    <!-- Apply saved theme ASAP to avoid flash (single shared key) -->
    <script>
        (function() {
            try {
                const key = 'smartclass-theme';
                const saved = localStorage.getItem(key);
                if (saved === 'dark') document.documentElement.classList.add('theme-dark');
                else document.documentElement.classList.add('theme-light');
            } catch (e) {
                document.documentElement.classList.add('theme-light');
            }
        })();
    </script>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />

    <style>
        /* =========================
           BASE THEME & NAV STYLES
           (from SD page)
           ========================= */
        :root {
            --bg: #f6fbff;
            --nav-bg: rgba(255, 255, 255, 0.96);
            --text: #0b1a2b;
            --muted: #58636f;
            --accent-from: #0ea5e9;
            --accent-to: #2dd4bf;
            --card-bg: #ffffff;
            --glass-border: rgba(2, 6, 23, 0.04);
            --shadow-soft: 0 20px 50px rgba(2, 6, 23, 0.06);
            --transition: 200ms;
            --footer-text: var(--muted);
            --success: #10b981;
            --error: #ef4444;
        }

        .theme-dark {
            --bg: #071426;
            --nav-bg: rgba(6, 12, 20, 0.92);
            --text: #e6eef7;
            --muted: #9fb2c6;
            --card-bg: #071224;
            --glass-border: rgba(255, 255, 255, 0.06);
            --accent-from: #2dd4bf;
            --accent-to: #1e3a5f;
            --shadow-soft: 0 20px 60px rgba(0, 0, 0, 0.4);
            --footer-text: var(--muted);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            scroll-behavior: smooth;
            transition: background var(--transition), color var(--transition);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .brand {
            display: flex;
            gap: .75rem;
            align-items: center;
            font-weight: 800;
            text-decoration: none;
            color: var(--text);
        }

        .brand-logo {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff;
            font-weight: 900;
            font-size: 1.2rem;
        }

        /* NAV */
        .site-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 990;
            background: var(--nav-bg);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .nav-links {
            display: flex;
            gap: 14px;
            align-items: center;
            position: relative;
        }

        .nav-link,
        .nav-btn {
            color: var(--text);
            font-weight: 700;
            font-size: .95rem;
            padding: 8px 12px;
            border-radius: 10px;
            background: transparent;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: background var(--transition), transform var(--transition);
        }

        .nav-link:hover,
        .nav-btn:hover {
            background: rgba(14, 165, 233, 0.06);
            transform: translateY(-2px);
        }

        .nav-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .theme-toggle {
            width: 44px;
            height: 44px;
            border-radius: 999px;
            border: 1px solid rgba(14, 165, 233, 0.10);
            background: var(--card-bg);
            display: grid;
            place-items: center;
            cursor: pointer;
            font-size: 1.1rem;
            transition: transform 200ms;
        }

        .btn-cta {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff;
            padding: .7rem 1.1rem;
            border-radius: 999px;
            font-weight: 800;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: transform var(--transition);
        }

        .btn-cta:hover {
            transform: translateY(-2px);
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
            transition: all var(--transition);
        }

        .hamburger .line {
            width: 20px;
            height: 2px;
            background: var(--text);
            border-radius: 2px;
            transition: transform var(--transition), opacity var(--transition);
        }

        .hamburger.open .line.top {
            transform: translateY(6px) rotate(45deg);
        }

        .hamburger.open .line.mid {
            opacity: 0;
        }

        .hamburger.open .line.bot {
            transform: translateY(-6px) rotate(-45deg);
        }

        .nav-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            left: 0;
            min-width: 220px;
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
            transform: translateY(0);
        }

        .nav-dropdown a {
            display: block;
            padding: 10px;
            border-radius: 8px;
            color: var(--text);
            text-decoration: none;
            font-weight: 700;
            transition: background var(--transition);
        }

        .nav-dropdown a:hover {
            background: rgba(14, 165, 233, 0.06);
        }

        /* Mobile drawer */
        .mobile-drawer {
            position: fixed;
            inset: 0;
            background: rgba(2, 6, 23, 0.45);
            display: none;
            z-index: 900;
            backdrop-filter: blur(4px);
            animation: fadeInDrawer 180ms ease;
        }

        .mobile-drawer.show {
            display: block;
        }

        .mobile-drawer .panel {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 86%;
            max-width: 380px;
            background: var(--card-bg);
            padding: 18px;
            overflow: auto;
            border-left: 1px solid var(--glass-border);
            box-shadow: -20px 0 60px rgba(2, 6, 23, 0.25);
            animation: slideInRightDrawer 220ms ease;
        }

        @keyframes fadeInDrawer {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideInRightDrawer {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }

        /* back to top */
        .back-to-top {
            position: fixed;
            right: 20px;
            bottom: 20px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff;
            border: none;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 60;
            font-size: 1.2rem;
            font-weight: 900;
            transition: transform var(--transition);
        }

        .back-to-top:hover {
            transform: translateY(-3px);
        }

        /* responsive */
        @media (max-width:880px) {
            .nav-links {
                display: none !important;
            }

            .hamburger {
                display: flex !important;
            }
        }

        /* =========================
           FORM & PAGE STYLES (from pendaftaran page)
           ========================= */
        /* Additional variables */
        :root {
            --shadow-soft-form: 0 20px 50px rgba(2, 6, 23, 0.06);
        }

        .page-wrapper {
            min-height: 100vh;
            padding-top: 96px;
            /* account for fixed nav */
            padding-bottom: 60px;
        }

        .hero-section {
            padding: 40px 0 30px;
            text-align: center;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.08), rgba(45, 212, 191, 0.08));
            border: 1px solid var(--glass-border);
            padding: 8px 18px;
            border-radius: 999px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--accent-from);
            margin-bottom: 20px;
        }

        .hero-title {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 900;
            margin-bottom: 12px;
            line-height: 1.1;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-desc {
            color: var(--muted);
            font-size: 1.1rem;
            line-height: 1.7;
            max-width: 720px;
            margin: 0 auto 30px;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            margin: 40px 0;
        }

        .benefit-card {
            background: var(--card-bg);
            padding: 24px;
            border-radius: 14px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-soft-form);
            transition: all var(--transition);
        }

        .benefit-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 60px rgba(14, 165, 233, 0.12);
        }

        .benefit-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: white;
            display: grid;
            place-items: center;
            font-size: 1.8rem;
            margin-bottom: 16px;
        }

        .benefit-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .benefit-desc {
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .form-section {
            background: var(--card-bg);
            padding: 40px;
            border-radius: 18px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-soft-form);
            margin: 40px 0;
        }

        .form-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .form-header h2 {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .form-header p {
            color: var(--muted);
        }

        .progress-steps {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 40px;
        }

        .step {
            flex: 1;
            max-width: 200px;
            text-align: center;
            position: relative;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--glass-border);
            color: var(--muted);
            display: grid;
            place-items: center;
            font-weight: 700;
            margin: 0 auto 8px;
            transition: all var(--transition);
        }

        .step.active .step-circle {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: white;
        }

        .step.completed .step-circle {
            background: var(--success);
            color: white;
        }

        .step-label {
            font-size: 0.85rem;
            color: var(--muted);
            font-weight: 600;
        }

        .step.active .step-label {
            color: var(--text);
        }

        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-field label {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-field label .required {
            color: var(--error);
        }

        .form-field input,
        .form-field select,
        .form-field textarea {
            padding: 12px 16px;
            border-radius: 10px;
            border: 1px solid var(--glass-border);
            background: transparent;
            color: var(--text);
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            transition: all var(--transition);
        }

        .form-field input:focus,
        .form-field select:focus,
        .form-field textarea:focus {
            outline: none;
            border-color: var(--accent-from);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }

        .form-field textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-field.full-width {
            grid-column: 1 / -1;
        }

        .field-hint {
            font-size: 0.85rem;
            color: var(--muted);
            margin-top: -4px;
        }

        .error-message {
            color: var(--error);
            font-size: 0.85rem;
            margin-top: 4px;
            display: none;
        }

        .form-field.error input,
        .form-field.error select,
        .form-field.error textarea {
            border-color: var(--error);
        }

        .form-field.error .error-message {
            display: block;
        }

        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid var(--glass-border);
            cursor: pointer;
            transition: all var(--transition);
        }

        .checkbox-item:hover {
            background: rgba(14, 165, 233, 0.04);
        }

        .checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .checkbox-item label {
            cursor: pointer;
            font-size: 0.95rem;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--glass-border);
        }

        .btn {
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all var(--transition);
            border: none;
            font-family: 'Poppins', sans-serif;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(14, 165, 233, 0.3);
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid var(--glass-border);
            color: var(--text);
        }

        .btn-secondary:hover {
            background: rgba(14, 165, 233, 0.06);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .success-message {
            text-align: center;
            padding: 60px 20px;
            display: none;
        }

        .success-message.show {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--success);
            color: white;
            display: grid;
            place-items: center;
            font-size: 2.5rem;
            margin: 0 auto 20px;
        }

        .success-title {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .success-desc {
            color: var(--muted);
            font-size: 1.05rem;
            line-height: 1.7;
            max-width: 600px;
            margin: 0 auto 30px;
        }

        .toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--card-bg);
            border: 1px solid var(--glass-border);
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: var(--shadow-soft-form);
            display: none;
            z-index: 1000;
            min-width: 300px;
        }

        .toast.show {
            display: flex;
            gap: 12px;
            align-items: center;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .toast.error {
            border-left: 4px solid var(--error);
        }

        .toast.success {
            border-left: 4px solid var(--success);
        }

        @media (max-width: 768px) {
            .form-section {
                padding: 24px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .progress-steps {
                flex-direction: column;
                max-width: 200px;
                margin: 0 auto 30px;
            }

            .benefits-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
            }
        }

        /* focus */
        .nav-btn:focus,
        .theme-toggle:focus,
        .btn-cta:focus,
        .hamburger:focus {
            outline: 3px solid rgba(14, 165, 233, 0.14);
            outline-offset: 3px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <!-- NAVIGATION (REPLACED) -->
    <header class="site-nav" role="navigation" aria-label="Main Navigation">
        <div class="nav-inner">
            <a href="{{ url('/') }}" class="brand" aria-label="SmartClass">
                <div class="brand-logo">
                    <img src="{{ asset('images/smartclass-logo.png') }}" alt="Logo" style="width:28px;height:28px;">
                </div>
                <span class="brand-text">SmartClass</span>
            </a>
            
            <nav class="nav-links" aria-label="Primary Links">
                <a href="https://ours.web.id" class="nav-link" title="Kembali ke Portal Kelas Kami">
                Portal
            </a>
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
                <a href="{{ route('kontak') }}" class="nav-link">Kontak</a>
            </nav>

            <div class="nav-actions" role="group" aria-label="Actions">
                <button class="theme-toggle" id="themeToggle" aria-pressed="false" title="Toggle gelap/terang"
                    aria-label="Toggle tema gelap-terang">🌙</button>

                <!-- For simplicity in this merged static demo, show Login CTA -->
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
                    <div class="brand-logo"> <img src="{{ asset('images/smartclass-logo.png') }}" alt="Logo"
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
                    <button id="mobileJenjangBtn"
                        style="width:100%;text-align:left;background:none;border:none;padding:12px;font-weight:800;cursor:pointer;color:var(--text);display:flex;justify-content:space-between;border-radius:8px">Jenjang Kelas ▾</button>
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
                    <a href="{{ route('guru.index') }}" class="nav-link">Guru</a>
                    <a href="{{ route('kontak') }}"class="nav-link">Kontak</a>
            </ul>
        </div>
    </div>

    <div class="page-wrapper">
        <div class="container">
            <!-- Hero -->
            <section class="hero-section" aria-hidden="true">
                <div class="hero-badge" aria-hidden="true">
                    <span>✨</span>
                    <span>Bergabung dengan Tim Pengajar Terbaik</span>
                </div>
                <h1 class="hero-title">Daftar Sebagai Guru SmartClass</h1>
                <p class="hero-desc">Bantu ribuan siswa meraih prestasi terbaik mereka. Dapatkan fleksibilitas waktu,
                    kompensasi kompetitif, dan dukungan penuh dari tim kami.</p>
            </section>

            <!-- Benefits (keprluan layout, opsi bisa dihilangkan) -->
            <div class="benefits-grid" aria-hidden="true">
                <div class="benefit-card">
                    <div class="benefit-icon">💰</div>
                    <div class="benefit-title">Kompensasi Kompetitif</div>
                    <div class="benefit-desc">Penghasilan yang menarik dengan sistem pembayaran transparan dan tepat
                        waktu.</div>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">📅</div>
                    <div class="benefit-title">Jadwal Fleksibel</div>
                    <div class="benefit-desc">Atur jadwal mengajar sesuai ketersediaan Anda sendiri.</div>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">📚</div>
                    <div class="benefit-title">Materi Lengkap</div>
                    <div class="benefit-desc">Akses ke bank soal, materi ajar, dan kurikulum yang sudah disiapkan.
                    </div>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">🤝</div>
                    <div class="benefit-title">Komunitas Profesional</div>
                    <div class="benefit-desc">Bergabung dengan komunitas pengajar berpengalaman untuk berbagi ilmu.
                    </div>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="form-section" id="formSection">
                <div class="form-header">
                    <h2>Form Pendaftaran</h2>
                    <p>Lengkapi informasi berikut untuk memulai proses pendaftaran</p>
                </div>

                <!-- Progress Steps -->
                <div class="progress-steps" id="progressSteps" role="tablist" aria-label="Langkah pendaftaran">
                    <div class="step active" data-step="1" role="tab" aria-selected="true" tabindex="0">
                        <div class="step-circle">1</div>
                        <div class="step-label">Data Pribadi</div>
                    </div>
                    <div class="step" data-step="2" role="tab" aria-selected="false" tabindex="0">
                        <div class="step-circle">2</div>
                        <div class="step-label">Pengalaman</div>
                    </div>
                    <div class="step" data-step="3" role="tab" aria-selected="false" tabindex="0">
                        <div class="step-circle">3</div>
                        <div class="step-label">Ketersediaan</div>
                    </div>
                </div>

                <form id="registrationForm" novalidate>
                    <!-- Step 1: Data Pribadi -->
                    <div class="form-step active" data-step="1">
                        <div class="form-grid">
                            <div class="form-field" id="field-namaLengkap">
                                <label for="namaLengkap">Nama Lengkap <span class="required">*</span></label>
                                <input type="text" id="namaLengkap" name="namaLengkap"
                                    placeholder="Nama lengkap Anda" required>
                                <span class="error-message">Nama lengkap wajib diisi</span>
                            </div>

                            <div class="form-field" id="field-email">
                                <label for="email">Email <span class="required">*</span></label>
                                <input type="email" id="email" name="email" placeholder="email@domain.com"
                                    required>
                                <span class="error-message">Masukkan email yang valid</span>
                            </div>

                            <div class="form-field" id="field-telepon">
                                <label for="telepon">Nomor Telepon/WhatsApp <span class="required">*</span></label>
                                <input type="tel" id="telepon" name="telepon" placeholder="08xx-xxxx-xxxx"
                                    required pattern="^\+?\d{9,15}$">
                                <span class="error-message">Masukkan nomor telepon yang valid (angka, 9-15
                                    digit)</span>
                            </div>

                            <div class="form-field" id="field-kota">
                                <label for="kota">Kota/Kabupaten <span class="required">*</span></label>
                                <input type="text" id="kota" name="kota" placeholder="Contoh: Jakarta"
                                    required>
                                <span class="error-message">Kota wajib diisi</span>
                            </div>

                            <div class="form-field full-width">
                                <label for="alamat">Alamat Lengkap</label>
                                <textarea id="alamat" name="alamat" placeholder="Alamat lengkap Anda (opsional)"></textarea>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-primary" onclick="nextStep()">Lanjut →</button>
                        </div>
                    </div>

                    <!-- Step 2: Pengalaman -->
                    <div class="form-step" data-step="2">
                        <div class="form-grid">
                            <div class="form-field" id="field-pendidikan">
                                <label for="pendidikan">Pendidikan Terakhir <span class="required">*</span></label>
                                <select id="pendidikan" name="pendidikan" required>
                                    <option value="">Pilih pendidikan...</option>
                                    <option value="D3">D3</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
                                <span class="error-message">Pilih pendidikan terakhir</span>
                            </div>

                            <div class="form-field" id="field-jurusan">
                                <label for="jurusan">Jurusan/Program Studi <span class="required">*</span></label>
                                <input type="text" id="jurusan" name="jurusan"
                                    placeholder="Contoh: Pendidikan Matematika" required>
                                <span class="error-message">Jurusan wajib diisi</span>
                            </div>

                            <div class="form-field" id="field-pengalaman">
                                <label for="pengalaman">Pengalaman Mengajar <span class="required">*</span></label>
                                <select id="pengalaman" name="pengalaman" required>
                                    <option value="">Pilih pengalaman...</option>
                                    <option value="< 1 tahun">Kurang dari 1 tahun</option>
                                    <option value="1-2 tahun">1-2 tahun</option>
                                    <option value="3-5 tahun">3-5 tahun</option>
                                    <option value="> 5 tahun">Lebih dari 5 tahun</option>
                                </select>
                                <span class="error-message">Pilih pengalaman mengajar</span>
                            </div>

                            <div class="form-field full-width" id="field-jenjang">
                                <label>Jenjang yang Dapat Diampu <span class="required">*</span></label>
                                <div class="checkbox-group" id="jenjangGroup">
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="jenjang_sd" name="jenjang" value="SD">
                                        <label for="jenjang_sd">SD</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="jenjang_smp" name="jenjang" value="SMP">
                                        <label for="jenjang_smp">SMP</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="jenjang_sma" name="jenjang" value="SMA/SMK">
                                        <label for="jenjang_sma">SMA/SMK</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="jenjang_utbk" name="jenjang" value="UTBK">
                                        <label for="jenjang_utbk">UTBK</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="jenjang_umum" name="jenjang" value="Umum">
                                        <label for="jenjang_umum">Umum</label>
                                    </div>
                                </div>
                                <span class="error-message">Pilih minimal satu jenjang</span>
                            </div>

                            <div class="form-field full-width" id="field-mataPelajaran">
                                <label for="mataPelajaran">Mata Pelajaran yang Dikuasai <span
                                        class="required">*</span></label>
                                <input type="text" id="mataPelajaran" name="mataPelajaran"
                                    placeholder="Pisahkan dengan koma, contoh: Matematika, Fisika, Kimia" required>
                                <span class="field-hint">Tuliskan semua mata pelajaran yang dapat Anda ajarkan</span>
                                <span class="error-message">Mata pelajaran wajib diisi</span>
                            </div>

                            <div class="form-field full-width">
                                <label for="deskripsiPengalaman">Deskripsi Pengalaman Mengajar</label>
                                <textarea id="deskripsiPengalaman" name="deskripsiPengalaman"
                                    placeholder="Ceritakan pengalaman mengajar Anda, metode yang digunakan, dan prestasi siswa..."></textarea>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="prevStep()">← Kembali</button>
                            <button type="button" class="btn btn-primary" onclick="nextStep()">Lanjut →</button>
                        </div>
                    </div>

                    <!-- Step 3: Ketersediaan -->
                    <div class="form-step" data-step="3">
                        <div class="form-grid">
                            <div class="form-field full-width" id="field-hari">
                                <label>Hari yang Tersedia <span class="required">*</span></label>
                                <div class="checkbox-group" id="hariGroup">
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="hari_senin" name="hari" value="Senin">
                                        <label for="hari_senin">Senin</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="hari_selasa" name="hari" value="Selasa">
                                        <label for="hari_selasa">Selasa</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="hari_rabu" name="hari" value="Rabu">
                                        <label for="hari_rabu">Rabu</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="hari_kamis" name="hari" value="Kamis">
                                        <label for="hari_kamis">Kamis</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="hari_jumat" name="hari" value="Jumat">
                                        <label for="hari_jumat">Jumat</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="hari_sabtu" name="hari" value="Sabtu">
                                        <label for="hari_sabtu">Sabtu</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="hari_minggu" name="hari" value="Minggu">
                                        <label for="hari_minggu">Minggu</label>
                                    </div>
                                </div>
                                <span class="error-message">Pilih minimal satu hari</span>
                            </div>

                            <div class="form-field full-width" id="field-waktu">
                                <label>Waktu yang Tersedia <span class="required">*</span></label>
                                <div class="checkbox-group" id="waktuGroup">
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="waktu_pagi" name="waktu"
                                            value="Pagi (08:00-12:00)">
                                        <label for="waktu_pagi">Pagi (08:00-12:00)</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="waktu_siang" name="waktu"
                                            value="Siang (12:00-16:00)">
                                        <label for="waktu_siang">Siang (12:00-16:00)</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="waktu_sore" name="waktu"
                                            value="Sore (16:00-18:00)">
                                        <label for="waktu_sore">Sore (16:00-18:00)</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="checkbox" id="waktu_malam" name="waktu"
                                            value="Malam (18:00-21:00)">
                                        <label for="waktu_malam">Malam (18:00-21:00)</label>
                                    </div>
                                </div>
                                <span class="error-message">Pilih minimal satu waktu</span>
                            </div>

                            <div class="form-field" id="field-metodePengajaran">
                                <label for="metodePengajaran">Metode Pengajaran <span
                                        class="required">*</span></label>
                                <select id="metodePengajaran" name="metodePengajaran" required>
                                    <option value="">Pilih metode...</option>
                                    <option value="Online">Online (via Zoom/Google Meet)</option>
                                    <option value="Offline">Offline (Datang ke rumah siswa)</option>
                                    <option value="Keduanya">Keduanya (Online & Offline)</option>
                                </select>
                                <span class="error-message">Pilih metode pengajaran</span>
                            </div>

                            <div class="form-field" id="field-ekspektasiHonor">
                                <label for="ekspektasiHonor">Ekspektasi Honor per Jam (IDR) <span
                                        class="required">*</span></label>
                                <input type="number" id="ekspektasiHonor" name="ekspektasiHonor"
                                    placeholder="Contoh: 100000" min="0" required>
                                <span class="error-message">Masukkan ekspektasi honor (angka)</span>
                            </div>

                            <div class="form-field full-width">
                                <label for="cvUpload">Upload CV / Portofolio (opsional)</label>
                                <input type="file" id="cvUpload" name="cvUpload" accept=".pdf,.doc,.docx" />
                                <span class="field-hint">Format PDF atau DOC, maksimal 5MB</span>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="prevStep()">← Kembali</button>
                            <button type="submit" class="btn btn-primary">Kirim Pendaftaran</button>
                        </div>
                    </div>
                </form>

                <!-- Success message -->
                <div class="success-message" id="successMessage" aria-live="polite">
                    <div class="success-icon" aria-hidden="true">✓</div>
                    <div class="success-title">Terima kasih! Pendaftaran Berhasil</div>
                    <div class="success-desc">Tim SmartClass akan meninjau data Anda dan menghubungi melalui email atau
                        WhatsApp dalam 3-5 hari kerja. Simpan kontak kami untuk info lanjutan.</div>
                    <div style="margin-top:20px;">
                        <a href="/" class="btn btn-primary">Kembali ke Beranda</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Toast -->
    <div class="toast" id="toast" role="status" aria-live="polite"></div>

    <button class="back-to-top" id="backToTop" aria-label="Kembali ke atas">↑</button>

    <script>
        /* ===============
                       NAV & THEME SCRIPTS (from SD page)
                       =============== */
        /* Theme Toggle (uses localStorage 'smartclass-theme') */
        (function() {
            const html = document.documentElement;
            const toggle = document.getElementById('themeToggle');
            const key = 'smartclass-theme';

            function applyTheme(name) {
                if (name === 'dark') {
                    html.classList.add('theme-dark');
                    toggle.textContent = '🌙';
                    toggle.setAttribute('aria-pressed', 'true');
                } else {
                    html.classList.remove('theme-dark');
                    toggle.textContent = '☀️';
                    toggle.setAttribute('aria-pressed', 'false');
                }
            }
            try {
                const saved = localStorage.getItem(key);
                if (saved) applyTheme(saved);
                else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) applyTheme(
                    'dark');
                else applyTheme('light');
            } catch (e) {
                applyTheme('light');
            }
            toggle.addEventListener('click', () => {
                const dark = document.documentElement.classList.toggle('theme-dark');
                try {
                    localStorage.setItem(key, dark ? 'dark' : 'light');
                } catch (e) {}
                applyTheme(dark ? 'dark' : 'light');
            });
        })();

        /* Nav Dropdown */
        (function() {
            const jenjangBtn = document.getElementById('jenjangBtn');
            const jenjangDropdown = document.getElementById('jenjangDropdown');
            if (!jenjangBtn || !jenjangDropdown) return;

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
        })();

        /* Mobile Drawer */
        (function() {
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
        })();

        /* Back to Top & simple footer subscription behavior */
        (function() {
            const back = document.getElementById('backToTop');
            window.addEventListener('scroll', () => {
                back.style.display = window.scrollY > 320 ? 'flex' : 'none';
            });
            back.addEventListener('click', () => window.scrollTo({
                top: 0,
                behavior: 'smooth'
            }));
        })();

        /* ============================
           REGISTRATION FORM SCRIPTS
           (from pendaftaran page)
           ============================ */
        // Step navigation
        let currentStep = 1;
        const totalSteps = 3;

        function showStep(step) {
            currentStep = step;
            document.querySelectorAll('.form-step').forEach(el => {
                el.classList.toggle('active', Number(el.dataset.step) === step);
            });
            document.querySelectorAll('.progress-steps .step').forEach(el => {
                const s = Number(el.dataset.step);
                el.classList.toggle('active', s === step);
                el.classList.toggle('completed', s < step);
                el.setAttribute('aria-selected', s === step ? 'true' : 'false');
            });
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function nextStep() {
            if (!validateStep(currentStep)) return;
            if (currentStep < totalSteps) showStep(currentStep + 1);
        }

        function prevStep() {
            if (currentStep > 1) showStep(currentStep - 1);
        }

        // Basic validation per step
        function validateStep(step) {
            clearErrors(step);
            let valid = true;
            if (step === 1) {
                const nama = document.getElementById('namaLengkap');
                const email = document.getElementById('email');
                const telepon = document.getElementById('telepon');
                const kota = document.getElementById('kota');

                if (!nama.value.trim()) {
                    markError('field-namaLengkap');
                    valid = false;
                }
                if (!validateEmail(email.value)) {
                    markError('field-email');
                    valid = false;
                }
                if (!validatePhone(telepon.value)) {
                    markError('field-telepon');
                    valid = false;
                }
                if (!kota.value.trim()) {
                    markError('field-kota');
                    valid = false;
                }
            } else if (step === 2) {
                const pendidikan = document.getElementById('pendidikan');
                const jurusan = document.getElementById('jurusan');
                const pengalaman = document.getElementById('pengalaman');
                const mata = document.getElementById('mataPelajaran');

                if (!pendidikan.value) {
                    markError('field-pendidikan');
                    valid = false;
                }
                if (!jurusan.value.trim()) {
                    markError('field-jurusan');
                    valid = false;
                }
                if (!pengalaman.value) {
                    markError('field-pengalaman');
                    valid = false;
                }
                if (!mata.value.trim()) {
                    markError('field-mataPelajaran');
                    valid = false;
                }

                if (!isAnyChecked('#jenjangGroup input[type="checkbox"]')) {
                    markError('field-jenjang');
                    valid = false;
                }
            } else if (step === 3) {
                if (!isAnyChecked('#hariGroup input[type="checkbox"]')) {
                    markError('field-hari');
                    valid = false;
                }
                if (!isAnyChecked('#waktuGroup input[type="checkbox"]')) {
                    markError('field-waktu');
                    valid = false;
                }
                if (!document.getElementById('metodePengajaran').value) {
                    markError('field-metodePengajaran');
                    valid = false;
                }
                const honor = document.getElementById('ekspektasiHonor');
                if (!honor.value || Number(honor.value) < 0) {
                    markError('field-ekspektasiHonor');
                    valid = false;
                }
            }

            if (!valid) {
                showToast('Mohon lengkapi data di langkah ini sebelum melanjutkan.', 'error');
            }
            return valid;
        }

        function markError(fieldId) {
            const el = document.getElementById(fieldId);
            if (el) el.classList.add('error');
        }

        function clearErrors(step) {
            const stepEl = document.querySelector('.form-step[data-step="' + step + '"]');
            if (!stepEl) return;
            stepEl.querySelectorAll('.form-field').forEach(f => f.classList.remove('error'));
        }

        function isAnyChecked(selector) {
            return Array.from(document.querySelectorAll(selector)).some(i => i.checked);
        }

        function validateEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        function validatePhone(phone) {
            const cleaned = phone.replace(/\D/g, '');
            return cleaned.length >= 9 && cleaned.length <= 15;
        }

        // Toast helper
        const toastEl = document.getElementById('toast');
        let toastTimer = null;

        function showToast(message, type = 'success') {
            if (!toastEl) return;
            toastEl.className = 'toast ' + (type === 'error' ? 'error' : 'success') + ' show';
            toastEl.textContent = message;
            if (toastTimer) clearTimeout(toastTimer);
            toastTimer = setTimeout(() => {
                toastEl.classList.remove('show');
            }, 4000);
        }

        // Form submission
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Ensure we're validating the final step
            if (!validateStep(currentStep)) return;

            // collect data
            const formData = new FormData();
            const fields = [
                'namaLengkap', 'email', 'telepon', 'kota', 'alamat',
                'pendidikan', 'jurusan', 'pengalaman', 'deskripsiPengalaman', 'mataPelajaran',
                'metodePengajaran', 'ekspektasiHonor'
            ];
            fields.forEach(k => {
                const el = document.getElementById(k);
                if (el) formData.append(k, el.value);
            });

            const jenjang = Array.from(document.querySelectorAll('#jenjangGroup input[type="checkbox"]:checked'))
                .map(i => i.value);
            const hari = Array.from(document.querySelectorAll('#hariGroup input[type="checkbox"]:checked')).map(i =>
                i.value);
            const waktu = Array.from(document.querySelectorAll('#waktuGroup input[type="checkbox"]:checked')).map(
                i => i.value);

            formData.append('jenjang', JSON.stringify(jenjang));
            formData.append('hari', JSON.stringify(hari));
            formData.append('waktu', JSON.stringify(waktu));

            // file (optional)
            const fileEl = document.getElementById('cvUpload');
            if (fileEl && fileEl.files && fileEl.files[0]) {
                const file = fileEl.files[0];
                if (file.size > 5 * 1024 * 1024) {
                    showToast('Ukuran file maksimal 5MB', 'error');
                    return;
                }
                formData.append('cv', file);
            }

            // show sending toast
            showToast('Mengirim pendaftaran...', 'success');

            // --- Real request: ganti URL '/api/pendaftaran-guru' sesuai backend Anda ---
            fetch('/api/pendaftaran-guru', {
                    method: 'POST',
                    body: formData
                })
                .then(async r => {
                    // try parse JSON, but be tolerant if not JSON
                    const json = await r.json().catch(() => ({}));
                    if (r.ok && (json.ok === undefined || json.ok === true)) {
                        // success
                        document.getElementById('registrationForm').style.display = 'none';
                        document.getElementById('progressSteps').style.display = 'none';
                        document.getElementById('successMessage').classList.add('show');
                        showToast('Pendaftaran berhasil dikirim. Terima kasih!', 'success');
                    } else {
                        const msg = json.message || 'Gagal mengirim pendaftaran';
                        showToast(msg, 'error');
                    }
                })
                .catch(err => {
                    showToast('Terjadi kesalahan jaringan. Silakan coba lagi.', 'error');
                    console.error('Submit error:', err);

                    // Uncomment the block below to simulate success locally if backend not ready:
                    /*
                    setTimeout(() => {
                        document.getElementById('registrationForm').style.display = 'none';
                        document.getElementById('progressSteps').style.display = 'none';
                        document.getElementById('successMessage').classList.add('show');
                        showToast('Pendaftaran berhasil dikirim. Terima kasih!', 'success');
                    }, 1100);
                    */
                });
        });

        // Make progress steps clickable (with validation checks)
        document.querySelectorAll('.progress-steps .step').forEach(s => {
            s.addEventListener('click', () => {
                const step = Number(s.dataset.step);
                if (step > currentStep) {
                    for (let st = 1; st < step; st++) {
                        if (!validateStep(st)) return;
                    }
                }
                showStep(step);
            });
            // keyboard support
            s.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    s.click();
                }
            });
        });

        // Prevent enter from submitting when focusing inputs (except textarea)
        document.querySelectorAll('#registrationForm input').forEach(i => {
            i.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' && i.tagName !== 'TEXTAREA') {
                    e.preventDefault();
                }
            });
        });

        // set initial scroll position (optional)
        window.scrollTo(0, 0);
    </script>
</body>

</html>
