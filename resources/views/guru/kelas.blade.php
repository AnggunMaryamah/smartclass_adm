@extends('guru.layouts.guru')

@section('title', 'Data Kelas')

@section('content')
<div class="dashboard-container">
    <h1 class="text-2xl font-bold text-[#0B1D51]">Kelas Saya</h1>
    <p class="text-gray-600 mb-4">Daftar kelas yang dikelola oleh guru.</p>

    <div class="card card-cyan">
        <h3>Belum ada kelas ditambahkan.</h3>
        <p>Silakan tambahkan data kelas untuk mulai mengajar.</p>
    </div>
</div>
@endsection
