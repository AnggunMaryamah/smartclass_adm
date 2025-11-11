<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SmartClass Guru</title>

    <!-- Ikon dari Themify -->
    <link rel="stylesheet" href="{{ asset('themify-icons.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #f0f3f7;
            color: #0B1D51;
        }

        main {
            margin-left: 250px;
            padding: 25px;
            min-height: 100vh;
        }

        /* TOP BAR - Header dengan SEARCH, NOTIF & PROFILE (SEJAJAR) */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 20px;
        }

        /* SEARCH BOX - di kiri top bar */
        .search-box {
            flex: 1;
            max-width: 450px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 12px 20px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            outline: none;
            background: white;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .search-box input:focus {
            border-color: #0077B6;
            box-shadow: 0 4px 12px rgba(0, 119, 182, 0.15);
        }

        /* RIGHT SIDE TOP BAR */
        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notif-icon {
            position: relative;
            font-size: 22px;
            color: #0B1D51;
            cursor: pointer;
            transition: 0.3s;
        }

        .notif-icon:hover {
            color: #0077B6;
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
            padding: 8px 15px 8px 8px;
            border-radius: 50px;
            transition: 0.3s;
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .profile-trigger:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .avatar {
            background: linear-gradient(135deg, #0077B6, #00B4D8);
            color: white;
            font-weight: 600;
            border-radius: 50%;
            width: 42px;
            height: 42px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .profile-name {
            font-size: 15px;
            font-weight: 600;
            color: #0B1D51;
        }

        .dropdown-arrow {
            font-size: 10px;
            color: #666;
            transition: 0.3s;
            margin-left: 2px;
        }

        /* PROFILE DROPDOWN - LEBIH COMPACT */
        .profile-dropdown {
            position: relative;
        }

        .profile-trigger {
            display: flex;
            align-items: center;
            gap: 8px;
            /* ← UBAH dari 10px */
            cursor: pointer;
            padding: 6px 12px 6px 6px;
            /* ← UBAH dari 8px 15px 8px 8px */
            border-radius: 50px;
            transition: 0.3s;
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .profile-trigger:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .avatar {
            background: linear-gradient(135deg, #0077B6, #00B4D8);
            color: white;
            font-weight: 600;
            border-radius: 50%;
            width: 36px;
            /* ← UBAH dari 42px */
            height: 36px;
            /* ← UBAH dari 42px */
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            /* ← UBAH dari 16px */
            flex-shrink: 0;
        }

        .profile-name {
            font-size: 14px;
            /* ← UBAH dari 15px */
            font-weight: 600;
            color: #0B1D51;
        }

        .dropdown-arrow {
            font-size: 9px;
            /* ← UBAH dari 10px */
            color: #666;
            transition: 0.3s;
            margin-left: 2px;
        }

        .profile-dropdown.active .dropdown-arrow {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            min-width: 170px;
            /* ← UBAH dari 200px */
            margin-top: 10px;
            /* ← UBAH dari 12px */
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s;
            z-index: 1000;
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
            /* ← UBAH dari 12px */
            padding: 11px 16px;
            /* ← UBAH dari 14px 20px */
            color: #0B1D51;
            text-decoration: none;
            font-size: 13px;
            /* ← UBAH dari 14px */
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: 0.2s;
            font-weight: 500;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: #f5f7fa;
        }

        .dropdown-menu a:first-child {
            border-radius: 10px 10px 0 0;
        }

        .dropdown-menu button:last-child {
            border-radius: 0 0 10px 10px;
            border-top: 1px solid #e0e0e0;
            color: #dc3545;
            font-weight: 600;
        }

        .dropdown-menu i {
            font-size: 15px;
            /* ← TAMBAHKAN ini (baru) */
        }


        /* WELCOME SECTION */
        .dashboard-header {
            background: linear-gradient(135deg, #0077B6 0%, #00B4D8 100%);
            padding: 35px;
            border-radius: 20px;
            color: white;
            display: flex;
            align-items: center;
            gap: 25px;
            margin-bottom: 30px;
            box-shadow: 0 6px 20px rgba(0, 119, 182, 0.3);
        }

        .welcome-icon {
            width: 85px;
            height: 85px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 50%;
            padding: 18px;
            flex-shrink: 0;
        }

        .welcome-text h2 {
            margin: 0 0 8px 0;
            font-weight: 700;
            font-size: 1.9rem;
        }

        .welcome-text p {
            margin: 0;
            opacity: 0.95;
            font-size: 1rem;
        }

        /* CARD AREA - 4 kolom */
        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 35px;
        }

        .card {
            background: white;
            padding: 28px 24px;
            border-radius: 16px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 18px;
        }

        .card h3 {
            margin: 0 0 10px 0;
            font-size: 0.95rem;
            font-weight: 500;
            color: #7a7a7a;
        }

        .card p {
            margin: 0 0 16px 0;
            font-size: 1.75rem;
            font-weight: 700;
            color: #0B1D51;
        }

        .card .progress {
            background: #f0f0f0;
            height: 7px;
            border-radius: 10px;
            overflow: hidden;
        }

        .card .bar {
            height: 7px;
            border-radius: 10px;
            transition: width 0.8s ease-in-out;
        }

        .card-blue .card-icon {
            background: #e3f2fd;
            color: #0077B6;
        }

        .card-blue .bar {
            background: #0077B6;
        }

        .card-cyan .card-icon {
            background: #e0f7fa;
            color: #00B4D8;
        }

        .card-cyan .bar {
            background: #00B4D8;
        }

        .card-yellow .card-icon {
            background: #fff3e0;
            color: #FFB340;
        }

        .card-yellow .bar {
            background: #FFB340;
        }

        .card-purple .card-icon {
            background: #e8eaf6;
            color: #5C6BC0;
        }

        .card-purple .bar {
            background: #5C6BC0;
        }

        /* CHART AREA */
        .chart-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }

        .chart-card {
            background: white;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .chart-card h3 {
            margin: 0 0 22px 0;
            font-size: 1.15rem;
            font-weight: 600;
            color: #0B1D51;
        }

        /* TARGET CIRCLE - DESAIN MIRIP CONTOH GAMBAR */
        .target-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .target-circle {
            position: relative;
            width: 160px;
            height: 160px;
            margin-bottom: 20px;
        }

        .target-circle svg {
            transform: rotate(-90deg);
            width: 100%;
            height: 100%;
        }

        .circle-bg {
            fill: none;
            stroke: #e3f2fd;
            stroke-width: 3.8;
        }

        .circle {
            fill: none;
            stroke: url(#gradient);
            stroke-width: 3.8;
            stroke-linecap: round;
            stroke-dasharray: 0, 100;
            transition: stroke-dasharray 1.5s ease-in-out;
        }

        .circle-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2rem;
            font-weight: 700;
            color: #0B1D51;
        }

        .target-info {
            text-align: center;
        }

        .target-info h4 {
            margin: 0 0 5px 0;
            font-size: 1.8rem;
            font-weight: 700;
            color: #0B1D51;
        }

        .target-info p {
            margin: 0;
            font-size: 0.95rem;
            color: #7a7a7a;
            font-weight: 500;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            main {
                margin-left: 0;
                padding: 20px;
            }

            .top-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                max-width: 100%;
            }

            .chart-section {
                grid-template-columns: 1fr;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    @include('guru.partials.sidebar')

    <main>
        <!-- Top Bar - Search, Notif & Profile SEJAJAR -->
        <div class="top-bar">
            <!-- Search Box di Kiri -->
            <div class="search-box">
                <input type="text" placeholder="Search Here">
            </div>

            <!-- Right Side: Notif & Profile -->
            <div class="top-bar-right">
                <div class="notif-icon">
                    <i class="ti-bell"></i>
                </div>

                <!-- Profile Dropdown dengan Arrow -->
                <div class="profile-dropdown" id="profileDropdown">
                    <div class="profile-trigger" onclick="toggleDropdown()">
                        <div class="avatar">{{ substr(Auth::user()->name ?? 'G', 0, 1) }}</div>
                        <span class="profile-name">{{ Auth::user()->name ?? 'Guru' }}</span>
                        <i class="ti-angle-down dropdown-arrow"></i>
                    </div>
                    <div class="dropdown-menu">
                        <a href="javascript:void(0)">
                            <i class="ti-user"></i> Profile
                        </a>
                        <a href="javascript:void(0)">
                            <i class="ti-settings"></i> Setting
                        </a>
                        <a href="javascript:void(0)">
                            <i class="ti-help"></i> Help
                        </a>
                        <button onclick="if(confirm('Yakin mau logout?')) window.location.href='/login'">
                            <i class="ti-shift-right"></i> Log Out
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')
    </main>

    @include('guru.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('active');
        }

        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });
    </script>

    @yield('script')
</body>

</html>
