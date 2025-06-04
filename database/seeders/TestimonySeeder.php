<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Testimony;
use App\Models\Member;
use App\Models\Parish;
use Faker\Factory;

class TestimonySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $members = Member::all();
        $parishes = Parish::all();

        if ($members->isEmpty() || $parishes->isEmpty()) {
            $this->command->warn('Seed members and parishes first.');
            return;
        }

        foreach (range(1, 10) as $i) {
            $member = $members->random();
            $parish = $member->parish_id ? Parish::find($member->parish_id) : $parishes->random();

            Testimony::create([
                'member_id' => $member->id,
                'parish_id' => $parish->id,
                'content' => $faker->paragraph(3),
                'date' => $faker->date(),
            ]);
        }
    }
}
