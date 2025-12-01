@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')
    <div class="dashboard-container">
        {{-- Welcome Banner --}}
        <div class="welcome-banner-rainbow">
            <div class="welcome-content">
                <h2>Selamat Datang, {{ optional(Auth::user())->name ?? 'Guru' }}!</h2>
                <p>Pantau aktivitas kelas, laporan, dan transaksi di sini.</p>
            </div>
            <div class="welcome-decoration">
                <div class="deco-circle deco-1"></div>
                <div class="deco-circle deco-2"></div>
                <div class="deco-circle deco-3"></div>
            </div>
        </div>
        {{-- Stats Cards REAL DATA --}}
        <div class="stats-grid-four">
            {{-- Kelas Aktif --}}
            <div class="stat-card stat-blue">
                <div class="stat-content">
                    <h3>KELAS SAYA</h3>
                    <p class="stat-number">{{ $jumlahKelas }}</p>
                    <p class="stat-label">kelas aktif</p>
                </div>
                <a href="{{ route('guru.kelas.index') }}" class="stat-link">
                    Lihat Detail
                    <span class="link-arrow">→</span>
                </a>
            </div>

            {{-- Siswa Aktif --}}
            <div class="stat-card stat-green">
                <div class="stat-content">
                    <h3>SISWA SAYA</h3>
                    <p class="stat-number">{{ $jumlahSiswa }}</p>
                    <p class="stat-label">siswa aktif</p>
                </div>
                <a href="{{ route('guru.siswa.index') }}" class="stat-link">
                    Lihat Detail
                    <span class="link-arrow">→</span>
                </a>
            </div>

            {{-- Laporan Siswa --}}
            <div class="stat-card stat-teal">
                <div class="stat-content">
                    <h3>LAPORAN SISWA</h3>
                    <p class="stat-number">{{ $jumlahLaporan }}</p>
                    <p class="stat-label">laporan baru</p>
                </div>
                <a href="{{ route('guru.laporan.index') }}" class="stat-link">
                    Lihat Detail
                    <span class="link-arrow">→</span>
                </a>
            </div>

            {{-- Pembayaran --}}
            <div class="stat-card stat-orange">
                <div class="stat-content">
                    <h3>PEMBAYARAN</h3>
                    <p class="stat-number-small">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</p>
                    <p class="stat-label">bulan ini</p>
                </div>
                <a href="{{ route('guru.pembayaran.index') }}" class="stat-link">
                    Lihat Detail
                    <span class="link-arrow">→</span>
                </a>
            </div>
        </div>
{{-- Charts --}}
        <div class="chart-section-equal">
            <div class="chart-card-glass">
                <div class="chart-header">
                    <h3>📊 Aktivitas Bulanan</h3>
                </div>
                <div class="chart-body">
                    <canvas id="guruChart"></canvas>
                </div>
            </div>

            <div class="chart-card-glass">
                <div class="chart-header">
                    <h3>🎯 Target Mengajar</h3>
                </div>
                <div class="target-container">
                    <div class="target-circle">
                        <svg viewBox="0 0 36 36">
                            <defs>
                                <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#0EA5E9;stop-opacity:1" />
                                    <stop offset="50%" style="stop-color:#06B6D4;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#14B8A6;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <path class="circle-bg"
                                d="M18 2.0845 a15.9155 15.9155 0 0 1 0 31.831 a15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="circle" stroke-dasharray="{{ $persentaseTarget ?? 0 }}, 100"
                                d="M18 2.0845 a15.9155 15.9155 0 0 1 0 31.831 a15.9155 15.9155 0 0 1 0 -31.831" />
                        </svg>
                        <div class="circle-text">{{ $persentaseTarget ?? 0 }}%</div>
                    </div>
                    <div class="target-info">
                        <h4>Rp {{ number_format($totalTransaksi ?? 0, 0, ',', '.') }}</h4>
                        <p>Pendapatan Bulan ini</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Activity --}}
        <div class="activity-section">
            <h3 class="section-title">
                🕐 Aktivitas Terbaru
            </h3>
            <div class="activity-card-glass">
                <div class="empty-state">
                    <div class="empty-icon">
                        📦
                    </div>
                    <h4>Belum Ada Aktivitas</h4>
                    <p>Aktivitas kelas dan siswa akan muncul di sini</p>
                </div>
            </div>
        </div>
    </div>
    <style>
        :root {
            --sky-blue: #0EA5E9;
            --cyan: #06B6D4;
            --teal: #14B8A6;
            --purple: #A855F7;
            --pink: #EC4899;
            --orange: #F97316;

            --bg-blue: #F0F9FF;
            --bg-cyan: #ECFEFF;
            --bg-teal: #F0FDFA;
            --bg-purple: #FAF5FF;
            --bg-pink: #FDF2F8;
            --bg-orange: #FFF7ED;

            --text-primary: #0F172A;
            --text-secondary: #64748B;

            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
        }

        .dashboard-container {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Welcome Banner */
        .welcome-banner-rainbow {
            background: linear-gradient(135deg,
                    var(--sky-blue) 0%,
                    var(--cyan) 33%,
                    var(--teal) 66%,
                    var(--sky-blue) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-xl);
            padding: 32px;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 24px;
            box-shadow: 0 8px 32px rgba(14, 165, 233, 0.3);
            position: relative;
            overflow: hidden;
        }

        .welcome-decoration {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .deco-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .deco-1 {
            width: 150px;
            height: 150px;
            top: -50px;
            right: 100px;
            animation: float 6s ease-in-out infinite;
        }

        .deco-2 {
            width: 100px;
            height: 100px;
            top: 50%;
            right: -30px;
            animation: float 8s ease-in-out infinite;
        }

        .deco-3 {
            width: 80px;
            height: 80px;
            bottom: -20px;
            right: 200px;
            animation: float 7s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(10deg);
            }
        }

        .welcome-content {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .welcome-content h2 {
            color: white;
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0 0 8px 0;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .welcome-content p {
            color: rgba(255, 255, 255, 0.95);
            font-size: 1rem;
            margin: 0;
        }

        /* Stats Grid */
        .stats-grid-four {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: var(--radius-lg);
            padding: 24px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Garis Warna di KIRI (FIXED) */
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 5px;
            background: currentColor;
            transition: width 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
        }

        .stat-card:hover::before {
            width: 8px;
        }

        .stat-blue {
            color: var(--sky-blue);
            background: linear-gradient(135deg, var(--bg-blue), rgba(255, 255, 255, 0.98));
        }

        .stat-green {
            color: var(--teal);
            background: linear-gradient(135deg, var(--bg-teal), rgba(255, 255, 255, 0.98));
        }

        .stat-teal {
            color: var(--cyan);
            background: linear-gradient(135deg, var(--bg-cyan), rgba(255, 255, 255, 0.98));
        }

        .stat-orange {
            color: var(--orange);
            background: linear-gradient(135deg, var(--bg-orange), rgba(255, 255, 255, 0.98));
        }

        .stat-content {
            flex: 1;
        }

        .stat-content h3 {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-secondary);
            margin: 0 0 12px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0 0 6px 0;
            line-height: 1;
        }

        .stat-number-small {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0 0 6px 0;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin: 0;
        }

        /* Tombol Lihat Detail - TANPA BORDER */
        .stat-link {
            display: inline-flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-top: 16px;
            padding: 10px 18px;
            background: rgba(0, 0, 0, 0.04);
            border: none;
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            font-weight: 600;
            color: currentColor;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        /* Hover: Background Lebih Gelap */
        .stat-link:hover {
            background: rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Active/Click: Sedikit Lebih Gelap */
        .stat-link:active {
            background: rgba(0, 0, 0, 0.1);
            transform: translateY(0);
        }

        /* Focus (Tab Keyboard) */
        .stat-link:focus {
            outline: 2px solid currentColor;
            outline-offset: 2px;
        }

        /* Arrow Animation */
        .link-arrow {
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .stat-link:hover .link-arrow {
            transform: translateX(4px);
        }

        /* Section Title */
        .section-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0 0 18px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Quick Actions */
        .quick-actions-section {
            margin-bottom: 28px;
        }

        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 14px;
        }

        .action-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: var(--radius-md);
            padding: 20px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: currentColor;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .action-card:hover::before {
            transform: scaleY(1);
        }

        .action-blue {
            color: var(--sky-blue);
            background: linear-gradient(135deg, var(--bg-blue), rgba(255, 255, 255, 0.95));
        }

        .action-teal {
            color: var(--teal);
            background: linear-gradient(135deg, var(--bg-teal), rgba(255, 255, 255, 0.95));
        }

        .action-purple {
            color: var(--purple);
            background: linear-gradient(135deg, var(--bg-purple), rgba(255, 255, 255, 0.95));
        }

        .action-pink {
            color: var(--pink);
            background: linear-gradient(135deg, var(--bg-pink), rgba(255, 255, 255, 0.95));
        }

        .action-content h4 {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0 0 6px 0;
        }

        .action-content p {
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin: 0;
        }

        /* Charts */
        .chart-section-equal {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-bottom: 28px;
        }

        .chart-card-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .chart-card-glass:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .chart-header {
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 2px solid rgba(14, 165, 233, 0.1);
        }

        .chart-header h3 {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
        }

        .chart-body {
            position: relative;
            height: 280px;
        }

        .chart-body canvas {
            max-height: 280px !important;
        }

        .target-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
            height: 280px;
        }

        .target-circle {
            position: relative;
            width: 150px;
            height: 150px;
            margin-bottom: 18px;
        }

        .target-circle svg {
            transform: rotate(-90deg);
            width: 100%;
            height: 100%;
        }

        .circle-bg {
            fill: none;
            stroke: rgba(14, 165, 233, 0.1);
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
            font-size: 1.9rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .target-info {
            text-align: center;
        }

        .target-info h4 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0 0 6px 0;
        }

        .target-info p {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin: 0;
        }

        /* Activity */
        .activity-section {
            margin-bottom: 28px;
        }

        .activity-card-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: var(--radius-lg);
            padding: 36px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        }

        .empty-state {
            text-align: center;
            padding: 30px 20px;
        }

        .empty-icon {
            font-size: 3.5rem;
            margin-bottom: 16px;
        }

        .empty-state h4 {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0 0 6px 0;
        }

        .empty-state p {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin: 0;
        }

        /* RESPONSIVE */
        @media (max-width: 1199px) {
            .stats-grid-four {
                grid-template-columns: repeat(2, 1fr);
            }

            .chart-section-equal {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 991px) {
            .welcome-banner-rainbow {
                padding: 24px;
                flex-direction: column;
                text-align: center;
            }

            .welcome-content h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 767px) {
            .stats-grid-four {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .quick-actions-grid {
                grid-template-columns: 1fr;
            }

            .stat-number {
                font-size: 2rem;
            }

            .stat-number-small {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 575px) {
            .stat-card {
                padding: 20px;
            }

            .stat-number {
                font-size: 1.8rem;
            }

            .stat-number-small {
                font-size: 1.3rem;
            }

            .chart-body {
                height: 240px;
            }

            .target-container {
                height: 240px;
            }

            .target-circle {
                width: 130px;
                height: 130px;
            }

            .circle-text {
                font-size: 1.6rem;
            }

            .target-info h4 {
                font-size: 1.4rem;
            }
        }
    </style>
@endsection

@section('script')
    <script>
        const ctx = document.getElementById('guruChart');
        if (ctx) {
            // Data REAL dari database
            const chartData = {!! json_encode($chartData ?? [0, 0, 0, 0, 0, 0]) !!};

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                    datasets: [{
                        label: 'Aktivitas',
                        data: chartData,
                        backgroundColor: [
                            '#1E3A8A',
                            '#2563EB',
                            '#84CC16',
                            '#22C55E',
                            '#14B8A6',
                            '#F97316'
                        ],
                        borderRadius: 8,
                        barThickness: 30
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        // Animasi Circle Progress
        window.addEventListener('load', function() {
            const circle = document.querySelector('.circle');
            if (circle) {
                setTimeout(() => {
                    const dashArray = circle.getAttribute('stroke-dasharray');
                    if (dashArray) {
                        const value = dashArray.split(',')[0];
                        circle.style.strokeDasharray = value + ', 100';
                    }
                }, 300);
            }
        });
    </script>
@endsection
