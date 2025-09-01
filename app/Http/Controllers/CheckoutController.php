<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Keranjang;
use App\Models\Voucher;
use App\Services\RajaOngkirService;
use Exception;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected $rajaOngkir;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Ambil data dari request, jika tidak ada ambil dari session
        $selectedCartIds = $request->input('selected_cart_ids', session('selected_cart_ids'));

        if (!$selectedCartIds || count($selectedCartIds) === 0) {
            // Alihkan ke halaman keranjang jika tidak ada data yang tersedia
            return redirect()->route('keranjang.index')->with('error', 'Tidak ada produk yang dipilih untuk checkout.');
        }

        // Jika data berasal dari POST, simpan ke session
        if ($request->isMethod('post') && $request->input('selected_cart_ids')) {
            session(['selected_cart_ids' => $selectedCartIds]);
        }

        // Karena integrasi RajaOngkir dinonaktifkan, kita set flag ini ke false
        $rajaOngkirAvailable = false;

        // Ambil data keranjang yang dipilih dengan relasi produk
        $cartItems = Keranjang::whereIn('id', $selectedCartIds)
            ->with('produk')
            ->get();

        // Update jumlah dan subtotal berdasarkan input
        $quantities = $request->input('jumlah');
        foreach ($cartItems as $item) {
            if (isset($quantities[$item->id])) {
                $item->jumlah = (int)$quantities[$item->id];
                $item->sub_total = $item->jumlah * $item->produk->harga;
            }
        }

        // Dapatkan voucher (jika ada)
        $voucherCode = $request->input('voucher_code');
        $voucher = null;
        if ($voucherCode) {
            $voucher = Voucher::where('kode', $voucherCode)->first();
        }

        // Hitung total belanja
        $subtotal = $cartItems->sum('sub_total');
        $discount = 0;
        if ($voucher && $subtotal >= $voucher->min_belanja) {
            if ($voucher->jenis === 'persen') {
                $discount = $subtotal * ($voucher->nilai / 100);
                if ($voucher->maks_diskon) {
                    $discount = min($discount, $voucher->maks_diskon);
                }
            } else {
                $discount = $voucher->nilai;
            }
        }
        $total = $subtotal - $discount;

        $cartItemsArray = $cartItems->map(function ($item) {
            return [
                'produk_id' => $item->produk_id,
                'jumlah' => $item->jumlah,
                'harga' => $item->produk->harga,
                'subtotal' => $item->sub_total
            ];
        });

        // Kirim data ke view checkout
        return view('customer.checkout', compact(
            'cartItems',
            'voucher',
            'subtotal',
            'discount',
            'total',
            'cartItemsArray'
        ));
    }
}
