<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    function beranda(){
        $produks = Produk::all();

        return view('pembeli.beranda', compact('produks'));
    }
    
}
