@extends('layouts.app')

@section('title', 'Detail Mata Kuliah')

@section('content')

<div class="container-fluid">

    <h4 class="mb-3">Detail Mata Kuliah</h4>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="200">Kode Mata Kuliah</th>
                    <td>{{ $mataKuliah->kode_mk }}</td>
                </tr>

                <tr>
                    <th>Nama Mata Kuliah</th>
                    <td>{{ $mataKuliah->nama_mk }}</td>
                </tr>

                <tr>
                    <th>Jumlah SKS</th>
                    <td>{{ $mataKuliah->sks }}</td>
                </tr>

            </table>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('matakuliah.edit', $mataKuliah->id) }}"
                   class="btn btn-warning">
                    Edit
                </a>
            @endif

            <a href="{{ route('matakuliah.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </div>
    </div>

</div>

@endsection