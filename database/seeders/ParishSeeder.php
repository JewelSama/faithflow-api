<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Parish;

class ParishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Parish::create([
            'name' => 'Grace Chapel',
            'location' => '10 Faith Avenue',
            'city' => 'Accra',
            'country' => 'Ghana',
        ]);

        Parish::create([
            'name' => 'Living Waters',
            'location' => '23 Hope Street',
            'city' => 'Nairobi',
            'country' => 'Kenya',
        ]);
    }
}
