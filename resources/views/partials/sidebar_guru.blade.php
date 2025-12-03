<div class="sidebar-wrapper">
    <aside class="sidebar-modern" id="sidebar">
        {{-- Header dengan Logo --}}
        <div class="sidebar-header">
            <div class="brand-container">
                <div class="logo-image">
                    <img src="{{ asset('images/smartclass-logo.png') }}?v={{ time() }}" alt="SmartClass"
                        class="owl-logo" onerror="this.style.display='none'">
                </div>
                <h3 class="brand-text">SmartClass</h3>
            </div>
            <button class="sidebar-close-btn" id="sidebarCloseBtn" aria-label="Close Sidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="sidebar-nav">
            <ul class="nav-list">
                {{-- Dashboard --}}
                <li class="nav-item {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('guru.dashboard') }}" class="nav-link">
                        <i class="fas fa-home nav-icon"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                {{-- Kelas Saya --}}
                <li class="nav-item {{ request()->routeIs('guru.kelas*') ? 'active' : '' }}">
                    <a href="{{ route('guru.kelas.index') }}" class="nav-link">
                        <i class="fas fa-book nav-icon"></i>
                        <span class="nav-text">Kelas Saya</span>
                    </a>
                </li>

                {{-- Laporan Belajar Siswa - FIXED --}}
                <li class="nav-item {{ request()->routeIs('guru.laporan_siswa*') ? 'active' : '' }}">
                    <a href="{{ route('guru.laporan_siswa.index') }}" class="nav-link">
                        <i class="fas fa-chart-bar nav-icon"></i>
                        <span class="nav-text">Laporan Belajar Siswa</span>
                    </a>
                </li>


                {{-- Pembayaran --}}
                <li class="nav-item {{ request()->routeIs('guru.pembayaran*') ? 'active' : '' }}">
                    <a href="{{ url('/guru/pembayaran') }}" class="nav-link">
                        <i class="fas fa-credit-card nav-icon"></i>
                        <span class="nav-text">Pembayaran</span>
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Logout --}}
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>
</div>

