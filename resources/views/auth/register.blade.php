<x-guest-layout>

    <div class="w-full max-w-6xl mx-auto py-14">
        <div class="grid grid-cols-1 md:grid-cols-2
                   gap-16
                   items-center">

            <!-- LEFT INFO -->
            <div
                class="hidden md:flex flex-col justify-center
                       p-12 rounded-2xl
                       bg-[var(--card-bg)]
                       border border-[var(--glass-border)]
                       shadow-[0_20px_60px_rgba(14,165,233,0.15)]">

                <h1 class="text-3xl font-extrabold leading-tight">
                    Buat Akun
                    <span class="block text-cyan-500 mt-1">
                        SmartClass
                    </span>
                </h1>

                <p class="mt-4 text-sm leading-relaxed text-[var(--muted)]">
                    Daftar untuk mengakses dashboard sesuai peranmu.
                    Pilih <strong>Guru</strong> atau <strong>Siswa</strong>
                    dan mulai perjalanan belajarmu bersama kami.
                </p>

                <ul class="mt-10 space-y-4 text-sm">
                    @foreach (['Dashboard sesuai peran', 'Sistem kelas & pembelajaran', 'Pembayaran & paket terintegrasi'] as $item)
                        <li class="flex items-start gap-4">
                            <span
                                class="w-9 h-9 flex items-center justify-center
                                       rounded-full
                                       bg-gradient-to-br from-cyan-400 to-blue-500
                                       text-white text-xs font-bold shrink-0">
                                ✓
                            </span>
                            <span class="text-[var(--text)]">
                                {{ $item }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- RIGHT FORM -->
            <div
                class="p-10 rounded-2xl
                       bg-[var(--card-bg)]
                       border border-[var(--glass-border)]
                       shadow-[0_20px_60px_rgba(14,165,233,0.15)]">

                <h2 class="text-2xl font-bold">
                    Daftar Akun
                </h2>

                <p class="mt-2 text-sm text-[var(--muted)]">
                    Lengkapi data berikut untuk melanjutkan.
                </p>

                <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
                    @csrf

                    @foreach ([['name', 'Nama Lengkap', 'text'], ['email', 'Email', 'email'], ['password', 'Password', 'password'], ['password_confirmation', 'Konfirmasi Password', 'password']] as [$field, $label, $type])
                        <div>
                            <x-input-label for="{{ $field }}" value="{{ $label }}" />

                            <x-text-input id="{{ $field }}" name="{{ $field }}" type="{{ $type }}"
                                required
                                class="mt-1 w-full rounded-lg
                                       bg-transparent
                                       border border-[var(--glass-border)]
                                       text-[var(--text)]
                                       focus:ring-2 focus:ring-cyan-400
                                       focus:border-transparent" />

                            <x-input-error :messages="$errors->get($field)" class="mt-1 text-xs text-rose-500" />
                        </div>
                    @endforeach

                    <div class="flex items-center justify-between pt-6">
                        <a href="{{ route('login') }}" class="text-sm text-[var(--muted)] hover:underline">
                            Sudah punya akun?
                        </a>

                        <button type="submit"
                            class="px-7 py-2.5 rounded-full
                                   font-semibold text-white
                                   bg-gradient-to-r from-cyan-400 to-blue-500
                                   hover:brightness-110 hover:scale-[1.03]
                                   transition">
                            Register
                        </button>
                    </div>
                </form>

                <p class="mt-8 text-xs text-[var(--muted)]">
                    Dengan mendaftar, kamu menyetujui
                    <span class="underline cursor-pointer">
                        syarat & ketentuan
                    </span>.
                </p>
            </div>

        </div>
    </div>

</x-guest-layout>