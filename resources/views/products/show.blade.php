@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>{{ $product->name }}</h3>
        </div>
        <div class="card-body">
            @if($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" class="img-fluid rounded mb-3" alt="{{ $product->name }}">
            @else
                <div class="text-muted mb-3">Tidak ada gambar</div>
            @endif

            <p><strong>Kategori:</strong> {{ $product->category }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p><strong>Stok:</strong> {{ $product->stock }}</p>
            <p><strong>Dibuat:</strong> {{ $product->created_at->format('d M Y H:i') }}</p>

            <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>

            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection