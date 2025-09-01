<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode', 'jenis', 'nilai', 'min_belanja', 'maks_diskon', 'jumlah_tersedia', 'berlaku_hingga'
    ];

    public function isValid()
    {
        return $this->jumlah_tersedia > 0 && now()->lessThanOrEqualTo($this->berlaku_hingga);
    }
}
