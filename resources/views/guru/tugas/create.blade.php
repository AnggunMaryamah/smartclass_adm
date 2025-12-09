@extends('layouts.guru')

@section('title', 'Tambah Tugas')

@section('content')
<style>
    :root {
        --primary: #0EA5E9;
        --primary-hover: #0284C7;
        --primary-light: #E0F2FE;
        --text-primary: #0F172A;
        --text-secondary: #64748B;
        --bg-light: #F8FAFC;
        --border: #E5E7EB;
    }

    .create-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 24px;
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

    .form-card {
        background: white;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .form-card h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 24px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .required {
        color: #EF4444;
    }

    .form-control, .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border);
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.12);
    }

    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 28px;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, var(--primary), var(--primary-hover));
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: white;
        color: var(--text-secondary);
        border: 2px solid var(--border);
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: var(--bg-light);
        border-color: var(--text-secondary);
    }

    .error-message {
        display: block;
        color: #EF4444;
        font-size: 0.875rem;
        margin-top: 6px;
    }
</style>

<div class="create-container">
    <a href="{{ route('guru.tugas.index', $kelas->id) }}" class="btn-back">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" 
             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>

    <div class="form-card">
        <h2>Tambah Kuis / Ujian untuk {{ $kelas->nama }}</h2>

        <form action="{{ route('guru.tugas.store', $kelas->id) }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="judul" class="form-label">
                    Judul <span class="required">*</span>
                </label>
                <input type="text" id="judul" name="judul" class="form-control" 
                       value="{{ old('judul') }}" placeholder="Contoh: Kuis Bab 1" required>
                @error('judul')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tipe" class="form-label">
                    Tipe <span class="required">*</span>
                </label>
                <select name="tipe" id="tipe" class="form-select" required>
                    <option value="">Pilih tipe</option>
                    @foreach($tipeOptions as $key => $label)
                        <option value="{{ $key }}" {{ old('tipe') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('tipe')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="deadline" class="form-label">Deadline (opsional)</label>
                <input type="datetime-local" name="deadline" id="deadline" class="form-control" value="{{ old('deadline') }}">
                @error('deadline')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi" class="form-label">Deskripsi (opsional)</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Deskripsi singkat...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('guru.tugas.index', $kelas->id) }}" class="btn-cancel">
                    Batal
                </a>
                <button type="submit" class="btn-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" 
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg>
                    Simpan & Lanjut ke Soal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
