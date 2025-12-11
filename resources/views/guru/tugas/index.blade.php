@extends('layouts.guru')

@section('title', 'Daftar Kuis & Ujian')

@section('content')
<style>
    :root {
        --primary: #0EA5E9;
        --primary-hover: #0284C7;
        --primary-light: #E0F2FE;
        --secondary: #64748B;
        --success: #10B981;
        --danger: #EF4444;
        --text-primary: #0F172A;
        --text-secondary: #64748B;
        --bg-light: #F8FAFC;
        --border: #E5E7EB;
    }

    .tugas-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 24px;
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: white;
        color: var(--text-secondary);
        border: 2px solid var(--border);
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .btn-back:hover {
        background: var(--bg-light);
        border-color: var(--primary);
        color: var(--primary);
        transform: translateX(-4px);
    }

    .btn-back svg {
        transition: transform 0.3s ease;
    }

    .btn-back:hover svg {
        transform: translateX(-3px);
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
    }

    .header-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        background: linear-gradient(135deg, var(--primary), var(--primary-hover));
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
        color: white;
    }

    .alert {
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: slideDown 0.4s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda, #c3f0d6);
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .table-container {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: linear-gradient(135deg, var(--primary-light), #F0F9FF);
        color: var(--primary);
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 16px;
        text-align: left;
        border-bottom: 2px solid var(--primary);
    }

    td {
        padding: 16px;
        color: var(--text-primary);
        border-bottom: 1px solid var(--border);
        font-size: 0.95rem;
    }

    tr:hover {
        background: var(--bg-light);
    }

    .badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .badge-kuis {
        background: #DBEAFE;
        color: #1E40AF;
    }

    .badge-ujian {
        background: #FEF3C7;
        color: #92400E;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        border: 2px solid;
        transition: all 0.3s ease;
    }

    .btn-kelola {
        background: white;
        color: var(--primary);
        border-color: var(--primary);
    }

    .btn-kelola:hover {
        background: var(--primary);
        color: white;
    }

    .btn-delete {
        background: white;
        color: var(--danger);
        border-color: var(--danger);
        cursor: pointer;
    }

    .btn-delete:hover {
        background: var(--danger);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 48px 20px;
        color: var(--text-secondary);
    }

    .action-group {
        display: flex;
        gap: 8px;
    }
</style>

<div class="tugas-container">
    <a href="{{ route('guru.materi_pembelajaran.index', $kelas->id) }}" class="btn-back">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" 
             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>

    <div class="header-section">
        <h1 class="header-title">Daftar Kuis & Ujian - {{ $kelas->nama }}</h1>
        <a href="{{ route('guru.tugas.create', $kelas->id) }}" class="btn-add">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" 
                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Tambah Kuis / Ujian
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" 
                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tipe</th>
                    <th>Deadline</th>
                    <th>Jumlah Soal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($tugasList as $tugas)
                <tr>
                    <td><strong>{{ $tugas->judul }}</strong></td>
                    <td>
                        @if($tugas->tipe === 'kuis')
                            <span class="badge badge-kuis">Kuis</span>
                        @else
                            <span class="badge badge-ujian">{{ ucwords(str_replace('_', ' ', $tugas->tipe)) }}</span>
                        @endif
                    </td>
                    <td>{{ $tugas->deadline ? \Carbon\Carbon::parse($tugas->deadline)->format('d M Y, H:i') : '-' }}</td>
                    <td>{{ $tugas->soals->count() }} soal</td>
                    <td>
                        <div class="action-group">
                            <a href="{{ route('guru.tugas.soal.edit', [$kelas->id, $tugas->id]) }}" class="btn-action btn-kelola">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Edit Soal
                            </a>

                            <form action="{{ route('guru.tugas.destroy', [$kelas->id, $tugas->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kuis/ujian ini beserta semua soal?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" 
                             fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:12px; opacity:0.4;">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                        </svg>
                        <p style="font-size:1rem; font-weight:600; margin:0;">Belum ada kuis atau ujian.</p>
                        <p style="font-size:0.9rem; margin-top:6px;">Klik tombol "Tambah Kuis / Ujian" untuk membuat yang baru.</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
