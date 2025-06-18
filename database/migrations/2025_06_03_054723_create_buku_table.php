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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rak');
            $table->unsignedBigInteger('id_kategori_buku');
            $table->string('judul', length: 255);
            $table->string('penerbit', length: 255);
            $table->year('tahun');
            $table->string('isbn', length: 255);
            $table->integer('jumlah');
            $table->foreign('id_rak')->references('id')->on('rak_buku')->onDelete('cascade');
            $table->foreign('id_kategori_buku')->references('id')->on('kategori_buku')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
