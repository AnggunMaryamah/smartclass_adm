@extends('layouts.siswa')

@section('title', 'Riwayat Pembayaran')

@section('content')
<div class="academy-container">

    {{-- HERO / BANNER WELCOME --}}
    <div class="academy-hero">
        <div class="hero-decoration">
            <div class="deco-cube cube-1"></div>
            <div class="deco-cube cube-2"></div>
            <div class="deco-cube cube-3"></div>
        </div>
        <div class="hero-content">
            <h1>Riwayat Pembayaran</h1>
            <p>Lihat semua pembayaran kelas yang pernah kamu lakukan di SmartClass.</p>
        </div>
    </div>

    {{-- KONTEN UTAMA: TABEL RIWAYAT --}}
    <div class="payment-card">
        <div class="payment-card-header">
            <h2>Daftar Pembayaran</h2>
            <p>Data pembayaran terbaru akan muncul di bagian paling atas.</p>
        </div>

        <div class="payment-table-wrapper">
            @if ($pembayaranList->count())
                <table class="payment-table">
                    <thead>
                        <tr>
                            <th class="col-kelas">Kelas</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembayaranList as $pembayaran)
                            @php
                                $status = $pembayaran->status_pembayaran;
                                $statusClass = match ($status) {
                                    'lunas' => 'status-badge status-success',
                                    'berhasil' => 'status-badge status-success',
                                    'gagal', 'ditolak' => 'status-badge status-danger',
                                    'menunggu' => 'status-badge status-warning',
                                    default => 'status-badge status-neutral',
                                };
                            @endphp
                            <tr>
                                {{-- Nama kelas + kode pemesanan --}}
                                <td class="col-kelas">
                                    <div class="cell-title">
                                        {{ $pembayaran->pemesanan->kelas->nama_kelas ?? 'Kelas tidak tersedia' }}
                                    </div>
                                    @if (! empty($pembayaran->pemesanan?->kode))
                                        <div class="cell-sub">
                                            Kode pemesanan:
                                            <span class="cell-code">
                                                {{ $pembayaran->pemesanan->kode }}
                                            </span>
                                        </div>
                                    @endif
                                </td>

                                {{-- Tanggal pembayaran --}}
                                <td>
                                    {{ $pembayaran->tanggal_pembayaran
                                        ? $pembayaran->tanggal_pembayaran->format('d M Y')
                                        : '-' }}
                                </td>

                                {{-- Nominal --}}
                                <td class="text-right">
                                    Rp {{ number_format($pembayaran->nominal_pembayaran ?? 0, 0, ',', '.') }}
                                </td>

                                {{-- Status --}}
                                <td>
                                    <span class="{{ $statusClass }}">
                                        {{ ucfirst($status ?? 'Tidak diketahui') }}
                                    </span>
                                </td>

                                {{-- Link ke detail pembayaran + bukti --}}
                                <td>
                                    <a
                                        href="{{ route('siswa.pembayaran.show', $pembayaran->id) }}"
                                        class="detail-link"
                                    >
                                        Lihat Bukti
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                {{-- EMPTY STATE SEDERHANA --}}
                <div class="empty-payments">
                    <div class="empty-icon">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <h3>Belum ada riwayat pembayaran</h3>
                    <p>
                        Setelah kamu melakukan pembayaran kelas, informasi dan statusnya
                        akan tampil otomatis di halaman ini.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- CSS KHUSUS HALAMAN PEMBAYARAN --}}
