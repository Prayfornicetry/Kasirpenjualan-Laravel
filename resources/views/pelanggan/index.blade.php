@extends('layouts.app')

@section('title', 'Kelola Pelanggan')

@section('content')
<div class="container mt-5">
    <div class="card p-4">
        <h3>Kelola Pelanggan</h3>
        <p>Cek data konsumen berdasarkan riwayat transaksi</p>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Total Belanja</th>
                    <th>Jumlah Transaksi</th>
                    <th>Terakhir Beli</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pelanggan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item['nama_pelanggan'] }}</td> <!-- Perhatikan: ['nama_pelanggan'] -->
                        <td>{{ $item['email_pelanggan'] ?: '-' }}</td> <!-- Perhatikan: ['email_pelanggan'] -->
                        <td>{{ $item['no_telp'] ?: '-' }}</td> <!-- Perhatikan: ['no_telp'] -->
                        <td>Rp {{ number_format($item['total_belanja'], 0, ',', '.') }}</td> <!-- Perhatikan: ['total_belanja'] -->
                        <td>{{ $item['jumlah_transaksi'] }}</td> <!-- Perhatikan: ['jumlah_transaksi'] -->
                        <td>{{ \Carbon\Carbon::parse($item['terakhir_beli'])->format('d/m/Y H:i') }}</td> <!-- Perhatikan: ['terakhir_beli'] -->
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada pelanggan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection