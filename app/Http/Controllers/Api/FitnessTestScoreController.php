<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use App\Models\TestScore;
use App\Traits\ApiResponse;
use App\Models\FitnessTests;
use Illuminate\Http\Request;
use App\Services\AgilityService;
use App\Services\BalanceService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\CardiovascularService;
use App\Services\CoordinationService;
use App\Services\FlexibilityService;
use App\Services\PowerService;
use App\Services\ReactionService;
use App\Services\SpeedService;
use App\Services\StaminaService;
use App\Services\StrengthService;

class FitnessTestScoreController extends Controller
{
    use ApiResponse;

    public function store(Request $request)
    {
        $user = auth('api')->user();
        if (!$user) {
            return $this->error(null, 'Unauthorized', 401);
        }

        // Check if user's school exists and is approved
        $school = $user->school;
        if (!$school || $school->status !== 'approved') {
            return $this->error(null, 'Your school is not approved. You cannot perform this test.', 403);
        }

        $request->validate([
            'student_id'      => 'required|exists:students,id',
            'fitness_test_id' => 'required|exists:fitness_tests,id',
            'test_score'        => 'required|numeric',
        ]);

        $student = Student::findOrFail($request->student_id);
        $test = FitnessTests::findOrFail($request->fitness_test_id);

        // Map fitness_test_id to service class
        $serviceMap = [
            1 => AgilityService::class,  // agility test
            2 => FlexibilityService::class, // flexibility test
            3 => BalanceService::class,  // balance test
            4 => CoordinationService::class, //coordination test
            5 => ReactionService::class, // reaction test
            6 => PowerService::class, // power test
            7 => StrengthService::class, // mascular strengeth test
            8 => StaminaService::class, // stamina test
            9 => SpeedService::class, // speed test
            10 => CardiovascularService::class //cardiovascular test
        ];

        if (!isset($serviceMap[$test->id])) {
            return $this->error(null, 'No service defined for this test.', 400);
        }

        $serviceClass = $serviceMap[$test->id];
        $service = new $serviceClass();

        DB::transaction(function () use ($student, $test, $request, $service, &$result) {
            $result = $service->calculatePoints($student, $request->test_score);

            TestScore::create([
                'student_id'      => $student->id,
                'fitness_test_id' => $test->id,
                'tested_by'       => auth()->id(),
                'score'           => $result['points'],
                'data'            => $request->test_score,
                'unit'            => 'seconds',
                'test_date'       => now(),
            ]);
        });

        return $this->success($result, 'Test score saved successfully');
    }
}
