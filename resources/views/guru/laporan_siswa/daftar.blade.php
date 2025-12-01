@extends('layouts.guru')
@section('title', 'Daftar Siswa')

@section('content')
    <div class="siswa-container">
        {{-- Header --}}
        <div class="siswa-header">
            <div class="header-left">
                <h1 class="page-title">Daftar Siswa</h1>
                <p class="page-subtitle">{{ $kelas->nama_kelas }} • {{ $daftarSiswa->total() }} Siswa</p>
            </div>
            <div class="header-right">
                <a href="{{ route('guru.laporan_siswa.index') }}" class="btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="table-card">
            <div class="table-container">
                <table class="siswa-table">
                    <thead>
                        <tr>
                            <th class="col-no">NO</th>
                            <th class="col-nama">NAMA SISWA</th>
                            <th class="col-email">EMAIL</th>
                            <th class="col-status">STATUS</th>
                            <th class="col-aksi">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($daftarSiswa as $index => $siswa)
                            @php
                                // SESUAIKAN dengan nama kolom di table siswas
                                $detailSiswa = [
                                    'nama' => $siswa->nama_lengkap ?? '-',
                                    'nisn' => $siswa->nisn ?? '-',
                                    'jenis_kelamin' => $siswa->jenis_kelamin ?? '-',
                                    'jenjang' => $siswa->jenjang_pendidikan ?? '-',
                                    'no_hp_siswa' => $siswa->no_hp_siswa ?? '-',
                                    'alamat' => $siswa->alamat ?? '-',
                                    'nama_orangtua' => $siswa->nama_orangtua ?? '-',
                                    'email_orangtua' => $siswa->email_orangtua ?? '-',
                                    'no_hp_orangtua' => $siswa->no_hp_orangtua ?? '-',
                                    'email_siswa' => $siswa->email ?? '-',
                                    'status_akun' => $siswa->status_akun ?? 'Aktif',
                                    'foto' => $siswa->foto_profil ?? '',
                                ];
                            @endphp
                            <tr>
                                {{-- NO --}}
                                <td class="text-center">
                                    <span class="no-text">{{ $daftarSiswa->firstItem() + $index }}</span>
                                </td>

                                {{-- NAMA SISWA --}}
                                <td class="text-center">
                                    <span class="siswa-name">{{ $siswa->nama_lengkap ?? '-' }}</span>
                                </td>

                                {{-- EMAIL --}}
                                <td class="text-center">
                                    <span class="siswa-email">{{ $siswa->email ?? '-' }}</span>
                                </td>

                                {{-- STATUS --}}
                                <td class="text-center">
                                    @php
                                        $statusAkun = $siswa->status_akun ?? 'Aktif';
                                        $statusClass =
                                            strtolower($statusAkun) === 'aktif' ? 'status-aktif' : 'status-nonaktif';
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        <span class="status-dot"></span> {{ ucfirst($statusAkun) }}
                                    </span>
                                </td>

                                {{-- AKSI --}}
                                <td>
                                    <div class="action-buttons">
                                        {{-- Tombol: Lihat detail --}}
                                        <button type="button" class="btn-view" data-detail='@json($detailSiswa, JSON_HEX_APOS | JSON_HEX_QUOT)'
                                            title="Detail Siswa">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="#0EA5E9" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    d="M1 12C2.8 8.7 6.6 6 12 6C17.4 6 21.2 8.7 23 12C21.2 15.3 17.4 18 12 18C6.6 18 2.8 15.3 1 12Z">
                                                </path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </button>

                                        {{-- Tombol: Lihat laporan --}}
                                        <a href="{{ route('guru.laporan_siswa.detail', $siswa->id) }}"
                                            class="btn-secondary-action" title="Lihat Laporan">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <svg class="empty-icon" xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <p class="empty-text">Belum ada siswa</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($daftarSiswa->total() > 0)
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        <span class="pagination-text">
                            Menampilkan {{ $daftarSiswa->firstItem() }} - {{ $daftarSiswa->lastItem() }} dari
                            {{ $daftarSiswa->total() }} siswa
                        </span>
                    </div>

                    <div class="pagination-buttons">
                        {{-- Previous --}}
                        @if ($daftarSiswa->onFirstPage())
                            <button class="page-btn disabled" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="15 18 9 12 15 6"></polyline>
                                </svg>
                            </button>
                        @else
                            <a href="{{ $daftarSiswa->previousPageUrl() }}" class="page-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="15 18 9 12 15 6"></polyline>
                                </svg>
                            </a>
                        @endif

                        {{-- Page Numbers --}}
                        @if ($daftarSiswa->lastPage() > 1)
                            @php
                                $start = max(1, $daftarSiswa->currentPage() - 2);
                                $end = min($daftarSiswa->lastPage(), $daftarSiswa->currentPage() + 2);
                            @endphp

                            @if ($start > 1)
                                <a href="{{ $daftarSiswa->url(1) }}" class="page-number">1</a>
                                @if ($start > 2)
                                    <span class="page-dots">...</span>
                                @endif
                            @endif

                            @for ($page = $start; $page <= $end; $page++)
                                @if ($page == $daftarSiswa->currentPage())
                                    <span class="page-number active">{{ $page }}</span>
                                @else
                                    <a href="{{ $daftarSiswa->url($page) }}" class="page-number">{{ $page }}</a>
                                @endif
                            @endfor

                            @if ($end < $daftarSiswa->lastPage())
                                @if ($end < $daftarSiswa->lastPage() - 1)
                                    <span class="page-dots">...</span>
                                @endif
                                <a href="{{ $daftarSiswa->url($daftarSiswa->lastPage()) }}"
                                    class="page-number">{{ $daftarSiswa->lastPage() }}</a>
                            @endif
                        @else
                            <span class="page-number active">1</span>
                        @endif

                        {{-- Next --}}
                        @if ($daftarSiswa->hasMorePages())
                            <a href="{{ $daftarSiswa->nextPageUrl() }}" class="page-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </a>
                        @else
                            <button class="page-btn disabled" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Modal Detail Siswa (STATUS DI FOTO, CLOSE ICON DI POJOK KANAN ATAS) --}}
    <div id="detailSiswaModal" class="modal">
        <div class="modal-overlay" onclick="closeDetailSiswaModal()"></div>
        <div class="modal-content-custom">
            {{-- Tombol Close (ikon X di pojok kanan atas) --}}
            <button type="button" class="modal-close-icon" onclick="closeDetailSiswaModal()" aria-label="Tutup">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            {{-- Foto Profil dengan Badge Status --}}
            <div class="modal-avatar-wrapper">
                <div class="avatar-container">
                    <img id="detail-foto" src="" alt="Foto Siswa" class="modal-avatar">
                    <span id="detail-status-badge" class="avatar-status-badge aktif">
                        <span class="status-dot-avatar"></span>
                        <span id="detail-status-text">Aktif</span>
                    </span>
                </div>
            </div>

            <h3 class="modal-title" id="detail-nama-title">Detail Siswa</h3>

            <div class="modal-body-custom">
                <div class="detail-columns">
                    {{-- Kolom kiri: Data Siswa --}}
                    <div class="detail-column">
                        <h4 class="section-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="title-icon">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Data Siswa
                        </h4>

                        <div class="detail-row">
                            <span class="detail-label">Nama Siswa</span>
                            <span class="detail-separator">:</span>
                            <span class="detail-value" id="detail-nama">-</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">NISN</span>
                            <span class="detail-separator">:</span>
                            <span class="detail-value" id="detail-nisn">-</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">Jenis Kelamin</span>
                            <span class="detail-separator">:</span>
                            <span class="detail-value" id="detail-jk">-</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">Jenjang</span>
                            <span class="detail-separator">:</span>
                            <span class="detail-value" id="detail-jenjang">-</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">No. HP Siswa</span>
                            <span class="detail-separator">:</span>
                            <span class="detail-value selectable" id="detail-nohp-siswa">-</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">Email Siswa</span>
                            <span class="detail-separator">:</span>
                            <span class="detail-value selectable" id="detail-email-siswa">-</span>
                        </div>

                        <div class="detail-row detail-row-alamat">
                            <span class="detail-label">Alamat</span>
                            <span class="detail-separator">:</span>
                            <span class="detail-value" id="detail-alamat">-</span>
                        </div>
                    </div>

                    {{-- Kolom kanan: Data Ortu --}}
                    <div class="detail-column">
                        <h4 class="section-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="title-icon">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Data Orang Tua / Wali
                        </h4>

                        <div class="detail-row">
                            <span class="detail-label">Nama Ortu</span>
                            <span class="detail-separator">:</span>
                            <span class="detail-value" id="detail-nama-orangtua">-</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">Email Ortu</span>
                            <span class="detail-separator">:</span>
                            <span class="detail-value selectable" id="detail-email-orangtua">-</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">No. HP Ortu</span>
                            <span class="detail-separator">:</span>
                            <span class="detail-value selectable" id="detail-no-hp-orangtua">-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CSS --}}
    <style>
        :root {
            --primary: #0EA5E9;
            --primary-hover: #0284C7;
            --primary-light: #E0F2FE;
            --success: #10B981;
            --success-bg: #D1FAE5;
            --success-border: #A7F3D0;
            --danger: #EF4444;
            --danger-bg: #FEE2E2;
            --danger-border: #FCA5A5;
            --text-primary: #0F172A;
            --text-secondary: #64748B;
            --bg-light: #F8FAFC;
            --border: #E2E8F0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(135deg, #F0F9FF 0%, #FFF 100%);
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        }

        .siswa-container {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 24px;
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .siswa-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header-left .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .header-left .page-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
        }

        .header-right {
            display: flex;
            gap: 12px;
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            font-size: .95rem;
            font-weight: 600;
            border-radius: 10px;
            border: 2px solid var(--border);
            cursor: pointer;
            transition: .3s;
            text-decoration: none;
            background: #fff;
            color: var(--text-secondary);
        }

        .btn-secondary:hover {
            background: var(--bg-light);
            border-color: var(--primary);
            color: var(--primary);
        }

        .table-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, .08);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .table-container {
            overflow-x: auto;
        }

        .siswa-table {
            width: 100%;
            border-collapse: collapse;
        }

        .siswa-table thead {
            background: linear-gradient(135deg, #0EA5E9 0%, #0284C7 100%);
        }

        .siswa-table th {
            padding: 18px 20px;
            text-align: center;
            font-size: .75rem;
            font-weight: 700;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: .5px;
            border-right: 1px solid rgba(255, 255, 255, .2);
        }

        .siswa-table th:last-child {
            border-right: none;
        }

        .siswa-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: .3s;
        }

        .siswa-table tbody tr:hover {
            background: var(--primary-light);
        }

        .siswa-table tbody tr:last-child {
            border-bottom: none;
        }

        .siswa-table tbody td {
            padding: 20px;
            font-size: .95rem;
            color: var(--text-primary);
            vertical-align: middle;
            border-right: 1px solid var(--border);
        }

        .siswa-table tbody td:last-child {
            border-right: none;
        }

        .col-no {
            width: 80px;
        }

        .col-nama {
            width: 30%;
        }

        .col-email {
            width: 30%;
        }

        .col-status {
            width: 15%;
        }

        .col-aksi {
            width: 120px;
            text-align: center;
        }

        .no-text {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .text-center {
            text-align: center;
        }

        .siswa-name {
            font-weight: 600;
            color: var(--text-primary);
            font-size: .95rem;
        }

        .siswa-email {
            color: var(--text-secondary);
            font-size: .875rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: .875rem;
            font-weight: 600;
        }

        .status-aktif {
            background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
            color: #065F46;
            border: 1px solid #6EE7B7;
        }

        .status-nonaktif {
            background: linear-gradient(135deg, #FEE2E2 0%, #FCA5A5 100%);
            color: #991B1B;
            border: 1px solid #F87171;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .status-aktif .status-dot {
            background: #10B981;
        }

        .status-nonaktif .status-dot {
            background: #EF4444;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .5;
            }
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .btn-edit,
        .btn-delete,
        .btn-view,
        .btn-secondary-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: .3s;
            text-decoration: none;
        }

        .btn-view {
            background: var(--primary-light);
            color: var(--primary);
        }

        .btn-view svg,
        .btn-view svg * {
            stroke: #0EA5E9;
            fill: none;
        }

        .btn-view:hover {
            background: var(--primary);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, .3);
        }

        .btn-view:hover svg,
        .btn-view:hover svg * {
            stroke: #ffffff;
        }

        .btn-secondary-action {
            background: #DCFCE7;
            color: #16A34A;
        }

        .btn-secondary-action:hover {
            background: #16A34A;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(22, 163, 74, .3);
        }

        .empty-state {
            padding: 80px 20px !important;
            text-align: center;
        }

        .empty-icon {
            color: #CBD5E1;
            margin-bottom: 16px;
        }

        .empty-text {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            border-top: 1px solid var(--border);
            background: var(--bg-light);
            flex-wrap: wrap;
            gap: 16px;
        }

        .pagination-info {
            display: flex;
            align-items: center;
        }

        .pagination-text {
            color: var(--text-secondary);
            font-size: .875rem;
            font-weight: 500;
        }

        .pagination-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .page-btn,
        .page-number {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-weight: 600;
            font-size: .95rem;
            transition: .3s;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .page-btn {
            background: #fff;
            color: var(--text-secondary);
            border: 2px solid var(--border);
        }

        .page-btn:not(.disabled):hover {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, .3);
        }

        .page-btn.disabled {
            background: var(--bg-light);
            color: #CBD5E1;
            border-color: var(--border);
            cursor: not-allowed;
            opacity: .5;
        }

        .page-number {
            background: #fff;
            color: var(--text-secondary);
            border: 2px solid var(--border);
        }

        .page-number:hover {
            background: var(--primary-light);
            color: var(--primary);
            border-color: var(--primary);
        }

        .page-number.active {
            background: linear-gradient(135deg, #0EA5E9, #0284C7);
            color: #fff;
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(14, 165, 233, .3);
        }

        .page-dots {
            color: var(--text-secondary);
            padding: 0 8px;
            font-weight: 700;
        }

        /* MODAL */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, .6);
            backdrop-filter: blur(4px);
        }

        .modal-content-custom {
            position: relative;
            background: #fff;
            border-radius: 24px;
            padding: 32px 32px 28px;
            max-width: 800px;
            width: 92%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 24px 70px rgba(15, 23, 42, .45);
            animation: scaleUp .3s ease;
        }

        @keyframes scaleUp {
            from {
                transform: scale(.9);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal-close-icon {
            position: absolute;
            top: 14px;
            right: 16px;
            width: 32px;
            height: 32px;
            border-radius: 999px;
            border: none;
            background: rgba(15, 23, 42, 0.04);
            color: var(--text-secondary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: .2s;
        }

        .modal-close-icon:hover {
            background: rgba(15, 23, 42, 0.08);
            transform: translateY(-1px);
        }

        .modal-avatar-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 12px;
            margin-bottom: 16px;
        }

        .avatar-container {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;

            /* kunci bentuk lingkaran */
            width: 110px;
            height: 110px;
            border-radius: 50%;
            overflow: hidden;

            /* style lingkaran */
            background: linear-gradient(135deg, #E5F3FF 0%, #C7E7FF 100%);
            border: 4px solid #fff;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .25);
        }

        /* gambar isi penuh ke dalam lingkaran */
        .modal-avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            /* backup kalau ada style global img */
            display: block;
        }


        .avatar-status-badge {
            position: absolute;
            bottom: 4px;
            right: -2px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .03em;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
            border: 2px solid #fff;
        }

        .avatar-status-badge.aktif {
            background: linear-gradient(135deg, #10B981, #059669);
            color: #fff;
        }

        .avatar-status-badge.nonaktif {
            background: linear-gradient(135deg, #EF4444, #DC2626);
            color: #fff;
        }

        .status-dot-avatar {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #fff;
            animation: pulse 2s infinite;
        }

        .modal-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-primary);
            text-align: center;
            margin-bottom: 24px;
        }

        .modal-body-custom {
            margin-bottom: 8px;
        }

        .detail-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
        }

        .section-title {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: .04em;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--primary-light);
        }

        .title-icon {
            color: var(--primary);
        }

        .detail-row {
            display: grid;
            grid-template-columns: 140px 10px 1fr;
            align-items: center;
            gap: 6px;
            margin-bottom: 10px;
            font-size: .95rem;
            padding: 6px 0;
        }

        .detail-row-alamat {
            align-items: flex-start;
        }

        .detail-label {
            font-weight: 600;
            color: var(--text-secondary);
        }

        .detail-separator {
            text-align: center;
            color: var(--text-secondary);
        }

        .detail-value {
            color: var(--text-primary);
            font-weight: 500;
        }

        .selectable {
            user-select: text;
            cursor: text;
        }

        @media (max-width: 768px) {
            .siswa-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-right {
                width: 100%;
            }

            .col-no {
                width: 60px;
            }

            .pagination-wrapper {
                flex-direction: column;
                gap: 12px;
            }

            .pagination-buttons {
                flex-wrap: wrap;
                justify-content: center;
            }

            .detail-row {
                grid-template-columns: 130px 10px 1fr;
            }

            .detail-columns {
                grid-template-columns: 1fr;
                gap: 24px;
            }
        }

        @media (max-width: 480px) {
            .btn-secondary {
                padding: 10px 16px;
                font-size: .875rem;
            }

            .page-btn,
            .page-number {
                width: 36px;
                height: 36px;
                font-size: .875rem;
            }

            .detail-row {
                grid-template-columns: 120px 10px 1fr;
            }

            .modal-content-custom {
                padding: 28px 20px 20px;
            }

            .modal-avatar {
                width: 90px;
                height: 90px;
            }

            .avatar-status-badge {
                font-size: .65rem;
                padding: 5px 10px;
            }
        }
    </style>

    <script>
        const defaultFoto = "{{ asset('images/default-profile.png') }}";

        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-view');
            if (!btn) return;

            try {
                const raw = btn.getAttribute('data-detail') || "{}";
                const data = JSON.parse(raw);
                openDetailSiswaModal(data);
            } catch (err) {
                console.error('Detail Siswa JSON invalid:', err);
            }
        });

        function openDetailSiswaModal(data) {
            const modal = document.getElementById('detailSiswaModal');

            // Foto profil
            const fotoEl = document.getElementById('detail-foto');
            if (data.foto && data.foto !== "") {
                const baseStorage = "{{ asset('storage') }}/";
                fotoEl.src = String(data.foto).startsWith("http") ?
                    data.foto :
                    baseStorage + data.foto;
            } else {
                fotoEl.src = defaultFoto;
            }

            // Status badge di foto
            const statusBadge = document.getElementById('detail-status-badge');
            const statusText = document.getElementById('detail-status-text');
            const statusAkun = (data.status_akun || 'Aktif').toLowerCase();

            if (statusAkun === 'aktif') {
                statusBadge.classList.remove('nonaktif');
                statusBadge.classList.add('aktif');
                statusText.textContent = 'Aktif';
            } else {
                statusBadge.classList.remove('aktif');
                statusBadge.classList.add('nonaktif');
                statusText.textContent = 'Nonaktif';
            }

            // Judul modal
            document.getElementById('detail-nama-title').textContent = data.nama || "Detail Siswa";

            // Data Siswa
            document.getElementById('detail-nama').textContent = data.nama || "-";
            document.getElementById('detail-nisn').textContent = data.nisn || "-";
            document.getElementById('detail-jk').textContent = data.jenis_kelamin || "-";
            document.getElementById('detail-jenjang').textContent = data.jenjang || "-";
            document.getElementById('detail-nohp-siswa').textContent = data.no_hp_siswa || "-";
            document.getElementById('detail-email-siswa').textContent = data.email_siswa || "-";
            document.getElementById('detail-alamat').textContent = data.alamat || "-";

            // Data Ortu
            document.getElementById('detail-nama-orangtua').textContent = data.nama_orangtua || "-";
            document.getElementById('detail-email-orangtua').textContent = data.email_orangtua || "-";
            document.getElementById('detail-no-hp-orangtua').textContent = data.no_hp_orangtua || "-";

            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeDetailSiswaModal() {
            const modal = document.getElementById('detailSiswaModal');
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetailSiswaModal();
            }
        });
    </script>
@endsection
