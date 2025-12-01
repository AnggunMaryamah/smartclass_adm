@extends('layouts.guru')

@section('title', 'Detail Kelas')

@section('content')
<div class="container">
    <h2>Detail Kelas: {{ $kelas->nama_kelas }}</h2>
    <p><strong>Jenjang:</strong> {{ $kelas->jenjang_pendidikan }}</p>
    <p><strong>Deskripsi:</strong> {{ $kelas->deskripsi }}</p>
    <p><strong>Harga:</strong> Rp {{ number_format($kelas->harga, 0, ',', '.') }}</p>
    <p><strong>Durasi:</strong> {{ $kelas->durasi }}</p>
    <p><strong>Jadwal:</strong> {{ $kelas->jadwal }}</p>
    <p><strong>Materi:</strong> {{ $kelas->materi }}</p>

    <a href="{{ route('guru.kelas') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
