<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->integer('pesanan');
            $table->decimal('total_harga', 10, 2);
            $table->dateTime('tanggal_pemesanan')->default(now());
            $table->string('nama_pelanggan');
            $table->string('email_pelanggan')->nullable();
            $table->string('no_telp')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};