<?php

namespace App\Services;

use App\Helper\Helper;
use App\Models\StaminaTestRule;
use App\Models\Student;

class StaminaService
{
    /**
     * Create a new class instance.
     */


    public function __construct()
    {
        //

    }

    public function calculatePoints(Student $student, $count)
    {
        // Calculate age using helper method
        $age = Helper::calculateAge($student->date_of_birth);


        // Find matching rule
        $rule = StaminaTestRule::where('gender', $student->gender)
            ->where('age', $age)
            ->where('min_count', '<=', $count)
            ->where('max_count', '>=', $count)
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
            'comment' => "Scored {$rule->points} points in {$count} mrf",
        ];
    }
}
