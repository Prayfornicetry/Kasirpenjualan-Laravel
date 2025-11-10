<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi #{{ $transaksi->id }}</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
            max-width: 300px;
            margin: 0 auto;
            border: 1px dashed #ccc;
            background: white;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .detail {
            margin-bottom: 15px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        .total {
            font-weight: bold;
            font-size: 1.1rem;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h3>Prayfornicetry</h3>
        <p>#{{ $transaksi->id }}</p>
    </div>

    <div class="detail">
        <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal_pemesanan)->format('d/m/Y H:i') }}<br>
        <strong>Pelanggan:</strong> {{ $transaksi->nama_pelanggan }}<br>
        <strong>Email:</strong> {{ $transaksi->email_pelanggan ?: '-' }}<br>
        <strong>No. Telepon:</strong> {{ $transaksi->no_telp ?: '-' }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $transaksi->nama_produk }}</td>
                <td>{{ $transaksi->pesanan }}</td>
                <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="total">
        <strong>Total: Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</strong>
    </div>

    <div class="footer">
        Terima kasih atas kunjungan Anda!<br>
        Jangan lupa folow instagram kami
        @Prayfornicetry
        © 2025 Brand Prayfornicetry
    </div>
</body>
</html>