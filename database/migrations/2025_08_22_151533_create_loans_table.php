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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();
            $table->string('member_id', 20);
            $table->string('member_name', 100); // Denormalized for performance
            $table->date('loan_date');
            $table->date('due_date');
            $table->date('return_date')->nullable();
            $table->integer('renewal_count')->default(0);
            $table->enum('status', ['on_loan', 'returned', 'overdue', 'lost'])->default('on_loan');
            $table->text('loan_notes')->nullable();
            $table->text('return_notes')->nullable();
            $table->unsignedBigInteger('loaned_by'); // Staff who processed the loan
            $table->unsignedBigInteger('returned_by')->nullable(); // Staff who processed the return
            $table->decimal('fine_amount', 10, 2)->default(0);
            $table->boolean('fine_paid')->default(false);
            $table->timestamps();
            
            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('loaned_by')->references('id')->on('users');
            $table->foreign('returned_by')->references('id')->on('users');
            
            $table->index(['member_id', 'status']);
            $table->index(['loan_date', 'due_date']);
            $table->index(['status', 'due_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};