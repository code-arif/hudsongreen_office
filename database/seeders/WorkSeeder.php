<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Work;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        // Fetch all team IDs
        $teams = Team::pluck('id')->toArray();
        // Fetch all category IDs (assuming categories exist)
        $categories = Category::pluck('id')->toArray();

        for ($i = 1; $i <= 20; $i++) {
            Work::create([
                'title' => 'Work Task ' . $i,
                'description' => 'Description for Work Task ' . $i,
                'location' => 'Location ' . $i,
                'latitude' => 23.7000 + ($i * 0.001), // dummy latitude
                'longitude' => 90.4000 + ($i * 0.001), // dummy longitude
                'time' => now()->format('H:i:s'),
                'work_date' => now()->addDays($i)->format('Y-m-d'),
                'is_completed' => false,
                'is_rescheduled' => false,
                'note' => 'Note for Work Task ' . $i,
                'status' => 1,
                'team_id' => $teams[array_rand($teams)], // random team
                'category_id' => $categories[array_rand($categories)], // random category
            ]);
        }
    }
}
