@extends('layouts.siswa_reader')

@section('title', $tugas->judul)

@section('content')
<div class="kuis-detail-wrapper">
    
    {{-- HEADER --}}
    <div class="kuis-header">
        <div class="kuis-header-container">
            <a href="{{ route('siswa.kuis.index', $tugas->kelas_id) }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                <span>{{ $tugas->judul }}</span>
            </a>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="kuis-container">
        
        {{-- SECTION: ATURAN --}}
        <div class="kuis-section">
            <h2 class="section-title">Aturan</h2>
            
            <div class="aturan-content">
                <p>{{ $tugas->tipe === 'kuis' ? 'Kuis' : 'Ujian' }} ini bertujuan untuk menguji pengetahuan Anda tentang materi <strong>{{ $tugas->materi ? $tugas->materi->judul : 'yang telah dipelajari' }}</strong>.</p>
                
                <p>Terdapat <strong>{{ $tugas->soals->count() }} pertanyaan</strong> yang harus dikerjakan dalam {{ $tugas->tipe === 'kuis' ? 'kuis' : 'ujian' }} ini. Beberapa ketentuannya sebagai berikut:</p>
                
                <ul class="aturan-list">
                    <li>Syarat nilai kelulusan: <strong>75%</strong></li>
                    <li>Durasi ujian: <strong>{{ $tugas->durasi ?? 5 }} menit</strong></li>
                </ul>

                @if($tugas->tipe === 'kuis')
                    <p>Apabila tidak memenuhi syarat kelulusan, maka Anda harus menunggu selama <strong>1 menit</strong> untuk mengulang pengerjaan kuis kembali. Manfaatkan waktu tunggu tersebut untuk mempelajari kembali materi sebelumnya, ya.</p>
                @else
                    <p class="warning-text"><i class="fas fa-exclamation-triangle"></i> <strong>Perhatian:</strong> Ujian hanya dapat dikerjakan <strong>satu kali</strong>. Pastikan Anda sudah siap sebelum memulai.</p>
                @endif

                <p class="success-text">Selamat Mengerjakan!</p>
            </div>
        </div>

        {{-- SECTION: TOMBOL MULAI / COUNTDOWN --}}
        <div class="kuis-section">
            @if($cooldown)
                {{-- COOLDOWN 1 MENIT --}}
                <div class="perhatian-box">
                    <div class="perhatian-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="perhatian-text">
                        <strong>Perhatian</strong>
                        <p>Silakan tunggu untuk mengambil ujian ulang: <span id="countdown" class="countdown-timer">{{ $sisaDetik }}s</span></p>
                    </div>
                </div>
            @else
                @php
                    $canRetake = true;
                    
                    // Cek apakah ujian/ujian_bab sudah pernah selesai
                    if(in_array($tugas->tipe, ['ujian', 'ujian_bab'])) {
                        $finishedAttempt = $riwayat->where('status', 'selesai')->first();
                        if($finishedAttempt) {
                            $canRetake = false;
                        }
                    }
                @endphp

                @if($canRetake)
                    {{-- TOMBOL MULAI --}}
                    <form method="POST" action="{{ route('siswa.kuis.start', $tugas->id) }}" class="form-start">
                        @csrf
                        <button type="submit" class="btn-start-kuis">
                            <i class="fas fa-play"></i>
                            <span>Mulai {{ $tugas->tipe === 'kuis' ? 'Kuis' : 'Ujian' }}</span>
                        </button>
                    </form>
                @else
                    {{-- SUDAH SELESAI UJIAN --}}
                    <div class="alert-completed">
                        <i class="fas fa-check-circle"></i>
                        <span>Anda telah menyelesaikan ujian ini. Ujian hanya dapat dikerjakan satu kali.</span>
                    </div>
                @endif
            @endif
        </div>

        {{-- SECTION: RIWAYAT --}}
        @if($riwayat->isNotEmpty())
        <div class="kuis-section">
            <h2 class="section-title">Riwayat</h2>
            
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
                        @foreach($riwayat as $attempt)
                        <tr>
                            <td data-label="Tanggal">{{ $attempt->created_at->format('d M Y H:i') }}</td>
                            <td data-label="Persentase"><strong>{{ $attempt->skor }}%</strong></td>
                            <td data-label="Status">
                                @if($attempt->skor >= 75)
                                    <span class="badge badge-success">Lulus</span>
                                @else
                                    <span class="badge badge-danger">Tidak Lulus</span>
                                @endif
                            </td>
                            <td data-label="Action">
                                <a href="{{ route('siswa.kuis.result', $attempt->id) }}" class="btn-detail">
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

    </div>
