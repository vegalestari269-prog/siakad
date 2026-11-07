<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'SIAKAD') | {{ config('app.name') }}</title>

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/siakad.css') }}" rel="stylesheet">

    <link href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('vendor/datatables/css/dataTables.bootstrap5.min.css') }}"
          rel="stylesheet">

    @stack('styles')
</head>

<body class="bg-body-tertiary">

    @include('layouts.partials.navbar')

    <div class="container-fluid">
        <div class="row">

            @include('layouts.partials.sidebar')

            <main class="col-lg-9 col-xl-10 px-3 px-md-4 py-4">
                @yield('content')
            </main>

        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('vendor/datatables/js/dataTables.min.js') }}"></script>

    <script src="{{ asset('vendor/datatables/js/dataTables.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        const pesanSukses = @json(session('success'));
        const pesanError = @json(session('error'));
        const pesanWarning = @json(session('warning'));
        const pesanInfo = @json(session('info'));

        if (pesanSukses) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: pesanSukses
            });
        }

        if (pesanError) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: pesanError
            });
        }

        if (pesanWarning) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: pesanWarning
            });
        }

        if (pesanInfo) {
            Swal.fire({
                icon: 'info',
                title: 'Informasi!',
                text: pesanInfo
            });
        }
    </script>
	{{-- jQuery --}}
	<script src="{{ asset('vendor/jquery/jquery-3.7.1.min.js') }}"></script>

	{{-- DataTables --}}
	<script src="{{ asset('vendor/datatables/js/dataTables.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/js/dataTables.bootstrap5.min.js') }}"></script>

    @stack('scripts')

</body>
</html>