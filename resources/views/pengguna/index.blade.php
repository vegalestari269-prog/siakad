@extends('layouts.app')

@section('title', 'Data Pengguna')

@section('content')
    <x-page-header
        judul="Data Pengguna"
        deskripsi="Daftar akun dan peran pengguna SIAKAD"
    />

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <x-tabel :kolom="$kolom" :baris="$pengguna" />
        </div>
    </div>
@endsection
