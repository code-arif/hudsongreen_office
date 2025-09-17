<?php

namespace Database\Seeders;

use App\Models\StrengthTestRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StrengthRuleSeeder extends Seeder
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
            ['age' => 18, 'gender' => 'male', 'min_count' => 0,     'max_count' => 32.69, 'points' => 0],
            ['age' => 18, 'gender' => 'male', 'min_count' => 32.70, 'max_count' => 36.34, 'points' => 1],
            ['age' => 18, 'gender' => 'male', 'min_count' => 36.35, 'max_count' => 39.04, 'points' => 2],
            ['age' => 18, 'gender' => 'male', 'min_count' => 39.05, 'max_count' => 41.38, 'points' => 3],
            ['age' => 18, 'gender' => 'male', 'min_count' => 41.39, 'max_count' => 43.62, 'points' => 4],
            ['age' => 18, 'gender' => 'male', 'min_count' => 43.63, 'max_count' => 45.88, 'points' => 5],
            ['age' => 18, 'gender' => 'male', 'min_count' => 45.89, 'max_count' => 48.34, 'points' => 6],
            ['age' => 18, 'gender' => 'male', 'min_count' => 48.35, 'max_count' => 51.27, 'points' => 7],
            ['age' => 18, 'gender' => 'male', 'min_count' => 51.28, 'max_count' => 55.41, 'points' => 8],
            ['age' => 18, 'gender' => 'male', 'min_count' => 55.42, 'max_count' => 58.90, 'points' => 9],
            ['age' => 18, 'gender' => 'male', 'min_count' => 58.91, 'max_count' => 99,    'points' => 10],

            // Age 17 and gender male
            ['age' => 17, 'gender' => 'male', 'min_count' => 0,     'max_count' => 30.12, 'points' => 0],
            ['age' => 17, 'gender' => 'male', 'min_count' => 30.13, 'max_count' => 33.76, 'points' => 1],
            ['age' => 17, 'gender' => 'male', 'min_count' => 33.77, 'max_count' => 36.46, 'points' => 2],
            ['age' => 17, 'gender' => 'male', 'min_count' => 36.47, 'max_count' => 38.82, 'points' => 3],
            ['age' => 17, 'gender' => 'male', 'min_count' => 38.83, 'max_count' => 41.06, 'points' => 4],
            ['age' => 17, 'gender' => 'male', 'min_count' => 41.07, 'max_count' => 43.34, 'points' => 5],
            ['age' => 17, 'gender' => 'male', 'min_count' => 43.35, 'max_count' => 45.82, 'points' => 6],
            ['age' => 17, 'gender' => 'male', 'min_count' => 45.83, 'max_count' => 48.76, 'points' => 7],
            ['age' => 17, 'gender' => 'male', 'min_count' => 48.77, 'max_count' => 52.94, 'points' => 8],
            ['age' => 17, 'gender' => 'male', 'min_count' => 52.95, 'max_count' => 56.47, 'points' => 9],
            ['age' => 17, 'gender' => 'male', 'min_count' => 56.48, 'max_count' => 99,    'points' => 10],

            // Age 16 and gender male
            ['age' => 16, 'gender' => 'male', 'min_count' => 0,     'max_count' => 27.51, 'points' => 0],
            ['age' => 16, 'gender' => 'male', 'min_count' => 27.52, 'max_count' => 31.11, 'points' => 1],
            ['age' => 16, 'gender' => 'male', 'min_count' => 31.12, 'max_count' => 33.78, 'points' => 2],
            ['age' => 16, 'gender' => 'male', 'min_count' => 33.79, 'max_count' => 36.11, 'points' => 3],
            ['age' => 16, 'gender' => 'male', 'min_count' => 36.12, 'max_count' => 38.33, 'points' => 4],
            ['age' => 16, 'gender' => 'male', 'min_count' => 38.34, 'max_count' => 40.59, 'points' => 5],
            ['age' => 16, 'gender' => 'male', 'min_count' => 40.60, 'max_count' => 43.05, 'points' => 6],
            ['age' => 16, 'gender' => 'male', 'min_count' => 43.06, 'max_count' => 45.98, 'points' => 7],
            ['age' => 16, 'gender' => 'male', 'min_count' => 45.99, 'max_count' => 50.13, 'points' => 8],
            ['age' => 16, 'gender' => 'male', 'min_count' => 50.14, 'max_count' => 53.64, 'points' => 9],
            ['age' => 16, 'gender' => 'male', 'min_count' => 53.65, 'max_count' => 99,    'points' => 10],

            // Age 15 and gender male
            ['age' => 15, 'gender' => 'male', 'min_count' => 0,     'max_count' => 24.79, 'points' => 0],
            ['age' => 15, 'gender' => 'male', 'min_count' => 24.80, 'max_count' => 28.26, 'points' => 1],
            ['age' => 15, 'gender' => 'male', 'min_count' => 28.27, 'max_count' => 30.84, 'points' => 2],
            ['age' => 15, 'gender' => 'male', 'min_count' => 30.85, 'max_count' => 33.09, 'points' => 3],
            ['age' => 15, 'gender' => 'male', 'min_count' => 33.10, 'max_count' => 35.24, 'points' => 4],
            ['age' => 15, 'gender' => 'male', 'min_count' => 35.25, 'max_count' => 37.43, 'points' => 5],
            ['age' => 15, 'gender' => 'male', 'min_count' => 37.44, 'max_count' => 39.81, 'points' => 6],
            ['age' => 15, 'gender' => 'male', 'min_count' => 39.82, 'max_count' => 42.65, 'points' => 7],
            ['age' => 15, 'gender' => 'male', 'min_count' => 42.66, 'max_count' => 46.69, 'points' => 8],
            ['age' => 15, 'gender' => 'male', 'min_count' => 46.70, 'max_count' => 50.10, 'points' => 9],
            ['age' => 15, 'gender' => 'male', 'min_count' => 50.11, 'max_count' => 99,    'points' => 10],

            // Age 14 and gender male
            ['age' => 14, 'gender' => 'male', 'min_count' => 0,     'max_count' => 21.94, 'points' => 0],
            ['age' => 14, 'gender' => 'male', 'min_count' => 21.95, 'max_count' => 25.17, 'points' => 1],
            ['age' => 14, 'gender' => 'male', 'min_count' => 25.18, 'max_count' => 27.58, 'points' => 2],
            ['age' => 14, 'gender' => 'male', 'min_count' => 27.59, 'max_count' => 29.69, 'points' => 3],
            ['age' => 14, 'gender' => 'male', 'min_count' => 29.70, 'max_count' => 31.70, 'points' => 4],
            ['age' => 14, 'gender' => 'male', 'min_count' => 31.71, 'max_count' => 33.75, 'points' => 5],
            ['age' => 14, 'gender' => 'male', 'min_count' => 33.76, 'max_count' => 35.99, 'points' => 6],
            ['age' => 14, 'gender' => 'male', 'min_count' => 36.00, 'max_count' => 38.65, 'points' => 7],
            ['age' => 14, 'gender' => 'male', 'min_count' => 38.66, 'max_count' => 42.44, 'points' => 8],
            ['age' => 14, 'gender' => 'male', 'min_count' => 42.45, 'max_count' => 45.65, 'points' => 9],
            ['age' => 14, 'gender' => 'male', 'min_count' => 45.66, 'max_count' => 99,    'points' => 10],

            // Age 13 and gender male\
            ['age' => 13, 'gender' => 'male', 'min_count' => 0,     'max_count' => 19.04, 'points' => 0],
            ['age' => 13, 'gender' => 'male', 'min_count' => 19.05, 'max_count' => 21.95, 'points' => 1],
            ['age' => 13, 'gender' => 'male', 'min_count' => 21.96, 'max_count' => 24.11, 'points' => 2],
            ['age' => 13, 'gender' => 'male', 'min_count' => 24.12, 'max_count' => 26.01, 'points' => 3],
            ['age' => 13, 'gender' => 'male', 'min_count' => 26.02, 'max_count' => 27.82, 'points' => 4],
            ['age' => 13, 'gender' => 'male', 'min_count' => 27.83, 'max_count' => 29.67, 'points' => 5],
            ['age' => 13, 'gender' => 'male', 'min_count' => 29.68, 'max_count' => 31.69, 'points' => 6],
            ['age' => 13, 'gender' => 'male', 'min_count' => 31.70, 'max_count' => 34.09, 'points' => 7],
            ['age' => 13, 'gender' => 'male', 'min_count' => 34.10, 'max_count' => 37.52, 'points' => 8],
            ['age' => 13, 'gender' => 'male', 'min_count' => 37.53, 'max_count' => 40.41, 'points' => 9],
            ['age' => 13, 'gender' => 'male', 'min_count' => 40.42, 'max_count' => 99,    'points' => 10],

            // Age 12 and gender male
            ['age' => 12, 'gender' => 'male', 'min_count' => 0,     'max_count' => 16.24, 'points' => 0],
            ['age' => 12, 'gender' => 'male', 'min_count' => 16.25, 'max_count' => 18.76, 'points' => 1],
            ['age' => 12, 'gender' => 'male', 'min_count' => 18.77, 'max_count' => 20.64, 'points' => 2],
            ['age' => 12, 'gender' => 'male', 'min_count' => 20.65, 'max_count' => 22.30, 'points' => 3],
            ['age' => 12, 'gender' => 'male', 'min_count' => 22.31, 'max_count' => 23.87, 'points' => 4],
            ['age' => 12, 'gender' => 'male', 'min_count' => 23.88, 'max_count' => 25.48, 'points' => 5],
            ['age' => 12, 'gender' => 'male', 'min_count' => 25.49, 'max_count' => 27.24, 'points' => 6],
            ['age' => 12, 'gender' => 'male', 'min_count' => 27.25, 'max_count' => 29.33, 'points' => 7],
            ['age' => 12, 'gender' => 'male', 'min_count' => 29.34, 'max_count' => 32.31, 'points' => 8],
            ['age' => 12, 'gender' => 'male', 'min_count' => 32.32, 'max_count' => 34.83, 'points' => 9],
            ['age' => 12, 'gender' => 'male', 'min_count' => 34.84, 'max_count' => 99,    'points' => 10],

            // Age 11 and gender male
            ['age' => 11, 'gender' => 'male', 'min_count' => 0,     'max_count' => 13.72, 'points' => 0],
            ['age' => 11, 'gender' => 'male', 'min_count' => 13.73, 'max_count' => 15.87, 'points' => 1],
            ['age' => 11, 'gender' => 'male', 'min_count' => 15.88, 'max_count' => 17.47, 'points' => 2],
            ['age' => 11, 'gender' => 'male', 'min_count' => 17.48, 'max_count' => 18.88, 'points' => 3],
            ['age' => 11, 'gender' => 'male', 'min_count' => 18.89, 'max_count' => 20.22, 'points' => 4],
            ['age' => 11, 'gender' => 'male', 'min_count' => 20.23, 'max_count' => 21.59, 'points' => 5],
            ['age' => 11, 'gender' => 'male', 'min_count' => 21.60, 'max_count' => 23.08, 'points' => 6],
            ['age' => 11, 'gender' => 'male', 'min_count' => 23.09, 'max_count' => 24.86, 'points' => 7],
            ['age' => 11, 'gender' => 'male', 'min_count' => 24.87, 'max_count' => 27.40, 'points' => 8],
            ['age' => 11, 'gender' => 'male', 'min_count' => 27.41, 'max_count' => 29.55, 'points' => 9],
            ['age' => 11, 'gender' => 'male', 'min_count' => 29.56, 'max_count' => 99,    'points' => 10],

            // Age 10 and gender male
            ['age' => 10, 'gender' => 'male', 'min_count' => 0,     'max_count' => 11.62, 'points' => 0],
            ['age' => 10, 'gender' => 'male', 'min_count' => 11.63, 'max_count' => 13.43, 'points' => 1],
            ['age' => 10, 'gender' => 'male', 'min_count' => 13.44, 'max_count' => 14.79, 'points' => 2],
            ['age' => 10, 'gender' => 'male', 'min_count' => 14.80, 'max_count' => 15.98, 'points' => 3],
            ['age' => 10, 'gender' => 'male', 'min_count' => 15.99, 'max_count' => 17.12, 'points' => 4],
            ['age' => 10, 'gender' => 'male', 'min_count' => 17.13, 'max_count' => 18.28, 'points' => 5],
            ['age' => 10, 'gender' => 'male', 'min_count' => 18.29, 'max_count' => 19.55, 'points' => 6],
            ['age' => 10, 'gender' => 'male', 'min_count' => 19.56, 'max_count' => 21.06, 'points' => 7],
            ['age' => 10, 'gender' => 'male', 'min_count' => 21.07, 'max_count' => 23.21, 'points' => 8],
            ['age' => 10, 'gender' => 'male', 'min_count' => 23.22, 'max_count' => 25.03, 'points' => 9],
            ['age' => 10, 'gender' => 'male', 'min_count' => 25.04, 'max_count' => 99,    'points' => 10],

            // Age 9 and gender male
            ['age' => 9, 'gender' => 'male', 'min_count' => 0,     'max_count' => 9.87, 'points' => 0],
            ['age' => 9, 'gender' => 'male', 'min_count' => 9.88,  'max_count' => 11.42, 'points' => 1],
            ['age' => 9, 'gender' => 'male', 'min_count' => 11.43, 'max_count' => 12.58, 'points' => 2],
            ['age' => 9, 'gender' => 'male', 'min_count' => 12.59, 'max_count' => 13.59, 'points' => 3],
            ['age' => 9, 'gender' => 'male', 'min_count' => 13.60, 'max_count' => 14.56, 'points' => 4],
            ['age' => 9, 'gender' => 'male', 'min_count' => 14.57, 'max_count' => 15.55, 'points' => 5],
            ['age' => 9, 'gender' => 'male', 'min_count' => 15.56, 'max_count' => 16.63, 'points' => 6],
            ['age' => 9, 'gender' => 'male', 'min_count' => 16.64, 'max_count' => 17.92, 'points' => 7],
            ['age' => 9, 'gender' => 'male', 'min_count' => 17.93, 'max_count' => 19.76, 'points' => 8],
            ['age' => 9, 'gender' => 'male', 'min_count' => 19.77, 'max_count' => 21.31, 'points' => 9],
            ['age' => 9, 'gender' => 'male', 'min_count' => 21.32, 'max_count' => 99,    'points' => 10],

            // Age 8 and gender male
            ['age' => 8, 'gender' => 'male', 'min_count' => 0,    'max_count' => 8.33, 'points' => 0],
            ['age' => 8, 'gender' => 'male', 'min_count' => 8.34, 'max_count' => 9.65, 'points' => 1],
            ['age' => 8, 'gender' => 'male', 'min_count' => 9.66, 'max_count' => 10.64, 'points' => 2],
            ['age' => 8, 'gender' => 'male', 'min_count' => 10.65, 'max_count' => 11.50, 'points' => 3],
            ['age' => 8, 'gender' => 'male', 'min_count' => 11.51, 'max_count' => 12.33, 'points' => 4],
            ['age' => 8, 'gender' => 'male', 'min_count' => 12.34, 'max_count' => 13.17, 'points' => 5],
            ['age' => 8, 'gender' => 'male', 'min_count' => 13.18, 'max_count' => 14.09, 'points' => 6],
            ['age' => 8, 'gender' => 'male', 'min_count' => 14.10, 'max_count' => 15.19, 'points' => 7],
            ['age' => 8, 'gender' => 'male', 'min_count' => 15.20, 'max_count' => 16.76, 'points' => 8],
            ['age' => 8, 'gender' => 'male', 'min_count' => 16.77, 'max_count' => 18.08, 'points' => 9],
            ['age' => 8, 'gender' => 'male', 'min_count' => 18.09, 'max_count' => 99,    'points' => 10],

            // Age 7 and gender male
            ['age' => 7, 'gender' => 'male', 'min_count' => 0,    'max_count' => 6.85, 'points' => 0],
            ['age' => 7, 'gender' => 'male', 'min_count' => 6.86, 'max_count' => 7.96, 'points' => 1],
            ['age' => 7, 'gender' => 'male', 'min_count' => 7.97, 'max_count' => 8.78, 'points' => 2],
            ['age' => 7, 'gender' => 'male', 'min_count' => 8.79, 'max_count' => 9.50, 'points' => 3],
            ['age' => 7, 'gender' => 'male', 'min_count' => 9.51, 'max_count' => 10.19, 'points' => 4],
            ['age' => 7, 'gender' => 'male', 'min_count' => 10.20, 'max_count' => 10.89, 'points' => 5],
            ['age' => 7, 'gender' => 'male', 'min_count' => 10.90, 'max_count' => 11.66, 'points' => 6],
            ['age' => 7, 'gender' => 'male', 'min_count' => 11.67, 'max_count' => 12.58, 'points' => 7],
            ['age' => 7, 'gender' => 'male', 'min_count' => 12.59, 'max_count' => 13.89, 'points' => 8],
            ['age' => 7, 'gender' => 'male', 'min_count' => 13.90, 'max_count' => 14.99, 'points' => 9],
            ['age' => 7, 'gender' => 'male', 'min_count' => 15.00, 'max_count' => 99,    'points' => 10],

            // Age 15 and gender female
            ['age' => 18, 'gender' => 'female', 'min_count' => 0,     'max_count' => 20.82, 'points' => 0],
            ['age' => 18, 'gender' => 'female', 'min_count' => 20.83, 'max_count' => 23.21, 'points' => 1],
            ['age' => 18, 'gender' => 'female', 'min_count' => 23.22, 'max_count' => 24.98, 'points' => 2],
            ['age' => 18, 'gender' => 'female', 'min_count' => 24.99, 'max_count' => 26.54, 'points' => 3],
            ['age' => 18, 'gender' => 'female', 'min_count' => 26.55, 'max_count' => 28.02, 'points' => 4],
            ['age' => 18, 'gender' => 'female', 'min_count' => 28.03, 'max_count' => 29.54, 'points' => 5],
            ['age' => 18, 'gender' => 'female', 'min_count' => 29.55, 'max_count' => 31.19, 'points' => 6],
            ['age' => 18, 'gender' => 'female', 'min_count' => 31.20, 'max_count' => 33.16, 'points' => 7],
            ['age' => 18, 'gender' => 'female', 'min_count' => 33.17, 'max_count' => 35.97, 'points' => 8],
            ['age' => 18, 'gender' => 'female', 'min_count' => 35.98, 'max_count' => 38.35, 'points' => 9],
            ['age' => 18, 'gender' => 'female', 'min_count' => 38.36, 'max_count' => 99,    'points' => 10],

            // Age 17 and gender female
            ['age' => 17, 'gender' => 'female', 'min_count' => 0,     'max_count' => 19.85, 'points' => 0],
            ['age' => 17, 'gender' => 'female', 'min_count' => 19.86, 'max_count' => 22.19, 'points' => 1],
            ['age' => 17, 'gender' => 'female', 'min_count' => 22.20, 'max_count' => 23.93, 'points' => 2],
            ['age' => 17, 'gender' => 'female', 'min_count' => 23.94, 'max_count' => 25.46, 'points' => 3],
            ['age' => 17, 'gender' => 'female', 'min_count' => 25.47, 'max_count' => 26.92, 'points' => 4],
            ['age' => 17, 'gender' => 'female', 'min_count' => 26.93, 'max_count' => 28.40, 'points' => 5],
            ['age' => 17, 'gender' => 'female', 'min_count' => 28.41, 'max_count' => 30.02, 'points' => 6],
            ['age' => 17, 'gender' => 'female', 'min_count' => 30.03, 'max_count' => 31.96, 'points' => 7],
            ['age' => 17, 'gender' => 'female', 'min_count' => 31.97, 'max_count' => 34.73, 'points' => 8],
            ['age' => 17, 'gender' => 'female', 'min_count' => 34.74, 'max_count' => 37.07, 'points' => 9],
            ['age' => 17, 'gender' => 'female', 'min_count' => 37.08, 'max_count' => 99,    'points' => 10],

            // Age 16 and gender female
            ['age' => 16, 'gender' => 'female', 'min_count' => 0,     'max_count' => 18.86, 'points' => 0],
            ['age' => 16, 'gender' => 'female', 'min_count' => 18.87, 'max_count' => 21.14, 'points' => 1],
            ['age' => 16, 'gender' => 'female', 'min_count' => 21.15, 'max_count' => 22.85, 'points' => 2],
            ['age' => 16, 'gender' => 'female', 'min_count' => 22.86, 'max_count' => 24.34, 'points' => 3],
            ['age' => 16, 'gender' => 'female', 'min_count' => 24.35, 'max_count' => 25.77, 'points' => 4],
            ['age' => 16, 'gender' => 'female', 'min_count' => 25.78, 'max_count' => 27.22, 'points' => 5],
            ['age' => 16, 'gender' => 'female', 'min_count' => 27.23, 'max_count' => 28.81, 'points' => 6],
            ['age' => 16, 'gender' => 'female', 'min_count' => 28.82, 'max_count' => 30.71, 'points' => 7],
            ['age' => 16, 'gender' => 'female', 'min_count' => 30.72, 'max_count' => 33.42, 'points' => 8],
            ['age' => 16, 'gender' => 'female', 'min_count' => 33.43, 'max_count' => 35.72, 'points' => 9],
            ['age' => 16, 'gender' => 'female', 'min_count' => 35.73, 'max_count' => 99,    'points' => 10],

            // Age 15 and gender female
            ['age' => 15, 'gender' => 'female', 'min_count' => 0,     'max_count' => 17.81, 'points' => 0],
            ['age' => 15, 'gender' => 'female', 'min_count' => 17.82, 'max_count' => 20.03, 'points' => 1],
            ['age' => 15, 'gender' => 'female', 'min_count' => 20.04, 'max_count' => 21.69, 'points' => 2],
            ['age' => 15, 'gender' => 'female', 'min_count' => 21.70, 'max_count' => 23.14, 'points' => 3],
            ['age' => 15, 'gender' => 'female', 'min_count' => 23.15, 'max_count' => 24.53, 'points' => 4],
            ['age' => 15, 'gender' => 'female', 'min_count' => 24.54, 'max_count' => 25.95, 'points' => 5],
            ['age' => 15, 'gender' => 'female', 'min_count' => 25.96, 'max_count' => 27.49, 'points' => 6],
            ['age' => 15, 'gender' => 'female', 'min_count' => 27.50, 'max_count' => 29.35, 'points' => 7],
            ['age' => 15, 'gender' => 'female', 'min_count' => 29.36, 'max_count' => 31.99, 'points' => 8],
            ['age' => 15, 'gender' => 'female', 'min_count' => 32.00, 'max_count' => 34.23, 'points' => 9],
            ['age' => 15, 'gender' => 'female', 'min_count' => 34.24, 'max_count' => 99,    'points' => 10],

            // Age 14 and gender female
            ['age' => 14, 'gender' => 'female', 'min_count' => 0,     'max_count' => 16.66, 'points' => 0],
            ['age' => 14, 'gender' => 'female', 'min_count' => 16.67, 'max_count' => 18.80, 'points' => 1],
            ['age' => 14, 'gender' => 'female', 'min_count' => 18.81, 'max_count' => 20.40, 'points' => 2],
            ['age' => 14, 'gender' => 'female', 'min_count' => 20.41, 'max_count' => 21.82, 'points' => 3],
            ['age' => 14, 'gender' => 'female', 'min_count' => 21.82, 'max_count' => 23.15, 'points' => 4],
            ['age' => 14, 'gender' => 'female', 'min_count' => 23.16, 'max_count' => 24.52, 'points' => 5],
            ['age' => 14, 'gender' => 'female', 'min_count' => 24.53, 'max_count' => 26.02, 'points' => 6],
            ['age' => 14, 'gender' => 'female', 'min_count' => 26.03, 'max_count' => 27.81, 'points' => 7],
            ['age' => 14, 'gender' => 'female', 'min_count' => 27.82, 'max_count' => 30.37, 'points' => 8],
            ['age' => 14, 'gender' => 'female', 'min_count' => 30.38, 'max_count' => 32.55, 'points' => 9],
            ['age' => 14, 'gender' => 'female', 'min_count' => 32.56, 'max_count' => 99,    'points' => 10],

            // Age 13 and gender female
            ['age' => 13, 'gender' => 'female', 'min_count' => 0,     'max_count' => 15.39, 'points' => 0],
            ['age' => 13, 'gender' => 'female', 'min_count' => 15.40, 'max_count' => 17.44, 'points' => 1],
            ['age' => 13, 'gender' => 'female', 'min_count' => 17.45, 'max_count' => 18.97, 'points' => 2],
            ['age' => 13, 'gender' => 'female', 'min_count' => 18.98, 'max_count' => 20.31, 'points' => 3],
            ['age' => 13, 'gender' => 'female', 'min_count' => 20.32, 'max_count' => 21.60, 'points' => 4],
            ['age' => 13, 'gender' => 'female', 'min_count' => 21.61, 'max_count' => 22.91, 'points' => 5],
            ['age' => 13, 'gender' => 'female', 'min_count' => 22.92, 'max_count' => 24.35, 'points' => 6],
            ['age' => 13, 'gender' => 'female', 'min_count' => 24.36, 'max_count' => 26.07, 'points' => 7],
            ['age' => 13, 'gender' => 'female', 'min_count' => 26.08, 'max_count' => 28.52, 'points' => 8],
            ['age' => 13, 'gender' => 'female', 'min_count' => 28.53, 'max_count' => 30.61, 'points' => 9],
            ['age' => 13, 'gender' => 'female', 'min_count' => 30.62, 'max_count' => 99,    'points' => 10],

            // Age 12 and gender female
            ['age' => 12, 'gender' => 'female', 'min_count' => 0,     'max_count' => 13.99, 'points' => 0],
            ['age' => 12, 'gender' => 'female', 'min_count' => 14.00, 'max_count' => 15.92, 'points' => 1],
            ['age' => 12, 'gender' => 'female', 'min_count' => 15.93, 'max_count' => 17.36, 'points' => 2],
            ['age' => 12, 'gender' => 'female', 'min_count' => 17.37, 'max_count' => 18.63, 'points' => 3],
            ['age' => 12, 'gender' => 'female', 'min_count' => 18.64, 'max_count' => 19.84, 'points' => 4],
            ['age' => 12, 'gender' => 'female', 'min_count' => 19.85, 'max_count' => 21.09, 'points' => 5],
            ['age' => 12, 'gender' => 'female', 'min_count' => 21.10, 'max_count' => 22.45, 'points' => 6],
            ['age' => 12, 'gender' => 'female', 'min_count' => 22.46, 'max_count' => 24.08, 'points' => 7],
            ['age' => 12, 'gender' => 'female', 'min_count' => 24.09, 'max_count' => 26.40, 'points' => 8],
            ['age' => 12, 'gender' => 'female', 'min_count' => 26.41, 'max_count' => 28.38, 'points' => 9],
            ['age' => 12, 'gender' => 'female', 'min_count' => 28.39, 'max_count' => 99,    'points' => 10],

            // Age 11 and gender female
            ['age' => 11, 'gender' => 'female', 'min_count' => 0,     'max_count' => 12.48, 'points' => 0],
            ['age' => 11, 'gender' => 'female', 'min_count' => 12.49, 'max_count' => 14.26, 'points' => 1],
            ['age' => 11, 'gender' => 'female', 'min_count' => 14.27, 'max_count' => 15.60, 'points' => 2],
            ['age' => 11, 'gender' => 'female', 'min_count' => 15.61, 'max_count' => 16.78, 'points' => 3],
            ['age' => 11, 'gender' => 'female', 'min_count' => 16.79, 'max_count' => 17.91, 'points' => 4],
            ['age' => 11, 'gender' => 'female', 'min_count' => 17.92, 'max_count' => 19.07, 'points' => 5],
            ['age' => 11, 'gender' => 'female', 'min_count' => 19.08, 'max_count' => 20.34, 'points' => 6],
            ['age' => 11, 'gender' => 'female', 'min_count' => 20.35, 'max_count' => 21.85, 'points' => 7],
            ['age' => 11, 'gender' => 'female', 'min_count' => 21.86, 'max_count' => 24.02, 'points' => 8],
            ['age' => 11, 'gender' => 'female', 'min_count' => 24.03, 'max_count' => 25.87, 'points' => 9],
            ['age' => 11, 'gender' => 'female', 'min_count' => 25.88, 'max_count' => 99,    'points' => 10],

            // Age 10 and gender female
            ['age' => 10, 'gender' => 'female', 'min_count' => 0,     'max_count' => 10.91, 'points' => 0],
            ['age' => 10, 'gender' => 'female', 'min_count' => 10.92, 'max_count' => 12.53, 'points' => 1],
            ['age' => 10, 'gender' => 'female', 'min_count' => 12.54, 'max_count' => 13.75, 'points' => 2],
            ['age' => 10, 'gender' => 'female', 'min_count' => 13.76, 'max_count' => 14.82, 'points' => 3],
            ['age' => 10, 'gender' => 'female', 'min_count' => 14.83, 'max_count' => 15.86, 'points' => 4],
            ['age' => 10, 'gender' => 'female', 'min_count' => 15.87, 'max_count' => 16.91, 'points' => 5],
            ['age' => 10, 'gender' => 'female', 'min_count' => 16.92, 'max_count' => 18.07, 'points' => 6],
            ['age' => 10, 'gender' => 'female', 'min_count' => 18.08, 'max_count' => 19.45, 'points' => 7],
            ['age' => 10, 'gender' => 'female', 'min_count' => 19.46, 'max_count' => 21.44, 'points' => 8],
            ['age' => 10, 'gender' => 'female', 'min_count' => 21.45, 'max_count' => 23.13, 'points' => 9],
            ['age' => 10, 'gender' => 'female', 'min_count' => 23.14, 'max_count' => 99,    'points' => 10],

            // Age 9 and gender female
            ['age' => 9, 'gender' => 'female', 'min_count' => 0,     'max_count' => 9.32, 'points' => 0],
            ['age' => 9, 'gender' => 'female', 'min_count' => 9.33,  'max_count' => 10.76, 'points' => 1],
            ['age' => 9, 'gender' => 'female', 'min_count' => 10.77, 'max_count' => 11.85, 'points' => 2],
            ['age' => 9, 'gender' => 'female', 'min_count' => 11.86, 'max_count' => 12.81, 'points' => 3],
            ['age' => 9, 'gender' => 'female', 'min_count' => 12.82, 'max_count' => 13.73, 'points' => 4],
            ['age' => 9, 'gender' => 'female', 'min_count' => 13.74, 'max_count' => 14.67, 'points' => 5],
            ['age' => 9, 'gender' => 'female', 'min_count' => 14.68, 'max_count' => 15.70, 'points' => 6],
            ['age' => 9, 'gender' => 'female', 'min_count' => 15.71, 'max_count' => 16.94, 'points' => 7],
            ['age' => 9, 'gender' => 'female', 'min_count' => 16.95, 'max_count' => 18.72, 'points' => 8],
            ['age' => 9, 'gender' => 'female', 'min_count' => 18.73, 'max_count' => 20.24, 'points' => 9],
            ['age' => 9, 'gender' => 'female', 'min_count' => 20.25, 'max_count' => 99,    'points' => 10],

            // Age 8 and gender female
            ['age' => 8, 'gender' => 'female', 'min_count' => 0,     'max_count' => 7.74, 'points' => 0],
            ['age' => 8, 'gender' => 'female', 'min_count' => 7.75,  'max_count' => 8.99, 'points' => 1],
            ['age' => 8, 'gender' => 'female', 'min_count' => 9.00,  'max_count' => 9.94, 'points' => 2],
            ['age' => 8, 'gender' => 'female', 'min_count' => 9.95,  'max_count' => 10.77, 'points' => 3],
            ['age' => 8, 'gender' => 'female', 'min_count' => 10.78, 'max_count' => 11.57, 'points' => 4],
            ['age' => 8, 'gender' => 'female', 'min_count' => 11.58, 'max_count' => 12.39, 'points' => 5],
            ['age' => 8, 'gender' => 'female', 'min_count' => 12.40, 'max_count' => 13.29, 'points' => 6],
            ['age' => 8, 'gender' => 'female', 'min_count' => 13.30, 'max_count' => 14.37, 'points' => 7],
            ['age' => 8, 'gender' => 'female', 'min_count' => 14.38, 'max_count' => 15.92, 'points' => 8],
            ['age' => 8, 'gender' => 'female', 'min_count' => 15.93, 'max_count' => 17.25, 'points' => 9],
            ['age' => 8, 'gender' => 'female', 'min_count' => 17.26, 'max_count' => 99,    'points' => 10],

            // Age 7 and gender female
            ['age' => 7, 'gender' => 'female', 'min_count' => 0,     'max_count' => 6.20, 'points' => 0],
            ['age' => 7, 'gender' => 'female', 'min_count' => 6.21,  'max_count' => 7.25, 'points' => 1],
            ['age' => 7, 'gender' => 'female', 'min_count' => 7.26,  'max_count' => 8.04, 'points' => 2],
            ['age' => 7, 'gender' => 'female', 'min_count' => 8.05,  'max_count' => 8.73, 'points' => 3],
            ['age' => 7, 'gender' => 'female', 'min_count' => 8.74,  'max_count' => 9.41, 'points' => 4],
            ['age' => 7, 'gender' => 'female', 'min_count' => 9.42,  'max_count' => 10.10, 'points' => 5],
            ['age' => 7, 'gender' => 'female', 'min_count' => 10.11, 'max_count' => 10.85, 'points' => 6],
            ['age' => 7, 'gender' => 'female', 'min_count' => 10.86, 'max_count' => 11.76, 'points' => 7],
            ['age' => 7, 'gender' => 'female', 'min_count' => 11.77, 'max_count' => 13.07, 'points' => 8],
            ['age' => 7, 'gender' => 'female', 'min_count' => 13.08, 'max_count' => 14.19, 'points' => 9],
            ['age' => 7, 'gender' => 'female', 'min_count' => 14.20, 'max_count' => 99,    'points' => 10],
        ];

        foreach ($rules as $rule) {
            StrengthTestRule::create($rule);
        }
    }
}
