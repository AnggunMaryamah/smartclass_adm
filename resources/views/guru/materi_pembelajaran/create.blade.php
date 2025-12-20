@extends('layouts.guru')

@section('title', 'Tambah Materi Pembelajaran')

@section('content')
    <div class="create-materi-container">
        <div class="form-container">
            {{-- Header --}}
            <div class="form-header">
                <h2 class="form-title">
                    <svg class="title-icon" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                    Tambah Materi Pembelajaran
                </h2>
                <p class="form-subtitle">{{ $kelas->nama_kelas }}</p>
            </div>

            {{-- Alert Success/Error --}}
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    <svg class="alert-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <svg class="alert-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <div>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="alert-list">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('guru.materi_pembelajaran.store', $kelas->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="materi-form" 
                  id="materiForm">
                @csrf

                {{-- Row: Bab & Urutan --}}
                <div class="form-row">
                    {{-- Bab --}}
                    <div class="form-group">
                        <label for="bab" class="form-label">
                            <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            Bab <span class="required">*</span>
                        </label>
                        <input type="number" 
                               id="bab" 
                               name="bab" 
                               min="1"
                               class="form-control @error('bab') is-invalid @enderror" 
                               placeholder="Contoh: 1, 2, 3..."
                               value="{{ old('bab', 1) }}" 
                               required>
                        @error('bab')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Urutan Materi --}}
                    <div class="form-group">
                        <label for="urutan" class="form-label">
                            <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            Urutan Materi <span class="required">*</span>
                        </label>
                        <input type="number" 
                               id="urutan" 
                               name="urutan" 
                               min="1"
                               class="form-control @error('urutan') is-invalid @enderror" 
                               placeholder="Contoh: 1, 2, 3..."
                               value="{{ old('urutan', 1) }}" 
                               required>
                        @error('urutan')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
{{-- Jenis Materi - CUSTOM DROPDOWN (SAMA DENGAN TAMBAH KELAS) --}}
<div class="form-group">
    <label class="form-label">
        <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
        </svg>
        Jenis Materi <span class="required">*</span>
    </label>

    {{-- Hidden Input --}}
    <input type="hidden" id="tipe" name="tipe" value="{{ old('tipe') }}" required>

    {{-- Custom Dropdown --}}
    <div class="custom-select" id="tipeSelect">
        <div class="select-trigger">
            <span class="select-value">
                @if(old('tipe') === 'bacaan')
                    Materi Bacaan
                @else
                    Pilih Jenis Materi
                @endif
            </span>
            <svg class="select-arrow" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </div>
        <div class="select-options">
            <div class="select-option" data-value="">Pilih Jenis Materi</div>
            <div class="select-option" data-value="bacaan">Materi Bacaan</div>
        </div>
    </div>
    @error('tipe')
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>

{{-- Judul Materi --}}
<div class="form-group">
    <label for="judul" class="form-label">
        <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 20h9"></path>
            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
        </svg>
        Judul Materi <span class="required">*</span>
    </label>
    <input type="text" 
           id="judul" 
           name="judul" 
           class="form-control @error('judul') is-invalid @enderror" 
           placeholder="Contoh: Pengenalan HTML"
           value="{{ old('judul') }}" 
           required>
    @error('judul')
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>

{{-- FORM KHUSUS BACAAAN (TinyMCE + PDF) --}}
<div id="form-bacaan">
    {{-- Konten Materi --}}
    <div class="form-group">
        <label for="kontenMateri" class="form-label">
            <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
            Konten Materi
        </label>
        <div class="editor-wrapper">
            <textarea name="konten" 
                      id="kontenMateri" 
                      class="form-control">{{ old('konten') }}</textarea>
        </div>
        @error('konten')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    {{-- Upload PDF --}}
    <div class="form-group">
        <label class="form-label">
            <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
            Upload PDF
        </label>

        <div class="custom-file-upload">
            <input type="file" 
                   name="file_path" 
                   class="file-input-hidden" 
                   accept=".pdf"
                   id="pdfFile">
            
            <label for="pdfFile" class="file-upload-label">
                <svg class="upload-icon" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="17 8 12 3 7 8"></polyline>
                    <line x1="12" y1="3" x2="12" y2="15"></line>
                </svg>
                <span class="file-upload-text">Pilih File PDF</span>
                <span class="file-upload-hint">atau drag & drop di sini</span>
            </label>
            
            @error('file_path')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div id="filePreview" class="file-preview" style="display: none;">
            <div class="file-preview-content">
                <svg class="file-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
                <div class="file-details">
                    <span id="fileName" class="file-name"></span>
                    <span id="fileSize" class="file-size"></span>
                </div>
                <button type="button" class="btn-remove-file" onclick="removeFile()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Catatan --}}
