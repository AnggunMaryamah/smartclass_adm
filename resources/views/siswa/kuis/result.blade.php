@extends('layouts.siswa')

@section('title', 'Hasil ' . $tugas->judul)

@section('content')
<div class="result-container">
    {{-- HEADER --}}
    <div class="result-header">
        <a href="{{ route('siswa.kuis.show', $tugas->id) }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h1>Hasil {{ ucfirst($tugas->tipe) }}</h1>
        <p class="result-subtitle">{{ $tugas->judul }} - {{ $tugas->kelas->nama_kelas }}</p>
    </div>

    {{-- SKOR CARD --}}
    <div class="score-card {{ $attempt->skor >= 75 ? 'pass' : 'fail' }}">
        <div class="score-icon">
            @if($attempt->skor >= 75)
                <div class="icon-check-circle">
                    <i class="fas fa-check"></i>
                </div>
            @else
                <div class="icon-x-circle">
                    <i class="fas fa-times"></i>
                </div>
            @endif
        </div>

        <div class="score-main">
            <h2>{{ $attempt->skor >= 75 ? 'Selamat! Anda Lulus' : 'Belum Lulus' }}</h2>
            <div class="score-value">{{ $attempt->skor }}<span class="score-unit">%</span></div>
            <p class="score-desc">
                @if($attempt->skor >= 75)
                    Kerja bagus! Anda telah menyelesaikan {{ $tugas->tipe }} ini dengan baik.
                @else
                    Jangan menyerah! Terus belajar dan coba lagi untuk hasil yang lebih baik.
                @endif
            </p>
        </div>

        <div class="score-stats">
            <div class="stat-item">
                <div class="stat-icon correct">
                    <i class="fas fa-check"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Benar</span>
                    <span class="stat-value">{{ $attempt->total_benar }}</span>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon wrong">
                    <i class="fas fa-times"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Salah</span>
                    <span class="stat-value">{{ $attempt->total_soal - $attempt->total_benar }}</span>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon total">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Total Soal</span>
                    <span class="stat-value">{{ $attempt->total_soal }}</span>
                </div>
            </div>
        </div>

        <div class="score-date">
            <i class="far fa-calendar-alt"></i>
            Dikerjakan pada {{ $attempt->created_at->format('d M Y H:i') }}
        </div>
    </div>

    {{-- PEMBAHASAN SOAL --}}
    <div class="review-section">
        <div class="review-header">
            <h2><i class="fas fa-book-open"></i> Pembahasan Soal</h2>
            <p>Lihat jawaban Anda dan kunci jawaban yang benar</p>
        </div>

        <div class="review-questions">
            @foreach($attempt->details as $index => $detail)
                @php
                    $soal = $detail->soal;
                    $isCorrect = $detail->benar;
                @endphp

                <div class="review-card {{ $isCorrect ? 'correct' : 'wrong' }}">
                    <div class="review-card-header">
                        <div class="review-number">
                            <span>Soal {{ $index + 1 }}</span>
                            @if($isCorrect)
                                <span class="badge badge-correct">
                                    <i class="fas fa-check"></i> Benar
                                </span>
                            @else
                                <span class="badge badge-wrong">
                                    <i class="fas fa-times"></i> Salah
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="review-question">
                        <h3>Pertanyaan:</h3>
                        <p>{!! nl2br(e($soal->pertanyaan)) !!}</p>
                    </div>

                    <div class="review-options">
                        @foreach(['A' => $soal->pilihan_a, 'B' => $soal->pilihan_b, 'C' => $soal->pilihan_c, 'D' => $soal->pilihan_d] as $key => $value)
                            @if($value)
                                @php
                                    $isUserAnswer = ($detail->jawaban_siswa === $key);
                                    $isCorrectAnswer = ($soal->jawaban_benar === $key);
                                @endphp

                                <div class="review-option 
                                    {{ $isCorrectAnswer ? 'is-correct' : '' }} 
                                    {{ $isUserAnswer && !$isCorrectAnswer ? 'is-wrong' : '' }}
                                    {{ $isUserAnswer ? 'is-selected' : '' }}">
                                    
                                    <div class="option-marker">{{ $key }}</div>
                                    <div class="option-text">{{ $value }}</div>
                                    
                                    @if($isCorrectAnswer)
                                        <div class="option-badge correct-badge">
                                            <i class="fas fa-check"></i> Kunci Jawaban
                                        </div>
                                    @endif
                                    
                                    @if($isUserAnswer && !$isCorrectAnswer)
                                        <div class="option-badge wrong-badge">
                                            <i class="fas fa-times"></i> Jawaban Anda
                                        </div>
                                    @endif

                                    @if($isUserAnswer && $isCorrectAnswer)
                                        <div class="option-badge correct-badge">
                                            <i class="fas fa-check"></i> Jawaban Anda (Benar)
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach

                        @if(!$detail->jawaban_siswa)
                            <div class="no-answer-notice">
                                <i class="fas fa-exclamation-triangle"></i>
                                Anda tidak menjawab soal ini
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ACTION BUTTONS --}}
    <div class="result-actions">
        @if($attempt->skor < 75)
            <a href="{{ route('siswa.kuis.show', $tugas->id) }}" class="btn-retry">
                <i class="fas fa-redo"></i> Coba Lagi
            </a>
        @endif
        <a href="{{ route('siswa.kelas.read', $tugas->kelas_id) }}" class="btn-continue">
            <i class="fas fa-arrow-right"></i> Lanjut Belajar
        </a>
    </div>
