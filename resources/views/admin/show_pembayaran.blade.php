@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Detail Pembayaran</h2>

    <div class="bg-white p-6 rounded-md shadow max-w-2xl">

        <div class="mb-3">
            <strong>ID Pembayaran:</strong>
            <p>{{ $pembayaran->id }}</p>
        </div>

        <div class="mb-3">
            <strong>ID Pemesanan:</strong>
            <p>{{ $pembayaran->pemesanan_id }}</p>
        </div>

        <div class="mb-3">
            <strong>Tanggal Pembayaran:</strong>
            <p>{{ $pembayaran->tanggal_pembayaran ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <strong>QRIS Reference:</strong>
            <p>{{ $pembayaran->qris_reference ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <strong>Nominal Pembayaran:</strong>
            <p>Rp {{ number_format($pembayaran->nominal_pembayaran, 2, ',', '.') }}</p>
        </div>

        <div class="mb-3">
            <strong>Status Pembayaran:</strong>
            <p class="capitalize">
                {{ $pembayaran->status_pembayaran }}
            </p>
        </div>

        <div class="mb-3">
            <strong>Bukti Pembayaran:</strong><br>
            @if($pembayaran->bukti_pembayaran)
                <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
                     alt="Bukti Pembayaran"
                     class="w-48 rounded shadow">
            @else
                <p>- Tidak ada bukti pembayaran -</p>
            @endif
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.pembayaran.index') }}"
               class="px-4 py-2 bg-gray-700 text-white rounded">
                Kembali
            </a>
        </div>

    </div>
</div>
@endsection
