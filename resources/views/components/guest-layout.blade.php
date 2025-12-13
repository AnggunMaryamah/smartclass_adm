<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'SmartClass' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --bg: #f6fbff;
            --nav-bg: rgba(255, 255, 255, 0.95);
            --text: #0b1a2b;
            --muted: #52606d;
            --card-bg: #ffffff;
            --accent-from: #0ea5e9;
            --accent-to: #2dd4bf;
            --glass-border: rgba(2, 6, 23, 0.05);
        }

        html.theme-dark {
            --bg: #071426;
            --nav-bg: rgba(6, 12, 20, 0.90);
            --text: #e6eef7;
            --muted: #9fb2c6;
            --card-bg: #071224;
            --accent-from: #2dd4bf;
            --accent-to: #1e3a5f;
            --glass-border: rgba(255, 255, 255, 0.06);
        }

        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
        }

        /* NAV */
        .site-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 72px;
            z-index: 1000;
            background: var(--nav-bg);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
            display: flex;
            align-items: center
        }

        .nav-inner {
            max-width: 1200px;
            margin: auto;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 18px;
            gap: 12px
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--text)
        }

        .brand-logo {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            display: grid;
            place-items: center;
            color: #fff;
            font-weight: 800
        }

        .nav-links {
            display: flex;
            gap: 18px;
            align-items: center
        }

        .nav-link {
            padding: 8px 12px;
            border-radius: 10px;
            font-weight: 600;
            color: var(--text);
            text-decoration: none
        }

        .nav-link:hover {
            background: rgba(14, 165, 233, 0.06)
        }

        .nav-dropdown {
            position: absolute;
            top: 110%;
            left: 0;
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--glass-border);
            padding: 8px;
            display: none;
            min-width: 150px
        }

        .nav-dropdown a {
            display: block;
            padding: 8px 10px;
            color: var(--text);
            text-decoration: none;
            font-weight: 600
        }

        .nav-dropdown a:hover {
            background: rgba(14, 165, 233, 0.04)
        }

        .auth-area {
            display: flex;
            align-items: center;
            gap: 10px
        }

        .btn-cta {
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            padding: .55rem 1rem;
            color: #fff;
            border-radius: 999px;
            font-weight: 800;
            text-decoration: none
        }

        .theme-toggle {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            border: 1px solid var(--glass-border);
            background: transparent;
            display: grid;
            place-items: center;
            cursor: pointer;
            font-size: 18px;
            color: var(--text)
        }

        .auth-user {
            display: flex;
            align-items: center;
            gap: 10px
        }

        .auth-avatar {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            object-fit: cover;
            display: none;
            border: 1px solid rgba(0, 0, 0, 0.06)
        }

        .auth-initial {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: none;
            place-items: center;
            background: linear-gradient(135deg, var(--accent-from), var(--accent-to));
            color: #fff;
            font-weight: 900
        }

        .auth-name {
            font-weight: 700;
            max-width: 160px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 0.95rem
        }

        main {
            padding-top: 110px
        }

        footer {
            padding: 20px;
            text-align: center;
            color: var(--muted)
        }

        /* MOBILE: hamburger visible */
        .hamburger {
            display: none;
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: transparent;
            border: 1px solid var(--glass-border);
            display: grid;
            place-items: center;
            cursor: pointer
        }

        .hamburger .line {
            width: 18px;
            height: 2px;
            background: var(--text);
            border-radius: 2px;
            display: block
        }

        .hamburger.open .line.top {
            transform: translateY(6px) rotate(45deg)
        }

        .hamburger.open .line.mid {
            opacity: 0;
            transform: scaleX(0)
        }

        .hamburger.open .line.bot {
            transform: translateY(-6px) rotate(-45deg)
        }

        /* mobile drawer */
        .mobile-drawer {
            position: fixed;
            inset: 0;
            display: none;
            z-index: 1100;
            background: rgba(2, 6, 23, 0.45)
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
            max-width: 360px;
            background: var(--card-bg);
            padding: 18px;
            overflow: auto;
            border-left: 1px solid var(--glass-border);
            box-shadow: -20px 0 60px rgba(0, 0, 0, 0.25)
        }

        .mobile-drawer a {
            display: block;
            padding: 12px 8px;
            color: var(--text);
            text-decoration: none;
            font-weight: 700;
            border-radius: 8px
        }

        .mobile-drawer .close-btn {
            background: transparent;
            border: 0;
            font-size: 22px;
            cursor: pointer;
            color: var(--text)
        }

        @media(max-width:880px) {
            .nav-links {
                display: none
            }

            .hamburger {
                display: grid
            }

            .auth-name {
                display: none
            }

            .brand-text {
                display: none
            }
        }
    </style>
