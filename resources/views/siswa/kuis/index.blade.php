@extends('layouts.siswa_reader')

@section('title', 'Kuis & Ujian - ' . $kelas->nama_kelas)

@section('content')
    <div class="kuis-wrapper">
        {{-- HEADER --}}
        <div class="kuis-header">
            <div class="kuis-header-container">
                <a href="{{ route('siswa.kelas.index') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    <span class="back-text">Kembali</span>
                </a>
                <h1 class="page-title">{{ $kelas->nama_kelas }}</h1>
            </div>
        </div>

        {{-- MAIN CONTENT (dibesarkan max-width 1100px) --}}
        <div class="kuis-container">
            @forelse ($tugasList as $tugas)
                @php
                    $riwayat = $tugas
                        ->jawabans()
                        ->where('siswa_id', $siswa->id)
                        ->where('status', 'selesai')
                        ->orderByDesc('created_at')
                        ->get();

                    $lastAttempt = $riwayat->first();
                    $cooldown = false;
                    $sisaDetik = 0;

                   // if ($tugas->tipe === 'kuis' && $lastAttempt && $lastAttempt->skor < 75) {
                     //   $selisih = \Carbon\Carbon::now()->diffInSeconds($lastAttempt->created_at);
                       // if ($selisih < 60) {
                         //   $cooldown = true;
                           // $sisaDetik = 60 - $selisih;
                        //}
                    //}

                    $canRetake = true;
                    if (in_array($tugas->tipe, ['ujian', 'ujian_bab'])) {
                        if ($riwayat->where('status', 'selesai')->isNotEmpty()) {
                            $canRetake = false;
                        }
                    }
                @endphp

                <div class="kuis-card" id="kuis-{{ $tugas->id }}">
                    <div class="kuis-card-header">
                        <h2 class="kuis-title">{{ $tugas->judul }}</h2>
                        <span class="kuis-badge kuis-badge-{{ $tugas->tipe }}">
                            {{ strtoupper(str_replace('_', ' ', $tugas->tipe)) }}
                        </span>
                    </div>

                    {{-- ATURAN --}}
                    <div class="kuis-section">
                        <h3 class="section-title">Aturan</h3>
                        <div class="aturan-content">
                            <p>
                                {{ $tugas->tipe === 'kuis' ? 'Kuis' : 'Ujian' }} ini bertujuan untuk menguji pengetahuan Anda
                                tentang materi
                                <strong>{{ $tugas->materi ? $tugas->materi->judul : 'yang telah dipelajari' }}</strong>.
                            </p>
                            <p>
                                Terdapat <strong>{{ $tugas->soals->count() }} pertanyaan</strong> yang harus dikerjakan.
                                Beberapa ketentuannya sebagai berikut:
                            </p>
                            <ul class="aturan-list">
                                <li>Syarat nilai kelulusan: <strong>75%</strong></li>
                                <li>Durasi ujian: <strong>{{ $tugas->durasi ?? 5 }} menit</strong></li>
                            </ul>
                            @if ($tugas->tipe === 'kuis')
                                <p>
                                    Apabila tidak memenuhi syarat kelulusan, maka Anda harus menunggu selama
                                    <strong>1 menit</strong> untuk mengulang pengerjaan kuis kembali.
                                </p>
                            @else
                                <p class="warning-text">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <strong>Perhatian:</strong> Ujian hanya dapat dikerjakan <strong>satu kali</strong>.
                                </p>
                            @endif
                            <p class="success-text">Selamat Mengerjakan!</p>
                        </div>
                    </div>

                    {{-- TOMBOL MULAI / COOLDOWN --}}
                    <div class="kuis-section">
                        @if ($cooldown)
                            <div class="perhatian-box">
                                <div class="perhatian-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="perhatian-text">
                                    <strong>Perhatian</strong>
                                    <p>
                                        Silakan tunggu untuk mengambil ujian ulang:
                                        <span class="countdown-timer"
                                              data-seconds="{{ $sisaDetik }}"
                                              data-tugas-id="{{ $tugas->id }}">
                                            {{ $sisaDetik }}s
                                        </span>
                                    </p>
                                </div>
                            </div>
                        @else
                            @if ($canRetake)
                                {{-- Form POST ke route start --}}
                                <form method="POST"
                                      action="{{ route('siswa.kuis.start', $tugas->id) }}"
                                      class="form-start"
                                      id="form-start-{{ $tugas->id }}">
                                    @csrf
                                    <button type="button"
                                            class="btn-start-kuis"
                                            data-tugas-id="{{ $tugas->id }}"
                                            data-judul="{{ $tugas->judul }}">
                                        <i class="fas fa-play"></i>
                                        <span>MULAI</span>
                                    </button>
                                </form>
                            @else
                                <div class="alert-completed">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Anda telah menyelesaikan ujian ini.</span>
                                </div>
                            @endif

                            {{-- RIWAYAT --}}
                            @if ($riwayat->isNotEmpty())
                                <div class="kuis-section">
                                    <h3 class="section-title">Riwayat</h3>
                                    <div class="table-wrapper">
                                        <table class="riwayat-table">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Persentase</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riwayat as $attempt)
                                                    <tr>
                                                        <td data-label="Tanggal">
                                                            {{ $attempt->created_at->format('d M Y H:i') }}
                                                        </td>
                                                        <td data-label="Persentase">
                                                            <strong>{{ $attempt->skor }}%</strong>
                                                        </td>
                                                        <td data-label="Status">
                                                            @if ($attempt->skor >= 75)
                                                                <span class="badge badge-success">Lulus</span>
                                                            @else
                                                                <span class="badge badge-danger">Tidak Lulus</span>
                                                            @endif
                                                        </td>
                                                        <td data-label="Action">
                                                            <a href="{{ route('siswa.kuis.result', $attempt->id) }}"
                                                               class="btn-detail">
                                                                Lihat Detail
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div> {{-- /.kuis-section --}}
                </div> {{-- /.kuis-card --}}
            @empty
                <p>Tidak ada kuis atau ujian di kelas ini.</p>
            @endforelse
        </div> {{-- /.kuis-container --}}
    </div> {{-- /.kuis-wrapper --}}

    {{-- MODAL KONFIRMASI --}}
    <div class="modal-backdrop" id="modal-backdrop" style="display:none;">
        <div class="modal-dialog">
            <h3 class="modal-title">Konfirmasi</h3>
            <p class="modal-text" id="modal-text">
                Apakah Anda yakin ingin mengerjakan kuis ini?
            </p>
            <div class="modal-actions">
                <button type="button" class="btn-modal-secondary" id="btn-modal-cancel">Batal</button>
                <button type="button" class="btn-modal-primary" id="btn-modal-confirm">Lanjut</button>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .kuis-wrapper {
            min-height: 100vh;
            background: var(--bg-base);
        }

        .kuis-header {
            background: var(--bg-card);
            border-bottom: 1px solid var(--border-light);
            padding: 1rem 0;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .kuis-header-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            color: var(--text-primary);
            text-decoration: none;
        }

        .back-link i {
            font-size: 1.2rem;
        }

        .back-text {
            font-weight: 600;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .kuis-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .kuis-card {
            background: var(--bg-card);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-light);
            overflow: hidden;
        }

        .kuis-card-header {
            padding: 1.5rem 2rem;
            background: linear-gradient(135deg, #F5F7FA, #EDF2F7);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .kuis-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin: 0;
        }

        .kuis-badge {
            padding: .4rem .9rem;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .kuis-badge-kuis {
            background: #E3F2FD;
            color: #1565C0;
        }

        .kuis-section {
            padding: 1.75rem 2rem;
            border-top: 1px solid var(--border-light);
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .aturan-content {
            line-height: 1.7;
            color: var(--text-secondary);
        }

        .aturan-list {
            list-style: none;
            margin: 1rem 0;
            padding-left: 0;
        }

        .aturan-list li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: .5rem;
        }

        .aturan-list li::before {
            content: '•';
            position: absolute;
            left: .3rem;
            color: #00B8D4;
            font-size: 1.2rem;
        }

        .warning-text {
            margin-top: .5rem;
            font-size: .9rem;
            color: #E65100;
            display: flex;
            gap: .4rem;
            align-items: flex-start;
        }

        .success-text {
            margin-top: 1rem;
            color: #2E7D32;
            font-weight: 600;
        }

        .form-start {
            display: flex;
            justify-content: center;
            margin-top: .5rem;
        }

        .btn-start-kuis {
            display: inline-flex;
            align-items: center;
            gap: .7rem;
            padding: .9rem 3rem;
            border-radius: 999px;
            border: none;
            background: linear-gradient(135deg, #00B8D4, #00ACC1);
            color: white;
            font-weight: 700;
            box-shadow: 0 6px 16px rgba(0, 184, 212, .4);
            cursor: pointer;
        }

        .btn-start-kuis i {
            font-size: 1rem;
        }

        .perhatian-box {
            display: flex;
            gap: 1rem;
            padding: 1rem 1.25rem;
            background: #E1F5FE;
            border-radius: 12px;
            border: 1px solid #81D4FA;
        }

        .perhatian-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #00B8D4;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .countdown-timer {
            font-weight: 700;
            color: #00ACC1;
        }

        .table-wrapper {
            margin-top: 1rem;
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid var(--border-light);
        }

        .riwayat-table {
            width: 100%;
            border-collapse: collapse;
        }

        .riwayat-table th {
            padding: .8rem 1rem;
            background: #F5F7FA;
            font-size: .8rem;
            text-transform: uppercase;
        }

        .riwayat-table td {
            padding: .8rem 1rem;
            border-top: 1px solid var(--border-light);
        }

        .badge {
            display: inline-block;
            padding: .3rem .7rem;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 600;
        }

        .badge-success {
            background: #E8F5E9;
            color: #2E7D32;
        }

        .badge-danger {
            background: #FFEBEE;
            color: #C62828;
        }

        .btn-detail {
            padding: .4rem .9rem;
            border-radius: 8px;
            border: 1px solid var(--border-medium);
            text-decoration: none;
            color: var(--text-primary);
            font-size: .85rem;
        }

        /* Modal */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .45);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 80;
        }

        .modal-dialog {
            background: white;
            border-radius: 12px;
            padding: 1.5rem 1.75rem;
            max-width: 420px;
            width: 90%;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .3);
        }

        .modal-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: .75rem;
        }

        .modal-text {
            font-size: .95rem;
            color: var(--text-secondary);
            margin-bottom: 1.25rem;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: .75rem;
        }

        .btn-modal-secondary,
        .btn-modal-primary {
            padding: .45rem 1.1rem;
            border-radius: 8px;
            border: none;
            font-size: .9rem;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-modal-secondary {
            background: #E5E7EB;
            color: #374151;
        }

        .btn-modal-primary {
            background: #0EA5E9;
            color: white;
        }

        @media (max-width:768px) {
            .kuis-header-container {
                padding: 0 1rem;
                justify-content: space-between;
            }

            .page-title {
                text-align: center;
                font-size: 1.2rem;
                flex: 1;
            }

            .kuis-container {
                padding: 1.5rem 1rem;
            }

            .kuis-card-header {
                padding: 1.2rem 1.5rem;
            }

            .kuis-title {
                font-size: 1.2rem;
            }

            .kuis-section {
                padding: 1.25rem 1.5rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // ==== COUNTDOWN SISA WAKTU (kalau ada) ====
        document.querySelectorAll('.countdown-timer').forEach(el => {
            let sec = parseInt(el.dataset.seconds);
            if (isNaN(sec)) return;

            const timer = setInterval(() => {
                sec--;
                el.textContent = sec + 's';

                if (sec <= 0) {
                    clearInterval(timer);
                    location.reload();
                }
            }, 1000);
        });

        // ==== MODAL KONFIRMASI MULAI KUIS ====
        let currentTugasId = null;

        // Elemen modal
        const backdrop  = document.getElementById('modal-backdrop');
        const modalText = document.getElementById('modal-text');
        const btnCancel = document.getElementById('btn-modal-cancel');
        const btnConfirm = document.getElementById('btn-modal-confirm');

        // Saat klik tombol MULAI di kartu kuis
        document.querySelectorAll('.btn-start-kuis').forEach(btn => {
            btn.addEventListener('click', () => {
                currentTugasId = btn.dataset.tugasId;
                const judul = btn.dataset.judul;

                if (modalText) {
                    modalText.textContent = 'Apakah Anda yakin ingin mengerjakan "' + judul + '" ?';
                }

                if (backdrop) {
                    backdrop.style.display = 'flex';
                }
            });
        });

        // Tombol Batal → tutup modal
        if (btnCancel && backdrop) {
            btnCancel.addEventListener('click', () => {
                backdrop.style.display = 'none';
                currentTugasId = null;
            });
        }

        // Tombol Lanjut → submit form sesuai tugas_id
        if (btnConfirm) {
            btnConfirm.addEventListener('click', () => {
                if (!currentTugasId) return;

                const form = document.getElementById('form-start-' + currentTugasId);
                if (form) {
                    form.submit();
                }
            });
        }
    </script>
@endpush
