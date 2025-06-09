<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attendance::create([
            'parish_id' => 1,
            'service_type' => 'Sunday Service',
            'date' => Carbon::now()->subDays(7),
            'adults' => 50,
            'children' => 20,
            'men' => 25,
            'women' => 30,
            'total' => 50 + 20 + 25 + 30,
        ]);

        Attendance::create([
            'parish_id' => 1,
            'service_type' => 'Midweek Service',
            'date' => Carbon::now()->subDays(3),
            'adults' => 35,
            'children' => 15,
            'men' => 18,
            'women' => 22,
            'total' => 35 + 15 + 18 + 22,
        ]);

        // For parish_id 2
        Attendance::create([
            'parish_id' => 2,
            'service_type' => 'Sunday Service',
            'date' => Carbon::now()->subDays(7),
            'adults' => 40,
            'children' => 10,
            'men' => 20,
            'women' => 25,
            'total' => 40 + 10 + 20 + 25,
        ]);

        Attendance::create([
            'parish_id' => 2,
            'service_type' => 'Vigil',
            'date' => Carbon::now()->subDays(1),
            'adults' => 30,
            'children' => 5,
            'men' => 12,
            'women' => 18,
            'total' => 30 + 5 + 12 + 18,
        ]);
    }
}
