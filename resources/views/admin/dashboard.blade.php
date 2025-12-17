@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <style>
        :root {
            --sky-blue: #0EA5E9;
            --cyan: #06B6D4;
            --teal: #14B8A6;
            --green: #10B981;
            --amber: #F59E0B;
            --red: #EF4444;
            --text-primary: #0F172A;
            --text-secondary: #64748B;
            --border: #E5E7EB;
        }

        .admin-dashboard-container {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* GRID KARTU STATISTIK */
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
            background: #fff;
            border-radius: 16px;
            padding: 18px 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            gap: 6px;
            position: relative;
            overflow: hidden;
            border-left: 6px solid transparent;
            /* default, akan diberi warna */
        }

        /* Warna border kiri per kartu */
        .stat-card.border-blue {
            border-left-color: #0EA5E9;
        }

        .stat-card.border-green {
            border-left-color: #10B981;
        }

        .stat-card.border-cyan {
            border-left-color: #06B6D4;
        }

        .stat-card.border-amber {
            border-left-color: #F59E0B;
        }

        .stat-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-secondary);
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
            background: #F3F4F6;
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

        .icon-blue {
            background: linear-gradient(135deg, #0EA5E9, #0284C7);
        }

        .icon-green {
            background: linear-gradient(135deg, #22C55E, #16A34A);
        }

        .icon-cyan {
            background: linear-gradient(135deg, #22D3EE, #06B6D4);
        }

        .icon-amber {
            background: linear-gradient(135deg, #FBBF24, #F59E0B);
        }

        /* TABEL PEMESANAN */
        .card-table-wrapper {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border);
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
            border-bottom: 1px solid var(--border);
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
    </style>

    <div class="admin-dashboard-container">
        {{-- GRID KARTU STATISTIK --}}
        <div class="stats-grid">
            <div class="stat-card border-blue">
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

            <div class="stat-card border-green">
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

            <div class="stat-card border-cyan">
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

            <div class="stat-card border-amber">
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
                    <select id="filterJenjang" onchange="applyFilterJenjang()"
                        style="padding:6px 12px; border-radius:8px; border:1px solid #ccc;">
                        <option value="semua" {{ $filterJenjang == 'semua' ? 'selected' : '' }}>Semua</option>
                        <option value="SD" {{ $filterJenjang == 'SD' ? 'selected' : '' }}>SD</option>
                        <option value="SMP" {{ $filterJenjang == 'SMP' ? 'selected' : '' }}>SMP</option>
                        <option value="SMA" {{ $filterJenjang == 'SMA' ? 'selected' : '' }}>SMA</option>
                    </select>
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
                                    $validJenjang = ['SD', 'SMP', 'SMA'];
                                    if (!in_array($jenjang, $validJenjang)) {
                                        $jenjang = null;
                                    }

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
                                @if ($jenjang)
                                    <span class="badge-jenjang"
                                        style="background:{{ $bgJenjang }};color:{{ $colorJenjang }};">
                                        {{ $jenjang }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $isBooking = $pemesanan->status_pemesanan === 'booking';
                                    $bgStatus = $isBooking ? '#D1FAE5' : '#FEE2E2';
                                    $colorStatus = $isBooking ? '#059669' : '#DC2626';
                                @endphp
                                <span class="badge-status"
                                    style="background:{{ $bgStatus }};color:{{ $colorStatus }};">
                                    {{ ucfirst($pemesanan->status_pemesanan) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($pemesanan->created_at)->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-row">Tidak ada pemesanan untuk filter ini</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-table-wrapper" style="margin-top:30px">
        <div class="card-table-header">
            <div class="card-table-title">
                👨‍🏫 Verifikasi Guru
            </div>
        </div>

        <table class="orders-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Mata Pelajaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gurus as $i => $guru)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $guru->nama_lengkap }}</td>
                        <td>{{ $guru->email }}</td>
                        <td>{{ $guru->mata_pelajaran }}</td>
                        <td>
                            @if ($guru->status_akun === 'Nonaktif')
                                <form method="POST" action="{{ route('admin.guru.verifikasi', $guru->id) }}"
                                    onsubmit="return confirm('Verifikasi guru ini?')" style="display:inline">
                                    @csrf
                                    <button type="submit" class="badge-status"
                                        style="
                                        background:#DCFCE7;
                                        color:#166534;
                                        border:none;
                                        cursor:pointer
                                    ">
                                        Verifikasi
                                    </button>
                                </form>
                            @else
                                <span class="badge-status" style="background:#E0F2FE;color:#0369A1">
                                    Aktif
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-row">
                            Belum ada guru mendaftar
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <script>
        function applyFilterJenjang() {
            const jenjang = document.getElementById('filterJenjang').value;
            window.location.href = '{{ route('admin.dashboard') }}?jenjang=' + jenjang;
        }
    </script>
@endsection
