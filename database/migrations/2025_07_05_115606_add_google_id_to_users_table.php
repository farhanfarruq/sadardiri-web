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
        Schema::table('users', function (Blueprint $table) {
            // Make password nullable for users logging in via Google
            $table->string('password')->nullable()->change();
            // Add google_id column to store the user's Google ID
            $table->string('google_id')->nullable()->unique()->after('id');
            // Add avatar column to store the user's profile picture URL
            $table->string('avatar')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable(false)->change();
            $table->dropColumn(['google_id', 'avatar']);
        });
    }
};
