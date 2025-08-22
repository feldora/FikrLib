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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            // $table->text('title');
            $table->string('title', 255);
            $table->string('subtitle')->nullable();
            $table->string('statement_of_responsibility', 200)->nullable(); // Author statement
            $table->string('edition', 50)->nullable();
            $table->string('isbn', 20)->nullable();
            $table->string('issn', 20)->nullable();
            $table->foreignId('publisher_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('place_id')->nullable()->constrained()->nullOnDelete();
            $table->string('publish_year', 10)->nullable();
            $table->string('pages', 50)->nullable(); // Collation/Physical description
            $table->string('series_title', 200)->nullable();
            $table->string('call_number', 50)->nullable();
            $table->string('language_code', 5)->default('id');
            $table->string('source', 10)->nullable(); // Purchase/donation source
            $table->string('classification', 40)->nullable(); // DDC/UDC
            $table->text('notes')->nullable();
            $table->text('abstract')->nullable();
            $table->string('cover_image', 255)->nullable();
            $table->json('attachments')->nullable(); // Store file attachments
            $table->boolean('is_opac_visible')->default(true);
            $table->boolean('is_promoted')->default(false);
            $table->json('labels')->nullable(); // For tagging/labeling
            $table->decimal('price', 12, 2)->nullable();
            $table->string('currency', 3)->default('IDR');
            $table->timestamps();
            
            $table->foreign('language_code')->references('code')->on('languages');
            $table->index(['title', 'isbn']);
            // $table->index(['title(255)', 'isbn']);
            $table->index(['classification', 'call_number']);
            $table->index(['is_opac_visible', 'is_promoted']);
            $table->fullText(['title', 'subtitle', 'series_title']);
            $table->fullText('notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};