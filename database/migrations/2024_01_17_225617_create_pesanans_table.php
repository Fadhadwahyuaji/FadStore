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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable(); // Jika ini adalah kode unik atau nomor referensi pesanan
            // $table->foreignId('user_id')->constrained();
            $table->string('nama');
            $table->string('email');
            // $table->foreignId('keranjang_id')->constrained();
            $table->string('no_hp')->nullable();
            $table->double('total')->default(0);
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('layanan_pengiriman')->nullable();
            $table->double('ongkir')->nullable();
            $table->text('detail_alamat')->nullable();
            $table->string('status')->default('pending');
            $table->string('snap_token')->nullable();
            $table->timestamp('tanggal_pesanan')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
