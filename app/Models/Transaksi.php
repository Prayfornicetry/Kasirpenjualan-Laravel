<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'transaksi_id',
        'nama_produk',
        'pesanan',
        'total_harga',
        'tanggal_pemesanan',
        'nama_pelanggan',
        'email_pelanggan',
        'no_telp'
    ];

    protected $casts = [
        'tanggal_pemesanan' => 'datetime:Y-m-d H:i',
    ];

    public function detail()
{
    return $this->hasMany(TransaksiDetail::class);
}

}