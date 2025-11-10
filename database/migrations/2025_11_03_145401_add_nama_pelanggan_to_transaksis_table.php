<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) { // ← PASTIKAN NAMA TABEL INI!
            $table->string('nama_pelanggan')->nullable()->after('nama_produk');
            $table->string('email_pelanggan')->nullable()->after('nama_pelanggan');
            $table->string('no_telp')->nullable()->after('email_pelanggan');
        });
    }

    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn(['nama_pelanggan', 'email_pelanggan', 'no_telp']);
        });
    }
};