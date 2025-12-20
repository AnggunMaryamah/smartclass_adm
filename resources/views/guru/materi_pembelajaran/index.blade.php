@extends('layouts.guru')

@section('title', 'Daftar Materi')

@section('content')
    <div class="materi-container">
        {{-- Header --}}
        <div class="materi-header">
            <div class="header-left">
                <h1 class="page-title">Daftar Materi</h1>
                <p class="page-subtitle">{{ $kelas->nama_kelas }} • {{ $materis->total() }} Materi</p>
                <p class="page-helper">
                    Gunakan <strong>Bacaan</strong> untuk materi teks, <strong>Kuis</strong> untuk latihan di akhir subbab,
                    dan <strong>Ujian</strong> untuk evaluasi akhir bab / akhir kelas.
                </p>
            </div>
            <div class="header-right">
                <a href="{{ route('guru.kelas.index') }}" class="btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Kembali
                </a>
                <a href="{{ route('guru.materi_pembelajaran.create', $kelas->id) }}" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Tambah Materi
                </a>
                <a href="{{ route('guru.tugas.index', $kelas->id) }}" class="btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Tambah Tugas
                </a>
            </div>
        </div>

        {{-- Alert Success --}}
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                <div class="alert-content">
                    <svg class="alert-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="alert-close" onclick="closeAlert()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        @endif

        {{-- Table Card --}}
        <div class="table-card">
            {{-- Table Container --}}
            <div class="table-container">
                <table class="materi-table">
                    <thead>
                        <tr>
                            <th class="col-no">NO</th>
                            <th class="col-judul">JUDUL MATERI</th>
                            <th class="col-tipe">JENIS</th>
                            <th class="col-keterangan">KETERANGAN</th>
                            <th class="col-aksi">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materis as $index => $materi)
                            <tr>
                                {{-- NO (dengan perhitungan pagination) --}}
                                <td class="text-center">
                                    <span class="no-text">{{ $materis->firstItem() + $index }}</span>
                                </td>

                                {{-- JUDUL MATERI --}}
                                <td>
                                    <div class="materi-title-wrapper">
                                        <svg class="title-icon" xmlns="http://www.w3.org/2000/svg" width="18"
                                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                        </svg>
                                        <span class="materi-title">{{ $materi->judul }}</span>
                                    </div>
                                </td>

                                {{-- JENIS --}}
                                <td>
                                    <div class="tipe-badge tipe-{{ $materi->tipe }}">
                                        @if ($materi->tipe === 'bacaan')
                                            <svg class="tipe-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z">
                                                </path>
                                            </svg>
                                            <span>Bacaan</span>
                                        @elseif($materi->tipe === 'kuis')
                                            <svg class="tipe-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 20h9"></path>
                                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                            </svg>
                                            <span>Kuis</span>
                                        @elseif($materi->tipe === 'ujian')
                                            <svg class="tipe-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="16" y1="13" x2="8" y2="13">
                                                </line>
                                                <line x1="16" y1="17" x2="8" y2="17">
                                                </line>
                                                <polyline points="10 9 9 9 8 9"></polyline>
                                            </svg>
                                            <span>Ujian</span>
                                        @endif
                                    </div>
                                </td>

                                {{-- KETERANGAN --}}
                                <td>
                                    @if ($materi->keterangan)
                                        <span class="keterangan-text">{{ Str::limit($materi->keterangan, 50) }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif

                                    @if ($materi->file_path)
                                        <div class="file-indicator">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                            </svg>
                                            <span>PDF</span>
                                        </div>
                                    @endif

                                    @if ($materi->video_url)
                                        <div class="video-indicator">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polygon points="23 7 16 12 23 17 23 7"></polygon>
                                                <rect x="1" y="5" width="15" height="14" rx="2"
                                                    ry="2"></rect>
                                            </svg>
                                            <span>Video</span>
                                        </div>
                                    @endif
                                    @if(in_array($materi->tipe, ['kuis', 'ujian']) && $materi->tugas)
                                        <div class="soal-indicator">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                            </svg>
                                            <span>{{ $materi->tugas->soals->count() }} soal</span>
                                        </div>
                                    @endif
                                </td>

                                {{-- AKSI --}}
                                <td>
                                    <div class="action-buttons">
                                        @if ($materi->tipe === 'bacaan')
                                            {{-- ========== BACAAN: Edit Materi ========== --}}
                                            <a href="{{ route('guru.materi_pembelajaran.edit', [$kelas->id, $materi->id]) }}"
                                                class="btn-edit" title="Edit Materi">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                    </path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4z"></path>
                                                </svg>
                                            </a>
                                        @else
                                            {{-- ========== KUIS / UJIAN ========== --}}

                                            {{-- 1. Tombol Kelola Soal --}}
                                            @if ($materi->tugas_id)
                                                <a href="{{ route('guru.tugas.soal.edit', [$kelas->id, $materi->tugas_id]) }}"
                                                    class="btn-kelola-soal" title="Kelola Soal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                        </path>
                                                        <polyline points="14 2 14 8 20 8"></polyline>
                                                    </svg>
                                                </a>
                                            @endif

                                            {{-- 2. Badge Status dengan Publish/Unpublish --}}
                                            @php
                                                $tugas = \App\Models\Tugas::find($materi->tugas_id);
                                            @endphp

                                            @if ($tugas)
                                                @if ($tugas->status === 'active')
                                                    {{-- Status Aktif: Tombol Unpublish --}}
                                                    <button type="button" class="btn-status btn-status-active"
                                                        onclick="openUnpublishModal('{{ $tugas->id }}', '{{ $materi->judul }}')"
                                                        title="Klik untuk Unpublish">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                            height="14" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg>
                                                        Aktif
                                                    </button>
                                                @else
                                                    {{-- Status Draft: Tombol Publish --}}
                                                    <button type="button" class="btn-status btn-status-draft"
                                                        onclick="openPublishModal('{{ $tugas->id }}', '{{ $materi->judul }}')"
                                                        title="Klik untuk Publish">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                            height="14" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                        </svg>
                                                        Draft
                                                    </button>
                                                @endif

                                                {{-- Form Hidden untuk Publish --}}
                                                <form id="publish-form-{{ $tugas->id }}"
                                                    action="{{ route('guru.tugas.publish', [$kelas->id, $tugas->id]) }}"
                                                    method="POST" style="display:none;">
                                                    @csrf
                                                </form>

                                                {{-- Form Hidden untuk Unpublish --}}
                                                <form id="unpublish-form-{{ $tugas->id }}"
                                                    action="{{ route('guru.tugas.unpublish', [$kelas->id, $tugas->id]) }}"
                                                    method="POST" style="display:none;">
                                                    @csrf
                                                </form>
                                            @endif
                                        @endif

                                        {{-- 3. Tombol Hapus (selalu ada) --}}
                                        <button type="button" class="btn-delete"
                                            onclick="openDeleteModal('{{ $materi->id }}', '{{ $materi->judul }}')"
                                            title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6l-1 14H6L5 6"></path>
                                                <path d="M10 11v6"></path>
                                                <path d="M14 11v6"></path>
                                                <path d="M9 6l1-3h4l1 3"></path>
                                            </svg>
                                        </button>

                                        <form id="delete-form-{{ $materi->id }}"
                                            action="{{ route('guru.materi_pembelajaran.destroy', [$kelas->id, $materi->id]) }}"
                                            method="POST" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <svg class="empty-icon" xmlns="http://www.w3.org/2000/svg" width="48"
                                        height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                    </svg>
                                    <p class="empty-text">Belum ada materi</p>
                                    <a href="{{ route('guru.materi_pembelajaran.create', $kelas->id) }}"
                                        class="btn-add-first">
                                        Tambah Materi Pertama
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- ✅ PAGINATION (SELALU TAMPIL) --}}
            @if ($materis->total() > 0)
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        <span class="pagination-text">
                            Menampilkan {{ $materis->firstItem() }} - {{ $materis->lastItem() }} dari
                            {{ $materis->total() }} materi
                        </span>
                    </div>

                    <div class="pagination-buttons">
                        {{-- ✅ TOMBOL PREVIOUS (KIRI) --}}
                        @if ($materis->onFirstPage())
                            <button class="page-btn disabled" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="15 18 9 12 15 6"></polyline>
                                </svg>
                            </button>
                        @else
                            <a href="{{ $materis->previousPageUrl() }}" class="page-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="15 18 9 12 15 6"></polyline>
                                </svg>
                            </a>
                        @endif

                        {{-- ✅ NOMOR HALAMAN --}}
                        @if ($materis->lastPage() > 1)
                            @php
                                $start = max(1, $materis->currentPage() - 2);
                                $end = min($materis->lastPage(), $materis->currentPage() + 2);
                            @endphp

                            {{-- First page --}}
                            @if ($start > 1)
                                <a href="{{ $materis->url(1) }}" class="page-number">1</a>
                                @if ($start > 2)
                                    <span class="page-dots">...</span>
                                @endif
                            @endif

                            {{-- Page numbers --}}
                            @for ($page = $start; $page <= $end; $page++)
                                @if ($page == $materis->currentPage())
                                    <span class="page-number active">{{ $page }}</span>
                                @else
                                    <a href="{{ $materis->url($page) }}" class="page-number">{{ $page }}</a>
                                @endif
                            @endfor

                            {{-- Last page --}}
                            @if ($end < $materis->lastPage())
                                @if ($end < $materis->lastPage() - 1)
                                    <span class="page-dots">...</span>
                                @endif
                                <a href="{{ $materis->url($materis->lastPage()) }}"
                                    class="page-number">{{ $materis->lastPage() }}</a>
                            @endif
                        @else
                            {{-- ✅ JIKA HANYA 1 HALAMAN --}}
                            <span class="page-number active">1</span>
                        @endif

                        {{-- ✅ TOMBOL NEXT (KANAN) --}}
                        @if ($materis->hasMorePages())
                            <a href="{{ $materis->nextPageUrl() }}" class="page-btn">
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

    {{-- Modal Konfirmasi Hapus --}}
    <div id="deleteModal" class="modal" style="display: none;">
        <div class="modal-overlay" onclick="closeDeleteModal()"></div>
        <div class="modal-content">
            <div class="modal-icon-wrapper">
                <div class="modal-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
            </div>
            <h3 class="modal-title">Yakin ingin menghapus materi ini?</h3>
            <p class="modal-message" id="materiName"></p>
            <div class="modal-actions">
                <button type="button" class="modal-btn btn-cancel" onclick="closeDeleteModal()">Batal</button>
                <button type="button" class="modal-btn btn-confirm" onclick="confirmDelete()">Hapus</button>
            </div>
        </div>
    </div>
    {{-- Modal Publish --}}
    <div id="publishModal" class="modal" style="display: none;">
        <div class="modal-overlay" onclick="closePublishModal()"></div>
        <div class="modal-content">
            <div class="modal-icon-wrapper">
                <div class="modal-icon" style="background: linear-gradient(135deg, #D1FAE5, #A7F3D0);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                        fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
            </div>
            <h3 class="modal-title">Publish Kuis/Ujian?</h3>
            <p class="modal-message" id="publishMateriName"></p>
            <p style="font-size: 0.875rem; color: var(--text-secondary); margin-bottom: 24px;">
                Siswa akan bisa mengerjakan kuis ini setelah dipublish.
            </p>
            <div class="modal-actions">
                <button type="button" class="modal-btn btn-cancel" onclick="closePublishModal()">Batal</button>
                <button type="button" class="modal-btn"
                    style="background: linear-gradient(135deg, #10B981, #059669); color: white;"
                    onclick="confirmPublish()">
                    Publish
                </button>
            </div>
        </div>
    </div>

    {{-- Modal Unpublish --}}
    <div id="unpublishModal" class="modal" style="display: none;">
        <div class="modal-overlay" onclick="closeUnpublishModal()"></div>
        <div class="modal-content">
            <div class="modal-icon-wrapper">
                <div class="modal-icon" style="background: linear-gradient(135deg, #FEF3C7, #FDE68A);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                        fill="none" stroke="#F59E0B" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                        <line x1="3" y1="3" x2="21" y2="21"></line>
                    </svg>
                </div>
            </div>
            <h3 class="modal-title">Unpublish Kuis/Ujian?</h3>
            <p class="modal-message" id="unpublishMateriName"></p>
            <p style="font-size: 0.875rem; color: var(--text-secondary); margin-bottom: 24px;">
                Siswa tidak akan bisa mengakses kuis ini setelah di-unpublish.
            </p>
            <div class="modal-actions">
                <button type="button" class="modal-btn btn-cancel" onclick="closeUnpublishModal()">Batal</button>
                <button type="button" class="modal-btn"
                    style="background: linear-gradient(135deg, #F59E0B, #D97706); color: white;"
                    onclick="confirmUnpublish()">
                    Unpublish
                </button>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary: #0EA5E9;
            --primary-hover: #0284C7;
            --primary-light: #E0F2FE;
            --success: #10B981;
            --success-bg: #D1FAE5;
            --success-border: #A7F3D0;
            --danger: #EF4444;
            --danger-hover: #DC2626;
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

        .materi-container {
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

        /* ===== HEADER ===== */
        .materi-header {
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

        .page-helper {
            margin-top: 4px;
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .header-right {
            display: flex;
            gap: 12px;
        }

        .btn-primary,
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0EA5E9, #0284C7);
            color: white;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
        }

        .btn-secondary {
            background: white;
            color: var(--text-secondary);
            border: 2px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--bg-light);
            border-color: var(--primary);
            color: var(--primary);
        }

        /* ===== ALERT ===== */
        .alert {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            animation: slideDown 0.4s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(-10px);
            }
        }

        .alert-success {
            background: var(--success-bg);
            color: #065F46;
            border: 1px solid var(--success-border);
        }

        .alert-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-icon {
            flex-shrink: 0;
            color: var(--success);
        }

        .alert-close {
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all 0.3s ease;
            color: #065F46;
        }

        .alert-close:hover {
            background: rgba(16, 185, 129, 0.1);
        }

        /* ===== TABLE CARD ===== */
        .table-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .table-container {
            overflow-x: auto;
        }

        .materi-table {
            width: 100%;
            border-collapse: collapse;
        }

        .materi-table thead {
            background: linear-gradient(135deg, #0EA5E9 0%, #0284C7 100%);
        }

        .materi-table th {
            padding: 18px 20px;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-right: 1px solid rgba(255, 255, 255, 0.2);
        }

        .materi-table th:last-child {
            border-right: none;
        }

        .materi-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .materi-table tbody tr:hover {
            background: var(--primary-light);
        }

        .materi-table tbody tr:last-child {
            border-bottom: none;
        }

        .materi-table td {
            padding: 20px;
            font-size: 0.95rem;
            color: var(--text-primary);
            vertical-align: middle;
            border-right: 1px solid var(--border);
        }

        .materi-table td:last-child {
            border-right: none;
        }

        .col-no {
            width: 80px;
            text-align: center;
        }

        .col-judul {
            width: 30%;
        }

        .col-tipe {
            width: 15%;
        }

        .col-keterangan {
            width: 30%;
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

        .materi-title-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .title-icon {
            color: var(--primary);
            flex-shrink: 0;
        }

        .materi-title {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.95rem;
        }

        .tipe-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .tipe-bacaan {
            background: linear-gradient(135deg, #DBEAFE 0%, #E0F2FE 100%);
            color: #0369A1;
            border: 1px solid #BAE6FD;
        }

        .tipe-kuis {
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
            color: #92400E;
            border: 1px solid #FCD34D;
        }

        .tipe-ujian {
            background: linear-gradient(135deg, #FECACA 0%, #FCA5A5 100%);
            color: #991B1B;
            border: 1px solid #F87171;
        }

        .keterangan-text {
            display: block;
            color: var(--text-secondary);
            font-size: 0.875rem;
            margin-bottom: 6px;
        }

        .file-indicator,
        .video-indicator {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-right: 6px;
            margin-top: 4px;
        }

        .video-indicator {
            background: #FEF3C7;
            color: #92400E;
        }
        .soal-indicator {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            background: linear-gradient(135deg, #DBEAFE, #BFDBFE);
            color: #1E40AF;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 6px;
        }

        .soal-indicator svg {
            color: #1E40AF;
            flex-shrink: 0;
        }

        .text-muted {
            color: #9CA3AF;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .btn-edit,
        .btn-delete,
        .btn-kelola-soal {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background: var(--primary-light);
            color: var(--primary);
        }

        .btn-edit:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        .btn-kelola-soal {
            background: #DBEAFE;
            color: #1D4ED8;
        }

        .btn-kelola-soal:hover {
            background: #1D4ED8;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
        }

        .btn-delete {
            background: #FEE2E2;
            color: var(--danger);
        }

        .btn-delete:hover {
            background: var(--danger);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        /* ===== TOMBOL STATUS PUBLISH/UNPUBLISH ===== */
        .btn-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .btn-status-active {
            background: linear-gradient(135deg, #D1FAE5, #A7F3D0);
            color: #065F46;
            border: 1px solid #6EE7B7;
        }

        .btn-status-active:hover {
            background: #10B981;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-status-draft {
            background: linear-gradient(135deg, #FEF3C7, #FDE68A);
            color: #92400E;
            border: 1px solid #FCD34D;
        }

        .btn-status-draft:hover {
            background: #F59E0B;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
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

        .btn-add-first {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(135deg, #0EA5E9, #0284C7);
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-add-first:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
        }

        /* ===== PAGINATION ===== */
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
            font-size: 0.875rem;
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
            font-size: 0.95rem;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .page-btn {
            background: white;
            color: var(--text-secondary);
            border: 2px solid var(--border);
        }

        .page-btn:not(.disabled):hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        .page-btn.disabled {
            background: var(--bg-light);
            color: #CBD5E1;
            border-color: var(--border);
            cursor: not-allowed;
            opacity: 0.5;
        }

        .page-number {
            background: white;
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
            color: white;
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        .page-dots {
            color: var(--text-secondary);
            padding: 0 8px;
            font-weight: 700;
        }

        /* ===== MODAL ===== */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
        }

        .modal-content {
            position: relative;
            background: white;
            border-radius: 20px;
            padding: 40px 32px 32px;
            max-width: 440px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: scaleUp 0.3s ease;
            text-align: center;
        }

        @keyframes scaleUp {
            from {
                transform: scale(0.9);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal-icon-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 24px;
        }

        .modal-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .modal-icon svg {
            color: var(--danger);
            width: 48px;
            height: 48px;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 12px;
        }

        .modal-message {
            font-size: 1rem;
            color: var(--text-secondary);
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .modal-btn {
            flex: 1;
            padding: 14px 24px;
            border-radius: 12px;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel {
            background: var(--bg-light);
            color: var(--text-secondary);
            border: 2px solid var(--border);
        }

        .btn-cancel:hover {
            background: white;
            border-color: var(--text-secondary);
            color: var(--text-primary);
        }

        .btn-confirm {
            background: linear-gradient(135deg, #EF4444, #DC2626);
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .materi-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-right {
                width: 100%;
                justify-content: space-between;
            }

            .col-no {
                width: 60px;
            }

            .col-keterangan {
                display: none;
            }

            .pagination-wrapper {
                flex-direction: column;
                gap: 12px;
            }

            .pagination-buttons {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {

            .btn-primary,
            .btn-secondary {
                padding: 10px 16px;
                font-size: 0.875rem;
            }

            .modal-actions {
                flex-direction: column;
            }

            .modal-btn {
                width: 100%;
            }

            .page-btn,
            .page-number {
                width: 36px;
                height: 36px;
                font-size: 0.875rem;
            }
        }
    </style>

    <script>
        let deleteMateriId = null;

        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(function() {
                    closeAlert();
                }, 5000);
            }
        });

        function closeAlert() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.animation = 'slideUp 0.3s ease';
                setTimeout(function() {
                    alert.remove();
                }, 300);
            }
        }

        function openDeleteModal(materiId, materiNama) {
            deleteMateriId = materiId;
            document.getElementById('materiName').textContent = materiNama;
            document.getElementById('deleteModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
            document.body.style.overflow = 'auto';
            deleteMateriId = null;
        }

        function confirmDelete() {
            if (deleteMateriId) {
                document.getElementById('delete-form-' + deleteMateriId).submit();
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDeleteModal();
            }
        });
        let publishTugasId = null;
        let unpublishTugasId = null;

        function openPublishModal(tugasId, materiNama) {
            publishTugasId = tugasId;
            document.getElementById('publishMateriName').textContent = materiNama;
            document.getElementById('publishModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closePublishModal() {
            document.getElementById('publishModal').style.display = 'none';
            document.body.style.overflow = 'auto';
            publishTugasId = null;
        }

        function confirmPublish() {
            if (publishTugasId) {
                document.getElementById('publish-form-' + publishTugasId).submit();
            }
        }

        function openUnpublishModal(tugasId, materiNama) {
            unpublishTugasId = tugasId;
            document.getElementById('unpublishMateriName').textContent = materiNama;
            document.getElementById('unpublishModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeUnpublishModal() {
            document.getElementById('unpublishModal').style.display = 'none';
            document.body.style.overflow = 'auto';
            unpublishTugasId = null;
        }

        function confirmUnpublish() {
            if (unpublishTugasId) {
                document.getElementById('unpublish-form-' + unpublishTugasId).submit();
            }
        }

        // Update event listener Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDeleteModal();
                closePublishModal();
                closeUnpublishModal();
            }
        });
    </script>
@endsection
