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
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('12345678'),
            ],
            [
                'username' => 'teacher1',
                'email' => 'teacher1@gmail.com',
                'role' => 'teacher',
                'password' => Hash::make('12345678'),
            ],
            [
                'username' => 'teacher2',
                'email' => 'teacher2@gmail.com',
                'role' => 'teacher',
                'password' => Hash::make('12345678'),
            ],
            [
                'username' => 'teacher3',
                'email' => 'teacher3@gmail.com',
                'role' => 'teacher',
                'password' => Hash::make('12345678'),
            ],
            [
                'username' => 'teacher4',
                'email' => 'teacher4@gmail.com',
                'role' => 'teacher',
                'password' => Hash::make('12345678'),
            ],
            [
                'username' => 'teacher5',
                'email' => 'teacher5@gmail.com',
                'role' => 'teacher',
                'password' => Hash::make('12345678'),
            ],
        ];

        // Insert manual users
        foreach ($manualUsers as $userData) {
            User::create($userData);
        }
    }
}
