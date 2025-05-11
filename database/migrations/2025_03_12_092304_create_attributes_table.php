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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Server, Rank, Delivery Time
            $table->enum('type', ['text', 'number', 'select', 'checkbox']);
            $table->json('options')->nullable(); // Example: ["NA", "EU", "ASIA"]
            $table->enum('applies_to', ['1', '2']);
            $table->boolean('required')->default('0');
            $table->boolean('topup')->default('0');
            // $table->foreignId('game_id')->nullable()->constrained()->onDelete('cascade');
            // $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
