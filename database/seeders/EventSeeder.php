<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Parish;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parish = Parish::first(); // Ensure at least one parish exists

        if ($parish) {
            Event::create([
                'parish_id' => $parish->id,
                'title' => 'Monthly Revival',
                'description' => 'A 3-day revival event with guest ministers.',
                'event_date' => now()->addDays(10)->toDateString(),
                'time' => '18:00:00', // 6:00 PM in 24-hour format
                'venue' => 'Main Auditorium',
            ]);
            
            Event::create([
                'parish_id' => $parish->id,
                'title' => 'Youth Conference',
                'description' => 'Empowering the next generation.',
                'event_date' => now()->addWeeks(2)->toDateString(),
                'time' => '10:00:00', // 10:00 AM
                'venue' => 'Youth Hall',
            ]);
        }
    }
}
