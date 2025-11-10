@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Produk Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama Produk -->
        <div class="form-group mb-3">
            <label for="name">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <!-- Kategori -->
        <div class="form-group mb-3">
            <label for="category">Kategori</label>
            <select class="form-control" id="category" name="category" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="makanan" {{ old('category') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                <option value="minuman" {{ old('category') == 'minuman' ? 'selected' : '' }}>Minuman</option>
                <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>

        <!-- Harga -->
        <div class="form-group mb-3">
            <label for="price">Harga</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
        </div>

        <!-- Stok -->
        <div class="form-group mb-3">
            <label for="stock">Stok</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" required>
        </div>

        <!-- Gambar -->
        <div class="form-group mb-3">
            <label for="image_path">Unggah Gambar Produk</label>
            <input type="file" class="form-control" id="image_path" name="image_path" accept="image/*">
            <small class="form-text text-muted">Opsional. Format: JPG, PNG, GIF.</small>
        </div>

        <!-- Deskripsi (opsional) -->
        <div class="form-group mb-3">
            <label for="description">Deskripsi (Opsional)</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <!-- Tombol -->
        <button type="submit" class="btn btn-success">Simpan Produk</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection