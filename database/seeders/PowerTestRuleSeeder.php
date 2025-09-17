<?php

namespace Database\Seeders;

use App\Models\PowerTestRule;
use Illuminate\Database\Seeder;

class PowerTestRuleSeeder extends Seeder
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
            ['age' => 18, 'gender' => 'male', 'min_distance' => 0,       'max_distance' => 192.90, 'points' => 0],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 192.91,  'max_distance' => 204.88, 'points' => 1],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 204.89,  'max_distance' => 213.41, 'points' => 2],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 213.42,  'max_distance' => 220.63, 'points' => 3],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 220.64,  'max_distance' => 227.33, 'points' => 4],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 227.34,  'max_distance' => 233.97, 'points' => 5],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 233.98,  'max_distance' => 241.03, 'points' => 6],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 241.04,  'max_distance' => 249.22, 'points' => 7],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 249.23,  'max_distance' => 260.47, 'points' => 8],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 260.48,  'max_distance' => 269.67, 'points' => 9],
            ['age' => 18, 'gender' => 'male', 'min_distance' => 269.68,  'max_distance' => 999,    'points' => 10],

            // Age 17 and gender male
            ['age' => 17, 'gender' => 'male', 'min_distance' => 0,       'max_distance' => 187.23, 'points' => 0],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 187.24,  'max_distance' => 199.47, 'points' => 1],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 199.48,  'max_distance' => 208.18, 'points' => 2],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 208.19,  'max_distance' => 215.55, 'points' => 3],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 215.56,  'max_distance' => 222.39, 'points' => 4],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 222.40,  'max_distance' => 229.16, 'points' => 5],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 229.17,  'max_distance' => 236.36, 'points' => 6],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 236.37,  'max_distance' => 244.71, 'points' => 7],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 244.72,  'max_distance' => 256.18, 'points' => 8],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 256.19,  'max_distance' => 265.55, 'points' => 9],
            ['age' => 17, 'gender' => 'male', 'min_distance' => 265.56,  'max_distance' => 999,    'points' => 10],

            // Age 16 and gender male
            ['age' => 16, 'gender' => 'male', 'min_distance' => 0,       'max_distance' => 180.82, 'points' => 0],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 180.83,  'max_distance' => 193.25, 'points' => 1],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 193.26,  'max_distance' => 202.10, 'points' => 2],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 202.11,  'max_distance' => 209.57, 'points' => 3],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 209.58,  'max_distance' => 216.50, 'points' => 4],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 216.51,  'max_distance' => 223.38, 'points' => 5],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 223.39,  'max_distance' => 230.67, 'points' => 6],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 230.68,  'max_distance' => 239.13, 'points' => 7],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 239.14,  'max_distance' => 250.74, 'points' => 8],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 250.75,  'max_distance' => 260.23, 'points' => 9],
            ['age' => 16, 'gender' => 'male', 'min_distance' => 260.24,  'max_distance' => 999,    'points' => 10],

            // Age 15 and gender male
            ['age' => 15, 'gender' => 'male', 'min_distance' => 0,       'max_distance' => 173.00, 'points' => 0],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 173.01,  'max_distance' => 185.48, 'points' => 1],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 185.49,  'max_distance' => 194.35, 'points' => 2],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 194.36,  'max_distance' => 201.85, 'points' => 3],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 201.86,  'max_distance' => 208.79, 'points' => 4],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 208.80,  'max_distance' => 215.68, 'points' => 5],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 215.69,  'max_distance' => 222.98, 'points' => 6],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 222.99,  'max_distance' => 231.46, 'points' => 7],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 231.47,  'max_distance' => 243.08, 'points' => 8],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 243.09,  'max_distance' => 252.57, 'points' => 9],
            ['age' => 15, 'gender' => 'male', 'min_distance' => 252.58,  'max_distance' => 999,    'points' => 10],

            // Age 14 and gender male
            ['age' => 14, 'gender' => 'male', 'min_distance' => 0,       'max_distance' => 163.56, 'points' => 0],
            ['age' => 14, 'gender' => 'male', 'min_distance' => 163.57,  'max_distance' => 175.88, 'points' => 1],
            ['age' => 14, 'gender' => 'male', 'min_distance' => 175.89,  'max_distance' => 184.63, 'points' => 2],
            ['age' => 14, 'gender' => 'male', 'min_distance' => 184.64,  'max_distance' => 192.03, 'points' => 3],
            ['age' => 14, 'gender' => 'male', 'min_distance' => 192.04,  'max_distance' => 198.87, 'points' => 4],
            ['age' => 14, 'gender' => 'male', 'min_distance' => 198.88,  'max_distance' => 205.66, 'points' => 5],
            ['age' => 14, 'gender' => 'male', 'min_distance' => 205.67,  'max_distance' => 212.86, 'points' => 6],
            ['age' => 14, 'gender' => 'male', 'min_distance' => 212.87,  'max_distance' => 221.20, 'points' => 7],
            ['age' => 14, 'gender' => 'male', 'min_distance' => 221.21,  'max_distance' => 232.65, 'points' => 8],
            ['age' => 14, 'gender' => 'male', 'min_distance' => 232.66,  'max_distance' => 241.99, 'points' => 9],
            ['age' => 14, 'gender' => 'male', 'min_distance' => 242.00,  'max_distance' => 999,    'points' => 10],

            // Age 13 and gender male
            ['age' => 13, 'gender' => 'male', 'min_distance' => 0,       'max_distance' => 153.00, 'points' => 0],
            ['age' => 13, 'gender' => 'male', 'min_distance' => 153.01,  'max_distance' => 164.96, 'points' => 1],
            ['age' => 13, 'gender' => 'male', 'min_distance' => 164.97,  'max_distance' => 173.45, 'points' => 2],
            ['age' => 13, 'gender' => 'male', 'min_distance' => 173.46,  'max_distance' => 180.63, 'points' => 3],
            ['age' => 13, 'gender' => 'male', 'min_distance' => 180.64,  'max_distance' => 187.27, 'points' => 4],
            ['age' => 13, 'gender' => 'male', 'min_distance' => 187.28,  'max_distance' => 193.85, 'points' => 5],
            ['age' => 13, 'gender' => 'male', 'min_distance' => 193.86,  'max_distance' => 200.82, 'points' => 6],
            ['age' => 13, 'gender' => 'male', 'min_distance' => 200.83,  'max_distance' => 208.91, 'points' => 7],
            ['age' => 13, 'gender' => 'male', 'min_distance' => 208.92,  'max_distance' => 220.00, 'points' => 8],
            ['age' => 13, 'gender' => 'male', 'min_distance' => 220.01,  'max_distance' => 229.05, 'points' => 9],
            ['age' => 13, 'gender' => 'male', 'min_distance' => 229.06,  'max_distance' => 999,    'points' => 10],

            // Age 12 and gender male
            ['age' => 12, 'gender' => 'male', 'min_distance' => 0,       'max_distance' => 142.19, 'points' => 0],
            ['age' => 12, 'gender' => 'male', 'min_distance' => 142.20,  'max_distance' => 153.69, 'points' => 1],
            ['age' => 12, 'gender' => 'male', 'min_distance' => 153.70,  'max_distance' => 161.85, 'points' => 2],
            ['age' => 12, 'gender' => 'male', 'min_distance' => 161.86,  'max_distance' => 168.73, 'points' => 3],
            ['age' => 12, 'gender' => 'male', 'min_distance' => 168.74,  'max_distance' => 175.11, 'points' => 4],
            ['age' => 12, 'gender' => 'male', 'min_distance' => 175.12,  'max_distance' => 181.42, 'points' => 5],
            ['age' => 12, 'gender' => 'male', 'min_distance' => 181.43,  'max_distance' => 188.12, 'points' => 6],
            ['age' => 12, 'gender' => 'male', 'min_distance' => 188.13,  'max_distance' => 195.88, 'points' => 7],
            ['age' => 12, 'gender' => 'male', 'min_distance' => 195.89,  'max_distance' => 206.51, 'points' => 8],
            ['age' => 12, 'gender' => 'male', 'min_distance' => 206.52,  'max_distance' => 215.19, 'points' => 9],
            ['age' => 12, 'gender' => 'male', 'min_distance' => 215.20,  'max_distance' => 999,    'points' => 10],

            // Age 11 and gender male
            ['age' => 11, 'gender' => 'male', 'min_distance' => 0,       'max_distance' => 131.89, 'points' => 0],
            ['age' => 11, 'gender' => 'male', 'min_distance' => 131.90,  'max_distance' => 142.92, 'points' => 1],
            ['age' => 11, 'gender' => 'male', 'min_distance' => 142.93,  'max_distance' => 150.73, 'points' => 2],
            ['age' => 11, 'gender' => 'male', 'min_distance' => 150.74,  'max_distance' => 157.33, 'points' => 3],
            ['age' => 11, 'gender' => 'male', 'min_distance' => 157.34,  'max_distance' => 163.43, 'points' => 4],
            ['age' => 11, 'gender' => 'male', 'min_distance' => 163.44,  'max_distance' => 169.48, 'points' => 5],
            ['age' => 11, 'gender' => 'male', 'min_distance' => 169.49,  'max_distance' => 175.89, 'points' => 6],
            ['age' => 11, 'gender' => 'male', 'min_distance' => 175.90,  'max_distance' => 183.31, 'points' => 7],
            ['age' => 11, 'gender' => 'male', 'min_distance' => 183.32,  'max_distance' => 193.48, 'points' => 8],
            ['age' => 11, 'gender' => 'male', 'min_distance' => 193.49,  'max_distance' => 201.78, 'points' => 9],
            ['age' => 11, 'gender' => 'male', 'min_distance' => 201.79,  'max_distance' => 999,    'points' => 10],

            // Age 10 and gender male
            ['age' => 10, 'gender' => 'male', 'min_distance' => 0,       'max_distance' => 122.25, 'points' => 0],
            ['age' => 10, 'gender' => 'male', 'min_distance' => 122.26,  'max_distance' => 132.84, 'points' => 1],
            ['age' => 10, 'gender' => 'male', 'min_distance' => 132.85,  'max_distance' => 140.34, 'points' => 2],
            ['age' => 10, 'gender' => 'male', 'min_distance' => 140.35,  'max_distance' => 146.68, 'points' => 3],
            ['age' => 10, 'gender' => 'male', 'min_distance' => 146.69,  'max_distance' => 152.53, 'points' => 4],
            ['age' => 10, 'gender' => 'male', 'min_distance' => 152.54,  'max_distance' => 158.33, 'points' => 5],
            ['age' => 10, 'gender' => 'male', 'min_distance' => 158.34,  'max_distance' => 164.48, 'points' => 6],
            ['age' => 10, 'gender' => 'male', 'min_distance' => 164.49,  'max_distance' => 171.60, 'points' => 7],
            ['age' => 10, 'gender' => 'male', 'min_distance' => 171.61,  'max_distance' => 181.35, 'points' => 8],
            ['age' => 10, 'gender' => 'male', 'min_distance' => 181.36,  'max_distance' => 189.31, 'points' => 9],
            ['age' => 10, 'gender' => 'male', 'min_distance' => 189.32,  'max_distance' => 999,    'points' => 10],

            // Age 9 and gender male
            ['age' => 9, 'gender' => 'male', 'min_distance' => 0,       'max_distance' => 112.87, 'points' => 0],
            ['age' => 9, 'gender' => 'male', 'min_distance' => 112.88,  'max_distance' => 123.05, 'points' => 1],
            ['age' => 9, 'gender' => 'male', 'min_distance' => 123.06,  'max_distance' => 130.26, 'points' => 2],
            ['age' => 9, 'gender' => 'male', 'min_distance' => 130.27,  'max_distance' => 136.34, 'points' => 3],
            ['age' => 9, 'gender' => 'male', 'min_distance' => 136.35,  'max_distance' => 141.96, 'points' => 4],
            ['age' => 9, 'gender' => 'male', 'min_distance' => 141.97,  'max_distance' => 147.53, 'points' => 5],
            ['age' => 9, 'gender' => 'male', 'min_distance' => 147.54,  'max_distance' => 153.43, 'points' => 6],
            ['age' => 9, 'gender' => 'male', 'min_distance' => 153.44,  'max_distance' => 160.25, 'points' => 7],
            ['age' => 9, 'gender' => 'male', 'min_distance' => 160.26,  'max_distance' => 169.60, 'points' => 8],
            ['age' => 9, 'gender' => 'male', 'min_distance' => 169.61,  'max_distance' => 177.22, 'points' => 9],
            ['age' => 9, 'gender' => 'male', 'min_distance' => 177.23,  'max_distance' => 999,    'points' => 10],

            // Age 8 and gender male
            ['age' => 8, 'gender' => 'male', 'min_distance' => 0,       'max_distance' => 103.38, 'points' => 0],
            ['age' => 8, 'gender' => 'male', 'min_distance' => 103.39,  'max_distance' => 113.11, 'points' => 1],
            ['age' => 8, 'gender' => 'male', 'min_distance' => 113.12,  'max_distance' => 120.00, 'points' => 2],
            ['age' => 8, 'gender' => 'male', 'min_distance' => 120.01,  'max_distance' => 125.81, 'points' => 3],
            ['age' => 8, 'gender' => 'male', 'min_distance' => 125.82,  'max_distance' => 131.18, 'points' => 4],
            ['age' => 8, 'gender' => 'male', 'min_distance' => 131.19,  'max_distance' => 136.49, 'points' => 5],
            ['age' => 8, 'gender' => 'male', 'min_distance' => 136.50,  'max_distance' => 142.12, 'points' => 6],
            ['age' => 8, 'gender' => 'male', 'min_distance' => 142.13,  'max_distance' => 148.63, 'points' => 7],
            ['age' => 8, 'gender' => 'male', 'min_distance' => 148.64,  'max_distance' => 157.54, 'points' => 8],
            ['age' => 8, 'gender' => 'male', 'min_distance' => 157.55,  'max_distance' => 164.81, 'points' => 9],
            ['age' => 8, 'gender' => 'male', 'min_distance' => 164.82,  'max_distance' => 999,    'points' => 10],

            // Age 7 and gender male
            ['age' => 7, 'gender' => 'male', 'min_distance' => 0,       'max_distance' => 93.75, 'points' => 0],
            ['age' => 7, 'gender' => 'male', 'min_distance' => 93.76,  'max_distance' => 102.98, 'points' => 1],
            ['age' => 7, 'gender' => 'male', 'min_distance' => 102.99,  'max_distance' => 109.50, 'points' => 2],
            ['age' => 7, 'gender' => 'male', 'min_distance' => 109.51,  'max_distance' => 115.00, 'points' => 3],
            ['age' => 7, 'gender' => 'male', 'min_distance' => 115.01,  'max_distance' => 120.08, 'points' => 4],
            ['age' => 7, 'gender' => 'male', 'min_distance' => 120.09,  'max_distance' => 125.11, 'points' => 5],
            ['age' => 7, 'gender' => 'male', 'min_distance' => 125.12,  'max_distance' => 130.43, 'points' => 6],
            ['age' => 7, 'gender' => 'male', 'min_distance' => 130.44,  'max_distance' => 136.59, 'points' => 7],
            ['age' => 7, 'gender' => 'male', 'min_distance' => 136.60,  'max_distance' => 145.02, 'points' => 8],
            ['age' => 7, 'gender' => 'male', 'min_distance' => 145.03,  'max_distance' => 151.88, 'points' => 9],
            ['age' => 7, 'gender' => 'male', 'min_distance' => 151.89,  'max_distance' => 999,    'points' => 10],


            /**
             * Seeder data for female gender
             */
            // Age 18 and gender female
            ['age' => 18, 'gender' => 'female', 'min_distance' => 0,       'max_distance' => 148.78, 'points' => 0],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 148.79,  'max_distance' => 156.83, 'points' => 1],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 156.84,  'max_distance' => 162.67, 'points' => 2],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 162.68,  'max_distance' => 167.67, 'points' => 3],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 167.68,  'max_distance' => 172.35, 'points' => 4],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 172.36,  'max_distance' => 177.05, 'points' => 5],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 177.06,  'max_distance' => 182.09, 'points' => 6],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 182.10,  'max_distance' => 188.01, 'points' => 7],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 188.02,  'max_distance' => 196.24, 'points' => 8],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 196.25,  'max_distance' => 203.06, 'points' => 9],
            ['age' => 18, 'gender' => 'female', 'min_distance' => 203.07,  'max_distance' => 999,    'points' => 10],

            // Age 17 and gender female
            ['age' => 17, 'gender' => 'female', 'min_distance' => 0,       'max_distance' => 147.00, 'points' => 0],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 147.01,  'max_distance' => 155.18, 'points' => 1],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 155.19,  'max_distance' => 161.11, 'points' => 2],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 161.12,  'max_distance' => 166.19, 'points' => 3],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 166.20,  'max_distance' => 170.95, 'points' => 4],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 170.96,  'max_distance' => 175.72, 'points' => 5],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 175.73,  'max_distance' => 180.84, 'points' => 6],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 180.85,  'max_distance' => 186.85, 'points' => 7],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 186.86,  'max_distance' => 195.22, 'points' => 8],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 195.23,  'max_distance' => 202.15, 'points' => 9],
            ['age' => 17, 'gender' => 'female', 'min_distance' => 202.16,  'max_distance' => 999,    'points' => 10],

            // Age 16 and gender female
            ['age' => 16, 'gender' => 'female', 'min_distance' => 0,       'max_distance' => 144.99, 'points' => 0],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 145.00,  'max_distance' => 153.31, 'points' => 1],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 153.32,  'max_distance' => 159.33, 'points' => 2],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 159.34,  'max_distance' => 164.49, 'points' => 3],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 164.50,  'max_distance' => 169.33, 'points' => 4],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 169.34,  'max_distance' => 174.18, 'points' => 5],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 174.19,  'max_distance' => 179.38, 'points' => 6],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 179.39,  'max_distance' => 185.49, 'points' => 7],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 185.50,  'max_distance' => 193.99, 'points' => 8],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 194.00,  'max_distance' => 201.04, 'points' => 9],
            ['age' => 16, 'gender' => 'female', 'min_distance' => 201.05,  'max_distance' => 999,    'points' => 10],

            // Age 15 and gender female
            ['age' => 15, 'gender' => 'female', 'min_distance' => 0,       'max_distance' => 142.49, 'points' => 0],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 142.50,  'max_distance' => 150.94, 'points' => 1],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 150.95,  'max_distance' => 157.05, 'points' => 2],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 157.06,  'max_distance' => 162.30, 'points' => 3],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 162.31,  'max_distance' => 167.21, 'points' => 4],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 167.22,  'max_distance' => 172.14, 'points' => 5],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 172.15,  'max_distance' => 177.43, 'points' => 6],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 177.44,  'max_distance' => 183.64, 'points' => 7],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 183.65,  'max_distance' => 192.28, 'points' => 8],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 192.29,  'max_distance' => 196.45, 'points' => 9],
            ['age' => 15, 'gender' => 'female', 'min_distance' => 196.46,  'max_distance' => 999,    'points' => 10],

            // Age 14 and gender female
            ['age' => 14, 'gender' => 'female', 'min_distance' => 0,       'max_distance' => 139.24, 'points' => 0],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 139.25,  'max_distance' => 147.81, 'points' => 1],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 147.82,  'max_distance' => 154.03, 'points' => 2],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 154.04,  'max_distance' => 159.35, 'points' => 3],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 159.36,  'max_distance' => 164.35, 'points' => 4],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 164.36,  'max_distance' => 169.36, 'points' => 5],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 169.37,  'max_distance' => 174.73, 'points' => 6],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 174.74,  'max_distance' => 181.04, 'points' => 7],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 181.05,  'max_distance' => 189.82, 'points' => 8],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 189.83,  'max_distance' => 197.10, 'points' => 9],
            ['age' => 14, 'gender' => 'female', 'min_distance' => 197.11,  'max_distance' => 999,    'points' => 10],

            // Age 13 and gender female
            ['age' => 13, 'gender' => 'female', 'min_distance' => 0,       'max_distance' => 135.08, 'points' => 0],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 135.09,  'max_distance' => 143.79, 'points' => 1],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 143.80,  'max_distance' => 150.09, 'points' => 2],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 150.10,  'max_distance' => 155.50, 'points' => 3],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 155.51,  'max_distance' => 160.57, 'points' => 4],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 160.58,  'max_distance' => 165.66, 'points' => 5],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 165.67,  'max_distance' => 171.12, 'points' => 6],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 171.13,  'max_distance' => 177.53, 'points' => 7],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 177.54,  'max_distance' => 186.45, 'points' => 8],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 186.46,  'max_distance' => 193.85, 'points' => 9],
            ['age' => 13, 'gender' => 'female', 'min_distance' => 193.86,  'max_distance' => 999,    'points' => 10],

            // Age 12 and gender female
            ['age' => 12, 'gender' => 'female', 'min_distance' => 0,       'max_distance' => 129.95, 'points' => 0],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 129.96,  'max_distance' => 138.77, 'points' => 1],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 138.78,  'max_distance' => 145.17, 'points' => 2],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 145.18,  'max_distance' => 150.66, 'points' => 3],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 150.67,  'max_distance' => 155.81, 'points' => 4],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 155.82,  'max_distance' => 160.97, 'points' => 5],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 160.98,  'max_distance' => 166.51, 'points' => 6],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 166.52,  'max_distance' => 173.01, 'points' => 7],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 173.02,  'max_distance' => 182.08, 'points' => 8],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 182.09,  'max_distance' => 189.59, 'points' => 9],
            ['age' => 12, 'gender' => 'female', 'min_distance' => 189.60,  'max_distance' => 999,    'points' => 10],

            // Age 11 and gender female
            ['age' => 11, 'gender' => 'female', 'min_distance' => 0,       'max_distance' => 123.87, 'points' => 0],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 123.88,  'max_distance' => 132.79, 'points' => 1],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 132.80,  'max_distance' => 139.26, 'points' => 2],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 139.27,  'max_distance' => 144.81, 'points' => 3],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 144.82,  'max_distance' => 150.01, 'points' => 4],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 150.02,  'max_distance' => 155.23, 'points' => 5],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 155.24,  'max_distance' => 160.84, 'points' => 6],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 160.85,  'max_distance' => 167.42, 'points' => 7],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 167.43,  'max_distance' => 176.59, 'points' => 8],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 176.60,  'max_distance' => 184.20, 'points' => 9],
            ['age' => 11, 'gender' => 'female', 'min_distance' => 184.21,  'max_distance' => 999,    'points' => 10],

            // Age 10 and gender female
            ['age' => 10, 'gender' => 'female', 'min_distance' => 0,       'max_distance' => 116.95, 'points' => 0],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 116.96,  'max_distance' => 125.92, 'points' => 1],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 125.93,  'max_distance' => 132.42, 'points' => 2],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 132.43,  'max_distance' => 138.00, 'points' => 3],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 138.01,  'max_distance' => 143.23, 'points' => 4],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 143.24,  'max_distance' => 148.48, 'points' => 5],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 148.49,  'max_distance' => 154.12, 'points' => 6],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 154.13,  'max_distance' => 160.75, 'points' => 7],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 160.76,  'max_distance' => 169.98, 'points' => 8],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 169.99,  'max_distance' => 177.63, 'points' => 9],
            ['age' => 10, 'gender' => 'female', 'min_distance' => 177.64,  'max_distance' => 999,    'points' => 10],

            // Age 9 and gender female
            ['age' => 9, 'gender' => 'female', 'min_distance' => 0,       'max_distance' => 109.37, 'points' => 0],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 109.38,  'max_distance' => 118.31, 'points' => 1],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 118.32,  'max_distance' => 124.79, 'points' => 2],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 124.80,  'max_distance' => 130.36, 'points' => 3],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 130.37,  'max_distance' => 135.58, 'points' => 4],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 135.59,  'max_distance' => 140.83, 'points' => 5],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 140.84,  'max_distance' => 146.45, 'points' => 6],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 146.46,  'max_distance' => 153.07, 'points' => 7],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 153.08,  'max_distance' => 162.28, 'points' => 8],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 162.29,  'max_distance' => 169.93, 'points' => 9],
            ['age' => 9, 'gender' => 'female', 'min_distance' => 169.94,  'max_distance' => 999,    'points' => 10],

            // Age 8 and gender female
            ['age' => 8, 'gender' => 'female', 'min_distance' => 0,       'max_distance' => 101.39, 'points' => 0],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 101.40,  'max_distance' => 110.22, 'points' => 1],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 110.23,  'max_distance' => 116.63, 'points' => 2],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 116.64,  'max_distance' => 122.14, 'points' => 3],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 122.15,  'max_distance' => 127.30, 'points' => 4],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 127.31,  'max_distance' => 132.49, 'points' => 5],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 132.50,  'max_distance' => 138.06, 'points' => 6],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 138.07,  'max_distance' => 144.60, 'points' => 7],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 144.61,  'max_distance' => 153.72, 'points' => 8],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 153.73,  'max_distance' => 161.30, 'points' => 9],
            ['age' => 8, 'gender' => 'female', 'min_distance' => 161.31,  'max_distance' => 999,    'points' => 10],

            // Age 7 and gender female
            ['age' => 7, 'gender' => 'female', 'min_distance' => 0,       'max_distance' => 93.30, 'points' => 0],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 93.31,   'max_distance' => 101.95, 'points' => 1],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 101.96,  'max_distance' => 108.24, 'points' => 2],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 108.25,  'max_distance' => 113.64, 'points' => 3],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 113.65,  'max_distance' => 118.71, 'points' => 4],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 118.72,  'max_distance' => 123.80, 'points' => 5],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 123.81,  'max_distance' => 129.26, 'points' => 6],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 129.27,  'max_distance' => 135.69, 'points' => 7],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 135.70,  'max_distance' => 144.64, 'points' => 8],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 144.65,  'max_distance' => 152.08, 'points' => 9],
            ['age' => 7, 'gender' => 'female', 'min_distance' => 152.09,  'max_distance' => 999,    'points' => 10],
        ];

        foreach ($rules as $rule) {
            PowerTestRule::create($rule);
        }
    }
}
