<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faktur', function (Blueprint $table) {
            $table->id('no_faktur');

            $table->foreignId('id_reservasi')
                  ->constrained('reservasi', 'id_reservasi')
                  ->onDelete('cascade');

            $table->string('nama_tamu');
            $table->string('tipe_kamar');
            $table->integer('durasi');
            $table->integer('total_tagihan');
            $table->date('tanggal_faktur');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faktur');
    }
};