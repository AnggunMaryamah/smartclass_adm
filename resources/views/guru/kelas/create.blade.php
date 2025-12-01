@extends('layouts.guru')

@section('title', 'Tambah Kelas')

@section('content')
    <div class="create-kelas-container">
        <div class="form-container">
            <form action="{{ route('guru.kelas.store') }}" method="POST" class="kelas-form" id="kelasForm">
                @csrf

                {{-- Nama Kelas --}}
                <div class="form-group">
                    <label for="nama_kelas" class="form-label">
                        <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                        Nama Kelas <span class="required">*</span>
                    </label>
                    <input type="text" id="nama_kelas" name="nama_kelas"
                        class="form-control @error('nama_kelas') is-invalid @enderror"
                        placeholder="Contoh: Matematika Kelas 7" value="{{ old('nama_kelas') }}" required>
                    @error('nama_kelas')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Row: Jenjang & Harga --}}
                <div class="form-row">
                    {{-- Jenjang Pendidikan - CUSTOM DROPDOWN --}}
                    <div class="form-group">
                        <label class="form-label">
                            <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                            </svg>
                            Jenjang Pendidikan <span class="required">*</span>
                        </label>

                        {{-- Hidden Input untuk Store Value --}}
                        <input type="hidden" id="jenjang_pendidikan" name="jenjang_pendidikan"
                            value="{{ old('jenjang_pendidikan') }}" required>

                        {{-- Custom Dropdown --}}
                        <div class="custom-select" id="jenjangSelect">
                            <div class="select-trigger">
                                <span class="select-value">{{ old('jenjang_pendidikan') ?: 'Pilih Jenjang' }}</span>
                                <svg class="select-arrow" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </div>
                            <div class="select-options">
                                <div class="select-option" data-value="">Pilih Jenjang</div>
                                <div class="select-option" data-value="SD">SD</div>
                                <div class="select-option" data-value="SMP">SMP</div>
                                <div class="select-option" data-value="SMA">SMA</div>
                            </div>
                        </div>
                        @error('jenjang_pendidikan')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="harga" class="form-label">
                            <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                            Harga Kelas (Rp) <span class="required">*</span>
                        </label>
                        <input type="number" id="harga" name="harga"
                            class="form-control @error('harga') is-invalid @enderror" placeholder="100000"
                            value="{{ old('harga') }}" min="0" step="1000" required>
                        @error('harga')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Durasi Kelas - CUSTOM DROPDOWN --}}
                <div class="form-group">
                    <label class="form-label">
                        <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        Durasi Akses Kelas <span class="required">*</span>
                    </label>

                    {{-- Hidden Input --}}
                    <input type="hidden" id="durasi" name="durasi" value="{{ old('durasi') }}" required>

                    {{-- Custom Dropdown --}}
                    <div class="custom-select" id="durasiSelect">
                        <div class="select-trigger">
                            <span class="select-value">{{ old('durasi') ?: 'Pilih Durasi' }}</span>
                            <svg class="select-arrow" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                        <div class="select-options">
                            <div class="select-option" data-value="">Pilih Durasi</div>
                            <div class="select-option" data-value="3 bulan">3 Bulan</div>
                            <div class="select-option" data-value="6 bulan">6 Bulan</div>
                            <div class="select-option" data-value="1 tahun">1 Tahun</div>
                            <div class="select-option" data-value="custom">Custom</div>
                        </div>
                    </div>
                    @error('durasi')
                        <span class="error-message">{{ $message }}</span>
                    @enderror

                    <input type="text" id="durasi_custom" name="durasi_custom" class="form-control"
                        placeholder="Contoh: 2 tahun, selamanya" value="{{ old('durasi_custom') }}"
                        style="display: none; margin-top: 10px;">
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label for="deskripsi" class="form-label">
                        <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        Deskripsi Kelas
                    </label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                        rows="4" placeholder="Jelaskan tentang kelas ini...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="form-actions">
                    <a href="{{ route('guru.kelas.index') }}" class="btn-cancel">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        Batal
                    </a>
                    <button type="button" id="simpanKelasBtn" class="btn-submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        <span class="btn-text">Simpan Kelas</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        .create-kelas-container {
            max-width: 800px;
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

        /* ===== CUSTOM DROPDOWN STYLE ===== */
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

        /* ===== SWEETALERT CUSTOM STYLES - DIPERBAIKI ===== */
        .swal-custom-popup {
            border-radius: 16px !important;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2) !important;
            overflow: hidden;
        }

        .swal-custom-content {
            padding: 32px 28px 20px; /* PERBAIKAN: padding bawah dikurangi */
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
            margin: 18px 6px; /* PERBAIKAN: margin atas bawah sama */
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

        /* ===== CLOSE BUTTON STYLES ===== */
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

        @keyframes pop-in {
            0% {
                transform: scale(0.7) translateY(-30px);
                opacity: 0;
            }

            50% {
                transform: scale(1.05) translateY(0);
            }

            100% {
                transform: scale(1) translateY(0);
                opacity: 1;
            }
        }

        @keyframes pop-out {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(0.8) translateY(20px);
                opacity: 0;
            }
        }

        @keyframes backdrop-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-pop-in {
            animation: pop-in 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55) !important;
        }

        .animate-pop-out {
            animation: pop-out 0.25s ease-out !important;
        }

        .animate-backdrop-in {
            animation: backdrop-in 0.3s ease !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .create-kelas-container {
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
        // Custom Dropdown Functionality
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

                    if (inputId === 'durasi') {
                        const customInput = document.getElementById('durasi_custom');
                        if (value === 'custom') {
                            customInput.style.display = 'block';
                            customInput.required = true;
                        } else {
                            customInput.style.display = 'none';
                            customInput.required = false;
                            customInput.value = '';
                        }
                    }
                });
            });

            document.addEventListener('click', function() {
                customSelect.classList.remove('active');
            });
        }

        initCustomSelect('jenjangSelect', 'jenjang_pendidikan');
        initCustomSelect('durasiSelect', 'durasi');

        // SweetAlert Konfirmasi - SIMPLE (TANPA POP-UP SUKSES)
        document.getElementById('simpanKelasBtn').addEventListener('click', function(e) {
            e.preventDefault();

            const form = document.getElementById('kelasForm');
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
                        <p class="swal-text">Apakah Anda yakin ingin menyimpan kelas ini?</p>
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
                    // Langsung submit form TANPA pop-up sukses
                    form.submit();
                }
            });
        });
    </script>
@endsection
