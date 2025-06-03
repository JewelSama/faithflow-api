<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Parish;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'Choir',
            'Ushering',
            'Children Ministry',
            'Media',
            'Sanctuary Keepers',
            'Prayer Unit',
            'Welfare',
            'Evangelism',
        ];

        $parishes = Parish::all();

        foreach ($parishes as $parish) {
            foreach ($departments as $name) {
                Department::create([
                    'parish_id' => $parish->id,
                    'name' => $name,
                ]);
            }
        }
    }
}
