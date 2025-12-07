@extends('layouts.siswa')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="detail-container">
    <div class="payment-detail-card">

        {{-- JUDUL DI DALAM KOTAK --}}
        <div class="detail-title">
            <h1>Detail Pembayaran</h1>
            <p>Ringkasan pembayaran untuk kelas {{ $pembayaran->pemesanan->kelas->nama_kelas ?? '-' }}.</p>
        </div>

        {{-- STATUS BESAR --}}
        @php
            $status = $pembayaran->status_pembayaran;
            $labelStatus = ucfirst($status ?? 'Tidak diketahui');
            $statusClass = match ($status) {
                'lunas', 'berhasil' => 'pill-status pill-success',
                'gagal', 'ditolak'  => 'pill-status pill-danger',
                'menunggu'          => 'pill-status pill-warning',
                default             => 'pill-status pill-neutral',
            };
        @endphp

        <div class="detail-header">
            <span class="{{ $statusClass }}">
                {{ $labelStatus }}
            </span>
        </div>

        {{-- TAGIHAN YANG DIBAYAR --}}
        <section class="detail-section">
            <h2>Tagihan yang dibayar</h2>
            <div class="detail-row between">
                <div>
                    <div class="detail-main">
                        {{ $pembayaran->pemesanan->kelas->nama_kelas ?? 'Kelas tidak tersedia' }}
                    </div>
                    @if (! empty($pembayaran->pemesanan?->kode))
                        <div class="detail-sub">
                            Kode pemesanan: {{ $pembayaran->pemesanan->kode }}
                        </div>
                    @endif
                </div>
                <div class="detail-amount">
                    Rp {{ number_format($pembayaran->nominal_pembayaran ?? 0, 0, ',', '.') }}
                </div>
            </div>
        </section>

        {{-- METODE PEMBAYARAN (diambil dari database) --}}
        <section class="detail-section">
            <h2>Metode Pembayaran</h2>
            <div class="detail-row">
                <div>
                    <div class="detail-main">
                        {{ $pembayaran->metode_pembayaran ?? 'QRIS' }}
                    </div>
                    <div class="detail-sub">
                        @if ($pembayaran->qris_reference)
                            Ref: {{ $pembayaran->qris_reference }}
                        @else
                            Scan QRIS kemudian upload bukti pembayaran.
                        @endif
                    </div>
                </div>
            </div>
        </section>

        {{-- RINCIAN PEMBAYARAN --}}
        @php
            $nominal    = $pembayaran->nominal_pembayaran ?? 0;
            $biayaAdmin = 0;
            $total      = $nominal + $biayaAdmin;
        @endphp
        <section class="detail-section">
            <h2>Rincian Pembayaran</h2>
            <div class="detail-row between">
                <span>Nominal</span>
                <span>Rp {{ number_format($nominal, 0, ',', '.') }}</span>
            </div>
            <div class="detail-row between">
                <span>Biaya Admin</span>
                <span>Rp {{ number_format($biayaAdmin, 0, ',', '.') }}</span>
            </div>
            <hr class="detail-divider">
            <div class="detail-row between total">
                <span>Total Tagihan</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </section>

        {{-- BUKTI PEMBAYARAN DI BAWAH --}}
        <section class="detail-section">
            <h2>Bukti Pembayaran</h2>
            @if ($pembayaran->bukti_pembayaran)
                <div class="receipt-wrapper">
                    <img
                        src="{{ asset('storage/'.$pembayaran->bukti_pembayaran) }}"
                        alt="Bukti pembayaran"
                        class="receipt-image"
                    >
                </div>
                <p class="detail-sub text-center">
                    Jika gambar kurang jelas, kamu bisa zoom di browser atau download dari menu klik kanan.
                </p>
            @else
                <p class="detail-sub">
                    Belum ada bukti pembayaran yang diupload.
                </p>
            @endif
        </section>

        <div class="detail-footer">
            <a href="{{ route('siswa.pembayaran.index') }}" class="detail-back-link">
                &larr; Kembali ke Riwayat Pembayaran
            </a>
        </div>
    </div>
</div>

<style>
/* container lebih sempit & ada padding kiri kanan supaya konten agak ke tengah */
.detail-container{
    max-width: 960px;
    margin: 0 auto 2rem;
    padding: 0 2rem;
}

/* kartu detail */
.payment-detail-card{
    background:#fff;
    border-radius:18px;
    border:1px solid #E2E8F0;
    box-shadow:0 4px 18px rgba(15,23,42,.08);
    padding:1.75rem 2.5rem 1.9rem;
}

/* judul di dalam kartu dan di tengah */
.detail-title{
    text-align:center;
    margin-bottom:1.25rem;
}
.detail-title h1{
    font-size:1.6rem;
    font-weight:700;
    color:#111827;
    margin:0 0 .25rem;
}
.detail-title p{
    font-size:.95rem;
    color:#6B7280;
    margin:0;
}

.detail-header{
    display:flex;
    justify-content:flex-start;
    margin-bottom:1.25rem;
}

/* pill status */
.pill-status{
    display:inline-flex;
    align-items:center;
    padding:.4rem .9rem;
    border-radius:999px;
    font-size:.85rem;
    font-weight:700;
}
.pill-success{background:#DCFCE7;color:#15803D;}
.pill-warning{background:#FEF3C7;color:#B45309;}
.pill-danger{background:#FEE2E2;color:#B91C1C;}
.pill-neutral{background:#E5E7EB;color:#4B5563;}

.detail-section{margin-bottom:1.4rem;}
.detail-section h2{
    font-size:.95rem;
    font-weight:700;
    color:#111827;
    margin-bottom:.6rem;
}

.detail-row{
    display:flex;
    align-items:flex-start;
    gap:.75rem;
    font-size:.9rem;
    color:#374151;
}
.detail-row.between{justify-content:space-between;}

.detail-main{font-weight:600;color:#111827;}
.detail-sub{font-size:.85rem;color:#6B7280;margin-top:.1rem;}
.detail-amount{font-weight:700;color:#111827;}

.detail-divider{
    border:none;
    border-top:1px dashed #D1D5DB;
    margin:.6rem 0;
}
.detail-row.total span:first-child{font-weight:700;}
.detail-row.total span:last-child{font-weight:700;color:#111827;}

.receipt-wrapper{
    border-radius:12px;
    border:1px solid #E5E7EB;
    padding:.75rem;
    background:#F9FAFB;
    display:flex;
    justify-content:center;
}
.receipt-image{
    max-width:100%;
    height:auto;
    border-radius:8px;
}

.detail-footer{
    margin-top:1.5rem;
    text-align:right;
}
.detail-back-link{
    font-size:.85rem;
    font-weight:600;
    color:#0369A1;
    text-decoration:none;
}
.detail-back-link:hover{text-decoration:underline;}

.text-center{text-align:center;}

@media(max-width:768px){
    .detail-container{padding:0 1rem;}
    .payment-detail-card{padding:1.4rem 1.25rem 1.6rem;}
    .detail-title h1{font-size:1.4rem;}
}
</style>
@endsection
