<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;
use App\Models\Parish;
use App\Models\PrayerRequest;


class PrayerRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = Member::all();
        $parishes = Parish::all();

        if ($members->isEmpty() || $parishes->isEmpty()) {
            $this->command->warn('No members or parishes found. Seed members and parishes first.');
            return;
        }

        if ($members->isEmpty() || $parishes->isEmpty()) {
            $this->command->warn('No members or parishes found. Seed members and parishes first.');
            return;
        }

        foreach (range(1, 10) as $i) {
            $member = $members->random();
            PrayerRequest::create([
                'member_id' => $member->id,
                'parish_id' => $member->parish_id ?? $parishes->random()->id,
                'request' => fake()->sentence(12)
            ]);
        }

    }
}
