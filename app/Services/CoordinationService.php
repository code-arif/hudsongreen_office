<?php

namespace App\Services;

use App\Helper\Helper;
use App\Models\Student;
use App\Models\CoordinationTestRule;

class CoordinationService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function calculatePoints(Student $student, $score)
    {
        // Calculate age using helper method
        $age = Helper::calculateAge($student->date_of_birth);


        // Find matching rule
        $rule = CoordinationTestRule::where('gender', $student->gender)
            ->where('age', $age)
            ->where('min_score', '<=', $score)
            ->where('max_score', '>=', $score)
            ->first();

        if (!$rule) {
            return [
                'points' => 0,
                'comment' => 'No matching rule found',
            ];
        }

        return [
            'name' => $student->name,
            'age' => $age,
            'gender' => $student->gender,
            'points' => $rule->points,
            'comment' => "Scored {$rule->points} points in {$score} score",
        ];
    }
}
