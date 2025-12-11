<!DOCTYPE html>
<html lang="id" class="theme-light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,viewport-fit=cover" />
    <title>Kelas SD - SmartClass</title>

    <meta name="description" content="Les private & bimbel SD dengan guru berpengalaman. Program khusus kelas 1-6 SD." />
    <meta property="og:title" content="Kelas SD - SmartClass" />
    <meta property="og:description" content="Les private & bimbel SD dengan guru berpengalaman." />
    <meta property="og:type" content="website" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap');

        :root {
            --bg: #f0f9ff;
            --nav-bg: rgba(255, 255, 255, 0.95);
            --text: #0f172a;
            --muted: #475569;
            --accent-from: #0ea5e9;
            --accent-to: #2dd4bf;
            --primary: #0ea5e9;
            --secondary: #2dd4bf;
            --card-bg: #ffffff;
            --panel: rgba(14, 165, 233, 0.05);
            --floating-shadow: 0 25px 50px rgba(14, 165, 233, 0.15);
            --glass-border: rgba(2, 6, 23, 0.04);
            --transition-fast: 180ms;
        }

        .theme-dark {
            --bg: #071426;
            --nav-bg: rgba(6, 12, 20, 0.85);
            --text: #e6eef7;
            --muted: #96a6b8;
            --accent-from: #2dd4bf;
            --accent-to: #1e3a5f;
            --primary: #2dd4bf;
            --secondary: #1e3a5f;
            --card-bg: #071224;
            --panel: rgba(45, 212, 191, 0.06);
            --floating-shadow: 0 30px 60px rgba(45, 212, 191, 0.12);
            --glass-border: rgba(255, 255, 255, 0.04);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Poppins', sans-serif;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            transition: background var(--transition-fast) ease, color var(--transition-fast) ease;
        }

        /* Particles */
        .particles {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, var(--accent-from), transparent);
            opacity: 0.10;
            animation: float-particle 20s infinite ease-in-out;
            will-change: transform, opacity;
        }

        @keyframes float-particle {
            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            25% {
                transform: translate(80px, -80px) scale(1.05);
            }

            50% {
                transform: translate(-50px, -160px) scale(.9);
            }

            75% {
                transform: translate(-120px, -90px) scale(1.03);
            }
        }

        /* Nav */
        .site-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 60;
            background: var(--nav-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
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
            box-shadow: var(--floating-shadow);
        }

        .nav-links {
            display: flex;
            gap: 14px;
            align-items: center;
        }

        .nav-link {
            color: var(--text);
            font-weight: 600;
            font-size: .95rem;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 8px;
            transition: background var(--transition-fast);
        }

        .nav-link:hover,
        .nav-link:focus {
            background: var(--panel);
            outline: none;
        }

        .nav-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-cta {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: white;
            padding: .7rem 1.2rem;
            border-radius: 999px;
            font-weight: 800;
            border: none;
            cursor: pointer;
            transition: transform .2s;
            box-shadow: 0 10px 30px rgba(14, 165, 233, .12);
        }

        .btn-cta:hover {
            transform: translateY(-2px);
        }

        .theme-toggle {
            width: 44px;
            height: 44px;
            border-radius: 999px;
            border: 1px solid rgba(14, 165, 233, .10);
            background: var(--card-bg);
            display: grid;
            place-items: center;
            cursor: pointer;
            font-size: 1.2rem;
            transition: transform 120ms ease;
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
        }

        .hamburger span {
            width: 20px;
            height: 2px;
            background: var(--text);
            border-radius: 2px;
            transition: transform .18s ease, opacity .18s ease;
        }

        /* mobile nav overlay (renamed to avoid conflict with inner list) */
        .mobile-drawer {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 200;
            background: rgba(0, 0, 0, 0.35);
            align-items: center;
            justify-content: center;
        }

        .mobile-drawer .panel {
            width: 100%;
            max-width: 420px;
            margin: 0 20px;
            border-radius: 14px;
            background: var(--card-bg);
            padding: 28px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.18);
            border: 1px solid var(--glass-border);
        }

        .drawer-nav {
            list-style: none;
            padding-left: 0;
        }

        .drawer-nav li + li {
            margin-top: 8px;
        }

        .drawer-nav a,
        .drawer-nav button {
            display: block;
            padding: 12px 8px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--text);
            font-weight: 700;
            font-size: 1.05rem;
            background: transparent;
            border: none;
            text-align: left;
            width: 100%;
            cursor: pointer;
        }

        /* rest (hero, grid, cards, footer) - kept concise and similar to original */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .hero-section {
            position: relative;
            z-index: 2;
            padding-top: 120px;
            padding-bottom: 60px;
            text-align: center;
        }

        .hero-section h1 {
            font-size: clamp(2rem, 6vw, 3.5rem);
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 16px;
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-section p {
            color: var(--muted);
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto 32px;
            line-height: 1.7;
        }

        .section {
            padding: 60px 0;
            position: relative;
            z-index: 2;
        }

        .section-title {
            margin-bottom: 40px;
        }

        .section-title h2 {
            font-size: 2rem;
            font-weight: 900;
            margin-bottom: 12px;
        }

        .section-title p {
            color: var(--muted);
            font-size: 1.05rem;
        }

        .grid {
            display: grid;
            gap: 24px;
        }

        .grid-3 {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }

        .grid-4 {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }

        .grid-2 {
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        }

        .content-card {
            padding: 28px;
            border-radius: 16px;
            background: var(--card-bg);
            border: 1px solid rgba(14, 165, 233, .06);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .06);
            transition: transform .3s, box-shadow .3s;
        }

        .content-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, .12);
        }

        .content-card .icon {
            font-size: 2.8rem;
            margin-bottom: 16px;
            display: block;
        }

        .content-card h3 {
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .content-card p {
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .testimonial-card {
            padding: 24px;
        }

        .rating {
            display: flex;
            gap: 4px;
            margin-bottom: 12px;
        }

        .rating span {
            color: #f59e0b;
            font-size: 1.1rem;
        }

        .testimonial-text {
            color: var(--muted);
            font-style: italic;
            margin-bottom: 16px;
            line-height: 1.6;
        }

        .testimonial-author {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .author-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            display: grid;
            place-items: center;
            color: white;
            font-weight: 800;
            font-size: 1.2rem;
        }

        .footer {
            background: var(--card-bg);
            padding: 60px 20px 20px;
            margin-top: 60px;
            border-top: 2px solid rgba(14, 165, 233, 0.08);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto 30px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            font-size: 1.1rem;
            margin-bottom: 12px;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-links a {
            color: var(--muted);
            text-decoration: none;
            font-weight: 600;
            transition: color .2s;
        }

        .footer-links a:hover {
            color: var(--primary);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(14, 165, 233, .06);
            color: var(--muted);
            font-size: .9rem;
        }

        .social-row {
            display: flex;
            gap: 12px;
            margin-top: 12px;
        }

        .social-link {
            display: inline-grid;
            place-items: center;
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: linear-gradient(180deg, rgba(0, 0, 0, .02), transparent);
            text-decoration: none;
            color: var(--text);
            border: 1px solid var(--glass-border);
            transition: transform 140ms ease;
        }

        .social-link:hover {
            transform: translateY(-4px);
        }

        .contact-form input[type="email"] {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid var(--glass-border);
            background: transparent;
            color: var(--text);
            margin-bottom: 8px;
        }

        .contact-form button {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: none;
            font-weight: 700;
            cursor: pointer;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: white;
        }

        /* Responsive adjustments */
        @media (max-width: 880px) {
            .nav-links {
                display: none !important;
            }

            .hamburger {
                display: flex !important;
                z-index: 120;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 640px) {
            .particle {
                display: none;
            }

            .hero-section {
                padding-top: 90px;
            }

            .grid-3,
            .grid-4,
            .grid-2 {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }
        }

        /* hamburger open animation */
        .hamburger.open span:nth-child(1) {
            transform: translateY(6px) rotate(45deg);
        }

        .hamburger.open span:nth-child(2) {
            opacity: 0;
            transform: scaleX(0);
        }

        .hamburger.open span:nth-child(3) {
            transform: translateY(-6px) rotate(-45deg);
        }
    </style>
</head>

<body>
    <!-- Particles -->
    <div class="particles" id="particles" aria-hidden="true"></div>

    <!-- Navigation -->
    <header class="site-nav" role="navigation" aria-label="Main Navigation">
        <div class="nav-inner">
            <a href="#" class="brand" aria-label="Bimbel Cerdas">
                <div class="brand-logo">📚</div>
                <span class="brand-text">SmartClass</span>
            </a>

            <nav class="nav-links" aria-label="Primary Links">
                <a href="#" class="nav-link">Beranda</a>
                <div style="position:relative;">
                    <button class="nav-btn nav-link" id="jenjangBtn" aria-expanded="false" aria-haspopup="true">Pilih Jenjang ▾</button>
                    <div class="nav-dropdown" id="jenjangDropdown" role="menu" aria-hidden="true" style="position:absolute; top:40px; left:0; background:var(--card-bg); border-radius:10px; padding:8px; box-shadow:0 10px 30px rgba(0,0,0,.08); display:none; border:1px solid var(--glass-border);">
                        <a href="/jenjang/sd" style="display:block;padding:8px 12px;text-decoration:none;color:var(--text);">SD</a>
                        <a href="/jenjang/smp" style="display:block;padding:8px 12px;text-decoration:none;color:var(--text);">SMP</a>
                        <a href="/jenjang/sma" style="display:block;padding:8px 12px;text-decoration:none;color:var(--text);">SMK/SMA</a>
                        <a href="/jenjang/utbk" style="display:block;padding:8px 12px;text-decoration:none;color:var(--text);">Utbk</a>
                        <a href="/jenjang/umum" style="display:block;padding:8px 12px;text-decoration:none;color:var(--text);">Umum</a>
                    </div>
                </div>
                <a href="#guru" class="nav-link">Guru</a>
                <a href="#kontak" class="nav-link">Tentang Kami</a>
            </nav>

            <div class="nav-actions" role="group" aria-label="Actions">
                <button class="theme-toggle" id="themeToggle" aria-pressed="false" title="Toggle gelap/terang" aria-label="Toggle tema gelap-terang">🌙</button>
                <a href="{{ route('siswa.login') }}" class="btn-cta">Login / Sign Up</a>
                <button class="hamburger" id="hamburger" aria-controls="mobileDrawer" aria-expanded="false" aria-label="Buka menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Drawer (overlay) -->
    <div class="mobile-drawer" id="mobileDrawer" aria-hidden="true" role="dialog" aria-modal="true">
        <div class="panel" role="document">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                <div class="brand">
                    <div class="brand-logo">📚</div>
                    <strong>SmartClass</strong>
                </div>
                <button id="closeDrawer" style="font-size:1.5rem;background:none;border:none;cursor:pointer;color:var(--text);" aria-label="Tutup menu">✕</button>
            </div>

            <ul class="drawer-nav">
                <li><a href="#">Beranda</a></li>
                <li>
                    <button id="mobileJenjangBtn" aria-expanded="false">Pilih Jenjang ▾</button>
                    <div id="mobileJenjang" style="display:none;padding-left:12px;margin-top:6px;">
                        <a href="/jenjang/sd">SD</a>
                        <a href="/jenjang/smp">SMP</a>
                        <a href="/jenjang/smk">SMK/SMA</a>
                        <a href="/jenjang/umum">UMUM</a>
                    </div>
                </li>
                <li><a href="#guru">Guru</a></li>
                <li><a href="#kontak">Tentang Kami</a></li>
            </ul>

            <button class="btn-cta" style="width:100%;margin-top:20px;">Login</button>
        </div>
    </div>

    <!-- Hero -->
    <main role="main">
        <section class="hero-section">
            <div class="container">
                <h1>Les Private <span class="gradient-text">Kelas SD</span></h1>
                <p>SmartClass menyediakan bimbel tatap muka & online untuk siswa SD dengan materi terstruktur dan pengajar berpengalaman.</p>
                <button class="btn-cta">Coba Kelas Gratis</button>
            </div>
        </section>

        <!-- Kelas Tersedia -->
        <section class="section">
            <div class="container">
                <div class="section-title">
                    <h2>📚 Kelas yang Tersedia</h2>
                    <p>Pilih kelas sesuai kebutuhan anak</p>
                </div>

                <div class="grid grid-3">
                    <div class="content-card">
                        <span class="icon">📖</span>
                        <h3>Kelas 1-2 SD</h3>
                        <p>Pengenalan dasar membaca, menulis, dan berhitung dengan metode fun learning.</p>
                        <button class="btn-cta">Daftar Sekarang</button>
                    </div>

                    <div class="content-card">
                        <span class="icon">✏️</span>
                        <h3>Kelas 3-4 SD</h3>
                        <p>Penguatan konsep matematika, IPA, dan bahasa Indonesia dengan latihan soal.</p>
                        <button class="btn-cta">Daftar Sekarang</button>
                    </div>

                    <div class="content-card">
                        <span class="icon">🎓</span>
                        <h3>Kelas 5-6 SD</h3>
                        <p>Persiapan ujian sekolah dan pendalaman materi untuk masuk SMP favorit.</p>
                        <button class="btn-cta">Daftar Sekarang</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mata Pelajaran -->
        <section class="section" style="background: var(--panel);">
            <div class="container">
                <div class="section-title" style="text-align:center;">
                    <h2>📖 Mata Pelajaran</h2>
                    <p>Bimbingan belajar untuk mapel SD</p>
                </div>

                <div class="grid grid-4">
                    <div class="content-card" style="text-align:center;"><span class="icon">🔢</span>
                        <h3>Matematika</h3>
                    </div>
                    <div class="content-card" style="text-align:center;"><span class="icon">🇮🇩</span>
                        <h3>Bahasa Indonesia</h3>
                    </div>
                    <div class="content-card" style="text-align:center;"><span class="icon">🔬</span>
                        <h3>IPA</h3>
                    </div>
                    <div class="content-card" style="text-align:center;"><span class="icon">🌍</span>
                        <h3>IPS</h3>
                    </div>
                    <div class="content-card" style="text-align:center;"><span class="icon">🇬🇧</span>
                        <h3>Bahasa Inggris</h3>
                    </div>
                    <div class="content-card" style="text-align:center;"><span class="icon">🎨</span>
                        <h3>Seni Budaya</h3>
                    </div>
                    <div class="content-card" style="text-align:center;"><span class="icon">⚽</span>
                        <h3>Penjaskes</h3>
                    </div>
                    <div class="content-card" style="text-align:center;"><span class="icon">📚</span>
                        <h3>Tematik</h3>
                    </div>
                </div>
            </div>
        </section>

        <!-- Keunggulan -->
        <section class="section">
            <div class="container">
                <div class="section-title" style="text-align:center;">
                    <h2>⭐ Keunggulan Kami</h2>
                    <p>Mengapa memilih SmartClass untuk anak Anda?</p>
                </div>

                <div class="grid grid-3">
                    <div class="content-card" style="text-align:center;">
                        <span class="icon">👨‍🏫</span>
                        <h3>Guru Berpengalaman</h3>
                        <p>Pengajar lulusan pendidikan terbaik dengan pengalaman mengajar SD lebih dari 5 tahun.</p>
                    </div>
                    <div class="content-card" style="text-align:center;">
                        <span class="icon">📱</span>
                        <h3>Metode Interaktif</h3>
                        <p>Pembelajaran dengan media digital, games edukatif, dan praktik langsung yang menyenangkan.
                        </p>
                    </div>
                    <div class="content-card" style="text-align:center;">
                        <span class="icon">📊</span>
                        <h3>Laporan Berkala</h3>
                        <p>Orang tua mendapat laporan perkembangan belajar anak setiap minggu secara detail.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimoni -->
        <section class="section" style="background: var(--panel);">
            <div class="container">
                <div class="section-title" style="text-align:center;">
                    <h2>💬 Testimoni Orang Tua</h2>
                    <p>Pendapat orang tua siswa SmartClass</p>
                </div>

                <div class="grid grid-2" style="max-width:1000px; margin:0 auto;">
                    <div class="content-card testimonial-card">
                        <div class="rating"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="testimonial-text">Anak saya yang tadinya kesulitan matematika, sekarang jadi lebih
                            percaya diri. Gurunya sabar dan metodenya mudah dipahami!</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">B</div>
                            <div class="author-info">
                                <div class="name">Ibu Budi</div>
                                <div class="grade">Orang Tua Siswa Kelas 4 SD</div>
                            </div>
                        </div>
                    </div>

                    <div class="content-card testimonial-card">
                        <div class="rating"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="testimonial-text">Sistem laporannya bagus, saya bisa pantau perkembangan anak tiap
                            minggu. Harga juga terjangkau untuk kualitas sebagus ini.</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">S</div>
                            <div class="author-info">
                                <div class="name">Ibu Siti</div>
                                <div class="grade">Orang Tua Siswa Kelas 5 SD</div>
                            </div>
                        </div>
                    </div>

                    <div class="content-card testimonial-card">
                        <div class="rating"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="testimonial-text">Anaknya senang belajar karena tidak membosankan. Guru-gurunya ramah
                            dan cara mengajarnya kreatif!</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">A</div>
                            <div class="author-info">
                                <div class="name">Bapak Ahmad</div>
                                <div class="grade">Orang Tua Siswa Kelas 3 SD</div>
                            </div>
                        </div>
                    </div>

                    <div class="content-card testimonial-card">
                        <div class="rating"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="testimonial-text">Nilai anak saya meningkat drastis setelah ikut les di sini. Terima
                            kasih SmartClass!</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">R</div>
                            <div class="author-info">
                                <div class="name">Ibu Rina</div>
                                <div class="grade">Orang Tua Siswa Kelas 6 SD</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer" id="kontak" role="contentinfo">
        <div class="footer-grid">
            <div>
                <div class="footer-brand">
                    <div class="brand-logo">📚</div>
                    <div>SmartClass<div style="font-size:.9rem;color:var(--muted);font-weight:600;">Les Private & Bimbel Online</div>
                    </div>
                </div>
                <p style="color:var(--muted);">Misi kami membantu setiap siswa mencapai potensinya lewat metode
                    pengajaran yang terukur dan dukungan tutor profesional.</p>

                <div class="social-row" aria-label="Tautan sosial">
                    <a class="social-link" href="https://www.instagram.com/zzz.official.en?igsh=MW96MHQyb2o0eXh0aQ==" target="_blank" rel="noopener" aria-label="Instagram">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="12" cy="12" r="3.2" stroke="currentColor" stroke-width="1.4" />
                            <path d="M17.5 6.5h.01" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <a class="social-link" href="https://www.facebook.com/share/1FqWhwHNQS/" target="_blank" rel="noopener" aria-label="Facebook">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M18 2h-3a4 4 0 00-4 4v3H8v4h3v8h4v-8h3l1-4h-4V6a1 1 0 011-1h3z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <a class="social-link" href="https://wa.me/6285831250257" target="_blank" rel="noopener" aria-label="WhatsApp">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 11-3.1-11.4 8.38 8.38 0 013.9.9L21 3l-1.3 2.6" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>

            <div>
                <h4 style="margin-bottom:8px;font-weight:800;">Tautan</h4>
                <ul class="footer-links">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="/sd">SD</a></li>
                    <li><a href="/smp">SMP</a></li>
                    <li><a href="/sma">SMA</a></li>
                </ul>
            </div>

            <div>
                <h4 style="margin-bottom:8px;font-weight:800;">Pilih Jenjang</h4>
                <ul class="footer-links">
                    <li><a href="/sd">SD</a></li>
                    <li><a href="/smp">SMP</a></li>
                    <li><a href="/sma">SMK/SMA</a></li>
                    <li><a href="/utbk">UTBK</a></li>
                </ul>
            </div>

            <div>
                <h4 style="margin-bottom:8px;font-weight:800;">Kontak & Daftar</h4>
                <p style="color:var(--muted); margin-bottom:8px;">Hubungi kami untuk paket & jadwal. Atau tinggalkan email, kami akan hubungi Anda.</p>

                <form class="contact-form" onsubmit="event.preventDefault(); alert('Terima kasih — formulir demo!');" aria-label="Form kontak singkat">
                    <label for="emailFooter" style="display:block; font-size:.9rem; margin-bottom:6px; font-weight:700;">Email Anda</label>
                    <input id="emailFooter" type="email" placeholder="nama@contoh.com" aria-label="Email" required />
                    <button type="submit">Kirim & Hubungi</button>
                </form>

                <div style="margin-top:12px; color:var(--muted); font-size:.95rem;">
                    <div><strong>WA:</strong> <a href="https://wa.me/6285831250257" target="_blank" rel="noopener">+62 858-3125-0257</a></div>
                    <div style="margin-top:6px;"><strong>Email:</strong> <a href="mailto:info@smartclass.example">info@smartclass.example</a></div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            © <span id="year"></span> SmartClass — All rights reserved.<br />
            Dikelola oleh windaa dan ye shungguang — Responsive & aksesibel
        </div>
    </footer>

    <script>
        // ====== Theme init + toggle handler ======
        (function() {
            const THEME_KEY = 'smartclass-theme';
            const btn = document.getElementById('themeToggle');

            function readSaved() {
                try { return localStorage.getItem(THEME_KEY); } catch (e) { return null; }
            }

            function saveTheme(t) {
                try { localStorage.setItem(THEME_KEY, t); } catch (e) { /* ignore */ }
            }

            function applyTheme(theme) {
                if (theme === 'dark') {
                    document.documentElement.classList.add('theme-dark');
                    document.documentElement.classList.remove('theme-light');
                } else {
                    document.documentElement.classList.remove('theme-dark');
                    document.documentElement.classList.add('theme-light');
                }
                if (btn) setButtonState(theme === 'dark');
            }

            function setButtonState(isDark) {
                if (!btn) return;
                btn.setAttribute('aria-pressed', isDark ? 'true' : 'false');
                btn.title = isDark ? 'Mode terang' : 'Mode gelap';
                btn.textContent = isDark ? '🌞' : '🌙';
            }

            // determine initial theme: saved -> prefers-color-scheme -> light
            let saved = readSaved();
            if (!saved) {
                try {
                    saved = (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) ? 'dark' : 'light';
                } catch (e) { saved = 'light'; }
            }
            applyTheme(saved);

            // attach click handler
            if (btn) {
                btn.addEventListener('click', () => {
                    const isDark = document.documentElement.classList.contains('theme-dark');
                    const next = isDark ? 'light' : 'dark';
                    applyTheme(next);
                    saveTheme(next);
                });
            }
        })();

        // ====== Mobile hamburger & nav drawer ======
        (function() {
            const btn = document.getElementById('hamburger');
            const drawer = document.getElementById('mobileDrawer');
            const closeBtn = document.getElementById('closeDrawer');

            function openDrawer() {
                btn.classList.add('open');
                btn.setAttribute('aria-expanded', 'true');
                drawer.style.display = 'flex';
                drawer.setAttribute('aria-hidden', 'false');
                document.documentElement.style.overflow = 'hidden';
            }

            function closeDrawer() {
                btn.classList.remove('open');
                btn.setAttribute('aria-expanded', 'false');
                drawer.style.display = 'none';
                drawer.setAttribute('aria-hidden', 'true');
                document.documentElement.style.overflow = '';
            }

            if (btn) {
                btn.addEventListener('click', (e) => {
                    const expanded = btn.getAttribute('aria-expanded') === 'true';
                    if (expanded) closeDrawer();
                    else openDrawer();
                    e.stopPropagation();
                });
            }

            if (closeBtn) closeBtn.addEventListener('click', closeDrawer);

            // close when clicking outside panel
            if (drawer) drawer.addEventListener('click', (e) => {
                if (e.target === drawer) closeDrawer();
            });

            // close on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeDrawer();
            });

            // close on resize to desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth > 880) closeDrawer();
            });

            // init hide
            if (drawer) {
                drawer.style.display = 'none';
                drawer.setAttribute('aria-hidden', 'true');
            }
            if (btn) btn.setAttribute('aria-expanded', 'false');
        })();

        // ====== Mobile "Pilih Jenjang" toggle inside drawer ======
        (function() {
            const btn = document.getElementById('mobileJenjangBtn');
            const panel = document.getElementById('mobileJenjang');
            if (!btn || !panel) return;
            btn.addEventListener('click', () => {
                const open = panel.style.display !== 'none';
                panel.style.display = open ? 'none' : 'block';
                btn.setAttribute('aria-expanded', !open ? 'true' : 'false');
            });
        })();

        // ====== Desktop "Pilih Jenjang" dropdown ======
        (function() {
            const btn = document.getElementById('jenjangBtn');
            const dd = document.getElementById('jenjangDropdown');
            if (!btn || !dd) return;
            btn.addEventListener('click', (e) => {
                const open = dd.style.display !== 'none';
                dd.style.display = open ? 'none' : 'block';
                btn.setAttribute('aria-expanded', !open ? 'true' : 'false');
                e.stopPropagation();
            });
            // close when clicking outside
            document.addEventListener('click', (e) => {
                if (!btn.contains(e.target) && !dd.contains(e.target)) {
                    dd.style.display = 'none';
                    btn.setAttribute('aria-expanded', 'false');
                }
            });
        })();

        // ====== Particles generator ======
        (function() {
            const container = document.getElementById('particles');
            if (!container) return;
            const count = Math.min(18, Math.floor(window.innerWidth / 60));
            for (let i = 0; i < count; i++) {
                const el = document.createElement('div');
                el.className = 'particle';
                const size = 40 + Math.random() * 160;
                el.style.width = size + 'px';
                el.style.height = size + 'px';
                el.style.left = Math.random() * 100 + '%';
                el.style.top = Math.random() * 100 + '%';
                el.style.animationDelay = (Math.random() * 10) + 's';
                el.style.opacity = (0.03 + Math.random() * 0.12).toString();
                container.appendChild(el);
            }
        })();

        // ====== Footer year & smooth anchors ======
        document.getElementById('year').textContent = new Date().getFullYear();
        (function() {
            document.querySelectorAll('a[href^="#"]').forEach(a => {
                a.addEventListener('click', function(e) {
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        })();
    </script>
</body>
</html>