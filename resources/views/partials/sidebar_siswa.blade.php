<style>
    /* ========== SIDEBAR SISWA ========== */
    .sidebar-siswa {
        position: fixed;
        top: 0;
        left: 0;
        width: 280px;
        height: 100vh;
        background: linear-gradient(180deg, #0EA5E9 0%, #0284C7 100%);
        z-index: 999;
        transition: transform 0.3s ease;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
    }

    .sidebar-siswa .sidebar-header {
        padding: 24px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .sidebar-siswa .sidebar-logo-section {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sidebar-siswa .sidebar-logo-section .logo-circle {
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

    .sidebar-siswa .sidebar-logo-section .logo-circle img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .sidebar-siswa .sidebar-logo-section span {
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
    }

    .sidebar-siswa .sidebar-close {
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

    .sidebar-siswa .sidebar-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    .sidebar-siswa .sidebar-nav {
        padding: 16px 12px;
    }

    .sidebar-siswa .nav-link {
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

    .sidebar-siswa .nav-link i {
        font-size: 1.15rem;
        width: 24px;
    }

    .sidebar-siswa .nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
    }

    .sidebar-siswa .nav-link.active {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        font-weight: 600;
    }

    /* ========== FOOTER LOGOUT (SAMA SEPERTI GURU) ========== */
    .sidebar-siswa .sidebar-footer {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 16px 12px 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
    }

    .sidebar-siswa .logout-btn {
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

    .sidebar-siswa .logout-btn:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.8);
        color: white;
    }

    /* ========== RESPONSIVE MOBILE ========== */
    @media (max-width: 991px) {
        .sidebar-siswa {
            transform: translateX(-100%);
        }

        .sidebar-siswa.active {
            transform: translateX(0);
        }

        .sidebar-siswa .sidebar-close {
            display: block;
        }

        .sidebar-siswa .sidebar-header {
            padding-top: 70px;
            padding-bottom: 28px;
            flex-direction: column;
            gap: 16px;
        }

        .sidebar-siswa .sidebar-logo-section {
            flex-direction: column;
            text-align: center;
        }

        .sidebar-siswa .sidebar-logo-section .logo-circle {
            width: 64px;
            height: 64px;
            padding: 10px;
        }

        .sidebar-siswa .sidebar-close {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    }

    @media (max-width: 575px) {
        .sidebar-siswa .sidebar-header {
            padding-top: 65px;
        }

        .sidebar-siswa .sidebar-logo-section .logo-circle {
            width: 56px;
            height: 56px;
        }
    }
</style>

<aside class="sidebar-siswa">
    <div class="sidebar-header">
        <div class="sidebar-logo-section">
            <div class="logo-circle">
                <img src="{{ asset('images/smartclass-logo.png') }}" alt="SmartClass Logo">
            </div>
            <span>SmartClass</span>
        </div>
        <button class="sidebar-close" onclick="document.querySelector('.sidebar-siswa').classList.remove('active'); document.getElementById('sidebarOverlay').classList.remove('active'); document.body.style.overflow = '';">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('siswa.dashboard') }}" class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('siswa.kelas.index') }}" class="nav-link {{ request()->routeIs('siswa.kelas.*') ? 'active' : '' }}">
            <i class="fas fa-book-open"></i>
            <span>Kelas Saya</span>
        </a>
        <a href="{{ route('siswa.pembayaran.index') }}" class="nav-link {{ request()->routeIs('siswa.pembayaran.*') ? 'active' : '' }}">
            <i class="fas fa-credit-card"></i>
            <span>Pembayaran</span>
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
            <button class="logout-btn">
                Logout
            </button>
        @endif
    </div>
</aside>
