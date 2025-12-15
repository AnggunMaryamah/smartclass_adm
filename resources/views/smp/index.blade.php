<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover" />
    <title>SmartClass - Kelas SMP</title>
    <meta name="description"
        content="SmartClass — Program SMP (7–9): penguatan konsep, latihan soal, dan persiapan ujian." />

    <!-- Apply saved theme ASAP to avoid flash (same key used across site) -->
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
        /* =========== copy of site theme (keamanan konsistensi) =========== */
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
            scroll-behavior: smooth
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

        .small-muted {
            color: var(--muted)
        }

        /* nav */
        .site-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 90;
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
            color: var(--text)
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
            font-size: 1.05rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12)
        }

        .brand-text {
            font-weight: 800;
            font-size: 1.05rem;
            letter-spacing: 0.02em
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
            text-decoration: none
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
            cursor: pointer
        }

        .btn-cta {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff;
            padding: .7rem 1.1rem;
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
            padding: 6px
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
            font-weight: 700
        }

        .nav-dropdown a:hover {
            background: rgba(14, 165, 233, 0.06)
        }

        /* hero */
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
            margin-bottom: 8px
        }

        .hero-desc {
            color: var(--muted);
            font-size: 1.02rem;
            line-height: 1.7;
            margin: 0 auto 18px;
            max-width: 820px
        }

        /* classes cards */
        .section {
            padding: 48px 0
        }

        .section-title {
            text-align: center;
            margin-bottom: 28px
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
            transition: transform var(--transition)
        }

        .content-card:hover {
            transform: translateY(-6px)
        }

        .card-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff;
            font-weight: 900
        }

        .card-actions {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 12px
        }

        .card-cta {
            padding: .6rem .9rem;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none
        }

        .card-link {
            background: transparent;
            border: none;
            color: var(--text);
            font-weight: 800;
            cursor: pointer;
            text-decoration: none
        }

        /* pricing */
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
            font-weight: 700
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
            justify-content: space-between
        }

        .price-badge {
            display: inline-flex;
            padding: 8px 12px;
            border-radius: 999px;
            font-weight: 800;
            background: linear-gradient(90deg, rgba(14, 165, 233, 0.06), transparent);
            margin-bottom: 12px
        }

        .price {
            font-size: 1.6rem;
            font-weight: 900;
            margin: 6px 0
        }

        .price-sub {
            color: var(--muted);
            font-size: .95rem;
            margin-bottom: 12px
        }

        .price-features {
            color: var(--muted);
            line-height: 1.8;
            margin-bottom: 14px
        }

        .price-actions {
            display: flex;
            gap: 10px;
            align-items: center
        }

        /* footer */
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
            margin: 0 auto
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800
        }

        .footer-brand .brand-logo {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: #000;
            display: grid;
            place-items: center;
            color: #fff
        }

        .footer-links {
            list-style: none;
            padding-left: 0;
            margin: 0
        }

        .footer-links li {
            margin-bottom: 8px
        }

        .footer-links a {
            color: var(--muted);
            text-decoration: none;
            font-weight: 600
        }

        .newsletter-input {
            padding: 10px;
            border-radius: 10px;
            border: 1px solid rgba(14, 165, 233, 0.08);
            width: 100%;
            margin-bottom: 10px;
            background: transparent;
            color: var(--text)
        }

        .newsletter-btn {
            width: 100%;
            padding: 10px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff;
            border: none;
            font-weight: 700;
            cursor: pointer
        }

        /* back-to-top */
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
            z-index: 60
        }

        /* responsive */
        @media (max-width:880px) {
            .nav-links {
                display: none
            }

            .hamburger {
                display: flex
            }

            .cards-grid {
                grid-template-columns: 1fr
            }

            .pricing-grid {
                grid-template-columns: 1fr
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
                <a href="https://ours.web.id" class="nav-link" title="Kembali ke Portal Kelas Kami">
                    Portal
                </a>
                <a href="{{ url('/') }}" class="nav-link">Beranda</a>

                <div style="position:relative;">
                    <button class="nav-btn" id="jenjangBtn" aria-expanded="false" aria-haspopup="true"
                        aria-controls="jenjangDropdown">Jenjang Kelas ▾</button>
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
    <div class="mobile-drawer" id="mobileDrawer" aria-hidden="true" role="dialog" aria-modal="true"
        style="display:none;">
        <div class="panel" role="document"
            style="position:fixed;right:0;top:0;bottom:0;width:86%;max-width:380px;background:var(--card-bg);padding:18px;overflow:auto;border-left:1px solid var(--glass-border);box-shadow:-20px 0 60px rgba(2,6,23,0.25);">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px">
                <div style="display:flex;gap:10px;align-items:center">
                    <div class="brand-logo" style="width:40px;height:40px">📚</div>
                    <strong>SmartClass</strong>
                </div>
                <button id="closeDrawer" aria-label="Tutup menu"
                    style="font-size:1.4rem;background:none;border:none;cursor:pointer;color:var(--text)">✕</button>
            </div>

            <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:8px">
                <li><a href="/"
                        style="display:block;padding:12px;text-decoration:none;color:var(--text);font-weight:800;border-radius:8px">Beranda</a>
                </li>
                <li>
                    <button id="mobileJenjangBtn" aria-expanded="false"
                        style="width:100%;text-align:left;background:none;border:none;padding:12px;font-weight:800;cursor:pointer;color:var(--text);display:flex;justify-content:space-between;align-items:center;border-radius:8px">Pilih
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
                </li>
                <a href="{{ route('guru.index') }}" class="nav-link">Guru</a>
                <a href="{{ route('kontak') }}"class="nav-link">Kontak</a>
            </ul>
            <a href="{{ route('login') }}" class="btn-cta" id="loginBtnHeader">Login</a>
        </div>
    </div>

    <!-- HERO -->
    <main class="hero-section" id="home" role="main">
        <div class="container">
            <h1 class="hero-title">Program <span class="gradient-text">Kelas SMP</span></h1>
            <p class="hero-desc">Program SMP (Kelas 7–9) fokus pada penguatan konsep, latihan soal, dan persiapan ujian
                — metode praktis dan pengajar profesional.</p>
        </div>
    </main>

    <!-- KELAS -->
    <section class="section" id="kelas" aria-labelledby="kelasTitle">
        <div class="container">
            <div class="section-title">
                <h2 id="kelasTitle">📚 <span class="gradient-text">Kelas yang Tersedia</span></h2>
                <p class="small-muted">Paket dirancang sesuai level SMP: penguatan dasar, persiapan ujian, dan privat
                    intensif. Pilih yang paling cocok.</p>
            </div>

            <div class="cards-grid" role="list">
                <article class="content-card" role="listitem" aria-labelledby="smp-basic">
                    <div style="display:flex;gap:14px;align-items:flex-start">
                        <div class="card-icon" aria-hidden="true">📘</div>
                        <div>
                            <h3 id="smp-basic">Penguatan Konsep (7–9)</h3>
                            <p>Fokus memperkuat dasar Matematika & IPA supaya siswa mengerti konsep, bukan hanya hafal.
                            </p>
                            <ul style="color:var(--muted);margin:12px 0 14px 18px;line-height:1.6">
                                <li><strong>Kurikulum:</strong> Konsep inti & latihan soal</li>
                                <li><strong>Metode:</strong> Interaktif & praktek</li>
                                <li><strong>Durasi:</strong> Mingguan / Bulanan</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-actions" style="justify-content:flex-start">
                        <a class="card-cta" href="/daftar?paket=smp-1">Daftar Paket Penguatan</a>
                        <a class="card-link" href="/detail?paket=smp-1" style="margin-left:12px">Lihat Detail</a>
                    </div>
                </article>

                <article class="content-card" role="listitem" aria-labelledby="smp-ujian">
                    <div style="display:flex;gap:14px;align-items:flex-start">
                        <div class="card-icon" aria-hidden="true">🧪</div>
                        <div>
                            <h3 id="smp-ujian">Persiapan Ujian & Tryout</h3>
                            <p>Tryout berkala + pembahasan strategi menjawab soal untuk mendongkrak nilai ulangan/ujian.
                            </p>
                            <ul style="color:var(--muted);margin:12px 0 14px 18px;line-height:1.6">
                                <li><strong>Kurikulum:</strong> Soal tematik & simulasi</li>
                                <li><strong>Metode:</strong> Pembahasan & feedback</li>
                                <li><strong>Bonus:</strong> Laporan progres</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-actions" style="justify-content:flex-start">
                        <a class="card-cta" href="/daftar?paket=smp-2">Daftar Paket Ujian</a>
                        <a class="card-link" href="/detail?paket=smp-2" style="margin-left:12px">Lihat Detail</a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- PRICING -->
    <section class="section" id="paket-harga" aria-labelledby="pricingTitle">
        <div class="container pricing-wrap">
            <div class="section-title">
                <h2 id="pricingTitle">💼 <span class="gradient-text">Paket & Harga</span></h2>
                <p class="small-muted">Pilih Bulanan atau Semester. Harga contoh — sesuaikan di backend bila perlu.</p>
            </div>

            <div style="display:flex;justify-content:center;margin-bottom:18px">
                <div class="toggle-switch" role="tablist" aria-label="Pilih periode">
                    <button id="toggleMonthly" class="active" role="tab" aria-selected="true">Bulanan</button>
                    <button id="toggleSemester" role="tab" aria-selected="false">Semester</button>
                </div>
            </div>

            <div class="pricing-grid" id="pricingGrid" role="list">
                <div class="pricing-card" data-plan="smp-basic">
                    <div>
                        <div class="price-badge">Penguatan</div>
                        <div class="price" data-price-month="Rp 300.000" data-price-sem="Rp 1.650.000">Rp 300.000
                        </div>
                        <div class="price-sub">per bulan</div>
                        <div class="price-features">
                            • 4 sesi / bulan<br />
                            • Modul & tugas mingguan<br />
                            • Laporan perkembangan
                        </div>
                    </div>
                    <div class="price-actions">
                        <button class="btn-cta" onclick="location.href='/daftar?paket=smp-1'">Pilih Paket</button>
                        <a href="{{ route('kontak') }}"
                            style="padding:12px 20px;border-radius:999px;border:2px solid var(--primary);background:transparent;color:var(--text);font-weight:700;cursor:pointer;text-decoration:none;display:inline-block;">
                            Tanya
                        </a>
                    </div>
                </div>

                <div class="pricing-card" data-plan="smp-ujian">
                    <div>
                        <div class="price-badge">Ujian</div>
                        <div class="price" data-price-month="Rp 350.000" data-price-sem="Rp 1.900.000">Rp 350.000
                        </div>
                        <div class="price-sub">per bulan</div>
                        <div class="price-features">
                            • Tryout & pembahasan<br />
                            • Strategi menjawab soal<br />
                            • Evaluasi berkala
                        </div>
                    </div>
                    <div class="price-actions">
                        <button class="btn-cta" onclick="location.href='/daftar?paket=smp-2'">Pilih Paket</button>
                        <a href="{{ route('kontak') }}"
                            style="padding:12px 20px;border-radius:999px;border:2px solid var(--primary);background:transparent;color:var(--text);font-weight:700;cursor:pointer;text-decoration:none;display:inline-block;">
                            Tanya
                        </a>
                    </div>
                </div>

                <div class="pricing-card" data-plan="smp-privat">
                    <div>
                        <div class="price-badge">Privat Intensif</div>
                        <div class="price" data-price-month="Rp 550.000" data-price-sem="Rp 3.000.000">Rp 550.000
                        </div>
                        <div class="price-sub">per bulan</div>
                        <div class="price-features">
                            • 8 sesi / bulan (1:1)<br />
                            • Modul personal & monitoring mingguan
                        </div>
                    </div>
                    <div class="price-actions">
                        <button class="btn-cta" onclick="location.href='/daftar?paket=smp-privat'">Pilih
                            Paket</button>
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
    <section class="section" id="guru" aria-labelledby="guruTitle">
        <div class="container">
            <div class="section-title">
                <h2 id="guruTitle">👩‍🏫 <span class="gradient-text">Guru Profesional</span></h2>
                <p class="small-muted">Tim pengajar berpengalaman & fokus pada perkembangan siswa SMP.</p>
            </div>

            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:18px;max-width:900px;margin:0 auto">
                <div
                    style="background:var(--card-bg);padding:18px;border-radius:12px;border:1px solid var(--glass-border);box-shadow:var(--shadow-soft);text-align:center">
                    <div
                        style="width:64px;height:64px;border-radius:12px;display:grid;place-items:center;margin:0 auto 10px;background:linear-gradient(135deg,var(--accent-from),var(--accent-to));color:white">
                        D</div>
                    <strong>Pak Anaxa</strong>
                    <div class="small-muted" style="margin-top:6px">Matematika • SMP</div>
                </div>
                <div
                    style="background:var(--card-bg);padding:18px;border-radius:12px;border:1px solid var(--glass-border);box-shadow:var(--shadow-soft);text-align:center">
                    <div
                        style="width:64px;height:64px;border-radius:12px;display:grid;place-items:center;margin:0 auto 10px;background:linear-gradient(135deg,var(--accent-from),var(--accent-to));color:white">
                        I</div>
                    <strong>Bu Cyrene</strong>
                    <div class="small-muted" style="margin-top:6px">IPA • Praktikum & Teori</div>
                </div>
                <div
                    style="background:var(--card-bg);padding:18px;border-radius:12px;border:1px solid var(--glass-border);box-shadow:var(--shadow-soft);text-align:center">
                    <div
                        style="width:64px;height:64px;border-radius:12px;display:grid;place-items:center;margin:0 auto 10px;background:linear-gradient(135deg,var(--accent-from),var(--accent-to));color:white">
                        R</div>
                    <strong>Pak ye shungguang</strong>
                    <div class="small-muted" style="margin-top:6px">Bahasa • Essay & TPS</div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer" id="kontak">
        <div class="footer-grid">
            <div>
                <div class="footer-brand">
                    <div class="brand-logo"> <img src="{{ asset('images/smartclass-logo.png') }}" alt="Logo"
                            style="width:28px;height:28px;"></div>
                    <div>
                        <strong style="color:var(--text);">SmartClass</strong>
                        <div style="font-size:.9rem;">Les Private & Bimbel Online</div>
                    </div>
                </div>
                <p class="small-muted">Misi kami membantu setiap siswa mencapai potensinya lewat metode pengajaran yang
                    terukur dan dukungan tutor profesional.</p>

                <!-- Social buttons (improved) -->
                <div style="margin-top:12px;display:flex;gap:10px;align-items:center">
                    <!-- Instagram -->
                    <a class="social-btn" href="https://instagram.com" target="_blank" rel="noopener noreferrer"
                        aria-label="Instagram SmartClass" title="Instagram SmartClass">
                        <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true"
                            focusable="false">
                            <path
                                d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm5 6.5A4.5 4.5 0 1 0 16.5 13 4.5 4.5 0 0 0 12 8.5zm5.2-2.6a1.05 1.05 0 1 1-1.05-1.05 1.05 1.05 0 0 1 1.05 1.05z"
                                fill="currentColor" />
                        </svg>
                        <span class="sr-only">Instagram</span>
                    </a>

                    <!-- Facebook -->
                    <a class="social-btn" href="https://facebook.com" target="_blank" rel="noopener noreferrer"
                        aria-label="Facebook SmartClass" title="Facebook SmartClass">
                        <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true"
                            focusable="false">
                            <path
                                d="M22 12.07C22 6.48 17.52 2 11.93 2S2 6.48 2 12.07c0 4.99 3.66 9.12 8.44 9.95v-7.05H8.23v-2.9h2.21V9.41c0-2.19 1.31-3.4 3.31-3.4.96 0 1.97.17 1.97.17v2.17h-1.11c-1.09 0-1.43.68-1.43 1.38v1.66h2.43l-.39 2.9h-2.04v7.05C18.34 21.19 22 17.06 22 12.07z"
                                fill="currentColor" />
                        </svg>
                        <span class="sr-only">Facebook</span>
                    </a>

                    <!-- X (Twitter) -->
                    <a class="social-btn" href="https://x.com" target="_blank" rel="noopener noreferrer"
                        aria-label="X (Twitter) SmartClass" title="X (Twitter) SmartClass">
                        <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true"
                            focusable="false">
                            <path
                                d="M22 5.92c-.66.29-1.36.5-2.09.59a3.61 3.61 0 0 0 1.58-1.99 7.1 7.1 0 0 1-2.28.87 3.56 3.56 0 0 0-6.06 3.24A10.12 10.12 0 0 1 3.16 4.9a3.56 3.56 0 0 0 1.1 4.74c-.53 0-1.03-.16-1.47-.4v.04a3.56 3.56 0 0 0 2.85 3.49c-.31.09-.64.14-.98.14-.24 0-.47-.02-.69-.06a3.56 3.56 0 0 0 3.33 2.47A7.13 7.13 0 0 1 2 19.54a10.07 10.07 0 0 0 5.46 1.6c6.55 0 10.13-5.42 10.13-10.13v-.46A7.27 7.27 0 0 0 22 5.92z"
                                fill="currentColor" />
                        </svg>
                        <span class="sr-only">X</span>
                    </a>

                    <!-- WhatsApp -->
                    <a class="social-btn" href="https://wa.me/6285831250257" target="_blank"
                        rel="noopener noreferrer" aria-label="WhatsApp SmartClass" title="WhatsApp SmartClass">
                        <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true"
                            focusable="false">
                            <path
                                d="M20.5 3.5A11 11 0 0 0 3.5 20.5L2 22l1.6-4.5A11 11 0 1 0 20.5 3.5zm-8 15.2c-2.1 0-3.9-.6-5.5-1.6l-.4-.3-3.2.8.9-3.1-.3-.4A8.7 8.7 0 1 1 19.7 8.7 8.6 8.6 0 0 1 12.5 18.7zM17 14.2c-.3-.1-1.9-.9-2.2-1-.3-.1-.5-.1-.8.1-.2.2-.7.9-.8 1.1-.1.2-.2.2-.5.1-1.1-.6-3.2-2.1-3.2-4.1 0-.8.3-1.4.8-1.9.2-.2.2-.3.2-.5 0-.2-.3-.6-.5-.9-.2-.3-.8-.6-1.2-.7-.4-.1-1.1 0-1.6.3-.5.3-1.9 1.6-1.9 3.8 0 2.2 2 4.7 4.4 6 2.4 1.3 4.1 1.4 5 1.3.9-.1 2.6-1 2.9-2 0 0 .1-.5-.2-.7-.3-.2-.7-.3-1-.5z"
                                fill="currentColor" />
                        </svg>
                        <span class="sr-only">WhatsApp</span>
                    </a>
                </div>
            </div>

            <div>
                <h4 style="margin-bottom:8px;font-weight:800;color:var(--text);">Tautan</h4>
                <ul class="footer-links">
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#program">Program</a></li>
                    <li><a href="#paket">Paket</a></li>
                    <a href="{{ route('kontak') }}"class="nav-link">Kontak</a>
                </ul>
            </div>

            <div>
                <h4 style="margin-bottom:8px;font-weight:800;color:var(--text);">Jenjang</h4>
                <ul class="footer-links">
                    <li><a href="/jenjang/sd">SD</a></li>
                    <li><a href="/jenjang/smp">SMP</a></li>
                    <li><a href="/jenjang/sma">SMA</a></li>
                </ul>
            </div>

            <div>
                <h4 style="margin-bottom:8px;font-weight:800;color:var(--text);">Kontak</h4>
                <p class="small-muted" style="line-height:1.6;">+62 858-3125-0257<br>info@smartclass.com<br>Jl.
                    Pendidikan No. 123</p>
                <input type="email" id="footerEmail" placeholder="Email..." class="newsletter-input"
                    aria-label="Email untuk langganan">
                <button id="footerSubscribe" class="newsletter-btn">Langganan</button>
            </div>
        </div>

        <div
            style="text-align:center;padding-top:16px;border-top:1px solid rgba(14,165,233,0.06);color:var(--muted);font-size:0.9rem;margin-top:20px;">
            <div>© <span id="year"></span> SmartClass — All rights reserved.</div>
        </div>

        <!-- Styles khusus social buttons (letakkan di <head> atau file CSS Anda jika perlu) -->
        <style>
            .social-btn {
                display: inline-grid;
                place-items: center;
                width: 40px;
                height: 40px;
                border-radius: 10px;
                background: var(--card-bg);
                border: 1px solid var(--glass-border);
                box-shadow: var(--shadow-soft);
                text-decoration: none;
                color: var(--text);
                transition: transform 160ms ease, box-shadow 160ms ease;
            }

            .social-btn:hover,
            .social-btn:focus {
                transform: translateY(-4px);
                box-shadow: 0 12px 30px rgba(2, 6, 23, 0.08);
                outline: none;
            }

            .social-btn svg {
                display: block
            }

            /* small-screen: make buttons slightly smaller */
            @media (max-width:480px) {
                .social-btn {
                    width: 36px;
                    height: 36px;
                    border-radius: 8px
                }
            }

            /* visually hidden for screen readers */
            .sr-only {
                position: absolute;
                border: 0;
                padding: 0;
                width: 1px;
                height: 1px;
                margin: -1px;
                overflow: hidden;
                clip: rect(0 0 0 0);
                white-space: nowrap
            }
        </style>

        <!-- Script untuk tahun & subscribe sederhana -->
        <script>
            // tahun otomatis
            (function() {
                const y = document.getElementById('year');
                if (y) y.textContent = new Date().getFullYear();
            })();

            // subscribe sederhana: validasi email & feedback
            (function() {
                const btn = document.getElementById('footerSubscribe');
                const input = document.getElementById('footerEmail');

                function validEmail(e) {
                    return /.+@.+\..+/.test(e);
                }

                if (!btn || !input) return;
                btn.addEventListener('click', function() {
                    const em = input.value.trim();
                    if (!em || !validEmail(em)) {
                        input.focus();
                        input.style.outline = '3px solid rgba(225, 60, 60, 0.12)';
                        setTimeout(() => input.style.outline = '', 1500);
                        alert('Masukkan email yang valid');
                        return;
                    }
                    // simulasi pendaftaran: ubah sesuai integrasi Anda (AJAX / form)
                    btn.textContent = 'Terdaftar ✓';
                    btn.disabled = true;
                    setTimeout(() => {
                        btn.textContent = 'Langganan';
                        btn.disabled = false;
                        input.value = '';
                    }, 1600);
                });
            })();
        </script>
    </footer>


    <!-- back to top -->
    <button class="back-to-top" id="backToTop" aria-label="Kembali ke atas">↑</button>

    <script>
        /* ------------------ Year ------------------ */
        document.getElementById('year').textContent = new Date().getFullYear();

        /* ------------------ Particles (light) ------------------ */
        (function() {
            const root = document.getElementById('particles');
            if (!root) return;
            if (window.matchMedia && window.matchMedia('(max-width:640px)').matches) return;
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

        /* ------------------ THEME (single key) ------------------ */
        (function() {
            const html = document.documentElement;
            const toggle = document.getElementById('themeToggle');
            const key = 'smartclass-theme';

            function applyTheme(name) {
                if (name === 'dark') {
                    html.classList.add('theme-dark');
                    toggle.textContent = '🌙';
                } else {
                    html.classList.remove('theme-dark');
                    toggle.textContent = '☀️';
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

        /* ------------------ NAV Dropdown & mobile drawer ------------------ */
        (function() {
            const jenjangBtn = document.getElementById('jenjangBtn');
            const jenjangDropdown = document.getElementById('jenjangDropdown');
            if (jenjangBtn && jenjangDropdown) {
                jenjangBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const open = jenjangDropdown.classList.toggle('show');
                    jenjangBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
                    jenjangDropdown.setAttribute('aria-hidden', open ? 'false' : 'true');
                    jenjangDropdown.style.left = '0';
                    jenjangDropdown.style.right = 'auto';
                    const rect = jenjangDropdown.getBoundingClientRect();
                    if (rect.right > window.innerWidth - 12) {
                        jenjangDropdown.style.right = '8px';
                        jenjangDropdown.style.left = 'auto';
                    }
                });
            }
            document.addEventListener('click', (e) => {
                if (jenjangDropdown && !jenjangBtn.contains(e.target) && !jenjangDropdown.contains(e.target)) {
                    jenjangDropdown.classList.remove('show');
                    jenjangBtn.setAttribute('aria-expanded', 'false');
                    jenjangDropdown.setAttribute('aria-hidden', 'true');
                }
            });

            // mobile drawer
            const hamburger = document.getElementById('hamburger');
            const mobileDrawer = document.getElementById('mobileDrawer');
            const closeDrawer = document.getElementById('closeDrawer');

            function openDrawer() {
                mobileDrawer.classList.add('show');
                mobileDrawer.style.display = 'block';
                mobileDrawer.setAttribute('aria-hidden', 'false');
                hamburger.classList.add('open');
                hamburger.setAttribute('aria-expanded', 'true');
                document.body.style.overflow = 'hidden';
            }

            function closeDrawerFn() {
                mobileDrawer.classList.remove('show');
                mobileDrawer.style.display = 'none';
                mobileDrawer.setAttribute('aria-hidden', 'true');
                hamburger.classList.remove('open');
                hamburger.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }
            if (hamburger && mobileDrawer) {
                hamburger.addEventListener('click', () => {
                    if (mobileDrawer.classList.contains('show')) closeDrawerFn();
                    else openDrawer();
                });
                if (closeDrawer) closeDrawer.addEventListener('click', closeDrawerFn);
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

        /* ------------------ PRICING TOGGLE (Monthly <-> Semester) ------------------ */
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
                    btnMonthly.setAttribute('aria-selected', 'true');
                    btnSemester.classList.remove('active');
                    btnSemester.setAttribute('aria-selected', 'false');
                } else {
                    btnSemester.classList.add('active');
                    btnSemester.setAttribute('aria-selected', 'true');
                    btnMonthly.classList.remove('active');
                    btnMonthly.setAttribute('aria-selected', 'false');
                }
            }

            if (btnMonthly && btnSemester) {
                btnMonthly.addEventListener('click', () => setMode('month'));
                btnSemester.addEventListener('click', () => setMode('sem'));
                setMode('month');
            }
        })();

        /* ------------------ Back-to-top & footer subscribe ------------------ */
        (function() {
            const back = document.getElementById('backToTop');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 320) back.style.display = 'flex';
                else back.style.display = 'none';
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
