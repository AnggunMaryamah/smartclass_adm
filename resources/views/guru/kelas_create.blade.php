@extends('layouts.guru')
@section('title', 'Tambah Kelas')

@section('content')
<div class="container">
    <h3>Tambah Kelas</h3>
    <form action="{{ route('guru.kelas.store') }}" method="POST">
        @csrf
        <input type="text" name="nama_kelas" placeholder="Nama Kelas" required>
        <textarea name="deskripsi" placeholder="Deskripsi"></textarea>
        <select name="jenjang_pendidikan" required>
            <option value="">--Pilih Jenjang--</option>
            <option value="SD">SD</option>
            <option value="SMP">SMP</option>
            <option value="SMA">SMA</option>
        </select>
        <input type="number" name="harga" placeholder="Harga / Biaya" required>
        <input type="text" name="durasi" placeholder="Durasi (contoh: 8 minggu)" required>
        <input type="text" name="jadwal" placeholder="Jadwal (contoh: Senin & Rabu, 16.00-18.00)">
        <textarea name="materi" placeholder="Materi Pembelajaran"></textarea>
        <button type="submit">Simpan</button>
    </form>
</div>
@endsection
