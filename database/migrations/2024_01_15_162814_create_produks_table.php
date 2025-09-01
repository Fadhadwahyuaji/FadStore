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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->integer('harga'); // Ubah tipe data sesuai kebutuhan
            $table->integer('jumlah')->nullable();
            $table->integer('berat')->default(1000); // Dalam gram (WAJIB untuk kalkulasi ongkir)
            $table->string('kategori')->nullable(); // Bisa dibuat tabel terpisah jika kompleks
            $table->boolean('is_published')->default(true); // Untuk hide/unhide produk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
