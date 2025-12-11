@extends('layouts.app')

@section('title', 'Laporan Data Kelas')

@section('content')
    <style>
        /* Filter card enhancements */
        .report-actions {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        /* tombol */
        .btn-reset,
        .btn-export {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 10px;
            font-weight: 600;
            border: 1px solid transparent;
            cursor: pointer;
            text-decoration: none;
        }

        /* Reset (outlined) */
        .btn-reset {
            background: white;
            color: #0b2b40;
            border-color: #d0d7df;
            box-shadow: 0 2px 6px rgba(11, 43, 64, 0.04);
            margin-bottom: 10px; 
        }

        .btn-reset:hover {
            background: #f6f8fa;
        }

        /* Export (solid green) */
        .btn-export {
            background: linear-gradient(180deg, #16a34a, #0ea05a);
            color: white;
            border-color: transparent;
            box-shadow: 0 6px 18px rgba(16, 185, 129, 0.12);
            margin-bottom: 10px; 
        }

        .btn-export:hover {
            filter: brightness(0.95);
        }

        /* small icon sizing */
        .btn-export svg,
        .btn-reset svg {
            width: 16px;
            height: 16px;
        }

        /* total badge */
        .total-badge {
            display: inline-block;
            background: #f1f5f9;
            color: #0b2b40;
            border-radius: 999px;
            padding: 6px 10px;
            font-weight: 700;
            margin-left: 8px;
        }

        /* ensure buttons align on small screens */
        @media (max-width: 575px) {
            .report-actions {
                width: 100%;
            }

            .report-actions>* {
                flex: 1 1 100%;
            }
        }
    </style>

    <div class="col-md-4">
        <label class="form-label mb-1">&nbsp;</label>

        <div class="report-actions">
            <!-- Reset button -->
            <a href="{{ route('admin.laporan') }}" class="btn-reset" title="Reset filter">
                <!-- icon: arrow-undo -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v6h6" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 11a8 8 0 10-8 8" />
                </svg>
                Reset
            </a>

            <!-- Export CSV button -->
            <a href="{{ route('admin.laporan.export', request()->only('tahun_ajaran')) }}" class="btn-export"
                title="Export CSV">
                <!-- icon: download -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v12" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11l4 4 4-4" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21H3" />
                </svg>
                Export CSV
            </a>

            <!-- Optional: total count badge -->
            <div class="total-badge" aria-hidden="true">
                Total: <span style="margin-left:6px">{{ $laporan->count() }}</span>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th>Nama Guru</th>
                        <th>Nama Kelas</th>
                        <th>Durasi Mengajar</th>
                        <th>Tahun Ajaran</th>
                        <th>Status Guru</th>
                        <th>Siswa Aktif</th>
                        <th>Jenjang</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($laporan as $r)
                        <tr>
                            <td>{{ $r->nama_guru }}</td>
                            <td>{{ $r->nama_kelas }}</td>
                            <td>{{ $r->durasi_pengajaran ?? '-' }}</td>
                            <td class="text-center">{{ $r->tahun_ajaran }}</td>
                            <td class="text-center">{{ $r->status_guru }}</td>
                            <td class="text-center">{{ $r->siswa_aktif ?? '-' }}</td>
                            <td class="text-center">{{ $r->jenjang_pendidikan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
    </div>
@endsection