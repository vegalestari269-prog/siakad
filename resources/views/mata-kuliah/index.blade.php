@extends('layouts.app')

@section('title', 'Data Mata Kuliah')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1">Data Mata Kuliah</h4>
            <p class="text-muted mb-0">
                Daftar seluruh data mata kuliah.
            </p>
        </div>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('matakuliah.create') }}"
               class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                Tambah Mata Kuliah
            </a>
        @endif
    </div>

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table id="mata-kuliah-table"
                       class="table table-striped table-hover align-middle w-100">

                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
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

    // Inisialisasi DataTables
    let table = $('#mata-kuliah-table').DataTable({

        processing: true,
        serverSide: true,

        ajax: "{{ route('matakuliah.data', [], false) }}",

        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'kode_mk',
                name: 'kode_mk'
            },
            {
                data: 'nama_mk',
                name: 'nama_mk'
            },
            {
                data: 'sks',
                name: 'sks'
            },
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false
            }
        ],

        order: [[2, 'asc']],

        language: {
			processing: "Sedang memproses...",
			search: "Cari:",
			lengthMenu: "Tampilkan _MENU_ data",
			info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
			infoEmpty: "Tidak ada data yang tersedia",
			infoFiltered: "(disaring dari _MAX_ total data)",
			loadingRecords: "Sedang memuat data...",
			zeroRecords: "Data tidak ditemukan",
			emptyTable: "Belum ada data mata kuliah",
			paginate: {
				first: "Pertama",
				previous: "Sebelumnya",
				next: "Selanjutnya",
				last: "Terakhir"
			}
		}

    });


    // Konfirmasi hapus menggunakan SweetAlert2
    $(document).on('click', '.btn-hapus', function () {

        let url = $(this).data('url');
        let nama = $(this).data('nama');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data mata kuliah ' + nama + ' akan dihapus.',
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