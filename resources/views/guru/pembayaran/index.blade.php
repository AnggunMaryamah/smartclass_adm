@extends('layouts.guru')

@section('title', 'Kelola Pembayaran')

@section('content')
<style>
/* ===== STYLE LOKAL HALAMAN PEMBAYARAN ===== */

/* Banner sama seperti di Kelas Saya */
.payment-banner {
    background: linear-gradient(135deg,
        var(--sky-blue) 0%,
        var(--cyan) 33%,
        var(--teal) 66%,
        var(--sky-blue) 100%);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: var(--radius-xl);
    padding: 32px;
    margin-bottom: 28px;
    display: flex;
    align-items: center;
    gap: 24px;
    box-shadow: 0 8px 32px rgba(14, 165, 233, 0.3);
    position: relative;
    overflow: hidden;
}
.payment-banner .welcome-content { flex: 1; position: relative; z-index: 1; }
.payment-banner .welcome-content h2 {
    color: #fff; font-size: 1.75rem; font-weight: 700; margin: 0 0 8px 0;
}
.payment-banner .welcome-content p {
    color: rgba(255, 255, 255, 0.95); font-size: 1rem; margin: 0;
}
.payment-banner .welcome-decoration {
    position: absolute; top: 0; right: 0; width: 100%; height: 100%; pointer-events: none;
}
.payment-banner .deco-circle {
    position: absolute; border-radius: 50%; background: rgba(255, 255, 255, 0.12);
}
.payment-banner .deco-1 { width: 150px; height: 150px; top: -50px; right: 100px; animation: float 6s ease-in-out infinite; }
.payment-banner .deco-2 { width: 100px; height: 100px; top: 50%; right: -30px; animation: float 8s ease-in-out infinite; }
.payment-banner .deco-3 { width: 80px; height: 80px; bottom: -20px; right: 200px; animation: float 7s ease-in-out infinite; }

@keyframes float {
    0%,100% { transform: translateY(0); }
    50%     { transform: translateY(-20px); }
}

/* Stats 4 kartu */
.payment-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 28px;
}
.pay-stat-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.6);
    border-radius: var(--radius-lg);
    padding: 24px;
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.pay-stat-card::before {
    content: ''; position: absolute; top: 0; left: 0; bottom: 0;
    width: 5px; background: currentColor; transition: width 0.3s ease;
}
.pay-stat-card:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12); }
.pay-stat-card:hover::before { width: 8px; }
.pay-stat-title {
    font-size: 0.75rem; font-weight: 700; color: var(--text-secondary);
    margin: 0 0 12px 0; text-transform: uppercase; letter-spacing: 0.5px;
}
.pay-stat-number {
    font-size: 2.3rem; font-weight: 700; color: var(--text-primary);
    margin: 0 0 6px 0; line-height: 1;
}
.pay-stat-number-sm { font-size: 1.9rem; }
.pay-stat-label { font-size: 0.85rem; color: var(--text-secondary); }

/* Warna pastel */
.pay-stat-blue   { color: var(--sky-blue);  background: linear-gradient(135deg, var(--bg-blue),   rgba(255,255,255,0.98)); }
.pay-stat-teal   { color: var(--cyan);      background: linear-gradient(135deg, var(--bg-cyan),   rgba(255,255,255,0.98)); }
.pay-stat-green  { color: var(--teal);      background: linear-gradient(135deg, var(--bg-teal),   rgba(255,255,255,0.98)); }
.pay-stat-orange { color: var(--orange);    background: linear-gradient(135deg, var(--bg-orange), rgba(255,255,255,0.98)); }

/* Card konten utama */
.pay-card {
    background: #ffffff;
    border-radius: var(--radius-lg);
    border: 1px solid #e5edf7;
    box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
    padding: 18px 20px;
    margin-bottom: 20px;
}
.pay-card-header {
    display:flex;align-items:center;gap:10px;
    font-weight:700;font-size:1.05rem;color:#0b5cab;
    margin-bottom:6px;
}
.pay-card-header::before{
    content:'';width:8px;height:18px;border-radius:999px;background:var(--sky-blue);
}

/* Info kecil */
.pay-info-text {
    font-size: 13px;
    color: #64748b;
    margin-bottom: 4px;
}

