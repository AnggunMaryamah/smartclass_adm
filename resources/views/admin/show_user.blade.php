@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<div class="container">
    <div class="form-card">
        <h2 class="form-title">Detail User</h2>

        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>

        {{-- tampilkan bukti atau dokumen sesuai role --}}
        @if($user->role === 'Guru')
            <p><strong>Dokumen CV:</strong>
                @if($user->bukti)
                    <a href="{{ asset('storage/' . $user->bukti) }}" target="_blank">Lihat CV</a>
                @else
                    Belum mengunggah CV
                @endif
            </p>
        @elseif($user->role === 'Siswa')
            <p><strong>Bukti Pembayaran:</strong>
                @if($user->bukti)
                    <a href="{{ asset('storage/' . $user->bukti) }}" target="_blank">Lihat Bukti</a>
                @else
                    Belum mengunggah bukti pembayaran
                @endif
            </p>
        @endif

        <p><strong>Status Akun:</strong> {{ $user->status_akun }}</p>

        {{-- tombol aktivasi akun --}}
        @if($user->status_akun === 'Nonaktif')
            <form action="{{ route('admin.users.activate', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-success">Aktifkan Akun</button>
            </form>
        @else
            <p><span class="badge badge-success">Akun Aktif</span></p>
        @endif

        <div class="form-actions">
            <a href="{{ route('admin.users') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>

<style>
.form-card {
    background-color: #fff;
    border-radius: 12px;
    padding: 24px 28px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    max-width: 500px;
    margin: auto;
}
.form-title {
    font-size: 1.5rem;
    color: #0B1D51;
    margin-bottom: 20px;
    font-weight: 700;
}
p {
    margin-bottom: 10px;
    color: #374151;
    font-size: 1rem;
}
.btn {
    padding: 8px 16px;
    border-radius: 6px;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: background-color 0.2s;
}
.btn-success {
    background-color: #10B981;
    color: #fff;
}
.btn-success:hover {
    background-color: #059669;
}
.btn-secondary {
    background-color: #9CA3AF;
    color: #fff;
}
.btn-secondary:hover {
    background-color: #6B7280;
}
.badge-success {
    background-color: #D1FAE5;
    color: #065F46;
    padding: 4px 8px;
    border-radius: 8px;
    font-weight: 600;
}
</style>
@endsection
