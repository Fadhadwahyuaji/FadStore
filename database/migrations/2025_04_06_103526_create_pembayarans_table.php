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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('midtrans_id')->nullable(); // ID transaksi dari Midtrans
            $table->string('snap_token')->nullable(); // Token pembayaran Midtrans
            $table->string('metode_pembayaran')->nullable(); // bank transfer, virtual account, credit card, dll
            $table->string('bank')->nullable(); // BCA, BNI, Mandiri, dll
            $table->string('va_number')->nullable(); // Virtual Account Number
            $table->string('status')->default('pending'); // pending, paid, expired, failed
            $table->timestamp('tanggal_bayar')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->text('response_midtrans')->nullable(); // JSON respons dari Midtrans
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
