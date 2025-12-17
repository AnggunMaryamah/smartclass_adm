@extends('layouts.siswa_reader')

@section('title', 'Mengerjakan ' . $tugas->judul)

@section('content')
<div class="kuis-attempt-wrapper">
    <header class="kuis-attempt-header">
        <div class="kuis-attempt-header-inner">
            <span class="kuis-badge-title">
                <i class="fas fa-calculator"></i> Kuis / Ujian
            </span>
            <h1 class="kuis-attempt-title">{{ $tugas->judul }}</h1>
            <p class="kuis-attempt-subtitle">
                {{ $kelas->nama_kelas }} · Total Soal: <strong>{{ $soal->count() }}</strong>
            </p>
        </div>
    </header>

    <main class="kuis-attempt-main">
        <form method="POST" action="{{ route('siswa.kuis.submit', $tugas->id) }}" id="form-kuis">
            @csrf

            <div class="soal-list">
                @foreach ($soal as $index => $s)
                    <article class="soal-card">
                        <div class="soal-header">
                            <span class="soal-number">{{ $index + 1 }}</span>
                            <div>
                                <p class="soal-label">
                                    <i class="fas fa-question-circle text-blue"></i>
                                    Pertanyaan {{ $index + 1 }}
                                </p>
                                <p class="soal-text">{{ $s->pertanyaan }}</p>
                            </div>
                        </div>

                        <div class="pilihan-list">
                            <label class="pilihan-item">
                                <input type="radio" name="jawaban[{{ $s->id }}]" value="A" required>
                                <span class="pilihan-label">
                                    <span class="pilihan-code code-a">A</span>
                                    <span class="pilihan-text">{{ $s->pilihan_a }}</span>
                                </span>
                            </label>

                            <label class="pilihan-item">
                                <input type="radio" name="jawaban[{{ $s->id }}]" value="B">
                                <span class="pilihan-label">
                                    <span class="pilihan-code code-b">B</span>
                                    <span class="pilihan-text">{{ $s->pilihan_b }}</span>
                                </span>
                            </label>

                            <label class="pilihan-item">
                                <input type="radio" name="jawaban[{{ $s->id }}]" value="C">
                                <span class="pilihan-label">
                                    <span class="pilihan-code code-c">C</span>
                                    <span class="pilihan-text">{{ $s->pilihan_c }}</span>
                                </span>
                            </label>

                            <label class="pilihan-item">
                                <input type="radio" name="jawaban[{{ $s->id }}]" value="D">
                                <span class="pilihan-label">
                                    <span class="pilihan-code code-d">D</span>
                                    <span class="pilihan-text">{{ $s->pilihan_d }}</span>
                                </span>
                            </label>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="kuis-attempt-actions">
                <button type="button" class="btn-secondary" id="btn-batal">
                    <i class="fas fa-times-circle"></i> Batal
                </button>
                <button type="button" class="btn-primary" id="btn-submit-open">
                     Selesai
                </button>
            </div>
        </form>
    </main>

    {{-- MODAL KONFIRMASI BATAL --}}
    <div class="modal-backdrop" id="modal-batal" style="display:none;">
        <div class="modal-dialog">
            <h3 class="modal-title">
                <i class="fas fa-exclamation-triangle text-orange"></i> Keluar dari Kuis?
            </h3>
            <p class="modal-text">
                Apakah Anda yakin ingin membatalkan pengerjaan kuis ini?
                Jika keluar sekarang, jawaban yang sudah diisi tidak akan disimpan.
            </p>
            <div class="modal-actions">
                <button type="button" class="btn-modal-secondary" id="btn-batal-tutup">
                    Lanjut Mengerjakan
                </button>
                <a href="{{ route('siswa.kuis.show', $tugas->id) }}" class="btn-modal-danger">
                    Ya, Keluar
                </a>
            </div>
        </div>
    </div>

    {{-- MODAL KONFIRMASI SUBMIT --}}
    <div class="submit-backdrop" id="modal-submit" style="display:none;">
        <div class="submit-dialog">
            <div class="submit-bg-layer"></div>

            <button type="button" class="submit-close-btn" id="submit-close-btn" aria-label="Tutup konfirmasi">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>

            <div class="submit-icon-wrapper">
                <div class="submit-icon-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="submit-icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div class="submit-icon-ring"></div>
            </div>

            <h3 class="submit-title">Yakin ingin mengumpulkan jawaban?</h3>
            <p class="submit-text">
                Setelah dikumpulkan, kamu tidak bisa mengubah jawaban lagi.
                Pastikan semua soal sudah kamu cek terlebih dahulu.
            </p>

            <div class="submit-actions">
                <button type="button" class="btn-submit-cancel" id="btn-submit-cancel">
                    Tinjau Lagi
                </button>
                <button type="button" class="btn-submit-confirm" id="btn-submit-confirm">
                    Kirim Jawaban
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .kuis-attempt-wrapper {
        min-height: 100vh;
        background: radial-gradient(circle at top, #E0F7FA 0, #F9FAFB 55%, #FFFFFF 100%);
        display: flex;
        flex-direction: column;
    }

    .kuis-attempt-header {
        padding: 1.5rem 1rem 1rem;
    }

    .kuis-attempt-header-inner {
        max-width: 960px;
        margin: 0 auto;
        text-align: center;
    }

    .kuis-badge-title {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .25rem .75rem;
        border-radius: 999px;
        font-size: .8rem;
        font-weight: 600;
        background: #E3F2FD;
        color: #1565C0;
    }

    .kuis-attempt-title {
        margin-top: .6rem;
        font-size: 1.7rem;
        font-weight: 800;
    }

    .kuis-attempt-subtitle {
        margin-top: .15rem;
        color: var(--text-secondary);
        font-size: .95rem;
    }

    .kuis-attempt-main {
        max-width: 960px;
        margin: 0 auto 2rem;
        padding: 0 1rem 2rem;
    }

    .soal-list {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        margin-top: 1.25rem;
    }

    .soal-card {
        background: #FFFFFF;
        border-radius: 18px;
        border: 1px solid #E5E7EB;
        box-shadow: 0 10px 25px rgba(15, 23, 42, .06);
        padding: 1.25rem 1.4rem 1.1rem;
    }

    .soal-header {
        display: flex;
        gap: .8rem;
        align-items: flex-start;
        margin-bottom: .9rem;
    }

    .soal-number {
        width: 32px;
        height: 32px;
        border-radius: 999px;
        background: linear-gradient(135deg, #38BDF8, #22C55E);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: .9rem;
        flex-shrink: 0;
    }

    .soal-label {
        margin: 0;
        font-size: .85rem;
        color: #6B7280;
    }

    .text-blue { color: #2563EB; }
    .text-orange { color: #EA580C; }

    .soal-text {
        margin: .15rem 0 0;
        font-weight: 600;
    }

    .pilihan-list {
        display: flex;
        flex-direction: column;
        gap: .5rem;
    }

    .pilihan-item {
        display: flex;
        align-items: center;
        gap: .45rem;
        padding: .5rem .65rem;
        border-radius: 12px;
        border: 1px solid transparent;
        cursor: pointer;
        transition: background .15s, border-color .15s, box-shadow .15s, transform .05s;
    }

    .pilihan-item:hover {
        background: #F3F4FF;
        border-color: #C7D2FE;
        box-shadow: 0 4px 10px rgba(79, 70, 229, .12);
        transform: translateY(-1px);
    }

    .pilihan-item input[type="radio"] {
        flex-shrink: 0;
        margin-right: .25rem;
    }

    .pilihan-label {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
    }

    .pilihan-code {
        width: 26px;
        height: 26px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .8rem;
        font-weight: 700;
        color: #111827;
    }

    .code-a { background: #FDE68A; }
    .code-b { background: #BFDBFE; }
    .code-c { background: #BBF7D0; }
    .code-d { background: #FBCFE8; }

    .pilihan-text {
        font-size: .95rem;
    }

    .kuis-attempt-actions {
        margin-top: 1.5rem;
        display: flex;
        justify-content: space-between;
        gap: 1rem;
    }

    .btn-primary,
    .btn-secondary {
        border-radius: 999px;
        padding: .7rem 1.9rem;
        font-weight: 600;
        font-size: .95rem;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: .5rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0EA5E9, #22C55E);
        color: #fff;
        box-shadow: 0 8px 18px rgba(34, 197, 94, .35);
    }

    .btn-secondary {
        background: #F3F4F6;
        color: #374151;
        border: 1px solid #D1D5DB;
    }

    /* Modal Batal */
    .modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, .5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 80;
    }

    .modal-dialog {
        background: #fff;
        border-radius: 16px;
        padding: 1.5rem 1.75rem 1.3rem;
        max-width: 420px;
        width: 90%;
        box-shadow: 0 18px 40px rgba(15, 23, 42, .4);
    }

    .modal-title {
        margin: 0 0 .75rem;
        font-size: 1.05rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: .4rem;
    }

    .modal-text {
        font-size: .9rem;
        color: var(--text-secondary);
        margin-bottom: 1.1rem;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: .7rem;
    }

    .btn-modal-secondary,
    .btn-modal-danger {
        border-radius: 10px;
        padding: .45rem 1.1rem;
        font-size: .9rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: .35rem;
    }

    .btn-modal-secondary {
        background: #E5E7EB;
        color: #374151;
    }
    .btn-modal-danger {
        background: #EF4444;
        color: #fff;
    }

    /* Modal Submit */
    .submit-backdrop {
        position: fixed;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 90;
        background: rgba(15, 23, 42, .45);
        animation: fadeIn .25s ease-out;
    }

    .submit-dialog {
        position: relative;
        max-width: 420px;
        width: 90%;
        background: #FFFFFF;
        border-radius: 20px;
        padding: 1.9rem 2rem 1.5rem;
        text-align: center;
        box-shadow: 0 24px 60px rgba(15, 23, 42, .55);
        overflow: hidden;
        border: 2px solid #BFDBFE;
    }

    .submit-bg-layer {
        position: absolute;
        inset: -40%;
        background:
            radial-gradient(circle at 0% 0%, #38BDF8 0, transparent 55%),
            radial-gradient(circle at 100% 0%, #34D399 0, transparent 55%),
            radial-gradient(circle at 50% 100%, #F9A8D4 0, transparent 60%);
        opacity: .35;
        animation: submitBgMove 14s linear infinite;
        pointer-events: none;
    }

    .submit-close-btn {
        position: absolute;
        top: .8rem;
        right: .8rem;
        width: 30px;
        height: 30px;
        border-radius: 999px;
        border: none;
        background: rgba(248, 250, 252, .9);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 2;
        color: #64748B;
        transition: background .15s, color .15s;
    }

    .submit-close-btn:hover {
        background: #E5E7EB;
        color: #0F172A;
    }

    .submit-close-btn svg {
        width: 16px;
        height: 16px;
    }

    .submit-icon-wrapper {
        position: relative;
        z-index: 1;
        width: 88px;
        height: 88px;
        margin: 0 auto .7rem;
    }

    .submit-icon-circle {
        width: 100%;
        height: 100%;
        border-radius: 999px;
        background: #ECFEFF;
        border: 3px solid #38BDF8;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #22C55E;
        box-shadow: 0 14px 35px rgba(56, 189, 248, .5);
        animation: scaleIn .6s ease-out;
    }

    .submit-icon-svg {
        width: 40px;
        height: 40px;
    }

    .submit-icon-ring {
        position: absolute;
        inset: 8px;
        border-radius: 999px;
        border: 2px dashed rgba(56, 189, 248, .6);
        animation: spinRing 6s linear infinite;
    }

    .submit-title {
        position: relative;
        z-index: 1;
        margin: .5rem 0 .3rem;
        font-size: 1.2rem;
        font-weight: 800;
        color: #0F172A;
    }

    .submit-text {
        position: relative;
        z-index: 1;
        font-size: .95rem;
        color: #475569;
        margin: 0 0 1.1rem;
        line-height: 1.55;
    }

    .submit-actions {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: center;
        gap: .7rem;
    }

    .btn-submit-cancel,
    .btn-submit-confirm {
        border-radius: 999px;
        padding: .55rem 1.4rem;
        font-size: .9rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }

    .btn-submit-cancel {
        background: #FFFFFF;
        color: #1F2937;
        border: 1px solid #CBD5F5;
    }

    .btn-submit-confirm {
        background: linear-gradient(135deg, #22C55E, #16A34A);
        color: #FFFFFF;
        box-shadow: 0 10px 26px rgba(34, 197, 94, .45);
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    @keyframes submitBgMove {
        0%   { transform: translate3d(0,0,0); }
        50%  { transform: translate3d(-14px,10px,0); }
        100% { transform: translate3d(0,0,0); }
    }

    @keyframes scaleIn {
        0%   { transform: scale(.4); opacity: 0; }
        60%  { transform: scale(1.05); opacity: 1; }
        100% { transform: scale(1); }
    }

    @keyframes spinRing {
        0%   { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @media (max-width: 768px) {
        .kuis-attempt-main {
            padding: 0 .75rem 1.8rem;
        }
        .kuis-attempt-actions {
            flex-direction: column-reverse;
        }
        .btn-primary,
        .btn-secondary {
            width: 100%;
            justify-content: center;
        }
        .submit-dialog {
            padding: 1.6rem 1.4rem 1.4rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    const btnBatal       = document.getElementById('btn-batal');
    const modalBatal     = document.getElementById('modal-batal');
    const btnBatalTutup  = document.getElementById('btn-batal-tutup');

    const btnSubmitOpen   = document.getElementById('btn-submit-open');
    const modalSubmit     = document.getElementById('modal-submit');
    const btnSubmitCancel = document.getElementById('btn-submit-cancel');
    const btnSubmitConfirm= document.getElementById('btn-submit-confirm');
    const submitCloseBtn  = document.getElementById('submit-close-btn');
    const formKuis        = document.getElementById('form-kuis');

    if (btnBatal && modalBatal) {
        btnBatal.addEventListener('click', () => {
            modalBatal.style.display = 'flex';
        });
    }

    if (btnBatalTutup && modalBatal) {
        btnBatalTutup.addEventListener('click', () => {
            modalBatal.style.display = 'none';
        });
    }

    if (btnSubmitOpen && modalSubmit) {
        btnSubmitOpen.addEventListener('click', () => {
            modalSubmit.style.display = 'flex';
        });
    }

    function closeSubmitModal() {
        if (!modalSubmit) return;
        const dialog = modalSubmit.querySelector('.submit-dialog');
        if (dialog) {
            dialog.style.animation = 'popupFadeOut .25s ease-out forwards';
        }
        setTimeout(() => {
            modalSubmit.style.display = 'none';
            if (dialog) dialog.style.animation = ''; // reset
        }, 250);
    }

    if (btnSubmitCancel) {
        btnSubmitCancel.addEventListener('click', closeSubmitModal);
    }
    if (submitCloseBtn) {
        submitCloseBtn.addEventListener('click', closeSubmitModal);
    }

    if (btnSubmitConfirm && formKuis) {
        btnSubmitConfirm.addEventListener('click', () => {
            formKuis.submit();
        });
    }
</script>
@endpush
