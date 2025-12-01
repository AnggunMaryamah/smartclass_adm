@extends('layouts.guru')

@section('title', 'Detail Kelas - ' . $kelas->nama_kelas)

@section('content')
    <div class="detail-kelas-container">
        {{-- Header --}}
        <div class="detail-header">
            <a href="{{ route('guru.kelas.index') }}" class="btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                Kembali
            </a>
            <h2 class="page-title">📚 Detail Kelas</h2>
        </div>

        {{-- Stats Cards --}}
        <div class="stats-grid">
            <div class="stat-card stat-primary">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $totalSiswa ?? 0 }}</div>
                    <div class="stat-label">Total Siswa</div>
                </div>
            </div>

            <div class="stat-card stat-success">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $totalMateri ?? 0 }}</div>
                    <div class="stat-label">Materi Tersedia</div>
                </div>
            </div>
        </div>

        {{-- Info Kelas --}}
        <div class="info-section">
            <h3 class="section-title">Informasi Kelas</h3>
            <div class="info-grid">
                <div class="info-item">
                    <label>Nama Kelas</label>
                    <p>{{ $kelas->nama_kelas }}</p>
                </div>
                <div class="info-item">
                    <label>Jenjang</label>
                    <span class="badge badge-{{ strtolower($kelas->jenjang_pendidikan) }}">
                        {{ strtoupper($kelas->jenjang_pendidikan) }}
                    </span>
                </div>
                <div class="info-item full-width">
                    <label>Deskripsi</label>
                    <p>{{ $kelas->deskripsi ?? '-' }}</p>
                </div>
                <div class="info-item">
                    <label>Harga</label>
                    <p class="price">Rp {{ number_format($kelas->harga, 0, ',', '.') }}</p>
                </div>
                <div class="info-item">
                    <label>Durasi</label>
                    <p>{{ $kelas->durasi }}</p>
                </div>
                <div class="info-item full-width">
                    <label>Jadwal</label>
                    <p>{{ $kelas->jadwal_kelas ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Daftar Siswa --}}
        <div class="siswa-section">
            <h3 class="section-title">👥 Daftar Siswa</h3>

            @if (isset($siswas) && $siswas->count() > 0)
                <div class="siswa-grid">
                    @foreach ($siswas as $index => $siswa)
                        <div class="siswa-card">
                            <div class="siswa-avatar">
                                {{ strtoupper(substr($siswa->nama ?? 'SS', 0, 2)) }}
                            </div>
                            <div class="siswa-info">
                                <div class="siswa-nama">{{ $siswa->nama_lengkap ?? 'Nama Siswa' }}</div>
                                <div class="siswa-email">{{ $siswa->email ?? '-' }}</div>
                                @if (isset($siswa->no_hp) && $siswa->no_hp_orangtua)
                                    <div class="siswa-telp">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                            </path>
                                        </svg>
                                        {{ $siswa->no_hp }}
                                    </div>
                                @endif
                            </div>

                            <div class="siswa-number">{{ $index + 1 }}</div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <p>Belum ada siswa yang terdaftar</p>
                </div>
            @endif
        </div>
    </div>

    <style>
        :root {
            --primary: #0EA5E9;
            --success: #10B981;
            --text-dark: #1F2937;
            --text-light: #6B7280;
            --border: #E5E7EB;
            --bg-light: #F9FAFB;
        }

        .detail-kelas-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header */
        .detail-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-light);
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-back:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-primary .stat-icon {
            background: #EFF6FF;
            color: var(--primary);
        }

        .stat-success .stat-icon {
            background: #F0FDF4;
            color: var(--success);
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 0.8125rem;
            color: var(--text-light);
            font-weight: 500;
        }

        /* Info Section */
        .info-section,
        .siswa-section {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 0 18px 0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .info-item label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .info-item p {
            font-size: 0.9375rem;
            color: var(--text-dark);
            margin: 0;
            line-height: 1.5;
        }

        .info-item .price {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--success);
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8125rem;
            width: fit-content;
        }

        .badge-sd {
            background: #DBEAFE;
            color: #1E40AF;
        }

        .badge-smp {
            background: #D1FAE5;
            color: #065F46;
        }

        .badge-sma {
            background: #FEF3C7;
            color: #92400E;
        }

        /* Siswa Grid */
        .siswa-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 12px;
        }

        .siswa-card {
            background: var(--bg-light);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            transition: all 0.2s;
        }

        .siswa-card:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.1);
        }

        .siswa-avatar {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--primary), #06B6D4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.875rem;
            flex-shrink: 0;
        }

        .siswa-info {
            flex: 1;
            min-width: 0;
        }

        .siswa-nama {
            font-size: 0.9375rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 3px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .siswa-email {
            font-size: 0.8125rem;
            color: var(--text-light);
            margin-bottom: 3px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .siswa-telp {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.75rem;
            color: var(--text-light);
        }

        .siswa-number {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 24px;
            height: 24px;
            background: var(--primary);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.75rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-state svg {
            color: #D1D5DB;
            margin-bottom: 12px;
        }

        .empty-state p {
            font-size: 0.9375rem;
            color: var(--text-light);
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .detail-kelas-container {
                padding: 16px;
            }

            .page-title {
                font-size: 1.25rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .siswa-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .detail-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .siswa-nama {
                font-size: 0.875rem;
            }
        }
    </style>
@endsection
