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

    {{-- TABS DI LUAR GRID, GARIS FULL WIDTH --}}
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

    {{-- WRAPPER 2 KOLOM: KIRI LIST KELAS, KANAN REKOMENDASI --}}
    <div class="academy-layout">
        <div class="academy-main">

            {{-- TAB: ACTIVE --}}
            <div class="tab-content active" id="tab-active">
                @php
                    $activeClasses = $kelasList->filter(fn($item) => !$item->is_completed);
                @endphp

                @if($activeClasses->isEmpty())
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
                    @foreach($activeClasses as $siswaKelas)
                        @php
                            $kelas = $siswaKelas->kelas;
                            if (!$kelas) {
                                continue;
                            }

                            $progress = $siswaKelas->progress ?? 0;

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
                                <h2 class="learning-title">{{ $kelas->nama_kelas }}</h2>

                                <div class="learning-header-actions">
                                    <a href="{{ route('siswa.kelas.read', $kelas->id) }}" class="btn-primary-ghost">
                                        Lanjut Belajar
                                    </a>
                                </div>
                            </div>

                            <div class="learning-body">
                                <div class="learning-main">
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
                                                    <span class="lp-deadline-date">
                                                        {{ $deadlineDate ?? '-' }}
                                                    </span>
                                                </div>
                                                <div class="lp-deadline-sub">
                                                    {{ $deadlineText }}
                                                </div>
                                                <button type="button" class="lp-info-link" data-deadline-modal>
                                                    Informasi lebih lanjut mengenai deadline
                                                </button>
                                            </div>
                                        </div>
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

                @if($completedClasses->isEmpty())
                    <div class="empty-state-simple">
                        <div class="empty-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <h3>Belum ada kelas yang sudah diselesaikan</h3>
                    </div>
                @else
                    @foreach($completedClasses as $siswaKelas)
                        @php
                            $kelas = $siswaKelas->kelas;
                            if (!$kelas) {
                                continue;
                            }
                        @endphp

                        <div class="learning-card completed">
                            <div class="learning-header">
                                <h2 class="learning-title">{{ $kelas->nama_kelas }}</h2>

                                <div class="learning-header-actions">
                                    <span class="badge-completed">Selesai</span>
                                    <a href="{{ route('siswa.kelas.show', $kelas->id) }}" class="btn-primary-ghost">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>

                            <div class="learning-body">
                                <div class="learning-main">
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
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- KOLOM KANAN: REKOMENDASI HANYA UNTUK TAB ACTIVE --}}
        @php
            $firstActive = $kelasList->first(fn($item) => !$item->is_completed && $item->kelas);
            $kelasRekom = $firstActive ? $firstActive->kelas : null;
            $materiRekom = $kelasRekom ? optional($kelasRekom->materi)->first() : null;
        @endphp

        @if($kelasRekom)
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

                @if($materiRekom)
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
                            <span>Pilih salah satu materi di kelas aktif untuk mulai mendapatkan rekomendasi belajar.</span>
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
                <li>Jika mendaftar dengan token/akses khusus, deadline menyesuaikan masa belajar yang ditentukan pada kelas tersebut.</li>
                <li>Jika sudah melewati deadline, kamu dapat memperpanjang akses untuk melanjutkan belajar.</li>
                <li>Saat akses diaktifkan kembali, progres belajarmu tidak direset dan dapat dilanjutkan dari terakhir.</li>
            </ul>
        </div>
    </div>
</div>

