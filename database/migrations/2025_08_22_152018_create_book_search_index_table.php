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
        Schema::create('book_search_index', function (Blueprint $table) {
            $table->foreignId('book_id')->primary()->constrained()->cascadeOnDelete();
            $table->text('title')->nullable();
            $table->string('isbn', 20)->nullable();
            $table->text('authors')->nullable(); // Concatenated authors
            $table->text('categories')->nullable(); // Concatenated categories  
            $table->string('publisher', 100)->nullable();
            $table->string('publish_place', 100)->nullable();
            $table->string('language', 50)->nullable();
            $table->string('publish_year', 10)->nullable();
            $table->string('classification', 40)->nullable();
            $table->text('notes')->nullable();
            $table->text('series_title')->nullable();
            $table->text('locations')->nullable(); // Available locations
            $table->text('collection_types')->nullable();
            $table->string('call_number', 50)->nullable();
            $table->integer('available_copies')->default(0);
            $table->integer('total_copies')->default(0);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_opac_visible')->default(true);
            $table->boolean('is_promoted')->default(false);
            $table->json('labels')->nullable();
            $table->string('cover_image', 255)->nullable();
            $table->timestamps();
            
            $table->index(['is_opac_visible', 'is_promoted']);
            $table->index(['is_available', 'available_copies']);
            $table->index(['publisher', 'publish_year']);
            $table->fullText(['title', 'series_title']);
            $table->fullText('authors');
            $table->fullText('categories');
            $table->fullText('notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_search_index');
    }
};