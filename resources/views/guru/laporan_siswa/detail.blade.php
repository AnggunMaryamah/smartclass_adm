@extends('layouts.guru')

@section('title', 'Detail Laporan Siswa')

@section('content')
@php
$totalKuis       = $totalKuis       ?? 0;
$kuisDikerjakan  = $kuisDikerjakan  ?? 0;
$totalUjian      = $totalUjian      ?? 0;
$ujianDikerjakan = $ujianDikerjakan ?? 0;
$progressMateri  = $progressMateri  ?? 0;
$materiSelesai   = $materiSelesai   ?? 0;
$totalMateri     = $totalMateri     ?? 0;

// Inisialisasi nilai default
$nilaiAwal   = 0;
$nilaiAkhir  = 0;
$perkembangan = 0;
$avgNilai    = 0;

// Cek laporan penilaian
if (!empty($laporan) && $laporan->count() > 0) {
    $nilaiAwal    = $laporan->sortBy('created_at')->first()->nilai    ?? 0;
    $nilaiAkhir   = $laporan->sortByDesc('created_at')->first()->nilai ?? 0;
    $perkembangan = $nilaiAkhir - $nilaiAwal;
    $avgNilai     = round($laporan->avg('nilai'), 2);
}

// Ambil nama guru yang sedang login
$namaGuru = auth()->user()->nama ?? 'Guru Pembimbing';
@endphp

<style>
:root {
    --primary: #1565c0;
    --primary-dark: #0d47a1;
    --primary-light: #e3f2fd;
    --secondary: #00897b;
    --secondary-light: #e0f2f1;
    --accent: #ff6f00;
    --accent-light: #fff3e0;
    --success: #2e7d32;
    --success-light: #e8f5e9;
    --grey-dark: #37474f;
    --grey: #546e7a;
    --grey-light: #eceff1;
    --grey-bg: #f5f7fa;
    --white: #ffffff;
    --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
    --shadow-md: 0 4px 16px rgba(0,0,0,0.1);
    --shadow-lg: 0 8px 24px rgba(0,0,0,0.12);
}

* { margin: 0; padding: 0; box-sizing: border-box; }
body {
    background: var(--grey-bg) !important;
    font-family: 'Inter','Segoe UI',system-ui,-apple-system,sans-serif;
    color: var(--grey-dark);
}

/* HEADER ATAS */
.header-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
}
.back-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--white);
    padding: 11px 20px;
    border-radius: 10px;
    border: 1px solid var(--grey-light);
    text-decoration: none;
    color: var(--primary-dark);
    font-weight: 600;
    box-shadow: var(--shadow-sm);
    transition: all 0.25s ease;
}
.back-btn:hover {
    background: var(--primary-light);
    transform: translateX(-3px);
    box-shadow: var(--shadow-md);
    border-color: var(--primary);
}

.action-buttons {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}
.btn-action {
    padding: 11px 22px;
    font-weight: 600;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    transition: all 0.25s ease;
    font-size: 14px;
    text-decoration: none;
    box-shadow: var(--shadow-sm);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    letter-spacing: 0.3px;
}
.btn-action:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }
.btn-edit {
    background: var(--primary);
    color: var(--white);
}
.btn-edit:hover { background: var(--primary-dark); }
.btn-save {
    background: var(--success);
    color: var(--white);
    display: none;
}
.btn-save:hover { background: #1b5e20; }
.btn-pdf {
    background: var(--accent);
    color: var(--white);
}
.btn-pdf:hover { background: #e65100; }
.btn-cancel {
    background: var(--grey-light);
    color: var(--grey);
    display: none;
}
.btn-cancel:hover { background: var(--grey); color: var(--white); }

/* PROGRESS SECTION */
.progress-section { margin: 36px 0; }
.section-title-main {
    font-weight: 700;
    font-size: 18px;
    color: var(--primary-dark);
    margin-bottom: 24px;
    padding-left: 16px;
    border-left: 4px solid var(--primary);
    display: flex;
    align-items: center;
    gap: 12px;
}
.section-title-main svg { width: 24px; height: 24px; }
.progress-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(300px,1fr));
    gap: 24px;
}

.progress-card {
    background: var(--white);
    border-radius: 12px;
    padding: 28px 24px;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--grey-light);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}
