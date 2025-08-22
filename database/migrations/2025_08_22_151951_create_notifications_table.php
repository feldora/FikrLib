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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->enum('recipient_type', ['member', 'staff', 'all'])->default('member');
            $table->string('recipient_id', 50)->nullable(); // Member ID or User ID
            $table->enum('type', ['due_reminder', 'overdue_notice', 'reservation_ready', 'fine_notice', 'general', 'system'])->default('general');
            $table->string('title');
            $table->text('message');
            $table->json('data')->nullable(); // Additional data (book info, fine amount, etc)
            $table->enum('channel', ['system', 'email', 'sms', 'whatsapp'])->default('system');
            $table->boolean('is_read')->default(false);
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            
            $table->index(['recipient_type', 'recipient_id']);
            $table->index(['type', 'is_read']);
            $table->index('sent_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};