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
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->date('date');
            $table->enum('type', ['national', 'religious', 'library', 'weekend'])->default('library');
            $table->text('description')->nullable();
            $table->boolean('is_recurring')->default(false); // Annual recurring holiday
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique(['name', 'date']);
            $table->index(['date', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('holidays');
    }
};