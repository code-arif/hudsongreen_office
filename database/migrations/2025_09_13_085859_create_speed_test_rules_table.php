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
        Schema::create('speed_test_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('age')->nullable();

            // duration range (sec)
            $table->decimal('min_duration', 5, 2)->nullable();
            $table->decimal('max_duration', 5, 2)->nullable();

            $table->string('gender')->nullable();
            $table->unsignedInteger('points')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speed_test_rules');
    }
};
