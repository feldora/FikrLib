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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('birth_year', 4)->nullable();
            $table->string('death_year', 4)->nullable();
            $table->enum('authority_type', ['person', 'organization', 'conference'])->default('person');
            $table->text('biography')->nullable();
            $table->string('authority_list', 20)->nullable(); // For authority control
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique(['name', 'authority_type']);
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};