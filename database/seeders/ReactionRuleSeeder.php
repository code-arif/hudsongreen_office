<?php

namespace Database\Seeders;

use App\Models\ReactionTestRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReactionRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [
            /**
             * Seeder data for male student
             */
            // Age 18 and gender male
            ['age' => 18, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 2,  'points' => 10],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 3,  'max_duration' => 4,  'points' => 9],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 5,  'max_duration' => 8,  'points' => 8],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 9,  'max_duration' => 11, 'points' => 7],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 12, 'max_duration' => 14, 'points' => 6],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 15, 'max_duration' => 18, 'points' => 5],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 19, 'max_duration' => 21, 'points' => 4],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 22, 'max_duration' => 26, 'points' => 3],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 27, 'max_duration' => 31, 'points' => 2],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 32, 'max_duration' => 36, 'points' => 1],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 37, 'max_duration' => 99, 'points' => 0],

            //Age 17 and gender male
            ['age' => 17, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 2,   'points' => 10],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 3,  'max_duration' => 5,   'points' => 9],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 6,  'max_duration' => 8,   'points' => 8],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 9,  'max_duration' => 11,  'points' => 7],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 12, 'max_duration' => 14,  'points' => 6],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 15, 'max_duration' => 18,  'points' => 5],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 19, 'max_duration' => 22,  'points' => 4],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 23, 'max_duration' => 27,  'points' => 3],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 28, 'max_duration' => 32,  'points' => 2],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 33, 'max_duration' => 37,  'points' => 1],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 38, 'max_duration' => 99, 'points' => 0],


            //Age 16 and gender male
            ['age' => 16, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 3,   'points' => 10],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 4,  'max_duration' => 5,   'points' => 9],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 6,  'max_duration' => 8,   'points' => 8],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 9,  'max_duration' => 12,  'points' => 7],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 13, 'max_duration' => 15,  'points' => 6],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 16, 'max_duration' => 19,  'points' => 5],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 20, 'max_duration' => 23,  'points' => 4],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 24, 'max_duration' => 28,  'points' => 3],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 29, 'max_duration' => 33,  'points' => 2],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 34, 'max_duration' => 38,  'points' => 1],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 39, 'max_duration' => 99, 'points' => 0],


            //Age 15 and gender male
            ['age' => 15, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 3,   'points' => 10],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 4,  'max_duration' => 5,   'points' => 9],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 6,  'max_duration' => 9,   'points' => 8],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 10, 'max_duration' => 13,  'points' => 7],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 14, 'max_duration' => 16,  'points' => 6],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 17, 'max_duration' => 20,  'points' => 5],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 21, 'max_duration' => 24,  'points' => 4],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 25, 'max_duration' => 29,  'points' => 3],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 30, 'max_duration' => 34,  'points' => 2],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 35, 'max_duration' => 39,  'points' => 1],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 40, 'max_duration' => 99, 'points' => 0],

            //Age 14 and gender male
            ['age' => 14, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 3,   'points' => 10],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 4,  'max_duration' => 6,   'points' => 9],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 7,  'max_duration' => 10,  'points' => 8],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 11, 'max_duration' => 13,  'points' => 7],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 14, 'max_duration' => 16,  'points' => 6],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 17, 'max_duration' => 20,  'points' => 5],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 21, 'max_duration' => 25,  'points' => 4],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 26, 'max_duration' => 30,  'points' => 3],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 31, 'max_duration' => 35,  'points' => 2],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 36, 'max_duration' => 40,  'points' => 1],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 41, 'max_duration' => 99, 'points' => 0],

            //Age 13 and gender male
            ['age' => 13, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 4,   'points' => 10],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 5,  'max_duration' => 6,   'points' => 9],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 7,  'max_duration' => 10,  'points' => 8],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 11, 'max_duration' => 14,  'points' => 7],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 15, 'max_duration' => 17,  'points' => 6],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 18, 'max_duration' => 22,  'points' => 5],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 23, 'max_duration' => 27,  'points' => 4],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 28, 'max_duration' => 32,  'points' => 3],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 33, 'max_duration' => 37,  'points' => 2],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 38, 'max_duration' => 42,  'points' => 1],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 43, 'max_duration' => 99, 'points' => 0],

            //Age 17 and gender male
            ['age' => 12, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 4,   'points' => 10],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 5,  'max_duration' => 7,   'points' => 9],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 8,  'max_duration' => 11,  'points' => 8],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 12, 'max_duration' => 15,  'points' => 7],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 16, 'max_duration' => 18,  'points' => 6],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 19, 'max_duration' => 23,  'points' => 5],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 24, 'max_duration' => 28,  'points' => 4],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 29, 'max_duration' => 33,  'points' => 3],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 34, 'max_duration' => 38,  'points' => 2],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 39, 'max_duration' => 43,  'points' => 1],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 44, 'max_duration' => 99, 'points' => 0],

            //Age 11 and gender male
            ['age' => 11, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 4,   'points' => 10],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 5,  'max_duration' => 7,   'points' => 9],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 8,  'max_duration' => 11,  'points' => 8],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 12, 'max_duration' => 15,  'points' => 7],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 16, 'max_duration' => 19,  'points' => 6],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 20, 'max_duration' => 24,  'points' => 5],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 25, 'max_duration' => 29,  'points' => 4],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 30, 'max_duration' => 34,  'points' => 3],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 35, 'max_duration' => 39,  'points' => 2],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 40, 'max_duration' => 44,  'points' => 1],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 45, 'max_duration' => 99, 'points' => 0],

            //Age 10 and gender male
            ['age' => 10, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 5,   'points' => 10],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 6,  'max_duration' => 8,   'points' => 9],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 9,  'max_duration' => 12,  'points' => 8],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 13, 'max_duration' => 16,  'points' => 7],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 17, 'max_duration' => 20,  'points' => 6],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 21, 'max_duration' => 25,  'points' => 5],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 26, 'max_duration' => 30,  'points' => 4],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 31, 'max_duration' => 35,  'points' => 3],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 36, 'max_duration' => 40,  'points' => 2],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 41, 'max_duration' => 45,  'points' => 1],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 46, 'max_duration' => 99, 'points' => 0],

            //Age 9 and gender male
            ['age' => 9, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 5,   'points' => 10],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 6,  'max_duration' => 8,   'points' => 9],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 9,  'max_duration' => 12,  'points' => 8],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 13, 'max_duration' => 16,  'points' => 7],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 17, 'max_duration' => 21,  'points' => 6],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 22, 'max_duration' => 26,  'points' => 5],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 27, 'max_duration' => 31,  'points' => 4],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 32, 'max_duration' => 36,  'points' => 3],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 37, 'max_duration' => 41,  'points' => 2],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 42, 'max_duration' => 46,  'points' => 1],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 47, 'max_duration' => 99, 'points' => 0],

            //Age 8 and gender male
            ['age' => 8, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 6,   'points' => 10],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 7,  'max_duration' => 10,  'points' => 9],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 11, 'max_duration' => 15,  'points' => 8],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 16, 'max_duration' => 20,  'points' => 7],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 21, 'max_duration' => 24,  'points' => 6],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 25, 'max_duration' => 29,  'points' => 5],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 30, 'max_duration' => 34,  'points' => 4],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 35, 'max_duration' => 39,  'points' => 3],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 40, 'max_duration' => 44,  'points' => 2],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 45, 'max_duration' => 49,  'points' => 1],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 50, 'max_duration' => 99, 'points' => 0],

            //Age 7 and gender male
            ['age' => 7, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 6,   'points' => 10],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 7,  'max_duration' => 10,  'points' => 9],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 11, 'max_duration' => 15,  'points' => 8],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 16, 'max_duration' => 20,  'points' => 7],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 21, 'max_duration' => 25,  'points' => 6],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 26, 'max_duration' => 30,  'points' => 5],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 31, 'max_duration' => 35,  'points' => 4],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 36, 'max_duration' => 40,  'points' => 3],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 41, 'max_duration' => 45,  'points' => 2],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 46, 'max_duration' => 50,  'points' => 1],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 51, 'max_duration' => 99, 'points' => 0],

            /**
             * Seeder data for female
             */
            //Age 18 and gender female
            ['age' => 18, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 3,   'points' => 10],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 4,  'max_duration' => 5,   'points' => 9],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 6,  'max_duration' => 8,   'points' => 8],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 9,  'max_duration' => 11,  'points' => 7],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 12, 'max_duration' => 14,  'points' => 6],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 15, 'max_duration' => 17,  'points' => 5],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 18, 'max_duration' => 21,  'points' => 4],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 22, 'max_duration' => 25,  'points' => 3],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 26, 'max_duration' => 30,  'points' => 2],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 31, 'max_duration' => 35,  'points' => 1],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 36, 'max_duration' => 99, 'points' => 0],

            //Age 17 and gender female
            ['age' => 17, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 3,   'points' => 10],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 4,  'max_duration' => 5,   'points' => 9],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 6,  'max_duration' => 8,   'points' => 8],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 9,  'max_duration' => 11,  'points' => 7],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 12, 'max_duration' => 14,  'points' => 6],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 15, 'max_duration' => 17,  'points' => 5],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 18, 'max_duration' => 22,  'points' => 4],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 23, 'max_duration' => 26,  'points' => 3],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 27, 'max_duration' => 31,  'points' => 2],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 32, 'max_duration' => 36,  'points' => 1],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 37, 'max_duration' => 99, 'points' => 0],

            //Age 16 and gender female
            ['age' => 16, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 4,   'points' => 10],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 5,  'max_duration' => 6,   'points' => 9],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 7,  'max_duration' => 9,   'points' => 8],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 10, 'max_duration' => 12,  'points' => 7],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 13, 'max_duration' => 15,  'points' => 6],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 16, 'max_duration' => 18,  'points' => 5],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 19, 'max_duration' => 23,  'points' => 4],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 24, 'max_duration' => 27,  'points' => 3],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 28, 'max_duration' => 32,  'points' => 2],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 33, 'max_duration' => 37,  'points' => 1],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 38, 'max_duration' => 99, 'points' => 0],

            //Age 15 and gender female
            ['age' => 15, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 4,   'points' => 10],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 5,  'max_duration' => 6,   'points' => 9],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 7,  'max_duration' => 9,   'points' => 8],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 10, 'max_duration' => 12,  'points' => 7],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 13, 'max_duration' => 16,  'points' => 6],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 17, 'max_duration' => 19,  'points' => 5],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 20, 'max_duration' => 24,  'points' => 4],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 25, 'max_duration' => 28,  'points' => 3],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 29, 'max_duration' => 33,  'points' => 2],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 34, 'max_duration' => 37,  'points' => 1],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 38, 'max_duration' => 99, 'points' => 0],

            //Age 14 and gender female
            ['age' => 14, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 4,   'points' => 10],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 5,  'max_duration' => 6,   'points' => 9],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 7,  'max_duration' => 10,  'points' => 8],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 11, 'max_duration' => 13,  'points' => 7],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 14, 'max_duration' => 16,  'points' => 6],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 17, 'max_duration' => 20,  'points' => 5],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 21, 'max_duration' => 25,  'points' => 4],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 26, 'max_duration' => 30,  'points' => 3],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 31, 'max_duration' => 35,  'points' => 2],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 36, 'max_duration' => 40,  'points' => 1],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 41, 'max_duration' => 99, 'points' => 0],

            //Age 13 and gender female
            ['age' => 13, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 4,   'points' => 10],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 5,  'max_duration' => 6,   'points' => 9],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 7,  'max_duration' => 10,  'points' => 8],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 11, 'max_duration' => 14,  'points' => 7],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 15, 'max_duration' => 17,  'points' => 6],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 18, 'max_duration' => 22,  'points' => 5],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 23, 'max_duration' => 27,  'points' => 4],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 28, 'max_duration' => 32,  'points' => 3],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 33, 'max_duration' => 37,  'points' => 2],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 38, 'max_duration' => 42,  'points' => 1],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 43, 'max_duration' => 99, 'points' => 0],

            //Age 12 and gender female
            ['age' => 12, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 4,   'points' => 10],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 5,  'max_duration' => 7,   'points' => 9],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 8,  'max_duration' => 11,  'points' => 8],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 12, 'max_duration' => 15,  'points' => 7],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 16, 'max_duration' => 18,  'points' => 6],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 19, 'max_duration' => 23,  'points' => 5],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 24, 'max_duration' => 28,  'points' => 4],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 29, 'max_duration' => 33,  'points' => 3],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 34, 'max_duration' => 38,  'points' => 2],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 39, 'max_duration' => 43,  'points' => 1],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 44, 'max_duration' => 99, 'points' => 0],

            //Age 11 and gender female
            ['age' => 11, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 5,   'points' => 10],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 6,  'max_duration' => 8,   'points' => 9],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 9,  'max_duration' => 12,  'points' => 8],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 13, 'max_duration' => 16,  'points' => 7],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 17, 'max_duration' => 20,  'points' => 6],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 21, 'max_duration' => 25,  'points' => 5],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 26, 'max_duration' => 30,  'points' => 4],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 31, 'max_duration' => 35,  'points' => 3],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 36, 'max_duration' => 40,  'points' => 2],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 41, 'max_duration' => 45,  'points' => 1],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 46, 'max_duration' => 99, 'points' => 0],

            //Age 10 and gender female
            ['age' => 10, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 5,   'points' => 10],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 6,  'max_duration' => 8,   'points' => 9],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 9,  'max_duration' => 12,  'points' => 8],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 13, 'max_duration' => 16,  'points' => 7],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 17, 'max_duration' => 20,  'points' => 6],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 21, 'max_duration' => 25,  'points' => 5],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 26, 'max_duration' => 30,  'points' => 4],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 31, 'max_duration' => 35,  'points' => 3],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 36, 'max_duration' => 40,  'points' => 2],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 41, 'max_duration' => 45,  'points' => 1],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 46, 'max_duration' => 99, 'points' => 0],

            //Age 9 and gender female
            ['age' => 9, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 6,   'points' => 10],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 7,  'max_duration' => 9,   'points' => 9],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 10, 'max_duration' => 13,  'points' => 8],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 14, 'max_duration' => 17,  'points' => 7],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 18, 'max_duration' => 22,  'points' => 6],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 23, 'max_duration' => 27,  'points' => 5],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 28, 'max_duration' => 32,  'points' => 4],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 33, 'max_duration' => 37,  'points' => 3],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 38, 'max_duration' => 42,  'points' => 2],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 43, 'max_duration' => 47,  'points' => 1],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 48, 'max_duration' => 99, 'points' => 0],

            //Age 8 and gender female
            ['age' => 8, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 6,   'points' => 10],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 7,  'max_duration' => 10,  'points' => 9],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 11, 'max_duration' => 15,  'points' => 8],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 16, 'max_duration' => 20,  'points' => 7],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 21, 'max_duration' => 25,  'points' => 6],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 26, 'max_duration' => 29,  'points' => 5],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 30, 'max_duration' => 34,  'points' => 4],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 35, 'max_duration' => 39,  'points' => 3],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 40, 'max_duration' => 44,  'points' => 2],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 45, 'max_duration' => 49,  'points' => 1],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 50, 'max_duration' => 99, 'points' => 0],

            //Age 7 and gender female
            ['age' => 7, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 6,   'points' => 10],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 7,  'max_duration' => 10,  'points' => 9],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 11, 'max_duration' => 15,  'points' => 8],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 16, 'max_duration' => 20,  'points' => 7],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 21, 'max_duration' => 25,  'points' => 6],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 26, 'max_duration' => 30,  'points' => 5],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 31, 'max_duration' => 35,  'points' => 4],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 36, 'max_duration' => 40,  'points' => 3],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 41, 'max_duration' => 45,  'points' => 2],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 46, 'max_duration' => 50,  'points' => 1],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 51, 'max_duration' => 99, 'points' => 0],
        ];

        foreach ($rules as $rule) {
            ReactionTestRule::create($rule);
        }
    }
}
