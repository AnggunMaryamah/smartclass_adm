<x-guest-layout>

    <div class="w-full max-w-md mx-auto py-16">
        <div
            class="p-10 rounded-2xl
                   bg-[var(--card-bg)]
                   border border-[var(--glass-border)]
                   shadow-[0_20px_60px_rgba(14,165,233,0.15)]">

            <h2 class="text-2xl font-bold">
                Lupa Password
            </h2>

            <p class="mt-2 text-sm text-[var(--muted)] leading-relaxed">
                Masukkan alamat email yang terdaftar.
                Kami akan mengirimkan link untuk reset password kamu.
            </p>

            {{-- STATUS SESSION --}}
            @if (session('status'))
                <div
                    class="mt-4 p-3 rounded-lg text-sm
                           bg-cyan-50 text-cyan-700
                           theme-dark:bg-cyan-500/10
                           theme-dark:text-cyan-300">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" value="Email" />

                    <x-text-input id="email" type="email" name="email" required autofocus
                        autocomplete="username"
                        class="mt-1 w-full rounded-lg
                               bg-transparent
                               border border-[var(--glass-border)]
                               text-[var(--text)]
                               focus:ring-2 focus:ring-cyan-400
                               focus:border-transparent" />

                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-rose-500" />
                </div>

                <!-- ACTION -->
                <div class="flex items-center justify-between pt-4">
                    <a href="{{ route('login') }}" class="text-sm text-[var(--muted)] hover:underline">
                        Kembali ke login
                    </a>

                    <button type="submit"
                        class="px-6 py-2.5 rounded-full
                               font-semibold text-white
                               bg-gradient-to-r from-cyan-400 to-blue-500
                               hover:brightness-110 hover:scale-[1.03]
                               transition">
                        Kirim Link Reset
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-guest-layout>