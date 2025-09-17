<?php

namespace Database\Seeders;

use App\Models\FlexibilityTestRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlexibilityRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [

            /**
             * Seeder Data for female
             */

            // Age 18 and gender male
            ['age' => 18, 'gender' => 'male', 'min_distance' => 23, 'max_distance' => 100,  'points' => 10],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 20, 'max_distance' => 22,  'points' => 9],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 18, 'max_distance' => 19,  'points' => 8],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 16, 'max_distance' => 17,  'points' => 7],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 14, 'max_distance' => 15,  'points' => 6],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 12, 'max_distance' => 13,  'points' => 5],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 9, 'max_distance' => 11,  'points' => 4],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 6, 'max_distance' => 8,  'points' => 3],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 2, 'max_distance' => 5,  'points' => 2],
            ['age' => 18, 'gender' => 'male', 'min_distance' => -2, 'max_distance' => 1,  'points' => 1],
            ['age' => 18, 'gender' => 'male', 'min_distance' => -7, 'max_distance' => -3,  'points' => 0],

            // Age 17 and gender male
            ['age' => 17, 'gender' => 'male', 'min_distance' => 22, 'max_distance' => 100, 'points' => 10],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 19, 'max_distance' => 21, 'points' => 9],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 17, 'max_distance' => 18, 'points' => 8],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 15, 'max_distance' => 16, 'points' => 7],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 13, 'max_distance' => 14, 'points' => 6],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 11, 'max_distance' => 12, 'points' => 5],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 8, 'max_distance' => 10, 'points' => 4],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 5, 'max_distance' => 7, 'points' => 3],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 1, 'max_distance' => 4, 'points' => 2],
            ['age' => 17, 'gender' => 'male', 'min_distance' => -3, 'max_distance' => 0, 'points' => 1],
            ['age' => 17, 'gender' => 'male', 'min_distance' => -8, 'max_distance' => -4, 'points' => 0],

            // Age 16 and gender male
            ['age' => 16, 'gender' => 'male', 'min_distance' => 20, 'max_distance' => 100, 'points' => 10],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 17, 'max_distance' => 19, 'points' => 9],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 14, 'max_distance' => 16, 'points' => 8],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 12, 'max_distance' => 13, 'points' => 7],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 10, 'max_distance' => 11, 'points' => 6],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 7, 'max_distance' => 9, 'points' => 5],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 4, 'max_distance' => 6, 'points' => 4],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 1, 'max_distance' => 3, 'points' => 3],
            ['age' => 16, 'gender' => 'male', 'min_distance' => -2, 'max_distance' => 0, 'points' => 2],
            ['age' => 16, 'gender' => 'male', 'min_distance' => -5, 'max_distance' => -3, 'points' => 1],
            ['age' => 16, 'gender' => 'male', 'min_distance' => -9, 'max_distance' => -6, 'points' => 0],

            // Age 15 and gender male
            ['age' => 15, 'gender' => 'male', 'min_distance' => 18, 'max_distance' => 100, 'points' => 10],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 15, 'max_distance' => 17, 'points' => 9],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 13, 'max_distance' => 14, 'points' => 8],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 11, 'max_distance' => 12, 'points' => 7],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 9, 'max_distance' => 10, 'points' => 6],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 7, 'max_distance' => 8, 'points' => 5],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 4, 'max_distance' => 6, 'points' => 4],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 1, 'max_distance' => 3, 'points' => 3],
            ['age' => 15, 'gender' => 'male', 'min_distance' => -2, 'max_distance' => 0, 'points' => 2],
            ['age' => 15, 'gender' => 'male', 'min_distance' => -6, 'max_distance' => -3, 'points' => 1],
            ['age' => 15, 'gender' => 'male', 'min_distance' => -10, 'max_distance' => -7, 'points' => 0],

            //Age 14 and gender male
            ['age' => 14, 'gender' => 'male', 'min_distance' => 16, 'max_distance' => 100, 'points' => 10],
            ['age' => 14, 'gender' => 'male', 'min_distance' => 13, 'max_distance' => 15, 'points' => 9],
            ['age' => 14, 'gender' => 'male', 'min_distance' => 11, 'max_distance' => 12, 'points' => 8],
            ['age' => 14, 'gender' => 'male', 'min_distance' => 9, 'max_distance' => 10, 'points' => 7],
            ['age' => 14, 'gender' => 'male', 'min_distance' => 7, 'max_distance' => 8, 'points' => 6],
            ['age' => 14, 'gender' => 'male', 'min_distance' => 5, 'max_distance' => 6, 'points' => 5],
            ['age' => 14, 'gender' => 'male', 'min_distance' => 2, 'max_distance' => 4, 'points' => 4],
            ['age' => 14, 'gender' => 'male', 'min_distance' => -1, 'max_distance' => 1, 'points' => 3],
            ['age' => 14, 'gender' => 'male', 'min_distance' => -4, 'max_distance' => -2, 'points' => 2],
            ['age' => 14, 'gender' => 'male', 'min_distance' => -7, 'max_distance' => -5, 'points' => 1],
            ['age' => 14, 'gender' => 'male', 'min_distance' => -10, 'max_distance' => -8, 'points' => 0],

            // Age 13 and gender male
            ['age' => 13, 'gender' => 'male', 'min_distance' => 13, 'max_distance' => 100, 'points' => 10],
            ['age' => 13, 'gender' => 'male', 'min_distance' => 11, 'max_distance' => 12, 'points' => 9],
            ['age' => 13, 'gender' => 'male', 'min_distance' => 9, 'max_distance' => 10, 'points' => 8],
            ['age' => 13, 'gender' => 'male', 'min_distance' => 7, 'max_distance' => 8, 'points' => 7],
            ['age' => 13, 'gender' => 'male', 'min_distance' => 5, 'max_distance' => 6, 'points' => 6],
            ['age' => 13, 'gender' => 'male', 'min_distance' => 3, 'max_distance' => 4, 'points' => 5],
            ['age' => 13, 'gender' => 'male', 'min_distance' => 1, 'max_distance' => 2, 'points' => 4],
            ['age' => 13, 'gender' => 'male', 'min_distance' => -1, 'max_distance' => 0, 'points' => 3],
            ['age' => 13, 'gender' => 'male', 'min_distance' => -4, 'max_distance' => -2, 'points' => 2],
            ['age' => 13, 'gender' => 'male', 'min_distance' => -7, 'max_distance' => -5, 'points' => 1],
            ['age' => 13, 'gender' => 'male', 'min_distance' => -10, 'max_distance' => -8, 'points' => 0],

            // Age 12 and gender male
            ['age' => 12, 'gender' => 'male', 'min_distance' => 12, 'max_distance' => 100, 'points' => 10],
            ['age' => 12, 'gender' => 'male', 'min_distance' => 11, 'max_distance' => 11, 'points' => 9],
            ['age' => 12, 'gender' => 'male', 'min_distance' => 9, 'max_distance' => 10, 'points' => 8],
            ['age' => 12, 'gender' => 'male', 'min_distance' => 7, 'max_distance' => 8, 'points' => 7],
            ['age' => 12, 'gender' => 'male', 'min_distance' => 5, 'max_distance' => 6, 'points' => 6],
            ['age' => 12, 'gender' => 'male', 'min_distance' => 3, 'max_distance' => 4, 'points' => 5],
            ['age' => 12, 'gender' => 'male', 'min_distance' => 1, 'max_distance' => 2, 'points' => 4],
            ['age' => 12, 'gender' => 'male', 'min_distance' => -1, 'max_distance' => 0, 'points' => 3],
            ['age' => 12, 'gender' => 'male', 'min_distance' => -4, 'max_distance' => -2, 'points' => 2],
            ['age' => 12, 'gender' => 'male', 'min_distance' => -7, 'max_distance' => -5, 'points' => 1],
            ['age' => 12, 'gender' => 'male', 'min_distance' => -10, 'max_distance' => -8, 'points' => 0],

            // Age 11 and gender male
            ['age' => 11, 'gender' => 'male', 'min_distance' => 11, 'max_distance' => 100, 'points' => 10],
            ['age' => 11, 'gender' => 'male', 'min_distance' => 10, 'max_distance' => 10, 'points' => 9],
            ['age' => 11, 'gender' => 'male', 'min_distance' => 8, 'max_distance' => 9, 'points' => 8],
            ['age' => 11, 'gender' => 'male', 'min_distance' => 6, 'max_distance' => 7, 'points' => 7],
            ['age' => 11, 'gender' => 'male', 'min_distance' => 4, 'max_distance' => 5, 'points' => 6],
            ['age' => 11, 'gender' => 'male', 'min_distance' => 2, 'max_distance' => 3, 'points' => 5],
            ['age' => 11, 'gender' => 'male', 'min_distance' => 0, 'max_distance' => 1, 'points' => 4],
            ['age' => 11, 'gender' => 'male', 'min_distance' => -2, 'max_distance' => -1, 'points' => 3],
            ['age' => 11, 'gender' => 'male', 'min_distance' => -4, 'max_distance' => -3, 'points' => 2],
            ['age' => 11, 'gender' => 'male', 'min_distance' => -7, 'max_distance' => -5, 'points' => 1],
            ['age' => 11, 'gender' => 'male', 'min_distance' => -10, 'max_distance' => -8, 'points' => 0],

            // Age 10 and gender male
            ['age' => 10, 'gender' => 'male', 'min_distance' => 11, 'max_distance' => 100, 'points' => 10],
            ['age' => 10, 'gender' => 'male', 'min_distance' => 10, 'max_distance' => 10, 'points' => 9],
            ['age' => 10, 'gender' => 'male', 'min_distance' => 8, 'max_distance' => 9, 'points' => 8],
            ['age' => 10, 'gender' => 'male', 'min_distance' => 6, 'max_distance' => 7, 'points' => 7],
            ['age' => 10, 'gender' => 'male', 'min_distance' => 4, 'max_distance' => 5, 'points' => 6],
            ['age' => 10, 'gender' => 'male', 'min_distance' => 2, 'max_distance' => 3, 'points' => 5],
            ['age' => 10, 'gender' => 'male', 'min_distance' => 0, 'max_distance' => 1, 'points' => 4],
            ['age' => 10, 'gender' => 'male', 'min_distance' => -2, 'max_distance' => -1, 'points' => 3],
            ['age' => 10, 'gender' => 'male', 'min_distance' => -4, 'max_distance' => -3, 'points' => 2],
            ['age' => 10, 'gender' => 'male', 'min_distance' => -7, 'max_distance' => -5, 'points' => 1],
            ['age' => 10, 'gender' => 'male', 'min_distance' => -10, 'max_distance' => -8, 'points' => 0],

            // Age 9 and gender male
            ['age' => 9, 'gender' => 'male', 'min_distance' => 11, 'max_distance' => 100, 'points' => 10],
            ['age' => 9, 'gender' => 'male', 'min_distance' => 10, 'max_distance' => 10, 'points' => 9],
            ['age' => 9, 'gender' => 'male', 'min_distance' => 8, 'max_distance' => 9, 'points' => 8],
            ['age' => 9, 'gender' => 'male', 'min_distance' => 6, 'max_distance' => 7, 'points' => 7],
            ['age' => 9, 'gender' => 'male', 'min_distance' => 4, 'max_distance' => 5, 'points' => 6],
            ['age' => 9, 'gender' => 'male', 'min_distance' => 2, 'max_distance' => 3, 'points' => 5],
            ['age' => 9, 'gender' => 'male', 'min_distance' => 1, 'max_distance' => 1, 'points' => 4],
            ['age' => 9, 'gender' => 'male', 'min_distance' => -1, 'max_distance' => 0, 'points' => 3],
            ['age' => 9, 'gender' => 'male', 'min_distance' => -3, 'max_distance' => -2, 'points' => 2],
            ['age' => 9, 'gender' => 'male', 'min_distance' => -5, 'max_distance' => -4, 'points' => 1],
            ['age' => 9, 'gender' => 'male', 'min_distance' => -7, 'max_distance' => -6, 'points' => 0],

            // Age 8 and gender male
            ['age' => 8, 'gender' => 'male', 'min_distance' => 11, 'max_distance' => 100, 'points' => 10],
            ['age' => 8, 'gender' => 'male', 'min_distance' => 10, 'max_distance' => 10, 'points' => 9],
            ['age' => 8, 'gender' => 'male', 'min_distance' => 8, 'max_distance' => 9, 'points' => 8],
            ['age' => 8, 'gender' => 'male', 'min_distance' => 6, 'max_distance' => 7, 'points' => 7],
            ['age' => 8, 'gender' => 'male', 'min_distance' => 4, 'max_distance' => 5, 'points' => 6],
            ['age' => 8, 'gender' => 'male', 'min_distance' => 2, 'max_distance' => 3, 'points' => 5],
            ['age' => 8, 'gender' => 'male', 'min_distance' => 1, 'max_distance' => 1, 'points' => 4],
            ['age' => 8, 'gender' => 'male', 'min_distance' => -1, 'max_distance' => 0, 'points' => 3],
            ['age' => 8, 'gender' => 'male', 'min_distance' => -3, 'max_distance' => -2, 'points' => 2],
            ['age' => 8, 'gender' => 'male', 'min_distance' => -5, 'max_distance' => -4, 'points' => 1],
            ['age' => 8, 'gender' => 'male', 'min_distance' => -7, 'max_distance' => -6, 'points' => 0],

            // Age 7 and gender male
            ['age' => 7, 'gender' => 'male', 'min_distance' => 10, 'max_distance' => 100, 'points' => 10],
            ['age' => 7, 'gender' => 'male', 'min_distance' => 9, 'max_distance' => 9, 'points' => 9],
            ['age' => 7, 'gender' => 'male', 'min_distance' => 8, 'max_distance' => 8, 'points' => 8],
            ['age' => 7, 'gender' => 'male', 'min_distance' => 6, 'max_distance' => 7, 'points' => 7],
            ['age' => 7, 'gender' => 'male', 'min_distance' => 4, 'max_distance' => 5, 'points' => 6],
            ['age' => 7, 'gender' => 'male', 'min_distance' => 2, 'max_distance' => 3, 'points' => 5],
            ['age' => 7, 'gender' => 'male', 'min_distance' => 1, 'max_distance' => 1, 'points' => 4],
            ['age' => 7, 'gender' => 'male', 'min_distance' => -1, 'max_distance' => 0, 'points' => 3],
            ['age' => 7, 'gender' => 'male', 'min_distance' => -3, 'max_distance' => -2, 'points' => 2],
            ['age' => 7, 'gender' => 'male', 'min_distance' => -5, 'max_distance' => -4, 'points' => 1],
            ['age' => 7, 'gender' => 'male', 'min_distance' => -7, 'max_distance' => -6, 'points' => 0],

            /**
             * Seeder Data for female
             */

            // Age 18 and gender female
            ['age' => 18, 'gender' => 'female', 'min_distance' => 23, 'max_distance' => 100, 'points' => 10],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 21, 'max_distance' => 22, 'points' => 9],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 19, 'max_distance' => 20, 'points' => 8],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 17, 'max_distance' => 18, 'points' => 7],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 15, 'max_distance' => 16, 'points' => 6],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 13, 'max_distance' => 14, 'points' => 5],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 10, 'max_distance' => 12, 'points' => 4],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 8, 'max_distance' => 9, 'points' => 3],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 4, 'max_distance' => 7, 'points' => 2],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 0, 'max_distance' => 3, 'points' => 1],
            ['age' => 18, 'gender' => 'female', 'min_distance' => -4, 'max_distance' => -1, 'points' => 0],

            // Age 17 and gender female
            ['age' => 17, 'gender' => 'female', 'min_distance' => 23, 'max_distance' => 100, 'points' => 10],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 21, 'max_distance' => 22, 'points' => 9],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 19, 'max_distance' => 20, 'points' => 8],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 17, 'max_distance' => 18, 'points' => 7],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 15, 'max_distance' => 16, 'points' => 6],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 13, 'max_distance' => 14, 'points' => 5],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 10, 'max_distance' => 12, 'points' => 4],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 8, 'max_distance' => 9, 'points' => 3],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 4, 'max_distance' => 7, 'points' => 2],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 0, 'max_distance' => 3, 'points' => 1],
            ['age' => 17, 'gender' => 'female', 'min_distance' => -4, 'max_distance' => -1, 'points' => 0],

            // Age 16 and gender female
            ['age' => 16, 'gender' => 'female', 'min_distance' => 23, 'max_distance' => 100, 'points' => 10],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 21, 'max_distance' => 22, 'points' => 9],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 19, 'max_distance' => 20, 'points' => 8],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 17, 'max_distance' => 18, 'points' => 7],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 15, 'max_distance' => 16, 'points' => 6],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 13, 'max_distance' => 14, 'points' => 5],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 10, 'max_distance' => 12, 'points' => 4],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 8, 'max_distance' => 9, 'points' => 3],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 4, 'max_distance' => 7, 'points' => 2],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 0, 'max_distance' => 3, 'points' => 1],
            ['age' => 16, 'gender' => 'female', 'min_distance' => -4, 'max_distance' => -1, 'points' => 0],


            // Age 15 and gender female
            ['age' => 15, 'gender' => 'female', 'min_distance' => 23, 'max_distance' => 100, 'points' => 10],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 21, 'max_distance' => 22, 'points' => 9],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 19, 'max_distance' => 20, 'points' => 8],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 17, 'max_distance' => 18, 'points' => 7],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 15, 'max_distance' => 16, 'points' => 6],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 13, 'max_distance' => 14, 'points' => 5],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 10, 'max_distance' => 12, 'points' => 4],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 8, 'max_distance' => 9, 'points' => 3],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 4, 'max_distance' => 7, 'points' => 2],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 0, 'max_distance' => 3, 'points' => 1],
            ['age' => 15, 'gender' => 'female', 'min_distance' => -4, 'max_distance' => -1, 'points' => 0],


            // Age 14 and gender female
            ['age' => 14, 'gender' => 'female', 'min_distance' => 21, 'max_distance' => 100, 'points' => 10],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 19, 'max_distance' => 20, 'points' => 9],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 17, 'max_distance' => 18, 'points' => 8],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 15, 'max_distance' => 16, 'points' => 7],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 13, 'max_distance' => 14, 'points' => 6],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 10, 'max_distance' => 12, 'points' => 5],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 7, 'max_distance' => 9, 'points' => 4],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 4, 'max_distance' => 6, 'points' => 3],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 1, 'max_distance' => 3, 'points' => 2],
            ['age' => 14, 'gender' => 'female', 'min_distance' => -2, 'max_distance' => 0, 'points' => 1],
            ['age' => 14, 'gender' => 'female', 'min_distance' => -5, 'max_distance' => -3, 'points' => 0],

            // Age 13 and gender female
            ['age' => 13, 'gender' => 'female', 'min_distance' => 20, 'max_distance' => 100, 'points' => 10],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 18, 'max_distance' => 19, 'points' => 9],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 16, 'max_distance' => 17, 'points' => 8],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 14, 'max_distance' => 15, 'points' => 7],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 11, 'max_distance' => 13, 'points' => 6],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 8, 'max_distance' => 10, 'points' => 5],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 6, 'max_distance' => 7, 'points' => 4],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 3, 'max_distance' => 5, 'points' => 3],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 0, 'max_distance' => 2, 'points' => 2],
            ['age' => 13, 'gender' => 'female', 'min_distance' => -3, 'max_distance' => -1, 'points' => 1],
            ['age' => 13, 'gender' => 'female', 'min_distance' => -6, 'max_distance' => -4, 'points' => 0],

            // Age 12 and gender female
            ['age' => 12, 'gender' => 'female', 'min_distance' => 17, 'max_distance' => 100, 'points' => 10],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 15, 'max_distance' => 16, 'points' => 9],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 13, 'max_distance' => 14, 'points' => 8],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 11, 'max_distance' => 12, 'points' => 7],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 9, 'max_distance' => 10, 'points' => 6],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 7, 'max_distance' => 8, 'points' => 5],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 5, 'max_distance' => 6, 'points' => 4],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 2, 'max_distance' => 4, 'points' => 3],
            ['age' => 12, 'gender' => 'female', 'min_distance' => -1, 'max_distance' => 1, 'points' => 2],
            ['age' => 12, 'gender' => 'female', 'min_distance' => -4, 'max_distance' => -2, 'points' => 1],
            ['age' => 12, 'gender' => 'female', 'min_distance' => -7, 'max_distance' => -5, 'points' => 0],

            // Age 11 and gender female
            ['age' => 11, 'gender' => 'female', 'min_distance' => 14, 'max_distance' => 100, 'points' => 10],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 13, 'max_distance' => 13, 'points' => 9],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 12, 'max_distance' => 12, 'points' => 8],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 10, 'max_distance' => 11, 'points' => 7],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 8, 'max_distance' => 9, 'points' => 6],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 6, 'max_distance' => 7, 'points' => 5],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 4, 'max_distance' => 5, 'points' => 4],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 2, 'max_distance' => 3, 'points' => 3],
            ['age' => 11, 'gender' => 'female', 'min_distance' => -1, 'max_distance' => 1, 'points' => 2],
            ['age' => 11, 'gender' => 'female', 'min_distance' => -4, 'max_distance' => -2, 'points' => 1],
            ['age' => 11, 'gender' => 'female', 'min_distance' => -7, 'max_distance' => -5, 'points' => 0],

            // Age 10 and gender female
            ['age' => 10, 'gender' => 'female', 'min_distance' => 12, 'max_distance' => 100, 'points' => 10],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 11, 'max_distance' => 11, 'points' => 9],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 10, 'max_distance' => 10, 'points' => 8],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 9, 'max_distance' => 9, 'points' => 7],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 7, 'max_distance' => 8, 'points' => 6],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 5, 'max_distance' => 6, 'points' => 5],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 3, 'max_distance' => 4, 'points' => 4],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 1, 'max_distance' => 2, 'points' => 3],
            ['age' => 10, 'gender' => 'female', 'min_distance' => -1, 'max_distance' => 0, 'points' => 2],
            ['age' => 10, 'gender' => 'female', 'min_distance' => -4, 'max_distance' => -2, 'points' => 1],
            ['age' => 10, 'gender' => 'female', 'min_distance' => -7, 'max_distance' => -5, 'points' => 0],

            // Age 9 ang gender female
            ['age' => 9, 'gender' => 'female', 'min_distance' => 12, 'max_distance' => 100, 'points' => 10],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 11, 'max_distance' => 11, 'points' => 9],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 10, 'max_distance' => 10, 'points' => 8],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 9, 'max_distance' => 9, 'points' => 7],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 7, 'max_distance' => 8, 'points' => 6],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 5, 'max_distance' => 6, 'points' => 5],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 3, 'max_distance' => 4, 'points' => 4],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 1, 'max_distance' => 2, 'points' => 3],
            ['age' => 9, 'gender' => 'female', 'min_distance' => -1, 'max_distance' => 0, 'points' => 2],
            ['age' => 9, 'gender' => 'female', 'min_distance' => -3, 'max_distance' => -2, 'points' => 1],
            ['age' => 9, 'gender' => 'female', 'min_distance' => -6, 'max_distance' => -4, 'points' => 0],

            // Age 8 ang gender female
            ['age' => 8, 'gender' => 'female', 'min_distance' => 12, 'max_distance' => 100, 'points' => 10],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 11, 'max_distance' => 11, 'points' => 9],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 10, 'max_distance' => 10, 'points' => 8],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 9, 'max_distance' => 9, 'points' => 7],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 7, 'max_distance' => 8, 'points' => 6],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 5, 'max_distance' => 6, 'points' => 5],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 3, 'max_distance' => 4, 'points' => 4],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 1, 'max_distance' => 2, 'points' => 3],
            ['age' => 8, 'gender' => 'female', 'min_distance' => -1, 'max_distance' => 0, 'points' => 2],
            ['age' => 8, 'gender' => 'female', 'min_distance' => -3, 'max_distance' => -2, 'points' => 1],
            ['age' => 8, 'gender' => 'female', 'min_distance' => -6, 'max_distance' => -4, 'points' => 0],

            // Age 7 ang gender female
            ['age' => 7, 'gender' => 'female', 'min_distance' => 11, 'max_distance' => 100, 'points' => 10],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 10, 'max_distance' => 10, 'points' => 9],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 9, 'max_distance' => 9, 'points' => 8],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 8, 'max_distance' => 8, 'points' => 7],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 6, 'max_distance' => 7, 'points' => 6],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 4, 'max_distance' => 5, 'points' => 5],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 2, 'max_distance' => 3, 'points' => 4],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 0, 'max_distance' => 1, 'points' => 3],
            ['age' => 7, 'gender' => 'female', 'min_distance' => -2, 'max_distance' => -1, 'points' => 2],
            ['age' => 7, 'gender' => 'female', 'min_distance' => -4, 'max_distance' => -3, 'points' => 1],
            ['age' => 7, 'gender' => 'female', 'min_distance' => -6, 'max_distance' => -5, 'points' => 0],
        ];

        foreach ($rules as $rule) {
            FlexibilityTestRule::create($rule);
        }
    }
}
