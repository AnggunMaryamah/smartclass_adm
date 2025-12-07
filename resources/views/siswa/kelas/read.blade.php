@extends('layouts.siswa_reader')

@section('title', $kelas->nama_kelas ?? 'Kelas')

@section('content')
<div class="reader-root" id="readerRoot">

    {{-- BAR ATAS --}}
    <header class="reader-header" id="readerHeader">
        <div class="reader-header-left">
            <a href="{{ route('siswa.kelas.index') }}" class="reader-back-link">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>

        <div class="reader-header-center">
            <h1 class="reader-class-title">{{ $kelas->nama_kelas }}</h1>
        </div>

        <div class="reader-header-right">
            <button class="reader-icon-btn" id="openSettings" aria-label="Pengaturan tampilan">
                <i class="fas fa-gear"></i>
            </button>

            <button class="reader-icon-btn reader-hamburger" id="openSidebar" aria-label="Daftar modul & catatan">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    {{-- AREA BACA + NAV BAWAH --}}
    <main class="reader-shell" id="readerShell">
        <article class="reader-article" id="readerArticle"
                 style="background: inherit; box-shadow: none; border: none; border-radius: 0;">
            @if($currentMateri)
                <h2 class="reader-materi-title">{{ $currentMateri->judul }}</h2>
                <div class="reader-materi-content" id="materiContent">
                    {!! $currentMateri->konten !!}
                </div>
            @else
                <p>Belum ada materi pada kelas ini.</p>
            @endif
        </article>

        {{-- NAVIGASI BAWAH --}}
        <nav class="reader-bottom-nav" id="readerBottomNav">
            <div class="reader-bottom-nav-left" style="display:flex;justify-content:flex-start;">
                @if(!empty($prevMateri))
                    <a href="{{ route('siswa.kelas.read', ['kelas' => $kelas->id, 'materi' => $prevMateri->id]) }}"
                       class="reader-bottom-link nav-prev"
                       style="flex-direction:row;align-items:center;gap:8px;">
                        <span class="nav-arrow-circle nav-arrow-circle-left" aria-hidden="true">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                        <span class="nav-title" style="max-width:none;">
                            {{ $prevMateri->judul }}
                        </span>
                    </a>
                @endif
            </div>

            <div class="reader-bottom-nav-center">
                <span class="nav-current-title">
                    {{ $currentMateri->judul ?? 'Belum ada materi' }}
                </span>
            </div>

            <div class="reader-bottom-nav-right" style="display:flex;justify-content:flex-end;">
                @if(!empty($nextMateri))
                    <a href="{{ route('siswa.kelas.read', ['kelas' => $kelas->id, 'materi' => $nextMateri->id]) }}"
                       class="reader-bottom-link nav-next"
                       style="flex-direction:row;align-items:center;gap:8px;">
                        <span class="nav-title" style="max-width:none;">
                            {{ $nextMateri->judul }}
                        </span>
                        <span class="nav-arrow-circle nav-arrow-circle-right" aria-hidden="true">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </a>
                @endif
            </div>
        </nav>
    </main>

    {{-- SIDEBAR KANAN: MODUL & CATATAN --}}
    @php
        $completedIds   = $completedMateriIds ?? [];
        $totalModules   = max($materiList->count(), 1);
        $doneModules    = $materiList->whereIn('id', $completedIds)->count();
        $progressPersen = round(($doneModules / $totalModules) * 100);
        
        $groupedMateri = $materiList->groupBy('bab');
    @endphp

    <aside class="reader-sidebar" id="readerSidebar" aria-label="Daftar modul dan catatan">
        <div class="reader-sidebar-header">
            <button class="reader-sidebar-close" id="closeSidebar" aria-label="Tutup sidebar">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div class="reader-sidebar-tabs">
            <button class="sidebar-tab active" data-target="#tabModules">Daftar Modul</button>
            <button class="sidebar-tab" data-target="#tabNotes">Catatan Belajar</button>
        </div>

        <div class="reader-sidebar-body">
            {{-- TAB MODUL --}}
            <section class="sidebar-panel active" id="tabModules">
                <div class="reader-progress-wrapper">
                    <div class="reader-progress-label">{{ $progressPersen }}% Selesai</div>
                    <div class="reader-progress-track">
                        <div class="reader-progress-bar" style="width: {{ $progressPersen }}%;"></div>
                    </div>
                </div>

                @if($materiList->isEmpty())
                    <p class="sidebar-empty">Belum ada modul.</p>
                @else
                    <div class="sidebar-chapter-list">
                        @if($groupedMateri->count() > 1)
                            @foreach($groupedMateri as $babName => $materiInBab)
                                @php
                                    $totalInBab = $materiInBab->count();
                                    $completedInBab = $materiInBab->whereIn('id', $completedIds)->count();
                                    $isAllComplete = $completedInBab === $totalInBab;
                                @endphp
                                <div class="chapter-group">
                                    <button class="chapter-header" data-chapter="{{ $loop->index }}">
                                        <span class="chapter-chevron">
                                            <i class="fas fa-chevron-right"></i>
                                        </span>
                                        <span class="chapter-title">{{ $babName ?: 'Bab ' . $loop->iteration }}</span>
                                        <span class="chapter-progress">{{ $completedInBab }}/{{ $totalInBab }}</span>
                                        @if($isAllComplete)
                                            <span class="chapter-check">
                                                <i class="fas fa-check"></i>
                                            </span>
                                        @endif
                                    </button>
                                    <ul class="chapter-content">
                                        @foreach($materiInBab as $materi)
                                            @php
                                                $isActive    = $currentMateri && $currentMateri->id === $materi->id;
                                                $isCompleted = in_array($materi->id, $completedIds);
                                            @endphp
                                            <li class="sidebar-module-item {{ $isActive ? 'active' : '' }} {{ $isCompleted ? 'is-completed' : '' }}">
                                                <a href="{{ route('siswa.kelas.read', ['kelas' => $kelas->id, 'materi' => $materi->id]) }}">
                                                    <span class="module-status-icon">
                                                        @if($isCompleted)
                                                            <i class="fas fa-check"></i>
                                                        @endif
                                                    </span>
                                                    <span class="module-title">{{ $materi->judul }}</span>
                                                    @if($isActive)
                                                        <span class="module-badge">Sedang dibaca</span>
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        @else
                            <ul class="sidebar-module-list">
                                @foreach($materiList as $materi)
                                    @php
                                        $isActive    = $currentMateri && $currentMateri->id === $materi->id;
                                        $isCompleted = in_array($materi->id, $completedIds);
                                    @endphp
                                    <li class="sidebar-module-item {{ $isActive ? 'active' : '' }} {{ $isCompleted ? 'is-completed' : '' }}">
                                        <a href="{{ route('siswa.kelas.read', ['kelas' => $kelas->id, 'materi' => $materi->id]) }}">
                                            <span class="module-status-icon">
                                                @if($isCompleted)
                                                    <i class="fas fa-check"></i>
                                                @endif
                                            </span>
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
                @endif
            </section>

            {{-- TAB CATATAN --}}
            <section class="sidebar-panel" id="tabNotes">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;padding-top:10px;">
                    <span style="font-size:0.85rem;font-weight:600;">Semua Catatan</span>
                    <span id="noteCount" style="font-size:0.75rem;opacity:.8;">0 catatan</span>
                </div>

                <ul class="sidebar-note-list" id="noteList">
                    {{-- Catatan dari Database --}}
                    @if(isset($catatan) && $catatan->count())
                        @foreach($catatan as $note)
                            <li class="sidebar-note-item" data-note-id="db-{{ $note->id }}">
    <div class="note-header-row">
        <div style="font-size:0.8rem;font-weight:600;margin-bottom:4px;flex:1;">
            {{ optional($note->materi)->judul ?? 'Catatan' }}
        </div>
    </div>

    <div class="note-body-container">
        <div class="note-body-text {{ strlen($note->body) > 100 ? 'truncated' : '' }}">
            {{ $note->body }}
        </div>
        @if(strlen($note->body) > 100)
            <button class="note-toggle-btn">Lihat lebih banyak</button>
        @endif
    </div>

    <div class="note-meta">
        <span>{{ $note->created_at->format('d M Y') }}</span>
    </div>
