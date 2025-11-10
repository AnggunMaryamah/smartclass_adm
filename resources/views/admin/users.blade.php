@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="container">
        <div class="flex justify-between mb-4">
            <h1 class="text-lg font-semibold">Daftar Pengguna</h1>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    @php
                        $status = $user->status_akun ?? 'Belum Aktif';
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role ?? 'Pengguna' }}</td>
                        <td>
                            <span class="status {{ $status === 'Aktif' ? 'aktif' : 'nonaktif' }}">
                                {{ $status }}
                            </span>
                        </td>
                        <td class="actions">
                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn-detail">Detail</a>

                            <form action="{{ route('admin.users.verifikasi', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                @if ($status === 'Belum Aktif')
                                    <button type="submit" class="btn-verif">Aktifkan</button>
                                @else
                                    <button type="submit" class="btn-nonaktif">Nonaktifkan</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .table th,
        .table td {
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid #e6e6e6;
        }

        .table thead {
            background-color: #e7f1ff;
            font-weight: 600;
            color: #0B1D51;
        }

        .table tbody tr:hover {
            background-color: #f9fafb;
        }

        .status {
            padding: 6px 10px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .status.aktif {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .status.nonaktif {
            background-color: #FEE2E2;
            color: #991B1B;
        }

        .actions a,
        .actions button {
            text-decoration: none;
            font-weight: 600;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.9rem;
            margin-right: 6px;
            transition: 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-detail {
            background-color: #60A5FA;
            color: white;
        }

        .btn-detail:hover {
            background-color: #2563EB;
        }

        .btn-verif {
            background-color: #34D399;
            color: white;
        }

        .btn-verif:hover {
            background-color: #059669;
        }

        .btn-nonaktif {
            background-color: #FBBF24;
            color: white;
        }

        .btn-nonaktif:hover {
            background-color: #D97706;
        }
    </style>
@endsection
