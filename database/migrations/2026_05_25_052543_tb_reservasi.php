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

            $table->unsignedBigInteger('tamu_id');
            $table->unsignedBigInteger('pengguna_id');
            $table->unsignedBigInteger('id_tipe');

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