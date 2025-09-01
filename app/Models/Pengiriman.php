<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'kurir',
        'layanan',
        'ongkir',
        'no_resi',
        'estimasi_hari',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
