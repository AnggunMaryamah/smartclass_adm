@extends('layouts.siswa')

@section('title', 'Mengerjakan ' . $tugas->judul)

@section('content')
<div class="quiz-attempt-container">
    {{-- HEADER --}}
    <div class="quiz-attempt-header">
        <div class="quiz-header-info">
            <a href="{{ route('siswa.kuis.show', $tugas->id) }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h1>{{ $tugas->judul }}</h1>
            <p class="quiz-subtitle">{{ $tugas->kelas->nama_kelas }}</p>
        </div>

        {{-- TIMER --}}
        <div class="quiz-timer" id="quizTimer">
            <div class="timer-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="timer-display">
                <span class="timer-label">Waktu Tersisa</span>
                <span class="timer-value" id="timerValue">05:00</span>
            </div>
        </div>
    </div>

    {{-- FORM SOAL --}}
    <form id="quizForm" class="quiz-form">
        @csrf
        <div class="quiz-questions">
            @foreach($soal as $index => $item)
                <div class="question-card" id="question-{{ $index + 1 }}">
                    <div class="question-number">
                        Pertanyaan {{ $index + 1 }} dari {{ $soal->count() }}
                    </div>

                    <div class="question-text">
                        {!! nl2br(e($item->pertanyaan)) !!}
                    </div>

                    <div class="question-options">
                        @foreach(['a' => $item->pilihan_a, 'b' => $item->pilihan_b, 'c' => $item->pilihan_c, 'd' => $item->pilihan_d] as $key => $value)
                            @if($value)
                                <label class="option-label">
                                    <input 
                                        type="radio" 
                                        name="jawaban[{{ $item->id }}]" 
                                        value="{{ strtoupper($key) }}"
                                        {{ (isset($savedAnswers[$item->id]) && $savedAnswers[$item->id] === strtoupper($key)) ? 'checked' : '' }}
                                    >
                                    <span class="option-marker">{{ strtoupper($key) }}</span>
                                    <span class="option-text">{{ $value }}</span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        {{-- NAVIGASI SOAL --}}
        <div class="quiz-navigation">
            <div class="question-nav-grid">
                @foreach($soal as $index => $item)
                    <button 
                        type="button" 
                        class="question-nav-btn {{ isset($savedAnswers[$item->id]) ? 'answered' : '' }}" 
                        data-question="{{ $index + 1 }}"
                        data-soal-id="{{ $item->id }}">
                        {{ $index + 1 }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- SUBMIT BUTTON --}}
        <div class="quiz-submit-section">
            <button type="button" id="submitQuizBtn" class="btn-submit-quiz">
                <i class="fas fa-paper-plane"></i> Submit Jawaban
            </button>
        </div>
    </form>
</div>

{{-- MODAL KONFIRMASI SUBMIT --}}
<div class="modal-overlay" id="submitModal">
    <div class="modal-card">
        <div class="modal-header">
            <h3>Konfirmasi Submit</h3>
            <button type="button" class="modal-close" id="closeSubmitModal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <p>Anda yakin ingin submit jawaban?</p>
            <p class="modal-warning">Setelah submit, jawaban tidak dapat diubah lagi.</p>
            <div class="modal-stats">
                <div class="stat-item">
                    <span class="stat-label">Dijawab</span>
                    <span class="stat-value" id="answeredCount">0</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Belum Dijawab</span>
                    <span class="stat-value text-danger" id="unansweredCount">{{ $soal->count() }}</span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-cancel" id="cancelSubmit">Batal</button>
            <button type="button" class="btn-confirm" id="confirmSubmit">
                <i class="fas fa-check"></i> Ya, Submit
            </button>
        </div>
    </div>
</div>

{{-- LOADING OVERLAY --}}
<div class="loading-overlay" id="loadingOverlay" style="display: none;">
    <div class="spinner"></div>
    <p>Menyimpan jawaban...</p>
</div>

<style>
.quiz-attempt-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 1.5rem 1rem;
}

.quiz-attempt-header {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 2rem;
    align-items: start;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 18px rgba(15, 23, 42, 0.08);
}

.quiz-header-info h1 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #111827;
    margin: 0.5rem 0;
}

.quiz-subtitle {
    color: #6B7280;
    font-size: 0.95rem;
    margin: 0;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #6B7280;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.2s;
}

.btn-back:hover {
    color: #0EA5E9;
}

/* TIMER */
.quiz-timer {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
    background: linear-gradient(135deg, #0EA5E9, #0284C7);
    border-radius: 12px;
    color: #fff;
    box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3); }
    50% { box-shadow: 0 8px 24px rgba(14, 165, 233, 0.5); }
}

.timer-icon {
    font-size: 2rem;
}

