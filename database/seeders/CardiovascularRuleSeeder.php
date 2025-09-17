<?php

namespace Database\Seeders;

use App\Models\CardiovascularTestRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardiovascularRuleSeeder extends Seeder
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

            // Age 18 and geder male
            ['age' => 18, 'gender' => 'male', 'min_duration' => 0,    'max_duration' => 4.7,  'points' => 0],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 4.8,  'max_duration' => 6.1,  'points' => 1],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 6.2,  'max_duration' => 7.2,  'points' => 2],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 7.3,  'max_duration' => 8.3,  'points' => 3],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 8.4,  'max_duration' => 9.3,  'points' => 4],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 9.4,  'max_duration' => 10.3, 'points' => 5],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 10.4, 'max_duration' => 11.3, 'points' => 6],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 11.4, 'max_duration' => 12.2, 'points' => 7],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 12.3, 'max_duration' => 13.1, 'points' => 8],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 13.2, 'max_duration' => 14.1, 'points' => 9],
            ['age' => 18, 'gender' => 'male', 'min_duration' => 14.2, 'max_duration' => 99, 'points' => 10],


            // Age 17 and geder male
            ['age' => 17, 'gender' => 'male', 'min_duration' => 0.0, 'max_duration' => 4.5,  'points' => 0],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 4.6, 'max_duration' => 5.6,  'points' => 1],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 5.7, 'max_duration' => 6.7,  'points' => 2],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 6.8, 'max_duration' => 7.8,  'points' => 3],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 7.9, 'max_duration' => 8.9,  'points' => 4],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 9.0, 'max_duration' => 9.9,  'points' => 5],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 10.0, 'max_duration' => 10.9, 'points' => 6],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 11.0, 'max_duration' => 11.9, 'points' => 7],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 12.0, 'max_duration' => 12.9, 'points' => 8],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 13.0, 'max_duration' => 13.7, 'points' => 9],
            ['age' => 17, 'gender' => 'male', 'min_duration' => 13.8, 'max_duration' => 99, 'points' => 10],


            // Age 16 and geder male
            ['age' => 16, 'gender' => 'male', 'min_duration' => 0.0, 'max_duration' => 4.3,  'points' => 0],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 4.4, 'max_duration' => 5.4,  'points' => 1],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 5.5, 'max_duration' => 6.5,  'points' => 2],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 6.6, 'max_duration' => 7.5,  'points' => 3],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 7.6, 'max_duration' => 8.5,  'points' => 4],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 8.6, 'max_duration' => 9.4,  'points' => 5],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 9.5, 'max_duration' => 10.3, 'points' => 6],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 10.4, 'max_duration' => 11.2, 'points' => 7],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 11.3, 'max_duration' => 12.1, 'points' => 8],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 12.2, 'max_duration' => 12.12, 'points' => 9],
            ['age' => 16, 'gender' => 'male', 'min_duration' => 12.13, 'max_duration' => 99, 'points' => 10],


            // Age 15 and geder male
            ['age' => 15, 'gender' => 'male', 'min_duration' => 0.0, 'max_duration' => 4.1,  'points' => 0],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 4.2, 'max_duration' => 5.2,  'points' => 1],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 5.3, 'max_duration' => 6.2,  'points' => 2],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 6.3, 'max_duration' => 7.1,  'points' => 3],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 7.2, 'max_duration' => 7.10, 'points' => 4],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 8.1, 'max_duration' => 8.9,  'points' => 5],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 8.10, 'max_duration' => 9.8,  'points' => 6],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 9.9, 'max_duration' => 10.7, 'points' => 7],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 10.8, 'max_duration' => 11.7, 'points' => 8],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 11.8, 'max_duration' => 12.5, 'points' => 9],
            ['age' => 15, 'gender' => 'male', 'min_duration' => 12.6, 'max_duration' => 99, 'points' => 10],


            // Age 14 and geder male
            ['age' => 14, 'gender' => 'male', 'min_duration' => 0.0, 'max_duration' => 4.0,  'points' => 0],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 4.1, 'max_duration' => 4.9,  'points' => 1],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 5.1, 'max_duration' => 5.9,  'points' => 2],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 6.1, 'max_duration' => 6.9,  'points' => 3],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 6.10, 'max_duration' => 7.8,  'points' => 4],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 7.9, 'max_duration' => 8.7,  'points' => 5],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 8.8, 'max_duration' => 9.5,  'points' => 6],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 9.6, 'max_duration' => 10.3, 'points' => 7],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 10.4, 'max_duration' => 11.1, 'points' => 8],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 11.2, 'max_duration' => 11.9, 'points' => 9],
            ['age' => 14, 'gender' => 'male', 'min_duration' => 12.0, 'max_duration' => 99, 'points' => 10],


            // Age 13 and geder male
            ['age' => 13, 'gender' => 'male', 'min_duration' => 0.0, 'max_duration' => 3.7,  'points' => 0],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 3.8, 'max_duration' => 4.7,  'points' => 1],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 4.8, 'max_duration' => 5.6,  'points' => 2],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 5.7, 'max_duration' => 6.5,  'points' => 3],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 6.6, 'max_duration' => 7.3,  'points' => 4],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 7.4, 'max_duration' => 8.1,  'points' => 5],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 8.2, 'max_duration' => 8.9,  'points' => 6],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 9.0, 'max_duration' => 9.6,  'points' => 7],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 9.7, 'max_duration' => 10.4, 'points' => 8],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 10.5, 'max_duration' => 11.2, 'points' => 9],
            ['age' => 13, 'gender' => 'male', 'min_duration' => 11.3, 'max_duration' => 99, 'points' => 10],


            // Age 12 and geder male
            ['age' => 12, 'gender' => 'male', 'min_duration' => 0.0, 'max_duration' => 3.5,  'points' => 0],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 3.6, 'max_duration' => 4.5,  'points' => 1],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 4.6, 'max_duration' => 5.3,  'points' => 2],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 5.4, 'max_duration' => 6.1,  'points' => 3],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 6.2, 'max_duration' => 6.8,  'points' => 4],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 6.9, 'max_duration' => 7.5,  'points' => 5],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 7.6, 'max_duration' => 8.3,  'points' => 6],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 8.4, 'max_duration' => 8.11, 'points' => 7],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 9.1, 'max_duration' => 9.8,  'points' => 8],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 9.9, 'max_duration' => 10.5, 'points' => 9],
            ['age' => 12, 'gender' => 'male', 'min_duration' => 10.6, 'max_duration' => 99, 'points' => 10],


            // Age 11 and geder male
            ['age' => 11, 'gender' => 'male', 'min_duration' => 0.0, 'max_duration' => 3.3,  'points' => 0],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 3.4, 'max_duration' => 4.3,  'points' => 1],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 4.4, 'max_duration' => 5.1,  'points' => 2],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 5.2, 'max_duration' => 5.8,  'points' => 3],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 5.9, 'max_duration' => 6.5,  'points' => 4],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 6.6, 'max_duration' => 7.2,  'points' => 5],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 7.3, 'max_duration' => 7.9,  'points' => 6],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 8.0, 'max_duration' => 8.6,  'points' => 7],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 8.7, 'max_duration' => 9.2,  'points' => 8],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 9.3, 'max_duration' => 9.9,  'points' => 9],
            ['age' => 11, 'gender' => 'male', 'min_duration' => 10.0, 'max_duration' => 99, 'points' => 10],


            // Age 10 and geder male
            ['age' => 10, 'gender' => 'male', 'min_duration' => 0.0, 'max_duration' => 3.1,  'points' => 0],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 3.2, 'max_duration' => 3.7,  'points' => 1],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 3.8, 'max_duration' => 4.5,  'points' => 2],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 4.6, 'max_duration' => 5.2,  'points' => 3],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 5.3, 'max_duration' => 5.8,  'points' => 4],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 5.9, 'max_duration' => 6.6,  'points' => 5],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 6.7, 'max_duration' => 7.3,  'points' => 6],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 7.4, 'max_duration' => 7.10, 'points' => 7],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 8.1, 'max_duration' => 8.7,  'points' => 8],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 8.8, 'max_duration' => 9.2,  'points' => 9],
            ['age' => 10, 'gender' => 'male', 'min_duration' => 9.3, 'max_duration' => 99, 'points' => 10],


            // Age 9 and geder male
            ['age' => 9, 'gender' => 'male', 'min_duration' => 0.0, 'max_duration' => 3.0,  'points' => 0],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 3.1, 'max_duration' => 3.6,  'points' => 1],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 3.7, 'max_duration' => 4.4,  'points' => 2],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 4.5, 'max_duration' => 5.1,  'points' => 3],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 5.2, 'max_duration' => 5.7,  'points' => 4],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 5.8, 'max_duration' => 6.4,  'points' => 5],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 6.5, 'max_duration' => 6.10, 'points' => 6],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 7.1, 'max_duration' => 7.5,  'points' => 7],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 7.6, 'max_duration' => 8.1,  'points' => 8],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 8.2, 'max_duration' => 8.6,  'points' => 9],
            ['age' => 9, 'gender' => 'male', 'min_duration' => 8.7, 'max_duration' => 99, 'points' => 10],


            // Age 8 and geder male
            ['age' => 8, 'gender' => 'male', 'min_duration' => 0.0, 'max_duration' => 2.7,  'points' => 0],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 2.8, 'max_duration' => 3.4,  'points' => 1],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 3.5, 'max_duration' => 4.1,  'points' => 2],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 4.2, 'max_duration' => 4.6,  'points' => 3],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 4.7, 'max_duration' => 5.2,  'points' => 4],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 5.3, 'max_duration' => 5.7,  'points' => 5],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 5.8, 'max_duration' => 6.3,  'points' => 6],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 6.4, 'max_duration' => 6.9,  'points' => 7],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 6.10, 'max_duration' => 7.4,  'points' => 8],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 7.5, 'max_duration' => 7.9,  'points' => 9],
            ['age' => 8, 'gender' => 'male', 'min_duration' => 8.0, 'max_duration' => 99, 'points' => 10],


            // Age 7 and geder male
            ['age' => 7, 'gender' => 'male', 'min_duration' => 0.0, 'max_duration' => 2.5,  'points' => 0],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 2.6, 'max_duration' => 3.1,  'points' => 1],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 3.2, 'max_duration' => 3.5,  'points' => 2],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 3.6, 'max_duration' => 4.1,  'points' => 3],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 4.2, 'max_duration' => 4.5,  'points' => 4],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 4.6, 'max_duration' => 5.1,  'points' => 5],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 5.2, 'max_duration' => 5.6,  'points' => 6],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 5.7, 'max_duration' => 6.2,  'points' => 7],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 6.3, 'max_duration' => 6.7,  'points' => 8],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 6.8, 'max_duration' => 7.2,  'points' => 9],
            ['age' => 7, 'gender' => 'male', 'min_duration' => 7.3, 'max_duration' => 99, 'points' => 10],


            /**
             * Seeder data for female gender
             */

            // Age 18 and geder female
            ['age' => 18, 'gender' => 'female', 'min_duration' => 0.0,  'max_duration' => 4.2,  'points' => 0],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 4.3,  'max_duration' => 5.2,  'points' => 1],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 5.3,  'max_duration' => 6.2,  'points' => 2],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 6.3,  'max_duration' => 7.1,  'points' => 3],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 7.2,  'max_duration' => 7.10, 'points' => 4],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 8.1,  'max_duration' => 8.9,  'points' => 5],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 8.10, 'max_duration' => 9.7,  'points' => 6],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 9.8,  'max_duration' => 10.6, 'points' => 7],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 10.7, 'max_duration' => 11.5, 'points' => 8],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 11.6, 'max_duration' => 12.3, 'points' => 9],
            ['age' => 18, 'gender' => 'female', 'min_duration' => 12.4, 'max_duration' => 99, 'points' => 10],


            // Age 17 and gender female
            ['age' => 17, 'gender' => 'female', 'min_duration' => 0.0,  'max_duration' => 4.1,  'points' => 0],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 4.2,  'max_duration' => 5.1,  'points' => 1],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 5.2,  'max_duration' => 6.1,  'points' => 2],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 6.2,  'max_duration' => 6.10, 'points' => 3],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 7.1,  'max_duration' => 7.9,  'points' => 4],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 7.10, 'max_duration' => 8.7,  'points' => 5],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 8.8,  'max_duration' => 9.5,  'points' => 6],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 9.6,  'max_duration' => 10.4, 'points' => 7],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 10.5, 'max_duration' => 11.3, 'points' => 8],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 11.4, 'max_duration' => 12.1, 'points' => 9],
            ['age' => 17, 'gender' => 'female', 'min_duration' => 12.2, 'max_duration' => 99, 'points' => 10],


            // Age 16 and gender female
            ['age' => 16, 'gender' => 'female', 'min_duration' => 0.0,   'max_duration' => 3.7,   'points' => 0],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 4.1,   'max_duration' => 4.9,   'points' => 1],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 5.1,   'max_duration' => 5.9,   'points' => 2],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 6.1,   'max_duration' => 6.9,   'points' => 3],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 6.10,  'max_duration' => 7.8,   'points' => 4],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 7.9,   'max_duration' => 8.7,   'points' => 5],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 8.8,   'max_duration' => 9.5,   'points' => 6],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 9.6,   'max_duration' => 10.2,  'points' => 7],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 10.3,  'max_duration' => 10.10, 'points' => 8],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 10.11, 'max_duration' => 11.7,  'points' => 9],
            ['age' => 16, 'gender' => 'female', 'min_duration' => 11.8,  'max_duration' => 99, 'points' => 10],


            // Age 17 and gender female
            ['age' => 15, 'gender' => 'female', 'min_duration' => 0.0,  'max_duration' => 3.5,  'points' => 0],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 3.6,  'max_duration' => 4.5,  'points' => 1],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 4.6,  'max_duration' => 5.5,  'points' => 2],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 5.6,  'max_duration' => 6.4,  'points' => 3],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 6.5,  'max_duration' => 7.2,  'points' => 4],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 7.3,  'max_duration' => 7.10, 'points' => 5],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 8.1,  'max_duration' => 8.8,  'points' => 6],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 8.9,  'max_duration' => 9.5,  'points' => 7],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 9.6,  'max_duration' => 10.3, 'points' => 8],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 10.4, 'max_duration' => 11.1, 'points' => 9],
            ['age' => 15, 'gender' => 'female', 'min_duration' => 11.2, 'max_duration' => 99, 'points' => 10],


            // Age 14 and gender female
            ['age' => 14, 'gender' => 'female', 'min_duration' => 0.0,  'max_duration' => 3.3,  'points' => 0],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 3.4,  'max_duration' => 4.2,  'points' => 1],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 4.3,  'max_duration' => 4.9,  'points' => 2],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 5.1,  'max_duration' => 5.8,  'points' => 3],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 5.9,  'max_duration' => 6.7,  'points' => 4],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 6.8,  'max_duration' => 7.5,  'points' => 5],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 7.6,  'max_duration' => 8.3,  'points' => 6],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 8.4,  'max_duration' => 8.11, 'points' => 7],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 9.1,  'max_duration' => 9.8,  'points' => 8],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 9.9,  'max_duration' => 10.5, 'points' => 9],
            ['age' => 14, 'gender' => 'female', 'min_duration' => 10.6, 'max_duration' => 99, 'points' => 10],


            // Age 13 and gender female
            ['age' => 13, 'gender' => 'female', 'min_duration' => 0.0,  'max_duration' => 3.1,  'points' => 0],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 3.2,  'max_duration' => 4.1,  'points' => 1],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 4.2,  'max_duration' => 4.9,  'points' => 2],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 5.1,  'max_duration' => 5.8,  'points' => 3],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 5.9,  'max_duration' => 6.7,  'points' => 4],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 6.8,  'max_duration' => 7.4,  'points' => 5],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 7.5,  'max_duration' => 8.1,  'points' => 6],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 8.2,  'max_duration' => 8.8,  'points' => 7],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 8.9,  'max_duration' => 9.4,  'points' => 8],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 9.5,  'max_duration' => 9.11, 'points' => 9],
            ['age' => 13, 'gender' => 'female', 'min_duration' => 9.12, 'max_duration' => 99, 'points' => 10],


            // Age 12 and gender female
            ['age' => 12, 'gender' => 'female', 'min_duration' => 0.0,  'max_duration' => 2.7,  'points' => 0],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 2.8,  'max_duration' => 3.5,  'points' => 1],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 3.6,  'max_duration' => 4.3,  'points' => 2],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 4.4,  'max_duration' => 4.9,  'points' => 3],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 5.1,  'max_duration' => 5.6,  'points' => 4],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 5.7,  'max_duration' => 6.4,  'points' => 5],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 6.5,  'max_duration' => 7.1,  'points' => 6],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 7.2,  'max_duration' => 7.8,  'points' => 7],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 7.9,  'max_duration' => 8.5,  'points' => 8],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 8.6,  'max_duration' => 9.1,  'points' => 9],
            ['age' => 12, 'gender' => 'female', 'min_duration' => 9.2,  'max_duration' => 99, 'points' => 10],


            // Age 11 and gender female
            ['age' => 11, 'gender' => 'female', 'min_duration' => 0.0,  'max_duration' => 2.6,  'points' => 0],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 2.7,  'max_duration' => 3.4,  'points' => 1],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 3.5,  'max_duration' => 4.2,  'points' => 2],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 4.3,  'max_duration' => 4.8,  'points' => 3],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 4.9,  'max_duration' => 5.5,  'points' => 4],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 5.6,  'max_duration' => 6.2,  'points' => 5],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 6.3,  'max_duration' => 6.8,  'points' => 6],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 6.9,  'max_duration' => 7.4,  'points' => 7],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 7.5,  'max_duration' => 7.10, 'points' => 8],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 8.1,  'max_duration' => 8.6,  'points' => 9],
            ['age' => 11, 'gender' => 'female', 'min_duration' => 8.7,  'max_duration' => 99, 'points' => 10],


            // Age 10 and gender female
            ['age' => 10, 'gender' => 'female', 'min_duration' => 0.0,  'max_duration' => 2.4,  'points' => 0],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 2.5,  'max_duration' => 3.2,  'points' => 1],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 3.3,  'max_duration' => 3.8,  'points' => 2],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 4.1,  'max_duration' => 4.6,  'points' => 3],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 4.7,  'max_duration' => 5.2,  'points' => 4],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 5.3,  'max_duration' => 5.7,  'points' => 5],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 5.8,  'max_duration' => 6.3,  'points' => 6],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 6.4,  'max_duration' => 6.8,  'points' => 7],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 6.9,  'max_duration' => 7.4,  'points' => 8],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 7.5,  'max_duration' => 7.10, 'points' => 9],
            ['age' => 10, 'gender' => 'female', 'min_duration' => 7.11, 'max_duration' => 99, 'points' => 10],


            // Age 9 and gender female
            ['age' => 9, 'gender' => 'female', 'min_duration' => 0.0,  'max_duration' => 2.3,  'points' => 0],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 2.4,  'max_duration' => 3.1,  'points' => 1],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 3.2,  'max_duration' => 3.7,  'points' => 2],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 3.8,  'max_duration' => 4.5,  'points' => 3],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 4.6,  'max_duration' => 5.0,  'points' => 4],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 5.1,  'max_duration' => 5.5,  'points' => 5],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 5.6,  'max_duration' => 5.10, 'points' => 6],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 6.1,  'max_duration' => 6.5,  'points' => 7],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 6.6,  'max_duration' => 6.10, 'points' => 8],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 7.1,  'max_duration' => 7.5,  'points' => 9],
            ['age' => 9, 'gender' => 'female', 'min_duration' => 7.6,  'max_duration' => 99, 'points' => 10],


            // Age 8 and gender female
            ['age' => 8, 'gender' => 'female', 'min_duration' => 0.0,  'max_duration' => 2.2,  'points' => 0],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 2.3,  'max_duration' => 2.6,  'points' => 1],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 2.7,  'max_duration' => 3.2,  'points' => 2],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 3.3,  'max_duration' => 3.6,  'points' => 3],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 3.7,  'max_duration' => 4.2,  'points' => 4],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 4.3,  'max_duration' => 4.7,  'points' => 5],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 4.8,  'max_duration' => 5.3,  'points' => 6],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 5.4,  'max_duration' => 5.8,  'points' => 7],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 5.9,  'max_duration' => 6.4,  'points' => 8],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 6.5,  'max_duration' => 6.9,  'points' => 9],
            ['age' => 8, 'gender' => 'female', 'min_duration' => 7.0,  'max_duration' => 99, 'points' => 10],


            // Age 7 and gender female
            ['age' => 7, 'gender' => 'female', 'min_duration' => 0.0,  'max_duration' => 2.0,  'points' => 0],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 2.2,  'max_duration' => 2.5,  'points' => 1],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 2.6,  'max_duration' => 3.1,  'points' => 2],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 3.2,  'max_duration' => 3.5,  'points' => 3],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 3.6,  'max_duration' => 4.1,  'points' => 4],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 4.2,  'max_duration' => 4.5,  'points' => 5],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 4.6,  'max_duration' => 4.9,  'points' => 6],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 5.1,  'max_duration' => 5.4,  'points' => 7],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 5.5,  'max_duration' => 5.8,  'points' => 8],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 5.9,  'max_duration' => 6.3,  'points' => 9],
            ['age' => 7, 'gender' => 'female', 'min_duration' => 6.4,  'max_duration' => 99, 'points' => 10],
        ];

        foreach ($rules as $rule) {
            CardiovascularTestRule::create($rule);
        }
    }
}
