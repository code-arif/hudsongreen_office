<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('schools')->insert([
            [
                'name' => 'Greenwood High School',
                'principal_name' => 'Dr. Alice Johnson',
                'email' => 'greenwood@example.com',
                'phone' => '(555) 123-1111',
                'street_address' => '1123 Maple Street',
                'city' => 'Springfield',
                'state' => 'CA',
                'zip_code' => '90001',
                'approximate_student_count' => 850,
                'status' => 'pending',
                'approved_by' => 1,
                'approved_at' => now(),
                'cancelled_by' => null,
                'cancelled_at' => null,
                'approval_token' => Str::uuid()->toString(),
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Riverside Academy',
                'principal_name' => 'Mr. Robert Smith',
                'email' => 'riverside@example.com',
                'phone' => '(555) 123-2222',
                'street_address' => '221 Oak Avenue',
                'city' => 'Riverside',
                'state' => 'TX',
                'zip_code' => '75001',
                'approximate_student_count' => 1200,
                'status' => 'pending',
                'approved_by' => 1,
                'approved_at' => now(),
                'cancelled_by' => null,
                'cancelled_at' => null,
                'approval_token' => Str::uuid()->toString(),
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hillcrest School',
                'principal_name' => 'Ms. Jennifer Lee',
                'email' => 'hillcrest@example.com',
                'phone' => '(555) 123-3333',
                'street_address' => '75 Hillcrest Blvd',
                'city' => 'Hilltown',
                'state' => 'NY',
                'zip_code' => '10001',
                'approximate_student_count' => 640,
                'status' => 'pending',
                'approved_by' => 1,
                'approved_at' => now(),
                'cancelled_by' => null,
                'cancelled_at' => null,
                'approval_token' => Str::uuid()->toString(),
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sunnydale Public School',
                'principal_name' => 'Mr. David Wilson',
                'email' => 'sunnydale@example.com',
                'phone' => '(555) 123-4444',
                'street_address' => '400 Sunshine Road',
                'city' => 'Sunnyvale',
                'state' => 'FL',
                'zip_code' => '32003',
                'approximate_student_count' => 930,
                'status' => 'pending',
                'approved_by' => 1,
                'approved_at' => now(),
                'cancelled_by' => null,
                'cancelled_at' => null,
                'approval_token' => Str::uuid()->toString(),
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lakeside International School',
                'principal_name' => 'Dr. Emma Brown',
                'email' => 'lakeside@example.com',
                'phone' => '(555) 123-5555',
                'street_address' => '89 Lakeview Drive',
                'city' => 'Lakeside',
                'state' => 'IL',
                'zip_code' => '60007',
                'approximate_student_count' => 1500,
                'status' => 'pending',
                'approved_by' => 1,
                'approved_at' => now(),
                'cancelled_by' => null,
                'cancelled_at' => null,
                'approval_token' => Str::uuid()->toString(),
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
