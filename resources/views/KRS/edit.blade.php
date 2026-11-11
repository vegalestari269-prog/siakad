@extends('layouts.app')

@section('title', 'Edit KRS')

@section('content')
<div class="container-fluid">

    <div class="mb-3">
        <h4>Edit KRS</h4>
        <p class="text-muted mb-0">
            Ubah data Kartu Rencana Studi mahasiswa.
        </p>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('krs.update', $krs->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                @include('krs._form')

            </form>

        </div>
    </div>

</div>
@endsection
