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
        Schema::create('test_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('fitness_test_id');
            $table->unsignedBigInteger('tested_by');

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('fitness_test_id')->references('id')->on('fitness_tests')->onDelete('cascade');
            $table->foreign('tested_by')->references('id')->on('users')->onDelete('cascade');

            $table->string('data')->nullable();
            $table->string('unit')->nullable();
            $table->float('score')->nullable();
            $table->dateTime('test_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_scores');
    }
};
