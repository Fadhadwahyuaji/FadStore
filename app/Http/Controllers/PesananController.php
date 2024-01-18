<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    protected $response = [];

    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }


    public function pay(Request $request){
        DB::transaction(function() use($request) { 
            $user = User::find(auth()->user()->id);
            $total = Keranjang::where('user_id', auth()->user()->id)->sum('total');
            $donation = \App\Models\Pesanan::create([
                'code'   => 'FADSTORE-' . mt_rand(100000, 999999),
                'name'   => $user->name,
                'email'  => $user->email,
                'amount' => $total,
                // 'note'   => $request->note,
            ]);

            $payload = [
                'transaction_details' => [
                    'order_id'     => $donation->code,
                    'gross_amount' => $donation->amount,
                ],
                'customer_details' => [
                    'first_name' => $donation->name,
                    'email'      => $donation->email,
                ],
                'item_details' => [
                    [
                        'id'            => $donation->code,
                        'price'         => $donation->amount,
                        'quantity'      => 1,
                        'name'          => 'Donation to ' . config('app.name'),
                        'brand'         => 'Donation',
                        'category'      => 'Donation',
                        'merchant_name' => config('app.name'),
                    ],
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($payload);
            $donation->snap_token = $snapToken;
            $donation->save();

            $this->response['snap_token'] = $snapToken;
        });

        return response()->json([
            'status'     => 'success',
            'snap_token' => $this->response,
        ]);
    }
    
    function pesanan() {
        $keranjang = Keranjang::where('user_id', auth()->user()->id);
        $user = auth()->user(); // Menggunakan fungsi auth() untuk mendapatkan user yang sedang login
    
        return view('pembeli.pesanan', compact('user', 'total'));
    }

    function checkout() {
        $total = Keranjang::where('user_id', auth()->user()->id)->sum('total');
        $user = auth()->user(); // Menggunakan fungsi auth() untuk mendapatkan user yang sedang login
    
        return view('pembeli.checkout', compact('user', 'total'));
    }
   

    // public function pay(Request $request)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $user = User::find(auth()->user()->id);

    //         // Ambil data keranjang dari tabel keranjang berdasarkan user ID
    //         $total = Keranjang::where('user_id', auth()->user()->id)->sum('total');

    //         $order = Pesanan::create([
    //             'no_pesanan'   => 'FADSTORE-' . mt_rand(100000, 999999),
    //             'nama'         => $user->name,
    //             'email'        => $user->email,
    //             'total'        => $total,
    //             'note'         => " ",
    //         ]);

    //         $payload = [
    //             'transaction_details' => [
    //                 'order_id'     => $order->no_pesanan,
    //                 'gross_amount' => (int)$order->total,
    //             ],
    //             'customer_details' => [
    //                 'first_name' => $order->nama,
    //                 'email'      => $order->email,
    //             ],
    //             'item_details' => [
    //                 [
    //                     'id'            => $order->no_pesanan,
    //                     'price'         => $order->total,
    //                     'quantity'      => 1,
    //                     'name'          => 'Order from ' . config('app.name'),
    //                     'brand'         => 'Product',
    //                     'category'      => 'Product',
    //                     'merchant_name' => config('app.name'),
    //                 ],
    //             ],
    //         ];

    //         $snapToken = \Midtrans\Snap::getSnapToken($payload);
    //         $order->snap_token = $snapToken;
    //         $order->save();

    //         $this->response['snap_token'] = $snapToken;

    //         DB::commit();

    //         return response()->json([
    //             'status'     => 'success',
    //             'snap_token' => $this->response,
    //         ]);
    //     } catch (\Exception $e) {
    //         DB::rollback();

    //         return response()->json([
    //             'status'  => 'error',
    //             'message' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
}
