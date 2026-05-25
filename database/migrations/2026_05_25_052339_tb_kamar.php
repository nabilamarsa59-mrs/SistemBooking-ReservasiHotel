<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kamar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tipe')
                  ->constrained('tipe_kamar', 'id_tipe')
                  ->onDelete('cascade');

            $table->string('no_kamar');
            $table->enum('status_kamar', ['tersedia', 'terisi']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};