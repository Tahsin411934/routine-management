<?php

namespace Database\Seeders;

use App\Models\Semester;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::insertOrIgnore([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);
        User::insertOrIgnore([
            'name' => 'Teacher',
            'email' => 'teacher@gmail.com',
            'role' => 'teacher',
            'password' => Hash::make('password'),
        ]);

        $semesters = [
            '1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th',
        ];
        foreach ($semesters as $semester) {
            Semester::insertOrIgnore([
                'name' => $semester,
            ]);
        }
    }
}
