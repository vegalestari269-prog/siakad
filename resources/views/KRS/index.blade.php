@extends('layouts.app')

@section('title', 'Data KRS')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1">Data Kartu Rencana Studi</h4>
            <p class="text-muted mb-0">
                Daftar Kartu Rencana Studi mahasiswa.
            </p>
        </div>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('krs.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                Tambah KRS
            </a>
        @endif
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="krs-table"
                       class="table table-striped table-hover align-middle w-100">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>Tahun Akademik</th>
                            <th>Semester</th>
                            <th>Mata Kuliah</th>
                            <th>Total SKS</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<link rel="stylesheet"
      href="{{ asset('vendor/datatables/dataTables.bootstrap5.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap5.min.js') }}"></script>

<script>
$(document).ready(function () {

    let table = $('#krs-table').DataTable({
        processing: true,
        serverSide: true,

        ajax: "{{ route('krs.data', [], false) }}",

        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'mahasiswa',
                name: 'mahasiswa'
            },
            {
                data: 'tahun_akademik',
                name: 'tahun_akademik'
            },
            {
                data: 'semester',
                name: 'semester'
            },
            {
                data: 'mata_kuliah',
                name: 'mata_kuliah',
                orderable: false,
                searchable: false
            },
            {
                data: 'total_sks',
                name: 'total_sks',
                orderable: false,
                searchable: false
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false
            }
        ],

        order: [[2, 'desc']],

        language: {
            processing: "Sedang memproses...",
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data yang tersedia",
            infoFiltered: "(disaring dari _MAX_ total data)",
            loadingRecords: "Sedang memuat data...",
            zeroRecords: "Data tidak ditemukan",
            emptyTable: "Belum ada data KRS",
            paginate: {
                first: "Pertama",
                previous: "Sebelumnya",
                next: "Selanjutnya",
                last: "Terakhir"
            }
        }
    });

    // Konfirmasi hapus KRS
    $(document).on('click', '.btn-hapus', function () {

        let url = $(this).data('url');
        let nama = $(this).data('nama');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data KRS ' + nama + ' akan dihapus.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },

                    success: function (response) {
                        table.ajax.reload(null, false);

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },

                    error: function (xhr) {
                        let pesan = xhr.responseJSON?.message
                            ?? 'Terjadi kesalahan saat menghapus data.';

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: pesan
                        });
                    }
                });
            }
        });
    });
});
</script>
@endpush
