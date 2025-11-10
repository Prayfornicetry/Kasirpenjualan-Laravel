<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class PelangganController extends Controller
{
    public function index()
    {
        // Ambil semua transaksi yang memiliki nama pelanggan
        $transaksi = Transaksi::select('nama_pelanggan', 'email_pelanggan', 'no_telp', 'total_harga', 'tanggal_pemesanan')
            ->whereNotNull('nama_pelanggan')
            ->orderBy('nama_pelanggan')
            ->get();

        // Proses data di PHP untuk menggabungkan informasi pelanggan unik
        $pelangganMap = [];
        foreach ($transaksi as $t) {
            $nama = $t->nama_pelanggan;

            if (!isset($pelangganMap[$nama])) {
                // Inisialisasi entri baru untuk pelanggan ini
                $pelangganMap[$nama] = [
                    'nama_pelanggan' => $nama,
                    'email_pelanggan' => null, // Akan diisi jika ditemukan
                    'no_telp' => null,         // Akan diisi jika ditemukan
                    'total_belanja' => 0,
                    'jumlah_transaksi' => 0,
                    'terakhir_beli' => null,
                ];
            }

            // Update info pelanggan dengan data dari transaksi
            // Prioritaskan data yang bukan null, jika sebelumnya null
            if (!$pelangganMap[$nama]['email_pelanggan'] && $t->email_pelanggan) {
                $pelangganMap[$nama]['email_pelanggan'] = $t->email_pelanggan;
            }
            if (!$pelangganMap[$nama]['no_telp'] && $t->no_telp) {
                $pelangganMap[$nama]['no_telp'] = $t->no_telp;
            }

            // Akumulasi total belanja
            $pelangganMap[$nama]['total_belanja'] += $t->total_harga;

            // Tambah jumlah transaksi
            $pelangganMap[$nama]['jumlah_transaksi']++;

            // Update tanggal terakhir beli jika transaksi ini lebih baru
            if (!$pelangganMap[$nama]['terakhir_beli'] || $t->tanggal_pemesanan > $pelangganMap[$nama]['terakhir_beli']) {
                $pelangganMap[$nama]['terakhir_beli'] = $t->tanggal_pemesanan;
            }
        }

        // Konversi map menjadi koleksi atau array untuk ditampilkan di view
        $pelanggan = collect(array_values($pelangganMap))->sortBy('nama_pelanggan');

        return view('pelanggan.index', compact('pelanggan'));
    }
}