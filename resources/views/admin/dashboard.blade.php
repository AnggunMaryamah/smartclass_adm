@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    .admin-dashboard-container {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* GRID KARTU 4 → 2 */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
    }

    @media (max-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    .stat-card {
        background: var(--bg-card);
        border-radius: 16px;
        padding: 18px 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-light);
        display: flex;
        flex-direction: column;
        gap: 6px;
        position: relative;
        overflow: hidden;
    }

    .stat-card::after {
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top right, rgba(14,165,233,0.12), transparent 55%);
        pointer-events: none;
    }

    .stat-label {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 800;
        color: var(--text-primary);
        letter-spacing: 0.02em;
    }

    .stat-chip {
        align-self: flex-start;
        margin-top: 4px;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
        background: var(--bg-subtle);
        color: var(--text-secondary);
    }

    .stat-icon {
        width: 34px;
        height: 34px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
        margin-right: 6px;
    }

    .icon-blue   { background: linear-gradient(135deg,#0EA5E9,#0284C7); }
    .icon-green  { background: linear-gradient(135deg,#22C55E,#16A34A); }
    .icon-cyan   { background: linear-gradient(135deg,#22D3EE,#06B6D4); }
    .icon-amber  { background: linear-gradient(135deg,#FBBF24,#F59E0B); }

    .stat-label span.icon-wrap {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* CARD TABEL PEMESANAN */
    .card-table-wrapper {
        background: var(--bg-card);
        border-radius: 18px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-light);
        padding: 18px 20px 8px 20px;
    }

    .card-table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
        flex-wrap: wrap;
    }

    .card-table-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .card-table-title span.emoji {
        font-size: 20px;
    }

    .filter-jenjang-label {
        font-size: 13px;
        color: var(--text-muted);
        font-weight: 500;
    }

    .filter-jenjang-select {
        padding: 8px 32px 8px 12px;
        border-radius: 10px;
        border: 2px solid var(--border-light);
        font-size: 13px;
        font-family: 'Inter',sans-serif;
        cursor: pointer;
        background: #FFFFFF;
        color: var(--text-primary);
        outline: none;
        transition: all 0.2s ease;
        appearance: none;
        position: relative;
    }

    .filter-jenjang-wrapper {
        position: relative;
        display: inline-flex;
        align-items: center;
    }

    .filter-jenjang-wrapper::after {
        content: '\f078';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        right: 10px;
        pointer-events: none;
        font-size: 10px;
        color: var(--text-secondary);
    }

    .filter-jenjang-select:hover {
        border-color: var(--accent-cyan);
        box-shadow: 0 0 0 3px var(--accent-cyan-tint);
    }

    .orders-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .orders-table thead {
        background: #E2F3FF;
    }

    .orders-table th,
    .orders-table td {
        padding: 12px 14px;
        text-align: left;
    }

    .orders-table th {
        font-weight: 600;
        color: var(--text-secondary);
        border-bottom: 1px solid var(--border-light);
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .orders-table tbody tr:nth-child(even) {
        background: #F8FAFC;
    }

    .orders-table tbody tr:hover {
        background: #EEF6FF;
    }

    .badge-jenjang {
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
    }

    .badge-status {
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
    }

    .empty-row {
        text-align: center;
        color: #9CA3AF;
        padding: 26px 14px;
        font-size: 13px;
    }

    @media (max-width: 768px) {
        .card-table-header {
            align-items: flex-start;
        }
    }
</style>

<div class="admin-dashboard-container">
    {{-- GRID 4 KARTU STATISTIK --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">
                <span class="icon-wrap">
                    <span class="stat-icon icon-blue">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </span>
                </span>
                <span>Total Guru</span>
            </div>
            <div class="stat-value">{{ $totalGuru }}</div>
            <div class="stat-chip">Akun guru terdaftar</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">
                <span class="icon-wrap">
                    <span class="stat-icon icon-green">
                        <i class="fas fa-user-graduate"></i>
                    </span>
                </span>
                <span>Total Siswa</span>
            </div>
            <div class="stat-value">{{ $totalSiswa }}</div>
            <div class="stat-chip">Siswa aktif di SmartClass</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">
                <span class="icon-wrap">
                    <span class="stat-icon icon-cyan">
                        <i class="fas fa-layer-group"></i>
                    </span>
                </span>
                <span>Kelas Aktif</span>
            </div>
            <div class="stat-value">{{ $kelasAktif }}</div>
            <div class="stat-chip">Kelas yang sedang berjalan</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">
                <span class="icon-wrap">
                    <span class="stat-icon icon-amber">
                        <i class="fas fa-wallet"></i>
                    </span>
                </span>
                <span>Transaksi</span>
            </div>
            <div class="stat-value">Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</div>
            <div class="stat-chip">Total nominal semua transaksi</div>
        </div>
    </div>

    {{-- TABEL PEMESANAN KELAS --}}
    <div class="card-table-wrapper">
        <div class="card-table-header">
            <div class="card-table-title">
                <span class="emoji">📋</span>
                <span>Data Pemesanan Kelas</span>
            </div>

            <div style="display:flex; align-items:center; gap:10px;">
                <span class="filter-jenjang-label">Filter Jenjang:</span>
                <div class="filter-jenjang-wrapper">
                    <select id="filterJenjang" onchange="applyFilterJenjang()"
                            class="filter-jenjang-select">
                        <option value="semua" {{ $filterJenjang == 'semua' ? 'selected' : '' }}>🌐 Semua</option>
                        <option value="sd" {{ $filterJenjang == 'sd' ? 'selected' : '' }}>🎒 SD</option>
                        <option value="smp" {{ $filterJenjang == 'smp' ? 'selected' : '' }}>📚 SMP</option>
                        <option value="sma" {{ $filterJenjang == 'sma' ? 'selected' : '' }}>🎓 SMA</option>
                    </select>
                </div>
            </div>
        </div>

        <table class="orders-table">
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
                        @php
                            $jenjang = $pemesanan->jenjang_pendidikan;
                            $bgJenjang = '#E3F2FD';
                            $colorJenjang = '#1976D2';
                            if ($jenjang === 'SMP') {
                                $bgJenjang = '#E8F5E9';
                                $colorJenjang = '#388E3C';
                            } elseif ($jenjang === 'SMA') {
                                $bgJenjang = '#FFF3E0';
                                $colorJenjang = '#F57C00';
                            }
                        @endphp
                        <span class="badge-jenjang"
                              style="background: {{ $bgJenjang }}; color: {{ $colorJenjang }};">
                            {{ $jenjang }}
                        </span>
                    </td>
                    <td>
                        @php
                            $isBooking = $pemesanan->status_pemesanan === 'booking';
                            $bgStatus = $isBooking ? '#D1FAE5' : '#FEE2E2';
                            $colorStatus = $isBooking ? '#059669' : '#DC2626';
                        @endphp
                        <span class="badge-status"
                              style="background: {{ $bgStatus }}; color: {{ $colorStatus }};">
                            {{ ucfirst($pemesanan->status_pemesanan) }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($pemesanan->created_at)->format('d M Y, H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-row">
                        Tidak ada pemesanan untuk filter ini
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function applyFilterJenjang() {
        const jenjang = document.getElementById('filterJenjang').value;
        window.location.href = '{{ route("admin.dashboard") }}?jenjang=' + jenjang;
    }
</script>
@endsection