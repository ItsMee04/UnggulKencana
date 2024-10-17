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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('transaksi_id', 100);
            $table->string('id_keranjang');
            $table->unsignedBigInteger('pelanggan_id');
            $table->integer('diskon');
            $table->date('tanggal');
            $table->integer('total');
            $table->unsignedBigInteger('users_id');
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_keranjang')->references('keranjang_id')->on('keranjang')->onDelete('cascade');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
