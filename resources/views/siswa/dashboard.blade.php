@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="dashboard-container">
    
    {{-- Welcome Banner --}}
    <div class="welcome-banner-siswa">
        <div class="welcome-main">
            <h2>Halo, {{ optional(Auth::user())->name ?? 'Siswa' }} 👋</h2>
            <p>Selamat datang di SmartClass. Pantau kelas aktif dan progres belajar kamu!</p>
        </div>
        <div class="welcome-extra">
            <span class="badge-level">Level Aktif</span>
            <p class="small-text">Tetap konsisten belajar supaya progresmu naik terus!</p>
        </div>
    </div>

    {{-- Stats Cards (4 cards sejajar di laptop, 2 di mobile) --}}
    <div class="stats-grid">
        
        {{-- Kelas Aktif --}}
        <div class="stat-card stat-blue">
            <div class="stat-header">
                <div>
                    <p class="stat-title">KELAS AKTIF</p>
                    <h3 class="stat-number">{{ $kelasAktif ?? 0 }}</h3>
                    <p class="stat-desc">Kelas yang sedang kamu ikuti</p>
                </div>
                <div class="stat-icon bg-blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>
            <a href="{{ route('siswa.kelas.index') }}" class="stat-link">
                <span>Lihat Detail</span>
                <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- Tugas Belum Selesai --}}
        <div class="stat-card stat-orange">
            <div class="stat-header">
                <div>
                    <p class="stat-title">TUGAS BELUM SELESAI</p>
                    <h3 class="stat-number">{{ $tugasBelumSelesai ?? 0 }}</h3>
                    <p class="stat-desc">Segera kerjakan sebelum deadline</p>
                </div>
                <div class="stat-icon bg-orange">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
            <a href="{{ route('siswa.tugas.index') }}" class="stat-link">
                <span>Lihat Detail</span>
                <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- Kelas Selesai --}}
        <div class="stat-card stat-green">
            <div class="stat-header">
                <div>
                    <p class="stat-title">KELAS SELESAI</p>
                    <h3 class="stat-number">{{ $kelasSelesai ?? 0 }}</h3>
                    <p class="stat-desc">Kelas yang sudah kamu tuntaskan</p>
                </div>
                <div class="stat-icon bg-green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <a href="{{ route('siswa.kelas.riwayat') }}" class="stat-link">
                <span>Lihat Detail</span>
                <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- Progress Belajar --}}
        <div class="stat-card stat-blue-dark">
            <div class="stat-header">
                <div>
                    <p class="stat-title">PROGRES BELAJAR</p>
                    <h3 class="stat-number">{{ $progressRataRata ?? 0 }}%</h3>
                    <p class="stat-desc">Progres rata-rata dari semua kelas aktif</p>
                </div>
                <div class="stat-icon bg-blue-dark">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
            </div>
            <a href="{{ route('siswa.kelas.index') }}" class="stat-link stat-link-dark">
                <span>Lanjut Belajar</span>
                <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    {{-- Kelas Aktif List --}}
    @if(isset($kelasAktifList) && $kelasAktifList->count() > 0)
    <div class="section-header">
        <h2>Kelas Sedang Berlangsung</h2>
        <a href="{{ route('siswa.kelas.index') }}" class="section-link">Lihat Semua →</a>
    </div>

    <div class="kelas-grid">
        @foreach($kelasAktifList as $item)
            <div class="kelas-card">
                <div class="kelas-header">
                    <div class="kelas-color-bar"></div>
                    <div class="kelas-info-top">
                        <div class="guru-profile">
                            <div class="guru-avatar">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <span class="guru-name">{{ $item->guru->name ?? 'Guru' }}</span>
                        </div>
                    </div>
                </div>

                <div class="kelas-body">
                    <h3 class="kelas-title">{{ $item->nama ?? 'Nama Kelas' }}</h3>
                    
                    {{-- Jenjang --}}
                    @if(isset($item->jenjang))
                    <div class="kelas-jenjang">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span>{{ $item->jenjang }}</span>
                    </div>
                    @endif
                    
                    {{-- Progress Bar --}}
                    <div class="kelas-progress">
                        <div class="progress-label">
                            <span>Progress</span>
                            <span class="progress-value">{{ $item->progress ?? 0 }}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $item->progress ?? 0 }}%"></div>
                        </div>
                    </div>

                    <div class="kelas-meta">
                        <div class="meta-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            {{ $item->total_materi ?? 0 }} Materi
                        </div>
                        <div class="meta-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            {{ $item->total_tugas ?? 0 }} Tugas
                        </div>
                    </div>

                    <a href="{{ route('siswa.kelas.read', $item->id) }}" class="kelas-btn">
                        Lanjutkan Belajar
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    @else
    <div class="empty-state">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
        <h3>Belum ada kelas aktif</h3>
        <p>Mulai perjalanan belajarmu dengan mendaftar kelas</p>
        <a href="{{ route('siswa.kelas.index') }}" class="empty-btn">Jelajahi Kelas</a>
    </div>
    @endif

</div>

