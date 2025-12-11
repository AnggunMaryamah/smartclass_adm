@extends('layouts.siswa')

@section('title', 'Kelas yang Diselesaikan')

@section('content')
<div class="container-fluid px-4 py-4">
    {{-- Header --}}
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title mb-2">Kelas yang Diselesaikan</h1>
                <p class="text-muted mb-0">Riwayat kelas yang telah Anda selesaikan</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('siswa.kelas.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Kelas Aktif
                </a>
            </div>
        </div>
    </div>

    {{-- Alert jika ada --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Statistik --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Total Kelas Selesai</div>
                    <div class="stat-value">{{ $kelasSelesai->count() }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar Kelas Selesai --}}
    @if($kelasSelesai->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h3 class="empty-title">Belum ada kelas yang diselesaikan</h3>
            <p class="empty-text">Kelas yang sudah Anda selesaikan akan muncul di sini</p>
            <a href="{{ route('siswa.kelas.index') }}" class="btn btn-primary mt-3">
                <i class="fas fa-book-open me-2"></i>Lihat Kelas Aktif
            </a>
        </div>
    @else
        <div class="row">
            @foreach($kelasSelesai as $siswaKelas)
                @php
                    $kelas = $siswaKelas->kelas;
                    $completedDate = $siswaKelas->completed_at;
                @endphp
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="class-card completed">
                        {{-- Badge Selesai --}}
                        <div class="completion-badge">
                            <i class="fas fa-check-circle me-1"></i>Selesai
                        </div>

                        {{-- Thumbnail --}}
                        <div class="class-thumbnail">
                            @if($kelas->thumbnail)
                                <img src="{{ asset('storage/' . $kelas->thumbnail) }}" alt="{{ $kelas->nama_kelas }}">
                            @else
                                <img src="{{ asset('images/default-class.jpg') }}" alt="Default thumbnail">
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="class-content">
                            <div class="class-category">
                                <i class="fas fa-bookmark me-1"></i>
                                {{ $kelas->jenjang_pendidikan ?? 'Umum' }}
                            </div>

                            <h3 class="class-title">{{ $kelas->nama_kelas }}</h3>

                            <div class="class-meta">
                                <div class="meta-item">
                                    <i class="fas fa-user-tie"></i>
                                    <span>{{ $kelas->guru->name ?? 'Guru' }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-calendar-check"></i>
                                    <span>{{ $completedDate->format('d M Y') }}</span>
                                </div>
                            </div>

                            {{-- Progress Bar --}}
                            <div class="progress-wrapper">
                                <div class="progress-label">
                                    <span>Progress</span>
                                    <span class="fw-bold">100%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="class-actions">
                                <a href="{{ route('siswa.kelas.read', ['kelas' => $kelas->id]) }}" 
                                   class="btn btn-outline-primary btn-sm w-100">
                                    <i class="fas fa-book-open me-2"></i>Review Materi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .page-header {
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 0.5rem;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #ffffff;
        flex-shrink: 0;
    }

    .stat-icon.bg-success {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .stat-content {
        flex: 1;
    }

    .stat-label {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a202c;
    }

    .empty-state {
        background: #ffffff;
        border-radius: 16px;
        padding: 4rem 2rem;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .empty-icon {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 3rem;
        color: #0ea5e9;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 0.5rem;
    }

    .empty-text {
        color: #6b7280;
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }

    .class-card {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .class-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        transform: translateY(-4px);
    }

    .completion-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: linear-gradient(135deg, #10b981, #059669);
        color: #ffffff;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        font-size: 0.875rem;
        font-weight: 600;
        z-index: 10;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .class-thumbnail {
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .class-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .class-content {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .class-category {
        display: inline-flex;
        align-items: center;
        background: #e0f2fe;
        color: #0369a1;
        padding: 0.375rem 0.75rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        width: fit-content;
    }

    .class-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 0.75rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .class-meta {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .meta-item i {
        width: 16px;
        text-align: center;
        color: #9ca3af;
    }

    .progress-wrapper {
        margin-bottom: 1rem;
        margin-top: auto;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .progress {
        height: 8px;
        background-color: #e5e7eb;
        border-radius: 999px;
        overflow: hidden;
    }

    .progress-bar {
        transition: width 0.6s ease;
    }

    .class-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-outline-primary {
        border: 2px solid #0ea5e9;
        color: #0ea5e9;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-outline-primary:hover {
        background: #0ea5e9;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    @media (max-width: 768px) {
        .page-header .row {
            flex-direction: column;
            gap: 1rem;
        }

        .page-header .col-auto {
            width: 100%;
        }

        .page-header .btn {
            width: 100%;
        }
    }
</style>
@endsection
