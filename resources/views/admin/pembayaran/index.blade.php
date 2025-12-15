@extends('layouts.app')

@section('title', 'Kelola Pembayaran')

@section('content')
@php($admin = auth()->user())

<style>
:root{
    --primary:#0EA5E9;
    --primary-soft:#E0F2FE;
    --success:#10B981;
    --warning:#F59E0B;
    --danger:#EF4444;
    --text:#1F2937;
    --muted:#6B7280;
    --border:#E5E7EB;
    --bg:#F8FAFC;
}

.payment-container{
    max-width:1400px;
    margin:auto;
    padding:24px;
}

/* =======================
   STATISTIC CARDS
======================= */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:18px;
    margin-bottom:26px;
}
.stat-card{
    background:#fff;
    border-radius:14px;
    padding:18px;
    border-left:5px solid var(--primary);
}
.stat-card.wait{border-color:var(--warning)}
.stat-card.success{border-color:var(--success)}
.stat-card.money{border-color:#6366F1}

.stat-card h4{
    font-size:.75rem;
    color:var(--muted);
    margin-bottom:6px;
    text-transform:uppercase;
}
.stat-card strong{
    font-size:1.6rem;
    color:var(--text);
}

/* =======================
   QRIS SECTION
======================= */
.payment-section{
    background:#fff;
    border-radius:18px;
    padding:26px;
    margin-bottom:30px;
}

.qris-grid{
    display:grid;
    grid-template-columns:260px 1fr;
    gap:32px;
}

.qris-wrapper{
    aspect-ratio:1;
    border:2px dashed var(--border);
    border-radius:16px;
    background:#F0F9FF;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    position:relative;
}
.qris-wrapper.has-image{
    border-style:solid;
    background:#fff;
}
.qris-wrapper img{
    width:100%;
    height:100%;
    object-fit:contain;
    padding:12px;
}

.qris-placeholder{
    text-align:center;
    color:var(--muted);
}
.qris-placeholder svg{
    width:64px;
    height:64px;
    opacity:.4;
    margin-bottom:10px;
}

.qris-btns{
    position:absolute;
    top:10px;
    right:10px;
}
.qris-btn{
    background:var(--danger);
    color:#fff;
    border:none;
    border-radius:10px;
    width:36px;
    height:36px;
    cursor:pointer;
}

/* =======================
   FORM
======================= */
.form-group{margin-bottom:14px}
.form-input,.form-select{
    width:100%;
    padding:11px 14px;
    border-radius:10px;
    border:1px solid var(--border);
}
.btn-save{
    background:var(--primary);
    color:#fff;
    border:none;
    border-radius:10px;
    padding:11px 24px;
    font-weight:600;
}

/* =======================
   TABLE HEADER
======================= */
.table-header{
    background:var(--primary-soft);
    border:1px solid #BAE6FD;
    border-radius:12px;
    padding:14px 18px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:14px;
}
.table-header h4{
    font-size:.95rem;
    font-weight:600;
    color:#0369A1;
}
.filter-group{
    display:flex;
    gap:10px;
}

/* =======================
   TABLE
======================= */
.table-wrapper{
    background:#fff;
    border-radius:16px;
    overflow:hidden;
}
table{
    width:100%;
    border-collapse:collapse;
}
thead{
    background:linear-gradient(135deg,#0EA5E9,#06B6D4);
    color:#fff;
}
th,td{
    padding:14px;
    text-align:center;
    border-bottom:1px solid var(--border);
}
tbody tr:hover{background:#F9FAFB}

.badge{
    padding:6px 14px;
    border-radius:999px;
    font-size:.75rem;
    font-weight:600;
}
.badge-menunggu{background:#FEF3C7;color:#92400E}
.badge-lunas{background:#D1FAE5;color:#065F46}
.badge-gagal{background:#FEE2E2;color:#991B1B}

/* =======================
   MODAL
======================= */
.modal-overlay{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.5);
    display:none;
    z-index:50;
}
.modal{
    position:fixed;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
    background:#fff;
    border-radius:16px;
    padding:24px;
    display:none;
    z-index:51;
}
.modal.active,.modal-overlay.active{display:block}
</style>

<div class="payment-container">

    {{-- STAT --}}
    <div class="stats-grid">
        <div class="stat-card">
            <h4>Total Transaksi</h4>
            <strong>{{ $totalPembayaran }}</strong>
        </div>
        <div class="stat-card wait">
            <h4>Menunggu</h4>
            <strong>{{ $menunggu }}</strong>
        </div>
        <div class="stat-card success">
            <h4>Lunas</h4>
            <strong>{{ $lunas }}</strong>
        </div>
        <div class="stat-card money">
            <h4>Total Pemasukan</h4>
            <strong>Rp {{ number_format($totalNominal,0,',','.') }}</strong>
        </div>
    </div>

    {{-- QRIS --}}
    <div class="payment-section">
        <form action="{{ route('admin.qris.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="qris-grid">

                <div>
                    <h4>QRIS Pembayaran</h4>
                    <div id="qrisWrapper" class="qris-wrapper {{ $admin->qris_image ? 'has-image' : '' }}">
                        @if($admin->qris_image)
                            <img id="qrisPreview" src="{{ asset('storage/'.$admin->qris_image) }}">
                            <div class="qris-btns">
                                <button type="button" class="qris-btn" onclick="openDeleteQris()">🗑</button>
                            </div>
                        @else
                            <div class="qris-placeholder">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="7" height="7"/>
                                    <rect x="14" y="3" width="7" height="7"/>
                                    <rect x="3" y="14" width="7" height="7"/>
                                    <rect x="14" y="14" width="7" height="7"/>
                                </svg>
                                <p>Belum ada QRIS<br><small>Klik untuk upload</small></p>
                            </div>
                            <img id="qrisPreview" style="display:none">
                        @endif
                    </div>
                    <input type="file" name="qris_image" id="qrisInput" hidden>
                </div>

                <div>
                    <h4>Informasi Rekening</h4>

                    <div class="form-group">
                        <select name="bank" id="bankSelect" class="form-select" required>
                            <option value="">Pilih Bank / E-Wallet</option>
                            @foreach(['DANA','OVO','GoPay','BRI'] as $b)
                                <option value="{{ $b }}" {{ $admin->qris_nama_bank === $b ? 'selected' : '' }}>{{ $b }}</option>
                            @endforeach
                            <option value="other">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" name="nama_rekening" class="form-input"
                               value="{{ $admin->qris_nama_rekening }}"
                               placeholder="Nama Rekening" required>
                    </div>

                    <div class="form-group">
                        <input type="text" name="no_wa" class="form-input"
                               value="{{ $admin->no_wa }}"
                               placeholder="No WhatsApp" required>
                    </div>

                    <button class="btn-save">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    {{-- HEADER TABLE --}}
    <div class="table-header">
        <h4>Daftar Pembayaran Siswa</h4>
        <div class="filter-group">
            <select class="form-select">
                <option>Semua Status</option>
                <option>Menunggu</option>
                <option>Lunas</option>
                <option>Gagal</option>
            </select>
            <button class="btn-save">Terapkan</button>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($pembayarans as $i=>$p)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ optional($p->created_at)->format('d/m/Y') }}</td>
                    <td>{{ $p->siswa->nama_lengkap ?? '-' }}</td>
                    <td>{{ $p->kelas->nama_kelas ?? '-' }}</td>
                    <td>Rp {{ number_format($p->nominal_pembayaran,0,',','.') }}</td>
                    <td><span class="badge badge-{{ $p->status_pembayaran }}">{{ ucfirst($p->status_pembayaran) }}</span></td>
                    <td>
                        @if($p->status_pembayaran === 'menunggu')
                        <form method="POST" action="{{ route('admin.payments.verify',$p->id) }}">
                            @csrf
                            <input type="hidden" name="status" value="lunas">
                            <button class="btn-save" style="padding:6px 12px">✔</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">Belum ada pembayaran</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL --}}
<div class="modal-overlay" id="deleteOverlay"></div>
<div class="modal" id="deleteModal">
    <p>Hapus QRIS?</p>
    <form method="POST" action="{{ route('admin.qris.delete') }}">
        @csrf @method('DELETE')
        <button class="btn-save" style="background:var(--danger)">Hapus</button>
        <button type="button" onclick="closeDeleteQris()">Batal</button>
    </form>
</div>

<script>
const qrisWrapper=document.getElementById('qrisWrapper');
const qrisInput=document.getElementById('qrisInput');
const qrisPreview=document.getElementById('qrisPreview');

if(qrisWrapper){
    qrisWrapper.onclick=()=>qrisInput.click();
    qrisInput.onchange=e=>{
        const f=e.target.files[0];
        if(!f)return;
        qrisPreview.src=URL.createObjectURL(f);
        qrisPreview.style.display='block';
        qrisWrapper.classList.add('has-image');
    }
}
function openDeleteQris(){
    deleteModal.classList.add('active');
    deleteOverlay.classList.add('active');
}
function closeDeleteQris(){
    deleteModal.classList.remove('active');
    deleteOverlay.classList.remove('active');
}
</script>
@endsection
