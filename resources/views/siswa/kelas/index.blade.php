@extends('layouts.siswa')

@section('title', 'Kelas Saya')

@section('content')
    <div class="academy-container">

        {{-- HERO --}}
        <div class="academy-hero">
            <div class="hero-decoration">
                <div class="deco-cube cube-1"></div>
                <div class="deco-cube cube-2"></div>
                <div class="deco-cube cube-3"></div>
            </div>
            <div class="hero-content">
                <h1>Kelas Saya</h1>
                <p>Progress Belajarmu di SmartClass</p>
            </div>
        </div>

        {{-- TABS --}}
        <div class="academy-tabs-wrapper">
            <div class="academy-tabs">
                <button class="tab-btn active" data-tab="active">
                    <i class="fas fa-book-reader"></i>
                    <span>Kelas yang Dipelajari</span>
                </button>
                <button class="tab-btn" data-tab="completed">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Kelas yang Diselesaikan</span>
                </button>
            </div>
        </div>

        {{-- LAYOUT 2 KOLOM --}}
        <div class="academy-layout">
            <div class="academy-main">

                {{-- TAB: ACTIVE --}}
                <div class="tab-content active" id="tab-active">
                    @php
                        $activeClasses = $kelasList->filter(fn($item) => !$item->is_completed);
                    @endphp

                    @if ($activeClasses->isEmpty())
                        <div class="empty-state-modern">
                            <div class="empty-illustration">
                                <div class="floating-icons">
                                    <i class="fas fa-book"></i>
                                    <i class="fas fa-graduation-cap"></i>
                                    <i class="fas fa-bookmark"></i>
                                </div>
                                <div class="empty-circle"></div>
                            </div>
                            <div class="empty-content">
                                <h2 class="empty-title">Belum ada kelas yang sedang dipelajari</h2>
                            </div>
                        </div>
                    @else
                        @foreach ($activeClasses as $siswaKelas)
                            @php
                                $kelas = $siswaKelas->kelas;
                                if (!$kelas) {
                                    continue;
                                }

                                $userId = Auth::id();
                                $progress = \App\Models\MateriPembelajaran::getCompletionPercentage(
                                    $kelas->id,
                                    $userId,
                                );

                                $totalMateri = $kelas->materiPembelajaran->count();
                                $completedMateri = \App\Models\MateriProgress::where('user_id', $userId)
                                    ->where('kelas_id', $kelas->id)
                                    ->where('is_completed', true)
                                    ->select('materi_id')
                                    ->groupBy('materi_id')
                                    ->get()
                                    ->count();

                                $deadlineText = 'Tidak ada batas waktu';
                                $deadlineDate = null;

                                if (!empty($kelas->deadline)) {
                                    $deadline = \Carbon\Carbon::parse($kelas->deadline);
                                    $deadlineText = $deadline->diffForHumans();
                                    $deadlineDate = $deadline->format('d M Y H:i');
                                }
                            @endphp


                            <div class="learning-card">
                                <div class="learning-header">
                                    <div class="header-top">
                                        <h2 class="learning-title">{{ $kelas->nama_kelas }}</h2>
                                        <a href="{{ route('siswa.kelas.read', ['kelas' => $kelas->id]) }}"
                                            class="btn-continue-small">
                                            Lanjut Belajar
                                        </a>
                                    </div>
                                    <p class="learning-subtitle">
                                        {{ $kelas->deskripsi ?? 'Kelas matematika untuk tingkat SMP.' }}</p>
                                    <div class="learning-meta">
                                        <span><i class="fas fa-book"></i> {{ $totalMateri }} Materi</span>
                                        <span><i class="fas fa-check-circle"></i> {{ $completedMateri }} Selesai</span>
                                        <span><i class="fas fa-graduation-cap"></i>
                                            {{ $kelas->jenjang_pendidikan ?? 'SMP' }}</span>
                                    </div>
                                </div>

                                <div class="learning-body">
                                    <div class="learning-progress-card">
                                        <div class="lp-header">
                                            <span class="lp-label">Progress Belajar</span>
                                            <span class="lp-percent">{{ $progress }}%</span>
                                        </div>
                                        <div class="lp-bar">
                                            <div class="lp-bar-fill" style="width: {{ $progress }}%"></div>
                                        </div>

                                        <div class="lp-deadline">
                                            <div class="lp-deadline-icon">
                                                <i class="far fa-clock"></i>
                                            </div>
                                            <div class="lp-deadline-text">
                                                <div class="lp-deadline-title">
                                                    Deadline Belajar:
                                                    <span class="lp-deadline-date">{{ $deadlineDate ?? '-' }}</span>
                                                </div>
                                                <div class="lp-deadline-sub">{{ $deadlineText }}</div>
                                                <button type="button" class="lp-info-link" data-deadline-modal>
                                                    Informasi lebih lanjut mengenai deadline
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="learning-evaluation">
                                        <div class="evaluation-header">
                                            <i class="fas fa-clipboard-list"></i>
                                            <span>Evaluasi Pembelajaran</span>
                                        </div>

                                        <div class="evaluation-body-new">
                                            <a href="{{ route('siswa.kuis.index', $kelas->id) }}" class="btn-eval-simple">
                                                Kerjakan Kuis / Ujian
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                {{-- TAB: COMPLETED --}}
                <div class="tab-content" id="tab-completed">
                    @php
                        $completedClasses = $kelasList->filter(fn($item) => $item->is_completed);
                    @endphp

                    @if ($completedClasses->isEmpty())
                        <div class="empty-state-simple">
                            <div class="empty-icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <h3>Belum ada kelas yang sudah diselesaikan</h3>
                        </div>
                    @else
                        @foreach ($completedClasses as $siswaKelas)
                            @php
                                $kelas = $siswaKelas->kelas;
                                if (!$kelas) {
                                    continue;
                                }
                            @endphp

                            <div class="learning-card completed">
                                <div class="learning-header">
                                    <h2 class="learning-title">{{ $kelas->nama_kelas }}</h2>
                                    <span class="badge-completed"><i class="fas fa-check"></i> Selesai</span>
                                </div>

                                <div class="learning-body">
                                    <div class="learning-progress-card">
                                        <div class="lp-header">
                                            <span class="lp-label">Progress Belajar</span>
                                            <span class="lp-percent">100%</span>
                                        </div>
                                        <div class="lp-bar">
                                            <div class="lp-bar-fill lp-bar-fill-completed" style="width: 100%"></div>
                                        </div>

                                        <div class="lp-deadline">
                                            <div class="lp-deadline-icon lp-done">
                                                <i class="fas fa-calendar-check"></i>
                                            </div>
                                            <div class="lp-deadline-text">
                                                <div class="lp-deadline-title">
                                                    Diselesaikan pada
                                                    <span class="lp-deadline-date">
                                                        {{ optional($siswaKelas->completed_at)->format('d M Y H:i') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            {{-- KOLOM KANAN: REKOMENDASI --}}
            @php
                $firstActive = $kelasList->first(fn($item) => !$item->is_completed && $item->kelas);
                $kelasRekom = $firstActive ? $firstActive->kelas : null;
                $materiRekom = $kelasRekom ? optional($kelasRekom->materiPembelajaran)->first() : null;
            @endphp

            @if ($kelasRekom)
                <aside class="academy-side" id="recommend-aside">
                    <div class="recommend-card sticky-recommend">
                        <div class="recommend-title">
                            <i class="far fa-lightbulb"></i>
                            <span>Rekomendasi Belajar</span>
                        </div>
                        <p class="recommend-text">
                            Capai progress 10%–20% lebih tinggi dalam 2 jam ke depan dengan menyelesaikan materi berikutnya
                            pada kelas aktifmu agar tetap konsisten belajar.
                        </p>

                        @if ($materiRekom)
                            <ul class="recommend-list">
                                <li>
                                    <span class="dot"></span>
                                    <span>
                                        Lanjutkan kelas <strong>{{ $kelasRekom->nama_kelas }}</strong><br>
                                        Materi berikutnya: {{ $materiRekom->judul }}
                                    </span>
                                </li>
                            </ul>
                            <a href="{{ route('siswa.kelas.read', $kelasRekom->id) }}" class="recommend-link">
                                Lihat Rekomendasi Belajar
                            </a>
                        @else
                            <ul class="recommend-list">
                                <li>
                                    <span class="dot"></span>
                                    <span>Pilih salah satu materi di kelas aktif untuk mulai mendapatkan rekomendasi
                                        belajar.</span>
                                </li>
                            </ul>
                            <a href="{{ route('siswa.kelas.read', $kelasRekom->id) }}" class="recommend-link">
                                Lihat Kelas
                            </a>
                        @endif
                    </div>
                </aside>
            @endif
        </div>
    </div>

    {{-- MODAL INFO DEADLINE --}}
    <div class="deadline-modal-backdrop" id="deadline-modal">
        <div class="deadline-modal">
            <div class="deadline-modal-header">
                <span>Informasi Tentang Deadline</span>
                <button type="button" class="deadline-close" data-close-deadline>&times;</button>
            </div>
            <div class="deadline-modal-body">
                <ul>
                    <li>Deadline belajar mengikuti masa aktif langganan di SmartClass.</li>
                    <li>Jika mendaftar dengan token/akses khusus, deadline menyesuaikan masa belajar yang ditentukan pada
                        kelas tersebut.</li>
                    <li>Jika sudah melewati deadline, kamu dapat memperpanjang akses untuk melanjutkan belajar.</li>
                    <li>Saat akses diaktifkan kembali, progres belajarmu tidak direset dan dapat dilanjutkan dari terakhir.
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <style>
        /* Base Styles */
        .academy-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Hero Section */
        .academy-hero {
            position: relative;
            background: linear-gradient(135deg, #0EA5E9, #38BDF8, #22C55E);
            border-radius: 20px;
            padding: 24px 28px;
            margin-bottom: 1.5rem;
            overflow: hidden;
            color: #fff;
            box-shadow: 0 10px 32px rgba(14, 165, 233, .35);
        }

        .hero-decoration {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .deco-cube {
            position: absolute;
            background: rgba(255, 255, 255, .1);
            border-radius: 6px;
            animation: float 6s ease-in-out infinite;
        }

        .cube-1 {
            width: 50px;
            height: 50px;
            top: 15%;
            right: 8%;
        }

        .cube-2 {
            width: 35px;
            height: 35px;
            top: 50%;
            right: 18%;
            animation-delay: 2s;
        }

        .cube-3 {
            width: 42px;
            height: 42px;
            top: 35%;
            right: 5%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0)
            }

            50% {
                transform: translateY(-15px) rotate(8deg)
            }
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-content h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: .25rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, .1);
        }

        .hero-content p {
            font-size: .95rem;
            opacity: .95;
            margin: 0;
        }

        /* Tabs */
        .academy-tabs-wrapper {
            margin-top: .75rem;
            margin-bottom: 1rem;
            border-bottom: 2px solid #E2E8F0;
        }

        .academy-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: -2px;
        }

        .tab-btn {
            display: flex;
            align-items: center;
            gap: .5rem;
            padding: .875rem 1.25rem;
            background: none;
            border: none;
            border-bottom: 3px solid transparent;
            font-size: .95rem;
            font-weight: 600;
            color: #64748B;
            cursor: pointer;
            transition: .3s;
            position: relative;
            bottom: -2px;
        }

        .tab-btn i {
            font-size: 1.1rem;
        }

        .tab-btn:hover {
            color: #0EA5E9;
            background: rgba(14, 165, 233, .05);
        }

        .tab-btn.active {
            color: #0EA5E9;
            border-bottom-color: #0EA5E9;
            background: rgba(14, 165, 233, .05);
        }

        /* Layout */
        .academy-layout {
            display: grid;
            grid-template-columns: minmax(0, 3fr) minmax(260px, 1.4fr);
            gap: 24px;
            align-items: flex-start;
        }

        .academy-main {
            min-width: 0;
        }

        .academy-side {
            min-width: 0;
        }

        .sticky-recommend {
            position: sticky;
            top: 110px;
        }

        /* Tab Content */
        .tab-content {
            display: none;
            animation: fadeIn .5s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        /* Learning Card */
        .learning-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .08);
            border: 1px solid #E2E8F0;
            margin-bottom: 1.75rem;
            overflow: hidden;
        }

        .learning-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #E2E8F0;
        }

        /* Header Top dengan Tombol Lanjut Belajar */
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: .5rem;
        }

        .learning-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1F2937;
            margin: 0;
        }

        .learning-subtitle {
            font-size: .9rem;
            color: #64748B;
            margin: 0 0 .75rem;
        }

        .learning-meta {
            display: flex;
            gap: 1.5rem;
            font-size: .85rem;
            color: #64748B;
        }

        .learning-meta span {
            display: flex;
            align-items: center;
            gap: .4rem;
        }

        .learning-meta i {
            color: #0EA5E9;
        }

        /* Tombol Lanjut Belajar KECIL di Samping Judul */
        .btn-continue-small {
            display: inline-flex;
            padding: .5rem 1rem;
            background: linear-gradient(135deg, #0EA5E9, #38BDF8);
            color: #fff;
            border-radius: 8px;
            font-size: .85rem;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(14, 165, 233, .25);
            transition: .25s;
            white-space: nowrap;
        }

        .btn-continue-small:hover {
            background: linear-gradient(135deg, #0284C7, #0EA5E9);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, .35);
            color: #fff;
        }

        .learning-body {
            padding: 1.25rem 1.5rem;
        }

        /* Progress Card */
        .learning-progress-card {
            background: #F9FAFB;
            border-radius: 14px;
            border: 1px solid #E5E7EB;
            padding: 1rem 1.1rem;
            margin-bottom: 1rem;
        }

        .lp-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: .55rem;
        }

        .lp-label {
            font-size: .85rem;
            font-weight: 600;
            color: #4B5563;
        }

        .lp-percent {
            font-size: .9rem;
            font-weight: 700;
            color: #0EA5E9;
        }

        .lp-bar {
            height: 8px;
            border-radius: 999px;
            background: #E5E7EB;
            overflow: hidden;
            margin-bottom: .85rem;
        }

        .lp-bar-fill {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #0EA5E9, #38BDF8);
            transition: width .6s ease;
            box-shadow: 0 2px 4px rgba(14, 165, 233, .4);
        }

        .lp-bar-fill-completed {
            background: linear-gradient(90deg, #22C55E, #16A34A);
        }

        .lp-deadline {
            display: flex;
            align-items: flex-start;
            gap: .75rem;
        }

        .lp-deadline-icon {
            width: 32px;
            height: 32px;
            border-radius: 999px;
            background: rgba(14, 165, 233, .1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0EA5E9;
            font-size: .9rem;
            flex-shrink: 0;
        }

        .lp-deadline-icon.lp-done {
            background: rgba(34, 197, 94, .1);
            color: #16A34A;
        }

        .lp-deadline-text {
            font-size: .83rem;
            color: #4B5563;
        }

        .lp-deadline-title {
            font-weight: 600;
            margin-bottom: .1rem;
        }

        .lp-deadline-date {
            color: #111827;
        }

        .lp-deadline-sub {
            color: #F97316;
            font-weight: 600;
            font-size: .8rem;
            margin-bottom: .25rem;
        }

        .lp-info-link {
            padding: 0;
            border: none;
            background: none;
            color: #0EA5E9;
            font-size: .8rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: underline;
        }

        /* Evaluation Section */
        .learning-evaluation {
            background: #F8FAFC;
            border: 1px dashed #CBD5E1;
            border-radius: 12px;
            padding: 1rem 1.2rem;
        }

        .evaluation-header {
            display: flex;
            align-items: center;
            gap: .5rem;
            font-size: .9rem;
            font-weight: 700;
            color: #334155;
            margin-bottom: .85rem;
        }

        .evaluation-header i {
            color: #0EA5E9;
            font-size: 1rem;
        }

        .evaluation-body-new {
            display: flex;
            justify-content: flex-end;
        }

        /* Tombol Evaluasi TANPA Icon */
        .btn-eval-simple {
            display: inline-flex;
            padding: .7rem 1.4rem;
            background: linear-gradient(135deg, #0EA5E9, #38BDF8);
            color: #fff;
            border-radius: 10px;
            font-size: .9rem;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(14, 165, 233, .3);
            transition: .25s;
        }

        .btn-eval-simple:hover {
            background: linear-gradient(135deg, #0284C7, #0EA5E9);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(14, 165, 233, .4);
            color: #fff;
        }

        /* Recommend Card */
        .recommend-card {
            background: #F1F5F9;
            border-radius: 12px;
            border: 1px solid #E2E8F0;
            padding: .95rem 1rem;
        }

        .recommend-title {
            display: flex;
            align-items: center;
            gap: .4rem;
            font-size: .88rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: .5rem;
        }

        .recommend-title i {
            color: #FBBF24;
        }

        .recommend-text {
            font-size: .8rem;
            color: #4B5563;
            margin-bottom: .6rem;
            line-height: 1.55;
        }

        .recommend-list {
            list-style: none;
            padding: 0;
            margin: 0 0 .7rem;
        }

        .recommend-list li {
            display: flex;
            align-items: flex-start;
            gap: .4rem;
            font-size: .79rem;
            color: #374151;
            margin-bottom: .3rem;
        }

        .recommend-list .dot {
            width: 5px;
            height: 5px;
            border-radius: 999px;
            background: #0EA5E9;
            margin-top: .35rem;
        }

        .recommend-link {
            display: inline-block;
            font-size: .8rem;
            font-weight: 600;
            color: #0EA5E9;
            text-decoration: none;
            border-bottom: 1px solid transparent;
            transition: .2s;
        }

        .recommend-link:hover {
            border-bottom-color: #0EA5E9;
        }

        /* Empty States */
        .empty-state-modern {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 40vh;
            padding: 2.5rem;
        }

        .empty-illustration {
            position: relative;
            width: 170px;
            height: 170px;
            margin-bottom: 1.75rem;
        }

        .empty-circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 130px;
            height: 130px;
            background: linear-gradient(135deg, #0EA5E9, #38BDF8);
            border-radius: 50%;
            opacity: .12;
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: translate(-50%, -50%) scale(1)
            }

            50% {
                transform: translate(-50%, -50%) scale(1.08)
            }
        }

        .floating-icons {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 110px;
            height: 110px;
        }

        .floating-icons i {
            position: absolute;
            font-size: 2.2rem;
            color: #0EA5E9;
            animation: float 4s ease-in-out infinite;
        }

        .floating-icons i:nth-child(1) {
            top: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .floating-icons i:nth-child(2) {
            bottom: 0;
            left: 0;
        }

        .floating-icons i:nth-child(3) {
            bottom: 0;
            right: 0;
        }

        .empty-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: #2D3748;
        }

        .empty-state-simple {
            text-align: center;
            padding: 3rem;
        }

        .empty-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            background: rgba(59, 130, 246, .1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .empty-icon i {
            font-size: 2.5rem;
            color: #4A7BA7;
        }

        .empty-state-simple h3 {
            font-size: 1.15rem;
            color: #4A5568;
            font-weight: 600;
        }

        /* Modal */
        .deadline-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .45);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 999;
        }

        .deadline-modal-backdrop.show {
            display: flex;
        }

        .deadline-modal {
            background: #fff;
            border-radius: 16px;
            max-width: 720px;
            width: 90%;
            max-height: 80vh;
            overflow: auto;
            box-shadow: 0 20px 50px rgba(15, 23, 42, .35);
        }

        .deadline-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #E5E7EB;
            font-weight: 600;
            font-size: .95rem;
        }

        .deadline-close {
            border: none;
            background: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6B7280;
        }

        .deadline-modal-body {
            padding: 1rem 1.25rem;
            font-size: .9rem;
            color: #374151;
        }

        .deadline-modal-body ul {
            padding-left: 1.1rem;
        }

        .deadline-modal-body li {
            margin-bottom: .45rem;
        }

        .badge-completed {
            padding: .4rem .9rem;
            background: #22C55E;
            color: #fff;
            border-radius: 999px;
            font-size: .8rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
        }

        /* Responsive */
        @media(max-width:1024px) {
            .academy-layout {
                grid-template-columns: 1fr;
            }

            .academy-side {
                order: -1;
            }

            .sticky-recommend {
                position: static;
            }
        }

        @media(max-width:768px) {
            .academy-hero {
                padding: 1.4rem 1.1rem;
            }

            .hero-content h1 {
                font-size: 1.5rem;
            }

            .learning-card {
                margin-bottom: 1.25rem;
            }

            .learning-header {
                padding: 1rem;
            }

            .header-top {
                flex-direction: column;
                align-items: flex-start;
                gap: .5rem;
            }

            .learning-title {
                font-size: 1.2rem;
            }

            .learning-meta {
                flex-wrap: wrap;
                gap: 1rem;
            }

            .learning-body {
                padding: 1rem;
            }

            .evaluation-body-new {
                justify-content: flex-start;
            }

            .btn-eval-simple {
                width: 100%;
            }

            .btn-continue-small {
                width: 100%;
                justify-content: center;
            }
        }

        @media(max-width:480px) {
            .academy-container {
                padding: 0 .75rem;
            }

            .academy-tabs {
                flex-direction: column;
                gap: 0;
            }

            .tab-btn {
                border-bottom: 1px solid #E2E8F0;
                justify-content: flex-start;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');
            const recommendAside = document.getElementById('recommend-aside');

            function switchTab(targetTab) {
                tabBtns.forEach(b => b.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));

                const btn = document.querySelector(`.tab-btn[data-tab="${targetTab}"]`);
                const content = document.getElementById('tab-' + targetTab);

                if (btn) btn.classList.add('active');
                if (content) content.classList.add('active');

                if (recommendAside) {
                    recommendAside.style.display = (targetTab === 'active') ? '' : 'none';
                }
            }

            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    switchTab(this.dataset.tab);
                });
            });

            const backdrop = document.getElementById('deadline-modal');
            if (backdrop) {
                document.querySelectorAll('[data-deadline-modal]').forEach(btn => {
                    btn.addEventListener('click', () => backdrop.classList.add('show'));
                });
                document.querySelectorAll('[data-close-deadline]').forEach(btn => {
                    btn.addEventListener('click', () => backdrop.classList.remove('show'));
                });
                backdrop.addEventListener('click', e => {
                    if (e.target === backdrop) backdrop.classList.remove('show');
                });
            }
        });
    </script>
@endsection
