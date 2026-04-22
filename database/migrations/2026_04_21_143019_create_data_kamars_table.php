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
    Schema::create('rooms', function (Blueprint $table) {
        $table->id();
        $table->string('number');
        $table->string('type');
        $table->integer('price');
        $table->string('status'); // Tersedia, Terisi, Perbaikan
        $table->integer('floor')->default(1);
        $table->string('capacity')->default('2 Orang');
        $table->timestamps();
    });
}

};
