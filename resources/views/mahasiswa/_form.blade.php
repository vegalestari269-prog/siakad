<div class="mb-3">
    <x-form-input label="NIM" name="nim"
        :value="$mahasiswa->nim" maxlength="15" required />
</div>

<div class="mb-3">
    <x-form-input label="Nama Mahasiswa" name="nama"
        :value="$mahasiswa->nama" maxlength="100" required />
</div>

<div class="mb-3">
    <label class="form-label">Jenis Kelamin</label>

    <select name="jenis_kelamin"
        class="form-select @error('jenis_kelamin') is-invalid @enderror">
        <option value="">Pilih Jenis Kelamin</option>
        <option value="L" @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'L')>
            Laki-laki
        </option>
        <option value="P" @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'P')>
            Perempuan
        </option>
    </select>

    @error('jenis_kelamin')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <x-form-input label="Email" name="email" type="email"
        :value="$mahasiswa->email" maxlength="100" required />
</div>

<div class="mb-3">
    <x-form-input label="Angkatan" name="angkatan" type="number"
        :value="$mahasiswa->angkatan" required />
</div>

<div class="mb-3">
    <x-form-input label="Program Studi" name="program_studi"
        :value="$mahasiswa->program_studi"
        maxlength="100" required />
</div>
