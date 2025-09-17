<?php

namespace Database\Seeders;

use App\Models\StaminaTestRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaminaRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [
            /**
             * Seeder dara for male gender
             */

            // Age 18 and gender male
            ['age' => 18, 'gender' => 'male', 'min_count' => 0, 'max_count' => 64, 'points' => 0],
            ['age' => 18, 'gender' => 'male', 'min_count' => 65, 'max_count' => 69, 'points' => 1],
            ['age' => 18, 'gender' => 'male', 'min_count' => 70, 'max_count' => 74, 'points' => 2],
            ['age' => 18, 'gender' => 'male', 'min_count' => 75, 'max_count' => 79, 'points' => 3],
            ['age' => 18, 'gender' => 'male', 'min_count' => 80, 'max_count' => 84, 'points' => 4],
            ['age' => 18, 'gender' => 'male', 'min_count' => 85, 'max_count' => 94, 'points' => 5],
            ['age' => 18, 'gender' => 'male', 'min_count' => 95, 'max_count' => 114, 'points' => 6],
            ['age' => 18, 'gender' => 'male', 'min_count' => 115, 'max_count' => 134, 'points' => 7],
            ['age' => 18, 'gender' => 'male', 'min_count' => 135, 'max_count' => 154, 'points' => 8],
            ['age' => 18, 'gender' => 'male', 'min_count' => 155, 'max_count' => 194, 'points' => 9],
            ['age' => 18, 'gender' => 'male', 'min_count' => 195, 'max_count' => 999, 'points' => 10],

            // Age 17 and gender male
            ['age' => 17, 'gender' => 'male', 'min_count' => 0, 'max_count' => 59, 'points' => 0],
            ['age' => 17, 'gender' => 'male', 'min_count' => 60, 'max_count' => 64, 'points' => 1],
            ['age' => 17, 'gender' => 'male', 'min_count' => 65, 'max_count' => 69, 'points' => 2],
            ['age' => 17, 'gender' => 'male', 'min_count' => 70, 'max_count' => 74, 'points' => 3],
            ['age' => 17, 'gender' => 'male', 'min_count' => 75, 'max_count' => 79, 'points' => 4],
            ['age' => 17, 'gender' => 'male', 'min_count' => 80, 'max_count' => 89, 'points' => 5],
            ['age' => 17, 'gender' => 'male', 'min_count' => 90, 'max_count' => 109, 'points' => 6],
            ['age' => 17, 'gender' => 'male', 'min_count' => 110, 'max_count' => 129, 'points' => 7],
            ['age' => 17, 'gender' => 'male', 'min_count' => 130, 'max_count' => 149, 'points' => 8],
            ['age' => 17, 'gender' => 'male', 'min_count' => 150, 'max_count' => 189, 'points' => 9],
            ['age' => 17, 'gender' => 'male', 'min_count' => 190, 'max_count' => 999, 'points' => 10],

            // Age 16 and gender male
            ['age' => 16, 'gender' => 'male', 'min_count' => 0, 'max_count' => 54, 'points' => 0],
            ['age' => 16, 'gender' => 'male', 'min_count' => 55, 'max_count' => 59, 'points' => 1],
            ['age' => 16, 'gender' => 'male', 'min_count' => 60, 'max_count' => 64, 'points' => 2],
            ['age' => 16, 'gender' => 'male', 'min_count' => 65, 'max_count' => 69, 'points' => 3],
            ['age' => 16, 'gender' => 'male', 'min_count' => 70, 'max_count' => 74, 'points' => 4],
            ['age' => 16, 'gender' => 'male', 'min_count' => 75, 'max_count' => 84, 'points' => 5],
            ['age' => 16, 'gender' => 'male', 'min_count' => 85, 'max_count' => 104, 'points' => 6],
            ['age' => 16, 'gender' => 'male', 'min_count' => 105, 'max_count' => 124, 'points' => 7],
            ['age' => 16, 'gender' => 'male', 'min_count' => 125, 'max_count' => 144, 'points' => 8],
            ['age' => 16, 'gender' => 'male', 'min_count' => 145, 'max_count' => 184, 'points' => 9],
            ['age' => 16, 'gender' => 'male', 'min_count' => 185, 'max_count' => 999, 'points' => 10],

            // Age 15 and gender male
            ['age' => 15, 'gender' => 'male', 'min_count' => 0, 'max_count' => 49, 'points' => 0],
            ['age' => 15, 'gender' => 'male', 'min_count' => 50, 'max_count' => 54, 'points' => 1],
            ['age' => 15, 'gender' => 'male', 'min_count' => 55, 'max_count' => 59, 'points' => 2],
            ['age' => 15, 'gender' => 'male', 'min_count' => 60, 'max_count' => 64, 'points' => 3],
            ['age' => 15, 'gender' => 'male', 'min_count' => 65, 'max_count' => 69, 'points' => 4],
            ['age' => 15, 'gender' => 'male', 'min_count' => 70, 'max_count' => 79, 'points' => 5],
            ['age' => 15, 'gender' => 'male', 'min_count' => 80, 'max_count' => 99, 'points' => 6],
            ['age' => 15, 'gender' => 'male', 'min_count' => 100, 'max_count' => 119, 'points' => 7],
            ['age' => 15, 'gender' => 'male', 'min_count' => 120, 'max_count' => 139, 'points' => 8],
            ['age' => 15, 'gender' => 'male', 'min_count' => 140, 'max_count' => 179, 'points' => 9],
            ['age' => 15, 'gender' => 'male', 'min_count' => 180, 'max_count' => 999, 'points' => 10],

            // Age 14 and gender male
            ['age' => 14, 'gender' => 'male', 'min_count' => 0, 'max_count' => 44, 'points' => 0],
            ['age' => 14, 'gender' => 'male', 'min_count' => 45, 'max_count' => 49, 'points' => 1],
            ['age' => 14, 'gender' => 'male', 'min_count' => 50, 'max_count' => 54, 'points' => 2],
            ['age' => 14, 'gender' => 'male', 'min_count' => 55, 'max_count' => 59, 'points' => 3],
            ['age' => 14, 'gender' => 'male', 'min_count' => 60, 'max_count' => 64, 'points' => 4],
            ['age' => 14, 'gender' => 'male', 'min_count' => 65, 'max_count' => 74, 'points' => 5],
            ['age' => 14, 'gender' => 'male', 'min_count' => 75, 'max_count' => 94, 'points' => 6],
            ['age' => 14, 'gender' => 'male', 'min_count' => 95, 'max_count' => 114, 'points' => 7],
            ['age' => 14, 'gender' => 'male', 'min_count' => 115, 'max_count' => 134, 'points' => 8],
            ['age' => 14, 'gender' => 'male', 'min_count' => 135, 'max_count' => 174, 'points' => 9],
            ['age' => 14, 'gender' => 'male', 'min_count' => 175, 'max_count' => 999, 'points' => 10],

            // Age 13 and gender male
            ['age' => 13, 'gender' => 'male', 'min_count' => 0, 'max_count' => 39, 'points' => 0],
            ['age' => 13, 'gender' => 'male', 'min_count' => 40, 'max_count' => 44, 'points' => 1],
            ['age' => 13, 'gender' => 'male', 'min_count' => 45, 'max_count' => 49, 'points' => 2],
            ['age' => 13, 'gender' => 'male', 'min_count' => 50, 'max_count' => 54, 'points' => 3],
            ['age' => 13, 'gender' => 'male', 'min_count' => 55, 'max_count' => 59, 'points' => 4],
            ['age' => 13, 'gender' => 'male', 'min_count' => 60, 'max_count' => 69, 'points' => 5],
            ['age' => 13, 'gender' => 'male', 'min_count' => 70, 'max_count' => 89, 'points' => 6],
            ['age' => 13, 'gender' => 'male', 'min_count' => 90, 'max_count' => 109, 'points' => 7],
            ['age' => 13, 'gender' => 'male', 'min_count' => 110, 'max_count' => 129, 'points' => 8],
            ['age' => 13, 'gender' => 'male', 'min_count' => 130, 'max_count' => 169, 'points' => 9],
            ['age' => 13, 'gender' => 'male', 'min_count' => 170, 'max_count' => 999, 'points' => 10],

            // Age 12 and gender male
            ['age' => 12, 'gender' => 'male', 'min_count' => 0, 'max_count' => 34, 'points' => 0],
            ['age' => 12, 'gender' => 'male', 'min_count' => 35, 'max_count' => 39, 'points' => 1],
            ['age' => 12, 'gender' => 'male', 'min_count' => 40, 'max_count' => 44, 'points' => 2],
            ['age' => 12, 'gender' => 'male', 'min_count' => 45, 'max_count' => 49, 'points' => 3],
            ['age' => 12, 'gender' => 'male', 'min_count' => 50, 'max_count' => 54, 'points' => 4],
            ['age' => 12, 'gender' => 'male', 'min_count' => 55, 'max_count' => 64, 'points' => 5],
            ['age' => 12, 'gender' => 'male', 'min_count' => 65, 'max_count' => 84, 'points' => 6],
            ['age' => 12, 'gender' => 'male', 'min_count' => 85, 'max_count' => 104, 'points' => 7],
            ['age' => 12, 'gender' => 'male', 'min_count' => 105, 'max_count' => 124, 'points' => 8],
            ['age' => 12, 'gender' => 'male', 'min_count' => 125, 'max_count' => 164, 'points' => 9],
            ['age' => 12, 'gender' => 'male', 'min_count' => 165, 'max_count' => 999, 'points' => 10],

            // Age 11 and gender male
            ['age' => 11, 'gender' => 'male', 'min_count' => 0, 'max_count' => 29, 'points' => 0],
            ['age' => 11, 'gender' => 'male', 'min_count' => 30, 'max_count' => 34, 'points' => 1],
            ['age' => 11, 'gender' => 'male', 'min_count' => 35, 'max_count' => 39, 'points' => 2],
            ['age' => 11, 'gender' => 'male', 'min_count' => 40, 'max_count' => 44, 'points' => 3],
            ['age' => 11, 'gender' => 'male', 'min_count' => 45, 'max_count' => 49, 'points' => 4],
            ['age' => 11, 'gender' => 'male', 'min_count' => 50, 'max_count' => 59, 'points' => 5],
            ['age' => 11, 'gender' => 'male', 'min_count' => 60, 'max_count' => 79, 'points' => 6],
            ['age' => 11, 'gender' => 'male', 'min_count' => 80, 'max_count' => 99, 'points' => 7],
            ['age' => 11, 'gender' => 'male', 'min_count' => 100, 'max_count' => 119, 'points' => 8],
            ['age' => 11, 'gender' => 'male', 'min_count' => 120, 'max_count' => 159, 'points' => 9],
            ['age' => 11, 'gender' => 'male', 'min_count' => 160, 'max_count' => 999, 'points' => 10],

            // Age 10 and gender male
            ['age' => 10, 'gender' => 'male', 'min_count' => 0, 'max_count' => 24, 'points' => 0],
            ['age' => 10, 'gender' => 'male', 'min_count' => 25, 'max_count' => 29, 'points' => 1],
            ['age' => 10, 'gender' => 'male', 'min_count' => 30, 'max_count' => 34, 'points' => 2],
            ['age' => 10, 'gender' => 'male', 'min_count' => 35, 'max_count' => 39, 'points' => 3],
            ['age' => 10, 'gender' => 'male', 'min_count' => 40, 'max_count' => 44, 'points' => 4],
            ['age' => 10, 'gender' => 'male', 'min_count' => 45, 'max_count' => 54, 'points' => 5],
            ['age' => 10, 'gender' => 'male', 'min_count' => 55, 'max_count' => 74, 'points' => 6],
            ['age' => 10, 'gender' => 'male', 'min_count' => 75, 'max_count' => 94, 'points' => 7],
            ['age' => 10, 'gender' => 'male', 'min_count' => 95, 'max_count' => 114, 'points' => 8],
            ['age' => 10, 'gender' => 'male', 'min_count' => 115, 'max_count' => 154, 'points' => 9],
            ['age' => 10, 'gender' => 'male', 'min_count' => 155, 'max_count' => 999, 'points' => 10],

            // Age 9 and gender male
            ['age' => 9, 'gender' => 'male', 'min_count' => 0, 'max_count' => 19, 'points' => 0],
            ['age' => 9, 'gender' => 'male', 'min_count' => 20, 'max_count' => 24, 'points' => 1],
            ['age' => 9, 'gender' => 'male', 'min_count' => 25, 'max_count' => 29, 'points' => 2],
            ['age' => 9, 'gender' => 'male', 'min_count' => 30, 'max_count' => 34, 'points' => 3],
            ['age' => 9, 'gender' => 'male', 'min_count' => 35, 'max_count' => 39, 'points' => 4],
            ['age' => 9, 'gender' => 'male', 'min_count' => 40, 'max_count' => 49, 'points' => 5],
            ['age' => 9, 'gender' => 'male', 'min_count' => 50, 'max_count' => 69, 'points' => 6],
            ['age' => 9, 'gender' => 'male', 'min_count' => 70, 'max_count' => 89, 'points' => 7],
            ['age' => 9, 'gender' => 'male', 'min_count' => 90, 'max_count' => 109, 'points' => 8],
            ['age' => 9, 'gender' => 'male', 'min_count' => 110, 'max_count' => 149, 'points' => 9],
            ['age' => 9, 'gender' => 'male', 'min_count' => 150, 'max_count' => 999, 'points' => 10],

            // Age 8 and gender male
            ['age' => 8, 'gender' => 'male', 'min_count' => 0, 'max_count' => 14, 'points' => 0],
            ['age' => 8, 'gender' => 'male', 'min_count' => 15, 'max_count' => 19, 'points' => 1],
            ['age' => 8, 'gender' => 'male', 'min_count' => 20, 'max_count' => 24, 'points' => 2],
            ['age' => 8, 'gender' => 'male', 'min_count' => 25, 'max_count' => 29, 'points' => 3],
            ['age' => 8, 'gender' => 'male', 'min_count' => 30, 'max_count' => 34, 'points' => 4],
            ['age' => 8, 'gender' => 'male', 'min_count' => 35, 'max_count' => 44, 'points' => 5],
            ['age' => 8, 'gender' => 'male', 'min_count' => 45, 'max_count' => 64, 'points' => 6],
            ['age' => 8, 'gender' => 'male', 'min_count' => 65, 'max_count' => 84, 'points' => 7],
            ['age' => 8, 'gender' => 'male', 'min_count' => 85, 'max_count' => 104, 'points' => 8],
            ['age' => 8, 'gender' => 'male', 'min_count' => 105, 'max_count' => 144, 'points' => 9],
            ['age' => 8, 'gender' => 'male', 'min_count' => 145, 'max_count' => 999, 'points' => 10],

            // Age 7 and gender male
            ['age' => 7, 'gender' => 'male', 'min_count' => 0, 'max_count' => 9, 'points' => 0],
            ['age' => 7, 'gender' => 'male', 'min_count' => 10, 'max_count' => 14, 'points' => 1],
            ['age' => 7, 'gender' => 'male', 'min_count' => 15, 'max_count' => 19, 'points' => 2],
            ['age' => 7, 'gender' => 'male', 'min_count' => 20, 'max_count' => 24, 'points' => 3],
            ['age' => 7, 'gender' => 'male', 'min_count' => 25, 'max_count' => 29, 'points' => 4],
            ['age' => 7, 'gender' => 'male', 'min_count' => 30, 'max_count' => 39, 'points' => 5],
            ['age' => 7, 'gender' => 'male', 'min_count' => 40, 'max_count' => 59, 'points' => 6],
            ['age' => 7, 'gender' => 'male', 'min_count' => 60, 'max_count' => 79, 'points' => 7],
            ['age' => 7, 'gender' => 'male', 'min_count' => 80, 'max_count' => 99, 'points' => 8],
            ['age' => 7, 'gender' => 'male', 'min_count' => 100, 'max_count' => 139, 'points' => 9],
            ['age' => 7, 'gender' => 'male', 'min_count' => 140, 'max_count' => 999, 'points' => 10],

            /**
             * Seeder data for female gender
             */

            // Age 18 and gender female
            ['age' => 18, 'gender' => 'female', 'min_count' => 0, 'max_count' => 51, 'points' => 0],
            ['age' => 18, 'gender' => 'female', 'min_count' => 52, 'max_count' => 56, 'points' => 1],
            ['age' => 18, 'gender' => 'female', 'min_count' => 57, 'max_count' => 61, 'points' => 2],
            ['age' => 18, 'gender' => 'female', 'min_count' => 62, 'max_count' => 66, 'points' => 3],
            ['age' => 18, 'gender' => 'female', 'min_count' => 67, 'max_count' => 71, 'points' => 4],
            ['age' => 18, 'gender' => 'female', 'min_count' => 72, 'max_count' => 81, 'points' => 5],
            ['age' => 18, 'gender' => 'female', 'min_count' => 82, 'max_count' => 101, 'points' => 6],
            ['age' => 18, 'gender' => 'female', 'min_count' => 102, 'max_count' => 121, 'points' => 7],
            ['age' => 18, 'gender' => 'female', 'min_count' => 122, 'max_count' => 141, 'points' => 8],
            ['age' => 18, 'gender' => 'female', 'min_count' => 142, 'max_count' => 181, 'points' => 9],
            ['age' => 18, 'gender' => 'female', 'min_count' => 182, 'max_count' => 999, 'points' => 10],

            // Age 17 and gender female
            ['age' => 17, 'gender' => 'female', 'min_count' => 0, 'max_count' => 47, 'points' => 0],
            ['age' => 17, 'gender' => 'female', 'min_count' => 48, 'max_count' => 52, 'points' => 1],
            ['age' => 17, 'gender' => 'female', 'min_count' => 53, 'max_count' => 57, 'points' => 2],
            ['age' => 17, 'gender' => 'female', 'min_count' => 58, 'max_count' => 62, 'points' => 3],
            ['age' => 17, 'gender' => 'female', 'min_count' => 63, 'max_count' => 67, 'points' => 4],
            ['age' => 17, 'gender' => 'female', 'min_count' => 68, 'max_count' => 77, 'points' => 5],
            ['age' => 17, 'gender' => 'female', 'min_count' => 78, 'max_count' => 97, 'points' => 6],
            ['age' => 17, 'gender' => 'female', 'min_count' => 98, 'max_count' => 117, 'points' => 7],
            ['age' => 17, 'gender' => 'female', 'min_count' => 118, 'max_count' => 137, 'points' => 8],
            ['age' => 17, 'gender' => 'female', 'min_count' => 138, 'max_count' => 177, 'points' => 9],
            ['age' => 17, 'gender' => 'female', 'min_count' => 178, 'max_count' => 999, 'points' => 10],

            // Age 16 and gender female
            ['age' => 16, 'gender' => 'female', 'min_count' => 0, 'max_count' => 43, 'points' => 0],
            ['age' => 16, 'gender' => 'female', 'min_count' => 44, 'max_count' => 48, 'points' => 1],
            ['age' => 16, 'gender' => 'female', 'min_count' => 49, 'max_count' => 53, 'points' => 2],
            ['age' => 16, 'gender' => 'female', 'min_count' => 54, 'max_count' => 58, 'points' => 3],
            ['age' => 16, 'gender' => 'female', 'min_count' => 59, 'max_count' => 63, 'points' => 4],
            ['age' => 16, 'gender' => 'female', 'min_count' => 64, 'max_count' => 73, 'points' => 5],
            ['age' => 16, 'gender' => 'female', 'min_count' => 74, 'max_count' => 93, 'points' => 6],
            ['age' => 16, 'gender' => 'female', 'min_count' => 94, 'max_count' => 113, 'points' => 7],
            ['age' => 16, 'gender' => 'female', 'min_count' => 114, 'max_count' => 133, 'points' => 8],
            ['age' => 16, 'gender' => 'female', 'min_count' => 134, 'max_count' => 173, 'points' => 9],
            ['age' => 16, 'gender' => 'female', 'min_count' => 174, 'max_count' => 999, 'points' => 10],

            // Age 15 and gender female
            ['age' => 15, 'gender' => 'female', 'min_count' => 0, 'max_count' => 39, 'points' => 0],
            ['age' => 15, 'gender' => 'female', 'min_count' => 40, 'max_count' => 44, 'points' => 1],
            ['age' => 15, 'gender' => 'female', 'min_count' => 45, 'max_count' => 49, 'points' => 2],
            ['age' => 15, 'gender' => 'female', 'min_count' => 50, 'max_count' => 54, 'points' => 3],
            ['age' => 15, 'gender' => 'female', 'min_count' => 55, 'max_count' => 59, 'points' => 4],
            ['age' => 15, 'gender' => 'female', 'min_count' => 60, 'max_count' => 69, 'points' => 5],
            ['age' => 15, 'gender' => 'female', 'min_count' => 70, 'max_count' => 89, 'points' => 6],
            ['age' => 15, 'gender' => 'female', 'min_count' => 90, 'max_count' => 109, 'points' => 7],
            ['age' => 15, 'gender' => 'female', 'min_count' => 110, 'max_count' => 129, 'points' => 8],
            ['age' => 15, 'gender' => 'female', 'min_count' => 130, 'max_count' => 169, 'points' => 9],
            ['age' => 15, 'gender' => 'female', 'min_count' => 170, 'max_count' => 999, 'points' => 10],

            // Age 14 and gender female
            ['age' => 14, 'gender' => 'female', 'min_count' => 0, 'max_count' => 35, 'points' => 0],
            ['age' => 14, 'gender' => 'female', 'min_count' => 36, 'max_count' => 40, 'points' => 1],
            ['age' => 14, 'gender' => 'female', 'min_count' => 41, 'max_count' => 45, 'points' => 2],
            ['age' => 14, 'gender' => 'female', 'min_count' => 46, 'max_count' => 50, 'points' => 3],
            ['age' => 14, 'gender' => 'female', 'min_count' => 51, 'max_count' => 55, 'points' => 4],
            ['age' => 14, 'gender' => 'female', 'min_count' => 56, 'max_count' => 65, 'points' => 5],
            ['age' => 14, 'gender' => 'female', 'min_count' => 66, 'max_count' => 85, 'points' => 6],
            ['age' => 14, 'gender' => 'female', 'min_count' => 86, 'max_count' => 105, 'points' => 7],
            ['age' => 14, 'gender' => 'female', 'min_count' => 106, 'max_count' => 125, 'points' => 8],
            ['age' => 14, 'gender' => 'female', 'min_count' => 126, 'max_count' => 165, 'points' => 9],
            ['age' => 14, 'gender' => 'female', 'min_count' => 166, 'max_count' => 999, 'points' => 10],

            // Age 13 and gender female
            ['age' => 13, 'gender' => 'female', 'min_count' => 0, 'max_count' => 31, 'points' => 0],
            ['age' => 13, 'gender' => 'female', 'min_count' => 32, 'max_count' => 36, 'points' => 1],
            ['age' => 13, 'gender' => 'female', 'min_count' => 37, 'max_count' => 41, 'points' => 2],
            ['age' => 13, 'gender' => 'female', 'min_count' => 42, 'max_count' => 46, 'points' => 3],
            ['age' => 13, 'gender' => 'female', 'min_count' => 47, 'max_count' => 51, 'points' => 4],
            ['age' => 13, 'gender' => 'female', 'min_count' => 52, 'max_count' => 61, 'points' => 5],
            ['age' => 13, 'gender' => 'female', 'min_count' => 62, 'max_count' => 81, 'points' => 6],
            ['age' => 13, 'gender' => 'female', 'min_count' => 82, 'max_count' => 101, 'points' => 7],
            ['age' => 13, 'gender' => 'female', 'min_count' => 102, 'max_count' => 121, 'points' => 8],
            ['age' => 13, 'gender' => 'female', 'min_count' => 122, 'max_count' => 161, 'points' => 9],
            ['age' => 13, 'gender' => 'female', 'min_count' => 162, 'max_count' => 999, 'points' => 10],

            // Age 12 and gender female
            ['age' => 12, 'gender' => 'female', 'min_count' => 0, 'max_count' => 27, 'points' => 0],
            ['age' => 12, 'gender' => 'female', 'min_count' => 28, 'max_count' => 32, 'points' => 1],
            ['age' => 12, 'gender' => 'female', 'min_count' => 33, 'max_count' => 37, 'points' => 2],
            ['age' => 12, 'gender' => 'female', 'min_count' => 38, 'max_count' => 42, 'points' => 3],
            ['age' => 12, 'gender' => 'female', 'min_count' => 43, 'max_count' => 47, 'points' => 4],
            ['age' => 12, 'gender' => 'female', 'min_count' => 48, 'max_count' => 57, 'points' => 5],
            ['age' => 12, 'gender' => 'female', 'min_count' => 58, 'max_count' => 77, 'points' => 6],
            ['age' => 12, 'gender' => 'female', 'min_count' => 78, 'max_count' => 97, 'points' => 7],
            ['age' => 12, 'gender' => 'female', 'min_count' => 98, 'max_count' => 117, 'points' => 8],
            ['age' => 12, 'gender' => 'female', 'min_count' => 118, 'max_count' => 157, 'points' => 9],
            ['age' => 12, 'gender' => 'female', 'min_count' => 158, 'max_count' => 999, 'points' => 10],

            // Age 11 and gender female
            ['age' => 11, 'gender' => 'female', 'min_count' => 0, 'max_count' => 23, 'points' => 0],
            ['age' => 11, 'gender' => 'female', 'min_count' => 24, 'max_count' => 28, 'points' => 1],
            ['age' => 11, 'gender' => 'female', 'min_count' => 29, 'max_count' => 33, 'points' => 2],
            ['age' => 11, 'gender' => 'female', 'min_count' => 34, 'max_count' => 38, 'points' => 3],
            ['age' => 11, 'gender' => 'female', 'min_count' => 39, 'max_count' => 43, 'points' => 4],
            ['age' => 11, 'gender' => 'female', 'min_count' => 44, 'max_count' => 53, 'points' => 5],
            ['age' => 11, 'gender' => 'female', 'min_count' => 54, 'max_count' => 73, 'points' => 6],
            ['age' => 11, 'gender' => 'female', 'min_count' => 74, 'max_count' => 93, 'points' => 7],
            ['age' => 11, 'gender' => 'female', 'min_count' => 94, 'max_count' => 113, 'points' => 8],
            ['age' => 11, 'gender' => 'female', 'min_count' => 114, 'max_count' => 153, 'points' => 9],
            ['age' => 11, 'gender' => 'female', 'min_count' => 154, 'max_count' => 999, 'points' => 10],

            // Age 10 and gender female
            ['age' => 10, 'gender' => 'female', 'min_count' => 0, 'max_count' => 19, 'points' => 0],
            ['age' => 10, 'gender' => 'female', 'min_count' => 20, 'max_count' => 24, 'points' => 1],
            ['age' => 10, 'gender' => 'female', 'min_count' => 25, 'max_count' => 29, 'points' => 2],
            ['age' => 10, 'gender' => 'female', 'min_count' => 30, 'max_count' => 34, 'points' => 3],
            ['age' => 10, 'gender' => 'female', 'min_count' => 35, 'max_count' => 39, 'points' => 4],
            ['age' => 10, 'gender' => 'female', 'min_count' => 40, 'max_count' => 49, 'points' => 5],
            ['age' => 10, 'gender' => 'female', 'min_count' => 50, 'max_count' => 69, 'points' => 6],
            ['age' => 10, 'gender' => 'female', 'min_count' => 70, 'max_count' => 89, 'points' => 7],
            ['age' => 10, 'gender' => 'female', 'min_count' => 90, 'max_count' => 109, 'points' => 8],
            ['age' => 10, 'gender' => 'female', 'min_count' => 110, 'max_count' => 149, 'points' => 9],
            ['age' => 10, 'gender' => 'female', 'min_count' => 150, 'max_count' => 999, 'points' => 10],

            // Age 9 and gender female
            ['age' => 9, 'gender' => 'female', 'min_count' => 0, 'max_count' => 15, 'points' => 0],
            ['age' => 9, 'gender' => 'female', 'min_count' => 16, 'max_count' => 20, 'points' => 1],
            ['age' => 9, 'gender' => 'female', 'min_count' => 21, 'max_count' => 25, 'points' => 2],
            ['age' => 9, 'gender' => 'female', 'min_count' => 26, 'max_count' => 30, 'points' => 3],
            ['age' => 9, 'gender' => 'female', 'min_count' => 31, 'max_count' => 35, 'points' => 4],
            ['age' => 9, 'gender' => 'female', 'min_count' => 36, 'max_count' => 45, 'points' => 5],
            ['age' => 9, 'gender' => 'female', 'min_count' => 46, 'max_count' => 65, 'points' => 6],
            ['age' => 9, 'gender' => 'female', 'min_count' => 66, 'max_count' => 85, 'points' => 7],
            ['age' => 9, 'gender' => 'female', 'min_count' => 86, 'max_count' => 105, 'points' => 8],
            ['age' => 9, 'gender' => 'female', 'min_count' => 106, 'max_count' => 145, 'points' => 9],
            ['age' => 9, 'gender' => 'female', 'min_count' => 146, 'max_count' => 999, 'points' => 10],

            // Age 8 and gender female
            ['age' => 8, 'gender' => 'female', 'min_count' => 0, 'max_count' => 11, 'points' => 0],
            ['age' => 8, 'gender' => 'female', 'min_count' => 12, 'max_count' => 16, 'points' => 1],
            ['age' => 8, 'gender' => 'female', 'min_count' => 17, 'max_count' => 21, 'points' => 2],
            ['age' => 8, 'gender' => 'female', 'min_count' => 22, 'max_count' => 26, 'points' => 3],
            ['age' => 8, 'gender' => 'female', 'min_count' => 27, 'max_count' => 31, 'points' => 4],
            ['age' => 8, 'gender' => 'female', 'min_count' => 32, 'max_count' => 41, 'points' => 5],
            ['age' => 8, 'gender' => 'female', 'min_count' => 42, 'max_count' => 61, 'points' => 6],
            ['age' => 8, 'gender' => 'female', 'min_count' => 62, 'max_count' => 81, 'points' => 7],
            ['age' => 8, 'gender' => 'female', 'min_count' => 82, 'max_count' => 101, 'points' => 8],
            ['age' => 8, 'gender' => 'female', 'min_count' => 102, 'max_count' => 141, 'points' => 9],
            ['age' => 8, 'gender' => 'female', 'min_count' => 142, 'max_count' => 999, 'points' => 10],

            // Age 7 and gender female
            ['age' => 7, 'gender' => 'female', 'min_count' => 0, 'max_count' => 7, 'points' => 0],
            ['age' => 7, 'gender' => 'female', 'min_count' => 8, 'max_count' => 12, 'points' => 1],
            ['age' => 7, 'gender' => 'female', 'min_count' => 13, 'max_count' => 17, 'points' => 2],
            ['age' => 7, 'gender' => 'female', 'min_count' => 18, 'max_count' => 22, 'points' => 3],
            ['age' => 7, 'gender' => 'female', 'min_count' => 23, 'max_count' => 27, 'points' => 4],
            ['age' => 7, 'gender' => 'female', 'min_count' => 28, 'max_count' => 36, 'points' => 5],
            ['age' => 7, 'gender' => 'female', 'min_count' => 37, 'max_count' => 56, 'points' => 6],
            ['age' => 7, 'gender' => 'female', 'min_count' => 57, 'max_count' => 76, 'points' => 7],
            ['age' => 7, 'gender' => 'female', 'min_count' => 77, 'max_count' => 96, 'points' => 8],
            ['age' => 7, 'gender' => 'female', 'min_count' => 97, 'max_count' => 136, 'points' => 9],
            ['age' => 7, 'gender' => 'female', 'min_count' => 137, 'max_count' => 999, 'points' => 10],
        ];

        foreach($rules as $rule){
            StaminaTestRule::create($rule);
        }
    }
}
