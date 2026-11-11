<div class="mb-3">
    <label for="kode_mk" class="form-label">
        Kode Mata Kuliah
    </label>

    <input type="text"
           name="kode_mk"
           id="kode_mk"
           class="form-control @error('kode_mk') is-invalid @enderror"
           value="{{ old('kode_mk', $mataKuliah->kode_mk) }}"
           maxlength="10"
           required>

    @error('kode_mk')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="nama_mk" class="form-label">
        Nama Mata Kuliah
    </label>

    <input type="text"
           name="nama_mk"
           id="nama_mk"
           class="form-control @error('nama_mk') is-invalid @enderror"
           value="{{ old('nama_mk', $mataKuliah->nama_mk) }}"
           maxlength="100"
           required>

    @error('nama_mk')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="sks" class="form-label">
        Jumlah SKS
    </label>

    <input type="number"
           name="sks"
           id="sks"
           class="form-control @error('sks') is-invalid @enderror"
           value="{{ old('sks', $mataKuliah->sks) }}"
           min="1"
           max="6"
           required>

    @error('sks')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>