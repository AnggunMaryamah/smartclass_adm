@extends('layouts.guru')

@section('title', 'Kelola Soal')

@section('content')
<style>
    :root {
        --primary: #0EA5E9;
        --primary-hover: #0284C7;
        --primary-light: #E0F2FE;
        --text-primary: #0F172A;
        --text-secondary: #64748B;
        --bg-light: #F8FAFC;
        --border: #E5E7EB;
    }

    .soal-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 24px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: white;
        color: var(--text-secondary);
        border: 2px solid var(--border);
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .btn-back:hover {
        background: var(--bg-light);
        border-color: var(--primary);
        color: var(--primary);
        transform: translateX(-4px);
    }

    h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 24px;
    }

    .alert-success {
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 20px;
        background: linear-gradient(135deg, #d4edda, #c3f0d6);
        color: #155724;
        border: 1px solid #c3e6cb;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-add-soal {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: white;
        color: var(--primary);
        border: 2px solid var(--primary);
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 16px;
    }

    .btn-add-soal:hover {
        background: var(--primary);
        color: white;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 28px;
        background: linear-gradient(135deg, var(--primary), var(--primary-hover));
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
    }
</style>

<div class="soal-container">
    <a href="{{ route('guru.tugas.index', $kelasId) }}" class="btn-back">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" 
             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>

    <h1>Soal: {{ $tugas->judul }}</h1>

    @if(session('success'))
        <div class="alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" 
                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('guru.tugas.soal.store', [$kelasId, $tugas->id]) }}" method="POST">
        @csrf

        <div id="soal-wrapper">
            @forelse($soals as $index => $soal)
                @include('guru.tugas._soal_item', ['index' => $index, 'soal' => $soal])
            @empty
                @include('guru.tugas._soal_item', ['index' => 0, 'soal' => null])
            @endforelse
        </div>

        <button type="button" class="btn-add-soal" onclick="tambahSoal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" 
                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Tambah Soal
        </button>

        <button type="submit" class="btn-submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" 
                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                <polyline points="7 3 7 8 15 8"></polyline>
            </svg>
            Simpan Soal
        </button>
    </form>
</div>

<script>
let soalIndex = {{ max($soals->count() - 1, 0) }};

function tambahSoal() {
    soalIndex++;

    const template = `
    <div class="card mb-3 p-3" style="background: white; border-radius: 12px; border: 2px solid #E5E7EB; padding: 20px !important; margin-bottom: 16px !important;">
        <input type="hidden" name="soal[\${soalIndex}][id]" value="">
        <div class="mb-2">
            <label class="form-label" style="font-weight: 600; color: #0F172A; margin-bottom: 8px;">Pertanyaan</label>
            <textarea name="soal[\${soalIndex}][pertanyaan]" class="form-control" rows="2" required style="width:100%; padding:12px; border: 2px solid #E5E7EB; border-radius:8px;"></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-2">
                <label class="form-label" style="font-weight: 600; color: #0F172A; margin-bottom: 8px;">Pilihan A</label>
                <input type="text" name="soal[\${soalIndex}][pilihan_a]" class="form-control" required style="padding:12px; border: 2px solid #E5E7EB; border-radius:8px;">
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label" style="font-weight: 600; color: #0F172A; margin-bottom: 8px;">Pilihan B</label>
                <input type="text" name="soal[\${soalIndex}][pilihan_b]" class="form-control" required style="padding:12px; border: 2px solid #E5E7EB; border-radius:8px;">
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label" style="font-weight: 600; color: #0F172A; margin-bottom: 8px;">Pilihan C</label>
                <input type="text" name="soal[\${soalIndex}][pilihan_c]" class="form-control" style="padding:12px; border: 2px solid #E5E7EB; border-radius:8px;">
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label" style="font-weight: 600; color: #0F172A; margin-bottom: 8px;">Pilihan D</label>
                <input type="text" name="soal[\${soalIndex}][pilihan_d]" class="form-control" style="padding:12px; border: 2px solid #E5E7EB; border-radius:8px;">
            </div>
        </div>
        <div class="mb-2">
            <label class="form-label" style="font-weight: 600; color: #0F172A; margin-bottom: 8px;">Jawaban Benar</label>
            <select name="soal[\${soalIndex}][jawaban_benar]" class="form-select" required style="padding:12px; border: 2px solid #E5E7EB; border-radius:8px;">
                <option value="">Pilih</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
        </div>
    </div>`;
    
    document.getElementById('soal-wrapper').insertAdjacentHTML('beforeend', template);
}
</script>
@endsection
