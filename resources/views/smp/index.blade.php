<!doctype html>
<html lang="id" class="theme-light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>{{ $pageTitle }}</title>
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
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(100px, -100px) scale(1.2); }
            50% { transform: translate(-50px, -200px) scale(0.8); }
            75% { transform: translate(-150px, -100px) scale(1.1); }
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

        .brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--text);
            display: flex;
            gap: 0.75rem;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .brand:hover { transform: scale(1.05); }

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
            0%, 100% { box-shadow: 0 8px 25px rgba(14, 165, 233, 0.4); }
            50% { box-shadow: 0 12px 35px rgba(45, 212, 191, 0.6); }
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

        .btn-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(14, 165, 233, 0.6);
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
        }

        .theme-toggle:hover {
            transform: scale(1.1);
            border-color: rgba(14, 165, 233, 0.6);
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.3);
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

        .nav-link:hover::after { width: 100%; }

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

        .nav-btn:hover::after { width: 100%; }

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

        /* Content Cards */
        .content-card {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(14, 165, 233, 0.1);
            transition: all 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(14, 165, 233, 0.2);
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: inline-block;
        }

        /* NAVBAR-ONLY DARK OVERRIDE */
        .site-nav.dark {
            --nav-bg: rgba(10, 22, 40, 0.95);
            --text: #ffffff;
            --muted: #94a3b8;
            --card-bg: #0f1f35;
        }

        /* Footer Styles */
        .sc-footer {
            padding: 40px 20px;
            color: var(--text);
            margin-top: 48px;
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

        .sc-links li { margin: 8px 0; }

        .sc-links a {
            color: var(--muted);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .sc-links a:hover { color: var(--text); }

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

        @media (max-width: 768px) {
            .sc-footer .inner { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>
    <!-- Particles Background -->
    <div class="particles" id="particles"></div>
    
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
                    <button class="nav-btn" id="jenjangBtn" aria-expanded="false" aria-haspopup="true">Pilih Jenjang
                        ▾</button>
                    <div class="nav-dropdown" id="jenjangDropdown" role="menu" aria-hidden="true">
                        <a href="/jenjang/sd">SD</a>
                        <a href="/jenjang/smp">SMP</a>
                        <a href="/jenjang/sma">SMK/SMA</a>
                        <a href="/jenjang/utbk">Utbk</a>
                        <a href="/jenjang/umum">Umum</a>
                    </div>
                </div>
                <a href="#guru" class="nav-link">Guru</a>
                <a href="#kontak" class="nav-link">Tentang Kami</a>
            </nav>

            <div class="nav-actions" role="group" aria-label="Actions">
                <button class="theme-toggle" id="themeToggle" aria-pressed="false" title="Toggle gelap/terang"
                    aria-label="Toggle tema gelap-terang">🌙</button>
                <a href="{{ route('siswa.login') }}" class="btn-cta">Login / Sign Up</a>
                <button class="hamburger" id="hamburger" aria-controls="mobileDrawer" aria-expanded="false"
                    aria-label="Buka menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Drawer -->
    <div class="mobile-drawer" id="mobileDrawer" aria-hidden="true" role="dialog" aria-modal="true">
        <div class="panel" role="document">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                <div class="brand">
                    <div class="brand-logo">📚</div>
                    <strong>SmartClass</strong>
                </div>
                <button id="closeDrawer"
                    style="font-size:1.5rem;background:none;border:none;cursor:pointer;color:var(--text);"
                    aria-label="Tutup menu">✕</button>
            </div>

            <ul class="mobile-nav">
                <li><a href="#">Beranda</a></li>
                <li><button id="mobileJenjangBtn">Pilih Jenjang ▾</button>
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

    <!-- Hero Section -->
    <main class="hero-section" id="home" role="main">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-text">
                    <div class="badge-tag" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="#f59e0b">
                            <path
                                d="M12 .587l3.668 7.431L23.5 9.167l-5.667 5.522L19.334 24 12 19.897 4.666 24l1.5-9.311L.5 9.167l7.832-1.149z" />
                        </svg>
                        <span>Dipercaya 200+ Siswa</span>
                    </div>

    <!-- KONTEN SMP -->
    <main style="padding-top: 100px; position: relative; z-index: 2;">
        <div class="max-w-7xl mx-auto px-6 py-12">
            
            <!-- Hero Section SMP -->
            <div class="text-center mb-16">
                <h1 style="font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 900; line-height: 1.1; margin-bottom: 1.5rem;">
                    Les Private <span class="gradient-text">SMP</span><br>
                    Siap Hadapi Tantangan Remaja
                </h1>
                <p style="color: var(--muted); font-size: 1.125rem; max-width: 700px; margin: 0 auto 2rem;">
                    Bimbingan belajar khusus SMP dengan pendekatan yang sesuai dengan karakteristik remaja, membantu meraih prestasi akademik maksimal.
                </p>
            </div>

            <!-- Grades Section -->
            <section style="margin: 4rem 0;">
                <div class="text-center mb-12">
                    <h2 style="font-size: 2.5rem; font-weight: 900; margin-bottom: 1rem;">
                        📚 Kelas yang Tersedia
                    </h2>
                    <p style="color: var(--muted); font-size: 1.125rem;">
                        Program belajar yang disesuaikan untuk setiap tingkat kelas SMP
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($grades as $grade)
                    <div class="content-card">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">{{ $grade['icon'] }}</div>
                        <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $grade['name'] }}</h3>
                        <p style="color: var(--muted);">{{ $grade['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- Subjects Section -->
            <section style="margin: 4rem 0;">
                <div class="text-center mb-12">
                    <h2 style="font-size: 2.5rem; font-weight: 900; margin-bottom: 1rem;">
                        📖 Mata Pelajaran
                    </h2>
                    <p style="color: var(--muted); font-size: 1.125rem;">
                        Mata pelajaran inti SMP yang kami ajarkan
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($subjects as $subject)
                    <div class="content-card text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">{{ $subject['icon'] }}</div>
                        <h3 style="font-size: 1.25rem; font-weight: 700;">{{ $subject['name'] }}</h3>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- Features Section -->
            <section style="margin: 4rem 0;">
                <div class="text-center mb-12">
                    <h2 style="font-size: 2.5rem; font-weight: 900; margin-bottom: 1rem;">
                        ⭐ Keunggulan Kami
                    </h2>
                    <p style="color: var(--muted); font-size: 1.125rem;">
                        Mengapa SmartClass pilihan tepat untuk siswa SMP Anda?
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($features as $feature)
                    <div class="content-card text-center">
                        <div style="font-size: 4rem; margin-bottom: 1rem;">{{ $feature['icon'] }}</div>
                        <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.75rem;">{{ $feature['title'] }}</h3>
                        <p style="color: var(--muted); line-height: 1.6;">{{ $feature['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- Testimonials Section -->
            <section style="margin: 4rem 0;">
                <div class="text-center mb-12">
                    <h2 style="font-size: 2.5rem; font-weight: 900; margin-bottom: 1rem;">
                        💬 Testimoni
                    </h2>
                    <p style="color: var(--muted); font-size: 1.125rem;">
                        Apa kata orang tua siswa SMP tentang SmartClass
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    @foreach($testimonials as $testimonial)
                    <div class="content-card">
                        <div style="display: flex; gap: 0.25rem; margin-bottom: 1rem;">
                            @for($i = 0; $i < $testimonial['rating']; $i++)
                                <span style="color: #f59e0b; font-size: 1.5rem;">⭐</span>
                            @endfor
                        </div>
                        <p style="color: var(--muted); font-size: 1.125rem; font-style: italic; margin-bottom: 1rem;">
                            "{{ $testimonial['text'] }}"
                        </p>
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div style="width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, var(--accent-from), var(--accent-to)); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.25rem;">
                                {{ substr($testimonial['name'], 0, 1) }}
                            </div>
                            <div>
                                <p style="font-weight: 700;">{{ $testimonial['name'] }}</p>
                                <p style="color: var(--muted); font-size: 0.875rem;">{{ $testimonial['grade'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="sc-footer">
        <div class="inner" style="background:var(--card-bg); border-radius:12px; padding:24px; box-shadow:0 20px 50px rgba(0,0,0,0.12); border:1px solid rgba(255,255,255,0.03);">
            <div>
                <div class="brand">
                    <div class="brand-logo">S</div>
                    <div>
                        <div>SmartClass</div>
                        <div style="font-size:0.9rem; color:var(--muted); font-weight:600;">Bimbel & Les Private</div>
                    </div>
                </div>
                <p>SmartClass — membantu siswa mencapai potensi terbaik lewat pengajar profesional, program terstruktur, dan dukungan pengembangan karakter.</p>
            </div>

            <div class="sc-links">
                <ul>
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#">Program</a></li>
                    <li><a href="#">Pilih Jenjang</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>

                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Karir</a></li>
                </ul>
            </div>

            <div>
                <div style="color:var(--muted);">
                    <strong style="color:var(--text); display:block; font-size:1rem;">Hubungi Kami</strong>
                    <div style="margin-top:8px;">+62 812-3456-7890</div>
                    <div>info@smartclass.id</div>
                    <div style="margin-top:8px;">Jl. Pendidikan No.1, Kota</div>
                </div>
            </div>
        </div>

        <div class="sc-bottom" style="max-width:1200px;margin:12px auto 0;">
            <div style="color:var(--muted); font-weight:600;">© <span id="scYear"></span> SmartClass. All rights reserved.</div>
            <div style="display:flex; gap:12px; align-items:center;">
                <nav class="sc-social">
                    <a href="#">IG</a>
                    <a href="#">YT</a>
                    <a href="#">FB</a>
                </nav>
                <div style="color:var(--muted); font-size:0.9rem;">Made with ye shungguang</div>
            </div>
        </div>
    </footer>

    <script>
        // Particles
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

        // Theme Toggle
        (function() {
            const html = document.documentElement;
            const nav = document.getElementById('siteNav');
            const toggle = document.getElementById('themeToggle');
            const icon = document.getElementById('globalThemeIcon');
            const storageKey = 'theme';

            const savedTheme = localStorage.getItem(storageKey) || 'dark';
            if (savedTheme === 'light') {
                html.classList.add('theme-light');
                nav.classList.remove('dark');
                icon.textContent = '🌙';
            } else {
                html.classList.remove('theme-light');
                nav.classList.add('dark');
                icon.textContent = '☀️';
            }

            toggle.addEventListener('click', () => {
                html.classList.toggle('theme-light');
                const isLight = html.classList.contains('theme-light');

                if (isLight) nav.classList.remove('dark');
                else nav.classList.add('dark');

                icon.textContent = isLight ? '☀️' : '🌙';
                localStorage.setItem(storageKey, isLight ? 'light' : 'dark');
            });
        })();

        // Dropdown Navigation
        (function() {
            const navBtns = document.querySelectorAll('.nav-btn');

            navBtns.forEach(btn => {
                const dropdown = btn.nextElementSibling;

                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const isActive = btn.classList.contains('active');

                    document.querySelectorAll('.nav-dropdown').forEach(dd => dd.classList.remove('show'));
                    document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));

                    if (!isActive) {
                        dropdown.classList.add('show');
                        btn.classList.add('active');
                    }
                });

                if (dropdown) dropdown.addEventListener('click', (e) => e.stopPropagation());
            });

            document.addEventListener('click', () => {
                document.querySelectorAll('.nav-dropdown').forEach(dd => dd.classList.remove('show'));
                document.querySelectorAll('.nav-btn').forEach(btn => btn.classList.remove('active'));
            });
        })();

        // Footer year
        document.getElementById('scYear').textContent = new Date().getFullYear();
    </script>

</body>
</html>