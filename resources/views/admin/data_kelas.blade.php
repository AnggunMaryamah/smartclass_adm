@extends('layouts.app')

@section('title', 'Data Kelas Bimbel')

@section('content')
<style>
  /* Filter card */
  .filter-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 25px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  }

  /* Fancy select */
  .fancy-select-wrapper { position: relative; }
  .fancy-select {
    appearance: none;
    width: 100%;
    padding: 10px 42px 10px 14px;
    border-radius: 10px;
    border: 1px solid #d8e2eb;
    background: #fff;
    font-weight: 600;
  }
  .fancy-select-wrapper::after {
    content: "⌄";
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    font-size: 14px;
    color: #0b2b40;
    opacity: .85;
  }

  /* Reset button spacing */
  .btn-reset-custom { 
    margin-top: 10px; 
    margin-bottom: 10px;
}

  /* Status badges */
  .status-aktif, .status-non {
    display: inline-block;
    min-width: 80px;
    text-align: center;
    padding: 6px 12px;
    border-radius: 999px;
    font-weight: 600;
    font-size: 14px;
    line-height: 1;
  }
  .status-aktif { background:#16a34a; color:#fff; }
  .status-non  { background:#6b7280; color:#fff; }

  .btn-toggle { min-width: 120px; font-weight:600; }

  .table thead { background: #ccebf7 !important; }
</style>

<div class="container-fluid">
  <h2 class="fw-bold mb-3">Data Kelas Bimbel</h2>

  <div class="filter-card">
    <div class="row g-3">

      {{-- Dropdown Tahun --}}
      <div class="col-md-4">
        <form id="filterForm" action="{{ route('admin.data_kelas') }}" method="GET">
          <label class="fw-semibold mb-1">Filter Tahun Ajaran</label>
          <div class="fancy-select-wrapper">
            <select name="tahun_ajaran" class="fancy-select" onchange="document.getElementById('filterForm').submit()">
              <option value="">-- Semua Tahun --</option>
              @foreach ($tahun_list as $t)
                <option value="{{ $t->tahun_ajaran }}"
                  {{ isset($tahunDipilih) && $tahunDipilih == $t->tahun_ajaran ? 'selected' : '' }}>
                  {{ $t->tahun_ajaran }}
                </option>
              @endforeach
            </select>
          </div>
        </form>
      </div>

      {{-- Reset --}}
      <div class="col-md-2 d-flex align-items-end">
        <button onclick="resetFilter()"
          class="btn btn-outline-secondary w-100 fw-semibold btn-reset-custom">
          Reset
        </button>
      </div>

      {{-- Search (input + tombol) --}}
      <div class="col-md-6">
        <div class="d-flex gap-2">
          <input id="searchInput" type="text" class="form-control" placeholder="Cari nama guru/kelas..." aria-label="Cari nama guru atau kelas">
          <button id="btnSearch" type="button" class="btn btn-primary px-4 fw-semibold">Cari</button>
        </div>
      </div>

    </div>
  </div>

  {{-- Table --}}
  <div class="table-responsive">
    <table class="table table-bordered align-middle">
      <thead class="text-center fw-bold">
        <tr>
          <th>Nama Guru</th>
          <th>Nama Kelas</th>
          <th>Durasi Mengajar</th>
          <th>Tahun Ajaran</th>
          <th>Status</th>
          <th>Siswa Aktif</th>
          <th>Jenjang</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>

      <tbody id="dataTableBody">
        @forelse ($data as $kelas)
          @php $status = strtolower($kelas->status_guru ?? $kelas->status ?? ''); @endphp
          <tr>
            <td>{{ $kelas->nama_guru }}</td>
            <td>{{ $kelas->nama_kelas }}</td>
            <td>{{ $kelas->durasi_pengajaran ?? $kelas->durasi_mengajar ?? '-' }}</td>
            <td class="text-center">{{ $kelas->tahun_ajaran }}</td>

            <td class="text-center">
              @if ($status === 'aktif')
                <span class="status-aktif">Aktif</span>
              @else
                <span class="status-non">Tidak Aktif</span>
              @endif
            </td>

            <td class="text-center">{{ $kelas->siswa_aktif ?? '-' }}</td>
            <td class="text-center">{{ $kelas->jenjang_pendidikan ?? '-' }}</td>

            <td class="text-end">
              <form action="{{ route('admin.data_kelas.toggle', $kelas->id) }}" method="POST" onsubmit="return confirm('Yakin ubah status guru ini?')">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-sm {{ $status === 'aktif' ? 'btn-outline-danger' : 'btn-outline-success' }} btn-toggle">
                  {{ $status === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center text-muted py-4">Tidak ada data.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('scripts')
<script>
  // Reset filter (kembali ke halaman tanpa query)
  function resetFilter() {
    window.location = "{{ route('admin.data_kelas') }}";
  }

  // Debounce helper
  function debounce(fn, delay = 150) {
    let t;
    return function(...args) {
      clearTimeout(t);
      t = setTimeout(() => fn.apply(this, args), delay);
    };
  }

  // Real-time / button search (client-side)
  function doSearchImmediate() {
    const input = document.getElementById('searchInput');
    const tbody = document.getElementById('dataTableBody');
    if (!input || !tbody) return;

    const q = input.value.toLowerCase().trim();
    const rows = Array.from(tbody.querySelectorAll('tr'));

    if (!q) {
      rows.forEach(r => r.style.display = '');
      return;
    }

    rows.forEach(row => {
      // assume: Nama Guru = td[0], Nama Kelas = td[1]
      const nama = (row.children[0]?.innerText || '').toLowerCase();
      const kelas = (row.children[1]?.innerText || '').toLowerCase();
      row.style.display = (nama.includes(q) || kelas.includes(q)) ? '' : 'none';
    });
  }

  const doSearchDebounced = debounce(doSearchImmediate, 150);

  document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('searchInput');
    const btn = document.getElementById('btnSearch');

    if (input) {
      input.addEventListener('input', doSearchDebounced);
      input.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          doSearchImmediate();
        }
      });
    }

    if (btn) {
      btn.addEventListener('click', doSearchImmediate);
    }
  });
</script>
@endsection