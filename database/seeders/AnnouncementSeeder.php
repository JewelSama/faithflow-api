<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Announcement;
use App\Models\Parish;
use Illuminate\Support\Carbon;


class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parish = Parish::first();

        if (!$parish) {
            $parish = Parish::create([
                'name' => 'Default Parish',
                // Add other required parish fields here
            ]);
        }

        $announcements = [
            [
                'parish_id' => $parish->id,
                'title' => 'Sunday Service Time',
                'message' => 'Join us every Sunday by 9 AM for worship.',
                'is_global' => false,
                'published_at' => Carbon::now(),
            ],
            [
                'parish_id' => $parish->id,
                'title' => 'Midweek Prayer',
                'message' => 'Don’t miss our Wednesday prayer meeting at 6 PM.',
                'is_global' => true,
                'published_at' => Carbon::now()->subDays(3),
            ],
            [
                'parish_id' => $parish->id,
                'title' => 'Youth Vigil',
                'message' => 'Youth vigil holds this Friday at 10 PM.',
                'is_global' => false,
                'published_at' => Carbon::now()->addDays(2),
            ],
        ];

        foreach ($announcements as $data) {
            Announcement::create($data);
        }
    }
}
