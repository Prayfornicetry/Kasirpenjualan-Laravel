@extends('layouts.transaksi')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="container mt-5">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Riwayat Transaksi</h3>
            <a href="{{ route('transaksi.create') }}" class="btn btn-custom">Buat Transaksi Baru</a>
            
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
<tbody>
    @forelse ($transaksi as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_produk }}</td>
            <td>{{ $item->pesanan }}</td>
            <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal_pemesanan)->format('d/m/Y H:i') }}</td>
            <td>
    <!-- Edit -->
    <a href="{{ route('transaksi.edit', $item->id) }}" 
       class="btn btn-sm btn-outline-primary me-1"
       style="color: #005f6b; border-color: #0097A7;">
        <i class="bi bi-pencil"></i> Edit
    </a>

    <!-- Delete -->
    <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus transaksi ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="btn btn-sm btn-outline-danger me-1"
                style="color: #b71c1c; border-color: #e53935;">
            <i class="bi bi-trash"></i> Hapus
        </button>
    </form>

    <!-- Cetak Struk -->
    <a href="{{ route('transaksi.cetak', $item->id) }}" 
       target="_blank" 
       class="btn btn-sm btn-outline-info"
       style="color: #00796B; border-color: #4FC3F7;">
        <i class="bi bi-printer"></i> Cetak Struk
    </a>
</td>
        </tr>
    @empty 
        <tr>
            <td colspan="6" class="text-center">Belum ada transaksi.</td>
        </tr>
    @endforelse
</tbody>
        </table>
    </div>
</div>
@endsection