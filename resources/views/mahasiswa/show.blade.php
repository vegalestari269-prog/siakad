@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
    <x-page-header
        judul="Detail Mahasiswa"
        deskripsi="Informasi lengkap mahasiswa." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            Informasi Mahasiswa
        </div>

        <div class="card-body">
            <table class="table">
                <tr>
                    <th width="180">NIM</th>
                    <td>{{ $data['nim'] }}</td>
                </tr>
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $data['nama'] }}</td>
                </tr>
                <tr>
                    <th>Angkatan</th>
                    <td>{{ $data['angkatan'] }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $data['email'] }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-primary">
                            {{ $data['status'] }}
                        </span>
                    </td>
                </tr>
            </table>

            <a href="{{ route('mahasiswa.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </div>
@endsection
