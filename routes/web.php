<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\LaporanPenjualanController;

// Halaman publik
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman yang hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    // Produk
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::resource('products', ProductController::class);

    // Transaksi — ✅ HANYA SATU RESOURCE ROUTE
    Route::resource('transaksi', TransaksiController::class);
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');

    

Route::get('/laporan', [LaporanPenjualanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/{id}/edit', [LaporanPenjualanController::class, 'edit'])->name('laporan.edit');
Route::put('/laporan/{id}', [LaporanPenjualanController::class, 'update'])->name('laporan.update');
Route::delete('/laporan/{id}', [LaporanPenjualanController::class, 'destroy'])->name('laporan.destroy');
Route::get('/laporan/export', [LaporanPenjualanController::class, 'export'])->name('laporan.export');



Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');

// Tambahkan ini:
Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');
Route::post('/transaksi/add-to-cart', [TransaksiController::class, 'addToCart'])->name('transaksi.addToCart');


});