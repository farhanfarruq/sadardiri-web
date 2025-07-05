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
        Schema::table('savings_targets', function (Blueprint $table) {
            // Mengubah kolom target_date agar bisa diisi NULL (opsional)
            $table->date('target_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('savings_targets', function (Blueprint $table) {
            // Mengembalikan kolom agar tidak bisa NULL jika migrasi di-rollback
            $table->date('target_date')->nullable(false)->change();
        });
    }
};