</div>

@push('styles')
<style>
/* ========== KUIS DETAIL STYLES ========== */

/* Wrapper */
.kuis-detail-wrapper {
    min-height: 100vh;
    background: var(--bg-base);
}

/* Header */
.kuis-header {
    background: var(--bg-card);
    border-bottom: 1px solid var(--border-light);
    padding: 1.25rem 0;
    box-shadow: var(--shadow-sm);
    position: sticky;
    top: 0;
    z-index: 50;
}

.kuis-header-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 0.875rem;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    text-decoration: none;
    transition: color 0.2s ease;
}

.back-link:hover {
    color: var(--accent-cyan);
}

.back-link i {
    font-size: 1.25rem;
}

/* Container */
.kuis-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 2rem 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

/* Section */
.kuis-section {
    background: var(--bg-card);
    border-radius: var(--radius-lg);
    padding: 1.75rem;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
}

.section-title {
    font-size: 1.375rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1.25rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--border-light);
}

/* Aturan Content */
.aturan-content {
    color: var(--text-secondary);
    line-height: 1.75;
}

.aturan-content p {
    margin-bottom: 1rem;
}

.aturan-content strong {
    color: var(--text-primary);
    font-weight: 600;
}

.aturan-list {
    list-style: none;
    padding-left: 0;
    margin: 1.25rem 0;
}

.aturan-list li {
    position: relative;
    padding-left: 1.75rem;
    margin-bottom: 0.75rem;
}

.aturan-list li::before {
    content: '•';
    position: absolute;
    left: 0.5rem;
    color: var(--accent-cyan);
    font-size: 1.25rem;
    font-weight: 700;
}

.warning-text {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    padding: 1rem;
    background: var(--warning-light);
    border-left: 4px solid var(--warning);
    border-radius: var(--radius-sm);
    color: #E65100;
    font-size: 0.9rem;
}

.warning-text i {
    color: var(--warning);
    margin-top: 0.125rem;
}

.success-text {
    font-weight: 600;
    color: var(--accent-green-dark);
    margin-top: 1rem;
}

/* Perhatian Box (Cooldown) */
.perhatian-box {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem;
    background: linear-gradient(135deg, #E1F5FE 0%, #B3E5FC 100%);
    border: 1px solid var(--accent-cyan-light);
    border-radius: var(--radius-md);
}

.perhatian-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--accent-cyan);
    color: var(--text-white);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.perhatian-icon i {
    font-size: 1.25rem;
}

.perhatian-text strong {
    display: block;
    color: var(--text-primary);
    font-size: 1rem;
    margin-bottom: 0.375rem;
}

.perhatian-text p {
    color: var(--text-secondary);
    margin: 0;
    font-size: 0.9rem;
}

.countdown-timer {
    font-weight: 700;
    color: var(--accent-cyan);
    font-size: 1.1rem;
}

/* Form Start */
.form-start {
    display: flex;
    justify-content: center;
}

.btn-start-kuis {
    display: inline-flex;
    align-items: center;
    gap: 0.875rem;
    padding: 1rem 2.5rem;
    background: linear-gradient(135deg, var(--accent-cyan), var(--accent-cyan-light));
    color: var(--text-white);
    border: none;
    border-radius: var(--radius-md);
    font-size: 1.0625rem;
    font-weight: 700;
    cursor: pointer;
    box-shadow: var(--shadow-cyan);
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-start-kuis:hover {
    background: linear-gradient(135deg, var(--accent-cyan-hover), var(--accent-cyan));
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 184, 212, 0.35);
}

