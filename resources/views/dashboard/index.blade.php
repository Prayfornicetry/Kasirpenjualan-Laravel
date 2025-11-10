<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan Online Berkualitas</title>
    <link href="{{ asset('css/hm.css') }}" rel="stylesheet">
    <link href="{{ asset('img/2.png') }}" rel="icon">
</head>
<body>

<!-- Header -->
<header>
    <div class="header-content">
        <div class="logo-container">
            <img src="{{ asset('img/4.png') }}" alt="Logo Perusahaan" class="logo-img">
            <span class="brand-name">HARTANTO STORE</span>
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('dashboard') }}">HOME</a></li>
                <li><a href="{{ route('products.index') }}">PRODUK</a></li>
                <li><a href="{{ route('transaksi.index') }}">TRANSAKSI</a></li>
                @auth
                    <li class="dropdown">
                        <a href="#" class="dropbtn">Hai, {{ Auth::user()->name }} ▼</a>
                        <div class="dropdown-content">
                            <a href="#">PROFIL</a>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout').submit();">
                                LOGOUT
                            </a>
                            <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
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
</header>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-container">
        <div class="hero-text">
            <h1>Penjualan Online Berkualitas</h1>
            <p>Kelola produk berkualitas, import, pelanggan, dan transaksi dengan mudah, dan dapatkan diskon hingga 15%, dengan harga terjangkau</p>
            <a href="{{ route('transaksi.create') }}" class="btn-checkout">Checkout Sekarang</a>
        </div>
        <div class="hero-image">
            <img src="{{ asset('img/3.png') }}" alt="Ilustrasi Belanja Online">
        </div>
    </div>
    <!-- Background Curve -->
    <div class="hero-bg-curve"></div>
</section>

<!-- Features Section -->
<section class="features">
    <div class="features-container">
        <div class="features-grid">

            <!-- Kartu 1: Kelola Produk -->
            <a href="{{ route('products.index') }}" class="feature-card">
                <div class="feature-icon">📦</div>
                <h3>Kelola Produk</h3>
                <p>Cek produk barang</p>
            </a>

            <!-- Kartu 2: Kelola Pelanggan -->
            <a href="{{ route('pelanggan.index') }}" class="feature-card">
            <div class="feature-icon">👤</div>
            <h3>Kelola Pelanggan</h3>
            <p>Cek data konsumen</p>
            </a>

            <!-- Kartu 3: Laporan Penjualan -->
            <a href="{{ route('laporan.index') }}" class="feature-card">
            <div class="feature-icon">📈</div>
            <h3>Laporan Penjualan</h3>
            <p>Memantau hasil transaksi pelanggan</p>
            </a>

        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Brand Prayfornicetry</p>
</footer>

</body>
</html>