</div>

<style>
.result-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

.result-header {
    margin-bottom: 2rem;
}

.result-header h1 {
    font-size: 2rem;
    font-weight: 700;
    color: #111827;
    margin: 0.5rem 0;
}

.result-subtitle {
    color: #6B7280;
    font-size: 1rem;
    margin: 0;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #6B7280;
    text-decoration: none;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    transition: color 0.2s;
}

.btn-back:hover {
    color: #0EA5E9;
}

/* SCORE CARD */
.score-card {
    background: #fff;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 10px 40px rgba(15, 23, 42, 0.12);
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
}

.score-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
}

.score-card.pass::before {
    background: linear-gradient(90deg, #22C55E, #16A34A);
}

.score-card.fail::before {
    background: linear-gradient(90deg, #EF4444, #DC2626);
}

.score-icon {
    margin-bottom: 1.5rem;
}

.icon-check-circle,
.icon-x-circle {
    width: 100px;
    height: 100px;
    margin: 0 auto;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    animation: scaleIn 0.5s ease;
}

.icon-check-circle {
    background: linear-gradient(135deg, #D1FAE5, #A7F3D0);
    color: #16A34A;
}

.icon-x-circle {
    background: linear-gradient(135deg, #FEE2E2, #FECACA);
    color: #DC2626;
}

@keyframes scaleIn {
    from {
        transform: scale(0);
    }
    to {
        transform: scale(1);
    }
}

.score-main h2 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 1rem;
}

.score-value {
    font-size: 5rem;
    font-weight: 700;
    background: linear-gradient(135deg, #0EA5E9, #0284C7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
    margin-bottom: 1rem;
}

.score-card.fail .score-value {
    background: linear-gradient(135deg, #EF4444, #DC2626);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.score-unit {
    font-size: 2.5rem;
}

.score-desc {
    font-size: 1rem;
    color: #6B7280;
    margin-bottom: 2rem;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

.score-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    background: #F9FAFB;
    border-radius: 12px;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.stat-icon.correct {
    background: #D1FAE5;
    color: #16A34A;
}

.stat-icon.wrong {
    background: #FEE2E2;
    color: #DC2626;
}

.stat-icon.total {
    background: #DBEAFE;
    color: #0284C7;
}

.stat-info {
    display: flex;
    flex-direction: column;
    text-align: left;
}

.stat-label {
    font-size: 0.85rem;
    color: #6B7280;
    margin-bottom: 0.25rem;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #111827;
}

.score-date {
    font-size: 0.9rem;
    color: #6B7280;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #E5E7EB;
}

/* REVIEW SECTION */
.review-section {
    margin-bottom: 3rem;
}

.review-header {
    margin-bottom: 2rem;
}

.review-header h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.review-header p {
    color: #6B7280;
    font-size: 0.95rem;
    margin: 0;
}

.review-questions {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.review-card {
    background: #fff;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 18px rgba(15, 23, 42, 0.08);
    border-left: 4px solid #E5E7EB;
}

.review-card.correct {
    border-left-color: #22C55E;
}

.review-card.wrong {
    border-left-color: #EF4444;
}

.review-card-header {
    margin-bottom: 1.5rem;
}

.review-number {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.review-number > span:first-child {
    font-size: 0.9rem;
    font-weight: 600;
    color: #0EA5E9;
}

.badge {
    padding: 0.4rem 0.75rem;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
}

.badge-correct {
    background: #D1FAE5;
    color: #16A34A;
}

.badge-wrong {
    background: #FEE2E2;
    color: #DC2626;
}

.review-question {
    margin-bottom: 1.5rem;
}

.review-question h3 {
    font-size: 0.9rem;
    font-weight: 600;
    color: #6B7280;
    margin-bottom: 0.75rem;
}

.review-question p {
    font-size: 1.05rem;
    font-weight: 600;
    color: #111827;
    line-height: 1.6;
    margin: 0;
}

.review-options {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.review-option {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.25rem;
    background: #F9FAFB;
    border: 2px solid #E5E7EB;
    border-radius: 12px;
    position: relative;
}

.review-option.is-correct {
    background: #ECFDF5;
    border-color: #22C55E;
}

.review-option.is-wrong {
    background: #FEF2F2;
    border-color: #EF4444;
}

.review-option .option-marker {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #fff;
    border: 2px solid #D1D5DB;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
    color: #6B7280;
    flex-shrink: 0;
}

.review-option.is-correct .option-marker {
    background: #22C55E;
    border-color: #22C55E;
    color: #fff;
}

.review-option.is-wrong .option-marker {
    background: #EF4444;
    border-color: #EF4444;
    color: #fff;
}

.review-option .option-text {
    flex: 1;
    font-size: 0.95rem;
    color: #374151;
    line-height: 1.5;
}

.option-badge {
    padding: 0.35rem 0.75rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    flex-shrink: 0;
}

.correct-badge {
    background: #22C55E;
    color: #fff;
}

.wrong-badge {
    background: #EF4444;
    color: #fff;
}

.no-answer-notice {
    padding: 1rem;
    background: #FEF3C7;
    border: 1px solid #FDE68A;
    border-radius: 8px;
    color: #92400E;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* ACTION BUTTONS */
.result-actions {
    display: flex;
    justify-content: center;
    gap: 1rem;
}

.btn-retry,
.btn-continue {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.1);
}

.btn-retry {
    background: #fff;
    color: #0EA5E9;
    border: 2px solid #0EA5E9;
}

.btn-retry:hover {
    background: #0EA5E9;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3);
}

.btn-continue {
    background: linear-gradient(135deg, #0EA5E9, #0284C7);
    color: #fff;
    border: none;
}

.btn-continue:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(14, 165, 233, 0.4);
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .result-container {
        padding: 1.5rem 1rem;
    }

    .score-card {
        padding: 2rem 1.5rem;
    }

    .score-value {
        font-size: 4rem;
    }

    .score-stats {
        grid-template-columns: 1fr;
    }

    .review-card {
        padding: 1.5rem;
    }

    .result-actions {
        flex-direction: column;
    }

    .btn-retry,
    .btn-continue {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .result-header h1 {
        font-size: 1.5rem;
    }

    .score-value {
        font-size: 3rem;
    }

    .score-unit {
        font-size: 1.5rem;
    }

    .review-option {
        padding: 0.875rem 1rem;
    }
}
</style>
@endsection
