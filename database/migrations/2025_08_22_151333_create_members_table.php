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
        Schema::create('members', function (Blueprint $table) {
            $table->string('id', 20)->primary(); // Member ID/Card number
            $table->string('name', 100);
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('birth_date')->nullable();
            $table->foreignId('member_type_id')->constrained();
            $table->text('address')->nullable();
            $table->text('mailing_address')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('institution', 100)->nullable();
            $table->string('student_id', 30)->nullable(); // NIM/NIP/etc
            $table->string('photo', 255)->nullable();
            $table->string('pin', 6)->nullable(); // For OPAC login
            $table->date('join_date');
            $table->date('expire_date');
            $table->text('notes')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended', 'pending'])->default('active');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(); // For OPAC access
            $table->rememberToken();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip', 45)->nullable();
            $table->timestamps();
            
            $table->index('name');
            $table->index(['member_type_id', 'status']);
            $table->index(['join_date', 'expire_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};