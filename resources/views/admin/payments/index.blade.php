@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Daftar Pembayaran</h2>

    <div class="bg-blue-50 rounded-md shadow-sm">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-blue-100 text-left">
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Nama Pembayar</th>
                    <th class="py-3 px-4">Email</th>
                    <th class="py-3 px-4">Paket</th>
                    <th class="py-3 px-4">Jumlah</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $index => $payment)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                        <td class="py-3 px-4">{{ $payment->payer_name }}</td>
                        <td class="py-3 px-4">{{ $payment->payer_email }}</td>
                        <td class="py-3 px-4">{{ $payment->package_name }}</td>
                        <td class="py-3 px-4">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">
                            @if ($payment->status == 'verified')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">Terverifikasi</span>
                            @elseif ($payment->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">Menunggu</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">Ditolak</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 flex gap-2">
                            <a href="{{ route('admin.payments.show', $payment->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Detail</a>
                            @if ($payment->status != 'verified')
                                <form action="{{ route('admin.payments.verify', $payment->id) }}" method="POST" onsubmit="return confirm('Verifikasi pembayaran ini?')">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">Verifikasi</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500">Belum ada data pembayaran</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
