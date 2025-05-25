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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_game_id')->constrained('category_game')->onDelete('cascade');
            $table->text('title')->nullable();
            $table->json('images')->nullable();
            $table->string('feature_image')->nullable();
            $table->string('images_path')->nullable();
            $table->text('description')->nullable();
            $table->string('delivery_time')->nullable();;
            $table->enum('delivery_method', ['automatic', 'manual'])->nullable();
            $table->json('account_info')->nullable();
            $table->integer('quantity_available')->nullable();;
            $table->integer('minimum_quantity')->nullable();;
            $table->float('price');
            $table->json('discount')->nullable();
            $table->boolean('pause')->default('0');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
