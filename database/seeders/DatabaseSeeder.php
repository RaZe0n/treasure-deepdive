<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Guest::factory(100)->create();
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'test@test.com',
            'role' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'Coach',
            'email' => 'coach@coach.com',
            'pin' => '123456',
        ]);
    }
}