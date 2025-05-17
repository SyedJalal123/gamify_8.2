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
        Schema::table('attributes', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('attribute_category', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('attribute_game', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('buyer_requests', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('buyer_request_attributes', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('buyer_request_conversations', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('category_game', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('category_game_attribute', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('games', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('items', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('item_attributes', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('messages', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('request_offers', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sellers', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('seller_service', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('services', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('service_attributes', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attributes', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('attribute_category', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('attribute_game', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('buyer_requests', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('buyer_request_attributes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('buyer_request_conversations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('category_game', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('category_game_attribute', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('games', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('items', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('item_attributes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('messages', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('request_offers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('seller_service', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('services', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('service_attributes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
