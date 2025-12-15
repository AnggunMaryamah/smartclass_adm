@extends('layouts.guru')

@section('title', 'Laporan Belajar Siswa')

@section('content')
<div class="laporan-container">
    {{-- Header halaman --}}
    <div class="page-header">
        <h1 class="page-title">Laporan Belajar Siswa</h1>
        <p class="page-subtitle">
            Kelola rekap belajar per kelas: lihat jumlah siswa, jenjang, dan buka laporan detail.
        </p>
    </div>

    {{-- Kartu ringkasan kecil  --}}
    <div class="stats-row">
        <div class="stat-card primary">
            <div class="stat-icon">
                <i class="fas fa-layer-group"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Total Kelas</div>
                <div class="stat-value">{{ $kelasList->count() }}</div>
            </div>
        </div>

        <div class="stat-card secondary">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Total Siswa</div>
                <div class="stat-value">
                    {{ $kelasList->sum('total_siswa') }}
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel daftar kelas --}}
    <div class="table-section">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-list"></i>
                Daftar Kelas & Laporan
            </h3>
        </div>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA KELAS</th>
                        <th>JENJANG</th>
                        <th>JUMLAH SISWA</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelasList as $i => $kelas)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                <div class="kelas-name">
                                    <span class="kelas-main">{{ $kelas->nama_kelas }}</span>
                                    {{-- kalau punya kolom tahun_ajaran / mapel bisa tampilkan kecil di bawah --}}
                                    @if(!empty($kelas->tahun_ajaran))
                                        <span class="kelas-sub">{{ $kelas->tahun_ajaran }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if(!empty($kelas->jenjang))
                                    <span class="badge-jenjang">{{ $kelas->jenjang }}</span>
                                @else
                                    <span class="badge-jenjang badge-jenjang-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge-siswa">
                                    {{ $kelas->total_siswa ?? 0 }} Siswa
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('guru.laporan_siswa.daftar', $kelas->id) }}"
                                   class="btn-aksi">
                                    <i class="fas fa-chart-line"></i>
                                    Kelola Laporan
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <h4 class="empty-title">Belum Ada Kelas</h4>
                                    <p class="empty-text">
                                        Kelas yang Anda ajar akan tampil di sini setelah ditambahkan.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
.laporan-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 16px 16px 24px 16px;
}

/* Header */
.page-header {
    margin-bottom: 18px;
}

.page-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #0F172A;
    margin-bottom: 4px;
}

.page-subtitle {
    font-size: 0.9rem;
    color: #6B7280;
}

/* Stats row kecil */
.stats-row {
    display: flex;
    gap: 16px;
    margin-bottom: 18px;
    flex-wrap: wrap;
}

.stat-card {
    flex: 0 0 220px;
    display: flex;
    align-items: center;
    gap: 12px;
    background: #ffffff;
    border-radius: 14px;
    padding: 12px 14px;
    box-shadow: 0 4px 10px rgba(15,23,42,0.06);
    border-left: 4px solid;
}

.stat-card.primary  { border-left-color: #0EA5E9; }
.stat-card.secondary{ border-left-color: #22C55E; }

.stat-icon {
    width: 40px;
    height: 40px;
    border-radius: 999px;
    background: #EFF6FF;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0EA5E9;
}

.stat-info {
    display: flex;
    flex-direction: column;
}

.stat-label {
    font-size: 0.75rem;
    font-weight: 600;
    color: #6B7280;
    text-transform: uppercase;
}

.stat-value {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0F172A;
}

/* Table section */
.table-section {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 8px 18px rgba(15,23,42,0.08);
    overflow: hidden;
}

.table-header {
    padding: 14px 20px;
    background: #0EA5E9;
    border-bottom: 1px solid #0284C7;
}

.table-title {
    font-size: 1rem;
    font-weight: 600;
    color: #ffffff;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.table-wrapper {
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table thead {
    background: #F9FAFB;
}

.data-table thead th {
    padding: 12px 16px;
    text-align: left;
    font-size: 0.75rem;
    font-weight: 700;
    color: #6B7280;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #E5E7EB;
    white-space: nowrap;
}

.data-table thead th:first-child {
    text-align: center;
    width: 60px;
}

.data-table thead th:last-child {
    text-align: center;
    width: 170px;
}

.data-table tbody tr {
    border-bottom: 1px solid #E5E7EB;
    transition: background 0.15s;
}

.data-table tbody tr:hover {
    background: #F1F5F9;
}

.data-table tbody td {
    padding: 12px 16px;
    font-size: 0.9rem;
    color: #111827;
    vertical-align: middle;
}

.data-table tbody td:first-child {
    text-align: center;
    font-weight: 600;
    color: #0EA5E9;
}

.data-table tbody td:last-child {
    text-align: center;
}

/* Nama kelas + sub info */
.kelas-name {
    display: flex;
    flex-direction: column;
}

.kelas-main {
    font-weight: 600;
    color: #0F172A;
}

.kelas-sub {
    font-size: 0.75rem;
    color: #9CA3AF;
}

/* Badge jenjang dan jumlah siswa */
.badge-jenjang {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 600;
    background: #FEF3C7;
    color: #92400E;
}

.badge-jenjang-muted {
    background: #E5E7EB;
    color: #4B5563;
}

.badge-siswa {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 0.78rem;
    font-weight: 600;
    background: #ECFEFF;
    color: #0F766E;
}

/* Tombol aksi */
.btn-aksi {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 7px 14px;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 600;
    color: #ffffff;
    background: #0EA5E9;
    text-decoration: none;
    box-shadow: 0 4px 10px rgba(14,165,233,0.3);
    transition: background 0.15s, transform 0.1s, box-shadow 0.15s;
}

.btn-aksi:hover {
    background: #0284C7;
    transform: translateY(-1px);
    box-shadow: 0 6px 14px rgba(2,132,199,0.35);
}

/* Empty state */
.empty-state {
    padding: 60px 20px;
    text-align: center;
}

.empty-icon {
    font-size: 3rem;
    color: #CBD5F5;
    margin-bottom: 12px;
}

.empty-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #0F172A;
    margin-bottom: 6px;
}

.empty-text {
    font-size: 0.9rem;
    color: #6B7280;
}

/* Responsive */
@media (max-width: 768px) {
    .laporan-container {
        padding: 12px;
    }

    .stats-row {
        flex-direction: column;
    }

    .stat-card {
        flex: 1 1 auto;
    }

    .data-table {
        min-width: 720px;
    }
}
</style>
@endpush
