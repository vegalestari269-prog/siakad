<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6f8;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #198754;
            color: white;
            padding: 12px 20px;
        }

        .error-card {
            background: white;
            max-width: 800px;
            margin: 40px auto;
            padding: 45px 25px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .error-code {
            color: #dc3545;
            font-size: 48px;
            font-weight: bold;
        }

        .error-title {
            font-size: 20px;
            font-weight: bold;
        }

        .error-message {
            color: #777;
            font-size: 14px;
            margin: 15px 0 25px;
        }

        .btn-dashboard {
            background-color: #0d6efd;
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-dashboard:hover {
            background-color: #0b5ed7;
            color: white;
        }
    </style>
</head>

<body>

<nav class="navbar">
    <strong>☰ &nbsp; SIAKAD - 3202416144</strong>
</nav>

<div class="container">
    <div class="error-card">

        <div class="error-code">403</div>

        <div class="error-title">
            Akses Ditolak!
        </div>

        <p class="error-message">
            Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
            Silakan kembali ke dashboard.
        </p>

        <a href="{{ url('/dashboard') }}" class="btn-dashboard">
            Kembali ke Dashboard
        </a>

    </div>
</div>

</body>
</html>
