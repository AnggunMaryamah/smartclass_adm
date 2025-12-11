@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')
    <div class="dashboard-container">
        {{-- Welcome Banner --}}
        <div class="welcome-banner-rainbow">
            <div class="welcome-content">
                <h2>Selamat Datang, {{ optional(Auth::user())->name ?? 'Guru' }}! 👋</h2>
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
                    <p class="stat-number">{{ $totalKelas }}</p>
                    <p class="stat-label">kelas aktif</p>
                </div>
                <a href="{{ route('guru.kelas.index') }}" class="stat-link">
                    <span>Lihat Detail</span>
                    <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            {{-- Siswa Aktif --}}
            <div class="stat-card stat-green">
                <div class="stat-content">
                    <h3>SISWA SAYA</h3>
                    <p class="stat-number">{{ $totalSiswa }}</p>
                    <p class="stat-label">siswa aktif</p>
                </div>
                <a href="{{ route('guru.siswa.index') }}" class="stat-link">
                    <span>Lihat Detail</span>
                    <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            {{-- Laporan Siswa --}}
            <div class="stat-card stat-teal">
                <div class="stat-content">
                    <h3>LAPORAN SISWA</h3>
                    <p class="stat-number">{{ $jumlahLaporan }}</p>
                    <p class="stat-label">laporan baru</p>
                </div>
                <a href="{{ route('guru.laporan_siswa.index') }}" class="stat-link">
                    <span>Lihat Detail</span>
                    <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
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
                    <span>Lihat Detail</span>
                    <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Grafik & Aktivitas Sejajar --}}
        <div class="chart-section-equal">
            {{-- KIRI: Grafik Aktivitas Siswa Bulanan --}}
            <div class="chart-card-glass">
                <div class="chart-header">
                    <h3>📊 Aktivitas Siswa Bulanan</h3>
                    <p class="chart-subtitle">Jumlah siswa yang bergabung per bulan</p>
                </div>
                <div class="chart-body">
                    <canvas id="guruChart"></canvas>
                </div>
            </div>

            {{-- KANAN: Aktivitas Terbaru --}}
            <div class="chart-card-glass">
                <div class="chart-header">
                    <h3>🕐 Aktivitas Terbaru</h3>
                    <p class="chart-subtitle">Aktivitas kelas dan siswa terkini</p>
                </div>
                <div class="activity-list">
                    @if(isset($aktivitasTerbaru) && count($aktivitasTerbaru) > 0)
                        @foreach($aktivitasTerbaru as $aktivitas)
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-{{ $aktivitas['icon'] ?? 'circle' }}"></i>
                            </div>
                            <div class="activity-content">
                                <h5>{{ $aktivitas['title'] ?? 'Aktivitas' }}</h5>
                                <p>{{ $aktivitas['description'] ?? '-' }}</p>
                                <span class="activity-time">{{ $aktivitas['time'] ?? '' }}</span>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="empty-state-small">
                            <div class="empty-icon-small">📦</div>
                            <h4>Belum Ada Aktivitas</h4>
                            <p>Aktivitas kelas dan siswa akan muncul di sini</p>
                        </div>
                    @endif
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

        /* Garis Warna di KIRI */
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

        /* Tombol Lihat Detail - TANPA BACKGROUND, HANYA IKON YANG GESER */
        .stat-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 14px;
            padding: 0;
            background: transparent;
            border: none;
            font-size: 0.85rem;
            font-weight: 600;
            color: currentColor;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .stat-link:hover {
            color: currentColor;
        }

        .arrow-icon {
            width: 16px;
            height: 16px;
            transition: transform 0.3s ease;
        }

        .stat-link:hover .arrow-icon {
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

        /* Charts & Activity Sejajar */
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
            display: flex;
            flex-direction: column;
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
            margin: 0 0 4px 0;
        }

        .chart-subtitle {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin: 0;
        }

        .chart-body {
            position: relative;
            height: 320px;
            flex: 1;
        }

        .chart-body canvas {
            max-height: 320px !important;
        }

        /* Activity List */
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
            max-height: 320px;
            overflow-y: auto;
            padding-right: 6px;
        }

        .activity-list::-webkit-scrollbar {
            width: 6px;
        }

        .activity-list::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.03);
            border-radius: 10px;
        }

        .activity-list::-webkit-scrollbar-thumb {
            background: rgba(14, 165, 233, 0.3);
            border-radius: 10px;
        }

        .activity-list::-webkit-scrollbar-thumb:hover {
            background: rgba(14, 165, 233, 0.5);
        }

        .activity-item {
            display: flex;
            gap: 14px;
            padding: 14px;
            background: rgba(14, 165, 233, 0.03);
            border-radius: var(--radius-md);
            border-left: 3px solid var(--sky-blue);
            transition: all 0.2s ease;
        }

        .activity-item:hover {
            background: rgba(14, 165, 233, 0.08);
            transform: translateX(4px);
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--sky-blue), var(--cyan));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .activity-content {
            flex: 1;
        }

        .activity-content h5 {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0 0 4px 0;
        }

        .activity-content p {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin: 0 0 6px 0;
            line-height: 1.4;
        }

        .activity-time {
            font-size: 0.7rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        /* Empty State Small */
        .empty-state-small {
            text-align: center;
            padding: 50px 20px;
        }

        .empty-icon-small {
            font-size: 2.5rem;
            margin-bottom: 12px;
            opacity: 0.6;
        }

        .empty-state-small h4 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0 0 6px 0;
        }

        .empty-state-small p {
            font-size: 0.85rem;
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
            /* Tetap 2 kolom di mobile untuk card agar sejajar */
            .stats-grid-four {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .stat-number {
                font-size: 2rem;
            }

            .stat-number-small {
                font-size: 1.5rem;
            }

            .chart-card-glass {
                padding: 18px;
            }

            .chart-body {
                height: 260px;
            }

            .chart-body canvas {
                max-height: 260px !important;
            }

            .activity-list {
                max-height: 260px;
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

            .chart-body canvas {
                max-height: 240px !important;
            }

            .activity-list {
                max-height: 240px;
            }
        }
    </style>
@endsection

@section('script')
    <script>
        const ctx = document.getElementById('guruChart');
        if (ctx) {
            // Data REAL dari database (bisa siswa masuk per bulan atau transaksi)
            const chartData = {!! json_encode($chartData ?? [0,0,0,0,0,0,0,0,0,0,0,0]) !!};

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Jumlah Siswa',
                        data: chartData,
                        backgroundColor: 'rgba(14, 165, 233, 0.1)',
                        borderColor: '#0EA5E9',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#0EA5E9',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            padding: 12,
                            borderRadius: 8,
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 13
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            },
                            ticks: {
                                font: {
                                    size: 12
                                },
                                color: '#64748B'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 12
                                },
                                color: '#64748B'
                            }
                        }
                    }
                }
            });
        }
    </script>
@endsection