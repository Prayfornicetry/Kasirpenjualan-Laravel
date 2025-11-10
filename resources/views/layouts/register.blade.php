<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kelola Produk')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset ('css/style.css') }} " rel="stylesheet">
    <link href="{{ asset ('css/app.css') }} " rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link href="{{ asset('img/2.png') }}" rel="icon">
</head>
<body>
    <div class="header d-flex justify-content-between align-items-center">
        <img src="{{ asset('img/2.png') }}" alt="Logo Perusahaan" class="logo-img">
        <nav>
            <ul>
                <li><a href="{{ route('login') }}" class="btn-login">LOGIN</a></li>
            </ul>
        </nav>
    </div>

    <div class="container">
        @yield('content')
    </div>

    <div class="footer">
        © 2025 Brand Prayfornicetry
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>