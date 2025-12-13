<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover" />
    <title>SmartClass - Les Private & Bimbel Online Terpercaya</title>
    <meta name="description"
        content="SmartClass — Les private & bimbel online dengan guru berpengalaman. Daftar sekarang untuk persiapan UN/UTBK dan kelas intensif." />
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
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
            scroll-behavior: smooth;
        }

        :root {
            --bg: #f6fbff;
            --nav-bg: rgba(255, 255, 255, 0.96);
            --text: #0b1a2b;
            --muted: #52606d;
            --accent-from: #0ea5e9;
            --accent-to: #2dd4bf;
            --primary: #0ea5e9;
            --card-bg: #ffffff;
            --glass-border: rgba(2, 6, 23, 0.04);
            --shadow-strong: 0 18px 50px rgba(2, 6, 23, 0.08);
        }

        .theme-dark {
            --bg: #071426;
            --nav-bg: rgba(6, 12, 20, 0.90);
            --text: #e6eef7;
            --muted: #9fb2c6;
            --card-bg: #071224;
            --glass-border: rgba(255, 255, 255, 0.06);
            --accent-from: #2dd4bf;
            --accent-to: #1e3a5f;
            --shadow-strong: 0 14px 30px rgba(0, 0, 0, 0.35);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            transition: background 200ms ease, color 200ms ease;
            line-height: 1.5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* NAV */
        .site-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 72px;
            display: flex;
            align-items: center;
            z-index: 999;
            background: var(--nav-bg);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
            padding: 0 12px;
        }

        .nav-inner {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 0 12px;
        }

        .brand {
            display: flex;
            gap: .75rem;
            align-items: center;
            font-weight: 800;
            color: var(--text);
            text-decoration: none;
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
            box-shadow: 0 10px 30px rgba(14, 165, 233, 0.12);
        }

        .nav-links {
            display: flex;
            gap: 14px;
            align-items: center;
        }

        .nav-link,
        .nav-btn {
            color: var(--text);
            font-weight: 600;
            font-size: .95rem;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 10px;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: background 200ms, transform 200ms;
        }

        .nav-link:hover,
        .nav-btn:hover {
            background: rgba(14, 165, 233, 0.06);
            transform: translateY(-2px);
        }

        .nav-dropdown {
            position: absolute;
            min-width: 220px;
            top: calc(100% + 10px);
            left: 0;
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: var(--shadow-strong);
            padding: 8px;
            border: 1px solid rgba(14, 165, 233, 0.06);
            opacity: 0;
            pointer-events: none;
            transform: translateY(-8px);
            transition: all 180ms ease;
            z-index: 80;
        }

        .nav-dropdown.show {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }

        .nav-dropdown a {
            display: block;
            padding: 10px 12px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--text);
            font-weight: 700;
        }

        .nav-dropdown a:hover {
            background: rgba(14, 165, 233, 0.04);
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
            font-size: 1.05rem;
            transition: transform 0.2s;
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
            box-shadow: 0 12px 30px rgba(14, 165, 233, 0.12);
            transition: transform 200ms;
            text-decoration: none;
            display: inline-block;
        }

        .btn-cta:hover {
            transform: translateY(-3px);
        }

        /* HAMBURGER */
        .hamburger {
            display: none;
            width: 44px;
            height: 44px;
            flex-direction: column;
            gap: 6px;
            border-radius: 10px;
            background: var(--card-bg);
            border: 1px solid var(--glass-border);
            align-items: center;
            justify-content: center;
            cursor: pointer;
            padding: 8px;
        }

        .hamburger .line {
            width: 20px;
            height: 2px;
            background: var(--text);
            border-radius: 2px;
            transition: transform 220ms ease, opacity 220ms ease;
        }

        .hamburger.open .line.top {
            transform: translateY(6px) rotate(45deg);
        }

        .hamburger.open .line.mid {
            opacity: 0;
            transform: scaleX(0);
        }

        .hamburger.open .line.bot {
            transform: translateY(-6px) rotate(-45deg);
        }

        /* MOBILE DRAWER */
        .mobile-drawer {
            position: fixed;
            inset: 0;
            background: rgba(2, 6, 23, 0.45);
            display: none;
            z-index: 900;
            animation: fadeIn 180ms ease;
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
            animation: slideInRight 220ms ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }

        .small-muted {
            color: var(--muted);
            font-size: 0.95rem;
        }

        /* HERO */
        main.hero-section {
            padding-top: 88px;
            padding-bottom: 60px;
            min-height: calc(100vh - 120px);
            display: flex;
            align-items: center;
            position: relative;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 480px;
            gap: 36px;
            align-items: center;
        }

        .hero-text h1 {
            font-size: clamp(2rem, 5.5vw, 3.8rem);
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 14px;
        }

        .hero-text p {
            color: var(--muted);
            font-size: 1.05rem;
            margin-bottom: 20px;
            line-height: 1.7;
        }

        .hero-cta {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .hero-circle {
            width: 440px;
            height: 440px;
            border-radius: 50%;
            background: linear-gradient(180deg, rgba(14, 165, 233, 0.12), rgba(45, 212, 191, 0.06));
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 0 30px 60px rgba(14, 165, 233, 0.08);
            border: 1px solid rgba(14, 165, 233, 0.08);
            animation: float 6s ease-in-out infinite;
        }

        .hero-card {
            width: 70%;
            height: 70%;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4.2rem;
            color: #fff;
            box-shadow: 0 18px 40px rgba(2, 6, 23, 0.12);
        }

        .stats-card {
            display: flex;
            gap: 16px;
            margin-top: 20px;
            background: var(--card-bg);
            padding: 14px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(2, 6, 23, 0.06);
            border: 1px solid rgba(14, 165, 233, 0.06);
        }

        .stat-item {
            text-align: center;
            min-width: 90px;
        }

        .stat-number {
            font-size: 1.6rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-badge {
            position: absolute;
            background: var(--card-bg);
            padding: 10px 14px;
            border-radius: 12px;
            display: flex;
            gap: 8px;
            box-shadow: 0 12px 30px rgba(2, 6, 23, 0.08);
            border: 1px solid rgba(14, 165, 233, 0.06);
            animation: fadeIn 0.8s ease;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* FEATURES */
        .section {
            padding: 60px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title h2 {
            font-size: 2.2rem;
            font-weight: 900;
            margin-bottom: 12px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .feature-card {
            background: var(--card-bg);
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 18px 40px rgba(2, 6, 23, 0.06);
            border: 1px solid rgba(14, 165, 233, 0.06);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 50px rgba(2, 6, 23, 0.12);
        }

        .feature-icon {
            font-size: 2.6rem;
            margin-bottom: 12px;
        }

        .feature-card h3 {
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 12px;
        }

        /* PAKET */
        .paket-section {
            padding: 48px 0 64px;
            background: linear-gradient(180deg, rgba(14, 165, 233, 0.02), transparent);
        }

        .paket-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .paket-card {
            border-radius: 18px;
            overflow: hidden;
            background: var(--card-bg);
            padding-bottom: 18px;
            box-shadow: 0 20px 45px rgba(2, 6, 23, 0.06);
            border: 1px solid rgba(14, 165, 233, 0.06);
            transition: transform 220ms ease, box-shadow 220ms ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .paket-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 70px rgba(2, 6, 23, 0.10);
        }

        .paket-header {
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .paket-badge {
            width: 86px;
            height: 86px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: #fff;
            font-weight: 900;
            font-size: 1.6rem;
            border: 4px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 10px 30px rgba(2, 6, 23, 0.08);
            transform: translateY(16px);
        }

        .paket-body {
            text-align: center;
            padding: 26px 18px 10px;
        }

        .paket-body h3 {
            margin-bottom: 6px;
            font-size: 1.18rem;
            font-weight: 800;
        }

        .paket-subtitle {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 12px;
        }

        .paket-desc {
            color: var(--muted);
            margin-bottom: 16px;
            font-size: 0.98rem;
        }

        .paket-tags {
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .paket-tags span {
            background: rgba(14, 165, 233, 0.06);
            color: var(--primary);
            padding: 6px 10px;
            border-radius: 999px;
            font-weight: 700;
            font-size: .85rem;
        }

        .paket-btn {
            width: 100%;
            padding: 10px 16px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff;
            border: none;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .paket-btn:hover {
            transform: scale(1.05);
        }

        /* ABOUT */
        .about-section {
            padding: 80px 0;
            background: linear-gradient(180deg, rgba(14, 165, 233, 0.02), rgba(45, 212, 191, 0.01));
            position: relative;
            overflow: hidden;
        }

        .about-hero {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 48px;
            align-items: start;
            max-width: 1200px;
            margin: 0 auto;
        }

        .about-hero h2 {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 20px;
            line-height: 1.1;
        }

        .about-hero p {
            color: var(--muted);
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .about-values {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-top: 32px;
        }

        .value-card {
            background: var(--card-bg);
            padding: 24px 18px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 12px 35px rgba(2, 6, 23, 0.06);
            border: 1px solid rgba(14, 165, 233, 0.06);
            transition: all 0.3s ease;
        }

        .value-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(2, 6, 23, 0.12);
        }

        .value-icon {
            font-size: 2.2rem;
            margin-bottom: 12px;
            display: block;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-top: 12px;
        }

        .team-card {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 12px 35px rgba(2, 6, 23, 0.06);
            border: 1px solid rgba(14, 165, 233, 0.06);
            transition: all 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 45px rgba(2, 6, 23, 0.10);
        }

        .team-avatar {
            width: 90px;
            height: 90px;
            border-radius: 16px;
            display: inline-grid;
            place-items: center;
            font-size: 2.2rem;
            margin-bottom: 12px;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff;
            box-shadow: 0 10px 30px rgba(14, 165, 233, 0.15);
        }

        /* FAQ */
        .faq-section {
            padding: 54px 0;
            background: rgba(14, 165, 233, 0.02);
        }

        .faq-grid {
            max-width: 900px;
            margin: 0 auto;
            display: grid;
            gap: 14px;
        }

        .faq-item {
            background: var(--card-bg);
            padding: 18px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(2, 6, 23, 0.05);
            border: 1px solid rgba(14, 165, 233, 0.06);
            transition: all 0.3s;
        }

        .faq-item:hover {
            box-shadow: 0 15px 40px rgba(2, 6, 23, 0.08);
        }

        .faq-question {
            font-weight: 800;
            margin-bottom: 8px;
            font-size: 1.05rem;
        }

        .faq-answer {
            color: var(--muted);
            line-height: 1.7;
        }

        /* FOOTER */
        .footer {
            background: var(--card-bg);
            padding: 48px 20px 28px;
            border-top: 1px solid rgba(14, 165, 233, 0.07);
            color: var(--muted);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 28px;
            max-width: 1200px;
            margin: 0 auto 20px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-links a {
            text-decoration: none;
            color: var(--muted);
            font-weight: 600;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--primary);
        }

        .newsletter-input {
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid rgba(14, 165, 233, 0.08);
            width: 100%;
            margin-bottom: 8px;
            background: var(--bg);
            color: var(--text);
        }

        .newsletter-btn {
            width: 100%;
            padding: 10px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff;
            border: none;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .newsletter-btn:hover {
            transform: scale(1.02);
        }

        .social-link {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 10px;
            background: rgba(14, 165, 233, 0.06);
            color: var(--text);
            font-weight: 700;
            transition: all 0.2s;
            display: inline-block;
        }

        .social-link:hover {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff;
            transform: translateY(-2px);
        }

        /* RESPONSIVE */
        @media (max-width: 1100px) {
            .hero-grid {
                grid-template-columns: 1fr 380px;
            }

            .hero-circle {
                width: 380px;
                height: 380px;
            }

            .paket-grid {
                grid-template-columns: 1fr;
                max-width: 600px;
                margin: 0 auto;
            }

            .about-hero {
                grid-template-columns: 1fr;
                gap: 32px;
            }

            .about-values {
                grid-template-columns: repeat(2, 1fr);
            }

            .team-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 880px) {
            .nav-links {
                display: none !important;
            }

            .hamburger {
                display: flex !important;
            }

            .hero-grid {
                grid-template-columns: 1fr;
                gap: 22px;
            }

            .hero-circle {
                width: 320px;
                height: 320px;
                margin: 0 auto;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 640px) {
            .site-nav {
                height: 64px;
                padding: 0 10px;
            }

            main.hero-section {
                padding-top: 72px;
            }

            .hero-circle {
                width: 260px;
                height: 260px;
            }

            .hero-text h1 {
                font-size: 2rem;
            }

            .stats-card {
                flex-direction: column;
            }

            .paket-grid {
                gap: 18px;
                padding: 0 14px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .about-values {
                grid-template-columns: 1fr;
            }

            .team-grid {
                grid-template-columns: 1fr;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .auth-user {
                flex-direction: column;
                width: 50%;
            }
        }
    </style>
</head>

<body>
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
                <a href="{{ route('kontak') }}" class="nav-link">Kontak</a>
                <a href="{{ route('kontak') }}" class="nav-link">Tim SmartClass</a>
            </nav>

            <div class="nav-actions" role="group" aria-label="Actions">
                <button class="theme-toggle" id="themeToggle" aria-pressed="false" title="Toggle gelap/terang"
                    aria-label="Toggle tema gelap-terang">🌙</button>

                {{-- AUTH: tampilkan avatar/inisial + nama ketika login, jika tidak tampil Login --}}
                {{-- Avatar + Dropdown (no Alpine) --}}
                {{-- AUTH: tampilkan avatar/inisial + nama ketika login, jika tidak tampil Login --}}
                @auth
                    <div style="position:relative;" id="avatar-wrapper">
                        <button id="avatar-toggle-btn"
                            style="display:flex;align-items:center;gap:12px;background:none;border:none;cursor:pointer;padding:8px 12px;border-radius:12px;transition:background 0.2s;"
                            aria-haspopup="true" aria-expanded="false" type="button">
                            @php
                                $user = auth()->user();
                                $displayName = $user->nama_lengkap ?? ($user->name ?? 'User');
                                // buat inisial: ambil huruf pertama dua kata kalau ada
                                $parts = preg_split('/\s+/', trim($displayName));
                                $initials = strtoupper(
                                    substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''),
                                );
                            @endphp

                            @if ($user->avatar)
                                {{-- ✅ FIX: Langsung pakai URL dari Google, jangan pakai asset() --}}
                                <img src="{{ $user->avatar }}" alt="{{ $displayName }}"
                                    style="width:40px;height:40px;border-radius:50%;object-fit:cover;border:2px solid rgba(14,165,233,0.3);" />
                            @else
                                {{-- Inisial sebagai fallback --}}
                                <span
                                    style="width:40px;height:40px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-weight:700;color:#fff;background:linear-gradient(135deg,var(--accent-from),var(--accent-to));font-size:0.9rem;">
                                    {{ $initials }}
                                </span>
                            @endif

                            <span style="font-weight:600;color:var(--text);font-size:0.95rem;">
                                {{ \Illuminate\Support\Str::limit($displayName, 15) }}
                            </span>

                            <svg style="width:16px;height:16px;color:var(--text);" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        {{-- ✅ FIX: Dropdown pakai CSS custom, bukan Tailwind --}}
                        <div id="avatar-dropdown-menu"
                            style="display:none;position:absolute;right:0;margin-top:8px;min-width:200px;background:var(--card-bg);border-radius:12px;box-shadow:var(--shadow-strong);border:1px solid rgba(14,165,233,0.06);padding:8px;z-index:100;"
                            role="menu" aria-labelledby="avatar-toggle-btn">

                            @php
                                $role = $user->role ?? null;
                                if ($role === 'admin') {
                                    $dashRoute = route('admin.dashboard');
                                } elseif ($role === 'guru') {
                                    $dashRoute = route('guru.dashboard');
                                } else {
                                    $dashRoute = route('siswa.dashboard');
                                }
                            @endphp

                            <a href="{{ $dashRoute }}"
                                style="display:block;padding:10px 12px;border-radius:8px;text-decoration:none;color:var(--text);font-weight:700;transition:background 0.2s;"
                                onmouseover="this.style.background='rgba(14,165,233,0.06)'"
                                onmouseout="this.style.background='transparent'" role="menuitem">
                                Dashboard
                            </a>

                            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                                @csrf
                                <button type="submit"
                                    style="width:100%;text-align:left;display:block;padding:10px 12px;border-radius:8px;background:none;border:none;color:var(--text);font-weight:700;cursor:pointer;transition:background 0.2s;"
                                    onmouseover="this.style.background='rgba(14,165,233,0.06)'"
                                    onmouseout="this.style.background='transparent'" role="menuitem">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-cta">Login</a>
                @endauth

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
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
                <div class="brand">
                    <img src="{{ asset('images/smartclass-logo.png') }}" alt="Logo"
                        style="width:28px;height:28px;">
                    <strong>SmartClass</strong>
                </div>
                <button id="closeDrawer"
                    style="font-size:1.4rem;background:none;border:none;cursor:pointer;color:var(--text);">✕</button>
            </div>

            <ul style="margin:0;list-style:none;">
                <li><a href="/"
                        style="display:block;padding:12px;text-decoration:none;color:var(--text);font-weight:700;border-radius:8px;">Beranda</a>
                </li>
                <li>
                    <button id="mobileJenjangBtn"
                        style="width:100%;text-align:left;background:none;border:none;padding:12px;font-weight:700;cursor:pointer;color:var(--text);display:flex;justify-content:space-between;">Pilih
                        Jenjang ▾</button>
                    <div id="mobileJenjang" style="display:none;padding-left:8px;margin-top:6px;">
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
                <li>
                <li><a href="{{ route('guru.index') }}" class="nav-link">Guru</a>
                </li>
                <li>
                    <a href="{{ route('kontak') }}"class="nav-link">Kontak</a>
            </ul>
        </div>
    </div>

    <!-- HERO -->
    <main class="hero-section" id="home" role="main">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-text">
                    <h1>Wujudkan Prestasi <span class="gradient-text">Terbaikmu</span> Bersama Kami</h1>
                    <p class="small-muted">SmartClass menyediakan les private & bimbel online dengan guru
                        berpengalaman, metode pembelajaran modern, dan hasil terbukti.</p>
                    <div class="hero-cta">
                        <button class="btn-cta" style="padding:12px 20px;">Daftar Sekarang</button>
                    </div>
                    <div class="stats-card">
                        <div class="stat-item">
                            <div class="stat-number">1+</div>
                            <div class="small-muted">Tahun Pengalaman</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">2+</div>
                            <div class="small-muted">Siswa Aktif</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">8+</div>
                            <div class="small-muted">Mata Pelajaran</div>
                        </div>
                    </div>
                </div>
                <div style="display:flex;justify-content:center;align-items:center;">
                    <div class="hero-circle">
                        <div class="hero-card"> <img src="{{ asset('images/smartclass-logo.png') }}" alt="Logo"
                                style="width:100px;height:100px;"></div>
                        <div class="hero-badge" style="top:18px;right:14%;">
                            <div style="font-size:1.2rem">📚</div>
                            <div>
                                <div style="font-weight:700;">2+</div>
                                <div style="font-size:.8rem;color:var(--muted)">Siswa</div>
                            </div>
                        </div>
                        <div class="hero-badge" style="bottom:14px;left:12%;">
                            <div style="font-size:1.2rem">🏆</div>
                            <div>
                                <div style="font-weight:700;">2+</div>
                                <div style="font-size:.8rem;color:var(--muted)">Guru</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- FEATURES -->
    <section class="section" id="program">
        <div class="container">
            <div class="section-title">
                <h2>Keunggulan <span class="gradient-text">SmartClass</span></h2>
                <p class="small-muted">Pengalaman belajar terbaik dengan pendekatan personal & profesional</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3>Persiapan UN/UTBK</h3>
                    <p class="small-muted">Program intensif untuk persiapan ujian nasional dan masuk perguruan tinggi
                        favorit</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">👨‍🏫</div>
                    <h3>Guru Berpengalaman</h3>
                    <p class="small-muted">Tim pengajar lulusan PTN terkemuka dengan metode pembelajaran yang terbukti
                        efektif</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💻</div>
                    <h3>Kelas Online & Offline</h3>
                    <p class="small-muted">Fleksibilitas belajar tatap muka atau online dengan fasilitas pembelajaran
                        modern</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PAKET -->
    <section class="paket-section" id="paket">
        <div class="container">
            <div class="section-title" style="text-align:left;">
                <h2><span class="gradient-text">Pilih Paket Belajar</span></h2>
                <p class="small-muted">Pilih jenjang SD, SMP, atau SMA sesuai kebutuhanmu</p>
            </div>
            <div class="paket-grid">
                <article class="paket-card">
                    <div class="paket-header" style="background:linear-gradient(135deg,#0ea5e9,#38bdf8);">
                        <div class="paket-badge" style="background:#0ea5e9">SD</div>
                    </div>
                    <div class="paket-body">
                        <h3>Kelas SD</h3>
                        <div class="paket-subtitle">Kelas 1–6</div>
                        <p class="paket-desc">Dasar & kebiasaan belajar yang kuat. Metode menyenangkan untuk membangun
                            pondasi belajar.</p>
                        <div class="paket-tags">
                            <span>Matematika</span><span>Bahasa</span>
                        </div>
                        <button class="paket-btn" onclick="location.href='/jenjang/sd'">Lihat Paket</button>
                    </div>
                </article>
                <article class="paket-card">
                    <div class="paket-header" style="background:linear-gradient(135deg,#2dd4bf,#14b8a6);">
                        <div class="paket-badge" style="background:#2dd4bf">SMP</div>
                    </div>
                    <div class="paket-body">
                        <h3>Kelas SMP</h3>
                        <div class="paket-subtitle">Kelas 7–9</div>
                        <p class="paket-desc">Penguatan konsep & persiapan ujian. Fokus pada pemahaman dan latihan
                            terstruktur.</p>
                        <div class="paket-tags">
                            <span>Matematika</span><span>IPA</span>
                        </div>
                        <button class="paket-btn" onclick="location.href='/jenjang/smp'">Lihat Paket</button>
                    </div>
                </article>
                <article class="paket-card">
                    <div class="paket-header" style="background:linear-gradient(135deg,#7c3aed,#8b5cf6);">
                        <div class="paket-badge" style="background:#7c3aed">SMA</div>
                    </div>
                    <div class="paket-body">
                        <h3>Kelas SMA / SMK</h3>
                        <div class="paket-subtitle">Kelas 10–12</div>
                        <p class="paket-desc">Pendalaman & persiapan PTN, termasuk UTBK dan simulasi ujian nyata.</p>
                        <div class="paket-tags">
                            <span>Matematika</span><span>Fisika</span>
                        </div>
                        <button class="paket-btn" onclick="location.href='/jenjang/sma'">Lihat Paket</button>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section class="about-section" id="tentang">
        <div class="container">
            <div class="about-hero">
                <div>
                    <h2>Tentang <span class="gradient-text">SmartClass</span></h2>
                    <p>SmartClass hadir sebagai solusi bimbingan belajar modern: gabungan metode terstruktur, guru
                        berkompeten, dan teknologi pembelajaran — fokus membantu siswa berkembang secara konsisten
                        menuju tujuan akademik mereka.</p>
                    <div class="about-values" role="list">
                        <div class="value-card" role="listitem">
                            <span class="value-icon">🎯</span>
                            <strong>Personal</strong>
                            <div class="small-muted">Pembelajaran sesuai kebutuhan siswa</div>
                        </div>
                        <div class="value-card" role="listitem">
                            <span class="value-icon">📊</span>
                            <strong>Terukur</strong>
                            <div class="small-muted">Evaluasi berkala & laporan perkembangan</div>
                        </div>
                        <div class="value-card" role="listitem">
                            <span class="value-icon">🏆</span>
                            <strong>Profesional</strong>
                            <div class="small-muted">Pengajar lulusan PTN & berpengalaman</div>
                        </div>
                    </div>
                    <div style="display:flex;gap:14px;margin-top:32px;flex-wrap:wrap;">
                        <a href="/kontak" class="btn-cta" href="{{ route('kontak') }}">Hubungi Kami</a>
                        <a href="/register" class="btn-cta"
                            style="background:transparent;color:var(--text);border:2px solid var(--accent-from);">Daftar
                            Sekarang</a>
                    </div>
                </div>
                <div style="position:sticky;top:50px;">
                    <div class="team-grid">
                        <div class="team-card">
                            <div class="team-avatar">N</div>
                            <strong>nona sparkle</strong>
                            <div class="small-muted">Matematika • S2</div>
                        </div>
                        <div class="team-card">
                            <div class="team-avatar">m</div>
                            <strong>madam herta</strong>
                            <div class="small-muted">IPA • Guru</div>
                        </div>
                        <div class="team-card">
                            <div class="team-avatar">N</div>
                            <strong>Nurr Aglaeaa</strong>
                            <div class="small-muted">Bahasa • TPS</div>
                        </div>
                        <div class="team-card">
                            <div class="team-avatar">N</div>
                            <strong>Nurr Aglaeaa</strong>
                            <div class="small-muted">Bahasa • TPS</div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- FAQ -->
    <section class="faq-section" id="faq">
        <div class="container">
            <div class="section-title">
                <h2>Pertanyaan yang Sering Diajukan</h2>
                <p class="small-muted">Semua jawaban ditampilkan penuh untuk kemudahan baca.</p>
            </div>
            <div class="faq-grid">
                <div class="faq-item">
                    <div class="faq-question">Bagaimana cara mendaftar kelas privat?</div>
                    <div class="faq-answer">Untuk mendaftar, klik tombol <strong>Daftar Sekarang</strong> atau hubungi
                        kami melalui WhatsApp. Isi formulir pendaftaran singkat; tim kami akan menghubungi Anda untuk
                        konfirmasi jadwal.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">Apakah tersedia kelas online dan offline?</div>
                    <div class="faq-answer">Ya — kami menyediakan kedua pilihan. Anda dapat memilih kelas tatap muka
                        atau kelas online melalui platform video conference. Materi dan evaluasi sama.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">Bagaimana metode pembayaran?</div>
                    <div class="faq-answer">Pembayaran dapat dilakukan via transfer bank atau e-wallet. Kami memberikan
                        evaluasi berkala dan laporan perkembangan untuk setiap siswa.</div>
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
                <div style="margin-top:12px;display:flex;gap:10px;">
                    <a class="social-link" href="https://instagram.com">IG</a>
                    <a class="social-link" href="https://facebook.com">FB</a>
                    <a class="social-link" href="https://x.com">X</a>
                    <a class="social-link" href="https://wa.me/6285831250257">WA</a>
                </div>
            </div>
            <div>
                <h4 style="margin-bottom:8px;font-weight:800;color:var(--text);">Tautan</h4>
                <ul class="footer-links">
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#program">Program</a></li>
                    <li><a href="#paket">Paket</a></li>
                    <a href="{{ route('kontak') }}">kontak</a>
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
                <p class="small-muted" style="line-height:1.6;">+62 858-3125-0257<br>windanur337@gmail.com<br>Jl.
                    Pendidikan No. 123</p>
                <input type="email" id="footerEmail" placeholder="Email..." class="newsletter-input">
                <button id="footerSubscribe" class="newsletter-btn">Langganan</button>
            </div>
        </div>
        <div
            style="text-align:center;padding-top:16px;border-top:1px solid rgba(14,165,233,0.06);color:var(--muted);font-size:0.9rem;margin-top:20px;">
            <div>© <span id="year"></span> SmartClass — All rights reserved.</div>
        </div>
    </footer>

    <button id="backToTop"
        style="position:fixed;right:20px;bottom:20px;width:56px;height:56px;border-radius:50%;background:linear-gradient(135deg,var(--accent-from),var(--accent-to));color:#fff;border:none;display:none;align-items:center;justify-content:center;font-size:1.2rem;box-shadow:0 10px 30px rgba(14,165,233,0.2);z-index:60;cursor:pointer;">↑</button>

    <script>
        // Theme toggle
        const html = document.documentElement;
        const toggle = document.getElementById('themeToggle');
        const key = 'smartclass-theme';

        function applyTheme(t) {
            if (t === 'dark') {
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
        } catch (e) {}
        toggle.addEventListener('click', () => {
            const dark = html.classList.toggle('theme-dark');
            try {
                localStorage.setItem(key, dark ? 'dark' : 'light');
            } catch (e) {}
            applyTheme(dark ? 'dark' : 'light');
        });

        // Jenjang dropdown
        const jenjangBtn = document.getElementById('jenjangBtn');
        const jenjangDropdown = document.getElementById('jenjangDropdown');
        jenjangBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const open = jenjangDropdown.classList.toggle('show');
            jenjangBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
            jenjangDropdown.setAttribute('aria-hidden', open ? 'false' : 'true');
        });
        document.addEventListener('click', (e) => {
            if (!jenjangBtn.contains(e.target) && !jenjangDropdown.contains(e.target)) {
                jenjangDropdown.classList.remove('show');
                jenjangBtn.setAttribute('aria-expanded', 'false');
                jenjangDropdown.setAttribute('aria-hidden', 'true');
            }
        });

        // Mobile drawer
        const hamburger = document.getElementById('hamburger');
        const mobileDrawer = document.getElementById('mobileDrawer');
        const closeDrawer = document.getElementById('closeDrawer');

        function openDrawer() {
            mobileDrawer.classList.add('show');
            hamburger.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeDrawerFn() {
            mobileDrawer.classList.remove('show');
            hamburger.classList.remove('open');
            document.body.style.overflow = '';
        }
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

        // Mobile jenjang
        const mobileJenjangBtn = document.getElementById('mobileJenjangBtn');
        const mobileJenjang = document.getElementById('mobileJenjang');
        mobileJenjangBtn.addEventListener('click', () => {
            const showing = mobileJenjang.style.display === 'block';
            mobileJenjang.style.display = showing ? 'none' : 'block';
        });

        // Back to top
        const btn = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            btn.style.display = window.scrollY > 320 ? 'flex' : 'none';
        });
        btn.addEventListener('click', () => window.scrollTo({
            top: 0,
            behavior: 'smooth'
        }));

        // Footer
        document.getElementById('year').textContent = new Date().getFullYear();
        document.getElementById('footerSubscribe').addEventListener('click', function() {
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

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (!href || href === '#') return;
                if (document.querySelector(href)) {
                    e.preventDefault();
                    const el = document.querySelector(href);
                    const top = el.getBoundingClientRect().top + window.scrollY - 80;
                    window.scrollTo({
                        top,
                        behavior: 'smooth'
                    });
                    if (mobileDrawer.classList.contains('show')) closeDrawerFn();
                }
            });
        });
    </script>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('avatar-toggle-btn');
        const menu = document.getElementById('avatar-dropdown-menu');

        if (!toggleBtn || !menu) {
            console.error('❌ Avatar dropdown elements not found');
            return;
        }

        console.log('✅ Avatar dropdown elements found');

        function openMenu() {
            menu.style.display = 'block'; // ✅ Pakai style.display
            toggleBtn.setAttribute('aria-expanded', 'true');
            console.log('✅ Dropdown opened');

            // Optional: focus first focusable in menu
            const first = menu.querySelector('a, button, [tabindex]:not([tabindex="-1"])');
            if (first) first.focus();
        }

        function closeMenu() {
            menu.style.display = 'none'; // ✅ Pakai style.display
            toggleBtn.setAttribute('aria-expanded', 'false');
            toggleBtn.focus();
            console.log('❌ Dropdown closed');
        }

        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const expanded = toggleBtn.getAttribute('aria-expanded') === 'true';
            if (expanded) {
                closeMenu();
            } else {
                openMenu();
            }
        });

        // Close on click outside
        document.addEventListener('click', function(e) {
            if (menu.style.display === 'block') { // ✅ Cek style.display
                const isInside = menu.contains(e.target) || toggleBtn.contains(e.target);
                if (!isInside) closeMenu();
            }
        });

        // Close on Esc
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && menu.style.display === 'block') { // ✅ Cek style.display
                closeMenu();
            }
        });

        // Optional: close on focusout if focus goes outside
        menu.addEventListener('focusout', function(e) {
            setTimeout(() => {
                const active = document.activeElement;
                if (!menu.contains(active) && active !== toggleBtn) {
                    closeMenu();
                }
            }, 10);
        });
    });
</script>

</html>
