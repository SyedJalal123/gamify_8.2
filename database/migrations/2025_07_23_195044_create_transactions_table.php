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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->integer('balance');
            $table->string('description');
            $table->string('payment_type'); // purchase, sale, withdrawl, completed
            $table->string('user_type'); // seller, buyer 
            $table->string('payment_method')->nullable(); // Bank, Crypto
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