</head>

<body>
    <header class="site-nav" role="navigation" aria-label="Main Navigation">
        <div class="nav-inner">
            <a href="{{ url('/') }}" class="brand" aria-label="SmartClass">
                <div class="brand-logo"> <img src="{{ asset('images/smartclass-logo.png') }}" alt="Logo"
                        style="width:28px;height:28px;"></div>
                <span class="brand-text">SmartClass</span>
            </a>

            <nav class="nav-links" aria-label="Primary Links">
                <a href="{{ url('/') }}" class="nav-link">Beranda</a>

                <div style="position:relative;">
                    <button id="jenjangBtn" class="nav-link" style="background:none;border:none;cursor:pointer">Pilih
                        Jenjang ▾</button>
                    <div id="jenjangDropdown" class="nav-dropdown" role="menu" aria-hidden="true">
                        <a href="/jenjang/sd">SD</a>
                        <a href="/jenjang/smp">SMP</a>
                        <a href="/jenjang/sma">SMK/SMA</a>
                    </div>
                </div>

                <a href="#guru" class="nav-link">Guru</a>
                <a href="#tentang" class="nav-link">Tentang Kami</a>
            </nav>

            <div style="display:flex;align-items:center;gap:10px">
                <button id="themeToggleBtn" class="theme-toggle" aria-label="Toggle tema">🌙</button>

                {{-- auth area --}}
                <div class="auth-area" role="group" aria-label="Actions">
                    @if (auth()->check())
                        @php
                            $user = auth()->user();
                            $displayName = $user->name ?? ($user->username ?? $user->email);
                            $avatar = $user->avatar ?? ($user->photo ?? null);
                            $initials = collect(explode(' ', trim($displayName)))
                                ->filter()
                                ->map(fn($s) => strtoupper(substr($s, 0, 1)))
                                ->slice(0, 2)
                                ->join('');
                        @endphp

                        <div class="auth-user" id="authUser">
                            @if ($avatar)
                                <img id="authAvatar" src="{{ $avatar }}" alt="avatar" class="auth-avatar"
                                    style="display:block">
                            @else
                                <div id="authInitial" class="auth-initial" style="display:grid">{{ $initials ?: 'U' }}
                                </div>
                            @endif

                            <div id="authName" class="auth-name">{{ \Illuminate\Support\Str::limit($displayName, 20) }}
                            </div>

                            <form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn-cta"
                                    style="background:transparent;color:var(--text);border:1px solid var(--glass-border);padding:.45rem .7rem">Keluar</button>
                            </form>
                        </div>
                    @else
                        <a id="loginBtnHeader" href="{{ route('login') }}" class="btn-cta">Login</a>
                    @endif
                </div>

                <!-- hamburger for mobile -->
                <button id="hamburger" class="hamburger" aria-expanded="false" aria-controls="mobileDrawer"
                    aria-label="Buka menu">
                    <span class="line top"></span>
                    <span class="line mid"></span>
                    <span class="line bot"></span>
                </button>
            </div>
        </div>
    </header>

    <!-- MOBILE DRAWER -->
    <div id="mobileDrawer" class="mobile-drawer" aria-hidden="true">
        <div class="panel" role="document" aria-label="Menu seluler">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px">
                <div style="display:flex;align-items:center;gap:10px">
                    <div class="brand-logo"
                        style="width:44px;height:44px;border-radius:10px;display:grid;place-items:center"> <img
                            src="{{ asset('images/smartclass-logo.png') }}" alt="Logo"
                            style="width:28px;height:28px;"></div>
                    <strong style="font-size:1rem">{{ config('app.name', 'SmartClass') }}</strong>
                </div>
                <button class="close-btn" id="closeDrawerBtn" aria-label="Tutup menu">✕</button>
            </div>

            <nav aria-label="Mobile primary">
                <a href="/" onclick="closeDrawer()">Beranda</a>
                <div>
                    <button id="mobileJenjangBtn"
                        style="width:100%;text-align:left;background:none;border:none;padding:10px 8px;font-weight:700;cursor:pointer">Pilih
                        Jenjang ▾</button>
                    <div id="mobileJenjang" style="display:none;padding-left:8px;margin-bottom:8px">
                        <a href="/jenjang/sd" onclick="closeDrawer()">SD</a>
                        <a href="/jenjang/smp" onclick="closeDrawer()">SMP</a>
                        <a href="/jenjang/sma" onclick="closeDrawer()">SMK/SMA</a>
                    </div>
                </div>
                <a href="#guru" onclick="closeDrawer()">Guru</a>
                <a href="#tentang" onclick="closeDrawer()">Tentang Kami</a>
            </nav>

            <div style="margin-top:18px;border-top:1px solid var(--glass-border);padding-top:14px">
                @if (auth()->check())
                    <div style="display:flex;gap:10px;align-items:center">
                        @if ($avatar ?? false)
                            <img src="{{ $avatar }}" alt="avatar"
                                style="width:52px;height:52px;border-radius:10px;object-fit:cover">
                        @else
                            <div
                                style="width:52px;height:52px;border-radius:10px;display:grid;place-items:center;background:linear-gradient(135deg,var(--accent-from),var(--accent-to));color:#fff;font-weight:800">
                                {{ $initials ?? 'U' }}</div>
                        @endif
                        <div>
                            <div style="font-weight:800">
                                {{ \Illuminate\Support\Str::limit($displayName ?? (auth()->user()->name ?? auth()->user()->email), 24) }}
                            </div>
                            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit"
                                    class="btn-cta"
                                    style="margin-top:6px;background:transparent;color:var(--text);border:1px solid var(--glass-border);padding:.45rem .7rem">Keluar</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-cta" style="display:block;text-align:center">Login /
                        Sign Up</a>
                @endif
            </div>
        </div>
    </div>

    <main>
        <div class="container">
            {{ $slot }}
        </div>
    </main>

    <footer>
        &copy; <span id="yearFooter"></span> SmartClass — All rights reserved.
    </footer>

    @if (Auth::check())
        <script>
            window.__USER = {!! json_encode([
                'id' => Auth::id(),
                'name' => Auth::user()->name ?? (Auth::user()->username ?? Auth::user()->email),
                'email' => Auth::user()->email,
                'avatar' => Auth::user()->avatar ?? (Auth::user()->photo ?? null),
            ]) !!};
        </script>
    @endif

    <script>
        (function() {
            // year
            const yEl = document.getElementById('yearFooter');
            if (yEl) yEl.textContent = new Date().getFullYear();

            // jenjang dropdown (desktop)
            const jenjangBtn = document.getElementById('jenjangBtn');
            const jenjangMenu = document.getElementById('jenjangDropdown');
            if (jenjangBtn && jenjangMenu) {
                jenjangBtn.addEventListener('click', e => {
                    e.stopPropagation();
                    jenjangMenu.style.display = jenjangMenu.style.display === 'block' ? 'none' : 'block';
                });
                document.addEventListener('click', e => {
                    if (!jenjangBtn.contains(e.target) && !jenjangMenu.contains(e.target)) jenjangMenu.style
                        .display = 'none';
                });
            }

            // theme toggle (persist)
            const THEME_KEY = 'smartclass-theme';
            const themeBtn = document.getElementById('themeToggleBtn');

            function applyTheme(t) {
                if (t === 'dark') {
                    document.documentElement.classList.add('theme-dark');
                    themeBtn.textContent = '☀️';
                } else {
                    document.documentElement.classList.remove('theme-dark');
                    themeBtn.textContent = '🌙';
                }
            }
            try {
                const saved = localStorage.getItem(THEME_KEY);
                if (saved) applyTheme(saved);
                else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) applyTheme(
                    'dark');
                else applyTheme('light');
            } catch (e) {
                applyTheme('light');
            }
            if (themeBtn) themeBtn.addEventListener('click', () => {
                const dark = document.documentElement.classList.toggle('theme-dark');
                try {
                    localStorage.setItem(THEME_KEY, dark ? 'dark' : 'light');
                } catch (e) {}
                applyTheme(dark ? 'dark' : 'light');
            });

            // MOBILE DRAWER & HAMBURGER
            const hamburger = document.getElementById('hamburger');
            const mobileDrawer = document.getElementById('mobileDrawer');
            const closeDrawerBtn = document.getElementById('closeDrawerBtn');
            const mobileJenjangBtn = document.getElementById('mobileJenjangBtn');
            const mobileJenjang = document.getElementById('mobileJenjang');

            function openDrawer() {
                if (!mobileDrawer) return;
                mobileDrawer.classList.add('show');
                mobileDrawer.setAttribute('aria-hidden', 'false');
                hamburger.classList.add('open');
                hamburger.setAttribute('aria-expanded', 'true');
                document.body.style.overflow = 'hidden';
            }

            function closeDrawer() {
                if (!mobileDrawer) return;
                mobileDrawer.classList.remove('show');
                mobileDrawer.setAttribute('aria-hidden', 'true');
                hamburger.classList.remove('open');
                hamburger.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }
            window.closeDrawer = closeDrawer; // used by inline onclicks

            if (hamburger && mobileDrawer) {
                hamburger.addEventListener('click', () => {
                    if (mobileDrawer.classList.contains('show')) closeDrawer();
                    else openDrawer();
                });
                if (closeDrawerBtn) closeDrawerBtn.addEventListener('click', closeDrawer);
                mobileDrawer.addEventListener('click', (e) => {
                    if (e.target === mobileDrawer) closeDrawer();
                });
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && mobileDrawer.classList.contains('show')) closeDrawer();
                });
                window.addEventListener('resize', () => {
                    if (window.innerWidth > 880 && mobileDrawer.classList.contains('show')) closeDrawer();
                });
            }

            if (mobileJenjangBtn && mobileJenjang) {
                mobileJenjangBtn.addEventListener('click', () => {
                    mobileJenjang.style.display = mobileJenjang.style.display === 'block' ? 'none' : 'block';
                });
            }

            // AUTH UI fallback logic (keeps header consistent if JS-only flow used)
            const AUTH = {
                loginBtn: document.getElementById('loginBtnHeader'),
                authUser: document.getElementById('authUser'),
                authAvatar: document.getElementById('authAvatar'),
                authInitial: document.getElementById('authInitial'),
                authName: document.getElementById('authName'),
                logoutForm: document.getElementById('logoutForm'),
                STORAGE_KEY: 'smartclass-user'
            };

            function showLoggedOut() {
                if (AUTH.loginBtn) AUTH.loginBtn.style.display = 'inline-block';
                if (AUTH.authUser) AUTH.authUser.style.display = 'none';
                try {
                    localStorage.removeItem(AUTH.STORAGE_KEY);
                } catch (e) {}
            }

            function showLoggedIn(user) {
                if (!user) return;
                if (AUTH.loginBtn) AUTH.loginBtn.style.display = 'none';
                if (AUTH.authName) AUTH.authName.textContent = user.name || user.email || 'User';
                if (user.avatar && AUTH.authAvatar) {
                    AUTH.authAvatar.src = user.avatar;
                    AUTH.authAvatar.style.display = 'block';
                    if (AUTH.authInitial) AUTH.authInitial.style.display = 'none';
                } else if (AUTH.authInitial) {
                    AUTH.authInitial.textContent = (user.name || user.email || 'U').split(' ').map(s => s[0]).slice(0,
                        2).join('').toUpperCase();
                    AUTH.authInitial.style.display = 'grid';
                    if (AUTH.authAvatar) AUTH.authAvatar.style.display = 'none';
                }
                if (AUTH.authUser) AUTH.authUser.style.display = 'flex';
                try {
                    localStorage.setItem(AUTH.STORAGE_KEY, JSON.stringify(user));
                } catch (e) {}
            }

            if (window.__USER && (window.__USER.name || window.__USER.email)) showLoggedIn(window.__USER);
            else {
                try {
                    const stored = localStorage.getItem(AUTH.STORAGE_KEY);
                    if (stored) {
                        const u = JSON.parse(stored);
                        if (u && (u.name || u.email)) showLoggedIn(u);
                        else showLoggedOut();
                    } else showLoggedOut();
                } catch (e) {
                    showLoggedOut();
                }
            }
            if (AUTH.logoutForm) AUTH.logoutForm.addEventListener('submit', () => {
                try {
                    localStorage.removeItem(AUTH.STORAGE_KEY);
                } catch (e) {}
            });

            // expose helpers
            window.smartclass = window.smartclass || {};
            window.smartclass.setLoggedInUser = function(user) {
                showLoggedIn(user);
            };
            window.smartclass.clearLoggedInUser = function() {
                showLoggedOut();
            };

        })();
    </script>
</body>

</html>