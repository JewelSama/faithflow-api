<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FinanceSeeder extends Seeder
{
    public function run(): void
    {
        $parishId = 1; // Ensure a parish with this ID exists
        $memberIds = DB::table('members')->pluck('id')->toArray();

        // Seed Offerings
        for ($i = 0; $i < 10; $i++) {
            DB::table('offerings')->insert([
                'parish_id' => $parishId,
                'member_id' => fake()->randomElement(array_merge($memberIds, [null])),
                'amount' => fake()->randomFloat(2, 500, 5000),
                'date' => fake()->dateTimeBetween('-2 months', 'now')->format('Y-m-d'),
                'service_type' => fake()->randomElement(['Sunday Service', 'Midweek Service', 'Thanksgiving']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Tithes
        for ($i = 0; $i < 10; $i++) {
            DB::table('tithes')->insert([
                'parish_id' => $parishId,
                'member_id' => fake()->randomElement(array_merge($memberIds, [null])),
                'amount' => fake()->randomFloat(2, 1000, 10000),
                'month_year' => fake()->monthName . ' ' . now()->year,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Donations
        for ($i = 0; $i < 10; $i++) {
            DB::table('donations')->insert([
                'parish_id' => $parishId,
                'member_id' => fake()->randomElement(array_merge($memberIds, [null])),
                'category' => fake()->randomElement(['Tithe', 'Offering', 'Pledge']),
                'mode' => fake()->randomElement(['Cash', 'Transfer', 'POS']),
                'amount' => fake()->randomFloat(2, 1000, 20000),
                'donation_date' => fake()->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
