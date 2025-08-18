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
        // Drop existing users table if it exists
        Schema::dropIfExists('users');
        
        // Create new users table with custom fields
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unique(); // PRIMARY KEY, IS UNIQUE
            $table->string('username')->unique(); // IS UNIQUE
            $table->string('name');
            $table->string('no_handphone');
            $table->string('email');
            $table->boolean('is_connect')->default(false);
            $table->string('machine_id')->default('-'); // VARCHAR
            $table->string('date_created');
            $table->string('date_updated');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
