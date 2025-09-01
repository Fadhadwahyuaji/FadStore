<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vouchers')->insert([
            [
                'kode' => 'FIRSTBUY',
                'jenis' => 'persen',
                'nilai' => 20,
                'min_belanja' => 50000,
                'maks_diskon' => 500000,
                'jumlah_tersedia' => 1000,
                'berlaku_hingga' => Carbon::now()->addDays(365),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'HEMAT20K',
                'jenis' => 'nominal',
                'nilai' => 20000,
                'min_belanja' => 100000,
                'maks_diskon' => null,
                'jumlah_tersedia' => 50,
                'berlaku_hingga' => Carbon::now()->addDays(90),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'FLASHSALE',
                'jenis' => 'persen',
                'nilai' => 25,
                'min_belanja' => 0,
                'maks_diskon' => 15000,
                'jumlah_tersedia' => 10,
                'berlaku_hingga' => Carbon::now()->addDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
