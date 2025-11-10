<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class LaporanPenjualanController extends Controller
{
    public function index()
    {
        $laporan = Transaksi::orderBy('tanggal_pemesanan', 'desc')->get();
        return view('laporan.index', compact('laporan'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('laporan.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'pesanan' => 'required|integer|min:1',
            'total_harga' => 'required|numeric',
            'tanggal_pemesanan' => 'required|date',
            'nama_pelanggan' => 'required|string|max:255',
            'email_pelanggan' => 'nullable|email',
            'no_telp' => 'nullable|string|max:20',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($request->all());

        return redirect()->route('laporan.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('laporan.index')->with('success', 'Transaksi berhasil dihapus!');
    }

    // Opsi: Simpan laporan ke Excel/PDF (opsional)
    public function export()
    {
        $laporan = Transaksi::orderBy('tanggal_pemesanan', 'desc')->get();

        // Contoh sederhana: download CSV
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="laporan_penjualan.csv"',
        ];

        $columns = ['No', 'Nama Produk', 'Pesanan', 'Total Harga', 'Tanggal Pemesanan', 'Nama Pelanggan', 'Email', 'No. Telepon'];

        $callback = function() use ($laporan, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($laporan as $item) {
                fputcsv($file, [
                    $item->id,
                    $item->nama_produk,
                    $item->pesanan,
                    $item->total_harga,
                    $item->tanggal_pemesanan,
                    $item->nama_pelanggan,
                    $item->email_pelanggan,
                    $item->no_telp
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}