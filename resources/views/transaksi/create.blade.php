@extends('layouts.app')

@section('title', 'Buat Transaksi Baru')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h3 class="mb-4">Buat Transaksi Baru</h3>

        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf

            <!-- Keranjang Produk -->
            <div class="mb-4">
                <h5>Keranjang Belanja</h5>
                <div id="cart-items" class="border rounded p-3 mb-3">
                    <p class="text-muted">Belum ada produk di keranjang.</p>
                </div>

                <div class="d-flex gap-3">
                    <!-- Pilih Produk -->
                    <div class="flex-grow-1">
                        <label for="product_id" class="form-label fw-bold">Pilih Produk</label>
                        <select name="product_id" id="product_id" class="form-select" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($products as $item)
                                <option value="{{ $item->id }}" data-name="{{ $item->name }}" data-price="{{ $item->price }}" data-stock="{{ $item->stock }}">
                                    {{ $item->name }} (Stock: {{ $item->stock }} | Harga: Rp {{ number_format($item->price, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jumlah -->
                    <div style="width: 120px;">
                        <label for="quantity" class="form-label fw-bold">Jumlah</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="0" value="1" required>
                    </div>

                    <!-- Tambah ke Keranjang -->
                    <div style="width: 150px; align-self: end;">
                        <button type="button" id="add-to-cart" class="btn btn-primary w-100">Tambah ke Keranjang</button>
                    </div>
                </div>
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
                       value="{{ old('nama_pelanggan') }}" 
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
                       value="{{ old('email_pelanggan') }}">
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
                       value="{{ old('no_telp') }}">
                @error('no_telp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Aksi -->
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-success px-4">Simpan Transaksi</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>

<!-- Script untuk Keranjang -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    let cartItems = [];
    const productSelect = document.getElementById('product_id');
    const quantityInput = document.getElementById('quantity');
    const addToCartBtn = document.getElementById('add-to-cart');
    const cartContainer = document.getElementById('cart-items');
    const form = document.querySelector('form');

    // Tambah ke keranjang
    addToCartBtn.addEventListener('click', function() {
        const selected = productSelect.options[productSelect.selectedIndex];
        const id = selected.value;
        const name = selected.dataset.name;
        const price = parseFloat(selected.dataset.price);
        const stock = parseInt(selected.dataset.stock);
        const qty = parseInt(quantityInput.value);

        if (!id || qty < 1) {
            alert("Pilih produk & jumlah valid!");
            return;
        }

        if (qty > stock) {
            alert(`Stok hanya ${stock}`);
            return;
        }

        // Cek produk sudah ada di keranjang
        const existing = cartItems.find(item => item.product_id === id);
        if (existing) {
            existing.quantity += qty;
            existing.subtotal = existing.quantity * price;
        } else {
            cartItems.push({
                product_id: id,
                name: name,
                price: price,
                quantity: qty,
                subtotal: price * qty
            });
        }

        updateCartDisplay();
        resetForm();
    });

    // Update tampilan keranjang
    function updateCartDisplay() {
        if (cartItems.length === 0) {
            cartContainer.innerHTML = '<p class="text-muted">Belum ada produk di keranjang.</p>';
            return;
        }

        let html = `
            <table class="table table-sm mb-0">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
        `;

        cartItems.forEach((item, index) => {
            html += `
                <tr>
                    <td>${item.name}</td>
                    <td>${item.quantity}</td>
                    <td>Rp ${item.price.toLocaleString()}</td>
                    <td>Rp ${item.subtotal.toLocaleString()}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFromCart(${index})">Hapus</button>
                    </td>
                </tr>
            `;
        });

        html += `</tbody></table>`;
        cartContainer.innerHTML = html;
    }

    // Hapus dari keranjang
    window.removeFromCart = function(index) {
        cartItems.splice(index, 1);
        updateCartDisplay();
    };

    // Reset form
    function resetForm() {
        productSelect.value = '';
        quantityInput.value = '1';
    }

    // Sebelum submit, kirim data keranjang
    form.addEventListener('submit', function(e) {
        if (cartItems.length === 0) {
            e.preventDefault();
            alert("Tambahkan produk ke keranjang terlebih dahulu!");
            return;
        }

        // Hapus input lama jika ada
        const existingInput = form.querySelector('input[name="items"]');
        if (existingInput) {
            existingInput.remove();
        }

        // Tambahkan input baru
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'items';
        input.value = JSON.stringify(cartItems);
        form.appendChild(input);
    });
});
</script>
@endsection