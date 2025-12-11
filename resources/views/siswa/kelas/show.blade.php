@extends('layouts.siswa_reader')
@section('title', $kelas->nama_kelas ?? 'Kelas')

@section('content')
<div class="reader-container">

    {{-- HEADER KECIL: BACK + JUDUL --}}
    <div class="reader-top">
        <a href="{{ route('siswa.kelas.index') }}" class="reader-back">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali ke Kelas Saya</span>
        </a>
        <div class="reader-title-block">
            <h1 class="reader-title">{{ $kelas->nama_kelas }}</h1>
            <p class="reader-subtitle">
                Guru: {{ optional($kelas->guru)->nama ?? '-' }}
            </p>
        </div>
    </div>

    {{-- AREA BACA PENUH --}}
    <div class="reader-main" id="reader-main">
        @php
            $currentMateri = $currentMateri
                ?? ($kelas->materiPembelajaran->first() ?? null);
        @endphp

        @if($currentMateri)
            <h2 class="materi-title">{{ $currentMateri->judul }}</h2>
            <div id="materi-content" class="materi-content">
                {!! $currentMateri->konten !!}
            </div>
        @else
            <p>Belum ada materi pada kelas ini.</p>
        @endif
    </div>

    {{-- TOMBOL TIGA GARIS DI KANAN --}}
    <button id="panel-toggle" class="reader-panel-toggle" aria-label="Buka daftar modul">
        <i class="fas fa-bars"></i>
    </button>

    {{-- DRAWER KANAN: MODUL & CATATAN --}}
    <aside id="reader-panel" class="reader-panel">
        <div class="reader-panel-header">
            <button id="panel-close" class="panel-close" aria-label="Tutup panel">
                &times;
            </button>
        </div>

        <div class="side-tabs">
            <button class="side-tab active" data-side-tab="modules">Daftar Modul</button>
            <button class="side-tab" data-side-tab="notes">Catatan Belajar</button>
        </div>

        {{-- DAFTAR MODUL --}}
        <div class="side-panel active" id="side-modules">
            @if($kelas->materiPembelajaran->isEmpty())
                <p class="empty-side-text">Belum ada modul.</p>
            @else
                <ul class="module-list">
                    @foreach($kelas->materiPembelajaran as $materi)
                        @php
                            $isActive = $currentMateri && $currentMateri->id === $materi->id;
                        @endphp
                        <li class="module-item {{ $isActive ? 'active' : '' }}">
                            <a href="{{ route('siswa.kelas.show', ['id' => $kelas->id, 'materi' => $materi->id]) }}">
                                <span class="module-title">{{ $materi->judul }}</span>
                                @if($isActive)
                                    <span class="module-badge">Sedang dibaca</span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- CATATAN BELAJAR --}}
        <div class="side-panel" id="side-notes">
            @if(isset($catatan) && $catatan->count())
                <ul class="note-list" id="note-list">
                    @foreach($catatan as $note)
                        <li class="note-item">
                            <div class="note-excerpt">“{{ $note->excerpt }}”</div>
                            <div class="note-body">{{ $note->body }}</div>
                            <div class="note-meta">
                                <span>Modul: {{ optional($note->materi)->judul }}</span>
                                <span>{{ $note->created_at->format('d M Y H:i') }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="empty-side-text">
                    Belum ada catatan. Blok teks di materi lalu pilih “Tambah Catatan”.
                </p>
            @endif
        </div>
    </aside>

    {{-- BACKDROP GELAP SAAT DRAWER BUKA --}}
    <div id="reader-backdrop" class="reader-backdrop"></div>
</div>

{{-- TOOLBAR SELEKSI TEKS + MODAL CATATAN (boleh pakai yang sebelumnya sudah dibuat) --}}
{{-- ... (toolbar & modal catatan yang kemarin) ... --}}

<style>
.reader-container{max-width:960px;margin:0 auto;padding:1.25rem 1rem 2.5rem;position:relative;}
.reader-top{display:flex;align-items:flex-start;gap:.9rem;margin-bottom:1.25rem;}
.reader-back{display:inline-flex;align-items:center;gap:.35rem;font-size:.85rem;color:#64748B;text-decoration:none;}
.reader-title-block{flex:1;}
.reader-title{margin:0 0 .25rem;font-size:1.7rem;font-weight:700;color:#111827;}
.reader-subtitle{margin:0;font-size:.9rem;color:#6B7280;}

.reader-main{background:#fff;border-radius:18px;border:1px solid #E5E7EB;
    box-shadow:0 4px 18px rgba(15,23,42,.06);padding:1.75rem;min-height:70vh;}
.materi-title{font-size:1.4rem;font-weight:700;margin:0 0 1.25rem;}
.materi-content{font-size:.95rem;line-height:1.7;color:#111827;}
.materi-content p{margin-bottom:1rem;}

.reader-panel-toggle{position:fixed;right:18px;top:50%;transform:translateY(-50%);
    width:44px;height:44px;border-radius:999px;border:none;background:#111827;color:#fff;
    display:flex;align-items:center;justify-content:center;box-shadow:0 8px 24px rgba(15,23,42,.45);
    cursor:pointer;z-index:9000;}
.reader-panel-toggle i{font-size:1.1rem;}

.reader-panel{position:fixed;top:0;right:0;width:360px;max-width:85vw;height:100vh;
    background:#F9FAFB;border-left:1px solid #E5E7EB;box-shadow:-8px 0 24px rgba(15,23,42,.25);
    transform:translateX(100%);transition:transform .3s ease;z-index:9500;display:flex;flex-direction:column;}
.reader-panel.open{transform:translateX(0);}
.reader-panel-header{padding:.6rem .9rem;display:flex;justify-content:flex-end;}
.panel-close{border:none;background:transparent;font-size:1.6rem;cursor:pointer;color:#6B7280;}

.reader-backdrop{position:fixed;inset:0;background:rgba(15,23,42,.45);opacity:0;pointer-events:none;
    transition:.3s ease;z-index:9400;}
.reader-backdrop.show{opacity:1;pointer-events:auto;}

.side-tabs{display:flex;border-bottom:1px solid #E5E7EB;}
.side-tab{flex:1;padding:.7rem .8rem;font-size:.85rem;font-weight:600;border:none;cursor:pointer;
    background:#EFF3F9;color:#64748B;}
.side-tab.active{background:#fff;color:#0EA5E9;border-bottom:2px solid #0EA5E9;}

.side-panel{display:none;padding:.9rem .9rem 1rem;overflow-y:auto;}
.side-panel.active{display:block;}
.empty-side-text{font-size:.85rem;color:#6B7280;}

.module-list{list-style:none;margin:0;padding:0;}
.module-item{margin-bottom:.35rem;}
.module-item a{display:flex;justify-content:space-between;align-items:center;
    padding:.55rem .55rem;border-radius:8px;font-size:.85rem;color:#111827;text-decoration:none;}
.module-item:hover a{background:#E5F3FF;}
.module-item.active a{background:#0EA5E9;color:#fff;}
.module-badge{font-size:.7rem;border-radius:999px;padding:.1rem .45rem;background:rgba(255,255,255,.2);}

.note-list{list-style:none;margin:0;padding:0;}
.note-item{padding:.6rem .7rem;border-radius:8px;background:#fff;border:1px solid #E5E7EB;margin-bottom:.5rem;}
.note-excerpt{font-size:.8rem;font-style:italic;color:#4B5563;margin-bottom:.25rem;}
.note-body{font-size:.85rem;color:#111827;margin-bottom:.35rem;}
.note-meta{display:flex;justify-content:space-between;font-size:.75rem;color:#9CA3AF;}

@media(max-width:768px){
    .reader-main{padding:1.25rem;}
    .reader-panel-toggle{top:auto;bottom:18px;transform:none;}
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const sideTabs = document.querySelectorAll('.side-tab');
    const sidePanels = {
        modules: document.getElementById('side-modules'),
        notes: document.getElementById('side-notes'),
    };
    sideTabs.forEach(tab => {
        tab.addEventListener('click', function () {
            const target = this.dataset.sideTab;
            sideTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            Object.values(sidePanels).forEach(p => p.classList.remove('active'));
            if (sidePanels[target]) sidePanels[target].classList.add('active');
        });
    });

    const panel = document.getElementById('reader-panel');
    const toggleBtn = document.getElementById('panel-toggle');
    const closeBtn = document.getElementById('panel-close');
    const backdrop = document.getElementById('reader-backdrop');

    function openPanel() {
        panel.classList.add('open');
        backdrop.classList.add('show');
    }
    function closePanel() {
        panel.classList.remove('open');
        backdrop.classList.remove('show');
    }

    toggleBtn.addEventListener('click', openPanel);
    closeBtn.addEventListener('click', closePanel);
    backdrop.addEventListener('click', closePanel);
});
</script>
@endsection