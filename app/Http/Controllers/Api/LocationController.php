    <?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Models\TeamLocation;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Cache;

    class LocationController extends Controller
    {
        /**
         * Update employee location (Flutter app calls this every 60 seconds)
         */
        public function update(Request $request)
        {
            $validated = $request->validate([
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'accuracy' => 'nullable|numeric|min:0',
            ]);

            $user = auth()->user();

            // Check if user belongs to a team
            $teamUser = DB::table('team_users')
                ->where('user_id', $user->id)
                ->first();

            if (!$teamUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not assigned to any team'
                ], 400);
            }

            // Store location in database
            $location = TeamLocation::create([
                'team_id' => $teamUser->team_id,
                'user_id' => $user->id,
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'accuracy' => $validated['accuracy'] ?? null,
                'status' => 'active',
                'tracked_at' => now(),
            ]);

            // Cache latest location for quick access (expires in 5 minutes)
            Cache::put(
                "team_location:{$teamUser->team_id}",
                [
                    'team_id' => $teamUser->team_id,
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'latitude' => $location->latitude,
                    'longitude' => $location->longitude,
                    'accuracy' => $location->accuracy,
                    'tracked_at' => $location->tracked_at->toIso8601String(),
                ],
                now()->addMinutes(5)
            );

            // Check if team is near any assigned work location
            $nearbyWorks = $this->checkNearbyWorks($teamUser->team_id, $validated['latitude'], $validated['longitude']);

            return response()->json([
                'success' => true,
                'message' => 'Location updated successfully',
                'data' => [
                    'location_id' => $location->id,
                    'tracked_at' => $location->tracked_at,
                    'nearby_works' => $nearbyWorks,
                ]
            ]);
        }

        /**
         * Get current tracking status
         */
        public function status(Request $request)
        {
            $user = auth()->user();

            $teamUser = DB::table('team_users')
                ->where('user_id', $user->id)
                ->first();

            if (!$teamUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'Not in any team'
                ]);
            }

            $lastLocation = TeamLocation::where('team_id', $teamUser->team_id)
                ->where('user_id', $user->id)
                ->latest('tracked_at')
                ->first();

            return response()->json([
                'success' => true,
                'data' => [
                    'team_id' => $teamUser->team_id,
                    'is_tracking' => $lastLocation && $lastLocation->tracked_at->gt(now()->subMinutes(5)),
                    'last_tracked_at' => $lastLocation?->tracked_at,
                    'last_location' => $lastLocation ? [
                        'latitude' => $lastLocation->latitude,
                        'longitude' => $lastLocation->longitude,
                    ] : null,
                ]
            ]);
        }

        /**
         * Check if team is near any work location (geofencing)
         */
        private function checkNearbyWorks($teamId, $lat, $lng)
        {
            $works = DB::table('works')
                ->where('team_id', $teamId)
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->whereDate('start_datetime', '<=', now())
                ->whereDate('end_datetime', '>=', now())
                ->where('is_completed', false)
                ->get();

            $nearbyWorks = [];

            foreach ($works as $work) {
                $distance = $this->calculateDistance(
                    $lat,
                    $lng,
                    $work->latitude,
                    $work->longitude
                );

                // If within 100 meters (or work's geofence_radius)
                $radius = $work->geofence_radius ?? 100;

                if ($distance <= $radius) {
                    $nearbyWorks[] = [
                        'work_id' => $work->id,
                        'title' => $work->title,
                        'distance' => round($distance, 2),
                        'is_inside_geofence' => true,
                    ];
                }
            }

            return $nearbyWorks;
        }

        /**
         * Calculate distance between two coordinates (Haversine formula)
         */
        private function calculateDistance($lat1, $lon1, $lat2, $lon2)
        {
            $earthRadius = 6371000; // meters

            $dLat = deg2rad($lat2 - $lat1);
            $dLon = deg2rad($lon2 - $lon1);

            $a = sin($dLat / 2) * sin($dLat / 2) +
                cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                sin($dLon / 2) * sin($dLon / 2);

            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

            return $earthRadius * $c; // Distance in meters
        }
    }
