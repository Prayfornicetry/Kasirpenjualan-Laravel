@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="card p-4">
    <h3>Edit Produk: {{ $product->name }}</h3>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $product->category) }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga (Rp)</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" min="0" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" name="stock" id="stock" class="form-control" min="0" value="{{ old('stock', $product->stock) }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Produk (Opsional)</label>
            <input type="file" name="image" id="image" class="form-control">
            @if($product->image_path)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="Current Image" class="img-thumbnail" style="max-height: 100px;">
                </div>
            @endif
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-custom">Perbarui Produk</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection