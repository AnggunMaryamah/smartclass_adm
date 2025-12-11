<!doctype html>
<html lang="id" class="theme-light">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>{{ $pageTitle ?? 'Les Privat SD — SmartClass' }}</title>
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- reuse small subset CSS from your landing for consistent look --}}
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap');
    :root { --accent-from:#0ea5e9; --accent-to:#2dd4bf; --muted:#475569; --card-bg:#ffffff; --text:#0f172a; }
    .theme-light { --bg:#f0f9ff; --nav-bg:rgba(255,255,255,0.9); --text:#0f172a; --card-bg:#fff; --muted:#475569; }
    body{font-family:'Poppins',sans-serif;background:var(--bg);color:var(--text);-webkit-font-smoothing:antialiased;}
    .brand-logo{width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,var(--accent-from),var(--accent-to));display:grid;place-items:center;color:white;font-weight:900;}
    .hero-circle{width:420px;height:420px;border-radius:50%;background:linear-gradient(135deg,rgba(14,165,233,0.15),rgba(45,212,191,0.08));display:flex;align-items:center;justify-content:center;box-shadow:0 30px 60px rgba(14,165,233,0.12);}
    .badge-tag{display:inline-flex;align-items:center;gap:0.6rem;background:linear-gradient(135deg, rgba(14,165,233,0.06), rgba(45,212,191,0.04));padding:0.5rem 0.9rem;border-radius:999px;border:1px solid rgba(14,165,233,0.06);font-weight:700;}
  </style>
</head>
<body>
  <!-- NAV (same structure as landing) -->
  <header class="fixed top-0 left-0 right-0 z-50 site-nav" style="background:var(--nav-bg);backdrop-filter:blur(8px);">
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
      <div class="flex items-center gap-6">
        <a href="#" class="flex items-center gap-3">
          <div class="brand-logo">S</div>
          <div style="font-weight:800">SmartClass</div>
        </a>

        <nav class="hidden md:flex items-center gap-6">
          <a href="/" class="text-sm font-semibold" style="color:var(--text)">Home</a>
          <div class="relative">
            <button class="nav-btn text-sm font-semibold flex items-center gap-2" aria-expanded="false" style="color:var(--text)">
              Pilih Jenjang
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5.5 7l4.5 4 4.5-4z"/></svg>
            </button>
            <div class="nav-dropdown" role="menu" style="display:none; position:absolute; left:0; top:calc(100% + 8px);">
              <a href="/sd">SD</a>
              <a href="/smp">SMP</a>
              <a href="/sma">SMA/SMK</a>
            </div>
          </div>
          <a href="#features" class="text-sm font-semibold" style="color:var(--text)">Program</a>
        </nav>
      </div>

      <div class="flex items-center gap-4">
        <button class="btn-cta" style="background:linear-gradient(90deg,var(--accent-from),var(--accent-to));color:white;padding:10px 16px;border-radius:999px;">Coba Kelas Gratis</button>
      </div>
    </div>
  </header>

  <main class="pt-24">
    <!-- HERO: SD specific -->
    <section class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div>
        <div class="badge-tag mb-6">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="#f59e0b" aria-hidden="true"><path d="M12 .587l3.668 7.431L23.5 9.167l-5.667 5.522L19.334 24 12 19.897 4.666 24l1.5-9.311L.5 9.167l7.832-1.149z"/></svg>
          <span>Telah dipercaya 200+ siswa</span>
        </div>

        <h1 style="font-size:clamp(2rem,4.5vw,3rem);font-weight:900;line-height:1.05;margin-bottom:1rem;">
          Les Privat <span style="background:linear-gradient(135deg,var(--accent-from),var(--accent-to));-webkit-background-clip:text;-webkit-text-fill-color:transparent;">SD</span>
          — Metode Personal & Interaktif
        </h1>

        <p style="color:var(--muted);margin-bottom:1.25rem;">
          Program khusus SD (Kelas 1–6) yang menekankan dasar numerasi, literasi, dan kebiasaan belajar.
        </p>

        <div class="flex gap-4 mb-8">
          <a href="#pilih-kelas" class="btn-cta" style="padding:12px 20px;border-radius:999px;">Pilih Kelas SD</a>
          <a href="#features" class="px-5 py-3" style="border-radius:999px;border:1px solid rgba(14,165,233,0.12);">Lihat Program</a>
        </div>

        <!-- Stats small -->
        <div class="flex gap-6">
          <div>
            <div style="font-weight:900;font-size:1.5rem;background:linear-gradient(90deg,var(--accent-from),var(--accent-to));-webkit-background-clip:text;-webkit-text-fill-color:transparent;">200+</div>
            <div style="color:var(--muted)">Siswa Aktif</div>
          </div>
          <div>
            <div style="font-weight:900;font-size:1.5rem;background:linear-gradient(90deg,var(--accent-from),var(--accent-to));-webkit-background-clip:text;-webkit-text-fill-color:transparent;">30+</div>
            <div style="color:var(--muted)">Mata Pelajaran</div>
          </div>
        </div>
      </div>

      <div class="flex justify-center lg:justify-end">
        <div class="hero-circle">
          <div style="width:85%;height:85%;border-radius:18px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--accent-from),var(--accent-to));font-size:4rem;">
            🦉
          </div>
        </div>
      </div>
    </section>

    <!-- PILIH KELAS SD -->
    <section id="pilih-kelas" class="max-w-7xl mx-auto px-6 py-12">
      <div class="text-center mb-10">
        <h2 style="font-size:1.75rem;font-weight:800">Pilih Kelas SD</h2>
        <p style="color:var(--muted)">Program disesuaikan dengan tingkat perkembangan setiap kelas</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($grades as $grade)
          <div class="bg-white rounded-2xl p-6 shadow-sm border" style="border-color:rgba(14,165,233,0.04);">
            <div class="text-5xl mb-4">{!! $grade['icon'] !!}</div>
            <h3 style="font-weight:800;margin-bottom:6px;">{{ $grade['name'] }}</h3>
            <p style="color:var(--muted);margin-bottom:12px;">{{ $grade['desc'] }}</p>
            <a href="#" class="inline-block px-4 py-2 rounded-full" style="border:1px solid rgba(14,165,233,0.12);">Pilih Kelas</a>
          </div>
        @empty
          <p class="text-center text-gray-500">Belum ada kelas tersedia.</p>
        @endforelse
      </div>
    </section>

    <!-- MATA PELAJARAN -->
    <section id="mapel" class="max-w-7xl mx-auto px-6 py-12 bg-gradient-to-b from-white to-transparent rounded-xl">
      <div class="text-center mb-8">
        <h2 style="font-weight:800;font-size:1.5rem;">Mata Pelajaran SD</h2>
        <p style="color:var(--muted)">Pilih mata pelajaran sesuai kebutuhan siswa</p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse($subjects as $subject)
          <div class="bg-white p-5 rounded-xl text-center border-2 border-transparent {{ $subject['border_class'] }}">
            <div class="text-4xl mb-2">{!! $subject['icon'] !!}</div>
            <div style="font-weight:700;">{{ $subject['name'] }}</div>
          </div>
        @empty
          <p class="text-center text-gray-500">Belum ada mata pelajaran terdaftar.</p>
        @endforelse
      </div>
    </section>

    <!-- FEATURES (reuse) -->
    <section id="features" class="max-w-7xl mx-auto px-6 py-12">
      <div class="text-center mb-8">
        <h2 style="font-weight:800;font-size:1.5rem;">Kenapa Pilih SmartClass untuk SD?</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($features as $feature)
          <div class="feature-card p-6 rounded-2xl">
            <div class="feature-icon mb-4" style="width:64px;height:64px;border-radius:12px;display:grid;place-items:center;background:linear-gradient(90deg,var(--accent-from),var(--accent-to));color:white;font-size:1.5rem;">{!! $feature['icon'] !!}</div>
            <h4 style="font-weight:800;margin-bottom:6px;">{{ $feature['title'] }}</h4>
            <p style="color:var(--muted)">{{ $feature['desc'] }}</p>
          </div>
        @empty
          <p class="text-center text-gray-500">Belum ada fitur terdaftar.</p>
        @endforelse
      </div>
    </section>

    <!-- TESTIMONIALS (compact) -->
    <section class="max-w-7xl mx-auto px-6 py-12">
      <div class="text-center mb-8">
        <h2 style="font-weight:800;">Testimoni Orang Tua</h2>
        <p style="color:var(--muted)">Apa kata mereka</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($testimonials as $t)
          <div class="bg-white p-6 rounded-xl shadow">
            <div class="flex items-center gap-4 mb-3">
              <div style="width:44px;height:44px;border-radius:10px;background:linear-gradient(90deg,var(--accent-from),var(--accent-to));display:grid;place-items:center;color:white;font-weight:800;">{{ strtoupper(substr($t['name'],0,1)) }}</div>
              <div>
                <div style="font-weight:700;">{{ $t['name'] }}</div>
                <div style="color:var(--muted);font-size:0.9rem;">{{ $t['grade'] }}</div>
              </div>
            </div>
            <p style="color:var(--muted)"><em>\"{{ $t['text'] }}\"</em></p>
          </div>
        @empty
          <p class="text-center text-gray-500">Belum ada testimoni.</p>
        @endforelse
      </div>
    </section>

  </main>

  <!-- reuse simplified footer from landing -->
  <footer style="background:var(--card-bg);padding:32px 0;border-top:1px solid rgba(14,165,233,0.04);margin-top:32px;">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex flex-col md:flex-row justify-between gap-6">
        <div>
          <div style="display:flex;gap:10px;align-items:center;font-weight:800;">
            <div class="brand-logo">S</div>
            <div>SmartClass</div>
          </div>
          <p style="color:var(--muted);margin-top:8px;">Les privat & bimbel untuk SD — personal, terstruktur, dan berkualitas.</p>
        </div>

        <div style="color:var(--muted)">© {{ date('Y') }} SmartClass. All rights reserved.</div>
      </div>
    </div>
  </footer>

  {{-- minimal JS for dropdown (reuse pattern) --}}
  <script>
    document.querySelectorAll('.nav-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const dd = btn.nextElementSibling;
            if(!dd) return;
            dd.style.display = dd.style.display === 'block' ? 'none' : 'block';
        });
    });
    // click outside to close
    document.addEventListener('click', (e) => {
      if(!e.target.closest('.nav-btn') && !e.target.closest('.nav-dropdown')) {
        document.querySelectorAll('.nav-dropdown').forEach(d => d.style.display = 'none');
      }
    });
  </script>
</body>
</html>