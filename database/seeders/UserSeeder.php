<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Manually inserted users
        $manualUsers = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'phone' => '1234546788',
                'role' => 'admin',
                'password' => Hash::make('12345678'),
                'unique_id' => '198563'
            ],
            [
                'name' => 'employee1',
                'email' => 'employee1@gmail.com',
                'phone' => '9876543456',
                'role' => 'employee',
                'password' => Hash::make('12345678'),
                'unique_id' => '198763'
            ],
            [
                'name' => 'employee2',
                'email' => 'employee2@gmail.com',
                'phone' => '98765333456',
                'role' => 'employee',
                'password' => Hash::make('12345678'),
                'unique_id' => '118763'
            ],
        ];

        // Insert manual users
        foreach ($manualUsers as $userData) {
            User::create($userData);
        }
    }
}
