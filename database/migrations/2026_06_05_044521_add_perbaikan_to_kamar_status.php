<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE kamar MODIFY status_kamar ENUM('tersedia', 'terisi', 'perbaikan')");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE kamar MODIFY status_kamar ENUM('tersedia', 'terisi')");
    }
};
