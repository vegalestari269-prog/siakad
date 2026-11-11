@php
    $terpilih = old(
        'mata_kuliah_ids',
        $selectedMataKuliah ?? []
    );
@endphp

<div class="mb-3">
    <label for="mahasiswa_id" class="form-label">
        Mahasiswa <span class="text-danger">*</span>
    </label>

    <select name="mahasiswa_id"
            id="mahasiswa_id"
            class="form-select @error('mahasiswa_id') is-invalid @enderror"
            required>
        <option value="">-- Pilih Mahasiswa --</option>

        @foreach($mahasiswa as $mhs)
            <option value="{{ $mhs->id }}"
                {{ old('mahasiswa_id', $krs->mahasiswa_id) == $mhs->id ? 'selected' : '' }}>
                {{ $mhs->nim }} - {{ $mhs->nama }}
            </option>
        @endforeach
    </select>

    @error('mahasiswa_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="tahun_akademik" class="form-label">
        Tahun Akademik <span class="text-danger">*</span>
    </label>

    <input type="text"
           name="tahun_akademik"
           id="tahun_akademik"
           class="form-control @error('tahun_akademik') is-invalid @enderror"
           placeholder="Contoh: 2026/2027"
           maxlength="9"
           value="{{ old('tahun_akademik', $krs->tahun_akademik) }}"
           required>

    @error('tahun_akademik')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="semester" class="form-label">
        Semester <span class="text-danger">*</span>
    </label>

    <select name="semester"
            id="semester"
            class="form-select @error('semester') is-invalid @enderror"
            required>
        <option value="">-- Pilih Semester --</option>

        <option value="Ganjil"
            {{ old('semester', $krs->semester) == 'Ganjil' ? 'selected' : '' }}>
            Ganjil
        </option>

        <option value="Genap"
            {{ old('semester', $krs->semester) == 'Genap' ? 'selected' : '' }}>
            Genap
        </option>
    </select>

    @error('semester')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="status" class="form-label">
        Status KRS <span class="text-danger">*</span>
    </label>

    <select name="status"
            id="status"
            class="form-select @error('status') is-invalid @enderror"
            required>
        <option value="">-- Pilih Status --</option>

        @foreach(['draft', 'diajukan', 'disetujui', 'ditolak'] as $status)
            <option value="{{ $status }}"
                {{ old('status', $krs->status ?? 'draft') == $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>

    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">
        Pilih Mata Kuliah <span class="text-danger">*</span>
    </label>

    <div class="border rounded p-3">
        @forelse($mataKuliah as $mk)
            <div class="form-check mb-2">
                <input class="form-check-input"
                       type="checkbox"
                       name="mata_kuliah_ids[]"
                       id="mk{{ $mk->id }}"
                       value="{{ $mk->id }}"
                       {{ in_array($mk->id, $terpilih) ? 'checked' : '' }}>

                <label class="form-check-label" for="mk{{ $mk->id }}">
                    {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                    ({{ $mk->sks }} SKS)
                </label>
            </div>
        @empty
            <p class="text-muted mb-0">
                Belum ada data mata kuliah.
            </p>
        @endforelse
    </div>

    @error('mata_kuliah_ids')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror

    @error('mata_kuliah_ids.*')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-save"></i>
        Simpan
    </button>

    <a href="{{ route('krs.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>
