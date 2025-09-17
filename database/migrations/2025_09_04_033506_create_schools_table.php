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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('principal_name');
            $table->string('email')->unique();
            $table->string('phone', 20);
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code', 20);
            $table->integer('approximate_student_count')->nullable();

            // Approval workflow columns
            $table->enum('status', ['pending', 'approved', 'cancelled'])->default('pending');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('cancelled_by')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->string('approval_token')->nullable()->unique();

            $table->timestamps();

            // Foreign keys
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->restrictOnDelete();
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('cancelled_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
