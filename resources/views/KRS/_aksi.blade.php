<a href="{{ route('krs.show', $krs->id) }}"
   class="btn btn-sm btn-info"
   title="Detail">
    <i class="bi bi-eye"></i>
</a>

@if(auth()->user()->role === 'admin')
    <a href="{{ route('krs.edit', $krs->id) }}"
       class="btn btn-sm btn-warning"
       title="Edit">
        <i class="bi bi-pencil-square"></i>
    </a>

    <button type="button"
            class="btn btn-sm btn-danger btn-hapus"
            data-url="{{ route('krs.destroy', $krs->id) }}"
            data-nama="{{ $krs->mahasiswa?->nama ?? 'KRS' }}"
            title="Hapus">
        <i class="bi bi-trash"></i>
    </button>
@endif
