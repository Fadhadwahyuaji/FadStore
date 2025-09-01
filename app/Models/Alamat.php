<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;


    protected $table = 'alamats';

    protected $fillable = [
        'user_id',
        'alamat_lengkap',
        'nama_penerima',
        'no_hp',
        'kode_pos',
        'is_default',
        'label',
        'tambahan',
        // 'city',
        // 'province',
        'kota',
        'provinsi',
    ];

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
