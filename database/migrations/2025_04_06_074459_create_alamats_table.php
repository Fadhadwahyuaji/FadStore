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
        Schema::create('alamats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama_penerima')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('kode_pos')->nullable();
            $table->boolean('is_default')->default(false);
            $table->string('label')->nullable();
            $table->string('alamat_lengkap')->nullable();
            $table->text('tambahan')->nullable();

            // RajaOngkir Starter Package fields
            // $table->unsignedInteger('province_id')->nullable(); // ID provinsi
            // $table->string('province')->nullable(); // Nama provinsi
            // $table->unsignedInteger('city_id')->nullable(); // ID kota
            // $table->string('city')->nullable(); // Nama kota



            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alamats');
    }
};
