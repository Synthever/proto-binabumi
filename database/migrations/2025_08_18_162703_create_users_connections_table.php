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
        Schema::create('users_connections', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('user_id')->unique(); // IS UNIQUE, Foreign key to users table
            $table->boolean('is_connect')->default(false);
            $table->string('machine_id')->default('-'); // VARCHAR, default "-"
            $table->string('date_created');
            $table->string('date_updated');
            
            // Foreign key constraint
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_connections');
    }
};
