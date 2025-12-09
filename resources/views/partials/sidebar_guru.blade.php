<style>
    /* ========== SIDEBAR GURU ========== */
    .sidebar-guru {
        position: fixed;
        top: 0;
        left: 0;
        width: 280px;
        height: 100vh;
        background: linear-gradient(180deg, #0EA5E9 0%, #0284C7 100%);
        z-index: 999;
        transition: transform 0.3s ease;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
    }

    .sidebar-guru .sidebar-header {
        padding: 24px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .sidebar-guru .sidebar-logo-section {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sidebar-guru .sidebar-logo-section .logo-circle {
        width: 48px;
        height: 48px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        flex-shrink: 0;
    }

    .sidebar-guru .sidebar-logo-section .logo-circle img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .sidebar-guru .sidebar-logo-section span {
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
    }

    .sidebar-guru .sidebar-close {
        display: none;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        color: white;
        cursor: pointer;
        font-size: 1.1rem;
        transition: all 0.2s ease;
    }

    .sidebar-guru .sidebar-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    .sidebar-guru .sidebar-nav {
        padding: 16px 12px;
        flex: 1;
        overflow-y: auto;
    }

    /* ========== NAV LINK BIASA ========== */
    .sidebar-guru .nav-link {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 16px;
        margin-bottom: 6px;
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .sidebar-guru .nav-link i {
        font-size: 1.15rem;
        width: 24px;
    }

    .sidebar-guru .nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
    }

    .sidebar-guru .nav-link.active {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        font-weight: 600;
    }

    /* ========== DROPDOWN MENU ========== */
    .nav-item-dropdown {
        margin-bottom: 6px;
    }

    .nav-dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 16px;
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 500;
        transition: all 0.25s ease;
        cursor: pointer;
        background: transparent;
        border: none;
        width: 100%;
        text-align: left;
        font-family: 'Inter', sans-serif;
    }

    .nav-dropdown-toggle i.icon {
        font-size: 1.15rem;
        width: 24px;
    }

    .nav-dropdown-toggle .menu-text {
        flex: 1;
    }

    .nav-dropdown-toggle i.arrow {
        font-size: 0.75rem;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin-left: auto;
    }

    .nav-dropdown-toggle:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
    }

    .nav-dropdown-toggle.active {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        font-weight: 600;
    }

    /* Arrow rotate saat dropdown terbuka */
    .nav-item-dropdown.open .nav-dropdown-toggle i.arrow {
        transform: rotate(180deg);
    }

    /* Submenu container */
    .nav-dropdown-menu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), 
                    opacity 0.25s ease,
                    padding 0.25s ease;
        opacity: 0;
        padding: 0;
    }

    .nav-item-dropdown.open .nav-dropdown-menu {
        max-height: 500px;
        opacity: 1;
        padding: 4px 0 4px 0;
    }

    /* Submenu items - TANPA BULLET, MENJOROK KE KANAN */
    .nav-dropdown-menu .submenu-link {
        display: block;
        padding: 10px 16px 10px 54px;
        font-size: 14px;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.2s ease;
        font-weight: 500;
    }

    /* TANPA HOVER EFFECT - Flat design */
    .nav-dropdown-menu .submenu-link:hover {
        color: white;
    }

    .nav-dropdown-menu .submenu-link.active {
        color: white;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 8px;
        margin: 2px 8px;
        padding-left: 46px;
    }

    /* ========== FOOTER LOGOUT ========== */
    .sidebar-guru .sidebar-footer {
        padding: 16px 12px 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
    }

    .sidebar-guru .logout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 12px 16px;
        margin-bottom: 0;
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        transition: all 0.2s ease;
        border: 2px solid rgba(255, 255, 255, 0.5);
        background: transparent;
        width: 100%;
        cursor: pointer;
        font-family: 'Inter', sans-serif;
        text-align: center;
    }

    .sidebar-guru .logout-btn:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.8);
        color: white;
    }

    /* ========== RESPONSIVE MOBILE ========== */
    @media (max-width: 991px) {
        .sidebar-guru {
            transform: translateX(-100%);
        }

        .sidebar-guru.active {
            transform: translateX(0);
        }

        .sidebar-guru .sidebar-close {
            display: block;
        }

        .sidebar-guru .sidebar-header {
            padding-top: 70px;
            padding-bottom: 28px;
            flex-direction: column;
            gap: 16px;
        }

        .sidebar-guru .sidebar-logo-section {
            flex-direction: column;
            text-align: center;
        }

        .sidebar-guru .sidebar-logo-section .logo-circle {
            width: 64px;
            height: 64px;
            padding: 10px;
        }

        .sidebar-guru .sidebar-close {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    }

    @media (max-width: 575px) {
        .sidebar-guru .sidebar-header {
            padding-top: 65px;
        }

        .sidebar-guru .sidebar-logo-section .logo-circle {
            width: 56px;
            height: 56px;
        }
    }
</style>

<aside class="sidebar-guru">
    <div class="sidebar-header">
        <div class="sidebar-logo-section">
            <div class="logo-circle">
                <img src="{{ asset('images/smartclass-logo.png') }}" alt="SmartClass Logo">
            </div>
            <span>SmartClass</span>
        </div>
        <button class="sidebar-close" onclick="closeSidebarGuru()">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <nav class="sidebar-nav">
        {{-- Dashboard --}}
        <a href="{{ route('guru.dashboard') }}" class="nav-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>

        {{-- Kelola Kelas (Dropdown) --}}
        <div class="nav-item-dropdown {{ request()->routeIs('guru.kelas.*') || request()->routeIs('guru.siswa.*') || request()->routeIs('guru.laporan_siswa.*') ? 'open' : '' }}" id="kelolaKelasDropdown">
            <button type="button" class="nav-dropdown-toggle {{ request()->routeIs('guru.kelas.*') || request()->routeIs('guru.siswa.*') || request()->routeIs('guru.laporan_siswa.*') ? 'active' : '' }}" onclick="toggleKelolaKelas(event)">
                <i class="fas fa-chalkboard-teacher icon"></i>
                <span class="menu-text">Kelola Kelas</span>
                <i class="fas fa-chevron-down arrow"></i>
            </button>
            <div class="nav-dropdown-menu">
                <a href="{{ route('guru.kelas.index') }}" class="submenu-link {{ request()->routeIs('guru.kelas.*') ? 'active' : '' }}">
                    Daftar Kelas
                </a>
                <a href="{{ route('guru.siswa.index') }}" class="submenu-link {{ request()->routeIs('guru.siswa.*') ? 'active' : '' }}">
                    Siswa Saya
                </a>
                <a href="{{ route('guru.laporan_siswa.index') }}" class="submenu-link {{ request()->routeIs('guru.laporan_siswa.*') ? 'active' : '' }}">
                    Laporan Siswa
                </a>
            </div>
        </div>

        {{-- Pembayaran --}}
        <a href="{{ route('guru.pembayaran.index') }}" class="nav-link {{ request()->routeIs('guru.pembayaran.*') ? 'active' : '' }}">
            <i class="fas fa-money-bill-wave"></i>
            <span>Laporan Pembayaran</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        @if (Route::has('logout'))
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="logout-btn" onclick="return confirm('Yakin ingin logout?')">
                    Logout
                </button>
            </form>
        @else
            <button class="logout-btn" onclick="alert('Route logout belum didefinisikan')">
                Logout
            </button>
        @endif
    </div>
</aside>

<script>
    // Toggle dropdown Kelola Kelas
    function toggleKelolaKelas(event) {
        event.preventDefault();
        event.stopPropagation();
        
        const dropdown = document.getElementById('kelolaKelasDropdown');
        dropdown.classList.toggle('open');
    }

    // Close sidebar mobile
    function closeSidebarGuru() {
        document.querySelector('.sidebar-guru').classList.remove('active');
        document.getElementById('sidebarOverlay').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Prevent dropdown close when clicking submenu
    document.querySelectorAll('.nav-dropdown-menu .submenu-link').forEach(link => {
        link.addEventListener('click', function(e) {
            // Let the link work normally, don't stop propagation
        });
    });
</script>
