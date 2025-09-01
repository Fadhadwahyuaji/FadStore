<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\ProfileAdmin;
use App\Models\User;
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
        // User Admin (tanpa customer, dan tanpa kolom name)
        User::create([
            'email' => 'admin@fadstore.com',
            'nama' => 'Admin Fadhad',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // User Pembeli (tanpa name)
        User::create([
            'email' => 'fadhad@fadstore.com',
            'nama' => 'Fadhad Wahyu Aji',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }
}
