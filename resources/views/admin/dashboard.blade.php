@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<!-- Statistics Cards - 4 Card Utama -->
<div class="stats-container">
    <div class="stat-card stat-blue">
        <h4>Total Guru</h4>
        <h2>{{ $totalGuru }}</h2>
    </div>
    <div class="stat-card stat-cyan">
        <h4>Total Siswa</h4>
        <h2>{{ $totalSiswa }}</h2>
    </div>
    <div class="stat-card stat-lightblue">
        <h4>Kelas Aktif</h4>
        <h2>{{ $kelasAktif }}</h2>
    </div>
    <div class="stat-card stat-yellow">
        <h4>Transaksi</h4>
        <h2>Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</h2>
    </div>
</div>

<!-- Mini Stats Pemesanan Per Jenjang -->
<div class="mini-stats-container">
    <div class="mini-stat mini-blue">
        <div class="mini-icon">🎒</div>
        <div class="mini-content">
            <h3>{{ $statSD }}</h3>
            <p>Pemesanan SD</p>
        </div>
    </div>
    
    <div class="mini-stat mini-green">
        <div class="mini-icon">📚</div>
        <div class="mini-content">
            <h3>{{ $statSMP }}</h3>
            <p>Pemesanan SMP</p>
        </div>
    </div>
    
    <div class="mini-stat mini-orange">
        <div class="mini-icon">🎓</div>
        <div class="mini-content">
            <h3>{{ $statSMA }}</h3>
            <p>Pemesanan SMA</p>
        </div>
    </div>
</div>

<!-- Tabel Pemesanan dengan Filter Jenjang -->
<div class="table-container">
    <div class="table-header">
        <h3>📋 Data Pemesanan Kelas</h3>
        <div class="filter-group">
            <label>Filter Jenjang:</label>
            <select id="filterJenjang" onchange="applyFilter()">
                <option value="semua" {{ $filterJenjang == 'semua' ? 'selected' : '' }}>🌐 Semua</option>
                <option value="sd" {{ $filterJenjang == 'sd' ? 'selected' : '' }}>🎒 SD</option>
                <option value="smp" {{ $filterJenjang == 'smp' ? 'selected' : '' }}>📚 SMP</option>
                <option value="sma" {{ $filterJenjang == 'sma' ? 'selected' : '' }}>🎓 SMA</option>
            </select>
        </div>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Jenjang</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemesananList as $index => $pemesanan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pemesanan->nama_siswa }}</td>
                    <td>{{ $pemesanan->nama_kelas }}</td>
                    <td>
                        <span class="badge 
                            @if($pemesanan->jenjang_pendidikan == 'SD') badge-blue
                            @elseif($pemesanan->jenjang_pendidikan == 'SMP') badge-green
                            @else badge-orange
                            @endif">
                            {{ $pemesanan->jenjang_pendidikan }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $pemesanan->status_pemesanan == 'booking' ? 'badge-success' : 'badge-danger' }}">
                            {{ ucfirst($pemesanan->status_pemesanan) }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($pemesanan->created_at)->format('d M Y, H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="no-data">Tidak ada pemesanan untuk filter ini</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
function applyFilter() {
    const jenjang = document.getElementById('filterJenjang').value;
    window.location.href = '{{ route("admin.dashboard") }}?jenjang=' + jenjang;
}
</script>
@endsection
