<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SmartClass')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background-color: #f8fafc;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #0B1D51;
            color: white;
            position: fixed;
            padding: 20px;
        }

        .sidebar h2 {
            font-weight: 800;
            font-size: 1.5rem;
            margin-bottom: 40px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: white;
            font-weight: 600;
            margin: 15px 0;
            padding: 10px 15px;
            border-radius: 8px;
            transition: 0.25s ease;
        }

        .sidebar a:hover {
            background-color: #1A3E78;
            transform: translateX(5px);
        }

        .logout-section {
            position: absolute;
            bottom: 30px;
            left: 20px;
            right: 20px;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #E63946;
            color: white;
            font-weight: 700;
            padding: 12px;
            border-radius: 10px;
            text-decoration: none;
            transition: 0.2s;
        }

        .logout-btn:hover {
            background-color: #C53030;
        }

        .main {
            margin-left: 270px;
            padding: 30px 40px;
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #e0e6ed;
            /* garis pemisah lembut */
            padding-bottom: 15px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header h1 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #0B1D51;
            margin: 0;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-right p {
            margin: 0;
            font-weight: 600;
            color: #0B1D51;
        }

        .avatar {
            background-color: #ffffff;
            border: 2px solid #0077B6;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #0B1D51;
        }

        /* CARD AREA */
        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card-info {
            border-radius: 15px;
            padding: 25px;
            transition: 0.3s;
            cursor: pointer;
        }

        .card-info h4,
        .card-info h2 {
            color: white;
            margin: 0;
        }

        .card-blue {
            background-color: #0077B6;
        }

        .card-cyan {
            background-color: #00B4D8;
        }

        .card-lightblue {
            background-color: #90E0EF;
            color: #0B1D51;
        }

        .card-yellow {
            background-color: #FFC34B;
            color: #0B1D51;
        }

        .card-info:hover {
            transform: translateY(-6px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        /* TABLE */
        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
        }

        .table th,
        .table td {
            padding: 15px 20px;
            text-align: left;
        }

        .table thead {
            background-color: #ccebf7;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>SmartClass</h2>

        <!-- Dashboard - PAKAI ROUTE -->
        <a href="{{ route('admin.dashboard') }}"
            style="{{ request()->routeIs('admin.dashboard') ? 'background-color: #1A3E78;' : '' }}">
            🏠 Dashboard
        </a>

        <!-- Users - PAKAI ROUTE -->
        <a href="{{ route('admin.users') }}"
            style="{{ request()->routeIs('admin.users*') ? 'background-color: #1A3E78;' : '' }}">
            👥 Users
        </a>

        <!-- Data Kelas - BELUM ADA ROUTE  -->
        <a href="{{ route('admin.data_kelas') }}"
            style="{{ request()->routeIs('admin.data_kelas*') ? 'background-color: #1A3E78;' : '' }}">
            🏫 Data Kelas
        </a>

        <!-- Laporan - BELUM ADA ROUTE  -->
        <a href="{{ route('admin.laporan') }}"
            style="{{ request()->routeIs('admin.laporan') ? 'background-color: #1A3E78;' : '' }}">
            📊 Laporan
        </a>

       <!-- Pembayaran -->
        <a href="{{ route('admin.pembayarans.index') }}"
            style="{{ request()->routeIs('admin.pembayarans*') ? 'background-color: #1A3E78;' : '' }}">
            💳 Pembayaran
        </a>


        <!-- Settings - BELUM ADA ROUTE  -->
        <a href="#">⚙️ Settings</a>

        <div class="logout-section">
            <a href="#" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="main">
        <div class="header">
            <div class="header-left">
                <h2>Dashoard Admin</h2>
            </div>
            <div class="header-right">
                <p>Hello, Admin</p>
                <div class="avatar">AD</div>
            </div>
        </div>

        @yield('content')
    </div>

    
</body>
</html>