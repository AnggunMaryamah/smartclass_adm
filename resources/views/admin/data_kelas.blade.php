@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4"> Data Kelas Bimbel</h2>
    <table class="table table-striped table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>Nama Kelas</th>
                <th>Durasi Mengajar</th>
                <th>Tahun Ajaran</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $kelas)
                <tr>
                    <td>{{ $kelas->nama_guru }}</td>
                    <td>{{ $kelas->nama_kelas }}</td>
                    <td>{{ $kelas->durasi_mengajar }}</td>
                    <td>{{ $kelas->tahun_ajaran }}</td>
                    <td>{{ $kelas->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection