@extends('layouts.siswa')

@section('content')
<div class="container">
    <h3>Riwayat Kuis</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Skor</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($riwayat as $item)
            <tr>
                <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                <td>{{ $item->skor }}</td>
                <td>
                    @if($item->lulus)
                        <span class="badge bg-success">Lulus</span>
                    @else
                        <span class="badge bg-danger">Tidak Lulus</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('siswa.kuis.result', $item->id) }}"
                       class="btn btn-sm btn-outline-primary">
                       Review
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
