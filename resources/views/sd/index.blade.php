<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover" />
    <title>SmartClass - Les Private & Bimbel Online Terpercaya</title>
    <meta name="description" content="SmartClass — Les private & bimbel online dengan guru berpengalaman." />

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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />

    <style>
        /* ---------- THEME & BASE ---------- */
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
            box-sizing: border-box
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
            padding: 20px
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent
        }

        /* ---------- NAV ---------- */
        .site-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 990;
            background: var(--nav-bg);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border)
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px
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

        .brand-text {
            font-weight: 800;
            font-size: 1.02rem
        }

        .nav-links {
            display: flex;
            gap: 14px;
            align-items: center;
            position: relative
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
            transform: translateY(-2px)
        }

        .nav-actions {
            display: flex;
            gap: 10px;
            align-items: center
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

        .theme-toggle:hover {
            transform: scale(1.05);
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
            transform: translateY(6px) rotate(45deg)
        }

        .hamburger.open .line.mid {
            opacity: 0
        }

        .hamburger.open .line.bot {
            transform: translateY(-6px) rotate(-45deg)
        }

        /* dropdown */
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
            z-index: 120
        }

        .nav-dropdown.show {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0)
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
            background: rgba(14, 165, 233, 0.06)
        }

        /* ---------- MOBILE DRAWER ---------- */
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
            display: block
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

        /* ---------- HERO ---------- */
        .hero-section {
            min-height: 32vh;
            display: flex;
            align-items: center;
            padding-top: 96px;
            padding-bottom: 28px;
            text-align: center
        }

        .hero-title {
            font-size: clamp(1.8rem, 4.5vw, 3.2rem);
            font-weight: 900;
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .hero-desc {
            color: var(--muted);
            font-size: 1.02rem;
            line-height: 1.7;
            margin: 0 auto 18px;
            max-width: 820px
        }

        /* ---------- KELAS ---------- */
        .section {
            padding: 48px 0
        }

        .section-title {
            text-align: center;
            margin-bottom: 28px
        }

        .section-title h2 {
            font-size: 2rem;
            font-weight: 900;
            margin: 0 0 8px 0;
        }

        .section-title p {
            color: var(--muted);
            font-size: 1.02rem;
            margin: 0;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px
        }

        .content-card {
            background: var(--card-bg);
            padding: 24px;
            border-radius: 14px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-soft);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 230px;
            transition: transform var(--transition), box-shadow var(--transition);
        }

        .content-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 60px rgba(2, 6, 23, 0.12);
        }

        .card-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff;
            font-weight: 900;
            font-size: 1.8rem;
            margin-bottom: 8px;
        }

        .content-card h3 {
            margin: 0 0 8px 0;
            font-weight: 800;
            font-size: 1.1rem;
        }

        .content-card p {
            color: var(--muted);
            line-height: 1.6;
            margin: 0 0 12px 0;
            font-size: 0.98rem;
        }

        .content-card ul {
            color: var(--muted);
            margin: 12px 0 14px 18px;
            line-height: 1.6;
            font-size: 0.95rem;
            padding: 0;
        }

        .content-card ul li {
            margin-bottom: 4px;
        }

        .card-actions {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 12px;
            flex-wrap: wrap;
        }

        /* Buttons inside cards */
        .card-cta {
            padding: .6rem .9rem;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.95rem;
            transition: transform var(--transition);
        }

        .card-cta:hover {
            transform: translateY(-2px);
        }

        .card-link {
            background: transparent;
            border: none;
            color: var(--primary);
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.95rem;
            margin-left: 12px !important;
        }

        .card-link:hover {
            text-decoration: underline;
        }

        /* ---------- PRICING ---------- */
        .pricing-wrap {
            max-width: 1100px;
            margin: 24px auto
        }

        .toggle-switch {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(90deg, rgba(14, 165, 233, 0.03), transparent);
            padding: 6px;
            border-radius: 999px;
            border: 1px solid rgba(14, 165, 233, 0.04)
        }

        .toggle-switch button {
            background: transparent;
            border: none;
            padding: 8px 12px;
            border-radius: 999px;
            cursor: pointer;
            font-weight: 700;
            transition: all var(--transition);
        }

        .toggle-switch button.active {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: white
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 18px
        }

        .pricing-card {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 14px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-soft);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform var(--transition), box-shadow var(--transition);
        }

        .pricing-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 60px rgba(2, 6, 23, 0.12);
        }

        .price-badge {
            display: inline-flex;
            padding: 8px 12px;
            border-radius: 999px;
            font-weight: 800;
            background: linear-gradient(90deg, rgba(14, 165, 233, 0.06), transparent);
            margin-bottom: 12px;
            font-size: 0.9rem;
        }

        .price {
            font-size: 1.6rem;
            font-weight: 900;
            margin: 6px 0;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .price-sub {
            color: var(--muted);
            font-size: .95rem;
            margin-bottom: 12px
        }

        .price-features {
            color: var(--muted);
            line-height: 1.8;
            margin-bottom: 14px;
            font-size: 0.95rem;
        }

        .price-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        /* ---------- GURU ---------- */
        .guru-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            max-width: 900px;
            margin: 0 auto;
        }

        .guru-card {
            background: var(--card-bg);
            padding: 18px;
            border-radius: 12px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-soft);
            text-align: center;
            transition: transform var(--transition), box-shadow var(--transition);
        }

        .guru-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(2, 6, 23, 0.12);
        }

        .guru-avatar {
            width: 64px;
            height: 64px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            margin: 0 auto 10px;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: white;
            font-weight: 900;
            font-size: 1.6rem;
        }

        .guru-card strong {
            display: block;
            margin: 0 0 6px 0;
            font-size: 1rem;
        }

        .guru-card p {
            color: var(--muted);
            font-size: .95rem;
            margin: 0;
        }

        /* ---------- FOOTER ---------- */
        .footer {
            background: var(--card-bg);
            padding: 48px 20px 28px;
            margin-top: 40px;
            border-top: 1px solid var(--glass-border);
            color: var(--footer-text)
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto 20px;
        }

        .footer-col h5 {
            font-weight: 800;
            margin-bottom: 10px;
            color: var(--text);
        }

        .footer-col ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-col ul li {
            margin-bottom: 6px;
        }

        .footer-col a {
            color: var(--muted);
            text-decoration: none;
            font-size: 0.95rem;
            transition: color var(--transition);
        }

        .footer-col a:hover {
            color: var(--accent-from);
        }

        .newsletter-input {
            padding: 10px;
            border-radius: 10px;
            border: 1px solid rgba(14, 165, 233, 0.08);
            width: 100%;
            margin-bottom: 10px;
            background: transparent;
            color: var(--text);
            font-family: 'Poppins', sans-serif;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 18px;
            border-top: 1px solid rgba(14, 165, 233, 0.06);
            color: var(--muted);
            margin-top: 18px;
            font-size: .95rem;
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

            .cards-grid {
                grid-template-columns: 1fr
            }

            .pricing-grid {
                grid-template-columns: 1fr
            }

            .guru-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .section {
                padding: 34px 0
            }

            .hero-section {
                padding-top: 84px
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr
            }
        }

        @media (max-width:640px) {
            .footer-grid {
                grid-template-columns: 1fr
            }

            .guru-grid {
                grid-template-columns: 1fr;
            }

            .hero-title {
                font-size: 1.8rem;
            }

            .section-title h2 {
                font-size: 1.5rem;
            }
        }

        /* focus */
        .nav-btn:focus,
        .theme-toggle:focus,
        .btn-cta:focus,
        .hamburger:focus {
            outline: 3px solid rgba(14, 165, 233, 0.14);
            outline-offset: 3px;
            border-radius: 10px
        }
    </style>
