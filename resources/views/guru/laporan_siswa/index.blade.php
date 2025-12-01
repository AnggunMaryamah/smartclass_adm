@extends('layouts.guru')

@section('title', 'Laporan Belajar Siswa')

@section('content')
<div class="dashboard-container">
    {{-- Welcome Banner (mirip dashboard, ganti judul/kalimat) --}}
    <div class="welcome-banner-rainbow">
        <div class="welcome-content">
            <h2>Laporan Belajar Siswa</h2>
            <p>Pantau perkembangan siswa, nilai rata-rata, status kelulusan, dan ekspor PDF rekap belajar.</p>
        </div>
        <div class="welcome-decoration">
            <div class="deco-circle deco-1"></div>
            <div class="deco-circle deco-2"></div>
            <div class="deco-circle deco-3"></div>
        </div>
    </div>

    {{-- Card Daftar Kelas --}}
    <div class="kelas-list-grid-laporan">
        @forelse($kelasList as $kelas)
            <div class="kelas-card-report">
                <div class="kelas-card-header">
                    <div class="kelas-card-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <div class="kelas-info">
                        <div class="kelas-title">{{ $kelas->nama_kelas }}</div>
                        <div class="kelas-meta">
                            <span class="kelas-badge">Kelas</span>
                            <span class="kelas-stats"><i class="fas fa-users me-1"></i>{{ $kelas->siswas_count ?? 0 }} Siswa</span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('guru.laporan_siswa.daftar', $kelas->id) }}" class="btn-laporan-main">
                    <i class="fas fa-chart-line me-1"></i>Kelola Laporan Belajar Siswa
                </a>
            </div>
        @empty
            <div class="empty-kelas-report">
                <div class="empty-icon">📚</div>
                <h4>Belum Ada Kelas</h4>
                <p>Kelas yang Anda ajar akan tampil di sini</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
.dashboard-container {
    max-width: 1280px;
    margin: auto;
    padding: 24px 16px;
}
.welcome-banner-rainbow {
    background: linear-gradient(135deg, #0EA5E9 0%, #06B6D4 33%, #14B8A6 66%, #0EA5E9 100%);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 20px;
    padding: 32px;
    display: flex; align-items:center; gap:24px;
    margin-bottom: 28px;
    box-shadow: 0 8px 32px rgba(14,165,233,0.26);
    position: relative; overflow: hidden;
}
.welcome-content { flex:1; position:relative; z-index:1;}
.welcome-content h2 {
    color:white; font-size:1.75rem; font-weight:700; margin:0 0 8px 0;
    text-shadow: 0 2px 8px rgba(0,0,0,0.15);
}
.welcome-content p {color:rgba(255,255,255,0.95); font-size:1rem; margin:0;}
.welcome-decoration { position: absolute; top:0; right:0; width:100%; height:100%; pointer-events:none;}
.deco-circle { position:absolute; border-radius:50%; background:rgba(255,255,255,.1); }
.deco-1 { width:150px; height:150px; top:-50px; right:100px; animation: float 6s ease-in-out infinite;}
.deco-2 { width:100px; height:100px; top:50%; right:-30px; animation: float 8s ease-in-out infinite;}
.deco-3 { width:80px; height:80px; bottom:-20px; right:200px; animation: float 7s ease-in-out infinite;}
@keyframes float {
    0%,100% {transform:translateY(0) rotate(0deg);}
    50% {transform:translateY(-20px) rotate(10deg);}
}
.kelas-list-grid-laporan {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px,1fr));
    gap: 20px;
}
/* Card TANPA HOVER - hanya static */
.kelas-card-report {
    background: rgba(255,255,255,0.95);
    border: 1px solid rgba(255,255,255,0.6);
    border-radius: 16px;
    padding: 24px 22px 20px 22px;
    display: flex; flex-direction: column; gap: 0;
    box-shadow: 0 4px 14px rgba(9,132,217,.08);
}
.kelas-card-header {
    display: flex; align-items: center; gap: 15px; margin-bottom: 14px;
}
.kelas-card-icon {
    width: 52px; height: 52px;
    background: linear-gradient(135deg, #F0F9FF, #fff 85%);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; color: #0EA5E9;
    flex-shrink:0;
}
.kelas-info { flex:1;}
.kelas-title {
    font-size: 1.08rem; font-weight:600; color: #1e293b; margin-bottom: 7px;
}
.kelas-meta { display: flex; align-items: center; gap: 12px;}
.kelas-badge {
    background: #F0F9FF;
    color: #0EA5E9;
    font-size: .77rem;
    padding: 4px 11px;
    border-radius: 7px;
    font-weight: 600;
}
.kelas-stats {
    font-size: .84rem;
    color: #64748B;
    font-weight: 500;
}
/* Tombol SEDANG dengan hover */
.btn-laporan-main {
    margin-top: 12px;
    width: 100%;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(90deg,#0ea5e9 100%);
    border: none;
    border-radius: 9px;
    padding: 10px 0;
    box-shadow: 0 2px 14px rgba(36,211,215,0.16);
    font-size: .94rem;
    text-align: center;
    transition: filter .15s, box-shadow .15s, transform .15s;
    text-decoration: none;
    display: block;
}
.btn-laporan-main:hover {
    filter:brightness(.94);
    box-shadow: 0 6px 22px rgba(30,232,232,0.14);
    transform: translateY(-2px);
}
.btn-laporan-main:active {
    transform: translateY(0);
}
.empty-kelas-report {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    background: rgba(255,255,255,0.92);
    border: 1px solid rgba(255,255,255,0.6);
    border-radius: 18px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.08);
}
.empty-icon { font-size: 4rem; margin-bottom:15px;}
.empty-kelas-report h4 {
    font-size:1.18rem; font-weight:600; color:#0F172A; margin:0 0 8px 0;
}
.empty-kelas-report p{ font-size: .99rem; color: #64748B;}
@media (max-width: 991px) {
    .welcome-banner-rainbow { padding: 24px; flex-direction: column; text-align: center;}
    .welcome-content h2 {font-size: 1.4rem;}
}
@media (max-width: 767px) {
    .kelas-list-grid-laporan {grid-template-columns: 1fr;}
    .kelas-card-header {flex-direction: row;}
}
</style>
@endpush
