@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-8 bg-white/10 backdrop-blur rounded-lg mt-10">
    <h2 class="text-2xl font-bold mb-3">Akun Sedang Diverifikasi</h2>
    <p class="text-gray-300">
        Terima kasih telah mendaftar sebagai <strong>Guru</strong>.
        Akun Anda sedang menunggu persetujuan admin.
        Anda akan diberi notifikasi jika akun sudah aktif.
    </p>

    <a href="/" class="mt-5 inline-block text-blue-400 underline hover:text-blue-300">
        Kembali ke beranda
    </a>
</div>
@endsection