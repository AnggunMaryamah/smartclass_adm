<style>
    /* ========== SIDEBAR ADMIN ========== */
    .sidebar-admin {
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

    .sidebar-admin .sidebar-header {
        padding: 24px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .sidebar-admin .sidebar-logo-section {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sidebar-admin .sidebar-logo-section .logo-circle {
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

    .sidebar-admin .sidebar-logo-section .logo-circle img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .sidebar-admin .sidebar-logo-section span {
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
    }

    .sidebar-admin .sidebar-close {
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

    .sidebar-admin .sidebar-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    .sidebar-admin .sidebar-nav {
        padding: 16px 12px;
        flex: 1;
        overflow-y: auto;
    }

    .sidebar-admin .nav-link {
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

    .sidebar-admin .nav-link i {
        font-size: 1.15rem;
        width: 24px;
    }

    .sidebar-admin .nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
    }

    .sidebar-admin .nav-link.active {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        font-weight: 600;
    }

    .sidebar-admin .sidebar-footer {
        padding: 16px 12px 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        margin-top: auto;
    }

    .sidebar-admin .logout-btn {
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

    .sidebar-admin .logout-btn:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.8);
        color: white;
    }

    .sidebar-admin .logout-btn:hover i {
        transform: translateX(-3px);
    }

    /* ========== RESPONSIVE MOBILE ========== */
    @media (max-width: 991px) {
        .sidebar-admin {
            transform: translateX(-100%);
        }

        .sidebar-admin.active {
            transform: translateX(0);
        }

        .sidebar-admin .sidebar-close {
            display: block;
        }

        .sidebar-admin .sidebar-header {
            padding-top: 70px;
            padding-bottom: 28px;
            flex-direction: column;
            gap: 16px;
        }

        .sidebar-admin .sidebar-logo-section {
            flex-direction: column;
            text-align: center;
        }

        .sidebar-admin .sidebar-logo-section .logo-circle {
            width: 64px;
            height: 64px;
            padding: 10px;
        }

        .sidebar-admin .sidebar-close {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    }

    @media (max-width: 575px) {
        .sidebar-admin .sidebar-header {
            padding-top: 65px;
        }

        .sidebar-admin .sidebar-logo-section .logo-circle {
            width: 56px;
            height: 56px;
        }
    }
</style>

<aside class="sidebar-admin">
    <div class="sidebar-header">
        <div class="sidebar-logo-section">
            <div class="logo-circle">
                <img src="{{ asset('images/smartclass-logo.png') }}" alt="SmartClass Logo">
            </div>
            <span>SmartClass</span>
        </div>
        <button class="sidebar-close" onclick="closeSidebarAdmin()">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.users.index') }}"
           class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <i class="fas fa-users"></i>
            <span>Users</span>
        </a>
        <a href="{{ route('admin.data_kelas') }}"
           class="nav-link {{ request()->routeIs('admin.data_kelas*') ? 'active' : '' }}">
            <i class="fas fa-school"></i>
            <span>Data Kelas</span>
        </a>

        <a href="{{ route('admin.laporan') }}"
           class="nav-link {{ request()->routeIs('admin.laporan*') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i>
            <span>Laporan Data Kelas</span>
        </a>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.pembayaran.index') }}"
               class="nav-link {{ request()->is('admin/pembayaran*') ? 'active' : '' }}">
                <i class="fas fa-credit-card"></i>
                <span>Pembayaran</span>
            </a>
        @endif
    </nav>

    {{-- ✅ FOOTER DI LUAR <nav>, SEJAJAR DENGAN <nav> --}}
    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                    class="logout-btn"
                    onclick="return confirm('Yakin ingin logout?')">
                <i class="fas fa-sign-out-alt" style="margin-right:8px;"></i>
                Logout
            </button>
        </form>
    </div>
</aside>

<script>
    function closeSidebarAdmin() {
        const sidebar = document.querySelector('.sidebar-admin');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const sidebarToggle = document.getElementById('sidebarToggle');
        if (sidebar) sidebar.classList.remove('active');
        if (sidebarOverlay) sidebarOverlay.classList.remove('active');
        if (sidebarToggle) sidebarToggle.classList.remove('active');
        document.body.style.overflow = '';
    }
</script>
