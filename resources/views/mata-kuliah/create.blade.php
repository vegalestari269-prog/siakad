@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah')

@section('content')

<div class="container-fluid">

    <h4 class="mb-3">Tambah Mata Kuliah</h4>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('matakuliah.store') }}"
                  method="POST"
                  novalidate>

                @csrf

                @include('mata-kuliah._form')

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i>
                    Simpan
                </button>

                <a href="{{ route('matakuliah.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>

@endsection