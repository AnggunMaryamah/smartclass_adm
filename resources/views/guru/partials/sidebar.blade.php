<aside class="sidebar">
    <h2>SmartClass</h2>
    <ul>
        <li>
            <a href="{{ route('guru.dashboard') }}" class="menu {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                <i class="ti-dashboard"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('guru.kelas') }}" class="menu {{ request()->routeIs('guru.kelas') ? 'active' : '' }}">
                <i class="ti-book"></i> Kelas Saya
            </a>
        </li>
        <li>
            <a href="{{ route('guru.laporan') }}" class="menu {{ request()->routeIs('guru.laporan') ? 'active' : '' }}">
                <i class="ti-bar-chart"></i> Laporan
            </a>
        </li>
        <li>
            <a href="{{ route('guru.pembayaran') }}" class="menu {{ request()->routeIs('guru.pembayaran') ? 'active' : '' }}">
                <i class="ti-wallet"></i> Pembayaran
            </a>
        </li>
    </ul>
</aside>

<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        height: 100vh;
        background: #0B1D51;
        color: white;
        padding: 20px;
        z-index: 1000;
    }

    .sidebar h2 {
        font-weight: 800;
        font-size: 1.6rem;
        margin-bottom: 40px;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar li {
        margin: 8px 0;
    }

    /* MENU LINK dengan HOVER & ACTIVE */
    .menu {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        display: block;
        padding: 12px 16px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
        position: relative;
    }

    .menu i {
        margin-right: 12px;
        font-size: 18px;
    }

    /* HOVER EFFECT - Seperti Admin */
    .menu:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        transform: translateX(5px);
    }

    /* ACTIVE STATE */
    .menu.active {
        background: rgba(255, 255, 255, 0.15);
        color: #FFB703;
        font-weight: 700;
    }

    .menu.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: #FFB703;
        border-radius: 0 4px 4px 0;
    }
</style>
