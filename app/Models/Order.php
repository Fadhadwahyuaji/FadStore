<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alamat_id',
        'kode_order',
        'total_harga',
        'total_ongkir',
        'total_diskon',
        'grand_total',
        'status',
        'voucher_id',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function detailOrder()
    {
        return $this->hasMany(DetailOrder::class);
    }

    public function pengiriman()
    {
        return $this->hasOne(Pengiriman::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function generateKodeOrder()
    {
        return 'FAD-' . strtoupper(substr(md5(time()), 0, 8));
    }
}
