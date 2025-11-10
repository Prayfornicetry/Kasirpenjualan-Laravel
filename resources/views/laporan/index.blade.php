@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="container mt-5">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Laporan Penjualan</h3>
            <a href="{{ route('laporan.export') }}" class="btn btn-success">SIMPAN LAPORAN</a>
        </div>

        <p>Memantau hasil transaksi pelanggan</p>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Pesanan</th>
                    <th>Total Harga</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->pesanan }}</td>
                        <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pemesanan)->format('d/m/Y H:i') }}</td>
                        <td>{{ $item->nama_pelanggan }}</td>
                        <td>{{ $item->email_pelanggan ?: '-' }}</td>
                        <td>{{ $item->no_telp ?: '-' }}</td>
                        <td>
                            <a href="{{ route('laporan.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('laporan.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus transaksi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection