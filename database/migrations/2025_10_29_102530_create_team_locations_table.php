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
        Schema::create('team_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // je login koreche
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->decimal('accuracy', 8, 2)->nullable(); // GPS accuracy in meters
            $table->string('status')->default('active'); // active, idle, offline
            $table->timestamp('tracked_at'); // location er actual time
            $table->timestamps();

            $table->index(['team_id', 'tracked_at']);
            $table->index('user_id');
        });

        Schema::table('works', function (Blueprint $table) {
            $table->decimal('geofence_radius', 8, 2)->default(100)->after('longitude'); // meters
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the team_locations table
        Schema::dropIfExists('team_locations');

        // Remove the added column from works table
        Schema::table('works', function (Blueprint $table) {
            $table->dropColumn('geofence_radius');
        });
    }
};