<style>
    :root {
        --sidebar-width: 280px;
        --primary-blue: #0EA5E9;
        --primary-dark: #0284C7;
        --primary-darker: #0369A1;
        --white: #FFFFFF;
        --white-80: rgba(255, 255, 255, 0.8);
        --white-90: rgba(255, 255, 255, 0.9);
        --white-10: rgba(255, 255, 255, 0.1);
        --white-12: rgba(255, 255, 255, 0.12);
        --white-15: rgba(255, 255, 255, 0.15);
        --white-20: rgba(255, 255, 255, 0.2);
        --white-25: rgba(255, 255, 255, 0.25);
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.15);
        --shadow-lg: 0 6px 24px rgba(14, 165, 233, 0.25);
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* ========== SIDEBAR UTAMA ========== */
    .sidebar-modern {
        position: fixed;
        left: 0;
        top: 0;
        width: var(--sidebar-width);
        height: 100vh;
        background: linear-gradient(180deg,
                var(--primary-blue) 0%,
                var(--primary-dark) 50%,
                var(--primary-darker) 100%);
        color: var(--white);
        overflow-y: auto;
        overflow-x: hidden;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            box-shadow 0.3s ease;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        box-shadow: 4px 0 20px rgba(3, 105, 161, 0.3);
    }

    /* Scrollbar Styling */
    .sidebar-modern::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-modern::-webkit-scrollbar-track {
        background: var(--white-10);
        border-radius: 3px;
    }

    .sidebar-modern::-webkit-scrollbar-thumb {
        background: var(--white-25);
        border-radius: 3px;
        transition: background 0.3s ease;
    }

    .sidebar-modern::-webkit-scrollbar-thumb:hover {
        background: var(--white-20);
    }

    /* ========== HEADER ========== */
    .sidebar-header {
        padding: 24px 20px;
        border-bottom: 1px solid var(--white-15);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--white-10);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        gap: 12px;
        position: sticky;
        top: 0;
        z-index: 10;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    }

    .brand-container {
        display: flex;
        align-items: center;
        gap: 14px;
        flex: 1;
        min-width: 0;
    }

    /* LOGO IMAGE */
    .logo-image {
        width: 50px;
        height: 50px;
        background: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        flex-shrink: 0;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .logo-image:hover {
        transform: scale(1.05) rotate(5deg);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }

    .owl-logo {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }

    .brand-text {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--white);
        margin: 0;
        letter-spacing: -0.5px;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Close Button */
    .sidebar-close-btn {
        display: none;
        background: var(--white-15);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: none;
        color: var(--white);
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
        background: var(--white-25);
        transform: scale(1.05) rotate(90deg);
    }

    .sidebar-close-btn:active {
        transform: scale(0.95);
    }

    /* ========== NAVIGATION ========== */
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
        color: var(--white-90);
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.95rem;
        font-weight: 500;
        position: relative;
        border-radius: 10px;
    }

    /* Accent Bar pada Kiri */
    .nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 0;
        background: var(--white);
        border-radius: 0 4px 4px 0;
        transition: height 0.3s ease;
    }

    /* Glassmorphism Background */
    .nav-link::after {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--white-10);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .nav-link:hover::after {
        opacity: 1;
    }

    .nav-link:hover {
        color: var(--white);
        transform: translateX(6px);
    }

    .nav-link:hover::before {
        height: 60%;
    }

    /* Active State */
    .nav-item.active .nav-link {
        background: var(--white-20);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        color: var(--white);
        font-weight: 600;
        box-shadow: var(--shadow-sm);
    }

    .nav-item.active .nav-link::before {
        height: 70%;
    }

    .nav-icon {
        font-size: 1.2rem;
        width: 24px;
        text-align: center;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
        transition: transform 0.3s ease;
    }

    .nav-link:hover .nav-icon {
        transform: scale(1.15) rotate(5deg);
    }

    .nav-text {
        flex: 1;
        position: relative;
        z-index: 1;
    }

    /* ========== FOOTER (LOGOUT) ========== */
    .sidebar-footer {
        padding: 20px;
        border-top: 1px solid var(--white-15);
        margin-top: auto;
        background: var(--white-10);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 -2px 12px rgba(0, 0, 0, 0.08);
    }

    .sidebar-footer form {
        margin: 0;
    }

    .btn-logout {
        width: 100%;
        padding: 14px 20px;
        background: var(--white-12);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid var(--white-20);
        color: var(--white);
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 0.95rem;
        text-decoration: none;
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
    }

    .btn-logout:hover {
        background: rgba(239, 68, 68, 0.25);
        border-color: rgba(239, 68, 68, 0.4);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.3);
    }

    .btn-logout:active {
        transform: translateY(0);
    }

    .btn-logout i {
        transition: transform 0.3s ease;
    }

    .btn-logout:hover i {
        transform: translateX(3px);
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 992px) {
        .sidebar-modern {
            transform: translateX(-100%);
        }

        .sidebar-modern.active {
            transform: translateX(0);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
        }

        .sidebar-close-btn {
            display: flex;
        }

        .sidebar-header {
            padding: 20px 18px;
        }

        .logo-image {
            width: 48px;
            height: 48px;
        }

        .brand-text {
            font-size: 1.35rem;
        }
    }

    @media (max-width: 768px) {
        .sidebar-modern {
            width: 280px;
        }

        .sidebar-header {
            padding: 18px 16px;
        }

        .logo-image {
            width: 46px;
            height: 46px;
        }

        .brand-text {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 576px) {
        .sidebar-modern {
            width: 260px;
        }

        .sidebar-header {
            padding: 16px 14px;
        }

        .brand-container {
            gap: 12px;
        }

        .logo-image {
            width: 44px;
            height: 44px;
        }

        .brand-text {
            font-size: 1.25rem;
        }

        .sidebar-close-btn {
            width: 36px;
            height: 36px;
        }

        .nav-link {
            font-size: 0.9rem;
            padding: 12px 14px;
        }

        .nav-icon {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 400px) {
        .sidebar-modern {
            width: 240px;
        }

        .sidebar-header {
            padding: 14px 12px;
        }

        .logo-image {
            width: 42px;
            height: 42px;
        }

        .brand-text {
            font-size: 1.2rem;
        }
    }

    /* ========== PRINT ========== */
    @media print {
        .sidebar-modern {
            display: none;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        // Close Sidebar Function
        function closeSidebar() {
            if (sidebar && sidebarOverlay) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        // Close Button Click
        if (sidebarCloseBtn) {
            sidebarCloseBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                closeSidebar();
            });
        }

        // Overlay Click
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeSidebar);
        }

        // Auto Close on Mobile after Link Click
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 992) {
                    setTimeout(closeSidebar, 300);
                }
            });
        });

        // Logout Confirmation
        const logoutForm = document.getElementById('logoutForm');
        if (logoutForm) {
            logoutForm.addEventListener('submit', function(e) {
                if (!confirm('Yakin ingin logout?')) {
                    e.preventDefault();
                }
            });
        }

        // Force Reload Logo on Error
        const owlLogo = document.querySelector('.owl-logo');
        if (owlLogo) {
            owlLogo.addEventListener('error', function() {
                console.warn('Logo gagal dimuat');
                this.style.display = 'none';
            });
        }
    });
