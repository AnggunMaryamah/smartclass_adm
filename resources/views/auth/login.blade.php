<!-- resources/views/auth/login.blade.php -->
<x-guest-layout>
    <div style="max-width:1100px;margin:0 auto;padding:16px;">
        <div style="display:grid;grid-template-columns:1fr 480px;gap:36px;align-items:center;">
            <div>
                <div
                    style="display:inline-flex;align-items:center;gap:10px;margin-bottom:10px;padding:8px 12px;border-radius:999px;border:1px solid rgba(45,212,191,0.06);background:linear-gradient(90deg,rgba(45,212,191,0.02),transparent);color:var(--muted);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#f59e0b" aria-hidden="true">
                        <path
                            d="M12 .587l3.668 7.431L23.5 9.167l-5.667 5.522L19.334 24 12 19.897 4.666 24l1.5-9.311L.5 9.167l7.832-1.149z" />
                    </svg>
                    <span style="font-weight:700;color:var(--text);">Dipercaya 200+ Siswa</span>
                </div>

                <h1 style="font-size:clamp(2rem,5.5vw,3.2rem);font-weight:900;margin:12px 0 14px;">
                    Wujudkan Prestasi <span
                        style="background:linear-gradient(135deg,var(--accent-from),var(--accent-to));-webkit-background-clip:text;color:transparent;">Terbaikmu</span>
                    Bersama Kami
                </h1>

                <p style="color:var(--muted);margin-bottom:20px;font-size:clamp(0.9rem,2vw,1rem);">
                    SmartClass menyediakan les private & bimbel online dengan guru berpengalaman, metode pembelajaran modern, dan hasil terbukti.
                </p>
            </div>

            <aside
                style="background:var(--card-bg);padding:20px;border-radius:12px;border:1px solid var(--glass-border);box-shadow:var(--shadow-strong);">

                <div style="text-align:center;margin-bottom:14px;">
                    <div
                        style="width:68px;height:68px;margin:0 auto;border-radius:14px;background:linear-gradient(135deg,var(--accent-from),var(--accent-to));display:grid;place-items:center;color:#fff;font-weight:800;font-size:22px;">
                        SC
                    </div>
                    <h3 style="margin-top:12px;font-size:clamp(1.3rem,4vw,1.4rem);font-weight:800;">
                        Masuk ke Akun
                    </h3>
                    <p style="color:var(--muted);margin-top:6px;font-size:0.9rem;">
                        Pilih metode masuk yang kamu inginkan
                    </p>
                </div>

                {{-- 🔴 PESAN ERROR LOGIN (GURU BELUM DI-APPROVE / LOGIN DITOLAK) --}}
                @if ($errors->has('email'))
                    <div style="
                        margin-bottom:12px;
                        padding:10px 12px;
                        border-radius:8px;
                        background:rgba(248,113,113,0.12);
                        color:#f87171;
                        font-size:0.9rem;
                        font-weight:600;
                        text-align:center;
                    ">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <a href="{{ url('/auth/google/redirect') }}"
                    style="display:flex;align-items:center;gap:10px;justify-content:center;padding:12px;border-radius:10px;border:1px solid var(--glass-border);background:transparent;color:var(--text);font-weight:700;margin-bottom:12px;text-decoration:none;font-size:0.9rem;">
                    <img src="{{ asset('images/google-icon.png') }}" alt="Google"
                        style="width:20px;height:20px;object-fit:contain" onerror="this.style.display='none'">
                    Masuk dengan Google
                </a>

                <div style="text-align:center;color:var(--muted);margin:12px 0;font-size:0.85rem;">
                    atau masuk dengan email
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div style="margin-bottom:12px;">
                        <label for="email" style="display:block;font-weight:700;margin-bottom:6px;font-size:0.9rem;">
                            Email atau NIS
                        </label>
                        <input id="email" name="email" type="text" value="{{ old('email') }}" required
                            placeholder="Masukkan email atau NIS" autocomplete="email"
                            style="width:100%;padding:10px;border-radius:8px;border:1px solid var(--glass-border);background:transparent;color:var(--text);font-size:1rem;">
                        @error('email')
                            <div style="color:#f87171;margin-top:6px;font-size:0.85rem;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div style="margin-bottom:12px;">
                        <label for="password" style="display:block;font-weight:700;margin-bottom:6px;font-size:0.9rem;">
                            Kata Sandi
                        </label>
                        <div style="display:flex;gap:8px;">
                            <input id="password" name="password" type="password" required
                                placeholder="Masukkan kata sandi" autocomplete="current-password"
                                style="flex:1;padding:10px;border-radius:8px;border:1px solid var(--glass-border);background:transparent;color:var(--text);font-size:1rem;">
                            <button type="button" id="togglePw"
                                style="padding:8px 10px;border-radius:8px;border:1px solid var(--glass-border);background:transparent;color:var(--text);cursor:pointer;font-size:0.85rem;">
                                Tampilkan
                            </button>
                        </div>
                        @error('password')
                            <div style="color:#f87171;margin-top:6px;font-size:0.85rem;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:8px;font-size:0.9rem;">
                        <label style="display:flex;gap:8px;align-items:center;">
                            <input type="checkbox" name="remember"> Ingat saya
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="color:var(--accent-from);font-weight:700;">
                                Lupa kata sandi?
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                        style="width:100%;padding:12px;border-radius:10px;background:linear-gradient(135deg,var(--accent-from),var(--accent-to));color:#fff;font-weight:800;border:none;margin-top:14px;font-size:0.95rem;cursor:pointer;">
                        Masuk Sekarang
                    </button>
                </form>

                <p style="text-align:center;color:var(--muted);margin-top:12px;font-size:0.9rem;">
                    Belum punya akun?
                    <a href="{{ route('register') }}" style="color:var(--accent-from);font-weight:800;">
                        Daftar sekarang
                    </a>
                </p>
            </aside>
        </div>
    </div>

    <script>
        document.addEventListener('click', function(e) {
            if (e.target && e.target.id === 'togglePw') {
                const pw = document.getElementById('password');
                if (!pw) return;
                pw.type = pw.type === 'password' ? 'text' : 'password';
                e.target.textContent = pw.type === 'password' ? 'Tampilkan' : 'Sembunyikan';
            }
        });
    </script>
</x-guest-layout>