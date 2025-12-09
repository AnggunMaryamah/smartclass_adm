@extends('layouts.guru')

@section('title', 'Siswa Saya')

@section('content')
<div class="gs-container">
    {{-- Header --}}
    <div class="gs-header">
        <div>
            <h2 class="gs-title">Siswa Saya</h2>
            <p class="gs-subtitle">Daftar semua siswa dari kelas yang Anda ampu</p>
        </div>
    </div>

    {{-- Stats --}}
    <div class="gs-stats-row">
        <div class="gs-stat gs-stat-blue">
            <div class="gs-stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <div>
                <p class="gs-stat-label">Total Siswa</p>
                <h3 class="gs-stat-value">{{ $totalSiswa ?? 0 }}</h3>
            </div>
        </div>

        <div class="gs-stat gs-stat-green">
            <div class="gs-stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="gs-stat-label">Siswa Aktif</p>
                <h3 class="gs-stat-value">{{ $siswaAktif ?? 0 }}</h3>
            </div>
        </div>

        <div class="gs-stat gs-stat-orange">
            <div class="gs-stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div>
                <p class="gs-stat-label">Total Kelas</p>
                <h3 class="gs-stat-value">{{ $totalKelas ?? 0 }}</h3>
            </div>
        </div>
    </div>

    {{-- Tabel Siswa --}}
    <div class="gs-table-card">
        @if(isset($daftarSiswa) && $daftarSiswa->count() > 0)
            <div class="gs-table-responsive">
                <table class="gs-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th class="hide-mobile">Email</th>
                            <th>Kelas</th>
                            <th class="hide-mobile">Jenjang</th>
                            <th class="hide-mobile">Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($daftarSiswa as $index => $siswa)
                        @php
                            $detailSiswa = [
                                'nama'            => $siswa->nama_lengkap ?? '-',
                                'nisn'            => $siswa->nisn ?? '-',
                                'jenis_kelamin'   => $siswa->jenis_kelamin ?? '-',
                                'jenjang'         => $siswa->kelas->isNotEmpty() ? $siswa->kelas->first()->jenjang_pendidikan : '-',
                                'no_hp'           => $siswa->no_hp_siswa ?? '-',
                                'email_siswa'     => $siswa->email ?? '-',
                                'alamat'          => $siswa->alamat ?? '-',
                                'nama_orangtua'   => $siswa->nama_orangtua ?? '-',
                                'email_orangtua'  => $siswa->email_orangtua ?? '-',
                                'no_hp_orangtua'  => $siswa->no_hp_orangtua ?? '-',
                                'status_akun'     => $siswa->status_akun ?? 'Aktif',
                                'foto'            => $siswa->foto_profil ?? null,
                            ];
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="gs-siswa-name-wrapper">
                                    <span class="gs-siswa-name">{{ $siswa->nama_lengkap ?? '-' }}</span>
                                    {{-- Info tambahan untuk mobile --}}
                                    <div class="gs-mobile-info">
                                        <span class="gs-mobile-email">{{ $siswa->email ?? '-' }}</span>
                                        <span class="gs-badge-status-sm gs-status-aktif-sm">Aktif</span>
                                    </div>
                                </div>
                            </td>
                            <td class="hide-mobile">{{ $siswa->email ?? '-' }}</td>
                            <td>
                                @if($siswa->kelas->isNotEmpty())
                                    <span class="gs-kelas-combined">
                                        {{ $siswa->kelas->first()->nama_kelas }}
                                        <span class="gs-jenjang-inline">{{ $siswa->kelas->first()->jenjang_pendidikan }}</span>
                                    </span>
                                @else
                                    <span class="gs-text-muted">-</span>
                                @endif
                            </td>
                            <td class="hide-mobile">
                                @if($siswa->kelas->isNotEmpty())
                                    <span class="gs-badge-jenjang gs-jenjang-{{ strtolower($siswa->kelas->first()->jenjang_pendidikan) }}">
                                        {{ $siswa->kelas->first()->jenjang_pendidikan }}
                                    </span>
                                @else
                                    <span class="gs-text-muted">-</span>
                                @endif
                            </td>
                            <td class="hide-mobile">
                                <span class="gs-badge-status gs-status-aktif">Aktif</span>
                            </td>
                            <td>
                                <div class="gs-actions">
                                    {{-- MATA = DETAIL SISWA (POPUP MODAL) --}}
                                    <button type="button"
                                            class="gs-btn-view btn-view"
                                            data-detail='@json($detailSiswa, JSON_HEX_APOS | JSON_HEX_QUOT)'
                                            title="Detail siswa">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>

                                    {{-- PENSIL = BUAT LAPORAN BELAJAR --}}
                                    <a href="{{ route('guru.laporan_siswa.detail', $siswa->id) }}" class="gs-btn-report" title="Buat laporan belajar siswa">
                                        <i class="fas fa-pen-to-square"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
        @else
            <div class="gs-empty">
                <div class="gs-empty-icon">👥</div>
                <h4>Tidak ada siswa</h4>
                <p>Siswa yang terdaftar di kelas Anda akan tampil di halaman ini.</p>
            </div>
        @endif
    </div>
