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
                            <span class="select-value">{{ old('tipe') ? ucfirst(old('tipe')) : 'Pilih Jenis Materi' }}</span>
                            <svg class="select-arrow" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                        <div class="select-options">
                            <div class="select-option" data-value="">Pilih Jenis Materi</div>
                            <div class="select-option" data-value="bacaan">Materi Bacaan</div>
                            <div class="select-option" data-value="kuis">Kuis</div>
                            <div class="select-option" data-value="ujian">Ujian</div>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- TinyMCE Script (TIDAK DIUBAH) --}}
    <script src="https://cdn.tiny.cloud/1/68bvpv4qzyhlp8g7qyzzpsppch2vj7nuznaynd0t8wpndr8t/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>

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
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        /* ===== ALERT STYLES ===== */
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
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        /* ===== CUSTOM DROPDOWN STYLE (SAMA DENGAN TAMBAH KELAS) ===== */
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

        /* ===== FILE UPLOAD STYLES ===== */
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

        .btn-submit,
        .btn-cancel {
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
            position: relative;
            overflow: hidden;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.25);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-submit:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(14, 165, 233, 0.45);
        }

        .btn-text {
            position: relative;
            z-index: 1;
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
            transform: translateY(-1px);
        }

        /* ===== SWEETALERT CUSTOM STYLES (SAMA DENGAN TAMBAH KELAS) ===== */
        .swal-custom-popup {
            border-radius: 16px !important;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2) !important;
            overflow: hidden;
        }

        .swal-custom-content {
            padding: 32px 28px 20px;
            text-align: center;
        }

        .icon-wrapper {
            margin: 0 auto 16px;
            width: 60px;
            height: 60px;
            animation: icon-bounce 0.6s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }

        .swal-text {
            font-size: 0.95rem;
            color: #0F172A;
            line-height: 1.6;
            margin: 0;
            font-weight: 500;
        }

        .swal-btn-confirm,
        .swal-btn-cancel {
            padding: 12px 26px;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            margin: 18px 6px;
        }

        @keyframes icon-bounce {
            0% {
                transform: scale(0) rotate(-45deg);
                opacity: 0;
            }
            50% {
                transform: scale(1.1) rotate(5deg);
            }
            100% {
                transform: scale(1) rotate(0deg);
                opacity: 1;
            }
        }

        .icon-check {
            width: 60px;
            height: 60px;
        }

        .icon-check-circle {
            stroke: #0EA5E9;
            stroke-width: 2;
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            animation: dash-circle 0.6s 0.2s ease forwards;
        }

        @keyframes dash-circle {
            to {
                stroke-dashoffset: 0;
            }
        }

        .icon-check-path {
            stroke: #0EA5E9;
            stroke-width: 3;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: dash-check 0.4s 0.5s ease forwards;
        }

        @keyframes dash-check {
            to {
                stroke-dashoffset: 0;
            }
        }

        .swal-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #0F172A;
            margin: 0 0 12px 0;
        }

        .swal-btn-confirm {
            background: linear-gradient(135deg, #0EA5E9, #0284C7);
            color: white;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.35);
        }

        .swal-btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.45);
        }

        .swal-btn-cancel {
            background: white;
            color: #64748B;
            border: 2px solid #E5E7EB;
        }

        .swal-btn-cancel:hover {
            background: #F8FAFC;
            border-color: #94A3B8;
        }

        .swal-close-btn {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 32px;
            height: 32px;
            background: #F1F5F9;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 20px;
            color: #64748B;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .swal-close-btn:hover {
            background: #E2E8F0;
            color: #334155;
            transform: rotate(90deg);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .create-materi-container {
                padding: 16px;
                margin: 20px auto;
            }

            .form-container {
                padding: 28px 24px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .form-actions {
                flex-direction: row;
                gap: 12px;
            }

            .btn-submit,
            .btn-cancel {
                flex: 1;
                padding: 13px 22px;
                font-size: 0.95rem;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 24px 20px;
            }

            .form-title {
                font-size: 1.5rem;
            }

            .form-actions {
                gap: 10px;
            }

            .btn-submit,
            .btn-cancel {
                padding: 12px 18px;
                font-size: 0.9rem;
            }

            .swal-custom-popup {
                width: 90% !important;
                max-width: 360px !important;
            }

            .swal-custom-content {
                padding: 28px 20px 16px;
            }

            .swal-title {
                font-size: 1.25rem;
            }

            .swal-text {
                font-size: 0.9rem;
            }

            .swal-btn-confirm,
            .swal-btn-cancel {
                padding: 10px 20px;
                font-size: 0.9rem;
                margin: 16px 5px;
            }
        }
    </style>

    <script>
        // TinyMCE Init (TIDAK DIUBAH)
        tinymce.init({
            selector: '#kontenMateri',
            height: 750,
            min_height: 600,
            max_height: 1500,
            resize: true,
            menubar: true,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic underline strikethrough | ' +
                     'alignleft aligncenter alignright alignjustify | ' +
                     'bullist numlist outdent indent | ' +
                     'forecolor backcolor | link image media | ' +
                     'removeformat fullscreen help',
            
            mobile: {
                menubar: true,
                toolbar_mode: 'sliding'
            },
            
            content_style: `
                body { 
                    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; 
                    font-size: 16px;
                    line-height: 1.6;
                    padding: 15px;
                }
                img {
                    max-width: 100%;
                    height: auto;
                }
            `,
            
            images_upload_handler: function(blobInfo, progress) {
                return new Promise(function(resolve, reject) {
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '{{ route('guru.upload.image') }}');
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    
                    xhr.upload.onprogress = function(e) {
                        progress(e.loaded / e.total * 100);
                    };
                    
                    xhr.onload = function() {
                        if (xhr.status !== 200) {
                            reject('HTTP Error: ' + xhr.status);
                            return;
                        }
                        
                        let json;
                        try {
                            json = JSON.parse(xhr.responseText);
                        } catch (e) {
                            reject('Invalid JSON: ' + xhr.responseText);
                            return;
                        }
                        
                        if (!json || typeof json.location !== 'string') {
                            reject('Invalid JSON: ' + xhr.responseText);
                            return;
                        }
                        
                        resolve(json.location);
                    };
                    
                    xhr.onerror = function() {
                        reject('Image upload failed');
                    };
                    
                    const formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    xhr.send(formData);
                });
            },
            
            setup: function(editor) {
                editor.on('init', function() {
                    console.log('✅ TinyMCE berhasil diinisialisasi');
                });
            }
        });

        // Custom Dropdown (SAMA DENGAN TAMBAH KELAS)
        function initCustomSelect(selectId, inputId) {
            const customSelect = document.getElementById(selectId);
            const hiddenInput = document.getElementById(inputId);
            const trigger = customSelect.querySelector('.select-trigger');
            const valueDisplay = customSelect.querySelector('.select-value');
            const options = customSelect.querySelectorAll('.select-option');

            trigger.addEventListener('click', function(e) {
                e.stopPropagation();
                customSelect.classList.toggle('active');
                document.querySelectorAll('.custom-select').forEach(select => {
                    if (select !== customSelect) {
                        select.classList.remove('active');
                    }
                });
            });

            options.forEach(option => {
                option.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    const text = this.textContent;

                    hiddenInput.value = value;
                    valueDisplay.textContent = text;

                    options.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');

                    customSelect.classList.remove('active');
                });
            });

            document.addEventListener('click', function() {
                customSelect.classList.remove('active');
            });
        }

        initCustomSelect('tipeSelect', 'tipe');

        // File Upload Handler
        const fileInput = document.getElementById('pdfFile');
        const fileLabel = document.querySelector('.file-upload-label');
        const filePreview = document.getElementById('filePreview');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');

        fileInput.addEventListener('change', function(e) {
            handleFile(e.target.files[0]);
        });

        // Drag & drop
        fileLabel.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('drag-over');
        });

        fileLabel.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('drag-over');
        });

        fileLabel.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('drag-over');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFile(files[0]);
            }
        });

        function handleFile(file) {
            if (!file) return;
            
            const fileSizeMB = (file.size / 1024 / 1024).toFixed(2);
            
            if (fileSizeMB > 10) {
                Swal.fire({
                    title: 'File Terlalu Besar',
                    text: 'Ukuran file maksimal 10MB',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0EA5E9'
                });
                fileInput.value = '';
                return;
            }
            
            if (file.type !== 'application/pdf') {
                Swal.fire({
                    title: 'Format File Salah',
                    text: 'Hanya file PDF yang diperbolehkan',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0EA5E9'
                });
                fileInput.value = '';
                return;
            }
            
            fileName.textContent = file.name;
            fileSize.textContent = `${fileSizeMB} MB`;
            filePreview.style.display = 'block';
            fileLabel.style.display = 'none';
        }

        function removeFile() {
            fileInput.value = '';
            filePreview.style.display = 'none';
            fileLabel.style.display = 'flex';
        }

        // SweetAlert Konfirmasi (SAMA DENGAN TAMBAH KELAS)
        document.getElementById('simpanMateriBtn').addEventListener('click', function(e) {
            e.preventDefault();

            const form = document.getElementById('materiForm');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            Swal.fire({
                html: `
                    <div class="swal-custom-content">
                        <div class="icon-wrapper">
                            <svg class="icon-check" viewBox="0 0 52 52">
                                <circle class="icon-check-circle" cx="26" cy="26" r="25" fill="none"/>
                                <path class="icon-check-path" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                            </svg>
                        </div>
                        <p class="swal-text">Apakah Anda yakin ingin menyimpan materi ini?</p>
                    </div>
                `,
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                buttonsStyling: false,
                customClass: {
                    popup: 'swal-custom-popup',
                    confirmButton: 'swal-btn-confirm',
                    cancelButton: 'swal-btn-cancel',
                    closeButton: 'swal-close-btn'
                },
                width: '400px',
                padding: '0'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
