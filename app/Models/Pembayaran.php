<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'midtrans_id',
        'snap_token',
        'metode_pembayaran',
        'bank',
        'va_number',
        'status',
        'tanggal_bayar',
        'expired_at',
        'response_midtrans',
    ];

    protected $casts = [
        'tanggal_bayar' => 'datetime',
        'expired_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
