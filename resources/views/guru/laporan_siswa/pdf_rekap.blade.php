<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
        }
        .header p {
            margin: 5px 0;
            font-size: 11px;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }
        table td {
            padding: 8px 10px;
            border: 1px solid #ddd;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            background-color: #007bff;
            color: white;
            font-size: 10px;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>LAPORAN HASIL BELAJAR SISWA</h1>
        <p>Tanggal Cetak: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <!-- Info Siswa -->
    <div class="info">
        <p><strong>Nama Siswa:</strong> {{ $siswa->nama }}</p>
        <p><strong>NISN:</strong> {{ $siswa->nisn ?? '-' }}</p>
        <p><strong>Email:</strong> {{ $siswa->email ?? '-' }}</p>
        <p><strong>Kelas:</strong> {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
    </div>

    <!-- Tabel Laporan -->
    @if($laporan->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Materi Pembelajaran</th>
                    <th class="text-center">Nilai</th>
                    <th class="text-center">Predikat</th>
                    <th class="text-center">Kehadiran</th>
                    <th>Deskripsi</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporan as $item)
                    <tr>
                        <td>{{ $item->materi_pembelajaran }}</td>
                        <td class="text-center">{{ $item->nilai }}</td>
                        <td class="text-center">{{ $item->predikat }}</td>
                        <td class="text-center">{{ $item->kehadiran ?? '-' }} hari</td>
                        <td>{{ $item->deskripsi ?? '-' }}</td>
                        <td>{{ $item->catatan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; color: #999;">Belum ada laporan hasil belajar.</p>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p>Dicetak oleh: {{ Auth::user()->name ?? 'Admin' }}</p>
        <p>{{ now()->format('d F Y') }}</p>
    </div>
</body>
</html>
