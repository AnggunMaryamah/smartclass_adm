@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<!-- Statistics Cards - COMPACT DESIGN (IKUT GAMBAR 2) -->
<div class="cards">
    <div class="card-info card-blue">
        <h4>Total Guru</h4>
        <h2>{{ $totalGuru }}</h2>
    </div>
    <div class="card-info card-cyan">
        <h4>Total Siswa</h4>
        <h2>{{ $totalSiswa }}</h2>
    </div>
    <div class="card-info card-lightblue">
        <h4>Kelas Aktif</h4>
        <h2>{{ $kelasAktif }}</h2>
    </div>
    <div class="card-info card-yellow">
        <h4>Transaksi</h4>
        <h2>Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</h2>
    </div>
</div>

<!-- Mini Stats Pemesanan Per Jenjang (SEDANG SIZE) -->
<div style="display: flex; gap: 15px; margin: 25px 0; justify-content: flex-start;">
    <div style="background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%); padding: 15px 25px; border-radius: 10px; min-width: 140px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
        <div style="font-size: 20px; margin-bottom: 5px;">🎒</div>
        <h3 style="font-size: 28px; color: #1976D2; margin: 5px 0; font-weight: 700;">{{ $statSD }}</h3>
        <p style="font-size: 13px; color: #666; margin: 0;">Pemesanan SD</p>
    </div>
    
    <div style="background: linear-gradient(135deg, #E8F5E9 0%, #C8E6C9 100%); padding: 15px 25px; border-radius: 10px; min-width: 140px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
        <div style="font-size: 20px; margin-bottom: 5px;">📚</div>
        <h3 style="font-size: 28px; color: #388E3C; margin: 5px 0; font-weight: 700;">{{ $statSMP }}</h3>
        <p style="font-size: 13px; color: #666; margin: 0;">Pemesanan SMP</p>
    </div>
    
    <div style="background: linear-gradient(135deg, #FFF3E0 0%, #FFE0B2 100%); padding: 15px 25px; border-radius: 10px; min-width: 140px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
        <div style="font-size: 20px; margin-bottom: 5px;">🎓</div>
        <h3 style="font-size: 28px; color: #F57C00; margin: 5px 0; font-weight: 700;">{{ $statSMA }}</h3>
        <p style="font-size: 13px; color: #666; margin: 0;">Pemesanan SMA</p>
    </div>
</div>

<!-- Tabel Pemesanan dengan Filter Jenjang -->
<div style="margin-top: 30px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="color: #1a1a1a; font-size: 20px; font-weight: 600;">📋 Data Pemesanan Kelas</h3>
        
        <!-- Filter Dropdown -->
        <div style="display: flex; align-items: center; gap: 10px;">
            <label style="font-size: 14px; color: #666; font-weight: 500;">Filter Jenjang:</label>
            <select id="filterJenjang" onchange="applyFilter()" style="padding: 8px 15px; border: 2px solid #E0E0E0; border-radius: 8px; font-size: 14px; cursor: pointer; background: white; outline: none;">
                <option value="semua" {{ $filterJenjang == 'semua' ? 'selected' : '' }}>🌐 Semua</option>
                <option value="sd" {{ $filterJenjang == 'sd' ? 'selected' : '' }}>🎒 SD</option>
                <option value="smp" {{ $filterJenjang == 'smp' ? 'selected' : '' }}>📚 SMP</option>
                <option value="sma" {{ $filterJenjang == 'sma' ? 'selected' : '' }}>🎓 SMA</option>
            </select>
        </div>
    </div>

    <!-- Tabel Pemesanan -->
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Jenjang</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemesananList as $index => $pemesanan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pemesanan->nama_siswa }}</td>
                    <td>{{ $pemesanan->nama_kelas }}</td>
                    <td>
                        <span style="background: 
                            @if($pemesanan->jenjang_pendidikan == 'SD') #E3F2FD; color: #1976D2;
                            @elseif($pemesanan->jenjang_pendidikan == 'SMP') #E8F5E9; color: #388E3C;
                            @else #FFF3E0; color: #F57C00;
                            @endif
                            padding: 5px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                            {{ $pemesanan->jenjang_pendidikan }}
                        </span>
                    </td>
                    <td>
                        <span style="background: {{ $pemesanan->status_pemesanan == 'booking' ? '#D1FAE5' : '#FEE2E2' }}; 
                                     color: {{ $pemesanan->status_pemesanan == 'booking' ? '#059669' : '#DC2626' }}; 
                                     padding: 5px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                            {{ ucfirst($pemesanan->status_pemesanan) }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($pemesanan->created_at)->format('d M Y, H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #999; padding: 30px;">
                        Tidak ada pemesanan untuk filter ini
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
function applyFilter() {
    const jenjang = document.getElementById('filterJenjang').value;
    window.location.href = '{{ route("admin.dashboard") }}?jenjang=' + jenjang;
}
</script>

@endsection