<style>
.academy-container{max-width:1200px;margin:0 auto;padding:0 1rem;}
.academy-hero{position:relative;background:linear-gradient(135deg,#0EA5E9,#38BDF8,#22C55E);border-radius:20px;padding:24px 28px;margin-bottom:1.5rem;overflow:hidden;color:#fff;box-shadow:0 10px 32px rgba(14,165,233,.35);}
.hero-decoration{position:absolute;inset:0;overflow:hidden;pointer-events:none;}
.deco-cube{position:absolute;background:rgba(255,255,255,.1);border-radius:6px;animation:float 6s ease-in-out infinite;}
.cube-1{width:50px;height:50px;top:15%;right:8%;}
.cube-2{width:35px;height:35px;top:50%;right:18%;animation-delay:2s;}
.cube-3{width:42px;height:42px;top:35%;right:5%;animation-delay:4s;}
@keyframes float{0%,100%{transform:translateY(0) rotate(0)}50%{transform:translateY(-15px) rotate(8deg)}}
.hero-content{position:relative;z-index:1;}
.hero-content h1{font-size:1.75rem;font-weight:700;margin-bottom:.25rem;text-shadow:0 2px 4px rgba(0,0,0,.1);}
.hero-content p{font-size:.95rem;opacity:.95;margin:0;}

.academy-tabs-wrapper{margin-top:.75rem;margin-bottom:1rem;border-bottom:2px solid #E2E8F0;}

.academy-layout{display:grid;grid-template-columns:minmax(0,3fr) minmax(260px,1.4fr);gap:24px;align-items:flex-start;}
.academy-main{min-width:0;}
.academy-side{min-width:0;}
.sticky-recommend{position:sticky;top:110px;}

.academy-tabs{display:flex;gap:1rem;margin-bottom:-2px;border-bottom:none;}
.tab-btn{display:flex;align-items:center;gap:.5rem;padding:.875rem 1.25rem;background:none;border:none;border-bottom:3px solid transparent;font-size:.95rem;font-weight:600;color:#64748B;cursor:pointer;transition:.3s;position:relative;bottom:-2px;font-family:'Inter',sans-serif;}
.tab-btn i{font-size:1.1rem;transition:.3s;}
.tab-btn:hover{color:#0EA5E9;background:rgba(14,165,233,.05);}
.tab-btn:hover i{transform:scale(1.1);}
.tab-btn.active{color:#0EA5E9;border-bottom-color:#0EA5E9;background:rgba(14,165,233,.05);}

.tab-content{display:none;animation:fadeIn .5s ease;}
.tab-content.active{display:block;}
@keyframes fadeIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}

.learning-card{background:#fff;border-radius:18px;box-shadow:0 4px 18px rgba(15,23,42,.08);border:1px solid #E2E8F0;margin-bottom:1.75rem;overflow:hidden;}
.learning-card.completed{border-color:rgba(34,197,94,.4);}
.learning-header{padding:1.25rem 1.5rem 1rem;display:flex;flex-direction:column;gap:.35rem;border-bottom:1px solid #E2E8F0;position:relative;}
.learning-header-actions{position:absolute;top:1.25rem;right:1.5rem;display:flex;align-items:center;gap:.5rem;}
.learning-title{font-size:1.4rem;font-weight:700;color:#1F2937;margin:0;}
.learning-body{padding:1.25rem 1.5rem 1.4rem;}
.learning-main{flex:1 1 auto;min-width:0;}

.btn-primary-ghost{display:inline-flex;align-items:center;justify-content:center;padding:.6rem 1.2rem;border-radius:999px;border:1px solid #0EA5E9;background:#0EA5E9;color:#fff;font-size:.9rem;font-weight:600;text-decoration:none;transition:.25s;box-shadow:0 4px 12px rgba(14,165,233,.32);}
.btn-primary-ghost:hover{background:#0284C7;border-color:#0284C7;box-shadow:0 6px 18px rgba(14,165,233,.42);}

.learning-progress-card{background:#F9FAFB;border-radius:14px;border:1px solid #E5E7EB;padding:1rem 1.1rem;}
.lp-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:.55rem;}
.lp-label{font-size:.85rem;font-weight:600;color:#4B5563;}
.lp-percent{font-size:.9rem;font-weight:700;color:#0EA5E9;}
.lp-bar{height:8px;border-radius:999px;background:#E5E7EB;overflow:hidden;margin-bottom:.85rem;}
.lp-bar-fill{height:100%;border-radius:999px;background:linear-gradient(90deg,#0EA5E9,#38BDF8);transition:width .6s ease;box-shadow:0 2px 4px rgba(14,165,233,.4);}
.lp-bar-fill-completed{background:linear-gradient(90deg,#22C55E,#16A34A);box-shadow:0 2px 4px rgba(34,197,94,.4);}
.lp-deadline{display:flex;align-items:flex-start;gap:.75rem;}
.lp-deadline-icon{width:32px;height:32px;border-radius:999px;background:rgba(14,165,233,.1);display:flex;align-items:center;justify-content:center;color:#0EA5E9;font-size:.9rem;flex-shrink:0;}
.lp-deadline-icon.lp-done{background:rgba(34,197,94,.1);color:#16A34A;}
.lp-deadline-text{font-size:.83rem;color:#4B5563;}
.lp-deadline-title{font-weight:600;margin-bottom:.1rem;}
.lp-deadline-date{color:#111827;margin-left:.2rem;}
.lp-deadline-sub{color:#F97316;font-weight:600;font-size:.8rem;margin-bottom:.25rem;}
.lp-info-link{padding:0;margin:0;border:none;background:none;color:#0EA5E9;font-size:.8rem;font-weight:600;cursor:pointer;text-decoration:underline;}

.recommend-card{background:#F1F5F9;border-radius:12px;border:1px solid #E2E8F0;padding:.95rem 1rem;}
.recommend-card.completed{background:#F0FDF4;border-color:rgba(34,197,94,.3);}
.recommend-title{display:flex;align-items:center;gap:.4rem;font-size:.88rem;font-weight:700;color:#111827;margin-bottom:.5rem;}
.recommend-title i{color:#FBBF24;font-size:1rem;}
.recommend-text{font-size:.8rem;color:#4B5563;margin-bottom:.6rem;line-height:1.55;}
.recommend-list{list-style:none;padding:0;margin:0 0 .7rem;}
.recommend-list li{display:flex;align-items:flex-start;gap:.4rem;font-size:.79rem;color:#374151;margin-bottom:.3rem;line-height:1.45;}
.recommend-list .dot{width:5px;height:5px;border-radius:999px;background:#0EA5E9;margin-top:.35rem;flex-shrink:0;}
.recommend-link{display:inline-block;font-size:.8rem;font-weight:600;color:#0EA5E9;text-decoration:none;border-bottom:1px solid transparent;transition:.2s;}
.recommend-link:hover{border-bottom-color:#0EA5E9;}

.empty-state-modern{display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:45vh;padding:2.5rem 1.5rem;text-align:center;}
.empty-illustration{position:relative;width:170px;height:170px;margin-bottom:1.75rem;}
.empty-circle{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:130px;height:130px;background:linear-gradient(135deg,#0EA5E9,#38BDF8);border-radius:50%;opacity:.12;animation:pulse 3s ease-in-out infinite;}
@keyframes pulse{0%,100%{transform:translate(-50%,-50%) scale(1)}50%{transform:translate(-50%,-50%) scale(1.08)}}
.floating-icons{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:110px;height:110px;}
.floating-icons i{position:absolute;font-size:2.2rem;color:#0EA5E9;animation:float 4s ease-in-out infinite;}
.floating-icons i:nth-child(1){top:0;left:50%;transform:translateX(-50%);}
.floating-icons i:nth-child(2){bottom:0;left:0;}
.floating-icons i:nth-child(3){bottom:0;right:0;}
.empty-title{font-size:1.35rem;font-weight:700;color:#2D3748;margin-bottom:.875rem;}

.empty-state-simple{text-align:center;padding:3.5rem 1.5rem;background:transparent;border-radius:0;border:none;}
.empty-icon{width:130px;height:130px;margin:0 auto 1.75rem;border-radius:50%;background:radial-gradient(circle at 30% 20%,rgba(148,197,255,.45),rgba(59,130,246,.08));display:flex;align-items:center;justify-content:center;position:relative;animation:float 4s ease-in-out infinite;}
.empty-icon i{font-size:3rem;color:#4A7BA7;text-shadow:0 6px 18px rgba(15,23,42,.25);}
.empty-state-simple h3{font-size:1.15rem;color:#4A5568;font-weight:600;}

.deadline-modal-backdrop{position:fixed;inset:0;background:rgba(15,23,42,.45);display:none;align-items:center;justify-content:center;z-index:999;}
.deadline-modal-backdrop.show{display:flex;}
.deadline-modal{background:#fff;border-radius:16px;max-width:720px;width:90%;max-height:80vh;overflow:auto;box-shadow:0 20px 50px rgba(15,23,42,.35);}
.deadline-modal-header{display:flex;justify-content:space-between;align-items:center;padding:1rem 1.25rem;border-bottom:1px solid #E5E7EB;font-weight:600;color:#111827;font-size:.95rem;}
.deadline-close{border:none;background:none;font-size:1.5rem;line-height:1;cursor:pointer;color:#6B7280;}
.deadline-modal-body{padding:1rem 1.25rem 1.4rem;font-size:.9rem;color:#374151;}
.deadline-modal-body ul{padding-left:1.1rem;margin:0;}
.deadline-modal-body li{margin-bottom:.45rem;}

.badge-completed{padding:.25rem .7rem;background:#22C55E;color:#fff;border-radius:999px;font-size:.75rem;font-weight:700;}

@media(max-width:1024px){
    .academy-layout{grid-template-columns:1fr;}
    .academy-side{order:-1;}
    .sticky-recommend{position:static;}
}

@media(max-width:768px){
    .academy-hero{padding:1.4rem 1.1rem;border-radius:16px;margin-bottom:1.25rem;}
    .hero-content h1{font-size:1.5rem;}
    .academy-tabs-wrapper{border-bottom:none;margin-bottom:.5rem;}
    .academy-tabs{flex-direction:column;gap:0;margin-bottom:0;}
    .tab-btn{justify-content:flex-start;padding:.875rem;border-bottom:1px solid #E2E8F0;border-left:3px solid transparent;bottom:0;}
    .tab-btn.active{border-bottom-color:#E2E8F0;border-left-color:#0EA5E9;background:#EFF6FF;}
    .learning-card{border-radius:14px;margin-bottom:1.25rem;}
    .learning-header{padding:1rem 1rem .85rem;}
    .learning-header-actions{position:static;margin-top:.4rem;align-self:flex-start;}
    .learning-title{font-size:1.15rem;}
    .learning-body{padding:1rem;}
}

@media(max-width:480px){
    .academy-container{padding:0 .75rem;}
    .btn-primary-ghost{width:100%;justify-content:center;}
    .learning-progress-card,.recommend-card{padding:.9rem .85rem;}
    .lp-deadline-text{font-size:.8rem;}
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
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

    const urlParams = new URLSearchParams(window.location.search);
    const tabParam = urlParams.get('tab');

    if (tabParam === 'completed') {
        switchTab('completed');
    } else {
        const activeBtn = document.querySelector('.tab-btn.active');
        const tab = activeBtn ? activeBtn.dataset.tab : 'active';
        if (recommendAside) {
            recommendAside.style.display = (tab === 'active') ? '' : 'none';
        }
    }

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const target = this.dataset.tab;
            switchTab(target);

            const url = new URL(window.location);
            url.searchParams.set('tab', target);
            window.history.pushState({}, '', url);

            window.scrollTo({ top: 0, behavior: 'smooth' });
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
            if (e.target === backdrop) {
                backdrop.classList.remove('show');
            }
        });
    }
});
</script>
@endsection