.timer-display {
    display: flex;
    flex-direction: column;
}

.timer-label {
    font-size: 0.8rem;
    opacity: 0.9;
    margin-bottom: 0.25rem;
}

.timer-value {
    font-size: 1.75rem;
    font-weight: 700;
    font-family: 'Courier New', monospace;
    letter-spacing: 0.05em;
}

.quiz-timer.warning {
    background: linear-gradient(135deg, #F97316, #EA580C);
    animation: shake 0.5s infinite;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

/* FORM LAYOUT */
.quiz-form {
    display: grid;
    grid-template-columns: 1fr 280px;
    gap: 2rem;
    align-items: start;
}

/* SOAL */
.quiz-questions {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.question-card {
    background: #fff;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 18px rgba(15, 23, 42, 0.08);
}

.question-number {
    font-size: 0.85rem;
    font-weight: 600;
    color: #0EA5E9;
    margin-bottom: 1rem;
    padding: 0.5rem 1rem;
    background: #EFF6FF;
    border-radius: 8px;
    display: inline-block;
}

.question-text {
    font-size: 1.1rem;
    font-weight: 600;
    color: #111827;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.question-options {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.option-label {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.25rem;
    background: #F9FAFB;
    border: 2px solid #E5E7EB;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s;
}

.option-label:hover {
    background: #EFF6FF;
    border-color: #0EA5E9;
}

.option-label input[type="radio"] {
    display: none;
}

.option-label input[type="radio"]:checked ~ .option-marker {
    background: #0EA5E9;
    color: #fff;
    border-color: #0EA5E9;
}

.option-label input[type="radio"]:checked ~ .option-text {
    color: #111827;
    font-weight: 600;
}

.option-label:has(input[type="radio"]:checked) {
    background: #EFF6FF;
    border-color: #0EA5E9;
    box-shadow: 0 4px 12px rgba(14, 165, 233, 0.2);
}

.option-marker {
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
    transition: all 0.2s;
}

.option-text {
    flex: 1;
    font-size: 0.95rem;
    color: #374151;
    line-height: 1.5;
}

/* NAVIGASI SOAL */
.quiz-navigation {
    position: sticky;
    top: 100px;
    background: #fff;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 18px rgba(15, 23, 42, 0.08);
}

.question-nav-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.question-nav-btn {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    border: 2px solid #E5E7EB;
    background: #fff;
    color: #6B7280;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s;
}

.question-nav-btn:hover {
    border-color: #0EA5E9;
    color: #0EA5E9;
}

.question-nav-btn.answered {
    background: #0EA5E9;
    color: #fff;
    border-color: #0EA5E9;
}

.question-nav-btn.active {
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.3);
}

/* SUBMIT SECTION */
.quiz-submit-section {
    grid-column: 1 / -1;
    display: flex;
    justify-content: center;
    padding: 2rem;
}

.btn-submit-quiz {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 3rem;
    background: linear-gradient(135deg, #0EA5E9, #0284C7);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3);
}

.btn-submit-quiz:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(14, 165, 233, 0.4);
}

/* MODAL */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.7);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    backdrop-filter: blur(4px);
}

.modal-overlay.show {
    display: flex;
}

.modal-card {
    background: #fff;
    border-radius: 16px;
    max-width: 500px;
    width: 90%;
    box-shadow: 0 20px 50px rgba(15, 23, 42, 0.3);
    animation: modalSlideIn 0.3s ease;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid #E5E7EB;
}

.modal-header h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #111827;
    margin: 0;
}

.modal-close {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: none;
    background: #F3F4F6;
    color: #6B7280;
    cursor: pointer;
    transition: all 0.2s;
}

.modal-close:hover {
    background: #E5E7EB;
    color: #111827;
}

.modal-body {
    padding: 1.5rem;
}

.modal-body p {
    font-size: 1rem;
    color: #374151;
    margin-bottom: 0.5rem;
}

.modal-warning {
    font-size: 0.9rem;
    color: #F97316;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.modal-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.modal-stats .stat-item {
    padding: 1rem;
    background: #F9FAFB;
    border-radius: 12px;
    text-align: center;
}

.modal-stats .stat-label {
    display: block;
    font-size: 0.85rem;
    color: #6B7280;
    margin-bottom: 0.5rem;
}

.modal-stats .stat-value {
    display: block;
    font-size: 1.75rem;
    font-weight: 700;
    color: #111827;
}

.modal-stats .text-danger {
    color: #EF4444;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    padding: 1.5rem;
    border-top: 1px solid #E5E7EB;
}

.btn-cancel,
.btn-confirm {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
}

.btn-cancel {
    background: #F3F4F6;
    color: #6B7280;
}

