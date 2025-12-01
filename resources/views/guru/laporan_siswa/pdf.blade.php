<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Hasil Belajar - {{ $siswa->nama_lengkap }}</title>
    <style>
        body { font-family: 'Inter', Arial, sans-serif; font-size: 13px; background: #f5f7fa; color: #37474f; }
        .container {max-width:900px; margin:28px auto; background:#fff; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,.07); padding:40px;}
        .header { text-align: center; border-bottom:3px solid #1565c0; padding-bottom:16px; margin-bottom:28px;}
        .title { font-size:24px; font-weight:800; color:#1565c0; text-transform:uppercase; letter-spacing:0.5px;}
        .subtitle { font-size:15px; color:#546e7a; font-weight:500; margin-top:10px;}
        .section { margin-bottom:32px;}
        .section-title { font-weight:700; font-size:15px; color:#1565c0; padding:8px 0; border-radius:0; margin-bottom:17px; border:none; background:none; display:block;}
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #eceff1; padding: 9px 10px; font-size:13px; }
        th { background: #1565c0; color: #fff; font-weight:700;}
        .data-table td { border: none; padding: 9px 6px; }
        .data-table td:first-child { width:130px; color:#37474f; font-weight:700; }
        .badge { display: inline-block; padding: 5px 12px; border-radius: 5px; font-size:12px; font-weight:700; background: #e3f2fd; color: #1565c0;}
        .catatan-box { background: #fff8e1; border-left:4px solid #ff6f00; border-radius:9px; padding:18px 22px; font-size:14px; color:#37474f; margin-top:20px; margin-bottom:0; }
        .catatan-box strong { color:#1565c0; font-weight:700; }
        .footer { margin-top:40px; display:flex; justify-content:space-between; align-items:flex-end; font-size: 13px;}
        .signature-line { border-top:2px solid #263238; width:160px; margin-top:28px;}
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div class="title">LAPORAN HASIL BELAJAR SISWA</div>
        <div class="subtitle">Tahun Ajaran: {{ date('Y') }}/{{ date('Y')+1 }}</div>
    </div>

    <!-- DATA SISWA -->
    <div class="section">
        <div class="section-title">A. DATA SISWA</div>
        <table class="data-table">
            <tr><td>Nama Lengkap</td><td>: <strong>{{ $siswa->nama_lengkap ?? '-' }}</strong></td></tr>
            <tr><td>NIS / NISN</td><td>: {{ $siswa->nis ?? '-' }} / {{ $siswa->nisn ?? '-' }}</td></tr>
            <tr><td>Jenis Kelamin</td><td>: {{ $siswa->jenis_kelamin ?? '-' }}</td></tr>
            <tr><td>Jenjang</td><td>: {{ $siswa->jenjang_pendidikan ?? '-' }}</td></tr>
            <tr><td>Tanggal Lahir</td><td>: {{ $siswa->tanggal_lahir ?? '-' }}</td></tr>
            <tr><td>Alamat</td><td>: {{ $siswa->alamat ?? '-' }}</td></tr>
            <tr><td>Nama Ortu</td><td>: {{ $siswa->nama_orangtua ?? '-' }}</td></tr>
            <tr><td>Email</td><td>: {{ $siswa->email ?? '-' }}</td></tr>
        </table>
    </div>

    <!-- PERKEMBANGAN BELAJAR -->
    @php
        $nilai_awal = (!empty($laporan) && $laporan->count() > 0) ? $laporan->sortBy('created_at')->first()->nilai ?? 0 : 0;
        $nilai_akhir = (!empty($laporan) && $laporan->count() > 0) ? $laporan->sortByDesc('created_at')->first()->nilai ?? 0 : 0;
        $devel = $nilai_akhir - $nilai_awal;
        $rata = (!empty($laporan) && $laporan->count() > 0) ? round($laporan->avg('nilai'),1) : 0;
    @endphp
    <div class="section">
        <div class="section-title">B. PERKEMBANGAN BELAJAR</div>
        <table>
            <tr>
                <th>NILAI AWAL</th>
                <th>NILAI AKHIR</th>
                <th>PERKEMBANGAN</th>
            </tr>
            <tr>
                <td>{{ $nilai_awal }}</td>
                <td>{{ $nilai_akhir }}</td>
                <td>@if($devel>=0)+{{ $devel }} ↑@else{{ $devel }} ↓@endif</td>
            </tr>
        </table>
    </div>

    <!-- RIWAYAT PENILAIAN -->
    <div class="section">
        <div class="section-title">C. RIWAYAT PENILAIAN</div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Materi</th>
                    <th>Nilai</th>
                    <th>Predikat</th>
                    <th>Capaian Kompetensi</th>
                    <th>Catatan Guru</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan as $idx => $row)
                <tr>
                    <td>{{ $idx+1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($row->jenis_penilaian) }}</td>
                    <td>{{ $row->materi_pembelajaran }}</td>
                    <td style="color:#1565c0;font-weight:bold;">{{ $row->nilai }}</td>
                    <td><span class="badge">{{ $row->predikat }}</span></td>
                    <td>{{ $row->capaian_kompetensi }}</td>
                    <td>{{ $row->catatan }}</td>
                </tr>
                @empty
                <tr><td colspan="8" style="color:#999;">Belum ada data penilaian</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top:12px; text-align:left; font-size:14px; font-weight:600;">
            <span style="color:#546e7a;">Rata-rata nilai:</span>
            <span style="color:#2e7d32;font-weight:700;">{{ $rata }}</span>
        </div>
    </div>

    <!-- CATATAN UMUM GURU -->
    <div class="section">
        <div class="section-title">D. CATATAN UMUM GURU</div>
        <div class="catatan-box">
            <strong>Apresiasi:</strong> Siswa menunjukkan peningkatan nilai {{ $devel }} poin dari nilai awal ke nilai akhir.<br>
            <strong>Catatan lain:</strong> Penilaian dilakukan berdasarkan standar kompetensi, data riil hasil belajar, dan evaluasi harian yang <u>jujur dan profesional</u> oleh guru kelas/pendamping.<br>
            Laporan ini dinyatakan <strong style="color:#37474f;">resmi dan sah</strong> sebagai dokumentasi hasil belajar siswa.
        </div>
    </div>

    <div class="footer">
        <div>Dicetak pada: {{ date('d/m/Y H:i') }}</div>
        <div>
            <div>Guru Pembimbing:</div>
            <div class="signature-line"></div>
        </div>
    </div>
</div>
</body>
</html>
