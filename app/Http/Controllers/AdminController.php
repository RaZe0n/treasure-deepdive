<?php

namespace App\Http\Controllers;

use App\Models\EnlistedGuests;
use App\Models\Game;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function createGame(Request $request)
    {
        $game = Game::create([
            'name' => $request->name
        ]);
        EnlistedGuests::create(['game_id' => $game->id, 'name' => 'Rutger van der Kooi', 'class_name' => '23SDB']);
        EnlistedGuests::create(['game_id' => $game->id, 'name' => 'Finn Bruinzeel', 'class_name' => '23SDB']);
        return view('admin.index');
    }

    public function show(Game $game)
    {
        return view('admin.game.show', ['game' => $game]);
    }

    public function startGame(Game $game)
    {
        $game->pin = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $game->save();
    }
}