.btn-start-kuis:active {
    transform: translateY(0);
}

.btn-start-kuis i {
    font-size: 1.125rem;
}

/* Alert Completed */
.alert-completed {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    background: var(--accent-green-tint);
    border: 1px solid var(--accent-green-light);
    border-radius: var(--radius-md);
    color: var(--accent-green-dark);
}

.alert-completed i {
    font-size: 1.5rem;
    color: var(--accent-green);
}

/* Table */
.table-wrapper {
    overflow-x: auto;
    border-radius: var(--radius-md);
    border: 1px solid var(--border-light);
}

.riwayat-table {
    width: 100%;
    border-collapse: collapse;
}

.riwayat-table thead {
    background: linear-gradient(135deg, #F5F7FA 0%, #EDF2F7 100%);
}

.riwayat-table th {
    padding: 1rem;
    text-align: left;
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid var(--border-medium);
}

.riwayat-table td {
    padding: 1.125rem 1rem;
    border-bottom: 1px solid var(--border-light);
    color: var(--text-primary);
}

.riwayat-table tbody tr {
    transition: background 0.2s ease;
}

.riwayat-table tbody tr:hover {
    background: var(--bg-hover);
}

.riwayat-table tbody tr:last-child td {
    border-bottom: none;
}

/* Badge */
.badge {
    display: inline-block;
    padding: 0.375rem 0.875rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-success {
    background: var(--accent-green-tint);
    color: var(--accent-green-dark);
}

.badge-danger {
    background: var(--danger-light);
    color: var(--danger);
}

/* Button Detail */
.btn-detail {
    display: inline-block;
    padding: 0.5rem 1.25rem;
    background: var(--bg-card);
    border: 1.5px solid var(--border-medium);
    border-radius: var(--radius-sm);
    color: var(--text-primary);
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-detail:hover {
    background: var(--accent-cyan);
    border-color: var(--accent-cyan);
    color: var(--text-white);
    box-shadow: var(--shadow-cyan);
    transform: translateY(-1px);
}

/* Responsive */
@media (max-width: 768px) {
    .kuis-container {
        padding: 1.5rem 1rem;
    }

    .kuis-section {
        padding: 1.25rem;
    }

    .back-link {
        font-size: 1.25rem;
    }

    .section-title {
        font-size: 1.125rem;
    }

    .btn-start-kuis {
        width: 100%;
        justify-content: center;
    }

    /* Table Mobile */
    .riwayat-table thead {
        display: none;
    }

    .riwayat-table tr {
        display: block;
        margin-bottom: 1rem;
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        overflow: hidden;
    }

    .riwayat-table td {
        display: flex;
        justify-content: space-between;
        padding: 0.875rem 1rem;
        border-bottom: 1px solid var(--border-light);
    }

    .riwayat-table td:last-child {
        border-bottom: none;
    }

    .riwayat-table td::before {
        content: attr(data-label);
        font-weight: 700;
        color: var(--text-secondary);
        font-size: 0.8125rem;
    }

    .btn-detail {
        width: 100%;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .kuis-header-container {
        padding: 0 1rem;
    }

    .kuis-container {
        padding: 1rem 0.75rem;
    }

    .aturan-content {
        font-size: 0.9375rem;
    }
}
</style>
@endpush

@if($cooldown)
@push('scripts')
<script>
let seconds = {{ $sisaDetik }};
const countdownEl = document.getElementById('countdown');

const timer = setInterval(() => {
    seconds--;
    countdownEl.textContent = seconds + 's';
    
    if (seconds <= 0) {
        clearInterval(timer);
        location.reload();
    }
}, 1000);
</script>
@endpush
@endif
@endsection