</script>
<div class="sidebar-wrapper">
    <aside class="sidebar-modern" id="sidebar">
        {{-- Header dengan Logo --}}
        <div class="sidebar-header">
            <div class="brand-container">
                <div class="logo-image">
                    <img src="{{ asset('images/smartclass-logo.png') }}?v={{ time() }}" alt="SmartClass"
                        class="owl-logo" onerror="this.style.display='none'">
                </div>
                <h3 class="brand-text">SmartClass</h3>
            </div>
            <button class="sidebar-close-btn" id="sidebarCloseBtn" aria-label="Close Sidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="sidebar-nav">
            <ul class="nav-list">
                {{-- Dashboard --}}
                <li class="nav-item {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('guru.dashboard') }}" class="nav-link">
                        <i class="fas fa-home nav-icon"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                {{-- Kelas Saya --}}
                <li class="nav-item {{ request()->routeIs('guru.kelas*') ? 'active' : '' }}">
                    <a href="{{ route('guru.kelas.index') }}" class="nav-link">
                        <i class="fas fa-book nav-icon"></i>
                        <span class="nav-text">Kelas Saya</span>
                    </a>
                </li>

                {{-- Laporan Belajar Siswa - FIXED --}}
                <li class="nav-item {{ request()->routeIs('guru.laporan_siswa*') ? 'active' : '' }}">
                    <a href="{{ route('guru.laporan_siswa.index') }}" class="nav-link">
                        <i class="fas fa-chart-bar nav-icon"></i>
                        <span class="nav-text">Laporan Belajar Siswa</span>
                    </a>
                </li>


                {{-- Pembayaran --}}
                <li class="nav-item {{ request()->routeIs('guru.pembayaran*') ? 'active' : '' }}">
                    <a href="{{ url('/guru/pembayaran') }}" class="nav-link">
                        <i class="fas fa-credit-card nav-icon"></i>
                        <span class="nav-text">Pembayaran</span>
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Logout --}}
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>
</div>