<div class="form-group">
    <label for="keterangan" class="form-label">
        <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
            <polyline points="10 9 9 9 8 9"></polyline>
        </svg>
        Catatan
    </label>
    <textarea id="keterangan" 
              name="keterangan" 
              class="form-control @error('keterangan') is-invalid @enderror"
              rows="3" 
              placeholder="Opsional">{{ old('keterangan') }}</textarea>
    @error('keterangan')
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>

                {{-- Buttons (HORIZONTAL DI KANAN) --}}
                <div class="form-actions">
                    <a href="{{ route('guru.materi_pembelajaran.index', $kelas->id) }}" class="btn-cancel">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        Batal
                    </a>
                    <button type="button" id="simpanMateriBtn" class="btn-submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        <span class="btn-text">Simpan Materi</span>
                    </button>
                </div>
                    </form>
    </div>
</div>

<style>
    :root {
        --primary: #0EA5E9;
        --primary-hover: #0284C7;
        --primary-light: #E0F2FE;
        --primary-lighter: #F0F9FF;
        --secondary: #64748B;
        --success: #10B981;
        --danger: #EF4444;
        --text-primary: #0F172A;
        --text-secondary: #64748B;
        --bg-light: #F8FAFC;
        --border: #E5E7EB;
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

    .create-materi-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 20px;
        animation: fadeInUp 0.5s ease;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-container {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        border: 1px solid var(--border);
    }

    .form-header {
        text-align: center;
        margin-bottom: 32px;
        padding-bottom: 24px;
        border-bottom: 2px solid var(--primary-light);
    }

    .form-title {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .title-icon {
        color: var(--primary);
    }

    .form-subtitle {
        color: var(--text-secondary);
        font-size: 1rem;
        font-weight: 500;
    }

    .alert {
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        animation: slideDown 0.4s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3f0d6 100%);
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #fccfd6 100%);
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert-icon {
        flex-shrink: 0;
        margin-top: 2px;
    }

    .alert-list {
        margin: 8px 0 0 20px;
        padding: 0;
    }

    .alert-list li {
        margin-bottom: 4px;
    }

    .form-group {
        margin-bottom: 28px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 10px;
    }

    .label-icon {
        color: var(--primary);
    }

    .required {
        color: var(--danger);
    }

    .form-control {
        width: 100%;
        padding: 14px 18px;
        font-size: 1rem;
        color: var(--text-primary);
        background: white;
        border: 2px solid var(--border);
        border-radius: 12px;
        transition: all 0.25s ease;
        font-family: inherit;
    }

    .form-control:hover {
        border-color: #BAE6FD;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        background: white;
        box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.12);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .editor-wrapper {
        border: 2px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.25s ease;
    }

    .editor-wrapper:focus-within {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.12);
    }

    .tox-tinymce {
        border: none !important;
    }

    .custom-select {
        position: relative;
        width: 100%;
    }

    .select-trigger {
        width: 100%;
        padding: 14px 18px;
        background: white;
        border: 2px solid var(--border);
        border-radius: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: all 0.25s ease;
        font-size: 1rem;
        color: var(--text-primary);
    }

    .select-trigger:hover {
        border-color: #BAE6FD;
    }
    /* ===== SWEETALERT2 CUSTOM STYLES ===== */
.swal2-custom-popup {
    border-radius: 20px !important;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15) !important;
    border: 1px solid #E5E7EB;
}

