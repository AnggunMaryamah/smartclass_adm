<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title') - SmartClass Siswa</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-dark: #003366;
            --primary-medium: #0055A5;
            --primary-gradient-start: #003366;
            --primary-gradient-end: #002147;

            --accent-cyan: #00B8D4;
            --accent-cyan-light: #4DD0E1;
            --accent-cyan-tint: #E0F7FA;
            --accent-cyan-hover: #0097A7;

            --accent-green: #8BC34A;
            --accent-green-light: #AED581;
            --accent-green-tint: #F1F8E9;
            --accent-green-dark: #7CB342;

            --bg-base: #F5F7FA;
            --bg-card: #FFFFFF;
            --bg-hover: #EDF2F7;
            --bg-subtle: #E8EEF3;

            --text-primary: #2D3748;
            --text-secondary: #4A5568;
            --text-muted: #718096;
            --text-white: #FFFFFF;

            --border-light: #E2E8F0;
            --border-medium: #CBD5E0;

            --warning: #FFA726;
            --warning-light: #FFF3E0;
            --danger: #EF5350;
            --danger-light: #FFEBEE;

            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(255, 255, 255, 0.7);

            --shadow-sm: 0 2px 8px rgba(0, 51, 102, 0.06);
            --shadow-md: 0 4px 12px rgba(0, 51, 102, 0.08);
            --shadow-lg: 0 8px 20px rgba(0, 51, 102, 0.10);
            --shadow-xl: 0 12px 28px rgba(0, 51, 102, 0.12);
            --shadow-cyan: 0 4px 12px rgba(0, 184, 212, 0.25);
            --shadow-green: 0 4px 12px rgba(139, 195, 74, 0.25);

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
            #F5F7FA 0%,
            #EDF2F7 50%,
            #E8EEF3 100%);
            background-attachment: fixed;
            color: var(--text-primary);
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* tombol toggle sidebar */
        .sidebar-toggle-btn {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--accent-cyan), var(--accent-cyan-hover));
            border: none;
            border-radius: var(--radius-md);
            color: var(--text-white);
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 1001;
            box-shadow: var(--shadow-cyan);
            transition: all 0.3s ease;
            align-items: center;
            justify-content: center;
        }

        .sidebar-toggle-btn:hover {
            transform: scale(1.05) rotate(5deg);
            box-shadow: 0 6px 16px rgba(0, 184, 212, 0.35);
        }

        .sidebar-toggle-btn:active {
            transform: scale(0.95);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(45, 55, 72, 0.5);
            backdrop-filter: blur(4px);
            z-index: 998;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* konten utama digeser karena sidebar */
        main {
            margin-left: 280px;
            padding: 25px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

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

        .search-box {
            flex: 1;
            max-width: 450px;
            position: relative;
            min-width: 200px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 20px 12px 48px;
            border: 2px solid var(--border-light);
            border-radius: var(--radius-md);
            font-size: 15px;
            outline: none;
            background: var(--bg-card);
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
        }

        .search-box input:focus {
            border-color: var(--accent-cyan);
            box-shadow: 0 0 0 4px var(--accent-cyan-tint);
        }

        .search-box input::placeholder {
            color: var(--text-muted);
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
            pointer-events: none;
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .notif-icon {
            position: relative;
            width: 42px;
            height: 42px;
            background: var(--bg-card);
            border: 1px solid var(--border-light);
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
            background: linear-gradient(135deg, var(--accent-cyan), var(--accent-cyan-hover));
            border-color: var(--accent-cyan);
            color: var(--text-white);
            transform: scale(1.1) rotate(-10deg);
            box-shadow: var(--shadow-cyan);
        }

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
            background: var(--bg-card);
            border: 1px solid var(--border-light);
            box-shadow: var(--shadow-sm);
        }

        .avatar {
            background: linear-gradient(135deg, var(--accent-cyan), var(--accent-cyan-hover));
            color: var(--text-white);
            font-weight: 700;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 15px;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(0, 184, 212, 0.3);
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
            color: var(--accent-cyan);
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: var(--bg-card);
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
            border: 1px solid var(--border-light);
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

        .dropdown-menu button:last-child {
            border-top: 1px solid var(--border-light);
            color: var(--danger);
        }

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
        }
    </style>

    @stack('styles')
</head>
<body>
<button class="sidebar-toggle-btn" id="sidebarToggle" aria-label="Toggle Sidebar">
    <i class="fas fa-bars"></i>
</button>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- sidebar kiri --}}
@include('partials.sidebar_siswa')

<main>
    {{-- TOP BAR GLOBAL --}}
    <div class="top-bar">
        <div class="search-box">
            <input type="text" placeholder="Cari kelas, materi, atau tugas...">
        </div>

        <div class="top-bar-right">
            <div class="notif-icon">
                <i class="fas fa-bell"></i>
            </div>

            <div class="profile-dropdown" id="profileDropdown">
                <div class="profile-trigger" onclick="toggleDropdown(event)">
                    <div class="avatar">{{ substr(optional(Auth::user())->name ?? 'S', 0, 1) }}</div>
                    <span class="profile-name">{{ optional(Auth::user())->name ?? 'Siswa' }}</span>
                    <i class="fas fa-chevron-down dropdown-arrow"></i>
                </div>
                <div class="dropdown-menu">
                    <a href="{{ route('siswa.profil.index') }}">
                        <i class="fas fa-user"></i> Profil Saya
                    </a>
                    <a href="javascript:void(0)">
                        <i class="fas fa-cog"></i> Pengaturan
                    </a>
                    <a href="javascript:void(0)">
                        <i class="fas fa-question-circle"></i> Bantuan
                    </a>
                    @if(Route::has('logout'))
                        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
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

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function toggleDropdown(event) {
        event.stopPropagation();
        const dropdown = document.getElementById('profileDropdown');
        dropdown.classList.toggle('active');
    }

    window.addEventListener('click', function (e) {
        const dropdown = document.getElementById('profileDropdown');
        if (dropdown && !dropdown.contains(e.target)) {
            dropdown.classList.remove('active');
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar-siswa');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (sidebarToggle && sidebar && sidebarOverlay) {
            sidebarToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                sidebar.classList.add('active');
                sidebarOverlay.classList.add('active');
                sidebarToggle.classList.add('active');
                document.body.style.overflow = 'hidden';
            });

            function closeSidebar() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                sidebarToggle.classList.remove('active');
                document.body.style.overflow = '';
            }

            sidebarOverlay.addEventListener('click', closeSidebar);

            const navLinks = document.querySelectorAll('.sidebar-siswa .nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function () {
                    if (window.innerWidth <= 991) {
                        setTimeout(closeSidebar, 300);
                    }
                });
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth > 991) {
                    closeSidebar();
                }
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                    closeSidebar();
                }
            });
        }
    });
</script>

@stack('scripts')
@yield('script')
</body>
</html>
