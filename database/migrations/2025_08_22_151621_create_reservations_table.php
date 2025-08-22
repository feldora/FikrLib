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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('member_id', 20);
            $table->foreignId('book_id')->constrained();
            $table->foreignId('item_id')->nullable()->constrained(); // Specific item if reserved
            $table->date('reservation_date');
            $table->date('expiry_date'); // When reservation expires
            $table->enum('status', ['active', 'ready', 'fulfilled', 'cancelled', 'expired'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamp('notified_at')->nullable(); // When member was notified
            $table->timestamps();
            
            $table->foreign('member_id')->references('id')->on('members');
            
            $table->index(['member_id', 'status']);
            $table->index(['book_id', 'status']);
            $table->index(['reservation_date', 'expiry_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};