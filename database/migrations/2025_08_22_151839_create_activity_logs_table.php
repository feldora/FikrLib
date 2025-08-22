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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->enum('user_type', ['staff', 'member', 'system'])->default('staff');
            $table->string('user_id', 50)->nullable(); // Can be staff ID or member ID
            $table->string('user_name', 100)->nullable();
            $table->string('action', 50); // login, logout, add_book, loan_book, etc
            $table->string('module', 50); // circulation, catalog, member, etc
            $table->string('description');
            $table->json('metadata')->nullable(); // Additional data
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('created_at');
            
            $table->index(['user_type', 'user_id']);
            $table->index(['action', 'module']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};