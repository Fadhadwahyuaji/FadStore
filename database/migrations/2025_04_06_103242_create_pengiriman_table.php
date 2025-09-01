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
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('kurir'); // JNE, J&T, TIKI, dll
            $table->string('layanan'); // REG, OKE, YES, dll
            $table->integer('ongkir');
            $table->string('no_resi')->nullable();
            $table->integer('estimasi_hari')->nullable();
            $table->string('status')->default('pending'); // pending, shipping, delivered
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};
