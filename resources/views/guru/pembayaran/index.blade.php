@extends('layouts.guru')

@section('title', 'Data Pembayaran Siswa')

@section('content')
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}



/* Header Section */
.page-header {
    margin-bottom: 24px;
}

.page-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 4px;
}

.page-subtitle {
    font-size: 0.875rem;
    color: #6B7280;
}

/* Stats Grid - 4 kolom desktop, 2 kolom mobile */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
}

/* Stat Card - Style seperti admin */
.stat-card {
    background: white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border-left: 4px solid;
    transition: transform 0.2s, box-shadow 0.2s;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.stat-card.primary { border-left-color: #3B82F6; }
.stat-card.warning { border-left-color: #F59E0B; }
.stat-card.success { border-left-color: #10B981; }
.stat-card.danger { border-left-color: #EF4444; }

.stat-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.stat-info {
    flex: 1;
}

.stat-label {
    font-size: 0.75rem;
    font-weight: 700;
    color: #6B7280;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.stat-value {
    font-size: 1.875rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 4px;
    line-height: 1;
}

.stat-desc {
    font-size: 0.75rem;
    color: #9CA3AF;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
    flex-shrink: 0;
}

.stat-card.primary .stat-icon { background: #3B82F6; }
.stat-card.warning .stat-icon { background: #F59E0B; }
.stat-card.success .stat-icon { background: #10B981; }
.stat-card.danger .stat-icon { background: #EF4444; }

/* Filter Section */
.filter-section {
    background: white;
    border-radius: 8px;
    padding: 16px 20px;
    margin-bottom: 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.filter-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
}

.filter-label {
    font-size: 0.875rem;
    font-weight: 600;
    color: #111827;
    display: flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
}

.filter-select {
    flex: 1;
    max-width: 200px;
    padding: 8px 12px;
    border: 1px solid #D1D5DB;
    border-radius: 6px;
    font-size: 0.875rem;
    color: #111827;
    background: white;
    cursor: pointer;
    transition: border-color 0.2s;
}

.filter-select:focus {
    outline: none;
    border-color: #3B82F6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.filter-btn {
    padding: 8px 20px;
    background: #3B82F6;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
    display: flex;
    align-items: center;
    gap: 6px;
}

.filter-btn:hover {
    background: #2563EB;
}

/* Table Section */
.table-section {
    background: white;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.table-header {
    padding: 16px 20px;
    background: #3B82F6;
    border-bottom: 1px solid #2563EB;
}

.table-title {
    font-size: 1rem;
    font-weight: 600;
    color: white;
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
    color: #374151;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #E5E7EB;
    white-space: nowrap;
}

.data-table thead th:first-child { text-align: center; }
.data-table thead th:nth-child(6),
.data-table thead th:nth-child(7) { text-align: center; }

.data-table tbody tr {
    border-bottom: 1px solid #E5E7EB;
    transition: background 0.15s;
}

.data-table tbody tr:hover {
    background: #F9FAFB;
}

.data-table tbody tr:last-child {
    border-bottom: none;
}

.data-table tbody td {
    padding: 14px 16px;
    font-size: 0.875rem;
    color: #111827;
}

.data-table tbody td:first-child {
    text-align: center;
    font-weight: 700;
    color: #3B82F6;
}

.data-table tbody td:nth-child(6),
.data-table tbody td:nth-child(7) {
    text-align: center;
}

/* Badge Status */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    white-space: nowrap;
}

.badge-success {
    background: #D1FAE5;
    color: #065F46;
}

.badge-warning {
    background: #FEF3C7;
    color: #92400E;
}

.badge-danger {
    background: #FEE2E2;
    color: #991B1B;
}

.reject-reason {
    font-size: 0.7rem;
    color: #DC2626;
    font-style: italic;
    margin-top: 4px;
    display: block;
}

/* Button View */
.btn-view {
    padding: 6px 14px;
    background: #3B82F6;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: background 0.2s;
}

.btn-view:hover {
    background: #2563EB;
    color: white;
    text-decoration: none;
}

/* Empty State */
.empty-state {
    padding: 60px 20px;
    text-align: center;
}

.empty-icon {
    font-size: 3.5rem;
    color: #D1D5DB;
    margin-bottom: 16px;
}

.empty-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #111827;
    margin-bottom: 8px;
}

.empty-text {
    font-size: 0.875rem;
    color: #6B7280;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .payment-container {
        padding: 16px;
    }

    .page-title {
        font-size: 1.5rem;
    }

    .stat-card {
        padding: 16px;
    }

    .stat-value {
        font-size: 1.5rem;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }

    .filter-wrapper {
        flex-direction: column;
        align-items: stretch;
    }

    .filter-select {
        max-width: 100%;
    }

    .filter-btn {
        width: 100%;
        justify-content: center;
    }

    .table-wrapper {
        overflow-x: scroll;
        -webkit-overflow-scrolling: touch;
    }

    .data-table {
        min-width: 800px;
    }

    .data-table thead th,
    .data-table tbody td {
        padding: 10px 8px;
        font-size: 0.75rem;
    }
}

@media (max-width: 480px) {
    .stat-label {
        font-size: 0.65rem;
    }

    .stat-value {
        font-size: 1.25rem;
    }

    .stat-desc {
        font-size: 0.65rem;
    }
}
</style>

<div class="payment-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Data Pembayaran Siswa</h1>
        <p class="page-subtitle">Kelola dan pantau pembayaran siswa di kelas Anda</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <!-- Total Transaksi -->
        <div class="stat-card primary">
            <div class="stat-content">
                <div class="stat-info">
                    <div class="stat-label">Total Transaksi</div>
                    <div class="stat-value">{{ $total }}</div>
                    <div class="stat-desc">Semua pembayaran</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-receipt"></i>
                </div>
            </div>
        </div>

        <!-- Menunggu -->
        <div class="stat-card warning">
            <div class="stat-content">
                <div class="stat-info">
                    <div class="stat-label">Menunggu</div>
                    <div class="stat-value">{{ $menunggu }}</div>
                    <div class="stat-desc">Butuh verifikasi admin</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>

        <!-- Lunas -->
        <div class="stat-card success">
            <div class="stat-content">
                <div class="stat-info">
                    <div class="stat-label">Lunas</div>
                    <div class="stat-value">{{ $lunas }}</div>
                    <div class="stat-desc">Pembayaran beres</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>

        <!-- Gagal -->
        <div class="stat-card danger">
            <div class="stat-content">
                <div class="stat-info">
                    <div class="stat-label">Gagal</div>
                    <div class="stat-value">{{ $gagal }}</div>
                    <div class="stat-desc">Pembayaran ditolak</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <form class="filter-wrapper" onsubmit="event.preventDefault(); filterStatusGuru();">
            <label class="filter-label">
                <i class="fas fa-filter"></i>
                Filter Status:
            </label>
            <select id="filterStatusGuru" class="filter-select">
                <option value="">Semua Status</option>
                <option value="menunggu">Menunggu</option>
                <option value="lunas">Lunas</option>
                <option value="gagal">Gagal</option>
            </select>
            <button class="filter-btn" type="submit">
                <i class="fas fa-check"></i>
                Terapkan
            </button>
        </form>
    </div>

    <!-- Table Section -->
    <div class="table-section">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-list"></i>
                Daftar Pembayaran
            </h3>
        </div>
        <div class="table-wrapper">
            <table class="data-table" id="tabelPembayaranGuru">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>TANGGAL</th>
                        <th>NAMA SISWA</th>
                        <th>KELAS</th>
                        <th>NOMINAL</th>
                        <th>STATUS</th>
                        <th>BUKTI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayarans as $i => $p)
                        <tr data-status="{{ $p->status_pembayaran }}">
                            <td>{{ $i + 1 }}</td>
                            <td>{{ optional($p->created_at)->format('d/m/Y') }}</td>
                            <td><strong>{{ $p->siswa->nama_lengkap ?? '-' }}</strong></td>
                            <td>{{ $p->kelas->nama_kelas ?? '-' }}</td>
                            <td><strong style="color: #10B981;">Rp {{ number_format($p->nominal_pembayaran, 0, ',', '.') }}</strong></td>
                            <td>
                                @if($p->status_pembayaran === 'lunas')
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i> Lunas
                                    </span>
                                @elseif($p->status_pembayaran === 'menunggu')
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock"></i> Menunggu
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times-circle"></i> Gagal
                                    </span>
                                    @if($p->rejected_reason)
                                        <span class="reject-reason">Alasan: {{ $p->rejected_reason }}</span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($p->bukti_pembayaran)
                                    <a href="{{ asset('storage/'.$p->bukti_pembayaran) }}" 
                                       target="_blank" 
                                       class="btn-view">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                @else
                                    <span style="color: #d6dee9;">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <h4 class="empty-title">Belum Ada Pembayaran</h4>
                                    <p class="empty-text">
                                        Pembayaran siswa akan muncul di sini
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

<script>
function filterStatusGuru() {
    const value = document.getElementById('filterStatusGuru').value;
    const rows  = document.querySelectorAll('#tabelPembayaranGuru tbody tr[data-status]');

    rows.forEach(row => {
        if (value === '' || row.dataset.status === value) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Auto filter on change
document.getElementById('filterStatusGuru')?.addEventListener('change', filterStatusGuru);
</script>
@endsection
