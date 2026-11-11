@extends('layouts.app')

@section('title', 'Tambah KRS')

@section('content')
<div class="container-fluid">

    <div class="mb-3">
        <h4>Tambah KRS</h4>
        <p class="text-muted mb-0">
            Tambahkan Kartu Rencana Studi mahasiswa.
        </p>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('krs.store') }}" method="POST">
                @csrf

                @include('krs._form')

            </form>

        </div>
    </div>

</div>
@endsection
