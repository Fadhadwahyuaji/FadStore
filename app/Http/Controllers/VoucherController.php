<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function cekVoucher(Request $request)
    {
        $request->validate(['kode' => 'required|string']);

        $voucher = Voucher::where('kode', $request->kode)->first();

        if (!$voucher || !$voucher->isValid()) {
            return response()->json(['error' => 'Voucher tidak valid atau sudah habis'], 400);
        }

        return response()->json([
            'kode' => $voucher->kode,
            'jenis' => $voucher->jenis,
            'nilai' => $voucher->nilai,
            'min_belanja' => $voucher->min_belanja,
            'maks_diskon' => $voucher->maks_diskon
        ]);
    }
}
