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
        Schema::create('file_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('filename');
            $table->string('original_name');
            $table->string('file_path');
            $table->string('mime_type', 100);
            $table->integer('file_size'); // in bytes
            $table->text('description')->nullable();
            $table->enum('access_type', ['public', 'private', 'members_only'])->default('public');
            $table->json('access_rules')->nullable(); // Additional access restrictions
            $table->morphs('attachable'); // Polymorphic relation
            $table->unsignedBigInteger('uploaded_by');
            $table->integer('download_count')->default(0);
            $table->timestamp('last_downloaded_at')->nullable();
            $table->timestamps();
            
            $table->foreign('uploaded_by')->references('id')->on('users');
            $table->index(['attachable_type', 'attachable_id'], 'file_attachments_attachable_type_and_id_index');
            $table->index('mime_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_attachments');
    }
};