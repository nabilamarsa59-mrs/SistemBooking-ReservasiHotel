<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');

            $table->foreignId('no_faktur')
                  ->constrained('faktur', 'no_faktur')
                  ->onDelete('cascade');

            $table->date('tanggal_pembayaran');
            $table->string('metode_pembayaran');
            $table->integer('jumlah_bayar');

            $table->enum('status_pembayaran', [
                'pending',
                'lunas'
            ]);

            $table->string('bukti_pembayaran')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};