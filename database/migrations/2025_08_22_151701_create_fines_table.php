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
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            $table->string('member_id', 20);
            $table->foreignId('loan_id')->nullable()->constrained(); // Related loan if applicable
            $table->date('fine_date');
            $table->enum('type', ['overdue', 'lost', 'damaged', 'administrative'])->default('overdue');
            $table->decimal('amount', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->enum('status', ['unpaid', 'partial', 'paid', 'waived'])->default('unpaid');
            $table->string('description');
            $table->text('notes')->nullable();
            $table->date('due_date')->nullable(); // When fine should be paid
            $table->date('paid_date')->nullable();
            $table->unsignedBigInteger('processed_by')->nullable(); // Staff who processed
            $table->timestamps();
            
            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('processed_by')->references('id')->on('users');
            
            $table->index(['member_id', 'status']);
            $table->index(['fine_date', 'status']);
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};