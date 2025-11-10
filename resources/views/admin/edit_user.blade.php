@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container">
    <div class="form-card">
        <h2 class="form-title">Edit User</h2>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-input">
                    <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Guru" {{ $user->role === 'Guru' ? 'selected' : '' }}>Guru</option>
                    <option value="Siswa" {{ $user->role === 'Siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-input">
                    <option value="Aktif" {{ $user->status === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Nonaktif" {{ $user->status === 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-warning">Perbarui</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<style>
/* Gunakan style sama seperti form tambah */
.form-card {
    background-color: #fff;
    border-radius: 12px;
    padding: 24px 28px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    max-width: 600px;
    margin: auto;
}
.form-title {
    font-size: 1.5rem;
    color: #0B1D51;
    margin-bottom: 20px;
    font-weight: 700;
}
.form-group { margin-bottom: 16px; }
.form-group label { display: block; font-weight: 600; margin-bottom: 6px; color: #374151; }
.form-input { width: 100%; border: 1px solid #D1D5DB; border-radius: 8px; padding: 10px 12px; font-size: 0.95rem; transition: border-color 0.2s, box-shadow 0.2s; }
.form-input:focus { border-color: #3B82F6; box-shadow: 0 0 0 2px #BFDBFE; outline: none; }
.form-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px; }
.btn { padding: 8px 16px; border-radius: 6px; font-weight: 600; text-decoration: none; border: none; cursor: pointer; transition: background-color 0.2s; }
.btn-warning { background-color: #FBBF24; color: white; }
.btn-warning:hover { background-color: #D97706; }
.btn-secondary { background-color: #9CA3AF; color: #fff; }
.btn-secondary:hover { background-color: #6B7280; }
</style>
@endsection