<style>
    :root {
        --sidebar-width: 280px;
        --primary-blue: #0EA5E9;
        --primary-dark: #0284C7;
        --primary-darker: #0369A1;
        --white: #FFFFFF;
        --white-80: rgba(255, 255, 255, 0.8);
        --white-90: rgba(255, 255, 255, 0.9);
        --white-10: rgba(255, 255, 255, 0.1);
        --white-12: rgba(255, 255, 255, 0.12);
        --white-15: rgba(255, 255, 255, 0.15);
        --white-20: rgba(255, 255, 255, 0.2);
        --white-25: rgba(255, 255, 255, 0.25);
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.15);
        --shadow-lg: 0 6px 24px rgba(14, 165, 233, 0.25);
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* ========== SIDEBAR UTAMA ========== */
    .sidebar-modern {
        position: fixed;
        left: 0;
        top: 0;
        width: var(--sidebar-width);
        height: 100vh;
        background: linear-gradient(180deg,
                var(--primary-blue) 0%,
                var(--primary-dark) 50%,
                var(--primary-darker) 100%);
        color: var(--white);
        overflow-y: auto;
        overflow-x: hidden;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            box-shadow 0.3s ease;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        box-shadow: 4px 0 20px rgba(3, 105, 161, 0.3);
    }

    /* Scrollbar Styling */
    .sidebar-modern::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-modern::-webkit-scrollbar-track {
        background: var(--white-10);
        border-radius: 3px;
    }

    .sidebar-modern::-webkit-scrollbar-thumb {
        background: var(--white-25);
        border-radius: 3px;
        transition: background 0.3s ease;
    }

    .sidebar-modern::-webkit-scrollbar-thumb:hover {
        background: var(--white-20);
    }

    /* ========== HEADER ========== */
    .sidebar-header {
        padding: 24px 20px;
        border-bottom: 1px solid var(--white-15);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--white-10);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        gap: 12px;
        position: sticky;
        top: 0;
        z-index: 10;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    }

    .brand-container {
        display: flex;
        align-items: center;
        gap: 14px;
        flex: 1;
        min-width: 0;
    }

    /* LOGO IMAGE */
    .logo-image {
        width: 50px;
        height: 50px;
        background: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        flex-shrink: 0;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .logo-image:hover {
        transform: scale(1.05) rotate(5deg);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }

    .owl-logo {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }

    .brand-text {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--white);
        margin: 0;
        letter-spacing: -0.5px;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Close Button */
    .sidebar-close-btn {
        display: none;
        background: var(--white-15);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: none;
        color: var(--white);
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
        background: var(--white-25);
        transform: scale(1.05) rotate(90deg);
    }

    .sidebar-close-btn:active {
        transform: scale(0.95);
    }

    /* ========== NAVIGATION ========== */
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
        color: var(--white-90);
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.95rem;
        font-weight: 500;
        position: relative;
        border-radius: 10px;
    }

    /* Accent Bar pada Kiri */
    .nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 0;
        background: var(--white);
        border-radius: 0 4px 4px 0;
        transition: height 0.3s ease;
    }

    /* Glassmorphism Background */
    .nav-link::after {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--white-10);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .nav-link:hover::after {
        opacity: 1;
    }

    .nav-link:hover {
        color: var(--white);
        transform: translateX(6px);
    }

    .nav-link:hover::before {
        height: 60%;
    }

    /* Active State */
    .nav-item.active .nav-link {
        background: var(--white-20);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        color: var(--white);
        font-weight: 600;
        box-shadow: var(--shadow-sm);
    }

    .nav-item.active .nav-link::before {
        height: 70%;
    }

    .nav-icon {
        font-size: 1.2rem;
        width: 24px;
        text-align: center;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
        transition: transform 0.3s ease;
    }

    .nav-link:hover .nav-icon {
        transform: scale(1.15) rotate(5deg);
    }

    .nav-text {
        flex: 1;
        position: relative;
        z-index: 1;
    }

    /* ========== FOOTER (LOGOUT) ========== */
    .sidebar-footer {
        padding: 20px;
        border-top: 1px solid var(--white-15);
        margin-top: auto;
        background: var(--white-10);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 -2px 12px rgba(0, 0, 0, 0.08);
    }

    .sidebar-footer form {
        margin: 0;
    }

    .btn-logout {
        width: 100%;
        padding: 14px 20px;
        background: var(--white-12);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid var(--white-20);
        color: var(--white);
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 0.95rem;
        text-decoration: none;
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
    }

    .btn-logout:hover {
        background: rgba(239, 68, 68, 0.25);
        border-color: rgba(239, 68, 68, 0.4);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.3);
    }

    .btn-logout:active {
        transform: translateY(0);
    }

    .btn-logout i {
        transition: transform 0.3s ease;
    }

    .btn-logout:hover i {
        transform: translateX(3px);
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 992px) {
        .sidebar-modern {
            transform: translateX(-100%);
        }

        .sidebar-modern.active {
            transform: translateX(0);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
        }

        .sidebar-close-btn {
            display: flex;
        }

        .sidebar-header {
            padding: 20px 18px;
        }

        .logo-image {
            width: 48px;
            height: 48px;
        }

        .brand-text {
            font-size: 1.35rem;
        }
    }

    @media (max-width: 768px) {
        .sidebar-modern {
            width: 280px;
        }

        .sidebar-header {
            padding: 18px 16px;
        }

        .logo-image {
            width: 46px;
            height: 46px;
        }

        .brand-text {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 576px) {
        .sidebar-modern {
            width: 260px;
        }

        .sidebar-header {
            padding: 16px 14px;
        }

        .brand-container {
            gap: 12px;
        }

        .logo-image {
            width: 44px;
            height: 44px;
        }

        .brand-text {
            font-size: 1.25rem;
        }

        .sidebar-close-btn {
            width: 36px;
            height: 36px;
        }

        .nav-link {
            font-size: 0.9rem;
            padding: 12px 14px;
        }

        .nav-icon {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 400px) {
        .sidebar-modern {
            width: 240px;
        }

        .sidebar-header {
            padding: 14px 12px;
        }

        .logo-image {
            width: 42px;
            height: 42px;
        }

        .brand-text {
            font-size: 1.2rem;
        }
    }

    /* ========== PRINT ========== */
    @media print {
        .sidebar-modern {
            display: none;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        // Close Sidebar Function
        function closeSidebar() {
            if (sidebar && sidebarOverlay) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        // Close Button Click
        if (sidebarCloseBtn) {
            sidebarCloseBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                closeSidebar();
            });
        }

        // Overlay Click
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeSidebar);
        }

        // Auto Close on Mobile after Link Click
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 992) {
                    setTimeout(closeSidebar, 300);
                }
            });
        });

        // Logout Confirmation
        const logoutForm = document.getElementById('logoutForm');
        if (logoutForm) {
            logoutForm.addEventListener('submit', function(e) {
                if (!confirm('Yakin ingin logout?')) {
                    e.preventDefault();
                }
            });
        }

        // Force Reload Logo on Error
        const owlLogo = document.querySelector('.owl-logo');
        if (owlLogo) {
            owlLogo.addEventListener('error', function() {
                console.warn('Logo gagal dimuat');
                this.style.display = 'none';
            });
        }
    });
</script>
<div class="sidebar-wrapper">
    <aside class="sidebar-modern" id="sidebar">
        {{-- Header dengan Logo --}}
        <div class="sidebar-header">
            <div class="brand-container">
                <div class="logo-image">
                    <img src="{{ asset('images/smartclass-logo.png') }}?v={{ time() }}" alt="SmartClass"
                        class="owl-logo" onerror="this.style.display='none'">
                </div>
                <h3 class="brand-text">SmartClass</h3>
            </div>
            <button class="sidebar-close-btn" id="sidebarCloseBtn" aria-label="Close Sidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="sidebar-nav">
            <ul class="nav-list">
                {{-- Dashboard --}}
                <li class="nav-item {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('guru.dashboard') }}" class="nav-link">
                        <i class="fas fa-home nav-icon"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                {{-- Kelas Saya --}}
                <li class="nav-item {{ request()->routeIs('guru.kelas*') ? 'active' : '' }}">
                    <a href="{{ route('guru.kelas.index') }}" class="nav-link">
                        <i class="fas fa-book nav-icon"></i>
                        <span class="nav-text">Kelas Saya</span>
                    </a>
                </li>

                {{-- Laporan Belajar Siswa - FIXED --}}
                <li class="nav-item {{ request()->routeIs('guru.laporan_siswa*') ? 'active' : '' }}">
                    <a href="{{ route('guru.laporan_siswa.index') }}" class="nav-link">
                        <i class="fas fa-chart-bar nav-icon"></i>
                        <span class="nav-text">Laporan Belajar Siswa</span>
                    </a>
                </li>


                {{-- Pembayaran --}}
                <li class="nav-item {{ request()->routeIs('guru.pembayaran*') ? 'active' : '' }}">
                    <a href="{{ url('/guru/pembayaran') }}" class="nav-link">
                        <i class="fas fa-credit-card nav-icon"></i>
                        <span class="nav-text">Pembayaran</span>
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Logout --}}
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>
</div>

