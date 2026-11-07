<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Masuk') | {{ config('app.name') }}</title>

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/siakad.css') }}" rel="stylesheet">

    <link rel="stylesheet"
          href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
</head>

<body class="bg-body-tertiary">

    <main class="container min-vh-100 py-4 d-flex align-items-center justify-content-center">
        <div class="w-100" style="max-width: 420px;">
            @yield('content')
        </div>
    </main>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

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

</body>
</html>
