<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use App\Models\Order;
use App\Models\DetailOrder;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        // Validasi data
        $request->validate([
            'alamat_id' => 'required|exists:alamats,id',
            'shipping_method' => 'required',
            'shipping_cost' => 'required|numeric'
        ]);

        // Hitung total pembayaran
        $grandTotal = $request->total + $request->shipping_cost - $request->discount;

        // Buat order
        $order = Order::create([
            'user_id' => auth()->id(),
            'alamat_id' => $request->alamat_id,
            'kode_order' => 'ORD-' . Str::upper(Str::random(10)),
            'total_harga' => $request->total,
            'total_ongkir' => $request->shipping_cost,
            'total_diskon' => $request->discount,
            'grand_total' => $grandTotal,
            'status' => 'pending',
            'voucher_id' => $request->voucher_id,
            'payment_method' => 'midtrans',
            'payment_status' => 'pending'
        ]);

        // Simpan detail order
        foreach ($request->cart_items as $item) {
            DetailOrder::create([
                'order_id' => $order->id,
                'produk_id' => $item['produk_id'],
                'jumlah' => $item['jumlah'],
                'harga' => $item['harga'],
                'subtotal' => $item['subtotal']
            ]);
        }

        // Siapkan parameter Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $order->kode_order,
                'gross_amount' => $grandTotal,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->alamat->where('is_default', true)->first()->no_hp,
            ],
            'enabled_payments' => [
                'credit_card', 'bca_va', 'bni_va', 'bri_va', 'gopay', 'shopeepay'
            ],
            'callbacks' => [
                'finish' => route('payment.finish')
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function notification(Request $request)
    {
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderId = $notif->order_id;
        $fraud = $notif->fraud_status;

        $order = Order::where('kode_order', $orderId)->first();

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $order->payment_status = 'challenge';
                } else {
                    $order->payment_status = 'success';
                }
            }
        } elseif ($transaction == 'settlement') {
            $order->payment_status = 'success';
        } elseif ($transaction == 'pending') {
            $order->payment_status = 'pending';
        } elseif ($transaction == 'deny') {
            $order->payment_status = 'denied';
        } elseif ($transaction == 'expire') {
            $order->payment_status = 'expired';
        } elseif ($transaction == 'cancel') {
            $order->payment_status = 'canceled';
        }

        $order->save();
        return response()->json(['status' => 'success']);
    }
}
