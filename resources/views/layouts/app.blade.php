<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kelola Produk')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/hm.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('img/2.png') }}" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="header d-flex justify-content-between align-items-center">
        <img src="{{ asset('img/2.png') }}" alt="Logo Perusahaan" class="logo-img">
        <nav>
            <ul>
                <li><a href="{{ url('/dashboard') }}">DASHBOARD</a></li>
                <li><a href="{{ route('transaksi.index') }}">TRANSAKSI</a></li>
                @auth
                    <li class="dropdown">
                        <a href="#" class="dropbtn">Hai, {{ Auth::user()->name }} ▼</a>
                        <div class="dropdown-content">
                            <a href="#">PROFIL</a>
                            <a href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                LOGOUT
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="btn-login">LOGIN</a></li>
                @endauth
            </ul>
        </nav>
    </div>

    <div class="container mt-4">
        @yield('content')
    </div>

    <div class="footer mt-5 py-3 text-center">
        © 2025 Brand Prayfornicetry
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>