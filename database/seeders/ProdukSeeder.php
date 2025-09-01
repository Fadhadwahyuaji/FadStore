<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Lakukan truncate pada tabel
        Produk::truncate();

        // Aktifkan kembali cek foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Data produk yang akan diisi
        $produkData = [
            [
                'gambar' => 'tshirt.jpeg',
                'nama' => 'T-shirt Casual Day',
                'deskripsi' => 'Deskripsi Produk 1',
                'harga' => 150000,
                'jumlah' => 50,
            ],
            [
                'gambar' => 'Caps.png',
                'nama' => 'Topi Casual Day',
                'deskripsi' => 'Deskripsi Produk 2',
                'harga' => 100000,
                'jumlah' => 30,
            ],
            [
                'gambar' => 'Bucket-Hats.png',
                'nama' => 'Topi Ember Casual Day',
                'deskripsi' => 'Deskripsi Produk 3',
                'harga' => 120000,
                'jumlah' => 30,
            ],
            [
                'gambar' => 'tshirt.jpeg',
                'nama' => 'T-shirt Casual Day 2',
                'deskripsi' => 'Deskripsi Produk 1',
                'harga' => 150000,
                'jumlah' => 50,
            ],
            [
                'gambar' => 'Caps.png',
                'nama' => 'Topi Casual Day 2',
                'deskripsi' => 'Deskripsi Produk 2',
                'harga' => 100000,
                'jumlah' => 30,
            ],
            [
                'gambar' => 'Bucket-Hats.png',
                'nama' => 'Topi Ember Casual Day 2',
                'deskripsi' => 'Deskripsi Produk 3',
                'harga' => 120000,
                'jumlah' => 30,
            ],
            [
                'gambar' => 'tshirt.jpeg',
                'nama' => 'T-shirt Casual Day 3',
                'deskripsi' => 'Deskripsi Produk 1',
                'harga' => 150000,
                'jumlah' => 50,
            ],
            [
                'gambar' => 'Caps.png',
                'nama' => 'Topi Casual Day 3',
                'deskripsi' => 'Deskripsi Produk 2',
                'harga' => 100000,
                'jumlah' => 30,
            ],
            [
                'gambar' => 'Bucket-Hats.png',
                'nama' => 'Topi Ember Casual Day 3',
                'deskripsi' => 'Deskripsi Produk 3',
                'harga' => 120000,
                'jumlah' => 30,
            ],
            // Tambahkan data produk lainnya sesuai kebutuhan
        ];

        // Loop untuk menambahkan data produk ke tabel
        foreach ($produkData as $produk) {
            // Ubah path gambar sesuai struktur folder public Anda
            // $gambarPath = asset($produk['gambar']);

            // Tambahkan produk beserta gambar ke database
            Produk::create([
                'gambar' => $produk['gambar'],
                'nama' => $produk['nama'],
                'deskripsi' => $produk['deskripsi'],
                'harga' => $produk['harga'],
                'jumlah' => $produk['jumlah'],
            ]);
        }
    }
}
