@extends('layouts.siswa_reader')

@section('title', 'Hasil ' . $tugas->judul)

@section('content')
@php
    $score = $attempt->skor;

    if ($score < 50) {
        $popupVariant = 'low';
        $popupTitle   = 'Belajar itu proses, bukan hasil instan';
        $popupText    = '"Setiap orang menjadi guru, setiap rumah menjadi sekolah." – Ki Hajar Dewantara. Nilai hari ini bukan penentu masa depanmu. Terus belajar dan jangan takut mencoba lagi.';
    } elseif ($score < 80) {
        $popupVariant = 'mid';
        $popupTitle   = 'Sedikit lagi, teruskan usahamu';
        $popupText    = '"Tanpa cinta, kecerdasan itu berbahaya. Dan tanpa kecerdasan, cinta itu tidak cukup." – B.J. Habibie. Kamu sudah punya dasar yang bagus, tinggal latihan dan fokus agar hasilnya maksimal.';
    } elseif ($score < 100) {
        $popupVariant = 'high';
        $popupTitle   = 'Kerja kerasmu mulai terlihat';
        $popupText    = '"Habis gelap terbitlah terang." – R.A. Kartini. Skormu sudah tinggi. Terus belajar dengan semangat, karena usaha tidak pernah mengkhianati hasil.';
    } else {
        $popupVariant = 'perfect';
        $popupTitle   = 'Sempurna, terus jaga prestasimu';
        $popupText    = '"Tujuan pendidikan itu untuk mempertajam kecerdasan, memperkukuh kemauan, serta memperhalus perasaan." – Tan Malaka. Nilai 100 adalah bukti disiplin dan ketekunanmu. Pertahankan kebiasaan baik ini.';
    }
@endphp

<div class="quiz-result-page">
    {{-- POPUP SKOR + QUOTE --}}
    <div class="quiz-result-popup" id="quiz-result-popup">
        <div class="quiz-result-popup-inner popup-theme-{{ $popupVariant }}">
            <div class="popup-background-layer"></div>

            {{-- TOMBOL CLOSE --}}
            <button type="button" class="popup-close-btn" id="popup-close-btn" aria-label="Tutup">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>

            <div class="popup-icon-wrapper popup-icon-{{ $popupVariant }}">
                @if ($popupVariant === 'low')
                    <svg xmlns="http://www.w3.org/2000/svg" class="popup-icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <circle cx="12" cy="12" r="9" stroke-width="1.8"/>
                        <path d="M9 10h.01M15 10h.01" stroke-linecap="round" stroke-width="1.8"/>
                        <path d="M9 16c1-.8 2-.8 3-.8s2 0 3 .8" stroke-linecap="round" stroke-width="1.6"/>
                    </svg>
                @elseif ($popupVariant === 'mid')
                    <svg xmlns="http://www.w3.org/2000/svg" class="popup-icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M5 19l4-9 4 4 6-11" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"/>
                        <path d="M4 5h5M4 9h3" stroke-linecap="round" stroke-width="1.5"/>
                    </svg>
                @elseif ($popupVariant === 'high')
                    <svg xmlns="http://www.w3.org/2000/svg" class="popup-icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M12 3l2.3 4.7 5.2.8-3.8 3.7.9 5.2L12 15.8 7.4 17.4l.9-5.2-3.8-3.7 5.2-.8L12 3z"
                              stroke-linejoin="round" stroke-width="1.6"/>
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="popup-icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M8 5h8v3a4 4 0 0 1-8 0V5z" stroke-linejoin="round" stroke-width="1.8"/>
                        <path d="M9 21h6M10 17h4" stroke-linecap="round" stroke-width="1.6"/>
                        <path d="M6 6H4v2a3 3 0 0 0 3 3" stroke-linecap="round" stroke-width="1.5"/>
                        <path d="M18 6h2v2a3 3 0 0 1-3 3" stroke-linecap="round" stroke-width="1.5"/>
                    </svg>
                @endif
            </div>

            <h2 class="popup-title-text">{{ $popupTitle }}</h2>
            <p class="popup-score-text">
                Skor kamu <span>{{ $score }}</span> / 100
            </p>
            <p class="popup-description-text">{{ $popupText }}</p>
        </div>
    </div>

    {{-- KONTEN UTAMA --}}
    <main class="quiz-result-main">
        <section class="quiz-result-summary">
            <h1 class="quiz-result-heading">Hasil {{ $tugas->judul }}</h1>
            <p class="quiz-result-subheading">{{ $kelas->nama_kelas }}</p>

            <div class="quiz-result-stat-grid">
                <div class="quiz-result-stat-card stat-card-total">
                    <div class="stat-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="stat-label">Total Soal</span>
                    <span class="stat-value">{{ $attempt->total_soal }}</span>
                </div>

                <div class="quiz-result-stat-card stat-card-correct">
                    <div class="stat-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="stat-label">Benar</span>
                    <span class="stat-value">{{ $attempt->total_benar }}</span>
                </div>

                <div class="quiz-result-stat-card stat-card-score">
                    <div class="stat-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="stat-label">Skor</span>
                    <span class="stat-value main-score">{{ $attempt->skor }}</span>
                </div>

                <div class="quiz-result-stat-card stat-card-status">
                    <div class="stat-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="stat-label">Status</span>
                    @if ($attempt->skor >= 75)
                        <span class="status-badge status-pass">Lulus</span>
                    @else
                        <span class="status-badge status-fail">Belum Lulus</span>
                    @endif
                </div>
            </div>

            <div class="quiz-result-actions">
                <a href="{{ route('siswa.kuis.index', $kelas->id) }}" class="result-back-button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Kembali ke Daftar Kuis</span>
                </a>
            </div>
        </section>
    </main>
</div>
@endsection

@push('styles')
<style>
    .quiz-result-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #E0F2FE 0%, #F0FDF4 50%, #FEF3C7 100%);
        display: flex;
        justify-content: center;
        padding: 2.5rem 1rem 3.5rem;
    }

    .quiz-result-main {
        width: 100%;
        max-width: 980px;
    }

    .quiz-result-summary {
        background: linear-gradient(145deg, #FFFFFF, #F8FAFC);
        border-radius: 28px;
        padding: 2rem 2.2rem 1.9rem;
        box-shadow: 0 20px 50px rgba(15, 23, 42, .14);
        border: 2px solid rgba(56, 189, 248, .15);
    }

    .quiz-result-heading {
        text-align: center;
        font-size: 1.85rem;
        font-weight: 800;
        margin: 0;
        color: #0F172A;
    }

    .quiz-result-subheading {
        text-align: center;
        margin-top: .3rem;
        font-size: 1rem;
        color: #64748B;
        font-weight: 500;
    }

    .quiz-result-stat-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1.2rem;
        margin-top: 1.8rem;
    }

    .quiz-result-stat-card {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 1.1rem 1.2rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .1);
        position: relative;
        overflow: hidden;
        border: 2px solid transparent;
        transition: transform .2s, box-shadow .2s;
    }

    .quiz-result-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 35px rgba(15, 23, 42, .16);
    }

    .stat-card-total {
        border-color: #BFDBFE;
        background: linear-gradient(135deg, #EFF6FF, #DBEAFE);
    }
    .stat-card-correct {
        border-color: #BBF7D0;
        background: linear-gradient(135deg, #F0FDF4, #DCFCE7);
    }
    .stat-card-score {
        border-color: #DDD6FE;
        background: linear-gradient(135deg, #F5F3FF, #EDE9FE);
    }
    .stat-card-status {
        border-color: #FED7AA;
        background: linear-gradient(135deg, #FFF7ED, #FFEDD5);
    }

    .stat-card-icon {
        width: 36px;
        height: 36px;
        margin: 0 auto .4rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .stat-card-total .stat-card-icon { color: #3B82F6; }
    .stat-card-correct .stat-card-icon { color: #22C55E; }
    .stat-card-score .stat-card-icon { color: #8B5CF6; }
    .stat-card-status .stat-card-icon { color: #F97316; }

    .stat-card-icon svg {
        width: 28px;
        height: 28px;
    }

    .stat-label {
        display: block;
        font-size: .85rem;
        color: #64748B;
        margin-bottom: .25rem;
        font-weight: 600;
    }

    .stat-value {
        font-size: 1.3rem;
        font-weight: 800;
        color: #0F172A;
    }

    .main-score {
        color: #8B5CF6;
        font-size: 1.65rem;
    }

    .status-badge {
        display: inline-block;
        padding: .3rem .9rem;
        border-radius: 999px;
        font-size: .85rem;
        font-weight: 700;
    }

    .status-pass {
        background: #86EFAC;
        color: #166534;
    }

    .status-fail {
        background: #FCA5A5;
        color: #991B1B;
    }

    .quiz-result-actions {
        margin-top: 1.8rem;
        display: flex;
        justify-content: center;
    }

    .result-back-button {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .75rem 2rem;
        border-radius: 999px;
        border: 2px solid #3B82F6;
        background: linear-gradient(135deg, #3B82F6, #2563EB);
        font-size: 1rem;
        font-weight: 700;
        color: #FFFFFF;
        text-decoration: none;
        box-shadow: 0 12px 28px rgba(59, 130, 246, .35);
        transition: transform .2s, box-shadow .2s;
    }

    .result-back-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 35px rgba(59, 130, 246, .45);
    }

    .result-back-button svg {
        width: 20px;
        height: 20px;
    }

    /* POPUP */

    .quiz-result-popup {
        position: fixed;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 90;
        background: rgba(15, 23, 42, .5);
        animation: popupOverlayIn .3s ease-out;
    }

    .quiz-result-popup-inner {
        position: relative;
        max-width: 440px;
        width: 92%;
        background: #FFFFFF;
        border-radius: 24px;
        padding: 2rem 2.2rem 1.8rem;
        text-align: center;
        box-shadow: 0 25px 60px rgba(15, 23, 42, .5);
        overflow: hidden;
        animation: popupBounceIn .6s cubic-bezier(0.34, 1.56, 0.64, 1);
        border: 3px solid transparent;
    }

    .popup-theme-low    { border-color: #FB923C; }
    .popup-theme-mid    { border-color: #38BDF8; }
    .popup-theme-high   { border-color: #4ADE80; }
    .popup-theme-perfect{ border-color: #FBBF24; }

    .popup-background-layer {
        position: absolute;
        inset: -50%;
        opacity: .3;
        animation: popupBgDrift 14s linear infinite;
        pointer-events: none;
    }

    .popup-theme-low .popup-background-layer {
        background:
            radial-gradient(circle at 20% 30%, #FB923C 0, transparent 45%),
            radial-gradient(circle at 80% 70%, #F472B6 0, transparent 45%);
    }
    .popup-theme-mid .popup-background-layer {
        background:
            radial-gradient(circle at 20% 30%, #38BDF8 0, transparent 45%),
            radial-gradient(circle at 80% 70%, #818CF8 0, transparent 45%);
    }
    .popup-theme-high .popup-background-layer {
        background:
            radial-gradient(circle at 20% 30%, #4ADE80 0, transparent 45%),
            radial-gradient(circle at 80% 70%, #34D399 0, transparent 45%);
    }
    .popup-theme-perfect .popup-background-layer {
        background:
            radial-gradient(circle at 20% 30%, #FBBF24 0, transparent 45%),
            radial-gradient(circle at 80% 70%, #FCD34D 0, transparent 45%);
    }

    .popup-close-btn {
        position: absolute;
        top: .9rem;
        right: .9rem;
        width: 32px;
        height: 32px;
        border-radius: 999px;
        border: none;
        background: rgba(15, 23, 42, .08);
        color: #475569;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 2;
        transition: background .15s, color .15s;
    }

    .popup-close-btn:hover {
        background: rgba(15, 23, 42, .15);
        color: #0F172A;
    }

    .popup-close-btn svg {
        width: 18px;
        height: 18px;
    }

    .popup-icon-wrapper {
        width: 72px;
        height: 72px;
        border-radius: 999px;
        background: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto .8rem;
        box-shadow: 0 14px 35px rgba(15, 23, 42, .3);
        position: relative;
        z-index: 1;
        border: 3px solid;
    }

    .popup-icon-low     { color: #F97316; border-color: #FDBA74; }
    .popup-icon-mid     { color: #0EA5E9; border-color: #7DD3FC; }
    .popup-icon-high    { color: #22C55E; border-color: #86EFAC; }
    .popup-icon-perfect { color: #FACC15; border-color: #FDE047; }

    .popup-icon-svg {
        width: 38px;
        height: 38px;
    }

    .popup-title-text {
        position: relative;
        z-index: 1;
        margin: 0 0 .4rem;
        font-size: 1.35rem;
        font-weight: 900;
        color: #0F172A;
    }

    .popup-score-text {
        position: relative;
        z-index: 1;
        font-size: 1.05rem;
        margin-bottom: .5rem;
        color: #334155;
        font-weight: 600;
    }

    .popup-score-text span {
        font-size: 1.85rem;
        font-weight: 900;
        color: #8B5CF6;
    }

    .popup-description-text {
        position: relative;
        z-index: 1;
        font-size: .95rem;
        color: #475569;
        margin: 0;
        line-height: 1.6;
    }

    @keyframes popupOverlayIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    @keyframes popupBounceIn {
        0%   { transform: translateY(35px) scale(.88); opacity: 0; }
        60%  { transform: translateY(-8px) scale(1.04); opacity: 1; }
        100% { transform: translateY(0) scale(1); }
    }

    @keyframes popupFadeOut {
        from { opacity: 1; transform: translateY(0) scale(1); }
        to   { opacity: 0; transform: translateY(12px) scale(.94); }
    }

    @keyframes popupBgDrift {
        0%   { transform: translate3d(0,0,0) rotate(0deg); }
        50%  { transform: translate3d(-15px,12px,0) rotate(3deg); }
        100% { transform: translate3d(0,0,0) rotate(0deg); }
    }

    @media (max-width: 768px) {
        .quiz-result-page {
            padding: 2rem .9rem 3rem;
        }
        .quiz-result-summary {
            padding: 1.7rem 1.4rem 1.5rem;
        }
        .quiz-result-stat-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    const popupElement = document.getElementById('quiz-result-popup');
    const popupCloseBtn = document.getElementById('popup-close-btn');

    function closePopup() {
        if (!popupElement) return;
        const inner = popupElement.querySelector('.quiz-result-popup-inner');
        if (inner) {
            inner.style.animation = 'popupFadeOut .4s ease-out forwards';
        }
        setTimeout(() => {
            popupElement.style.display = 'none';
        }, 400);
    }

    if (popupCloseBtn) {
        popupCloseBtn.addEventListener('click', closePopup);
    }

    if (popupElement) {
        setTimeout(closePopup, 9000);
    }
</script>
@endpush
