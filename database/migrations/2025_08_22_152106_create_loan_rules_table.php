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
        Schema::create('loan_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->foreignId('member_type_id')->constrained();
            $table->foreignId('collection_type_id')->nullable()->constrained();
            $table->integer('loan_limit')->default(3); // Max books
            $table->integer('loan_period')->default(7); // Days
            $table->integer('renewal_limit')->default(2);
            $table->decimal('fine_per_day', 8, 2)->default(1000.00);
            $table->integer('grace_period')->default(0); // Days before fine starts
            $table->boolean('can_reserve')->default(true);
            $table->integer('reserve_limit')->default(3);
            $table->json('restrictions')->nullable(); // Additional rules
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['member_type_id', 'collection_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_rules');
    }
};