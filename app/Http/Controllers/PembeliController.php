<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    function beranda()
    {
        $produks = Produk::take(8)->get();

        return view('customer.beranda', compact('produks'));
    }

    function produkAll()
    {
        $produks = Produk::all();

        return view('customer.produk', compact('produks'));
    }
}
