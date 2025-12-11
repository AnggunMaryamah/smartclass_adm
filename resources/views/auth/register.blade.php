<x-guest-layout>
    <div
        class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[linear-gradient(180deg,#071827_0%,#071427_100%)]">
        <div class="w-full max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
                <!-- LEFT: illustration / headline (hidden on small screens) -->
                <div
                    class="hidden md:flex flex-col justify-center px-6 py-8 bg-gradient-to-b from-[#071827]/40 to-[#042232]/30 rounded-2xl shadow-lg">
                    <div class="mb-6">
                        <h1 class="text-3xl font-extrabold text-white">Buat Akun Baru</h1>
                        <p class="mt-2 text-sm text-slate-200/80">Daftar untuk mengakses dashboard sesuai peranmu. Pilih
                            <span class="font-medium">Guru</span> jika kamu ingin mengajar, atau <span
                                class="font-medium">Siswa</span> jika ingin ikut belajar.</p>
                    </div>

                    <ul class="space-y-3 mt-6 text-sm text-slate-300">
                        <li class="flex items-start gap-3">
                            <span
                                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-cyan-400 to-blue-500 text-white text-xs font-semibold">✓</span>
                            <span>Dashboard khusus peran</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span
                                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-cyan-400 to-blue-500 text-white text-xs font-semibold">✓</span>
                            <span>Pembuatan & pengelolaan kelas (guru)</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span
                                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-cyan-400 to-blue-500 text-white text-xs font-semibold">✓</span>
                            <span>Pendaftaran paket & pembayaran</span>
                        </li>
                    </ul>
                </div>

                <!-- RIGHT: form -->
                <div class="bg-white/5 backdrop-blur-md border border-white/6 rounded-2xl shadow-lg p-6 sm:p-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-white">Daftar Akun</h2>
                        <p class="mt-1 text-sm text-slate-300">Isi data di bawah untuk membuat akun baru.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-sm text-slate-200" />
                            <x-text-input id="name"
                                class="mt-1 block w-full rounded-lg border border-white/10 bg-transparent text-white placeholder-white/60 py-3 px-4 focus:ring-2 focus:ring-cyan-400 focus:border-transparent"
                                type="text" name="name" :value="old('name')" required autofocus
                                autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-rose-400" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-sm text-slate-200" />
                            <x-text-input id="email"
                                class="mt-1 block w-full rounded-lg border border-white/10 bg-transparent text-white placeholder-white/60 py-3 px-4 focus:ring-2 focus:ring-cyan-400 focus:border-transparent"
                                type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-rose-400" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" class="text-sm text-slate-200" />
                            <x-text-input id="password"
                                class="mt-1 block w-full rounded-lg border border-white/10 bg-transparent text-white placeholder-white/60 py-3 px-4 focus:ring-2 focus:ring-cyan-400 focus:border-transparent"
                                type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-rose-400" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')"
                                class="text-sm text-slate-200" />
                            <x-text-input id="password_confirmation"
                                class="mt-1 block w-full rounded-lg border border-white/10 bg-transparent text-white placeholder-white/60 py-3 px-4 focus:ring-2 focus:ring-cyan-400 focus:border-transparent"
                                type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-rose-400" />
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-slate-200">Role</label>
                            <select id="role" name="role" required
                                class="mt-1 block w-full rounded-lg border border-white/10 bg-transparent text-white py-3 px-4 focus:ring-2 focus:ring-cyan-400 focus:border-transparent">
                                <option value="">-- Pilih Role --</option>
                                <option value="guru" {{ old('role') === 'guru' ? 'selected' : '' }}>Guru</option>
                                <option value="siswa" {{ old('role') === 'siswa' ? 'selected' : '' }}>Siswa</option>
                            </select>
                            @error('role')
                                <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mt-2">
                            <a class="text-sm text-slate-300 hover:underline" href="{{ route('login') }}">
                                Sudah punya akun?
                            </a>

                            <x-primary-button class="inline-flex items-center gap-2 px-5 py-2">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <!-- small note -->
                    <div class="mt-6 text-xs text-slate-400">
                        Dengan mendaftar kamu menyetujui <a href="#" class="underline">syarat & ketentuan</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            /* Slight shadow + backdrop tweak supaya konsisten */
            .backdrop-blur-md {
                backdrop-filter: blur(6px);
            }

            /* small screens: reduce card padding */
            @media (max-width: 640px) {
                .max-w-4xl {
                    padding: 0 12px;
                }
            }
        </style>
    @endpush
</x-guest-layout>