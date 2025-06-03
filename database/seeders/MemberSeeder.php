<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::create([
            'parish_id' => 1,
            'full_name' => 'Samuel Kofi Mensah',
            'gender' => 'male',
            'phone' => '0541234567',
            'email' => 'samuel.mensah@example.com',
            'address' => '12 Peace Road, Accra',
            'dob' => '1990-05-15',
            'joined_date' => '2021-08-01',
        ]);

        Member::create([
            'parish_id' => 1,
            'full_name' => 'Abena Ama Asante',
            'gender' => 'female',
            'phone' => '0547654321',
            'email' => 'abena.asante@example.com',
            'address' => '45 Glory Street, Accra',
            'dob' => '1985-12-22',
            'joined_date' => '2022-01-15',
        ]);

        Member::create([
            'parish_id' => 2,
            'full_name' => 'Joseph Otieno',
            'gender' => 'male',
            'phone' => '0712345678',
            'email' => 'joseph.otieno@example.com',
            'address' => '78 Faith Lane, Nairobi',
            'dob' => '1992-07-09',
            'joined_date' => '2023-03-05',
        ]);
    }
}
