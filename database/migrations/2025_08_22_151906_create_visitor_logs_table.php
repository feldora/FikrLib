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
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('member_id', 20)->nullable(); // If registered member
            $table->string('visitor_name', 100);
            $table->string('institution', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('purpose', 100)->nullable(); // Reading, research, etc
            $table->datetime('checkin_time');
            $table->datetime('checkout_time')->nullable();
            $table->integer('locker_number')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('member_id')->references('id')->on('members')->nullOnDelete();
            $table->index(['checkin_time', 'checkout_time']);
            $table->index('member_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_logs');
    }
};