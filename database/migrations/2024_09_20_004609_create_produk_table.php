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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('kodeproduk', 100);
            $table->unsignedBigInteger('jenis_id');
            $table->unsignedBigInteger('nampan_id');
            $table->string('nama', 100);
            $table->integer('harga_jual')->nullable();
            $table->integer('harga_beli')->nullable();
            $table->text('keterangan')->nullable();
            $table->double('berat', 15, 8)->nullable();
            $table->integer('karat');
            $table->string('image', 100)->nullable();
            $table->integer('status')->unsigned()->nullable()->default(12);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('jenis_id')->references('id')->on('jenis_produk')->onDelete('cascade');
            $table->foreign('nampan_id')->references('id')->on('nampan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
