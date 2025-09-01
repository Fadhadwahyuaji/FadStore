<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function create()
    {
        return view('admin.vouchers.create');
    }

    /**
     * Simpan voucher baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'kode'            => 'required|string|unique:vouchers,kode',
            'jenis'           => 'required|in:persen,nominal',
            'nilai'           => 'required|integer|min:1',
            'min_belanja'     => 'nullable|integer|min:0',
            'maks_diskon'     => 'nullable|integer|min:0',
            'jumlah_tersedia' => 'required|integer|min:1',
            'berlaku_hingga'  => 'required|date|after:today',
        ]);

        // Buat voucher baru
        Voucher::create($validated);

        // Redirect ke halaman voucher (misalnya ke index voucher admin)
        return redirect()->route('admin.vouchers.create')->with('success', 'Voucher berhasil ditambahkan.');
    }
}