.progress-card::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 4px;
}
.progress-card.materi::before { background: linear-gradient(90deg,#1976d2,#42a5f5); }
.progress-card.kuis::before   { background: linear-gradient(90deg,#00897b,#26a69a); }
.progress-card.ujian::before  { background: linear-gradient(90deg,#ff6f00,#ffa726); }
.progress-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    border-color: var(--primary-light);
}

.card-header {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 20px;
}
.icon-box {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.icon-box svg { width: 28px; height: 28px; }
.progress-card.materi .icon-box   { background: var(--primary-light);   color: var(--primary); }
.progress-card.kuis .icon-box     { background: var(--secondary-light); color: var(--secondary); }
.progress-card.ujian .icon-box    { background: var(--accent-light);    color: var(--accent); }

.card-info { flex: 1; }
.card-info h3 {
    font-size: 16px;
    font-weight: 700;
    margin: 0 0 6px 0;
    color: var(--grey-dark);
}
.card-info p {
    font-size: 13px;
    margin: 0;
    color: var(--grey);
    line-height: 1.5;
}

.progress-wrapper { margin: 18px 0; }
.progress-bar {
    width: 100%;
    height: 10px;
    background: var(--grey-light);
    border-radius: 10px;
    overflow: hidden;
}
.progress-fill {
    height: 100%;
    border-radius: 10px;
    transition: width 0.6s cubic-bezier(0.4,0,0.2,1);
}
.progress-card.materi .progress-fill { background: linear-gradient(90deg,#1976d2,#42a5f5); }
.progress-card.kuis   .progress-fill { background: linear-gradient(90deg,#00897b,#4db6ac); }
.progress-card.ujian  .progress-fill { background: linear-gradient(90deg,#ff6f00,#ffb74d); }

.stats-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 16px;
}
.stat-main { display: flex; align-items: baseline; gap: 6px; }
.stat-value {
    font-size: 36px;
    font-weight: 800;
    line-height: 1;
    color: var(--grey-dark);
}
.stat-unit { font-size: 16px; font-weight: 600; color: var(--grey); }
.stat-detail { text-align: right; font-size: 13px; color: var(--grey); }
.stat-detail strong { color: var(--grey-dark); font-weight: 700; }
.stat-status { font-size: 12px; margin-top: 4px; display: block; }
.stat-status.success { color: var(--success); }
.stat-status.warning { color: var(--accent); }

/* LAPORAN CONTAINER */
.laporan-container {
    max-width: 1000px;
    margin: 40px auto 0;
    background: var(--white);
    border-radius: 12px;
    box-shadow: var(--shadow-md);
    padding: 44px 40px;
    border: 1px solid var(--grey-light);
}

.report-header {
    text-align: center;
    border-bottom: 3px solid var(--primary);
    padding-bottom: 24px;
    margin-bottom: 36px;
}
.report-title {
    font-size: 24px;
    font-weight: 800;
    color: var(--primary-dark);
    letter-spacing: 0.5px;
    text-transform: uppercase;
}
.report-subtitle {
    font-size: 15px;
    color: var(--grey);
    font-weight: 500;
    margin-top: 10px;
}

.report-section { margin-bottom: 32px; }
.report-section-title {
    font-weight: 700;
    font-size: 15px;
    color: var(--primary);
    display: block;
    padding: 10px 0;
    margin-bottom: 20px;
    letter-spacing: 0.5px;
}

.data-table {
    width: 100%;
    font-size: 14px;
    border-collapse: collapse;
}
.data-table td {
    padding: 11px 8px;
    vertical-align: top;
    line-height: 1.6;
}
.data-table td:first-child {
    width: 35%;
    font-weight: 700;
    color: var(--grey-dark);
}
.data-table td:nth-child(2) { color: var(--grey); }

.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
    margin-top: 16px;
}
.table thead {
    background: linear-gradient(135deg,var(--primary) 0%,var(--primary-dark) 100%);
    color: var(--white);
}
.table th {
    padding: 14px 10px;
    font-weight: 700;
    text-align: center;
    letter-spacing: 0.3px;
}
.table tbody tr {
    border-bottom: 1px solid var(--grey-light);
    transition: background 0.2s;
}
.table tbody tr:hover { background: var(--primary-light); }
.table td {
    padding: 13px 10px;
    color: var(--grey);
    text-align: center;
}
.badge {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 700;
    background: var(--primary-light);
    color: var(--primary);
}

.catatan-box {
    background: linear-gradient(135deg,#fffbf0 0%,#fff8e1 100%);
    border-left: 4px solid var(--accent);
    border-radius: 10px;
    padding: 20px 24px;
    font-size: 14px;
    color: var(--grey-dark);
    line-height: 1.8;
    box-shadow: 0 2px 8px rgba(255,111,0,0.08);
}
.catatan-box strong {
    color: var(--grey-dark);
    font-weight: 700;
}

.report-footer {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-top: 56px;
    padding-top: 28px;
    border-top: 2px solid var(--grey-light);
}
.footer-label { font-size: 13px; color: var(--grey); }
.footer-signature { text-align: center; }
.footer-name {
    font-size: 14px;
    font-weight: 700;
    color: var(--grey-dark);
    margin-top: 8px;
}
.signature-line {
    border-top: 2px solid var(--grey-dark);
    margin-top: 40px;
    width: 180px;
}

/* RESPONSIVE */
@media (max-width: 900px) {
    .laporan-container { padding: 32px 24px; }
    .progress-grid { grid-template-columns: 1fr; }
    .action-buttons { gap: 8px; }
    .btn-action { padding: 9px 16px; font-size: 13px; }
    .report-footer { flex-direction: column; gap: 24px; align-items: center; }
    .stat-value { font-size: 28px; }
}
</style>

<!-- HEADER & BUTTONS -->
<div class="header-top">
    <a href="javascript:history.back()" class="back-btn">
        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
            <path d="M20 11H7.83l5.59-5.59L12 3 3 12l9 9 1.41-1.41L7.83 13H20v-2z"/>
        </svg>
        Kembali
    </a>
    <div class="action-buttons">
        <button type="button" class="btn-action btn-edit" id="btnEdit" onclick="toggleEdit()">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z"/>
                <path d="M20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
            </svg>
            Edit Catatan
        </button>
        <button type="button" class="btn-action btn-save" id="btnSave">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/>
            </svg>
            Simpan
        </button>
        <button type="button" class="btn-action btn-cancel" id="btnCancel" onclick="cancelEdit()">Batal</button>
        <a href="{{ route('guru.laporan_siswa.export_pdf', $siswa->id) }}" class="btn-action btn-pdf">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 12v7H5v-7H3v7c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-7h-2zm-6 .67l2.59-2.58L17 11.5l-5 5-5-5 1.41-1.41L11 12.67V3h2z"/>
            </svg>
            Unduh PDF
        </a>
    </div>
</div>

<!-- PROGRESS BELAJAR SECTION -->
<div class="progress-section">
    <div class="section-title-main">
        <svg fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
        </svg>
        Progress Belajar Siswa
    </div>
    <div class="progress-grid">
        <!-- Card 1: Materi -->
        <div class="progress-card materi">
            <div class="card-header">
                <div class="icon-box">
                    <svg fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 5c-1.11-.35-2.33-.5-3.5-.5-1.95 0-4.05.4-5.5 1.5-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5 1.35-.85 3.8-1.5 5.5-1.5 1.65 0 3.35.3 4.75 1.05.1.05.15.05.25.05.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1zm0 13.5c-1.1-.35-2.3-.5-3.5-.5-1.7 0-4.15.65-5.5 1.5V8c1.35-.85 3.8-1.5 5.5-1.5 1.2 0 2.4.15 3.5.5v11.5z"/>
                    </svg>
                </div>
                <div class="card-info">
                    <h3>Penguasaan Materi</h3>
                    <p>Materi pembelajaran yang telah diselesaikan dan dikuasai oleh siswa</p>
                </div>
            </div>
            <div class="progress-wrapper">
                <div class="progress-bar">
                    <div class="progress-fill" style="width: {{ $progressMateri }}%;"></div>
                </div>
            </div>
            <div class="stats-row">
                <div class="stat-main">
                    <span class="stat-value">{{ $progressMateri }}</span>
                    <span class="stat-unit">%</span>
                </div>
                <div class="stat-detail">
                    <strong>{{ $materiSelesai }}</strong> dari <strong>{{ $totalMateri }}</strong> materi<br>
                    <span class="stat-status success">✓ Telah diselesaikan</span>
                </div>
            </div>
        </div>

        <!-- Card 2: Kuis -->
        <div class="progress-card kuis">
            <div class="card-header">
                <div class="icon-box">
                    <svg fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <div class="card-info">
                    <h3>Kuis Dikerjakan</h3>
                    <p>Total kuis yang telah diselesaikan dari keseluruhan kuis yang tersedia</p>
                </div>
            </div>
            <div class="progress-wrapper">
                <div class="progress-bar">
                    <div class="progress-fill" style="width: {{ $totalKuis>0 ? round(($kuisDikerjakan/$totalKuis)*100) : 0 }}%;"></div>
                </div>
            </div>
            <div class="stats-row">
                <div class="stat-main">
                    <span class="stat-value">{{ $kuisDikerjakan }}</span>
                    <span class="stat-unit">kuis</span>
                </div>
                <div class="stat-detail">
                    Dari total <strong>{{ $totalKuis }}</strong> kuis<br>
                    <span class="stat-status warning">{{ $totalKuis - $kuisDikerjakan }} belum dikerjakan</span>
                </div>
            </div>
        </div>

        <!-- Card 3: Ujian -->
        <div class="progress-card ujian">
            <div class="card-header">
                <div class="icon-box">
                    <svg fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                    </svg>
                </div>
                <div class="card-info">
                    <h3>Ujian Dikerjakan</h3>
                    <p>Total ujian yang telah diselesaikan dari keseluruhan ujian yang tersedia</p>
                </div>
            </div>
            <div class="progress-wrapper">
                <div class="progress-bar">
                    <div class="progress-fill" style="width: {{ $totalUjian>0 ? round(($ujianDikerjakan/$totalUjian)*100) : 0 }}%;"></div>
                </div>
            </div>
            <div class="stats-row">
                <div class="stat-main">
                    <span class="stat-value">{{ $ujianDikerjakan }}</span>
                    <span class="stat-unit">ujian</span>
                </div>
                <div class="stat-detail">
                    Dari total <strong>{{ $totalUjian }}</strong> ujian<br>
                    <span class="stat-status warning">{{ $totalUjian - $ujianDikerjakan }} belum dikerjakan</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FORM UNTUK UPDATE CATATAN UMUM SAJA -->
<form id="laporanForm" method="POST" action="{{ route('guru.laporan_siswa.catatan_umum', $siswa->id) }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="catatan_umum" id="inputCatatanUmum">
</form>

<!-- LAPORAN CONTAINER -->
<div class="laporan-container">
    <div class="report-header">
        <div class="report-title">Laporan Hasil Belajar Siswa</div>
        <div class="report-subtitle">Tahun Ajaran: 2025/2026</div>
    </div>

    <!-- A. DATA SISWA (READ-ONLY) -->
    <div class="report-section">
        <div class="report-section-title">A. DATA SISWA</div>
        <table class="data-table">
            <tr><td>Nama Lengkap</td><td>: <strong>{{ $siswa->nama_lengkap ?? '-' }}</strong></td></tr>
            <tr><td>NIS / NISN</td><td>: {{ $siswa->nis ?? '-' }} / {{ $siswa->nisn ?? '-' }}</td></tr>
            <tr><td>Jenis Kelamin</td><td>: {{ $siswa->jenis_kelamin ?? '-' }}</td></tr>
            <tr><td>Jenjang</td><td>: SMP</td></tr>
            <tr><td>Tanggal Lahir</td><td>: {{ $siswa->tanggal_lahir ?? '-' }}</td></tr>
            <tr><td>Alamat</td><td>: {{ $siswa->alamat ?? '-' }}</td></tr>
            <tr><td>Nama Orang Tua</td><td>: {{ $siswa->nama_ortu ?? '-' }}</td></tr>
            <tr><td>Email</td><td>: {{ $siswa->email ?? '-' }}</td></tr>
        </table>
    </div>

    <!-- B. PERKEMBANGAN BELAJAR (READ-ONLY) -->
    <div class="report-section">
        <div class="report-section-title">B. PERKEMBANGAN BELAJAR</div>
        <table class="table">
            <thead>
                <tr>
                    <th style="width:120px;">NILAI AWAL</th>
                    <th style="width:120px;">NILAI AKHIR</th>
                    <th>PERKEMBANGAN</th>
                </tr>
            </thead>
            <tbody>
                <tr style="height:52px;font-size:16px;font-weight:700;">
                    <td>{{ $nilaiAwal }}</td>
                    <td>{{ $nilaiAkhir }}</td>
                    <td style="color:#2e7d32;">
                        {{ $perkembangan > 0 ? '+' : '' }}{{ $perkembangan }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- C. RIWAYAT PENILAIAN (READ-ONLY) - HANYA 7 KOLOM -->
    <div class="report-section">
        <div class="report-section-title">C. RIWAYAT PENILAIAN</div>
        <div style="overflow-x:auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width:40px;">No</th>
                        <th style="width:80px;">Tanggal</th>
                        <th style="width:80px;">Jenis</th>
                        <th style="width:150px;">Materi</th>
                        <th style="width:60px;">Nilai</th>
                        <th style="width:70px;">Predikat</th>
                        <th>Capaian Kompetensi</th>
                    </tr>
                </thead>
                <tbody>
                @if(!empty($laporan) && $laporan->count() > 0)
                    @foreach($laporan as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->created_at ? $item->created_at->format('d/m/y') : '-' }}</td>
                        <td style="font-weight:700;text-transform:capitalize;">
                            {{ $item->jenis_penilaian ?? '-' }}
                        </td>
                        <td style="text-align:left;">{{ $item->materi_pembelajaran ?? '-' }}</td>
                        <td style="font-weight:700;color:#1565c0;">{{ $item->nilai ?? '-' }}</td>
                        <td><span class="badge">{{ $item->predikat ?? '-' }}</span></td>
                        <td style="text-align:left;font-size:12px;">
                            {{ \Illuminate\Support\Str::limit($item->capaian_kompetensi ?? '-', 60, '...') }}
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr><td colspan="7" style="color:#999;">Belum ada data penilaian</td></tr>
                @endif
                </tbody>
            </table>
            <div style="margin-top:12px; text-align:left; font-size:15px; font-weight:600;">
                <span style="color:#37474f">Rata-rata nilai:</span>
                <span style="color:#2e7d32;font-weight:700;">{{ $avgNilai }}</span>
            </div>
        </div>
    </div>

    <!-- D. CATATAN UMUM GURU (EDITABLE) -->
    <div class="report-section">
        <div class="report-section-title">D. CATATAN UMUM GURU</div>
        <div class="catatan-box" id="catatanBox">
            <strong>Apresiasi:</strong> Siswa menunjukkan peningkatan nilai {{ $perkembangan }} poin dari nilai awal ke nilai akhir.<br>
            <strong>Catatan lain:</strong> Penilaian dilakukan berdasarkan standar kompetensi, data riil hasil belajar, dan evaluasi harian yang <u>jujur dan profesional</u> oleh guru kelas/pendamping.<br>
            Laporan ini dinyatakan <strong style="color:#37474f;">resmi dan sah</strong> sebagai dokumentasi hasil belajar siswa.
        </div>
    </div>

    <!-- FOOTER LAPORAN -->
    <div class="report-footer">
        <div class="footer-label">
            Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y, H:i') }} WIB
        </div>
        <div class="footer-signature">
            <div class="footer-label">Guru Pembimbing</div>
            <div class="signature-line"></div>
            <div class="footer-name">{{ $namaGuru }}</div>
        </div>
    </div>
</div>

<script>
// Aktifkan mode edit HANYA untuk Catatan Umum
function toggleEdit() {
    document.getElementById('btnEdit').style.display   = 'none';
    document.getElementById('btnSave').style.display   = 'inline-flex';
    document.getElementById('btnCancel').style.display = 'inline-flex';

    const catatanBox = document.getElementById('catatanBox');
    catatanBox.contentEditable       = 'true';
    catatanBox.style.cursor          = 'text';
    catatanBox.style.backgroundColor = '#fffde7';
    catatanBox.style.padding         = '20px 24px';
    catatanBox.style.borderRadius    = '10px';
    catatanBox.focus();
}

// Batalkan edit (reload halaman)
function cancelEdit() {
    location.reload();
}

// Sinkronkan isi catatan yang sudah di-edit ke hidden input sebelum submit
function syncCatatanToForm() {
    const catatanBox = document.getElementById('catatanBox');
    document.getElementById('inputCatatanUmum').value = catatanBox.innerHTML.trim();
}

// SUBMIT tanpa SweetAlert (sederhana dulu)
document.getElementById('btnSave').addEventListener('click', function (e) {
    e.preventDefault();
    syncCatatanToForm();
    document.getElementById('laporanForm').submit();
});

// Opsional: aktifkan menu sidebar
document.addEventListener('DOMContentLoaded', function () {
    var laporanLinkHref = "{{ route('guru.laporan_siswa.index') }}";
    document.querySelectorAll('a').forEach(function(a) {
        if (a.href === laporanLinkHref) {
            a.classList.add('active');
        }
    });
});
</script>
@endsection