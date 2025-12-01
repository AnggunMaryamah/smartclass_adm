@extends('layouts.guru')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Laporan Hasil Belajar</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('guru.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('guru.laporan_siswa.index') }}">Laporan Siswa</a></li>
        <li class="breadcrumb-item"><a href="{{ route('guru.laporan_siswa.detail', $siswa->id) }}">Detail {{ $siswa->nama_lengkap }}</a></li>
        <li class="breadcrumb-item active">Tambah Laporan</li>
    </ol>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-plus-circle me-1"></i>
            Form Input Laporan - {{ $siswa->nama_lengkap }}
        </div>
        <div class="card-body">
            <form action="{{ route('guru.laporan_siswa.store') }}" method="POST">
                @csrf
                <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Jenis Penilaian <span class="text-danger">*</span></label>
                        <select name="jenis_penilaian" class="form-select @error('jenis_penilaian') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="kuis" {{ old('jenis_penilaian') == 'kuis' ? 'selected' : '' }}>Kuis</option>
                            <option value="ujian" {{ old('jenis_penilaian') == 'ujian' ? 'selected' : '' }}>Ujian Akhir</option>
                        </select>
                        @error('jenis_penilaian')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Materi Pembelajaran <span class="text-danger">*</span></label>
                        <input type="text" name="materi_pembelajaran" class="form-control @error('materi_pembelajaran') is-invalid @enderror" value="{{ old('materi_pembelajaran') }}" placeholder="Contoh: Matematika Bab 1 - Aljabar" required>
                        @error('materi_pembelajaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nilai (0-100) <span class="text-danger">*</span></label>
                        <input type="number" name="nilai" min="0" max="100" class="form-control @error('nilai') is-invalid @enderror" value="{{ old('nilai') }}" required>
                        @error('nilai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Predikat (Opsional, otomatis jika kosong)</label>
                        <select name="predikat" class="form-select">
                            <option value="">-- Otomatis --</option>
                            <option value="A" {{ old('predikat') == 'A' ? 'selected' : '' }}>A (90-100)</option>
                            <option value="B" {{ old('predikat') == 'B' ? 'selected' : '' }}>B (80-89)</option>
                            <option value="C" {{ old('predikat') == 'C' ? 'selected' : '' }}>C (70-79)</option>
                            <option value="D" {{ old('predikat') == 'D' ? 'selected' : '' }}>D (60-69)</option>
                            <option value="E" {{ old('predikat') == 'E' ? 'selected' : '' }}>E (<60)</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Capaian Kompetensi <span class="text-danger">*</span></label>
                    <textarea name="capaian_kompetensi" rows="4" class="form-control @error('capaian_kompetensi') is-invalid @enderror" placeholder="Tuliskan capaian kompetensi siswa pada materi ini. Contoh: Siswa mampu memahami konsep dasar aljabar dan menyelesaikan soal persamaan linear dengan benar." required>{{ old('capaian_kompetensi') }}</textarea>
                    @error('capaian_kompetensi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Jelaskan kemampuan yang telah dikuasai siswa setelah mempelajari materi ini.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan Tambahan (Opsional)</label>
                    <textarea name="catatan" rows="3" class="form-control" placeholder="Tambahkan catatan khusus atau saran untuk siswa (opsional)">{{ old('catatan') }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('guru.laporan_siswa.detail', $siswa->id) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection