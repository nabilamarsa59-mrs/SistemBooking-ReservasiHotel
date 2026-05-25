<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipe_kamar', function (Blueprint $table) {
            $table->id('id_tipe');
            $table->string('detail_kamar');
            $table->integer('harga_kamar');
            $table->string('fasilitas');
            $table->string('foto_kamar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipe_kamar');
    }
};