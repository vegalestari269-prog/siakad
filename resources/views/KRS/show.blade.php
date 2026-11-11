@extends('layouts.app')

@section('title', 'Detail KRS')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4>Detail Kartu Rencana Studi</h4>
            <p class="text-muted mb-0">
                Informasi lengkap KRS mahasiswa.
            </p>
        </div>

        <a href="{{ route('krs.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            Informasi Mahasiswa
        </div>

        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th width="200">NIM</th>
                    <td>: {{ $krs->mahasiswa?->nim ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Nama Mahasiswa</th>
                    <td>: {{ $krs->mahasiswa?->nama ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Tahun Akademik</th>
                    <td>: {{ $krs->tahun_akademik }}</td>
                </tr>

                <tr>
                    <th>Semester</th>
                    <td>: {{ $krs->semester }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>:
                        @php
                            $warna = [
                                'draft' => 'secondary',
                                'diajukan' => 'warning',
                                'disetujui' => 'success',
                                'ditolak' => 'danger',
                            ];
                        @endphp

                        <span class="badge bg-{{ $warna[$krs->status] ?? 'secondary' }}">
                            {{ ucfirst($krs->status) }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Daftar Mata Kuliah
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($krs->details as $index => $detail)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    {{ $detail->mataKuliah?->kode_mk ?? '-' }}
                                </td>
                                <td>
                                    {{ $detail->mataKuliah?->nama_mk ?? '-' }}
                                </td>
                                <td>
                                    {{ $detail->mataKuliah?->sks ?? 0 }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    Belum ada mata kuliah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">
                                Total SKS
                            </th>
                            <th>
                                {{ $krs->details->sum(fn ($detail) => $detail->mataKuliah?->sks ?? 0) }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