<style>
    :root {
        --sidebar-width: 280px;
        --primary-blue: #0EA5E9;
        --primary-dark: #0284C7;
        --primary-darker: #0369A1;
        --white: #FFFFFF;
        --white-80: rgba(255, 255, 255, 0.8);
        --white-90: rgba(255, 255, 255, 0.9);
        --white-10: rgba(255, 255, 255, 0.1);
        --white-12: rgba(255, 255, 255, 0.12);
        --white-15: rgba(255, 255, 255, 0.15);
        --white-20: rgba(255, 255, 255, 0.2);
        --white-25: rgba(255, 255, 255, 0.25);
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.15);
        --shadow-lg: 0 6px 24px rgba(14, 165, 233, 0.25);
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* ========== SIDEBAR UTAMA ========== */
    .sidebar-modern {
        position: fixed;
        left: 0;
        top: 0;
        width: var(--sidebar-width);
        height: 100vh;
        background: linear-gradient(180deg,
                var(--primary-blue) 0%,
                var(--primary-dark) 50%,
                var(--primary-darker) 100%);
        color: var(--white);
        overflow-y: auto;
        overflow-x: hidden;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            box-shadow 0.3s ease;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        box-shadow: 4px 0 20px rgba(3, 105, 161, 0.3);
    }

    /* Scrollbar Styling */
    .sidebar-modern::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-modern::-webkit-scrollbar-track {
        background: var(--white-10);
        border-radius: 3px;
    }

    .sidebar-modern::-webkit-scrollbar-thumb {
        background: var(--white-25);
        border-radius: 3px;
        transition: background 0.3s ease;
    }

    .sidebar-modern::-webkit-scrollbar-thumb:hover {
        background: var(--white-20);
    }

    /* ========== HEADER ========== */
    .sidebar-header {
        padding: 24px 20px;
        border-bottom: 1px solid var(--white-15);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--white-10);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        gap: 12px;
        position: sticky;
        top: 0;
        z-index: 10;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    }

    .brand-container {
        display: flex;
        align-items: center;
        gap: 14px;
        flex: 1;
        min-width: 0;
    }

    /* LOGO IMAGE */
    .logo-image {
        width: 50px;
        height: 50px;
        background: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        flex-shrink: 0;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .logo-image:hover {
        transform: scale(1.05) rotate(5deg);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }

    .owl-logo {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }

    .brand-text {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--white);
        margin: 0;
        letter-spacing: -0.5px;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Close Button */
    .sidebar-close-btn {
        display: none;
        background: var(--white-15);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: none;
        color: var(--white);
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
        background: var(--white-25);
        transform: scale(1.05) rotate(90deg);
    }

    .sidebar-close-btn:active {
        transform: scale(0.95);
    }

    /* ========== NAVIGATION ========== */
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
        color: var(--white-90);
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.95rem;
        font-weight: 500;
        position: relative;
        border-radius: 10px;
    }

    /* Accent Bar pada Kiri */
    .nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 0;
        background: var(--white);
        border-radius: 0 4px 4px 0;
        transition: height 0.3s ease;
    }

    /* Glassmorphism Background */
    .nav-link::after {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--white-10);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .nav-link:hover::after {
        opacity: 1;
    }

    .nav-link:hover {
        color: var(--white);
        transform: translateX(6px);
    }

    .nav-link:hover::before {
        height: 60%;
    }

    /* Active State */
    .nav-item.active .nav-link {
        background: var(--white-20);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        color: var(--white);
        font-weight: 600;
        box-shadow: var(--shadow-sm);
    }

    .nav-item.active .nav-link::before {
        height: 70%;
    }

    .nav-icon {
        font-size: 1.2rem;
        width: 24px;
        text-align: center;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
        transition: transform 0.3s ease;
    }

    .nav-link:hover .nav-icon {
        transform: scale(1.15) rotate(5deg);
    }

    .nav-text {
        flex: 1;
        position: relative;
        z-index: 1;
    }

    /* ========== FOOTER (LOGOUT) ========== */
    .sidebar-footer {
        padding: 20px;
        border-top: 1px solid var(--white-15);
        margin-top: auto;
        background: var(--white-10);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 -2px 12px rgba(0, 0, 0, 0.08);
    }

    .sidebar-footer form {
        margin: 0;
    }

    .btn-logout {
        width: 100%;
        padding: 14px 20px;
        background: var(--white-12);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid var(--white-20);
        color: var(--white);
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 0.95rem;
        text-decoration: none;
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
    }

    .btn-logout:hover {
        background: rgba(239, 68, 68, 0.25);
        border-color: rgba(239, 68, 68, 0.4);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.3);
    }

    .btn-logout:active {
        transform: translateY(0);
    }

    .btn-logout i {
        transition: transform 0.3s ease;
    }

    .btn-logout:hover i {
        transform: translateX(3px);
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 992px) {
        .sidebar-modern {
            transform: translateX(-100%);
        }

        .sidebar-modern.active {
            transform: translateX(0);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
        }

        .sidebar-close-btn {
            display: flex;
        }

        .sidebar-header {
            padding: 20px 18px;
        }

        .logo-image {
            width: 48px;
            height: 48px;
        }

        .brand-text {
            font-size: 1.35rem;
        }
    }

    @media (max-width: 768px) {
        .sidebar-modern {
            width: 280px;
        }

        .sidebar-header {
            padding: 18px 16px;
        }

        .logo-image {
            width: 46px;
            height: 46px;
        }

        .brand-text {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 576px) {
        .sidebar-modern {
            width: 260px;
        }

        .sidebar-header {
            padding: 16px 14px;
        }

        .brand-container {
            gap: 12px;
        }

        .logo-image {
            width: 44px;
            height: 44px;
        }

        .brand-text {
            font-size: 1.25rem;
        }

        .sidebar-close-btn {
            width: 36px;
            height: 36px;
        }

        .nav-link {
            font-size: 0.9rem;
            padding: 12px 14px;
        }

        .nav-icon {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 400px) {
        .sidebar-modern {
            width: 240px;
        }

        .sidebar-header {
            padding: 14px 12px;
        }

        .logo-image {
            width: 42px;
            height: 42px;
        }

        .brand-text {
            font-size: 1.2rem;
        }
    }

    /* ========== PRINT ========== */
    @media print {
        .sidebar-modern {
            display: none;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        // Close Sidebar Function
        function closeSidebar() {
            if (sidebar && sidebarOverlay) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        // Close Button Click
        if (sidebarCloseBtn) {
            sidebarCloseBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                closeSidebar();
            });
        }

        // Overlay Click
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeSidebar);
        }

        // Auto Close on Mobile after Link Click
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 992) {
                    setTimeout(closeSidebar, 300);
                }
            });
        });

        // Logout Confirmation
        const logoutForm = document.getElementById('logoutForm');
        if (logoutForm) {
            logoutForm.addEventListener('submit', function(e) {
                if (!confirm('Yakin ingin logout?')) {
                    e.preventDefault();
                }
            });
        }

        // Force Reload Logo on Error
        const owlLogo = document.querySelector('.owl-logo');
        if (owlLogo) {
            owlLogo.addEventListener('error', function() {
                console.warn('Logo gagal dimuat');
                this.style.display = 'none';
            });
        }
    });
</script>
