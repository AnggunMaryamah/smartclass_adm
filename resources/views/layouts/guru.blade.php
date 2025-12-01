<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SmartClass Guru</title>

    {{-- Font Awesome (Updated ke versi terbaru dengan integrity) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">

    <style>
        /* ========== CSS Variables - Color Palette ========== */
        :root {
            /* Primary Colors */
            --sky-blue: #0EA5E9;
            --cyan: #06B6D4;
            --teal: #14B8A6;
            --purple: #A855F7;
            --pink: #EC4899;
            --orange: #F97316;
            --amber: #F59E0B;

            /* Soft Backgrounds */
            --bg-blue: #F0F9FF;
            --bg-cyan: #ECFEFF;
            --bg-teal: #F0FDFA;
            --bg-purple: #FAF5FF;
            --bg-pink: #FDF2F8;
            --bg-orange: #FFF7ED;

            /* Text */
            --text-primary: #0F172A;
            --text-secondary: #64748B;

            /* Glassmorphism */
            --glass-bg: rgba(255, 255, 255, 0.75);
            --glass-border: rgba(255, 255, 255, 0.6);

            /* Shadows */
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 12px 32px rgba(0, 0, 0, 0.12);

            /* Radius */
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg,
                    #F0F9FF 0%,
                    #E0F2FE 15%,
                    #ECFEFF 30%,
                    #F0FDFA 45%,
                    #FAF5FF 60%,
                    #FDF2F8 75%,
                    #FFF7ED 100%);
            color: var(--text-primary);
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* ========== SIDEBAR TOGGLE BUTTON ========== */
        .sidebar-toggle-btn {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--cyan), var(--teal));
            border: none;
            border-radius: var(--radius-md);
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 1001;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            align-items: center;
            justify-content: center;
        }

        .sidebar-toggle-btn:hover {
            transform: scale(1.05) rotate(5deg);
            box-shadow: var(--shadow-lg);
        }

        /* ========== SIDEBAR OVERLAY ========== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 998;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* ========== MAIN CONTENT ========== */
        main {
            margin-left: 280px;
            padding: 25px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        /* ========== TOP BAR ========== */
        .top-bar {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-lg);
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 20px;
            flex-wrap: wrap;
            box-shadow: var(--shadow-sm);
            position: relative;
            z-index: 100;
        }

        /* SEARCH BOX */
        .search-box {
            flex: 1;
            max-width: 450px;
            position: relative;
            min-width: 200px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 20px 12px 48px;
            border: 2px solid rgba(14, 165, 233, 0.2);
            border-radius: var(--radius-md);
            font-size: 15px;
            outline: none;
            background: white;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .search-box input:focus {
            border-color: var(--cyan);
            box-shadow: 0 0 0 4px rgba(6, 182, 212, 0.1);
        }

        .search-box::before {
            content: '\f002';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 1rem;
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        /* NOTIFICATION ICON */
        .notif-icon {
            position: relative;
            width: 42px;
            height: 42px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .notif-icon:hover {
            background: linear-gradient(135deg, var(--cyan), var(--teal));
            color: white;
            transform: scale(1.1) rotate(-10deg);
            box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);
        }

        /* PROFILE DROPDOWN */
        .profile-dropdown {
            position: relative;
        }

        .profile-trigger {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 6px 12px 6px 6px;
            border-radius: 50px;
            transition: all 0.3s ease;
            background: white;
            box-shadow: var(--shadow-sm);
        }

        .profile-trigger:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .avatar {
            background: linear-gradient(135deg, var(--cyan), var(--teal));
            color: white;
            font-weight: 700;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 15px;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(6, 182, 212, 0.3);
        }

        .profile-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .dropdown-arrow {
            font-size: 10px;
            color: var(--text-secondary);
            transition: transform 0.3s ease;
            margin-left: 4px;
        }

        .profile-dropdown.active .dropdown-arrow {
            transform: rotate(180deg);
        }

        /* DROPDOWN MENU */
        .dropdown-menu {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: white;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-xl);
            min-width: 180px;
            max-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 10000;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .profile-dropdown.active .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu a,
        .dropdown-menu button {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            color: var(--text-primary);
            text-decoration: none;
            font-size: 13px;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
        }

        .dropdown-menu a:hover {
            background: linear-gradient(90deg, var(--bg-cyan), var(--bg-teal));
            color: var(--cyan);
        }

        .dropdown-menu button:hover {
            background: linear-gradient(90deg, #FEE2E2, #FECACA);
            color: #DC2626;
        }

        .dropdown-menu button:last-child {
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            color: #DC2626;
        }

        .dropdown-menu i {
            font-size: 14px;
            width: 18px;
            display: inline-block;
        }

        /* ========== FORCE FONT AWESOME ICONS TO SHOW ========== */
        i.fas,
        i.far,
        i.fab,
        i.fa,
        .fas,
        .far,
        .fab,
        .fa {
            display: inline-block !important;
            font-style: normal !important;
            font-variant: normal !important;
            text-rendering: auto !important;
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        /* Khusus ikon di dashboard cards */
        .stat-icon i,
        .action-icon i,
        .welcome-icon-colorful i {
            color: white !important;
            font-size: inherit !important;
            line-height: inherit !important;
        }

        /* Ikon section title & empty state */
        .section-title i,
        .empty-icon i,
        .chart-header i {
            color: inherit !important;
            font-size: inherit !important;
        }

        /* Ikon di top bar */
        .notif-icon i,
        .dropdown-arrow,
        .dropdown-menu i {
            color: inherit !important;
        }

        /* Ikon di badge */
        .stat-badge i,
        .action-arrow i {
            color: inherit !important;
            font-size: inherit !important;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 991px) {
            .sidebar-toggle-btn {
                display: flex;
            }

            main {
                margin-left: 0;
                padding: 80px 20px 20px 20px;
            }

            .top-bar {
                margin-top: 10px;
            }
        }

        @media (max-width: 767px) {
            main {
                padding: 75px 15px 15px 15px;
            }

            .top-bar {
                padding: 12px 16px;
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }

            .search-box {
                max-width: 100%;
                order: 2;
            }

            .top-bar-right {
                order: 1;
                justify-content: flex-end;
            }
        }

        @media (max-width: 575px) {
            .sidebar-toggle-btn {
                width: 44px;
                height: 44px;
                font-size: 1.1rem;
            }

            main {
                padding: 70px 12px 12px 12px;
            }

            .profile-name {
                display: none;
            }

            .notif-icon {
                width: 38px;
                height: 38px;
                font-size: 1rem;
            }

            .avatar {
                width: 36px;
                height: 36px;
                font-size: 13px;
            }

            .dropdown-menu {
                min-width: 160px;
            }

            .dropdown-menu a,
            .dropdown-menu button {
                padding: 9px 12px;
                font-size: 12px;
                gap: 8px;
            }

            .dropdown-menu i {
                font-size: 13px;
                width: 16px;
            }

            /* ========== SIDEBAR STYLING ========== */
            :root {
                --sidebar-width: 280px;
            }

            .sidebar-modern {
                position: fixed;
                left: 0;
                top: 0;
                width: var(--sidebar-width);
                height: 100vh;
                background: linear-gradient(180deg, #0EA5E9 0%, #0284C7 50%, #0369A1 100%);
                color: white;
                overflow-y: auto;
                overflow-x: hidden;
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                z-index: 1000;
                display: flex;
                flex-direction: column;
                box-shadow: 4px 0 20px rgba(3, 105, 161, 0.3);
            }

            .sidebar-modern::-webkit-scrollbar {
                width: 6px;
            }

            .sidebar-modern::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.1);
                border-radius: 3px;
            }

            .sidebar-modern::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, 0.25);
                border-radius: 3px;
            }

            .sidebar-header {
                padding: 24px 20px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.15);
                display: flex;
                align-items: center;
                justify-content: space-between;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(12px);
                gap: 12px;
                position: sticky;
                top: 0;
                z-index: 10;
            }

            .brand-container {
                display: flex;
                align-items: center;
                gap: 14px;
                flex: 1;
                min-width: 0;
            }

            .logo-image {
                width: 50px;
                height: 50px;
                background: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 5px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                flex-shrink: 0;
                overflow: hidden;
            }

            .owl-logo {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }

            .brand-text {
                font-size: 1.5rem;
                font-weight: 700;
                color: white;
                margin: 0;
                letter-spacing: -0.5px;
                text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            }

            .sidebar-close-btn {
                display: none;
                background: rgba(255, 255, 255, 0.15);
                border: none;
                color: white;
                width: 38px;
                height: 38px;
                border-radius: 10px;
                cursor: pointer;
                transition: all 0.3s ease;
                flex-shrink: 0;
                align-items: center;
                justify-content: center;
                font-size: 1.1rem;
            }

            .sidebar-close-btn:hover {
                background: rgba(255, 255, 255, 0.25);
            }

            .sidebar-nav {
                flex: 1;
                padding: 20px 0;
                overflow-y: auto;
            }

            .nav-list {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .nav-item {
                margin: 0 10px 4px 10px;
            }

            .nav-link {
                display: flex;
                align-items: center;
                gap: 15px;
                padding: 14px 16px;
                color: rgba(255, 255, 255, 0.9);
                text-decoration: none;
                transition: all 0.3s ease;
                font-size: 0.95rem;
                font-weight: 500;
                position: relative;
                border-radius: 10px;
            }

            .nav-link::before {
                content: '';
                position: absolute;
                left: 0;
                top: 50%;
                transform: translateY(-50%);
                width: 4px;
                height: 0;
                background: white;
                border-radius: 0 4px 4px 0;
                transition: height 0.3s ease;
            }

            .nav-link:hover {
                color: white;
                background: rgba(255, 255, 255, 0.1);
                transform: translateX(6px);
            }

            .nav-link:hover::before {
                height: 60%;
            }

            .nav-item.active .nav-link {
                background: rgba(255, 255, 255, 0.2);
                color: white;
                font-weight: 600;
            }

            .nav-item.active .nav-link::before {
                height: 70%;
            }

            .nav-icon {
                font-size: 1.2rem;
                width: 24px;
                text-align: center;
                flex-shrink: 0;
            }

            .nav-text {
                flex: 1;
            }

            .sidebar-footer {
                padding: 20px;
                border-top: 1px solid rgba(255, 255, 255, 0.15);
                margin-top: auto;
                background: rgba(255, 255, 255, 0.1);
            }

            .btn-logout {
                width: 100%;
                padding: 14px 20px;
                background: rgba(255, 255, 255, 0.12);
                border: 1px solid rgba(255, 255, 255, 0.2);
                color: white;
                border-radius: 10px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                font-size: 0.95rem;
                font-family: 'Inter', sans-serif;
            }

            .btn-logout:hover {
                background: rgba(239, 68, 68, 0.25);
                border-color: rgba(239, 68, 68, 0.4);
                transform: translateY(-2px);
            }

            /* Responsive */
            @media (max-width: 991px) {
                .sidebar-modern {
                    transform: translateX(-100%);
                }

                .sidebar-modern.active {
                    transform: translateX(0);
                }

                .sidebar-close-btn {
                    display: flex;
                }
            }
        }
    </style>

    {{-- Stack untuk CSS tambahan dari child views --}}
    @stack('styles')
</head>

<body>
    {{-- Sidebar Toggle Button --}}
    <button class="sidebar-toggle-btn" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    {{-- Sidebar Overlay --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- Include Sidebar --}}
    @include('guru.partials.sidebar')

    <main>
        <!-- Top Bar -->
        <div class="top-bar">
            <!-- Search Box -->
            <div class="search-box">
                <input type="text" placeholder="Cari kelas, siswa, atau materi...">
            </div>

            <!-- Right Side -->
            <div class="top-bar-right">
                <div class="notif-icon">
                    <i class="fas fa-bell"></i>
                </div>

                <!-- Profile Dropdown -->
                <div class="profile-dropdown" id="profileDropdown">
                    <div class="profile-trigger" onclick="toggleDropdown(event)">
                        <div class="avatar">{{ substr(optional(Auth::user())->name ?? 'G', 0, 1) }}</div>
                        <span class="profile-name">{{ optional(Auth::user())->name ?? 'Guru' }}</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </div>
                    <div class="dropdown-menu">
                        <a href="javascript:void(0)">
                            <i class="fas fa-user"></i> Profile Saya
                        </a>
                        <a href="javascript:void(0)">
                            <i class="fas fa-cog"></i> Pengaturan
                        </a>
                        <a href="javascript:void(0)">
                            <i class="fas fa-question-circle"></i> Bantuan
                        </a>
                        @if (Route::has('logout'))
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" onclick="return confirm('Yakin ingin logout?')">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        @else
                            <button onclick="alert('Logout route not defined')">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content dari child views --}}
        @yield('content')
    </main>

    {{-- Chart.js untuk grafik --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Toggle Profile Dropdown
        function toggleDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('active');
        }

        // Close dropdown saat klik di luar
        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            if (dropdown && !dropdown.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });

        // Sidebar Toggle Logic
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar-modern, aside');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            if (sidebarToggle && sidebar && sidebarOverlay) {
                // Open sidebar
                sidebarToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    sidebar.classList.add('active');
                    sidebarOverlay.classList.add('active');
                    sidebarToggle.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });

                // Close sidebar function
                function closeSidebar() {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                    sidebarToggle.classList.remove('active');
                    document.body.style.overflow = '';
                }

                // Close saat klik overlay
                sidebarOverlay.addEventListener('click', closeSidebar);

                // Close saat klik nav link (mobile)
                const navLinks = document.querySelectorAll('.nav-link');
                navLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        if (window.innerWidth <= 991) {
                            setTimeout(closeSidebar, 300);
                        }
                    });
                });

                // Close saat resize ke desktop
                window.addEventListener('resize', function() {
                    if (window.innerWidth > 991) {
                        closeSidebar();
                    }
                });
            }
        });
    </script>

    {{-- Stack untuk scripts tambahan dari child views --}}
    @stack('scripts')
    @yield('script')
</body>

</html>
