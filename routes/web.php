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
*/

// Halaman beranda publik
Route::get('/beranda', [PembeliController::class, 'beranda'])->name('beranda');
// Root diarahkan ke beranda
Route::redirect('/', '/beranda');

// Notifikasi pembayaran (callback Midtrans) - tanpa auth
Route::post('/payment/notification', [PaymentController::class, 'notification'])->name('payment.notification');

Route::middleware('auth')->group(function () {
    // Admin
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:admin')
        ->group(function () {
            // Menyerupai pola resource untuk "produk"
            Route::get('/produk', [AdminController::class, 'produk'])->name('produk.index');
            Route::get('/produk/create', [AdminController::class, 'tambah_produk'])->name('produk.create');
            Route::post('/produk', [AdminController::class, 'store'])->name('produk.store');
            Route::get('/produk/{id}/edit', [AdminController::class, 'edit'])->name('produk.edit');
            Route::put('/produk/{id}', [AdminController::class, 'update'])->name('produk.update');
            Route::delete('/produk/{id}', [AdminController::class, 'destroy'])->name('produk.destroy');
        });

    // Customer
    Route::middleware('role:customer')
        ->name('customer.')
        ->group(function () {
            // Keranjang
            Route::prefix('keranjang')->name('keranjang.')->group(function () {
                Route::get('/', [KeranjangController::class, 'keranjang'])->name('index');
                // Disarankan POST untuk menambah item (lebih aman daripada GET)
                Route::post('/tambah/{produk}', [KeranjangController::class, 'tambahKeranjang'])->name('tambah');
                Route::put('/{keranjang_id}/quantity', [KeranjangController::class, 'tambahQuantity'])->name('quantity');
                Route::delete('/{id}', [KeranjangController::class, 'removeFromCart'])->name('hapus');
                Route::delete('/selected', [KeranjangController::class, 'deleteSelected'])->name('hapus.selected');
            });
            // Backward compatibility untuk URL lama
            Route::get('/keranjangku', fn() => redirect()->route('customer.keranjang.index'))->name('keranjang.legacy');

            // Checkout
            Route::prefix('checkout')->name('checkout.')->group(function () {
                Route::get('/', [CheckoutController::class, 'index'])->name('index');
                // Sementara tetap pakai method index agar tidak memecah controller yang ada
                Route::post('/', [CheckoutController::class, 'index'])->name('submit');
            });

            // Alamat
            Route::prefix('alamat')->name('alamat.')->group(function () {
                Route::post('/', [AlamatController::class, 'storeAlamat'])->name('store');
                Route::post('/default', [AlamatController::class, 'setDefault'])->name('set-default');
                Route::get('/{id}/edit', [AlamatController::class, 'edit'])->name('edit');
                Route::put('/{id}', [AlamatController::class, 'update'])->name('update');
                Route::delete('/{id}', [AlamatController::class, 'destroy'])->name('destroy');
            });

            // Pembayaran (yang butuh sesi user)
            Route::prefix('payment')->name('payment.')->group(function () {
                Route::post('/process', [PaymentController::class, 'process'])->name('process');
                Route::get('/finish', [PaymentController::class, 'finish'])->name('finish');
            });

            // Voucher
            Route::prefix('voucher')->name('voucher.')->group(function () {
                Route::post('/cek', [VoucherController::class, 'cekVoucher'])->name('cek');
            });

            // Raja Ongkir (contoh)
            //            Route::prefix('ongkir')->name('ongkir.')->group(function () {
            //                Route::get('/alamat/cities/{provinceId}', [CheckoutController::class, 'getCities'])->name('alamat.getCities');
            //                Route::post('/calculate-shipping', [CheckoutController::class, 'calculateShipping'])->name('calculateShipping');
            //            });
        });
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');