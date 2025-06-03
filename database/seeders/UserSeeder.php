<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John ParishAdmin',
            'email' => 'john@gracechapel.org',
            'password' => Hash::make('admin'),
            'phone' => '07012345678',
            'role' => 'parish_admin',
            'parish_id' => 1,
        ]);

        User::create([
            'name' => 'Mary ParishAdmin',
            'email' => 'mary@livingwaters.org',
            'password' => Hash::make('admin'),
            'phone' => '08098765432',
            'role' => 'parish_admin',
            'parish_id' => 2,
        ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@faithflow.org',
            'password' => Hash::make('admin'),
            'phone' => '08000000000',
            'role' => 'super_admin',
            'parish_id' => null,
        ]);
    }
}
