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

    {{-- Stats Cards (4 cards sejajar) --}}
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
                    @php
                        $avgProgress = isset($kelasAktif) && $kelasAktif > 0 && isset($kelasAktifList)
                            ? round($kelasAktifList->avg('progress') ?? 0) 
                            : 0;
                    @endphp
                    <h3 class="stat-number">{{ $avgProgress }}%</h3>
                    <p class="stat-desc">Progres rata-rata dari semua kelas aktif</p>
                </div>
                <div class="stat-icon bg-blue-dark">
                    {{-- Icon TrendingUp --}}
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </div>
            <a href="#" class="stat-link">
                <span>Lanjut Belajar</span>
                <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    {{-- Kelas Aktif List --}}
    @if(isset($kelasAktifList) && $kelasAktifList->count() > 0)
    <div class="content-panel">
        <div class="panel-header">
            <h2>Kelas Sedang Berlangsung</h2>
            <a href="{{ route('siswa.kelas.index') }}" class="panel-link-header">Lihat Semua →</a>
        </div>

        <div class="kelas-grid">
            @foreach($kelasAktifList as $kelas)
            <div class="kelas-card">
                <div class="kelas-thumbnail">
                    @if(isset($kelas->thumbnail))
                        <img src="{{ $kelas->thumbnail }}" alt="{{ $kelas->nama }}">
                    @else
                        <div class="kelas-thumbnail-placeholder"></div>
                    @endif
                    @if(isset($kelas->kategori))
                    <span class="kelas-badge">{{ $kelas->kategori }}</span>
                    @endif
                </div>

                <div class="kelas-body">
                    <h3 class="kelas-title">{{ $kelas->nama ?? 'Nama Kelas' }}</h3>
                    
                    <div class="kelas-guru">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ $kelas->guru->name ?? 'Guru' }}
                    </div>

                    {{-- Progress Bar --}}
                    <div class="kelas-progress">
                        <div class="progress-label">
                            <span>Progress</span>
                            <span class="progress-value">{{ $kelas->progress ?? 0 }}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $kelas->progress ?? 0 }}%"></div>
                        </div>
                    </div>

                    <div class="kelas-meta">
                        <div class="meta-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            {{ $kelas->total_materi ?? 0 }} Materi
                        </div>
                        <div class="meta-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            {{ $kelas->total_tugas ?? 0 }} Tugas
                        </div>
                    </div>

                    <a href="{{ route('siswa.kelas.read', $kelas->id) }}" class="kelas-btn">
                        Lanjutkan Belajar
                    </a>
                </div>
            </div>
            @endforeach
        </div>
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
/* Container */
.dashboard-container {
    padding: 24px;
    background: linear-gradient(135deg, #F9FAFB 0%, #EFF6FF 100%);
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
    margin-bottom: 24px;
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

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
}

.stat-blue { border-left: 4px solid #0EA5E9; }
.stat-orange { border-left: 4px solid #F97316; }
.stat-green { border-left: 4px solid #22C55E; }
.stat-blue-dark { border-left: 4px solid #1E40AF; }  /* Biru gelap */
.bg-blue-dark { background: #DBEAFE; color: #1E40AF; }
.stat-blue-dark .stat-link { color: #1E40AF; }


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
}

.stat-icon svg {
    width: 24px;
    height: 24px;
}

.bg-blue { background: #DBEAFE; color: #0EA5E9; }
.bg-orange { background: #FFEDD5; color: #F97316; }
.bg-green { background: #DCFCE7; color: #22C55E; }
.bg-purple { background: #F3E8FF; color: #A855F7; }

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
.stat-purple .stat-link { color: #A855F7; }

.arrow-icon {
    width: 16px;
    height: 16px;
    transition: transform 0.3s ease;
}

.stat-link:hover .arrow-icon {
    transform: translateX(4px);
}

/* Content Panel */
.content-panel {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.panel-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.panel-header h2 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0F172A;
}

.panel-link-header {
    font-size: 0.9rem;
    font-weight: 600;
    color: #0EA5E9;
    text-decoration: none;
}

.panel-link-header:hover {
    text-decoration: underline;
}

/* Kelas Grid */
.kelas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.kelas-card {
    background: linear-gradient(135deg, #EFF6FF 0%, white 100%);
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #E5E7EB;
    transition: all 0.3s ease;
}

.kelas-card:hover {
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    transform: translateY(-4px);
}

.kelas-thumbnail {
    height: 160px;
    background: linear-gradient(135deg, #0EA5E9, #A855F7);
    position: relative;
    overflow: hidden;
}

.kelas-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.kelas-thumbnail-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #0EA5E9, #A855F7);
}

.kelas-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(8px);
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 600;
    color: #0F172A;
}

.kelas-body {
    padding: 20px;
}

.kelas-title {
    font-size: 1rem;
    font-weight: 700;
    color: #0F172A;
    margin-bottom: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.kelas-guru {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    color: #64748B;
    margin-bottom: 16px;
}

.kelas-guru svg {
    width: 16px;
    height: 16px;
}

.kelas-progress {
    margin-bottom: 16px;
}

.progress-label {
    display: flex;
    justify-content: space-between;
    font-size: 0.75rem;
    color: #64748B;
    margin-bottom: 6px;
}

.progress-value {
    font-weight: 700;
}

.progress-bar {
    width: 100%;
    height: 8px;
    background: #E5E7EB;
    border-radius: 999px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #0EA5E9, #A855F7);
    border-radius: 999px;
    transition: width 1s ease;
}

.kelas-meta {
    display: flex;
    justify-content: space-between;
    margin-bottom: 16px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 0.75rem;
    color: #64748B;
}

.meta-item svg {
    width: 16px;
    height: 16px;
}

.kelas-btn {
    display: block;
    width: 100%;
    text-align: center;
    background: linear-gradient(135deg, #0EA5E9, #0EA5E9);
    color: white;
    padding: 10px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    text-decoration: none;
    transition: all 0.3s ease;
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
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
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

/* Responsive */
@media (max-width: 1199px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 991px) {
    .welcome-banner-siswa {
        flex-direction: column;
        text-align: left;
    }
    
    .welcome-extra {
        text-align: left;
    }
    
    .kelas-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
}

@media (max-width: 767px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .kelas-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
