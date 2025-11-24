@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="container">
        
        <!-- TAMBAHAN 1: Success Message -->
        @if(session('success'))
            <div style="background: #D1FAE5; color: #065F46; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: 600;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- TAMBAHAN 2: Header dengan Filter -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1 style="font-size: 24px; font-weight: 700; color: #0B1D51;">Daftar Pengguna</h1>
            
            <!-- Filter Dropdown -->
            <div style="display: flex; align-items: center; gap: 10px;">
                <label style="font-size: 14px; color: #666; font-weight: 500;">Filter Role:</label>
                <select id="filterRole" onchange="applyFilter()" style="padding: 10px 20px; border: 2px solid #E0E0E0; border-radius: 8px; font-size: 14px; cursor: pointer; background: white; font-weight: 600;">
                    <option value="semua" {{ ($filterRole ?? 'semua') == 'semua' ? 'selected' : '' }}>🌐 Semua</option>
                    <option value="admin" {{ ($filterRole ?? '') == 'admin' ? 'selected' : '' }}>👤 Admin</option>
                    <option value="guru" {{ ($filterRole ?? '') == 'guru' ? 'selected' : '' }}>👨‍🏫 Guru</option>
                    <option value="siswa" {{ ($filterRole ?? '') == 'siswa' ? 'selected' : '' }}>👨‍🎓 Siswa</option>
                </select>
            </div>
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

                            <!-- TAMBAHAN 3: Button Hapus -->
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus {{ $user->name }}?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- TAMBAHAN 4: Script untuk Filter -->
    <script>
        function applyFilter() {
            const role = document.getElementById('filterRole').value;
            window.location.href = '{{ route("admin.users") }}?role=' + role;
        }
    </script>

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

        /* TAMBAHAN 5: Style Button Hapus */
        .btn-hapus {
            background-color: #EF4444;
            color: white;
        }

        .btn-hapus:hover {
            background-color: #DC2626;
        }
    </style>
@endsection
