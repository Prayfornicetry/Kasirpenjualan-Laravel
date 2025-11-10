@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')
<div class="card p-4">
    <h3 class="mb-4">Kelola Produk</h3>

    <div class="d-flex justify-content-between mb-3">
        <form action="{{ route('products.index') }}" method="GET" class="d-flex">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control" placeholder="Cari Produk..." value="{{ request('search') }}">
            </div>
        </form>

        <a href="{{ route('products.create') }}" class="btn btn-custom">Tambah Produk</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="bg-info text-white">
                <tr>
                    <th>NO</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $product)
                <tr>
                    <td>{{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->formatted_price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        @if($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="Gambar" class="img-thumbnail">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada produk ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $products->links() }}
</div>
@endsection