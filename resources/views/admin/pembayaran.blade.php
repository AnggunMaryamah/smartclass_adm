@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Pembayaran</h2>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel Data Pembayaran --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>Pemesan</th>
                    <th>Tanggal</th>
                    <th>QRIS Reference</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pembayarans as $item)
                    <tr class="text-center">
                        <td>{{ $item->pemesanan->nama ?? '-' }} - {{ $item->pemesanan->kelas ?? '-' }}</td>

                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('d M Y') }}</td>

                        <td>{{ $item->qris_reference }}</td>

                        <td>Rp {{ number_format($item->nominal_pembayaran, 0, ',', '.') }}</td>

                        <td>
                            @if($item->status_pembayaran == 'Berhasil')
                                <span class="badge bg-success">{{ $item->status_pembayaran }}</span>
                            @elseif($item->status_pembayaran == 'Pending')
                                <span class="badge bg-warning">{{ $item->status_pembayaran }}</span>
                            @else
                                <span class="badge bg-danger">{{ $item->status_pembayaran }}</span>
                            @endif
                        </td>

                        <td>
                            @if($item->bukti_pembayaran)
                                <a href="{{ asset($item->bukti_pembayaran) }}" target="_blank"
                                   class="btn btn-sm btn-secondary">Lihat</a>
                            @else
                                Tidak ada
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.pembayarans.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>

                            <form action="{{ route('admin.pembayarans.destroy', $item->id) }}"
                                  method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus pembayaran ini?')"
                                        class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="7">Belum ada data pembayaran.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection


   


