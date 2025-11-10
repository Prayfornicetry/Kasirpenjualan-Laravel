<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->string('transaksi_id')->nullable()->after('id'); // ID unik untuk kelompok transaksi
        });
    }

    public function down() {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn('transaksi_id');
        });
    }
};