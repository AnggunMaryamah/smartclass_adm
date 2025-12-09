<div class="card mb-3 p-3" style="background: white; border-radius: 12px; border: 2px solid #E5E7EB; padding: 20px !important; margin-bottom: 16px !important;">
    <input type="hidden" name="soal[{{ $index }}][id]" value="{{ $soal->id ?? '' }}">

    <div class="mb-2">
        <label class="form-label" style="font-weight: 600; color: #0F172A; margin-bottom: 8px;">Pertanyaan</label>
        <textarea name="soal[{{ $index }}][pertanyaan]" class="form-control" rows="2" required style="width:100%; padding:12px; border: 2px solid #E5E7EB; border-radius:8px;">{{ $soal->pertanyaan ?? '' }}</textarea>
    </div>

    <div class="row">
        <div class="col-md-6 mb-2">
            <label class="form-label" style="font-weight: 600; color: #0F172A; margin-bottom: 8px;">Pilihan A</label>
            <input type="text" name="soal[{{ $index }}][pilihan_a]" class="form-control"
                   value="{{ $soal->pilihan_a ?? '' }}" required style="padding:12px; border: 2px solid #E5E7EB; border-radius:8px;">
        </div>
        <div class="col-md-6 mb-2">
            <label class="form-label" style="font-weight: 600; color: #0F172A; margin-bottom: 8px;">Pilihan B</label>
            <input type="text" name="soal[{{ $index }}][pilihan_b]" class="form-control"
                   value="{{ $soal->pilihan_b ?? '' }}" required style="padding:12px; border: 2px solid #E5E7EB; border-radius:8px;">
        </div>
        <div class="col-md-6 mb-2">
            <label class="form-label" style="font-weight: 600; color: #0F172A; margin-bottom: 8px;">Pilihan C</label>
            <input type="text" name="soal[{{ $index }}][pilihan_c]" class="form-control"
                   value="{{ $soal->pilihan_c ?? '' }}" style="padding:12px; border: 2px solid #E5E7EB; border-radius:8px;">
        </div>
        <div class="col-md-6 mb-2">
            <label class="form-label" style="font-weight: 600; color: #0F172A; margin-bottom: 8px;">Pilihan D</label>
            <input type="text" name="soal[{{ $index }}][pilihan_d]" class="form-control"
                   value="{{ $soal->pilihan_d ?? '' }}" style="padding:12px; border: 2px solid #E5E7EB; border-radius:8px;">
        </div>
    </div>

    <div class="mb-2">
        <label class="form-label" style="font-weight: 600; color: #0F172A; margin-bottom: 8px;">Jawaban Benar</label>
        @php
            $jawabanBenar = $soal->jawaban_benar ?? '';
        @endphp
        <select name="soal[{{ $index }}][jawaban_benar]" class="form-select" required style="padding:12px; border: 2px solid #E5E7EB; border-radius:8px;">
            <option value="">Pilih</option>
            <option value="A" {{ $jawabanBenar === 'A' ? 'selected' : '' }}>A</option>
            <option value="B" {{ $jawabanBenar === 'B' ? 'selected' : '' }}>B</option>
            <option value="C" {{ $jawabanBenar === 'C' ? 'selected' : '' }}>C</option>
            <option value="D" {{ $jawabanBenar === 'D' ? 'selected' : '' }}>D</option>
        </select>
    </div>
</div>
