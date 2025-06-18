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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', length: 255);
            $table->string('password', length: 255);
            $table->string('nama', length: 255);
            $table->string('email', length: 255);
            $table->text('alamat');
            $table->string('no_telp', length: 30);
            $table->enum('role', ['admin', 'anggota'])->default('anggota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
