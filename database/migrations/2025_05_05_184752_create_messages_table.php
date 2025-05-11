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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // Sender of the message
            $table->foreignId('reciever_id')->constrained('users')->onDelete('cascade'); // Receiver of the message
            $table->foreignId('buyer_request_conversation_id')->nullable()->constrained('buyer_request_conversations')->onDelete('cascade');
            $table->text('message')->nullable(); // The message content (text)
            $table->string('file_name')->nullable(); // File name
            $table->string('file_path')->nullable(); // File path
            $table->string('file_type')->nullable(); // File type (image, document, etc.)
            $table->enum('status', ['sent', 'delivered', 'read'])->default('sent'); // Message status
            $table->timestamp('delivered_at')->nullable(); // When the message was delivered
            $table->timestamp('read_at')->nullable(); // When the message was read
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
