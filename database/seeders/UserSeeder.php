<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        DB::table('users')->insert([
            'name' => 'FadStore',
            'email' => 'admin@fadstore.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        // Pembeli User
        DB::table('users')->insert([
            'name' => 'Fadhad Wahyu Aji',
            'email' => 'pembeli@fadstore.com',
            'password' => Hash::make('123456'),
            'role' => 'pembeli',
        ]);
    }
}
