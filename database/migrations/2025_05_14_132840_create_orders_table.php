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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('order_id')->unique();
            $table->foreignId('item_id')->nullable()->constrained();
            $table->foreignId('request_offer_id')->nullable()->constrained();
            $table->foreignId('buyer_id')->constrained('users');

            $table->string('title')->nullable();
            $table->integer('quantity')->default('1');
            $table->float('price', 10, 4);
            $table->integer('discount_in_per')->default('0');
            $table->decimal('payment_fees', 10, 2);
            $table->decimal('other_taxes', 10, 2)->default('0');
            $table->decimal('total_price', 10, 2);

            $table->string('payment_method');
            $table->string('delivery_type')->nullable();
            $table->string('payment_status')->default('pending');
            $table->string('order_status')->default('pending delivery');
            $table->timestamp('delivered_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
