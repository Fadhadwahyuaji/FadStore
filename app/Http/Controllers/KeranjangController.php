<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    function keranjang(){
        $produks = Produk::all();

        return view('pembeli.keranjang', compact('produks'));
    }
}
