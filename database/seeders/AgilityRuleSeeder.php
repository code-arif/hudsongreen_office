<?php

namespace Database\Seeders;

use App\Models\AgilityTestRule;
use Illuminate\Database\Seeder;

class AgilityRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [
            // Age 18 and boys
            ['age' => 18, 'gender' => 'male', 'min_duration' => 0, 'max_duration' => 14.5,  'points' => 10],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 14.6, 'max_duration' => 15.1,  'points' => 9],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 15.2, 'max_duration' => 15.7,  'points' => 8],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 15.8, 'max_duration' => 16.3,  'points' => 7],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 16.4, 'max_duration' => 16.9,  'points' => 6],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 17.0, 'max_duration' => 17.5,  'points' => 5],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 17.6, 'max_duration' => 18.1,  'points' => 4],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 18.2, 'max_duration' => 18.7,  'points' => 3],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 18.8, 'max_duration' => 19.3,  'points' => 2],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 19.4, 'max_duration' => 19.9,  'points' => 1],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 20, 'max_duration' => 60.0,  'points' => 0],

            // Age 17 and boys
            ['age' => 17, 'gender' => 'male', 'min_duration' => 0, 'max_duration' => 15,  'points' => 10],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 15.1, 'max_duration' => 15.6,  'points' => 9],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 15.7, 'max_duration' => 16.2,  'points' => 8],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 16.3, 'max_duration' => 16.8,  'points' => 7],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 16.9, 'max_duration' => 17.4,  'points' => 6],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 17.5, 'max_duration' => 18,  'points' => 5],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 18.1, 'max_duration' => 18.6,  'points' => 4],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 18.7, 'max_duration' => 19.2,  'points' => 3],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 19.3, 'max_duration' => 19.8,  'points' => 2],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 19.9, 'max_duration' => 20.4,  'points' => 1],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 20.5, 'max_duration' => 60.0,  'points' => 0],

            //Age 16 and boys
            ['age' => 16, 'gender' => 'male', 'min_duration' => 0, 'max_duration' => 15.5,  'points' => 10],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 15.6, 'max_duration' => 16.1,  'points' => 9],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 16.2, 'max_duration' => 16.7,  'points' => 8],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 16.8, 'max_duration' => 17.3,  'points' => 7],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 17.4, 'max_duration' => 17.9,  'points' => 6],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 18.0, 'max_duration' => 18.5,  'points' => 5],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 18.6, 'max_duration' => 19.1,  'points' => 4],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 19.2, 'max_duration' => 19.7,  'points' => 3],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 19.8, 'max_duration' => 20.3,  'points' => 2],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 20.4, 'max_duration' => 20.9,  'points' => 1],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 21.0, 'max_duration' => 60.0,  'points' => 0],

            //Age 15 and boys
            ['age' => 15, 'gender' => 'male', 'min_duration' => 0, 'max_duration' => 16,  'points' => 10],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 16.1, 'max_duration' => 16.6,  'points' => 9],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 16.7, 'max_duration' => 17.2,  'points' => 8],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 17.3, 'max_duration' => 17.8,  'points' => 7],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 17.9, 'max_duration' => 18.4,  'points' => 6],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 18.5, 'max_duration' => 19.0,  'points' => 5],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 19.1, 'max_duration' => 19.6,  'points' => 4],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 19.7, 'max_duration' => 20.2,  'points' => 3],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 20.3, 'max_duration' => 20.8,  'points' => 2],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 20.9, 'max_duration' => 21.4,  'points' => 1],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 21.5, 'max_duration' => 60.0,  'points' => 0],

            //Age 14 and gender male
            ['age' => 14, 'gender' => 'male', 'min_duration' => 0, 'max_duration' => 16.5,  'points' => 10],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 16.6, 'max_duration' => 17.1,  'points' => 9],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 17.2, 'max_duration' => 17.7,  'points' => 8],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 17.8, 'max_duration' => 18.3,  'points' => 7],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 18.4, 'max_duration' => 18.9,  'points' => 6],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 19.0, 'max_duration' => 19.5,  'points' => 5],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 19.6, 'max_duration' => 20.1,  'points' => 4],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 20.2, 'max_duration' => 20.7,  'points' => 3],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 20.8, 'max_duration' => 21.3,  'points' => 2],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 21.4, 'max_duration' => 21.9,  'points' => 1],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 22.0, 'max_duration' => 60.0,  'points' => 0],

            //Age 13 and gender male
            ['age' => 13, 'gender' => 'male', 'min_duration' => 0, 'max_duration' => 17,  'points' => 10],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 17.1, 'max_duration' => 17.6,  'points' => 9],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 17.7, 'max_duration' => 18.2,  'points' => 8],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 18.3, 'max_duration' => 18.8,  'points' => 7],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 18.9, 'max_duration' => 19.4,  'points' => 6],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 19.5, 'max_duration' => 20.0,  'points' => 5],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 20.1, 'max_duration' => 20.6,  'points' => 4],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 20.7, 'max_duration' => 21.2,  'points' => 3],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 21.3, 'max_duration' => 21.8,  'points' => 2],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 21.9, 'max_duration' => 22.4,  'points' => 1],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 22.5, 'max_duration' => 60.0,  'points' => 0],

            // Age 12 and gender male
            ['age' => 12, 'gender' => 'male', 'min_duration' => 0, 'max_duration' => 17.5,  'points' => 10],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 17.6, 'max_duration' => 18.1,  'points' => 9],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 18.2, 'max_duration' => 18.7,  'points' => 8],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 18.8, 'max_duration' => 19.3,  'points' => 7],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 19.4, 'max_duration' => 19.9,  'points' => 6],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 20.0, 'max_duration' => 20.5,  'points' => 5],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 20.6, 'max_duration' => 21.1,  'points' => 4],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 21.2, 'max_duration' => 21.7,  'points' => 3],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 21.8, 'max_duration' => 22.3,  'points' => 2],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 22.4, 'max_duration' => 22.9,  'points' => 1],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 23.0, 'max_duration' => 60.0,  'points' => 0],


            //Age 11 and gender 11
            ['age' => 11, 'gender' => 'male', 'min_duration' => 0, 'max_duration' => 18,  'points' => 10],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 18.1, 'max_duration' => 18.6,  'points' => 9],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 18.7, 'max_duration' => 19.2,  'points' => 8],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 19.3, 'max_duration' => 19.8,  'points' => 7],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 19.9, 'max_duration' => 20.4,  'points' => 6],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 20.5, 'max_duration' => 21.0,  'points' => 5],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 21.1, 'max_duration' => 21.6,  'points' => 4],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 21.7, 'max_duration' => 22.2,  'points' => 3],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 22.3, 'max_duration' => 22.8,  'points' => 2],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 22.9, 'max_duration' => 23.4,  'points' => 1],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 23.5, 'max_duration' => 60.0,  'points' => 0],

            // Age 10 and gender male
            ['age' => 10, 'gender' => 'male', 'min_duration' => 0, 'max_duration' => 18.5,  'points' => 10],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 18.6, 'max_duration' => 19.1,  'points' => 9],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 19.2, 'max_duration' => 19.7,  'points' => 8],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 19.8, 'max_duration' => 20.3,  'points' => 7],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 20.4, 'max_duration' => 20.9,  'points' => 6],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 21.0, 'max_duration' => 21.5,  'points' => 5],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 21.6, 'max_duration' => 22.1,  'points' => 4],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 22.2, 'max_duration' => 22.7,  'points' => 3],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 22.8, 'max_duration' => 23.3,  'points' => 2],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 23.4, 'max_duration' => 23.9,  'points' => 1],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 24.0, 'max_duration' => 60.0,  'points' => 0],

            // Age 9 and gender male
            ['age' => 9, 'gender' => 'male', 'min_duration' => 0, 'max_duration' => 19,  'points' => 10],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 19.1, 'max_duration' => 19.6,  'points' => 9],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 19.7, 'max_duration' => 20.2,  'points' => 8],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 20.3, 'max_duration' => 20.8,  'points' => 7],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 20.9, 'max_duration' => 21.4,  'points' => 6],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 21.5, 'max_duration' => 22.0,  'points' => 5],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 22.1, 'max_duration' => 22.6,  'points' => 4],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 22.7, 'max_duration' => 23.2,  'points' => 3],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 23.3, 'max_duration' => 23.8,  'points' => 2],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 23.9, 'max_duration' => 24.4,  'points' => 1],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 24.5, 'max_duration' => 60.0,  'points' => 0],

            // Age 8 and gender male
            ['age' => 8, 'gender' => 'male', 'min_duration' => 0, 'max_duration' => 19.5,  'points' => 10],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 19.6, 'max_duration' => 20.1,  'points' => 9],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 20.2, 'max_duration' => 20.7,  'points' => 8],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 20.8, 'max_duration' => 21.3,  'points' => 7],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 21.4, 'max_duration' => 21.9,  'points' => 6],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 22.0, 'max_duration' => 22.5,  'points' => 5],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 22.6, 'max_duration' => 23.1,  'points' => 4],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 23.2, 'max_duration' => 23.7,  'points' => 3],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 23.8, 'max_duration' => 24.3,  'points' => 2],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 24.4, 'max_duration' => 24.9,  'points' => 1],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 25.0, 'max_duration' => 60.0,  'points' => 0],


            // Age 7 and gender male
            ['age' => 7, 'gender' => 'male', 'min_duration' => 0, 'max_duration' => 20,  'points' => 10],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 20.1, 'max_duration' => 20.6,  'points' => 9],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 20.7, 'max_duration' => 21.2,  'points' => 8],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 21.3, 'max_duration' => 21.8,  'points' => 7],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 21.9, 'max_duration' => 22.4,  'points' => 6],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 22.5, 'max_duration' => 23.0,  'points' => 5],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 23.1, 'max_duration' => 23.6,  'points' => 4],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 23.7, 'max_duration' => 24.2,  'points' => 3],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 24.3, 'max_duration' => 24.8,  'points' => 2],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 24.9, 'max_duration' => 25.4,  'points' => 1],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 25.5, 'max_duration' => 60.0,  'points' => 0],

            // Age 18 agen gender female
            ['age' => 18, 'gender' => 'female', 'min_duration' => 0, 'max_duration' => 16.3,  'points' => 10],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 16.4, 'max_duration' => 17.1,  'points' => 9],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 17.2, 'max_duration' => 17.9,  'points' => 8],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 18.0, 'max_duration' => 18.7,  'points' => 7],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 18.8, 'max_duration' => 19.5,  'points' => 6],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 19.6, 'max_duration' => 20.3,  'points' => 5],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 20.4, 'max_duration' => 21.1,  'points' => 4],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 21.2, 'max_duration' => 21.9,  'points' => 3],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 22.0, 'max_duration' => 22.7,  'points' => 2],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 22.8, 'max_duration' => 23.5,  'points' => 1],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 23.6, 'max_duration' => 60.0,  'points' => 0],

            // Age 17 and gender female
            ['age' => 17, 'gender' => 'female', 'min_duration' => 0, 'max_duration' => 16.8,  'points' => 10],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 16.9, 'max_duration' => 17.6,  'points' => 9],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 17.7, 'max_duration' => 18.4,  'points' => 8],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 18.5, 'max_duration' => 19.2,  'points' => 7],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 19.3, 'max_duration' => 20.0,  'points' => 6],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 20.1, 'max_duration' => 20.8,  'points' => 5],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 20.9, 'max_duration' => 21.6,  'points' => 4],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 21.7, 'max_duration' => 22.4,  'points' => 3],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 22.5, 'max_duration' => 23.2,  'points' => 2],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 23.3, 'max_duration' => 24.0,  'points' => 1],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 24.1, 'max_duration' => 60.0,  'points' => 0],

            // Age 16 and gender female
            ['age' => 16, 'gender' => 'female', 'min_duration' => 0, 'max_duration' => 17.3,  'points' => 10],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 17.4, 'max_duration' => 18.1,  'points' => 9],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 18.2, 'max_duration' => 18.9,  'points' => 8],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 19.0, 'max_duration' => 19.7,  'points' => 7],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 19.8, 'max_duration' => 20.5,  'points' => 6],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 20.6, 'max_duration' => 21.3,  'points' => 5],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 21.4, 'max_duration' => 22.1,  'points' => 4],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 22.2, 'max_duration' => 22.9,  'points' => 3],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 23.0, 'max_duration' => 23.7,  'points' => 2],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 23.8, 'max_duration' => 24.5,  'points' => 1],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 24.6, 'max_duration' => 60.0,  'points' => 0],

            // Age 15 and gender female
            ['age' => 15, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 17.8, 'points' => 10],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 17.9, 'max_duration' => 18.6, 'points' => 9],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 18.7, 'max_duration' => 19.4, 'points' => 8],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 19.5, 'max_duration' => 20.2, 'points' => 7],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 20.3, 'max_duration' => 21.0, 'points' => 6],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 21.1, 'max_duration' => 21.8, 'points' => 5],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 21.9, 'max_duration' => 22.6, 'points' => 4],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 22.7, 'max_duration' => 23.4, 'points' => 3],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 23.5, 'max_duration' => 24.2, 'points' => 2],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 24.3, 'max_duration' => 25.0, 'points' => 1],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 25.1, 'max_duration' => 60.0, 'points' => 0],

            // Age 14 and gender female
            ['age' => 14, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 18.3, 'points' => 10],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 18.4, 'max_duration' => 19.1, 'points' => 9],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 19.2, 'max_duration' => 19.9, 'points' => 8],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 20.0, 'max_duration' => 20.7, 'points' => 7],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 20.8, 'max_duration' => 21.5, 'points' => 6],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 21.6, 'max_duration' => 22.3, 'points' => 5],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 22.4, 'max_duration' => 23.1, 'points' => 4],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 23.2, 'max_duration' => 23.9, 'points' => 3],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 24.0, 'max_duration' => 24.7, 'points' => 2],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 24.8, 'max_duration' => 25.5, 'points' => 1],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 25.6, 'max_duration' => 60.0, 'points' => 0],

            // Age 13 and gender female
            ['age' => 13, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 18.8, 'points' => 10],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 18.9, 'max_duration' => 19.6, 'points' => 9],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 19.7, 'max_duration' => 20.4, 'points' => 8],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 20.5, 'max_duration' => 21.2, 'points' => 7],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 21.3, 'max_duration' => 22.0, 'points' => 6],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 22.1, 'max_duration' => 22.8, 'points' => 5],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 22.9, 'max_duration' => 23.6, 'points' => 4],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 23.7, 'max_duration' => 24.4, 'points' => 3],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 24.5, 'max_duration' => 25.2, 'points' => 2],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 25.3, 'max_duration' => 26.0, 'points' => 1],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 26.1, 'max_duration' => 60.0, 'points' => 0],

            // Age 12 and gender female
            ['age' => 12, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 19.3, 'points' => 10],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 19.4, 'max_duration' => 20.1, 'points' => 9],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 20.2, 'max_duration' => 20.9, 'points' => 8],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 21.0, 'max_duration' => 21.7, 'points' => 7],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 21.8, 'max_duration' => 22.5, 'points' => 6],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 22.6, 'max_duration' => 23.3, 'points' => 5],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 23.4, 'max_duration' => 24.1, 'points' => 4],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 24.2, 'max_duration' => 24.9, 'points' => 3],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 25.0, 'max_duration' => 25.7, 'points' => 2],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 25.8, 'max_duration' => 26.5, 'points' => 1],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 26.6, 'max_duration' => 60.0, 'points' => 0],

            // Age 11 and gender female
            ['age' => 11, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 19.8, 'points' => 10],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 19.9, 'max_duration' => 20.6, 'points' => 9],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 20.7, 'max_duration' => 21.4, 'points' => 8],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 21.5, 'max_duration' => 22.2, 'points' => 7],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 22.3, 'max_duration' => 23.0, 'points' => 6],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 23.1, 'max_duration' => 23.8, 'points' => 5],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 23.9, 'max_duration' => 24.6, 'points' => 4],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 24.7, 'max_duration' => 25.4, 'points' => 3],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 25.5, 'max_duration' => 26.2, 'points' => 2],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 26.3, 'max_duration' => 27.0, 'points' => 1],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 27.1, 'max_duration' => 60.0, 'points' => 0],

            // Age 10 and gender female
            ['age' => 10, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 20.3, 'points' => 10],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 20.4, 'max_duration' => 21.1, 'points' => 9],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 21.2, 'max_duration' => 21.9, 'points' => 8],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 22.0, 'max_duration' => 22.7, 'points' => 7],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 22.8, 'max_duration' => 23.5, 'points' => 6],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 23.6, 'max_duration' => 24.3, 'points' => 5],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 24.4, 'max_duration' => 25.1, 'points' => 4],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 25.2, 'max_duration' => 25.9, 'points' => 3],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 26.0, 'max_duration' => 26.7, 'points' => 2],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 26.8, 'max_duration' => 27.5, 'points' => 1],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 27.6, 'max_duration' => 60.0, 'points' => 0],

            // Age 9 and gender female
            ['age' => 9, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 20.8, 'points' => 10],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 20.9, 'max_duration' => 21.6, 'points' => 9],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 21.7, 'max_duration' => 22.4, 'points' => 8],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 22.5, 'max_duration' => 23.2, 'points' => 7],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 23.3, 'max_duration' => 24.0, 'points' => 6],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 24.1, 'max_duration' => 24.8, 'points' => 5],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 24.9, 'max_duration' => 25.6, 'points' => 4],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 25.7, 'max_duration' => 26.4, 'points' => 3],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 26.5, 'max_duration' => 27.2, 'points' => 2],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 27.3, 'max_duration' => 28.0, 'points' => 1],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 28.1, 'max_duration' => 60.0, 'points' => 0],

            // Age 8 and gender female
            ['age' => 8, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 21.3, 'points' => 10],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 21.4, 'max_duration' => 22.1, 'points' => 9],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 22.2, 'max_duration' => 22.9, 'points' => 8],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 23.0, 'max_duration' => 23.7, 'points' => 7],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 23.8, 'max_duration' => 24.5, 'points' => 6],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 24.6, 'max_duration' => 25.3, 'points' => 5],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 25.4, 'max_duration' => 26.1, 'points' => 4],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 26.2, 'max_duration' => 26.9, 'points' => 3],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 27.0, 'max_duration' => 27.7, 'points' => 2],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 27.8, 'max_duration' => 28.5, 'points' => 1],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 28.6, 'max_duration' => 60.0, 'points' => 0],

            // Age 7 and gender female
            ['age' => 7, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 21.8, 'points' => 10],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 21.9, 'max_duration' => 22.6, 'points' => 9],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 22.7, 'max_duration' => 23.4, 'points' => 8],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 23.5, 'max_duration' => 24.2, 'points' => 7],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 24.3, 'max_duration' => 25.0, 'points' => 6],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 25.1, 'max_duration' => 25.8, 'points' => 5],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 25.9, 'max_duration' => 26.6, 'points' => 4],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 26.7, 'max_duration' => 27.4, 'points' => 3],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 27.5, 'max_duration' => 28.2, 'points' => 2],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 28.3, 'max_duration' => 29.0, 'points' => 1],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 29.1, 'max_duration' => 60.0, 'points' => 0],

        ];

        foreach ($rules as $rule) {
            AgilityTestRule::create($rule);
        }
    }
}
