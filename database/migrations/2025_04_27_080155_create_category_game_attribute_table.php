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
        Schema::create('category_game_attribute', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_game_id');
            $table->unsignedBigInteger('attribute_id');
            $table->timestamps();
        
            // Add foreign keys if you want
            $table->foreign('category_game_id')->references('id')->on('category_game')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_game_attribute');
    }
};
