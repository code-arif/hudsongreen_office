<?php

namespace App\Services;

use App\Helper\Helper;
use App\Models\SpeedTestRule;
use App\Models\Student;

class SpeedService
{
    /**
     * Create a new class instance.
     */


    public function __construct()
    {
        //

    }

    public function calculatePoints(Student $student, $duration)
    {
        // Calculate age using helper method
        $age = Helper::calculateAge($student->date_of_birth);


        // Find matching rule
        $rule = SpeedTestRule::where('gender', $student->gender)
            ->where('age', $age)
            ->where('min_duration', '<=', $duration)
            ->where('max_duration', '>=', $duration)
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
            'duration' => $duration . ' sec',
            'comment' => "Scored {$rule->points} points in {$duration} seconds",
        ];
    }
}
