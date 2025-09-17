<?php

namespace Database\Seeders;

use App\Models\BalanceTestRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BalanceRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [
            /**
             * Seeder data for male
             */

            // Age 18 and gender male
            ['age' => 18, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 40, 'points' => 0],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 41, 'max_duration' => 45, 'points' => 1],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 46, 'max_duration' => 50, 'points' => 2],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 51, 'max_duration' => 55, 'points' => 3],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 56, 'max_duration' => 60, 'points' => 4],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 61, 'max_duration' => 65, 'points' => 5],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 66, 'max_duration' => 70, 'points' => 6],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 71, 'max_duration' => 75, 'points' => 7],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 76, 'max_duration' => 80, 'points' => 8],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 81, 'max_duration' => 85, 'points' => 9],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 86, 'max_duration' => 99, 'points' => 10],


            // Age 17 and gender male
            ['age' => 17, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 38, 'points' => 0],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 38, 'max_duration' => 42, 'points' => 1],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 43, 'max_duration' => 47, 'points' => 2],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 48, 'max_duration' => 52, 'points' => 3],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 53, 'max_duration' => 57, 'points' => 4],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 58, 'max_duration' => 62, 'points' => 5],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 63, 'max_duration' => 67, 'points' => 6],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 68, 'max_duration' => 72, 'points' => 7],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 73, 'max_duration' => 77, 'points' => 8],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 78, 'max_duration' => 82, 'points' => 9],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 83, 'max_duration' => 99, 'points' => 10],


            // Age 16 and gender male
            ['age' => 16, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 35, 'points' => 0],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 35, 'max_duration' => 39, 'points' => 1],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 40, 'max_duration' => 44, 'points' => 2],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 45, 'max_duration' => 49, 'points' => 3],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 50, 'max_duration' => 54, 'points' => 4],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 55, 'max_duration' => 59, 'points' => 5],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 60, 'max_duration' => 64, 'points' => 6],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 65, 'max_duration' => 69, 'points' => 7],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 70, 'max_duration' => 74, 'points' => 8],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 75, 'max_duration' => 79, 'points' => 9],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 80, 'max_duration' => 99, 'points' => 10],


            // Age 15 and gender male
            ['age' => 15, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 32, 'points' => 0],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 32, 'max_duration' => 36, 'points' => 1],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 37, 'max_duration' => 41, 'points' => 2],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 42, 'max_duration' => 46, 'points' => 3],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 47, 'max_duration' => 51, 'points' => 4],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 52, 'max_duration' => 56, 'points' => 5],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 57, 'max_duration' => 61, 'points' => 6],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 62, 'max_duration' => 66, 'points' => 7],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 67, 'max_duration' => 71, 'points' => 8],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 72, 'max_duration' => 76, 'points' => 9],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 77, 'max_duration' => 99, 'points' => 10],


            // Age 14 and gender male
            ['age' => 14, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 29, 'points' => 0],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 29, 'max_duration' => 33, 'points' => 1],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 34, 'max_duration' => 38, 'points' => 2],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 39, 'max_duration' => 43, 'points' => 3],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 44, 'max_duration' => 48, 'points' => 4],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 49, 'max_duration' => 53, 'points' => 5],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 54, 'max_duration' => 58, 'points' => 6],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 59, 'max_duration' => 63, 'points' => 7],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 64, 'max_duration' => 68, 'points' => 8],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 69, 'max_duration' => 73, 'points' => 9],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 74, 'max_duration' => 99, 'points' => 10],


            // Age 13 and gender male
            ['age' => 13, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 26, 'points' => 0],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 26, 'max_duration' => 30, 'points' => 1],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 31, 'max_duration' => 35, 'points' => 2],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 36, 'max_duration' => 40, 'points' => 3],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 41, 'max_duration' => 45, 'points' => 4],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 46, 'max_duration' => 50, 'points' => 5],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 51, 'max_duration' => 55, 'points' => 6],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 56, 'max_duration' => 60, 'points' => 7],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 61, 'max_duration' => 65, 'points' => 8],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 66, 'max_duration' => 70, 'points' => 9],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 71, 'max_duration' => 99, 'points' => 10],


            // Age 12 and gender male
            ['age' => 12, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 23, 'points' => 0],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 23, 'max_duration' => 27, 'points' => 1],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 28, 'max_duration' => 32, 'points' => 2],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 33, 'max_duration' => 37, 'points' => 3],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 38, 'max_duration' => 42, 'points' => 4],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 43, 'max_duration' => 47, 'points' => 5],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 48, 'max_duration' => 52, 'points' => 6],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 53, 'max_duration' => 57, 'points' => 7],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 58, 'max_duration' => 62, 'points' => 8],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 63, 'max_duration' => 67, 'points' => 9],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 68, 'max_duration' => 99, 'points' => 10],


            // Age 11 and gender male
            ['age' => 11, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 20, 'points' => 0],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 20, 'max_duration' => 24, 'points' => 1],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 25, 'max_duration' => 29, 'points' => 2],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 30, 'max_duration' => 34, 'points' => 3],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 35, 'max_duration' => 39, 'points' => 4],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 40, 'max_duration' => 44, 'points' => 5],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 45, 'max_duration' => 49, 'points' => 6],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 50, 'max_duration' => 54, 'points' => 7],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 55, 'max_duration' => 59, 'points' => 8],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 60, 'max_duration' => 64, 'points' => 9],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 65, 'max_duration' => 99, 'points' => 10],


            // Age 10 and gender male
            ['age' => 10, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 17, 'points' => 0],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 17, 'max_duration' => 21, 'points' => 1],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 22, 'max_duration' => 26, 'points' => 2],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 27, 'max_duration' => 31, 'points' => 3],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 32, 'max_duration' => 36, 'points' => 4],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 37, 'max_duration' => 41, 'points' => 5],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 42, 'max_duration' => 46, 'points' => 6],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 47, 'max_duration' => 51, 'points' => 7],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 52, 'max_duration' => 56, 'points' => 8],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 57, 'max_duration' => 61, 'points' => 9],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 62, 'max_duration' => 99, 'points' => 10],


            // Age 9 and gender male
            ['age' => 9, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 14, 'points' => 0],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 14, 'max_duration' => 18, 'points' => 1],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 19, 'max_duration' => 23, 'points' => 2],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 24, 'max_duration' => 28, 'points' => 3],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 29, 'max_duration' => 33, 'points' => 4],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 34, 'max_duration' => 38, 'points' => 5],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 39, 'max_duration' => 43, 'points' => 6],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 44, 'max_duration' => 48, 'points' => 7],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 49, 'max_duration' => 53, 'points' => 8],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 54, 'max_duration' => 58, 'points' => 9],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 59, 'max_duration' => 99, 'points' => 10],


            // Age 8 and gender male
            ['age' => 8, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 11, 'points' => 0],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 11, 'max_duration' => 15, 'points' => 1],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 16, 'max_duration' => 20, 'points' => 2],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 21, 'max_duration' => 25, 'points' => 3],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 26, 'max_duration' => 30, 'points' => 4],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 31, 'max_duration' => 35, 'points' => 5],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 36, 'max_duration' => 40, 'points' => 6],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 41, 'max_duration' => 45, 'points' => 7],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 46, 'max_duration' => 50, 'points' => 8],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 51, 'max_duration' => 55, 'points' => 9],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 56, 'max_duration' => 99, 'points' => 10],


            // Age 7 and gender male
            ['age' => 7, 'gender' => 'male', 'min_duration' => 0,  'max_duration' => 8, 'points' => 0],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 8,  'max_duration' => 12, 'points' => 1],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 13, 'max_duration' => 17, 'points' => 2],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 18, 'max_duration' => 22, 'points' => 3],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 23, 'max_duration' => 27, 'points' => 4],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 28, 'max_duration' => 32, 'points' => 5],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 33, 'max_duration' => 37, 'points' => 6],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 38, 'max_duration' => 42, 'points' => 7],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 43, 'max_duration' => 47, 'points' => 8],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 48, 'max_duration' => 52, 'points' => 9],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 53, 'max_duration' => 99, 'points' => 10],


            /**
             * Seeder data for female
             */

            // Age 18 and gender female
            ['age' => 18, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 26, 'points' => 0],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 26, 'max_duration' => 30, 'points' => 1],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 31, 'max_duration' => 35, 'points' => 2],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 36, 'max_duration' => 40, 'points' => 3],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 41, 'max_duration' => 45, 'points' => 4],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 46, 'max_duration' => 50, 'points' => 5],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 51, 'max_duration' => 55, 'points' => 6],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 56, 'max_duration' => 60, 'points' => 7],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 61, 'max_duration' => 65, 'points' => 8],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 66, 'max_duration' => 70, 'points' => 9],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 71, 'max_duration' => 99, 'points' => 10],


            // Age 17 and gender female
            ['age' => 17, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 24, 'points' => 0],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 24, 'max_duration' => 28, 'points' => 1],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 29, 'max_duration' => 33, 'points' => 2],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 34, 'max_duration' => 38, 'points' => 3],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 39, 'max_duration' => 43, 'points' => 4],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 44, 'max_duration' => 48, 'points' => 5],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 49, 'max_duration' => 53, 'points' => 6],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 54, 'max_duration' => 58, 'points' => 7],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 59, 'max_duration' => 63, 'points' => 8],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 64, 'max_duration' => 68, 'points' => 9],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 69, 'max_duration' => 99, 'points' => 10],


            // Age 16 and gender female
            ['age' => 16, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 22, 'points' => 0],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 22, 'max_duration' => 26, 'points' => 1],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 27, 'max_duration' => 31, 'points' => 2],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 32, 'max_duration' => 36, 'points' => 3],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 37, 'max_duration' => 41, 'points' => 4],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 42, 'max_duration' => 46, 'points' => 5],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 47, 'max_duration' => 51, 'points' => 6],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 52, 'max_duration' => 56, 'points' => 7],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 57, 'max_duration' => 61, 'points' => 8],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 62, 'max_duration' => 66, 'points' => 9],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 67, 'max_duration' => 99, 'points' => 10],


            // Age 15 and gender female
            ['age' => 15, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 20, 'points' => 0],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 20, 'max_duration' => 24, 'points' => 1],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 25, 'max_duration' => 29, 'points' => 2],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 30, 'max_duration' => 34, 'points' => 3],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 35, 'max_duration' => 39, 'points' => 4],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 40, 'max_duration' => 44, 'points' => 5],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 45, 'max_duration' => 49, 'points' => 6],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 50, 'max_duration' => 54, 'points' => 7],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 55, 'max_duration' => 59, 'points' => 8],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 60, 'max_duration' => 64, 'points' => 9],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 65, 'max_duration' => 99, 'points' => 10],


            // Age 14 and gender female
            ['age' => 14, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 18, 'points' => 0],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 18, 'max_duration' => 22, 'points' => 1],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 23, 'max_duration' => 27, 'points' => 2],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 28, 'max_duration' => 32, 'points' => 3],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 33, 'max_duration' => 37, 'points' => 4],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 38, 'max_duration' => 42, 'points' => 5],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 43, 'max_duration' => 47, 'points' => 6],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 48, 'max_duration' => 52, 'points' => 7],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 53, 'max_duration' => 57, 'points' => 8],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 58, 'max_duration' => 62, 'points' => 9],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 63, 'max_duration' => 99, 'points' => 10],


            // Age 13 and gender female
            ['age' => 13, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 16, 'points' => 0],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 16, 'max_duration' => 20, 'points' => 1],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 21, 'max_duration' => 25, 'points' => 2],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 26, 'max_duration' => 30, 'points' => 3],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 31, 'max_duration' => 35, 'points' => 4],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 36, 'max_duration' => 40, 'points' => 5],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 41, 'max_duration' => 45, 'points' => 6],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 46, 'max_duration' => 50, 'points' => 7],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 51, 'max_duration' => 55, 'points' => 8],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 56, 'max_duration' => 60, 'points' => 9],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 61, 'max_duration' => 99, 'points' => 10],


            // Age 12 and gender female
            ['age' => 12, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 14, 'points' => 0],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 14, 'max_duration' => 18, 'points' => 1],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 19, 'max_duration' => 23, 'points' => 2],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 24, 'max_duration' => 28, 'points' => 3],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 29, 'max_duration' => 33, 'points' => 4],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 34, 'max_duration' => 38, 'points' => 5],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 39, 'max_duration' => 43, 'points' => 6],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 44, 'max_duration' => 48, 'points' => 7],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 49, 'max_duration' => 53, 'points' => 8],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 54, 'max_duration' => 58, 'points' => 9],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 59, 'max_duration' => 99, 'points' => 10],


            // Age 11 and gender female
            ['age' => 11, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 12, 'points' => 0],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 12, 'max_duration' => 16, 'points' => 1],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 17, 'max_duration' => 21, 'points' => 2],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 22, 'max_duration' => 26, 'points' => 3],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 27, 'max_duration' => 31, 'points' => 4],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 32, 'max_duration' => 36, 'points' => 5],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 37, 'max_duration' => 41, 'points' => 6],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 42, 'max_duration' => 46, 'points' => 7],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 47, 'max_duration' => 51, 'points' => 8],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 52, 'max_duration' => 56, 'points' => 9],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 57, 'max_duration' => 99, 'points' => 10],


            // Age 10 and gender female
            ['age' => 10, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 10, 'points' => 0],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 10, 'max_duration' => 14, 'points' => 1],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 15, 'max_duration' => 19, 'points' => 2],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 20, 'max_duration' => 24, 'points' => 3],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 25, 'max_duration' => 29, 'points' => 4],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 30, 'max_duration' => 34, 'points' => 5],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 35, 'max_duration' => 39, 'points' => 6],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 40, 'max_duration' => 44, 'points' => 7],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 45, 'max_duration' => 49, 'points' => 8],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 50, 'max_duration' => 54, 'points' => 9],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 55, 'max_duration' => 99, 'points' => 10],


            // Age 9 and gender female
            ['age' => 9, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 8, 'points' => 0],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 8, 'max_duration' => 12, 'points' => 1],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 13, 'max_duration' => 17, 'points' => 2],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 18, 'max_duration' => 22, 'points' => 3],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 23, 'max_duration' => 27, 'points' => 4],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 28, 'max_duration' => 32, 'points' => 5],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 33, 'max_duration' => 37, 'points' => 6],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 38, 'max_duration' => 42, 'points' => 7],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 43, 'max_duration' => 47, 'points' => 8],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 48, 'max_duration' => 52, 'points' => 9],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 53, 'max_duration' => 99, 'points' => 10],


            // Age 8 and gender female
            ['age' => 8, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 6, 'points' => 0],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 6, 'max_duration' => 10, 'points' => 1],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 11, 'max_duration' => 15, 'points' => 2],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 16, 'max_duration' => 20, 'points' => 3],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 21, 'max_duration' => 25, 'points' => 4],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 26, 'max_duration' => 30, 'points' => 5],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 31, 'max_duration' => 35, 'points' => 6],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 36, 'max_duration' => 40, 'points' => 7],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 41, 'max_duration' => 45, 'points' => 8],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 46, 'max_duration' => 50, 'points' => 9],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 51, 'max_duration' => 99, 'points' => 10],


            // Age 7 and gender female
            ['age' => 7, 'gender' => 'female', 'min_duration' => 0,  'max_duration' => 4, 'points' => 0],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 4, 'max_duration' => 8, 'points' => 1],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 9, 'max_duration' => 13, 'points' => 2],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 14, 'max_duration' => 18, 'points' => 3],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 19, 'max_duration' => 23, 'points' => 4],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 24, 'max_duration' => 28, 'points' => 5],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 29, 'max_duration' => 33, 'points' => 6],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 34, 'max_duration' => 38, 'points' => 7],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 39, 'max_duration' => 43, 'points' => 8],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 44, 'max_duration' => 48, 'points' => 9],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 49, 'max_duration' => 99, 'points' => 10],
        ];

        foreach ($rules as $rule) {
            BalanceTestRule::create($rule);
        }
    }
}
