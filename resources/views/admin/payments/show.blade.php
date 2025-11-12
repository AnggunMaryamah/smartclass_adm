@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Detail Pembayaran</h2>

    <div class="bg-white p-6 rounded-md shadow-md max-w-2xl">
        <div class="mb-4">
            <p><strong>Nama Pembayar:</strong> {{ $payment->payer_name }}</p>
            <p><strong>Email:</strong> {{ $payment->payer_email }}</p>
            <p><strong>Paket:</strong> {{ $payment->package_name }}</p>
            <p><strong>Jumlah:</strong> Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
            <p><strong>Status:</strong>
                @if ($payment->status == 'verified')
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">Terverifikasi</span>
                @elseif ($payment->status == 'pending')
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">Menunggu</span>
                @else
                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">Ditolak</span>
                @endif
            </p>
            <p><strong>Tanggal Pembayaran:</strong> {{ $payment->created_at->format('d M Y, H:i') }}</p>
        </div>

        <div class="mb-4">
            <h3 class="font-semibold mb-2">Bukti Pembayaran:</h3>
            @if ($payment->proof)
                <img src="{{ asset('storage/' . $payment->proof) }}" alt="Bukti Pembayaran"
                     class="rounded-md border w-full max-w-md">
            @else
                <p class="text-gray-500">Tidak ada bukti pembayaran.</p>
            @endif
        </div>

        <div class="flex gap-3 mt-4">
            <a href="{{ route('admin.payments.index') }}"
               class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                Kembali
            </a>

            @if ($payment->status != 'verified')
                <form action="{{ route('admin.payments.verify', $payment->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin memverifikasi pembayaran ini?')">
                    @csrf
                    <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Verifikasi
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
