<?php

namespace Database\Seeders;

use App\Models\EnlistedGuests;
use App\Models\Game;
use App\Models\Guest;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\EnlistedGuests;

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
        User::factory()->create([
            'name' => 'Test Coach',
            'email' => 'text@coach.com',
            'pin' => '123456',
        ]);
        $game = Game::create(['name' => 'gameTest', 'pin' => '123456']);
        EnlistedGuests::create(['game_id' => $game->id, 'name' => 'Rutger van der Kooi', 'class_name' => '23SDB']);
         EnlistedGuests::create(['game_id' => $game->id, 'name' => 'Finn van der Kooi', 'class_name' => '23SDB']);
         EnlistedGuests::create(['game_id' => $game->id, 'name' => 'Gerjan van der Kooi', 'class_name' => '23SDB']);
         EnlistedGuests::create(['game_id' => $game->id, 'name' => 'Ezra van der Kooi', 'class_name' => '23SDB']);

        $game = Game::create(['name' => 'gameTest', 'pin' => '123457']);
        EnlistedGuests::create(['game_id' => $game->id, 'name' => 'Rutger van der Kooi', 'class_name' => '23SDB']);
    }
}