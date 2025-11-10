@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h3>Edit Transaksi</h3>

        <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Pilih Produk -->
            <div class="mb-3">
                <label for="product_id" class="form-label fw-bold">Produk</label>
                <select name="product_id" id="product_id" class="form-select" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($products as $item)
                        <option value="{{ $item->id }}" 
                                data-price="{{ $item->price }}" 
                                data-stock="{{ $item->stock }}"
                                {{ $transaksi->nama_produk == $item->name ? 'selected' : '' }}>
                            {{ $item->name }} (Stock: {{ $item->stock }} | Harga: Rp {{ number_format($item->price, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Jumlah Pesanan -->
            <div class="mb-3">
                <label for="pesanan" class="form-label fw-bold">Jumlah Pesanan</label>
                <input type="number" 
                       name="pesanan" 
                       id="pesanan" 
                       class="form-control" 
                       min="1" 
                       value="{{ old('pesanan', $transaksi->pesanan) }}" 
                       required>
                <div id="stock-warning" class="text-warning mt-1" style="display: none;">
                    ⚠️ Stok tidak mencukupi!
                </div>
            </div>

            <!-- Total Harga (otomatis dihitung) -->
            <div class="mb-3">
                <label for="total_harga" class="form-label fw-bold">Total Harga</label>
                <input type="number" 
                       name="total_harga" 
                       id="total_harga" 
                       class="form-control" 
                       step="0.01" 
                       value="{{ old('total_harga', $transaksi->total_harga) }}" 
                       readonly>
            </div>

            <!-- Tanggal Pemesanan -->
            <div class="mb-3">
                <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan</label>
                <input type="datetime-local" 
                       name="tanggal_pemesanan" 
                       id="tanggal_pemesanan" 
                       class="form-control" 
                       value="{{ old('tanggal_pemesanan', $transaksi->tanggal_pemesanan->format('Y-m-d\TH:i')) }}" 
                       required>
            </div>

            <hr class="my-4">

            <!-- Data Pelanggan -->
            <h5 class="mb-3">Data Pelanggan</h5>

            <div class="mb-3">
                <label for="nama_pelanggan" class="form-label fw-bold">Nama Pelanggan</label>
                <input type="text" 
                       name="nama_pelanggan" 
                       id="nama_pelanggan" 
                       class="form-control @error('nama_pelanggan') is-invalid @enderror" 
                       value="{{ old('nama_pelanggan', $transaksi->nama_pelanggan) }}" 
                       required>
                @error('nama_pelanggan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email_pelanggan" class="form-label">Email (Opsional)</label>
                <input type="email" 
                       name="email_pelanggan" 
                       id="email_pelanggan" 
                       class="form-control @error('email_pelanggan') is-invalid @enderror" 
                       value="{{ old('email_pelanggan', $transaksi->email_pelanggan) }}">
                @error('email_pelanggan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="no_telp" class="form-label">No. Telepon (Opsional)</label>
                <input type="text" 
                       name="no_telp" 
                       id="no_telp" 
                       class="form-control @error('no_telp') is-invalid @enderror" 
                       value="{{ old('no_telp', $transaksi->no_telp) }}">
                @error('no_telp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Aksi -->
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productSelect = document.getElementById('product_id');
    const quantityInput = document.getElementById('pesanan');
    const totalPriceInput = document.getElementById('total_harga');
    const stockWarning = document.getElementById('stock-warning');

    // Hitung total harga saat jumlah atau produk berubah
    function calculateTotal() {
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const price = selectedOption ? parseFloat(selectedOption.dataset.price) || 0 : 0;
        const quantity = parseInt(quantityInput.value) || 0;
        const stock = selectedOption ? parseInt(selectedOption.dataset.stock) || 0 : 0;

        // Tampilkan warning stok
        if (quantity > stock) {
            stockWarning.style.display = 'block';
        } else {
            stockWarning.style.display = 'none';
        }

        const total = price * quantity;
        totalPriceInput.value = total.toFixed(2);
    }

    // Event listeners
    productSelect.addEventListener('change', calculateTotal);
    quantityInput.addEventListener('input', calculateTotal);

    // Hitung saat halaman dimuat
    calculateTotal();
});
</script>
@endsection