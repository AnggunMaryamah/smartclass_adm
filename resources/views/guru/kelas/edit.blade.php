@extends('layouts.guru')

@section('title', 'Edit Kelas')

@section('content')
    <div class="form-kelas-container">
        {{-- Header --}}
        <div class="form-header">
            <a href="{{ route('guru.kelas.index') }}" class="btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                Kembali
            </a>
            <h2 class="page-title">Edit Kelas</h2>
        </div>

        {{-- Form Card --}}
        <div class="form-card">
            <form action="{{ route('guru.kelas.update', $kelas->id) }}" method="POST" id="editKelasForm">
                @csrf
                @method('PUT')

                {{-- Nama Kelas --}}
                <div class="form-group">
                    <label for="nama_kelas">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                        Nama Kelas <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nama_kelas" 
                        name="nama_kelas" 
                        value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                        placeholder="Contoh: Matematika Kelas 7" 
                        required
                    >
                    @error('nama_kelas')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Jenjang & Harga (Grid 2 Kolom) --}}
                <div class="form-row">
                    {{-- Jenjang Pendidikan --}}
                    <div class="form-group">
                        <label for="jenjang_pendidikan">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                            </svg>
                            Jenjang Pendidikan <span class="required">*</span>
                        </label>
                        <select id="jenjang_pendidikan" name="jenjang_pendidikan" required style="display: none;">
                            <option value="">Pilih Jenjang</option>
                            <option value="SD" {{ old('jenjang_pendidikan', $kelas->jenjang_pendidikan) == 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ old('jenjang_pendidikan', $kelas->jenjang_pendidikan) == 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMA" {{ old('jenjang_pendidikan', $kelas->jenjang_pendidikan) == 'SMA' ? 'selected' : '' }}>SMA</option>
                        </select>
                        <div class="custom-select" data-target="jenjang_pendidikan">
                            <div class="custom-select-trigger">
                                <span>{{ old('jenjang_pendidikan', $kelas->jenjang_pendidikan) ?: 'Pilih Jenjang' }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </div>
                            <div class="custom-options">
                                <div class="custom-option placeholder" data-value="">Pilih Jenjang</div>
                                <div class="custom-option" data-value="SD">SD</div>
                                <div class="custom-option" data-value="SMP">SMP</div>
                                <div class="custom-option" data-value="SMA">SMA</div>
                            </div>
                        </div>
                        @error('jenjang_pendidikan')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    <div class="form-group">
                        <label for="harga">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                            Harga Kelas (Rp) <span class="required">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="harga" 
                            name="harga" 
                            value="{{ old('harga', $kelas->harga) }}"
                            placeholder="100000" 
                            min="0" 
                            required
                        >
                        @error('harga')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Durasi --}}
                <div class="form-group">
                    <label for="durasi">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        Durasi Akses Kelas <span class="required">*</span>
                    </label>
                    <select id="durasi" name="durasi" required style="display: none;">
                        <option value="">Pilih Durasi</option>
                        <option value="1 bulan" {{ old('durasi', $kelas->durasi) == '1 bulan' ? 'selected' : '' }}>1 bulan</option>
                        <option value="3 bulan" {{ old('durasi', $kelas->durasi) == '3 bulan' ? 'selected' : '' }}>3 bulan</option>
                        <option value="6 bulan" {{ old('durasi', $kelas->durasi) == '6 bulan' ? 'selected' : '' }}>6 bulan</option>
                        <option value="1 tahun" {{ old('durasi', $kelas->durasi) == '1 tahun' ? 'selected' : '' }}>1 tahun</option>
                        <option value="custom" {{ !in_array($kelas->durasi, ['1 bulan', '3 bulan', '6 bulan', '1 tahun']) && $kelas->durasi ? 'selected' : '' }}>Custom</option>
                    </select>
                    <div class="custom-select" data-target="durasi">
                        <div class="custom-select-trigger">
                            <span>{{ old('durasi', in_array($kelas->durasi, ['1 bulan', '3 bulan', '6 bulan', '1 tahun']) ? $kelas->durasi : ($kelas->durasi ? 'Custom' : 'Pilih Durasi')) }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                        <div class="custom-options">
                            <div class="custom-option placeholder" data-value="">Pilih Durasi</div>
                            <div class="custom-option" data-value="1 bulan">1 bulan</div>
                            <div class="custom-option" data-value="3 bulan">3 bulan</div>
                            <div class="custom-option" data-value="6 bulan">6 bulan</div>
                            <div class="custom-option" data-value="1 tahun">1 tahun</div>
                            <div class="custom-option" data-value="custom">Custom</div>
                        </div>
                    </div>
                    @error('durasi')
                        <span class="error-message">{{ $message }}</span>
                    @enderror

                    {{-- Custom Durasi --}}
                    <input 
                        type="text" 
                        id="durasi_custom" 
                        name="durasi_custom" 
                        value="{{ !in_array($kelas->durasi, ['1 bulan', '3 bulan', '6 bulan', '1 tahun']) && $kelas->durasi ? $kelas->durasi : '' }}"
                        placeholder="Contoh: 2 minggu, 45 hari" 
                        style="margin-top: 12px; {{ !in_array($kelas->durasi, ['1 bulan', '3 bulan', '6 bulan', '1 tahun']) && $kelas->durasi ? '' : 'display: none;' }}"
                    >
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label for="deskripsi">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        Deskripsi Kelas
                    </label>
                    <textarea 
                        id="deskripsi" 
                        name="deskripsi" 
                        rows="4" 
                        placeholder="Jelaskan tentang kelas ini..."
                    >{{ old('deskripsi', $kelas->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label for="status">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        Status Kelas
                    </label>
                    <select id="status" name="status" required style="display: none;">
                        <option value="aktif" {{ old('status', $kelas->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $kelas->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    <div class="custom-select" data-target="status">
                        <div class="custom-select-trigger">
                            <span>{{ ucfirst(old('status', $kelas->status)) }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                        <div class="custom-options">
                            <div class="custom-option" data-value="aktif">Aktif</div>
                            <div class="custom-option" data-value="nonaktif">Nonaktif</div>
                        </div>
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="form-actions">
                    <a href="{{ route('guru.kelas.index') }}" class="btn-cancel">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        Batal
                    </a>
                    <button type="button" class="btn-submit" onclick="confirmUpdate()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Konfirmasi --}}
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <div class="modal-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>
            <h3 class="modal-title">Simpan Perubahan?</h3>
            <p class="modal-message">Data kelas akan diperbarui. Pastikan semua informasi sudah benar.</p>
            <div class="modal-actions">
                <button type="button" class="modal-btn-cancel" onclick="closeModal()">Batal</button>
                <button type="button" class="modal-btn-confirm" onclick="submitForm()">Ya, Simpan</button>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary: #0EA5E9;
            --primary-dark: #0284C7;
            --text-dark: #1F2937;
            --text-light: #6B7280;
            --border: #E5E7EB;
            --bg-light: #F9FAFB;
            --danger: #EF4444;
            --success: #10B981;
        }

        .form-kelas-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 24px;
        }

        /* Header */
        .form-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-light);
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-back:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }

        /* Form Card */
        .form-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        /* Form Group */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group:last-of-type {
            margin-bottom: 0;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .form-group label svg {
            color: var(--primary);
            flex-shrink: 0;
        }

        .required {
            color: var(--danger);
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 0.9375rem;
            color: var(--text-dark);
            transition: all 0.2s;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* ========================================
           CUSTOM SELECT DROPDOWN - FULL CUSTOM
           ======================================== */
        .custom-select {
            position: relative;
            width: 100%;
        }

        .custom-select-trigger {
            width: 100%;
            padding: 12px 40px 12px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s;
            user-select: none;
        }

        .custom-select-trigger span {
            font-size: 0.9375rem;
            color: var(--text-dark);
        }

        .custom-select-trigger.placeholder span {
            color: #9CA3AF;
            font-style: italic;
        }

        .custom-select-trigger svg {
            color: var(--text-light);
            transition: transform 0.2s;
            flex-shrink: 0;
        }

        .custom-select.active .custom-select-trigger {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }

        .custom-select.active .custom-select-trigger svg {
            transform: rotate(180deg);
            color: var(--primary);
        }

        .custom-options {
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            right: 0;
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-height: 200px;
            overflow-y: auto;
            z-index: 100;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s;
        }

        .custom-select.active .custom-options {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .custom-option {
            padding: 12px 16px;
            font-size: 0.9375rem;
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.15s;
            user-select: none;
        }

        .custom-option.placeholder {
            color: #9CA3AF;
            font-style: italic;
        }

        .custom-option:hover {
            background: #EFF6FF;
            color: var(--primary);
        }

        .custom-option.selected {
            background: var(--primary);
            color: white;
            font-weight: 600;
        }

        /* Form Row */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }

        /* Error Message */
        .error-message {
            display: block;
            margin-top: 6px;
            font-size: 0.8125rem;
            color: var(--danger);
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
        }

        .btn-cancel, .btn-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
            white-space: nowrap;
        }

        .btn-cancel {
            background: white;
            color: var(--text-light);
            border: 1px solid var(--border);
        }

        .btn-cancel:hover {
            background: var(--bg-light);
            border-color: var(--text-light);
            color: var(--text-dark);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary), #06B6D4);
            color: white;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(14, 165, 233, 0.4);
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            padding: 32px;
            max-width: 420px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .modal-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #FEF3C7, #FDE68A);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-icon svg {
            color: #F59E0B;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 0 12px 0;
        }

        .modal-message {
            font-size: 0.9375rem;
            color: var(--text-light);
            margin: 0 0 28px 0;
            line-height: 1.6;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
        }

        .modal-btn-cancel, .modal-btn-confirm {
            flex: 1;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 0.9375rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .modal-btn-cancel {
            background: var(--bg-light);
            color: var(--text-light);
        }

        .modal-btn-cancel:hover {
            background: #E5E7EB;
            color: var(--text-dark);
        }

        .modal-btn-confirm {
            background: linear-gradient(135deg, var(--primary), #06B6D4);
            color: white;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        .modal-btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(14, 165, 233, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-kelas-container {
                padding: 16px;
            }

            .form-card {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .form-actions {
                justify-content: stretch;
            }

            .btn-cancel, .btn-submit {
                flex: 1;
            }

            .modal-content {
                padding: 24px;
            }

            .modal-icon {
                width: 64px;
                height: 64px;
            }

            .modal-icon svg {
                width: 36px;
                height: 36px;
            }
        }

        @media (max-width: 480px) {
            .form-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .page-title {
                font-size: 1.25rem;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn-cancel, .btn-submit {
                width: 100%;
            }

            .modal-actions {
                flex-direction: column-reverse;
            }

            .modal-btn-cancel, .modal-btn-confirm {
                width: 100%;
            }
        }
    </style>

    <script>
        // ========================================
        // CUSTOM SELECT DROPDOWN HANDLER
        // ========================================
        document.addEventListener('DOMContentLoaded', function() {
            const customSelects = document.querySelectorAll('.custom-select');
            
            customSelects.forEach(selectContainer => {
                const trigger = selectContainer.querySelector('.custom-select-trigger');
                const options = selectContainer.querySelectorAll('.custom-option');
                const targetInput = document.getElementById(selectContainer.dataset.target);
                
                // Toggle dropdown
                trigger.addEventListener('click', function(e) {
                    e.stopPropagation();
                    // Close other dropdowns
                    customSelects.forEach(s => {
                        if (s !== selectContainer) {
                            s.classList.remove('active');
                        }
                    });
                    // Toggle current dropdown
                    selectContainer.classList.toggle('active');
                });
                
                // Handle option click
                options.forEach(option => {
                    option.addEventListener('click', function(e) {
                        e.stopPropagation();
                        
                        const value = this.dataset.value;
                        const text = this.textContent.trim();
                        
                        // Update hidden select
                        targetInput.value = value;
                        
                        // Update trigger text
                        trigger.querySelector('span').textContent = text;
                        
                        // Update placeholder class
                        if (value === '') {
                            trigger.classList.add('placeholder');
                        } else {
                            trigger.classList.remove('placeholder');
                        }
                        
                        // Update selected class
                        options.forEach(opt => opt.classList.remove('selected'));
                        if (value !== '') {
                            this.classList.add('selected');
                        }
                        
                        // Close dropdown
                        selectContainer.classList.remove('active');
                        
                        // Handle durasi custom
                        if (selectContainer.dataset.target === 'durasi') {
                            const durasiCustom = document.getElementById('durasi_custom');
                            if (value === 'custom') {
                                durasiCustom.style.display = 'block';
                                durasiCustom.required = true;
                            } else {
                                durasiCustom.style.display = 'none';
                                durasiCustom.required = false;
                                durasiCustom.value = '';
                            }
                        }
                    });
                });
                
                // Initial selected state
                const currentValue = targetInput.value;
                if (currentValue) {
                    options.forEach(opt => {
                        if (opt.dataset.value === currentValue) {
                            opt.classList.add('selected');
                        }
                    });
                    trigger.classList.remove('placeholder');
                } else {
                    trigger.classList.add('placeholder');
                }
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function() {
                customSelects.forEach(select => {
                    select.classList.remove('active');
                });
            });
        });

        // ========================================
        // MODAL FUNCTIONS
        // ========================================
        function confirmUpdate() {
            const form = document.getElementById('editKelasForm');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const durasi = document.getElementById('durasi').value;
            const durasiCustom = document.getElementById('durasi_custom').value.trim();

            if (durasi === 'custom' && !durasiCustom) {
                alert('Mohon isi durasi custom!');
                document.getElementById('durasi_custom').focus();
                return;
            }

            document.getElementById('confirmModal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('confirmModal').classList.remove('show');
        }

        function submitForm() {
            document.getElementById('editKelasForm').submit();
        }

        document.getElementById('confirmModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
@endsection
