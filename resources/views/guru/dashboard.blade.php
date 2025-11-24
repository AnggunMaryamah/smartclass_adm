@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')
<!-- Welcome Header -->
<div class="dashboard-header">
    <img src="https://cdn-icons-png.flaticon.com/512/201/201623.png" alt="Guru" class="welcome-icon">
    <div class="welcome-text">
        <h2>Selamat Datang, Guru!</h2>
        <p>Pantau aktivitas kelas, laporan, dan transaksi di sini.</p>
    </div>
</div>

<!-- Statistics Cards - 4 Kolom dengan ICON -->
<div class="cards">
    <div class="card card-blue">
        <div class="card-icon"><i class="ti-book"></i></div>
        <h3>Kelas Saya</h3>
        <p>{{ $jumlahKelas }} kelas aktif</p>
        <div class="progress"><div class="bar" style="width: {{ $progressKelas }}%;"></div></div>
    </div>

    <div class="card card-cyan">
        <div class="card-icon"><i class="ti-user"></i></div>
        <h3>Siswa Saya</h3>
        <p>{{ $jumlahSiswa }} siswa aktif</p>
        <div class="progress"><div class="bar" style="width: {{ $progressSiswa }}%;"></div></div>
    </div>

    <div class="card card-yellow">
        <div class="card-icon"><i class="ti-bar-chart"></i></div>
        <h3>Laporan Siswa</h3>
        <p>{{ $laporanBaru }} laporan baru</p>
        <div class="progress"><div class="bar" style="width: {{ $progressLaporan }}%;"></div></div>
    </div>

    <div class="card card-purple">
        <div class="card-icon"><i class="ti-credit-card"></i></div>
        <h3>Transaksi Saya</h3>
        <p>Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</p>
        <div class="progress"><div class="bar" style="width: {{ $progressTransaksi }}%;"></div></div>
    </div>
</div>

<!-- Charts Section -->
<div class="chart-section">
    <div class="chart-card">
        <h3>Aktivitas Bulanan</h3>
        <canvas id="guruChart" height="100"></canvas>
    </div>

    <div class="chart-card">
        <h3>Target Mengajar</h3>
        <div class="target-container">
            <div class="target-circle">
                <svg viewBox="0 0 36 36">
                    <defs>
                        <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#0077B6;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#00B4D8;stop-opacity:1" />
                        </linearGradient>
                    </defs>
                    <path class="circle-bg" 
                        d="M18 2.0845 a15.9155 15.9155 0 0 1 0 31.831 a15.9155 15.9155 0 0 1 0 -31.831" />
                    <path class="circle" stroke-dasharray="{{ $persentaseTarget }}, 100"
                        d="M18 2.0845 a15.9155 15.9155 0 0 1 0 31.831 a15.9155 15.9155 0 0 1 0 -31.831" />
                </svg>
                <div class="circle-text">{{ $persentaseTarget }}%</div>
            </div>
            <div class="target-info">
                <h4>Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</h4>
                <p>Pendapatan Bulan ini</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
// Chart Aktivitas Bulanan - DATA DINAMIS DARI CONTROLLER
const ctx = document.getElementById('guruChart');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [{
            label: 'Laporan Dibuat',
            data: [
                @foreach($aktivitasBulanan as $data)
                    {{ $data['total'] }},
                @endforeach
            ],
            backgroundColor: '#0077B6',
            borderRadius: 8,
            barThickness: 35
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: '#f5f5f5' }
            },
            x: {
                grid: { display: false }
            }
        }
    }
});

// Animasi Target Circle
window.addEventListener('load', function() {
    const circle = document.querySelector('.circle');
    setTimeout(() => {
        circle.style.transition = 'stroke-dasharray 1.5s ease-in-out';
        circle.style.strokeDasharray = '{{ $persentaseTarget }}, 100';
    }, 300);
});
</script>
@endsection
