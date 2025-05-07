<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function createGame(Request $request)
    {
        $game = Game::create([
            'name' => $request->name
        ]);

        return view('admin.index');
    }

    public function show(Game $game)
    {
        return view('admin.game.show', ['game' => $game]);
    }
}
