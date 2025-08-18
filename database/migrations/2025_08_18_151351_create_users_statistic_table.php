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
        Schema::create('users_statistic', function (Blueprint $table) {
            $table->id(); // PRIMARY KEY (auto increment)
            $table->string('user_id')->unique(); // IS UNIQUE - references users.user_id
            $table->string('balance')->default('0');
            $table->integer('poin')->default(0);
            $table->integer('bottle_count')->default(0);
            $table->string('date_created');
            $table->string('date_updated');
            
            // Add foreign key constraint (optional)
            // $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_statistic');
    }
};
