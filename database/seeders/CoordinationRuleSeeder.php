<?php

namespace Database\Seeders;

use App\Models\CoordinationTestRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoordinationRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [

            /**
             * Seeder data for male gender
             */

            //Age 18 and gender male
            ['age' => 18, 'gender' => 'male', 'min_score' => 0,  'max_score' => 21, 'points' => 0],
            ['age' => 18, 'gender' => 'male', 'min_score' => 22, 'max_score' => 23, 'points' => 1],
            ['age' => 18, 'gender' => 'male', 'min_score' => 24, 'max_score' => 25, 'points' => 2],
            ['age' => 18, 'gender' => 'male', 'min_score' => 26, 'max_score' => 27, 'points' => 3],
            ['age' => 18, 'gender' => 'male', 'min_score' => 28, 'max_score' => 29, 'points' => 4],
            ['age' => 18, 'gender' => 'male', 'min_score' => 30, 'max_score' => 31, 'points' => 5],
            ['age' => 18, 'gender' => 'male', 'min_score' => 32, 'max_score' => 33, 'points' => 6],
            ['age' => 18, 'gender' => 'male', 'min_score' => 34, 'max_score' => 35, 'points' => 7],
            ['age' => 18, 'gender' => 'male', 'min_score' => 36, 'max_score' => 37, 'points' => 8],
            ['age' => 18, 'gender' => 'male', 'min_score' => 38, 'max_score' => 39, 'points' => 9],
            ['age' => 18, 'gender' => 'male', 'min_score' => 40, 'max_score' => 99, 'points' => 10],


            //Age 17 and gender male
            ['age' => 17, 'gender' => 'male', 'min_score' => 0,  'max_score' => 20, 'points' => 0],
            ['age' => 17, 'gender' => 'male', 'min_score' => 21, 'max_score' => 22, 'points' => 1],
            ['age' => 17, 'gender' => 'male', 'min_score' => 23, 'max_score' => 24, 'points' => 2],
            ['age' => 17, 'gender' => 'male', 'min_score' => 25, 'max_score' => 26, 'points' => 3],
            ['age' => 17, 'gender' => 'male', 'min_score' => 27, 'max_score' => 28, 'points' => 4],
            ['age' => 17, 'gender' => 'male', 'min_score' => 29, 'max_score' => 30, 'points' => 5],
            ['age' => 17, 'gender' => 'male', 'min_score' => 31, 'max_score' => 32, 'points' => 6],
            ['age' => 17, 'gender' => 'male', 'min_score' => 33, 'max_score' => 34, 'points' => 7],
            ['age' => 17, 'gender' => 'male', 'min_score' => 35, 'max_score' => 36, 'points' => 8],
            ['age' => 17, 'gender' => 'male', 'min_score' => 37, 'max_score' => 38, 'points' => 9],
            ['age' => 17, 'gender' => 'male', 'min_score' => 39, 'max_score' => 99, 'points' => 10],


            //Age 16 and gender male
            ['age' => 16, 'gender' => 'male', 'min_score' => 0,  'max_score' => 19, 'points' => 0],
            ['age' => 16, 'gender' => 'male', 'min_score' => 20, 'max_score' => 21, 'points' => 1],
            ['age' => 16, 'gender' => 'male', 'min_score' => 22, 'max_score' => 23, 'points' => 2],
            ['age' => 16, 'gender' => 'male', 'min_score' => 24, 'max_score' => 25, 'points' => 3],
            ['age' => 16, 'gender' => 'male', 'min_score' => 26, 'max_score' => 27, 'points' => 4],
            ['age' => 16, 'gender' => 'male', 'min_score' => 28, 'max_score' => 29, 'points' => 5],
            ['age' => 16, 'gender' => 'male', 'min_score' => 30, 'max_score' => 31, 'points' => 6],
            ['age' => 16, 'gender' => 'male', 'min_score' => 32, 'max_score' => 33, 'points' => 7],
            ['age' => 16, 'gender' => 'male', 'min_score' => 34, 'max_score' => 35, 'points' => 8],
            ['age' => 16, 'gender' => 'male', 'min_score' => 36, 'max_score' => 37, 'points' => 9],
            ['age' => 16, 'gender' => 'male', 'min_score' => 38, 'max_score' => 99, 'points' => 10],


            //Age 15 and gender male
            ['age' => 15, 'gender' => 'male', 'min_score' => 0,  'max_score' => 18, 'points' => 0],
            ['age' => 15, 'gender' => 'male', 'min_score' => 19, 'max_score' => 20, 'points' => 1],
            ['age' => 15, 'gender' => 'male', 'min_score' => 21, 'max_score' => 22, 'points' => 2],
            ['age' => 15, 'gender' => 'male', 'min_score' => 23, 'max_score' => 24, 'points' => 3],
            ['age' => 15, 'gender' => 'male', 'min_score' => 25, 'max_score' => 26, 'points' => 4],
            ['age' => 15, 'gender' => 'male', 'min_score' => 27, 'max_score' => 28, 'points' => 5],
            ['age' => 15, 'gender' => 'male', 'min_score' => 29, 'max_score' => 30, 'points' => 6],
            ['age' => 15, 'gender' => 'male', 'min_score' => 31, 'max_score' => 32, 'points' => 7],
            ['age' => 15, 'gender' => 'male', 'min_score' => 33, 'max_score' => 34, 'points' => 8],
            ['age' => 15, 'gender' => 'male', 'min_score' => 35, 'max_score' => 36, 'points' => 9],
            ['age' => 15, 'gender' => 'male', 'min_score' => 37, 'max_score' => 99, 'points' => 10],


            //Age 14 and gender male
            ['age' => 14, 'gender' => 'male', 'min_score' => 0,  'max_score' => 17, 'points' => 0],
            ['age' => 14, 'gender' => 'male', 'min_score' => 18, 'max_score' => 19, 'points' => 1],
            ['age' => 14, 'gender' => 'male', 'min_score' => 20, 'max_score' => 21, 'points' => 2],
            ['age' => 14, 'gender' => 'male', 'min_score' => 22, 'max_score' => 23, 'points' => 3],
            ['age' => 14, 'gender' => 'male', 'min_score' => 24, 'max_score' => 25, 'points' => 4],
            ['age' => 14, 'gender' => 'male', 'min_score' => 26, 'max_score' => 27, 'points' => 5],
            ['age' => 14, 'gender' => 'male', 'min_score' => 28, 'max_score' => 29, 'points' => 6],
            ['age' => 14, 'gender' => 'male', 'min_score' => 30, 'max_score' => 31, 'points' => 7],
            ['age' => 14, 'gender' => 'male', 'min_score' => 32, 'max_score' => 33, 'points' => 8],
            ['age' => 14, 'gender' => 'male', 'min_score' => 34, 'max_score' => 35, 'points' => 9],
            ['age' => 14, 'gender' => 'male', 'min_score' => 36, 'max_score' => 99, 'points' => 10],


            //Age 13 and gender male
            ['age' => 13, 'gender' => 'male', 'min_score' => 0,  'max_score' => 16, 'points' => 0],
            ['age' => 13, 'gender' => 'male', 'min_score' => 17, 'max_score' => 18, 'points' => 1],
            ['age' => 13, 'gender' => 'male', 'min_score' => 19, 'max_score' => 20, 'points' => 2],
            ['age' => 13, 'gender' => 'male', 'min_score' => 21, 'max_score' => 22, 'points' => 3],
            ['age' => 13, 'gender' => 'male', 'min_score' => 23, 'max_score' => 24, 'points' => 4],
            ['age' => 13, 'gender' => 'male', 'min_score' => 25, 'max_score' => 26, 'points' => 5],
            ['age' => 13, 'gender' => 'male', 'min_score' => 27, 'max_score' => 28, 'points' => 6],
            ['age' => 13, 'gender' => 'male', 'min_score' => 29, 'max_score' => 30, 'points' => 7],
            ['age' => 13, 'gender' => 'male', 'min_score' => 31, 'max_score' => 32, 'points' => 8],
            ['age' => 13, 'gender' => 'male', 'min_score' => 33, 'max_score' => 34, 'points' => 9],
            ['age' => 13, 'gender' => 'male', 'min_score' => 35, 'max_score' => 99, 'points' => 10],


            //Age 12 and gender male
            ['age' => 12, 'gender' => 'male', 'min_score' => 0,  'max_score' => 15, 'points' => 0],
            ['age' => 12, 'gender' => 'male', 'min_score' => 16, 'max_score' => 17, 'points' => 1],
            ['age' => 12, 'gender' => 'male', 'min_score' => 18, 'max_score' => 19, 'points' => 2],
            ['age' => 12, 'gender' => 'male', 'min_score' => 20, 'max_score' => 21, 'points' => 3],
            ['age' => 12, 'gender' => 'male', 'min_score' => 22, 'max_score' => 23, 'points' => 4],
            ['age' => 12, 'gender' => 'male', 'min_score' => 24, 'max_score' => 25, 'points' => 5],
            ['age' => 12, 'gender' => 'male', 'min_score' => 26, 'max_score' => 27, 'points' => 6],
            ['age' => 12, 'gender' => 'male', 'min_score' => 28, 'max_score' => 29, 'points' => 7],
            ['age' => 12, 'gender' => 'male', 'min_score' => 30, 'max_score' => 31, 'points' => 8],
            ['age' => 12, 'gender' => 'male', 'min_score' => 32, 'max_score' => 33, 'points' => 9],
            ['age' => 12, 'gender' => 'male', 'min_score' => 34, 'max_score' => 99, 'points' => 10],


            //Age 11 and gender male
            ['age' => 11, 'gender' => 'male', 'min_score' => 0,  'max_score' => 14, 'points' => 0],
            ['age' => 11, 'gender' => 'male', 'min_score' => 15, 'max_score' => 16, 'points' => 1],
            ['age' => 11, 'gender' => 'male', 'min_score' => 17, 'max_score' => 18, 'points' => 2],
            ['age' => 11, 'gender' => 'male', 'min_score' => 19, 'max_score' => 20, 'points' => 3],
            ['age' => 11, 'gender' => 'male', 'min_score' => 21, 'max_score' => 22, 'points' => 4],
            ['age' => 11, 'gender' => 'male', 'min_score' => 23, 'max_score' => 24, 'points' => 5],
            ['age' => 11, 'gender' => 'male', 'min_score' => 25, 'max_score' => 26, 'points' => 6],
            ['age' => 11, 'gender' => 'male', 'min_score' => 27, 'max_score' => 28, 'points' => 7],
            ['age' => 11, 'gender' => 'male', 'min_score' => 29, 'max_score' => 30, 'points' => 8],
            ['age' => 11, 'gender' => 'male', 'min_score' => 31, 'max_score' => 32, 'points' => 9],
            ['age' => 11, 'gender' => 'male', 'min_score' => 33, 'max_score' => 99, 'points' => 10],


            //Age 10 and gender male
            ['age' => 10, 'gender' => 'male', 'min_score' => 0,  'max_score' => 13, 'points' => 0],
            ['age' => 10, 'gender' => 'male', 'min_score' => 14, 'max_score' => 15, 'points' => 1],
            ['age' => 10, 'gender' => 'male', 'min_score' => 16, 'max_score' => 17, 'points' => 2],
            ['age' => 10, 'gender' => 'male', 'min_score' => 18, 'max_score' => 19, 'points' => 3],
            ['age' => 10, 'gender' => 'male', 'min_score' => 20, 'max_score' => 21, 'points' => 4],
            ['age' => 10, 'gender' => 'male', 'min_score' => 22, 'max_score' => 23, 'points' => 5],
            ['age' => 10, 'gender' => 'male', 'min_score' => 24, 'max_score' => 25, 'points' => 6],
            ['age' => 10, 'gender' => 'male', 'min_score' => 26, 'max_score' => 27, 'points' => 7],
            ['age' => 10, 'gender' => 'male', 'min_score' => 28, 'max_score' => 29, 'points' => 8],
            ['age' => 10, 'gender' => 'male', 'min_score' => 30, 'max_score' => 31, 'points' => 9],
            ['age' => 10, 'gender' => 'male', 'min_score' => 32, 'max_score' => 99, 'points' => 10],


            //Age 9 and gender male
            ['age' => 9, 'gender' => 'male', 'min_score' => 0,  'max_score' => 12, 'points' => 0],
            ['age' => 9, 'gender' => 'male', 'min_score' => 13, 'max_score' => 14, 'points' => 1],
            ['age' => 9, 'gender' => 'male', 'min_score' => 15, 'max_score' => 16, 'points' => 2],
            ['age' => 9, 'gender' => 'male', 'min_score' => 17, 'max_score' => 18, 'points' => 3],
            ['age' => 9, 'gender' => 'male', 'min_score' => 19, 'max_score' => 20, 'points' => 4],
            ['age' => 9, 'gender' => 'male', 'min_score' => 21, 'max_score' => 22, 'points' => 5],
            ['age' => 9, 'gender' => 'male', 'min_score' => 23, 'max_score' => 24, 'points' => 6],
            ['age' => 9, 'gender' => 'male', 'min_score' => 25, 'max_score' => 26, 'points' => 7],
            ['age' => 9, 'gender' => 'male', 'min_score' => 27, 'max_score' => 28, 'points' => 8],
            ['age' => 9, 'gender' => 'male', 'min_score' => 29, 'max_score' => 30, 'points' => 9],
            ['age' => 9, 'gender' => 'male', 'min_score' => 31, 'max_score' => 99, 'points' => 10],


            //Age 8 and gender male
            ['age' => 8, 'gender' => 'male', 'min_score' => 0,  'max_score' => 11, 'points' => 0],
            ['age' => 8, 'gender' => 'male', 'min_score' => 12, 'max_score' => 13, 'points' => 1],
            ['age' => 8, 'gender' => 'male', 'min_score' => 14, 'max_score' => 15, 'points' => 2],
            ['age' => 8, 'gender' => 'male', 'min_score' => 16, 'max_score' => 17, 'points' => 3],
            ['age' => 8, 'gender' => 'male', 'min_score' => 18, 'max_score' => 19, 'points' => 4],
            ['age' => 8, 'gender' => 'male', 'min_score' => 20, 'max_score' => 21, 'points' => 5],
            ['age' => 8, 'gender' => 'male', 'min_score' => 22, 'max_score' => 23, 'points' => 6],
            ['age' => 8, 'gender' => 'male', 'min_score' => 24, 'max_score' => 25, 'points' => 7],
            ['age' => 8, 'gender' => 'male', 'min_score' => 26, 'max_score' => 27, 'points' => 8],
            ['age' => 8, 'gender' => 'male', 'min_score' => 28, 'max_score' => 29, 'points' => 9],
            ['age' => 8, 'gender' => 'male', 'min_score' => 30, 'max_score' => 99, 'points' => 10],


            //Age 7 and gender male
            ['age' => 7, 'gender' => 'male', 'min_score' => 0,  'max_score' => 10, 'points' => 0],
            ['age' => 7, 'gender' => 'male', 'min_score' => 11, 'max_score' => 12, 'points' => 1],
            ['age' => 7, 'gender' => 'male', 'min_score' => 13, 'max_score' => 14, 'points' => 2],
            ['age' => 7, 'gender' => 'male', 'min_score' => 15, 'max_score' => 16, 'points' => 3],
            ['age' => 7, 'gender' => 'male', 'min_score' => 17, 'max_score' => 18, 'points' => 4],
            ['age' => 7, 'gender' => 'male', 'min_score' => 19, 'max_score' => 20, 'points' => 5],
            ['age' => 7, 'gender' => 'male', 'min_score' => 21, 'max_score' => 22, 'points' => 6],
            ['age' => 7, 'gender' => 'male', 'min_score' => 23, 'max_score' => 24, 'points' => 7],
            ['age' => 7, 'gender' => 'male', 'min_score' => 25, 'max_score' => 26, 'points' => 8],
            ['age' => 7, 'gender' => 'male', 'min_score' => 27, 'max_score' => 28, 'points' => 9],
            ['age' => 7, 'gender' => 'male', 'min_score' => 29, 'max_score' => 99, 'points' => 10],


            /**
             * Seeder data for female gender
             */

            //Age 18 and gender female
            ['age' => 18, 'gender' => 'female', 'min_score' => 0,  'max_score' => 16, 'points' => 0],
            ['age' => 18, 'gender' => 'female', 'min_score' => 17, 'max_score' => 18, 'points' => 1],
            ['age' => 18, 'gender' => 'female', 'min_score' => 19, 'max_score' => 20, 'points' => 2],
            ['age' => 18, 'gender' => 'female', 'min_score' => 21, 'max_score' => 22, 'points' => 3],
            ['age' => 18, 'gender' => 'female', 'min_score' => 23, 'max_score' => 24, 'points' => 4],
            ['age' => 18, 'gender' => 'female', 'min_score' => 25, 'max_score' => 26, 'points' => 5],
            ['age' => 18, 'gender' => 'female', 'min_score' => 27, 'max_score' => 28, 'points' => 6],
            ['age' => 18, 'gender' => 'female', 'min_score' => 29, 'max_score' => 30, 'points' => 7],
            ['age' => 18, 'gender' => 'female', 'min_score' => 31, 'max_score' => 32, 'points' => 8],
            ['age' => 18, 'gender' => 'female', 'min_score' => 33, 'max_score' => 34, 'points' => 9],
            ['age' => 18, 'gender' => 'female', 'min_score' => 35, 'max_score' => 99, 'points' => 10],

            //Age 17 and gender female
            ['age' => 17, 'gender' => 'female', 'min_score' => 0,  'max_score' => 15, 'points' => 0],
            ['age' => 17, 'gender' => 'female', 'min_score' => 16, 'max_score' => 17, 'points' => 1],
            ['age' => 17, 'gender' => 'female', 'min_score' => 18, 'max_score' => 19, 'points' => 2],
            ['age' => 17, 'gender' => 'female', 'min_score' => 20, 'max_score' => 21, 'points' => 3],
            ['age' => 17, 'gender' => 'female', 'min_score' => 22, 'max_score' => 23, 'points' => 4],
            ['age' => 17, 'gender' => 'female', 'min_score' => 24, 'max_score' => 25, 'points' => 5],
            ['age' => 17, 'gender' => 'female', 'min_score' => 26, 'max_score' => 27, 'points' => 6],
            ['age' => 17, 'gender' => 'female', 'min_score' => 28, 'max_score' => 29, 'points' => 7],
            ['age' => 17, 'gender' => 'female', 'min_score' => 30, 'max_score' => 31, 'points' => 8],
            ['age' => 17, 'gender' => 'female', 'min_score' => 32, 'max_score' => 33, 'points' => 9],
            ['age' => 17, 'gender' => 'female', 'min_score' => 34, 'max_score' => 99, 'points' => 10],


            //Age 16 and gender female
            ['age' => 16, 'gender' => 'female', 'min_score' => 0,  'max_score' => 14, 'points' => 0],
            ['age' => 16, 'gender' => 'female', 'min_score' => 15, 'max_score' => 16, 'points' => 1],
            ['age' => 16, 'gender' => 'female', 'min_score' => 17, 'max_score' => 18, 'points' => 2],
            ['age' => 16, 'gender' => 'female', 'min_score' => 19, 'max_score' => 20, 'points' => 3],
            ['age' => 16, 'gender' => 'female', 'min_score' => 21, 'max_score' => 22, 'points' => 4],
            ['age' => 16, 'gender' => 'female', 'min_score' => 23, 'max_score' => 24, 'points' => 5],
            ['age' => 16, 'gender' => 'female', 'min_score' => 25, 'max_score' => 26, 'points' => 6],
            ['age' => 16, 'gender' => 'female', 'min_score' => 27, 'max_score' => 28, 'points' => 7],
            ['age' => 16, 'gender' => 'female', 'min_score' => 29, 'max_score' => 30, 'points' => 8],
            ['age' => 16, 'gender' => 'female', 'min_score' => 31, 'max_score' => 32, 'points' => 9],
            ['age' => 16, 'gender' => 'female', 'min_score' => 33, 'max_score' => 99, 'points' => 10],


            //Age 15 and gender female
            ['age' => 15, 'gender' => 'female', 'min_score' => 0,  'max_score' => 13, 'points' => 0],
            ['age' => 15, 'gender' => 'female', 'min_score' => 14, 'max_score' => 15, 'points' => 1],
            ['age' => 15, 'gender' => 'female', 'min_score' => 16, 'max_score' => 17, 'points' => 2],
            ['age' => 15, 'gender' => 'female', 'min_score' => 18, 'max_score' => 19, 'points' => 3],
            ['age' => 15, 'gender' => 'female', 'min_score' => 20, 'max_score' => 21, 'points' => 4],
            ['age' => 15, 'gender' => 'female', 'min_score' => 22, 'max_score' => 23, 'points' => 5],
            ['age' => 15, 'gender' => 'female', 'min_score' => 24, 'max_score' => 25, 'points' => 6],
            ['age' => 15, 'gender' => 'female', 'min_score' => 26, 'max_score' => 27, 'points' => 7],
            ['age' => 15, 'gender' => 'female', 'min_score' => 28, 'max_score' => 29, 'points' => 8],
            ['age' => 15, 'gender' => 'female', 'min_score' => 30, 'max_score' => 31, 'points' => 9],
            ['age' => 15, 'gender' => 'female', 'min_score' => 32, 'max_score' => 99, 'points' => 10],

            //Age 14 and gender female
            ['age' => 14, 'gender' => 'female', 'min_score' => 0,  'max_score' => 12, 'points' => 0],
            ['age' => 14, 'gender' => 'female', 'min_score' => 13, 'max_score' => 14, 'points' => 1],
            ['age' => 14, 'gender' => 'female', 'min_score' => 15, 'max_score' => 16, 'points' => 2],
            ['age' => 14, 'gender' => 'female', 'min_score' => 17, 'max_score' => 18, 'points' => 3],
            ['age' => 14, 'gender' => 'female', 'min_score' => 19, 'max_score' => 20, 'points' => 4],
            ['age' => 14, 'gender' => 'female', 'min_score' => 21, 'max_score' => 22, 'points' => 5],
            ['age' => 14, 'gender' => 'female', 'min_score' => 23, 'max_score' => 24, 'points' => 6],
            ['age' => 14, 'gender' => 'female', 'min_score' => 25, 'max_score' => 26, 'points' => 7],
            ['age' => 14, 'gender' => 'female', 'min_score' => 27, 'max_score' => 28, 'points' => 8],
            ['age' => 14, 'gender' => 'female', 'min_score' => 29, 'max_score' => 30, 'points' => 9],
            ['age' => 14, 'gender' => 'female', 'min_score' => 31, 'max_score' => 99, 'points' => 10],


            //Age 13 and gender female
            ['age' => 13, 'gender' => 'female', 'min_score' => 0,  'max_score' => 11, 'points' => 0],
            ['age' => 13, 'gender' => 'female', 'min_score' => 12, 'max_score' => 13, 'points' => 1],
            ['age' => 13, 'gender' => 'female', 'min_score' => 14, 'max_score' => 15, 'points' => 2],
            ['age' => 13, 'gender' => 'female', 'min_score' => 16, 'max_score' => 17, 'points' => 3],
            ['age' => 13, 'gender' => 'female', 'min_score' => 18, 'max_score' => 19, 'points' => 4],
            ['age' => 13, 'gender' => 'female', 'min_score' => 20, 'max_score' => 21, 'points' => 5],
            ['age' => 13, 'gender' => 'female', 'min_score' => 22, 'max_score' => 23, 'points' => 6],
            ['age' => 13, 'gender' => 'female', 'min_score' => 24, 'max_score' => 25, 'points' => 7],
            ['age' => 13, 'gender' => 'female', 'min_score' => 26, 'max_score' => 27, 'points' => 8],
            ['age' => 13, 'gender' => 'female', 'min_score' => 28, 'max_score' => 29, 'points' => 9],
            ['age' => 13, 'gender' => 'female', 'min_score' => 30, 'max_score' => 99, 'points' => 10],


            //Age 12 and gender female
            ['age' => 12, 'gender' => 'female', 'min_score' => 0,  'max_score' => 10, 'points' => 0],
            ['age' => 12, 'gender' => 'female', 'min_score' => 11, 'max_score' => 12, 'points' => 1],
            ['age' => 12, 'gender' => 'female', 'min_score' => 13, 'max_score' => 14, 'points' => 2],
            ['age' => 12, 'gender' => 'female', 'min_score' => 15, 'max_score' => 16, 'points' => 3],
            ['age' => 12, 'gender' => 'female', 'min_score' => 17, 'max_score' => 18, 'points' => 4],
            ['age' => 12, 'gender' => 'female', 'min_score' => 19, 'max_score' => 20, 'points' => 5],
            ['age' => 12, 'gender' => 'female', 'min_score' => 21, 'max_score' => 22, 'points' => 6],
            ['age' => 12, 'gender' => 'female', 'min_score' => 23, 'max_score' => 24, 'points' => 7],
            ['age' => 12, 'gender' => 'female', 'min_score' => 25, 'max_score' => 26, 'points' => 8],
            ['age' => 12, 'gender' => 'female', 'min_score' => 27, 'max_score' => 28, 'points' => 9],
            ['age' => 12, 'gender' => 'female', 'min_score' => 29, 'max_score' => 99, 'points' => 10],


            //Age 11 and gender female
            ['age' => 11, 'gender' => 'female', 'min_score' => 0,  'max_score' => 9, 'points' => 0],
            ['age' => 11, 'gender' => 'female', 'min_score' => 10, 'max_score' => 11, 'points' => 1],
            ['age' => 11, 'gender' => 'female', 'min_score' => 12, 'max_score' => 13, 'points' => 2],
            ['age' => 11, 'gender' => 'female', 'min_score' => 14, 'max_score' => 15, 'points' => 3],
            ['age' => 11, 'gender' => 'female', 'min_score' => 16, 'max_score' => 17, 'points' => 4],
            ['age' => 11, 'gender' => 'female', 'min_score' => 18, 'max_score' => 19, 'points' => 5],
            ['age' => 11, 'gender' => 'female', 'min_score' => 20, 'max_score' => 21, 'points' => 6],
            ['age' => 11, 'gender' => 'female', 'min_score' => 22, 'max_score' => 23, 'points' => 7],
            ['age' => 11, 'gender' => 'female', 'min_score' => 24, 'max_score' => 25, 'points' => 8],
            ['age' => 11, 'gender' => 'female', 'min_score' => 26, 'max_score' => 27, 'points' => 9],
            ['age' => 11, 'gender' => 'female', 'min_score' => 28, 'max_score' => 99, 'points' => 10],


            //Age 10 and gender female
            ['age' => 10, 'gender' => 'female', 'min_score' => 0,  'max_score' => 8, 'points' => 0],
            ['age' => 10, 'gender' => 'female', 'min_score' => 9, 'max_score' => 10, 'points' => 1],
            ['age' => 10, 'gender' => 'female', 'min_score' => 11, 'max_score' => 12, 'points' => 2],
            ['age' => 10, 'gender' => 'female', 'min_score' => 13, 'max_score' => 14, 'points' => 3],
            ['age' => 10, 'gender' => 'female', 'min_score' => 15, 'max_score' => 16, 'points' => 4],
            ['age' => 10, 'gender' => 'female', 'min_score' => 17, 'max_score' => 18, 'points' => 5],
            ['age' => 10, 'gender' => 'female', 'min_score' => 19, 'max_score' => 20, 'points' => 6],
            ['age' => 10, 'gender' => 'female', 'min_score' => 21, 'max_score' => 22, 'points' => 7],
            ['age' => 10, 'gender' => 'female', 'min_score' => 23, 'max_score' => 24, 'points' => 8],
            ['age' => 10, 'gender' => 'female', 'min_score' => 25, 'max_score' => 26, 'points' => 9],
            ['age' => 10, 'gender' => 'female', 'min_score' => 27, 'max_score' => 99, 'points' => 10],


            //Age 9 and gender female
            ['age' => 9, 'gender' => 'female', 'min_score' => 0,  'max_score' => 7, 'points' => 0],
            ['age' => 9, 'gender' => 'female', 'min_score' => 8, 'max_score' => 9, 'points' => 1],
            ['age' => 9, 'gender' => 'female', 'min_score' => 10, 'max_score' => 11, 'points' => 2],
            ['age' => 9, 'gender' => 'female', 'min_score' => 12, 'max_score' => 13, 'points' => 3],
            ['age' => 9, 'gender' => 'female', 'min_score' => 14, 'max_score' => 15, 'points' => 4],
            ['age' => 9, 'gender' => 'female', 'min_score' => 16, 'max_score' => 17, 'points' => 5],
            ['age' => 9, 'gender' => 'female', 'min_score' => 18, 'max_score' => 19, 'points' => 6],
            ['age' => 9, 'gender' => 'female', 'min_score' => 20, 'max_score' => 21, 'points' => 7],
            ['age' => 9, 'gender' => 'female', 'min_score' => 22, 'max_score' => 23, 'points' => 8],
            ['age' => 9, 'gender' => 'female', 'min_score' => 24, 'max_score' => 25, 'points' => 9],
            ['age' => 9, 'gender' => 'female', 'min_score' => 26, 'max_score' => 99, 'points' => 10],

            //Age 8 and gender female
            ['age' => 8, 'gender' => 'female', 'min_score' => 0,  'max_score' => 6, 'points' => 0],
            ['age' => 8, 'gender' => 'female', 'min_score' => 7, 'max_score' => 8, 'points' => 1],
            ['age' => 8, 'gender' => 'female', 'min_score' => 9, 'max_score' => 10, 'points' => 2],
            ['age' => 8, 'gender' => 'female', 'min_score' => 11, 'max_score' => 12, 'points' => 3],
            ['age' => 8, 'gender' => 'female', 'min_score' => 13, 'max_score' => 14, 'points' => 4],
            ['age' => 8, 'gender' => 'female', 'min_score' => 15, 'max_score' => 16, 'points' => 5],
            ['age' => 8, 'gender' => 'female', 'min_score' => 17, 'max_score' => 18, 'points' => 6],
            ['age' => 8, 'gender' => 'female', 'min_score' => 19, 'max_score' => 20, 'points' => 7],
            ['age' => 8, 'gender' => 'female', 'min_score' => 21, 'max_score' => 22, 'points' => 8],
            ['age' => 8, 'gender' => 'female', 'min_score' => 23, 'max_score' => 24, 'points' => 9],
            ['age' => 8, 'gender' => 'female', 'min_score' => 25, 'max_score' => 99, 'points' => 10],

            //Age 7 and gender female
            ['age' => 7, 'gender' => 'female', 'min_score' => 0,  'max_score' => 5, 'points' => 0],
            ['age' => 7, 'gender' => 'female', 'min_score' => 6, 'max_score' => 7, 'points' => 1],
            ['age' => 7, 'gender' => 'female', 'min_score' => 8, 'max_score' => 9, 'points' => 2],
            ['age' => 7, 'gender' => 'female', 'min_score' => 10, 'max_score' => 11, 'points' => 3],
            ['age' => 7, 'gender' => 'female', 'min_score' => 12, 'max_score' => 13, 'points' => 4],
            ['age' => 7, 'gender' => 'female', 'min_score' => 14, 'max_score' => 15, 'points' => 5],
            ['age' => 7, 'gender' => 'female', 'min_score' => 16, 'max_score' => 17, 'points' => 6],
            ['age' => 7, 'gender' => 'female', 'min_score' => 18, 'max_score' => 19, 'points' => 7],
            ['age' => 7, 'gender' => 'female', 'min_score' => 20, 'max_score' => 21, 'points' => 8],
            ['age' => 7, 'gender' => 'female', 'min_score' => 22, 'max_score' => 23, 'points' => 9],
            ['age' => 7, 'gender' => 'female', 'min_score' => 24, 'max_score' => 99, 'points' => 10],
        ];

        foreach ($rules as $rule) {
            CoordinationTestRule::create($rule);
        }
    }
}
