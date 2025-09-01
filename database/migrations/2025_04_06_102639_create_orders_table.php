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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('alamat_id');
            $table->string('kode_order')->unique();
            $table->integer('total_harga');
            $table->integer('total_ongkir');
            $table->integer('total_diskon')->default(0);
            $table->integer('grand_total');
            $table->enum('status', [
                'pending', 'paid', 'processing',
                'shipped', 'delivered', 'cancelled'
            ])->default('pending');
            $table->string('payment_method')->nullable();
            $table->enum('payment_status', [
                'pending', 'success', 'failed',
                'challenge', 'expired', 'denied'
            ])->default('pending');
            $table->text('snap_token')->nullable();
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('alamat_id')->references('id')->on('alamats')->onDelete('cascade');
            $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
