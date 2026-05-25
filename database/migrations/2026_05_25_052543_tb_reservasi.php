<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id('id_reservasi');

            $table->foreignId('tamu_id')
                  ->constrained('tamu')
                  ->onDelete('cascade');

            $table->foreignId('pengguna_id')
                  ->constrained('pengguna')
                  ->onDelete('cascade');

            $table->foreignId('id_tipe')
                  ->constrained('tipe_kamar', 'id_tipe')
                  ->onDelete('cascade');

            $table->date('check_in');
            $table->date('check_out');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};