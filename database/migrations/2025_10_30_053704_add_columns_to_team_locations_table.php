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
        Schema::table('team_locations', function (Blueprint $table) {
            $table->decimal('speed', 8, 2)->nullable()->after('accuracy'); // km/h
            $table->decimal('bearing', 8, 2)->nullable()->after('speed'); // degrees
            $table->decimal('altitude', 10, 2)->nullable()->after('bearing'); // meters
            $table->string('battery_level')->nullable()->after('altitude'); // percentage
            $table->boolean('is_mock_location')->default(false)->after('battery_level');
            $table->string('activity_type')->nullable()->after('is_mock_location'); // still, walking, driving
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('team_locations', function (Blueprint $table) {
            $table->dropColumn(['speed', 'bearing', 'altitude', 'battery_level', 'is_mock_location', 'activity_type']);
        });
    }
};
