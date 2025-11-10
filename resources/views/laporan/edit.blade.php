@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
<div class="container mt-5">
    <div class="card p-4">
        <h3>Edit Transaksi</h3>

        <form action="{{ route('laporan.update', $transaksi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="{{ old('nama_produk', $transaksi->nama_produk) }}" required>
            </div>

            <div class="mb-3">
                <label for="pesanan" class="form-label">Jumlah Pesanan</label>
                <input type="number" name="pesanan" id="pesanan" class="form-control" min="1" value="{{ old('pesanan', $transaksi->pesanan) }}" required>
            </div>

            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="number" name="total_harga" id="total_harga" class="form-control" step="0.01" value="{{ old('total_harga', $transaksi->total_harga) }}" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan</label>
                <input type="datetime-local" name="tanggal_pemesanan" id="tanggal_pemesanan" class="form-control" value="{{ old('tanggal_pemesanan', $transaksi->tanggal_pemesanan->format('Y-m-d\TH:i')) }}" required>
            </div>

            <div class="mb-3">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" value="{{ old('nama_pelanggan', $transaksi->nama_pelanggan) }}" required>
            </div>

            <div class="mb-3">
                <label for="email_pelanggan" class="form-label">Email (Opsional)</label>
                <input type="email" name="email_pelanggan" id="email_pelanggan" class="form-control" value="{{ old('email_pelanggan', $transaksi->email_pelanggan) }}">
            </div>

            <div class="mb-3">
                <label for="no_telp" class="form-label">No. Telepon (Opsional)</label>
                <input type="text" name="no_telp" id="no_telp" class="form-control" value="{{ old('no_telp', $transaksi->no_telp) }}">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection