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
        Schema::create('member_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('description')->nullable();
            $table->integer('loan_limit')->default(3); // Max books that can be borrowed
            $table->integer('loan_period')->default(7); // Days
            $table->integer('renewal_limit')->default(2); // How many times can renew
            $table->boolean('can_reserve')->default(true);
            $table->integer('reserve_limit')->default(3);
            $table->integer('membership_period')->default(365); // Days
            $table->decimal('fine_per_day', 8, 2)->default(1000.00); // Fine amount per day
            $table->integer('grace_period')->default(0); // Grace period before fine
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_types');
    }
};