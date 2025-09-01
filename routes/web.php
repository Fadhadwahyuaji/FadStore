<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\VoucherController;
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

    Route::middleware(['role:customer'])->group(function () {
        // Pembeli
        Route::get('/beranda', [PembeliController::class, 'beranda'])->name('beranda');
        // Route::get('/ongkir', [RajaOngkirController::class, 'getOngkir']);

        //keranjang
        Route::get('/keranjangku', [KeranjangController::class, 'keranjang'])->name('keranjang');
        Route::get('/tambah-keranjang/{produk}', [KeranjangController::class, 'tambahKeranjang'])->name('tambah.keranjang');
        Route::put('/tambah-quantity/{keranjang_id}', [KeranjangController::class, 'tambahQuantity'])->name('tambah.quantity');
        Route::delete('/hapus-keranjang/{id}', [KeranjangController::class, 'removeFromCart'])->name('hapus.keranjang');

        // Checkout
        Route::post('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.get');

        // Raja Ongkir
        // Route::get('/alamat/cities/{provinceId}', [CheckoutController::class, 'getCities'])->name('alamat.getCities');
        // Route::post('/calculate-shipping', [CheckoutController::class, 'calculateShipping'])->name('calculateShipping');

        //Alamat
        Route::post('/alamat/store', [AlamatController::class, 'storeAlamat'])->name('alamat.store');
        Route::post('/alamat/set-default', [AlamatController::class, 'setDefault'])->name('alamat.set-default');
        Route::get('/alamat/edit/{id}', [AlamatController::class, 'edit'])->name('alamat.edit');
        Route::put('/alamat/update/{id}', [AlamatController::class, 'update'])->name('alamat.update');
        Route::delete('/alamat/delete/{id}', [AlamatController::class, 'destroy'])->name('alamat.destroy');

        //midtrans
        Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
        Route::post('/payment/notification', [PaymentController::class, 'notification']);
        Route::get('/payment/finish', [PaymentController::class, 'finish'])->name('payment.finish');

        // Voucher
        Route::post('/voucher/cek', [VoucherController::class, 'cekVoucher'])->name('voucher.cek');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
