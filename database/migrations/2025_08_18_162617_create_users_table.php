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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unique(); // PRIMARY KEY, IS UNIQUE
            $table->string('username')->unique(); // IS UNIQUE
            $table->string('name');
            $table->string('no_handphone');
            $table->string('email')->unique(); // Make email unique for auth
            $table->string('password');
            $table->boolean('is_login')->default(false); // Track login status
            $table->string('date_created');
            $table->string('date_updated');
            $table->string('profile_picture')->nullable();
        });

        // Create password reset tokens table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
