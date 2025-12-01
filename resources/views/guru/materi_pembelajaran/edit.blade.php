@extends('layouts.guru')

@section('title', 'Edit Materi Pembelajaran')

@section('content')
    <div class="form-container">
        {{-- Header --}}
        <div class="form-header">
            <div class="header-content">
                <div class="header-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" 
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="page-title">Edit Materi Pembelajaran</h1>
                    <p class="page-subtitle">{{ $kelas->nama_kelas }}</p>
                </div>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="form-card">
            <form action="{{ route('guru.materi_pembelajaran.update', [$kelas->id, $materi->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-row">
                    {{-- Bab --}}
                    <div class="form-group">
                        <label for="bab" class="form-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                            Bab <span class="required">*</span>
                        </label>
                        <input type="number" 
                               class="form-input @error('bab') error @enderror" 
                               id="bab" 
                               name="bab" 
                               value="{{ old('bab', $materi->bab) }}" 
                               min="1" 
                               required>
                        @error('bab')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Urutan --}}
                    <div class="form-group">
                        <label for="urutan" class="form-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                               class="form-input @error('urutan') error @enderror" 
                               id="urutan" 
                               name="urutan" 
                               value="{{ old('urutan', $materi->urutan) }}" 
                               min="1" 
                               required>
                        @error('urutan')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Jenis Materi --}}
                <div class="form-group">
                    <label for="tipe" class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                        Jenis Materi <span class="required">*</span>
                    </label>
                    <div class="select-wrapper">
                        <select class="form-input @error('tipe') error @enderror" id="tipe" name="tipe" required>
                            <option value="">Pilih Jenis Materi</option>
                            <option value="bacaan" {{ old('tipe', $materi->tipe) == 'bacaan' ? 'selected' : '' }}>Bacaan</option>
                            <option value="kuis" {{ old('tipe', $materi->tipe) == 'kuis' ? 'selected' : '' }}>Kuis</option>
                            <option value="ujian" {{ old('tipe', $materi->tipe) == 'ujian' ? 'selected' : '' }}>Ujian</option>
                        </select>
                        <svg class="select-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" 
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                    @error('tipe')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Judul --}}
                <div class="form-group">
                    <label for="judul" class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 20h9"></path>
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                        </svg>
                        Judul Materi <span class="required">*</span>
                    </label>
                    <input type="text" 
                           class="form-input @error('judul') error @enderror" 
                           id="judul" 
                           name="judul" 
                           value="{{ old('judul', $materi->judul) }}" 
                           placeholder="Contoh: Pengenalan HTML" 
                           required>
                    @error('judul')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Konten --}}
                <div class="form-group">
                    <label for="konten" class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        Konten Materi
                    </label>
                    <textarea id="konten" name="konten" class="@error('konten') error @enderror">{{ old('konten', $materi->konten) }}</textarea>
                    @error('konten')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Upload PDF --}}
                <div class="form-group">
                    <label for="file_path" class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        Upload PDF
                    </label>

                    @if($materi->file_path)
                        <div class="current-file">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" 
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                            </svg>
                            <span>{{ basename($materi->file_path) }}</span>
                            <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank" class="file-view">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                Lihat
                            </a>
                        </div>
                    @endif

                    <div class="file-upload-wrapper">
                        <input type="file" 
                               class="form-input-file @error('file_path') error @enderror" 
                               id="file_path" 
                               name="file_path" 
                               accept=".pdf">
                        <label for="file_path" class="file-upload-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" 
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                            <span class="upload-text">Pilih File PDF</span>
                            <span class="upload-hint">atau drag & drop di sini</span>
                        </label>
                    </div>
                    @error('file_path')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Catatan --}}
                <div class="form-group">
                    <label for="keterangan" class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                        Catatan
                    </label>
                    <textarea class="form-input @error('keterangan') error @enderror" 
                              id="keterangan" 
                              name="keterangan" 
                              rows="4" 
                              placeholder="Opsional">{{ old('keterangan', $materi->keterangan) }}</textarea>
                    @error('keterangan')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="form-actions">
                    <a href="{{ route('guru.materi_pembelajaran.index', $kelas->id) }}" class="btn-cancel">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" 
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" class="btn-submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" 
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Simpan Materi
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
            --success: #10B981;
            --danger: #EF4444;
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
            min-height: 100vh;
        }

        .form-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 24px 40px;
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== HEADER ===== */
        .form-header {
            margin-bottom: 32px;
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #0EA5E9, #0284C7);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 16px rgba(14, 165, 233, 0.3);
            flex-shrink: 0;
        }

        .header-icon svg {
            color: white;
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
        }

        /* ===== FORM CARD ===== */
        .form-card {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .form-label svg {
            color: var(--primary);
            flex-shrink: 0;
        }

        .required {
            color: var(--danger);
        }

        .form-input, textarea.form-input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            font-family: inherit;
            background: white;
        }

        .form-input:focus, textarea.form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-light);
        }

        .form-input.error, textarea.form-input.error {
            border-color: var(--danger);
        }

        textarea.form-input {
            resize: vertical;
            min-height: 120px;
            line-height: 1.6;
        }

        .select-wrapper {
            position: relative;
        }

        .select-wrapper select {
            appearance: none;
            padding-right: 40px;
            cursor: pointer;
        }

        .select-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: var(--text-secondary);
        }

        .error-message {
            display: block;
            color: var(--danger);
            font-size: 0.875rem;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* ===== CURRENT FILE ===== */
        .current-file {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            background: linear-gradient(135deg, #E0F2FE 0%, #DBEAFE 100%);
            border: 2px solid #BAE6FD;
            border-radius: 10px;
            margin-bottom: 12px;
            color: #0369A1;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .current-file svg {
            flex-shrink: 0;
            color: var(--primary);
        }

        .file-view {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            padding: 6px 12px;
            background: white;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .file-view:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        /* ===== FILE UPLOAD ===== */
        .file-upload-wrapper {
            position: relative;
        }

        .form-input-file {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .file-upload-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 180px;
            padding: 32px;
            border: 3px dashed var(--border);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: var(--bg-light);
        }

        .file-upload-label:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .file-upload-label svg {
            color: var(--primary);
            margin-bottom: 12px;
        }

        .upload-text {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .upload-hint {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        /* ===== BUTTONS ===== */
        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            padding-top: 24px;
            border-top: 1px solid var(--border);
            margin-top: 32px;
        }

        .btn-cancel, .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
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

        .btn-submit {
            background: linear-gradient(135deg, #0EA5E9, #0284C7);
            color: white;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .form-container {
                padding: 0 16px 24px;
            }
            .form-card {
                padding: 24px;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
            .form-actions {
                flex-direction: column-reverse;
            }
            .btn-cancel, .btn-submit {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    {{-- ✅ TinyMCE WITH Image Support --}}
    <script src="https://cdn.tiny.cloud/1/68bvpv4qzyhlp8g7qyzzpsppch2vj7nuznaynd0t8wpndr8t/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#konten',
            height: 500,
            menubar: false,
            plugins: 'link lists table code help',
            toolbar: 'undo redo | blocks | bold italic underline strikethrough | forecolor backcolor | ' +
                     'alignleft aligncenter alignright alignjustify | ' +
                     'bullist numlist | link | removeformat | code',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; font-size: 14px; line-height: 1.8; padding: 16px; }',
            branding: false,
            promotion: false,
            // ✅ Gambar yang ada di konten akan tetap tampil
            valid_elements: '*[*]',
            extended_valid_elements: 'img[*]',
            // ✅ Supaya gambar tidak dihapus
            cleanup: false,
            verify_html: false
        });

        // File upload preview
        document.getElementById('file_path').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                const label = document.querySelector('.file-upload-label .upload-text');
                label.textContent = fileName;
                label.parentElement.style.borderColor = 'var(--success)';
                label.parentElement.style.background = '#D1FAE5';
            }
        });
    </script>
@endsection
