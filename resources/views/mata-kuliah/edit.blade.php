@extends('layouts.app')

@section('title', 'Edit Mata Kuliah')

@section('content')

<div class="container-fluid">

    <h4 class="mb-3">Edit Mata Kuliah</h4>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('matakuliah.update', $mataKuliah->id) }}"
                  method="POST"
                  novalidate>

                @csrf
                @method('PUT')

                @include('mata-kuliah._form')

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i>
                    Perbarui
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