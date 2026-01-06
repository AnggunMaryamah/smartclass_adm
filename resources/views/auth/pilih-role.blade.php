<x-app-layout>
    <div class="max-w-4xl mx-auto py-16 text-center">
        <h1 class="text-3xl font-bold">Pilih Peran</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">
            <a href="{{ route('siswa.daftar') }}" class="p-8 border rounded-xl">
                Daftar Siswa
            </a>

            <a href="{{ route('guru.daftar') }}" class="p-8 border rounded-xl">
                Daftar Guru
            </a>
        </div>
    </div>
</x-app-layout>