<style>
/* Container - background putih kebiruan */
.dashboard-container {
    padding: 10px 24px 24px;
    background: #F0F4F8;
    min-height: 100vh;
    animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Welcome Banner */
.welcome-banner-siswa {
    background: linear-gradient(135deg, #0EA5E9, #38BDF8, #22C55E);
    border-radius: 20px;
    padding: 24px 28px;
    display: flex;
    justify-content: space-between;
    gap: 18px;
    color: white;
    box-shadow: 0 10px 32px rgba(14, 165, 233, 0.35);
    margin-bottom: 20px;
}

.welcome-main h2 {
    font-size: 1.6rem;
    margin-bottom: 6px;
    font-weight: 700;
}

.welcome-main p {
    font-size: 0.95rem;
    opacity: 0.95;
}

.welcome-extra {
    text-align: right;
    align-self: center;
}

.badge-level {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 999px;
    background: rgba(15, 23, 42, 0.18);
    font-size: 0.78rem;
    font-weight: 600;
}

.small-text {
    margin-top: 6px;
    font-size: 0.85rem;
    opacity: 0.95;
}

/* Stats Grid - 4 kolom laptop, 2 kolom mobile */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin-bottom: 28px;
}

@media (min-width: 1024px) {
    .stats-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
}

.stat-blue { border-left: 4px solid #0EA5E9; }
.stat-orange { border-left: 4px solid #F97316; }
.stat-green { border-left: 4px solid #22C55E; }
.stat-blue-dark { border-left: 4px solid #1E40AF; }

.stat-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 12px;
}

.stat-title {
    font-size: 0.7rem;
    font-weight: 700;
    color: #64748B;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #0F172A;
    margin-bottom: 4px;
}

.stat-desc {
    font-size: 0.8rem;
    color: #64748B;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.stat-icon svg {
    width: 24px;
    height: 24px;
}

.bg-blue { background: #DBEAFE; color: #0EA5E9; }
.bg-orange { background: #FFEDD5; color: #F97316; }
.bg-green { background: #DCFCE7; color: #22C55E; }
.bg-blue-dark { background: #DBEAFE; color: #1E40AF; }

.stat-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.stat-blue .stat-link { color: #0EA5E9; }
.stat-orange .stat-link { color: #F97316; }
.stat-green .stat-link { color: #22C55E; }
.stat-link-dark { color: #1E40AF; }

.arrow-icon {
    width: 16px;
    height: 16px;
    transition: transform 0.3s ease;
}

.stat-link:hover .arrow-icon {
    transform: translateX(4px);
}

/* Section Header */
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.section-header h2 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0F172A;
}

.section-link {
    font-size: 0.9rem;
    font-weight: 600;
    color: #0EA5E9;
    text-decoration: none;
    transition: all 0.3s ease;
}

.section-link:hover {
    text-decoration: underline;
}

/* Kelas Grid - ukuran card lebih besar dan panjang */
.kelas-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
}

@media (min-width: 768px) {
    .kelas-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1280px) {
    .kelas-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.kelas-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    min-height: 320px;
}

.kelas-card:hover {
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    transform: translateY(-4px);
}

/* Header dengan color bar dan profile guru */
.kelas-header {
    position: relative;
    padding: 18px;
    background: linear-gradient(135deg, #F0F9FF 0%, #E0F2FE 100%);
}

.kelas-color-bar {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #0EA5E9, #38BDF8);
}

.kelas-info-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.guru-profile {
    display: flex;
    align-items: center;
    gap: 10px;
}

.guru-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    flex-shrink: 0;
}

.guru-avatar svg {
    width: 20px;
    height: 20px;
    color: #0EA5E9;
}

.guru-name {
    font-size: 0.9rem;
    font-weight: 600;
    color: #0F172A;
}

/* Kelas Body */
.kelas-body {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
    background: white;
}

.kelas-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: #0F172A;
    margin-bottom: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 56px;
    line-height: 1.4;
}

/* Jenjang */
.kelas-jenjang {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.82rem;
    color: #64748B;
    margin-bottom: 14px;
    padding: 7px 12px;
    background: #F8FAFC;
    border-radius: 8px;
    width: fit-content;
}

.kelas-jenjang svg {
    width: 15px;
    height: 15px;
    flex-shrink: 0;
}

.kelas-progress {
    margin-bottom: 18px;
}

.progress-label {
    display: flex;
    justify-content: space-between;
    font-size: 0.8rem;
    color: #64748B;
    margin-bottom: 8px;
}

.progress-value {
    font-weight: 700;
    color: #0EA5E9;
}

.progress-bar {
    width: 100%;
    height: 9px;
    background: #E5E7EB;
    border-radius: 999px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #0EA5E9, #38BDF8);
    border-radius: 999px;
    transition: width 1s ease;
}

.kelas-meta {
    display: flex;
    justify-content: space-between;
    margin-bottom: 18px;
    padding-top: 14px;
    border-top: 1px solid #F1F5F9;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    color: #64748B;
}

.meta-item svg {
    width: 17px;
    height: 17px;
    flex-shrink: 0;
}

.kelas-btn {
    display: block;
    width: 100%;
    text-align: center;
    background: linear-gradient(135deg, #0EA5E9, #0284C7);
    color: white;
    padding: 12px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.95rem;
    text-decoration: none;
    transition: all 0.3s ease;
    margin-top: auto;
}

.kelas-btn:hover {
    opacity: 0.9;
    transform: scale(1.02);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 24px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
}

.empty-state svg {
    width: 80px;
    height: 80px;
    color: #CBD5E1;
    margin-bottom: 16px;
}

.empty-state h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0F172A;
    margin-bottom: 8px;
}

.empty-state p {
    color: #64748B;
    margin-bottom: 24px;
}

.empty-btn {
    display: inline-block;
    background: #0EA5E9;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.empty-btn:hover {
    background: #0284C7;
}

/* Responsive Mobile */
@media (max-width: 767px) {
    .welcome-banner-siswa {
        flex-direction: column;
        text-align: left;
        padding: 20px;
    }
    
    .welcome-extra {
        text-align: left;
    }

    .welcome-main h2 {
        font-size: 1.4rem;
    }

    .stat-card {
        padding: 16px;
    }

    .stat-number {
        font-size: 1.75rem;
    }

    .dashboard-container {
        padding: 8px 16px 24px;
    }
    
    .kelas-body {
        padding: 16px;
    }
    
    .kelas-header {
        padding: 16px;
    }
}
</style>
@endsection