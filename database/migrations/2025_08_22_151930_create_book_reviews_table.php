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
        Schema::create('book_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->string('member_id', 20);
            $table->integer('rating')->unsigned()->nullable(); // 1-5 stars
            $table->text('review')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_public')->default(true);
            $table->timestamps();
            
            $table->foreign('member_id')->references('id')->on('members')->cascadeOnDelete();
            $table->unique(['book_id', 'member_id']); // One review per member per book
            $table->index(['book_id', 'is_approved']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_reviews');
    }
};