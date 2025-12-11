<!doctype html>
<html lang="id" class="theme-light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>SmartClass — Landing (Final)</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap');

        :root {
            --bg: #0a1628;
            --nav-bg: rgba(10, 22, 40, 0.85);
            --text: #ffffff;
            --muted: #94a3b8;
            --accent-from: #1e3a5f;
            --accent-to: #2dd4bf;
            --primary: #2dd4bf;
            --secondary: #1e3a5f;
            --card-bg: #0f1f35;
            --panel: rgba(45, 212, 191, 0.05);
            --floating-shadow: 0 30px 60px rgba(45, 212, 191, 0.3);
        }

        .theme-light {
            --bg: #f0f9ff;
            --nav-bg: rgba(255, 255, 255, 0.9);
            --text: #0f172a;
            --muted: #475569;
            --accent-from: #0ea5e9;
            --accent-to: #2dd4bf;
            --primary: #0ea5e9;
            --secondary: #2dd4bf;
            --card-bg: #ffffff;
            --panel: rgba(14, 165, 233, 0.05);
            --floating-shadow: 0 25px 50px rgba(14, 165, 233, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            transition: background 0.4s ease, color 0.4s ease;
        }

        /* Animated Background Particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, var(--accent-from), transparent);
            opacity: 0.15;
            animation: float-particle 20s infinite ease-in-out;
        }

        @keyframes float-particle {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            25% {
                transform: translate(100px, -100px) scale(1.2);
            }

            50% {
                transform: translate(-50px, -200px) scale(0.8);
            }

            75% {
                transform: translate(-150px, -100px) scale(1.1);
            }
        }

        /* Navigation */
        .site-nav {
            background: var(--nav-bg);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            z-index: 60;
        }

        .site-nav.scrolled {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }

        .brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--text);
            display: flex;
            gap: 0.75rem;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .brand:hover {
            transform: scale(1.05);
        }

        .brand-logo {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 900;
            font-size: 1.5rem;
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
            animation: pulse-glow 3s infinite;
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 8px 25px rgba(14, 165, 233, 0.4);
            }

            50% {
                box-shadow: 0 12px 35px rgba(45, 212, 191, 0.6);
            }
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            z-index: 2;
            min-height: 90vh;
            display: flex;
            align-items: center;
        }

        .hero-text h1 {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--text), var(--accent-from));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: text-shimmer 3s infinite;
        }

        @keyframes text-shimmer {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: inline-block;
        }

        /* Hero Circle */
        .hero-circle {
            width: 550px;
            height: 550px;
            border-radius: 50%;
            background: linear-gradient(135deg,
                    rgba(14, 165, 233, 0.2),
                    rgba(45, 212, 191, 0.15));
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: var(--floating-shadow);
            animation: rotate-slow 30s linear infinite, float-hero 6s ease-in-out infinite;
            border: 2px solid rgba(14, 165, 233, 0.3);
        }

        @keyframes rotate-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes float-hero {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-30px) rotate(2deg);
            }
        }

        .hero-circle::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            opacity: 0.5;
            filter: blur(20px);
            animation: pulse-border 3s infinite;
        }

        @keyframes pulse-border {

            0%,
            100% {
                opacity: 0.3;
            }

            50% {
                opacity: 0.6;
            }
        }

        .hero-card {
            width: 75%;
            height: 65%;
            background: var(--card-bg);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
            position: relative;
            animation: card-float 8s ease-in-out infinite;
        }

        @keyframes card-float {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-15px) scale(1.02);
            }
        }

        .hero-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                    rgba(14, 165, 233, 0.3),
                    rgba(45, 212, 191, 0.2));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .hero-card:hover::before {
            opacity: 1;
        }

        /* Float Badges */
        .float-badge {
            position: absolute;
            background: var(--card-bg);
            padding: 1rem 1.25rem;
            border-radius: 18px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 30;
            border: 1px solid rgba(14, 165, 233, 0.2);
            backdrop-filter: blur(10px);
            animation: badge-bounce 3s infinite;
        }

        @keyframes badge-bounce {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-10px) scale(1.05);
            }
        }

        .badge-top {
            top: 40px;
            right: 100px;
            animation-delay: 0.5s;
        }

        .badge-bottom {
            bottom: 30px;
            right: 20px;
            animation-delay: 1s;
        }

        /* Buttons */
        .btn-cta {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 700;
            box-shadow: 0 10px 30px rgba(14, 165, 233, 0.4);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .btn-cta::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--accent-to), var(--accent-from));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-cta:hover::before {
            opacity: 1;
        }

        .btn-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(14, 165, 233, 0.6);
        }

        .btn-cta span {
            position: relative;
            z-index: 1;
        }

        /* Stats Card */
        .stats-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(14, 165, 233, 0.1);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stat-item {
            text-align: center;
            padding: 0 1.5rem;
            border-right: 2px solid rgba(14, 165, 233, 0.2);
        }

        .stat-item:last-child {
            border-right: none;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        /* Feature Cards */
        .feature-card {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(14, 165, 233, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-from), var(--accent-to));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 40px 80px rgba(14, 165, 233, 0.25);
            border-color: rgba(14, 165, 233, 0.4);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: white;
            box-shadow: 0 15px 35px rgba(14, 165, 233, 0.3);
            transition: all 0.4s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 20px 45px rgba(14, 165, 233, 0.5);
        }

        /* Theme Toggle */
        .theme-toggle {
            width: 48px;
            height: 48px;
            background: var(--card-bg);
            border-radius: 50%;
            border: 2px solid rgba(14, 165, 233, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
            border-color: rgba(14, 165, 233, 0.6);
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.3);
        }

        .theme-icon {
            font-size: 1.5rem;
            transition: transform 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .theme-toggle:hover .theme-icon {
            transform: rotate(20deg) scale(1.1);
        }

        .theme-toggle::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .theme-toggle:hover::before {
            opacity: 0.1;
        }

        /* Navigation Links */
        .nav-link {
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--accent-from), var(--accent-to));
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-btn:hover::after {
            width: 100%;
        }

        .nav-btn {
            position: relative;
            padding: 0.5rem 0;
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .nav-btn::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--accent-from), var(--accent-to));
            transition: width 0.3s ease;
        }

        .nav-btn svg {
            transition: transform 0.3s ease;
        }

        .nav-btn.active svg {
            transform: rotate(180deg);
        }

        .nav-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            left: 0;
            min-width: 240px;
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            padding: 0.5rem;
            z-index: 50;
            border: 1px solid rgba(14, 165, 233, 0.2);
            opacity: 0;
            transform: translateY(-10px);
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .nav-dropdown.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: all;
        }

        .nav-dropdown a {
            display: block;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            color: var(--text);
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .nav-dropdown a:hover {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: white;
            transform: translateX(8px);
        }

        /* Badge Tag */
        .badge-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.2), rgba(45, 212, 191, 0.2));
            padding: 0.5rem 1rem;
            border-radius: 50px;
            border: 1px solid rgba(14, 165, 233, 0.3);
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 2rem;
            animation: badge-glow 2s infinite;
        }

        @keyframes badge-glow {
            0%,
            100% {
                box-shadow: 0 0 20px rgba(14, 165, 233, 0.2);
            }

            50% {
                box-shadow: 0 0 30px rgba(14, 165, 233, 0.4);
            }
        }

        /* ABOUT DROPDOWN (new) */
        .about-toggle-wrap {
            display: flex;
            justify-content: center;
            margin-top: 2.25rem;
        }

        .about-toggle {
            background: transparent;
            color: var(--text);
            border: 1px solid rgba(14, 165, 233, 0.12);
            padding: 0.75rem 1.25rem;
            border-radius: 999px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            transition: all .25s ease;
        }

        .about-toggle:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(14, 165, 233, 0.08);
        }

        .about-dropdown {
            max-width: 1100px;
            margin: 1.25rem auto 0;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0.01));
            border: 1px solid rgba(14, 165, 233, 0.06);
            border-radius: 16px;
            padding: 1.5rem;
            overflow: hidden;
            opacity: 0;
            transform: translateY(-8px) scale(0.995);
            transition: all .28s cubic-bezier(.2, .9, .2, 1);
            pointer-events: none;
        }

        .about-dropdown.show {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 20px;
            align-items: center;
        }

        .about-left h4 {
            font-size: 1.1rem;
            font-weight: 800;
            margin-bottom: 6px
        }

        .about-left p {
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 12px
        }

        .about-features {
            display: flex;
            flex-direction: column;
            gap: 10px
        }

        .about-feature {
            display: flex;
            gap: 12px;
            align-items: flex-start
        }

        .about-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--accent-to), var(--accent-from));
            color: #012;
            font-weight: 700;
            box-shadow: 0 12px 30px rgba(2, 6, 23, 0.4)
        }

        .about-right {
            display: flex;
            flex-direction: column;
            gap: 12px
        }

        .about-stat {
            padding: 12px;
            border-radius: 10px;
            font-weight: 800;
            color: white;
            box-shadow: 0 10px 30px rgba(2, 6, 23, 0.45)
        }

        .about-stat.one {
            background: linear-gradient(135deg, #0ea5e9, #34d399)
        }

        .about-stat.two {
            background: linear-gradient(135deg, #7c3aed, #ef4444)
        }

        .about-stat.small {
            background: linear-gradient(135deg, #f97316, #f43f5e);
            font-weight: 700
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero-circle {
                width: 400px;
                height: 400px;
            }

            .about-grid {
                grid-template-columns: 1fr 300px;
            }
        }

        @media (max-width: 768px) {
            .hero-circle {
                width: 320px;
                height: 320px;
                margin: 2rem auto;
            }

            .badge-top,
            .badge-bottom {
                right: 20px;
            }

            .stat-item {
                border-right: none;
                border-bottom: 2px solid rgba(99, 102, 241, 0.2);
                padding: 1rem 0;
            }

            .stat-item:last-child {
                border-bottom: none;
            }

            .about-grid {
                grid-template-columns: 1fr;
            }

            .about-right {
                order: 2
            }
        }

        /* NAVBAR-ONLY DARK OVERRIDE */
        .site-nav.dark {
            --nav-bg: rgba(10, 22, 40, 0.95);
            --text: #ffffff;
            --muted: #94a3b8;
            --card-bg: #0f1f35;
            --panel: rgba(45, 212, 191, 0.05);
            --floating-shadow: 0 25px 50px rgba(10, 22, 40, 0.25);
        }
    </style>
</head>

<body>
    <!-- Particles Background -->
    <div class="particles" id="particles"></div>

    <!-- Navigation -->
    <header class="site-nav fixed top-0 left-0 right-0 z-50" id="siteNav" role="navigation" aria-label="Main Navigation">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="#" class="brand">
                    <div class="brand-logo">S</div>
                    <span>SmartClass</span>
                </a>

                <nav class="hidden md:flex items-center gap-6" aria-label="Primary Links">
                    <a href="#" class="text-sm font-semibold transition-colors nav-link"
                        style="color: var(--text);">Home</a>

                        <div class="relative">
                            <button class="nav-btn text-sm font-semibold flex items-center gap-2 transition-colors"
                                style="color: var(--text);" aria-expanded="false">
                                Pilih Jenjang
                                <svg class="w-4 h-4 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5.5 7l4.5 4 4.5-4z" />
                                </svg>
                            </button>

                            <div class="nav-dropdown" role="menu">
                                {{-- Jika $allJenjangs tersedia gunakan itu; jika tidak gunakan daftar fallback --}}
                                @if (isset($allJenjangs) && $allJenjangs->count())
                                    @foreach ($allJenjangs as $j)
                                        <a href="{{ route('jenjang.show', $j->slug) }}" role="menuitem">
                                            {{ $j->title }}
                                        </a>
                                    @endforeach
                                @else
                                    {{-- fallback statis — aman, tidak akan menimbulkan error --}}
                                    <a href="/sd">SD</a>
                                    <a href="/sd">SMP</a>
                                    <a href="/sd">SMA/SMK</a>
                                    <a href="/sd">UMUM</a>
                                    <a href="/sd">UTBK</a>
                                @endif
                            </div>
                        </div>

                        <div class="relative">
                            <button class="nav-btn text-sm font-semibold flex items-center gap-2 transition-colors"
                                style="color: var(--text);" aria-expanded="false">
                                lorem ipsum
                                <svg class="w-4 h-4 transition-transform" fill="currentColor" viewBox="0 0 20 20"
                                    aria-hidden="true">
                                    <path d="M5.5 7l4.5 4 4.5-4z" />
                                </svg>
                            </button>
                            <div class="nav-dropdown" role="menu">
                                <a href="#" role="menuitem">Lorem Ipsum</a>
                                <a href="#" role="menuitem">Lorem Ipsum</a>
                                <a href="#" role="menuitem">lorem Ipsum</a>
                            </div>
                        </div>

                        <a href="#" class="text-sm font-semibold transition-colors nav-link"
                            style="color: var(--text);">Kontak</a>
                </nav>
            </div>

            <div class="flex items-center gap-4">
                <!-- Single unified theme toggle -->
                <button class="theme-toggle" id="themeToggle" title="Toggle Theme" aria-pressed="false">
                    <span class="theme-icon" id="globalThemeIcon">🌙</span>
                </button>

                <button class="btn-cta">
                    <span>Coba Kelas Gratis</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="hero-section">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="hero-text">
                    <div class="badge-tag">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#f59e0b" aria-hidden="true">
                            <path
                                d="M12 .587l3.668 7.431L23.5 9.167l-5.667 5.522L19.334 24 12 19.897 4.666 24l1.5-9.311L.5 9.167l7.832-1.149z" />
                        </svg>
                        <span>Telah dipercaya 200+ siswa</span>
                    </div>

                    <h1>
                        Les Private dan <span class="gradient-text">Bimbel Online</span>
                        <br>Semua Kurikulum
                    </h1>

                    <p class="text-lg" style="color: var(--muted); margin-bottom: 2rem;">
                        SmartClass menyediakan bimbel tatap muka & online dengan fasilitas modern,
                        guru lulusan PTN, dan kelas pengembangan diri.
                    </p>

                    <div class="flex flex-wrap gap-4 mb-12">
                        <button class="btn-cta">
                            <span>Temukan Cabang Terdekat</span>
                        </button>
                        <button
                            style="padding: 1rem 2rem; border-radius: 50px; border: 2px solid var(--accent-from); background: transparent; color: var(--text); font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                            Pelajari Program
                        </button>
                    </div>

                    <!-- Stats -->
                    <div class="stats-card">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="stat-item">
                                <div class="stat-number">4+</div>
                                <div class="text-sm" style="color: var(--muted);">Tahun Pengalaman</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">200+</div>
                                <div class="text-sm" style="color: var(--muted);">Siswa Aktif</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">30+</div>
                                <div class="text-sm" style="color: var(--muted);">Mata Pelajaran</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Circle -->
                <div class="flex justify-center lg:justify-end">
                    <div class="hero-circle">
                        <div class="hero-card">
                            <div
                                style="width: 100%; height: 100%; background: linear-gradient(135deg, #0ea5e9 0%, #2dd4bf 100%); display: flex; align-items: center; justify-content: center; font-size: 6rem;">
                                🦉
                            </div>
                        </div>

                        <div class="float-badge badge-top">
                            <div style="font-size: 2rem;">🎓</div>
                            <div>
                                <div style="font-weight: 700; font-size: 1.25rem;">200+</div>
                                <div style="font-size: 0.75rem; color: var(--muted);">Happy Students</div>
                            </div>
                        </div>

                        <div class="float-badge badge-bottom">
                            <div style="font-size: 2rem;">🏅</div>
                            <div>
                                <div style="font-weight: 700; font-size: 1.25rem;">20+</div>
                                <div style="font-size: 0.75rem; color: var(--muted);">Pro Teachers</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section style="padding: 5rem 0; position: relative; z-index: 2;">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 reveal">
                <h2 style="font-size: 3rem; font-weight: 900; margin-bottom: 1rem;">
                    Keunggulan <span class="gradient-text">SmartClass</span>
                </h2>
                <p style="color: var(--muted); font-size: 1.125rem;">
                    Kami memberikan pengalaman belajar terbaik dengan pendekatan personal & profesional
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="feature-card reveal">
                    <div class="feature-icon">📘</div>
                    <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem;">
                        Kelas Dipersonalisasi
                    </h3>
                    <p style="color: var(--muted); line-height: 1.6;">
                        Setiap sesi disusun sesuai gaya belajar siswa untuk hasil maksimal
                    </p>
                </div>

                <div class="feature-card reveal">
                    <div class="feature-icon">👩‍🏫</div>
                    <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem;">
                        Guru Profesional
                    </h3>
                    <p style="color: var(--muted); line-height: 1.6;">
                        Tim pengajar berpengalaman & terlatih dari universitas terkemuka
                    </p>
                </div>

                <div class="feature-card reveal">
                    <div class="feature-icon">⭐</div>
                    <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem;">
                        Harga Terjangkau
                    </h3>
                    <p style="color: var(--muted); line-height: 1.6;">
                        Paket fleksibel sesuai kebutuhan dan budget keluarga Anda
                    </p>
                </div>
            </div>

            <!-- ABOUT DROPDOWN: inserted here (below Keunggulan) -->
            <div class="about-toggle-wrap">
                <button id="aboutToggle" class="about-toggle" aria-expanded="false" aria-controls="aboutDropdown">
                    <span>Tentang Kami</span>
                    <svg id="aboutCaret" width="16" height="16" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 7L10 12L15 7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <div id="aboutDropdown" class="about-dropdown" role="region" aria-hidden="true">
                <div class="about-grid">
                    <div class="about-left">
                        <h4>Mengapa SmartClass berbeda?</h4>
                        <p>Kami memadukan metode pengajaran yang terukur, dukungan tutor yang hangat, dan laporan
                            kemajuan konkret — sehingga proses belajar jadi efisien dan menyenangkan.</p>

                        <div class="about-features">
                            <div class="about-feature">
                                <div class="about-icon">A</div>
                                <div>
                                    <strong>Akademis & Karakter</strong>
                                    <p style="color:var(--muted); margin:6px 0 0;">Latihan intensif + pengembangan
                                        soft-skill untuk kesiapan ujian dan kehidupan kampus.</p>
                                </div>
                            </div>

                            <div class="about-feature">
                                <div class="about-icon">D</div>
                                <div>
                                    <strong>Data-Driven</strong>
                                    <p style="color:var(--muted); margin:6px 0 0;">Laporan rutin membantu tutor
                                        menyesuaikan rencana belajar yang tepat untuk tiap siswa.</p>
                                </div>
                            </div>

                            <div class="about-feature">
                                <div class="about-icon">S</div>
                                <div>
                                    <strong>Support & Komunitas</strong>
                                    <p style="color:var(--muted); margin:6px 0 0;">Mentoring di luar jam belajar dan
                                        grup diskusi agar siswa terus termotivasi.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="about-right">
                        <div class="about-stat one">4+<div style="font-size:.85rem; font-weight:400; margin-top:6px;">
                                Tahun Pengalaman</div>
                        </div>
                        <div class="about-stat two">200+<div
                                style="font-size:.85rem; font-weight:400; margin-top:6px;">Ulasan Positif</div>
                        </div>
                        <div class="about-stat small">30+<div
                                style="font-size:.85rem; font-weight:400; margin-top:6px;">Mata Pelajaran</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end about dropdown -->

        </div>
    </section>

    <script>
        // Create Particles
        const particlesContainer = document.getElementById('particles');
        for (let i = 0; i < 15; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.width = `${Math.random() * 100 + 50}px`;
            particle.style.height = particle.style.width;
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;
            particle.style.animationDelay = `${Math.random() * 5}s`;
            particle.style.animationDuration = `${Math.random() * 10 + 15}s`;
            particlesContainer.appendChild(particle);
        }

        // Single unified Theme Toggle: controls global theme AND navbar appearance
        (function() {
            const html = document.documentElement;
            const nav = document.getElementById('siteNav');
            const toggle = document.getElementById('themeToggle');
            const icon = document.getElementById('globalThemeIcon');
            const storageKey = 'theme'; // 'light' atau 'dark'

            // Load saved theme (default: dark)
            const savedTheme = localStorage.getItem(storageKey) || 'dark';
            if (savedTheme === 'light') {
                html.classList.add('theme-light');
                nav.classList.remove('dark');
                icon.textContent = '☀️';
                toggle.setAttribute('aria-pressed', 'true');
            } else {
                html.classList.remove('theme-light');
                nav.classList.add('dark');
                icon.textContent = '🌙';
                toggle.setAttribute('aria-pressed', 'false');
            }

            toggle.addEventListener('click', () => {
                html.classList.toggle('theme-light');
                const isLight = html.classList.contains('theme-light');

                // keep navbar in sync: dark when page is dark, light when page is light
                if (isLight) nav.classList.remove('dark');
                else nav.classList.add('dark');

                icon.textContent = isLight ? '☀️' : '🌙';
                localStorage.setItem(storageKey, isLight ? 'light' : 'dark');
                toggle.setAttribute('aria-pressed', isLight ? 'true' : 'false');
            });
        })();

        // Dropdown Navigation (accessible)
        (function() {
            const navBtns = document.querySelectorAll('.nav-btn');

            navBtns.forEach(btn => {
                const dropdown = btn.nextElementSibling;

                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const isActive = btn.classList.contains('active');

                    // Close all dropdowns
                    document.querySelectorAll('.nav-dropdown').forEach(dd => dd.classList.remove(
                        'show'));
                    document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));
                    document.querySelectorAll('.nav-btn').forEach(b => b.setAttribute('aria-expanded',
                        'false'));

                    if (!isActive) {
                        dropdown.classList.add('show');
                        btn.classList.add('active');
                        btn.setAttribute('aria-expanded', 'true');
                    }
                });

                // Close dropdown on Esc
                document.addEventListener('keydown', (ev) => {
                    if (ev.key === 'Escape') {
                        dropdown.classList.remove('show');
                        btn.classList.remove('active');
                        btn.setAttribute('aria-expanded', 'false');
                    }
                });

                // Prevent propagation when clicking inside dropdown
                if (dropdown) dropdown.addEventListener('click', (e) => e.stopPropagation());
            });

            document.addEventListener('click', () => {
                document.querySelectorAll('.nav-dropdown').forEach(dd => dd.classList.remove('show'));
                document.querySelectorAll('.nav-btn').forEach(btn => {
                    btn.classList.remove('active');
                    btn.setAttribute('aria-expanded', 'false');
                });
            });
        })();

        // ABOUT dropdown toggle (inserted)
        (function() {
            const aboutToggle = document.getElementById('aboutToggle');
            const aboutDropdown = document.getElementById('aboutDropdown');
            const caret = document.getElementById('aboutCaret');

            if (!aboutToggle || !aboutDropdown) return;

            aboutToggle.addEventListener('click', (e) => {
                const open = aboutDropdown.classList.toggle('show');
                aboutToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
                aboutDropdown.setAttribute('aria-hidden', open ? 'false' : 'true');

                // rotate caret
                if (open) caret.style.transform = 'rotate(180deg)';
                else caret.style.transform = 'rotate(0deg)';

                // scroll into view when opening (nice UX)
                if (open) {
                    setTimeout(() => {
                        aboutDropdown.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }, 120);
                }
            });

            // Close when clicking outside
            document.addEventListener('click', (ev) => {
                if (!aboutDropdown.classList.contains('show')) return;
                const isOutside = !aboutDropdown.contains(ev.target) && !aboutToggle.contains(ev.target);
                if (isOutside) {
                    aboutDropdown.classList.remove('show');
                    aboutToggle.setAttribute('aria-expanded', 'false');
                    aboutDropdown.setAttribute('aria-hidden', 'true');
                    caret.style.transform = 'rotate(0deg)';
                }
            });

            // close on Esc
            document.addEventListener('keydown', (ev) => {
                if (ev.key === 'Escape' && aboutDropdown.classList.contains('show')) {
                    aboutDropdown.classList.remove('show');
                    aboutToggle.setAttribute('aria-expanded', 'false');
                    aboutDropdown.setAttribute('aria-hidden', 'true');
                    caret.style.transform = 'rotate(0deg)';
                }
            });
        })();

        // Scroll Animations
        const reveals = document.querySelectorAll('.reveal');

        const revealOnScroll = () => {
            reveals.forEach(el => {
                const rect = el.getBoundingClientRect();
                const isVisible = rect.top < window.innerHeight * 0.85;

                if (isVisible) {
                    el.classList.add('active');
                }
            });
        };

        window.addEventListener('scroll', revealOnScroll);
        window.addEventListener('load', revealOnScroll);
    </script>

    <!-- =========================
         ADD-ON: PENCAPAIAN + DOKUMENTASI (FINAL)
         Already inserted here — only added, not replacing other code
         ========================= -->
    <style>
        /* scoped styles to avoid conflict */
        .sc-pencapaian {
            max-width: 1200px;
            margin: 36px auto;
            padding: 28px;
            border-radius: 14px;
            background: linear-gradient(90deg, rgba(124, 58, 237, 0.12), rgba(14, 165, 233, 0.06));
            border: 1px solid rgba(255, 255, 255, 0.03);
            box-shadow: 0 12px 40px rgba(2, 6, 23, 0.6);
        }

        .sc-pencapaian .head {
            text-align: center;
            margin-bottom: 18px;
        }

        .sc-pencapaian h3 {
            margin: 0;
            font-size: 26px;
            font-weight: 800;
            color: var(--text);
        }

        .sc-pencapaian p.sub {
            margin: 6px 0 0;
            color: var(--muted);
        }

        .sc-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 18px;
        }

        .sc-stat {
            padding: 18px;
            border-radius: 12px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0.01));
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.02);
        }

        .sc-stat .num {
            font-size: 22px;
            font-weight: 900;
            color: #fff;
        }

        .sc-stat .lbl {
            color: var(--muted);
            margin-top: 6px;
            font-weight: 600;
        }

        /* Dokumentasi / slideshow */
        .sc-doc {
            margin-top: 20px;
            display: block;
        }

        .sc-doc-wrap {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.03);
            background: rgba(0, 0, 0, 0.5);
        }

        .sc-slides {
            position: relative;
            width: 100%;
            height: 380px;
            min-height: 220px;
        }

        .sc-slide {
            position: absolute;
            inset: 0;
            background-position: center;
            background-size: cover;
            opacity: 0;
            transition: opacity .6s ease, transform .6s ease;
            transform: scale(.995);
        }

        .sc-slide.active {
            opacity: 1;
            transform: scale(1);
            position: relative;
        }

        .sc-caption {
            position: absolute;
            left: 20px;
            bottom: 18px;
            z-index: 5;
            color: var(--text);
            background: linear-gradient(90deg, rgba(2, 6, 23, 0.5), rgba(2, 6, 23, 0.3));
            padding: 12px 16px;
            border-radius: 10px;
            max-width: 70%;
        }

        .sc-caption h4 {
            margin: 0;
            font-size: 18px;
            font-weight: 800;
        }

        .sc-caption p {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 13px;
        }

        .sc-controls {
            position: absolute;
            right: 18px;
            top: 12px;
            z-index: 6;
            display: flex;
            gap: 8px;
        }

        .sc-btn {
            display: inline-grid;
            place-items: center;
            width: 40px;
            height: 40px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.04);
            cursor: pointer;
            color: var(--text);
            font-weight: 700;
        }

        .sc-nav {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 12px;
            display: flex;
            gap: 8px;
            z-index: 6;
        }

        .sc-dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.18);
            cursor: pointer;
        }

        .sc-dot.active {
            background: linear-gradient(90deg, var(--accent-from), var(--accent-to));
            box-shadow: 0 8px 20px rgba(6, 21, 34, 0.6);
        }

        /* small */
        @media (max-width:900px) {
            .sc-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .sc-caption {
                max-width: 85%;
                left: 12px;
                right: 12px;
            }
        }

        @media (max-width:520px) {
            .sc-stats {
                grid-template-columns: 1fr;
            }

            .sc-slide {
                background-position: center top;
            }

            .sc-slides {
                height: 220px;
            }
        }
    </style>

    <section class="sc-pencapaian" aria-labelledby="sc-pencapaian-title">
        <div class="head">
            <h3 id="sc-pencapaian-title">Pencapaian SmartClass</h3>
            <p class="sub">Angka-angka yang menunjukkan komitmen kami terhadap pendidikan berkualitas</p>
        </div>

        <div class="sc-stats" role="list">
            <div class="sc-stat" role="listitem">
                <div class="num">4+</div>
                <div class="lbl">Tahun Pengalaman</div>
            </div>
            <div class="sc-stat" role="listitem">
                <div class="num">200+</div>
                <div class="lbl">Ulasan Positif</div>
            </div>
            <div class="sc-stat" role="listitem">
                <div class="num">30+</div>
                <div class="lbl">Mata Pelajaran</div>
            </div>
            <div class="sc-stat" role="listitem">
                <div class="num">200+</div>
                <div class="lbl">Siswa Terdaftar</div>
            </div>
        </div>

        <!-- DOKUMENTASI (slideshow) -->
        <div class="sc-doc" aria-label="Dokumentasi SmartClass">
            <div class="sc-doc-wrap" id="scDocWrap" data-interval="5000"><!-- data-interval in ms (default 5000) -->
                <div class="sc-slides" id="scSlides">
                    <!-- GANTI URL GAMBAR DI SINI jika perlu -->
                    <div class="sc-slide active" data-title="Tutor Profesional Siap Bimbing"
                        data-desc="Tutor berpengalaman fokus pada perkembangan siswa."
                        style="background-image:url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1400&auto=format&fit=crop');">
                    </div>

                    <div class="sc-slide" data-title="Latihan & Evaluasi Rutin"
                        data-desc="Latihan adaptif + laporan kemajuan."
                        style="background-image:url('https://images.unsplash.com/photo-1557800636-894a64c1696f?q=80&w=1400&auto=format&fit=crop');">
                    </div>

                    <div class="sc-slide" data-title="Kelas Online & Tatap Muka"
                        data-desc="Fleksibel: online atau tatap muka sesuai kebutuhan."
                        style="background-image:url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1400&auto=format&fit=crop');">
                    </div>
                </div>

                <div class="sc-controls" aria-hidden="true">
                    <div class="sc-btn" id="scPrev" title="Previous" aria-label="Previous">&#10094;</div>
                    <div class="sc-btn" id="scNext" title="Next" aria-label="Next">&#10095;</div>
                </div>

                <div class="sc-caption" id="scCaption" aria-live="polite">
                    <h4 id="scTitle">Tutor Profesional Siap Bimbing</h4>
                    <p id="scDesc">Tutor berpengalaman yang fokus pada perkembangan siswa.</p>
                </div>

                <div class="sc-nav" id="scDots" aria-hidden="true"></div>
            </div>
        </div>
    </section>

    <script>
        (function() {
            const wrap = document.getElementById('scDocWrap');
            if (!wrap) return;
            const slidesContainer = document.getElementById('scSlides');
            const slides = Array.from(slidesContainer.querySelectorAll('.sc-slide'));
            const titleEl = document.getElementById('scTitle');
            const descEl = document.getElementById('scDesc');
            const prev = document.getElementById('scPrev');
            const next = document.getElementById('scNext');
            const dotsWrap = document.getElementById('scDots');

            if (slides.length === 0) return;

            // create dots
            slides.forEach((s, i) => {
                const d = document.createElement('div');
                d.className = 'sc-dot' + (i === 0 ? ' active' : '');
                d.dataset.index = i;
                d.addEventListener('click', () => goTo(i));
                dotsWrap.appendChild(d);
            });

            let current = 0;

            function show(i) {
                slides.forEach((s, idx) => {
                    s.classList.toggle('active', idx === i);
                });
                const activeSlide = slides[i];
                titleEl.textContent = activeSlide.dataset.title || '';
                descEl.textContent = activeSlide.dataset.desc || '';
                Array.from(dotsWrap.children).forEach((d, idx) => d.classList.toggle('active', idx === i));
                current = i;
            }

            function nextSlide() {
                show((current + 1) % slides.length);
            }

            function prevSlide() {
                show((current - 1 + slides.length) % slides.length);
            }
            next.addEventListener('click', () => {
                nextSlide();
                resetTimer();
            });
            prev.addEventListener('click', () => {
                prevSlide();
                resetTimer();
            });

            // keyboard
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') {
                    prevSlide();
                    resetTimer();
                }
                if (e.key === 'ArrowRight') {
                    nextSlide();
                    resetTimer();
                }
            });

            // autoplay interval (data-attribute), default 5000ms
            let interval = parseInt(wrap.dataset.interval, 10);
            if (isNaN(interval) || interval < 1000) interval = 5000;
            let timer = setInterval(nextSlide, interval);

            function resetTimer() {
                clearInterval(timer);
                timer = setInterval(nextSlide, interval);
            }

            // pause on hover
            wrap.addEventListener('mouseenter', () => clearInterval(timer));
            wrap.addEventListener('mouseleave', () => resetTimer());

            // init
            show(0);

            // Expose simple API (optional)
            window.SC_DOKUMENTASI = {
                goTo: (i) => {
                    if (typeof i === 'number' && i >= 0 && i < slides.length) {
                        show(i);
                        resetTimer();
                    }
                },
                next: () => {
                    nextSlide();
                    resetTimer();
                },
                prev: () => {
                    prevSlide();
                    resetTimer();
                },
                setIntervalMs: (ms) => {
                    if (!isNaN(ms) && ms >= 1000) {
                        interval = ms;
                        resetTimer();
                        wrap.dataset.interval = ms;
                    }
                }
            };

            function goTo(i) {
                show(i);
                resetTimer();
            }
        })();
    </script>
    <!-- =========================
     FOOTER — Tambahkan sebelum </body>
     ========================= -->
    <footer class="sc-footer" role="contentinfo" aria-label="Footer SmartClass" style="margin-top:48px;">
        <style>
            .sc-footer {
                --bgf: linear-gradient(180deg, rgba(2, 6, 23, 0.7), rgba(2, 6, 23, 0.5));
                padding: 40px 20px;
                color: var(--text);
            }

            .sc-footer .inner {
                max-width: 1200px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 20px;
                align-items: start;
            }

            .sc-footer .brand {
                display: flex;
                gap: 12px;
                align-items: center;
                font-weight: 800;
                font-size: 1.125rem;
            }

            .sc-footer .brand-logo {
                width: 44px;
                height: 44px;
                border-radius: 10px;
                display: grid;
                place-items: center;
                color: white;
                font-weight: 900;
                background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            }

            .sc-footer p {
                color: var(--muted);
                margin-top: 8px;
                line-height: 1.6;
                font-size: 0.95rem;
            }

            .sc-links {
                display: flex;
                gap: 24px;
            }

            .sc-links ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .sc-links li {
                margin: 8px 0;
            }

            .sc-links a {
                color: var(--muted);
                text-decoration: none;
                font-weight: 600;
                font-size: 0.95rem;
            }

            .sc-links a:hover {
                color: var(--text);
                text-underline-offset: 4px;
            }

            .sc-contact {
                font-size: 0.95rem;
                color: var(--muted);
            }

            .sc-contact a {
                color: var(--muted);
                text-decoration: none;
                display: block;
                margin-top: 6px;
            }

            .sc-contact a:hover {
                color: var(--text);
            }

            .sc-news {
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .sc-news input[type="email"] {
                padding: 10px 12px;
                border-radius: 10px;
                border: 1px solid rgba(255, 255, 255, 0.06);
                background: transparent;
                color: var(--text);
                outline: none;
            }

            .sc-news button {
                padding: 10px 14px;
                border-radius: 999px;
                border: none;
                cursor: pointer;
                font-weight: 700;
                background: linear-gradient(90deg, var(--accent-from), var(--accent-to));
                color: white;
            }

            .sc-bottom {
                margin-top: 24px;
                border-top: 1px solid rgba(255, 255, 255, 0.03);
                padding-top: 18px;
                display: flex;
                justify-content: space-between;
                gap: 12px;
                align-items: center;
                flex-wrap: wrap;
            }

            .sc-social {
                display: flex;
                gap: 10px;
            }

            .sc-social a {
                width: 36px;
                height: 36px;
                display: grid;
                place-items: center;
                border-radius: 8px;
                background: rgba(255, 255, 255, 0.03);
                color: var(--text);
                text-decoration: none;
                font-weight: 700;
            }

            .sc-top {
                position: fixed;
                right: 18px;
                bottom: 18px;
                width: 44px;
                height: 44px;
                border-radius: 999px;
                display: grid;
                place-items: center;
                cursor: pointer;
                background: linear-gradient(90deg, var(--accent-from), var(--accent-to));
                color: white;
                box-shadow: 0 8px 30px rgba(2, 6, 23, 0.5);
                z-index: 100;
            }

            @media (max-width:900px) {
                .sc-footer .inner {
                    grid-template-columns: 1fr;
                }

                .sc-links {
                    gap: 12px;
                    flex-wrap: wrap;
                }

                .sc-news {
                    order: 3;
                }
            }
        </style>

        <div class="inner"
            style="background:var(--card-bg); border-radius:12px; padding:24px; box-shadow:0 20px 50px rgba(0,0,0,0.12); border:1px solid rgba(255,255,255,0.03);">
            <div>
                <div class="brand" aria-hidden="true">
                    <div class="brand-logo">S</div>
                    <div>
                        <div>SmartClass</div>
                        <div style="font-size:0.9rem; color:var(--muted); font-weight:600;">Bimbel & Les Private</div>
                    </div>
                </div>
                <p>SmartClass — membantu siswa mencapai potensi terbaik lewat pengajar profesional, program terstruktur,
                    dan dukungan pengembangan karakter.</p>
            </div>

            <div class="sc-links" aria-label="Quick links">
                <ul>
                    <li><a href="#" rel="noopener">Beranda</a></li>
                    <li><a href="#" rel="noopener">Program</a></li>
                    <li><a href="#" rel="noopener">Pilih Jenjang</a></li>
                    <li><a href="#" rel="noopener">Kontak</a></li>
                </ul>

                <ul>
                    <li><a href="#" rel="noopener">FAQ</a></li>
                    <li><a href="#" rel="noopener">Syarat & Ketentuan</a></li>
                    <li><a href="#" rel="noopener">Kebijakan Privasi</a></li>
                    <li><a href="#" rel="noopener">Karir</a></li>
                </ul>
            </div>

            <div>
                <div class="sc-contact" aria-label="Contact info">
                    <strong style="color:var(--text); display:block; font-size:1rem;">Hubungi Kami</strong>
                    <a href="tel:+6281234567890">+62 812-3456-7890</a>
                    <a href="mailto:info@smartclass.id">info@smartclass.id</a>
                    <div style="margin-top:8px;">Jl. Pendidikan No.1, Kota</div>
                </div>

                <div class="sc-news" style="margin-top:12px;">
                    <label for="scEmail"
                        style="font-weight:700; color:var(--text); font-size:0.95rem;">Newsletter</label>
                    <div style="display:flex; gap:8px; margin-top:8px;">
                        <input id="scEmail" type="email" placeholder="Masukkan email..."
                            aria-label="Email newsletter">
                        <button id="scSubscribe">Langganan</button>
                    </div>
                    <small style="color:var(--muted); margin-top:6px; display:block;">Kami kirimkan info & promo
                        langganan berkala (bisa berhenti kapan saja).</small>
                </div>
            </div>
        </div>

        <div class="sc-bottom" style="max-width:1200px;margin:12px auto 0;">
            <div style="color:var(--muted); font-weight:600;">© <span id="scYear"></span> SmartClass. All rights
                reserved.</div>
            <div style="display:flex; gap:12px; align-items:center;">
                <nav class="sc-social" aria-label="Sosial media">
                    <a href="#" aria-label="Instagram">IG</a>
                    <a href="#" aria-label="YouTube">YT</a>
                    <a href="#" aria-label="Facebook">FB</a>
                </nav>
                <div style="color:var(--muted); font-size:0.9rem;">Made with ye shungguang</div>
            </div>
        </div>

        <button class="sc-top" id="scTop" aria-label="Back to top" title="Kembali ke atas">↑</button>

        <script>
            // dynamic year
            document.getElementById('scYear').textContent = new Date().getFullYear();

            // subscribe (simple UI only)
            document.getElementById('scSubscribe').addEventListener('click', function() {
                const email = document.getElementById('scEmail').value.trim();
                if (!email || !/.+@.+\..+/.test(email)) {
                    alert('Masukkan email yang valid ya.');
                    return;
                }
                // NOTE: integrasi backend tidak dilakukan di sini — ini hanya UI
                this.textContent = 'Terdaftar ✓';
                this.disabled = true;
                setTimeout(() => {
                    this.textContent = 'Langganan';
                    this.disabled = false;
                    document.getElementById('scEmail').value = '';
                }, 2500);
            });

            // back to top
            const topBtn = document.getElementById('scTop');
            topBtn.addEventListener('click', () => window.scrollTo({
                top: 0,
                behavior: 'smooth'
            }));

            // show/hide topBtn on scroll
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) topBtn.style.display = 'grid';
                else topBtn.style.display = 'none';
            });
            // initial hidden
            topBtn.style.display = 'none';
        </script>
    </footer>
    <!-- ========================= END FOOTER ========================= -->
</body>

</html>