</head>

<body>
    <!-- decorative particles -->
    <div id="particles" aria-hidden="true" style="position:fixed;inset:0;pointer-events:none;z-index:0"></div>

    <!-- NAV -->
    <!-- NAVIGATION (REPLACE ONLY THIS HEADER) -->
    <header class="site-nav" role="navigation" aria-label="Main Navigation">
        <div class="nav-inner">
            <a href="{{ url('/') }}" class="brand" aria-label="SmartClass">
                <div class="brand-logo">
                    <img src="{{ asset('images/smartclass-logo.png') }}" alt="Logo" style="width:28px;height:28px;">
                </div>
                <span class="brand-text">SmartClass</span>
            </a>

            <nav class="nav-links" aria-label="Primary Links">
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
            </nav>

            <div class="nav-actions" role="group" aria-label="Actions">
                <button class="theme-toggle" id="themeToggle" aria-pressed="false" title="Toggle gelap/terang"
                    aria-label="Toggle tema gelap-terang">🌙</button>

                {{-- AUTH: tampilkan avatar/inisial + nama ketika login, jika tidak tampil Login --}}
                @if (auth()->check())
                    @php
                        $user = auth()->user();
                        // pilih nama tampilan fallback ke email bila kosong
                        $displayName = $user->name ?? ($user->username ?? $user->email);
                        // jika ada field avatar/photo gunakan itu, atau null
                        $avatar = $user->avatar ?? ($user->photo ?? null);
                        // buat inisial (maks 2 huruf)
                        $initials = collect(explode(' ', trim($displayName)))
                            ->filter()
                            ->map(fn($s) => strtoupper(substr($s, 0, 1)))
                            ->slice(0, 2)
                            ->join('');
                    @endphp

                    <div class="auth-user" style="display:flex;gap:10px;align-items:center;">
                        @if ($avatar)
                            <img src="{{ $avatar }}" alt="avatar" class="auth-avatar"
                                style="width:44px;height:44px;border-radius:10px;object-fit:cover;border:1px solid rgba(255,255,255,0.06);">
                        @else
                            <div class="auth-initial"
                                style="width:44px;height:44px;border-radius:10px;display:grid;place-items:center;font-weight:900;color:#fff;background:linear-gradient(135deg,var(--accent-from),var(--accent-to));box-shadow:0 8px 20px rgba(14,165,233,0.12);font-size:1rem;">
                                {{ $initials ?: 'U' }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" style="display:inline;margin-left:6px;">
                            @csrf
                            <button type="submit" class="btn-cta"
                                style="background:transparent;color:var(--text);border:1px solid rgba(14,165,233,0.08);padding:.5rem .75rem;border-radius:10px;font-weight:700;">Keluar</button>
                        </form>
                    </div>
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
                <li>
                    <button id="mobileJenjangBtn"
                        style="width:100%;text-align:left;background:none;border:none;padding:12px;font-weight:800;cursor:pointer;color:var(--text);display:flex;justify-content:space-between;border-radius:8px">Pilih
                        Jenjang ▾</button>
                    <div id="mobileJenjang" style="display:none;padding-left:8px;margin-top:6px">
                        <a href="/jenjang/sd"
                            style="display:block;padding:10px;border-radius:8px;text-decoration:none;color:var(--text);font-weight:700">🎓
                            SD</a>
                        <a href="/jenjang/smp"
                            style="display:block;padding:10px;border-radius:8px;text-decoration:none;color:var(--text);font-weight:700">📖
                            SMP</a>
                        <a href="/jenjang/sma"
                            style="display:block;padding:10px;border-radius:8px;text-decoration:none;color:var(--text);font-weight:700">🎯
                            SMA</a>
                    </div>
                </li>
                <li><a href="{{ route('guru.index') }}" class="nav-link">Guru</a>
                </li>
                <li><a href="{{ route('kontak') }}"class="nav-link">Kontak</a>
                </li>
            </ul>
            <a href="{{ route('login') }}" class="btn-cta" id="loginBtnHeader">Login</a>
        </div>
    </div>

    <!-- HERO -->
    <main class="hero-section" id="home" role="main">
        <div class="container">
            <h1 class="hero-title">Les Private <span class="gradient-text">Kelas SD</span></h1>
            <p class="hero-desc">SmartClass menyediakan bimbel tatap muka & online untuk siswa SD dengan materi
                terstruktur dan pengajar berpengalaman — membangun fondasi belajar yang kuat dan menyenangkan.</p>
        </div>
    </main>

    <!-- KELAS -->
    <section class="section" id="kelas">
        <div class="container">
            <div class="section-title">
                <h2>📚 <span class="gradient-text">Kelas yang Tersedia</span></h2>
                <p>Paket dirancang sesuai level: 1–3 (pemula) dan 4–6 (menengah). Pilih jadwal & durasi yang kamu mau.
                </p>
            </div>

            <div class="cards-grid" role="list">
                <article class="content-card" role="listitem">
                    <div>
                        <div class="card-icon">🌱</div>
                        <h3>Kelas 1–3 (Pemula)</h3>
                        <p>Dasar: membaca, menulis, berhitung, aktivitas interaktif. Pendekatan ramah anak untuk
                            membangun rasa percaya diri belajar.</p>
                        <ul>
                            <li><strong>Kurikulum:</strong> Literasi & numerasi dasar</li>
                            <li><strong>Metode:</strong> Game edukasi & praktik interaktif</li>
                            <li><strong>Durasi:</strong> Fleksibel — mingguan / bulanan</li>
                        </ul>
                    </div>
                    <div class="card-actions">
                        <a class="card-cta" href="/daftar?paket=1-3">Daftar Paket 1–3</a>
                        <a class="card-link" href="/detail?paket=1-3">Lihat Detail</a>
                    </div>
                </article>

                <article class="content-card" role="listitem">
                    <div>
                        <div class="card-icon">🚀</div>
                        <h3>Kelas 4–6 (Menengah)</h3>
                        <p>Pendalaman konsep, problem solving, soal tematik dan persiapan naik kelas/ujian sekolah.</p>
                        <ul>
                            <li><strong>Kurikulum:</strong> Soal tematik, sains dasar</li>
                            <li><strong>Metode:</strong> Latihan & pembahasan strategi</li>
                            <li><strong>Bonus:</strong> Konsultasi jenjang berikutnya</li>
                        </ul>
                    </div>
                    <div class="card-actions">
                        <a class="card-cta" href="/daftar?paket=4-6">Daftar Paket 4–6</a>
                        <a class="card-link" href="/detail?paket=4-6">Lihat Detail</a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- PRICING -->
    <section class="section" id="paket-harga">
        <div class="container pricing-wrap">
            <div class="section-title">
                <h2>💼 <span class="gradient-text">Paket & Harga</span></h2>
                <p>Pilih model pembayaran — Bulanan atau Semester. Harga contoh bisa disesuaikan.</p>
            </div>

            <div style="display:flex;justify-content:center;margin-bottom:18px">
                <div class="toggle-switch" role="tablist">
                    <button id="toggleMonthly" class="active" role="tab">Bulanan</button>
                    <button id="toggleSemester" role="tab">Semester</button>
                </div>
            </div>

            <div class="pricing-grid" id="pricingGrid">
                <div class="pricing-card" data-plan="1-3">
                    <div>
                        <div class="price-badge">Kelas 1–3</div>
                        <div class="price" data-price-month="Rp 250.000" data-price-sem="Rp 1.350.000">Rp 250.000
                        </div>
                        <div class="price-sub">per bulan</div>
                        <div class="price-features">
                            • 4 sesi / bulan<br />
                            • Materi + modul + tugas mingguan<br />
                            • Laporan perkembangan
                        </div>
                    </div>
                    <div class="price-actions">
                        <button class="btn-cta" onclick="location.href='/daftar?paket=1-3'">Pilih Paket</button>
                        <a href="{{ route('kontak') }}"
                            style="padding:12px 20px;border-radius:999px;border:2px solid var(--primary);background:transparent;color:var(--text);font-weight:700;cursor:pointer;text-decoration:none;display:inline-block;">
                            Tanya
                        </a>
                    </div>
                </div>

                <div class="pricing-card" data-plan="4-6">
                    <div>
                        <div class="price-badge">Kelas 4–6</div>
                        <div class="price" data-price-month="Rp 300.000" data-price-sem="Rp 1.650.000">Rp 300.000
                        </div>
                        <div class="price-sub">per bulan</div>
                        <div class="price-features">
                            • 4 sesi / bulan<br />
                            • Latihan + simulasi ujian<br />
                            • Konsultasi naik jenjang
                        </div>
                    </div>
                    <div class="price-actions">
                        <button class="btn-cta" onclick="location.href='/daftar?paket=4-6'">Pilih Paket</button>
                        <a href="{{ route('kontak') }}"
                            style="padding:12px 20px;border-radius:999px;border:2px solid var(--primary);background:transparent;color:var(--text);font-weight:700;cursor:pointer;text-decoration:none;display:inline-block;">
                            Tanya
                        </a>
                    </div>
                </div>

                <div class="pricing-card" data-plan="privat">
                    <div>
                        <div class="price-badge">Privat Intensif</div>
                        <div class="price" data-price-month="Rp 550.000" data-price-sem="Rp 3.000.000">Rp 550.000
                        </div>
                        <div class="price-sub">per bulan</div>
                        <div class="price-features">
                            • 8 sesi / bulan (1:1)<br />
                            • Modul personal + monitoring<br />
                            • Review nilai & strategi
                        </div>
                    </div>
                    <div class="price-actions">
                        <button class="btn-cta" onclick="location.href='/daftar?paket=privat'">Pilih Paket</button>
                        <a href="{{ route('kontak') }}"
                            style="padding:12px 20px;border-radius:999px;border:2px solid var(--primary);background:transparent;color:var(--text);font-weight:700;cursor:pointer;text-decoration:none;display:inline-block;">
                            Tanya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GURU -->
    <section class="section" id="guru">
        <div class="container">
            <div class="section-title">
                <h2>👩‍🏫 <span class="gradient-text">Guru Profesional</span></h2>
                <p>Tim pengajar berpengalaman dan peduli perkembangan anak.</p>
            </div>
            <div class="guru-grid">
                <div class="guru-card">
                    <div class="guru-avatar">A</div>
                    <strong>Bu shizuku</strong>
                    <p>Spesialis literasi & anak usia dini</p>
                </div>
                <div class="guru-card">
                    <div class="guru-avatar">B</div>
                    <strong>bu kafka</strong>
                    <p>Matematika dasar</p>
                </div>
                <div class="guru-card">
                    <div class="guru-avatar">S</div>
                    <strong>Bu camellya</strong>
                    <p>Pendampingan PR & bahan ajar interaktif</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer" id="kontak" role="contentinfo">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div
                        style="display:flex;align-items:center;gap:10px;font-weight:800;color:var(--text);margin-bottom:8px">
                        <div class="brand-logo"> <img src="{{ asset('images/smartclass-logo.png') }}" alt="Logo"
                                style="width:28px;height:28px;"></div>
                        <div>
                            <div>SmartClass</div>
                            <div style="color:var(--muted);font-size:0.95rem">Bimbel & Les Privat untuk SD</div>
                        </div>
                    </div>
                    <p style="color:var(--muted);max-width:360px;margin:8px 0 0 0">Materi terstruktur, guru
                        bersertifikat, dan pendekatan yang menyenangkan untuk anak. Fokus pada hasil & perkembangan
                        jangka panjang.</p>
                </div>

                <div class="footer-col">
                    <h5>Produk</h5>
                    <ul>
                        <li><a href="/jenjang/sd">Kelas SD</a></li>
                        <li><a href="/jenjang/smp">Kelas SMP</a></li>
                        <li><a href="/jenjang/utbk">UTBK</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h5>Perusahaan</h5>
                    <ul>
                        <a href="{{ route('kontak') }}">Kontak</a>
                        <li><a href="/karir">Karir</a></li>
                        <li><a href="/blog">Blog</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h5>Newsletter</h5>
                    <p style="color:var(--muted);font-size:0.95rem;margin:0 0 8px 0">Dapatkan update kelas & promo.</p>
                    <input class="newsletter-input" id="footerEmail" placeholder="Email Anda"
                        aria-label="Email untuk newsletter" />
                    <button class="btn-cta" id="footerSubscribe" style="width:100%;margin-top:8px">Langganan</button>
                </div>
            </div>

            <div class="footer-bottom">
                <div>© <span id="year"></span> SmartClas. Semua hak dilindungi.</div>
                <div style="font-size:0.85rem;color:var(--muted);margin-top:6px;">Dikelola oleh tim SmartClass —
                    Responsive & aksesibel</div>
            </div>
        </div>
    </footer>

    <button class="back-to-top" id="backToTop" aria-label="Kembali ke atas">↑</button>

    <script>
        /* Year */
        document.getElementById('year').textContent = new Date().getFullYear();

        /* Particles */
        (function() {
            const root = document.getElementById('particles');
            if (!root || (window.matchMedia && window.matchMedia('(max-width:640px)').matches)) return;
            for (let i = 0; i < 6; i++) {
                const el = document.createElement('div');
                const size = 40 + Math.random() * 80;
                el.style.position = 'absolute';
                el.style.width = size + 'px';
                el.style.height = size + 'px';
                el.style.left = Math.random() * 100 + '%';
                el.style.top = Math.random() * 100 + '%';
                el.style.opacity = '0.03';
                el.style.borderRadius = '50%';
                el.style.background = 'radial-gradient(circle, var(--accent-from), transparent)';
                el.style.pointerEvents = 'none';
                root.appendChild(el);
            }
        })();

        /* Theme Toggle */
        (function() {
            const html = document.documentElement;
            const toggle = document.getElementById('themeToggle');
            const key = 'smartclass-theme';

            function applyTheme(name) {
                if (name === 'dark') {
                    html.classList.add('theme-dark');
                    toggle.textContent = '☀️';
                } else {
                    html.classList.remove('theme-dark');
                    toggle.textContent = '🌙';
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
                const dark = html.classList.toggle('theme-dark');
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

        /* Pricing Toggle */
        (function() {
            const btnMonthly = document.getElementById('toggleMonthly');
            const btnSemester = document.getElementById('toggleSemester');
            const priceEls = document.querySelectorAll('.pricing-card .price');

            function setMode(mode) {
                priceEls.forEach(el => {
                    const m = el.getAttribute('data-price-month');
                    const s = el.getAttribute('data-price-sem');
                    if (mode === 'month') {
                        el.textContent = m;
                        el.nextElementSibling && (el.nextElementSibling.textContent = 'per bulan');
                    } else {
                        el.textContent = s;
                        el.nextElementSibling && (el.nextElementSibling.textContent = 'per semester');
                    }
                });
                if (mode === 'month') {
                    btnMonthly.classList.add('active');
                    btnSemester.classList.remove('active');
                } else {
                    btnSemester.classList.add('active');
                    btnMonthly.classList.remove('active');
                }
            }

            if (btnMonthly && btnSemester) {
                btnMonthly.addEventListener('click', () => setMode('month'));
                btnSemester.addEventListener('click', () => setMode('sem'));
                setMode('month');
            }
        })();

        /* Back to Top & Footer */
        (function() {
            const back = document.getElementById('backToTop');
            window.addEventListener('scroll', () => {
                back.style.display = window.scrollY > 320 ? 'flex' : 'none';
            });
            back.addEventListener('click', () => window.scrollTo({
                top: 0,
                behavior: 'smooth'
            }));

            const footerSubscribe = document.getElementById('footerSubscribe');
            if (footerSubscribe) {
                footerSubscribe.addEventListener('click', function() {
                    const em = document.getElementById('footerEmail').value.trim();
                    if (!em || !/.+@.+\..+/.test(em)) {
                        alert('Masukkan email yang valid');
                        return;
                    }
                    this.textContent = 'Terdaftar ✓';
                    this.disabled = true;
                    setTimeout(() => {
                        this.textContent = 'Langganan';
                        this.disabled = false;
                        document.getElementById('footerEmail').value = '';
                    }, 1500);
                });
            }
        })();
    </script>
</body>

</html>
