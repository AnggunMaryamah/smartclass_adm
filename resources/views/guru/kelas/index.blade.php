@extends('layouts.guru')

@section('title', 'Kelas Saya')

@section('content')
    <div class="kelas-container">
        {{-- Welcome Banner --}}
        <div class="welcome-banner-kelas">
            <div class="welcome-content">
                <h2>Kelola Kelas Anda dengan Mudah</h2>
                <p>Tambahkan kelas baru, kelola materi pembelajaran, ubah informasi kelas, dan lihat detailnya dengan mudah. </p>
            </div>
            <div class="welcome-decoration">
                <div class="deco-circle deco-1"></div>
                <div class="deco-circle deco-2"></div>
                <div class="deco-circle deco-3"></div>
            </div>
        </div>

        {{-- Section Kelas --}}
        <div class="kelas-section">
            <div class="section-header">
                <div class="section-title-group">
                    <h3 class="section-title">📚 Kelas Saya</h3>
                    <p class="section-subtitle">Kelola semua kelas pembelajaran Anda</p>
                </div>
                @if (Route::has('guru.kelas.create'))
                    <a href="{{ route('guru.kelas.create') }}" class="btn-tambah-kelas">
                        <span class="btn-icon">+</span>
                        <span class="btn-text">Tambah Kelas</span>
                    </a>
                @endif
            </div>

            {{-- Table Container --}}
            <div class="table-wrapper">
                <div class="table-responsive">
                    <table class="modern-table" id="kelasTable">
                        <thead>
                            <tr>
                                <th class="th-number">No</th>
                                <th class="th-nama sortable" onclick="sortTable(1)">
                                    Nama Kelas
                                    <span class="sort-icon">⇅</span>
                                </th>
                                <th class="th-jenjang sortable" onclick="sortTable(2)">
                                    Jenjang
                                    <span class="sort-icon">⇅</span>
                                </th>
                                <th class="th-siswa sortable" onclick="sortTable(3)">
                                    Siswa
                                    <span class="sort-icon">⇅</span>
                                </th>
                                <th class="th-status sortable" onclick="sortTable(4)">
                                    Status
                                    <span class="sort-icon">⇅</span>
                                </th>
                                <th class="th-action">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($daftarKelas as $index => $kelas)
                                <tr class="table-row">
                                    <td class="td-number">
                                        <span
                                            class="row-number">{{ ($daftarKelas->currentPage() - 1) * $daftarKelas->perPage() + $index + 1 }}</span>
                                    </td>
                                    <td class="td-nama">
                                        <div class="kelas-info">
                                            <span class="kelas-nama-text">{{ $kelas->nama_kelas }}</span>
                                        </div>
                                    </td>
                                    <td class="td-jenjang">
                                        <span class="jenjang-badge badge-{{ strtolower($kelas->jenjang_pendidikan) }}">
                                            {{ strtoupper($kelas->jenjang_pendidikan) }}
                                        </span>
                                    </td>
                                    <td class="td-siswa">
                                        <span class="siswa-number">{{ $kelas->siswas->count() }}</span>
                                    </td>
                                    <td class="td-status">
                                        <span
                                            class="status-badge {{ $kelas->status === 'aktif' ? 'status-active' : 'status-inactive' }}">
                                            <span class="status-dot"></span>
                                            {{ ucfirst($kelas->status) }}
                                        </span>
                                    </td>
                                    <td class="td-action">
                                        <div class="action-buttons">
                                            @if (Route::has('guru.kelas.show'))
                                                <a href="{{ route('guru.kelas.show', $kelas->id) }}"
                                                    class="btn-action btn-detail" title="Detail Kelas">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </a>
                                            @endif

                                            @if (Route::has('guru.materi_pembelajaran.index'))
                                                <a href="{{ route('guru.materi_pembelajaran.index', $kelas->id) }}"
                                                    class="btn-action btn-materi" title="Kelola Materi">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                                        <path
                                                            d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @endif

                                            @if (Route::has('guru.kelas.edit'))
                                                <a href="{{ route('guru.kelas.edit', $kelas->id) }}"
                                                    class="btn-action btn-edit" title="Edit Kelas">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                        </path>
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @endif

                                            @if (Route::has('guru.kelas.destroy'))
                                                <form action="{{ route('guru.kelas.destroy', $kelas->id) }}" method="POST"
                                                    style="display:inline;" class="delete-form"
                                                    data-kelas-nama="{{ $kelas->nama_kelas }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn-action btn-hapus btn-delete"
                                                        title="Hapus Kelas">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                            </path>
                                                            <line x1="10" y1="11" x2="10"
                                                                y2="17"></line>
                                                            <line x1="14" y1="11" x2="14"
                                                                y2="17"></line>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="empty-state-table">
                                        <div class="empty-content">
                                            <div class="empty-icon">📚</div>
                                            <h4>Belum Ada Kelas</h4>
                                            <p>Mulai dengan menambahkan kelas baru untuk memulai pembelajaran</p>
                                            @if (Route::has('guru.kelas.create'))
                                                <a href="{{ route('guru.kelas.create') }}" class="btn-empty-action">
                                                    + Tambah Kelas Pertama
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($daftarKelas->isNotEmpty())
                    <div class="table-pagination">
                        <div class="pagination-info">
                            Menampilkan {{ $daftarKelas->firstItem() ?? 0 }} - {{ $daftarKelas->lastItem() ?? 0 }} dari
                            {{ $daftarKelas->total() }} kelas
                        </div>
                        <div class="pagination-controls">
                            <nav aria-label="Pagination">
                                <ul class="pagination">
                                    @if ($daftarKelas->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="15 18 9 12 15 6"></polyline>
                                                </svg>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $daftarKelas->previousPageUrl() }}"
                                                rel="prev">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="15 18 9 12 15 6"></polyline>
                                                </svg>
                                            </a>
                                        </li>
                                    @endif

                                    @foreach ($daftarKelas->getUrlRange(1, $daftarKelas->lastPage()) as $page => $url)
                                        @if ($page == $daftarKelas->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($daftarKelas->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $daftarKelas->nextPageUrl() }}"
                                                rel="next">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="9 18 15 12 9 6"></polyline>
                                                </svg>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="9 18 15 12 9 6"></polyline>
                                                </svg>
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        }

        .kelas-container {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Welcome Banner */
        .welcome-banner-kelas {
            background: linear-gradient(135deg, var(--sky-blue) 0%, var(--cyan) 50%, var(--teal) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 32px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(14, 165, 233, 0.3);
        }

        .welcome-decoration {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .deco-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .deco-1 {
            width: 150px;
            height: 150px;
            top: -50px;
            right: 100px;
            animation: float 6s ease-in-out infinite;
        }

        .deco-2 {
            width: 100px;
            height: 100px;
            top: 50%;
            right: -30px;
            animation: float 8s ease-in-out infinite;
        }

        .deco-3 {
            width: 80px;
            height: 80px;
            bottom: -20px;
            right: 200px;
            animation: float 7s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(10deg);
            }
        }

        .welcome-content {
            position: relative;
            z-index: 1;
        }

        .welcome-content h2 {
            color: white;
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0 0 8px 0;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .welcome-content p {
            color: rgba(255, 255, 255, 0.95);
            font-size: 1rem;
            margin: 0;
        }

        /* Section Header */
        .kelas-section {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            gap: 16px;
            flex-wrap: wrap;
        }

        .section-title-group {
            flex: 1;
        }

        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0 0 4px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-subtitle {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin: 0;
        }

        .btn-tambah-kelas {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(135deg, var(--sky-blue), var(--cyan));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        .btn-tambah-kelas:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
        }

        .btn-icon {
            font-size: 1.3rem;
            line-height: 1;
        }

        /* Table Wrapper */
        .table-wrapper {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #E5E7EB;
        }

        .table-responsive {
            overflow-x: auto;
        }

        /* Modern Table */
        .modern-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .modern-table thead {
            background: #F9FAFB;
        }

        .modern-table thead th {
            padding: 14px 16px;
            text-align: center;
            font-size: 0.8rem;
            font-weight: 700;
            color: #111827;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #E5E7EB;
            border-right: 1px solid #E5E7EB;
            white-space: nowrap;
        }

        .modern-table thead th:last-child {
            border-right: none;
        }

        .sortable {
            cursor: pointer;
            user-select: none;
            transition: background 0.2s;
        }

        .sortable:hover {
            background: #F3F4F6;
        }

        .sort-icon {
            margin-left: 4px;
            font-size: 0.875rem;
            color: #9CA3AF;
        }

        /* Table Body */
        .modern-table tbody tr {
            border-bottom: 1px solid #E5E7EB;
            background: white;
            transition: background 0.2s;
        }

        .modern-table tbody tr:hover {
            background: #F9FAFB;
        }

        .modern-table tbody tr:last-child {
            border-bottom: none;
        }

        .modern-table tbody td {
            padding: 16px;
            font-size: 0.875rem;
            color: #111827;
            vertical-align: middle;
            border-right: 1px solid #F3F4F6;
        }

        .modern-table tbody td:last-child {
            border-right: none;
        }

        .th-number,
        .td-number {
            width: 70px;
            text-align: center;
        }

        .th-nama,
        .td-nama {
            width: 35%;
            text-align: left;
        }

        .th-jenjang,
        .td-jenjang {
            width: 15%;
            text-align: center;
        }

        .th-siswa,
        .td-siswa {
            width: 12%;
            text-align: center;
        }

        .th-action,
        .td-action {
            width: 23%;
            text-align: center;
        }

        /* Table Header - Status Column */
        .th-status {
            width: 110px;
            text-align: center;
        }

        /* Table Data - Status Cell */
        .td-status {
            text-align: center;
            padding: 12px 8px;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.8125rem;
            font-weight: 600;
            text-transform: capitalize;
            white-space: nowrap;
        }

        /* Status Active (Hijau) */
        .status-active {
            background: #D1FAE5;
            color: #065F46;
            border: 1px solid #A7F3D0;
        }

        /* Status Inactive (Abu-abu) */
        .status-inactive {
            background: #F3F4F6;
            color: #6B7280;
            border: 1px solid #E5E7EB;
        }

        /* Status Dot Indicator */
        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-active .status-dot {
            background: #10B981;
            box-shadow: 0 0 0 2px #D1FAE5;
        }

        .status-inactive .status-dot {
            background: #9CA3AF;
            box-shadow: 0 0 0 2px #F3F4F6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .kelas-container {
                padding: 16px;
            }

            .section-header {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }

            .section-actions {
                flex-direction: column;
            }

            .btn-primary,
            .btn-secondary {
                width: 100%;
                justify-content: center;
            }

            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .kelas-table {
                min-width: 700px;
                /* Biar bisa scroll horizontal */
            }

            /* Status tetap tampil, tapi ukuran lebih kecil */
            .th-status {
                width: 90px;
                font-size: 0.75rem;
            }

            .td-status {
                padding: 10px 6px;
            }

            .status-badge {
                padding: 5px 10px;
                font-size: 0.75rem;
                gap: 4px;
            }

            .status-dot {
                width: 6px;
                height: 6px;
            }

            /* Hide kolom Siswa kalau space kurang */
            .th-siswa,
            .td-siswa {
                display: none;
                /* Siswa yang di-hide, bukan Status */
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.25rem;
            }

            .kelas-table {
                min-width: 600px;
            }

            /* Status tetap tampil dengan ukuran compact */
            .th-status {
                width: 80px;
            }

            .status-badge {
                padding: 4px 8px;
                font-size: 0.7rem;
            }

            .status-badge svg {
                display: none;
                /* Hide icon status di mobile kecil */
            }
        }

        /* Row Number */
        .row-number {
            font-weight: 700;
            font-size: 1.1rem;
            color: #111827;
        }

        /* Nama Kelas */
        .kelas-nama-text {
            font-weight: 600;
            font-size: 0.9375rem;
            color: #111827;
            line-height: 1.4;
        }

        /* Badge Jenjang */
        .jenjang-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
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

        /* Jumlah Siswa */
        .siswa-number {
            font-weight: 700;
            font-size: 1.1rem;
            color: #111827;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1.5px solid;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-detail {
            color: #0EA5E9;
            border-color: #BAE6FD;
        }

        .btn-detail:hover {
            background: #F0F9FF;
            border-color: #0EA5E9;
        }

        .btn-materi {
            color: #10B981;
            border-color: #A7F3D0;
        }

        .btn-materi:hover {
            background: #F0FDF4;
            border-color: #10B981;
        }

        .btn-edit {
            color: #F59E0B;
            border-color: #FDE68A;
        }

        .btn-edit:hover {
            background: #FFFBEB;
            border-color: #F59E0B;
        }

        .btn-hapus {
            color: #EF4444;
            border-color: #FECACA;
        }

        .btn-hapus:hover {
            background: #FEF2F2;
            border-color: #EF4444;
        }

        /* Pagination */
        .table-pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
            border-top: 2px solid #E5E7EB;
            background: #F9FAFB;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pagination-info {
            font-size: 0.875rem;
            color: #6B7280;
            font-weight: 500;
        }

        .pagination {
            display: flex;
            gap: 6px;
            margin: 0;
            padding: 0;
            list-style: none;
            flex-wrap: wrap;
        }

        .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            color: #374151;
            font-weight: 500;
            font-size: 0.875rem;
            text-decoration: none;
            background: white;
            transition: all 0.2s ease;
        }

        .page-link:hover {
            background: #F9FAFB;
            border-color: #0EA5E9;
            color: #0EA5E9;
        }

        .page-item.active .page-link {
            background: #0EA5E9;
            border-color: #0EA5E9;
            color: white;
            font-weight: 600;
        }

        .page-item.disabled .page-link {
            background: #F9FAFB;
            color: #D1D5DB;
            cursor: not-allowed;
            opacity: 0.5;
        }

        /* Empty State */
        .empty-state-table {
            padding: 60px 20px !important;
            text-align: center;
            background: #F9FAFB;
        }

        .empty-icon {
            font-size: 4rem;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .empty-content h4 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #111827;
            margin: 12px 0 8px;
        }

        .empty-content p {
            font-size: 0.9375rem;
            color: #6B7280;
            margin: 0 0 16px;
        }

        .btn-empty-action {
            display: inline-flex;
            padding: 12px 24px;
            background: linear-gradient(135deg, #0EA5E9, #06B6D4);
            color: white;
            border-radius: 10px;
            font-size: 0.9375rem;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
            transition: all 0.3s;
        }

        .btn-empty-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
        }

        /* ===== RESPONSIVE MOBILE - TABEL RAPAT & KECIL ===== */
        @media (max-width: 991px) {
            .welcome-banner-kelas {
                padding: 24px;
            }

            .welcome-content h2 {
                font-size: 1.5rem;
            }

            .section-title {
                font-size: 1.2rem;
            }

            .kelas-section {
                padding: 20px;
            }
        }

        @media (max-width: 767px) {

            /* Banner & Header - LEBIH COMPACT */
            .welcome-banner-kelas {
                padding: 16px;
                margin-bottom: 16px;
            }

            .welcome-content h2 {
                font-size: 1.15rem;
            }

            .welcome-content p {
                font-size: 0.75rem;
            }

            .kelas-section {
                padding: 10px;
            }

            .section-header {
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
                margin-bottom: 12px;
            }

            .section-title {
                font-size: 0.95rem;
            }

            .section-subtitle {
                font-size: 0.7rem;
            }

            .btn-tambah-kelas {
                width: 100%;
                justify-content: center;
                padding: 10px 16px;
                font-size: 0.8rem;
            }

            /* Table Mobile - TABEL SEPERTI DESKTOP TAPI KECIL & RAPAT */
            .table-wrapper {
                border-radius: 8px;
            }

            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .modern-table {
                font-size: 0.7rem;
                min-width: 100%;
            }

            .modern-table thead th {
                padding: 8px 6px;
                font-size: 0.6rem;
            }

            .modern-table tbody td {
                padding: 10px 6px;
            }

            /* Kolom Width Mobile - RAPAT */
            .th-number,
            .td-number {
                width: 35px;
                min-width: 35px;
            }

            .row-number {
                font-size: 0.85rem;
            }

            .th-nama,
            .td-nama {
                width: auto;
                min-width: 120px;
                max-width: 140px;
            }

            .kelas-nama-text {
                font-size: 0.75rem;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .th-jenjang,
            .td-jenjang {
                width: 55px;
                min-width: 55px;
            }

            .jenjang-badge {
                padding: 3px 8px;
                font-size: 0.65rem;
            }

            .th-siswa,
            .td-siswa {
                width: 45px;
                min-width: 45px;
            }

            .siswa-number {
                font-size: 0.9rem;
            }

            .th-action,
            .td-action {
                width: auto;
                min-width: 80px;
            }

            /* Action Buttons Mobile - Grid 2x2 RAPAT */
            .action-buttons {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 4px;
                max-width: 76px;
                margin: 0 auto;
            }

            .btn-action {
                width: 100%;
                height: 30px;
            }

            .btn-action svg {
                width: 13px;
                height: 13px;
            }

            /* Pagination Mobile */
            .table-pagination {
                flex-direction: column;
                align-items: center;
                padding: 8px;
                gap: 6px;
            }

            .pagination-info {
                font-size: 0.65rem;
                text-align: center;
            }

            .pagination {
                justify-content: center;
                gap: 3px;
            }

            .page-link {
                min-width: 28px;
                height: 28px;
                font-size: 0.7rem;
                padding: 0 6px;
            }
        }

        @media (max-width: 480px) {
            .welcome-content h2 {
                font-size: 1rem;
            }

            .section-title {
                font-size: 0.875rem;
            }

            .btn-tambah-kelas {
                font-size: 0.75rem;
                padding: 9px 14px;
            }

            .modern-table {
                font-size: 0.65rem;
            }

            .kelas-nama-text {
                font-size: 0.7rem;
            }

            .jenjang-badge {
                font-size: 0.6rem;
                padding: 2px 6px;
            }

            .siswa-number {
                font-size: 0.85rem;
            }

            .btn-action {
                height: 28px;
            }

            .btn-action svg {
                width: 12px;
                height: 12px;
            }
        }

        /* ===== CUSTOM SWEETALERT DELETE CONFIRMATION ===== */
        .swal-delete-popup {
            border-radius: 18px !important;
            box-shadow: 0 20px 60px rgba(239, 68, 68, 0.25) !important;
            overflow: hidden;
        }

        .swal-delete-content {
            padding: 32px 24px 20px;
            text-align: center;
            background: linear-gradient(135deg, #ffffff 0%, #fef2f2 100%);
        }

        .delete-icon-wrapper {
            margin: 0 auto 18px;
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #FEE2E2, #FECACA);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: delete-bounce 0.6s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }

        @keyframes delete-bounce {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .delete-icon-wrapper svg {
            width: 36px;
            height: 36px;
            color: #EF4444;
        }

        .swal-delete-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #0F172A;
            margin: 0 0 10px 0;
        }

        .swal-delete-text {
            font-size: 0.9rem;
            color: #64748B;
            line-height: 1.6;
            margin: 0 0 8px 0;
        }

        .swal-kelas-name {
            font-weight: 700;
            color: #EF4444;
            font-size: 1rem;
        }

        .swal-btn-confirm-delete {
            padding: 12px 28px;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            margin: 18px 6px;
            background: linear-gradient(135deg, #EF4444, #DC2626);
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.35);
        }

        .swal-btn-confirm-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.45);
        }

        .swal-btn-cancel-delete {
            padding: 12px 28px;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 18px 6px;
            background: white;
            color: #64748B;
            border: 2px solid #E5E7EB;
        }

        .swal-btn-cancel-delete:hover {
            background: #F8FAFC;
            border-color: #94A3B8;
        }
    </style>

    <script>
        // Sort Table Function
        function sortTable(columnIndex) {
            const table = document.getElementById('kelasTable');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr:not(.empty-state-table)'));

            const currentDir = tbody.getAttribute('data-sort-dir') || 'asc';
            const newDir = currentDir === 'asc' ? 'desc' : 'asc';
            tbody.setAttribute('data-sort-dir', newDir);

            rows.sort((a, b) => {
                const aText = a.cells[columnIndex].textContent.trim();
                const bText = b.cells[columnIndex].textContent.trim();

                const aNum = parseFloat(aText);
                const bNum = parseFloat(bText);

                if (columnIndex === 4) {
                    // Aktif = 1, Nonaktif = 0 (untuk sorting)
                    const aStatus = aText.toLowerCase() === 'aktif' ? 1 : 0;
                    const bStatus = bText.toLowerCase() === 'aktif' ? 1 : 0;
                    return newDir === 'asc' ? bStatus - aStatus : aStatus - bStatus;
                }

                return newDir === 'asc' ? aText.localeCompare(bText) : bText.localeCompare(aText);
            });

            rows.forEach(row => tbody.appendChild(row));

            const currentPage = {{ $daftarKelas->currentPage() ?? 1 }};
            const perPage = {{ $daftarKelas->perPage() ?? 10 }};
            rows.forEach((row, index) => {
                const numberSpan = row.querySelector('.row-number');
                if (numberSpan) {
                    numberSpan.textContent = ((currentPage - 1) * perPage) + index + 1;
                }
            });
        }

        // SweetAlert Delete Confirmation
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const form = this.closest('.delete-form');
                    const kelasNama = form.getAttribute('data-kelas-nama');

                    Swal.fire({
                        html: `
                            <div class="swal-delete-content">
                                <div class="delete-icon-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </div>
                                <h3 class="swal-delete-title">Hapus Kelas?</h3>
                                <p class="swal-delete-text">
                                    Yakin ingin menghapus kelas<br>
                                    <span class="swal-kelas-name">"${kelasNama}"</span>?
                                </p>
                                <p class="swal-delete-text" style="font-size:0.8rem;color:#94A3B8;margin-top:6px;">
                                    Tindakan ini tidak dapat dibatalkan.
                                </p>
                            </div>
                        `,
                        showCancelButton: true,
                        showCloseButton: true,
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        buttonsStyling: false,
                        customClass: {
                            popup: 'swal-delete-popup',
                            confirmButton: 'swal-btn-confirm-delete',
                            cancelButton: 'swal-btn-cancel-delete',
                            closeButton: 'swal-close-btn'
                        },
                        width: '420px',
                        padding: '0'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    {{-- POP-UP SUKSES --}}
    @if (session('success'))
        <style>
            .swal-success-popup {
                border-radius: 18px !important;
                box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2) !important;
                overflow: hidden;
            }

            .swal-success-content {
                padding: 28px 24px 0;
                text-align: center;
                background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            }

            .success-icon-wrapper {
                margin: 0 auto 18px;
                width: 65px;
                height: 65px;
                animation: success-bounce 0.7s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            }

            @keyframes success-bounce {
                0% {
                    transform: scale(0) rotate(-45deg);
                    opacity: 0;
                }

                50% {
                    transform: scale(1.1) rotate(10deg);
                }

                100% {
                    transform: scale(1) rotate(0deg);
                    opacity: 1;
                }
            }

            .success-checkmark {
                width: 100%;
                height: 100%;
            }

            .checkmark-circle {
                stroke-dasharray: 166;
                stroke-dashoffset: 166;
                stroke-width: 3;
                stroke: #10B981;
                fill: none;
                animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
            }

            .checkmark-check {
                transform-origin: 50% 50%;
                stroke-dasharray: 48;
                stroke-dashoffset: 48;
                stroke: #10B981;
                stroke-width: 3;
                animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.4s forwards;
            }

            @keyframes stroke {
                100% {
                    stroke-dashoffset: 0;
                }
            }

            .success-content {
                margin-bottom: 24px;
            }

            .success-title {
                font-size: 1.3rem;
                font-weight: 700;
                color: #0F172A;
                margin: 0 0 10px 0;
            }

            .success-message {
                font-size: 0.875rem;
                color: #64748B;
                line-height: 1.5;
                margin: 0;
            }

            .progress-bar-container {
                position: relative;
                width: calc(100% + 48px);
                height: 5px;
                background: linear-gradient(90deg, #E2E8F0 0%, #CBD5E1 100%);
                overflow: hidden;
                margin: 24px -24px 0;
            }

            .progress-bar {
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                width: 0;
                background: linear-gradient(90deg, #10B981 0%, #059669 50%, #047857 100%);
                box-shadow: 0 0 20px rgba(16, 185, 129, 0.7), 0 0 40px rgba(16, 185, 129, 0.4);
                animation: progress-glow 3.5s ease-out forwards;
            }

            @keyframes progress-glow {
                0% {
                    width: 0;
                    box-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
                }

                50% {
                    box-shadow: 0 0 25px rgba(16, 185, 129, 0.8), 0 0 50px rgba(16, 185, 129, 0.5);
                }

                100% {
                    width: 100%;
                    box-shadow: 0 0 15px rgba(16, 185, 129, 0.6), 0 0 30px rgba(16, 185, 129, 0.3);
                }
            }

            .swal-success-close-btn {
                position: absolute;
                top: 14px;
                right: 14px;
                width: 30px;
                height: 30px;
                background: rgba(241, 245, 249, 0.95);
                backdrop-filter: blur(10px);
                border-radius: 8px;
                border: none;
                cursor: pointer;
                transition: all 0.3s ease;
                font-size: 18px;
                color: #64748B;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10;
            }

            .swal-success-close-btn:hover {
                background: #E2E8F0;
                color: #334155;
                transform: scale(1.15) rotate(90deg);
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    html: `
                <div class="swal-success-content">
                    <div class="success-icon-wrapper">
                        <svg class="success-checkmark" viewBox="0 0 52 52">
                            <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                            <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                        </svg>
                    </div>
                    <div class="success-content">
                        <h3 class="success-title">🎉 Berhasil!</h3>
                        <p class="success-message">{{ session('success') }}</p>
                    </div>
                    <div class="progress-bar-container">
                        <div class="progress-bar"></div>
                    </div>
                </div>
            `,
                    showConfirmButton: false,
                    showCloseButton: true,
                    allowOutsideClick: true,
                    timer: 3500,
                    timerProgressBar: false,
                    customClass: {
                        popup: 'swal-success-popup',
                        closeButton: 'swal-success-close-btn'
                    },
                    width: '400px',
                    padding: '0'
                });
            });
        </script>
    @endif

@endsection
