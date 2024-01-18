<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('pembeli.beranda');
// });
Route::get('/', [PembeliController::class, 'beranda'])->name('beranda');

Route::middleware('auth')->group(function () {

    Route::middleware(['role:admin'])->group(function () {
// Admin
Route::get('/data-produk', [AdminController::class, 'produk'])->name('produk');
Route::get('/tambah-data-produk', [AdminController::class, 'tambah_produk'])->name('tambah.produk');
Route::post('/store-data-produk', [AdminController::class, 'store'])->name('store.produk');
Route::delete('/hapus-produk/{id}', [AdminController::class, 'destroy'])->name('destroy.produk');
Route::get('/edit-produk/{id}', [AdminController::class, 'edit'])->name('edit.produk');
Route::put('/update-produk/{id}', [AdminController::class, 'update'])->name('update.produk');
    });

    Route::middleware(['role:pembeli'])->group(function () {
// Pembeli
Route::get('/beranda', [PembeliController::class, 'beranda'])->name('beranda');

//keranjang
Route::get('/keranjangku', [KeranjangController::class, 'keranjang'])->name('keranjang');
Route::get('/tambah-keranjang/{produk}', [KeranjangController::class, 'tambahKeranjang'])->name('tambah.keranjang');
Route::put('/tambah-quantity/{keranjang_id}', [KeranjangController::class, 'tambahQuantity'])->name('tambah.quantity');
Route::delete('/hapus-keranjang/{id}', [KeranjangController::class, 'removeFromCart'])->name('hapus.keranjang');

//midtrans
Route::get('/detail-pesanan', [PesananController::class, 'pesanan'])->name('pesanan');
Route::get('/checkout', [PesananController::class, 'checkout'])->name('checkout');
Route::post('/pesanan/bayar', [PesananController::class, 'pay'])->name('pesanan.bayar');


    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
