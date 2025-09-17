<?php

namespace Database\Seeders;

use App\Models\SpeedTestRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpeedRuleSeeder extends Seeder
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

            // Age 18 and gender male
            ['age' => 18, 'gender' => 'male', 'min_duration' => 4.93, 'max_duration' => 99,   'points' => 0],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 4.81, 'max_duration' => 4.92, 'points' => 1],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 4.69, 'max_duration' => 4.80, 'points' => 2],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 4.57, 'max_duration' => 4.68, 'points' => 3],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 4.45, 'max_duration' => 4.56, 'points' => 4],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 4.33, 'max_duration' => 4.44, 'points' => 5],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 4.21, 'max_duration' => 4.32, 'points' => 6],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 4.09, 'max_duration' => 4.20, 'points' => 7],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 3.97, 'max_duration' => 4.08, 'points' => 8],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 3.85, 'max_duration' => 3.96, 'points' => 9],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 0,    'max_duration' => 3.84, 'points' => 10],


            // Age 17 and gender male
            ['age' => 17, 'gender' => 'male', 'min_duration' => 4.98, 'max_duration' => 99,   'points' => 0],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 4.86, 'max_duration' => 4.97, 'points' => 1],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 4.74, 'max_duration' => 4.85, 'points' => 2],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 4.62, 'max_duration' => 4.73, 'points' => 3],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 4.50, 'max_duration' => 4.61, 'points' => 4],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 4.38, 'max_duration' => 4.49, 'points' => 5],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 4.26, 'max_duration' => 4.37, 'points' => 6],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 4.14, 'max_duration' => 4.25, 'points' => 7],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 4.02, 'max_duration' => 4.13, 'points' => 8],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 3.90, 'max_duration' => 4.01, 'points' => 9],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 0,    'max_duration' => 3.89, 'points' => 10],


            // Age 16 and gender male
            ['age' => 16, 'gender' => 'male', 'min_duration' => 5.03, 'max_duration' => 99,   'points' => 0],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 4.91, 'max_duration' => 5.02, 'points' => 1],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 4.79, 'max_duration' => 4.90, 'points' => 2],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 4.67, 'max_duration' => 4.78, 'points' => 3],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 4.55, 'max_duration' => 4.66, 'points' => 4],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 4.43, 'max_duration' => 4.54, 'points' => 5],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 4.31, 'max_duration' => 4.42, 'points' => 6],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 4.19, 'max_duration' => 4.30, 'points' => 7],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 4.07, 'max_duration' => 4.18, 'points' => 8],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 3.95, 'max_duration' => 4.06, 'points' => 9],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 0,    'max_duration' => 3.94, 'points' => 10],


            // Age 15 and gender male
            ['age' => 15, 'gender' => 'male', 'min_duration' => 5.08, 'max_duration' => 99,   'points' => 0],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 4.96, 'max_duration' => 5.07, 'points' => 1],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 4.84, 'max_duration' => 4.95, 'points' => 2],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 4.72, 'max_duration' => 4.83, 'points' => 3],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 4.60, 'max_duration' => 4.71, 'points' => 4],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 4.48, 'max_duration' => 4.59, 'points' => 5],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 4.36, 'max_duration' => 4.47, 'points' => 6],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 4.24, 'max_duration' => 4.35, 'points' => 7],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 4.12, 'max_duration' => 4.23, 'points' => 8],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 4.00, 'max_duration' => 4.11, 'points' => 9],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 0,    'max_duration' => 3.99, 'points' => 10],


            // Age 14 and gender male
            ['age' => 14, 'gender' => 'male', 'min_duration' => 5.13, 'max_duration' => 99,   'points' => 0],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 5.01, 'max_duration' => 5.12, 'points' => 1],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 4.89, 'max_duration' => 5.00, 'points' => 2],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 4.77, 'max_duration' => 4.88, 'points' => 3],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 4.65, 'max_duration' => 4.76, 'points' => 4],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 4.53, 'max_duration' => 4.64, 'points' => 5],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 4.41, 'max_duration' => 4.52, 'points' => 6],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 4.29, 'max_duration' => 4.40, 'points' => 7],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 4.17, 'max_duration' => 4.28, 'points' => 8],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 4.05, 'max_duration' => 4.16, 'points' => 9],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 0,    'max_duration' => 4.04, 'points' => 10],


            // Age 13 and gender male
            ['age' => 13, 'gender' => 'male', 'min_duration' => 5.18, 'max_duration' => 99,   'points' => 0],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 5.06, 'max_duration' => 5.17, 'points' => 1],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 4.94, 'max_duration' => 5.05, 'points' => 2],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 4.82, 'max_duration' => 4.93, 'points' => 3],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 4.70, 'max_duration' => 4.81, 'points' => 4],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 4.58, 'max_duration' => 4.69, 'points' => 5],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 4.46, 'max_duration' => 4.57, 'points' => 6],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 4.34, 'max_duration' => 4.45, 'points' => 7],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 4.22, 'max_duration' => 4.33, 'points' => 8],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 4.10, 'max_duration' => 4.21, 'points' => 9],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 0,    'max_duration' => 4.09, 'points' => 10],


            // Age 12 and gender male
            ['age' => 12, 'gender' => 'male', 'min_duration' => 5.23, 'max_duration' => 99,   'points' => 0],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 5.11, 'max_duration' => 5.22, 'points' => 1],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 4.99, 'max_duration' => 5.10, 'points' => 2],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 4.87, 'max_duration' => 4.98, 'points' => 3],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 4.75, 'max_duration' => 4.86, 'points' => 4],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 4.63, 'max_duration' => 4.74, 'points' => 5],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 4.51, 'max_duration' => 4.62, 'points' => 6],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 4.39, 'max_duration' => 4.50, 'points' => 7],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 4.27, 'max_duration' => 4.38, 'points' => 8],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 4.15, 'max_duration' => 4.26, 'points' => 9],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 0,    'max_duration' => 4.14, 'points' => 10],


            // Age 11 and gender male
            ['age' => 11, 'gender' => 'male', 'min_duration' => 5.28, 'max_duration' => 99,   'points' => 0],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 5.16, 'max_duration' => 5.27, 'points' => 1],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 5.04, 'max_duration' => 5.15, 'points' => 2],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 4.92, 'max_duration' => 5.03, 'points' => 3],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 4.80, 'max_duration' => 4.91, 'points' => 4],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 4.68, 'max_duration' => 4.79, 'points' => 5],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 4.56, 'max_duration' => 4.67, 'points' => 6],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 4.44, 'max_duration' => 4.55, 'points' => 7],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 4.32, 'max_duration' => 4.43, 'points' => 8],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 4.20, 'max_duration' => 4.31, 'points' => 9],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 0,    'max_duration' => 4.19, 'points' => 10],


            // Age 10 and gender male
            ['age' => 10, 'gender' => 'male', 'min_duration' => 5.33, 'max_duration' => 99,   'points' => 0],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 5.21, 'max_duration' => 5.32, 'points' => 1],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 5.09, 'max_duration' => 5.20, 'points' => 2],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 4.97, 'max_duration' => 5.08, 'points' => 3],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 4.85, 'max_duration' => 4.96, 'points' => 4],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 4.73, 'max_duration' => 4.84, 'points' => 5],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 4.61, 'max_duration' => 4.72, 'points' => 6],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 4.49, 'max_duration' => 4.60, 'points' => 7],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 4.37, 'max_duration' => 4.48, 'points' => 8],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 4.25, 'max_duration' => 4.36, 'points' => 9],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 0,    'max_duration' => 4.24, 'points' => 10],


            // Age 9 and gender male
            ['age' => 9, 'gender' => 'male', 'min_duration' => 5.38, 'max_duration' => 99,   'points' => 0],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 5.26, 'max_duration' => 5.37, 'points' => 1],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 5.14, 'max_duration' => 5.25, 'points' => 2],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 5.02, 'max_duration' => 5.13, 'points' => 3],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 4.90, 'max_duration' => 5.01, 'points' => 4],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 4.78, 'max_duration' => 4.89, 'points' => 5],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 4.66, 'max_duration' => 4.77, 'points' => 6],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 4.54, 'max_duration' => 4.65, 'points' => 7],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 4.42, 'max_duration' => 4.53, 'points' => 8],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 4.30, 'max_duration' => 4.41, 'points' => 9],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 0,    'max_duration' => 4.29, 'points' => 10],


            // Age 8 and gender male
            ['age' => 8, 'gender' => 'male', 'min_duration' => 5.43, 'max_duration' => 99,   'points' => 0],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 5.31, 'max_duration' => 5.42, 'points' => 1],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 5.19, 'max_duration' => 5.30, 'points' => 2],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 5.07, 'max_duration' => 5.18, 'points' => 3],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 4.95, 'max_duration' => 5.06, 'points' => 4],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 4.83, 'max_duration' => 4.94, 'points' => 5],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 4.71, 'max_duration' => 4.82, 'points' => 6],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 4.59, 'max_duration' => 4.70, 'points' => 7],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 4.47, 'max_duration' => 4.58, 'points' => 8],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 4.35, 'max_duration' => 4.46, 'points' => 9],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 0,    'max_duration' => 4.34, 'points' => 10],


            // Age 7 and gender male
            ['age' => 7, 'gender' => 'male', 'min_duration' => 5.48, 'max_duration' => 99,   'points' => 0],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 5.36, 'max_duration' => 5.47, 'points' => 1],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 5.24, 'max_duration' => 5.35, 'points' => 2],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 5.12, 'max_duration' => 5.23, 'points' => 3],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 5.00, 'max_duration' => 5.11, 'points' => 4],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 4.88, 'max_duration' => 4.99, 'points' => 5],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 4.76, 'max_duration' => 4.87, 'points' => 6],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 4.64, 'max_duration' => 4.75, 'points' => 7],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 4.52, 'max_duration' => 4.63, 'points' => 8],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 4.40, 'max_duration' => 4.51, 'points' => 9],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 0,    'max_duration' => 4.39, 'points' => 10],


            /**
             * Seeder data for female gender
             */

            // Age 18 and gender female
            ['age' => 18, 'gender' => 'female', 'min_duration' => 5.38, 'max_duration' => 99,   'points' => 0],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 5.26, 'max_duration' => 5.37, 'points' => 1],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 5.14, 'max_duration' => 5.25, 'points' => 2],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 5.02, 'max_duration' => 5.13, 'points' => 3],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 4.90, 'max_duration' => 5.01, 'points' => 4],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 4.78, 'max_duration' => 4.89, 'points' => 5],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 4.66, 'max_duration' => 4.77, 'points' => 6],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 4.54, 'max_duration' => 4.65, 'points' => 7],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 4.42, 'max_duration' => 4.53, 'points' => 8],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 4.30, 'max_duration' => 4.41, 'points' => 9],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 4.29, 'points' => 10],


            // Age 17 and gender female
            ['age' => 17, 'gender' => 'female', 'min_duration' => 5.43, 'max_duration' => 99,   'points' => 0],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 5.31, 'max_duration' => 5.42, 'points' => 1],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 5.19, 'max_duration' => 5.30, 'points' => 2],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 5.07, 'max_duration' => 5.18, 'points' => 3],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 4.95, 'max_duration' => 5.06, 'points' => 4],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 4.83, 'max_duration' => 4.94, 'points' => 5],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 4.71, 'max_duration' => 4.82, 'points' => 6],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 4.59, 'max_duration' => 4.70, 'points' => 7],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 4.47, 'max_duration' => 4.58, 'points' => 8],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 4.35, 'max_duration' => 4.46, 'points' => 9],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 4.34, 'points' => 10],


            // Age 16 and gender female
            ['age' => 16, 'gender' => 'female', 'min_duration' => 5.48, 'max_duration' => 99,   'points' => 0],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 5.36, 'max_duration' => 5.47, 'points' => 1],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 5.24, 'max_duration' => 5.35, 'points' => 2],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 5.12, 'max_duration' => 5.23, 'points' => 3],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 5.00, 'max_duration' => 5.11, 'points' => 4],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 4.88, 'max_duration' => 4.99, 'points' => 5],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 4.76, 'max_duration' => 4.87, 'points' => 6],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 4.64, 'max_duration' => 4.75, 'points' => 7],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 4.52, 'max_duration' => 4.63, 'points' => 8],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 4.40, 'max_duration' => 4.51, 'points' => 9],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 4.39, 'points' => 10],


            // Age 15 and gender female
            ['age' => 15, 'gender' => 'female', 'min_duration' => 5.53, 'max_duration' => 99,   'points' => 0],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 5.41, 'max_duration' => 5.52, 'points' => 1],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 5.29, 'max_duration' => 5.40, 'points' => 2],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 5.17, 'max_duration' => 5.28, 'points' => 3],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 5.05, 'max_duration' => 5.16, 'points' => 4],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 4.93, 'max_duration' => 5.04, 'points' => 5],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 4.81, 'max_duration' => 4.92, 'points' => 6],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 4.69, 'max_duration' => 4.80, 'points' => 7],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 4.57, 'max_duration' => 4.68, 'points' => 8],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 4.45, 'max_duration' => 4.56, 'points' => 9],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 4.44, 'points' => 10],


            // Age 14 and gender female
            ['age' => 14, 'gender' => 'female', 'min_duration' => 5.58, 'max_duration' => 99,   'points' => 0],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 5.46, 'max_duration' => 5.57, 'points' => 1],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 5.34, 'max_duration' => 5.45, 'points' => 2],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 5.22, 'max_duration' => 5.33, 'points' => 3],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 5.10, 'max_duration' => 5.21, 'points' => 4],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 4.98, 'max_duration' => 5.09, 'points' => 5],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 4.86, 'max_duration' => 4.97, 'points' => 6],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 4.74, 'max_duration' => 4.85, 'points' => 7],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 4.62, 'max_duration' => 4.73, 'points' => 8],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 4.50, 'max_duration' => 4.61, 'points' => 9],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 4.49, 'points' => 10],


            // Age 13 and gender female
            ['age' => 13, 'gender' => 'female', 'min_duration' => 5.63, 'max_duration' => 99,   'points' => 0],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 5.51, 'max_duration' => 5.62, 'points' => 1],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 5.39, 'max_duration' => 5.50, 'points' => 2],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 5.27, 'max_duration' => 5.38, 'points' => 3],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 5.15, 'max_duration' => 5.26, 'points' => 4],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 5.03, 'max_duration' => 5.14, 'points' => 5],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 4.91, 'max_duration' => 5.02, 'points' => 6],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 4.79, 'max_duration' => 4.90, 'points' => 7],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 4.67, 'max_duration' => 4.78, 'points' => 8],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 4.55, 'max_duration' => 4.66, 'points' => 9],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 4.54, 'points' => 10],


            // Age 12 and gender female
            ['age' => 12, 'gender' => 'female', 'min_duration' => 5.68, 'max_duration' => 99,   'points' => 0],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 5.56, 'max_duration' => 5.67, 'points' => 1],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 5.44, 'max_duration' => 5.55, 'points' => 2],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 5.32, 'max_duration' => 5.43, 'points' => 3],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 5.20, 'max_duration' => 5.31, 'points' => 4],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 5.08, 'max_duration' => 5.19, 'points' => 5],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 4.96, 'max_duration' => 5.07, 'points' => 6],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 4.84, 'max_duration' => 4.95, 'points' => 7],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 4.72, 'max_duration' => 4.83, 'points' => 8],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 4.60, 'max_duration' => 4.71, 'points' => 9],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 4.59, 'points' => 10],


            // Age 11 and gender female
            ['age' => 11, 'gender' => 'female', 'min_duration' => 5.73, 'max_duration' => 99,   'points' => 0],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 5.61, 'max_duration' => 5.72, 'points' => 1],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 5.49, 'max_duration' => 5.60, 'points' => 2],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 5.37, 'max_duration' => 5.48, 'points' => 3],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 5.25, 'max_duration' => 5.36, 'points' => 4],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 5.13, 'max_duration' => 5.24, 'points' => 5],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 5.01, 'max_duration' => 5.12, 'points' => 6],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 4.89, 'max_duration' => 5.00, 'points' => 7],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 4.77, 'max_duration' => 4.88, 'points' => 8],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 4.65, 'max_duration' => 4.76, 'points' => 9],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 4.64, 'points' => 10],


            // Age 10 and gender female
            ['age' => 10, 'gender' => 'female', 'min_duration' => 5.78, 'max_duration' => 99,   'points' => 0],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 5.66, 'max_duration' => 5.77, 'points' => 1],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 5.54, 'max_duration' => 5.65, 'points' => 2],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 5.42, 'max_duration' => 5.53, 'points' => 3],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 5.30, 'max_duration' => 5.41, 'points' => 4],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 5.18, 'max_duration' => 5.29, 'points' => 5],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 5.06, 'max_duration' => 5.17, 'points' => 6],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 4.94, 'max_duration' => 5.05, 'points' => 7],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 4.82, 'max_duration' => 4.93, 'points' => 8],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 4.70, 'max_duration' => 4.81, 'points' => 9],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 4.69, 'points' => 10],


            // Age 9 and gender female
            ['age' => 9, 'gender' => 'female', 'min_duration' => 5.83, 'max_duration' => 99,   'points' => 0],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 5.71, 'max_duration' => 5.82, 'points' => 1],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 5.59, 'max_duration' => 5.70, 'points' => 2],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 5.47, 'max_duration' => 5.58, 'points' => 3],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 5.35, 'max_duration' => 5.46, 'points' => 4],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 5.23, 'max_duration' => 5.34, 'points' => 5],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 5.11, 'max_duration' => 5.22, 'points' => 6],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 4.99, 'max_duration' => 5.10, 'points' => 7],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 4.87, 'max_duration' => 4.98, 'points' => 8],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 4.75, 'max_duration' => 4.86, 'points' => 9],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 4.74, 'points' => 10],


            // Age 8 and gender female
            ['age' => 8, 'gender' => 'female', 'min_duration' => 5.89, 'max_duration' => 99,   'points' => 0],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 5.77, 'max_duration' => 5.87, 'points' => 1],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 5.64, 'max_duration' => 5.75, 'points' => 2],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 5.52, 'max_duration' => 5.63, 'points' => 3],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 5.40, 'max_duration' => 5.51, 'points' => 4],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 5.28, 'max_duration' => 5.39, 'points' => 5],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 5.16, 'max_duration' => 5.27, 'points' => 6],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 5.04, 'max_duration' => 5.15, 'points' => 7],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 4.92, 'max_duration' => 5.03, 'points' => 8],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 4.80, 'max_duration' => 4.91, 'points' => 9],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 4.79, 'points' => 10],


            // Age 7 and gender female
            ['age' => 7, 'gender' => 'female', 'min_duration' => 5.93, 'max_duration' => 99,   'points' => 0],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 5.81, 'max_duration' => 5.92, 'points' => 1],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 5.69, 'max_duration' => 5.80, 'points' => 2],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 5.57, 'max_duration' => 5.68, 'points' => 3],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 5.45, 'max_duration' => 5.56, 'points' => 4],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 5.33, 'max_duration' => 5.44, 'points' => 5],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 5.21, 'max_duration' => 5.32, 'points' => 6],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 5.09, 'max_duration' => 5.20, 'points' => 7],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 4.97, 'max_duration' => 5.08, 'points' => 8],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 4.85, 'max_duration' => 4.96, 'points' => 9],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 0,    'max_duration' => 4.84, 'points' => 10],
        ];

        foreach ($rules as $rule){
            SpeedTestRule::create($rule);
        }
    }
}
