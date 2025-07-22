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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->uuid('ticket_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('issue')->nullable();
            $table->string('email_username')->nullable();
            $table->string('wallet_address')->nullable();
            $table->string('order_ids')->nullable();
            $table->string('order_id')->nullable();
            $table->string('dispute_duration')->nullable();
            $table->string('dispute_refund_orignal_account')->nullable();
            $table->string('evidence_path')->nullable();
            $table->string('evidence')->nullable();
            $table->string('reported_person')->nullable();
            $table->string('category')->nullable();
            $table->integer('status')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