</li>
                        @endforeach
                    @endif
                </ul>

                <p class="sidebar-empty" id="emptyNoteMessage" style="padding-top:10px;display:none;">
                    Belum ada catatan.
                </p>
            </section>
        </div>
    </aside>

    {{-- TEXT SELECTION POPUP --}}
    <div class="text-selection-popup" id="textSelectionPopup">
        <button class="popup-btn" id="copyTextBtn" title="Salin teks">
            <i class="fas fa-copy"></i>
            <span>Salin</span>
        </button>
        <button class="popup-btn" id="createNoteBtn" title="Buat catatan">
            <i class="fas fa-sticky-note"></i>
            <span>Buat Catatan</span>
        </button>
    </div>

    {{-- OVERLAY --}}
    <div class="reader-overlay" id="readerOverlay"></div>

    {{-- MODAL ADAPTIVE READING --}}
    <div class="reader-settings-modal" id="settingsModal" aria-modal="true" role="dialog">
        <div class="settings-card">
            <div class="settings-header">
                <h2>Adaptive Reading</h2>
                <button class="reader-icon-btn" id="closeSettings" aria-label="Tutup pengaturan">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="settings-section">
                <h3>Tema</h3>
                <div class="settings-grid">
                    <button class="settings-option" data-theme="light">
                        <span class="option-title">Terang</span>
                        <span class="option-desc">Latar putih bersih</span>
                    </button>
                    <button class="settings-option" data-theme="warm">
                        <span class="option-title">Hangat</span>
                        <span class="option-desc">Latar krem lembut</span>
                    </button>
                    <button class="settings-option" data-theme="dark">
                        <span class="option-title">Gelap</span>
                        <span class="option-desc">Kontras rendah cahaya</span>
                    </button>
                </div>
            </div>

            <div class="settings-section">
                <h3>Jenis Font</h3>
                <div class="settings-grid">
                    <button class="settings-option" data-font="default">
                        <span class="option-title">Default</span>
                        <span class="option-desc">Sans-serif modern</span>
                    </button>
                    <button class="settings-option" data-font="serif">
                        <span class="option-title">Serif</span>
                        <span class="option-desc">Kesan seperti buku</span>
                    </button>
                    <button class="settings-option" data-font="opendyslexic">
                        <span class="option-title">Open Dyslexic</span>
                        <span class="option-desc">Ramah disleksia</span>
                    </button>
                </div>
            </div>

            <div class="settings-section">
                <h3>Ukuran Font</h3>
                <div class="settings-grid">
                    <button class="settings-option" data-size="large">
                        <span class="option-title">Besar</span>
                    </button>
                    <button class="settings-option" data-size="medium">
                        <span class="option-title">Sedang</span>
                    </button>
                    <button class="settings-option" data-size="small">
                        <span class="option-title">Kecil</span>
                    </button>
                </div>
            </div>

            <div class="settings-section">
                <h3>Lebar Bacaan</h3>
                <div class="settings-grid">
                    <button class="settings-option" data-width="medium">
                        <span class="option-title">Medium-width</span>
                    </button>
                    <button class="settings-option" data-width="full">
                        <span class="option-title">Full-width</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SWEETALERT2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --reader-bg-light: #fafafa;
        --reader-bg-warm:  #f7ebd9;
        --reader-bg-dark:  #020617;

        --reader-card-light: #ffffff;
        --reader-card-warm:  #f7ebd9;
        --reader-card-dark:  #0f172a;

        --reader-text-light: #1f2933;
        --reader-text-warm:  #3c2f22;
        --reader-text-dark:  #e5e7eb;

        --reader-accent: #0ea5e9;
        --reader-accent-soft: #e0f2fe;
        --reader-border: #e5e7eb;
    }

    .reader-root {
        min-height: 100vh;
        background: var(--reader-bg-light);
        display: flex;
        flex-direction: column;
    }

    .reader-root.theme-light { background: var(--reader-bg-light); color: var(--reader-text-light); }
    .reader-root.theme-warm  { background: var(--reader-bg-warm);  color: var(--reader-text-warm); }
    .reader-root.theme-dark  { background: var(--reader-bg-dark);  color: var(--reader-text-dark); }

    .reader-root.theme-dark .reader-header {
        border-bottom-color: rgba(148, 163, 184, 0.4);
        background: #020617;
    }

    .reader-header {
        position: sticky;
        top: 0;
        z-index: 20;
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        padding: 14px 32px;
        border-bottom: 1px solid rgba(148, 163, 184, 0.15);
        backdrop-filter: blur(10px);
        background: rgba(250, 250, 250, 0.9);
    }

    .reader-root.theme-warm .reader-header {
        background: rgba(240, 225, 200, 0.9);
    }

    .reader-root.theme-dark .reader-header {
        background: rgba(15, 23, 42, 0.95);
    }

    .reader-header-left,
    .reader-header-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .reader-header-right {
        justify-content: flex-end;
    }

    .reader-header-center {
        text-align: center;
    }

    .reader-class-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0;
    }

    .reader-back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.9rem;
        color: inherit;
        text-decoration: none;
    }

    .reader-back-link i {
        font-size: 0.85rem;
    }

    .reader-icon-btn {
        width: 36px;
        height: 36px;
        border-radius: 999px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #111827;
        color: #f9fafb;
        cursor: pointer;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .reader-icon-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.4);
    }

    .reader-root.theme-dark .reader-icon-btn {
        background: #111827;
        color: #e5e7eb;
    }

    .reader-hamburger {
        margin-left: 8px;
    }

    .reader-shell {
        max-width: 960px;
        width: 100%;
        margin: 24px auto 80px;
        padding: 0 24px;
        transition: all 0.3s ease;
    }

    .reader-root.sidebar-open .reader-shell {
        margin-right: calc(340px + 24px);
        max-width: 700px;
    }

    .reader-root.width-full .reader-shell {
        max-width: 1120px;
    }

    .reader-root.width-medium .reader-shell {
        max-width: 800px;
    }

    .reader-root.sidebar-open.width-full .reader-shell {
        max-width: 800px;
    }

    .reader-root.sidebar-open.width-medium .reader-shell {
        max-width: 650px;
    }

    .reader-article {
        background: #ffffff;
        border-radius: 0;
        padding: 32px 32px 40px;
        border: none;
        box-shadow: none;
    }

    .reader-root.theme-warm .reader-article,
    .reader-root.theme-dark .reader-article {
        background: #ffffff;
        border: none;
    }

    .reader-materi-title {
        font-size: 1.6rem;
        margin-bottom: 1.4rem;
        font-weight: 700;
    }

    .reader-materi-content {
        font-size: 0.98rem;
        line-height: 1.8;
    }

    .reader-root.font-default    { font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
    .reader-root.font-serif      { font-family: 'Georgia', 'Times New Roman', serif; }
    .reader-root.font-opendyslexic { font-family: 'OpenDyslexic', system-ui, sans-serif; }

    .reader-root.size-small  { font-size: 14px; }
    .reader-root.size-medium { font-size: 16px; }
    .reader-root.size-large  { font-size: 18px; }

    .reader-materi-content p { margin-bottom: 1rem; }

    .reader-bottom-nav {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 19;
        padding: 14px 32px;
        margin: 0;
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: flex-start;
        gap: 12px;
        border-top: 1px solid rgba(148, 163, 184, 0.15);
        background: rgba(250, 250, 250, 0.96);
        backdrop-filter: blur(10px);
    }

    .reader-root.theme-warm .reader-bottom-nav {
        background: rgba(240, 225, 200, 0.96);
    }

    .reader-root.theme-dark .reader-bottom-nav {
        background: rgba(15, 23, 42, 0.96);
        border-top-color: rgba(148, 163, 184, 0.4);
    }

    .reader-bottom-nav::before {
        content: none;
    }

    .reader-bottom-link {
        display: inline-flex;
        flex-direction: column;
        text-decoration: none;
        color: inherit;
        font-size: 0.82rem;
    }

    .reader-bottom-link .nav-label {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-weight: 700;
        margin-bottom: 2px;
        color: var(--reader-accent);
        font-size: 0.9rem;
    }

    .nav-arrow {
        font-size: 1.1rem;
        line-height: 1;
    }

    .reader-bottom-link.nav-next {
        align-items: flex-end;
        text-align: right;
    }

    .nav-arrow-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 22px;
        height: 22px;
        border-radius: 999px;
        border: 1px solid rgba(148, 163, 184, 0.85);
        font-size: 0.75rem;
        background: #ffffff;
        color: #6b7280;
        transition: transform 0.15s ease, background 0.15s ease,
                    color 0.15s ease, border-color 0.15s ease;
    }

    .reader-root.theme-dark .nav-arrow-circle {
        background: #020617;
        color: #e5e7eb;
        border-color: rgba(148, 163, 184, 0.6);
    }

    .reader-bottom-link:hover .nav-title {
        color: #111827;
    }

    .reader-root.theme-dark .reader-bottom-link:hover .nav-title {
        color: #f9fafb;
    }

    .reader-bottom-link.nav-next:hover .nav-arrow-circle-right {
        transform: translateX(2px);
    }

    .reader-bottom-link.nav-prev:hover .nav-arrow-circle-left {
        transform: translateX(-2px);
    }

    .reader-bottom-link:hover .nav-arrow-circle {
        background: #e5e7eb;
        border-color: #9ca3af;
        color: #111827;
    }

    .nav-title {
        max-width: 260px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 0.8rem;
        color: rgba(100, 116, 139, 0.95);
    }

    .nav-current-title {
        font-size: 0.9rem;
        font-weight: 600;
        text-align: center;
    }

    .reader-sidebar {
        position: fixed;
        right: 0;
        width: 340px;
        max-width: 85vw;
        border-left: 1px solid rgba(148, 163, 184, 0.4);
        transform: translateX(100%);
        transition: transform 0.3s ease;
        z-index: 30;
        display: flex;
        flex-direction: column;
    }

    .reader-root.theme-light .reader-sidebar {
        background: var(--reader-card-light);
        color: var(--reader-text-light);
    }

    .reader-root.theme-warm .reader-sidebar {
        background: var(--reader-card-warm);
        color: var(--reader-text-warm);
    }

    .reader-root.theme-dark .reader-sidebar {
        background: var(--reader-card-dark);
        color: var(--reader-text-dark);
    }

    .reader-sidebar.open {
        transform: translateX(0);
    }

    .reader-sidebar-header {
        padding: 10px 12px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .reader-sidebar-close {
        width: 32px;
        height: 32px;
        border-radius: 999px;
        border: none;
        background: var(--reader-accent);
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.9rem;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.4);
        transition: all 0.25s ease;
    }

    .reader-sidebar-close:hover {
        background: #0284c7;
        box-shadow: 0 6px 18px rgba(14, 165, 233, 0.55);
        transform: translateY(-1px);
    }

    .reader-sidebar-tabs {
        display: flex;
        border-bottom: 1px solid rgba(148, 163, 184, 0.4);
    }

    .sidebar-tab {
        flex: 1;
        padding: 10px 12px;
        background: transparent;
        border: none;
        font-size: 0.86rem;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .reader-root.theme-light .sidebar-tab,
    .reader-root.theme-warm .sidebar-tab {
        background: #e5e7eb;
        color: #111827;
    }

    .reader-root.theme-dark .sidebar-tab {
        background: #1f2937;
        color: #f9fafb;
    }

    .sidebar-tab + .sidebar-tab {
        border-left: 1px solid rgba(148, 163, 184, 0.4);
    }

    .sidebar-tab.active {
        background: var(--reader-accent);
        color: #ffffff;
        box-shadow: 0 0 0 1px rgba(14, 165, 233, 0.5);
    }

    .sidebar-tab:hover {
        filter: brightness(1.05);
    }

    .reader-progress-wrapper {
        padding: 10px 14px 4px;
        margin-bottom: 8px;
    }

    .reader-progress-label {
        font-size: 0.8rem;
        color: rgba(100, 116, 139, 0.95);
        margin-bottom: 4px;
        font-weight: 500;
    }

    .reader-root.theme-dark .reader-progress-label {
        color: rgba(148, 163, 184, 0.95);
    }

    .reader-progress-track {
        height: 4px;
        background: #e5e7eb;
        border-radius: 999px;
        overflow: hidden;
    }

    .reader-root.theme-dark .reader-progress-track {
        background: #1f2937;
    }

    .reader-progress-bar {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, #0ea5e9, #0284c7);
        border-radius: 999px;
        transition: width 0.35s ease;
    }

    .reader-sidebar-body {
        flex: 1;
        overflow-y: auto;
        padding: 0 12px 16px;
        font-size: 0.86rem;
    }

    .sidebar-panel {
        display: none;
    }

    .sidebar-panel.active {
        display: block;
    }

    .sidebar-chapter-list {
        margin-top: 4px;
    }

    .chapter-group {
        margin-bottom: 4px;
    }

    .chapter-header {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 9px 10px;
        background: rgba(148, 163, 184, 0.12);
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.88rem;
        font-weight: 600;
        text-align: left;
        transition: background 0.15s ease;
    }

    .chapter-header:hover {
        background: rgba(148, 163, 184, 0.2);
    }

    .reader-root.theme-dark .chapter-header {
        background: rgba(15, 23, 42, 0.7);
    }

    .reader-root.theme-dark .chapter-header:hover {
        background: rgba(15, 23, 42, 0.9);
    }

    .chapter-chevron {
        width: 14px;
        height: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s ease;
    }

    .chapter-chevron i {
        font-size: 0.75rem;
    }

    .chapter-header.expanded .chapter-chevron {
        transform: rotate(90deg);
    }

    .chapter-title {
        flex: 1;
    }

    .chapter-progress {
        font-size: 0.72rem;
        padding: 2px 6px;
        background: rgba(100, 116, 139, 0.15);
        border-radius: 999px;
        font-weight: 500;
    }

    .chapter-check {
        width: 18px;
        height: 18px;
        border-radius: 999px;
        background: #0ea5e9;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
    }

    .chapter-content {
        list-style: none;
        margin: 0;
        padding: 0;
        padding-left: 12px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .chapter-header.expanded + .chapter-content {
        max-height: 1000px;
        padding-top: 4px;
    }

    .sidebar-module-list,
    .sidebar-note-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .sidebar-module-item a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 9px;
        border-radius: 8px;
        text-decoration: none;
        color: inherit;
        transition: background 0.15s ease;
    }

    .sidebar-module-item:hover a {
        background: rgba(148, 163, 184, 0.16);
    }

    .reader-root.theme-dark .sidebar-module-item:hover a {
        background: rgba(15, 23, 42, 0.9);
    }

    .sidebar-module-item.active a {
        background: var(--reader-accent);
        color: #f9fafb;
    }

    .module-status-icon {
        width: 20px;
        height: 20px;
        border-radius: 999px;
        border: 2px solid var(--reader-accent);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        color: #ffffff;
        background: transparent;
        flex-shrink: 0;
    }

    .sidebar-module-item.is-completed .module-status-icon {
        background: var(--reader-accent);
    }

    .module-title {
        flex: 1;
        max-width: 220px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .module-badge {
        font-size: 0.7rem;
        padding: 2px 6px;
        border-radius: 999px;
        border: 1px solid rgba(249, 250, 251, 0.6);
    }

    .sidebar-note-item {
        border-radius: 8px;
        padding: 8px 9px;
        margin-bottom: 6px;
        background: rgba(15, 23, 42, 0.05);
        position: relative;
    }

    .reader-root.theme-dark .sidebar-note-item {
        background: rgba(15, 23, 42, 0.85);
    }

    .note-header-row {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 4px;
    }

    /* ← PERBAIKAN CSS: Paksa teks catatan jadi hitam */
    .note-body-container {
        background: #fef3c7;
        border-radius: 6px;
        padding: 6px 8px;
        font-size: 0.8rem;
        margin-bottom: 4px;
        color: #1f2937; /* ← Teks hitam gelap */
    }

    .note-body-text {
        line-height: 1.5;
        color: #1f2937 !important; /* ← Paksa teks hitam */
    }

    .note-body-text.truncated {
        max-height: 3.6em;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    .note-body-text.expanded {
        max-height: none;
        -webkit-line-clamp: unset;
    }

    .note-toggle-btn {
        background: transparent;
        border: none;
        color: var(--reader-accent);
        font-size: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        padding: 4px 0 0;
        text-decoration: underline;
    }

    .note-toggle-btn:hover {
        color: #0284c7;
    }

    /* Link dalam catatan tetap terlihat */
    .note-body-container a {
        color: #0ea5e9 !important;
        text-decoration: underline;
        font-weight: 500;
    }

    .note-body-container a:hover {
        color: #0284c7 !important;
    }

    .note-meta {
        display: flex;
        justify-content: space-between;
        font-size: 0.72rem;
        opacity: 0.7;
        margin-top: 2px;
    }

    .sidebar-empty {
        font-size: 0.84rem;
        opacity: 0.8;
        padding: 6px 2px;
    }

    .text-selection-popup {
        position: absolute;
        display: none;
        gap: 6px;
        padding: 6px;
        background: #111827;
        border-radius: 10px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.4);
        z-index: 50;
    }

    .text-selection-popup.show {
        display: flex;
    }

    .popup-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        background: transparent;
        border: none;
        border-radius: 6px;
        color: #f9fafb;
        font-size: 0.85rem;
        cursor: pointer;
        transition: background 0.15s ease;
    }

    .popup-btn:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .popup-btn i {
        font-size: 0.9rem;
    }

    .note-menu-dropdown {
        position: absolute;
        display: none;
        flex-direction: column;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.15);
        overflow: hidden;
        z-index: 100; /* ← PERBAIKAN: z-index tinggi */
        min-width: 120px;
    }

    .note-menu-dropdown.show {
        display: flex;
    }

    .reader-root.theme-dark .note-menu-dropdown {
        background: #1f2937;
    }

    .note-menu-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        background: transparent;
        border: none;
        color: inherit;
        font-size: 0.85rem;
        cursor: pointer;
        text-align: left;
        transition: background 0.15s ease;
    }

    .note-menu-item:hover {
        background: rgba(148, 163, 184, 0.1);
    }

    .reader-root.theme-dark .note-menu-item:hover {
        background: rgba(15, 23, 42, 0.9);
    }

    .note-menu-item i {
        font-size: 0.9rem;
    }

    .reader-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.5);
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
        z-index: 25;
    }

    .reader-overlay.show {
        opacity: 1;
        pointer-events: auto;
    }

    .reader-settings-modal {
        position: fixed;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 40;
    }

    .reader-settings-modal.show {
        opacity: 1;
        pointer-events: auto;
    }

    .settings-card {
        width: 480px;
        max-width: 95vw;
        max-height: 90vh;
        overflow-y: auto;
        background: #ffffff;
        border-radius: 18px;
        padding: 18px 20px 20px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.25);
    }

    .reader-root.theme-warm .settings-card {
        background: #fff7ea;
    }

    .reader-root.theme-dark .settings-card {
        background: #020617;
        color: #e5e7eb;
    }

    .settings-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .settings-header h2 {
        font-size: 1.2rem;
    }

    .settings-section {
        margin-top: 14px;
    }

    .settings-section h3 {
        font-size: 0.95rem;
        margin-bottom: 6px;
    }

    .settings-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 8px;
    }

    .settings-option {
        position: relative;
        padding: 10px 8px;
        border-radius: 10px;
        border: 1px solid rgba(148, 163, 184, 0.6);
        background: #f9fafb;
        font-size: 0.8rem;
        text-align: left;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .settings-option:hover {
        border-color: var(--reader-accent);
        box-shadow: 0 0 0 1px rgba(14, 165, 233, 0.25);
    }

    .settings-option.active {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 2px rgba(14, 165, 233, 0.35);
        background: var(--reader-accent-soft);
    }

    .settings-option.active::after {
        content: "\f00c";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        right: 6px;
        top: 6px;
        width: 18px;
        height: 18px;
        border-radius: 999px;
        background: #0ea5e9;
        color: #ffffff;
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .option-title {
        font-weight: 600;
        display: block;
        margin-bottom: 2px;
    }

    .option-desc {
        font-size: 0.75rem;
        opacity: 0.8;
    }

    /* SWEETALERT2 CUSTOM STYLES */
    .swal-custom-popup {
        border-radius: 16px;
        padding: 0;
    }

    .swal-custom-content {
        padding: 32px 24px 24px;
        text-align: center;
    }

    .icon-wrapper {
        margin: 0 auto 20px;
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-check {
        width: 80px;
        height: 80px;
        animation: scaleIn 0.3s ease;
    }

    .icon-check-circle {
        stroke: #0ea5e9;
        stroke-width: 2;
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        animation: drawCircle 0.6s ease forwards;
    }

    .icon-check-path {
        stroke: #0ea5e9;
        stroke-width: 3;
        stroke-linecap: round;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: drawCheck 0.4s 0.3s ease forwards;
    }

    @keyframes scaleIn {
        from { transform: scale(0); }
        to { transform: scale(1); }
    }

    @keyframes drawCircle {
        to { stroke-dashoffset: 0; }
    }

    @keyframes drawCheck {
        to { stroke-dashoffset: 0; }
    }

    .swal-text {
        font-size: 1rem;
        color: #1f2937;
        margin: 0;
        line-height: 1.5;
    }

    .swal2-actions {
        margin-top: 24px !important;
        gap: 12px;
    }

    .swal-btn-confirm,
    .swal-btn-cancel {
        padding: 10px 24px;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .swal-btn-confirm {
        background: #0ea5e9;
        color: #ffffff;
    }

    .swal-btn-confirm:hover {
        background: #0284c7;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .swal-btn-cancel {
        background: #e5e7eb;
        color: #1f2937;
    }

    .swal-btn-cancel:hover {
        background: #d1d5db;
    }

    .swal-close-btn {
        width: 32px;
        height: 32px;
        font-size: 1.2rem;
        color: #6b7280;
    }

    .swal-close-btn:hover {
        color: #1f2937;
    }

    @media (max-width: 900px) {
        .reader-shell {
            padding: 0 16px;
            margin-bottom: 70px;
        }

        .reader-article {
            padding: 20px 18px 26px;
        }

        .reader-root.sidebar-open .reader-shell {
            margin-right: 0;
            max-width: 960px;
        }

        .reader-shell {
            max-width: 960px;
            width: 100%;
            margin: 24px auto 96px;
            padding: 0 24px;
        }
    }

    @media (max-width: 900px) {
        .reader-shell {
            padding: 0 16px;
            margin-bottom: 90px;
        }
    }

    @media (max-width: 640px) {
        .reader-header {
            grid-template-columns: auto 1fr auto;
            padding-inline: 16px;
        }

        .reader-class-title {
            font-size: 1.1rem;
        }

        .nav-title {
            max-width: 120px;
        }
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const root    = document.getElementById('readerRoot');
    const overlay = document.getElementById('readerOverlay');
    const sidebar = document.getElementById('readerSidebar');
    const header  = document.getElementById('readerHeader');
    const bottomNav = document.getElementById('readerBottomNav');

    function adjustSidebarPosition() {
        const headerHeight = header.offsetHeight;
        const bottomNavHeight = bottomNav.offsetHeight;
        
        sidebar.style.top = headerHeight + 'px';
        sidebar.style.bottom = bottomNavHeight + 'px';
    }

    adjustSidebarPosition();
    window.addEventListener('resize', adjustSidebarPosition);

    const prefs = {
        theme: localStorage.getItem('reader_theme') || 'light',
        font:  localStorage.getItem('reader_font')  || 'default',
        size:  localStorage.getItem('reader_size')  || 'medium',
        width: localStorage.getItem('reader_width') || 'full',
    };

    function applyPrefs() {
        root.classList.remove('theme-light', 'theme-warm', 'theme-dark');
        root.classList.add('theme-' + prefs.theme);

        root.classList.remove('font-default', 'font-serif', 'font-opendyslexic');
        root.classList.add('font-' + prefs.font);

        root.classList.remove('size-small', 'size-medium', 'size-large');
        root.classList.add('size-' + prefs.size);

        root.classList.remove('width-medium', 'width-full');
        root.classList.add('width-' + prefs.width);

        document.querySelectorAll('.settings-option').forEach(btn => {
            btn.classList.remove('active');
        });
        document
            .querySelectorAll(
                '.settings-option[data-theme="' + prefs.theme + '"],' +
                '.settings-option[data-font="'  + prefs.font  + '"],' +
                '.settings-option[data-size="'  + prefs.size  + '"],' +
                '.settings-option[data-width="' + prefs.width + '"]'
            )
            .forEach(btn => btn.classList.add('active'));
    }

    applyPrefs();

    const openSettings  = document.getElementById('openSettings');
    const closeSettings = document.getElementById('closeSettings');
    const settingsModal = document.getElementById('settingsModal');

    function showSettings() {
        settingsModal.classList.add('show');
        overlay.classList.add('show');
    }

    function hideSettings() {
        settingsModal.classList.remove('show');
        overlay.classList.remove('show');
    }

    function hideNoteMenu() {
        // dummy function supaya tidak error saat Escape
    }

    // ==========================================
    // UPDATE NOTE COUNT
    // ==========================================
    function updateNoteCount() {
        const noteList  = document.getElementById('noteList');
        const noteCount = document.getElementById('noteCount');
        const emptyMsg  = document.getElementById('emptyNoteMessage');

        const count = noteList.querySelectorAll('.sidebar-note-item').length;
        noteCount.textContent = `${count} catatan`;

        if (count === 0) {
            emptyMsg.style.display = 'block';
        } else {
            emptyMsg.style.display = 'none';
        }
    }

    openSettings.addEventListener('click', showSettings);
    closeSettings.addEventListener('click', hideSettings);

    document.querySelectorAll('.settings-option').forEach(btn => {
        btn.addEventListener('click', () => {
            const t = btn.dataset.theme;
            const f = btn.dataset.font;
            const s = btn.dataset.size;
            const w = btn.dataset.width;

            if (t) { prefs.theme = t; localStorage.setItem('reader_theme', t); }
            if (f) { prefs.font  = f; localStorage.setItem('reader_font',  f); }
            if (s) { prefs.size  = s; localStorage.setItem('reader_size',  s); }
            if (w) { prefs.width = w; localStorage.setItem('reader_width', w); }

            applyPrefs();
        });
    });

    const openSidebarBtn  = document.getElementById('openSidebar');
    const closeSidebarBtn = document.getElementById('closeSidebar');

    function openSidebar() {
        sidebar.classList.add('open');
        root.classList.add('sidebar-open');
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        root.classList.remove('sidebar-open');
    }

    openSidebarBtn.addEventListener('click', openSidebar);
    closeSidebarBtn.addEventListener('click', closeSidebar);

    overlay.addEventListener('click', () => {
        if (settingsModal.classList.contains('show')) {
            hideSettings();
        }
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            hideSettings();
            closeSidebar();
            hideNoteMenu();
        }
    });

    const tabs = document.querySelectorAll('.sidebar-tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const target = tab.dataset.target;
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            document.querySelectorAll('.sidebar-panel').forEach(p => {
                p.classList.remove('active');
            });
            document.querySelector(target).classList.add('active');
        });
    });

    // CHAPTER ACCORDION
    document.querySelectorAll('.chapter-header').forEach(header => {
        header.addEventListener('click', () => {
            header.classList.toggle('expanded');
        });
    });

    // ==========================================
    // TEXT SELECTION POPUP
    // ==========================================
    const selectionPopup = document.getElementById('textSelectionPopup');
    const copyTextBtn = document.getElementById('copyTextBtn');
    const createNoteBtn = document.getElementById('createNoteBtn');
    const materiContent = document.getElementById('materiContent');
    let selectedText = '';

    function showSelectionPopup(x, y) {
        selectionPopup.style.left = x + 'px';
        selectionPopup.style.top = (y - 50) + 'px';
        selectionPopup.classList.add('show');
    }

    function hideSelectionPopup() {
        selectionPopup.classList.remove('show');
    }

    if (materiContent) {
        materiContent.addEventListener('mouseup', function(e) {
            setTimeout(() => {
                const selection = window.getSelection();
                selectedText = selection.toString().trim();

                if (selectedText.length > 0) {
                    const range = selection.getRangeAt(0);
                    const rect = range.getBoundingClientRect();
                    showSelectionPopup(rect.left + (rect.width / 2) - 60, rect.top + window.scrollY);
                } else {
                    hideSelectionPopup();
                }
            }, 10);
        });
    }

    document.addEventListener('mousedown', function(e) {
        if (!selectionPopup.contains(e.target) && !materiContent.contains(e.target)) {
            hideSelectionPopup();
        }
    });

    // COPY TEXT WITH SWAL
    copyTextBtn.addEventListener('click', () => {
        if (selectedText) {
            navigator.clipboard.writeText(selectedText).then(() => {
                Swal.fire({
                    html: `
                        <div class="swal-custom-content">
                            <div class="icon-wrapper">
                                <svg class="icon-check" viewBox="0 0 52 52">
                                    <circle class="icon-check-circle" cx="26" cy="26" r="25" fill="none"/>
                                    <path class="icon-check-path" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                                </svg>
                            </div>
                            <p class="swal-text">Teks berhasil disalin!</p>
                        </div>
                    `,
                    timer: 2000,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'swal-custom-popup'
                    },
                    width: '320px',
                    padding: '0'
                });
                hideSelectionPopup();
            });
        }
    });

    // ==========================================
    // CREATE NOTE WITH SWAL CONFIRMATION
    // ==========================================
    createNoteBtn.addEventListener('click', () => {
        if (selectedText) {
            Swal.fire({
                html: `
                    <div class="swal-custom-content">
                        <div class="icon-wrapper">
                            <svg class="icon-check" viewBox="0 0 52 52">
                                <circle class="icon-check-circle" cx="26" cy="26" r="25" fill="none"/>
                                <path class="icon-check-path" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                            </svg>
                        </div>
                        <p class="swal-text">Apakah Anda yakin ingin menyimpan catatan ini?</p>
                    </div>
                `,
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                buttonsStyling: false,
                customClass: {
                    popup: 'swal-custom-popup',
                    confirmButton: 'swal-btn-confirm',
                    cancelButton: 'swal-btn-cancel',
                    closeButton: 'swal-close-btn'
                },
                width: '400px',
                padding: '0'
            }).then((result) => {
                if (result.isConfirmed) {
                    const note = {
                        id: Date.now(),
                        materiId: {{ $currentMateri->id ?? 'null' }},
                        materiTitle: "{{ $currentMateri->judul ?? '' }}",
                        body: selectedText,
                        createdAt: new Date().toISOString()
                    };

                    let notes = JSON.parse(localStorage.getItem('reader_notes') || '[]');
                    notes.unshift(note);
                    localStorage.setItem('reader_notes', JSON.stringify(notes));

                    addNoteToSidebar(note);
                    updateNoteCount();

                    Swal.fire({
                        html: `
                            <div class="swal-custom-content">
                                <div class="icon-wrapper">
                                    <svg class="icon-check" viewBox="0 0 52 52">
                                        <circle class="icon-check-circle" cx="26" cy="26" r="25" fill="none"/>
                                        <path class="icon-check-path" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                                    </svg>
                                </div>
                                <p class="swal-text">Catatan berhasil dibuat!</p>
                            </div>
                        `,
                        timer: 2000,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'swal-custom-popup'
                        },
                        width: '320px',
                        padding: '0'
                    });

                    hideSelectionPopup();
                    window.getSelection().removeAllRanges();
                }
            });
        }
    });

    // ==========================================
    // ADD NOTE TO SIDEBAR
    // ==========================================
    function addNoteToSidebar(note) {
        const noteList = document.getElementById('noteList');
        const emptyMsg = document.getElementById('emptyNoteMessage');

        emptyMsg.style.display = 'none';

        const noteItem = document.createElement('li');
        noteItem.className = 'sidebar-note-item';
        noteItem.setAttribute('data-note-id', `local-${note.id}`);

        const isLong = note.body.length > 100;

        // Format tanggal
        const dateText = note.createdAt
            ? new Date(note.createdAt).toLocaleDateString('id-ID', {
                day: '2-digit', month: 'short', year: 'numeric'
              })
            : '';

        noteItem.innerHTML = `
            <div class="note-header-row">
                <div style="font-size:0.8rem;font-weight:600;margin-bottom:4px;flex:1;">
                    ${note.materiTitle || 'Catatan'}
                </div>
            </div>

            <div class="note-body-container">
                <div class="note-body-text ${isLong ? 'truncated' : ''}">
                    ${note.body}
                </div>
                ${isLong ? '<button class="note-toggle-btn">Lihat lebih banyak</button>' : ''}
            </div>

            <div class="note-meta">
                <span>${dateText}</span>
            </div>
        `;

        noteList.insertBefore(noteItem, noteList.firstChild);

        const toggleBtn = noteItem.querySelector('.note-toggle-btn');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', toggleNoteExpansion);
        }
    }

    // ==========================================
    // TOGGLE NOTE EXPANSION
    // ==========================================
    function toggleNoteExpansion(e) {
        const btn = e.currentTarget;
        const textEl = btn.previousElementSibling;
        
        if (textEl.classList.contains('truncated')) {
            textEl.classList.remove('truncated');
            textEl.classList.add('expanded');
            btn.textContent = 'Lihat lebih sedikit';
        } else {
            textEl.classList.add('truncated');
            textEl.classList.remove('expanded');
            btn.textContent = 'Lihat lebih banyak';
        }
    }

    // Attach to existing notes
    document.querySelectorAll('.note-toggle-btn').forEach(btn => {
        btn.addEventListener('click', toggleNoteExpansion);
    });

    // ==========================================
    // LOAD LOCAL NOTES (SUPAYA GA HILANG SETELAH REFRESH)
    // ==========================================
    function loadLocalNotes() {
        const notes = JSON.parse(localStorage.getItem('reader_notes') || '[]');
        const currentMateriId = {{ $currentMateri->id ?? 'null' }};

        notes.forEach(note => {
            // Filter per materi (kalau mau semua catatan, hapus if ini)
            if (note.materiId === currentMateriId) {
                addNoteToSidebar(note);
            }
        });

        updateNoteCount();
    }

    // ==========================================
    // SCROLL TRACKING & COMPLETION
    // ==========================================
    let completionSent = false;

    @if($currentMateri)
    const progressUrl = "{{ route('siswa.kelas.materi.complete', [
        'kelas'  => $kelas->id,
        'materi' => $currentMateri->id
    ]) }}";

    console.log('🎯 Progress URL:', progressUrl);
    console.log('📘 Materi ID:', {{ $currentMateri->id }});

    window.addEventListener('scroll', () => {
        const doc = document.documentElement;
        const scrollTop = window.scrollY;
        const scrollHeight = doc.scrollHeight;
        const clientHeight = window.innerHeight;
        const scrollPercentage = (scrollTop / (scrollHeight - clientHeight)) * 100;
        
        if (scrollPercentage > 95) {
            console.log('📊 Scroll:', scrollPercentage.toFixed(2) + '%');
        }
        
        const bottomReached = scrollTop + clientHeight >= scrollHeight - 100;

        if (bottomReached && !completionSent) {
            completionSent = true;
            console.log('✅ Bottom reached! Sending completion...');

            fetch(progressUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                console.log('✅ Response:', data);
                if (data.success) {
                    const progressLabel = document.querySelector('.reader-progress-label');
                    const progressBar = document.querySelector('.reader-progress-bar');
                    
                    if (progressLabel && data.progress) {
                        progressLabel.textContent = data.progress + '% Selesai';
                    }
                    
                    if (progressBar && data.progress) {
                        progressBar.style.width = data.progress + '%';
                    }
                    
                    console.log(`🎉 Progress: ${data.completed}/${data.total} materi (${data.progress}%)`);
                    
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            })
            .catch(error => {
                console.error('❌ Error:', error);
            });
        }
    });
    @endif

    // ==========================================
    // PANGGIL loadLocalNotes() SAAT HALAMAN SIAP
    // ==========================================
    loadLocalNotes();
});
</script>
@endsection
