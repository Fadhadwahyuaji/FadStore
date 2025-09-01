<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->enum('jenis', ['persen', 'nominal']); // Diskon persen atau nominal
            $table->integer('nilai'); // Nilai diskon (misal: 10% atau Rp10.000)
            $table->integer('min_belanja')->default(0); // Minimum pembelian agar bisa digunakan
            $table->integer('maks_diskon')->nullable(); // Maksimum diskon jika jenis persen
            $table->integer('jumlah_tersedia')->default(1); // Berapa kali bisa digunakan
            $table->date('berlaku_hingga'); // Expired date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
