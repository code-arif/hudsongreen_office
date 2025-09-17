<?php

namespace App\Http\Resources;

use App\Models\FitnessTests;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentDetailsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Load all fitness tests
        $allTests = FitnessTests::all();

        // Map each test to include student's attempt info
        $fitnessTests = $allTests->map(function ($test) {
            $scores = $this->testScores->where('fitness_test_id', $test->id);
            $lastScore = $scores->sortByDesc('test_date')->first();

            return [
                'id' => $test->id,
                'name' => $test->name,
                'unit' => $test->scoring_type,
                'is_completed' => $scores->isNotEmpty(),
                'attempts' => $scores->count(),
                'last_score' => $lastScore?->score,
            ];
        });

        // Summary
        $uniqueTestsCount = $this->testScores
            ->pluck('fitness_test_id')
            ->unique()
            ->count();

        return [
            'student' => [
                'id' => $this->id,
                'name' => $this->name,
                'gender' => $this->gender,
                'date_of_birth' => $this->date_of_birth,
                 'age'          => $this->date_of_birth ? Carbon::parse($this->date_of_birth)->age : null,
                'class' => $this->class,
                'section' => $this->section,
                'class_roll' => $this->class_roll,
                'school' => $this->whenLoaded('school', function () {
                    return [
                        'id' => $this->school->id,
                        'school_name' => $this->school->name,
                        'principal_name' => $this->school->principal_name,
                        'phone' => $this->school->phone ?? null,
                        'street_address' => $this->school->street_address ?? null,
                        'city' => $this->school->city,
                        'state' => $this->school->state,
                        'zip_code' => $this->school->zip_code,
                    ];
                }),
            ],

            'fitness_tests' => $fitnessTests,

            'summary' => [
                'total_attempts' => $this->testScores->count(),
                'unique_tests_taken' => $uniqueTestsCount
            ],
        ];
    }
}