</div>

{{-- Modal Detail Siswa --}}
<div id="detailSiswaModal" class="modal">
    <div class="modal-overlay" onclick="closeDetailSiswaModal()"></div>
    <div class="modal-content-custom">
        {{-- Tombol Close --}}
        <button type="button" class="modal-close-icon" onclick="closeDetailSiswaModal()" aria-label="Tutup">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

<style>
    

    .gs-header { margin-bottom: 24px; }
    .gs-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 4px;
    }
    .gs-subtitle {
        color: #64748B;
        font-size: 0.95rem;
    }

    /* Stats */
    .gs-stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    .gs-stat {
        background: #FFFFFF;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.06);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .gs-stat:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.1);
    }
    .gs-stat-blue { border-left: 4px solid #0EA5E9; }
    .gs-stat-green { border-left: 4px solid #22C55E; }
    .gs-stat-orange { border-left: 4px solid #F97316; }

    .gs-stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .gs-stat-blue .gs-stat-icon { background: #DBEAFE; color: #0EA5E9; }
    .gs-stat-green .gs-stat-icon { background: #DCFCE7; color: #22C55E; }
    .gs-stat-orange .gs-stat-icon { background: #FFEDD5; color: #F97316; }
    .gs-stat-icon svg { width: 26px; height: 26px; }

    .gs-stat-label {
        font-size: 0.85rem;
        color: #64748B;
        margin-bottom: 4px;
        font-weight: 600;
    }
    .gs-stat-value {
        font-size: 1.9rem;
        font-weight: 700;
        color: #0F172A;
    }

    /* Table card */
    .gs-table-card {
        background: #FFFFFF;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.06);
    }
    .gs-table-responsive { overflow-x: auto; }

    .gs-table {
        width: 100%;
        border-collapse: collapse;
    }
    .gs-table thead {
        background: linear-gradient(135deg, #F8FAFC, #F1F5F9);
    }
    .gs-table th {
        padding: 14px 16px;
        font-size: 0.8rem;
        font-weight: 700;
        color: #475569;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        border-bottom: 2px solid #E2E8F0;
    }
    .gs-table td {
        padding: 14px 16px;
        border-bottom: 1px solid #EEF2F7;
        font-size: 0.9rem;
        color: #334155;
    }
    .gs-table tbody tr:hover {
        background: #F8FAFC;
    }

    .gs-siswa-name-wrapper {
        display: flex;
        flex-direction: column;
    }
    .gs-siswa-name {
        font-weight: 600;
        color: #0F172A;
    }

    /* Info mobile di bawah nama (hidden di desktop) */
    .gs-mobile-info {
        display: none;
        flex-direction: column;
        gap: 5px;
        margin-top: 6px;
    }
    .gs-mobile-email {
        font-size: 0.75rem;
        color: #64748B;
        word-break: break-all;
    }

    /* Badge status kecil untuk mobile */
    .gs-badge-status-sm {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 999px;
        font-size: 0.65rem;
        font-weight: 600;
        width: fit-content;
    }
    .gs-status-aktif-sm {
        background: #DCFCE7;
        color: #15803D;
    }

    /* Kelas combined (nama kelas + jenjang untuk mobile) */
    .gs-kelas-combined {
        display: flex;
        flex-direction: column;
        gap: 4px;
        font-weight: 600;
        color: #0F172A;
        font-size: 0.9rem;
    }
    .gs-jenjang-inline {
        font-size: 0.75rem;
        color: #64748B;
        font-weight: 500;
    }

    .gs-badge-jenjang {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .gs-jenjang-sd   { background: #DCFCE7; color: #16A34A; }
    .gs-jenjang-smp  { background: #FEF3C7; color: #D97706; }
    .gs-jenjang-sma  { background: #FEE2E2; color: #DC2626; }

    .gs-badge-status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .gs-status-aktif {
        background: #DCFCE7;
        color: #15803D;
    }

    .gs-actions {
        display: flex;
        gap: 8px;
    }
    .gs-btn-view,
    .gs-btn-report {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease, color 0.15s ease;
    }

    .gs-btn-view {
        background: #DBEAFE;
        color: #0EA5E9;
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.25);
    }
    .gs-btn-view svg { width: 18px; height: 18px; }
    .gs-btn-view:hover {
        transform: translateY(-1px);
        background: #0EA5E9;
        color: #FFFFFF;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.35);
    }

    .gs-btn-report {
        background: #E0FBE2;
        color: #16A34A;
        box-shadow: 0 2px 6px rgba(22, 163, 74, 0.25);
        text-decoration: none;
    }
    .gs-btn-report i { font-size: 16px; }
    .gs-btn-report:hover {
        transform: translateY(-1px);
        background: #16A34A;
        color: #FFFFFF;
        box-shadow: 0 4px 10px rgba(22, 163, 74, 0.35);
    }

    .gs-empty {
        text-align: center;
        padding: 60px 20px;
    }
    .gs-empty-icon {
        font-size: 3rem;
        margin-bottom: 10px;
        opacity: 0.5;
    }
    .gs-empty h4 {
        font-size: 1.1rem;
        margin-bottom: 6px;
        color: #0F172A;
    }
    .gs-empty p {
        color: #6B7280;
        font-size: 0.9rem;
    }

    .gs-pagination {
        margin-top: 18px;
        display: flex;
        justify-content: center;
    }

    .gs-text-muted {
        color: #9CA3AF;
        font-size: 0.85rem;
    }

    /* Hide column di mobile */
    .hide-mobile {
        display: table-cell;
    }

    /* ========== RESPONSIVE MOBILE ========== */
    @media (max-width: 768px) {
        .gs-container {
            padding: 16px;
        }

        .gs-title {
            font-size: 1.4rem;
        }

        /* Stats tetap 3 kolom sejajar di mobile */
        .gs-stats-row {
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }
        .gs-stat {
            padding: 12px 8px;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 8px;
            border-left: none;
            border-top: 3px solid;
        }
        .gs-stat-blue { border-top-color: #0EA5E9; }
        .gs-stat-green { border-top-color: #22C55E; }
        .gs-stat-orange { border-top-color: #F97316; }

        .gs-stat-icon {
            width: 40px;
            height: 40px;
        }
        .gs-stat-icon svg {
            width: 20px;
            height: 20px;
        }
        .gs-stat-label {
            font-size: 0.65rem;
        }
        .gs-stat-value {
            font-size: 1.3rem;
        }

        /* Hide kolom email, jenjang, status di mobile */
        .hide-mobile {
            display: none !important;
        }

        /* Tampilkan info mobile di bawah nama */
        .gs-mobile-info {
            display: flex;
        }

        .gs-table-card {
            padding: 12px;
        }
        .gs-table th,
        .gs-table td {
            padding: 10px 8px;
            font-size: 0.8rem;
        }
        .gs-table th {
            font-size: 0.7rem;
        }

        .gs-kelas-combined {
            font-size: 0.8rem;
        }
        .gs-jenjang-inline {
            font-size: 0.7rem;
        }

        .gs-actions {
            gap: 6px;
            flex-direction: column;
        }
        .gs-btn-view,
        .gs-btn-report {
            width: 32px;
            height: 32px;
        }
        .gs-btn-view svg {
            width: 16px;
            height: 16px;
        }
        .gs-btn-report i {
            font-size: 14px;
        }
    }

    /* ========== MODAL STYLES ========== */
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
        from { transform: scale(.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
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
        color: #64748B;
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
        width: 110px;
        height: 110px;
        border-radius: 50%;
        overflow: hidden;
        background: linear-gradient(135deg, #E5F3FF 0%, #C7E7FF 100%);
        border: 4px solid #fff;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .25);
    }
    .modal-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
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
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: .5; }
    }
    .modal-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: #0F172A;
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
        color: #0EA5E9;
        text-transform: uppercase;
        letter-spacing: .04em;
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 2px solid #E0F2FE;
    }
    .title-icon {
        color: #0EA5E9;
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
        color: #64748B;
    }
    .detail-separator {
        text-align: center;
        color: #64748B;
    }
    .detail-value {
        color: #0F172A;
        font-weight: 500;
    }
    .selectable {
        user-select: text;
        cursor: text;
    }

    @media (max-width: 768px) {
        .detail-columns {
            grid-template-columns: 1fr;
            gap: 24px;
        }
        .detail-row {
            grid-template-columns: 110px 10px 1fr;
            font-size: .85rem;
        }
        .modal-content-custom {
            padding: 24px 16px 20px;
            width: 95%;
        }
        .avatar-container {
            width: 90px;
            height: 90px;
        }
        .avatar-status-badge {
            font-size: .6rem;
            padding: 4px 8px;
        }
        .modal-title {
            font-size: 1.3rem;
        }
        .section-title {
            font-size: .85rem;
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
            fotoEl.src = String(data.foto).startsWith("http") ? data.foto : baseStorage + data.foto;
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