.swal2-confirm-btn {
    background: linear-gradient(135deg, #0EA5E9, #0284C7) !important;
    color: white !important;
    padding: 12px 32px !important;
    border-radius: 12px !important;
    font-size: 1rem !important;
    font-weight: 600 !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    margin: 10px 8px !important;
}

.swal2-confirm-btn:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4) !important;
}

.swal2-cancel-btn {
    background: white !important;
    color: #64748B !important;
    padding: 12px 32px !important;
    border-radius: 12px !important;
    font-size: 1rem !important;
    font-weight: 600 !important;
    border: 2px solid #E5E7EB !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    margin: 10px 8px !important;
}

.swal2-cancel-btn:hover {
    background: #F8FAFC !important;
    border-color: #94A3B8 !important;
    color: #334155 !important;
}

.swal2-close-btn {
    position: absolute !important;
    top: 16px !important;
    right: 16px !important;
    width: 36px !important;
    height: 36px !important;
    background: #F1F5F9 !important;
    border-radius: 50% !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    font-size: 24px !important;
    color: #64748B !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.swal2-close-btn:hover {
    background: #E2E8F0 !important;
    color: #334155 !important;
    transform: rotate(90deg) !important;
}

.swal2-html-container {
    margin: 0 !important;
    padding: 0 !important;
}

    .custom-select.active .select-trigger {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.12);
    }

    .select-value {
        font-weight: 500;
    }

    .select-trigger .select-value:empty::before {
        content: 'Pilih...';
        color: #9CA3AF;
        font-style: italic;
    }

    .select-arrow {
        color: var(--primary);
        transition: transform 0.3s ease;
        flex-shrink: 0;
    }

    .custom-select.active .select-arrow {
        transform: rotate(180deg);
    }

    .select-options {
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        right: 0;
        background: white;
        border: 2px solid var(--primary);
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(14, 165, 233, 0.15);
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 100;
    }

    .custom-select.active .select-options {
        max-height: 280px;
        overflow-y: auto;
        opacity: 1;
    }

    .select-option {
        padding: 12px 18px;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 1rem;
        color: var(--text-primary);
        font-weight: 500;
    }

    .select-option:first-child {
        color: #9CA3AF;
        font-style: italic;
        border-bottom: 1px solid var(--border);
    }

    .select-option:hover {
        background: var(--primary-light);
        color: var(--primary);
    }

    .select-option.selected {
        background: linear-gradient(90deg, var(--primary-light) 0%, white 100%);
        color: var(--primary);
        font-weight: 600;
        position: relative;
    }

    .select-option.selected::after {
        content: '✓';
        position: absolute;
        right: 18px;
        font-weight: 700;
    }

    .custom-file-upload {
        margin-top: 10px;
    }

    .file-input-hidden {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;
        overflow: hidden;
        z-index: -1;
    }

    .file-upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 32px 20px;
        border: 3px dashed var(--border);
        border-radius: 12px;
        background: var(--bg-light);
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .file-upload-label:hover {
        border-color: var(--primary);
        background: var(--primary-lighter);
    }

    .file-upload-label.drag-over {
        border-color: var(--primary);
        background: var(--primary-light);
        transform: scale(1.02);
    }

    .upload-icon {
        color: var(--primary);
        margin-bottom: 12px;
        transition: transform 0.3s ease;
    }

    .file-upload-label:hover .upload-icon {
        transform: translateY(-4px);
    }

    .file-upload-text {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 1rem;
        margin-bottom: 4px;
    }

    .file-upload-hint {
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    .file-preview {
        margin-top: 16px;
        padding: 16px;
        background: linear-gradient(135deg, #E0F2FE 0%, #F0F9FF 100%);
        border-radius: 12px;
        border: 2px solid var(--primary-light);
        animation: slideDown 0.3s ease;
    }

    .file-preview-content {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .file-icon {
        color: var(--primary);
        flex-shrink: 0;
    }

    .file-details {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .file-name {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 0.95rem;
    }

    .file-size {
        font-size: 0.85rem;
        color: var(--text-secondary);
    }

    .btn-remove-file {
        background: var(--danger);
        color: white;
        border: none;
        border-radius: 8px;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .btn-remove-file:hover {
        background: #DC2626;
        transform: scale(1.1);
    }

    .error-message {
        display: block;
        color: var(--danger);
        font-size: 0.875rem;
        margin-top: 6px;
        font-weight: 500;
    }

    .form-control.is-invalid {
        border-color: var(--danger);
        background: #FEF2F2;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 14px;
        margin-top: 36px;
    }

    .btn-submit, .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 28px;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-submit {
        background: linear-gradient(135deg, #0EA5E9, #0284C7);
        color: white;
        box-shadow: 0 4px 16px rgba(14, 165, 233, 0.35);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(14, 165, 233, 0.45);
    }

    .btn-cancel {
        background: white;
        color: var(--text-secondary);
        border: 2px solid var(--border);
    }

    .btn-cancel:hover {
        background: var(--bg-light);
        border-color: var(--text-secondary);
        color: var(--text-primary);
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- ✅ TinyMCE dari CDN (TIDAK PERLU DOWNLOAD) --}}
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Init TinyMCE
        if (typeof tinymce !== 'undefined') {
            tinymce.init({
                selector: '#kontenMateri',
                height: 500,
                menubar: true,
                plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist | link image | removeformat',
                setup: function(editor) {
                    editor.on('init', function() {
                        console.log('✅ TinyMCE loaded!');
                    });
                }
            });
        }

        // Custom Dropdown
        const customSelect = document.getElementById('tipeSelect');
        if (customSelect) {
            const trigger = customSelect.querySelector('.select-trigger');
            const valueDisplay = customSelect.querySelector('.select-value');
            const options = customSelect.querySelectorAll('.select-option');
            const hiddenInput = document.getElementById('tipe');

            trigger.addEventListener('click', () => customSelect.classList.toggle('active'));

            options.forEach(option => {
                option.addEventListener('click', function() {
                    hiddenInput.value = this.dataset.value;
                    valueDisplay.textContent = this.textContent;
                    customSelect.classList.remove('active');
                });
            });

            document.addEventListener('click', (e) => {
                if (!customSelect.contains(e.target)) customSelect.classList.remove('active');
            });
        }

        // File Upload
        const fileInput = document.getElementById('pdfFile');
        const fileLabel = document.querySelector('.file-upload-label');
        const filePreview = document.getElementById('filePreview');

        if (fileInput) {
            fileInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    document.getElementById('fileName').textContent = file.name;
                    document.getElementById('fileSize').textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                    filePreview.style.display = 'block';
                    fileLabel.style.display = 'none';
                }
            });
        }

        window.removeFile = function() {
            fileInput.value = '';
            filePreview.style.display = 'none';
            fileLabel.style.display = 'flex';
        };

        // Submit Confirmation
document.getElementById('simpanMateriBtn')?.addEventListener('click', function(e) {
    e.preventDefault();
    const form = document.getElementById('materiForm');
    
    if (form.checkValidity()) {
        Swal.fire({
            html: `
                <div style="text-align: center; padding: 20px 10px;">
                    <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: linear-gradient(135deg, #E0F2FE, #BAE6FD); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#0EA5E9" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <h2 style="font-size: 1.5rem; font-weight: 700; color: #0F172A; margin-bottom: 12px;">Konfirmasi</h2>
                    <p style="font-size: 1rem; color: #64748B; margin: 0;">Apakah Anda yakin ingin menyimpan<br>materi ini?</p>
                </div>
            `,
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            buttonsStyling: false,
            customClass: {
                popup: 'swal2-custom-popup',
                confirmButton: 'swal2-confirm-btn',
                cancelButton: 'swal2-cancel-btn',
                closeButton: 'swal2-close-btn'
            },
            width: '420px',
            padding: '0'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    } else {
        form.reportValidity();
    }
});
    });
</script>
@endsection
