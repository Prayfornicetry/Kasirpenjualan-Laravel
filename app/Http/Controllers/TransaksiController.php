<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::orderBy('tanggal_pemesanan', 'desc')->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)->get(); // hanya tampilkan produk yang stoknya tersedia
        return view('transaksi.create', compact('products'));
    }

public function store(Request $request)
{
    $request->validate([
    'product_id' => 'required|exists:products,id',
    'quantity' => 'required|integer|min:1',
    'nama_pelanggan' => 'required|string|max:255',
    'email_pelanggan' => 'nullable|email',
    'no_telp' => 'nullable|string|max:20',
]);

    $product = Product::findOrFail($request->product_id);

    if ($product->stock < $request->quantity) {
        return back()->withErrors(['quantity' => 'Stok tidak mencukupi!']);
    }

    $totalHarga = $product->price * $request->quantity;
    $product->decrement('stock', $request->quantity);

    Transaksi::create([
        'nama_produk' => $product->name,
        'pesanan' => $request->quantity,
        'total_harga' => $totalHarga,
        'tanggal_pemesanan' => now(),
        'nama_pelanggan' => $request->nama_pelanggan,
        'email_pelanggan' => $request->email_pelanggan,
        'no_telp' => $request->no_telp,
    ]);

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');
}
public function edit($id)
{
     $transaksi = Transaksi::findOrFail($id);
    $products = Product::all(); // atau where('stock', '>', 0)
    return view('transaksi.edit', compact('transaksi', 'products'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'pesanan' => 'required|integer|min:1',
        'tanggal_pemesanan' => 'required|date',
        'nama_pelanggan' => 'required|string|max:255',
        'email_pelanggan' => 'nullable|email',
        'no_telp' => 'nullable|string|max:20',
    ]);

    $transaksi = Transaksi::findOrFail($id);
    $product = Product::findOrFail($request->product_id);

    // Cek stok
    if ($product->stock < $request->pesanan) {
        return back()->withErrors(['pesanan' => 'Stok tidak mencukupi!']);
    }

    // Hitung ulang total harga
    $totalHarga = $product->price * $request->pesanan;

    // Update transaksi
    $transaksi->update([
        'nama_produk' => $product->name,
        'pesanan' => $request->pesanan,
        'total_harga' => $totalHarga,
        'tanggal_pemesanan' => $request->tanggal_pemesanan,
        'nama_pelanggan' => $request->nama_pelanggan,
        'email_pelanggan' => $request->email_pelanggan,
        'no_telp' => $request->no_telp,
    ]);

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui!');
}

public function destroy($id)
{
    $transaksi = Transaksi::findOrFail($id);
    $transaksi->delete();

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
}

public function cetak($id)
{
    $transaksi = Transaksi::findOrFail($id);

    // Jika ingin cetak PDF, gunakan library dompdf
    // Untuk sekarang, kita buat view sederhana untuk print

    return view('transaksi.struk', compact('transaksi'));
}
}