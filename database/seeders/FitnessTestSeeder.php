<?php

namespace Database\Seeders;

use App\Models\FitnessTests;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FitnessTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tests = [
            [
                'name' => 'AGILITY',
                'description' => 'Measure how quickly you can change direction',
                'scoring_type' => 'time'
            ],
            [
                'name' => 'FLEXIBILITY',
                'description' => 'Measure range of motion in joints',
                'scoring_type' => 'distance'
            ],
            [
                'name' => 'BALANCE',
                'description' => 'Measure ability to maintain equilibrium',
                'scoring_type' => 'time'
            ],
            [
                'name' => 'COORDINATION',
                'description' => 'Assess motor coordination skills',
                'scoring_type' => 'score'
            ],
            [
                'name' => 'REACTION',
                'description' => 'Measure response time to stimuli',
                'scoring_type' => 'time'
            ],
            [
                'name' => 'POWER',
                'description' => 'Measure explosive strength',
                'scoring_type' => 'distance'
            ],
            [
                'name' => 'MUSCLE STRENGTH',
                'description' => 'Measure maximum force production',
                'scoring_type' => 'count'
            ],
            [
                'name' => 'MUSCLE STAMINA',
                'description' => 'Measure muscular endurance',
                'scoring_type' => 'count'
            ],
            [
                'name' => 'SPEED',
                'description' => 'Measure how quickly you can move',
                'scoring_type' => 'time'
            ],
            [
                'name' => 'CARDIOVASCULAR ENDURANCE',
                'description' => 'Measure heart and lung endurance',
                'scoring_type' => 'time'
            ]
        ];

        foreach ($tests as $test) {
            FitnessTests::create($test);
        }
    }
}
