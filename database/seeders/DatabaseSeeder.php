<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SchoolTableSeeder::class,
            SettingSeeder::class,
            CmsSeeder::class,
            StudentSeeder::class,
            FitnessTestSeeder::class,
            AgilityRuleSeeder::class,
            FlexibilityRuleSeeder::class,
            BalanceRuleSeeder::class,
            CoordinationRuleSeeder::class,
            ReactionRuleSeeder::class,
            PowerTestRuleSeeder::class,
            StrengthRuleSeeder::class,
            StaminaRuleSeeder::class,
            SpeedRuleSeeder::class,
            CardiovascularRuleSeeder::class
        ]);
    }
}