/* QRIS layout */
.pay-flex{display:flex;flex-wrap:wrap;gap:18px}
.pay-qris-preview{flex:0 0 240px}
.pay-qris-empty{
    width:100%;min-height:240px;border-radius:16px;border:1px dashed #d7e1f0;
    background:linear-gradient(180deg,#f6fbff,#eef4ff);
    display:flex;align-items:center;justify-content:center;
    color:#8a9ab0;font-size:.95rem;text-align:center;padding:10px;
}
.pay-qris-img{
    max-width:240px;border-radius:16px;border:1px solid #dfe6f3;padding:10px;
    background:#fff;box-shadow:0 6px 18px rgba(15,23,42,.08);
}
.pay-qris-form{flex:1;min-width:260px}

/* Form */
.pay-form-grid{display:grid;gap:12px}
.pay-form-group label{
    display:block;font-size:13px;font-weight:700;color:var(--text-primary);margin-bottom:6px;
}
.pay-input{
    width:100%;
    border-radius:10px;
    border:1px solid #dde5f2;
    padding:11px 15px;
    font-size:14px;
    background:#fff;
    outline:none;
    transition:.18s ease;
}
.pay-input:focus{
    border-color:#38bdf8;
    box-shadow:0 0 0 1px #38bdf8,0 0 0 4px rgba(56,189,248,.22);
}
.pay-help{font-size:12px;color:#7a8aa0;margin-top:4px}

/* ===== TOMBOL (Pilih Gambar & Simpan) – konsisten ===== */
.pay-btn{
    border:none;
    border-radius:12px;
    padding:10px 18px;
    font-size:13px;
    font-weight:700;
    cursor:pointer;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    transition:.18s ease;
}
.pay-btn-primary{
    background: linear-gradient(135deg,#06b6d4,#0ea5e9);
    color:#fff;
    box-shadow:0 8px 20px rgba(8,145,178,.35);
}
.pay-btn-primary:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 28px rgba(8,145,178,.45);
}
.pay-btn-ghost{
    background:#f3f7ff;
    color:#0b5cab;
    border:1px solid #bae6fd;
}

/* File input */
.pay-file-row{display:flex;gap:10px;align-items:center;flex-wrap:wrap}
.pay-file-input{display:none}
.pay-file-icon{
    width:18px;height:18px;border-radius:999px;
    background:#fff;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    color:#0ea5e9;
    font-size:11px;
}

/* Tabel + dropdown filter seperti komponen Jenjang */
.pay-table-card{
    background:#fff;border-radius:var(--radius-lg);
    border:1px solid #e4edf8;box-shadow:0 6px 18px rgba(15,23,42,.06);
    padding:16px 18px;
}
.pay-table-head{
    display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;gap:10px;
}
.pay-table-title{font-weight:700;color:#0b5cab}

/* Wrapper dropdown */
.pay-filter-wrapper{
    position:relative;
    display:inline-flex;
    flex-direction:column;
    align-items:flex-end;
    gap:4px;
    font-size:12px;
    color:#6b7280;
}
.pay-filter-label{align-self:flex-end;}

.pay-filter-select{
    -webkit-appearance:none;appearance:none;
    border-radius:12px;
    border:2px solid #22c1ff;
    padding:8px 34px 8px 12px;
    font-size:13px;
    font-weight:600;
    color:#0b5cab;
    background:#ffffff;
    cursor:pointer;
    box-shadow:0 0 0 3px rgba(34,193,255,0.18);
    transition:.18s ease;
}
.pay-filter-select:focus{
    outline:none;
    box-shadow:0 0 0 3px rgba(34,193,255,0.3);
}
.pay-filter-select:hover{
    box-shadow:0 0 0 4px rgba(34,193,255,0.35);
}

/* icon panah */
.pay-filter-chevron{
    position:absolute;
    right:10px;
    bottom:9px;
    width:18px;height:18px;
    border-radius:999px;
    background:#0ea5e9;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    pointer-events:none;
    box-shadow:0 3px 8px rgba(14,165,233,.6);
}
.pay-filter-chevron svg{width:9px;height:9px;fill:#fff;}

.pay-table-wrap{overflow:auto;margin-top:4px}
.pay-table{width:100%;border-collapse:collapse;font-size:13px}
.pay-table thead th{
    background:linear-gradient(135deg,#0ea5e9,#0b75c9);color:#fff;
    padding:9px 9px;text-align:left;font-weight:700;position:sticky;top:0;
}
.pay-table tbody td{
    padding:9px 9px;border-bottom:1px solid #e6edf7;color:#1f2937;
}
.pay-table tbody tr:hover{background:#f7fbff}

/* Badge & aksi */
.pay-badge{
    display:inline-block;padding:4px 10px;border-radius:999px;font-size:11px;font-weight:700;
}
.pay-badge-menunggu{background:#fff3cd;color:#995c00}
.pay-badge-lunas   {background:#e7f6ee;color:#15803d}
.pay-badge-gagal   {background:#ffe2e5;color:#b91c1c}
.pay-actions{display:flex;flex-wrap:wrap;gap:6px}
.pay-btn-pill{
    border-radius:999px;padding:7px 12px;font-size:12px;font-weight:700;
    color:#fff;border:none;cursor:pointer;box-shadow:0 3px 10px rgba(15,23,42,.18);
    transition:.15s ease;
}
.pay-btn-pill:hover{transform:translateY(-1px);filter:brightness(1.03);}
.pay-btn-success{background:#16a34a}
.pay-btn-danger {background:#dc2626}
.pay-btn-view   {background:#0b5cab}

/* Responsive */
@media (max-width:1024px){
    .payment-stats{grid-template-columns:repeat(2,1fr);}
}
@media (max-width:640px){
    .payment-stats{grid-template-columns:1fr;}
    .pay-qris-preview{flex:1 1 100%}
    .pay-qris-img,.pay-qris-empty{max-width:100%}
}
</style>

{{-- Banner --}}
<div class="payment-banner">
    <div class="welcome-content">
        <h2>Kelola Pembayaran Kelas</h2>
        <p>Upload QRIS dan verifikasi pembayaran siswa yang telah transfer.</p>
    </div>
    <div class="welcome-decoration">
        <div class="deco-circle deco-1"></div>
        <div class="deco-circle deco-2"></div>
        <div class="deco-circle deco-3"></div>
    </div>
</div>

{{-- Stats --}}
<div class="payment-stats">
    <div class="pay-stat-card pay-stat-blue">
        <div>
            <h3 class="pay-stat-title">Total Transaksi</h3>
            <div class="pay-stat-number">{{ $totalPembayaran }}</div>
            <p class="pay-stat-label">Semua pembayaran tercatat</p>
        </div>
    </div>
    <div class="pay-stat-card pay-stat-teal">
        <div>
            <h3 class="pay-stat-title">Menunggu Verifikasi</h3>
            <div class="pay-stat-number pay-stat-number-sm">{{ $menunggu }}</div>
            <p class="pay-stat-label">Butuh pengecekan Anda</p>
        </div>
    </div>
    <div class="pay-stat-card pay-stat-green">
        <div>
            <h3 class="pay-stat-title">Lunas</h3>
            <div class="pay-stat-number pay-stat-number-sm">{{ $lunas }}</div>
            <p class="pay-stat-label">Pembayaran yang sudah beres</p>
        </div>
    </div>
    <div class="pay-stat-card pay-stat-orange">
        <div>
            <h3 class="pay-stat-title">Total Pemasukan</h3>
            <div class="pay-stat-number">Rp {{ number_format($totalPemasukan,0,',','.') }}</div>
            <p class="pay-stat-label">Akumulasi pembayaran lunas</p>
        </div>
    </div>
</div>

{{-- Notifikasi flash --}}
@if(session('success')) <div class="pay-info-text" style="color:#16a34a;">✔ {{ session('success') }}</div> @endif
@if(session('error'))   <div class="pay-info-text" style="color:#b91c1c;">✖ {{ session('error') }}</div>   @endif
@if($errors->any())
    <div class="pay-info-text" style="color:#b91c1c;">
        Terjadi kesalahan:
        <ul style="margin:4px 0 0 18px">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
    </div>
@endif

{{-- QRIS --}}
<div class="pay-card">
    <div class="pay-card-header">QRIS pembayaran Anda</div>

    <p class="pay-info-text">
        Siswa akan menggunakan QRIS ini untuk membayar kelas, lalu mengunggah bukti transfer pada halaman mereka.
    </p>
    @unless($guru->qris_image)
        <p class="pay-info-text" style="color:#b45309;">
            Anda belum mengupload QRIS. Siswa belum bisa membayar dengan benar.
        </p>
    @endunless

    <div class="pay-flex">
        <div class="pay-qris-preview">
            @if($guru->qris_image)
                <img src="{{ asset('storage/'.$guru->qris_image) }}" class="pay-qris-img" alt="QRIS">
            @else
                <div class="pay-qris-empty">Belum ada QRIS</div>
            @endif
        </div>

        <div class="pay-qris-form">
            <form action="{{ route('guru.pembayaran.upload_qris') }}" method="POST" enctype="multipart/form-data" class="pay-form-grid">
                @csrf

                <div class="pay-form-group">
                    <label>{{ $guru->qris_image ? 'Ganti QRIS (opsional)' : 'Upload QRIS *' }}</label>
                    <div class="pay-file-row">
                        <input id="qris_image" type="file" name="qris_image" class="pay-file-input" accept="image/*" {{ $guru->qris_image ? '' : 'required' }}>
                        <button type="button" class="pay-btn pay-btn-primary" onclick="document.getElementById('qris_image').click()">
                            Pilih Gambar
                        </button>
                        <span id="fileName" class="pay-help">Format PNG/JPG, maks 2 MB</span>
                    </div>
                </div>

                <div class="pay-form-group">
                    <label>Nama Bank / E‑Wallet *</label>
                    <input type="text"
                           name="qris_nama_bank"
                           class="pay-input"
                           value="{{ old('qris_nama_bank', $guru->qris_nama_bank) }}"
                           placeholder="Contoh: BCA, Mandiri, DANA, GoPay">
                    <div class="pay-help">Isi sesuai rekening / e‑wallet yang terhubung dengan QRIS.</div>
                </div>

                <div>
                    <button type="submit" class="pay-btn pay-btn-primary">
                        Simpan QRIS
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Tabel Pembayaran --}}
<div class="pay-table-card">
    <div class="pay-table-head">
        <div class="pay-table-title">Daftar Pembayaran Siswa</div>
        <div class="pay-filter-wrapper">
            <span class="pay-filter-label">Filter status</span>
            <select id="filterStatus" class="pay-filter-select" onchange="filterTable()">
                <option value="">Semua status</option>
                <option value="menunggu">Menunggu</option>
                <option value="lunas">Lunas</option>
                <option value="gagal">Gagal</option>
            </select>
            <div class="pay-filter-chevron">
                <svg viewBox="0 0 20 20">
                    <path d="M5 7l5 6 5-6H5z"></path>
                </svg>
            </div>
        </div>
    </div>

    @if($pembayarans->count())
        <div class="pay-table-wrap">
            <table class="pay-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach($pembayarans as $i => $bayar)
                        <tr data-status="{{ $bayar->status_pembayaran }}">
                            <td>{{ $i + 1 }}</td>
                            <td>{{ optional($bayar->created_at)->format('d/m/Y H:i') }}</td>
                            <td>{{ $bayar->pemesanan->siswa->nama_lengkap ?? '-' }}</td>
                            <td>{{ $bayar->pemesanan->kelas->nama_kelas ?? '-' }}</td>
                            <td><strong>Rp {{ number_format($bayar->nominal_pembayaran,0,',','.') }}</strong></td>
                            <td>
                                <span class="pay-badge pay-badge-{{ $bayar->status_pembayaran }}">
                                    {{ ucfirst($bayar->status_pembayaran) }}
                                </span>
                            </td>
                            <td>
                                @if($bayar->bukti_pembayaran)
                                    <a href="{{ asset('storage/'.$bayar->bukti_pembayaran) }}" target="_blank"
                                       class="pay-btn-pill pay-btn-view">Lihat</a>
                                @else
                                    <span class="pay-help">Tidak ada</span>
                                @endif
                            </td>
                            <td class="pay-actions">
                                @if($bayar->status_pembayaran === 'menunggu')
                                    <form action="{{ route('guru.pembayaran.verify', $bayar->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="lunas">
                                        <button type="submit" class="pay-btn-pill pay-btn-success"
                                                onclick="return confirm('Tandai LUNAS?')">Lunas</button>
                                    </form>
                                    <form action="{{ route('guru.pembayaran.verify', $bayar->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="gagal">
                                        <button type="submit" class="pay-btn-pill pay-btn-danger"
                                                onclick="return confirm('Tolak pembayaran ini?')">Tolak</button>
                                    </form>
                                @else
                                    <span class="pay-help">
                                        Diverifikasi: {{ optional($bayar->verified_at)->format('d/m/Y H:i') ?? '-' }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="pay-help" style="padding-top:4px;">Belum ada data pembayaran dari siswa.</p>
    @endif
</div>

<script>
const input = document.getElementById('qris_image');
if (input) {
    input.addEventListener('change', function () {
        const el = document.getElementById('fileName');
        el.textContent = this.files && this.files[0]
            ? this.files[0].name
            : 'Format PNG/JPG, maks 2 MB';
    });
}

function filterTable(){
  const value = document.getElementById('filterStatus').value;
  document.querySelectorAll('#tableBody tr').forEach(tr=>{
    tr.style.display = (!value || tr.dataset.status === value) ? '' : 'none';
  });
}
</script>
@endsection
