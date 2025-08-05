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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('profile')->nullable();
            $table->string('email')->unique();
            $table->string('descripiton', 500)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('role',['admin','customer','vendor'])->default('customer');
            $table->enum('status',['active','inactive','banned'])->default('active');
            $table->string('password');
            $table->timestamp('username_updated_at')->nullable();
            $table->timestamp('email_updated_at')->nullable();
            $table->decimal('balance', 10, 2)->default('0');
            $table->rememberToken();
            $table->timestamps();
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