<style>
.academy-container{max-width:1200px;margin:0 auto;padding:0 1rem;}
.academy-hero{position:relative;background:linear-gradient(135deg,#0EA5E9,#38BDF8,#22C55E);border-radius:20px;padding:24px 28px;margin-bottom:1.5rem;overflow:hidden;color:#fff;box-shadow:0 10px 32px rgba(14,165,233,.35);}
.hero-decoration{position:absolute;inset:0;overflow:hidden;pointer-events:none;}
.deco-cube{position:absolute;background:rgba(255,255,255,.1);border-radius:6px;animation:float 6s ease-in-out infinite;}
.cube-1{width:50px;height:50px;top:15%;right:8%;}
.cube-2{width:35px;height:35px;top:50%;right:18%;animation-delay:2s;}
.cube-3{width:42px;height:42px;top:35%;right:5%;animation-delay:4s;}
@keyframes float{0%,100%{transform:translateY(0) rotate(0)}50%{transform:translateY(-15px) rotate(8deg)}}
.hero-content{position:relative;z-index:1;}
.hero-content h1{font-size:1.75rem;font-weight:700;margin-bottom:.25rem;text-shadow:0 2px 4px rgba(0,0,0,.1);}
.hero-content p{font-size:.95rem;opacity:.95;margin:0;}

/* KARTU RIWAYAT PEMBAYARAN */
.payment-card{background:#fff;border-radius:18px;box-shadow:0 4px 18px rgba(15,23,42,.08);border:1px solid #E2E8F0;margin-bottom:2rem;overflow:hidden;}
.payment-card-header{padding:1.25rem 1.5rem 0.75rem;border-bottom:1px solid #E2E8F0;}
.payment-card-header h2{font-size:1.25rem;font-weight:700;color:#1F2937;margin:0 0 .25rem;}
.payment-card-header p{font-size:.9rem;color:#64748B;margin:0;}
.payment-table-wrapper{padding:1.25rem 1.5rem 1.4rem;}

/* TABEL: mirip tabel kelas, garis antar kolom dan rata tengah */
.payment-table{width:100%;border-collapse:separate;border-spacing:0;font-size:.9rem;color:#1F2937;}
.payment-table thead{background:#F9FAFB;}
.payment-table th,
.payment-table td{
    padding:.75rem 1rem;
    border-bottom:1px solid #E5E7EB;
    text-align:center;
    vertical-align:middle;
}
.payment-table th:first-child{border-top-left-radius:10px;}
.payment-table th:last-child{border-top-right-radius:10px;}
.payment-table tbody tr:hover{background:#F9FAFB;}
.payment-table td.text-right{text-align:right;}
.payment-table th:not(:last-child),
.payment-table td:not(:last-child){
    border-right:1px solid #E5E7EB;
}

/* kolom kelas tetap rata kiri */
.payment-table th.col-kelas,
.payment-table td.col-kelas{
    text-align:left;
}

/* TEKS DI DALAM KOLOM KELAS */
.cell-title{font-weight:600;color:#111827;}
.cell-sub{font-size:.8rem;color:#64748B;margin-top:.15rem;}
.cell-code{font-family:'Inter',system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;font-size:.8rem;color:#0F766E;}

/* STATUS BADGE DENGAN WARNA BERBEDA */
.status-badge{display:inline-flex;align-items:center;gap:.3rem;padding:.25rem .7rem;border-radius:999px;font-size:.78rem;font-weight:600;}
.status-badge::before{content:'';width:6px;height:6px;border-radius:999px;background:currentColor;}
.status-success{background:#ECFDF3;color:#16A34A;}   /* Lunas: hijau */
.status-warning{background:#FEF3C7;color:#D97706;}   /* Menunggu: kuning */
.status-danger{background:#FEF2F2;color:#DC2626;}    /* Gagal/Ditolak: merah */
.status-neutral{background:#E5E7EB;color:#4B5563;}

/* LINK DETAIL BUKTI PEMBAYARAN */
.detail-link{display:inline-flex;align-items:center;gap:.25rem;padding:.3rem .8rem;border-radius:999px;font-size:.8rem;font-weight:600;color:#0369A1;background:#E0F2FE;text-decoration:none;transition:.2s;}
.detail-link:hover{background:#BAE6FD;color:#075985;}

/* EMPTY STATE */
.empty-payments{text-align:center;padding:3rem 1.5rem;}
.empty-icon{width:120px;height:120px;margin:0 auto 1.5rem;border-radius:50%;background:radial-gradient(circle at 30% 20%,rgba(148,197,255,.45),rgba(59,130,246,.08));display:flex;align-items:center;justify-content:center;animation:float 4s ease-in-out infinite;}
.empty-icon i{font-size:2.6rem;color:#2563EB;text-shadow:0 6px 18px rgba(15,23,42,.25);}
.empty-payments h3{font-size:1.15rem;color:#1F2937;font-weight:600;margin-bottom:.5rem;}
.empty-payments p{font-size:.9rem;color:#6B7280;margin:0;}

/* RESPONSIVE */
@media(max-width:768px){
    .academy-hero{padding:1.4rem 1.1rem;border-radius:16px;margin-bottom:1.25rem;}
    .hero-content h1{font-size:1.5rem;}
    .academy-container{padding:0 .75rem;}
    .payment-card-header,
    .payment-table-wrapper{padding:1rem;}
    .payment-table th,
    .payment-table td{padding:.6rem .7rem;}
}
</style>
@endsection
