<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Order;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\User;
use Dipantry\Rajaongkir\Models\ROCity;
use Dipantry\Rajaongkir\Models\ROProvince;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function pay(Request $request)
    {
        DB::transaction(function () use ($request) {
            // $order = Pesanan::all();
            $donation = \App\Models\Donation::create([
                'code'   => 'DONATION-' . mt_rand(100000, 999999),
                'name'   => 'Fadhad Wahyu Aji',
                'email'  => 'pembeli@fadstore.com',
                'amount' => 115000,
                // 'amount' => $order->total,
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

    public function store(Request $request)
    {
        // Ambil ID pengguna yang sedang login
        $user = auth()->user();
        $keranjangItems = Keranjang::with('produk')->where('user_id', $user)->get();
        $subTotal = $keranjangItems->sum('sub_total');
        $layananPengiriman = $request->input('layanan_pengiriman');
        $ongkosKirim = 0;

        switch ($layananPengiriman) {
            case 'jnt':
                $ongkosKirim = 15000;
                break;
            case 'jne':
                $ongkosKirim = 15000;
                break;
            case 'pos':
                $ongkosKirim = 20000;
                break;
            case 'tiki':
                $ongkosKirim = 18000;
                break;
            default:
                $ongkosKirim = 0;
                break;
        }

        $TotalPesanan = $subTotal + $ongkosKirim;

        // Simpan pesanan ke dalam tabel pesanans
        $order = Order::create([
            'code' => 'FADSTORE-' . mt_rand(100000, 999999),
            'user_id' => $user->id,
            'nama' => $user->name,
            'email' => $user->email,
            'no_hp' => $request->input('no_hp'),
            'ongkir' => $ongkosKirim,
            'layanan_pengiriman' => $layananPengiriman,
            'total' => $TotalPesanan,
            'provinsi' => $request->input('provinsi'),
            'kabupaten' => $request->input('kabupaten'),
            'kecamatan' => $request->input('kecamatan'),
            'detail_alamat' => $request->input('detail_alamat'),
            'status' => 'pending',
            'tanggal_pesanan' => now(),
        ]);


        // Perbarui pesanan_id di setiap item keranjang yang terkait
        $keranjangItems->each(function ($item) use ($order) {
            $item->update(['pesanan_id' => $order->id]);
        });

        $order->save();

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }


    // public function pay(Request $request)
    // {


    //     return DB::transaction(function () use ($request) {
    //         $user = auth()->user();
    //     $order = Pesanan::where('user_id', $user->id)
    //         ->where('status', 'pending') // Sesuaikan dengan status yang sesuai
    //         ->first();
    //         // Buat catatan pembayaran di tabel pembayarans
    //         $pembayaran = Pembayaran::create([
    //             // 'pesanan_id'       => $order->id,
    //             'metode_pembayaran' => 'midtrans', // Gantilah sesuai dengan metode pembayaran yang digunakan
    //             'status'             => 'pending', // Atur status pembayaran sesuai kebutuhan
    //             'code'             => 'FADSTORE-' . mt_rand(100000, 999999),
    //             'name'             => $user->name,
    //             'email'            => $user->email,
    //             'amount'           => 120000, // Sesuaikan dengan jumlah yang benar
    //             // Tambahkan atribut lain yang diperlukan
    //         ]);

    //         // Lanjutkan dengan proses pembayaran menggunakan Midtrans
    //         $payload = [
    //             'transaction_details' => [
    //                 'order_id'     => $pembayaran->code,
    //                 'gross_amount' => $pembayaran->amount,
    //             ],
    //             'customer_details' => [
    //                 'first_name' => $pembayaran->name,
    //                 'email'      => $pembayaran->email,
    //             ],
    //             'item_details' => [
    //                 'id'            => $pembayaran->code,
    //                 'price'         => 120000,
    //                 'quantity'      => 1,
    //                 'name'          => 'Donation to ' . config('app.name'),
    //                 'brand'         => 'FADSTORE',
    //                 'category'      => 'E-Commerce',
    //                 'merchant_name' => config('app.name'),
    //             ],
    //         ];
    //         // dd('Debugging checkpoint');

    //         $snapToken = \Midtrans\Snap::getSnapToken($payload);
    //         $pembayaran->snap_token = $snapToken;
    //         $pembayaran->save();

    //         $this->response['snap_token'] = $snapToken;

    //     });
    //         return response()->json([
    //             'status'     => 'success',
    //             'snap_token' => $this->response,
    //         ]);



    // }


    function checkout(Request $request)
    {
        $userId = Auth::id();
        $keranjangItems = Keranjang::with('produk')->where('user_id', $userId)->get();
        $totalPesanan = $keranjangItems->sum('sub_total');

        // Simpan pesanan ke dalam tabel pesanans
        $order = Order::All();
        // $order->keranjangs()->createMany($keranjangItems->toArray());
        // Hapus keranjang setelah checkout
        // Keranjang::where('user_id', $userId)->delete();

        $user = auth()->user(); // Menggunakan fungsi auth() untuk mendapatkan user yang sedang login
        $provinces = ROProvince::all();
        $kotas = ROCity::all();

        return view('customer.checkout', compact('user', 'order', 'totalPesanan', 'keranjangItems', 'provinces', 'kotas'));
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
