<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Voucher;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    function keranjang()
    {
        $keranjang = Keranjang::where('user_id', auth()->user()->id)->with('produk')->get();

        return view('customer.keranjang', compact('keranjang'));
    }

    public function tambahKeranjang(Request $request, Produk $produk)
    {
        // Logika untuk menambah produk ke keranjang
        $keranjang = new Keranjang();
        $keranjang->user_id = auth()->user()->id; // Sesuaikan dengan cara Anda mengelola pengguna
        $keranjang->produk_id = $produk->id;
        // $keranjang->pesanan_id ='0';
        $keranjang->jumlah = 1; // Default quantity, bisa diubah sesuai kebutuhan
        $keranjang->sub_total = $produk->harga;
        $keranjang->save();

        $this->updateTotalPesanan(auth()->user()->id);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function tambahQuantity(Request $request, $keranjang_id)
    {
        $keranjang = Keranjang::find($keranjang_id);
        $keranjang->jumlah = $request->input('jumlah');
        $keranjang->save();

        $this->updateTotalPesanan(auth()->user()->id);

        return redirect()->back()->with('success', 'Quantity updated successfully.');
    }

    public function removeFromCart(Request $request, $id)
    {
        $cart = Keranjang::find($id);

        if (!$cart) {
            return redirect()->back()->with('error', 'Item tidak ditemukan dalam keranjang.');
        }

        $cart->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    private function updateTotalPesanan($user_id)
    {
        $total = Keranjang::where('user_id', $user_id)->sum('sub_total');

        // Simpan total pesanan ke dalam tabel pesanan
        $pesanan = Keranjang::where('user_id', $user_id)->first();
        if ($pesanan) {
            // $pesanan->sub_total = $sub_total;
            $pesanan->save();
        }
    }
}