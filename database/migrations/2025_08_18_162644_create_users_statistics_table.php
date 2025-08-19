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
        Schema::create('users_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unique(); // Foreign key to users table
            $table->string('balance');
            $table->integer('poin');
            $table->integer('bottle_count');
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
        Schema::dropIfExists('users_statistics');
    }
};
