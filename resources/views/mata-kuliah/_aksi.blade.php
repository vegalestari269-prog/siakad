<a href="{{ route('matakuliah.show', $mataKuliah->id) }}"
   class="btn btn-sm btn-info"
   title="Detail">
    <i class="bi bi-eye"></i>
</a>

@if(auth()->user()->role === 'admin')

    <a href="{{ route('matakuliah.edit', $mataKuliah->id) }}"
       class="btn btn-sm btn-warning"
       title="Edit">
        <i class="bi bi-pencil-square"></i>
    </a>

    <button type="button"
            class="btn btn-sm btn-danger btn-hapus"
            data-url="{{ route('matakuliah.destroy', $mataKuliah->id) }}"
            data-nama="{{ $mataKuliah->nama_mk }}"
            title="Hapus">
        <i class="bi bi-trash"></i>
    </button>

@endif