.btn-cancel:hover {
    background: #E5E7EB;
    color: #111827;
}

.btn-confirm {
    background: #0EA5E9;
    color: #fff;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-confirm:hover {
    background: #0284C7;
    box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
}

/* LOADING */
.loading-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.9);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 1.5rem;
    z-index: 1001;
}

.spinner {
    width: 60px;
    height: 60px;
    border: 4px solid rgba(255, 255, 255, 0.2);
    border-top-color: #0EA5E9;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.loading-overlay p {
    color: #fff;
    font-size: 1.1rem;
    font-weight: 600;
}

/* RESPONSIVE */
@media (max-width: 1024px) {
    .quiz-form {
        grid-template-columns: 1fr;
    }

    .quiz-navigation {
        position: static;
        order: -1;
    }
}

@media (max-width: 768px) {
    .quiz-attempt-header {
        grid-template-columns: 1fr;
    }

    .quiz-timer {
        justify-content: center;
    }

    .question-nav-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // TIMER
    const timerDuration = 5 * 60; // 5 menit dalam detik
    let timeLeft = timerDuration;
    const timerElement = document.getElementById('timerValue');
    const timerContainer = document.getElementById('quizTimer');
    const attemptId = "{{ $attempt->id }}";

    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = seconds % 60;
        return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }

    function updateTimer() {
        timerElement.textContent = formatTime(timeLeft);
        
        if (timeLeft <= 60) {
            timerContainer.classList.add('warning');
        }
        
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            autoSubmit();
        }
        
        timeLeft--;
    }

    const timerInterval = setInterval(updateTimer, 1000);
    updateTimer();

    // AUTO SUBMIT SAAT WAKTU HABIS
    function autoSubmit() {
        document.getElementById('loadingOverlay').style.display = 'flex';
        submitAnswers();
    }

    // NAVIGASI SOAL
    const questionCards = document.querySelectorAll('.question-card');
    const navBtns = document.querySelectorAll('.question-nav-btn');

    navBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const questionNum = this.dataset.question;
            const targetCard = document.getElementById(`question-${questionNum}`);
            
            if (targetCard) {
                targetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                
                navBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            }
        });
    });

    // UPDATE STATUS JAWABAN
    const radioInputs = document.querySelectorAll('input[type="radio"]');
    
    function updateAnswerStatus() {
        const answeredCount = document.querySelectorAll('input[type="radio"]:checked').length;
        const totalQuestions = {{ $soal->count() }};
        const unansweredCount = totalQuestions - answeredCount;
        
        document.getElementById('answeredCount').textContent = answeredCount;
        document.getElementById('unansweredCount').textContent = unansweredCount;
        
        // Update navigasi
        radioInputs.forEach(radio => {
            if (radio.checked) {
                const soalId = radio.name.match(/\[(.*?)\]/)[1];
                const navBtn = document.querySelector(`[data-soal-id="${soalId}"]`);
                if (navBtn) {
                    navBtn.classList.add('answered');
                }
            }
        });
    }

    radioInputs.forEach(radio => {
        radio.addEventListener('change', updateAnswerStatus);
    });

    updateAnswerStatus();

    // SUBMIT MODAL
    const submitBtn = document.getElementById('submitQuizBtn');
    const submitModal = document.getElementById('submitModal');
    const closeModalBtn = document.getElementById('closeSubmitModal');
    const cancelBtn = document.getElementById('cancelSubmit');
    const confirmBtn = document.getElementById('confirmSubmit');

    submitBtn.addEventListener('click', function() {
        updateAnswerStatus();
        submitModal.classList.add('show');
    });

    closeModalBtn.addEventListener('click', () => submitModal.classList.remove('show'));
    cancelBtn.addEventListener('click', () => submitModal.classList.remove('show'));

    confirmBtn.addEventListener('click', function() {
        submitModal.classList.remove('show');
        document.getElementById('loadingOverlay').style.display = 'flex';
        submitAnswers();
    });

    // SUBMIT JAWABAN
    function submitAnswers() {
        const formData = new FormData(document.getElementById('quizForm'));
        
        fetch(`/siswa/kuis/attempt/${attemptId}/submit`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                alert('Terjadi kesalahan: ' + (data.error || 'Unknown error'));
                document.getElementById('loadingOverlay').style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat submit jawaban');
            document.getElementById('loadingOverlay').style.display = 'none';
        });
    }

    // PREVENT ACCIDENTAL CLOSE
    window.addEventListener('beforeunload', function(e) {
        if (timeLeft > 0) {
            e.preventDefault();
            e.returnValue = 'Kuis belum selesai. Yakin ingin keluar?';
        }
    });
});
</script>
@endsection
