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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->string('barcode', 50)->unique(); // Item barcode/code
            $table->string('inventory_code', 50)->nullable();
            $table->string('call_number', 50)->nullable(); // Can override book's call number
            $table->foreignId('collection_type_id')->constrained();
            $table->foreignId('location_id')->constrained();
            $table->enum('status', ['available', 'on_loan', 'reserved', 'lost', 'damaged', 'missing', 'repair'])->default('available');
            $table->date('received_date')->nullable();
            $table->string('supplier', 100)->nullable();
            $table->string('invoice_number', 50)->nullable();
            $table->date('invoice_date')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->string('currency', 3)->default('IDR');
            $table->string('source', 50)->nullable(); // Purchase/donation/etc
            $table->text('notes')->nullable();
            $table->date('last_stocktake_date')->nullable();
            $table->boolean('is_available_for_loan')->default(true);
            $table->timestamps();
            
            $table->index('barcode');
            $table->index(['book_id', 'status']);
            $table->index(['collection_type_id', 'location_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};