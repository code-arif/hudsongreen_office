<?php

namespace App\Services;

use App\Helper\Helper;
use DateTime;
use App\Models\Student;
use App\Models\FlexibilityTestRule;

class FlexibilityService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function calculatePoints(Student $student, $distance)
    {
        // Calculate age using helper method
        $age = Helper::calculateAge($student->date_of_birth);

        // Find matching rule
        $rule = FlexibilityTestRule::where('gender', $student->gender)
            ->where('age', $age)
            ->where('min_distance', '<=', $distance)
            ->where('max_distance', '>=', $distance)
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
            'comment' => "Scored {$rule->points} points for {$distance} cm",
        ];
    }
}
